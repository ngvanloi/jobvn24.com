<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>브랜드 구인공고 관리<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php include '../include/company_leftmenu.php'; ?>
		<div class="subcon_area">
			<section class="brand_entire my_brandinfo tab_style1">
				<h1>브랜드 구인공고 관리</h1>
				<ul class="help_text">
					<li>등록된 구인공고의 승인여부를 결정할 수있습니다.</li>	
					<li>체인지점인 공고만 승인할 수있습니다.</li>	
					<li>미등록된 체인점은 '체인점으로 등록'버튼을 통해 체인점으로 변경할 수있습니다.</li>	
				</ul>
				<div class="no_brand"> <!--브랜드 입점하지 않은 회원에게 노출-->
					입점하지 않은 회원입니다.<br>
					브랜드 입점은 브랜드 본사가 가입하는 서비스입니다.<br><button>브랜드 입점 안내</button>
				</div>
				<div class="sub_serach">
					<ul class="fl">
						<li><select name="" id="">
							<option value="">체인지점명</option>
							<option value="">담당자 명</option>
							<option value="">구인제목명</option>
							<option value="">업소명</option>
						</select>
						<form action="">
							<div class="search_style">
								<label for="">
									<input type="text">
									<button type="submint"><i class="axi axi-search3"></i></button>
								</label>
							</div>
						</form>
						</li>
					</ul>
					<ul class="fr">
						<li>
							<input type="checkbox"><label for="" class="checkstyle1"></label>구인공고 자동수락
						</li>
						<li>
							<select name="" id="">
								<option value="">10개씩 보기</option>
								<option value="">20개씩 보기</option>
							</select>
						</li>
					</ul>
				</div>
				<ul class="tab">
					<li class="on"><a href="">전체공고 <span>(45)</span></a></li>
					<li><a href="">승인공고 <span>(5)</span></a></li>
					<li><a href="">미승인공고 <span>(5)</span></a></li>
					<li><a href="">수정 미승인공고 <span>(5)</span></a></li>
					<li><a href="">승인거부 공고 <span>(5)</span></a></li>
				</ul>
				<div class="tabcon"><!--진행중인 구인공고-->
					<div class="no_content">
						<p>브랜드공고 정보가 없습니다.</p>
					</div>
					<div><!--반복-->
						<div class="img_box">
							<p class="company"></p>
						</div>
						<div class="info_box">
							<a href="">
								<h2>디자인/ 마케팅 신입/경력 정규직, 계약직 구인 구인제목</h2>
								<dl>
									<dt>업소명</dt>
									<dd>넷퓨</dd>
									<dt>경력</dt>
									<dd>1년 6개월</dd>
									<dt>학력</dt>
									<dd>고등학교 졸업</dd>
									<dt>급여</dt>
									<dd>시급 10,000원</dd>
								</dl>
								<dl>
									<dt>근무형태</dt>
									<dd>정규직</dd>
									<dt>근무기간</dt>
									<dd>6개월 / 월~금 / 09:00 ~ 20:00</dd>
									<dt>업·직종</dt>
									<dd>서비스 > 숙박·호텔·리조트 > 도어맨</dd>
									<dt>근무지</dt>
									<dd>광주>서구,서울</dd>
								</dl>
							</a>
						</div>
						<table>
							<colgroup>
								<col width="50%">	
								<col width="50%">	
							</colgroup>
							<tr>
								<th>부가정보</th>
								<th>공고 승인여부</th>
							</tr>	
							<tr>
								<td>
									<ul>
										<li><span>등록일 :</span> 2022.04.12</li>
										<li><span>마감일 :</span> 2022.04.12</li>
										<li><span>체인점 :</span> 화정지점</li>
										<li><span>체인여부 :</span> <span class="red">미등록업체</span></li>
									</ul>
								</td>
								<td>
									<select name="" id="" title="승인여부">
										<option value="">미승인</option>
										<option value="">승인</option>
										<option value="">승인거부</option>
									</select>
								</td>
							</tr>
						</table>
						<div class="assi_line">
							<ul>
								<li>공고수정일 : 2022.11.11</li>
								<li><button>담당자 정보보기</button></li>
							</ul>
							<ul>
								<li><a href="">체인지점으로 등록</a></li>
								<li><a href="">쪽지</a></li>
								<li><a href="">수정</a></li>
								<li><a href="">삭제</a></li>
							</ul>
						</div>
					</div>
					<!--//반복-->
					<div><!--반복-->
						<div class="img_box">
							<p class="company"></p>
						</div>
						<div class="info_box">
							<a href="">
								<h2>디자인/ 마케팅 신입/경력 정규직, 계약직 구인 구인제목</h2>
								<dl>
									<dt>업소명</dt>
									<dd>넷퓨</dd>
									<dt>경력</dt>
									<dd>1년 6개월</dd>
									<dt>학력</dt>
									<dd>고등학교 졸업</dd>
									<dt>급여</dt>
									<dd>시급 10,000원</dd>
								</dl>
								<dl>
									<dt>근무형태</dt>
									<dd>정규직</dd>
									<dt>근무기간</dt>
									<dd>6개월 / 월~금 / 09:00 ~ 20:00</dd>
									<dt>업·직종</dt>
									<dd>서비스 > 숙박·호텔·리조트 > 도어맨</dd>
									<dt>근무지</dt>
									<dd>광주>서구,서울</dd>
								</dl>
							</a>
						</div>
						<table>
							<colgroup>
								<col width="50%">	
								<col width="50%">	
							</colgroup>
							<tr>
								<th>부가정보</th>
								<th>공고 승인여부</th>
							</tr>	
							<tr>
								<td>
									<ul>
										<li><span>등록일 :</span> 2022.04.12</li>
										<li><span>마감일 :</span> 2022.04.12</li>
										<li><span>체인점 :</span> 화정지점</li>
										<li><span>체인여부 :</span> <span class="blue">등록된업체</span></li>
									</ul>
								</td>
								<td>
									<select name="" id="" title="승인여부">
										<option value="">미승인</option>
										<option value="">승인</option>
										<option value="">승인거부</option>
									</select>
								</td>
							</tr>
						</table>
						<div class="assi_line">
							<ul>
								<li>공고수정일 : 2022.11.11</li>
								<li><button>담당자 정보보기</button></li>
							</ul>
							<ul>
								<li><a href="">쪽지</a></li>
								<li><a href="">수정</a></li>
								<li><a href="">삭제</a></li>
							</ul>
						</div>
					</div>
					<!--//반복-->
					<button class="more">더보기 <i class="axi axi-plus"></i></button>
				</div>
				<!--//tabcon-->
			</section>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
