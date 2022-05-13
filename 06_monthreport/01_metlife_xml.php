<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include "../03_crawling/PHPExcel-1.8/Classes/PHPExcel.php";

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



$data_set = isset($_GET['data_set']) ? $_GET['data_set'] : "제목 없음";


$check_array = array("","","/","article","story","biz","about","auth");

$prety_jy_check_array = array(3,4,5,6,7);

$sql	 = "select mrmd_filename from month_report_met_dataset_file where mrmd_datatype ='".$data_set."' order by mrmd_flie_idx DESC Limit 1;";

$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);
//$crawling_work = $info['mrmd_filename'];


$objPHPExcel = new PHPExcel();
// 엑셀 데이터를 담을 배열을 선언한다.
$allData = array();
// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.

$file_name = "xlsx/".$info['mrmd_filename'];
$filename = iconv("UTF-8", "EUC-KR",$file_name );




try {

        // 업로드한 PHP 파일을 읽어온다.

	$objPHPExcel = PHPExcel_IOFactory::load($filename);
	$sheetsCount = $objPHPExcel -> getSheetCount();  
	for($i = 0; $i < $sheetsCount; $i++) {



          $objPHPExcel -> setActiveSheetIndex($i);
          $sheet = $objPHPExcel -> getActiveSheet();
          $highestRow = $sheet -> getHighestRow();   			           // 마지막 행         

          $highestColumn = $sheet -> getHighestColumn();	// 마지막 컬럼

          // 한줄읽기

          for($row = 2; $row <= $highestRow; $row++) {



            // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.

            $rowData = $sheet -> rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
            


            // $rowData에 들어가는 값은 계속 초기화 되기때문에 값을 담을 새로운 배열을 선안하고 담는다.
            
            $allData[$row] = $rowData[0];

          }

	}
  

} catch(exception $e) {

	

}




