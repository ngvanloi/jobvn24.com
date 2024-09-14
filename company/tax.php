<?php
$_SERVER['__USE_API__'] = array('jqueryui');
$add_cate_arr = array('job_company', 'job_listed', 'job_company_type', 'email');
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '세금계산서 발행신청';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '세금계산서 발행신청';
include NFE_PATH.'/include/m_title.inc.php';

if(!$member_tax) {
	$mb_biz_no_arr = explode("-", $member_ex['mb_biz_no']);
	$mb_phone_arr = explode("-", $mem_row['mb_phone']);
	$mb_email_arr = explode("@", $mem_row['mb_email']);
} else {
	$mb_biz_no_arr = explode("-", $member_tax['wr_biz_no']);
	$mb_phone_arr = explode("-", $member_tax['wr_phone']);
	$mb_email_arr = explode("@", $member_tax['wr_email']);
}
?>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php
		$left_on['tax'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<form name="fwrite" action="<?php echo NFE_URL;?>/include/regist.php" method="post">
			<input type="hidden" name="mode" value="tax_write" />
			<section class="tax common_table">
				<p class="s_title">세금계산서 발행신청</p>
				<ul class="help_text">
					<li>유료서비스 신청후 세금계산서 발행신청시 발행해드리고 있습니다. 단, 결제완료 후 세금계산서가 발행되오니 이 점 숙지하시기 바랍니다.</li>
				</ul>
				<?php
				include NFE_PATH.'/include/etc/tax.company.inc.php';
				?>
				<div class="next_btn">
					<button class="base">설정하기</button>
				</div>
			</section>
			</form>
		</div>
	</section>
</div>
<!--푸터영역-->
<?php include '../include/footer.php'; ?>
