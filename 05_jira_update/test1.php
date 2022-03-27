<?php
function hd_print($value1,$vaule2){
    echo $value1." : ".$vaule2."<br>";
}
$username = 'yoonhd@mz.co.kr';
$password = 'K80gueIJUonHEGUJHQ4y44E6';
$url = "https://mz-dev.atlassian.net/rest/api/latest/search?jql=updated>=-1w";

$curl = curl_init();
curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

//$result = curl_exec($curl);
$ress=json_decode(curl_exec($curl),true);



for($j=0;$j<count($ress['issues']);$j++){
   echo $ress['issues'][$j]['key'];
   echo "<br>";
}

?>