if($data_set ==1){
  $sql	 = "truncate month_report_met_dataset_1";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  $start_sql="INSERT INTO month_report_met_dataset_1(data_date, data_value)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
          
    $rrsql = $rrsql." ('".PHPExcel_Style_NumberFormat::toFormattedString($temp_list[0], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2)."','".$temp_list[1]."'),";        
        
        
  }
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));

  $sql	 = "delete from  month_report_met_dataset_1 where data_date = 0";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));



}elseif($data_set==2){
  $sql	 = "truncate month_report_met_dataset_2";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  $start_sql="INSERT INTO month_report_met_dataset_2(data_page, data_page1, data_page2, data_page3, data_page4, data_page5, data_page6)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
    if($check_array[$data_set]==$temp_list[0]){      
      //$rrsql = $rrsql." ('".$temp_list[0]."','".$temp_list[1]."','".$temp_list[2]."','".PHPExcel_Style_NumberFormat::toFormattedString($temp_list[3], PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME8)."','".$temp_list[4]."','".$temp_list[5]."','".$temp_list[6]."'),";        
      $rrsql = $rrsql." ('".$temp_list[0]."','".$temp_list[1]."','".$temp_list[2]."','".$temp_list[3]."','".$temp_list[4]."','".$temp_list[5]."','".$temp_list[6]."'),";        
    }

  }
  
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));

  


  $sql	 = "select mrmd_idx,from_unixtime(data_page3) as prety_jy from month_report_met_dataset_2;";

  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  while($info	 = mysqli_fetch_array($res)){

    $U_sql	 = "
    update month_report_met_dataset_2 set 
    data_page3_1 = '".pretty_jy($info['prety_jy'])."'
    where mrmd_idx = ".$info['mrmd_idx']."
    ;";

    $U_res	=  mysqli_query($real_sock,$U_sql) or die(mysqli_error($real_sock));


  };


  
}elseif(in_array($data_set,$prety_jy_check_array)){
  $sql	 = "delete from month_report_met_dataset_2 where data_page = '".$check_array[$data_set]."'";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  $start_sql="INSERT INTO month_report_met_dataset_2(data_page, data_page1, data_page2, data_page3, data_page4, data_page5, data_page6)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
    if($temp_list[0]==""){     
      $rrsql = $rrsql." ('".$check_array[$data_set]."','".$temp_list[1]."','".$temp_list[2]."','".$temp_list[3]."','".$temp_list[4]."','".$temp_list[5]."','".$temp_list[6]."'),";        
    }

  }
  
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));

  


  $sql	 = "select mrmd_idx,from_unixtime(data_page3) as prety_jy from month_report_met_dataset_2;";

  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  while($info	 = mysqli_fetch_array($res)){

    $U_sql	 = "
    update month_report_met_dataset_2 set 
    data_page3_1 = '".pretty_jy($info['prety_jy'])."'
    where mrmd_idx = ".$info['mrmd_idx']."
    ;";

    $U_res	=  mysqli_query($real_sock,$U_sql) or die(mysqli_error($real_sock));


  };
  
}
elseif($data_set==8){


 

  $sql	 = "truncate month_report_met_dataset_3";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  $start_sql="INSERT INTO month_report_met_dataset_3(data_page, data_value)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
    
      $rrsql = $rrsql." ('".$temp_list[0]."','".$temp_list[1]."'),";        
    

  }
  
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));

  $sql	 = "update month_report_met_dataset_3 
      set data_page = REPLACE(data_page,'(direct) / (none)','직접 URL 입력') ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  $sql	 = "update month_report_met_dataset_3 
      set data_page = REPLACE(data_page,'organic','검색') ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  $sql	 = "update month_report_met_dataset_3 
      set data_page = REPLACE(data_page,'referral','유입') ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  

  
}
elseif($data_set==9){

 $sql	 = "truncate month_report_met_dataset_4";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  $start_sql="INSERT INTO month_report_met_dataset_4(data_page, data_value)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
    
      $rrsql = $rrsql." ('".str_replace('\\','',$temp_list[0])." ','".$temp_list[1]."'),";        
    

  }
  
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));

  
  $sql	 = "update month_report_met_dataset_4 set 

  data_page = trim(data_page)
  ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  
}
elseif($data_set==10){
  
  $sql	 = "truncate month_report_met_dataset_4_total";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  $start_sql="INSERT INTO month_report_met_dataset_4_total(data_page, data_value)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
    
      $rrsql = $rrsql." ('".str_replace('\\','',$temp_list[0])." ','".$temp_list[1]."'),";        
    

  }
  
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));
 
  $sql	 = "update month_report_met_dataset_4_total set 

  data_page = trim(data_page)
  ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  
}elseif($data_set==11){
  
  $sql	 = "truncate month_report_met_dataset_6";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  $start_sql="INSERT INTO month_report_met_dataset_6(data_page)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
    
      $rrsql = $rrsql." ('".str_replace('\\','',$temp_list[0])." '),";        
    

  }
  
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));
 
  $sql	 = "update month_report_met_dataset_6 set 

  data_page = trim(data_page)
  ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  
}

elseif($data_set==12){
  
  $start_sql="INSERT INTO month_report_met_dataset_7(data_page0, data_page1, data_page2, data_page3)  VALUES";
  $rrsql = $start_sql;

  for($i=2 ; $i <count($allData)+2;$i++){
    $temp_list = $allData[$i];
    $temp_2 = str_replace("'","%%",$temp_list[2]);
    $temp_2 = str_replace('"','%%%',$temp_2 );
    $temp_2 = str_replace('\\','',$temp_2);
    
      $rrsql = $rrsql." ('".str_replace('\\','',$temp_list[0])." ','".$temp_list[1]."','".$temp_2."','".PHPExcel_Style_NumberFormat::toFormattedString($temp_list[3], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2)."'),";        
    

  }
  
  $rrsql = substr($rrsql, 0, -1);
  $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));
  $sql	 = "update month_report_met_dataset_7 set 

  data_page0 = trim(data_page0)
  ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  $sql	 = "update month_report_met_dataset_7 set 

  data_page2 = REPLACE(data_page2,'%%%','\"')
  ";
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
  
  $sql	 = 'update month_report_met_dataset_7 set 

  data_page2 = REPLACE(data_page2,"%%","\'")
  ';
  $res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

  
  
  
}



 


$u_date00 = isset($_GET['u_date00']) ? $_GET['u_date00'] :  date('Y-m-d');
$u_date01 = isset($_GET['u_date01']) ? $_GET['u_date01'] :  date('Y-m-d');





  

echo "<script>
	alert('파일 업로드 성공');
	parent.location.replace('/MZ_DSG_PLANNER/06_monthreport/01_metlife.php?u.date00=".$u_date00."&u.date01=".$u_date01."');
</script> ";



?>
