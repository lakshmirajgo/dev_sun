<?php
/**-----------------------------------------------------------------------------
 *
 *	DATABASE SYSTEM CLASS
 *	August 2012
 *
 *------------------------------------------------------------------------------
 */

class Database {
	
	public $error;
	public $last_query;
	public $result;
	
	private $mysqli;
	
	public function __construct($config)
	{
		$this->connect($config);
	}
	
	public function connect($config) 
	{
		$this->mysqli = new mysqli($config['HOST'], $config['USERNAME'], $config['PASSWORD'], $config['DATABASE']);
		
		if ($this->mysqli->connect_errno)
		{
			$this->error = $this->mysqli->connect_error;
		}
	}
	
	public function query($sql)
	{
		$this->last_query = $sql;
		
		$this->result = $this->mysqli->query($sql);
		
		$this->error = $this->mysqli->error;
		
		return $this->result;
	}
	
	public function escape($str)
	{
		return $this->mysqli->real_escape_string($str);
	}
	
	/**
	 *	Sanitize an array of data
	 *	Recursively sanitize each member of the array
	 *	NOTE: data is referenced for speed
	 *	ref: http://stackoverflow.com/questions/1216552/php-pass-by-reference-in-recursive-function-not-working
	 */
	public function sanitize_array(&$data = array())
	{
		foreach ($data as $k => &$v)
		{
			if (is_string($v))
			{
				$data[$k] = $this->mysqli->real_escape_string($v);
			}
			elseif (is_array($v))
			{
				$data[$k] = $this->sanitize_array($v);
			}
		}
		// unset a referenced $value in foreach
		// ref: http://docs.php.net/manual/en/control-structures.foreach.php
		unset($v); 
		return $data;
	}
	
	public function insert()
	{
		$args = func_get_args();
		switch (func_num_args())
		{
			case 2:
					return $this->insert_with_data($args[0], $args[1]);
			case 1:
					$this->query($args[0]);
					return $this->mysqli->insert_id;
			default: 
					return false;
		}
	}
	
	private function insert_with_data($table, $data)
	{		
		$fields = '';
		$values = '';
		foreach ($data as $k => $v)
		{
			$fields .= "`$k`,";
			$values .= "'$v',";
		}
		$fields = rtrim($fields, ',');
		$values = rtrim($values, ',');
		
		$this->query("INSERT INTO `$table`($fields) VALUES($values)");
		
		return $this->mysqli->insert_id;
	}
	
	public function update($sql)
	{
		$args = func_get_args();
		switch (func_num_args())
		{
			case 3: 
					return $this->update_with_data($args[0], $args[1], $args[2]);
			case 2:
					return $this->update_with_data($args[0], $args[1]);
			case 1:
					$this->query($args[0]);
					return $this->mysqli->affected_rows;
			default:
					return false;
		}
	}
	
	private function update_with_data($table, $data, $where = NULL)
	{
		if ($where == NULL) return false;
		
		$set_str = '';
		foreach ($data as $k => $v)
		{
			$set_str .= "`" . $k . "`='" . $v ."', ";
		}
		$set_str = rtrim($set_str, ', ');
		
		$this->query("UPDATE `$table` SET $set_str WHERE $where");
		
		return $this->mysqli->affected_rows;
	}
	
	public function row_array()
	{
		$data = array();
		if ($this->result)
		{
			$data = $this->result->fetch_assoc();
		}
		return $data;
	}
	
	public function result_array()
	{
		$data = array();
		if ($this->result)
		{
			while ($row = $this->result->fetch_assoc())
			{
				$data[] = $row;
			}
		}
		return $data;
	}
	
	public function num_rows()
	{
		if ($this->result)
		{
			return $this->result->num_rows;
		}
		else
		{
			return false;
		}
	}
}