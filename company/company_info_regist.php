<?php
$_SERVER['__USE_API__'] = array('jqueryui', 'editor');
$add_cate_arr = array('job_company', 'job_listed', 'job_company_type', 'email');
include_once "../engine/_core.php";
$nf_member->check_login('company');

$company_row = $db->query_fetch("select * from nf_member_company where `no`=?", array(intval($_GET['no'])));
$site_title_ = $_site_title_ = '업소정보 '.($company_row ? '수정' : '추가');

include '../include/header_meta.php';
include '../include/header.php';
?>
<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_member.class.js"></script>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button><?php echo $site_title_;?><button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php include '../include/company_leftmenu.php'; ?>
		<div class="subcon_area">
			<section class="register tab_style3">
				<p class="s_title"><?php echo $site_title_;?></p>
				<ul class="help_text">
					<li>체크항목은 필수 입력값입니다.</li>	
				</ul>
				<form name="fmember" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
				<input type="hidden" name="mode" value="company_write" />
				<input type="hidden" name="no" value="<?php echo $nf_util->get_html($company_row['no']);?>" />
				<table class="style1">
					<colgroup>
					</colgroup>
					<tbody>
						<?php
						include NFE_PATH.'/include/job/company_write.inc.php';
						?>
					</tbody>
				</table>
				<div class="next_btn">
					<button type="submit" class="base"><?php echo $company_row ? '수정' : '추가';?>하기</button>
				</div>
				</form>
			</section>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
