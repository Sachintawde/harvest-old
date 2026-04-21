# Why Emails Are Not Being Received — `info@harvestgreenmontessori.com`

**Date:** April 21, 2026  
**Last Updated:** April 21, 2026 — Mail sending confirmed working via `mail()`. Emails not received in `info@` inbox — Microsoft 365 spam/junk filtering is the active issue.  
**Application:** Harvest Green Montessori School (CodeIgniter 3)  
**Recipient address:** `info@harvestgreenmontessori.com`  
**Mailbox provider:** Microsoft 365 (Office 365)

---

## SMTP Configuration Summary

### Local Environment (`env.local`)

| Key | Value |
|---|---|
| `MAIL_PROTOCOL` | `smtp` |
| `MAIL_HOST` | `smtp.office365.com` |
| `MAIL_PORT` | `587` |
| `MAIL_USERNAME` | `info@harvestgreenmontessori.com` |
| `MAIL_PASSWORD` | `Saibaba0987612$` |
| `MAIL_ENCRYPTION` | `tls` (STARTTLS) |
| `MAIL_FROM_ADDRESS` | `info@harvestgreenmontessori.com` |
| `MAIL_FROM_NAME` | `Harvest Green Montessori School` |
| `ADMIN_MAIL_TO` | `info@harvestgreenmontessori.com` |

### Live / Production Environment (`env.live`)

> ✅ **Fixed on April 21, 2026** — Updated to use `smtp.office365.com:587` with TLS (same as local).

| Key | Value |
|---|---|
| `MAIL_PROTOCOL` | `smtp` |
| `MAIL_HOST` | `smtp.office365.com` |
| `MAIL_PORT` | `587` |
| `MAIL_USERNAME` | `info@harvestgreenmontessori.com` |
| `MAIL_PASSWORD` | `Saibaba0987612$` |
| `MAIL_ENCRYPTION` | `tls` (STARTTLS) |
| `MAIL_FROM_ADDRESS` | `info@harvestgreenmontessori.com` |
| `MAIL_FROM_NAME` | `Harvest Green Montessori School` |
| `ADMIN_MAIL_TO` | `info@harvestgreenmontessori.com` |

> **Note:** Both environments now authenticate directly with Microsoft 365's SMTP server on port 587 with TLS.

---

## Root Causes — Live Environment (GoDaddy Shared Hosting)

### ~~1. GoDaddy Blocks Outbound Port 25~~ ✅ FIXED

GoDaddy shared hosting intentionally blocks outbound connections on port 25 from PHP scripts to prevent spam abuse. When the application called `smtp.connect('localhost', 25)`, the connection either timed out silently or was refused. No error was thrown — `CI_Email::send()` may even have returned `TRUE` because the local MTA accepted the message, but it was then dropped before leaving the server.

**Effect:** Emails were accepted by the local sendmail/postfix queue but never forwarded to Microsoft 365. They silently disappeared.

**Fix applied:** `MAIL_HOST` changed to `smtp.office365.com`, `MAIL_PORT` changed to `587`.

### ~~2. No SMTP Authentication Credentials on Live~~ ✅ FIXED

`MAIL_USERNAME` and `MAIL_PASSWORD` were empty in `env.live`. GoDaddy's local relay normally does not require authentication for PHP-submitted mail, but any relay that does will immediately reject the connection.

**Effect:** Relay refused the message silently (with `APP_DEBUG=false` in `env.live`, the failure was completely invisible).

**Fix applied:** `MAIL_USERNAME` and `MAIL_PASSWORD` set to the Microsoft 365 credentials.

### ~~3. No TLS/Encryption on Live~~ ✅ FIXED

`MAIL_ENCRYPTION` was blank in `env.live`. Emails were submitted to the local relay in plain text. Microsoft 365 enforces TLS on inbound connections from unknown relays, causing the message to be refused or silently discarded.

**Fix applied:** `MAIL_ENCRYPTION=tls` set in `env.live`.

### 16. GoDaddy Blocks Outbound Port 587 on Live Server — **NEW CRITICAL FINDING**

**Confirmed by live diagnostic test on April 21, 2026.**

After switching `env.live` to `smtp.office365.com:587`, the live server test showed:

