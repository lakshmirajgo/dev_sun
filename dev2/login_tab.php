<form id="login" name="login" method="post" action="login.php<?php if (!empty($_GET['redirect'])) { echo "?redirect=".$_GET['redirect']; }; ?>" onsubmit="return validate(this)">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr> 
            <td class="top">Client Login</td>
            </tr>
              <tr>
              <td class="middle">
              <?php
			  if ($_SESSION['auth'] != '1') { ?>
              	<div id="ClientLogin"> 
                	<strong>View</strong> or<strong> Change</strong> your reservation 24 Hours a Day <br />
                    <?php echo '<span style="color:#FF0000;">'.$_SESSION['notice'].'</span>'; echo "<br />"; ?>
                	<br />
                    <strong>Email Address: </strong><br />
                    
                  <label>
                    <input type="text" name="email" id="email" />
                  </label>
                  <br />
                  <strong>Password :</strong>                <br />
                    <input type="password" name="password" id="password" />
                    <br />
                    <input src="images/Bt_login.gif" width="54" height="19" border="0" type="image"><br />
                <a href="new_client.php">Create a new account</a><br />
                <a href="forgot_password.php">Forgot password?</a></div>      
                    <?php } else { ?>
                   <div style="padding:3px;">&raquo; <a href="edit_account.php" class="menu"><strong>EDIT ACCOUNT</strong></a></div>
                   <div style="padding:3px;">&raquo; <a href="my_account.php" class="menu"><strong>MY RESERVATIONS</strong></a></div>
                   <div style="padding:3px;">&raquo; <a href="logout.php" class="menu"><strong>LOG OUT</strong></a></div>
                   <div style="padding:3px;">&raquo; <a href="reserve.php" class="menu"><strong>MAKE A NEW RESERVATION</strong></a></div>
                    <? } ?>
              </td>
            </tr>
                  <tr>
                    <td class="bottom">&nbsp;</td>
            </tr>
                </table>
</form>