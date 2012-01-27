<?php

class User
{
	public $loggedIn;
	public $userID;
	public $userName;
	public $courseID;
	public $courseName;
	public $accessToken;
	private $dblink;
	
	public function __construct()
	{
		$this->dblink = new Database();
		
		if (isset($_SESSION['user']))
		{
			$this->loggedIn = true;
			$this->userID = $_SESSION['user']['userid'];
			$this->userName = $_SESSION['user']['userName'];
			$this->courseID = $_SESSION['user']['courseID'];
			$this->courseName = $_SESSION['user']['courseName'];
			$this->accessToken = $_SESSION['user']['accesstoken'];
		}
		else
			$this->loggedIn = false;
	}
	public function login($code)
	{
		//Take input from oAuth and log user in to this system
		$url = API_AUTH_ROOT;
		$fields = array(
						'grant_type'=>urlencode('authorization_code'), 
						'client_id'=>urlencode(API_CLIENT_ID), 
						'client_secret'=>urlencode(API_CLIENT_SECRET), 
						'redirect_uri'=>urlencode(API_REDIRECT_URI), 
						'code'=>urlencode($code)
						);
		$authresponse = Fetch($url, true, $fields);
		
		$auth = json_decode($authresponse);
		
		if ($auth->error)
		{
			throw new Exception("NU-005");
		}
		else
		{
			$accesstoken = $auth->access_token;
			$userdetailsuri = API_ROOT.GET_SINGLE_USER.$accesstoken;
			try
			{
				$success = false;
				$loopcount = 0;
				while (!$sucess)
				{
					$userdatajson = Fetch($userdetailsuri);
					$userdata = json_decode($userdatajson);
					$loopcount++;
					
					if ($userdata->error == null)
					{
						$success = true;
						break;
					}
					elseif ($loopcount >= 5)
					{
						throw new Exception("NU-002");
						break;
						exit;
					}
				}
			}
			catch(Exception $e)
			{
				throw $e;
			}
			
			$this->userID = $userdata->results[0]->id;
			$this->userName = $userdata->results[0]->name;
			$this->courseID = $userdata->results[0]->course->id;
			$this->courseName = $userdata->results[0]->course->title;
			$this->accessToken = $accesstoken;
			$this->loggedIn = true;
			$userdetails = array(
								 'userid'=> $this->userID, 
								 'userName'=> $this->userName, 
								 'courseID'=> $this->courseID, 
								 'courseName'=> $this->courseName, 
								 'accesstoken'=> $this->accessToken
								 );
			$_SESSION['user'] = $userdetails;
			
			//Database bit
			//Check user exists
			$checksql = "SELECT userID 
						 FROM uni_user 
						 WHERE userID = ".$this->userID.";";
			$this->dblink->query($checksql);
			$number = $this->dblink->countRows();
			//If not there add user in
			if ($number == 0)
			{
				$addsql = "INSERT INTO uni_user (userID, userName, userCourseID, userCourseName) 
						   VALUES (".$this->userID.", '".$this->userName."', '".$this->courseID."', '".$this->courseName."');";
				$this->dblink->query($addsql);
				//Push forward to first time login page for facebook login etc.
			}
			
			//REMOVE THIS - TEST ONLY
			$_SESSION['accesstoken'][] = $this->accessToken;
		}
	}
	public function logout()
	{
		$this->loggedIn = false;
		unset($_SESSION['user']);
	}
	public function GetPrintBalance()
	{
		echo $url = API_ROOT.GET_PRINT_BALANCE.$_SESSION['user']['accesstoken']."&user_id=".$_SESSION['user']['userid'];
		return Fetch($url);
	}
}
?>