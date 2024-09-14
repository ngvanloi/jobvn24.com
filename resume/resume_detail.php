<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_time', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions', 'job_resume_report_reason', 'job_language_exam', 'job_computer', 'job_veteran', 'job_pay_employ', 'job_obstacle');
include_once "../engine/_core.php";
include_once NFE_PATH.'/engine/function/read_insert.function.php';
$service_where = $nf_search->service_where('resume');
$re_row = $db->query_fetch("select * from nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno` where nr.`no`=".intval($_GET['no']));
$is_service_end = $db->query_fetch("select * from nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno` where nr.`no`=".intval($_GET['no'])." and (".strtr($service_where['where'], array(" or "=>" and ", ">="=>"<")).")");



if(!$re_row || (!admin_id && $re_row['is_delete'])) {
	die($nf_util->move_url($nf_util->page_back(), "삭제된 인재정보입니다."));
}

// : 본인은 확인 가능해야함
$my_info = $re_row['mno']!=$member['no'] ? false : true;
if(!$my_info) {

	$not_read = $db->query_fetch("select * from nf_not_read where `mno`=".intval($re_row['mno'])." and `pmno`=".intval($member['no']));
	if($not_read) {
		die($nf_util->move_url($nf_util->page_back(), "해당 이력서는 열람이 제한되어 있습니다."));
	}

	if(!$re_row['wr_open'] && !admin_id) {
		die($nf_util->move_url($nf_util->page_back(), "비공개된 인재정보입니다."));
	}

	if($re_row['wr_report']==-1 && !admin_id) {
		die($nf_util->move_url($nf_util->page_back(), "신고된 인재정보입니다."));
	}

	// : 일반리스트 유무료 체크
	$service_row = $db->query_fetch("select * from nf_service where `code`=? and `type`=?", array('resume', '1_list'));
	if(!$service_row['is_pay']) $is_service_end = false; // : 일반리스트 무료
	//if(!$env['service_resume_use']) $is_service_end = false; // : 이력서 결제페이지 사용여부 [ 이건 처음만 무료고 기간이 남기 때문에 체크안함 ]
	if($is_service_end && !admin_id) {
		die($nf_util->move_url($nf_util->page_back(), "만료된 인재정보입니다."));
	}
}


include '../include/header_meta.php';
$not_read_div_box = ""; $accept_row = array(); // : 앞의 변수는 $nf_job->read() 함수에서 사용합니다.

$read_allow = $nf_job->read($member['no'], $re_row['no'], 'resume');
$resume_info = $nf_job->resume_info($re_row);
$resume_individual = $nf_job->resume_individual($re_row['mno']);
$mem_individual_row = $db->query_fetch("select * from nf_member_individual where `mno`=".intval($re_row['mno']));
$get_member = $db->query_fetch("select * from nf_member where `no`=".intval($re_row['mno']));
$_site_title_not_description_ = true;
$_site_title_ = $re_row['wr_subject'];
$_site_content_ =  $nf_util->get_text($re_row['wr_subject'].' '.$env['meta_description']);
$is_scrap = $db->query_fetch("select * from nf_scrap where `mno`=? and `pno`=? and `code`=?", array($member['no'], $_GET['no'], 'resume'));
include '../include/header.php';

$get_member_status = $nf_job->get_member_status($mem_individual_row, 'individual');

$m_title = '이력서 상세정보';
include NFE_PATH.'/include/m_title.inc.php';

