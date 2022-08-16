<?php
function hd_active($input){
	$uri=explode('/',$_SERVER['REQUEST_URI']);
		if($uri[2]==$input){
		echo "class='active'";}
}
function hd_drop($num,$grobal,$sub_name,$sub_url){
?>

<li class="parent ">
		<a href="#">
		<span data-toggle="collapse" href="#sub-item-<?php echo $num;?>"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> <?php echo $grobal?> </span>
		</a>
		<ul class="children collapse" id="sub-item-<?php echo $num;?>">
		<?php
		for($i = 0 ; $i <count($sub_name);$i++){
		?>
			<li>
				<a class="" href="<?php echo $sub_url[$i];?>">
					<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> <?php echo $sub_name[$i];?>
				</a>
			</li>
		<?php
		}?>
		</ul>
	</li>
<?php
}
?>


	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
				
			</div>

		</form>

		<ul class="nav menu" >
		<li <?php hd_active("home.php");?>><a href="/MZ_DSG_PLANNER/home.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>Home</a></li>
		<?php
			$num		='hq-05';
			$grobal		= '지라관리';
			$sub_name	= array('동기화','일자 수정','업체관리');
			$sub_url	= array("/MZ_DSG_PLANNER/05_jira_update/jira_update_main.php",
			 					"/MZ_DSG_PLANNER/05_jira_update/jira_update_main_date.php",
								"/MZ_DSG_PLANNER/02_weekreport/01_setting.php"
							
							
							);
			hd_drop($num,$grobal,$sub_name,$sub_url);
		?>				
		<li <?php hd_active("02_loreal.php");?>><a href="/MZ_DSG_PLANNER/02_weekreport/02_loreal.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>주간 보고</a></li>



	</ul>
</div>