<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>브랜드입점 안내<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php include '../include/company_leftmenu.php'; ?>
		<div class="subcon_area">
			<section class="brand_regist register">
				<h1>브랜드입점 안내</h1>
				<div class="brand_regist_info">
					<h3><span class="orange">브랜드 본사</span>가 입점하는 서비스입니다.</h3>
					<span>※ <b>브랜드 본사가 입점하는 서비스</b>이오니, 브랜드의 체인지점이 신청하는 오류사항이 없도록 주의 바랍니다. </span>
					<p>브랜드 입점 서비스를 이용하시면 <b>브랜드 구인 메뉴</b>란에 브랜드가 표기되며, 결제한 상품 건수에 맞춰 해당 브랜드의 체인지점은 브랜드구인 페이지에 구인공고를 무료로 등록
할 수 있습니다. 체인지점이 브랜드구인 페이지에서 구인공고를 신청하면, 브랜드 본사 담당자의 구인공고 승인을 거쳐 구인공고가 등록됩니다. <br>	
동시 진행가능한 구인공고 건수를 모두 채웠으면 브랜드구인 페이지에 더이상 구인공고를 등록할 수 없습니다.<br>
- 예) A브랜드가 동시 진행가능한 구인공고 건수 100건을 구매했을때, A브랜드의 페이지에 진행중인 구인공고가 100건이면 더이상 구인공고 등록이 불가합니다.
					</p>
				</div>
				<div class="box_wrap">
					<h2>브랜드 정보 입력</h2>
					<table class="style1">
						<tr>
							<th>브랜드 분류<i class="axi axi-ion-android-checkmark"></i></th>
							<td>
								<select title="브랜드 분류선택" name="" id="" required>
									<option value="">일반음식점</option>
									<option value="">패스트푸드점</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>브랜드 명<i class="axi axi-ion-android-checkmark"></i></th>
							<td><input type="text"><button class="base2">중복확인</button></td>
						</tr>
						<tr>
							<th>업소로고<i class="axi axi-ion-android-checkmark"></i></th>
							<td><input type="file"><em>[ 권장 : 넓이 400px, 높이 120px ]</em></td>
						</tr>
						<tr>
							<th>사업자번호<i class="axi axi-ion-android-checkmark"></i></th>
							<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
						</tr>
						<tr>
							<th>공고승인<i class="axi axi-ion-android-checkmark"></i></th>
							<td>
								<input type="radio"><label for="" class="radiostyle1"></label>자동승인
								<input type="radio"><label for="" class="radiostyle1"></label>심사 후 승인
							</td>
						</tr>
						<tr>
							<th>홈페이지주소</th>
							<td><input type="text"></td>
						</tr>
						<tr>
							<th>브랜드 소개</th>
							<td>에디터영역</td>
						</tr>
					</table>

					<h2>브랜드 구인 담당자정보 입력<span>* 담당자가 구인공고 승인을 해주어야 구인공고가 등록됩니다.</span></h2>
					<table class="style1">
						<tr>
							<th>담당자명<i class="axi axi-ion-android-checkmark"></i></th>
							<td><input type="text"></td>
						</tr>
						<tr>
							<th>연락처<i class="axi axi-ion-android-checkmark"></i></th>
							<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><input type="text"> @ <input type="text">
								<select title="일선택" name="" id="" required hname="생일">
									<option value="">직접입력</option>
									<option value="">naver.com</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>SNS채널 ID</th>
							<td>
								<select name="" title="sns채널id"id="">
									<option value="">SNS</option>
									<option value="">카카오톡</option>
									<option value="">네이버</option>
								</select>
								<input type="text" placeholder="ID입력">
								<input type="checkbox"><label for="" class="checkstyle1"></label>SNS알림받기
								<em>* 체인지점에서 구인공고를 등록하거나, 수정했을때 알림이 오는 SNS입니다. 정확히 기입해주세요.</em>
							</td>
						</tr>
					</table>
					<div class="next_btn">
						<button class="base">다음</button>
					</div>
				</div>
			</section>
		</div>
	</section>
</div>





<!--푸터영역-->
<?php include '../include/footer.php'; ?>
