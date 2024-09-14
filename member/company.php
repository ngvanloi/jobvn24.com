<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_member.class.js"></script>
<div class="wrap1260 MAT20">
	
	<section class="register sub">
		<p class="s_title">업소 회원가입</p>
		<div class="box_wrap">
			<ul class="order">
				<li><span>1</span>약관동의</li>
				<li class="on"><span>2</span>회원정보 입력</li>
				<li><span>3</span>가입완료</li>
			</ul>
			<h2>업소정보 입력</h2>
			<form name="fmember" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
			<input type="hidden" name="mode" value="member_write" />
			<input type="hidden" name="mb_type" value="<?php echo $nf_util->get_html($_GET['code']);?>" />
			<?php
			include NFE_PATH.'/include/etc/google_recaptcha3.inc.php';
			?>
			<?php
			include NFE_PATH.'/member/company_part.inc.php';
			?>
			<div class="next_btn">
				<button type="button" class="base graybtn">취소하기</button>
				<button type="submit" class="base">회원가입</button>
			</div>
			</form>
		</div>
	</section>
	
</div>