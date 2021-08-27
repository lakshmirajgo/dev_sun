<?php
include("includes/functions/general_functions.php");
include("includes/functions/location_functions.php");
?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="200" class="ob"><strong>Transportation From: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" class="ot2"><select name="from" id="from" size="1" onchange="javascript:getNewlocationContent();">
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
              </table>
              <table id="loadto_shadesofgreen" width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
              <tr valign="middle">
                <td align="right" height="30" width="200" class="ob"><strong>Transportation To: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" class="ot2"><select name="to" id="to" size="1">
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