<?php

class Calendar
{
	
	public function __construct()
	{
		
	}
	public function GetAllUserCalendars()
	{
		$url = API_ROOT.GET_USER_CALENDAR.$_SESSION['user']['accesstoken'];
		return Fetch($url);
	}
	public function CreateCalendar($calendarName, $accesstoken)
	{
		$url = API_ROOT.CREATE_CALENDAR.'access_token='.$accesstoken.'&name='.$calendarName;
		return Fetch($url);
	}
}

?>