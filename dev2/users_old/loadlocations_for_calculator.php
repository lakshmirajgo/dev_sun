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
                <td align="right" height="30" width="38%" class="ob"><strong>Transportation From</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="from1" id="from1" required="yes" size="1" onchange="javascript:getNewlocationContent(this.value);">
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
                <option value="512">Orlando Exec. Airport</option>
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
                
                
                <optgroup label="SHADES OF GREEN TRANSFERS">
                <OPTGROUP LABEL="&nbsp;&nbsp;&nbsp;Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </OPTGROUP>
                                      <optgroup label="&nbsp;&nbsp;&nbsp;GATEWAYS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY ATTRACTIONS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;ATTRACTIONS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY RESORTS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;GOLF COURSES">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;SHOPPING">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;RESTAURANTS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;OTHER">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;LBV">
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
                                    </optgroup>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transportation To</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="to1" id="to1" required="yes" size="1" onchange="javascript:getNewlocationtoContent(this.value);">
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
                <option value="512">Orlando Exec. Airport</option>
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
                
                
                <optgroup label="SHADES OF GREEN TRANSFERS">
                <OPTGROUP LABEL="&nbsp;&nbsp;&nbsp;Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </OPTGROUP>
                                      <optgroup label="&nbsp;&nbsp;&nbsp;GATEWAYS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY ATTRACTIONS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;ATTRACTIONS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY RESORTS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;GOLF COURSES">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;SHOPPING">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;RESTAURANTS">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;OTHER">
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
                                    <optgroup label="&nbsp;&nbsp;&nbsp;LBV">
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
                                    </optgroup>
                </select></td>
              </tr>
              <?php if ($_GET['val'] == '2') { ?> 
              
              <?php } else { ?>
              
              <tr valign="middle">
              	<td colspan="2"><p id="myLocationdetailsto"></p></td>
              </tr>
              
              <?php } ?>
               
</table>
<?php
} else {
?>
<tr valign="middle">
              	<td colspan="2">
                <input name="from1" id="from" type="hidden" value="" />
				<input name="to1" id="to" type="hidden" value="" />
                </td>
              </tr> 

<?php } ?>