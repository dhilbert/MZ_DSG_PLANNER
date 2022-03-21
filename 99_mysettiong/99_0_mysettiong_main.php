<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');

include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');
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
								<td>템플릿 관리</td>
								<td align='right'>
						 <a href="#" data-toggle="modal" data-target="#99_0_mysettiong_main_0" class="btn btn-success login-btn">템플릿 추가</a></td>
							</tr>
						</tbody>
					</table>
					
					</div>

					<div class="panel-body">

<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_0" data-sortable="true" >#			</th>
			<th data-field="s_1" data-sortable="true" >업무 유형	 </th>
			<th data-field="s_2" data-sortable="true" >업체	 </th>
			<th data-field="s_3" data-sortable="true" >컴포너트			 </th>			
			<th data-field="s_4" data-sortable="true" >템플릿 정보 	  </th>			
			<th data-field="s_5" data-sortable="true" >등록자		  </th>
			<th data-field="s_6" data-sortable="true" >등록일         </th>
			<th data-field="s_7" data-sortable="true" >삭제</th>

		</tr>
	</thead>
	<tbody>
	<?php
		$count_n = 0;
		
		$now = date("Y-m-d H:i:s");

		$sql	 = "	
				select d.company_name,c.jira_comp_name,b.admin_name,a.indi_tem_title,a.indi_tem_maintext,a.indi_tem_regdate,a.indi_tem_idx


				from individual_template_main as a 
					join admin_member as b
				on a.admin_idx = b.admin_idx
					join jiraapi_component as c 
				on a.jira_comp_idx = c.jira_comp_idx
					join admin_company_info as d	
				on a.company_idx = d.company_idx	";

		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
		while($info	 = mysqli_fetch_array($res)){
			$count_n+=1;
			
			echo "
				<tr>
					<td data-field='s_0' data-sortable='true' >".$count_n."</td>
					<td data-field='s_1' data-sortable='true' >".$info['indi_tem_title']."</td>
					<td data-field='s_2' data-sortable='true' >".$info['company_name']."</td>
					<td data-field='s_3' data-sortable='true' >".$info['jira_comp_name']."</td>
					<td data-field='s_4' data-sortable='true' >".str_replace("\r\n", "<br>", $info['indi_tem_maintext'])."</td>
					<td data-field='s_5' data-sortable='true' >".$info['admin_name']."</td>
					<td data-field='s_6' data-sortable='true' >".$info['indi_tem_regdate']."</td>
					<td data-field='s_7' data-sortable='true' ><a href = '99_0_mysettiong_main_del_proc.php?indi_tem_idx=".$info['indi_tem_idx']."' class='btn btn-danger login-btn'>삭제</a></td>
		
		
		
		
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




<div class="modal fade" id="99_0_mysettiong_main_0" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<strong>템플릿 추가</strong>
			</div>
			<div class="modal-body">
				
					<div class="form-group">

					<form name="frm" role="form" method="get" action="99_0_mysettiong_main_proc.php">

						<label>업무 유형</label>							
							<input class='form-control'		name = 'indi_tem_title'	style='background-color:'><p><br>
						<label>업체</label>							
							<select class="form-control" name = 'jira_comp_idx'>
							<?php
								$jiraapi_component_sql	 = "select * from jiraapi_component where jira_comp_status =1;";
								$jiraapi_component_res	=  mysqli_query($real_sock,$jiraapi_component_sql) or die(mysqli_error($real_sock));
								while($jiraapi_component_info	 = mysqli_fetch_array($jiraapi_component_res)){
										echo "<option value = '".$jiraapi_component_info['jira_comp_idx']."'>".$jiraapi_component_info['jira_comp_name']."</option>";
								};
							?>
							</select>
						<label>회사 선택</label>
						<select class="form-control" name = 'company_idx'>
							<?php
								$admin_company_info_sql	 = "select * from admin_company_info;";
								$admin_company_info_res	=  mysqli_query($real_sock,$admin_company_info_sql) or die(mysqli_error($real_sock));
								while($admin_company_info_info	 = mysqli_fetch_array($admin_company_info_res)){
										echo "<option value = '".$admin_company_info_info['company_idx']."'>".$admin_company_info_info['company_name']."</option>";
								};
							?>
							</select>
							<div class="form-group">
									<label>템플릿 입력</label>
									<textarea class="form-control" rows="4" name ='indi_tem_maintext'></textarea>
							</div>








						</div>
						<p><br>
					














				


			</div>
			<div class="modal-footer">
			<input  type='submit' class="btn btn-success login-btn" type="submit" value="템플릿 등록">
				</form>


				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
