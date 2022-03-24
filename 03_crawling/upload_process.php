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


$crawling_flie_name = $path;


$sql	= "
  insert crawling_file set 
  admin_idx		= '".$admin_idx."',
  crawling_flie_name		= '".$crawling_flie_name."',
      
      crawling_flie_reg_date	= now()


  ";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));








echo "<script>
	alert('파일 업로드 성공');
	parent.location.replace('/MZ_DSG_PLANNER/03_crawling/01_crawling_settiong.php');
</script> ";






?>


