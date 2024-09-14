<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>브랜드정보 관리<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php include '../include/company_leftmenu.php'; ?>
		<div class="subcon_area">
			<section class="brand_entire my_brandinfo">
				<h1>브랜드정보 관리</h1>
				<div class="no_brand"> <!--브랜드 입점하지 않은 회원에게 노출-->
					입점하지 않은 회원입니다.<br>
					브랜드 입점은 브랜드 본사가 가입하는 서비스입니다.<br><button>브랜드 입점 안내</button>
				</div>
				<div class="brand_info">
					<table class="brand_all">
						<tr>
							<th>이용기한</th>
							<td>3개월(2022.04.14 ~ 2022.05.14) 50건 <span>+  1개월(2022.05.15 ~ 2022.06.15) 50건 </span></td>
							<td class="tar"><button>서비스 연장</button></td>
						</tr>
					</table>
					<div class="infobox">
						<div>
							<p><i class="axi axi-paper"></i><a href="">진행중인 구인공고 <span>5645건</span></a></p>
							 <button>공고관리</button>
						</div>
						<div>
							<p><i class="axi axi-file-subtract"></i><a href="">승인 대기중인 공고 <span>456건</span></a></p>
							<ul>
								<li><span>16</span>건 등록가능</li>
								<li><a href="">등록가능건수 늘리기 <i class="axi axi-keyboard-arrow-right"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!--//brand_info-->
				<div class="button_area">
					<ul class="fr">
						<li><button class="bbcolor">브랜드 정보수정</button></li>
					</ul>
				</div>
				<div class="con_box">
					<div class="brand_infocon">
						<h3>브랜드 정보</h3>
						<div class="img_box">
							<p class="company"></p>
						</div>
						<div class="text_box">
							<dl>
								<dt>브랜드명</dt>
								<dd class="line1">넷퓨</dd>
								<dt>브랜드분류</dt>
								<dd class="line1">일반음식점</dd>
								<dt>사업자번호</dt>
								<dd class="line1">456-45-45645</dd>
								<dt>공고승인</dt>
								<dd class="line1">자동승인 or 심사 후 승인</dd>
							</dl>
						</div>
					</div>
					<div class="brand_manager">
						<h3>담당자 정보</h3>
						<dl>
							<dt>담당자명</dt>
							<dd class="line1">김담당</dd>
							<dt>연락처</dt>
							<dd class="line1">010-0000-0000</dd>
							<dt>이메일</dt>
							<dd class="line1">test@test.test</dd>
							<dt>SNS채널ID</dt>
							<dd class="line1">카카오톡 testid / 알림 <span class="blue">ON</span> <span class="orange">OFF</span></dd>
						</dl>
					</div>
				</div>
				<div class="brand_intro">
					<h3>브랜드 소개</h3>
					<p>브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용브랜드소개내용</p>
				</div>
			</section>
		</div>
	</section>
</div>



<!--푸터영역-->
<?php include '../include/footer.php'; ?>
