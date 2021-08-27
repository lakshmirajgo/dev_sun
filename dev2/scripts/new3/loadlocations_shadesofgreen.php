<?php
include("includes/functions/general_functions.php");
include("includes/functions/location_functions.php");


if ($_GET['val'] == '15' || $_GET['val'] == '75' || $_GET['val'] == '18') {
//Shades of Green To Orlando Airport BEGIN
if ($_GET['val'] == '14') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="from" id="from" required="yes" size="1">
                                      <option value="517" selected="selected">Shades of Green</option>
                                      
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="to" id="to" required="yes" size="1">
                                      <option value="421" selected="selected">Orlando International Airport</option>
                </select></td>
              </tr>
</table>
<?php
//Shades of Green To Orlando Airport END
} 

//From Orlando Airport to Shades of Green BEGIN
if ($_GET['val'] == '15') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="from" id="from" required="yes" size="1">
                                      <option value="421" selected="selected">Orlando International Airport</option>            
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="to" id="to" required="yes" size="1">   
                                      <option value="517" selected="selected">Shades of Green</option>
                </select></td>
              </tr>
</table>
<?php
//From Orlando Airport to Shades of Green END
}

//Shades of Green to Orlando Exec. Airport BEGIN
if ($_GET['val'] == '16') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="from" id="from" required="yes" size="1">
                <option value="517" selected="selected">Shades of Green</option>
                                                  
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="to" id="to" required="yes" size="1">   
                                <option value="512" selected="selected">Orlando Exec. Airport</option>      
                </select></td>
              </tr>
</table>
<?php
//Shades of Green to Orlando Exec. Airport END
}


//Shades of Green to Sanford Airport BEGIN
if ($_GET['val'] == '17' || $_GET['val'] == '75') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="from" id="from" required="yes" size="1">
                <OPTGROUP LABEL="Orlando Hotels">
                                <option value="517">Shades of Green</option>
                                </OPTGROUP>
                                <optgroup label="GATEWAYS">
                                <option value="421">Orlando International Airport</option>
                                </optgroup>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="to" id="to" required="yes" size="1">   
                                <OPTGROUP LABEL="Orlando Hotels">
                                <option value="517">Shades of Green</option>
                                </OPTGROUP>
                                <optgroup label="GATEWAYS">
                                <option value="421">Orlando International Airport</option>
                                </optgroup>      
                </select></td>
              </tr>
</table>
<?php
//Shades of Green to Sanford Airport END
}

//From Sanford Airport to Shades of Green BEGIN
if ($_GET['val'] == '18') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="from" id="from" required="yes" size="1">
                <option value="422" selected="selected">Orlando Sanford International Airport</option>
                                                  
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="to" id="to" required="yes" size="1">   
                                <option value="517" selected="selected">Shades of Green</option>      
                </select></td>
              </tr>
</table>
<?php
//From Sanford Airport to Shades of Green END
} 

} else { ?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="from" id="from" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </OPTGROUP>
                                      <optgroup label="GATEWAYS">
                                      <option value="421">Orlando International Airport</option>
                                      <option value="422">Orlando Sanford International Airport</option>
                                      <option value="512">Orlando Exec. Airport</option>
                                     <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(13);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                					</OPTGROUP>
                                    <optgroup label="DISNEY ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(5);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(6);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="DISNEY RESORTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(7);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="GOLF COURSES">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(8);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="SHOPPING">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(9);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="RESTAURANTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(10);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="OTHER">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(11);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="LBV">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(12);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                					</select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="40%" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="60%" class="ot2"><select name="to" id="to" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </OPTGROUP>
                                      <optgroup label="GATEWAYS">
                                      <option value="421">Orlando International Airport</option>
                                      <option value="422">Orlando Sanford International Airport</option>
                                      <option value="512">Orlando Exec. Airport</option>
                                     <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(13);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                					</OPTGROUP>
                                    <optgroup label="DISNEY ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(5);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(6);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="DISNEY RESORTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(7);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="GOLF COURSES">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(8);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="SHOPPING">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(9);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="RESTAURANTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(10);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="OTHER">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(11);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="LBV">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(12);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                </select></td>
              </tr>
</table>

<?php
}
 ?>