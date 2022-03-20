<?php
//https://accounts.google.com/o/oauth2/v2/auth


function hd_temp_echo($name,$value) {
    echo $name." : <input type = 'text' name = '".$name."' value='".urldecode($value)."'><br>";

}


$code = isset($_GET['code']) ? $_GET['code'] : 3;
$scope = isset($_GET['scope']) ? $_GET['scope'] : 3;
$state = isset($_GET['state']) ? $_GET['state'] : 3;

?>

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


<p>~~~~~~~~~~~~~~~~~~~~~<p>
<form name="frm" role="form" method="get" action="https://accounts.google.com/o/oauth2/v2/auth">
        <?php
            hd_temp_echo('code',$code);
            hd_temp_echo('client_id','63637537412-2m50g234bj15beqah1fmgmni3ae8o3q1.apps.googleusercontent.com');
            hd_temp_echo('client_secret','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');
            echo "redirect_uri : <input type = 'text' name = 'redirect_uri' value='http://localhost/MZ_DSG_PLANNER/test.php'><br>";
            hd_temp_echo('grant_type','authorization_code');
            
            
    
            
            
            
            
        
        ?>
        
        
<input  type='submit' value = '2차'>
</form>