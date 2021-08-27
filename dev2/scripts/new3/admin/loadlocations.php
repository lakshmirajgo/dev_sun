<?php
include("includes/functions/general_functions.php");
include("includes/functions/location_functions.php");
$all_locations = get_all_locations();
$all_airports = get_all_airports();
if ($_GET['val'] == '1' || $_GET['val'] == '2') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transportation From</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="from" id="from" required="yes" size="1" onchange="javascript:getNewlocationContent(this.value);">
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
                <td align="right" height="30" width="38%" class="ob"><strong>Pickup at</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="h" size="1"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m" size="1"><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm" size="1"><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2"><p id="myLocationdetails"></p></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transportation To</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="to" id="to" required="yes" size="1" onchange="javascript:getNewlocationtoContent(this.value);">
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
              <?php if ($_GET['val'] == '2') { ?> 
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Pickup at</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="h2" size="1"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m2" size="1"><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm2" size="1"><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2"><p id="myLocationdetailsto"></p></td>
              </tr>
              
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
                <input name="from" id="from" type="hidden" value="" />
				<input name="to" id="to" type="hidden" value="" />
                </td>
              </tr> 

<?php } ?>