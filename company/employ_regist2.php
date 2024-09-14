<?php
include '../include/header_meta.php';
include '../include/header.php';
?>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>구인공고 등록<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 MAT20">
	<section class="employ_regist regist_common sub">
		<div class="left_info">
			<!--이 영역에 인크루드-->
			<div class="title">
				<div class="side_con">
					<h3>구인 제목</h3>
					<select title="구인공고 불러오기" name="" id="">
						<option value="">구인공고 불러오기</option>
						<option value="">구인공고 타이틀</option>
					</select>
				</div>
				<input type="text" placeholder="구인공고 제목을 입력해주세요.">
			</div>
			<!--근무지정보-->
			<div class="p_work box_wrap">
				<h3>근무지정보</h3>
				<div class="common_box">
					<table class="com_table">	
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>업소로고<br><button><i class="axi axi-question-circle"></i> 도움말</button></th>
							<td>
								<ul class="logotype">
									<li><input type="radio" id="logotype1" name="logo"><label for="logotype1" class="radiostyle1" ></label> 텍스트로고
										<p class="MAT10"><input type="text"></p>
									</li>
									<li><input type="radio" id="logotype2" name="logo"><label for="logotype2" class="radiostyle1" ></label> 이미지로고 <button>로고등록</button>
										<div class="logo_box logotype_box">
											<span><a href=""><i class="axi axi-close"></i></a></span>
										</div>
									</li>
									<li><input type="radio" id="logotype3" name="logo"><label for="logotype3" class="radiostyle1" ></label> 배경로고 <button>배경등록</button>
										<div class="bg_box logotype_box">
											<span><a href=""><i class="axi axi-close"></i></a></span>
										</div>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 업소(점포)명</th>
							<td><input type="text"></td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>업·직종</th>
							<td>
								<p class="bojotext">* 최대 3개까지 등록 가능합니다.</p>
								<ul class="MBT10">
									<li>
										<select title="1차직종 선택" name="" id="">
											<option value="">1차직종 선택</option>
										</select>
										<select title="2차직종 선택" name="" id="">
											<option value="">2차직종 선택</option>
										</select>
										<select title="3차직종 선택" name="" id="">
											<option value="">3차직종 선택</option>
										</select>
										<button class="regist_btn1">+ 추가</button>
									</li>
									<li>
										<select title="1차직종 선택" name="" id="">
											<option value="">1차직종 선택</option>
										</select>
										<select title="2차직종 선택" name="" id="">
											<option value="">2차직종 선택</option>
										</select>
										<select title="3차직종 선택" name="" id="">
											<option value="">3차직종 선택</option>
										</select>
										<button class="regist_btn1">- 제거</button>
									</li>
								</ul>
								<input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 초보가능
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>근무지역</th>
							<td>
								<p class="bojotext">* 지도등록을 하시면 [지도검색]페이지에 업소이 노출됩니다. 최대 3개까지 등록 가능합니다.</p>
								<div class="line">
									<ul class="MBT10">
										<li>
											<select title="시·도 선택" name="" id="">
												<option value="">--시·도--</option>
											</select>
											<select title="시·군·구 선택" name="" id="">
												<option value="">--시·군·구--</option>
											</select>
											<select title="시·군·구 선택" name="" id="">
												<option value="">--읍·면·동--</option>
											</select>
											<button class="regist_btn1">+ 추가</button>
											<button class="regist_btn3">지도등록</button>
										</li>
										<li><!--지도등록을 하면 생기는 상세주소 텍스트 박스-->
											<input type="text" >
										</li>
									</ul>
									<input type="checkbox" id="re_1"><label for="re_1" class="checkstyle1" ></label> 재택근무 가능
								</div>
								<div class="line">
									<ul class="MBT10">
										<li>
											<select title="시·도 선택" name="" id="">
												<option value="">--시·도--</option>
											</select>
											<select title="시·군·구 선택" name="" id="">
												<option value="">--시·군·구--</option>
											</select>
											<select title="시·군·구 선택" name="" id="">
												<option value="">--읍·면·동--</option>
											</select>
											<button class="regist_btn1">+ 추가</button>
											<button class="regist_btn3">지도등록</button>
										</li>
										<li><!--지도등록을 하면 생기는 상세주소 텍스트 박스-->
											<input type="text" >
										</li>
									</ul>
									<input type="checkbox" id="re_1"><label for="re_1" class="checkstyle1" ></label> 재택근무 가능
								</div>
							</td>
						</tr>
						<tr>
							<th>인근지하철</th>
							<td>
								<select name="" id="" title="지역">
									<option value="">지역</option>
								</select>
								<select name="" id="" title="호선">
									<option value="">호선</option>
								</select>
								<select name="" id="" title="지하철역">
									<option value="">지하철역</option>
								</select>
								<input type="text" placeholder="출구, 소요시간 등">
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--//근무지정보-->

			<!--근무조건-->
			<div class="w_condition box_wrap">
				<h3>근무조건</h3>
				<div class="common_box">
					<table class="com_table">	
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 근무형태</th>
							<td>
								<ul class="li_float">
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 정규직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 계약직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 파견직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 인턴직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 위촉직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 아르바이트</li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 근무기간</th>
							<td>
								<select title="근무기간 선택" name="" id="">
									<option value="">기간선택</option>
									<option value=""></option>
								</select>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 근무요일</th>
							<td>
								<select title="근무요일 선택" name="" id="">
									<option value="">요일선택</option>
									<option value=""></option>
								</select>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 근무시간</th>
							<td>
								<select title="시작 시 선택" name="" id="">
									<option value="">--시--</option>
									<option value=""></option>
								</select>
								<select title="시작 분 선택" name="" id="">
									<option value="">--분--</option>
									<option value=""></option>
								</select>
								~
								<select title="끝나는 시 선택" name="" id="">
									<option value="">--시--</option>
									<option value=""></option>
								</select>
								<select title="끝나는 분 선택" name="" id="">
									<option value="">--분--</option>
									<option value=""></option>
								</select>
								<p class="MAT10"><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 시간협의</p>
							</td>
						</tr>
						<tr class="pay">
							<th><i class="axi axi-ion-android-checkmark"></i> 급여</th>
							<td>
								<ul class="MBT10 li_float">
									<li>
										<input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>
										<select title="급여방법 선택" name="" id="">
										<option value="">선택</option>
										<option value=""></option>
										</select>
										<input type="text"> 원  
									</li>
									<li>
										<input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 추후협의
									</li>		
								</ul>
								<ul class="li_float">
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 당일지급</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 수습기간 있음</li>
								</ul>
							</td>
						</tr>
						<tr>
							<th>복리후생</th>
							<td class="flex_td">
								<button class="regist_btn3">선택</button>
								<ul class="flex_child">
									<li>국민연금<button><i class="axi axi-close"></i></button></li>
									<li>국민연금<button><i class="axi axi-close"></i></button></li>
									<li>국민연금<button><i class="axi axi-close"></i></button></li>
									<li>국민연금<button><i class="axi axi-close"></i></button></li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
				<!--//common_box-->
			</div>
			<!--//근무조건-->
			<!--지원조건-->
			<div class="appli box_wrap">
				<h3>지원조건</h3>
				<div class="common_box">
					<table class="com_table">	
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>성별<br></th>
							<td>
								<ul class="li_float MBT10">
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>성별무관</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>남자</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>여자</li>
								</ul>
								<p class="bojotext"><i class="axi axi-exclamation-circle"></i> 구인에서 남녀를 차별하거나, 여성근로자를 구인할 때 직무수행에 불필요한 용모, 키, 체중 등의 신체조건, 미혼조건을 제시 또는 요구하는 경우 남녀 고용평등법 위반 에 따른 500만원이하의 벌금이 부과될 수 있습니다.</p>
							</td>
						</tr>
						<tr class="age">
							<th><i class="axi axi-ion-android-checkmark"></i>연령</th>
							<td>
								<ul class="li_float MBT10">
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>연령무관</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>연령제한</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 고연령자가능(만65세 이상)</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 주부가능</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 청소년가능(만18세이상)</li>
								</ul>
								<ul class="MBT10"><!--연령제한 선택시 노출-->
									<li><input type="text">세 ~ <input type="text">세</li>
								</ul>
								<p class="bojotext"><i class="axi axi-exclamation-circle"></i> 구인 시 합리적인 이유 없이 연령제한을 하는 경우 연령차별금지법 위반에 해당되어 500만원 이하의 벌금이 부과될 수 있습니다.</p>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>학력조건</th>
							<td>
								<select name="" id="" title="학력선택">
									<option value="">학력선택</option>
								</select>
								<p class="MAT10"><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 졸업예정자 가능</p>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>경력사항</th>
							<td>
								<ul class="li_float">
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 경력무관</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 신입</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 경력</li>
								</ul>
								<p class="MAT10"><!--경력 선택했을시 노출-->
									<select name="" id="" title="경력">
										<option value="">경력</option>
									</select> 이상
								</p>
							</td>
						</tr>
						<tr>
							<th>직급/직책</th>
							<td class="flex_td">
								<button class="regist_btn3">선택</button>
								<ul class="flex_child">
									<li>주임<button><i class="axi axi-close"></i></i></button></li>
									<li>계장<button><i class="axi axi-close"></i></button></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th>우대조건</th>
							<td class="flex_td">
								<button class="regist_btn3">선택</button>
								<ul class="flex_child">
									<li>영어 가능자<button><i class="axi axi-close"></i></i></button></li>
									<li>차량소지자<button><i class="axi axi-close"></i></button></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th>자격증</th>
							<td><input type="text" placeholder="ex) 운전면허증1종, 컴퓨터기능사1급"></td>
						</tr>
					</table>
				</div>
			</div>
			<!--//지원조건-->

			<!--모집내용-->
			<div class="group box_wrap">
				<h3>모집내용</h3>
				<div class="common_box">
					<table class="com_table">
						<tr class="personnel">
							<th><i class="axi axi-ion-android-checkmark"></i>모집인원</th>
							<td>
								<ul class="li_float">
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <input type="text"> 명</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 0명</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 00명</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 000명</li>
								</ul>
							</td>
						</tr>
						<tr class="group_close">
							<th><i class="axi axi-ion-android-checkmark"></i>모집종료일</th>
							<td>
								<ul class="li_float">
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>날짜선택 <input type="text"></li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>상시모집</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>구인시까지</li>
								</ul>
							</td>
						</tr>
						<tr class="receipt">
							<th><i class="axi axi-ion-android-checkmark"></i>접수방법</th>
							<td>
								<ul class="li_float">
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 온라인지원</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 이메일지원</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 홈페이지</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 전화연락</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 방문접수</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 우편</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 팩스</li>
								</ul>
								<p class="MAT10">홈페이지URL <input type="text"></p><!--홈페이지를 선택했을때 노출-->
								<p class="MAT10" class="file">자사양식 사용 <input type="file"></p><!--이메일지원 선택시 노출-->
							</td>
						</tr>
						<tr>
							<th>모집대상</th>
							<td>
								<ul class="li_float">
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 청소년</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 대학생</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 주부</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 장년</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 초보자</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택가능</li>
								</ul>
							</td>
						</tr>
						<tr>
							<th>제출서류</th>
							<td>
								<ul class="li_float">
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 이력서</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 포트폴리오</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 자기소개서</li>
								</ul>
							</td>
						</tr>
						
						<tr>
							<th>사전질문</th>
							<td><textarea name="" id="" placeholder="사전인터뷰 질문을 등록하시면 온라인 입사지원시 지원자가 이력서와 함께 질문에 대한 답변을 작성해서 보냅니다."></textarea></td>
						</tr>
					</table>
				</div>
			</div>
			<!--//모집내용-->

			<!--인사 담당자 정보-->
			<div class="manager box_wrap">
				<div class="side_con">
					<h3>인사 담당자 정보</h3>
					<select title="담당자정보 불러오기" name="" id="">
						<option value="">담당자정보 불러오기</option>
						<option value="">담당자</option>
					</select>
				</div>
				<div class="common_box">
					<table class="com_table">
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>담당자명</th>
							<td><input type="text"></td>
						</tr>
						<tr class="num">
							<th><i class="axi axi-ion-android-checkmark"></i>연락처</th>
							<td><input type="text"> - <input type="text"> - <input type="text"> <span><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 비노출</span></td>
						</tr>
						<tr class="num">
							<th>휴대폰</th>
							<td>
								<select name="" id="">
									<option value="">010</option>
								</select>
								-
								<input type="text"> - <input type="text"> 
								<span><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 비노출</span>
							</td>
						</tr>
						<tr class="num">
							<th>팩스</th>
							<td><input type="text"> - <input type="text"> - <input type="text"></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><input type="text"> @ <input type="text" placeholder="직접입력">
								<select name="" id="" title="이메일선택">
									<option value="">이메일선택</option>
								</select>
								<span><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 비노출</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--//인사 담당자 정보-->

			<!--상세모집요강-->
			<div class="guide box_wrap">
				<div class="side_con">
					<h3>상세모집요강</h3>
					<button>입력한 내용으로 모집요강 적용</button>
				</div>
				<div class="common_box">
					<ul>
						<li class="on"><a href=""><img src="../images/skin0.png" alt="스킨사요안함"></a></li>
						<li><a href=""><img src="../images/skin1.png" alt="스킨1"></a></li>
						<li><a href=""><img src="../images/skin2.png" alt="스킨2"></a></li>
						<li><a href=""><img src="../images/skin3.png" alt="스킨3"></a></li>						
					</ul>
				</div>
				<div class="write">
					에디터영역
				</div>
				<div class="employ_skin1 e_skincommon">
					<div class="top_img">
						<div>
							<h3>구인제목을 입력해주세요구인제을 입력해주세요구인제목을 입력해주세요구인제목을 입력해주세요세요구인제목을 입력해주세요채</h3>
						</div>
					</div>
					<div class="text_wrap">
						<p>넷퓨는 2007년에 설립된 업소로 자본금 2억원 규모의 중소업소입니다. 광주 동구 금남로5가에 위치하고 있으며, 소프트웨어 개발 및 유지보수사업을 하고 있습니다.</p>
						<h4>모집분야 및 자격 요건</h4>
						<table>
							<tr>
								<th>모집분야명<br>(1명)</th>
								<td>
									<dl>
										<dt>자격요건</dt>
										<dd>학력 : </dd>
										<dd>경력 : </dd>
										<dd>모집대상 : </dd>
										<dd>제출서류 : </dd>
									</dl>
									<dl>
										<dt>우대사항</dt>
										<dd>우대조건 : </dd>
										<dd>직급/직책 : </dd>
										<dd>자격증 : </dd>
									</dl>
								</td>
							</tr>
						</table>
						<h4>전형절차</h4>
						<ul>
							<ul>
								<li>서류면접 > 1차면접 > 2차면접 > 임원면접 > 최종합격</li>
								<li>면접일정은 추후 통보됩니다.</li>
							</ul>
						</ul>
						<h4>유의사항</h4>
						<ul>
							<ul>
								<li>허위사실이 발견될 경우 구인이 취소될 수 있습니다.</li>
							</ul>
						</ul>
					</div>
				</div>
				<!--employ_skin1 -->
				<div class="employ_skin2 e_skincommon">
					<div class="top_img">
						<div>
							<h2>넷퓨업소이름</h2>
							<h3>구인제목을 입력해주세요구인제목을 입력해주세요구인제목을 입력해주세요</h3>
						</div>
					</div>
					<div class="text_wrap">
						<p>넷퓨는 2007년에 설립된 업소로 자본금 2억원 규모의 중소업소입니다. 광주 동구 금남로5가에 위치하고 있으며, 소프트웨어 개발 및 유지보수사업을 하고 있습니다.</p>
						<h4>모집분야 및 자격 요건</h4>
						<table>
							<tr>
								<th>모집분야명<br>(1명)</th>
								<td>
									<dl>
										<dt>자격요건</dt>
										<dd>학력 : </dd>
										<dd>경력 : </dd>
										<dd>모집대상 : </dd>
										<dd>제출서류 : </dd>
									</dl>
									<dl>
										<dt>우대사항</dt>
										<dd>우대조건 : </dd>
										<dd>직급/직책 : </dd>
										<dd>자격증 : </dd>
									</dl>
								</td>
							</tr>
						</table>
						<h4>전형절차</h4>
						<ul>
							<ul>
								<li>서류면접 > 1차면접 > 2차면접 > 임원면접 > 최종합격</li>
								<li>면접일정은 추후 통보됩니다.</li>
							</ul>
						</ul>
						<h4>유의사항</h4>
						<ul>
							<ul>
								<li>허위사실이 발견될 경우 구인이 취소될 수 있습니다.</li>
							</ul>
						</ul>
					</div>
				</div>
				<!--employ_skin2 -->
				<div class="employ_skin3 e_skincommon">
					<div class="top_img">
						<div>
							<h2>넷퓨업소이름</h2>
							<h3>구인제목을 입력해주세요구인제목을 입력해주세요구인제목을 입력해주세요</h3>
						</div>
					</div>
					<div class="text_wrap">
						<p>넷퓨는 2007년에 설립된 업소로 자본금 2억원 규모의 중소업소입니다. 광주 동구 금남로5가에 위치하고 있으며, 소프트웨어 개발 및 유지보수사업을 하고 있습니다.</p>
						<h4>모집분야 및 자격 요건</h4>
						<table>
							<tr>
								<th>모집분야명<br>(1명)</th>
								<td>
									<dl>
										<dt>자격요건</dt>
										<dd>학력 : </dd>
										<dd>경력 : </dd>
										<dd>모집대상 : </dd>
										<dd>제출서류 : </dd>
									</dl>
									<dl>
										<dt>우대사항</dt>
										<dd>우대조건 : </dd>
										<dd>직급/직책 : </dd>
										<dd>자격증 : </dd>
									</dl>
								</td>
							</tr>
						</table>
						<h4>전형절차</h4>
						<ul>
							<ul>
								<li>서류면접 > 1차면접 > 2차면접 > 임원면접 > 최종합격</li>
								<li>면접일정은 추후 통보됩니다.</li>
							</ul>
						</ul>
						<h4>유의사항</h4>
						<ul>
							<ul>
								<li>허위사실이 발견될 경우 구인이 취소될 수 있습니다.</li>
							</ul>
						</ul>
					</div>
				</div>
				<!--employ_skin3 -->
			</div>
			<!--//상세모집요강-->

			<!--업소 이미지/동영상 등록-->
			<div class="img_box box_wrap">
				<h3>업소 이미지/동영상 등록</h3>
				<div class="common_box">
					<p><input type="file"><span class="blue">파일당 00MB 용량 이내의 파일만 등록 가능합니다.</span></p>
					<ul>
						<li><span><a href=""><i class="axi axi-close"></i></a></span></li>
						<li><span><a href=""><i class="axi axi-close"></i></a></span></li>
						<li><span><a href=""><i class="axi axi-close"></i></a></span></li>
						<li><span><a href=""><i class="axi axi-close"></i></a></span></li>
					</ul>
					<table class="com_table">
						<tr>
							<th>동영상등록</th>
							<td><input type="text"><br><span class="blue">iframe 형식으로 동영상을 넣으실 수 있습니다.</span></td>
						</tr>
					</table>
				</div>
			</div>
			<!--//업소 이미지/동영상 등록-->

			<div class="keyword box_wrap">
				<h3>테마 선택</h3>
				<div>
					<table>
						<colgroup>
							<col width="33.3%">
							<col width="33.3%">
							<col width="33.3%">
						</colgroup>	
						<tr>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무재택근무재택근무재택근무재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
						</tr>
						<tr>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
						</tr>
						<tr>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
						</tr>
						<tr>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
						</tr>
						<tr>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 재택근무</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!--//left_info-->

		<!--right_info-->
		<div class="right_info">
			<select name="" id="">
				<option value="">업소정보 선택</option>
				<option value="">업소정보</option>
			</select>	
			<div class="info_box">
				<div>
					<div class="logo_img">
						<p></p>
					</div>
					<ul>
						<li><button>사진수정</button></li>
						<li><button>정보수정</button></li> <!--정보수정클릭시 작성한 내용을 저장하지 않고 페이지를 벗어난다는 경고메세지 띄어져야함  -->
					</ul>
				</div>
				<dl>
					<dt>업소명</dt>
					<dd>넷퓨</dd>
					<dt>대표자명</dt>
					<dd>김대표</dd>
					<dt>업소형태</dt>
					<dd>대업소</dd>
					<dt>주요사업</dt>
					<dd>네트워크 트래픽 관리제품 개발 및 판매</dd>
					<dt>업소주소</dt>
					<dd>[501-713] 광주광역시 동구 금남로5가 남선빌딩 407호	</dd>
					<dt>홈페이지</dt>
					<dd>http://netfu.co.kr</dd>
				</dl>
			</div>
			<button class="base pay">유료 구인공고 등록</button>
			<button class="base">심사후 구인공고 등록</button>
			<button class="base">일반 구인공고 등록</button>
			<!--관리자에서 심사후에 등록하기로 설정하면 '유료서비스 즉시등록','심사 후 공고등록완료' 노출/관리자에서 바로 등록이면 '유료서비스 이용등록','공고등록완료' 노출-->
		</div>
		<!--//right_info-->
	</section>
