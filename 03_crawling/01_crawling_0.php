<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');

include_once('../contents_header.php');
include_once('../contents_profile.php');
include_once('../contents_sidebar.php');

include_once('crawling.php');
//$name = $total_num ;$temp_text=$temp_text.hd_tbody_td($num,$name);$num+=1;


$num = 0;


function hd_tbody_td_text($text,$num,$name){
	$text = $text."<td data-field='s_".$num."' data-sortable='true' >".$name."</td>";
	return $text;
}


function hd_tbody_td_text_check($text,$num,$temp_text){
	if(trim($temp_text[0])==trim($temp_text[1])){
		$text = $text."<td data-field='s_".$num."' data-sortable='true' >".$temp_text[0]."</td>";
		
	}elseif($temp_text[1]=='fail'){
		$text = $text."<td data-field='s_".$num."' data-sortable='true' >fail</td>";

	}
	else{
		$text = $text."<td data-field='s_".$num."' data-sortable='true' ><font color='red'>".$temp_text[0]."<br>".$temp_text[1]."</font></td>";
		

	}
	

	
	return $text;
}


function hd_tbody_td_text_check2($text,$num,$temp_text){

	if($temp_text[1]=="추적 불가능"){
		$text = $text."<td data-field='s_".$num."' data-sortable='true' >".$temp_text[0]."<br>(추적불가능)</td>";
		

	}elseif(round((int)str_replace(",","",$temp_text[1]),0)==round($temp_text[0],0)){
		$text = $text."<td data-field='s_".$num."' data-sortable='true' >".$temp_text[0]."</td>";
		
	}
	else{
		$text = $text."<td data-field='s_".$num."' data-sortable='true' ><font color='red'>".$temp_text[0]."<br>".$temp_text[1]."</font></td>";
		

	}	
	return $text;
}



function hd_error_check2($temp_text){

	if($temp_text[1]=="추적 불가능"){
		
		$check = 0;

	}elseif(round((int)str_replace(",","",$temp_text[1]),0)==round($temp_text[0],0)){
		
		$check = 0;
	}
	else{
		
		$check = 1;

	}	
	return $check;


}



function hd_error_check($temp_text){
	if(trim($temp_text[0])==trim($temp_text[1])){
		$check = 0;
	}
	else{		
		$check = 1;
	}
	return $check;
}


function check_crawling_company($num,$sku){
	$temp_list = array('허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체','허용하지 않은 업체');
	if($num==1){ $want_array = hmall_crawling($sku);}
	elseif($num==3){ $want_array = ak_crawling($sku);}
	elseif($num==4){ $want_array = galleria_crawling($sku);}	
	elseif($num==5){ $want_array = kakao_crawling($sku);}
	elseif($num==6){ $want_array = lotte_crawling($sku);}
	elseif($num==7){ $want_array = imall_crawling($sku);}
	else{$want_array = $temp_list;}
	return $want_array;
	
}


$cute_jy_error='';
$cute_jy_want='';
$cute_jy_check1=0;
$cute_jy_check2=0;
$cute_jy_check3=0;
$cute_jy_check4=0;
$cute_jy_total_check=0;





$sql	 = "select b.crawling_company_name,a.crawling_company_inx,a.crawling_sku,a.crawling_price,a.crawling_dis,a.crawling_name,a.crawling_status,a.crawling_work
			from crawling as a 
				join crawling_company as b 
			on 	a.crawling_company_inx = b.crawling_company_idx
			where a.crawling_status = 1

			";
