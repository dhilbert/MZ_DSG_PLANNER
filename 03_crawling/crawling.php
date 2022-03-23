<?php
$url = 'https://www.akmall.com/goods/GoodsDetail.do?goods_id=100026863';//AK
$url = 'https://www.galleria.co.kr/goods/initDetailGoods.action?goods_no=2101742518';//Galleria 
$url = 'https://www.hmall.com/p/pda/itemPtc.do?slitmCd=2135096658';//Hmall  

$url = 'http://www.ssg.com/item/itemView.ssg?itemId=1000039917198';//ssg 크롤링 불가
$url = 'http://www.lotteimall.com/goods/viewGoodsDetail.lotte?goods_no=1913552635';//Imall 
$url = 'https://www.discoverglo.co.kr/cpanel';//

$url = 'https://www.lotteon.com/p/product/LE1208998277';//LOTTE   됨
$url = 'https://www.akmall.com/goods/GoodsDetail.do?goods_id=100026863';//AK
$url = 'https://www.lotteon.com/p/product/LE1208998277';//LOTTE   됨





$url = 'https://www.lotteon.com/p/product/LE1208998277';//LOTTE   됨




    $url = 'https://www.lotteon.com/p/product/LE1208998277';//LOTTE   됨
    $url = 'http://www.ssg.com/item/itemView.ssg?itemId=1000039917198';//ssg 크롤링 불가

    $url = 'https://www.hmall.com/p/pda/itemPtc.do?slitmCd=2137499009';//AK


    $url = 'https://www.akmall.com/goods/GoodsDetail.do?goods_id=100026863';//AK
    $url = 'https://www.akmall.com/goods/GoodsDetail.do?goods_id=100026855';//AK

//Snoopy.class.php를 불러옵니다
require('Snoopy.class.php');
 
 
//스누피를 생성해줍시다
$snoopy = new Snoopy;
 
//스누피의 fetch함수로 제 웹페이지를 긁어볼까요? :)
$snoopy->fetch($url);
$temp = $snoopy->results;


$want_text = explode('<img id="mainGoodsImage" src="',$temp);
$want_text = explode('" alt="',$want_text[1]);
echo "<img src='".$want_text[0]."'>";

/*

$want_text = explode('" alt="',$want_text[0]);
$want_text = explode('<img src="',$want_text[0]);
echo "<img src='".$want_text[1]."'>";

/*
<img id="mainGoodsImage" src="
//photo.akmall.com/image3/goods/00/02/68/63/100026863_M_350.jpg" alt="[조르지오 아르마니]디자이너 리프트 블루파운데이션" width="348" height="348" onerror="noImage(this, 350)">



//결과는 $snoopy->results에 저장되어 있습니다
//preg_match 정규식을 사용해서 이제 본문인 article 요소만을 추출해보도록 하죠
preg_match('/<div class="goods_info">(.*?)<\/div>/is', $snoopy->results, $text);
 
//이제 결과를 보면...?
echo $text[1];





//preg_match('/<div class="goods_info">(.*?)<\/div>/is', $snoopy->results, $text);
preg_match('/<div class="info_top">(.*?)<\/div>/is', $snoopy->results, $text);



//이제 결과를 보면...?
print_r($text);
//preg_match('/<div class="goods_info">(.*?)<\/div>/is', $snoopy->results, $text);
preg_match('/<li class="c_price">(.*?)<\/li>/is', $snoopy->results, $text);



//이제 결과를 보면...?
print_r($text);


//결과는 $snoopy->results에 저장되어 있습니다
//preg_match 정규식을 사용해서 이제 본문인 article 요소만을 추출해보도록 하죠
preg_match('/<div class="contentArea el">(.*?)<\/div>/is', $snoopy->results, $text);
 
echo $snoopy->results;

$dom = new DOMDocument;
$dom->loadHTML($snoopy->results);



//이제 결과를 보면...?
print_r($text);
*/
?>


