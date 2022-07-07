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
						주간 공수 확인(4/1부터)
					</div>

					<div class="panel-body">



<?php 
$project_name=array();
$project_sql	 = "	SELECT comment_kind FROM jirasync_work GROUP BY comment_kind;";
$project_res	=  mysqli_query($real_sock,$project_sql) or die(mysqli_error($real_sock));
while($project_info	 = mysqli_fetch_array($project_res)){
	array_push($project_name,$project_info['comment_kind']);
}











function hd_week7after($temp_date){
	
	$mydate = date("Y-m-d", strtotime("+7 day", strtotime($temp_date)));           
	return $mydate;
}


function hd_week7b($temp_date){
	
	$mydate = date("Y-m-d", strtotime("-7 day", strtotime($temp_date)));           
	return $mydate;
}


function weekOfMonth($vdate) {
	$mydate = strtotime("monday this week, +2 days", strtotime($vdate)); //수요일을 기준으로 "wednesday this week"으로 해도 될 듯...
	$month1 = date("m", $mydate);
	$rvalue = (int)$month1 ."월 "; //리턴값
	$firstOfMonth = strtotime(date("Y-m-01", $mydate)); //그달의 첫날
	//일요일을 한주의 시작으로 간주하는 경우 만일 그 달의 시작일이 일요일이면 이전 주(달)로 계산되기 때문에 임시로 하루를 증가시킴. (심지어 2017-01-01(일)은 2016년 12월로 계산되기도 함)
	if(date("w",$firstOfMonth)==0) $firstOfMonth = strtotime("tomorrow",$firstOfMonth);
	$weekOfMonth = intval(date("W",$mydate)) - intval(date("W",$firstOfMonth)) + 1; //전체주수-그달 첫날의 주수 +1
	// 그달의 시작일이 수요일 이후 즉, 목금토일 때는 한주를 줄임
	if(date("w",$firstOfMonth) > 3) $weekOfMonth -= 1;
	$rvalue .= $weekOfMonth. "주";
	return $rvalue;
	}
	
	






?><p>
※ 2021-03-28(일) : 12주<p>
※ 2021-03-29(월) : 13주<p>

<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
		<tr>
			<th data-field="s_99" data-sortable="true" >월 주차</th>
			<th data-field="s_98" data-sortable="true" >시작일</th>
			<th data-field="s_97" data-sortable="true" >마지막일</th>						
			<th data-field="s_0" data-sortable="true" >공수 합계</th>
			<th data-field="s_1" data-sortable="true" >기획</th>
			<th data-field="s_2" data-sortable="true" >디자인</th>
			<th data-field="s_3" data-sortable="true" >개발</th>
			<th data-field="s_4" data-sortable="true" >퍼블</th>			
			
			

		</tr>
	</thead>
	<tbody>
	<?php

		
		$firstDate = "2021-04-01";
		$secondDate = date("Y-m-d");
		$now = date("Y-m-d");

		$check1 = hd_week_ft($firstDate);
		$start_cehck = $check1[0];
		$check2 = hd_week_ft($secondDate);
		$end_check = $check2[0];
		
		
		
		
		

		$week_array = array(array());
		$week_sql	 = "
		SELECT 
		WEEKOFYEAR(jwl.updated) as weeknum,
		di.division_name,
		((sum(jwl.timeSpentSeconds)/3600)/8/20.8) AS timep
		FROM jirasync_work AS jwl
			JOIN admin_member AS am
		ON jwl.jmi_work_name = am.admin_name
			JOIN admin_division_info AS di
		ON di.division_idx= am.division_idx	
	WHERE 		WEEKOFYEAR(jwl.updated)>0
	group by WEEKOFYEAR(jwl.updated),am.division_idx";
		$week_res	=  mysqli_query($real_sock,$week_sql) or die(mysqli_error($real_sock));
		while($week_info	 = mysqli_fetch_array($week_res)){
			$week_array[$week_info['weeknum']][$week_info['division_name']] = $week_info['timep'];
		}


		
		

	

		while($end_check>$start_cehck){
			
			
			$want_list = hd_week_ft($secondDate);
			$temp0 = isset($week_array[$want_list[0]]['기획']) ? $week_array[$want_list[0]]['기획'] : 0;
			$temp1 = isset($week_array[$want_list[0]]['디자인']) ? $week_array[$want_list[0]]['디자인'] : 0;
			$temp2 = isset($week_array[$want_list[0]]['퍼블']) ? $week_array[$want_list[0]]['퍼블'] : 0;
			$temp3 = isset($week_array[$want_list[0]]['개발']) ? $week_array[$want_list[0]]['개발'] : 0;

			$total_score = $temp0+$temp1+$temp2+$temp3;

			
			echo "
				<tr>
					<td data-field='s_99' data-sortable='true' ><a href='detail_week.php?week_num=".$want_list[0]."'>".weekOfMonth($secondDate)."</a></td>
					<td data-field='s_98' data-sortable='true' >".$want_list[1]."</td>
					<td data-field='s_97' data-sortable='true' >".$want_list[2]."</td>

					<td data-field='s_0' data-sortable='true' >".round($total_score,3) ."</td>
					<td data-field='s_1' data-sortable='true' >".round($temp0,3)."</td>
					<td data-field='s_2' data-sortable='true' >".round($temp1,3)."</td>
					<td data-field='s_3' data-sortable='true' >".round($temp2,3)."</td>
					<td data-field='s_4' data-sortable='true' >".round($temp3,3)."</td>
					
					
					
		
		
		
				</tr>		
			";

			$secondDate = hd_week7b($secondDate);
			$start_cehck+=1;
		};









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





