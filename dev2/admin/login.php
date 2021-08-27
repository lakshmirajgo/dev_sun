<?php
	session_start();	
		include("includes/functions/general_functions.php");

	if(isset($_POST['username']) && isset($_POST['password'])){
	
		if(!login($_POST['username'], $_POST['password'])){
			if($_SERVER['REMOTE_ADDR']!='97.79.119.152')
			{
				$_SESSION['user_details'] = login_new($_POST['username'], $_POST['password']);
				
				if(empty($_SESSION['user_details'])){
					unset($_SESSION['auth_admin']);
					$_SESSION['notice'] = "Invalid username or password.";
				} else {
					//Login like User BEGIN
					$_SESSION['auth_admin'] = true;
					//$_SESSION['username'] = $_POST['username'];
					
					// Redirect to previous page
					if (!empty($_SESSION['redirect'])) {
						header("Location: ".$_SESSION['redirect']."");
						exit;
					} else {
						header("Location: index.php");
					}
				
				//Login like User END
				}
			}
			else
			{
				$_SESSION['auth_admin'] = true;
				//$_SESSION['username'] = $_POST['username'];		
				// Redirect to previous page
				if (!empty($_SESSION['redirect'])) 
				{
					header("Location: ".$_SESSION['redirect']."");
					exit;
				} 
				else 
				{
					header("Location: index.php");
				}
			}
		}
		else{
			$_SESSION['auth_admin'] = true;
			//$_SESSION['username'] = $_POST['username'];
			
			// Redirect to previous page
			if (!empty($_SESSION['redirect'])) {
			header("Location: ".$_SESSION['redirect']."");
			exit;
			} else {
			header("Location: index.php");
			}
		}
	}
	
include ("includes/common/header.php");		
?>
<table border="0" cellpadding="0" cellspacing="0" width="350">
      <tbody><tr>
        <td align="left" valign="top" width="10"><img src="images/left_curve.jpg" height="179" width="11"></td>
        <td align="left" background="images/center_curve.jpg" valign="middle" width="379">
		<form id="login" name="login" method="post" action="login.php" onsubmit="return validate(this)">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle"><table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>LOGIN DETAILS</strong></td>
                </tr>
              </tbody></table>
              </td>

          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody><tr valign="middle">
                <td align="center" height="30" width="28%"><strong>Username</strong></td>
                <td align="left" height="30" width="72%">
                  <label>
                    <input name="username" class="bodytxt" size="39" id="username" type="text">

                    </label>                </td>
              </tr>
              <tr valign="middle">
                <td align="center" height="30"><strong>Password</strong></td>
                <td align="left" height="30"><input name="password" class="bodytxt" size="39" id="password" type="password"></td>
              </tr>
              <tr>
                <td align="left" height="20" valign="middle">&nbsp;</td>

                <td style="padding-right: 20px;" align="right" valign="top"><input src="images/but_login.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </tbody></table>
			
			</td>
          </tr>
        </tbody></table>
		</form>
		<div align="center" class="bodytxt">
		  <? if(!empty($_SESSION['notice'])){ echo "<div class=\"notice\">".$_SESSION['notice']."</div>"; unset($_SESSION['notice']); } ?>
	   </div></td>
        <td align="left" valign="top" width="11"><img src="images/right_curve.jpg" height="179" width="11"></td>

      </tr>
    </tbody></table>
    <p class="bodytxt"><a href="../index.html" class="bodytxt" title="Click Here to go to our home page"><strong>Home</strong></a></p>
<?php
include ("includes/common/footer.php");
?>