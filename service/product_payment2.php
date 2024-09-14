<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>상품선택 및 결제<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>

<!-- 개인 상품서비스-->
<div class="wrap1260 MAT20">
	<section class="sub service service_sub">
		<ul class="service_quick">
			<li><a href="#employ">구인정보 열람권</a></li>
			<li><a href="#package">패키지상품</a></li>
			<li class="on"><a href="#main">메인페이지</a></li>
			<li><a href="#injae">서브 인재정보 페이지</a></li>
			<li><a href="#hurry">급구인재 페이지</a></li>
			<li><a href="#accent">강조옵션 상품</a></li>
			<li><a href="#jump">점프서비스</a></li>
		</ul>

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
							<li>구인정보를 열럼할 수 있는 열람권입니다.</li>
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
					
		<h4 id="package"><span class="orange">패키지</span> 상품 <button>서비스 신청</button></h4>
		<div class="tablewrap package">
			<table class="style2">
				<colgroup>
					<col width="20%">
					<col width="%">
					<col width="10%">
				</colgroup>
				<tr>
					<th>패키지 명</th>
					<th>패키지 내용</th>
					<th>금액</th>
					<th class="choice">선택</th>
				</tr>
				<tr>
					<td class="tac">프리미엄 패키지 상품</td>
					<td>개인서비스 패키지 내용~~
						<ul class="product_info">
							<li>패키지설명글</li>
						</ul>
					</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">프리미엄 패키지 상품</td>
					<td>개인서비스 패키지 내용~~
						<ul class="product_info">
							<li>패키지설명글</li>
						</ul>
					</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
			</table>
		</div>
		<!--//tablewrap-->

		<h4 id="main"><span class="orange">메인페이지</span> 상품 <button>서비스 신청</button></h4>
		<div class="tablewrap indi_product">
			<table class="style2 fl">
				<tr>
					<th>미리보기</th>
				</tr>
				<tr>
					<td class="tac"><img src="../images/indi_main_product.jpg" alt="메인페이지 상품"></td>
				</tr>
			</table>
			<table class="style2 fr">
				<colgroup>
					<col width="53%">
					<col width="21%">
					<col width="26%">
				</colgroup>
				<tr>
					<th>서비스명</th>
					<th colspan="3">기간선택</th>
				</tr>
				<tr>
					<td rowspan="6">
						<span class="area_f">A영역</span>
						<h5>메인 포커스 인재정보<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>메인페이지 포커스 인재정보 영역 고정 등록</li>
							<li>아이콘 무료</li>
							<li>일반리스트 무료 등록</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<th colspan="3">포커스 전용 아이콘선택</th>
				</tr>
				<tr>
					<td colspan="3">
						<span class="orange" style="font-size:13px; ">*  최대 3개까지 선택 가능</span>
						<ul class="li_float img_icon">
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon1.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon2.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon3.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon4.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon5.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon6.jpg" alt=""></li>
						</ul>
					</td>
				</tr>
				<tr>
					<td rowspan="4">
						<span class="area_f">B영역</span>
						<h5>메인 플러스 인재정보<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>메인페이지 플러스 인재정보 영역 고정 등록</li>
							<li>아이콘 무료</li>
							<li>일반리스트 무료 등록</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
			</table>

			<table class="style2 fl MAT10">
				<tr>
					<th>미리보기</th>
				</tr>
				<tr>
					<td class="tac"><img src="../images/indi_main_product_line.jpg" alt="메인페이지 상품"></td>
				</tr>
			</table>
			<table class="style2 fr MAT10">
				<colgroup>
					<col width="53%">
					<col width="21%">
					<col width="26%">
				</colgroup>
				<tr>
					<th>서비스명</th>
					<th colspan="3">기간선택</th>
				</tr>
				<tr>
					<td rowspan="4">
						<h5>메인 인재정보 테두리강조<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>메인 포커스 인재정보 상품과 메인 플러스 인재정보 상품을 이용하는 고객전용입니다.</li>
							<li>테두리 라인을 색상으로 처리해 이력서를 강조해줍니다.</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
			</table>
		</div>
		<!--//tablewrap-->

		<h4 id="injae"><span class="orange">서브 인재정보 페이지</span> 상품 <button>서비스 신청</button></h4>
		<div class="tablewrap indi_product">
			<table class="style2 fl">
				<tr>
					<th>미리보기</th>
				</tr>
				<tr>
					<td class="tac"><img src="../images/indi_injae_product.jpg" alt="인재페이지 상품"></td>
				</tr>
			</table>
			<table class="style2 fr">
				<colgroup>
					<col width="53%">
					<col width="21%">
					<col width="26%">
				</colgroup>
				<tr>
					<th>서비스명</th>
					<th colspan="3">기간선택</th>
				</tr>
				<tr>
					<td rowspan="6">
						<span class="area_f">A영역</span>
						<h5>서브 포커스 인재정보<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>서브 인재정보 페이지 포커스 영역 고정 등록</li>
							<li>아이콘 무료</li>
							<li>일반리스트 무료 등록</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<th colspan="3">포커스 전용 아이콘선택</th>
				</tr>
				<tr>
					<td colspan="3">
						<span class="orange" style="font-size:13px; ">*  최대 3개까지 선택 가능</span>
						<ul class="li_float img_icon">
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon1.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon2.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon3.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon4.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon5.jpg" alt=""></li>
							<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label><img src="../images/injae_icon6.jpg" alt=""></li>
						</ul>
					</td>
				</tr>
				<tr>
					<td rowspan="4">
						<span class="area_f">B영역</span>
						<h5>서브 플러스 인재정보<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>서브 인재정보 페이지 플러스 영역 고정 등록</li>
							<li>일반리스트 무료 등록</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
			</table>

			<table class="style2 fl MAT10">
				<tr>
					<th>미리보기</th>
				</tr>
				<tr>
					<td class="tac"><img src="../images/indi_injae_product_line.jpg" alt="서브 테두리 상품"></td>
				</tr>
			</table>
			<table class="style2 fr MAT10">
				<colgroup>
					<col width="53%">
					<col width="21%">
					<col width="26%">
				</colgroup>
				<tr>
					<th>서비스명</th>
					<th colspan="3">기간선택</th>
				</tr>
				<tr>
					<td rowspan="4">
						<h5>서브 인재정보 테두리강조<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>서브 포커스 인재정보 상품과 서브 플러스 인재정보 상품을 이용하는 고객전용입니다.</li>
							<li>테두리 라인을 색상으로 처리해 이력서를 강조해줍니다.</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
			</table>
		</div>
		<!--//tablewrap-->


		<h4 id="hurry"><span class="orange">급구인재 페이지</span> 상품 <button>서비스 신청</button></h4>
		<div class="tablewrap indi_product">
			<table class="style2 fl">
				<tr>
					<th>미리보기</th>
				</tr>
				<tr>
					<td class="tac"><img src="../images/indi_hurry_product.jpg" alt="급구인재 상품"></td>
				</tr>
			</table>
			<table class="style2 fr">
				<colgroup>
					<col width="53%">
					<col width="21%">
					<col width="26%">
				</colgroup>
				<tr>
					<th>서비스명</th>
					<th colspan="3">기간선택</th>
				</tr>
				<tr>
					<td rowspan="5">
						<h5>급구 인재<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>인재정보 서브페이지 급구인재정보에 노출</li>
							<li>급구 아이콘 무료</li>
							<li>일반리스트 무료 등록</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
			</table>
		</div>
		<!--//tablewrap-->

		<h4 id="accent"><span class="orange">강조옵션 </span> 상품 <button>서비스 신청</button></h4>
		<div class="tablewrap accent">
			<table class="style2">
				<tr>
					<th class="m_none">미리보기</th>
					<th>서비스명/서비스선택</th>
					<th colspan="3">기간선택</th>
				</tr>
				<!--아이콘-->
				<tr>
					<td rowspan="4" class="ij_preview">
						<div>
							<p class="title line1"><img src="../images/icon_company_00.gif">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
						<div>
							<p class="title line1"><img src="../images/icon_injae_01.gif">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
					</td>
					<td rowspan="4">
						<h5>아이콘<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>인재정보 리스트 제목 앞을 아이콘으로 강조 효과</li>
						</ul>
						<ul class="li_float img_icon">
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_01.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_02.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_03.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_04.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_05.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_06.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_07.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_08.gif" alt=""></li>
							<li><input type="radio" id=""><label for=""></label><img src="../images/icon_injae_09.gif" alt=""></li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<!--//아이콘-->

				<!--형광팬-->
				<tr>
					<td rowspan="4" class="ij_preview">
						<div>
							<p class="title line1 bgcol1">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
						<div>
							<p class="title line1 bgcol2">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
					</td>
					<td rowspan="4">
						<h5>형광펜<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>인재정보 리스트 제목을 형광펜 강조 효과</li>
						</ul>
						<ul class="li_float img_icon">
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol1">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol2">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol3">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol4">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol5">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol6">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol7">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol8">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title bgcol9">형광펜강조효과</p></li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<!--//형광팬-->

				<!--글자색-->
				<tr>
					<td rowspan="4" class="ij_preview">
						<div>
							<p class="title line1 tcol1">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
						<div>
							<p class="title line1 tcol2">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
					</td>
					<td rowspan="4">
						<h5>글자색<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>인재정보 리스트 제목을 글자색으로 강조 효과</li>
						</ul>
						<ul class="li_float img_icon">
							<li><input type="radio" id=""><label for=""></label><p class="title tcol1">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol2">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol3">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol4">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol5">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol6">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol7">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol8">형광펜강조효과</p></li>
							<li><input type="radio" id=""><label for=""></label><p class="title tcol9">형광펜강조효과</p></li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<!--//글자색-->

				<!--굵은글자-->
				<tr>
					<td rowspan="4" class="ij_preview">
						<div>
							<p class="title line1 fwb">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
					</td>
					<td rowspan="4">
						<h5>굵은글자<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>인재정보 리스트 제목을 굵은 글자로 강조 효과</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<!--//굵은글자-->

				<!--반짝칼라 글자-->
				<tr>
					<td rowspan="4" class="ij_preview">
						<div>
							<p class="title line1">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
							<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
							<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
						</div>
					</td>
					<td rowspan="4">
						<h5>반짝칼라 글자<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>인재정보 리스트 제목을 빤짝컬러 강조 효과</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<!--//반짝칼라 글자-->
			</table>
		</div>
		<!--//tablewrap-->


		<h4 id="jump"><span class="orange">점프</span> 서비스 <button>서비스 신청</button></h4>
		<div class="tablewrap indi_product">
			<table class="style2 fl">
				<tr>
					<th>미리보기</th>
				</tr>
				<tr>
					<td class="tac"><img src="../images/indi_jump_product.jpg" alt="점프서비스 상품"></td>
				</tr>
			</table>
			<table class="style2 fr">
				<colgroup>
					<col width="53%">
					<col width="21%">
					<col width="26%">
				</colgroup>
				<tr>
					<th>서비스명</th>
					<th colspan="3">기간선택</th>
				</tr>
				<tr>
					<td rowspan="5">
						<h5>점프 서비스<button><i class="axi axi-question-circle"></i></button></h5>
						<ul class="product_info">
							<li>구인공고 등록 후 24시간 내에 2번 (12시간 간격)</li>
							<li>박스형 상품, 리스트형 상품 모두 최상위로 노출 순서 변경</li>
							<li>이력서 관리에서 수동으로 점프 가능</li>
						</ul>
					</td>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p><em>100,000</em>원</p>
					</td>
					<td class="tac choice"><input type="radio" id=""></td>
				</tr>
				<tr>
					<td class="tac">1일</td>
					<td class="price tar">
						<p class="sale"><span>10%</span>90,000원</p>
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
				<h5>적용할 이력서 선택 <i class="axi axi-ion-android-checkmark red"></i></h5>
				<div class="apply_product">
					<select name="" id="">
						<option value="">적용할 이력서 선택</option>	
						<option value="">적용할 이력서 선택</option>	
						<option value="">이력서 제목</option>	
						<option value="">이력서 제목</option>	
					</select>
				</div>
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
						<td>프리미엄 패키지 상품</td>
						<td class="tal">메인 플래티넘 1개월 + 메인 플래티넘 골드 1개월 + 메인 플래티넘 로고강조 1개월 + 메인 구인공고 일반리스트 1년 + 구인정보 플래티넘 1개월 + 구인정보 플래티넘 골드 1개월 + 구인정보 플래티넘 로고강조 1개월 + 구인정보 일반리스트 1년 + 급구 옵션 1개월 + 이력서 열람권 1개월</td>
						<td><span class="orange">5,000</span>원</td>
					</tr>
					<tr>
						<td>메인 플래티넘</td>
						<td class="tal">2일</td>
						<td><span class="orange">5,000</span>원</td>
					</tr>
					<tr>
						<td>점프 서비스</td>
						<td class="tal">10건</td>
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
					<button class="base graybtn">My홈으로</button> <!--마이페이지 홈으로 이동-->
					<button class="base">결제하기</button>
				</div>
			</div>
		</div>
		<!--//payment-->
	</section>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>

