<?php
function hd_print($value1,$vaule2){
    echo $value1." : ".$vaule2."<br>";
}
$username = 'yoonhd@mz.co.kr';
$password = 'K80gueIJUonHEGUJHQ4y44E6';
$url = "https://mz-dev.atlassian.net/rest/api/latest/issue/MZNO-45859.json";

























$curl = curl_init();
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

//$result = curl_exec($curl);
$res=json_decode(curl_exec($curl),true);
hd_print("지라키",$res['key']);

hd_print("상위지라",$res['fields']['parent']['key']);
hd_print("summary",$res['fields']['summary']);


echo "수정 버전 : ";
for($i = 0 ;$i < count($res['fields']['fixVersions']) ; $i++){
   echo $res['fields']['fixVersions'][$i]['description'].",";
}
echo "<br>";

hd_print("중요도",$res['fields']['priority']['name']);

echo "라벨 : ";
for($i = 0 ;$i < count($res['fields']['labels']) ; $i++){
   echo $res['fields']['labels'][$i].",";
}
echo "<br>";

hd_print("책임자",$res['fields']['assignee']['displayName']);
hd_print("상태",$res['fields']['status']['name']);
hd_print("상태값",$res['fields']['status']['id']);


echo "components : ";
for($i = 0 ;$i < count($res['fields']['components']) ; $i++){
   echo $res['fields']['components'][$i]['name'].",";
}
echo "<br>";

hd_print("지라 생성자",$res['fields']['creator']['displayName']);
echo "하위 지라 : 없음<br>";
hd_print("지라 보고자",$res['fields']['reporter']['displayName']);

echo "~~~~~~~~~댓글~~~~~~~~";
echo "<br>";
$temps_list = $res['fields']['comment']['comments'];

for($i = 0 ;$i < count($temps_list) ; $i++){
    echo $temps_list[$i]['author']['displayName']." :".$temps_list[$i]['body']."(".$temps_list[$i]['updated'].")";
 }
 echo "<br>";

 echo "~~~~~~~~~작업로그~~~~~~~~";
 echo "<br>";
 $temps_list = $res['fields']['worklog']['worklogs'];
 echo count($temps_list);
 for($i = 0 ;$i < count($temps_list) ; $i++){


   $temp = isset($temps_list[$i]['comment']) ? $temps_list[$i]['comment'] : '댓글없음';
   $times = explode("T",$temps_list[$i]['updated']);
   
   echo $temps_list[$i]['author']['displayName']." : ".$temp."~~~~".$temps_list[$i]['timeSpent']."(".$temps_list[$i]['timeSpentSeconds'].")-".$times[0]."<br>";
  }
  echo "<br>";
 
  


?>