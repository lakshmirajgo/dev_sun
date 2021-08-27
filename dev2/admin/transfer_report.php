<?php

	session_start();
	
	//error_reporting(E_ALL);
	
	if (!isset($_SESSION['auth_admin'])) {
		$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
		header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
		// Quit the script
		exit(); 
	}
	include("includes/functions/general_functions.php");
	include("includes/functions/transfer_report_functions.php");	
	
	//Check permissions for User BEGIN
	if (!chech_permissions($_SESSION['user_details'], 'reports')) {
		//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
		echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
		// Quit the script
		exit(); 
		
	}
	//Check permissions for User END		
	$report=get_transfer_report();
/*
	$total1=0;
	$total2=0;
	
	$total1+=$report[date('Y')][date('M',mktime(2,2,2,date('n')-1,1))]; 
	$total2+=$report[date('Y')-1][date('M',mktime(2,2,2,date('n')-1,1,date('Y')-1))];
	
	$total1+=$report[date('Y')][date('M',mktime(2,2,2,date('n'),1))];
	$total2+=$report[date('Y')-1][date('M',mktime(2,2,2,date('n'),1,date('Y')-1))];
	
	$total1+=$report[date('Y')][date('M',mktime(2,2,2,date('n')+1,1))];
	$total2+=$report[date('Y')-1][date('M',mktime(2,2,2,date('n')+1,1,date('Y')-1))];
*/	
	include ("includes/common/header.php");
	
	
?>
	<div align="center">	
		<?php include ("includes/common/menu.php");	?>
		<br />
			<?php echo get_3_month_summary($report);?>
<!--		<table border="1" cellpadding="5" cellspacing="0" width="25%" align="cetner" style="font-size: 14px;">
			<tr>
				<th >&nbsp;</th>
				<th bgcolor="#999999"><?php echo date('Y');?></th>
				<th bgcolor="#999999"><?php echo date('Y')-1;?></th>
			</tr>
			<tr>
				<td>
					<?php echo date('F',mktime(2,2,2,date('n')-1,1));?>
				</td>
				<td><?php echo $report[date('Y')][date('M',mktime(2,2,2,date('n')-1,1))];?></td>
				<td><?php echo $report[date('Y')-1][date('M',mktime(2,2,2,date('n')-1,1,date('Y')-1))];?></td>
			</tr>
			<tr>
				<td>
					<?php echo date('F');?>
				</td>
				<td><?php echo $report[date('Y')][date('M',mktime(2,2,2,date('n'),1))];?></td>
				<td><?php echo $report[date('Y')-1][date('M',mktime(2,2,2,date('n'),1,date('Y')-1))];?></td>
			</tr>
			<tr>
				<td>
					<?php echo date('F',mktime(2,2,2,date('n')+1,1));?>
				</td>
				<td><?php echo $report[date('Y')][date('M',mktime(2,2,2,date('n')+1,1))];?></td>
				<td><?php echo $report[date('Y')-1][date('M',mktime(2,2,2,date('n')+1,1,date('Y')-1))];?></td>
			</tr>
			<tr bgcolor="#cccccc">
				<td>Total Transfers</td>
				<td><?php echo $total1;?></td>
				<td><?php echo $total2;?></td>
			</tr>
		</table>
		-->
		<h1>Annual Transfer Summary</h1>
		<table border="1" cellpadding="5" cellspacing="0" width="90%" align="center">
			<tr>
				<th>Year</th>
			<?php
				for($x=1;$x<=12;$x++)
				{
				?>
					<th><?php echo date('M',mktime(2,2,2,$x,1));?></th>
				<?php
				}
			?>
				<th>Runs</th>
				<th>Total</th>
				<th>Cash</th>
				<th>CC</th>
			</tr>
			<?php
				foreach($report as $k=>$v)
				{					
					if($k!='total' && $k!='totals')
					{
				?>
						<tr>
							<td><?php echo $k;?></td>
						<?php
							for($x=1;$x<=12;$x++)
							{
							?>
								<td><?php echo number_format($v[date('M',mktime(2,2,2,$x))],0,'',',');?></td>
							<?php
							}
						?>
							<td><?php print $v['totals']['runs'];?></td>
							<td>$<?php print number_format($v['totals']['total_amount'], 2);?></td>
							<td>$<?php print number_format($v['totals']['cash'], 2);?></td>
							<td>$<?php print number_format($v['totals']['credit_card'], 2);?></td>
						</tr>
				<?php
					}
				}
			?>
		</table>
	</div>
<?php
		unset ($_SESSION['redirect']);
		include ("includes/common/footer.php");
	?>
