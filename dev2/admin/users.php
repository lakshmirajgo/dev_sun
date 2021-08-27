<?php
session_start();
error_reporting(E_ALL);

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}

	include("includes/functions/general_functions.php");
	include("includes/functions/user_functions.php");

//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'users')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END	
	
	include ("includes/common/header.php");	
	include ("includes/common/menu.php");	
	
	if(isset($_GET['delete'])){
		delete_user($_GET['delete']);
		header("Location: users.php");	
	}
	if($_GET['action']=="add"){
		add_user($_GET);
		header("Location: users.php");
	}
	
	if($_GET['action']=="edit"){
		edit_user($_GET);
		
		if (!empty($_GET['password'])) {
		edit_user_password($_GET); // Update password
		}
		
		echo '<script language="javascript">window.location=\'users.php?edit='.$_GET['username'].'\';</script>';
		exit;
	}
	// Show all clients
	$users = get_all_users();
?>

<p align="center">
  <? if(!empty($_SESSION['notice'])) echo $_SESSION['notice']; ?>
</p>
<p align="center" class="bodytxt"><strong>Current Users</a>
</strong>
<table width="383" border="1" align="center" cellpadding="3" cellspacing="0" class="bodytxt">
  <tr>
    <td width="276"><span style="font-weight: bold">Username</span></td>
    <td width="95"><span style="font-weight: bold">Action</span></td>
  </tr>
  <? foreach($users as $value){?>
  <tr>
    <td><a href="users.php?edit=<? echo $value['username']; ?>" class="bodytxt"><? echo $value['username']; ?></a></td>
    <td><a href="users.php?delete=<? echo $value['username']; ?>" class="bodytxt">Delete</a></td>
  </tr>
  <? } ?>
