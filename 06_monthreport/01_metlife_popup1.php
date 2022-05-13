<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');





$now = date("Y-m-d");


$sql	= "
	insert month_report_met_popup set 
		
		mrmp_date	 = now(),
		admin_idx = '".$admin_idx."'
";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));



echo "<script>
alert('내일부터는 보임');
parent.location.replace('/MZ_DSG_PLANNER/06_monthreport/01_metlife.php');
</script> ";



?>