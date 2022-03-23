<?php
function ak_crawling($url){
    $snoopy = new Snoopy;
    $snoopy->fetch($url);
    $origin_html = $snoopy->results;    

    $want_text = explode('<img id="mainGoodsImage" src="',$origin_html);
    $want_text = explode('" alt="',$want_text[1]);
    $img =  "<img src='".$want_text[0]."'>";
    
    $want_text = explode('<strong class="c_pink"></strong>',$origin_html);
    $want_text = explode('<em class="sub">',$want_text[1]);
    $title =  $want_text[0];
    
    $want_text = explode('<dd class="ss"><i>',$origin_html);
    $want_text = explode('</i>원</dd>',$want_text[1]);
    $real_price = $want_text[0];

    $want_text = explode('<dd class="tt"><i>',$origin_html);
    $want_text = explode('</i>원</dd>',$want_text[1]);
    $dis_price = $want_text[0];

    $want_text = explode('class="sp direct" value="',$origin_html);
    $want_text = explode('"',$want_text[1]);
    $button_t  = $want_text[0];
    $want_array = array($title,$img , $real_price , $dis_price    ,$button_t         );
    return $want_array;
}    



function hmall_crawling($url){
    $snoopy = new Snoopy;
    $snoopy->fetch($url);
    $origin_html = $snoopy->results;    

    $want_text = explode('<div class="item"  data-item data-outputsrc="',$origin_html);
    $want_text = explode('?RS=1400x1400&AR=0"',$want_text[1]);
    $img =  "<img src='".$want_text[0]."'>";
    
    $want_text = explode('<strong class="prduct-name">',$origin_html);
    $want_text = explode('</strong>',$want_text[1]);
    $title =  $want_text[0];
   
    $want_text = explode('<p class="discount" aria-label="할인가">',$origin_html);
    $want_text = explode('<em>',$want_text[1]);
    $want_text = explode('</em><b>원</b>',$want_text[1]);
    $real_price = $want_text[0];


    $want_text = explode('<dl class="baroOnOff" id="crdImdDlTagTmp">',$origin_html);
    $want_text = explode('<em>',$want_text[1]);    
    $want_text = explode('</em>',$want_text[1]);
    $dis_price = $want_text[0];


    $want_text = explode('<button class="btn btn-default large btn-buy" onclick="buyDirect();"><span>',$origin_html);
    $want_text = explode('</span>',$want_text[1]);
    $button_t  = $want_text[0];
    $want_array = array($title,$img , $real_price , $dis_price    ,$button_t         );
    
    

    return $want_array;
}    


function galleria_crawling($url){
    $snoopy = new Snoopy;
    $snoopy->fetch($url);
    $origin_html = $snoopy->results;    

    
    $want_text = explode('<div class="gd_img" id="gd_img">',$origin_html);
    $want_text = explode('<img src="',$want_text[1]);
    $want_text = explode('" alt="',$want_text[1]);
    $img =  "<img src='".$want_text[0]."'>";
    
    
    $want_text = explode('<div class="gd_name">',$origin_html);
    $want_text = explode('</div>',$want_text[1]);
    $title =  $want_text[0];
   
    $want_text = explode('<div class="g_org"><em class="ir">판매가</em>',$origin_html);
    $want_text = explode('<em class="unit">원</em></div>',$want_text[1]);
    ;
    $real_price = $want_text[0];
        
    $want_text = explode('<span class="rate"><em class="ir">할인율</em><b>',$origin_html);
    $want_text = explode('</span>',$want_text[1]);
    $want_text = explode('<em class="unit">원</em>',$want_text[1]);
    $dis_price = trim($want_text[0]);


    $want_text = explode('button type="button" onclick="GOODS.fn.fnAddCart(this);" data-cart_divi_cd="20"><em>',$origin_html);
    $want_text = explode('</em>',$want_text[1]);
    $button_t  = $want_text[0];

    $want_array = array($title,$img , $real_price , $dis_price    ,$button_t         );

    

    return  $want_array;
}    



function kakao_crawling($url){
        
    $snoopy = new Snoopy;
    $snoopy->fetch($url);
    $origin_html = $snoopy->results;    

    $want_text = explode('<meta property="og:image" content="',$origin_html);
    $want_text = explode('">',$want_text[1]);
    $img =  "<img src='".$want_text[0]."'>";
    
    
    
    $want_text = explode('<meta property="og:title" content="',$origin_html);
    $want_text = explode('">',$want_text[1]);
    $title =  $want_text[0];
   
    $want_text = explode('<meta property="og:description" content="지금 카카오톡 선물하기에서 ',$origin_html);
    $want_text = explode('원">',$want_text[1]);
    $real_price = $want_text[0];
        
    $dis_price = "추적 불가능";


    
    $button_t  = "추적 불가능";

    $want_array = array($title,$img , $real_price , $dis_price    ,$button_t         );

    

    return  $want_array;
    
}    



function lotte_crawling($url){
        
    $snoopy = new Snoopy;
    $snoopy->fetch($url);
    $origin_html = $snoopy->results;    

    
$want_text = explode('meta property="og:image" content="',$origin_html);
$want_text = explode('">',$want_text[1]);
$img =  "<img src='".$want_text[0]."'>";
    
    
    
$want_text = explode('&quot;pdNm&quot;:&quot;',$origin_html);
$want_text = explode('&quot;,&quot;ageLmtCd&quot;:&quot;0&quot;,&quot;brdNo&quot;:&quot;P3686&quot;,&quot;brdNm&quot;:&quot;조르지오 아르',$want_text[1]);
    $title =  $want_text[0];
   
    
$want_text = explode(',&quot;priceInfo&quot;:{&quot;slPrc&quot;:',$origin_html);
$want_text = explode('},&quot;dlvInfo&quot;:{&quot;dvRsvDvsCd&quot;:&quot;GNRL_',$want_text[1]);
    $real_price = $want_text[0];
        
    $dis_price = "추적 불가능";


    
    $button_t  = "추적 불가능";

    $want_array = array($title,$img , $real_price , $dis_price    ,$button_t         );

    

    return  $want_array;
    
}    
    
function imall_crawling($url){
        
    $snoopy = new Snoopy;
    $snoopy->fetch($url);
    $origin_html = $snoopy->results;    


            
    $want_text = explode('<div class="thumb_product">',$origin_html);
    $want_text = explode('<img  src="',$want_text[1]);
    $want_text = explode('" onError="',$want_text[1]);
    $img =  "<img src='".$want_text[0]."'>";
    
    $want_text = explode('<span class="tit">',$origin_html);
    $want_text = explode('</span>',$want_text[1]);
    $title =  trim($want_text[0]);


    $want_text = explode('<span class="line">',$origin_html);
    $want_text = explode('</span> 원</span>',$want_text[1]);
    $real_price = $want_text[0];

    
    $want_text = explode('<span class="num">',$want_text[1]);
    $want_text = explode('</span>',$want_text[1]);
    $dis_price = $want_text[0];

    $want_text = explode('id="immOrder-btn">',$origin_html);
    $want_text = explode('</a></li>',$want_text[1]);   
   
    $button_t  = $want_text[0];

    $want_array = array($title,$img , $real_price , $dis_price    ,$button_t         );

    

    return  $want_array;
    
}    

        
    require('Snoopy.class.php');
    
?>