$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
while($info	 = mysqli_fetch_array($res)){
	$cute_jy_total_check+=1;
	
	$temp_text = '';
	$error_check_temp = 0;
	$num=2;
	$temp_text = hd_tbody_td_text($temp_text,$num,$info['crawling_work']);	$num += 1;
	$temp_text = hd_tbody_td_text($temp_text,$num,$info['crawling_company_name']);	$num += 1;
	$temp_text = hd_tbody_td_text($temp_text,$num,$info['crawling_sku']);	$num += 1;

	
	$check = check_crawling_company($info['crawling_company_inx'],$info['crawling_sku']);

	
	
	$temp_list = array($info['crawling_name'],$check[0]);
	$temp_text = hd_tbody_td_text_check($temp_text,$num,$temp_list);	$num += 1;
	$error_check_temp +=hd_error_check($temp_list);
	

	$temp_list = array($check[1],$check[1]);
	$temp_text = hd_tbody_td_text_check($temp_text,$num,$temp_list);	$num += 1;

	$temp_list = array($info['crawling_price'],$check[2]);
	$temp_text = hd_tbody_td_text_check2($temp_text,$num,$temp_list);	$num += 1;
	$error_check_temp +=hd_error_check2($temp_list);
	

	$temp_list = array($info['crawling_dis'],$check[3]);
	$temp_text = hd_tbody_td_text_check2($temp_text,$num,$temp_list);	$num += 1;
	$error_check_temp +=hd_error_check2($temp_list);
	
	
	$temp_list = array($check[4],$check[4]);
	$temp_text = hd_tbody_td_text_check($temp_text,$num,$temp_list);	$num += 1;

	
	$name = "<a href=".$check[5].">바로가기</a>";
	$temp_text = hd_tbody_td_text($temp_text,$num,$name);
	
	if($error_check_temp==0){
		
		$first_text = "<tr>";
		$first_text = hd_tbody_td_text($first_text,0,$cute_jy_total_check);	
		$first_text = hd_tbody_td_text($first_text,1,"성공");	
		$cute_jy_want = $cute_jy_want.$first_text.$temp_text."
		</tr>
		";;
		$cute_jy_check1 += $error_check_temp ;//틀린 항목

	}elseif($check[0]=='fail'){
		$cute_jy_check3+=1;
		$first_text = "<tr>";
		$first_text = hd_tbody_td_text($first_text,0,$cute_jy_total_check);	
		$first_text = hd_tbody_td_text($first_text,1,"실패");
		$first_text = hd_tbody_td_text($first_text,2,$info['crawling_work']);
		$first_text = hd_tbody_td_text($first_text,2,$info['crawling_company_name']);
		$first_text = hd_tbody_td_text($first_text,3,$info['crawling_sku']);
		$first_text = hd_tbody_td_text($first_text,4,"실패");
		$first_text = hd_tbody_td_text($first_text,5,"실패");
		$first_text = hd_tbody_td_text($first_text,6,"실패");
		$first_text = hd_tbody_td_text($first_text,7,"실패");
		$first_text = hd_tbody_td_text($first_text,8,"실패");
		$name = "<a href=".$check[5].">바로가기</a>";
		$first_text = hd_tbody_td_text($first_text,9,$name);
		$cute_jy_error = $cute_jy_error.$first_text."
		</tr>
		";

	}	else{
		
		$first_text = "<tr>";
		$first_text = hd_tbody_td_text($first_text,0,$cute_jy_total_check);	
		$first_text = hd_tbody_td_text($first_text,1,"일부 실패");	
		$cute_jy_error = $cute_jy_error.$first_text.$temp_text."
		</tr>
		";;
		$cute_jy_check2+=1;//트린 사이트 
		$cute_jy_check1 += $error_check_temp ;//틀린 항목
		
	}
	
	
	
}
$cute_jy = $cute_jy_error.$cute_jy_want;

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
					<div class="panel-heading">크롤링					</div>

				</div>
			</div>



		 
  


</div>	<!--/.main-->


		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cute_jy_total_check ?></div>
							<div class="text-muted">총 크롤링 사이트</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cute_jy_check2- $cute_jy_check3  ?></div>
							<div class="text-muted">다른 사이트</div>
							
						
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cute_jy_check1 ?></div>
							<div class="text-muted">총 다른 항목</div>
						
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $cute_jy_check3 ?></div>
							<div class="text-muted">크롤링 실패</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">결과					</div>
					<div class="panel-body">	

						<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							<thead>
								<tr>

									<?php
										$num=0;
										$name="#";	hd_thead_th($num,$name);$num+=1;
										$name="결과";	hd_thead_th($num,$name);$num+=1;
										$name="작업구분";	hd_thead_th($num,$name);$num+=1;
										$name="사이트";	hd_thead_th($num,$name);$num+=1;
										$name="SKU";	hd_thead_th($num,$name);$num+=1;
										$name="제품명";	hd_thead_th($num,$name);$num+=1;
										$name="이미지";	hd_thead_th($num,$name);$num+=1;
										$name="정가";	hd_thead_th($num,$name);$num+=1;
										$name="할인가";	hd_thead_th($num,$name);$num+=1;
										$name="버튼명";	hd_thead_th($num,$name);$num+=1;
										$name="바로가기";	hd_thead_th($num,$name);$num+=1;
									?>						
								</tr>	
							<thead>
							<tbody>		
								<?php
									echo $cute_jy;
								
								
								
								
								?>	
							</tbody>		
			 			</table>	
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				</div>
				</div>
			</div>				
		</div>			

<!--Modal-->
<?php include_once('../contents_footer.php');


?>

