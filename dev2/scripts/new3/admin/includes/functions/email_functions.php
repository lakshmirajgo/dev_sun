<?php
	//Get ALL Emails
	function get_all_emails(){
		global $db;
			$get_all_emails_sql = "SELECT * FROM email_templates ORDER BY id ASC";
			if(!$result = $db->select($get_all_emails_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_emails[] = $data;
				return $all_emails;
			}
	}
	
	// Get current Email
	function get_emails_view($id){
		global $db;
			$get_emails_view_sql = "SELECT * FROM email_templates where id='$id'";
			if(!$result = $db->select($get_emails_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Email Template
	function edit_emails($id){
	global $db;
		$edit_emails_sql = "UPDATE email_templates SET status_id='".$_POST['status_id']."', email_name='".$_POST['email_name']."', email_title='".$_POST['email_title']."', email_content='".$_POST['email_content']."', email_content2='".$_POST['email_content2']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_emails_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Email Template
	function add_emails(){
	global $db; 
		$add_emails_sql = "INSERT INTO email_templates  (status_id, email_name, email_title, email_content, email_content2) values('".$_POST['status_id']."', '".$_POST['email_name']."', '".$_POST['email_title']."', '".$_POST['email_content']."', '".$_POST['email_content2']."')";
		if(!$result = $db->insert_sql($add_emails_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Emails
	function delete_emails($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_emails_sql = "Delete from email_templates where id='".$id[$count]."'";
			if(!$db->select($delete_emails_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Single Email Template
	function delete_email($id){
	global $db;
	$delete_email_sql = "Delete from email_templates where id='$id'";
		if(!$db->select($delete_email_sql)){
		//$_SESSION['notice'] = "Database Error. Please try again";
		exit;
		}
			
		return true;
	}
?>