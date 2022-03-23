<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');



$now_time =  date("Y-m-d H:i:s");



if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {

    $file = $_FILES['upfile'];

    $upload_directory = 'xlsx/';

    $ext_str = "xlsx";

    $allowed_extensions = explode(',', $ext_str);

    

    $max_file_size = 5242880;

    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);

    

    // 확장자 체크

    if(!in_array($ext, $allowed_extensions)) {

        echo "엑셀파일만 확인 가능";

    }


    $path = md5(microtime()) . '.' . $ext;
    move_uploaded_file($file['tmp_name'], $upload_directory.$path);
    
} else {

    echo "<h3>파일이 업로드 되지 않았습니다.</h3>";

    echo '<a href="javascript:history.go(-1);">이전 페이지</a>';

}










require_once "PHPExcel/Classes/PHPExcel.php";
$objPHPExcel = new PHPExcel();

require_once "PHPExcel/Classes/PHPExcel/IOFactory.php";

$filename = $file_name = "xlsx/".$path;
echo $filename;
$filename = iconv("UTF-8", "EUC-KR",$file_name );



 

// PHPExcel은 메모리를 사용하므로 메모리 최대치를 늘려준다.
// 이부분은 엑셀파일이 클때는 적절히 더욱 늘려줘야 제대로 읽어올수 있다.


ini_set('memory_limit', '1024M');

 

try {

 

    // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.

    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);

 

    // 읽기전용으로 설정

    $objReader->setReadDataOnly(true);

 

    // 엑셀파일을 읽는다

    $objExcel = $objReader->load($filename);

 

    // 첫번째 시트를 선택

    $objExcel->setActiveSheetIndex(0);

 

    $objWorksheet = $objExcel->getActiveSheet();

    $rowIterator = $objWorksheet->getRowIterator();

 

    foreach ($rowIterator as $row) {

               $cellIterator = $row->getCellIterator();

               $cellIterator->setIterateOnlyExistingCells(false);

    }

 

    $maxRow = $objWorksheet->getHighestRow();

 

    // echo $maxRow . "<br>";

 

    for ($i = 0 ; $i <= $maxRow ; $i++) {


               $a = $objWorksheet->getCell('A' . $i)->getValue(); // A열

               $b = $objWorksheet->getCell('B' . $i)->getValue(); // B열 
 
               $c = $objWorksheet->getCell('C' . $i)->getValue(); // C열 

               $d = $objWorksheet->getCell('D' . $i)->getValue(); // D열

               $e = $objWorksheet->getCell('E' . $i)->getValue();  // E열 

 

               $f = $objWorksheet->getCell('F' . $i)->getValue(); // F열

               $g = $objWorksheet->getCell('G' . $i)->getValue(); // G열 

 

               $h = $objWorksheet->getCell('H' . $i)->getValue(); // H열 

               // 날짜 형태의 셀을 읽을때는 toFormattedString를 사용한다.

               $h = PHPExcel_Style_NumberFormat::toFormattedString($h, 'YYYY-MM-DD');

 

      //   echo $a . " / " . $b. " / " . $c . " / " . $d . " / " . $e . " / " . $f . " / " . $g . " <br>\n";

    
             $b  = addslashes($b);
             $c  = addslashes($c);
             $d  = addslashes($d);
             $e  = addslashes($e);
             $f  = addslashes($f);
             $g  = addslashes($g);

 

          $query = "insert into 삽입할 테이블 (continent,country_code,country,city_code,city,use_yn) values ('$b','$c','$d','$e','$f','$g')";
          mysql_query($query) or die("Insert Error !");


      }
 
   echo $maxRow-1 . " Data inserting finished !";

 

} catch (exception $e) {
    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.!';
}

?>













































$objPHPExcel = new PHPExcel();
// 엑셀 데이터를 담을 배열을 선언한다.
$allData = array();
// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.

/*
$objPHPExcel = PHPExcel_IOFactory::load($filename);

$sheetsCount = $objPHPExcel -> getSheetCount();

print_r($sheetsCount);
/*


try {

        // 업로드한 PHP 파일을 읽어온다.


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

echo $e;

echo "<pre>";



//echo PHPExcel_Style_NumberFormat::toFormattedString( $allData[2][8], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

echo "<br>";



//
/*

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














































echo "<script>
	alert('파일 업로드 성공');
	parent.location.replace('/03_crawling/01_crawling_settiong.php');
</script> ";


*/



?>


