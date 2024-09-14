<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php
		$left_on['jump_list'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="jump_list tab_style1">
				<p class="s_title">보유한 점프내역</p>
				<ul class="help_text">
					<li>회원님께서 보유중인 점프내역을 확인할 수 있습니다.</li>
				</ul>
				<div class="tabcon"><!--진행중인 구인공고-->
					<div class="no_content">
						<p>보유한 점프 내역이 없습니다. <br> <button>점프 구매하기</button>		</p>
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
								<th>유료서비스 내역</th>
							</tr>	
							<tr>
								<td>
									<ul>
										<li><span>등록일 :</span> 2022.04.12</li>
										<li><span>마감일 :</span> 2022.04.12</li>
										<li><a href=""><span>지원자 :</span> <span class="blue">0</span> 명</a></li>
										<li><span>등록승인여부 :</span> <span class="red">미승인</span></li>
									</ul>
								</td>
								<td>
									<button class="red">서비스연장·추가</button>
									<ul>
										<li>메인 플래티넘 (~ 2030.01.01)</li>
										<li>메인 프라임 (~ 2030.01.01)</li>
										<li>메인 그랜드 (~ 2030.01.01)</li>
										<li>메인 배너형 (~ 2030.01.01)</li>
										<li>점프</li>
									</ul>
								</td>
							</tr>
						</table>
						<div class="assi_line">
							<ul>
								<li>공고수정일 : 2022.11.11</li>
							</ul>
							<ul>
								<li><!--점프권이 있을경우에 표기-->
									<dl>
										<dt><a href=""><i class="axi axi-ion-arrow-up-c"></i> 점프하기</a></dt>
										<dd>남은 점프횟수 259</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt style="color:#fff; padding:0 3px;">점프</dt>
										<dd><label><input type="radio">사용</label> <label><input type="radio">미사용</label></dd>
									</dl>
								</li>
								<li><a href="">마감</a></li>
								<li><a href="">수정</a></li>
								<li><a href="">복사</a></li>
								<li><a href="">삭제</a></li>
							</ul>
						</div>
					</div>
					<!--//반복-->
				</div>
				<!--//tabcon-->
			</section>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
