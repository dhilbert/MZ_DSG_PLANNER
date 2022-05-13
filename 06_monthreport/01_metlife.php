<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');
include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');

$u_date00 = isset($_GET['u_date00']) ? $_GET['u_date00'] :  date('Y-m-d');
$u_date01 = isset($_GET['u_date01']) ? $_GET['u_date01'] :  date('Y-m-d');

$check_cute_jy_pretty = array();
$sql	 = "select mrmd_datatype from month_report_met_dataset_file;";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
  array_push($check_cute_jy_pretty,$info['mrmd_datatype']	);
}

function cute_jy_complete_check($value,$check_cute_jy_pretty){
  if(in_array($value,$check_cute_jy_pretty)){
    $want_text = '완료';
  }else{
    $want_text = '<font color="red">미완료</font>';
  }
  return $want_text;
}


function cute_jy_complete_check2($value,$check_cute_jy_pretty){
  if(in_array($value,$check_cute_jy_pretty)){
    $want_text = 'default';
  }else{
    $want_text = 'success';
  }
  return $want_text;
}

function cute_jy_met_date_trance($date){
  $temp = explode("-",$date);
  return $temp[0].$temp[1].$temp[2];
}


function cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text){
  echo "<tr>";
  
    echo "<td><a href = '".$url."'  target='_blank'  >".$text1."</a></td>";
?>
<td><form name="uploadForm" id="uploadForm" method="post" action="01_metlife_upload.php" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
            <div>
             
              <input type="file" name="upfile" id="upfile" />
              <input type="hidden" name="data_set" value="<?php echo $value?>">
               <input type="hidden" name="u_date00"      value="<?php echo $u_date00 ?>">
            <input type="hidden" name="u_date01"      value="<?php echo $u_date01 ?>"  >
</td>
<?php
echo "<td>".$value."</td>";

?>
<td> <input  type='submit' class="btn btn-<?php echo $b_text?> login-btn" type="submit" value="업로드">

</div></form>
</td>
<td> <?php echo $s_text?>


</td>

<?php


  echo "</tr>";
  
  
}
?>
  





  
            
  









			<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
					<?php
					$array = array(
						array('#','직원 관리')
					);
					breadcrumb($array);
					?>
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						매트라이프(재단) 월간 보고서
					</div>

					<div class="panel-body">
          <h4>기존 자료 </h4>
          <br><a href ='[메가존] 메트라이프재단_인수인계_월간보고서_201117.pptx'> 메트 라이프 작성 방법 </a>
          <br><a href ='[메가존] 메트라이프생명 사회공헌재단_2022_2월_월간보고서.pptx'>기존 자료(2022년02월)</a>
          
          <p><br><p>
          <h4>월간 보고서 작성 기간 </h4>
          <form name="frm" role="form" method="get" action="01_metlife.php">
            <label for="start">시작 일자:</label>  <input type="date" id="start" name="u_date00"      value="<?php echo $u_date00 ?>"      min="2022-01-01"      max="2030-12-31">
            <label for="start">시작 일자:</label>  <input type="date" id="start" name="u_date01"      value="<?php echo $u_date01 ?>"      min="2022-01-01"      max="2030-12-31">
            <input  type='submit' class="btn btn-success login-btn" type="submit" value="적용">

        </form>
        <p><br><p>
        <a href='01_metlife_refresh.php'  class="btn btn-success login-btn" > 초기화</a>

        <h4>데이터 입력</h4>
        <table width='70%'>    
          <thead>
          
          <th> GA 접속하여 다운로드</th>
            <th> 파일 선택 </th>
            <th> #</th>
            <th> 파일 확인</th>
            <th> 다운로드</th>

          </thead>
          <tbody>
           <?php 
$last_check = 0;
$url = "https://analytics.google.com/analytics/web/#/report/visitors-overview/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$text1 = "일별사용자정보";
$value = "1";
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);


$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01)."&explorer-table.plotKeys=%5B%5D&explorer-table.rowStart=0&explorer-table.rowCount=1000/";
$text1 = "행동 > 사이트 콘텐츠 > 모든 페이지";
$value = "2";$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);

$text = "article";
$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=1000&explorer-table.filter=~2F".$text."~2F&explorer-table-dataTable.sortColumnName=analytics.avgPageDuration&explorer-table-dataTable.sortDescending=true/";
$text1 = "행동 > 사이트 콘텐츠 > 모든 페이지>".$text;
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);


$text = "story";
$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=1000&explorer-table.filter=~2F".$text."~2F&explorer-table-dataTable.sortColumnName=analytics.avgPageDuration&explorer-table-dataTable.sortDescending=true/";
$text1 = "행동 > 사이트 콘텐츠 > 모든 페이지>".$text;
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);
$text = "biz";
$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=1000&explorer-table.filter=~2F".$text."~2F&explorer-table-dataTable.sortColumnName=analytics.avgPageDuration&explorer-table-dataTable.sortDescending=true/";
$text1 = "행동 > 사이트 콘텐츠 > 모든 페이지>".$text;
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);


$text = "about";
$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=1000&explorer-table.filter=~2F".$text."~2F&explorer-table-dataTable.sortColumnName=analytics.avgPageDuration&explorer-table-dataTable.sortDescending=true/";
$text1 = "행동 > 사이트 콘텐츠 > 모든 페이지>".$text;
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);

$text = "auth";
$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=1000&explorer-table.filter=~2F".$text."~2F&explorer-table-dataTable.sortColumnName=analytics.avgPageDuration&explorer-table-dataTable.sortDescending=true/";
$text1 = "행동 > 사이트 콘텐츠 > 모든 페이지>".$text;
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);

