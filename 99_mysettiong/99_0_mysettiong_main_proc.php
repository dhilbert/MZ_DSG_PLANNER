<?php
	include_once('../lib/session.php');
	include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
	function hd_check_val($check_val,$text){
		if($check_val==Null) {
						echo "<script>
							alert('".$text."');
							parent.location.replace('/MZ_DSG_PLANNER/');
						</script> ";
		}
	}
	

	$indi_tem_title		= isset($_POST['indi_tem_title'])		? $_POST['indi_tem_title'] : 3;
	$jira_comp_idx 	= isset($_POST['jira_comp_idx'])	? $_POST['jira_comp_idx'] : 3;
	$company_idx 	= isset($_POST['company_idx'])	? $_POST['company_idx'] : 3;
	
	$indi_tem_maintext = isset($_POST['content']) ? $_POST['content'] : 3;


	$crawling_work = isset($_POST['crawling_work']) ? $_POST['crawling_work'] : "제목 없음";
	
	
	if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
	
		$file = $_FILES['upfile'];
	
		$upload_directory = 'ref/';
		
		$ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
	
		$allowed_extensions = explode(',', $ext_str);
	
		
	
		$max_file_size = 5242880;
	
		$ext = substr($file['name'], strrpos($file['name'], '.') + 1);
	
		
	
		// 확장자 체크
	
		if(!in_array($ext, $allowed_extensions)) {
	
			echo "엑셀파일만 확인 가능";
	
		}
	
	
		$path = $_FILES['upfile']['name'];
		move_uploaded_file($file['tmp_name'], $upload_directory.$path);
		
	} else {
	
		echo "<h3>파일이 업로드 되지 않았습니다.</h3>";
	
		echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
	
	}
	
	
	$crawling_flie_name = $path;
	
// $crawling_flie_name;






















	
	if( strlen($indi_tem_title)==0) {
		echo "<script>
				alert('유형은 최소 1자 이상 ');
				history.back();

			</script> ";
	}
	if( strlen($indi_tem_maintext)==0) {
		echo "<script>
				alert('템플릿은 최소 1자 이상 ');
				history.back();

			</script> ";
	}
	else{

		$indi_tem_path = "/MZ_DSG_PLANNER/99_mysettiong/ref/".$crawling_flie_name;




	$sql	= "
		insert individual_template_main set 
		indi_tem_status		= 1,
		indi_tem_title		= '".$indi_tem_title."',
		indi_tem_maintext	= '".$indi_tem_maintext."',	
		indi_tem_regdate	= now(),
		admin_idx	= '".$admin_idx."',	
		company_idx	= '".$company_idx."',	
		jira_comp_idx	= '".$jira_comp_idx."',
		indi_tem_path = '".$indi_tem_path."';";		
	
		
		$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
	
	



	echo "<script>
	alert('등록완료');
	parent.location.replace('/MZ_DSG_PLANNER/99_mysettiong/99_0_mysettiong_main.php');
	

</script> ";
	}

?>	