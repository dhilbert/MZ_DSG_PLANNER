<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');



$jem_idx = isset($_GET['jem_idx']) ? $_GET['jem_idx'] : 3;
$Assignee = isset($_GET['Assignee']) ? $_GET['Assignee'] : 3;

?>


			<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
					<?php
					$array = array(
						array('#','공수확인')
					);
					breadcrumb($array);
					?>
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
					
						<?php echo $Assignee ?>님의 지라	종합

					</div>

					<div class="panel-body">










					

<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >#</th>
			<th data-field="s_0" data-sortable="true" >프로젝트</th>	
			<th data-field="s_1" data-sortable="true" >생성지라</th>						
			<th data-field="s_2" data-sortable="true" >공수</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$count_n = 0;
		
		$gp1_arry	=	array();
		
		$sql	 = "	
		select jes.Assignee,((SUM(Time_Spent)/3600)/8)/20.8  as workTime ,  dit.worker_team,Components,count(Time_Spent) as cnt

		
					
		from jira_excel_sub as jes
			JOIN division_info_temp as dit
		on jes.Assignee   = dit.worker_name
		where jem_idx = '".$jem_idx."'
		and 	jes.Assignee = '".$Assignee."'
	group by jes.Components
	order by workTime DESC

		
		
		
		";
		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
		while($info	 = mysqli_fetch_array($res)){
			array_push($gp1_arry,array($info['Components'],$info['workTime']));
			$count_n+=1;
			echo "
				<tr>
					<td data-field='s_99' data-sortable='true' >".$count_n."</td>
					<td data-field='s_0' data-sortable='true' >".$info['Components']."</td>
					<td data-field='s_1' data-sortable='true' >".$info['cnt']."</td>					
					<td data-field='s_2' data-sortable='true' >".round($info['workTime'],3)."</td>	
		
		
				</tr>		
			";
		}
	?>
	</tbody>
</table>



					</div>
				</div>
				</div>
				</div>
			<div class="row">

			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
					
						<?php echo $Assignee ?>님의 그래프

					</div>


					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						<script type="text/javascript">
						google.charts.load('current', {'packages':['corechart']});
						google.charts.setOnLoadCallback(drawChart);

						function drawChart() {

							var data = google.visualization.arrayToDataTable([
							['프로젝트', '공수'],
							<?php 
							
							
								$want_test = '';
								for($i = 0; $i < count($gp1_arry);$i++){
									$want_test =$want_test."['".$gp1_arry[$i][0]."',".$gp1_arry[$i][1]."],";
									


								}
								$want_test = substr($want_test, 0, -1);
								echo $want_test;

							?>



							]);

							var options = {
							title: '참여 프로젝트 비율'
							};

							var chart = new google.visualization.PieChart(document.getElementById('piechart'));

							chart.draw(data, options);
						}
					</script>
					
					



					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
									['일자','공수'],
									<?php 
										$gp2_text='';
										$sql	 = "	
										select ((SUM(Time_Spent)/3600)/8)/20.8  as workTime ,Due_Datetime
								
										
													
											from jira_excel_sub
											where jem_idx = '".$jem_idx."'
											and Assignee = '".$Assignee."'
										group by Due_Datetime
										order by Due_Datetime ASC
									
										
									
									
										";
										$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
										while($info	 = mysqli_fetch_array($res)){
											$gp2_text=$gp2_text."['".$info['Due_Datetime']."',".$info['workTime']."],";
									
										}
										$gp2_text = substr($gp2_text, 0, -1);
										echo $gp2_text;

									?>
								


								]);

var options = {
  title: '작업자 Performance',
  hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
  vAxis: {minValue: 0}
};

var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
chart.draw(data, options);
}
</script>
					
					
					















					














					<div class="panel-body">
					<div id="piechart" style="width: 100%;height: 500px;"></div>
			


					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
					
						<?php echo $Assignee ?>님의 그래프

					</div>
						<div id="chart_div" style="width: 100%;height: 500px;"></div>
  
					</div>
				</div>
			</div>


	
	</div>
</div>	<!--/.main-->


<!--Modal-->
<?php include_once('../contents_footer.php');


?>