<?php

class Error
{
	public static function LogError($eMsg, $data)
	{
		$db = new Database();
		
		$db->query("INSERT INTO error_log (eMsg, data) VALUES('".$eMsg."', '".$data."')");
	}
}

?>