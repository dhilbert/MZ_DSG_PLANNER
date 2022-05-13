<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');


$sql	 = "truncate month_report_met_dataset_2";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));


$sql	 = "truncate month_report_met_dataset_1";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

$sql	 = "truncate month_report_met_dataset_file";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));


$directory = "xlsx/";


$handle = opendir($directory); // 절대경로

if( is_dir($directory) ){
  if( $handle ){
    while( ($filerd = readdir($handle)) != false ){
      if( $filerd != ".." && $filerd != "." ){
        
        @unlink($directory.$filerd);
		
      }
    }
  }
}

closedir($handle);

echo "<script>
	alert('모든정보 초기화');
	parent.location.replace('/MZ_DSG_PLANNER/06_monthreport/01_metlife.php');
</script> ";



?>