</table>
<?php if (empty($_GET['edit'])) { ?>
<p align="center" class="bodytxt"><strong>Add Users</strong> </p>
<form id="adduser" name="adduser" method="get" action="users.php">
  <table width="400" border="1" align="center" cellpadding="3" cellspacing="0" class="bodytxt">
    <tr>
      <td width="189"><span style="font-weight: bold">Username</span></td>
      <td width="148"><span style="font-weight: bold">Password</span></td>
    </tr>
    <tr>
      <td><input name="username" type="text" id="username" size="30" /></td>
      <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">
       <input name="clients" type="checkbox" value="1" />CLIENTS<br />
       <input name="reservations" type="checkbox" value="1" />RESERVATIONS<br />
       <input name="shades_of_green" type="checkbox" value="1" />SHADES OF GREEN RESERVATIONS<br />
       <input name="vehicle" type="checkbox" value="1" />VEHICLE<br />
       <input name="zone" type="checkbox" value="1" />ZONE<br />
       <input name="location" type="checkbox" value="1" />LOCATION<br />
       <input name="price" type="checkbox" value="1" />PRICE<br />
       <input name="price_sog" type="checkbox" value="1" />PRICE SOG<br />
       <input name="pages" type="checkbox" value="1" />PAGES<br />
       <input name="email" type="checkbox" value="1" />EMAIL<br />
       <input name="status" type="checkbox" value="1" />STATUS<br />
       <input name="reports" type="checkbox" value="1" />REPORTS<br />
       <input name="users" type="checkbox" value="1" />USERS<br />
       <input name="settings" type="checkbox" value="1" />SETTINGS
      &nbsp;
      </td>
      <td align="left" valign="top">
      <span style="font-weight: bold">Allowed IP address</span><br />
      <input type="text" name="user_ip" id="user_ip" /><br /><br />
      
      <span style="font-weight: bold">Account Type</span><br />
      <select name="account_type">
      <option value=""> -- Select Account Type --</option>
      <option value="Admin">Admin</option>
      <option value="Manager">Manager</option>
      </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="right"><label>
      <input type="hidden" name="action" value="add">
        <input type="submit" name="button" id="button" value="Add User" />
      </label></td>
    </tr>
  </table>
</form>
<?php } else { 

$user_view = get_user_view($_GET['edit']);
?>
<p align="center" class="bodytxt"><strong>Update User</strong> </p>
<form id="adduser" name="adduser" method="get" action="users.php?edit=<?php echo $_GET['edit']; ?>">
  <table width="400" border="1" align="center" cellpadding="3" cellspacing="0" class="bodytxt">
    <tr>
      <td width="189"><span style="font-weight: bold">Username</span></td>
      <td width="148"><span style="font-weight: bold">Password</span></td>
    </tr>
    <tr>
      <td><input name="user_id" type="hidden" value="<?php echo $user_view['user_id']; ?>" /><input name="username" type="text" id="username" size="30" value="<?php echo $user_view['username']; ?>" /></td>
      <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">
       <input name="clients" type="checkbox" value="1" <?php if ($user_view['clients'] == '1') { echo 'checked="checked"'; } ?> />CLIENTS<br />
       <input name="reservations" type="checkbox" value="1" <?php if ($user_view['reservations'] == '1') { echo 'checked="checked"'; } ?> />RESERVATIONS<br />
       <input name="shades_of_green" type="checkbox" value="1" <?php if ($user_view['shades_of_green'] == '1') { echo 'checked="checked"'; } ?> />SHADES OF GREEN RESERVATIONS<br />
       <input name="vehicle" type="checkbox" value="1" <?php if ($user_view['vehicle'] == '1') { echo 'checked="checked"'; } ?> />VEHICLE<br />
       <input name="zone" type="checkbox" value="1" <?php if ($user_view['zone'] == '1') { echo 'checked="checked"'; } ?> />ZONE<br />
       <input name="location" type="checkbox" value="1" <?php if ($user_view['location'] == '1') { echo 'checked="checked"'; } ?> />LOCATION<br />
       <input name="price" type="checkbox" value="1" <?php if ($user_view['price'] == '1') { echo 'checked="checked"'; } ?> />PRICE<br />
       <input name="price_sog" type="checkbox" value="1" <?php if ($user_view['price_sog'] == '1') { echo 'checked="checked"'; } ?> />PRICE SOG<br />
       <input name="pages" type="checkbox" value="1" <?php if ($user_view['pages'] == '1') { echo 'checked="checked"'; } ?> />PAGES<br />
       <input name="email" type="checkbox" value="1" <?php if ($user_view['email'] == '1') { echo 'checked="checked"'; } ?> />EMAIL<br />
       <input name="status" type="checkbox" value="1" <?php if ($user_view['status'] == '1') { echo 'checked="checked"'; } ?> />STATUS<br />
       <input name="reports" type="checkbox" value="1" <?php if ($user_view['reports'] == '1') { echo 'checked="checked"'; } ?> />REPORTS<br />
       <input name="users" type="checkbox" value="1" <?php if ($user_view['users'] == '1') { echo 'checked="checked"'; } ?> />USERS<br />
       <input name="settings" type="checkbox" value="1" <?php if ($user_view['settings'] == '1') { echo 'checked="checked"'; } ?> />SETTINGS
      &nbsp;
      </td>
      <td align="left" valign="top">
      <span style="font-weight: bold">Allowed IP address</span><br />
      <input type="text" name="user_ip" id="user_ip" value="<?php echo $user_view['user_ip']; ?>" /><br /><br />

      <span style="font-weight: bold">Account Type</span><br />
      <select name="account_type">
      <?php if (empty($user_view['account_type'])) { ?>
      <option value=""> -- Select Account Type --</option>
      <?php } ?>
      <option value="Admin" <?php if ($user_view['account_type']=='Admin') { echo 'selected="selected"'; }; ?>>Admin</option>
      <option value="Manager" <?php if ($user_view['account_type']=='Manager') { echo 'selected="selected"'; }; ?>>Manager</option>
      </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="right"><label>
      <input type="hidden" name="action" value="edit">
        <input type="submit" name="button" id="button" value="Update User" />
      </label></td>
    </tr>
  </table>
</form>
<?php } ?>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp; </p>


  <?php
unset ($_SESSION['notice']);
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>
</p>
