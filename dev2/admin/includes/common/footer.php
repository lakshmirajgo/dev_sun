</td>
  </tr>
</tbody></table>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="780">
  
  <tbody><tr>
    <td class="footertxt" align="center" height="50" valign="middle">&#169; Copyright <?php echo date ("Y"); ?> <?php echo $company_info['company']; ?> </td>
  </tr>
  
  <?php
  if($_SERVER['REMOTE_ADDR'] == '97.68.74.30')
{
?>
	<tr>
  	<td>
	  <pre>
	  	<?php print_r($_SESSION);?>
	  </pre>
	  </td>
  </tr>
  <?php
}
?>
  

</tbody></table>
</body></html>