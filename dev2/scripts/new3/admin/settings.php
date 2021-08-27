<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include ("includes/common/header.php");	
if ($_POST['action'] == 'update_settings') {
		if(edit_settings())		
		$_SESSION['notice'] = '<div style="background-color:#d1fac3; padding:5px; border:#72da4e solid 1px;">Your company information update request has processed successfully.</div>';
			else 
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">Error updating page. Try again</span></div>';
			
		$company_info = get_company_info();
	}
if ($_POST['action2'] == 'update_password') {
		if(md5($_POST['password_old']) != $company_info['password']){
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">Sorry the old password entered does not match. Try again</span></div>';
		
		} else {
		if($_POST['password_new'] != $_POST['password_confirm']){
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">Sorry the new password entered does not match. Try again</span></div>';
		}
		else{	
			update_password($_POST['username'], $_POST['password_old'], $_POST['password_new']);
			$_SESSION['notice'] = '<div style="background-color:#d1fac3; padding:5px; border:#72da4e solid 1px;">Your account password update request has processed successfully.</div>';
		}
		}
		
	}
	
	echo $_SESSION['notice'];
?>
	<div align="center">
	  <?php include ("includes/common/menu.php");	?>
	  <form id="update_settings" style="padding-bottom:0px;" name="update_settings" method="post" action="settings.php" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="update_settings">
	 <table border="0" cellpadding="0" cellspacing="0" width="580" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="580">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>COMPANY INFORMATION</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>

          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody><tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Company Name</strong></td>
                <td align="left" height="30"><input name="company" class="bodytxt" size="39" id="company" type="text" value="<?php echo $company_info['company'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address" type="text" value="<?php echo $company_info['address'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2" class="bodytxt" size="39" id="address2" type="text" value="<?php echo $company_info['address2'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text" value="<?php echo $company_info['city'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">
						<option value="<?php echo $company_info['state'] ;?>" selected="selected"><?php echo $company_info['state'] ;?></option>                        
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="39" id="zip" type="text" value="<?php echo $company_info['zip'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country" id="country" class="bodytxt">
  				<option value="<?php echo $company_info['country'] ;?>"><?php echo $company_info['country'] ;?></option>
  				<option value="USA" selected="selected">United States</option>
				</select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Toll free</strong></td>
                <td align="left" height="30"><input name="tollfree" class="bodytxt" size="39" id="tollfree" type="text" value="<?php echo $company_info['tollfree'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Telephone</strong></td>
                <td align="left" height="30"><input name="telephone" class="bodytxt" size="39" id="telephone" type="text" value="<?php echo $company_info['telephone'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Fax</strong></td>
                <td align="left" height="30"><input name="fax" class="bodytxt" size="39" id="fax" type="text" value="<?php echo $company_info['fax'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail</strong></td>
                <td align="left" height="30"><input name="email" class="bodytxt" size="39" id="email" type="text" value="<?php echo $company_info['email'] ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Slogan</strong></td>
                <td align="left" height="30"><textarea name="slogan" id="slogan" cols="36" rows="2" class="bodytxt"><?php echo $company_info['slogan'] ;?></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Home Page Title</strong></td>
                <td align="left" height="30"><textarea name="home_page_title" id="home_page_title" cols="36" rows="2" class="bodytxt"><?php echo $company_info['home_page_title'] ;?></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Show Contact</strong></td>
                <td align="left" height="30">
                <select name="show_contact" id="show_contact" class="bodytxt">
  				<option value="<?php echo $company_info['show_contact'] ;?>"><?php echo $company_info['show_contact'] ;?></option>
  				<option value="Yes">Yes</option>
  				<option value="No">No</option>
				</select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Show Map</strong></td>
                <td align="left" height="30">
                <select name="show_map" id="show_map" class="bodytxt">
  				<option value="<?php echo $company_info['show_map'] ;?>"><?php echo $company_info['show_map'] ;?></option>
  				<option value="Yes">Yes</option>
  				<option value="No">No</option>
				</select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Map engine</strong></td>
                <td align="left" height="30"><select name="map_engine" id="map_engine" class="bodytxt">
  				<option value="<?php echo $company_info['map_engine'] ;?>"><?php echo $map_engine = ucfirst(str_replace("_", " ",$company_info['map_engine'])) ;?></option>
  				<option value="google">Google</option>
  				<option value="yahoo">Yahoo!</option>
                <option value="live_search">Live Search</option>
				</select>     
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Reservation Minimum Time</strong></td>
                <td align="left" height="30">
                <select name="minimum_time" id="minimum_time" class="bodytxt">
  				<option value="<?php echo $company_info['minimum_time'] ;?>"><?php echo $company_info['minimum_time']*24 ;?></option>
  				<option value="1">24</option>
  				<option value="2">48</option>
                <option value="3">72</option>
				</select>
                </td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    </form>
    <form id="update_password" style="padding-bottom:0px;" name="update_password" method="post" action="settings.php" onsubmit="return validate2(this)">
    <input name="action2" type="hidden" value="update_password">
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="580">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>LOGIN DETAILS</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody><tr valign="middle">
                <td height="30" width="38%" align="right" class="ob"><strong>Username</strong></td>
                <td align="left" height="30" width="62%">
                  <label>
                  <input name="username" class="bodytxt" size="39" id="username" type="text" value="<?php echo $company_info['username'] ;?>">
                  </label>
                 </td>
              </tr>
              <tr valign="middle">
                <td height="30" align="right" class="ob"><strong>Old Password</strong></td>
                <td align="left" height="30"><input name="password_old" class="bodytxt" size="39" id="password_old" type="password"></td>
              </tr>
              <tr valign="middle">
                <td height="30" align="right" class="ob"><strong>New Password</strong></td>
                <td align="left" height="30"><input name="password_new" class="bodytxt" size="39" id="password_new" type="password"></td>
              </tr>
              <tr valign="middle">
                <td height="30" align="right" class="ob"><strong>Confirm Password</strong></td>
                <td align="left" height="30"><input name="password_confirm" class="bodytxt" size="39" id="password_confirm" type="password"></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    </form>
    </div>
<?php
unset ($_SESSION['notice']);
include ("includes/common/footer.php");
?>