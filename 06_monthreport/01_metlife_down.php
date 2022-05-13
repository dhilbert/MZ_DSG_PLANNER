<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');

require('../03_crawling/Snoopy.class.php');
/*
function met_crawling($sku){   
    $url='https://www.akmall.com/goods/GoodsDetail.do?goods_id='.$sku;
    $snoopy = new Snoopy;
    $snoopy->fetch($url);
    $origin_html = $snoopy->results;    

    $want_text = explode('<img id="mainGoodsImage" src="',$origin_html);
    $want_text = explode('" alt="',hd_jy_crawlong($want_text,1));       
    $img = "<a href ='".hd_jy_crawlong($want_text,0)."' target='_blank'><img src='".hd_jy_crawlong($want_text,0)."' height='50'></a>";

    
    $want_text = explode('<strong class="c_pink"></strong>',$origin_html);
    $want_text = explode('<em class="sub">',hd_jy_crawlong($want_text,1));
    $title =  hd_jy_crawlong($want_text,0);
    
    $want_text = explode('<dd class="ss"><i>',$origin_html);
    $want_text = explode('</i>원</dd>',hd_jy_crawlong($want_text,1));
    $real_price =hd_jy_crawlong( $want_text,0);

    $want_text = explode('<dd class="tt"><i>',$origin_html);
    $want_text = explode('</i>원</dd>',hd_jy_crawlong($want_text,1));
    $dis_price = hd_jy_crawlong($want_text,0);

    $want_text = explode('class="sp direct" value="',$origin_html);
    $want_text = explode('"',hd_jy_crawlong($want_text,1));
    $button_t  = hd_jy_crawlong($want_text,0);
    $want_array = array($title,$img , $real_price , $dis_price    ,$button_t  ,$url       );
    return $want_array;
}    
*/
$sql	 = "
UPDATE month_report_met_dataset_4 SET data_page =TRIM(data_page);



";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

$sql	 = "

UPDATE month_report_met_dataset_7 SET data_page0 =TRIM(data_page0);


";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

$sql	 = "
UPDATE month_report_met_dataset_4_total SET data_page =TRIM(data_page);

";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));

$sql	 = "
UPDATE month_report_met_dataset_6 SET data_page =TRIM(data_page);
";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));





$u_date00 = isset($_GET['u_date00']) ? $_GET['u_date00'] :  date('Y-m-d');
$u_date01 = isset($_GET['u_date01']) ? $_GET['u_date01'] :  date('Y-m-d');









$EXCEL_STR = "<h4>1. 운영 현환>1-1. 작업량 추이</h4>

<table border='1'>
		<thead>
			<tr>
				
				<th>이름</th>
				<th>공수</th>
			</tr>

		</thead>
		<tbody>
";

$total = 0;
$sql	 = "
	select  sum(a.timeSpentSeconds/3600/8/20.8) as sums, a.jmi_work_name,a.jmi_key
		from jirasync_work as a
			Join jirasync_main_info as b
		on 	a.jmi_inx = b.jmi_inx 
	where b.components LIKE '%메트라이프%'
	and check_date >= '".$u_date00 ."'
	and check_date <= '".$u_date01 ."'
	group by a.jmi_work_id";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$total +=round($info['sums'],3);
	$EXCEL_STR = $EXCEL_STR."<tr>
	<td>".$info['jmi_work_name']."</td>
	<td>".round($info['sums'],3)."</td>
	
	</tr>";

}

$EXCEL_STR = $EXCEL_STR."<tr>
				<td> 합계 </td>
				<td>".$total."</td>
				</tr></tbody>
				</table>";


$EXCEL_STR = $EXCEL_STR."<h4>1. 운영 현환>1-2 업무내역 </h4>


<table border='1'>
		<thead>
			<tr>
				
			<th>No</th>
			<th>요청일</th>
			<th>작업내용</th>
			<th>완료일</th>
			<th>상태</th>
			<th>비고</th>
				
			</tr>

		</thead>
		<tbody>
";



$total = 0;
$sql	 = "
	select  customfield_12267,customfield_12266,jmi_summary,status
		from jirasync_main_info 
		
	where components LIKE '%메트라이프%'
	and customfield_12267 >= '".$u_date00 ."'
	and customfield_12267 <= '".$u_date01 ."'
	";

