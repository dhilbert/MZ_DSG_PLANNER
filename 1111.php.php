<?php

$username = 'yoonhd@mz.co.kr';
$password = 'ya29.A0ARrdaM-qX5xWugS_qbpcQLBzfBAKTaDANbZAY12cQZ3w8NZFxVudGiy4-pXYmvCrFXVrzm62_sdYvtOY57M3K_FmWDmd3JQeXp2xHGBV2x76DcfAjaJIG9UycMldSQIt90VVY2YO2KeFeSvCgIy3CB4VHXd5';

$url = "https://gmail.googleapis.com/gmail/v1/users/".$username."/messages?key=".$password ."";


echo $url ;

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




print_r($ress)






?>

