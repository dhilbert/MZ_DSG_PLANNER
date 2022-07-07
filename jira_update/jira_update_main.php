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
								<td>지라 동기화 내역</td>
								<td align='right'><a href="jira_update_main_step1.php" class="btn btn-success login-btn">지라 동기화</a></td>
							</tr>
						</tbody>
					</table>
					
					</div>

					<div class="panel-body">

<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >#</th>
			<th data-field="s_0" data-sortable="true" >지라시작일자</th>
			<th data-field="s_00" data-sortable="true" >동기화 일자</th>			
			<th data-field="s_1" data-sortable="true" >관리자</th>
			<th data-field="s_2" data-sortable="true" >관리자 직급</th>
			<th data-field="s_3" data-sortable="true" >관리자 팀</th>


		</tr>
	</thead>
	<tbody>
	<?php
		$count_n = 0;
		
		$now = date("Y-m-d H:i:s");

		echo $now;
		
		$sql	 = "	
				select 
				jui.jui_reg_date ,	jui.jui_updatedate , am.admin_name, am.admin_lv,di.division_name
					from jira_update_info as jui
						join admin_member as am
					on am.admin_idx = jui.admin_idx	
						JOIN 	division_info as di 
					on am.division_idx =	di.division_idx									



				
				order by jui.jui_idx DESC										
		
		
		
		";

		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
		while($info	 = mysqli_fetch_array($res)){
			$count_n+=1;
			
			echo "
				<tr>
					<td data-field='s_99' data-sortable='true' >".$count_n."</td>
					<td data-field='s_0' data-sortable='true' >".$info['jui_updatedate']."</td>
					<td data-field='s_00' data-sortable='true' >".$info['jui_reg_date']."</td>
					<td data-field='s_1' data-sortable='true' >".$info['admin_name']."</td>
					<td data-field='s_1' data-sortable='true' >".$info['admin_lv']."</td>
					<td data-field='s_1' data-sortable='true' >".$info['division_name']."</td>
		
		
		
		
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

  <!-- Modal -->
<div class="modal fade" id="myModal3" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				엑셀 파일 
			</div>
			<div class="modal-body">
			

			<script type="text/javascript">

function formSubmit(f) {

    // 업로드 할 수 있는 파일 확장자를 제한합니다.

	var extArray = new Array('hwp','xls','doc','xlsx','docx','pdf','jpg','gif','png','txt','ppt','pptx');

	var path = document.getElementById("upfile").value;

	if(path == "") {

		alert("파일을 선택해 주세요.");

		return false;

	}

	

	var pos = path.indexOf(".");

	if(pos < 0) {

		alert("확장자가 없는파일 입니다.");

		return false;

	}

	

	var ext = path.slice(path.indexOf(".") + 1).toLowerCase();

	var checkExt = false;

	for(var i = 0; i < extArray.length; i++) {

		if(ext == extArray[i]) {

			checkExt = true;

			break;

		}

	}



	if(checkExt == false) {

		alert("업로드 할 수 없는 파일 확장자 입니다.");

	    return false;

	}

	

	return true;

}

</script>



<form name="uploadForm" id="uploadForm" method="post" action="upload_process.php" 

      enctype="multipart/form-data" onsubmit="return formSubmit(this);">

    <div>

        <label for="upfile">첨부파일</label>

        <input type="file" name="upfile" id="upfile" />

    </div>

    


				


			</div>
			<div class="modal-footer">
			
				<input  type='submit' class="btn btn-success login-btn" type="submit" value="업로드">
				</form>

				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>





