<?php
session_start();
//ini_set('display_errors', 1);
//ini_set('log_errors', 0);
//error_reporting(E_ALL);
if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/testimony_functions.php");

	if ($_POST['action'] == 'create_new') {
		unset($_POST['action']);
		if(add_testimony_new($_POST))
		echo '<script language="javascript">alert(\'Testimony created successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating testimony\');</script>';
	}
	
	if ($_GET['cAction'] == 'edit'){
		$testimony_view = get_testimonials_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			unset($_POST['action']);
			$_POST['date_submitted']=date('Y-m-d',strtotime($_POST['date_submitted']));
			if (edit_testimony_new($_POST,$_GET['id'])) {
			echo '<script language="javascript">alert(\'Testimony updated successfully\');</script>';
						$testimony_view = get_testimonials_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating testimony\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_testimonials($delete_id))
		echo '<script language="javascript">alert(\'Testimony Deleted Successfully\');window.location=\'testimony_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the testimony\n\nPlease try again\');window.location=\'testimony_manager.php\';</script>';
		$all_testimonials = get_all_testimonials();
		
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_testimonials($_POST['id']))
		echo '<script language="javascript">alert(\'Testimonials Deleted Successfully\')</script>';
		$all_testimonials = get_all_testimonials();
	}
		
	include ("includes/common/header.php");	
 	include ("includes/common/menu.php");	
	$start=0;
	$display=30;
	if(!empty($_GET['start']))
	{$start=$_GET['start'];}
	if(!empty($_REQUEST['display']))
	{$display=$_REQUEST['display'];}
	
	
	if(!empty($_GET['from_page']))
	{$_POST=$_SESSION['last_search'];}
	
	if(!empty($_POST))
	{$_SESSION['last_search']=$_POST;}
	else
	{unset($_SESSION['last_search']);}
	
    $all_testimonials = get_all_testimonials_with_pages($start,$display);
	$total=count(get_all_testimonials());
	$pagination=generate_pagination_numbers($total,$start,$display,'page_link','page_link_home');
	//print_r($all_testimonials);

	// Show all testimonials
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete'){
	?>
	<style type="text/css">
		.page_link {text-decoration: none; font-size: 12px; display: inline-block; padding: 5px; width: 15px; text-align: center; color: #646464;}
		.page_link:hover {background-color:#646464; color:#FFF; text-decoration:underline;}
		.page_link_home {font-size: 12px; display: inline-block; padding: 5px; width: 15px; text-align: center; background-color:#646464; color:#FFF;}
	</style>
	<script type="text/javascript">
		function filter_display(display)
		{
			window.location.href='testimony_manager.php?start=<?php echo $_REQUEST['start'];?>&display='+display;
		}
	</script>
	<table border="0" cellpadding="0" cellspacing="0" width="680" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
		<tbody>
			<tr>
				<td align="center" valign="middle" width="100%">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
									<table border="0" cellpadding="0" cellspacing="0" width="90%">
										<tbody>
											<tr>
												<td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>TESTIMONY MANAGER</em></strong></td>
												<td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="testimony_manager.php?cAction=create_new"><img src="images/add_testimony.jpg" border="0" type="image" alt="Add a New Testimony" title="Add a New Testimony"></a></td>
											</tr>
										</tbody>
									</table>
									<strong> </strong>
								</td>
							</tr>
							<tr>
								<td>
									<table width="570px" align="center">
										<tr>
											<td align="center">
												<form id="filter" name="filter" action="" method="post">
													<strong>Filter By Date</strong><br /><br />
													From : <input name="from_date" value="" />
													<span style="padding:5px;"><img src="img/cal.gif" alt="View Calendar" width="16" height="16" onclick="javascript:cal1.popup();" /></span>
													To : 
													<input name="to_date" value="" />
													<span style="padding:5px;"><img src="img/cal.gif" alt="View Calendar" width="16" height="16" onclick="javascript:cal2.popup();" /></span><br />
													<br />
													<input type="submit" value="Filter By Date" />
												</form>	
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="570px" align="center">
										<tr>
											<td>
												<?php echo $pagination;?>
											</td>
										</tr>
										<tr>
											<td>
												Records per Page : 
												<select name="filter_display" onchange="filter_display(this.value);">
													<?php
														for($x=10;$x<=100;$x+=10)
														{
														?>
															<option <?php if($display==$x)echo'selected="selected"';?> value="<?php echo $x;?>" ><?php echo $x;?></option>
														<?php
														}
													?>
												</select>
											</td>
										</tr>
									</table>
								</td>	
							</tr>	
							<tr>
								<td>
									
									<form name="displayfrm" method="post" action="testimony_manager.php">
										<input type="hidden" value="" name="action">
										<table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
											<tr bgcolor="#646464" >
												<td width="37" style="font-weight: bold; color:#FFFFFF"></td>
												<td width="22"></td>
												<td width="280" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
												<?php
													if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') 
													{
												?>
														<a href="?orderby=name&sort=desc" class="link2">Name</a><?php } else { ?>
														<a href="?orderby=name&sort=asc" class="link2">Name</a>
												<?php 
													} 
												?>
												</td>
												<td width="120" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">City, State</td>
												<td width="84" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
												<?php
													if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') 
													{
												?>
														<a href="?orderby=date&sort=asc" class="link2">Date</a><?php } else { ?>
														<a href="?orderby=date&sort=desc" class="link2">Date</a>
												<?php 
													} 
												?>
												</td>
												<td width="22"></td>
												<td width="5"></td>
											</tr>
										<?php 	
											if(count($all_testimonials)>=1)
											{
												foreach($all_testimonials as $value)
												{
													if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
													echo '<tr bgcolor="'.$bgcolor.'">';
										?>
														<td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
														<td width="22" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
														<td width="280" align="left" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Testimony"><strong><?php if (!empty($value['name'])) { echo $value['name'].", "; }; ?><?php if (!empty($value['company'])) { echo $value['company']; }; ?></strong></a></td> 
														<td width="120" align="left" class="ot1"><?php if (!empty($value['city'])) { echo $value['city'].", "; }; ?><?php if (!empty($value['state'])) { echo $value['state']; }; ?></td>
														<td width="84" align="center" class="ot1"><?php if (!empty($value['date_submitted'])) { echo format_date_calendar2($value['date_submitted']); }; ?></td> 
														<td width="22" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this testimony?\n\nNotice: deleted testimony cannot be restored')" /></a></td> 
														<td width="5"></td>
													</tr>
													<tr>
										<?php 
												} 
										?>
												<td colspan="5" valign="bottom" height="30"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected testimonials?\n\nNotice: deleted testimonials cannot be restored')"></td>
											</tr>
									<?php 					
											} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no testimonials in the database. <a href="testimony_manager.php?cAction=create_new" class="link1">Create a new testimony</a></strong></div><table><tr><td></td></tr>'; } 
									?> 
										</table>  
									</form>
								</td>
							</tr>
							<tr>
								<td >
									<table width="570px" align="center">
										<tr>
											<td>
												<?php echo $pagination;?>
											</td>
										</tr>
									</table>
								</td>	
							</tr>	
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
		<script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['filter'].elements['from_date']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
	var cal2 = new calendar2(document.forms['filter'].elements['to_date']);
	cal2.year_scroll = true;
	cal2.time_comp = false;
//-->
</script>
	<?php
	}
	?>
    <?php
	// Create a New Testimony
	if ($_GET[cAction] == 'create_new') {
	?>
	<script type="text/javascript">
		function validate_testimony_form(form)
		{
			if(form.name.value=='' || form.testimonial.value=='')
			{
				alert('Required Fields are marked with an asterik (*). \r\n Please check the form for the missing information');
				return false;
			}
			return true;
		}	
	</script>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="testimony_manager.php" onsubmit="return validate_testimony_form(this);">
		<input name="action" type="hidden" value="create_new">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
			<tbody>
				<tr>
					<td align="center" valign="middle" width="100%">
						<table border="0" cellpadding="0" cellspacing="0" width="580" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
							<tbody>
								<tr>
									<td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
										<table border="0" cellpadding="0" cellspacing="0" width="90%">
											<tbody>
												<tr>
													<td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>ADD A NEW TESTIMONY</em></strong></td>
												</tr>
											</tbody>
										</table>
										<strong> </strong>
									</td>
								</tr>
								<tr>
									<td align="left" valign="top">
										 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="BorderBox" bgcolor="#e9fbff">
											<tbody>
												<tr> 
													<td class="ot"><strong>Name <font color="#ff0000" size="2">*</font></strong></td>
													<td class="ot"><input name="name" value=""></td>
												</tr>
												<tr> 
													<td class="ot"><strong>Email Address</strong></td>
													<td class="ot"><input name="email_address"></td>
												</tr>
												<tr valign="middle" class="bodytxt">
													<td align="left" height="30" class="ot"><strong>City:</strong></td>
													<td align="left" height="30" class="ot"><input name="city" class="bodytxt" size="39" type="text" /></td>
												</tr>
												<tr valign="middle" class="bodytxt">
													<td align="left" height="30" class="ot"><strong>State:</strong></td>
													<td align="left" height="30" class="ot"><select name="state">
														<option value="" selected="selected">Select State</option>
															<option value="AK">AK</option>
															<option value="AL">AL</option>
															<option value="AR">AR</option>
															<option value="AZ">AZ</option>
															<option value="CA">CA</option>
															<option value="CO">CO</option>
															<option value="CT">CT</option>
															<option value="DC">DC</option>
															<option value="DE">DE</option>
															<option value="FL">FL</option>
															<option value="GA">GA</option>
															<option value="HI">HI</option>
															<option value="IA">IA</option>
															<option value="ID">ID</option>
															<option value="IL">IL</option>
															<option value="IN">IN</option>
															<option value="KS">KS</option>
															<option value="KY">KY</option>
															<option value="LA">LA</option>
															<option value="MA">MA</option>
															<option value="MD">MD</option>
															<option value="ME">ME</option>
															<option value="MI">MI</option>
															<option value="MN">MN</option>
															<option value="MO">MO</option>
															<option value="MS">MS</option>
															<option value="MT">MT</option>
															<option value="NC">NC</option>
															<option value="ND">ND</option>
															<option value="NE">NE</option>
															<option value="NH">NH</option>
															<option value="NJ">NJ</option>
															<option value="NM">NM</option>
															<option value="NV">NV</option>
															<option value="NY">NY</option>
															<option value="OH">OH</option>
															<option value="OK">OK</option>
															<option value="OR">OR</option>
															<option value="PA">PA</option>
															<option value="RI">RI</option>
															<option value="SC">SC</option>
															<option value="SD">SD</option>
															<option value="TN">TN</option>
															<option value="TX">TX</option>
															<option value="UT">UT</option>
															<option value="VA">VA</option>
															<option value="VT">VT</option>
															<option value="WA">WA</option>
															<option value="WI">WI</option>
															<option value="WV">WV</option>
															<option value="WY">WY</option>
														</select>
													</td>
												</tr>
												<tr> 
													<td class="ot"><strong>Overall SUN STATE TRANSPORTATION experience</strong></td>
													<td width="40%" class="ot"> 
														<select name="overall_rating" size="1">
															<option selected="selected" value="5">5 - Excellent</option>
															<option value="4">4 - Above Average</option>
															<option value="3 ">3 - Average</option>
															<option value="2">2 - Below Average</option>
															<option value="1">1 - Poor</option>
														</select>
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Cleanliness of your vehicle</strong></td>
													<td width="40%" class="ot"> 
														<select name="clean_rating" size="1">
															<option selected="selected" value="5">5 - Excellent</option>
															<option value="4">4 - Above Average</option>
															<option value="3 ">3 - Average</option>
															<option value="2">2 - Below Average</option>
															<option value="1">1 - Poor</option>
														</select>                    
													</td>
												</tr>
												<tr> 
													<td class="ot"><strong>Vehicle Type</strong></td>
													<td class="ot"> 
														<select name="vehicle" required="no" size="1">
															<option value="Town Car">Town Car</option>
															<option value="Luxury Van">Luxury Van</option>
															<option value="Limo">Limousine</option>
														</select>                   
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Rate the Service</strong></td>
													<td width="40%" class="ot"> 
														<select name="service_rating" size="1">
															<option selected="selected" value="5">5 - Excellent</option>
															<option value="4">4 - Above Average</option>
															<option value="3 ">3 - Average</option>															
															<option value="2">2 - Below Average</option>
															<option value="1">1 - Poor</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Rate the Driver</strong></td>
													<td width="40%" class="ot"> 
														<select name="driver_rating" size="1">
															<option selected="selected" value="5">5 - Excellent</option>
															<option value="4">4 - Above Average</option>
															<option value="3 ">3 - Average</option>
															<option value="2">2 - Below Average</option>
															<option value="1">1 - Poor</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Drivers Name (If you remember)</strong></td>
													<td class="ot">
														<input name="drivers_name" value="" size="25" type="text">                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Value of the service for&nbsp; the money you spent?</strong></td>
													<td width="40%" class="ot">
														<select name="money_rating" size="1">
															<option selected="selected" value="5">5 - Excellent</option>
															<option value="4">4 - Above Average</option>
															<option value="3">3 - Average</option>
															<option value="2">2 - Below Average</option>
															<option value="1">1 - Poor</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Would you use us again?</strong></td>
													<td width="40%" class="ot"> 
														<select name="use_us_again" size="1">
															<option selected="selected" value="Yes">Yes</option>
															<option value="No">No</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td valign="top" width="60%" class="ot"><strong>Testimony <font color="#ff0000" size="2">*</font></strong></td>
													<td width="40%" class="ot"> 
														<textarea cols="31" rows="5" name="testimonial"></textarea>                  
													</td>
												</tr>										
												<tr valign="middle">
													<td align="right" height="30" width="38%" class="ob"><strong>Status:</strong></td>
													<td align="left" height="30" width="62%" class="ot2">
														<select name="status">
															<option value="1">Active</option>
															<option value="0">Inactive</option>
														</select>
													</td>
												</tr>
												<tr>
													<td align="right" height="30px" valign="middle"><strong>Date:</strong></td>
													<td align="left" valign="middle" class="ot2">
														<input id="date_submitted" name="date_submitted" class="bodytxt" size="8" type="text" value="<?php echo date('m/d/Y');?>" />
														<span style="padding:5px;"><img src="img/cal.gif" alt="View Calendar" width="16" height="16" onclick="javascript:cal1.popup();" /></span>
													</td>
												</tr>
												<tr>
													<td align="left" height="48" valign="middle">&nbsp;</td>
													<td style="padding-top: 5px; padding-right:20px;" align="right" valign="top"><input border="0" height="22" value="Add New Testimony" type="submit" width="68" style="border:#1d557f solid 1px; color:#1d557f; background-color:#9edbee; font-weight:bold; padding:3px;" /></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	    <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['create_new'].elements['date_submitted']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
//-->
</script>
	<?php
	}
	?>
    <?php
	// Edit Testimony
	if ($_GET[cAction] == 'edit') {
	?>
	<script type="text/javascript">
		function validate_testimony_form(form)
		{
			if(form.name.value=='' || form.testimonial.value=='' || form.date_submitted.value=='')
			{
				alert('Required Fields are marked with an asterik (*). \r\n Please check the form for the missing information');
				return false;
			}
			return true;
		}	
	</script>
	<form onsubmit="return validate_testimony_form(this);" id="edit_testimony" style="padding-bottom:0px;" name="edit_testimony" method="post" action="testimony_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>">
		<input name="action" type="hidden" value="edit">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
			<tbody>
				<tr>  
					<td align="center" valign="middle" width="100%">
						<table border="0" cellpadding="0" cellspacing="0" width="580" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
							<tbody>
								<tr>
									<td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
										<table border="0" cellpadding="0" cellspacing="0" width="90%">
											<tbody>
												<tr>
													<td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>EDIT TESTIMONY</em></strong></td>
												</tr>
											</tbody>
										</table>
										<strong> </strong>
									</td>
								</tr>
								<tr>
									<td align="left" valign="top">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="BorderBox" bgcolor="#e9fbff">
											<tbody>
												<tr> 
													<td class="ot"><strong>Name <font color="#ff0000" size="2">*</font></strong></td>
													<td class="ot"><input name="name" value="<?php echo $testimony_view['name'];?>"></td>
												</tr>
												<tr> 
													<td class="ot"><strong>Email Address</strong></td>
													<td class="ot"><input name="email_address" value="<?php echo $testimony_view['email_address'];?>"></td>
												</tr>
												<tr valign="middle" class="bodytxt">
													<td align="left" height="30" class="ot"><strong>City:</strong></td>
													<td align="left" height="30" class="ot"><input name="city" class="bodytxt" size="39" type="text" /></td>
												</tr>
												<tr valign="middle" class="bodytxt">
													<td align="left" height="30" class="ot"><strong>State:</strong></td>
													<td align="left" height="30" class="ot">
														<select name="state">
														<?php
															if($testimony_view['state']=='')
															{
														?>
																<option value="" selected="selected">Select State</option>
														<?php
															}
															else
															{
														?>
																<option value="<?php echo $testimony_view['state'];?>" > <?php echo $testimony_view['state'];?></option>
														<?php
															}
														?>
															<option value="AK">AK</option>
															<option value="AL">AL</option>
															<option value="AR">AR</option>
															<option value="AZ">AZ</option>
															<option value="CA">CA</option>
															<option value="CO">CO</option>
															<option value="CT">CT</option>
															<option value="DC">DC</option>
															<option value="DE">DE</option>
															<option value="FL">FL</option>
															<option value="GA">GA</option>
															<option value="HI">HI</option>
															<option value="IA">IA</option>
															<option value="ID">ID</option>
															<option value="IL">IL</option>
															<option value="IN">IN</option>
															<option value="KS">KS</option>
															<option value="KY">KY</option>
															<option value="LA">LA</option>
															<option value="MA">MA</option>
															<option value="MD">MD</option>
															<option value="ME">ME</option>
															<option value="MI">MI</option>
															<option value="MN">MN</option>
															<option value="MO">MO</option>
															<option value="MS">MS</option>
															<option value="MT">MT</option>
															<option value="NC">NC</option>
															<option value="ND">ND</option>
															<option value="NE">NE</option>
															<option value="NH">NH</option>
															<option value="NJ">NJ</option>
															<option value="NM">NM</option>
															<option value="NV">NV</option>
															<option value="NY">NY</option>
															<option value="OH">OH</option>
															<option value="OK">OK</option>
															<option value="OR">OR</option>
															<option value="PA">PA</option>
															<option value="RI">RI</option>
															<option value="SC">SC</option>
															<option value="SD">SD</option>
															<option value="TN">TN</option>
															<option value="TX">TX</option>
															<option value="UT">UT</option>
															<option value="VA">VA</option>
															<option value="VT">VT</option>
															<option value="WA">WA</option>
															<option value="WI">WI</option>
															<option value="WV">WV</option>
															<option value="WY">WY</option>
														</select>
													</td>
												</tr>
												<tr> 
													<td class="ot"><strong>Overall SUN STATE TRANSPORTATION experience</strong></td>
													<td width="40%" class="ot"> 
														<select name="overall_rating" size="1">
															<option <?php echo ($testimony_view['overall_rating']=='5')?'selected="selected"':'';?> value="5">5 - Excellent</option>
															<option <?php echo ($testimony_view['overall_rating']=='4')?'selected="selected"':'';?> value="4">4 - Above Average</option>
															<option <?php echo ($testimony_view['overall_rating']=='3')?'selected="selected"':'';?> value="3 ">3 - Average</option>
															<option <?php echo ($testimony_view['overall_rating']=='2')?'selected="selected"':'';?> value="2">2 - Below Average</option>
															<option <?php echo ($testimony_view['overall_rating']=='1')?'selected="selected"':'';?> value="1">1 - Poor</option>
														</select>

													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Cleanliness of your vehicle</strong></td>
													<td width="40%" class="ot"> 
														<select name="clean_rating" size="1">
															<option <?php echo ($testimony_view['clean_rating']=='5')?'selected="selected"':'';?> value="5">5 - Excellent</option>
															<option <?php echo ($testimony_view['clean_rating']=='4')?'selected="selected"':'';?> value="4">4 - Above Average</option>
															<option <?php echo ($testimony_view['clean_rating']=='3')?'selected="selected"':'';?> value="3 ">3 - Average</option>
															<option <?php echo ($testimony_view['clean_rating']=='2')?'selected="selected"':'';?> value="2">2 - Below Average</option>
															<option <?php echo ($testimony_view['clean_rating']=='1')?'selected="selected"':'';?> value="1">1 - Poor</option>
														</select>                    
													</td>
												</tr>
												<tr> 
													<td class="ot"><strong>Vehicle Type</strong></td>
													<td class="ot"> 
														<select name="vehicle" required="no" size="1">
															<option <?php echo ($testimony_view['vehicle']=='Town Car')?'selected="selected"':'';?> value="Town Car">Town Car</option>
															<option <?php echo ($testimony_view['vehicle']=='Luxary Van')?'selected="selected"':'';?> value="Luxury Van">Luxury Van</option>
															<option <?php echo ($testimony_view['vehicle']=='Limo')?'selected="selected"':'';?>value="Limo">Limousine</option>
														</select>                   
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Rate the Service</strong></td>
													<td width="40%" class="ot"> 
														<select name="service_rating" size="1">
															<option <?php echo ($testimony_view['service_rating']=='5')?'selected="selected"':'';?> value="5">5 - Excellent</option>
															<option <?php echo ($testimony_view['service_rating']=='4')?'selected="selected"':'';?> value="4">4 - Above Average</option>
															<option <?php echo ($testimony_view['service_rating']=='3')?'selected="selected"':'';?> value="3 ">3 - Average</option>															
															<option <?php echo ($testimony_view['service_rating']=='2')?'selected="selected"':'';?> value="2">2 - Below Average</option>
															<option <?php echo ($testimony_view['service_rating']=='1')?'selected="selected"':'';?> value="1">1 - Poor</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Rate the Driver</strong></td>
													<td width="40%" class="ot"> 
														<select name="driver_rating" size="1">
															<option <?php echo ($testimony_view['driver_rating']=='5')?'selected="selected"':'';?> value="5">5 - Excellent</option>
															<option <?php echo ($testimony_view['driver_rating']=='4')?'selected="selected"':'';?> value="4">4 - Above Average</option>
															<option <?php echo ($testimony_view['driver_rating']=='4')?'selected="selected"':'';?> value="3 ">3 - Average</option>
															<option <?php echo ($testimony_view['driver_rating']=='3')?'selected="selected"':'';?> value="2">2 - Below Average</option>
															<option <?php echo ($testimony_view['driver_rating']=='2')?'selected="selected"':'';?> value="1">1 - Poor</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Drivers Name (If you remember)</strong></td>
													<td class="ot">
														<input name="drivers_name" value="<?php echo $testimony_view['drivers_name'];?>" size="25" type="text">                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Value of the service for&nbsp; the money you spent?</strong></td>
													<td width="40%" class="ot">
														<select name="money_rating" size="1">
															<option <?php echo ($testimony_view['money_rating']=='5')?'selected="selected"':'';?> value="5">5 - Excellent</option>
															<option <?php echo ($testimony_view['money_rating']=='4')?'selected="selected"':'';?> value="4">4 - Above Average</option>
															<option <?php echo ($testimony_view['money_rating']=='3')?'selected="selected"':'';?> value="3">3 - Average</option>
															<option <?php echo ($testimony_view['money_rating']=='2')?'selected="selected"':'';?> value="2">2 - Below Average</option>
															<option <?php echo ($testimony_view['money_rating']=='1')?'selected="selected"':'';?> value="1">1 - Poor</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td width="60%" class="ot"><strong>Would you use us again?</strong></td>
													<td width="40%" class="ot"> 
														<select name="use_us_again" size="1">
															<option <?php echo ($testimony_view['use_us_again']=='Yes')?'selected="selected"':'';?> value="Yes">Yes</option>
															<option <?php echo ($testimony_view['use_us_again']=='No')?'selected="selected"':'';?> value="No">No</option>
														</select>                  
													</td>
												</tr>
												<tr> 
													<td valign="top" width="60%" class="ot"><strong>Testimony <font color="#ff0000" size="2">*</font></strong></td>
													<td width="40%" class="ot"> 
														<textarea cols="31" rows="5" name="testimonial"><?php echo $testimony_view['testimonial'];?></textarea>                  
													</td>
												</tr>										
												<tr valign="middle">
													<td align="left" height="30" width="38%" class="ob"><strong>Status:</strong></td>
													<td align="left" height="30" width="62%" class="ot2">
														<select name="status">
															<option <?php echo ($testimony_view['status']=='1')?'selected="selected"':'';?> value="1">Active</option>
															<option <?php echo ($testimony_view['status']=='0')?'selected="selected"':'';?> value="0">Inactive</option>
														</select>
													</td>
												</tr>
												<tr>
													<td align="left" height="30px" valign="middle"><strong>Date:<font color="#ff0000" size="2">*</font></strong></td>
													<td align="left" valign="middle" class="ot2">
														<input id="date_submitted" name="date_submitted" class="bodytxt" size="8" type="text" value="<?php echo date('m/d/Y',strtotime($testimony_view['date_submitted']));?>" />
														<span style="padding:5px;"><img src="img/cal.gif" alt="View Calendar" width="16" height="16" onclick="javascript:cal1.popup();" /></span>
													</td>
												</tr>
												<tr>
													<td align="left" height="48" valign="middle">&nbsp;</td>
													<td style="padding-top: 5px; padding-right:20px;" align="right" valign="top"><input border="0" height="22" value="Update Testimony" type="submit" width="68" style="border:#1d557f solid 1px; color:#1d557f; background-color:#9edbee; font-weight:bold; padding:3px;" /></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['edit_testimony'].elements['date_submitted']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
//-->
</script>
	<?php
	}
	?>
<?php
include ("includes/common/footer.php");
?>