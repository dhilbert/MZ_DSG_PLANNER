<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include_once('../contents_header.php');
include_once('../contents_profile.php');
//include_once('../contents_sidebar.php');

$week_num = isset($_GET['week_num']) ? $_GET['week_num'] : 3;
$week_array = array();
		$week_sql	 = "
				SELECT WEEKOFYEAR(jwl.updated) as weeknum,di.division_name,((sum(jwl.timeSpentSeconds)/3600)/8/20.8) AS timep
				FROM jirasync_work AS jwl
					JOIN admin_member AS am
					ON jwl.jmi_work_name = am.admin_name

					JOIN admin_division_info AS di
					ON di.division_idx= am.division_idx						
				
				WHERE 		WEEKOFYEAR(jwl.updated)=".$week_num."
				group by WEEKOFYEAR(jwl.updated),am.division_idx";
		$week_res	=  mysqli_query($real_sock,$week_sql) or die(mysqli_error($real_sock));
		while($week_info	 = mysqli_fetch_array($week_res)){
			$week_array[$week_info['division_name']] = $week_info['timep'];
		}


?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['파트별', 'Man/week'],
          ['기획 : <?php echo round($week_array['기획'],3) ;?>',<?php	echo $week_array['기획'] ;?>],
		  ['디자인 : <?php echo 	round( $week_array['디자인'],3) ;?>',<?php	echo $week_array['디자인'] ;?>],
		  ['퍼블 : <?php echo 	round($week_array['퍼블'],3) ;?>',<?php	echo $week_array['퍼블'] ;?>],
		  ['개발 : <?php echo 	round($week_array['개발'],3) ;?>',<?php	echo $week_array['개발'] ;?>]
        ]);

        var options = {
          title: "MZ's Man/Month"
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>










			<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
					<?php
					$array = array(
						array('#','주간공수')
					);
					breadcrumb($array);
					?>
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						프로젝트별 공수
					</div>		
					<div class="panel-body">

					<div id="piechart" style="width: 100%; height: 500px;"></div>




					</div>
				</div>
				</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['프로젝트','기획', '디자인', '퍼블', '개발'],
		<?php 
		
		$week_array = array();
		$week_sql	 = "	
		
SELECT jwls.checksss,sum(jwls.timeSpentSeconds)/3600/8/20.8 AS mamweek,
(
	SELECT SUM(jwl.timeSpentSeconds)/3600/8/20.8 AS mamweek
		FROM jirasync_work AS jwl
			JOIN admin_member AS am
		ON jwl.jmi_work_name = am.admin_name				
	WHERE WEEKOFYEAR(jwl.updated)=".$week_num."
	AND am.division_idx = 1
	AND jwl.checksss=jwls.checksss
) AS team1,		(
	SELECT SUM(jwl.timeSpentSeconds)/3600/8/20.8 AS mamweek
		FROM jirasync_work AS jwl
			JOIN admin_member AS am
		ON jwl.jmi_work_name = am.admin_name				
	WHERE WEEKOFYEAR(jwl.updated)=".$week_num."
	AND am.division_idx = 2
	AND jwl.checksss=jwls.checksss
)AS team2,		(
	SELECT SUM(jwl.timeSpentSeconds)/3600/8/20.8 AS mamweek
		FROM jirasync_work AS jwl
			JOIN admin_member AS am
		ON jwl.jmi_work_name = am.admin_name				
	WHERE WEEKOFYEAR(jwl.updated)=".$week_num."
	AND am.division_idx = 3
	AND jwl.checksss=jwls.checksss
)AS team3,		(
	SELECT SUM(jwl.timeSpentSeconds)/3600/8/20.8 AS mamweek
		FROM jirasync_work AS jwl
			JOIN admin_member AS am
		ON jwl.jmi_work_name = am.admin_name				
	WHERE WEEKOFYEAR(jwl.updated)=".$week_num."
	AND am.division_idx = 4
	AND jwl.checksss=jwls.checksss
) AS team4


FROM jirasync_work AS jwls
WHERE WEEKOFYEAR(jwls.updated)=".$week_num."
GROUP BY jwls.checksss;";

$want_text = '';
$week_res	=  mysqli_query($real_sock,$week_sql) or die(mysqli_error($real_sock));
while($week_info	 = mysqli_fetch_array($week_res)){
	$total_temp = isset($week_info['mamweek'])? $week_info['mamweek'] : 0;
	$time_temp_1 = isset($week_info['team1'])? $week_info['team1'] : 0;
	$time_temp_2 = isset($week_info['team2'])? $week_info['team2'] : 0;
	$time_temp_3 = isset($week_info['team3'])? $week_info['team3'] : 0;
	$time_temp_4 = isset($week_info['team4'])? $week_info['team4'] : 0;
	echo "['".$week_info['checksss']."',".$time_temp_1.",".$time_temp_2.",".$time_temp_3.",".$time_temp_4."   ],";
	$want_text = $want_text."
			<tr>
				<td data-field='s_0' data-sortable='true' >".$week_info['checksss']."</td>
				<td data-field='s_1' data-sortable='true' >".round($total_temp,3)."</td>
				<td data-field='s_2' data-sortable='true' >".round($time_temp_1,3)."</td>
				<td data-field='s_3' data-sortable='true' >".round($time_temp_2,3)."</td>
				<td data-field='s_4' data-sortable='true' >".round($time_temp_3,3)."</td>
				<td data-field='s_5' data-sortable='true' >".round($time_temp_4,3)."</td>
				
				
				
				



			</tr>		
";


}

		
		
		
		
		
		?>		


        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  





			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						프로젝트 팀별 공수
					</div>		
					<div class="panel-body">
					<div id="barchart_material" style="width: 100%; height: 900px;"></div>


					<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
							<tr>
								<th data-field="s_0" data-sortable="true" >프로젝트</th>
								<th data-field="s_1" data-sortable="true" >총합</th>
								<th data-field="s_2" data-sortable="true" >기획</th>						
								<th data-field="s_3" data-sortable="true" >디자인</th>
								<th data-field="s_4" data-sortable="true" >퍼블</th>
								<th data-field="s_5" data-sortable="true" >개발</th>			
								
								

							</tr>
						</thead>
						<tbody>
	  					<?php
						  echo $want_text; 
						  
						  ?>


						</tbody>
</table>




					</div>
				</div>
			</div>
	









<?php

			$member_name = array();
			$member_array = array(array());
			$member_sql	 = "	
				SELECT jmi_work_name,comment_kind,sum(timeSpentSeconds)/3600/8/20.8 AS mamweek
						FROM jirasync_work 
				WHERE WEEKOFYEAR(updated)=".$week_num."
				GROUP BY jmi_work_name,comment_kind
				order by mamweek ASC
				
				;";
			
			$member_res	=  mysqli_query($real_sock,$member_sql) or die(mysqli_error($real_sock));
			while($member_info	 = mysqli_fetch_array($member_res)){
				
				$member_array[$member_info['jmi_work_name']][$member_info['comment_kind']] = $member_info['mamweek'];
				if(!in_array($member_info['jmi_work_name'],$member_name)){
					array_push($member_name,$member_info['jmi_work_name']);
				}


			}



?>









			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						개인별 공수
					</div>		
					<div class="panel-body">

					<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
		var data = google.visualization.arrayToDataTable([
        ['성명',<?php
				$comment_kind_text = '';
				$comment_kind_array = array();
				$comment_kind_sql	 = "	
					SELECT comment_kind
							FROM jirasync_work 
					WHERE WEEKOFYEAR(updated)=".$week_num."
					GROUP BY comment_kind;";
				
				$comment_kind_res	=  mysqli_query($real_sock,$comment_kind_sql) or die(mysqli_error($real_sock));
				while($comment_kind_info	 = mysqli_fetch_array($comment_kind_res)){
					array_push($comment_kind_array,$comment_kind_info['comment_kind'] );
					$comment_kind_text = $comment_kind_text."'".$comment_kind_info['comment_kind']."',";
					
				}
				$comment_kind_text =substr($comment_kind_text , 0, -1);
				echo $comment_kind_text ;
				
				
				?>, { role: 'annotation' } ],
		<?php
			$want_text = '';
			
			for($i = 0 ; $i < count($member_name);$i++){
				$totals = 0;
				$temp_text="";

				for($j = 0 ; $j < count($comment_kind_array);$j++){
					$temp =   isset($member_array[$member_name[$i]][$comment_kind_array[$j]]) ? $member_array[$member_name[$i]][$comment_kind_array[$j]] : 0;
					
					$totals +=	$temp;
					
				
					
					$temp_text = $temp_text.$temp.",";
					
				}


				$want_text = $want_text."['".$member_name[$i]."(".round($totals,2).")',";		
				$temp_text = substr($temp_text, 0, -1);
				$want_text = $want_text.$temp_text.",''],";
				
			}
			$want_text =substr($want_text , 0, -1);
			echo $want_text;
		
		?>]);

      
      var view = new google.visualization.DataView(data);
     

	var options = {
		
        legend: { position: 'top', maxLines: 5 },
    
        isStacked: true
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="barchart_values" style="width:100%; height: 900px;"></div>

					</div>
				</div>
			</div>
			</div>				



			</div>				



	
	</div>
</div>	<!--/.main-->

	
<!--Modal-->
<?php include_once('../contents_footer.php');


?>





