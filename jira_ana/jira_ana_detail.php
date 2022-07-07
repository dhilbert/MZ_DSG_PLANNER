<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');

$admin_idxs = isset($_GET['admin_idx']) ? $_GET['admin_idx'] : $_GET['admin_idx'];

$admin_member_sql	 = "SELECT * from admin_member where admin_idx = ".$admin_idxs;
$admin_member_res	=  mysqli_query($real_sock,$admin_member_sql) or die(mysqli_error($real_sock));
$admin_member_info	 = mysqli_fetch_array($admin_member_res);

$years = isset($_GET['years']) ? $_GET['years'] : date('Y');
$months = isset($_GET['months']) ? $_GET['months'] : date('m');



$gp1_text = '';
$want_list = array();

$gp1_sql	 = "

		SELECT 
		a.work_kind,sum(a.work_timeSpentSeconds)/3600 as timewant,count(a.work_timeSpentSeconds) as cnt,
		
		(
			select AVG(b.work_timeSpentSeconds/3600) from jira_work_log as b where b.work_kind = a.work_kind 
		) as wks
		from jira_work_log as a
		where a.work_author = '".$admin_member_info['admin_name']."'
		and a.work_updated LIKE '".$years."-".$months."%'
		and a.work_kind is not null
		group by a.work_kind
		order by timewant DESC
		Limit 10
		
		";
$gp1_res	=  mysqli_query($real_sock,$gp1_sql) or die(mysqli_error($real_sock));
while($gp1_info	 = mysqli_fetch_array($gp1_res)){

	$worktime = $gp1_info['timewant']/$gp1_info['cnt'];
	$gp1_text = $gp1_text."['".$gp1_info['work_kind']."',".$worktime.",".$gp1_info['wks']."],";
	array_push($want_list,
				array($gp1_info['work_kind'], $gp1_info['timewant'], $gp1_info['cnt']) );



};
$gp1_text = substr($gp1_text, 0, -1);



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
							echo $admin_member_info['admin_name']."의 ".$years." 년 ".$months." 월 업무 분석";

						
						?>



						
					</div>

					<div class="panel-body">
						<form name="frm" role="form" method="get" action="">
						<?php 
						
						
						?>
						<table width='70%'>	
							<tr>
								<td><input class="form-control" name="years" value = '<?php echo $years?>' ></td>
								<td>년</td>
								</tr>								
							<tr>								
								<td><input class="form-control" name="months" value = '<?php echo $months?>'></td>							
								<td>월</td>
							</tr>								
							<tr>		
								<input class="form-control" type ='hidden' name="admin_idx" value = '<?php echo $admin_idxs?>'>
								<td colspan=2><input  type='submit' class="btn btn-success login-btn" type="submit" value="확인하기"></td>															
							</tr>								


						</table>						       	

				     </form>
					 <p><br<p><br<p><br> 위에꺼 나중에 selectbox로 수정 
					 <p><br<p><br<p><br<p><br><p>

					 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
							<script type="text/javascript">
							google.charts.load('current', {'packages':['bar']});
							google.charts.setOnLoadCallback(drawChart);

							function drawChart() {
								var data = google.visualization.arrayToDataTable([
								['작업시간(h)', '<?php echo $admin_member_info['admin_name']?>의 작업시간(h)',  '부문 평균 작업 시간'],
								<?php 

echo $gp1_text;
								
								
								?>
								
								
								
								
								
								]);

								var options = {
								chart: {
									title: '업무 시간 분석',
									subtitle: '',
								}
								};

								var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

								chart.draw(data, google.charts.Bar.convertOptions(options));
							}
							</script>
    <div id="columnchart_material" style="width: 100%; height: 700px;"></div>
  



	<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >작업명</th>
			<th data-field="s_98" data-sortable="true" >투입 시간(m)</th>
			<th data-field="s_97" data-sortable="true" >작업 횟수</th>						
			<th data-field="s_4" data-sortable="true" >1회 투입 시간(m)</th>			
			<th data-field="s_5" data-sortable="true" >작업 상세 보기(공사중)</th>			
			
			

		</tr>
	</thead>
	<tbody>




<?php



$gp1_sql	 = "

		SELECT 
		work_kind,sum(work_timeSpentSeconds)/60 as timewant,count(work_timeSpentSeconds) as cnt
		
		from jira_work_log 
		where work_author = '".$admin_member_info['admin_name']."'
		and work_updated LIKE '".$years."-".$months."%'
		and work_kind is not null
		group by work_kind
		order by timewant DESC
		
		
		";
$gp1_res	=  mysqli_query($real_sock,$gp1_sql) or die(mysqli_error($real_sock));
while($gp1_info	 = mysqli_fetch_array($gp1_res)){

	echo "
	<tr>
		<td data-field='s_99' data-sortable='true' >".$gp1_info['work_kind']."</td>
		<td data-field='s_98' data-sortable='true' >".round($gp1_info['timewant'],2)."</td>
		<td data-field='s_97' data-sortable='true' >".round($gp1_info['cnt'],2)."</td>
		<td data-field='s_4' data-sortable='true' >".round($gp1_info['timewant']/$gp1_info['cnt'],2)."</td>

		<td data-field='s_5' data-sortable='true' ><a href = '#'>확인하기</a></td>
		
		
		



	</tr>		
";



};








?>






					</div>
				</div>
			</div>



		 
  

	
	</div>
</div>	<!--/.main-->

	
<!--Modal-->
<?php include_once('../contents_footer.php');
/*

매일 아침 데일리 체크 
오전 9:30 ~9:40
짧게 진행 
어떤 업무를 얼마나 진행 
오늘 처리한 내용 / 어제 처리한 내용 
영근 와이어 프레임 세부 항목 진행 
쇼핑몰 플랫폼에 대한 부분은 정답이 나왔다. 
네이쳐 리퍼블릭 내용

운영과 다르게 일정과 결과가 나와야 한다. 
정해진 목표에 산출물이 나오는 형태
속도와 결과물에 대한 제출이 
모니터링및 관리는 작업에 대한 결과물 확인 => 영근 차장님 
일정은 저희가 잡아서 제출 ==> 알럿

우선순의 변경 
-이번 주 세부 항목 정리 
-와이어 프레임이 나와 기대만큼 퍼포먼스가 안 나온다. 
-퍼포먼스가 나와야 한다. 
-일정 기획 확인 
-일정 데일리 잡고, app은 하이브리드 / 네이티브 : 기능 +별도 개발 
-화면 그린다. 
-회의는 끊어서 진행, 마에스톤대로 진행 
-하루 일정에 대한 리뷰 및 전일 진행한 사항에 대한 체크 
-그후에 다음 작업은 모바일 작업 
-선이 넘고 있다. 모바일 쪽이 와이어프레임 잡아야 한다. 
-시간을 줄어야 한다. 
-본인 업무.......?


영근 차장님께 공유 
-설계서 리뷰하는 자리 후 순위로 리마인드 하면서 공유하는 자리 
-진행과정이 확인 할수 있도록 한다. 
-참석인원수는 정리: 김대연 차장님 
-단 오전에는 진행할수있도록 진행 
-일정과 퀄리티 양이 나와야 한다. 

1625446800
*/

?>
