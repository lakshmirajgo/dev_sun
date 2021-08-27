<?php
	function get_all_testimonials()
	{
		global $db;
		$sql="SELECT * FROM mod_testimonials WHERE status='1' ORDER BY date_submitted DESC, id ASC";
		if(!$result=$db->select($sql)){return false;}
		while($row=$db->get_row($result))
		{$testimony[]=$row;}
		return $testimony;
	}
	
	function add_testimony($data)
	{
		global $db;
		$data['date_submitted']=date('Y-m-d');
		$data['status']='0';
		$query='INSERT INTO mod_testimonials SET ';
		foreach($data as $key=>$val)
		{
			$query.=$key."='".mysql_real_escape_string($val)."',";
		}
		$query=substr_replace($query,'',-1,1);
		if(!$result=$db->insert_sql($query)){return false;}
		return $result;
	}
	
	function activate_testimonial($id)
	{
		global $db;
		$sql="UPDATE mod_testimonials SET status='1' WHERE id='".mysql_real_escape_string($id)."'";
		if(!$db->update_sql($sql)){return false;}
		return true;
	}	
?>