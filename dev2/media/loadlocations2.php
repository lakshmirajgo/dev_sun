<?php
	include("includes/functions/general_functions.php");
	include("includes/functions/location_functions.php");
	$all_locations = get_all_locations_new();
	$all_airports = get_all_airports();
	$all_cruises = get_all_cruises();
	$all_disney_resorts = get_all_disney_resorts(); 
	if ($_GET['val'] == '1' || $_GET['val'] == '2') {
?>



<!--block is for orlando area  ---pmg-->
<table width="100%" cellpadding="" cellspacing="0">
	<tr>
		<td class="ob"> From: <font color="#ff0000" size="2">*</font><br>
			<select name="from" id="from">
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
			</select>
		</td>
		<td>&nbsp;</td>
		<td class="ob"> To: <font color="#ff0000" size="2">*</font><br>
			<select name="to" id="to">
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
			</select>
		</td>
	</tr>
	<?php if ($_GET['val'] == '2') { ?>
	<?php } ?>
</table>
<!--end block for orlando area  ---pmg-->

<!--block is for MCO to Cruise Terminals - one way  ---pmg-->
<?php
// For Cruise Transfers
} else {

	if ($_GET['val'] == '3' || $_GET['val'] == '4') {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="ob"> From: <font color="#ff0000" size="2">*</font></br>
			<select name="from" id="from" size="1">
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
			</select>
		</td>
		<td>&nbsp;</td>
		<td class="ob"> To: <font color="#ff0000" size="2">*</font><br>
			<select name="to" id="to" size="1">
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
			</select>
		</td>
	</tr>
	<?php if ($_GET['val'] == '4') { ?>
	<?php } ?>
</table>
<!--end block for MCO to Cruise Terminals - one way  ---pmg-->

<!--block is for attraction xfers number 1-->
<?php
	}
	// Specials 
	if ($_GET['val'] == '12' || $_GET['val'] == '13') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="middle">
		<td class="ob"> From: <font color="#ff0000" size="2">*</font><br>
			<select name="from" id="from" size="1">
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
		<td>&nbsp;</td>
		<td class="ob"> To: <font color="#ff0000" size="2">*</font><br>
			<select name="to" id="to" size="1">
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
	<?php if ($_GET['val'] == '4') { ?>
	<?php } ?>
</table>
<!--end block for attraction xfers number 1-->

<!--block is for attraction xfers number 2-->
<?php
			
			}
			
			
			// Specials 
			if ($_GET['val'] == '77' || $_GET['val'] == '78') {
	?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="ob"> From: <font color="#ff0000" size="2">*</font><br>
			<select name="from" id="from" size="1">
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
			</select>
		</td>
		<td>&nbsp;</td>
		<td class="ob"> To: <font color="#ff0000" size="2">*</font><br>
			<select name="to" id="to" size="1">
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
			</select>
		</td>
	</tr>
	<?php if ($_GET['val'] == '4') { ?>
	<?php } ?>
</table>
<!--end block for attraction xfers number 2-->

<!--block is for attraction xfers number 3-->
<?php
	}
	// Specials 
	if ($_GET['val'] == '79' || $_GET['val'] == '80') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="middle">
		<td class="ob"> From: <font color="#ff0000" size="2">*</font><BR>
			<select name="from" id="from" size="1">
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
			</select>
		</td>
		<td>&nbsp;</td>
		<td class="ob"> To: <font color="#ff0000" size="2">*</font><br>
			<select name="to" id="to" size="1">
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
			</select>
			</td>
		</tr>
		<?php if ($_GET['val'] == '4') { ?>
		<?php } ?>
	</table>
<!--end block for attraction xfers number 3-->

