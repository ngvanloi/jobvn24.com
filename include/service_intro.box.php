<script type="text/javascript">
var intro_service = function(el, code, service) {
	$(".popup_layer.product").css({"display":"none"});
	$(".service-"+code+"-"+service+"-").css({"display":"block"});
}

var intro_service_close = function(el) {
	$(el).closest(".popup_layer.product").css({"display":"none"});
}
</script>

<?php
// : 업소회원 서비스 모음
?>

<div class="popup_layer product service-employ-main-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">메인구인 페이지 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/employ_main_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service-employ-0_border-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">메인구인 테두리강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/employ_main_product_border.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service-employ-sub-"  style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">구인정보 페이지 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/employ_sub_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service-employ-1_border-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">서브 구인 테두리강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/employ_sub_product_border.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product hurry service-employ-busy-" style="display:none;" >
	<div class="h6wrap">
		<h6 class="s_title">급구구인 페이지 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/employ_busy_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-employ-icon-"style="display:none;" >
	<div class="h6wrap">
		<h6 class="s_title">아이콘 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<table>
			<tr>
				<td class="ij_preview">
					<div>
						<p class="title line1"><img src="../images/icon_company_00.gif">함께 업소을 꾸려나갈 인재를 모집합니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">IT>웹 / 대학교졸업(4년) : 웹디자인과</p>
					</div>
					<div>
						<p class="title line1"><img src="../images/icon_injae_01.gif">함께 업소을 꾸려나갈 인재를 모집합니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">IT>웹 / 대학교졸업(4년) : 웹디자인과</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-employ-neon-" style="display:none;"  >
	<div class="h6wrap">
		<h6 class="s_title">형광펜 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<table>
			<tr>
				<td class="ij_preview">
					<div>
						<p class="title line1 bgcol1">함께 업소을 꾸려나갈 인재를 모집합니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">IT>웹 / 대학교졸업(4년) : 웹디자인과</p>
					</div>
					<div>
						<p class="title line1 bgcol2">함께 업소을 꾸려나갈 인재를 모집합니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">IT>웹 / 대학교졸업(4년) : 웹디자인과</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>


<div class="popup_layer product service service-employ-color-"  style="display:none;" >
	<div class="h6wrap">
		<h6 class="s_title">글자색 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<table>
			<tr>
				<td class="ij_preview">
					<div>
						<p class="title line1 tcol1">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
					</div>
					<div>
						<p class="title line1 tcol2">함께 업소을 꾸려나갈 인재를 모집합니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">IT>웹 / 대학교졸업(4년) : 웹디자인과</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-employ-bold-"style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">굵은글자 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll min-height">
		<table>
			<tr>
				<td class="ij_preview">
					<div>
						<p class="title line1 fwb">함께 업소을 꾸려나갈 인재를 모집합니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">IT>웹 / 대학교졸업(4년) : 웹디자인과</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-employ-blink-"  style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">반짝칼라글자 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll min-height"">
		<table>
			<tr>
				<td class="ij_preview">
					<div>
						<p class="title line1 service-blink-">함께 업소을 꾸려나갈 인재를 모집합니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">IT>웹 / 대학교졸업(4년) : 웹디자인과</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>


<div class="popup_layer product hurry service-employ-jump-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">점프서비스 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/employ_jump_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>





<?php
// : 개인회원 서비스 모음
?>
<div class="popup_layer product service-resume-main-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">메인 인재 페이지 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/resume_main_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service-resume-0_border-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">메인 인재 테두리강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/resume_main_product_border.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service-resume-sub-"  style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">인재정보 페이지 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/resume_sub_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service-resume-1_border-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">서브 인재 테두리강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/resume_sub_product_border.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product hurry service-resume-busy-" style="display:none;" >
	<div class="h6wrap">
		<h6 class="s_title">급구인재 페이지 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/indi_hurry_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-resume-icon-"style="display:none;" >
	<div class="h6wrap">
		<h6 class="s_title">아이콘 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<table>
			<tr>
				<td class="ij_preview">
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
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-resume-neon-" style="display:none;"  >
	<div class="h6wrap">
		<h6 class="s_title">형광펜 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<table>
			<tr>
				<td class="ij_preview">
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
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>


<div class="popup_layer product service service-resume-color-"  style="display:none;" >
	<div class="h6wrap">
		<h6 class="s_title">글자색 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<table>
			<tr>
				<td class="ij_preview">
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
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-resume-bold-"style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">굵은글자 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll min-height">
		<table>
			<tr>
				<td class="ij_preview">
					<div>
						<p class="title line1 fwb">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>

<div class="popup_layer product service service-resume-blink-"  style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">반짝칼라글자 강조 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll min-height"">
		<table>
			<tr>
				<td class="ij_preview">
					<div>
						<p class="title line1 service-blink-">모든일에 최선을 다하는 열정을 가지고 있습니다.</p>
						<p class="locaiotn line1"><i class="axi axi-location-on"></i> 서울 강서구,경기 화성시</p>
						<p class="jb line1">서비스>숙박·호텔·리조트>도어맨 / 대학교졸업(4년) : 호텔조리학과</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>


<div class="popup_layer product hurry service-resume-jump-" style="display:none;">
	<div class="h6wrap">
		<h6 class="s_title">점프서비스 상품 미리보기</h6>
		<button type="button" onClick="intro_service_close(this)"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<img src="../images/indi_jump_product.jpg" alt="">
	</div>
	<ul class="btn">
		<li><button type="button" onClick="intro_service_close(this)">닫기</button></li>
	</ul>
</div>