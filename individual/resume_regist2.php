<?php
$PATH = $_SERVER['DOCUMENT_ROOT'];
$add_cate_arr = array('email', 'job_type', 'job_date', 'job_week', 'job_time', 'job_pay', 'job_type', 'job_computer', 'job_pay_employ', 'job_obstacle', 'job_veteran', 'job_language', 'job_language_exam');
include_once $PATH."/engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '이력서등록';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '이력서 등록';
include NFE_PATH.'/include/m_title.inc.php';
?>
<div class="wrap1260 MAT20">
	<section class="resume_regist regist_common sub">
		<div class="left_info">
			<div class="title">
				<div class="side_con">
					<h3>이력서 제목<span>이력서 제목은 희망직무나 구체적인 지원분야를 입력하시는 것이 좋습니다.</span></h3>
					<select title="이력서 불러오기" name="" id="">
						<option value="">이력서 불러오기</option>
						<option value="">이력서타이틀제목</option>
					</select>
				</div>
				<input type="text" placeholder="이력서 제목을 입력해주세요.">
			</div>
			<!--희망근무조건-->
			<div class="box_wrap">
				<h3>희망근무조건</h3>
				<div class="common_box">
					<table class="com_table">	
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>근무지</th>
							<td>
								<p class="bojotext">* 최대 3개까지 등록 가능합니다.</p>
								<div class="line">
									<ul class="MBT10">
										<li>
											<select title="시·도 선택" name="" id="">
												<option value="">--시·도--</option>
											</select>
											<select title="시·군·구 선택" name="" id="">
												<option value="">--시·군·구--</option>
											</select>
											<button class="regist_btn1">+ 추가</button>
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
											<button class="regist_btn1">- 제거</button>
										</li>
									</ul>
									<input type="checkbox" id="re_2"><label for="re_2" class="checkstyle1" ></label> 재택근무 가능
								</div>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>업·직종</th>
							<td>
								<p class="bojotext">* 최대 3개까지 등록 가능합니다.</p>
								<ul>
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
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i>근무일시</th>
							<td>
								<ul class="MBT10">
									<li>
										<select title="근무기간 선택" name="" id="">
											<option value="">--근무기간--</option>
										</select>
										<select title="근무요일 선택" name="" id="">
											<option value="">--근무요일--</option>
										</select>
										<select title="근무시간 선택" name="" id="">
											<option value="">--근무시간--</option>
										</select>										
									</li>
								</ul>
								<input type="checkbox" id="re_2"><label for="re_2" class="checkstyle1" ></label> 즉시출근가능
							</td>
						</tr>
						<tr class="salary">
							<th><i class="axi axi-ion-android-checkmark"></i>급여</th>
							<td>
								<ul class="MBT10">
									<li>
										<select title="급여 선택" name="" id="">
											<option value="">=급여=</option>
											<option value=""></option>
										</select>
										<input type="text">  &nbsp;원
									</li>
								</ul>
								<input type="checkbox" id="re_3"><label for="re_3" class="checkstyle1" ></label> 추후협의
							</td>
						</tr>
						<tr class="worktype">
							<th><i class="axi axi-ion-android-checkmark"></i>근무형태</th>
							<td>
								<ul>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 정규직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 계약직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 파견직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 인턴직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 위촉직</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 아르바이트</li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
				<!--//common_box-->
			</div>
			<!--//희망근무조건-->
			<!--학력사항-->
			<div class="edh box_wrap">
				<h3>학력사항</h3>
				<div class="common_box">
					<table class="com_table">	
						<tr class="edu">
							<th><i class="axi axi-ion-android-checkmark"></i>학력<br><button class="regist_btn2">+ 추가</button></th>
							<td>
								<ul class="MBT10">
									<li>
										<select title="학력 선택" name="" id="">
											<option value="">--학력선택--</option>
										</select>
									</li>
									<li class="MAT10"><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 졸업예정자</li>
								</ul>
								
								<ul>
									<li>입력할 학력선택 &nbsp;:&nbsp; </li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 고등학교</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 대학(2,3학년)</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 대학(4학년)</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 대학원</li>
								</ul>
							</td>
						</tr>
						<tr class="c_edu">
							<th>선택학력</th>
							<td>
								<input type="text" placeholder="출신학교 입력">
								<input type="text" placeholder="전공 입력">
								<select title="학위 선택" name="" id="">
									<option value="">학위</option>
								</select>
								<select title="입학년도 선택" name="" id="">
									<option value="">년도</option>
								</select>
								년 ~
								<select title="졸업년도 선택" name="" id="">
									<option value="">년도</option>
								</select>
								<select title="상태 선택" name="" id="">
									<option value="">상태</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div class="common_box">
					<table class="com_table">	
						<tr class="edu">
							<th><i class="axi axi-ion-android-checkmark"></i>학력<br><button class="regist_btn2">- 제거</button></th>
							<td>
								<ul class="MBT10">
									<li>
										<select title="학력 선택" name="" id="">
											<option value="">--학력선택--</option>
										</select>
									</li>
									<li class="MAT10"><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 졸업예정자</li>
								</ul>
								<ul>
									<li>입력할 학력선택 &nbsp;:&nbsp; </li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 고등학교</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 대학(2,3학년)</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 대학(4학년)</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 대학원</li>
								</ul>
							</td>
						</tr>
						<tr class="c_edu">
							<th>선택학력</th>
							<td>
								<input type="text" placeholder="출신학교 입력">
								<input type="text" placeholder="전공 입력">
								<select title="학위 선택" name="" id="">
									<option value="">학위</option>
								</select>
								<select title="입학년도 선택" name="" id="">
									<option value="">년도</option>
								</select>
								년 ~
								<select title="졸업년도 선택" name="" id="">
									<option value="">년도</option>
								</select>
								<select title="상태 선택" name="" id="">
									<option value="">상태</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--//학력사항-->

			<!--경력사항-->
			<div class="box_wrap">
				<h3>경력사항</h3>
				<div class="common_box">
					<table class="com_table">
						<tr class="career">
							<th>경력</th>
							<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 경력있음</td>
						</tr>
						<tr class="career_list">
							<th>경력사항<br><button class="regist_btn2">+ 추가</button></th>
							<td>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 업소명</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 근무직종</dt>
									<dd>
										<select title="1차직종 선택" name="" id="">
											<option value="">1차직종선택</option>
											<option value=""></option>
										</select>
										<select title="2차직종 선택" name="" id="">
											<option value="">2차직종선택</option>
											<option value=""></option>
										</select>
										<select title="3차직종 선택" name="" id="">
											<option value="">3차직종선택</option>
											<option value=""></option>
										</select>
									</dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 근무기간</dt>
									<dd>
										<select title="근무기간첫년도" name="" id="">
											<option value="">년</option>
											<option value=""></option>
										</select>
										년
										<select title="근무기간첫월" name="" id="">
											<option value="">월</option>
											<option value=""></option>
										</select>
										월 ~
										<select title="근무기간마지막년도" name="" id="">
											<option value="">년</option>
											<option value=""></option>
										</select>
										년
										<select title="근무기간마지막월" name="" id="">
											<option value="">월</option>
											<option value=""></option>
										</select>
										월
									</dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 담당업무</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt>상세업무 내용</dt>
									<dd><input type="text"></dd>
								</dl>
							</td>
						</tr>
						<tr class="career_list">
							<th>경력사항<br><button class="regist_btn2">- 제거</button></th>
							<td>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 업소명</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 근무직종</dt>
									<dd>
										<select title="1차직종 선택" name="" id="">
											<option value="">1차직종선택</option>
											<option value=""></option>
										</select>
										<select title="2차직종 선택" name="" id="">
											<option value="">2차직종선택</option>
											<option value=""></option>
										</select>
										<select title="3차직종 선택" name="" id="">
											<option value="">3차직종선택</option>
											<option value=""></option>
										</select>
									</dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 근무기간</dt>
									<dd>
										<select title="근무기간첫년도" name="" id="">
											<option value="">년</option>
											<option value=""></option>
										</select>
										년
										<select title="근무기간첫월" name="" id="">
											<option value="">월</option>
											<option value=""></option>
										</select>
										월 ~
										<select title="근무기간마지막년도" name="" id="">
											<option value="">년</option>
											<option value=""></option>
										</select>
										년
										<select title="근무기간마지막월" name="" id="">
											<option value="">월</option>
											<option value=""></option>
										</select>
										월
									</dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 담당업무</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt>상세업무 내용</dt>
									<dd><input type="text"></dd>
								</dl>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--//경력사항-->
			<!--자기소개서-->
			<div class="self_intro box_wrap">
				<h3>자기소개서</h3>
				<div class="write">
					에디터
				</div>
				<div class="file">
					<h4>첨부파일<button><i class="axi axi-plus"></i></button><button><i class="axi axi-minus"></i></button></h4>
					<span class="blue">파일당 <em>00</em>MB 용량 이내의 파일만 등록 가능합니다.</span>
					<p>
						<input type="file">
					</p>
					<p>
						<input type="file">
					</p>
				</div>
				<div class="file">
					<h4>동영상</h4>
					<span class="blue">iframe형식으로 등록 가능합니다.</span>
					<input type="text">
				</div>
			</div>
			<!--//자기소개서-->

			<!--이력서설정-->
			<div class="setting box_wrap">
				<h3>이력서 설정</h3>
				<div class="common_box">
					<table class="com_table">
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 공개여부</th>
							<td>
								<dl>
									<dt>이력서</dt>
									<dd>
										<ul>
											<li><input type="radio" id="ra1" name="agree1"><label for="ra1" class="radiostyle1" ></label> 공개</li>
											<li><input type="radio" id="ra2" name="agree1"><label for="ra2" class="radiostyle1" ></label> 비공개</li>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>홈페이지</dt>
									<dd>
										<ul>
											<li><input type="radio" id="ra1" name="agree1"><label for="ra1" class="radiostyle1" ></label> 공개</li>
											<li><input type="radio" id="ra2" name="agree1"><label for="ra2" class="radiostyle1" ></label> 비공개</li>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>연락처</dt>
									<dd>
										<ul>
											<li><input type="radio" id="ra1" name="agree1"><label for="ra1" class="radiostyle1" ></label> 공개</li>
											<li><input type="radio" id="ra2" name="agree1"><label for="ra2" class="radiostyle1" ></label> 비공개</li>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>주소</dt>
									<dd>
										<ul>
											<li><input type="radio" id="ra1" name="agree1"><label for="ra1" class="radiostyle1" ></label> 공개</li>
											<li><input type="radio" id="ra2" name="agree1"><label for="ra2" class="radiostyle1" ></label> 비공개</li>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>이메일</dt>
									<dd>
										<ul>
											<li><input type="radio" id="ra1" name="agree1"><label for="ra1" class="radiostyle1" ></label> 공개</li>
											<li><input type="radio" id="ra2" name="agree1"><label for="ra2" class="radiostyle1" ></label> 비공개</li>
										</ul>
									</dd>
								</dl>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 연락가능시간</th>
							<td>
								<select title="시간 선택" name="" id="">
									<option value="">00시</option>
								</select>
								~
								<select title="시간 선택" name="" id="">
									<option value="">00시</option>
								</select><br>
								<p class="MAT10"><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 언제나가능</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--//이력서설정-->


			<!--선택사항-->
			<div class="choice box_wrap">
				<h3>선택사항</h3>
				<ul class="choice_box">
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 자격증</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 외국어능력</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 보유기술 및 능력</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 수상·수료활동</li>
					<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 구인우대사항</li>
				</ul>
				<!--자격증-->
				<div class="common_box license">
					<table class="com_table">
						<tr>
							<th>자격증<br><button class="regist_btn2">+ 추가</button></th>
							<td>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 자격증명</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 발행처</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 취득년도</dt>
									<dd>
										<select title="취득년도 선택" name="" id="">
											<option value="">년</option>
											<option value=""></option>
										</select>
										년
									</dd>
								</dl>
							</td>
						</tr>
					</table>
					<table class="com_table">
						<tr>
							<th>자격증<br><button class="regist_btn2">- 제거</button></th>
							<td>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 자격증명</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 발행처</dt>
									<dd><input type="text"></dd>
								</dl>
								<dl>
									<dt><i class="axi axi-ion-android-checkmark"></i> 취득년도</dt>
									<dd>
										<select title="취득년도 선택" name="" id="">
											<option value="">년</option>
											<option value=""></option>
										</select>
										년
									</dd>
								</dl>
							</td>
						</tr>
					</table>
				</div>
				<!--//자격증-->
				<!--외국어능력-->
				<div class="common_box language">
					<table class="com_table"> <!--반복-->
						<tr>
							<th>외국어능력<br><button class="regist_btn2">+ 추가</button></th>
							<td>
								<div>
									<dl>
										<dt><i class="axi axi-ion-android-checkmark"></i> 외국어</dt>
										<dd>
											<select title="외국어 선택" name="" id="">
												<option value="">외국어 선택</option>
												<option value=""></option>
											</select>
											<ul class="class">
												<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class1">상</span>(회화능숙)</li>
												<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class2">중</span>(일상대화)</li>
												<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class3">하</span>(간단대화)</li>
											</ul>
										</dd>
									</dl>
									<dl>
										<dt>어학연수</dt>
										<dd><input type="text"></dd>
									</dl>
								</div>
								<div class="add_exam">
									<dl>
										<dt>공인시험</dt>
										<dd>
											<select title="공인시험 선택" name="" id="">
												<option value="">공인시험 선택</option>
												<option value=""></option>
											</select>
											<button class="regist_btn1">+ 추가</button>
										</dd>
									</dl>
									<dl>
										<dt>점수/등급</dt>
										<dd><input type="text"></dd>
									</dl>
									<dl>
										<dt>취득년도</dt>
										<dd>
											<select title="년도 선택" name="" id="">
												<option value="">년도 선택</option>
												<option value=""></option>
											</select>
											년
										</dd>
									</dl>
								</div>
								<div class="add_exam">
									<dl>
										<dt>공인시험</dt>
										<dd>
											<select title="공인시험 선택" name="" id="">
												<option value="">공인시험 선택</option>
												<option value=""></option>
											</select>
											<button class="regist_btn1">- 제거</button>
										</dd>
									</dl>
									<dl>
										<dt>점수/등급</dt>
										<dd><input type="text"></dd>
									</dl>
									<dl>
										<dt>취득년도</dt>
										<dd>
											<select title="년도 선택" name="" id="">
												<option value="">년도 선택</option>
												<option value=""></option>
											</select>
											년
										</dd>
									</dl>
								</div>
							</td>
						</tr>
					</table>
					<table class="com_table"> <!--반복-->
						<tr>
							<th>외국어능력<br><button class="regist_btn2">- 제거</button></th>
							<td>
								<div>
									<dl>
										<dt><i class="axi axi-ion-android-checkmark"></i> 외국어</dt>
										<dd>
											<select title="외국어 선택" name="" id="">
												<option value="">외국어 선택</option>
												<option value=""></option>
											</select>
											<ul class="class">
												<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class1">상</span>(회화능숙)</li>
												<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class2">중</span>(일상대화)</li>
												<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class3">하</span>(간단대화)</li>
											</ul>
										</dd>
									</dl>
									<dl>
										<dt>어학연수</dt>
										<dd><input type="text"></dd>
									</dl>
								</div>
								<div class="add_exam">
									<dl>
										<dt>공인시험</dt>
										<dd>
											<select title="공인시험 선택" name="" id="">
												<option value="">공인시험 선택</option>
												<option value=""></option>
											</select>
											<button class="regist_btn1">+ 추가</button>
										</dd>
									</dl>
									<dl>
										<dt>점수/등급</dt>
										<dd><input type="text"></dd>
									</dl>
									<dl>
										<dt>취득년도</dt>
										<dd>
											<select title="년도 선택" name="" id="">
												<option value="">년도 선택</option>
												<option value=""></option>
											</select>
											년
										</dd>
									</dl>
								</div>
								<div class="add_exam">
									<dl>
										<dt>공인시험</dt>
										<dd>
											<select title="공인시험 선택" name="" id="">
												<option value="">공인시험 선택</option>
												<option value=""></option>
											</select>
											<button class="regist_btn1">- 제거</button>
										</dd>
									</dl>
									<dl>
										<dt>점수/등급</dt>
										<dd><input type="text"></dd>
									</dl>
									<dl>
										<dt>취득년도</dt>
										<dd>
											<select title="년도 선택" name="" id="">
												<option value="">년도 선택</option>
												<option value=""></option>
											</select>
											년
										</dd>
									</dl>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<!--//외국어능력-->
				<!--보유기술 및 능력-->
				<div class="common_box technology">
					<table class="com_table"> <!--반복-->
						<tr>
							<th>OA능력</th>
							<td>
								<dl>
									<dt>워드(한글·MS워드)</dt>
									<dd>
										<ul class="class">
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class1">상</span>(표/도구활용가능)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class2">중</span>(문서편집 가능)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class3">하</span>(기본사용)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>해당없음</li>	
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>프리젠테이션(파워포인트)</dt>
									<dd>
										<ul class="class">
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class1">상</span>(챠트/효과 활용가능)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class2">중</span>(서식/도형 가능)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class3">하</span>(기본사용)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>해당없음</li>	
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>스프레드시트(엑셀)</dt>
									<dd>
										<ul class="class">
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class1">상</span>(수식/함수 활용가능)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class2">중</span>(데이터 편집가능)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class3">하</span>(기본사용)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>해당없음</li>	
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>인터넷(정보검색)</dt>
									<dd>
										<ul class="class">
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class1">상</span>(정보수집 능숙)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class2">중</span>(정보수집 가능)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> <span class="class3">하</span>(기본사용)</li>
											<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label>해당없음</li>	
										</ul>
									</dd>
								</dl>
							</td>
						</tr>
						<tr>
							<th>컴퓨터능력</th>
							<td>
								 <ul class="class">
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 프로그래밍</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 디자인</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 컴퓨터활용능력</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 포토샵이미지툴</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> PC조립/설치</li>
								 </ul>
							</td>
						</tr>
					</table>
				</div>
				<!--//보유기술 및 능력-->

				<!--수상·수료활동-->
				<div class="common_box awards">
					<table class="com_table"> <!--반복-->
						<tr>
							<th>수상·수료활동</th>
							<td><textarea name="" id=""></textarea></td>
						</tr>
					</table>
				</div>
				<!--//수상·수료활동-->

				<!--구인우대사항-->
				<div class="common_box preferential">
					<table class="com_table">
						<tr>
							<th>국가보훈</th>
							<td>
								<ul >
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 비대상</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 대상</li>
								</ul>
								<input type="text" placeholder="대상사유"><!--대상선택되었을때-->
							</td>
						</tr>
						<tr>
							<th>고용지원금</th>
							<td>
								<ul>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 비대상</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 대상</li>
								</ul>
								<ul class="class" style="margin-bottom:0"><!--대상선택되었을때-->
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 중증장애인</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 경증장애인</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 여성가장</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 경력단절여성(임신,출산,육아)</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 고령자</li>
									<li><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 기타</li>
								</ul>
							</td>
						</tr>
						<tr>
							<th>병역여부</th>
							<td>
								<ul>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 미필</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 군필</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 면제</li>
								</ul>
								<input type="text" placeholder="[선택]면제사유"><!--면제로선택되었을때-->
								<select name="" id="" title="입대년도"><!--군필로선택되었을때-->
									<option value="">년</option>	
									<option value=""></option>	
								</select>
								년
								<select name="" id="" title="입대월">
									<option value="">월</option>	
									<option value=""></option>	
								</select>
								월 ~
								<select name="" id="" title="제대년도">
									<option value="">년</option>	
									<option value=""></option>	
								</select>
								년
								<select name="" id="" title="제대월">
									<option value="">월</option>	
									<option value=""></option>	
								</select>
								월
							</td>
						</tr>
						<tr>
							<th>장애여부</th>
							<td>
								<ul>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 비대상</li>
									<li><input type="radio" id="" name=""><label for="" class="radiostyle1" ></label> 대상</li>
								</ul>
								<select name="" id="" title="장애등급">
									<option value="">등급</option>
								</select>
								<input type="text" placeholder="[선택]장애내용 입력">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="agree_box">
									<p><i class="axi axi-ion-android-checkmark"></i> 민감정보 처리 동의<span><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> 처리에 동의합니다.</span>	</p>
									<div>
										당사는 개인정보보호법 제23조에 따라 상기의 개인정보에 대한 개별 동의사항에 대하여 다음과 같이 귀하의 민감정보(보훈대상, 장애여부, 고용지원금)를 처리(수집/이용, 제공 등) 하고자 합니다 <br><br>

