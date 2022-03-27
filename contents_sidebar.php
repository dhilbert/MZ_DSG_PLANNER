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
		<li <?php hd_active("slacks.php");?>><a href="/MZ_DSG_PLANNER/slacks.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>webhook테스트</a></li>
		<li <?php hd_active("test_pre.php");?>><a href="/MZ_DSG_PLANNER/test_pre.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>oauth2 승인</a></li>

		<?php

			$num		='hq-01';
			$grobal		= '지라 관리';
			$sub_name	= array('지라 생성');
			$sub_url	= array("/MZ_DSG_PLANNER/01_workflow/01_workflow.php");
			hd_drop($num,$grobal,$sub_name,$sub_url);



			$num		='hq-02';
			$grobal		= '업체별 주간 보고';
			$sub_name	= array('KBO(1식)','로레얄(2식)');
			$sub_url	= array("/MZ_DSG_PLANNER/02_weekreport/01_KBO.php","/MZ_DSG_PLANNER/02_weekreport/02_loreal.php");
			hd_drop($num,$grobal,$sub_name,$sub_url);

			$num		='hq-03';
			$grobal		= '로레알 가격 정보 크롤링';
			$sub_name	= array('설정','크롤링');
			$sub_url	= array("/MZ_DSG_PLANNER/03_crawling/01_crawling_settiong.php",
								"/MZ_DSG_PLANNER/03_crawling/01_crawling_0.php"
		
		
		);
			hd_drop($num,$grobal,$sub_name,$sub_url);
			$num		='hq-05';
			$grobal		= '지라관리';
			$sub_name	= array('동기화');
			$sub_url	= array("/MZ_DSG_PLANNER/05_jira_update/jira_update_main.php");
			hd_drop($num,$grobal,$sub_name,$sub_url);


			$num		='hq-99';
			$grobal		= '설정';
			$sub_name	= array('템플릿관리');
			$sub_url	= array("/MZ_DSG_PLANNER/99_mysettiong/99_0_mysettiong_main.php");
			hd_drop($num,$grobal,$sub_name,$sub_url);


		?>


		<!--
		
					<li <?php hd_active("jira_updat.php");?>><a href="/MZ_DSG_PLANNER/jira_update/jira_update_main.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>지라 동기화</a></li>


					<li <?php hd_active("jira_week_main.php");?>><a href="/MZ_DSG_PLANNER/jira_week/jira_week_main.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>주간 공수</a></li>


					<li <?php hd_active("member_only.php");?>><a href="/MZ_DSG_PLANNER/member_only/member_only.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>인원별 공수</a></li>
					<li <?php hd_active("jira_week_main.php");?>><a href="/MZ_DSG_PLANNER/jira_week/jira_week_main.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>브랜드 공수</a></li>
					


					<!--
					<li <?php hd_active("jira_ana_main.php");?>><a href="/MZ_DSG_PLANNER/jira_ana/jira_ana_main.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>개별 공수 분석</a></li>
			
					<li <?php hd_active("jira_ana_main.php");?>><a href="/MZ_DSG_PLANNER/jira_ana/jira_ana_detail.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>팀별 공수 분석</a></li>


-->

				<?php
					
			
/*
			



			// 본사 슈퍼 어드민일때 

			/*
			$num		='hq-2';
			$grobal		= '지라';
			$sub_name	= array('지라엑셀파일관리');
			$sub_url	= array("/MZ_DSG_PLANNER/jira/jira_main.php");
			hd_drop($num,$grobal,$sub_name,$sub_url);

			$num		='hq-3';
			$grobal		= '월간보고서';
			$sub_name	= array('BAT');
			$sub_url	= array("/MZ_DSG_PLANNER/month/bat_main.php");
			hd_drop($num,$grobal,$sub_name,$sub_url);

*/


?>				




<!--
	 <?php hd_active("");?>><a href="/MZ_DSG_PLANNER/gp/gp_main.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>공수 합계</a></li>	



	 <?php hd_active("homes.php");?>><a href="/MZ_DSG_PLANNER/homes.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>성능확인</a></li>

	
	<li <?php hd_active("");?>><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg>물품 관리</a></li>
-->
	</ul>
</div>