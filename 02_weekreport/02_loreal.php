<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');

include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');


$List = array('In-Progress','닫힘','해결됨.','열기','Confirm','To be confirmed','진행 중');
$jiraapi_status = isset($_GET['jiraapi_status']) ? $_GET['jiraapi_status'] : $List;

?>








			<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
					<?php
					$array = array(
						array('#','직원 관리')
					);
					breadcrumb($array);
					?>
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<?php
							$request_uri = $_SERVER['REQUEST_URI'];
							$url =  $request_uri;						

							$temp_url = explode("02_loreal.php?",$url);
						
						
						?>
						<table width='100%'>
							<tr>	
							<td>Loreal 주간 보고서<td>
								<!--01_Loreal_down.php?<?php echo $temp_url[1] ; ?>-->
							<td><a href="#" class="btn btn-success login-btn" >            엑셀다운로드  (공사중)   </a>   <td>

							</tr>	
						</table>
					</div>

					<div class="panel-body">
					<form name="frm" role="form" method="get" action="02_loreal.php">
				
		
					
<div class="form-group">
<?php




	
$want_sql = '(';	

	for($i = 0 ; $i < count($List)   ; $i++){

		$temp_checked = "";
		if(in_array($List[$i],$jiraapi_status))	{
			$temp_checked = "checked";
			$want_sql = $want_sql."'".$List[$i]."',";

		}
		echo '<div class="checkbox">
			<label>
				<input type="checkbox" value="'.$List[$i].'"  name="jiraapi_status[]" '.$temp_checked.' >'.$List[$i].'
			</label>
		</div>
	';




	}
	$want_sql =  substr($want_sql, 0, -1);
	$want_sql = $want_sql.')';
	?>
</div>

<input  type='submit' class="btn btn-success login-btn" type="submit" value="검색">
					
				</form>










				



<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<?php	
				$num=0;
				$name="#";hd_thead_th($num,$name);$num+=1;
				$name=" 작업타입  ";hd_thead_th($num,$name);$num+=1;
				$name="상태";hd_thead_th($num,$name);$num+=1;
				$name="작업시작일";hd_thead_th($num,$name);$num+=1;
				$name="작업완료일";hd_thead_th($num,$name);$num+=1;
				$name="구성요소";hd_thead_th($num,$name);$num+=1;
				$name="메일제목";hd_thead_th($num,$name);$num+=1;
				$name="지라링크";hd_thead_th($num,$name);$num+=1;
				$name="기획자";hd_thead_th($num,$name);$num+=1;
				$name="작업자";hd_thead_th($num,$name);$num+=1;
				
				$name="진행상황";hd_thead_th($num,$name);$num+=1;
				$name="갯수";hd_thead_th($num,$name);$num+=1;
				$name="수정횟수";hd_thead_th($num,$name);$num+=1;
				$name="총작업시간(h)";hd_thead_th($num,$name);$num+=1;
				$name="비고";hd_thead_th($num,$name);$num+=1;
			?>
		


		</tr>
	</thead>
<tbody>
<?php




$total = 0;
$sql	 = "
SELECT a.customfield_12265,a.environment,a.jmi_key,a.jmi_summary,a.jmi_assignee_name,a.jmi_reporter_name,a.status,a.customfield_12271,a.customfield_12270,a.customfield_12268,a.customfield_12269,a.jmi_inx,

(select count(*) from jirasync_work where jmi_inx = a.jmi_inx and comment_kind='수정') as temp1,

(select sum(timeSpentSeconds) from jirasync_work where jmi_inx = a.jmi_inx ) as temp2,a.customfield_12262



FROM jirasync_main_info as a


where a.components =' 로레알_아르마니 '
and a.status in ".$want_sql."

";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	echo "<tr>";
		$num=0; $total += 1;
		$name = $total ;	hd_tbody_td($num,$name);$num+=1;
		
		$name = $info['customfield_12265'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $info['status'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $info['customfield_12268'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $info['customfield_12269'] ;	hd_tbody_td($num,$name);$num+=1;



		$sub_sql	 = "
			SELECT description
				FROM jirasync_fixversions		
			where jmi_inx ='".$info['jmi_inx']."'";
		$sub_res	=  mysqli_query($real_sock,$sub_sql) or die(mysqli_error($real_sock));

		$temp_name = '';
		while($sub_info	 = mysqli_fetch_array($sub_res)){
			$temp_name = $temp_name.$sub_info['description']."/";
		}
		$name = substr($temp_name, 0, -1);	hd_tbody_td($num,$name);$num+=1;
		
		$name = $info['environment'] ;	hd_tbody_td($num,$name);$num+=1;
		
		
		$name = "<a href='https://mz-dev.atlassian.net/browse/".$info['jmi_key']."'>".$info['jmi_summary']."</a>";	hd_tbody_td($num,$name);$num+=1;
		$name = $info['jmi_reporter_name'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $info['jmi_assignee_name'] ;	hd_tbody_td($num,$name);$num+=1;
		
		$name = $info['customfield_12271'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $info['customfield_12270'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $info['temp1'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = round($info['temp2']/3600,2) ;	hd_tbody_td($num,$name);$num+=1;
		$name = $info['customfield_12262'] ;	hd_tbody_td($num,$name);$num+=1;


		
	echo "</tr>";

};









?>



























</tbody>
</table>
























					</div>
				</div>
			</div>



		 
  

	
	</div>
</div>	<!--/.main-->

	
<!--Modal-->
<?php include_once('../contents_footer.php');


/*
고객명 : 고객명
메일 제목 : 
비고 : summary
개발 운선 순위 : 작업타입
진척률 : 개수
우선 순위 : 메일 제목


*/

	/*
	echo "<tr>"	;
		$num=0;
		$name = $total_num ;	hd_tbody_td($num,$name);$num+=1;
		$name = "<a href='https://mz-dev.atlassian.net/browse/".$temp_list['key']."'>".$temp_list['key']."</a>" ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['status']['name'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['summary'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['customfield_12271'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['reporter']['displayName'] ;	hd_tbody_td($num,$name);$num+=1;


		$name = $sub_ress['fields']['assignee']['displayName'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['customfield_12266'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['customfield_12267'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['customfield_12268'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['customfield_12269'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['customfield_12261'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['customfield_12262'] ;	hd_tbody_td($num,$name);$num+=1;

		$name = mb_substr($sub_ress['fields']['description'] ,0,30,'UTF-8');	hd_tbody_td($num,$name);$num+=1;
		



		
		
		$name = $sub_ress['fields']['customfield_12270'] ;	hd_tbody_td($num,$name);$num+=1;
		$name = $sub_ress['fields']['environment'] ;	hd_tbody_td($num,$name);$num+=1;

	*/	
	

	?>
