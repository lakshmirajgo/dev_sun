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