```
Port 587 — BLOCKED — Connection timed out (110)
✘ FAILED → info@harvestgreenmontessori.com
The following SMTP error was encountered: 110 Connection timed out
```

GoDaddy shared hosting firewalls outbound TCP connections on **both port 25 and port 587** from PHP processes. This is a server-level network restriction that cannot be worked around by changing credentials or encryption settings. The TCP connection never reaches Microsoft 365's servers — it times out after ~6 seconds.

**This is the root cause of email delivery failure on the live server.**

**Solutions (in order of recommended priority):**

1. **Use GoDaddy's own SMTP relay** — GoDaddy allows outbound connections to their own relay from within shared hosting. Use `relay-hosting.secureserver.net` on port 25 (no credentials needed from within GoDaddy). This is the simplest fix but requires no authentication, meaning SPF/DKIM must be correctly configured.
2. **Use port 465 (SSL) instead of 587** — Some GoDaddy plans allow outbound port 465. Worth testing before escalating.
3. **Contact GoDaddy support** and request that outbound port 587 be unblocked for the hosting account. This may not be possible on all shared hosting tiers.
4. **Switch to a transactional email API** (SendGrid, Mailgun, AWS SES) that communicates over HTTPS (port 443) instead of raw SMTP — port 443 is never blocked.

---

### 4. Email is Sent from the Same Address It Is Delivered To

