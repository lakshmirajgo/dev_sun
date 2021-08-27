<?php
	//Get ALL Testimonials
	function get_all_testimonials(){
		global $db;
		if(!empty($_POST))
		{
			if(!empty($_POST['from_date']) && !empty($_POST['to_date']))
			{$where_sql=" WHERE date_submitted>= '".date('Y-m-d',strtotime($_POST['from_date']))."' AND date_submitted<='".date('Y-m-d',strtotime($_POST['to_date']))."' ";}
		}
		if (empty($_GET['orderby'])) {
			$orderby_sql = " name ASC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " name ASC";
					} else {
					$orderby_sql = " name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " date_submitted ASC";
					} else {
					$orderby_sql = " date_submitted DESC";
					}
				}
			}
			
			$get_all_testimonials_sql = "SELECT * FROM mod_testimonials $where_sql ORDER BY $orderby_sql";
			
//			print_r($get_all_testimonials_sql);
//			exit;
			if(!$result = $db->select($get_all_testimonials_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_testimonials[] = $data;
					return $all_testimonials;
			}
	}
	
	function get_all_testimonials_with_pages($start,$display)
	{
		$data=get_all_testimonials();
		if(sizeof($data)<=$display)
		{return $data;}
		else
		{
			for($x=$start;$x<$start+$display;$x++)
			{
				if(isset($data[$x])){
					$display_rows[]=$data[$x];
				}
			}
			return $display_rows;
		}
	}
	// Get current Testimony
	function get_testimonials_view($id){
		global $db;
			$get_testimonials_view_sql = "SELECT * FROM mod_testimonials where id='$id'";
			if(!$result = $db->select($get_testimonials_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Testimonials
	function edit_testimonials($id){
    
    //sanitize post data
    foreach($_POST as $key => $data)
    {
        $_POST[$key] = mysql_real_escape_string($data);
    }
    
	global $db;
	
		$edit_testimonials_sql = "UPDATE mod_testimonials SET name='".$_POST['name']."', company='".$_POST['company']."', position='".$_POST['position']."', city='".$_POST['city']."', state='".$_POST['state']."', status='".$_POST['status']."', testimonial='".$_POST['testimonial']."', service_rating='".$_POST['service_rating']."', date_submitted='".mysql_real_escape_string(date('Y-m-d',strtotime($_POST['date_submitted'])))."' where id='$id'";
		if(!$result = $db->insert_sql($edit_testimonials_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Testimony
	function add_testimonials(){
    //sanitize post data
    foreach($_POST as $key => $data)
    {
        $_POST[$key] = mysql_real_escape_string($data);
    }
	global $db; 
		
	$date_submitted = date('Y-m-d');	
	if (empty($_POST['status'])) {
	$status = '0'; //Default value Inactive = 0	
	} else {
	$status = $_POST['status'];
	}
		$add_testimonials_sql = "INSERT INTO mod_testimonials (name, company, position, city, state, date_submitted, status, testimonial, service_rating, date_submitted) values('".$_POST['name']."', '".$_POST['company']."', '".$_POST['position']."', '".$_POST['city']."', '".$_POST['state']."', '$date_submitted', '$status', '".$_POST['testimonial']."', '".$_POST['service_rating']."', '".mysql_real_escape_string(date('Y-m-d',strtotime($_POST['date_submitted'])))."')";
		
		//print_r($add_testimonials_sql);
		//exit;
		if(!$result = $db->insert_sql($add_testimonials_sql)){
			$_SESSION['notice'] = $db->last_error;
			echo $_SESSION['notice'];
			exit;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Testimony
	function delete_testimonials($id){
	global $db;
	$count =0;
		while($count < count($id)){
		
			$delete_testimonials_sql = "Delete from mod_testimonials where id='".$id[$count]."'";
			if(!$db->select($delete_testimonials_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	function add_testimony_new($data)
	{
		global $db;
		if($data['date_submitted']=='')
		{$data['date_submitted']=date('Y-m-d');}
		else
		{$data['date_submitted']=date('Y-m-d',strtotime($data['date_submitted']));}
		$data['status']='0';
		$query='INSERT INTO mod_testimonials SET ';
		foreach($data as $key=>$val)
		{
			$query.=$key."='".mysql_real_escape_string($val)."',";
		}
		$query=substr_replace($query,'',-1,1);
		if(!$result=$db->insert_sql($query)){return false;}
		return true;
	}
	
	function edit_testimony_new($data,$id)
	{
		global $db;
		$query='UPDATE mod_testimonials SET ';
		foreach($data as $key=>$val)
		{
			$query.=$key."='".mysql_real_escape_string($val)."',";
		}
		$query=substr_replace($query,'',-1,1);
		$query.=" WHERE id='".mysql_real_escape_string($id)."'"; 
		if(!$result=$db->insert_sql($query)){
			echo $db->print_last_error(true);
			return false;
		}
		return true;
	}
?>