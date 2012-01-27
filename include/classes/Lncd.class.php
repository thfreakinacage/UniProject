<?php
require('User.class.php');
require('Event.class.php');
require('Calendar.class.php');
 
class Lncd
{
	public $user;
	public $event;
	public $calendar;
	
	public function __construct()
	{
		$this->user = new User();
		$this->event = new Event();
		$this->calendar = new Calendar();
	}
	
	public function Secure()
	{
		if (!$this->user->loggedIn)
		{
			header('Location: index.php?error=LNCD001');
			exit();
		}
	}
}
?>