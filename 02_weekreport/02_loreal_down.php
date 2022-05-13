<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');


$List = array('In-Progress','닫힘','해결됨.','열기','Confirm','To be confirmed','진행 중');
$jiraapi_status = isset($_GET['jiraapi_status']) ? $_GET['jiraapi_status'] : $List;
















$EXCEL_STR = "
<table border='1'>
		<thead>
			<tr>
				
				
<th> # </th>
<th>작업타입</th>
<th>상태</th>
<th>작업시작일</th>
<th>작업완료일</th>
<th>구성요소</th>
<th>메일제목</th>
<th>지라링크</th>
<th>지라번호</th>
<th>고객명</th>
<th>기획자</th>
<th>작업자</th>
<th>진행상황</th>
<th>갯수</th>
<th>수정횟수</th>
<th>총작업시간(h)</th>
<th>비고v
				</tr>

		</thead>
		<tbody>
";




	
$want_sql = '(';	

	for($i = 0 ; $i < count($List)   ; $i++){

		$temp_checked = "";
		if(in_array($List[$i],$jiraapi_status))	{
			$temp_checked = "checked";
			$want_sql = $want_sql."'".$List[$i]."',";

		}
	}
	$want_sql =  substr($want_sql, 0, -1);
	$want_sql = $want_sql.')';





$total = 0;
$sql	 = "
SELECT a.customfield_12265,a.environment,a.jmi_key,a.jmi_summary,a.jmi_assignee_name,a.jmi_reporter_name,a.status,a.customfield_12271,a.customfield_12270,a.customfield_12268,a.customfield_12269,a.jmi_inx,

(select count(*) from jirasync_work where jmi_inx = a.jmi_inx and comment_kind='수정') as temp1,

(select sum(timeSpentSeconds) from jirasync_work where jmi_inx = a.jmi_inx ) as temp2,a.customfield_12262,a.customfield_12261



FROM jirasync_main_info as a


where a.components =' 로레알_아르마니 '
and a.status in ".$want_sql;



$total = 0;
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$total += 1;
	$EXCEL_STR =$EXCEL_STR."<tr>";
	$name=$total;$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['customfield_12265'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['status'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['customfield_12268'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['customfield_12269'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";



	$sub_sql	 = "
		SELECT description
			FROM jirasync_fixversions		
		where jmi_inx ='".$info['jmi_inx']."'";
	$sub_res	=  mysqli_query($real_sock,$sub_sql) or die(mysqli_error($real_sock));

	$temp_name = '';
	while($sub_info	 = mysqli_fetch_array($sub_res)){
		$temp_name = $temp_name.$sub_info['description']."/";
	}
	$name = substr($temp_name, 0, -1);	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	
	$name = $info['environment'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	
	
	$name = "<a href='https://mz-dev.atlassian.net/browse/".$info['jmi_key']."'>".$info['jmi_summary']."</a>";	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['jmi_key'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['customfield_12261'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['jmi_reporter_name'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['jmi_assignee_name'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	
	$name = $info['customfield_12271'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['customfield_12270'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['temp1'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = round($info['temp2']/3600,2) ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";
	$name = $info['customfield_12262'] ;	$EXCEL_STR =$EXCEL_STR."<td>".$name."</td>";

	$EXCEL_STR =$EXCEL_STR."</tr>";
}











$today = date("Y-m-d H:i:s");

















header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = [KBO]운영현황_".$today.".xls" );
header( "Content-Description: PHP4 Generated Data" );


$EXCEL_STR .= "</tbody></table>";
echo $EXCEL_STR;

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";




 
?>