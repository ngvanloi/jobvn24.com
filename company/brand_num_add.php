<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>등록가능건수 추가<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php include '../include/company_leftmenu.php'; ?>
		<div class="subcon_area">
			<section class="brand_product service">
				<h4>브랜드 구인공고 건수 추가</h4>
				 <div class="current_status">
					<p>현재 <b>[2022.04.14 ~ 2022.05.14 / 보유건수 : <span class="orange">50건</span>]</b>사용중 입니다.</p>
					<p><b class="orange">*<em> 해당 기간에서 건수만 추가</em></b>됩니다.</p>
				 </div>
				<div class="tablewrap">
					<table class="style2 fl">
						<tr>
							<th>상품안내</th>
						</tr>
						<tr>
							<td>
								<h5>브랜드 구인공고 건수 추가</h5>
								<ul class="product_info">
									<li>기간이 남아있는 상태에서 추가하는 건수입니다. <br><b>건수의 증가가 기간에 영향을 주지 않습니다.</b></li>
									<li>브랜드구인 페이지에 진행중인 채ㅆ공고를 표기할 수 있는 건수입니다.</li>
									<li>브랜드 본사가 해당 상품을 구매하면, 체인지점들은 구매된 건수에 맞게 구인공고를 무료로 등록할 수 있습니다.</li>
									<li>체인지점이 브랜드구인 페이지에 구인공고를 신청하면, <b>브랜드 본사 담당자의 구인공고 승인을 거쳐 구인공고가 등록</b>됩니다.</li>
									<li>동시 진행가능한 구인공고 건수를 모두 채웠으면 브랜드구인 페이지에 구인공고를 더이상 등록할 수 없습니다.</li>
									<li></li>
								</ul>
							</td>
						</tr>
					</table>

					<table class="style2 fr tac">
						<tr>
							<th>동시 진행가능한 구인공고 건수 추가</th>
							<th>건당 금액</th>
						<tr>
							<td>
								<button><i class="axi axi-minus"></i></button>
								<input type="text">
								<button><i class="axi axi-plus"></i></button>
							</td>
							<td class="price tar">
								<p class="sale"><span>10%</span>90,000원</p>
								<p><em>100,000</em>원</p>
							</td>
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
								<th>상품내용</th>
								<th>금액</th>
							</tr>
							<tr>
								<td>브랜드 구인공고 건수 추가</td>
								<td class="tal">456건</td>
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
										<li><input type="radio" id=""><label for="" class="radiostyle1" ></label> 신용카드</li>
										<li><input type="radio" id=""><label for="" class="radiostyle1" ></label> 실시간 계좌이체</li>
										<li><input type="radio" id=""><label for="" class="radiostyle1" ></label> 휴대폰</li>
										<li><input type="radio" id=""><label for="" class="radiostyle1" ></label> 무통장입금</li>
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
								<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 발급
									<ul class="li_float">
										<li><input type="radio" id="" name=""><label for=""  name="" class="radiostyle1" ></label>소득공제용(일반개인용)</li>
										<li><input type="radio" id="" name=""><label for=""  name="" class="radiostyle1" ></label>지출증빙용(사업자용)</li>
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
	</section>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>
