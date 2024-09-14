<?php
$_SERVER['__USE_API__'] = array('jqueryui', 'editor');
$add_cate_arr = array('email', 'subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
include_once "../engine/_core.php";
$nf_member->check_login('company');

$get_no = $_GET['info_no'] ? $_GET['info_no'] : $_GET['no'];
$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($get_no));
$is_modify = $em_row && $_GET['code']!='copy' && !$_GET['info_no'] ? true : false;
if($em_row['is_delete']) {
	die($nf_util->move_url($nf_util->page_back(), "삭제된 구인정보입니다."));
}
if($em_row && $em_row['mno']!=$member['no']) {
	die($nf_util->move_url($nf_util->page_back(), "검색된 구인정보가 없습니다."));
}

$_site_title_ = '구인정보 '.($is_modify ? '수정' : '등록');
include '../include/header_meta.php';
include '../include/header.php';

$employ_query = $db->query_fetch_rows("select * from nf_employ where `mno`=".intval($member['no'])." order by `no` desc");

$employ_info = $nf_job->employ_info($em_row);

$cno_no = $em_row['cno'] ? $em_row['cno'] : $member_ex['no'];

$company_m_query = $db->query_fetch("select * from nf_member_company where `mno`=".intval($member['no']));

$m_title = '구인공고 등록';
include NFE_PATH.'/include/m_title.inc.php';
?>
<script type="text/javascript">
var click_submit = function(code) {
	var form = document.forms['fwrite'];
	form.charge.value = code;
}
</script>
<form name="ffile" action="<?php echo NFE_URL;?>/include/regist.php" method="post" enctype="multipart/form-data" style="display:none">
<input type="hidden" name="mode" value="employ_upload" />
<input type="hidden" name="no" value="<?php echo intval($em_row['no']);?>" />
<input type="hidden" name="code" value="" />
<input type="file" name="file_upload" id="file_upload-" onChange="nf_job.ch_logo(this)" />
</form>

<div class="wrap1260 MAT20">
	
	<form name="fwrite" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return validate(this)" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="employ_write" />
	<input type="hidden" name="mno" value="<?php echo $em_row['mno'];?>" />
	<input type="hidden" name="no" value="<?php echo $em_row['no'];?>" />
	<input type="hidden" name="code" value="<?php echo $_GET['code'];?>" />
	<input type="hidden" name="charge" value="<?php echo $_GET['code'];?>" />
	<input type="hidden" name="info_no" value="<?php echo $_GET['info_no'] ? intval($em_row['no']) : "";?>" />
	<section class="employ_regist regist_common sub">
		<div class="left_info">
			<!--이 영역에 인크루드-->
			<?php
			include NFE_PATH.'/include/job/employ_write.inc.php';
			?>
			</form>
		</div>
		<!--//left_info-->

		<?php
		include NFE_PATH.'/nad/include/logo.inc.php'; // : 로고
		include NFE_PATH.'/nad/include/bg_logo.inc.php'; // : 배경로고
		include NFE_PATH.'/nad/include/grade_position.inc.php'; // : 직급,직책
		include NFE_PATH.'/nad/include/preferential.inc.php'; // : 우대조건
		include NFE_PATH.'/nad/include/welfare.inc.php'; // : 복리후생

		$q = "nf_member_company as nmc where nmc.`mno`=".intval($member['no'])." ".$_where;
		$max_company_no = $db->query_fetch("select max(`no`) as c from ".$q);
		$company_query = $db->_query("select *, if(nmc.is_public=1, ".intval($max_company_no['c']+1).", nmc.`no`) as sort_no from ".$q.$order);
		?>
		<!--right_info-->
		<div class="right_info">
			<select name="cno" onChange="nf_job.ch_company(this)">
				<?php
				while($row=$db->afetch($company_query)) {
					$selected = $cno_no==$row['no'] ? 'selected' : '';
				?>
				<option value="<?php echo $row['no'];?>" <?php echo $selected;?>><?php echo $nf_util->get_text($row['mb_company_name']);?></option>
				<?php
				}?>
			</select>
			<div class="info_box">
				<div>
					<div class="logo_img">
						<p class="logo_img_put-" <?php if($member_ex['mb_logo_src']) {?>style="background-image:url(<?php echo $member_ex['mb_logo_src'];?>);"<?php }?>></p>
					</div>
					<ul>
						<li><a href="#none;" onClick="nf_util.window_open(root+'/company/company_info_regist.php?no='+document.forms['fwrite'].cno.value, 'mem_modify', 1280, 900)"><button type="button">정보수정</button></a></li> <!--정보수정클릭시 작성한 내용을 저장하지 않고 페이지를 벗어난다는 경고메세지 띄어져야함  -->
					</ul>
				</div>
				<dl>
					<dt>업소명</dt>
					<dd class="company_name-"><?php echo $nf_util->get_text($member_ex['mb_company_name']);?></dd>
					<dt>대표자명</dt>
					<dd class="ceo_name-"><?php echo $nf_util->get_text($member_ex['mb_ceo_name']);?></dd>

					<?php if(!empty($member_ex['mb_biz_no'])) { ?>
						<dt>사업자번호</dt>
						<dd><?php echo $nf_util->make_pass_($member_ex['mb_biz_no']);?></dd>
					<?php } ?>
					<!-- <dt>업소형태</dt>
					<dd class="biz_type-"><?php echo $nf_util->get_text($member_ex['mb_biz_type']);?></dd> -->
					<!--
					<dt>주요사업</dt>
					<dd class="biz_content-"><?php echo $nf_util->get_text($member_ex['mb_biz_content']);?></dd>
					-->
					<dt>업소주소</dt>
					<dd class="biz_address-"><?php echo $nf_util->get_text($member_ex['mb_biz_address0']." ".$member_ex['mb_biz_address1']);?></dd>
					
					<!-- <dt>홈페이지</dt>
					<dd class="homepage-"><?php echo $nf_util->get_text($member_ex['mb_homepage']);?></dd> -->
				</dl>
			</div>
			<?php
			if($env['service_employ_audit_use']) $is_audit = true;
			if($env['service_employ_use']) $is_charge = true;


			if($is_modify) {
			?>
			<button class="base pay" onClick="click_submit(0)">수정하기</button>
			<?php
			} else {
				if($is_charge===true && $env['service_employ_use']) {
				?>
				<button class="base pay" onClick="click_submit(1)">유료 구인공고 등록</button>
				<?php
				}
				
				if(!$nf_payment->service_kind_arr['employ']['1_list']['is_pay']) {
					if($is_audit===true && $env['service_employ_use']) {
					?>
					<button class="base" onClick="click_submit('audit')">심사후 구인공고 등록</button>
					<?php } else {?>
					<button class="base" onClick="click_submit(0)">일반 구인공고 등록</button>
					<?php }
				}
			}?>
			<!--관리자에서 심사후에 등록하기로 설정하면 '유료서비스 즉시등록','심사 후 공고등록완료' 노출/관리자에서 바로 등록이면 '유료서비스 이용등록','공고등록완료' 노출-->
		</div>
		<!--//right_info-->
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
