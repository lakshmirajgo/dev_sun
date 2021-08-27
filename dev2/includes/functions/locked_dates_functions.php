<?php
   
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
