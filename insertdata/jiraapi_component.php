<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');


$want_rarry = array("BAT PIPA3",
                    "BAT글로", "CJ도너스캠프", "e-CRF", "EBM포럼", "EBS공고육지원", "GetFile", 
                    " GS글로벌", "GS글로벌 리뉴얼", "KFC", "KIPFA", "LG IoT샵", "LG IoT인증센터", "LG U+ 5G", "LG U+ 비디오포털", 
                    "LG상사", "LG상사-신규", "LG엔시스", "SC러닝센터", "갈라랩", "경기대원격교육원", "그로스팀 디자인파트", "글로벌CEO연구포럼", 
                    "기타프로젝트", "기타행정업무", "대한스키협회", "돌체구스토", "라이엇게임즈", "람보르기니샵 운영", 
                    "로레알_아르마니", "롯데마트 B2B", "롯데시네마 스마트오더", "롯데시네마 온라인광고영역 개발", 
                    "롯데아사히맥주제안", "메트라이프", "메트라이프 재무건강", "범한판토스", "부가가치 증대", "부산아쿠아리움", "삼성TV-A-Store", "삼성에버랜드APP", "삼성화재-마이키즈", "쌤소나이트-운영", "아사히맥주", 
                    "아시아나 WCAG 준수", "아시아나 항공 기업우대", "아시아나IDT 3개국어추가별건", "아시아나글로벌", 
                    "아시아나항공 뉴스레터", "아시아나항공 드림윙즈", "아시아나항공 마일리지", "아우디 중고차", 
                    "오서비스", "옥션도서몰", "웅진북클럽서술형수학문제", "이베이-계약관리", "이베이-계약관리-별건", 
                    "일반행정", "일본항공", 
                    "지오다노", "지오다노-모바일웹", 
                    "커버댄스", "코웨이 Q-TAS", "코웨이 마이크로페이지 개발", "코웨이 무한책임 통합", "코웨이-별건", 
                    "코웨이_C library", "코웨이_운영", "터치앤고", 
                    "파라다이스지원", "퍼시픽에이전시", "폭스바겐", "폴리텍대학", "프리홈", "한국관광공사", "한국미스미제안", "한화 Quantum X", 
                    "해피오토멤버스", "현대하이라이프손사", 
                    "현대하이카손사", "희망브리지");


for($i = 0 ; $i < count(    $want_rarry );$i++){
    
    $jira_component_name=$want_rarry[$i] ;
    $sql = "insert jiraapi_component set 
                        jira_comp_name = '".trim($jira_component_name)."',
                            jira_comp_status = 0
        
	;";
	$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
	
}

?>