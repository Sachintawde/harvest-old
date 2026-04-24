<?php
/**
 * Standalone Microsoft Graph API Mail Test
 * -----------------------------------------
 * Upload this file + env.live to the live server root, visit it once,
 * then DELETE IT immediately after testing.
 *
 * Usage:
 *   https://harvestgreenmontessori.com/graph_live_test.php
 *   https://harvestgreenmontessori.com/graph_live_test.php?to=you@gmail.com
 *
 * Security: Locked to a simple token to prevent public access.
 * Access key: harvest2026test
 * URL: graph_live_test.php?key=harvest2026test
 */

// ── Access guard ──────────────────────────────────────────────────────────────
define('ACCESS_KEY', 'harvest2026test');
if (($_GET['key'] ?? '') !== ACCESS_KEY) {
    http_response_code(403);
    die('Access denied. Append ?key=harvest2026test to the URL.');
}

// ── Load env.live ─────────────────────────────────────────────────────────────
$env_file = __DIR__ . '/env.live';
$env = [];
if (file_exists($env_file)) {
    foreach (file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        if (strpos($line, '=') === false) continue;
        [$k, $v] = explode('=', $line, 2);
        $k = trim($k); $v = trim($v);
        if (strlen($v) > 1 && (($v[0] === '"' && substr($v, -1) === '"') || ($v[0] === "'" && substr($v, -1) === "'"))) {
            $v = substr($v, 1, -1);
        }
        $env[$k] = $v;
    }
}

$tenant_id     = $env['MS_GRAPH_TENANT_ID']     ?? '';
$client_id     = $env['MS_GRAPH_CLIENT_ID']     ?? '';
$client_secret = $env['MS_GRAPH_CLIENT_SECRET'] ?? '';
$from          = $env['MAIL_FROM_ADDRESS']       ?? '';
$admin_to      = $env['ADMIN_MAIL_TO']           ?? '';

// Override recipient if ?to= is passed
$send_to_raw = $_GET['to'] ?? '';
$send_to = (!empty($send_to_raw) && filter_var($send_to_raw, FILTER_VALIDATE_EMAIL)) ? $send_to_raw : $admin_to;

