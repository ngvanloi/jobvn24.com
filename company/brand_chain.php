<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>체인점 관리<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php include '../include/company_leftmenu.php'; ?>
		<div class="subcon_area">
			<section class="brand_chain my_brandinfo">
				<h1>체인점 관리</h1>
				<div class="no_brand"> <!--브랜드 입점하지 않은 회원에게 노출-->
					입점하지 않은 회원입니다.<br>
					브랜드 입점은 브랜드 본사가 가입하는 서비스입니다.<br><button>브랜드 입점 안내</button>
				</div>
				<div class="sub_serach">
					<div>
						<select name="" id="">
							<option value="">체인지점명</option>
							<option value="">담당자 명</option>
						</select>
						<form action="">
							<div class="search_style">
								<label for="">
									<input type="text">
									<button type="submint"><i class="axi axi-search3"></i></button>
								</label>
							</div>
						</form>
					</div>
				</div>
				<div class="button_area">
					<ul class="fl">
						<li class="on"><a href="">· 등록일순</a></li>
						<li><a href="">· 구인등록 많은순</a></li>
					</ul>
					<ul class="fr">
						<li><button class="bbcolor">체인지점 추가</button></li>
					</ul>
				</div>
				<table class="style3">
					<colgroup>
						<col width="10%">
						<col width="20%">
						<col width="20%">
						<col width="10%">
						<col width="20%">
						<col width="20%">
					</colgroup>
					<tr>
						<th><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> </th>
						<th>체인지점</th>
						<th>담당자명</th>
						<th>등록된 구인건수</th>
						<th>쪽지보내기</th>
						<th>설정</th>
					</tr>
					<tr>
						<td colspan="6">등록된 체인지점이 없습니다.</td>
					</tr>
					<tr>
						<td><input type="checkbox" id=""><label for="" class="checkstyle1" ></label> </td>
						<td>광주광역시 화정지점</td>
						<td><a href="">김담당</a></td>
						<td><a href="">2건</a></td>
						<td>
							<ul class="button">
								<li><button><i class="axi axi-forum"></i> 쪽지</button></li>
							</ul>
						</td>
						<td class="tac">
							<ul class="button">
								<li><button>수정</button></li>
								<li><button>삭제</button></li>
							</ul>
						</td>
					</tr>
				</table>
				<div class="button_area MAT10">
					<ul class="fl">
						<li><button class="white">전체선택</button></li>
						<li><button class="white">선택삭제</button></li>
					</ul>
				</div>
			</section>
			<!--페이징-->
			<?php include '../include/paging.php'; ?>
		</div>
	</section>
</div>


<div class="popup_layer manager"> <!--담당자이름 클릭시 나타나는 창-->
	<h1>담당자 정보<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="scroll">
		<table class="style1">
			<tr>
				<th>체인지점<i class="axi axi-ion-android-checkmark"></i></th>
				<td>광주광역시 화정지점</td>
			</tr>
			<tr>
				<th>담당자명<i class="axi axi-ion-android-checkmark"></i></th>
				<td>김담당</td>
			</tr>
			<tr>
				<th>연락처<i class="axi axi-ion-android-checkmark"></i></th>
				<td>010-0000-0000</td>
			</tr>
			<tr>
				<th>휴대폰</th>
				<td>010-0000-0000</td>
			</tr>
			<tr>
				<th>팩스</th>
				<td>-</td>
			</tr>
			<tr>
				<th>이메일</th>
				<td>-</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button>닫기</button></li>
	</ul>
</div>

<div class="popup_layer manager">  <!--수정버튼 클릭시-->
	<h1>담당자 정보 수정<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="scroll">
		<table class="style1">
			<tr>
				<th>체인지점<i class="axi axi-ion-android-checkmark"></i></th>
				<td><input type="text"></td>
			</tr>
			<tr>
				<th>담당자명<i class="axi axi-ion-android-checkmark"></i></th>
				<td><input type="text"></td>
			</tr>
			<tr>
				<th>연락처<i class="axi axi-ion-android-checkmark"></i></th>
				<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
			</tr>
			<tr>
				<th>휴대폰</th>
				<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
			</tr>
			<tr>
				<th>팩스</th>
				<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
			</tr>
			<tr>
				<th>이메일</th>
				<td><input type="text"> @ <input type="text">
					<select name="" id="">
						<option value="">직접입력</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>등록</button></li>
	</ul>
</div>

<div class="popup_layer manager">  <!--체인지점 추가-->
	<h1>체인지점 추가<button><i class="axi axi-ion-close-round"></i></button></h1>
	<div class="scroll">
		<table class="style1">
			<tr>
				<th>체인지점명<i class="axi axi-ion-android-checkmark"></i></th>
				<td><input type="text"></td>
			</tr>
			<tr>
				<th>담당자명<i class="axi axi-ion-android-checkmark"></i></th>
				<td><input type="text"></td>
			</tr>
			<tr>
				<th>연락처<i class="axi axi-ion-android-checkmark"></i></th>
				<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
			</tr>
			<tr>
				<th>휴대폰</th>
				<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
			</tr>
			<tr>
				<th>팩스</th>
				<td class="size1"><input type="text"> - <input type="text"> - <input type="text"></td>
			</tr>
			<tr>
				<th>이메일</th>
				<td><input type="text"> @ <input type="text">
					<select name="" id="">
						<option value="">직접입력</option>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>등록</button></li>
	</ul>
</div>


<div class="popup_layer mail">
	<h1>쪽지보내기<button><i class="axi axi-ion-close-round"></i></button></h1>
	<table class="style1">
		<tr>
			<th>받는사람(닉네임)</th>
			<td>김담당</td>
		</tr>
	</table>
	<div class="text_area">
		<textarea name="" id="" placeholder="내용을 입력해주세요"></textarea>
	</div>	
	<ul class="btn">
		<li><button>취소</button></li>
		<li><button>보내기</button></li>
	</ul>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
