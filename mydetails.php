<?php
require_once('include/Lncd.start.php');
$lncd = new Lncd();
$lncd->Secure();

if (!$lncd->user->loggedIn)
	$loginuri = API_LOGIN_ROOT.API_LOGIN_QS.API_LOGIN_TOKEN_QS;
else
	$loginuri = API_LOGOUT_STRING;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="sexybuttons/sexybuttons.css" />
<link rel="stylesheet" type="text/css" href="style/main.css" />
<link rel="stylesheet" type="text/css" href="style/dash.css" />
<link rel="stylesheet" type="text/css" href="style/impromtu.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-impromptu.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	//jQuery stuff here

	//Login button control
	$('a.logincontrol').click(function(event){
		event.preventDefault();
		$('a.logincontrol').html('<img src="imgs/generic/loading_small.gif" />Please wait...');
		function whenCheckHTTPComplete(loginStatus)
		{
			if (loginStatus == 200)
			{
				window.location.href = "<?php echo $loginuri; ?>";
			}
			else
			{
				$.prompt("Lincoln Uni's sign on server is offline. <br />Please reload this page and try again. ");
				$('a.logincontrol').html("The server is offline");
			}
		}
		//$('div.paper').load('content/checklogin.php');
		$.get('content/checklogin.php', whenCheckHTTPComplete);
	});
	
	$('a.void').click(function(event){event.preventDefault()});
	
	
	//Dropdown menu
	$('#nav li').hover(
		function () {
			//show its submenu
			$('ul', this).slideDown(100);
			$('img#navdd').attr('src', 'sexybuttons/images/icons/silk/section_expanded.png');
		}, 
		function () {
			//hide its submenu
			$('ul', this).slideUp(100);
			$('img#navdd').attr('src', 'sexybuttons/images/icons/silk/section_collapsed.png');			
		}
	);
});
</script>
<title>Lincoln Open Data Project</title>
</head>

<body>

<div id="wrapper">
	<div id="header">
    	<div class="inner">
			<img title="LNCD" alt="Main Logo" src="imgs/generic/lncd.png" style="height: 30%; width: 30%;" />
            <div id="login">
				<ul id="nav">
	            	<?php
					if ($lncd->user->loggedIn)
					{
						echo '<li><a href="#" class="void">
						<img id="navdd" src="sexybuttons/images/icons/silk/section_collapsed.png" /> My Dash</a>
						<ul>
							<li><a href="mydetails.php">My Details</a></li>
							<li><a href="mydetails.php?view=facebook">Facebook</a></li>
							<li><a href="#">Another Option</a></li>
						</ul>
						<div class="clear"></div>
					</li>
					<li>
						<a class="logincontrol" href="'.API_LOGOUT_STRING.'">
							<img id="navuser" src="sexybuttons/images/icons/silk/user.png" /> Logout
						</a>
					</li>
					<div class="clear"></div>';
					}
					else
					{
						echo '<li id="loginonly"><a class="logincontrol" href="#">
							<img id="navuser" src="sexybuttons/images/icons/silk/user.png" /> Login with your uni ID</a></li>
							<div class="clear"></div>';
					}
					?>
				</ul>
            </div>
        </div>
    </div>
    <div id="navigation">
    	<div class="inner">
			<ul id="navlist">
            	<li><span><a href="#" id="loadcals" class="void">All calendars</a></span></li>
                <li><span><a href="#" id="loadagenda" class="void">Load Agenda</a></span></li>
                <li><span><a href="#" id="printbalance" class="void">Print Balance</a></span></li>
                <li><span><a href="#" id="createcal" class="void">Create Calendar</a></span></li>
                <li><span><a href="#" id="clearsession" class="void">Clear Session</a></span></li>
            </ul>
        </div>
    </div>
    <div id="main">
    	<div class="inner">
			<div class="paper">
				<span class="pagetitle">My Details</span><br />
				These details are mostly based on what is stored on the University of Lincoln servers.<br />
				You should inform the University of any errors.<br />
				Items marked with * have been supplied by you.
				<dl>
					<dt>Name: </dt>
					<dd><?php echo $lncd->user->userName; ?></dd>
					<dt>Uni ID: </dt>
					<dd><?php echo $lncd->user->userID; ?></dd>
					<dt>Course: </dt>
					<dd><?php echo $lncd->user->courseName; ?></dd>
				</dl>
			</div>
        </div>
    </div>
    <div id="footer">
    	<div class="inner">
			
        </div>
    </div>
</div>

</body>
</html>
