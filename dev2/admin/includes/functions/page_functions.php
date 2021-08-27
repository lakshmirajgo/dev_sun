<?php
	//Get ALL Pages
	function get_all_pages(){
		global $db;
			$get_all_pages_sql = "SELECT * FROM pages ORDER BY page_title ASC";
			if(!$result = $db->select($get_all_pages_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_pages[] = $data;
				return $all_pages;
			}
	}
	
	// Get current page
	function get_pages_view($id){
		global $db;
			$get_pages_view_sql = "SELECT * FROM pages where id='$id'";
			if(!$result = $db->select($get_pages_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Page
	function edit_pages($id){
	global $db;
		$edit_pages_sql = "UPDATE pages SET page_name='".$_POST['page_name']."', page_title='".$_POST['page_title']."', meta_description='".$_POST['meta_description']."', meta_keywords='".$_POST['meta_keywords']."', page_content='".$_POST['page_content']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_pages_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Page
	function add_pages(){
	global $db; 
		$add_pages_sql = "INSERT INTO pages  (page_name, page_title, meta_description, meta_keywords, page_content) values('".$_POST['page_name']."', '".$_POST['page_title']."', '".$_POST['meta_description']."', '".$_POST['meta_keywords']."', '".$_POST['page_content']."')";
		if(!$result = $db->insert_sql($add_pages_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Pages
	function delete_pages($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_pages_sql = "Delete from pages  where id='".$id[$count]."'";
			if(!$db->select($delete_pages_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Single Page
	function delete_page($id){
	global $db;
	$delete_page_sql = "Delete from pages  where id='$id'";
		if(!$db->select($delete_page_sql)){
		//$_SESSION['notice'] = "Database Error. Please try again";
		exit;
		}
			
		return true;
	}
?>