</div>


<!--
<div class="popup_layer ijimg">
	<h1>로고등록/수정<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="text_info">
		GIF, JPEG, JPG, PNG 파일형식으로 400*120픽셀, 100KB 용량 이내의 파일을 권장합니다.
	</div>
	<p class="file">
		<input type="file">
	</p>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>확인</button></li>
	</ul>
</div>

<div class="popup_layer ijimg">
	<h1>배경로고등록/수정<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="text_info">
		GIF, JPEG, JPG, PNG 파일형식으로 400*168픽셀, 100KB 용량 이내의 파일을 권장합니다.
	</div>
	<p class="file">
		<input type="file">
	</p>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>확인</button></li>
	</ul>
</div>

<div class="popup_layer help">
	<h1>업소로고 도움말<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="scroll">
		<h2>· 텍스트로고 예시 이미지</h2>
		<ul>
			<li><img src="../images/text_ex1.jpg" alt=""></li>
			<li><img src="../images/text_ex2.jpg" alt=""></li>
		</ul>
		<h2>· 이미지로고 예시 이미지</h2>
		<ul>
			<li><img src="../images/logo_ex1.jpg" alt=""></li>
			<li><img src="../images/logo_ex2.jpg" alt=""></li>
		</ul>
		<h2>· 배경로고 예시 이미지</h2>
		<ul>
			<li><img src="../images/bg_ex1.jpg" alt=""></li>
			<li><img src="../images/bg_ex2.jpg" alt=""></li>
		</ul>
	</div>
	<ul class="btn">
		<li><button>닫기</button></li>
	</ul>
</div>

<div class="popup_layer welfare">
	<h1>복리후생<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div>
		<dl>
			<dt>보험</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금국민연금국민연금국민연금국민연금국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>보험</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>보험</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>보험</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>보험</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
	</div>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>확인</button></li>
	</ul>
</div>

<div class="popup_layer rank">
	<h1>직급/직책<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="scroll">
		<dl>
			<dt>직급</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 사원급</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 과장~차장</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 임원~CEO</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>직책</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 팀원</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 파트장</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 지점장</li>
				</ul>
			</dd>
		</dl>
	</div>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>확인</button></li>
	</ul>
</div>


<div class="popup_layer welfare">
	<h1>우대조건<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div>
		<dl>
			<dt>취업보호·장려</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금국민연금국민연금국민연금국민연금국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>자격·능력</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>근무조건</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>활동·경험</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt>외국어능력</dt>	
			<dd>
				<ul>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 국민연금</li>
				</ul>
			</dd>
		</dl>
	</div>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>확인</button></li>
	</ul>
</div>
-->

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
