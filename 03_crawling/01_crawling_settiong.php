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
								<td>업로드된 엑셀파일 확인</td>
								<td align='right'><a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-success login-btn">엑셀파일 추가</a></td>
							</tr>
						</tbody>
					</table>
					
					</div>

					<div class="panel-body">

<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >#</th>
			<th data-field="s_0" data-sortable="true" >쇼핑몰</th>
			<th data-field="s_1" data-sortable="true" >sku</th>
			<th data-field="s_2" data-sortable="true" >정가</th>
			<th data-field="s_3" data-sortable="true" >상품명</th>
			<th data-field="s_4" data-sortable="true" >상태</th>


		</tr>
	</thead>
	<tbody>
	<?php
	/*
		$count_n = 0;
		
		
		
		$sql	 = "	
				select 
					b.admin_name,a.reg_date,a.file_name	,a.excel_state	,a.jem_idx,a.reg_datetime	
					from jira_excel_maintain as a
						Join admin_member as b
					on a.admin_idx = b.admin_idx	
				order by 	jem_idx DESC										
		
		
		
		";
		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
		while($info	 = mysqli_fetch_array($res)){
			$count_n+=1;
			if($info['excel_state']==0){
				$temp="<a href='xml.php?jem_idx=".$info['jem_idx']."'>지라생성</a>"	;


			}else{
				$temp="<font color='red'>".$info['reg_datetime']." </font>생성<br>
				<a href='print_jira.php?jem_idx=".$info['jem_idx']."'>공수 확인</a>"	;

			}




			echo "
				<tr>
					<td data-field='s_99' data-sortable='true' >".$count_n."</td>
					<td data-field='s_0' data-sortable='true' >".$info['admin_name']."</td>
					<td data-field='s_1' data-sortable='true' >".$info['reg_date']."</td>
					<td data-field='s_2' data-sortable='true' ><a href='xlsx/".$info['file_name']."'>다운로드</a></td>
					<td data-field='s_3' data-sortable='true' >".$temp."</td>
		
		
		
		
				</tr>		
			";
		}
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
				엑셀 파일 
			</div>
			<div class="modal-body">
			

			<script type="text/javascript">

function formSubmit(f) {

    // 업로드 할 수 있는 파일 확장자를 제한합니다.

	var extArray = new Array('xlsx');

	var path = document.getElementById("upfile").value;

	if(path == "") {

		alert("파일을 선택해 주세요.");

		return false;

	}

	

	var pos = path.indexOf(".");

	if(pos < 0) {

		alert("엑셀 파일, 양식에 맞게 업로드하시오");

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

		alert("엑셀 파일, 양식에 맞게 업로드하시오");

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





