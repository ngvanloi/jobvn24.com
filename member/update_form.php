<?php
$_SERVER['__USE_API__'] = array('jqueryui', 'editor');
$add_cate_arr = array('job_company', 'job_listed', 'job_company_type', 'email');
include_once "../engine/_core.php";
$nf_member->check_login();

include '../include/header_meta.php';
include '../include/header.php';

$mb_phone_arr = explode("-", $member['mb_phone']);
$mb_hphone_arr = explode("-", $member['mb_hphone']);
$mb_receive_arr = explode(",", $member['mb_receive']);
$mb_email_arr = explode("@", $member['mb_email']);

$m_title = '개인정보 수정';
if($member['mb_type']=='individual') $m_title = '업소정보 수정';
include NFE_PATH.'/include/m_title.inc.php';
?>
<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_member.class.js"></script>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['update_form'] = 'on';
		if($member['mb_type']=='individual') include '../include/indi_leftmenu.php';
		else include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="register pass_check">
				<p class="s_title">비밀번호 확인</p>
				<ul class="help_text">
					<li>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 다시 한 번 입력해 주세요.</li>
				</ul>
				<form name="fmember" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
				<input type="hidden" name="mode" value="member_modify" />
				<?php
				include NFE_PATH.'/include/etc/google_recaptcha3.inc.php';
				?>
				<table class="style1">
					<tr>
						<th><i class="axi axi-ion-android-checkmark"></i>회원아이디</th>
						<td><?php echo $member['mb_id'];?></td>
					</tr>
					<?php if(!$member['mb_is_sns']) {?>
					<tr>
						<th>비밀번호확인</th>
						<td><input type="password" name="mb_password" hname="비밀번호확인" needed><em>* 비밀번호를 입력해 주십시오.</em></td>
					</tr>
					<?php }?>
				</table>

				<p class="s_title" style="margin-top:4rem"><?php echo $nf_member->mb_type[$member['mb_type']];?>정보 수정</p>
				<?php
				// : /member/individual.php - 개인회원
				// : /member/company.php - 업소회원
				$company_row = $member_ex;
				$my_member = $member;
				include NFE_PATH.'/member/'.$member['mb_type'].'_part.inc.php';
				?>
				<div class="next_btn">
					<button class="base">수정하기</button>
				</div>
				</form>
			</section>
		</div>
	</section>
</div>
<!--푸터영역-->
<?php include '../include/footer.php'; ?>
