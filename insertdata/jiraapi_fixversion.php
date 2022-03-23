<?php
include_once('../lib/session.php');
include_once('../lib/dbcon_MZ_DSG_PLANNER.php');




for($i = 1 ; $i < 13;$i++){
    
    

    $jira_component_name=    "2022년 ".$i."월 업무";
    $sql = "insert jiraapi_fixversion set 
                    jira_fix_name = '".$jira_component_name."',
                    jira_fix_status = 0
        
	;";
    echo $sql ;
    echo "<br>";

//	$res	=  mysqli_query($real_sock,$sql) or die(mysqli_error($real_sock));
	
}

?>