수집에 동의하지 않을 경우 해당 민감정보 항목은 저장되지 않습니다.<br><br>

① 개인정보 수집 이용 목적 : 이력서 작성, 보관 및 입사지원 시 제공<br>
② 수집항목 : 민감정보 (보훈대상, 장애여부, 고용지원금)<br>
③ 보유 이용기간 : 회원정보 보유기간을 따른다<br>
④ 동의 거부 권리 안내 : 본 서비스는 민감정보 제공에 동의하지 않을 경우, 해당항목은 저장할 수 없습니다.
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<!--//구인 우대사항-->
			</div>
			<!--//선택사항-->
		</div>
		<!--//left_info-->
		<!--right_info-->
		<div class="right_info">
			<p>회원 기본정보</p>	
			<div class="info_box">
				<div>
					<div class="injae_img">
						<p></p>
					</div>
					<ul>
						<li><button>사진수정</button></li>
						<li><button>정보수정</button></li> <!--정보수정클릭시 작성한 내용을 저장하지 않고 페이지를 벗어난다는 경고메세지 띄어져야함  -->
					</ul>
				</div>
				<dl>
					<dt>이름</dt>
					<dd>김넷퓨</dd>
					<dt>성별</dt>
					<dd>여</dd>
					<dt>나이</dt>
					<dd>34세</dd>
					<dt>연락처</dt>
					<dd>010-2855-1242</dd>
					<dt>이메일</dt>
					<dd>test@test.test</dd>
					<dt>주소</dt>
					<dd>[501-713] 광주광역시 동구 금남로5가 남선빌딩 407호</dd>
					<dt>홈페이지</dt>
					<dd>http://netfu.co.kr</dd>
				</dl>
			</div>
			<button class="pay">유료 인재공고 등록</button>
			<button class="base">일반 인재공고 등록</button>
		</div>
		<!--//right_info-->
	</section>
</div>

<div class="popup_layer ijimg">
	<h1>사진등록/수정<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="text_info">
		GIF, JPEG, JPG, PNG 파일형식으로 140*170픽셀, 100KB 용량 이내의 파일만 등록 가능합니다.
	</div>
	<p class="file">
		<input type="file">
	</p>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>확인</button></li>
	</ul>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>
