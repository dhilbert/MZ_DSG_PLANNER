<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');
$weeknum = isset($_GET['weeknum']) ? $_GET['weeknum'] : 3;
$jem_idx = isset($_GET['jem_idx']) ? $_GET['jem_idx'] : 3;
$Assignee = isset($_GET['Assignee']) ? $_GET['Assignee'] : 3;
$Components = isset($_GET['Components']) ? $_GET['Components'] : 3;

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
					공수 확인</div>

					<div class="panel-body">










<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			
					
					<th data-field="s_0" data-sortable="true" >Type</th>
					<th data-field="s_1" data-sortable="true" >Key</th>
					<th data-field="s_2" data-sortable="true" >Summary</th>
					<th data-field="s_3" data-sortable="true" >Assignee</th>
					<th data-field="s_4" data-sortable="true" >Priority</th>

					<th data-field="s_5" data-sortable="true" >Updated</th>
					<th data-field="s_6" data-sortable="true" >Time Spent</th>
					<th data-field="s_61" data-sortable="true" >Time Spent(hour)</th>
					<th data-field="s_7" data-sortable="true" >Due-Datetime</th>
					<th data-field="s_8" data-sortable="true" >Start Date</th>
					<th data-field="s_9" data-sortable="true" >Start date</th>

					<th data-field="s_10" data-sortable="true" >Resolution</th>
					<th data-field="s_11" data-sortable="true" >Components</th>
					<th data-field="s_12" data-sortable="true" >Description</th>


		</tr>
	</thead>
	<tbody>
	<?php


		if($weeknum!=Null){
			$sql	 = "
			select * from jira_excel_sub
		 	where 	WEEKOFYEAR(Due_Datetime) ='".$weeknum."'
			 and jem_idx ='".$jem_idx."'
			 and Assignee ='".$Assignee."'
			 and Components ='".$Components."'			 			 
			
		
		";}
		else{
			$sql	 = "
			select * from jira_excel_sub
		 	where 	WEEKOFYEAR(Due_Datetime) is null
			 and jem_idx ='".$jem_idx."'
			 and Assignee ='".$Assignee."'
			 and Components ='".$Components."'			 			 
			
		
		";



		}

			
		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
		while($info	 = mysqli_fetch_array($res)){
		
			

			echo "	<tr>
					
					
					<td data-field='s_0' data-sortable='true' >".$info['Issue_Type']."</td>
					<td data-field='s_1' data-sortable='true' ><a href = 'https://mz-dev.atlassian.net/browse/".$info['jiraKey']."'>".$info['jiraKey']."</a></td>
					<td data-field='s_2' data-sortable='true' >".$info['Summary']."</td>
					<td data-field='s_3' data-sortable='true' >".$info['Assignee']."</td>
					<td data-field='s_4' data-sortable='true' >".$info['Priority']."</td>

					<td data-field='s_5' data-sortable='true' >".$info['Updated']."</td>
					<td data-field='s_6' data-sortable='true' >".$info['Time_Spent']."</td>
					<td data-field='s_61' data-sortable='true' >".($info['Time_Spent']/3600)."</td>					
					<td data-field='s_7' data-sortable='true' >".$info['Due_Datetime']."</td>
					<td data-field='s_8' data-sortable='true' >".$info['Start_Datess']."</td>
					<td data-field='s_9' data-sortable='true' >".$info['Resolution']."</td>

					<td data-field='s_10' data-sortable='true' >".$info['Start_dates']."</td>
					<td data-field='s_11' data-sortable='true' >".$info['Components']."</td>
					<td data-field='s_12' data-sortable='true' >".substr($info['Descriptions'],0,20)."....
					<details>
					<summary>(더보기)</summary>
    <ul>
        	
					".$info['Descriptions']."
    </ul>
</details>

					
				</td>
					
			
		
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




