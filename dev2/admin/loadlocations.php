<?php
include("includes/functions/general_functions.php");
include("includes/functions/drivers_functions.php");
include("includes/functions/location_functions.php");
include("../includes/functions/trip_type_functions.php");
$all_locations = get_all_locations_new();
$all_airports = get_all_airports();
$all_cruises = get_all_cruises();
$all_disney_resorts = get_all_disney_resorts(); 
?>
<?php
		  $trip_type = get_trip_types_view($_GET['val']);
		  //Number of legs -> make a loop BEGIN
          $num_legs = $trip_type['num_legs'];
		  session_start();
		  $_SESSION['num_legs'] = $num_legs;
		  for ($count =1; $count <= $num_legs; $count += 1) {
		  ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td colspan="2" width="100%" valign="top" align="center" bgcolor="#ffff82">
              <div style="background-color:#ffff82; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-size:12px; font-weight:bold;"><?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { echo "Arrival"; } else { echo "Departure"; }; ?><? } else { echo "Transfer"; }; ?></span></div>            </td>
             </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="count_legs" type="hidden" value="<?php echo $count; ?>" /><select name="from<?php echo $count; ?>" id="from<?php echo $count; ?>" required="yes" size="1" onchange="javascript:getNewlocationContent<?php echo $count; ?>(this.value); JavaScript:xmlhttpPost('calculate_sog.php');">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <optgroup label="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </optgroup>
                                      <optgroup label="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                <optgroup label="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                
                <optgroup label="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </optgroup>
                                      <optgroup label="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                
                
                <optgroup label="SHADES OF GREEN TRANSFERS">
                <optgroup label="&nbsp;&nbsp;&nbsp;Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </optgroup>
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
                					</optgroup>
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
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
				<?php if (empty($_SESSION['date1'])) { $_SESSION['date1'] = $_SESSION['travel_date']; }; ?><input name="date<?php echo $count; ?>" type="text" id="date<?php echo $count; ?>" size="10" maxlength="10" value="<?php echo $_SESSION['date'.$count.''];?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('date<? echo $count; ?>');"><!-- <i> <font color="#ff0000" size="1">click to select date</font></i> --><br />
                MM/DD/YYYY
                <script language="JavaScript">
				var cal<?php echo $count; ?> = new calendar2(document.forms['create_new'].elements['date<?php echo $count; ?>']);
				cal<?php echo $count; ?>.year_scroll = true;
				cal<?php echo $count; ?>.time_comp = false;
				//-->
				</script>
                </td>
              </tr>
              <tr valign="middle">
              	<td colspan="2"><p id="myLocationdetails<?php echo $count; ?>" align="center"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Time:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['h'.$count.''])) { echo '<option value="'.$_SESSION['h'.$count.''].'" selected="selected">'.$_SESSION['h'.$count.''].'</option>'; } ;?><option value="12">12</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select><select name="m<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['m'.$count.''])) { echo '<option value="'.$_SESSION['m'.$count.''].'">'.$_SESSION['m'.$count.''].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['ampm'.$count.''])) { echo '<option value="'.$_SESSION['ampm'.$count.''].'">'.$_SESSION['ampm'.$count.''].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="to<?php echo $count; ?>" id="to<?php echo $count; ?>" required="yes" size="1" onchange="javascript:getNewlocationtoContent1_<?php echo $count; ?>(this.value); JavaScript:xmlhttpPost('calculate_sog.php');">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <optgroup label="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </optgroup>
                                      <optgroup label="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                <optgroup label="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                <optgroup label="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </optgroup>
                                      <optgroup label="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                
                <optgroup label="SHADES OF GREEN TRANSFERS">
                <optgroup label="&nbsp;&nbsp;&nbsp;Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </optgroup>
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
                					</optgroup>
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
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Driver:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
                  <select name="drivers_id<?php print $count?>">
                    <option value="0"> -- Select One -- </option>
                    <?php
						$all_drivers = get_all_drivers(); 
						foreach ($all_drivers as $driver) {
							print '<option value="' . $driver["id"] . '" ' . $default_driver . '>';
							print ucfirst($driver["first_name"]) . ' ' . ucfirst($driver["last_name"]);
							print '</option>';
						} 
					?>
				  </select>
                </td>
              </tr>
              <tr valign="middle">
              	<td colspan="2"><p id="myLocationdetailsto<?php echo $count; ?>"></p></td>
              </tr>
          </table>
          </td>
          </tr>
          </table>
          <?php
		  //Number of legs -> make a loop END
		  } ?>