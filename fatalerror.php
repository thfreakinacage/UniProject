<?php
require_once('include/config/errorcodes.php');
$msgcode=$_GET['msgcode'];
$msg = constant($msgcode);
$return = $_GET['redirect'];

//Choose redirect path
switch ($return) {
	case 'home':
		$returnpath = "index.php";
		$return = "Home";
		break;
		
	case 'mydetails':
		$returnpath = "mydetails.php";
		$return = "My Details";
		break;
	
	default:
		$returnpath = "index.php";
		$return = "Home";
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>A fatal error has occured</title>
<link rel="stylesheet" type="text/css" href="style/fatalerror.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

var targetURL="<?php echo $returnpath; ?>"; 
//change the second to start counting down from 
var countdownfrom=5;
var currentsecond=countdownfrom;
$('.time').html(currentsecond);
	
$(document).ready(function(){
	//counter();
	
	setInterval(function() {
    	if (currentsecond > 0)
    	{
    		currentsecond -= 1;
    		$('.time').html(currentsecond);
    	}
    	else
    	{
    		window.location.replace(targetURL);
    	}
	}, 1000);
});

function counter()
{
	//currentsecond-=1;
	//$('.time').html(currentsecond);
	//setTimeout(counter(), 1000);
}
</script>
</head>
<body>

<div id="outer">
	<div id="inner">
		<div id="content">
			<div id="img"><img src="imgs/generic/fatalerror.png" /></div>
			<div id="message">
				<br /><br /><br />
				<span class="title">Oops! Error.</span><br />
				An error has occured with the message:<br />
				<div class="msg"><?php echo trim($msg, " "); ?></div>
				You will be returned to "<?php echo $return; ?>" in <span class="time">5</span> seconds.<br />
				Or <a href="<?php echo $returnpath; ?>">click here</a> to go now.
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

</body>
</html>
