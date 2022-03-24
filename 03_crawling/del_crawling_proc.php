<?php
	
	include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
	$crawling_idx		= isset($_GET['crawling_idx'])		? $_GET['crawling_idx'] : 3;
	
	
	$sql	= "
			update crawling set 
			crawling_status = 0
			where crawling_idx ='".$crawling_idx."'
	
	
				";
	$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
	
	
	echo "<script>
		alert('회원 가입이 완료 되었습니다. 관리자 승인해야 완료 됩니다. ');
		parent.location.replace('/MZ_DSG_PLANNER/03_crawling/01_crawling_settiong.php');
	</script> ";
	
?>	