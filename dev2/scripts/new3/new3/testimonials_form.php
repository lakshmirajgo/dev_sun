
<a style=="float: right;" href="#" class="lbAction" rel="deactivate">Close Form</a><br clear="all" /><br />
<form onsubmit="return validate_testimony_form(this);" name="form" id="form" method="post" action="submit_testimonial.php">
	<input type="hidden" name="action" value="submit" />
	<h2>Customer Testimonials Form</h2>
	<table width="450px" border="0" cellpadding="0" cellspacing="1" class="bodytext" bgcolor="#e9fbff">
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
				<td valign="top" width="60%" class="ot"><strong>Comments or Suggestions to improve our service <font color="#ff0000" size="2">*</font></strong></td>
				<td width="40%" class="ot"> 
					<textarea cols="31" rows="5" name="testimonial"></textarea>                  
				</td>
			</tr>										
			<tr>
				<td align="left" height="48" valign="middle">&nbsp;</td>
				<td style="padding-top: 5px; padding-right:20px;" align="right" valign="top">
                    <div id="imperial_web_solutions_div"></div>
                    <input border="0" height="22" value="Add New Testimony" type="submit" width="68" style="border:#1d557f solid 1px; color:#1d557f; background-color:#9edbee; font-weight:bold; padding:3px;" />
                </td>
			</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript">
// HONEYPOT
(function(elem) {
	if (document.getElementById(elem)) {
		var honeyPot = document.getElementById(elem);
		honeyPot.style.display = 'none';
		honeyPot.innerHTML = '<input type="text" value="" name="imperial_web_solutions">';
	}
}('imperial_web_solutions_div'));
</script>
