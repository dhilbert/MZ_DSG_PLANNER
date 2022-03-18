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
						array('#','공수확인')
					);
					breadcrumb($array);
					?>
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
					
						공수 확인
					</div>

					<div class="panel-body">

<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >#</th>
			<th data-field="s_0" data-sortable="true" >팀</th>
			<th data-field="s_1" data-sortable="true" >작업자</th>			
			<th data-field="s_2" data-sortable="true" >공수</th>			
			<th data-field="s_3" data-sortable="true" >그래프확인</th>


		</tr>
	</thead>
	<tbody>
	<?php
		$count_n = 0;
		
		
		
		$sql	 = "	
		select jes.Assignee,((SUM(Time_Spent)/3600)/8)/20.8  as workTime ,  dit.worker_team

		
					
		from jira_excel_sub as jes
			JOIN division_info_temp as dit
		on jes.Assignee   = dit.worker_name
		where jem_idx = '".$jem_idx."'					
	group by jes.Assignee
	order by workTime DESC

		
		
		
		";
		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
		while($info	 = mysqli_fetch_array($res)){
			$count_n+=1;
			echo "
				<tr>
					<td data-field='s_99' data-sortable='true' >".$count_n."</td>
					<td data-field='s_0' data-sortable='true' >".$info['worker_team']."</td>
					<td data-field='s_1' data-sortable='true' >".$info['Assignee']."</td>
					<td data-field='s_2' data-sortable='true' >".round($info['workTime'],3)."</td>					
					<td data-field='s_3' data-sortable='true' ><a href='member_gp.php?jem_idx=".$jem_idx."&Assignee=".$info['Assignee']."'>그래프확인</a></td>
		
		
		
		
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





