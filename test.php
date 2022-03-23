

<?php

function hd_temp_echo($name,$value) {
    echo $name." : <input type = 'text' name = '".$name."' value='".$value."'><br>";

}
function hd_urlencode_echo($name,$value) {
    echo $name." : <input type = 'text' name = '".urlencode($name)."' value='".$value."'><br>";

}




$code = isset($_GET['code']) ? $_GET['code'] : 3;
$scope = isset($_GET['scope']) ? $_GET['scope'] : 3;
$state = isset($_GET['state']) ? $_GET['state'] : 3;

?>



<form action="https://www.googleapis.com/oauth2/v4/token" method="post" enctype="application/x-www-form-urlencoded"> 
    code : <input type="text" id="codebox" name="code"><br> 
    client_id : <input type="text" name="client_id" value="63637537412-oilcc6h898e4v4ac97m2ppusk0vuif0d.apps.googleusercontent.com"><br>
     client_secret : <input type="text" name="client_secret" value="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"><br>
      redirect_uri : <input type="text" name="redirect_uri" value="http://localhost/MZ_DSG_PLANNER/test.php"><br>
      grant_type : <input type="text" name="grant_type" value="authorization_code"><br>      <input type="submit">
     </form>
     
     
     
     
     
     
     
     <script> function getHttpParam(name) { var regexS = "[\\?&]" + name + "=([^&#]*)"; var regex = new RegExp(regexS); var results = regex.exec(window.location.href); if (results == null) { return 2; } else { return results[1]; } } var ret = getHttpParam("code"); document.getElementById("codebox").value = ret; </script> </body> </html>




 