The `MAIL_FROM_ADDRESS` is `info@harvestgreenmontessori.com` and `ADMIN_MAIL_TO` is also `info@harvestgreenmontessori.com`. When the local GoDaddy relay sends a message originating from a Microsoft 365 address but not authenticated via Microsoft 365's SMTP servers, the receiving Microsoft 365 mailbox will almost certainly classify it as spoofing and reject or spam-folder it. Microsoft 365's inbound DMARC enforcement checks whether the sending IP (GoDaddy's server IP) is authorized to send on behalf of `harvestgreenmontessori.com`.

---

## Root Causes — Local Environment (Windows / Office 365 SMTP)

### 5. Microsoft 365 Basic Authentication (SMTP AUTH) Disabled

Microsoft began disabling Basic Authentication for SMTP AUTH across all tenants starting **October 1, 2022**. If SMTP AUTH has been disabled at the tenant level or for the specific `info@harvestgreenmontessori.com` mailbox in the Microsoft 365 Admin Center, the connection will be rejected with a `535 5.7.139 Authentication unsuccessful` error regardless of whether the username and password are correct.

**How to check:** Log in to the Microsoft 365 Admin Center → Users → Active Users → select the account → Mail → Manage email apps → confirm **Authenticated SMTP** is checked ON.

**Effect:** CodeIgniter's `CI_Email::send()` returns `FALSE` and the email is never sent.

### 6. SMTP AUTH Disabled at the Tenant Level

Even if the mailbox setting is correct, SMTP AUTH can be disabled globally for the entire tenant. This is done in Exchange Online Admin Center under **Settings → Org Settings → Modern Authentication** or via PowerShell:

```powershell
Get-TransportConfig | Select-Object SmtpClientAuthenticationDisabled
```

If this returns `True`, no mailbox in the tenant can use Basic Auth SMTP.

### 7. Multi-Factor Authentication (MFA) Blocking Basic Auth

If `info@harvestgreenmontessori.com` has MFA (Two-Factor Authentication) enforced via a Conditional Access Policy or the per-user MFA setting, then Basic Authentication SMTP will be blocked entirely. Basic Auth cannot complete an MFA challenge — it does not support interactive prompts. The SMTP connection will be rejected with an authentication error.

**Effect:** The application cannot send email at all until MFA is excluded for SMTP or an App Password is generated.

### 8. Incorrect or Expired Password

The password stored in `env.local` (`Saibaba0987612$`) may have been changed, reset, or expired on the Microsoft 365 side. Microsoft 365 passwords can be set to expire on a schedule, and an admin password reset would also invalidate the stored credential.

**Effect:** Authentication fails with `535 5.7.3 Authentication unsuccessful`.

### 9. `cacert.pem` SSL Certificate Bundle — Outdated

The custom `MY_Email.php` library (`application/libraries/MY_Email.php`) uses `application/config/cacert.pem` on Windows to verify SSL certificates when connecting to `smtp.office365.com:587` via STARTTLS. The `cacert.pem` bundle is the Mozilla/cURL CA certificate bundle. If this file is outdated, the SSL handshake may fail because newer intermediate certificates used by Microsoft are not included.

- File location: `application/config/cacert.pem`
- The file **exists** in this project.
- **Action:** Download the latest bundle from https://curl.se/ca/cacert.pem periodically.

If `cacert.pem` is absent or unreadable, `MY_Email.php` falls back to disabling SSL peer verification (`verify_peer = false`), which allows the connection to proceed but leaves it vulnerable to man-in-the-middle attacks.

---

## Root Causes — Email Delivery & Spam (Both Environments)

### 10. Emails Delivered to Spam / Junk Folder

Even when an email is successfully sent and accepted by Microsoft 365's inbound gateway, it may be automatically classified as spam and moved to the Junk Email folder rather than the inbox. This happens because:

- The sending IP (GoDaddy's server or a PHP localhost relay) has low sender reputation.
- The `From` address (`info@harvestgreenmontessori.com`) does not align with the sending server's SPF record.
- The email lacks DKIM signing.
- The email subject or body contains words/patterns flagged by Microsoft Defender's spam filter.

**Effect:** The recipient never sees the email because it is silently quarantined in Junk.

### 11. Missing or Incorrect SPF Record

An SPF (Sender Policy Framework) DNS record for `harvestgreenmontessori.com` must authorize every IP that legitimately sends email from this domain. If the live environment sends via GoDaddy's mail relay and GoDaddy's IP is not listed in the SPF record, receiving servers (including Microsoft 365 itself) will mark the message as a fail or softfail.

**How to check:**
```
nslookup -type=TXT harvestgreenmontessori.com
```
or use https://mxtoolbox.com/spf.aspx

**Correct SPF should include:** GoDaddy's mail servers and `include:spf.protection.outlook.com` for Microsoft 365.

### 12. Missing DKIM Signing

DKIM (DomainKeys Identified Mail) cryptographically signs outgoing emails to prove they originated from an authorized server. If DKIM is not configured in Microsoft 365 for `harvestgreenmontessori.com`, all outbound emails from this domain are unsigned. Modern mail filters (including Microsoft 365's own inbound filter) apply higher spam scores to unsigned messages.

**How to configure:** Microsoft 365 Admin Center → Security → Email & Collaboration → Policies & Rules → Threat Policies → Email authentication settings → DKIM.

### 13. Missing DMARC Policy

DMARC (Domain-based Message Authentication, Reporting & Conformance) ties SPF and DKIM together. Without a DMARC record, receiving servers have no policy instruction for how to handle messages that fail SPF/DKIM checks. Some servers will quarantine or reject such messages by default.

**How to check:**
```
nslookup -type=TXT _dmarc.harvestgreenmontessori.com
```

A basic DMARC record would look like:
```
v=DMARC1; p=none; rua=mailto:info@harvestgreenmontessori.com
```

---

## Root Causes — Application / Configuration Layer

### 14. `APP_DEBUG=false` on Live — Errors Are Silently Swallowed

In `env.live`, `APP_DEBUG=false` and `LOG_LEVEL=error`. CodeIgniter's email library returns `FALSE` on failure, but if the controller does not explicitly check the return value and log it, the failure is completely invisible. There are no visible error messages and no log entries generated for SMTP connection failures at `error` log level if the SMTP failure is treated as a non-fatal warning internally.

### 15. Emails Sent but Destined for the Same Mailbox That Is Broken

Both `MAIL_FROM_ADDRESS` and `ADMIN_MAIL_TO` are set to `info@harvestgreenmontessori.com`. If the Microsoft 365 mailbox itself has a problem (full, disabled, rule-based auto-deletion, forwarding misconfiguration, or litigation hold), emails sent to it may arrive at Microsoft's servers but never appear in the inbox.

---

## Summary Table

| # | Environment | Cause | Severity | Status |
|---|---|---|---|---|
| 1 | Live | GoDaddy blocks outbound port 25 | **Critical** | ✅ Fixed (changed host) |
| 2 | Live | No SMTP username/password | **Critical** | ✅ Fixed |
| 3 | Live | No TLS encryption, relay sends plain text | High | ✅ Fixed |
| 4 | Both | From/To same address; not authenticated via Microsoft — looks like spoofing | High | ⚠️ Pending |
| 5 | Both | Microsoft 365 SMTP AUTH disabled at mailbox level | **Critical** | ⚠️ Verify |
| 6 | Both | SMTP AUTH disabled at tenant level | **Critical** | ⚠️ Verify |
| 7 | Both | MFA enforced, blocks Basic Auth SMTP | **Critical** | ⚠️ Verify |
| 8 | Both | Password expired or changed | High | ⚠️ Verify |
| 9 | Local (Win) | Outdated `cacert.pem` — SSL handshake failure | Medium | ⚠️ Pending |
| 10 | Both | Emails landing in Junk/Spam folder | High | ⚠️ Pending |
| 11 | Both | SPF record missing or incomplete | High | ⚠️ Pending |
| 12 | Both | DKIM not configured | Medium | ⚠️ Pending |
| 13 | Both | DMARC policy absent | Medium | ⚠️ Pending |
| 14 | Live | `APP_DEBUG=false` hides all SMTP errors silently | High | ⚠️ Pending |
| 15 | Both | Mailbox-level issue (full, disabled, rules) | Medium | ⚠️ Pending |
| **16** | **Live** | **GoDaddy blocks outbound port 587 — TCP connection times out** | **🔴 Critical** | **❌ Unresolved** |

---

## SMTP Test Results

### Test 1 — Local Server (Windows)

**Test run:** April 21, 2026 at 11:08:09  
**Endpoint:** `http://harvest.com/schedule_a_tour/test_mail`  
**Result: ✅ Email successfully sent**

| Check | Result |
|---|---|
| Environment | `local` (env.local) |
| PHP version | 7.4.5RC1 (WINNT) |
| OpenSSL | 1.1.1e (17 Mar 2020) |
| `cacert.pem` | ✅ Found — 226,168 bytes |
| Email class | `MY_Email` (custom Windows SMTP override) |
| `fsockopen()` | ✅ Available |
| `stream_socket_client()` | ✅ Available |
| SMTP host | `smtp.office365.com` |
| Port 587 | ✅ OPEN |
| Encryption | `tls` (STARTTLS) |
| Auth user | `info@harvestgreenmontessori.com` |
| Auth pass | Set (15 chars) |
| Test send → `info@harvestgreenmontessori.com` | ✅ **SENT** (accepted by Microsoft 365) |

> **Note:** "SENT" means Microsoft 365's SMTP gateway accepted the message. Check inbox and Junk folder for `info@harvestgreenmontessori.com`.

---

### Test 2 — Live Server (GoDaddy / Linux) — SMTP port 587 attempt

**Test run:** April 21, 2026 at 11:16:06  
**Endpoint:** `https://harvestgreenmontessori.com/schedule_a_tour/test_mail`  
**Result: ❌ FAILED — Port 587 blocked by GoDaddy firewall**

| Check | Result |
|---|---|
| Environment | `live` (env.live) |
| PHP version | 8.1.34 (Linux) |
| OpenSSL | 1.1.1w (11 Sep 2023) |
| `cacert.pem` | ✅ Found — 226,168 bytes |
| Email class | `MY_Email` (Linux uses native CI SMTP path) |
| `fsockopen()` | ✅ Available |
| `stream_socket_client()` | ✅ Available |
| SMTP host | `smtp.office365.com` |
| Port 587 | ❌ **BLOCKED — Connection timed out (errno 110)** |
| Encryption | `tls` (STARTTLS) |
| Auth user | `info@harvestgreenmontessori.com` |
| Auth pass | Set (15 chars) |
| Test send → `info@harvestgreenmontessori.com` | ❌ **FAILED** — `110 Connection timed out` |

**Root cause confirmed:** GoDaddy's shared hosting firewall blocks all outbound TCP connections on port 587. Changing credentials or encryption will not fix this.

---

### Test 3 — Live Server (GoDaddy / Linux) — PHP `mail()` method ✅

**Test run:** April 21, 2026 at 11:30:46  
**Protocol switched to:** `MAIL_PROTOCOL=mail` (PHP native `mail()` via GoDaddy sendmail)  
**Result: ✅ Both sends accepted by server — but `info@` not received in inbox**

| Check | Result |
|---|---|
| Environment | `live` (env.live) |
| PHP version | 8.1.34 (Linux) |
| Protocol | `mail` (PHP native) |
| Test send → `info@harvestgreenmontessori.com` | ✅ **SENT** (accepted by server) |
| Test send → `sachintawde548@gmail.com` | ✅ **SENT** (accepted by server) |
| Received at `sachintawde548@gmail.com` | ✅ **Yes — email arrived** |
| Received at `info@harvestgreenmontessori.com` | ❌ **No — not in inbox** |

**New root cause confirmed:** The sending pipeline is working. GoDaddy's `mail()` successfully hands messages to its outbound mail server. The Gmail address received the email. The `info@harvestgreenmontessori.com` Microsoft 365 mailbox is **not receiving it** — the email is being silently filtered, rejected, or quarantined by Microsoft 365 on the receiving end.

---

## Fix Applied

**April 21, 2026 — Step 1:** `env.live` updated from `localhost:25` to `smtp.office365.com:587` with TLS — issues #1, #2, #3 resolved but port 587 was blocked by GoDaddy.

**April 21, 2026 — Step 2:** Switched to `MAIL_PROTOCOL=mail` (PHP native `mail()`). Live test confirmed emails are now successfully sent and received on Gmail. The `info@harvestgreenmontessori.com` Microsoft 365 mailbox is the remaining problem — it is silently filtering/blocking the incoming messages.

Current `env.live` mail config:
```dotenv
MAIL_PROTOCOL=mail
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=info@harvestgreenmontessori.com
ADMIN_MAIL_TO=info@harvestgreenmontessori.com
```

---

## Remaining Action Items

### 🔴 Priority 1 — Fix Microsoft 365 Inbox Delivery (Active Issue)

Sending works. The email is being blocked or filtered by Microsoft 365 before it reaches the inbox. Work through these steps in order:

**Step 1 — Check Junk / Spam folder immediately**  
Log in to `info@harvestgreenmontessori.com` (Outlook Web App or Outlook desktop) and check the **Junk Email** folder. If the test emails are there, the problem is spam classification — proceed to Step 2.

**Step 2 — Check Microsoft 365 Quarantine**  
If not in Junk, check the quarantine: Microsoft 365 Defender portal → **Review → Quarantine**. Search for messages from `info@harvestgreenmontessori.com`. If found, release them and whitelist the sender.

**Step 3 — Check SPF record**  
GoDaddy's `mail()` sends from GoDaddy's outbound mail server IP. If GoDaddy's IP is not in the SPF record for `harvestgreenmontessori.com`, Microsoft 365 will treat incoming messages as spoofed and either spam-folder or reject them.

Check current SPF:
```
nslookup -type=TXT harvestgreenmontessori.com
```
The SPF record must include GoDaddy's mail servers. A typical GoDaddy SPF entry:
```
v=spf1 include:secureserver.net include:spf.protection.outlook.com ~all
```

**Step 4 — Enable DKIM in Microsoft 365**  
Microsoft 365 Admin Center → Security → Email Authentication → DKIM → enable for `harvestgreenmontessori.com`.

**Step 5 — Add DMARC DNS record**  
Add a TXT record at `_dmarc.harvestgreenmontessori.com`:
```
v=DMARC1; p=none; rua=mailto:info@harvestgreenmontessori.com
```

**Step 6 — Check Microsoft 365 mail flow rules**  
Exchange Admin Center → Mail flow → Rules. Verify no rule is deleting or redirecting incoming messages to `info@harvestgreenmontessori.com`.

**Step 7 — Check inbox rules in Outlook**  
Log into Outlook Web App → Settings → View all Outlook settings → Mail → Rules. Delete any rules that move or delete incoming messages.

---

### ✅ Resolved Issues

| # | Cause | Fix |
|---|---|---|
| 1 | GoDaddy blocks port 25 | Changed MAIL_HOST away from localhost |
| 2 | No SMTP credentials on live | Added credentials |
| 3 | No TLS on live | Added MAIL_ENCRYPTION=tls |
| 16 | GoDaddy blocks port 587 | Switched to MAIL_PROTOCOL=mail |
