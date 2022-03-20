<?php
include_once('lib/session.php');
include_once('lib/dbcon_MZ_DSG_PLANNER.php');
include_once('contents_header.php');
include_once('contents_profile.php');
include_once('contents_sidebar.php');

?>


	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
	
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="/MZ_DSG_PLANNER/home.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a> home				
				</li>

			</ol>
		</div>

	<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">권한 얻기(공사중)</div>
					<div class="panel-body">
					<div class="form-group">




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
    client_id : <input type="text" name="client_id" value="63637537412-bufv2jfof7i498d64kvqdf69ms44mdr7.apps.googleusercontent.com"><br>
     client_secret : <input type="text" name="client_secret" value="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"><br>
      redirect_uri : <input type="text" name="redirect_uri" value="http://localhost/MZ_DSG_PLANNER/test.php"><br>
      grant_type : <input type="text" name="grant_type" value="authorization_code"><br>      <input type="submit">
     </form>
     
     
     
     
     
     
     
     <script> function getHttpParam(name) { var regexS = "[\\?&]" + name + "=([^&#]*)"; var regex = new RegExp(regexS); var results = regex.exec(window.location.href); if (results == null) { return 2; } else { return results[1]; } } var ret = getHttpParam("code"); document.getElementById("codebox").value = ret; </script> </body> </html>




 


     </div>
				</div>
			</div>
			
		</div><!--/.row-->
		





								
	</div>	<!--/.main-->
<?php include_once('contents_footer.php');?>