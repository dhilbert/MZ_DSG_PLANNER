<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include "../03_crawling/PHPExcel-1.8/Classes/PHPExcel.php";


$data_set = isset($_GET['data_set']) ? $_GET['data_set'] : "제목 없음";


function pretty_jy($num){

  $want = str_replace('1970-01-01 09' , '00', $num);
  $want = explode(":",$want);
  if(round($want[2],0)<10){
    $temp = "0".round($want[2],0);
  }else{
    $temp = round($want[2],0);
  }


  $want = $want[0].":".$want[1].":".$temp;
  

  return $want;
}





$sql	 = "SELECT data_page,data_page3,from_unixtime(data_page3) as temp FROM month_report_met_dataset_2 Limit 1;";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);




echo pretty_jy($info['temp']);

?>
