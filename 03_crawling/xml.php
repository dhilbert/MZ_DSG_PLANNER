<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include "../PHPExcel/Classes/PHPExcel.php";
$now_time =  date("Y-m-d H:i:s");
$jem_idx = isset($_GET['jem_idx']) ? $_GET['jem_idx'] : 3;

$sql	 = "select * from jira_excel_maintain where jem_idx ='".$jem_idx."';";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);


$objPHPExcel = new PHPExcel();


// 엑셀 데이터를 담을 배열을 선언한다.

$allData = array();



// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.



$file_name = "xlsx/".$info['file_name'];
$filename = iconv("UTF-8", "EUC-KR",$file_name );



try {

        // 업로드한 PHP 파일을 읽어온다.

	$objPHPExcel = PHPExcel_IOFactory::load($filename);

	$sheetsCount = $objPHPExcel -> getSheetCount();



	// 시트Sheet별로 읽기

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

	echo $e;

}



echo "<pre>";





//echo PHPExcel_Style_NumberFormat::toFormattedString( $allData[2][8], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

echo "<br>";

print_r($allData[2]);

//

$start_sql="INSERT INTO jira_excel_sub(jem_idx, Issue_Type, jiraKey, Summary, Assignee, Priority, Updated, Time_Spent, Due_Datetime, Start_Datess, Resolution, Start_dates, Components, Descriptions)  VALUES";
$rrsql = $start_sql;
for($i=2 ; $i <count($allData)+2;$i++){
  $temp_list = $allData[$i];
        
  
      $rrsql = $rrsql." ('".$jem_idx."',
        '".$temp_list[0]."',
        '".$temp_list[1]."',
        '".preg_replace("/[ #\/\\\:;,'\"`<>()]/i","", $temp_list[2])."',
        '".$temp_list[3]."',
        '".$temp_list[4]."',
        '".PHPExcel_Style_NumberFormat::toFormattedString($temp_list[5], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH)."',
        '".$temp_list[6]."',                        
        '".PHPExcel_Style_NumberFormat::toFormattedString($temp_list[7], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH)."',
        '".PHPExcel_Style_NumberFormat::toFormattedString($temp_list[8], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH)."',
        '".$temp_list[9]."',
        '".$temp_list[10]."',
        '".$temp_list[11]."',
        '".preg_replace("/[ #\/\\\:;,'\"`<>()]/i","", $temp_list[12])."'),";
      if($i%100==0){

        $rrsql = substr($rrsql, 0, -1);
        $res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));
        $rrsql = $start_sql;
      }
      
}
$rrsql = substr($rrsql, 0, -1);
$res	=  mysqli_query($real_sock,$rrsql) or die(mysqli_error($real_sock));


$sql	 = "update jira_excel_maintain  set 
excel_state = 1,
reg_datetime = '".$now_time."'




      where jem_idx ='".$jem_idx."';";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

echo "<script>
	alert('파일 업로드 성공');
	parent.location.replace('/MZ_DSG_PLANNER/jira/jira_main.php');
</script> ";




?>
