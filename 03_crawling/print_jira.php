<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');

$jem_idx = isset($_GET['jem_idx']) ? $_GET['jem_idx'] : 3;

?>


			<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
					<?php
					$array = array(
						array('#','공수 확인')
					);
					breadcrumb($array);
					?>
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
					<table width = '100%'>
						<tbody >
							<tr>
								<td>공수확인</td>
								<td align='right'>
								
								
								<a href="excel.php?jem_idx=<?php echo $jem_idx ?>" class="btn btn-success login-btn">엑셀 파일 다운로드</a>
								
								
								
								</td>
							</tr>
						</tbody>
					</table>
					</div>		
					<div class="panel-body">

<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >#</th>
			<th data-field="s_0" data-sortable="true" >기간</th>
			<th data-field="s_1" data-sortable="true" >마지막 수정일</th>			
			<th data-field="s_2" data-sortable="true" >작업 시작일</th>			
			<th data-field="s_3" data-sortable="true" >작업 완료일</th>						
			<th data-field="s_4" data-sortable="true" >프로젝트명</th>			
			<th data-field="s_5" data-sortable="true" >팀분류</th>
			<th data-field="s_6" data-sortable="true" >작업자</th>
			<th data-field="s_7" data-sortable="true" >공수</th>
			<th data-field="s_8" data-sortable="true" >확인</th>			


		</tr>
	</thead>
	<tbody>
	<?php
		$count_n = 0;
		/*
		$today_num = date('w'); //요일을 숫자로 표시 일:0, 월:1, 화:2, 수:3, 목:4, 금:5, 토:6
echo "오늘 :".$today_num; // 오늘이 금요일이라면 => 결과 : 오늘 : 5
echo "월 :".date('Y-m-d',strtotime('-'.($today_num - 1).'days')); // 오늘이 금요일이라면 이번주 월요일의 날짜가 출력되겠지..
echo "금 :".date('Y-m-d',strtotime('+'.(5 -$today_num).'days')); // 오늘이 금요일이라면.. 이건 금요일의 날짜가 출력이 되겠지..
		*/
		$sql	 = "	
		select jes.Assignee,jes.Components,WEEKOFYEAR(jes.Due_Datetime) as weeknum,((SUM(Time_Spent)/3600)/8)/20.8  as workTime ,  dit.worker_team,

		jes.Start_Datess,
		jes.Due_Datetime,
		jes.Updated
					
		from jira_excel_sub as jes
			JOIN division_info_temp as dit
		on jes.Assignee   = dit.worker_name
		where jem_idx = '".$jem_idx."'					
	group by jes.Assignee,jes.Components,WEEKOFYEAR(jes.Due_Datetime)
	ORDER BY WEEKOFYEAR(jes.Due_Datetime) DESC";
		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
		while($info	 = mysqli_fetch_array($res)){
			$count_n +=1;
			

			echo "
				<tr>
					<td data-field='s_99' data-sortable='true' >".$count_n."</td>
					<td data-field='s_0' data-sortable='true' >".$info['weeknum']."</td>
					<td data-field='s_1' data-sortable='true' >".$info['Updated']."</td>
					<td data-field='s_2' data-sortable='true' >".$info['Start_Datess']."</td>										
					<td data-field='s_3' data-sortable='true' >".$info['Due_Datetime']."</td>															
					<td data-field='s_4' data-sortable='true' >".$info['Components']."</td>
					<td data-field='s_5' data-sortable='true' >".$info['worker_team']."</td>				
					<td data-field='s_6' data-sortable='true' >".$info['Assignee']."</td>				
					<td data-field='s_7' data-sortable='true' >".round($info['workTime'],3)."</td>				
					<td data-field='s_8' data-sortable='true' >
					<a href = 'jira_com.php?weeknum=".$info['weeknum']."&jem_idx=".$jem_idx."&Assignee=".$info['Assignee']."&Components=".$info['Components']."'>확인하기</a>
					
		
		
		
				</tr>		
			";
			
		}
	?>
	</tbody>
<table>



					</div>
				</div>
			</div>



		 
  

	
	</div>
</div>	<!--/.main-->

	
<!--Modal-->
<?php include_once('../contents_footer.php');


?>





