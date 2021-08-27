<?php
	//Get ALL Locked dates
	function get_all_locked_dates(){
    
		global $db;
        
		$sql = "SELECT * FROM locked_dates ORDER BY id DESC";
            
		if(!$result = $db->select($sql))
        {
			return false;
		}
		else
        {
			while($data = $db->get_row($result, 'MYSQL_ASSOC'))
            {
				$dates[] = $data;
            }
            
			return $dates;
		}
            
	}
    
    function is_locked_date($date){
        
        global $db;
        
        /** convert date to time to see if the time falls between 12am and 5:59am, if it does we return true since we don't wanna book
         * any reservations if they do
         **/
        $time = (int)date('H', strtotime($date));
        
        if($time < 6 && $time >= 0)
        {
            return true;
        }  
        /**end of time check**/
        
        $date;
  
        $sql = "SELECT * FROM locked_dates WHERE from_date <= '$date' AND to_date >= '$date'";
        
        $result = $db->select($sql);

        $data = $db->get_row($result, 'MYSQL_ASSOC');
        
        if(!empty($data) && is_array($data))
        {
			return true;
		}
        else
        {
            return false;
        }
    }
    
    function add_locked_date($from = null, $to = null, $status = 1){
    
        if($from == null || $to == null) return false;
    
        global $db;
        
        $from = mysql_real_escape_string($from);
        $to = mysql_real_escape_string($to);
        
        
        $from = date('Y-m-d H:i:s', strtotime($from));
        $to = date('Y-m-d H:i:s', strtotime($to));
        
        
        
        $sql = "INSERT INTO locked_dates VALUES('', '$from', '$to', '$status')";
        
        $result = $db->insert_sql($sql);
               
        if(!$result)
        {
            die($db->last_error);
			return false;
		}
        else
        {
            return $result; //returns the inserted id
        }
    
    }
    
    function edit_locked_date($id = null, $from = null, $to = null, $status = 1){
    
        if($id == null || $from == null || $to == null) return false;
        
        $from = mysql_real_escape_string($from);
        $to = mysql_real_escape_string($to);
    
        global $db;
        
        $sql = "UPDATE locked_dates SET from_date = '$from', to_date = '$to', status = '$status' WHERE id = '$id'";
        
        $result = $db->insert_sql($sql);
               
        if(!$result)
        {
            die($db->last_error);
			return false;
		}
        else
        {
            return true; //returns true if updated successfully
        }
    
    }
    
    function delete_locked_date($id = null){
    
        if($id == null || empty($id)) return false;
    
        global $db;
        
        $sql = "DELETE FROM locked_dates WHERE id = '$id'";
        
        $result = $db->select($sql);
               
        if(!$result)
        {
            die($db->last_error);
			return false;
		}
        else
        {
            return true; //returns true if deleted successfully
        }
    
    }
