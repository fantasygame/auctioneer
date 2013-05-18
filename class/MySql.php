<?php

/**
 * Description of MySql
 *
 * @author kuba
 */
class MySql extends mysqli
{
	private $dbhost = 'localhost';
	private $dbuser = 'user';
	private $dbpassword = 'password';
	private $lastQuery;

	public function __construct($host = null, $user = null, $password = null, $database = null)
	{
		if (!($host == null || $user == null || $password == null)) {
			if ($database != null) {
				$this->connect($host, $user, $password, $database);
			} else {
				$this->connect($host, $user, $password);
			}
		} else {
			$this->connect($this->dbhost, $this->dbuser, $this->dbpassword);
		}
		$this->query('SET character_set_connection=utf8');
		$this->query('SET character_set_client=utf8');
		$this->query('SET character_set_results=utf8');
	}

	public function select($query, $mode = 'assoc')
	{
		$results = array();
		$result = $this->query($query);
		if ($mode == 'assoc') {
			while ($r = $result->fetch_assoc()) {
				$results[] = $r;
			}
		} else {
			while ($r = $result->fetch_array()) {
				$results[] = $r;
			}
		}
		return $results;
	}

	public function selectSimpleAssocs($table, $columns = array(), $constrains = '')
	{
		$results = array();

		$columnsString = '';
		if (empty($columns)) {
			$columnsString = '*';
		} else {
			$count = count($columns);
			for ($i = 0; $i < $count - 1; $i++) {
				$columnsString .= "`{$columns[$i]}`, ";
			}
			$columnsString .= "`{$columns[$count - 1]}`";
		}
		$result = $this->query("SELECT $columnsString FROM `$table` WHERE $constrains");
		while ($r = $result->fetch_assoc()) {
			$results[] = $r;
		}

		return $results;
	}

	public function query($query, $resultmode = MYSQLI_STORE_RESULT)
	{
		$this->lastQuery = $query;

		$result = parent::query($query, $resultmode);
		if (!$result) {
			throw new Exception("<p>SQL Error:<br/>{$this->error}</p><p>Query:<br />$query</p>", 1);
		}
		return $result;
	}

}

?>
