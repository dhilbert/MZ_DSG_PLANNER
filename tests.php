<?php
//https://accounts.google.com/o/oauth2/v2/auth


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



<html> <body> <style> input{ width:300px; } </style> <form action="https://www.googleapis.com/oauth2/v4/token" method="post" enctype="application/x-www-form-urlencoded"> 
    code : <input type="text" id="codebox" name="code"><br> 
    client_id : <input type="text" name="client_id" value=126535204254-l050qbdjopjg49j90bucm88uptnrmari.apps.googleusercontent.com"><br>
     client_secret : <input type="text" name="client_secret" value="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"><br>
      redirect_uri : <input type="text" name="redirect_uri" value="http://localhost/MZ_DSG_PLANNER/test.php"><br>
       grant_type : <input type="text" name="grant_type" value="authorization_code"><br> <input type="submit">
     </form>
     
     
     
     
     
     
     
     <script> function getHttpParam(name) { var regexS = "[\\?&]" + name + "=([^&#]*)"; var regex = new RegExp(regexS); var results = regex.exec(window.location.href); if (results == null) { return 2; } else { return results[1]; } } var ret = getHttpParam("code"); document.getElementById("codebox").value = ret; </script> </body> </html>























<?php


/*
https://accounts.google.com/o/oauth2/v2/auth


<p>~~~~~~~~~~~~~~~~~~~~~<p>
<form name="frm" role="form" method="get" action="https://accounts.google.com/o/oauth2/v2/auth">
        <?php
           // hd_urlencode_echo('code',$code);
            hd_temp_echo('client_id','63637537412-2m50g234bj15beqah1fmgmni3ae8o3q1.apps.googleusercontent.com');
           // hd_temp_echo('client_secret','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');
            echo "redirect_uri : <input type = 'text' name = 'redirect_uri' value='http://localhost/MZ_DSG_PLANNER/test.php'><br>";
           // hd_temp_echo('grant_type','authorization_code');
            hd_temp_echo('response_type','code');
            hd_temp_echo('scope','https://mail.google.com');

        
        ?>
        
        
<input  type='submit' value = '2차'>
</form>

<form name="frm" role="form" method="get" action="https://accounts.google.com/o/oauth2/v2/auth">
    <?php
            hd_temp_echo('scope','https%3A//www.googleapis.com/auth/drive.metadata.readonly');
            hd_temp_echo('access_type','offline');
            hd_temp_echo('include_granted_scopes','true');
            hd_temp_echo('response_type','code');
            hd_temp_echo('state',$state);

            
            echo "redirect_uri : <input type = 'text' name = 'redirect_uri' value='http://localhost/MZ_DSG_PLANNER/test.php'><br>";
    
            
            hd_temp_echo('client_id','63637537412-2m50g234bj15beqah1fmgmni3ae8o3q1.apps.googleusercontent.com');
            
            
        
        ?>
        
        
<input  type='submit' >
</form>
*/
?>