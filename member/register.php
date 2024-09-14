<?php
$_site_title_ = '회원가입 동의';
include_once "../engine/_core.php";
$nf_member->check_not_login();

include '../include/header_meta.php';
include '../include/header.php';
?>
<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_member.class.js"></script>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>회원가입<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 MAT20">
	<form name="fagree" action="<?php echo NFE_URL;?>/member/member_regist.php" method="get">
	<input type="hidden" name="code" value="" />
	<section class="register sub">
		<p class="s_title">회원가입</p>
		<div class="box_wrap">
			<ul class="order">
				<li class="on"><span>1</span>약관동의</li>
				<li><span>2</span>회원정보 입력</li>
				<li><span>3</span>가입완료</li>
			</ul>
			<div class="allagree">
				<p>모든 약관의 내용을 확인하고 동의합니다.</p>
				<p><input type="checkbox" onClick="nf_member.check_agree(this)" id="allagree"><label for="allagree" class="checkstyle2" ></label>모든 약관 동의</p>
			</div>
			<div class="terms">
				<h2>· 회원약관</h2>
				<div class="terms_box">
					<?php echo stripslashes($env['content_membership']);?>
				</div>
				<p><input type="checkbox" class="_chk" txt="회원약관" id="indiagree"><label for="indiagree" class="checkstyle1" ></label>회원약관에 동의합니다.</p>
			</div>
			<div class="terms">
				<h2>· 개인정보보호정책</h2>
				<div class="terms_box">
					<?php echo stripslashes($env['content_privacy']);?>
				</div>
				<p><input type="checkbox" class="_chk" txt="개인정보보호정책" id="infoagree"><label for="infoagree" class="checkstyle1" ></label>개인정보보호정책에 동의합니다.</p>
			</div>
			<div class="next_btn">
				<button type="button" onClick="nf_member.member_regist_move('individual')" class="base darkbluebtn">개인회원 가입</button>
				<button type="button" onClick="nf_member.member_regist_move('company')" class="base">업소회원 가입</button>
			</div>
		</div>
	</section>
	</form>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>