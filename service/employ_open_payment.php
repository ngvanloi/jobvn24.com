<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>이력서 열람권 구매<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260">
	<section class="sub service service_sub">
		<h4 id="resume"><span class="orange">구인정보 열람권</span> 상품 <button>서비스 신청</button></h4>
		<div class="tablewrap resume_open">
			<table class="style2">
				<tr>
					<th>서비스 안내</th>
					<th>건수</th>
					<th>금액</th>
					<th class="choice">선택</th>
				</tr>
				<tr>
					<td rowspan="2">
						<h5>구인정보 열람권</h5>
						<ul class="product_info">
							<li>구인정보를 열람할 수 있는 열람권입니다.</li>
						</ul>
					</td>
					<td class="tac">1건</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1건</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
			</table>
		</div>
		<!--//tablewrap-->

		<h4 class="orange">결제안내</h4>
		<div class="payment register ">
			<div class="payment_box">
				<h5>신청상품</h5>
				<table class="style2 tac">
					<colgroup>
						<col width="25%">
						<col width="50%">
						<col width="25%">
					</colgroup>
					<tr>
						<th>상품명</th>
						<th>상품안내</th>
						<th>금액</th>
					</tr>
					<tr>
						<td>구인정보 열람권</td>
						<td class="tal">100건</td>
						<td><span class="orange">5,000</span>원</td>
					</tr>
				</table>
				<div class="all_pay">
					<p>신청상품 합계금액</p>	
					<p><span class="orange">10,000</span>원</p>
				</div>

				<h5>결제정보</h5>
				<table class="style1">
					<tr>
						<th>신청상품 합계</th>
						<td><span class="orange">10,000</span>원</td>
					</tr>
					<tr>
						<th>할인내역</th>
						<td><input type="text"> 포인트 <button class="base2">사용하기</button><br>보유 포인트 : <b>2,100</b>포인트</td>
					</tr>
					<tr>
						<th>최종 결제금액</th>
						<td><span class="red">10,000</span>원</td>
					</tr>
				</table>

				<h5>결제수단 선택</h5>
				<table class="style1">
					<tr>
						<th>결제방법<i class="axi axi-ion-android-checkmark"></i></th>
						<td>
							<ul class="li_float">
								<li><label  name=""><input type="radio" id=""> 신용카드</label></li>
								<li><label  name=""><input type="radio" id=""> 실시간 계좌이체</label></li>
								<li><label  name=""><input type="radio" id=""> 휴대폰</label></li>
								<li><label  name=""><input type="radio" id=""> 무통장입금</label></li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>입금은행<i class="axi axi-ion-android-checkmark"></i></th>
						<td>
							<select name="" id="">
								<option value="">입금은행 선택</option>
							</select>
						</td>
					<tr>
						<th>입금자명<i class="axi axi-ion-android-checkmark"></i></th>
						<td><input type="text"></td>
					</tr>
					<tr>
						<th>현금영수증</th>
						<td><label ><input type="checkbox" id=""> 발급</label>
							<ul class="li_float">
								<li><label  name=""><input type="radio" id="" name="">소득공제용(일반개인용)</label></li>
								<li><label  name=""><input type="radio" id="" name="">지출증빙용(사업자용)</label></li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>소득공제용(일반개인용)</th>
						<td>
							<select name="" id="">
								<option value="">주민등록번호</option>
							</select>
							<input type="text">
						</td>
					</tr>
					<tr>
						<th>지출증빙용(사업자용)</th>
						<td class="size1">사업자등록번호 <input type="text"> - <input type="text"> -<input type="text"></td>
					</tr>
				</table>
				<div class="next_btn">
					<button class="base">결제하기</button>
				</div>
			</div>
		</div>
		<!--//payment-->
	</section>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>

