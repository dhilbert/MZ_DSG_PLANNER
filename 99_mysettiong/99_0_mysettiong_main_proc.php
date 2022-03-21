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
	

	$indi_tem_title		= isset($_GET['indi_tem_title'])		? $_GET['indi_tem_title'] : 3;
	$jira_comp_idx 	= isset($_GET['jira_comp_idx'])	? $_GET['jira_comp_idx'] : 3;
	$company_idx 	= isset($_GET['company_idx'])	? $_GET['company_idx'] : 3;
	$indi_tem_maintext		= isset($_GET['indi_tem_maintext'])		? $_GET['indi_tem_maintext'] : 3;

	if( strlen($indi_tem_title)<8) {
		echo "<script>
				alert('유형은 최소 4자 이상 입력하시오');
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


	$sql	= "
		insert individual_template_main set 
		indi_tem_status		= 1,
		indi_tem_title		= '".$indi_tem_title."',
		indi_tem_maintext	= '".$indi_tem_maintext."',	
		indi_tem_regdate	= now(),
		admin_idx	= '".$admin_idx."',	
		company_idx	= '".$company_idx."',	
		jira_comp_idx	= '".$jira_comp_idx."'


		";


echo 	$sql;	
	$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
	echo "<script>
	alert('등록완료');
	parent.location.replace('/MZ_DSG_PLANNER/99_mysettiong/99_0_mysettiong_main.php');
	

</script> ";
	}
?>	