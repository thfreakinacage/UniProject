<?php
require_once('../include/functions/checknucleusstatus.php');
$status = checkHTTPstatus('https://sso.lincoln.ac.uk/ping');
//$status = checkHTTPstatus('http://www.google.com/');
//$status = checkHTTPstatus('http://www.thisisnotarealsite.com/');
echo $status;
?>