// ── HTML output ───────────────────────────────────────────────────────────────
header('Content-Type: text/html; charset=utf-8');
?><!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Graph Mail Test — Live</title>
<style>
  body{font-family:monospace;background:#0d1117;color:#c9d1d9;padding:24px;max-width:800px;margin:auto}
  h2{color:#58a6ff}h3{color:#e3b341;margin:16px 0 8px}
  .ok{color:#3fb950}.fail{color:#f85149}.warn{color:#d29922}
  pre{background:#161b22;padding:12px;border-radius:6px;font-size:12px;white-space:pre-wrap;overflow:auto}
  table{border-collapse:collapse;width:100%;margin-bottom:12px}
  td,th{border:1px solid #30363d;padding:8px 12px;font-size:13px}th{background:#21262d;text-align:left}
  .box{border:1px solid #30363d;border-radius:6px;padding:16px 20px;margin-bottom:20px}
  .note{background:#1f2937;border-left:4px solid #f85149;padding:10px 14px;border-radius:4px;margin-bottom:20px;font-size:13px}
</style></head><body>
<h2>&#9993; Microsoft Graph Mail Test &mdash; Live Server</h2>
<p>PHP <?= phpversion() ?> &nbsp;|&nbsp; OS: <?= PHP_OS ?> &nbsp;|&nbsp; <?= date('Y-m-d H:i:s T') ?></p>
<div class="note">&#9888; <strong>DELETE this file immediately after testing!</strong></div>

<?php
// ── Step 1: env.live check ────────────────────────────────────────────────────
echo '<div class="box"><h3>&#9312; env.live — Configuration</h3>';
if (!file_exists($env_file)) {
    echo '<p class="fail">&#10008; env.live NOT FOUND at: ' . htmlspecialchars($env_file) . '</p>';
    echo '<p>Upload <code>env.live</code> to the same folder as <code>index.php</code> on the live server.</p>';
} else {
    echo '<p class="ok">&#10004; env.live found: ' . htmlspecialchars($env_file) . '</p>';
}
$keys = ['MS_GRAPH_TENANT_ID','MS_GRAPH_CLIENT_ID','MS_GRAPH_CLIENT_SECRET','MAIL_FROM_ADDRESS','ADMIN_MAIL_TO'];
echo '<table><tr><th>Key</th><th>Value</th></tr>';
foreach ($keys as $k) {
    $v = $env[$k] ?? null;
    if ($k === 'MS_GRAPH_CLIENT_SECRET' && $v) {
        $display = str_repeat('*', max(0, strlen($v) - 4)) . substr($v, -4);
    } else {
        $display = $v !== null ? htmlspecialchars($v) : '<span class="warn">NOT SET</span>';
    }
    echo "<tr><td>{$k}</td><td>{$display}</td></tr>";
}
echo '</table></div>';

// ── Step 2: cURL / SSL check ──────────────────────────────────────────────────
echo '<div class="box"><h3>&#9313; cURL / SSL</h3>';
echo '<p>cURL version: ' . (curl_version()['version'] ?? 'n/a') . '</p>';
$cainfo = ini_get('curl.cainfo');
echo '<p>curl.cainfo: ' . ($cainfo ? htmlspecialchars($cainfo) . (file_exists($cainfo) ? ' <span class="ok">(exists)</span>' : ' <span class="fail">(FILE NOT FOUND)</span>') : '<span class="warn">not set (OS bundle will be used)</span>') . '</p>';
echo '</div>';

// ── Step 3: Get access token ──────────────────────────────────────────────────
echo '<div class="box"><h3>&#9314; OAuth 2.0 — Get Access Token</h3>';
$token = null;
$token_error = '';

if (empty($tenant_id) || empty($client_id) || empty($client_secret)) {
    echo '<p class="fail">&#10008; Missing MS_GRAPH_* credentials — cannot request token.</p>';
} else {
    $token_url  = "https://login.microsoftonline.com/{$tenant_id}/oauth2/v2.0/token";
    $token_body = http_build_query([
        'grant_type'    => 'client_credentials',
        'client_id'     => $client_id,
        'client_secret' => $client_secret,
        'scope'         => 'https://graph.microsoft.com/.default',
    ]);
    $ch = curl_init($token_url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $token_body,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
    ]);
    $resp     = curl_exec($ch);
    $curl_err = curl_error($ch);
    $http     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($resp === false) {
        echo '<p class="fail">&#10008; cURL error: ' . htmlspecialchars($curl_err) . '</p>';
        if (strpos($curl_err, 'SSL') !== false || strpos($curl_err, 'certificate') !== false) {
            echo '<p class="warn">SSL issue detected. On Linux hosting this usually fixes itself. On Windows, set <code>curl.cainfo</code> in php.ini.</p>';
        }
    } elseif ($http !== 200) {
        $data = json_decode($resp, true);
        echo '<p class="fail">&#10008; Token request failed. HTTP ' . $http . '</p>';
        echo '<pre>' . htmlspecialchars(json_encode($data, JSON_PRETTY_PRINT)) . '</pre>';
        if (!empty($data['error_description']) && strpos($data['error_description'], '7000215') !== false) {
            echo '<p class="warn">&#9888; AADSTS7000215 — Client secret is invalid or expired. Create a new secret in Azure Portal.</p>';
        }
        if (!empty($data['error_description']) && strpos($data['error_description'], '700016') !== false) {
            echo '<p class="warn">&#9888; AADSTS700016 — Client ID not found in tenant. Check MS_GRAPH_CLIENT_ID and MS_GRAPH_TENANT_ID.</p>';
        }
    } else {
        $data  = json_decode($resp, true);
        $token = $data['access_token'] ?? null;
        echo '<p class="ok">&#10004; Access token acquired. Expires in ' . ($data['expires_in'] ?? '?') . 's.</p>';
    }
}
echo '</div>';

// ── Step 4: Send test email ───────────────────────────────────────────────────
echo '<div class="box"><h3>&#9315; Send Test Email &rarr; ' . htmlspecialchars($send_to) . '</h3>';
if (!$token) {
    echo '<p class="warn">Skipped — no access token.</p>';
} elseif (empty($from)) {
    echo '<p class="fail">&#10008; MAIL_FROM_ADDRESS not set in env.live.</p>';
} else {
    $payload = json_encode([
        'message' => [
            'subject' => '[LIVE TEST] Graph API — ' . date('Y-m-d H:i:s T'),
            'body'    => [
                'contentType' => 'HTML',
                'content'     => '<h2>&#9989; Live Server Test</h2>'
                               . '<p>Microsoft Graph API email is working on the <strong>live server</strong>.</p>'
                               . '<p>Sent: ' . date('Y-m-d H:i:s T') . '<br>'
                               . 'PHP: ' . phpversion() . '<br>'
                               . 'Server: ' . htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'unknown') . '</p>',
            ],
            'toRecipients' => [['emailAddress' => ['address' => $send_to]]],
        ],
        'saveToSentItems' => false,
    ]);

    $send_url = "https://graph.microsoft.com/v1.0/users/" . urlencode($from) . "/sendMail";
    $ch = curl_init($send_url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ],
    ]);
    $resp     = curl_exec($ch);
    $curl_err = curl_error($ch);
    $http     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($resp === false) {
        echo '<p class="fail">&#10008; cURL error: ' . htmlspecialchars($curl_err) . '</p>';
    } elseif ($http === 202) {
        echo '<p class="ok">&#10004; Email SENT (HTTP 202). Check inbox at: <strong>' . htmlspecialchars($send_to) . '</strong></p>';
    } else {
        $data = json_decode($resp, true);
        echo '<p class="fail">&#10008; Send failed. HTTP ' . $http . '</p>';
        echo '<pre>' . htmlspecialchars(json_encode($data, JSON_PRETTY_PRINT)) . '</pre>';
        if (!empty($data['error']['code'])) {
            $code = $data['error']['code'];
            if ($code === 'ErrorAccessDenied') {
                echo '<p class="warn">&#9888; Mail.Send permission not granted. Go to Azure Portal → App registrations → API permissions → add Mail.Send (Application) → Grant admin consent.</p>';
            } elseif ($code === 'AuthenticationError') {
                echo '<p class="warn">&#9888; Authentication failed. Token may be for wrong tenant/app.</p>';
            } elseif ($code === 'MailboxNotEnabledForRESTAPI') {
                echo '<p class="warn">&#9888; The mailbox ' . htmlspecialchars($from) . ' is not licensed for Microsoft Graph. Ensure it has an Exchange/M365 license.</p>';
            }
        }
    }
}
echo '</div>';

echo '<p style="color:#555;font-size:12px;margin-top:30px">&#9888; Delete graph_live_test.php from the server after testing.</p>';
?>
</body></html>
