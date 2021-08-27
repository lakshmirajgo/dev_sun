<?php
session_start();

/**
if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}**/


date_default_timezone_set('America/New_York');

include("includes/functions/general_functions.php");
include("includes/functions/client_functions.php");
include("includes/functions/reservation_functions.php");	
include("includes/functions/locked_dates_functions.php");

//ajax check for available dates
if(isset($_POST) && !empty($_POST['check']))
{
    $date = $_POST['date'];

    //convert date
    $new_date = date('Y-m-d H:i:s', strtotime($date));
    
    echo is_locked_date($new_date);
    
    die();
} 



//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'clients')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
//echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
//exit(); 
}
//Check permissions for User END


include_once ("includes/common/header.php");	

?>

<div align="center">
	  <?php include_once ("includes/common/menu.php");	?>

    <div class="container">
    
    
    
    <?php
    
        if(isset($_GET['action']) && $_GET['action'] == 'delete')
        {
            if(delete_locked_date($_GET['id']))
            {
                echo '<p class="message">Date deleted successfully</p>';
            }
            else
            {
                echo '<p class="error">Error deleting date</p>';
            }
        }
        
        //process submitted form
        if(isset($_POST) && !empty($_POST['from']))
        {
            
            if(add_locked_date($_POST['from'], $_POST['to']))
            {
                echo '<p class="message">Date added successfully</p>';
            }
            else
            {
                echo '<p class="error">Error adding date</p>';
            }
    
        }  
        
           
    
    ?>
    
    
    
    
    
    
        <h2>Locked Dates Manager</h2>
        
        <div class="datetime-picker">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p>Add a new locked date below:</p>
                <p>From: <input type="text" name="from" class="datepicker"> To: <input type="text" name="to" class="datepicker"></p> 
                <p><input type="submit" value="Add Locked Date"/></p>
            </form>
        </div>
        
        <script>
            $(function() {
                $( ".datepicker" ).datetimepicker({
                	timeFormat: 'hh:mm tt'
                });
            });
        </script>
        
        <div class="locked-dates">
        <?php
        $dates = get_all_locked_dates();  
        
        if(!empty($dates))
        {
        ?>
        
            <table>
                <tbody>
                    <tr>
                        <th>Locked Dates</th>
                        <th>Action</th>
                    </tr>
                    
                    <?php
                                           
                        
                        foreach($dates as $date)
                        {
                        
                        $from = date('m/d/Y h:i:s A', strtotime($date['from_date']));
                        $to = date('m/d/Y h:i:s A', strtotime($date['to_date']));
                        
                        ?>
                            <tr>
                                <td><?php echo $from;?> - <?php echo $to;?></td>
                                <td align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&amp;id=<?php echo $date['id'];?>">Delete</a></td>
                            </tr>
                        <?php
                        }
                    ?>
                    
                    
                    
                </tbody>
            </table>
            <?php
            }
            ?>
        
        
            
            
        
        </div>
    
    </div>



    <?php
unset ($_SESSION['redirect']);
include_once ("includes/common/footer.php");
?>
