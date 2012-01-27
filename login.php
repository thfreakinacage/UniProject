<?php
require_once('include/Lncd.start.php');
$lncd = new Lncd();

//THIS IS TO FORWARD REQUESTS MADE TO NEW VERSION ONLY
if ($_GET['state'] != "null" && $_GET['action'] != "logout")
{
	$url = 'http://lncd.martinwebdev.co.uk/login.php?code='.$_GET['code'].'&state='.$_GET['state'];
	header('location: '.$url);
	exit();
}

if (isset($_GET['code']))
{
	//Get auth
	$code = $_GET['code'];
	$_SESSION['code'][] = $code;
	try
	{
		$lncd->user->login($code);
		header('location: index.php');
	}
	catch (Exception $e)
	{
		if ($e->getMessage() == "HTTP404")
			header('location: fatalerror.php?redirect=home&msgcode=NU-001');
		else
			header('location: fatalerror.php?redirect=home&msgcode='.$e->getMessage());
	}
}
elseif ($_GET['error'])
{
	$errormsg = $_GET['error_message'];
	echo $errormsg;
}
elseif ($_GET['action'] == 'logout')
{
	$lncd->user->logout();
	header('location: index.php');
	exit();
}
else
{
	header('location: index.php');
	exit();
}
?>