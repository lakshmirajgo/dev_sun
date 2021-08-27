<?php
include("includes/functions/general_functions.php");
include("includes/functions/location_functions.php");
$all_locations = get_all_locations_new();
$all_airports = get_all_airports();
$all_cruises = get_all_cruises();
$all_disney_resorts = get_all_disney_resorts(); 
if ($_GET['val'] == '1' || $_GET['val'] == '2') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '2') { ?>
              <?php } ?>
</table>
<?php
// For Cruise Transfers
} else {

              if ($_GET['val'] == '3' || $_GET['val'] == '4') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="421">Orlando International Airport</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="421">Orlando International Airport</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '4') { ?>
              <?php } ?>
</table>
<?php
		
		}
		
		
		
		// Specials 
		if ($_GET['val'] == '12' || $_GET['val'] == '13') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '4') { ?>
              <?php } ?>
</table>
<?php
		
		}
		
		
		// Specials 
		if ($_GET['val'] == '77' || $_GET['val'] == '78') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Theme Parks">
                  <option value="527">Sea World</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Theme Parks">
                  <option value="527">Sea World</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '4') { ?>
              <?php } ?>
</table>
<?php
		
		}
		
		// Specials 
		if ($_GET['val'] == '79' || $_GET['val'] == '80') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Theme Parks">
                  <option value="528">Universal Studios</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Theme Parks">
                  <option value="528">Universal Studios</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '4') { ?>
              <?php } ?>
</table>
<?php
		
		}
		
		
		if ($_GET['val'] == '9' || $_GET['val'] == '11') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="422">Orlando Sanford International Airport</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="422">Orlando Sanford International Airport</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '11') { ?>
              <?php } ?>
</table>
<?php
		
		}
		
		
		 if ($_GET['val'] == '5' || $_GET['val'] == '6') {
		?>


<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>c"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '6') { ?>
              <?php } ?>
</table>
<?php } 
		
		 if ($_GET['val'] == '7') {
		?>

<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 1: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location1" id="location1" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="421">Orlando International Airport</option>
                                      </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 2: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location2" id="location2" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 3: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location3" id="location3" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>c"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
</table>
		<?php }
		
		
		 if ($_GET['val'] == '8') {
		?>

<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 1: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location1" id="location1" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="421">Orlando International Airport</option>
                                      </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 2: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location2" id="location2" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>c"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 3: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location3" id="location3" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
</table>
		<?php }
        
        
        if ($_GET['val'] == '10') {
		?>

<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 1: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location1" id="location1" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <option value="422">Orlando Sanford International Airport</option>

                                      </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 2: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location2" id="location2" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>c"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 3: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location3" id="location3" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
</table>
		<?php }

 if ($_GET['val'] == '76') {
		?>
<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 1: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location1" id="location1" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                     <OPTGROUP LABEL="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 2: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location2" id="location2" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>c"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 3: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location3" id="location3" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                     <OPTGROUP LABEL="Orlando Airports">
                  <option value="421">Orlando International Airport</option>
                                      </OPTGROUP>
                </select></td>
              </tr>
</table>
		<?php } 
 } ?>