<!--block is for Sanford to cruise terminal/port area resorts-->
<?php
		
		}
		
		
		if ($_GET['val'] == '9' || $_GET['val'] == '11') {
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="ob"> From: <font color="#ff0000" size="2">*</font><br>
			<select name="from" id="from" size="1">
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
			</select>
		</td>
		<td>&nbsp;</td>
		<td class="ob"> To: <font color="#ff0000" size="2">*</font><br>
			<select name="to" id="to" size="1">
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
			</select>
		</td>
	</tr>
   <?php if ($_GET['val'] == '11') { ?>
   <?php } ?>
</table>
<!--end block for Sanford to cruise terminal/port area resorts-->

<!--block is for disney/universal to cruise terminal/port access-->
<?php
		
		}
		
		
		 if ($_GET['val'] == '5' || $_GET['val'] == '6') {
		?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="middle">
		<td class="ob"> From: <font color="#ff0000" size="2">*</font><br>
		<select name="from" id="from" size="1">
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
		<td>&nbsp;</td>
		<td class="ob"> To: <font color="#ff0000" size="2">*</font><br>
		<select name="to" id="to" size="1">
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
		</select>
		</td>
	</tr>
   <?php if ($_GET['val'] == '6') { ?>
   <?php } ?>
</table>
<!--end block for disney/universal to cruise terminal/port access-->


<!--block is for disney or universal>Cruise terminal>MCCO (3)leg-->
<?php } 
		
		 if ($_GET['val'] == '7') {
		?>
<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="middle">
		<td class="ob">Location 1: <font color="#ff0000" size="2">*</font><br>
			<select name="location1" id="location1" size="1">
				<option value="" selected="selected"> -- Select One -- </option>
				<OPTGROUP LABEL="Orlando Airports">
					<option value="421">Orlando International Airport</option>
				</OPTGROUP>
			</select>
			<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 2: <font color="#ff0000" size="2">*</font><br>
		<select name="location2" id="location2" size="1">
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
		<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 3: <font color="#ff0000" size="2">*</font><br>
			<select name="location3" id="location3" size="1">
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
			</select>
			<br>
		</td>
	</tr>
</table>
<!--end block for disney pr universal>Cruise terminal>MCCO (3)leg-->

<!--block is for MCO>Cruse Terminals>Disney or Usiversal>MCCO (3)leg-->
		<?php }
		
		
		 if ($_GET['val'] == '8') {
		?>
<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="middle">
		<td class="ob">Location 1: <font color="#ff0000" size="2">*</font><br>
			<select name="location1" id="location1" size="1">
				<option value="" selected="selected"> -- Select One -- </option>
				<OPTGROUP LABEL="Orlando Airports">
					<option value="421">Orlando International Airport</option>
				</OPTGROUP>
			</select>
			<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 2: <font color="#ff0000" size="2">*</font><br>
			<select name="location2" id="location2" size="1">
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
			</select>
			<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 3: <font color="#ff0000" size="2">*</font><br>
			<select name="location3" id="location3" size="1">
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
</table>
<!--end block  for MCO>Cruse Terminals>Disney or Usiversal>MCCO (3)leg-->

<!--block is for Sanford>Cruise Terminals>Disney or Universal>Sanford (3)leg-->
<?php }
	if ($_GET['val'] == '10') {
?>
<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="middle">
		<td class="ob">Location 1: <font color="#ff0000" size="2">*</font><br>
			<select name="location1" id="location1" size="1">
				<option value="" selected="selected"> -- Select One -- </option>
				<OPTGROUP LABEL="Orlando Airports">
					<option value="422">Orlando Sanford International Airport</option>
				</OPTGROUP>
			</select>
			<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 2: <font color="#ff0000" size="2">*</font><br>
			<select name="location2" id="location2" size="1">
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
			</select>
			<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 3: <font color="#ff0000" size="2">*</font><br>
			<select name="location3" id="location3" size="1">
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
</table>
<!--end block for Sanford>Cruise Terminals>Disney or Universal>Sanford (3)leg-->


<!--block is for Disney/Universal>cruise>MCO - Round trip (3)leg-->
<?php }
	if ($_GET['val'] == '76') {
?>
<input name="from" type="hidden" /><input name="to" type="hidden" />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="middle">
		<td class="ob">Location 1: <font color="#ff0000" size="2">*</font><br>
			<select name="location1" id="location1" size="1">
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
			<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 2: <font color="#ff0000" size="2">*</font><br>
			<select name="location2" id="location2" size="1">
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
			</select>
			<br><br>
		</td>
	</tr>
	<tr valign="middle">
		<td class="ob">Location 3: <font color="#ff0000" size="2">*</font><br>
			<select name="location3" id="location3" size="1">
				<option value="" selected="selected"> -- Select One -- </option>
				<OPTGROUP LABEL="Orlando Airports">
					<option value="421">Orlando International Airport</option>
				</OPTGROUP>
			</select>
		</td>
	</tr>
</table>
<!--end block for Disney/Universal>cruise>MCO - Round trip (3)leg-->

<?php } 
 } ?>