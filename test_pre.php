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


				
<a href="https://accounts.google.com/o/oauth2/v2/auth?
	scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fgmail.readonly%20https%3A%2F%2Fmail.google.com%2F&
	access_type=offline&
	include_granted_scopes=true&
	response_type=code&
	state=state_parameter_passthrough_value&
	redirect_uri=http://localhost/MZ_DSG_PLANNER/test.php&
	client_id=63637537412-nso7d7k6594bn8c2is3ktirev2ep7je7.apps.googleusercontent.com">oauth2 권한 얻기</a>


	<html>
<?php 



	


?>



					</div>
				</div>
			</div>
			
		</div><!--/.row-->
		





								
	</div>	<!--/.main-->
<?php include_once('contents_footer.php');?>