$url = "https://analytics.google.com/analytics/web/#/report/trafficsources-all-traffic/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowStart=0&explorer-table.rowCount=5000";
$text1 = "획득 > 전체 트래픽 > 소스 / 매체";
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);


$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=2500&explorer-table.advFilter=%5B%5B0,%22analytics.pagePath%22,%22PT%22,%22read%22,0%5D,%5B0,%22analytics.pagePath%22,%22PT%22,%22program%22,1%5D,%5B0,%22analytics.pagePath%22,%22PT%22,%22page%22,1%5D%5D";
$text1 = "행동 > 사이트 콘텐츠 > 모든사이트 (이번달)";
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);

$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=20140613&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=2500&explorer-table.advFilter=%5B%5B0,%22analytics.pagePath%22,%22PT%22,%22read%22,0%5D,%5B0,%22analytics.pagePath%22,%22PT%22,%22program%22,1%5D,%5B0,%22analytics.pagePath%22,%22PT%22,%22page%22,1%5D%5D";
$text1 = "행동 > 사이트 콘텐츠 > 모든사이트 (전체)";
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);


$url = "https://analytics.google.com/analytics/web/#/report/content-event-events/a63821144w99505338p103457030/_u.date00=".cute_jy_met_date_trance($u_date00)."&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-segmentExplorer.segmentId=analytics.eventLabel&explorer-table.plotKeys=%5B%5D&explorer-table.rowStart=0&explorer-table.rowCount=250/";
$text1 = "행동 > 이벤트 > 인기 이벤트 ";
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
echo "<tr>";

echo "<td><a href = '".$url."'  target='_blank'  >".$text1."</a></td>";
echo "<td>인기 이벤트는 그냥 보고 올리는게 빠름</td>";
echo "<td></td>";
echo "<td></td>";

echo "</tr>";
$url = "img/met_11.xlsx";
$text1 = "이번달 올린글 양식 받기";
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);
if($b_text=='success'){$last_check+=1;}
cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);



$url = "https://analytics.google.com/analytics/web/#/report/content-pages/a63821144w99505338p103457030/_u.date00=20140613&_u.date01=".cute_jy_met_date_trance($u_date01);
$url = $url."&explorer-table.plotKeys=%5B%5D&explorer-table.rowCount=2500&explorer-table.advFilter=%5B%5B0,%22analytics.pagePath%22,%22PT%22,%22read%22,0%5D,%5B0,%22analytics.pagePath%22,%22PT%22,%22program%22,1%5D,%5B0,%22analytics.pagePath%22,%22PT%22,%22page%22,1%5D%5D";
$text1 = "매트 정보 넣기";
$value += 1;
$b_text = cute_jy_complete_check2($value,$check_cute_jy_pretty);
$s_text = cute_jy_complete_check($value,$check_cute_jy_pretty);

//cute_jy_met_table_td($url,$text1,$value,$s_text,$b_text);



           ?> 

          </tbody>


        </table>  




        


        <p><br>
        <p><br>
<?php 
if($last_check==0){

?>
적용 일자 마지막으로 확인 필요
<form name="frm" role="form" method="get" action="01_metlife_down.php">
             <input type="date" id="start" name="u_date00"      value="<?php echo $u_date00 ?>"      min="2022-01-01"      max="2030-12-31">~
            <input type="date" id="start" name="u_date01"      value="<?php echo $u_date01 ?>"      min="2022-01-01"      max="2030-12-31">
            <input  type='submit' class="btn btn-success login-btn" type="submit" value="엑셀다운로드">

        </form>


<?php


}



?>


        <a id="met_btn_0" href="#" data-toggle="modal" data-target="#met_explain"></a>
			</div>
		</div>
	</div>
</div>





<!--Modal-->
<?php include_once('../contents_footer.php');


?>





<!-- Modal -->
<div class="modal fade" id="met_explain" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				 주의 사항
			</div>
			<div class="modal-body">
      <table width = '100%'>
              <tbody>
              <tr>
                  <td colspan=3><h3>접속전 session 맞추기</h3></td> 
                  
                </tr>                



              <tr>
                  <td><img src='img/met_start1.png' width='100%'> </td> 
                  <td><img src='img/met_start2.png' width='100%'> </td> 
                  <td><img src='img/met_start3.png' width='100%'> </td> 
                </tr>                

                <tr>
                <td>1. 해당 사이트를 METLIFE 구글 계정으로 접속</td> 
                <td>2. GA 미리 접속</td> 
                <td>3.GA 속성이 특정 IP 엑세스 제외인지 확인</td> 
                  
                </tr>    <tr>
                  <td colspan=3><h3>엑셀 다운로드 및 적용시</h3></td> 
                  
                </tr>      
                <tr>
                  <td><img src='img/met_excel1.png' width='100%'> </td> 
                  <td><img src='img/met_excel2.png' width='100%'> </td> 
                  <td></td> 
                </tr>                

                <tr>
                <td>1. 엑셀 다운로드 클릭</td> 
                <td>2.1개 시트만 업로드됨. 데이터1 빼고 전부 삭제 해야 함</td> 
                <td></td> 
                  
                </tr>                
              </tbody>
            </table>



			</div>
			<div class="modal-footer">
        <a href='01_metlife_popup1.php'>오늘 하루 그만 보기</a>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php 

$now = date('Y-m-d');


$sql	 = "select * from month_report_met_popup where admin_idx = ".$admin_idx." and mrmp_date = '".$now."';			";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);

if($info==Null){
?>

<script>
window.addEventListener('DOMContentLoaded', function()
{
  document.getElementById('met_btn_0').click();
});
</script>


<?php
}
?>