<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');

include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');




$sql	 = "select * from jira_update_info where admin_idx = ".$admin_idx." order by jui_idx DESC LIMIT 1;";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$jira_update_info_info	 = mysqli_fetch_array($res);

$username = 'yoonhd@mz.co.kr';
$password = 'K80gueIJUonHEGUJHQ4y44E6';
$url = "https://mz-dev.atlassian.net/rest/api/latest/search?jql=updated>=".$jira_update_info_info['jui_updatedate']."%20and%20timespent>0%20and%20reporter%20in%20(".$jira_id.")";




$curl = curl_init();
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

//$result = curl_exec($curl);
$ress=json_decode(curl_exec($curl),true);











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
					

					<table width = '100%'>
						<tbody >
							<tr>
								<td>지라 동기화할 내역 확인</td>
								<td align='right'><a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-success login-btn">동기화</a></td>
							</tr>
						</tbody>
					</table>




					
					</div>

					<div class="panel-body">
					<?php
					echo "<br>";
					
					
					echo "최근 동기화 일자 : <font color = 'red'> ".$jira_update_info_info['jui_reg_date']."</font><br>";
					echo "마지막 동기화 지라 일자 : <font color = 'red'> ".$jira_update_info_info['jui_updatedate']."</font><br>";
					echo "총 동기화할 데이터 :<font color = 'red'>".$ress['total']."</font>개 ";

						$want_text="";
						$count_n = 0;
						
											 
					
					?>
					<br><font color='red'>※ 검색 결과는 jira 내규상 50개까지 만 확인 가능 </font>
					<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
					<thead>
						<tr>
								<th data-field="s_99" data-sortable="true" >#</th>
								<th data-field="s_0" data-sortable="true" >지라키</th>
								<th data-field="s_00" data-sortable="true" >요약</th>
								<th data-field="s_000" data-sortable="true" >프로젝트</th>								
								<th data-field="s_1" data-sortable="true" >priority</th>
								
								<th data-field="s_22" data-sortable="true" >보고자</th>								
								<th data-field="s_3" data-sortable="true" >상태</th>
								<th data-field="s_4" data-sortable="true" >공수</th>
								<th data-field="s_5" data-sortable="true" >업데이트 일자</th>


							</tr>
						</thead>
						<tbody>
						<?php

for($i = 0 ; $i <count($ress['issues']); $i++){
	$temps_list = $ress['issues'][$i];
	$count_n += 1;		
	$time_temp_1 = isset($temps_list['fields']['components'][0]['name'])? $temps_list['fields']['components'][0]['name'] : "네이처리퍼블릭";
	

	$want_text=$want_text."
		<tr>
			<td data-field='s_99' data-sortable='true' >".$count_n."</td>
			<td data-field='s_0' data-sortable='true' ><a href='https://mz-dev.atlassian.net/browse/".$temps_list['key']."'>".$temps_list['key']."</a></td>
			<td data-field='s_00' data-sortable='true' >".$temps_list['fields']['summary']."</td>
			<td data-field='s_000' data-sortable='true' >".$time_temp_1."</td>
			<td data-field='s_1' data-sortable='true' >".$temps_list['fields']['priority']['name']."</td>
			<td data-field='s_22' data-sortable='true' >".$temps_list['fields']['reporter']['displayName']."</td>
			<td data-field='s_3' data-sortable='true' >".$temps_list['fields']['status']['name']."</td>
			<td data-field='s_4' data-sortable='true' >".$temps_list['fields']['timespent']."</td>
			<td data-field='s_5' data-sortable='true' >".$temps_list['fields']['updated']."</td>
			


			

		</tr>		
	";
}

 






							echo $want_text;







						
							
							/*
					
								echo "
									<tr>
										<td data-field='s_99' data-sortable='true' >".$count_n."</td>
										<td data-field='s_0' data-sortable='true' >".$info['jui_updatedate']."</td>
										<td data-field='s_1' data-sortable='true' >".$info['admin_name']."</td>
										<td data-field='s_1' data-sortable='true' >".$info['admin_lv']."</td>
										<td data-field='s_1' data-sortable='true' >".$info['division_name']."</td>
							
							
							
							
									</tr>		
								";
							*/
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

  <!-- Modal -->
<div class="modal fade" id="myModal3" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				동기화
			</div>
			<div class="modal-body">
			




	<?php
	
	echo "총 <font color = 'red'>".$ress['total']."</font>개의 지라 데이터를 동기화 하겠습니까? ";
	?>


				


			</div>
			<div class="modal-footer">
			
				<a href="jira_update_main_step2_proc.php" class="btn btn-success login-btn" >동기화</a>
				

				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>





