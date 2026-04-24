<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Microsoft Graph API Configuration
|--------------------------------------------------------------------------
| Credentials are read exclusively from environment variables.
| Never hardcode secrets here — this file is safe to commit.
|
| Required Azure AD App Registration settings:
|   - Grant: Mail.Send (Application permission, not delegated)
|   - Admin consent: required
|--------------------------------------------------------------------------
*/

$config['client_id']     = env('MS_GRAPH_CLIENT_ID',     '');
$config['client_secret'] = env('MS_GRAPH_CLIENT_SECRET', '');
$config['tenant_id']     = env('MS_GRAPH_TENANT_ID',     '');
$config['scope']         = 'https://graph.microsoft.com/.default';
$config['auth_url']      = 'https://login.microsoftonline.com/' . env('MS_GRAPH_TENANT_ID', 'common') . '/oauth2/v2.0/token';
$config['graph_api_url'] = 'https://graph.microsoft.com/v1.0';
