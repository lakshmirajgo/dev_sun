<?php
	function get_transfer_report()
	{
		global $db;
		$sql="SELECT `reservation_id`,`date`, r.total_amount, r.paying_cash FROM `reservation_details` rd JOIN `reservations` r ON `rd`.`reservation_id` = `r`.`id` WHERE `r`.`status` != '11' AND `rd`.`date`>='2009-01-01' GROUP BY reservation_id ORDER BY `rd`.`date` ASC";
		if(!$result=$db->select($sql))
		{
			return false;
		}

		$data['total']=0;
		$data['totals'] = array('runs' => 0, 'total_amount' => 0, 'cash' => 0, 'credit_card' => 0);
		while($row=$db->get_row($result))
		{
			$year = date('Y',strtotime($row['date']));
			$month = date('M',strtotime($row['date']));
			
			$data[$year][$month]++;
			$data['total']++;
			$data[$year]['total']++;
			
			// meta
			$data[$year]['totals']['runs'] += 1;
			$data[$year]['totals']['total_amount'] += $row['total_amount'];
			if (strtolower(trim($row['paying_cash'])) == 'yes') {
				$data[$year]['totals']['cash'] += $row['total_amount'];
			}
			else {
				$data[$year]['totals']['credit_card'] += $row['total_amount'];
			}
		}
		return $data;
	}
	
	function get_3_month_summary($report)
	{
		$total1=0;
		$total2=0;
		
		$total1+=$report[date('Y')][date('M',mktime(2,2,2,date('n')-1,1))]; 
		$total2+=$report[date('Y')-1][date('M',mktime(2,2,2,date('n')-1,1,date('Y')-1))];
		
		$total1+=$report[date('Y')][date('M',mktime(2,2,2,date('n'),1))];
		$total2+=$report[date('Y')-1][date('M',mktime(2,2,2,date('n'),1,date('Y')-1))];
		
		$total1+=$report[date('Y')][date('M',mktime(2,2,2,date('n')+1,1))];
		$total2+=$report[date('Y')-1][date('M',mktime(2,2,2,date('n')+1,1,date('Y')-1))];

		$summary='
		<table border="1" cellpadding="5" cellspacing="0" width="40%" align="cetner" style="font-size: 14px;">
			<tr>
				<th >&nbsp;</th>
				<th bgcolor="#999999">'.date('Y').'</th>
				<th bgcolor="#999999">'.(date('Y')-1).'</th>
			</tr>
			<tr>
				<td>
					'.(date('F',mktime(2,2,2,date('n')-1,1))).'
				</td>
				<td>'.$report[date('Y')][date('M',mktime(2,2,2,date('n')-1,1))].'</td>
				<td>'.$report[date('Y')-1][date('M',mktime(2,2,2,date('n')-1,1,date('Y')-1))].'</td>
			</tr>
			<tr>
				<td>
					'.date('F').'
				</td>
				<td>'.$report[date('Y')][date('M',mktime(2,2,2,date('n'),1))].'</td>
				<td>'.$report[date('Y')-1][date('M',mktime(2,2,2,date('n'),1,date('Y')-1))].'</td>
			</tr>
			<tr>
				<td>
					'.date('F',mktime(2,2,2,date('n')+1,1)).'
				</td>
				<td>'.$report[date('Y')][date('M',mktime(2,2,2,date('n')+1,1))].'</td>
				<td>'.$report[date('Y')-1][date('M',mktime(2,2,2,date('n')+1,1,date('Y')-1))].'</td>
			</tr>
			<tr bgcolor="#cccccc">
				<td>Total Transfers</td>
				<td>'.$total1.'</td>
				<td>'.$total2.'</td>
			</tr>
			<tr bgcolor="#cccccc">
				<td>YTD Transfers</td>
				<td>'.$report[date('Y')]['total'].'</td>
				<td>'.$report[date('Y')-1]['total'].'</td>
			</tr>
		</table>';
		return $summary;
	}
?>