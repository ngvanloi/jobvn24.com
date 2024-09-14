<!DOCTYPE HTML>
<html lang="ko" id="no-fouc">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible">
		<meta name="Generator" content="">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<script src="../../_helpers/_js/jquery-3.5.1.js"></script>
		<link rel="stylesheet" type="text/css" href="../../css/admin_style.css">
		<link rel="stylesheet" type="text/css" href="../../css/default.css">

	</head>
	
	<script type="text/javascript">
	$(function(){
		var para = location.href.split("#");
		var para2 = para[1].split("-");
		$(".menu_1d > li").removeClass("on");
		$(".menu_1d").find("ul.menu_2d").css({"display":"none"});
		$(".menu_1d > li#"+para2[0]+'-head').addClass("on");
		$(".menu_1d > li#"+para2[0]+'-head').find("ul.menu_2d").css({"display":"block"});
	});
	</script>
	<body>
		<div class="guide_wrap">
			<section class="guide_menu">
				<h1>메뉴얼</h1>
				<ul class="menu_1d">
					<li class="on" id="guide1-head"><span>구인구직관리</span>
						<ul class="menu_2d">
							<li><em class="col1"></em>구인구직관리</li>
							<li><a href="#guide1-1">전체구인공고관리</a></li>
							<li><a href="#guide1-2">이력서관리</a></li>
						</ul>
					</li>
					<li id="guide2-head"><span>환경설정</span>
						<ul class="menu_2d">
							<li><em class="col2"></em>환경설정</li>
							<li><a href="#guide2-1">기본정보설정</a></li>
							<li><a href="#guide2-2">업소회원 가입폼설정</a></li>
							<li><a href="#guide2-3">구인정보 항목설정</a></li>
							<li><a href="#guide2-5">분류관리</a></li>
						</ul>
					</li>
					<li id="guide3-head"><span>회원관리</span>
						<ul class="menu_2d">
							<li><em class="col3"></em>회원관리</li>
							<li><a href="#guide3-1">전체회원관리</a></li>
							<li><a href="#guide3-2">회원등급/포인트설정</a></li>
							<li><a href="#guide3-3">업소회원관리</a></li>
							<li><a href="#guide3-4">개인회원관리</a></li>
							<li><a href="#guide3-5">회원메일발송</a></li>
							<li><a href="#guide3-6">회원문자발송</a></li>
							<li><a href="#guide3-7">맞춤메일발송</a></li>
						</ul>
					</li>
					<li id="guide4-head"><span>디자인관리</span>
						<ul class="menu_2d">
							<li><em class="col4"></em>디자인관리</li>
							<li><a href="#guide4-1">사이트디자인설정</a></li>
							<li><a href="#guide4-2">서비스명설정</a></li>
							<li><a href="#guide4-3">배너관리</a></li>
							<li><a href="#guide4-4">MAIL스킨관리</a></li>
						</ul>
					</li>
					<li id="guide5-head"><span>결제관리</span>
						<ul class="menu_2d">
							<li><em class="col5"></em>결제관리</li>
							<li><a href="#guide5-1">결제페이지설정</a></li>
							<li><a href="#guide5-2">서비스별금액설정</a></li>
							<li><a href="#guide5-3">결제통합관리</a></li>
							<li><a href="#guide5-4">패키지설정</a></li>
						</ul>
					</li>
					<li id="guide6-head"><span>커뮤니티관리</span>
						<ul class="menu_2d">
							<li><em class="col6"></em>커뮤니티관리</li>
							<li><a href="#guide6-1">게시판관리</a></li>
							<li><a href="#guide6-2">게시판 메인설정</a></li>
							<li><a href="#guide6-3">메인게시판 출력설정</a></li>
						</ul>
					</li>
				</ul>
			</section>
			
			<section class="guide_design">
				<h1>구인구직관리</h1>
				
				<!-- 구인구직관리 - 전체구인공고관리 -->
				<div class="box_wrap" id="guide1-1">
					<dl>
						<dt class="col1">전체구인공고관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide1-1.gif" alt="">
					</div>
				</div>

				<!-- 구인구직관리 - 이력서관리 -->
				<div class="box_wrap" id="guide1-2">
					<dl>
						<dt class="col1">이력서관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide1-2.gif" alt="">
					</div>
				</div>

				<h1>환경설정</h1>
				<!--환경설정 - 기본정보설정-->
				<div class="box_wrap" id="guide2-1">
					<dl>
						<dt class="col2">기본정보설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide2-1.gif" alt="" usemap="#guide2-1.gif">
						<map name="guide2-1.gif">
							<area shape="rect" coords="178,1817,250,1841"  href="#none"  onclick="void(window.open('../pop/bbaton_guide.html','','width=965,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
							<area shape="rect" coords="596,2864,659,2883"  href="#none"  onclick="void(window.open('../pop/facebook_guide.html','','width=815,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
							<area shape="rect" coords="596,2915,658,2934"  href="#none"  onclick="void(window.open('../pop/facebook_guide.html','','width=815,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
							<area shape="rect" coords="596,2966,658,2984"  href="#none"  onclick="void(window.open('../pop/twitter_guide.html','','width=815,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
							<area shape="rect" coords="598,3020,659,3038"  href="#none"  onclick="void(window.open('../pop/twitter_guide.html','','width=815,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
							<area shape="rect" coords="597,3068,659,3086"  href="#none"  onclick="void(window.open('../pop/kakao_guide.html','','width=815,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
							<area shape="rect" coords="597,3120,658,3138"  href="#none"  onclick="void(window.open('../pop/naver_guide.html','','width=815,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
							<area shape="rect" coords="597,3172,658,3191"  href="#none"  onclick="void(window.open('../pop/naver_guide.html','','width=815,height=900,resizable=no,scrollbars=yes'))" target="" alt="" />
						</map>
					</div>
				</div>

				<!--환경설정 - 업소회원 가입폼 설정-->
				<div class="box_wrap" id="guide2-2">
					<dl>
						<dt class="col2">업소회원 가입폼 설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide2-2.gif" alt="">
					</div>
				</div>

				<!--환경설정 - 구인정보 항목 설정-->
				<div class="box_wrap" id="guide2-3">
					<dl>
						<dt class="col2">구인정보 항목 설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide2-3.gif" alt="">
					</div>
				</div>


				<!--환경설정 - 분류관리-->
				<div class="box_wrap" id="guide2-5">
					<dl>
						<dt class="col2">분류관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide2-5.gif" alt="">
					</div>
				</div>

				<h1>회원관리</h1>
				<!--회원관리 - 전체회원관리-->
				<div class="box_wrap" id="guide3-1">
					<dl>
						<dt class="col3">전체회원관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide3-1.gif" alt="">
					</div>
				</div>

				<!--회원관리 - 회원등급/포인트설정-->
				<div class="box_wrap" id="guide3-2">
					<dl>
						<dt class="col3">회원등급/포인트설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide3-2.gif" alt="">
					</div>
				</div>

				<!--회원관리 - 업소회원관리-->
				<div class="box_wrap" id="guide3-3">
					<dl>
						<dt class="col3">업소회원관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide3-3.gif" alt="">
					</div>
				</div>

				<!--회원관리 - 개인회원관리-->
				<div class="box_wrap" id="guide3-4">
					<dl>
						<dt class="col3">개인회원관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide3-4.gif" alt="">
					</div>
				</div>

				<!--회원관리 - 회원MAIL발송-->
				<div class="box_wrap" id="guide3-5">
					<dl>
						<dt class="col3">회원메일발송</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide3-5.gif" alt="">
					</div>
				</div>

				<!--회원관리 - 회원SMS발송-->
				<div class="box_wrap" id="guide3-6">
					<dl>
						<dt class="col3">회원문자발송</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide3-6.gif" alt="">
					</div>
				</div>

				<!--회원관리 - 맞춤메일발송 -->
				<div class="box_wrap" id="guide3-7">
					<dl>
						<dt class="col3">맞춤메일발송</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide3-7.gif" alt="">
					</div>
				</div>

				<h1>디자인관리</h1>
				<!--디자인관리 - 사이트디자인설정-->
				<div class="box_wrap" id="guide4-1">
					<dl>
						<dt class="col4">사이트디자인설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide4-1.gif" alt="">
					</div>
				</div>

				<!--디자인관리 - 서비스명설정-->
				<div class="box_wrap" id="guide4-2">
					<dl>
						<dt class="col4">서비스명설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide4-2.gif" alt="">
					</div>
				</div>

				<!--디자인관리 - 배너관리-->
				<div class="box_wrap" id="guide4-3">
					<dl>
						<dt class="col4">배너관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide_banner.jpg" alt="">
					</div>
				</div>

				<!--디자인관리 - MAIL스킨관리-->
				<div class="box_wrap" id="guide4-4">
					<dl>
						<dt class="col4">MAIL스킨관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide4-4.gif" alt="">
					</div>
				</div>

				<h1>결제관리</h1>
				<!--결제관리 -결제페이지설정-->
				<div class="box_wrap" id="guide5-1">
					<dl>
						<dt class="col5">결제페이지설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide5-1.gif" alt="">
					</div>
				</div>
					
				<!--결제관리 - 서비스별금액설정-->
				<div class="box_wrap" id="guide5-2">
					<dl>
						<dt class="col5">서비스별금액설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide5-2.gif" alt="">
					</div>
				</div>

				<!--결제관리 - 결제통합관리-->
				<div class="box_wrap" id="guide5-3">
					<dl>
						<dt class="col5">결제통합관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide5-3.gif" alt="">
					</div>
				</div>

				<!--결제관리 - 패키지설정-->
				<div class="box_wrap" id="guide5-4">
					<dl>
						<dt class="col5">패키지설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide5-4.gif" alt="">
					</div>
				</div>

				<!--커뮤니티관리 - 게시판관리-->
				<div class="box_wrap" id="guide6-1">
					<dl>
						<dt class="col5">게시판관리</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide6-1.gif" alt="">
					</div>
				</div>

				<!--커뮤니티관리 - 게시판 메인설정-->
				<div class="box_wrap" id="guide6-2">
					<dl>
						<dt class="col5">게시판 메인설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide6-2.gif" alt="">
					</div>
				</div>

				<!--커뮤니티관리 - 메인게시판 출력설정-->
				<div class="box_wrap" id="guide6-3">
					<dl>
						<dt class="col5">메인게시판 출력설정</dt>
						<dd></dd>
					</dl>
					<div class="img_area">
						<img src="../../images/nad/guide6-3.gif" alt="">
					</div>
				</div>

				
			</section>
		</div>

		<script>
			$(".menu_1d>li").mouseover(function(){
				$(".menu_1d>li").removeClass("on");
				$(this).addClass("on");
				$(this).children('ul').show()
				$(this).siblings().children('ul').hide()
			});
		</script>
	</body>
</html>

