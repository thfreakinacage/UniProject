<?php
class Database
{
	private $dblink;
	public $result;
	
	public function __construct()
	{
		$this->dblink = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		mysql_select_db(DB_NAME, $this->dblink);
	}
	public function query($qs)
	{
		$this->result = mysql_query($qs, $this->dblink);
	}
	public function getResult()
	{
		mysql_data_seek($this->result, 0);
		$returnval = array();
		while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC))
		{
			$returnval[] = $row;
		}
		return $returnval;
	}
	public function getObject()
	{
		mysql_data_seek($this->result, 0);
		$returnval = array();
		while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC))
		{
			$returnval[] = (object)$row;
		}
		return $returnval;
	}
	public function countRows()
	{
		return mysql_num_rows($this->result);
	}
}
?>