<?php
$_SERVER['__USE_API__'] = array('editor');
$add_cate_arr = array('job_company', 'job_listed', 'job_company_type', 'email');
$top_menu_code = '300203';
include '../include/header.php';

$company_row = $db->query_fetch("select * from nf_member_company as nmc where `no`=?", array($_GET['no']));
$mb_phone_arr = explode("-", $company_row['mb_phone']);
$mb_hphone_arr = explode("-", $company_row['mb_hphone']);
$mb_biz_fax_arr = explode("-", $company_row['mb_biz_fax']);
$mb_email_arr = explode("@", $company_row['mb_email']);
$mb_biz_no_arr = explode("-", $company_row['mb_biz_no']);
$mb_receive_arr = explode(",", $company_row['mb_receive']);


$mno = $company_row['mno'] ? $company_row['mno'] : $_GET['mno'];
$mem_row = $db->query_fetch("select * from nf_member where `no`=".intval($mno));
?>
<!-- 업소회원등록 -->
<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_member.class.js"></script>
<div class="wrap">
	<?php include '../include/left_menu.php'; ?> <!--관리자 공통 좌측메뉴-->

	<section>
		<?php include '../include/title.php'; ?> <!--관리자 타이틀영역-->
		<div class="consadmin conbox">
			
			<form name="fmember" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
			<input type="hidden" name="mode" value="company_write" />
			<input type="hidden" name="mno" value="<?php echo $mem_row['no'];?>" />
			<input type="hidden" name="no" value="<?php echo $nf_util->get_html($company_row['no']);?>" />
			<h6>업소정보입력<span><b>*</b> 표시는 필수 입력사항</span></h6>

			<table class="style1">
				<colgroup>
					<col width="10%">
				</colgroup>
				<tbody>
				<tr>
					<th>아이디</th>
					<td><?php echo $mem_row['mb_id'];?> (<?php echo $mem_row['mb_name'];?>)</td>
				</tr>
				<?php
					if(!$company_row['mb_biz_email']) $company_row['mb_biz_email'] = $my_member['mb_email'];
					if(!$company_row['mb_biz_hphone']) $company_row['mb_biz_hphone'] = $my_member['mb_hphone'];
					include NFE_PATH.'/include/job/company_write.inc.php';
				?>
				</tbody>
			</table>
			<div class="flex_btn">
				<button type="submit" class="save_btn">저장하기</button>
				<button type="button" class="cancel_btn">취소하기</button>
			</div>
			</form>
		</div>
		<!--//conbox-->

		

		
	</section>
</div>
<!--//wrap-->

<?php include '../include/footer.php'; ?> <!--관리자 footer-->