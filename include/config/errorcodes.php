<?php
//Database errors
define('DB-001', 'Connection to database could not be made. ');
define('DB-002', 'Database name does not seem to exist. ');
define('DB-003', 'Database request returned an empty result. ');
//API (nucleus) server errors
define('NU-001', 'The University server appears to be down. ');
define('NU-002', 'The Univeristy server is currently unable to complete this action. ');
define('NU-003', 'You are already logged in. ');
define('NU-004', 'Your session has expired, you will need to login with the University server again. ');
define('NU-005', 'The server was unable to authorize your session. Please try again. ');
//HTTP errors
define('HTTP403', 'The server could not authorize that action. Be sure to grant permission for this site to use youre data. ');
define('HTTP404', 'The page could not be found. Please try again later. ');
//Site only errors
define('LNCD001', 'You must be logged in to view that page');
?>