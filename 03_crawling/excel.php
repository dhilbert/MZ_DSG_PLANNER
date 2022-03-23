<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');




//해당주차의 시작일 

$timestamp = strtotime("2021/01/01 +2 week");
$check = date("Y-m-d ", $timestamp);


header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 주간공수.xls" );
header( "Content-Description: PHP4 Generated Data" );


$EXCEL_STR = "<table border='1'>";
$jem_idx = isset($_GET['jem_idx']) ? $_GET['jem_idx'] : Null;
$sql	 = "
	select Components from jira_excel_sub
	where  jem_idx ='".$jem_idx."'
		group by Components
	

";			
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$check_week = array();
	$EXCEL_STR =   $EXCEL_STR."
		<tr>
			<td> </td>
		</tr>	
		<tr>
			<td>".$info['Components']."</td>
		</tr>
		<tr>
			<td rowspan=2>파트</td>
			<td rowspan=2>담당자</td>		
		";	
		$week_sql	 = "	
		select WEEKOFYEAR(Due_Datetime) as Due_Datetime
		from jira_excel_sub
			where  jem_idx ='".$jem_idx."'
			and Components= '".$info['Components']."'			
		group by WEEKOFYEAR(Due_Datetime)
		ORDER BY WEEKOFYEAR(Due_Datetime) ASC";
	$week_res	=  mysqli_query($real_sock,$week_sql) or die(mysqli_error($real_sock));
	while($week_info	 = mysqli_fetch_array($week_res)){
		array_push($check_week,$week_info['Due_Datetime']);			
	}
	$EXCEL_STR =   $EXCEL_STR."<td colspan=".count($check_week).">주차</td>	<td rowspan=2>합</td>		
		</tr>
	<tr>";
	for($week_i = 0 ;$week_i<count($check_week);$week_i++){
		
		$timestamp = strtotime(date('Y')."/01/01 +".$check_week[$week_i]." week");
		$check = date("Y-m-d ", $timestamp);


		$EXCEL_STR =   $EXCEL_STR."<td>".$check."</td>";
	}

	$team_sql	 = "	
		select jes.Assignee,dit.division_idx,dit.worker_team
			from jira_excel_sub as jes
				join division_info_temp as dit
			on 	jes.Assignee =dit.worker_name			
			where  jes.jem_idx ='".$jem_idx."'
			and jes.Components= '".$info['Components']."'

		group by Assignee
		ORDER BY dit.division_idx ASC";
	$team_res	=  mysqli_query($real_sock,$team_sql) or die(mysqli_error($real_sock));
	while($team_info	 = mysqli_fetch_array($team_res)){

		$temp_STR='';
		$temp_STR =   $temp_STR."
			<tr>
				<td >".$team_info['worker_team']."</td>	
				<td >".$team_info['Assignee']."</td>	

			";
			$total = 0;	
		for($ii = 0 ;$ii<count($check_week);$ii++){
			$worktime_sql	 = "select ((SUM(Time_Spent)/3600)/8)/20.8  as workTime
			from jira_excel_sub 
			where  jem_idx ='".$jem_idx."'
			and Components= '".$info['Components']."'	
			and 	Assignee ='".$team_info['Assignee']."'	
			and WEEKOFYEAR(Due_Datetime) =  '".$check_week[$ii]."'	";
			
			$worktime_res	=  mysqli_query($real_sock,$worktime_sql) or die(mysqli_error($real_sock));
			$worktime_info	 = mysqli_fetch_array($worktime_res);
			$total += $worktime_info['workTime'];
			$temp_STR =   $temp_STR."	<td >".round($worktime_info['workTime'],3)."</td>";	

		}
		$temp_STR =   $temp_STR."	<td >".round($total,3)."</td>";	
		$temp_STR =   $temp_STR."</tr>	";
		if(round($total,3)>0){

			$EXCEL_STR =   $EXCEL_STR.$temp_STR;

		}


	};
	












	$EXCEL_STR =   $EXCEL_STR."	<tr>";





		



}






$EXCEL_STR .= "</table>";
echo $EXCEL_STR;
echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";















/*



/*
$temp1 ='주소' ;
$temp2 =$info['Courtbuilding'];
$want = temp_print_hd($temp1,$temp2);$EXCEL_STR =$EXCEL_STR.$want;

$temp1 ='번지' ;
$temp2 =$info['buildingNumber'];
$want = temp_print_hd($temp1,$temp2);$EXCEL_STR =$EXCEL_STR.$want;
$temp1 ='평형' ;
$temp2 =$info['exclusiveUseArea'];
$want = temp_print_hd($temp1,$temp2);$EXCEL_STR =$EXCEL_STR.$want;


$EXCEL_STR .= "</table>";



$EXCEL_STR = "<table border='1'>";


$table = hd_findertype_invers($info['finderType']);

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$info['Courtbuilding']."_".$info['buildingNumber']."_".$info['exclusiveUseArea']."평형_전세상세거래.xls" );
header( "Content-Description: PHP4 Generated Data" );

$id_array = array();
$COLUMNS_sql	 = "SHOW COLUMNS FROM rawdata_charter_".$table.";";
$COLUMNS_res	=  mysqli_query($real_sock,$COLUMNS_sql) or die(mysqli_error($real_sock));
while($COLUMNS_info	 = mysqli_fetch_array($COLUMNS_res)){
 $EXCEL_STR =   $EXCEL_STR."<td>".$COLUMNS_info['Field']."</td>";
 array_push($id_array,$COLUMNS_info['Field']);
};


$data_sql	 = "select * from rawdata_charter_".$table." as a
				where a.Courtbuilding = '".$info['Courtbuilding']."'
				and a.buildingNumber  = '".$info['buildingNumber']."'
				and floor(a.AreaforExclusiveUse/3.3) = ".$info['exclusiveUseArea']."

;";
$data_res	=  mysqli_query($real_sock,$data_sql) or die(mysqli_error($real_sock));


while($data_info	 = mysqli_fetch_array($data_res)){

	 $EXCEL_STR =   $EXCEL_STR."<tr>";
	for($i = 0 ;$i <count($id_array);$i++ ){
			 $EXCEL_STR =   $EXCEL_STR."<td>".$data_info[$id_array[$i]]."</td>";	
	}
	 $EXCEL_STR =   $EXCEL_STR."</tr>";
 
}


$EXCEL_STR .= "</table>";
echo $EXCEL_STR;
echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";






 */
?>