<?php

require('Snoopy.class.php');

$snoopy = new Snoopy;


$uri = 'https://www.discoverglo.co.kr';

$auth['email'] = 'jini1237@naver.com'; 
$auth['password'] = 'Asdf1020';


$snoopy->submit($uri,$auth);


$snoopy->setcookies;

$origin_html = $snoopy->fetch($uri);



?>


