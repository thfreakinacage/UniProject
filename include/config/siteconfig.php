<?php
require_once('errorcodes.php');
//Site Config
define('SITE_URI', 'http://lincoln.martinwebdev.co.uk');
//DB config
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');
//API config
define('API_CLIENT_ID', '');
define('API_CLIENT_SECRET', '');
define('API_REDIRECT_URI', '');
define('API_ROOT', 'https://nucleus-proxy.online.lincoln.ac.uk');
define('API_LOGIN_ROOT', 'https://sso.lincoln.ac.uk/oauth');
define('API_LOGOUT_STRING', 'https://sso.lincoln.ac.uk/sign_out?redirect_uri='.
	   urlencode('http://lincoln.martinwebdev.co.uk/login.php?action=logout'));
define('API_SCOPE_QS', 'user.basic,user.courses,user.calendars,user.events.public,user.events.private,user.print.balance');
define('API_LOGIN_QS', '?client_id='.API_CLIENT_ID.'&redirect_uri='.urlencode(API_REDIRECT_URI).'&response_type=code&scope='.API_SCOPE_QS);
define('API_LOGIN_TOKEN_QS', '&state=null');
define('API_AUTH_ROOT', 'https://sso.lincoln.ac.uk/oauth/access_token');
define('GET_SINGLE_USER', '/v1/people/user.json?access_token=');
define('GET_USER_CALENDAR', '/v1/calendars/user?access_token=');
define('CREATE_CALENDAR', '/v1/calendars/create?');
define('GET_SINGLE_CALENDAR', '/v1/calendars/id/');
define('GET_USER_AGENDA', '/v1/events/agenda?access_token=');
define('CREATE_EVENT', '/v1/events/create');
define('UPDATE_EVENT', '/v1/events/'); 
define('DELETE_EVENT', '/v1/events/'); 
define('GET_PRINT_BALANCE', '/v1/printing/user?access_token=');
//Facebook Config
define('FB_URI', 'http://www.facebook.com');
define('FB_APP_ID', '');
define('FB_APP_SECRET', '');
define('FB_APP_DISPLAY_NAME', '');
define('FB_APP_NAMESPACE', '');
?>