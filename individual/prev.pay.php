<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>유료 결제내역<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['pay'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="pay_list tab_style3">
				<h1>유료 결제내역</h1>
				<ul class="help_text">
					<li>회원님께서 구매하신 모든 유료서비스 이용내역을 확인할 수 있습니다.</li>
					<li>최근 3개월 이내 조회만 확인할 수 있으며, 과거 이용내역은 고객센터로 문의해 주세요.</li>	
				</ul>
				<div class="date_search">
					<ul class="fl">
						<li>조회기간&nbsp;&nbsp;</li>
						<li class="on"><button class="white">1주일</button></li>
						<li><button class="white">1개월</button></li>
						<li><button class="white">3개월</button></li>
					</ul>
					<ul class="fr">
						<li><input type="text"> ~ <input type="text"> <button class="bbcolor">검색</button></li>
						<li>
							<select name="" id="">
								<option value="">10개씩 보기</option>
								<option value="">20개씩 보기</option>
							</select>
						</li>
					</ul>
				</div>
				<table class="style3">
					<colgroup>
						<col width="55%">
						<col width="15%">
						<col width="15%">
						<col width="15%">
					</colgroup>
					<tr>
						<th>상품명</th>
						<th>결제방법</th>
						<th>포인트사용</th>
						<th>결제금액</th>
					</tr>
					<tr>
						<td colspan="4" style="padding:1.5rem .5rem">유료 결제내역이 없습니다.</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="wrap">
								<div class="pr_name tal">
									<h3>이력서or구인공고 제목 영역</h3>
									<ul>
										<li>메인 플래티넘 <span>(2022.03.17 ~ 2022.09.17)</span></li>
										<li>메인 리스트형 <span>(2022.03.17 ~ 2022.09.17)</span></li>
										<li>점프권 (100건)</li>
									</ul>
								</div>
								<div class="pay_way">
									무통장입금
								</div>
								<div class="point_us">
									<span>0</span> 원
								</div>
								<div class="payment">
									<span>576,600</span> 원
								</div>
								<div class="assi_line">
									<ul class="fl">
										<li>신청일 : 2022.02.02</li>
									</ul>
									<ul class="fr">
										<li><span class="blue">결제완료 : 2022.04.05 (14.52)</span></li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="wrap">
								<div class="pr_name tal">
									<h3>이력서or구인공고 제목 영역</h3>
									<ul>
										<li>프리미엄 패키지 상품</li>
									</ul>
								</div>
								<div class="pay_way">
									무통장입금
								</div>
								<div class="point_us">
									<span>0</span> 원
								</div>
								<div class="payment">
									<span>576,600</span> 원
								</div>
								<div class="assi_line">
									<ul class="fl">
										<li>신청일 : 2022.02.02</li>
									</ul>
									<ul class="fr">
										<li><span class="red">결제대기</span></li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="wrap">
								<div class="pr_name tal">
									<ul>
										<li>이력서 열람권 <span>(100건)</span></li>
									</ul>
								</div>
								<div class="pay_way">
									무통장입금
								</div>
								<div class="point_us">
									<span>0</span> 원
								</div>
								<div class="payment">
									<span>576,600</span> 원
								</div>
								<div class="assi_line">
									<ul class="fl">
										<li>신청일 : 2022.02.02</li>
									</ul>
									<ul class="fr">
										<li><span class="red">결제대기</span></li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</section>
			<!--페이징-->
			<?php include '../include/paging.php'; ?>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
