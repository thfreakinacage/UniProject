<?php
require_once('include/Lncd.start.php');
$lncd = new Lncd();

switch ($_GET['load']) 
{
	case 'loadcals':
		$json = $lncd->calendar->GetAllUserCalendars();
		$decoded = json_decode($json);
		$newjson = json_encode($decoded);
		printr($newjson);
		break;
	
	case 'loadagenda':
		try
		{
			$newjson = $lncd->event->UserAgenda();
			printr($newjson);
		}
		catch (Exception $e)
		{
			if ($e->getMessage() == "HTTP404")
				header('location: fatalerror.php?redirect=home&msgcode=NU-001');
		}
		break;
	
	case 'printbalance':
		printr($lncd->user->GetPrintBalance());
		break;
	
	case 'clearsession':
		unset($_SESSION['accesstoken']);
		unset($_SESSION['code']);
		break;
	
	case 'createcal':
		$calname = "calendar".rand(1000, 10000);
		$cal = $lncd->calendar->CreateCalendar($calname, $lncd->user->accessToken);
		printr($cal);
		break;
	
	default:
		break;
}
?>
