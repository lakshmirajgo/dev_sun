<?php
//Define Header Array
//Default top
	$header[0]['logo']='sunstate.gif';
	$header[0]['header']='banner.jpg';
	$header[0]['start']='';
	$header[0]['end']='';
//	//Chrismas
	$header[1]['logo']='seasons/sunstate01.gif';
	$header[1]['header']='seasons/header01.jpg';
	$header[1]['start']=date('Y-').'12-15';
	$header[1]['end']=date('Y-',strtotime('next year')).'01-02';
	//July 4th
	$header[2]['logo']='seasons/sunstate02.gif';
	$header[2]['header']='seasons/header02.jpg';
	$header[2]['start']=date('Y-').'07-03';
	$header[2]['end']=date('Y-').'07-05';
	// Thanksgiving
	$header[3]['logo']='seasons/sunstate03.gif';
	$header[3]['header']='seasons/header03.jpg';
	$header[3]['start']=date('Y-').'11-'.(date('d',strtotime('last Thursday',mktime(1,1,1,11,1,date('Y'))))-1);
	$header[3]['end']=date('Y-').'11-'.(date('d',strtotime('last Thursday',mktime(1,1,1,11,1,date('Y'))))+1);

	// Easter
	$header[4]['logo']='seasons/sunstate04.gif';
	$header[4]['header']='seasons/header04.jpg';
	$easter_day=date('d',easter_date(date('Y')));
	$start_day=($easter_day-1<10)?'0'.($easter_day-1):$easter_day-1;
	$end_day=($easter_day+1<10)?'0'.($easter_day+1):$easter_day+1;
	$header[4]['start']=date('Y-m-',easter_date(date('Y'))).$start_day;
	$header[4]['end']=date('Y-m-',easter_date(date('Y'))).$end_day;
	//Veterans Day
	$header[5]['logo']='seasons/sunstate05.gif';
	$header[5]['header']='seasons/header05.jpg';
	$header[5]['start']=date('Y-').'11-10';
	$header[5]['end']=date('Y-').'11-12';
	
	$img_head='';
	$img_logo='';
	$now=time();
//	$now=mktime(4,4,4,4,4,2010);
	for($i=1;$i<sizeof($header);$i++)
	{
//		echo '<br />-Start : '.$header[$i]['start'].' -- '.date('Y-m-d',$now).' -- End : '.$header[$i]['end'].'<hr />';
		if($now>=strtotime($header[$i]['start'].'00:00:00') && $now<=strtotime($header[$i]['end'].'23:59:59'))
		{
			$img_head=$header[$i]['header'];
			$img_logo=$header[$i]['logo'];
		}
	}
	if(empty($img_head) || empty($img_logo))
	{
		$img_head=$header[0]['header'];
		$img_logo=$header[0]['logo'];
	}
?>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="19%" valign="middle"><img src="/images/<?php echo $img_logo;?>" alt="Sunstate" /></td>
		<td width="81%" align="right"><img src="images/topRightCars.jpg" width="367" height="102" border="0" usemap="#Map" /></td>
	</tr>
</table>-->