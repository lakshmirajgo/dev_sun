<?php
include("includes/functions/general_functions.php");
include("includes/functions/zone_functions.php");
$all_zones = get_all_zones();
if ($_GET['val'] == '1' || $_GET['val'] == '2') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>From Zone</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
				<select name="from" size="1" class="bodytxt">
                <?php 
				if ($_GET['new_zone'] == 'yes') {
				?>
                <option value="<?php echo $last_zone['id']; ?>"><?php echo $last_zone['name']; ?></option>
                <?php 	
				}
				
				if(count($all_zones)>=1){
				foreach($all_zones as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> - <?php echo $value['description']; ?></option>
                <?php
					}
				}
				?>
                </select>
				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>To Zone</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
				<select name="to" size="1" class="bodytxt">
                <?php 
				if ($_GET['new_zone'] == 'yes') {
				?>
                <option value="<?php echo $last_zone['id']; ?>"><?php echo $last_zone['name']; ?></option>
                <?php 	
				}
				
				if(count($all_zones)>=1){
				foreach($all_zones as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> - <?php echo $value['description']; ?></option>
                <?php
					}
				}
				?>
                </select>
				</td>
              </tr>
</table>
<?php
} else {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Custom Bundle:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="custom_bundle" class="bodytxt" size="69" type="text"></td>
              </tr>
</table>
<?php } ?>