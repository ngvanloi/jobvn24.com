<?php
$_SERVER['__USE_API__'] = array('jqueryui', 'editor');
$PATH = $_SERVER['DOCUMENT_ROOT'];
$add_cate_arr = array('email', 'job_type', 'job_date', 'job_week', 'job_time', 'job_pay', 'job_type', 'job_computer', 'job_pay_employ', 'job_obstacle', 'job_veteran', 'job_language', 'job_language_exam');

include_once $PATH."/engine/_core.php";
$nf_member->check_login('individual');

$get_no = $_GET['info_no'] ? $_GET['info_no'] : $_GET['no'];
$re_row = $db->query_fetch("select * from nf_resume where `no`=".intval($get_no));
$is_modify = $re_row && !$_GET['info_no'] ? true : false;

if($re_row['is_delete']) {
	die($nf_util->move_url($nf_util->page_back(), "삭제된 이력서정보입니다."));
}

$_site_title_ = '이력서등록';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '이력서 등록';
include NFE_PATH.'/include/m_title.inc.php';

$mno = $re_row['mno'] ? $re_row['mno'] : $member['no'];
$resume_individual = $nf_job->resume_individual($mno);
$resume_query = $db->_query("select * from nf_resume where `mno`=".intval($member['no'])." order by `no` desc");
$resume_info = $nf_job->resume_info($re_row);

// : 사진변경 태그정보 - 사진수정누르고 사진을 선택하면 바로 아래 태그를 실행합니다.
?>
<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_member.class.js"></script>
<style type="text/css">
.popup_layer { display:none; }
</style>
<script type="text/javascript">
var submit_func = function(el) {
	if(validate(el)) {
		if($("[name='resume_select[]'][value='preferential']")[0].checked && !$("[name='wr_sensitive']")[0].checked) {
			alert("민감정보처리동의를 체크해주시기 바랍니다.");
			$("[name='wr_sensitive']")[0].focus();
			return false;
		}
		return true;
	}
	return false;
}

var click_submit = function(code) {
	var form = document.forms['fwrite'];
	form.charge.value = code;
}
</script>
<div class="wrap1260 MAT20">
	<form name="fwrite" action="<?php echo NFE_URL;?>/include/regist.php" enctype="multipart/form-data" method="post" onSubmit="return submit_func(this)">
	<input type="hidden" name="mode" value="resume_write" />
	<input type="hidden" name="no" value="<?php echo $re_row['no'];?>" />
	<input type="hidden" name="charge" value="<?php echo $_GET['code'];?>" />
	<input type="hidden" name="info_no" value="<?php echo $_GET['info_no'] ? intval($re_row['no']) : "";?>" />
	<section class="resume_regist regist_common sub">
		<div class="left_info">
			<?php
			include NFE_PATH.'/include/job/resume_write.inc.php';
			?>
			
		</div>
		<!--//left_info-->
		<!--right_info-->
		<div class="right_info">
			<p>회원 기본정보</p>	
			<div class="info_box">
				<div>
					<div class="injae_img parent_photo_upload-">
						<p class="put_img-" style="background-image:url(<?php echo $member['photo_src'];?>)"></p>
					</div>
					<ul>
						<li><button type="button" onClick="$('.popup_layer.ijimg').css({'display':'block'})">사진수정</button></li>
						<li><a href="<?php echo NFE_URL;?>/member/update_form.php"><button type="button">정보수정</button></a></li> <!--정보수정클릭시 작성한 내용을 저장하지 않고 페이지를 벗어난다는 경고메세지 띄어져야함  -->
					</ul>
				</div>
				<dl>
					<dt>이름</dt>
					<dd><?php echo $nf_util->get_text($member['mb_name']);?></dd>
					<dt>성별</dt>
					<dd><?php echo $nf_util->gender_short_arr[$member['mb_gender']];?></dd>
					<dt>나이</dt>
					<dd><?php echo $nf_util->get_age($member['mb_birth']);?>세</dd>
					<dt>연락처</dt>
					<dd><?php echo $nf_util->get_text((strtr($member['mb_hphone'],array('-'=>'')) ? $member['mb_hphone'] : $member['mb_phone']));?></dd>
					<dt>이메일</dt>
					<dd><?php echo $nf_util->get_text($member['mb_email']);?></dd>
					<dt>주소</dt>
					<dd>[<?php echo $member['mb_zipcode'];?>] <?php echo $member['mb_address0'].' '.$member['mb_address1'];?></dd>
				</dl>
			</div>
			<?php
			if($is_modify) {?>
			<button class="base" onClick="click_submit(0)">수정하기</button>
			<?php
			} else {?>
				<?php
				if($env['service_resume_use']) {?>
				<button class="pay" onClick="click_submit(1)">유료 인재공고 등록</button>
				<?php
				}
				if(!$nf_payment->service_kind_arr['resume']['1_list']['is_pay']) {?>
				<button class="base" onClick="click_submit(0)">일반 인재공고 등록</button>
			<?php
				}
			}?>
		</div>
		<!--//right_info-->
	</section>
	</form>
</div>




<!--푸터영역-->
<?php
include NFE_PATH.'/include/etc/photo.individual.inc.php';
include '../include/footer.php';
?>
