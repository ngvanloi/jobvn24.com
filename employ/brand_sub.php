<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>브랜드구인<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 MAT20">
	<section class="brand_sub sub">
		<h1>브랜드 구인</h1>
		<div class="top_btn_area">
			<ul class="fl">
				<li><button>구인공고 등록하기 <i class="axi axi-ion-arrow-right-c"></i></button></li>
			</ul>
			<ul class="fr">
				<li>
					<select name="" id="">
						<option value="">브랜드 분류선택</option>
						<option value="">일반 음식점</option>
					</select>
					<select name="" id="">
						<option value="">브랜드 선택</option>
						<option value="">국수나무</option>
					</select>
					<button>검색</button>
				</li>
			</ul>
		</div>
		<div class="brand_title">
			<p class="name"><a href="">이디야커피</a></p><!--업소정보로 링크 이동-->
			<p class="logo"></p>
		</div>
		<div class="brand_intro">
			브랜드소개 영역
		</div>
	</section>

	<section class="jobtable sub">
		<div class="side_con">
			<h1>Thông tin việc làm<span>총<em class="red">4</em>건</span></h1>
			<div class="select_area">
				<select name="" id="">
					<option value="">최근등록순</option>
					<option value="">모집마감일 빠른순</option>
					<option value="">모집마감일 느린순</option>
				</select>
				<select name="" id="">
					<option value="">20개씩보기</option>
					<option value="">30개씩보기</option>
				</select>
			</div>
		</div>
		<table>
			<colgroup>
				<col width="18%">
				<col width="45%">
				<col width="13%">
				<col width="12%">
				<col width="12%">
			</colgroup>	
			<tr>
				<th>업소명</th>
				<th>구인 정보</th>
				<th>급여</th>
				<th>경력</th>
				<th>모집마감일</th>
			</tr>
		</table>
		<div class="no_content">
			<p>구인중인 공고가 없습니다.</p>
		</div>
		<div class="job_box"><!--반복-->
			<div class="name">
				<h2><button><i class="axi axi-star3 scrap"></i></button>(주)케이시씨</h2>
			</div>
			<div class="resume_info">
				<a href="">
					<p class="title line1">방송통신 공무업무 담당자 및 삼성전자 방송시스템 운영관리자 구인</p>
					<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
					<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
				</a>
			</div>	
			<div class="pay tac">
				<p><span class="sstyle ysalary">연</span> 50,000,000원</p>
			</div>
			<div class="career tac">
				<p>2년</p>
			</div>
			<div class="date tac">
				<p>2022.05.12</p>
			</div>
		</div><!--//반복-->
		<div class="job_box"><!--반복-->
			<div class="name">
				<h2><button><i class="axi axi-star-o"></i></button>(주)케이시씨</h2>
			</div>
			<div class="resume_info">
				<a href="">
					<p class="title line1">방송통신 공무업무 담당자 및 삼성전자 방송시스템 운영관리자 구인</p>
					<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
					<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
				</a>
			</div>	
			<div class="pay tac">
				<p><span class="sstyle ysalary">연</span> 50,000,000원</p>
			</div>
			<div class="career tac">
				<p>2년</p>
			</div>
			<div class="date tac">
				<p>2022.05.12</p>
			</div>
		</div><!--//반복-->
	</section>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>