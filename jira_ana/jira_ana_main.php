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
						공수 확인(4/1부터)
					</div>

					<div class="panel-body">



<?php 
	






?>
<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >NO</th>
			<th data-field="s_98" data-sortable="true" >이름</th>
			<th data-field="s_97" data-sortable="true" >팀</th>						
			<th data-field="s_4" data-sortable="true" >확인</th>			
			
			

		</tr>
	</thead>
	<tbody>
	<?php

	
		$n_check 	=		0;
		$week_sql	 = "
				SELECT 
					a.admin_name,b.division_name,a.admin_idx
				
				from 	admin_member as a 
					JOIN division_info as b 
				on a.division_idx = b.division_idx		
				where admin_state = 1
				and admin_lv <100

				
				";


		$week_sql	 = "
				SELECT a.admin_name,b.division_name,a.admin_idx
					
				
				from 	admin_member as a 
					JOIN admin_division_info as b 
				on a.division_idx = b.division_idx		
				
				
				";

		$week_res	=  mysqli_query($real_sock,$week_sql) or die(mysqli_error($real_sock));
		while($week_info	 = mysqli_fetch_array($week_res)){
			$n_check 	+=1;
			echo "
				<tr>
					<td data-field='s_99' data-sortable='true' >".$n_check."</td>
					<td data-field='s_98' data-sortable='true' >".$week_info['admin_name']."</td>
					<td data-field='s_97' data-sortable='true' >".$week_info['division_name']."</td>

					<td data-field='s_4' data-sortable='true' ><a href = '/MZ_DSG_PLANNER/jira_ana/jira_ana_detali.php?admin_idx=".$week_info['admin_idx']."'>확인하기</a></td>
					
					
					
		
		
		
				</tr>		
			";
		}


		
		






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





