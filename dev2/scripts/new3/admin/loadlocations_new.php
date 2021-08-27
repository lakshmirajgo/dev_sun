<?php
include("includes/functions/general_functions.php");
include("includes/functions/location_functions.php");
$all_locations = get_all_locations();
$all_airports = get_all_airports();
$all_cruises = get_all_cruises();
if ($_GET['val'] == '1' || $_GET['val'] == '2') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>a"><?php echo $value['name']; ?></option>
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
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>a"><?php echo $value['name']; ?></option>
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
</table>
<?php
// For Cruise Transfers
} else {

              if ($_GET['val'] == '3' || $_GET['val'] == '4') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="1a">Orlando International Airport</option>
                                      </OPTGROUP>
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
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="1a">Orlando International Airport</option>
                                      </OPTGROUP>
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
		<?php
		
		}
		
		
		if ($_GET['val'] == '9' || $_GET['val'] == '11') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="2a">Orlando Sanford International Airport</option>

                                      </OPTGROUP>
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
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="2a">Orlando Sanford International Airport</option>
                                      </OPTGROUP>
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
		<?php
		
		}
		
		
		 if ($_GET['val'] == '5' || $_GET['val'] == '6') {
		?>


<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="from" id="from" required="yes" size="1">
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
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="to" id="to" required="yes" size="1">
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
		
		 if ($_GET['val'] == '7') {
		?>


<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 1: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location1" id="location1" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="1a">Orlando International Airport</option>
                                      </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 2: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location2" id="location2" required="yes" size="1">
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
                <td align="left" height="30" width="70%" class="ot2"><select name="location3" id="location3" required="yes" size="1">
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


<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 1: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location1" id="location1" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                      <OPTGROUP LABEL="Orlando Airports">
                  <option value="1a">Orlando International Airport</option>
                                      </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 2: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location3" id="location3" required="yes" size="1">
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
                <td align="left" height="30" width="70%" class="ot2"><select name="location2" id="location2" required="yes" size="1">
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


<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 1: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location1" id="location1" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <option value="2a">Orlando Sanford International Airport</option>

                                      </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="30%" class="ob"><strong>Location 2: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="70%" class="ot2"><select name="location3" id="location3" required="yes" size="1">
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
                <td align="left" height="30" width="70%" class="ot2"><select name="location2" id="location2" required="yes" size="1">
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
		<?php } ?>


<?php } ?>