$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$total +=1;
	$EXCEL_STR = $EXCEL_STR."<tr>
	<td>".$total."</td>
	<td>".$info['customfield_12267']."</td>
	<td>".$info['jmi_summary']."</td>
	<td>".$info['customfield_12266']."</td>
	<td>".$info['status']."</td>
	<td></td>
	
	
	</tr>";
}

$EXCEL_STR = $EXCEL_STR."</tbody></table>";


$EXCEL_STR = $EXCEL_STR."<h4>2. 접속 현황 > 2-1. Traffic Reporting 
</h4>


<table border='1'>
		<thead>
			<tr>
				
			<th>일자</th>
			<th>숫자</th>
				
			</tr>

		</thead>
		<tbody>
";
$total=0;

$sql	 = "
	select  * 
		from month_report_met_dataset_1
		
	";

$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	
	$EXCEL_STR = $EXCEL_STR."<tr>
	
	<td>".$info['data_date']."</td>
	<td>".$info['data_value']."</td>
	
	
	</tr>";
	$total+=$info['data_value'];
}


$EXCEL_STR = $EXCEL_STR."</tbody></table>";


$EXCEL_STR = $EXCEL_STR."<h4>2. 접속 현황 > 2-1. Traffic Reporting >월별 접속 현황 
</h4>
총 접속자 : ".$total."

";



$EXCEL_STR = $EXCEL_STR."<h4>2. 접속 현황 > 2-1. Traffic Reporting > 메뉴 별 조회수(방문수) 
</h4>


<table border='1'>
		<thead>
			<tr>
				
				<th>항목</th>
				<th>숫자</th>
				
			</tr>

		</thead>
		<tbody>
";
$sql = "select  * 	from month_report_met_dataset_2 where data_page='story'";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);
	
	$EXCEL_STR = $EXCEL_STR."<tr>
		<td>나눔 스토리</td>
		<td>".$info['data_page4']."</td>
		</tr>";

$sql = "select  * 	from month_report_met_dataset_2 where data_page='biz'";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);

$EXCEL_STR = $EXCEL_STR."<tr>
	<td>사업 소개</td>
	<td>".$info['data_page4']."</td>
	</tr>";

$sql = "select  * 	from month_report_met_dataset_2 where data_page='article'";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);
	
$EXCEL_STR = $EXCEL_STR."<tr>
	<td>재단 소식</td>
	<td>".$info['data_page4']."</td>
	</tr>";				
			
$sql = "select  * 	from month_report_met_dataset_2 where data_page='about'";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
$info	 = mysqli_fetch_array($res);
	
$EXCEL_STR = $EXCEL_STR."<tr>
	<td>재단 소개</td>
	<td>".$info['data_page4']."</td>
	</tr>";				
							



$EXCEL_STR = $EXCEL_STR."</tbody></table><h4>2-1. Traffic Reporting > 페이지 별 방문사용자 수, 평균 머문 시간, 페이지 이탈율</h4>


<table border='1'>
		<thead>
			<tr>
				
				<th>방문페이지</th>
				<th>사용자(방문수)</th>
				<th>평균 머문시간 (평균 세션시간)
				</th>
				<th>이탈율</th>
				
			</tr>

		</thead>
		<tbody>
";

$sql = "select  * 	from month_report_met_dataset_2";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	
$EXCEL_STR = $EXCEL_STR."<tr>
<td>".$info['data_page']."</td>
<td>".$info['data_page4']."</td>
<td>".$info['data_page3_1']."</td>
<td>".round($info['data_page5']*100,2)."%</td>
	</tr>";			
}


$EXCEL_STR = $EXCEL_STR."</tbody></table><h4>2-1. Traffic Reporting > 도메인 별 접속 현황
</h4>


<table border='1'>
		<thead>
			<tr>
				
				<th>No</th>
				<th>접속 전 도메인</th>
				<th>접속 수 				</th>
				
				
			</tr>

		</thead>
		<tbody>
";
$total = 0;
$sql = "select  * 	from month_report_met_dataset_3 where data_page!=''";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$total += 1;
	$EXCEL_STR = $EXCEL_STR."<tr>
	<td>".$total."</td>
	<td>".$info['data_page']."</td>
	<td>".$info['data_value']."</td>
	
	</tr>";			
}



