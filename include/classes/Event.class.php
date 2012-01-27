<?php

class Event
{
	
	public function __construct()
	{
		
	}
	public function UserAgenda()
	{
		try
		{
			echo $url = API_ROOT.GET_USER_AGENDA.$_SESSION['user']['accesstoken'];
			return Fetch($url);
		}
		catch (Exception $e)
		{
			throw $e;
		}
	}
}
?>