if($member['mb_type']=='individual') $a_href_not_read = "alert('업소회원만 이용 가능합니다.');";
if($member['mb_type']=='company') $a_href_not_read = "location.href=root+'/service/product_payment.php?code=read'";
if(!$member['no']) $a_href_not_read = "location.href=root+'/member/login.php?url='+location.href";
?>
<div class="wrap1260 MAT20">
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('resume_F');
		echo $banner_arr['tag'];
		?>
	</div>

	<section class="resume_detail detail_common sub">
		<?php
		$page_code = 'resume';
		$page_code_txt = '이력서';
		$info_no = $re_row['no'];
		// : $not_read_div_box 변수는 $nf_job->read() 함수에서 사용합니다.
		if($not_read_div_box) include_once NFE_PATH.'/include/job/not_read.box.php';
		?>
		<div class="detail_top">
			<p class="s_title">이력서 상세정보</p>
			<div>
				<ul>
					<li><a href="#none" onClick="nf_util.openWin('.report-')"><i class="axi axi-bell"></i> 신고하기</a></li>
				</ul>
			</div>
		</div>
		<div class="r_detail">
			<div class="resume_d1">
				<h2><?php echo $nf_util->get_text($re_row['wr_subject']);?></h2>
				<div class="con1">
					<div class="ij_img">
						<p style="background-image:url(<?php echo $resume_info['photo_src'];?>)"></p>
					</div>
					<div class="ij_info">
						<h3><?php echo $resume_info['name_txt'];?> <span><?php echo $resume_info['gender_age_txt'];?></span></h3>
						<div>
							<dl>
								<dt>연락처</dt>
								<dd><?php echo $read_allow ? (!$my_info && ((!$accept_row && !@in_Array('phone', $accept_row['view_arr'])) || !$re_row['is_phone']) ? '비공개' : $get_member['mb_phone']) : '<a href="javascript:void(0)" class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_resume_txt.'</a>';?></dd>
							</dl>
							<dl>
								<dt>이메일</dt>
								<dd><?php echo $read_allow ? (!$my_info && (($accept_row && !@in_Array('email', $accept_row['view_arr'])) || !$re_row['is_email']) ? '비공개' : $get_member['mb_email']) : '<a href="javascript:void(0)" class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_resume_txt.'</a>';?></dd>
							</dl>
							<dl>
								<dt>주소</dt>
								<dd>
									<?php 
									if($read_allow) {
										if(!$my_info && (($accept_row && !@in_Array('address', $accept_row['view_arr'])) || !$re_row['is_address'])) {
											echo '비공개';
										} else {
									?>
											[<?php echo $get_member['mb_zipcode'];?>] <?php echo $get_member['mb_address0'].' '.$get_member['mb_address1'];?>
									<?php
										}
									} else {?>
									<?php echo $accept_row && !in_Array('address', $accept_row['view_arr']) ? '비공개' : '<a href="javascript:void(0)" class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_resume_txt.'</a>';?>
									<?php }?>
								</dd>
							</dl>
							<dl>
								<dt>메신져</dt>
								<dd><?php echo $cate_p_array['job_listed'][0][$re_row['wr_messanger']]['wr_name'].' : '.$re_row['wr_messanger_id'] ;?></dd>
							</dl>
							<dl>
								<dt>연락가능시간</dt>
								<dd><?php echo $resume_info['calltime_txt'];?></dd>
							</dl>
						</div>
					</div>
				</div>

			</div>
			<div class="resume_d2">
				<h2>희망 근무조건</h2>
				<div>
					<dl>
						<dt>근무지</dt>
						<dd>
							<?php
								$area_text_arr = array();
								if(is_array($resume_info['area_text_arr2_txt'])) { foreach($resume_info['area_text_arr2_txt'] as $k=>$v) {
									$area_text_arr[$k] = $v;									
								} }
								echo implode("<br/>", $area_text_arr);
							?>
						</dd>
						<dt>업·직종</dt>
						<dd><?php echo implode("<br/>", $resume_info['job_type_text_arr2_txt']);?>&nbsp;</dd>
						
						<dt>급여</dt>
						<dd><?php echo $resume_info['pay_type'];?> <?php echo number_format(intval($re_row['wr_pay']));?>원</dd>

						<dt>테마</dt>
						<dd><?php echo strtr(strtr($resume_info['wr_work_type'], array(","=>", ")), $cate_array['indi_tema']);?>&nbsp;</dd>
						
					</dl>
				</div>
			</div>
		</div>

		<?php if($member['mb_type']=='company') {?>
		<ul class="btnbox">
			<?php if($read_allow) {?>
			<li class="online_sup"><a href="#none" onClick="nf_util.openWin('.resume_support-')">면접 제의하기</a></li>
			<?php if($env['use_message'] && $read_allow && $get_member['mb_message_view']) {?><li class="email_sup"><a href="#none" onClick="nf_util.openWin('.message-')">쪽지 보내기</a></li><?php }?>
			<?php }?>
			<li class="scrap_btn"><a href="#none" onClick="nf_util.scrap(this, 'resume', '<?php echo $re_row['no'];?>')"><i class="axi <?php echo $is_scrap ? 'axi-star3 scrap' : 'axi-star-o';?>"></i> 인재 스크랩</a></li>
		</ul>
		<?php }?>


		<div class="tab self_intro">
			<h2>자기소개서</h2>
			<div >
				<?php if($read_allow) {?>
				<p><?php echo stripslashes($re_row['wr_introduce']);?></p>
				<?php } else {?>
				<div class="open_pl">
					<p>자기소개서는 <b>열람 신청</b>을 해야 볼 수 있습니다.</p>
					<button type="button" onClick="<?php echo $a_href_not_read;?>">열람신청하기</button>
				</div>
				<?php }?>
			</div>
		</div>

		<div class="banner" style="overflow:hidden;margin-top:20px;">
			<?php
			$banner_arr = $nf_banner->banner_view('resume_G');
			echo $banner_arr['tag'];
			?>
		</div>


		<div class="caution">
			<ul>
				<li>· 본 정보는 취업활동을 위해 등록한 이력서 정보이며 <?php echo $nf_util->get_text($env['site_name']);?>는(은) 기재된 내용에 대한 오류와 사용자가 신뢰하여 취한 조치에 대한 책임을 지지 않습니다.</li>
				<li>· 누구든 본 정보를 <?php echo $nf_util->get_text($env['site_name']);?>의 동의없이 재배포할 수 없으며 본 정보를 출력 및 복사하더라도 구인목적 이외의 용도로 사용할 수 없습니다.</li>
				<li>· 본 정보를 출력 및 복사한 경우의 개인정보보호에 대한 책임은 출력 및 복사한 당사자에게 있으며 정보통신부 고시 제2005-18호 (개인정보의 기술적·관리적 보호조치 기준)에 따라 개인정보가 담긴 이력서 등을 불법유출 및 배포하게 되면 법에 따라 책임지게 됨을 양지하시기 바랍니다. &lt;저작권자 ⓒ 정규직 <?php echo $nf_util->get_text($env['site_name']);?>. 무단전재-재배포 금지&gt;</li>
			</ul>
		</div>

	</section>

</div>



<!--푸터영역-->
<?php
$mno = $member['no'];
$page_code = 'resume';
$info_no = $re_row['no'];
include NFE_PATH.'/include/etc/report.inc.php';
include NFE_PATH.'/include/job/resume_support.inc.php';
include NFE_PATH.'/include/etc/message.inc.php';
include '../include/footer.php';
?>