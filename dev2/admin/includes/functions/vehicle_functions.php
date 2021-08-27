<?php
	//Get ALL Vehicles
	function get_all_vehicles(){
		global $db;
			$get_all_vehicles_sql = "SELECT * FROM vehicles ORDER BY id ASC";
			if(!$result = $db->select($get_all_vehicles_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_vehicles[] = $data;
				return $all_vehicles;
			}
	}
	
	// Get current Vehicles
	function get_vehicles_view($id){
		global $db;
			$get_vehicles_view_sql = "SELECT * FROM vehicles where id='$id'";
			if(!$result = $db->select($get_vehicles_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Vehicle
	function edit_vehicles($id){
	global $db;
    
    //sanitize post data
        foreach($_POST as $key => $data)
        {
            $_POST[$key] = mysql_real_escape_string($data);
        }
    
		$edit_vehicles_sql = "UPDATE vehicles SET name='".$_POST['name']."', description='".$_POST['description']."', passengers='".$_POST['passengers']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_vehicles_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Vehicle
	function add_vehicles(){
	global $db; 
    
    //sanitize post data
        foreach($_POST as $key => $data)
        {
            $_POST[$key] = mysql_real_escape_string($data);
        }
    
		$add_vehicles_sql = "INSERT INTO vehicles (name, description, passengers) values('".$_POST['name']."', '".$_POST['description']."', '".$_POST['passengers']."')";
		if(!$result = $db->insert_sql($add_vehicles_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Vehicles
	function delete_vehicles($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_vehicles_sql = "Delete from vehicles where id='".$id[$count]."'";
			if(!$db->select($delete_vehicles_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Single Vehicle
	function delete_vehicle($id){
	global $db;
	$delete_vehicles_sql = "Delete from vehicles where id='$id'";
		if(!$db->select($delete_vehicles_sql)){
		//$_SESSION['notice'] = "Database Error. Please try again";
		exit;
		}
			
		return true;
	}
	
	// Upload image function
	function add_vehicle_image($vehicle_name, $id){
	
	global $db;
	// Create a filename
	if (empty($id)) {
			$vehicle_name = get_last_vehicle();
			$new_pic_name = $vehicle_name['name'];
			$id = $vehicle_name['id'];
			$new_vehicle_name = $vehicle_name['name'];
	} else {
	$new_pic_name = $vehicle_name;
	$id = $id;
	$new_vehicle_name = $vehicle_name;
	};	
	
			$extension = explode ('.', $_FILES['upload']['name']);
			//$filenames .= $new_pic_name."_".$rand_num;
			$new_pic_name = str_replace(" ", "_", $new_pic_name);
			$ext=rand(1, 100);
			$filename = $new_pic_name."_".$ext.".".$extension[1];  //set the  new file name
			
			//print_r($filename);
			//exit;
			
			if (copy($_FILES['upload']['tmp_name'], "../media/images/thumbs/$filename")) {
			
			$dir='../media/images/thumbs/';
			$picture =$dir.$filename;
			$max=170;# maximum size of 1 side of the picture.

			$src_img=imagecreatefromjpeg($picture);
			$oh=imagesy($src_img);# original height
			$ow=imagesx($src_img);# original width
			$new_h=$oh;
			$new_w=$ow;
			if($oh>$max||$ow>$max){
			$r=$oh/$ow;
			$new_h=($oh>$ow)?$max:$max*$r;
			$new_w=$new_h/$r;
			}
			// note TrueColor does 256 and not.. 8
			$dst_img=imagecreatetruecolor($new_w,$new_h);

			imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,ImageSX($src_img),ImageSY($src_img));
			imagejpeg($dst_img,"$picture");
										
			};

			if (move_uploaded_file($_FILES['upload']['tmp_name'], "../media/images/$filename")) {
			echo '<script language="javascript">alert(\'The file has been successfully uploaded!\');</script>';
			$QUERY = "UPDATE vehicles SET vehicle_image='".$filename."' where id='$id'";

			$result= @mysql_query ($QUERY);
			} else {
			echo '<script language="javascript">alert(\'The file could not be moved. The size of your picture is more then 1Mb.\');</script>';

			}
	}
	
	// Get Last Vehicle
	function get_last_vehicle(){
		global $db;
			$get_last_vehicle_sql = "SELECT id, name FROM vehicles ORDER BY id DESC LIMIT 1";
			if(!$result = $db->select($get_last_vehicle_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Delete Images
	function delete_images($id, $image_name){
	global $db;
	$count =0;
		while($count < count($id)){
		$tmpfile = "../media/images/thumbs/".$image_name."";
		unlink($tmpfile); 
		$tmpfile2 = "../media/images/".$image_name."";
		unlink($tmpfile2); 
			$delete_images_sql = "UPDATE vehicles SET vehicle_image='' where id='$id[$count]'";
			if(!$db->select($delete_images_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
			$count++;
		}
			
		return true;
	}
?>