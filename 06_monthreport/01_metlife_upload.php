<?php

include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');



$now_time =  date("Y-m-d H:i:s");

$data_set = isset($_POST['data_set']) ? $_POST['data_set'] : "제목 없음";

$u_date00 = isset($_GET['u_date00']) ? $_GET['u_date00'] :  date('Y-m-d');
$u_date01 = isset($_GET['u_date01']) ? $_GET['u_date01'] :  date('Y-m-d');



if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {

    $file = $_FILES['upfile'];

    $upload_directory = 'xlsx/';

    $ext_str = "xlsx";

    $allowed_extensions = explode(',', $ext_str);

    $max_file_size = 5242880;
    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);
   


    // 확장자 체크

    if(!in_array($ext, $allowed_extensions)) {

        
        echo "<script>
        alert('엑셀파일만 업로드 가능');
        parent.location.replace('/MZ_DSG_PLANNER/06_monthreport/01_metlife.php');
    </script>";
    }
    else{
        $path = md5(microtime()) . '.' . $ext;
        move_uploaded_file($file['tmp_name'], $upload_directory.$path);



    }


    
    
} else {

    echo "<script>
    alert('파일이 업로드 되지 않았습니다.');
    parent.location.replace('/MZ_DSG_PLANNER/06_monthreport/01_metlife.php');
</script>";
}


$crawling_flie_name = $path;
echo $data_set;
echo "<br>";
echo $crawling_flie_name;


$sql	= "
    delete from month_report_met_dataset_file where mrmd_datatype 		= '".$data_set."'

";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));


$sql	= "
  insert month_report_met_dataset_file set 
  admin_idx		= '".$admin_idx."',
  mrmd_filename		= '".$crawling_flie_name."',
  mrmd_datatype 		= '".$data_set."'


  ";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));







echo "<script>
	alert('파일 업로드 성공');
	parent.location.replace('/MZ_DSG_PLANNER/06_monthreport/01_metlife_xml.php?data_set=".$data_set."&u_date00=".$u_date00."u_date01=".$u_date01."');
</script> ";






?>


