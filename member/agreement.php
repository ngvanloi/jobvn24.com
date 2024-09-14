<?php
$_site_title_ = '본인인증';
include_once "../engine/_core.php";
$nf_member->check_not_login();

include '../include/header_meta.php';
include '../include/header.php';
?>
<?php if(!$env['use_adult']) {?>
<script type="text/javascript" src="<?php echo NFE_URL;?>/plugin/auth/nf_auth.class.js"></script>
<?php }?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>본인인증<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 MAT20">
	<section class="register agreement sub">
		<p class="s_title">본인인증</p>
		<div class="box_wrap">
			<div class="certification">
				<?php if($env['use_ipin'] || $env['use_hphone']) {?>
					<?php if($env['use_ipin']) {?>
					<div class="ipin agree">
						<h2>아이핀인증</h2>
						<div>
							<p><i class="axi axi-lock-outline"></i></p>
							<button type="button">아이핀 인증하기</button>
						</div>
					</div>
					<?php }?>
					<?php if($env['use_hphone']) {?>
					<div class="phone agree">
						<h2>휴대폰인증</h2>
						<div>
							<p><i class="axi axi-phone-android"></i></p>
							<button type="button">휴대폰 인증하기</button>
						</div>
					</div>
					<?php }?>
				<?php } else if($env['use_bbaton']) {?>
					<div class="bbaton agree">
						<h2>비바톤</h2>
						<div>
							<p><i style="font-weight:bold; font-style:normal;">B</i></p>
							<button type="button" onClick="nf_auth.auth_func('bbaton')">비바톤 인증하기</button>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php 
include_once  NFE_PATH."/plugin/auth/kcb/auth.inc.php";
include '../include/footer.php'; 
?>