<?php
	//Get ALL Pages
	function get_all_pages(){
		global $db;
			$get_all_pages_sql = "SELECT * FROM pages ORDER BY id ASC";
			if(!$result = $db->select($get_all_pages_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_pages[] = $data;
				return $all_pages;
			}
	}
	
	// Get current page
	function get_pages_view($page_name){
		global $db;
			$get_pages_view_sql = "SELECT * FROM pages where page_name='$page_name'";
			if(!$result = $db->select($get_pages_view_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
?>