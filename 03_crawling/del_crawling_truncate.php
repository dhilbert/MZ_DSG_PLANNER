<?php
	
	include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
	$crawling_idx		= isset($_GET['crawling_idx'])		? $_GET['crawling_idx'] : 3;
	
	
	$sql	= "
	truncate   crawling
	
	
				";
	$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
	
	
	echo "<script>
		alert('비우기 성공 ');
		parent.location.replace('/MZ_DSG_PLANNER/03_crawling/01_crawling_settiong.php');
	</script> ";
	
?>	