$EXCEL_STR = $EXCEL_STR."</tbody></table><h4>2-1. Traffic Reporting > 게시물 누적 조회수 Top10 집계 
</h4>


<table border='1'>
		<thead>
			<tr>
				
				<th>No</th>
				<th>분류				</th>
				<th>제목				</th>
				<th>게시 날짜				</th>
				<th>링크				</th>
				<th>누적 조회수 				</th>
				<th>당월 조회수 				</th>
				
				
				
			</tr>

		</thead>
		<tbody>
";
$total = 0;
$sql = "select  a.data_page, a.data_value as adata_value ,b.data_value as bdata_value ,c.data_page1,c.data_page2,c.data_page3



from month_report_met_dataset_4_total as a
	join month_report_met_dataset_4 as b 
on a.data_page = b.data_page 
	LEFT join 	month_report_met_dataset_7 as c
on a.data_page = c.data_page0 	
group by a.data_page
order by a.data_value DESC LIMIT 20



";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$total += 1;
	$EXCEL_STR = $EXCEL_STR."<tr>
	<td>".$total."</td>
	<td>".$info['data_page1']."</td>
	<td>".$info['data_page2']."</td>
	<td>".$info['data_page3']."</td>
	<td>".$info['data_page']."</td>
	<td>".$info['adata_value']."</td>
	<td>".$info['bdata_value']."</td>
	
	</tr>";			
}



$EXCEL_STR = $EXCEL_STR."</tbody></table><h4>2-1. Traffic Reporting > 당월 누적 조회수 Top10 집계 
</h4>


<table border='1'>
		<thead>
			<tr>
				
				<th>No</th>
				<th>분류				</th>
				<th>제목				</th>
				<th>게시 날짜				</th>
				<th>링크				</th>
				<th>누적 조회수 				</th>
				<th>당월 조회수 				</th>
				
				
				
			</tr>

		</thead>
		<tbody>
";
$total = 0;
$sql = "select  a.data_page, a.data_value as adata_value ,b.data_value as bdata_value ,c.data_page1,c.data_page2,c.data_page3
from month_report_met_dataset_4 as a
	join month_report_met_dataset_4_total as b 
on a.data_page = b.data_page 
	LEFT join 	month_report_met_dataset_7 as c
on a.data_page = c.data_page0 	
group by a.data_page
order by a.data_value DESC LIMIT 20



";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$total += 1;
	$EXCEL_STR = $EXCEL_STR."<tr>
	<td>".$total."</td>
	<td>".$info['data_page1']."</td>
	<td>".$info['data_page2']."</td>
	<td>".$info['data_page3']."</td>
	<td>".$info['data_page']."</td>
	<td>".$info['bdata_value']."</td>
	<td>".$info['adata_value']."</td>
	
	
	</tr>";			
}


$EXCEL_STR = $EXCEL_STR."</tbody></table><h4>2-1. Traffic Reporting > 당월 올린 게시글ㄴ
</h4>


<table border='1'>
		<thead>
			<tr>
				
				<th>No</th>
				<th>분류				</th>
				<th>제목				</th>
				<th>게시 날짜				</th>
				<th>링크				</th>
				<th>누적 조회수 				</th>
				
				
				
			</tr>

		</thead>
		<tbody>
";
$total = 0;
$sql = "select  a.data_page, b.data_value as bdata_value ,c.data_page1,c.data_page2,c.data_page3
from month_report_met_dataset_6 as a
	LEFT join month_report_met_dataset_4 as b 
on a.data_page = b.data_page 
	LEFT join 	month_report_met_dataset_7 as c
on a.data_page = c.data_page0 	
group by a.data_page




";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$total += 1;
	$EXCEL_STR = $EXCEL_STR."<tr>
	<td>".$total."</td>
	<td>".$info['data_page1']."</td>
	<td>".$info['data_page2']."</td>
	<td>".$info['data_page3']."</td>
	<td>".$info['data_page']."</td>
	<td>".$info['bdata_value']."</td>
	
	
	
	</tr>";			
}








header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 메트라이프월간보고서.xls" );
header( "Content-Description: PHP4 Generated Data" );








$EXCEL_STR .= "</tbody></table>";
echo $EXCEL_STR;




echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";




 
?>