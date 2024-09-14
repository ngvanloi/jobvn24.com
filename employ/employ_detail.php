<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions', 'job_employ_report_reason');
include_once "../engine/_core.php";
include_once NFE_PATH.'/engine/function/read_insert.function.php';
$service_where = $nf_search->service_where('employ');
$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($_GET['no']));
$employ_info = $nf_job->employ_info($em_row);
$is_service_end = $db->query_fetch("select * from nf_employ where `no`=".intval($em_row['no'])." and (".strtr($service_where['where'], array(" or "=>" and ", ">="=>"<")).")");

if(!$em_row || (!admin_id && $em_row['is_delete'])) {
	die($nf_util->move_url($nf_util->page_back(), "삭제된 구인정보입니다."));
}

// : 본인은 확인 가능해야함
if($em_row['mno']!=$member['no']) {
	if(!$em_row['wr_open'] && !admin_id) {
		die($nf_util->move_url($nf_util->page_back(), "비공개된 구인정보입니다."));
	}

	if($em_row['wr_report']==-1 && !admin_id) {
		die($nf_util->move_url($nf_util->page_back(), "신고된 구인정보입니다."));
	}

	if(($em_row['wr_end_date']!='always' && $em_row['wr_end_date']!='end' && $em_row['wr_end_date']<today) && !admin_id) {
		die($nf_util->move_url($nf_util->page_back(), "모집마감된 구인정보입니다."));
	}

	$service_row = $db->query_fetch("select * from nf_service where `code`=? and `type`=?", array('employ', '1_list'));
	if(!$service_row['is_pay']) $is_service_end = false; // : 일반리스트 무료
	//if(!$env['service_employ_use']) $is_service_end = false; // : 이력서 결제페이지 사용여부 [ 이건 처음만 무료고 기간이 남기 때문에 체크안함 ]
	if($is_service_end && !admin_id) {
		die($nf_util->move_url($nf_util->page_back(), "만료된 구인정보입니다."));
	}
}

$register_form_employ_arr = array();

include '../include/header_meta.php';

$check_adult = $nf_util->check_adult($member['mb_birth']);
if($em_row['wr_is_adult'] && !$check_adult && $member['mb_type']!='company') {
	// : 성인인증 사용시 사용
	include NFE_PATH.'/include/adult.php';
}

$not_read_div_box = ""; $accept_row = array(); // : 앞의 변수는 $nf_job->read() 함수에서 사용합니다.
$read_allow = $nf_job->read($member['no'], $em_row['no'], 'employ');
$mem_company_row = $db->query_fetch("select * from nf_member_company where `no`=".intval($em_row['cno']));
$get_member = $db->query_fetch("select * from nf_member where `no`=".intval($em_row['mno']));
$_site_title_not_description_ = true;
$_site_title_ = $employ_info['wr_subject'];
//$_site_content_ = '경력 : '.$employ_info['career_txt'].', 학력 : '.$nf_job->school[$em_row['wr_ability']].', 급여 : '.$employ_info['pay_txt'].', 마감일 : '.$employ_info['end_date'];
$_site_content_ =  $nf_util->get_text($employ_info['wr_subject'].' '.$employ_info['wr_company_name'].' '.$env['meta_description']);
$_site_keyword_ = '#'.implode(" #", $employ_info['keyword_arr']);
if($employ_info['is_logo_image']) $_site_image_ = $employ_info['logo_image'];
$is_interest = $db->query_fetch("select * from nf_interest where `mno`=? and `exmno`=? and `code`=?", array($member['no'], $em_row['cno'], 'company'));

include '../include/header.php';

$get_member_status = $nf_job->get_member_status($mem_company_row, 'company');

$m_title = '구인 상세정보';
include NFE_PATH.'/include/m_title.inc.php';

if($member['mb_type']=='company') $a_href_not_read = "alert('개인회원만 이용 가능합니다.');";
if($member['mb_type']=='individual') $a_href_not_read = "location.href=root+'/service/product_payment.php?code=read'";
if(!$member['no']) $a_href_not_read = "location.href=root+'/member/login.php?url='+location.href";

?>
<div class="wrap1260 MAT20">
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('employ_G');
		echo $banner_arr['tag'];
		?>
	</div>

	<section class="employ_detail detail_common sub">
		<?php
		$page_code = 'employ';
		$page_code_txt = '구인정보';
		$info_no = $em_row['no'];
		// : $not_read_div_box 변수는 $nf_job->read() 함수에서 사용합니다.
		if($not_read_div_box) include_once NFE_PATH.'/include/job/not_read.box.php';
		?>
		<div class="detail_top">
			<div>
				<ul>
					<li><a href="" class="scrap-star-" no="<?php echo $em_row['no'];?>" code="employ"><i class="axi <?php echo $nf_util->is_scrap($em_row['no'], 'employ') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i> 스크랩</a></li>
					<li><a href="#none" onClick="nf_util.openWin('.report-')"><i class="axi axi-bell"></i> 신고하기</a></li>
				</ul>
				<ul>
					<?php
					include NFE_PATH.'/include/etc/sns.inc.php';
					?>
				</ul>
				
			</div>
		</div>
		<div class="job_detail">
			<div class="job_d1">
				<h3><?php echo $nf_util->get_text($em_row['wr_subject']);?></h3>
				<div class="condition_box">
					<div class="con1">
						<h4>지원조건</h4>
						<dl>
							<dt>연령</dt>
							<dd class="blue"><?php echo $employ_info['age_text'];?>&nbsp;</dd>
							<dt>성별</dt>
							<dd><?php echo $employ_info['gender_text'];?>&nbsp;</dd>
							<?php if(!empty($em_row['wr_work_type'])) { ?>
							<dt>테마</dt>
							<dd><?php echo strtr(strtr($em_row['wr_work_type'], array(","=>", ")), $cate_array['job_tema']);?>&nbsp;</dd>
							<?php } ?>
							<?php if(!empty($em_row['wr_target'])) { ?>
							<dt>보장제도</dt>
							<dd><?php echo strtr(strtr($em_row['wr_target'], array(","=>", ")), $cate_array['job_document']);?>&nbsp;</dd>
							<?php } ?>
						</dl>
					</div>
					<div class="con1">
						<h4>근무조건</h4>
						<dl>							
							<dt>급여</dt>
							<dd><?php if($employ_info['pay_txt_first']) {?><span class="salary sstyle"><?php echo $employ_info['pay_txt_first'];?></span><?php }?> <?php echo $employ_info['pay_txt_price'];?></dd>
							<dt>업·직종</dt>
							<dd><?php echo implode("<br/>", $employ_info['job_type_text_arr2_txt']);?></dd>
							<dt>근무지역</dt>
							<dd>
								<ul class="area_map">
									<?php
									if(is_array($employ_info['area_text_arr2_txt'])) { foreach($employ_info['area_text_arr2_txt'] as $k=>$v) {
										$v_arr = explode(",", $v);
										$v_area_txt = $v_arr[1].' '.$v_arr[2].' '.$v_arr[3].' '.$v_arr[4];
									?>
									<li><?php if($employ_info['wr_lat'.$k]) {?><button class="map"  onClick="void(window.open('<?php echo NFE_URL;?>/employ/map.php?no=<?php echo $em_row['no'];?>&num=<?php echo $k;?>','','width=500,height=500,resizable=no,scrollbars=yes'))">지도보기</button><?php }?><?php echo $v;?></li> 
									<?php
									} }?>
								</ul>
							</dd>
						</dl>
					</div>
				</div>
				<div class="accept">
					<h4>접수방법</h4>
					<p>
						<?php
						$requisition_arr = $nf_job->requisition;
						$requisition_arr[','] = ', ';
						echo strtr($employ_info['wr_requisition'], $requisition_arr);
						?>
					</p>
				</div>
				<div class="manager_box">
					<div class="con2">
						<dl>
							<dt>모집인원</dt>
							<dd><?php echo $em_row['wr_person'];?>명</dd>
							<dt>모집마감일</dt>
							<dd><?php echo $employ_info['end_date'];?></dd>
						</dl>
						<dl>
							<dt>등록일</dt>
							<dd><?php echo date("Y.m.d", strtotime($em_row['wr_wdate']));?></dd>
						</dl>
					</div>
					<div class="con3">
						<dl>
							<dt>담당자</dt>
							<dd><?php echo $read_allow ? $nf_util->get_text($em_row['wr_name']) : '<a href="javascript:void(0)" class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_employ_txt.'</a>';?></dd>
						</dl>
						<?php if(!empty($em_row['wr_nickname'])) { ?>
						<dl>
							<dt>닉네임</dt>
							<dd><?php echo $nf_util->get_text($em_row['wr_nickname']) ?></dd>
						</dl>
						<?php } ?>
						<dl>
							<dt>연락처</dt>
							<dd><?php echo $read_allow ? ($nf_util->in_array('phone', $employ_info['manager_not_view_arr']) ? '비공개' : $nf_util->get_text($em_row['wr_phone'])) : '<a href="javascript:void(0)"  class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_employ_txt.'</a>';?></dd>
						</dl>
						<?php if(!empty($em_row['wr_hphone'])) { ?>
						<dl>
							<dt>휴대폰</dt>
							<dd><?php echo $read_allow ? ($nf_util->in_array('hphone', $employ_info['manager_not_view_arr']) ? '비공개' : $nf_util->get_text($em_row['wr_hphone'])) : '<a href="javascript:void(0)"  class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_employ_txt.'</a>';?></dd>
						</dl>
						<?php } ?>
						<?php if(!empty($em_row['wr_email'])) { ?>
						<dl>
							<dt>이메일</dt>
							<dd><?php echo $read_allow ? ($nf_util->in_array('email', $employ_info['manager_not_view_arr']) ? '비공개' : $nf_util->get_text($em_row['wr_email'])) : '<a href="javascript:void(0)"  class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_employ_txt.'</a>';?></dd>
						</dl>
						<?php } ?>
						<?php if(!empty($em_row['wr_messanger_id'])) { ?>
						<dl>
							<dt>메신져</dt>
							<dd><?php echo $read_allow ? $cate_p_array['job_listed'][0][$em_row['wr_messanger']]['wr_name'].' : '.$em_row['wr_messanger_id']  : '<a href="javascript:void(0)"  class="blue" style="text-decoration:underline !important;" onClick="'.$a_href_not_read.'">'.$nf_job->read_employ_txt.'</a>';?></dd>
						</dl>
						<?php } ?>
						<?php if($env['use_message'] && $read_allow && $get_member['mb_message_view']) { ?>
						<dl>
							<dt>쪽지</dt>
							<dd>
							<?php if($env['use_message'] && $read_allow && $get_member['mb_message_view'] && $member['mb_type']=='individual') { ?>
								<button type="button" onClick="nf_util.openWin('.message-')"><i class="axi axi-mail2"></i>쪽지보내기</button>
							<?php }else{ ?>
								<button type="button" onClick="javascript:alert('개인회원만 쪽지발송이 가능합니다.')"><i class="axi axi-mail2"></i>쪽지보내기</button>
							<?php } ?>
							</dd>
						</dl>
						<?php } ?>
					</div>
					<div class="con4">
						※ <?php echo $env['site_name']; ?> 보고 연락드렸다고 하시면 상담이 편해집니다.
					</div>
				</div>
			</div>
			<div class="job_d2">
				<div class="logo_area">
					<p style="background-image:url(<?php echo $employ_info['logo_image'];?>)" class="<?php echo $employ_info['logo_class'];?>"><?php if(!$employ_info['is_logo_image']) echo $employ_info['logo_text'];?></p>
				</div>
				<div>
					<dl>
						<dt>업소명</dt>
						<dd><?php echo $nf_util->get_text($em_row['wr_company_name']);?></dd>
						<dt>대표자명</dt>
						<dd><?php echo $nf_util->get_text($mem_company_row['mb_ceo_name']);?></dd>

						<?php if(!empty($mem_company_row['mb_biz_no'])) { ?>
							<dt>사업자번호</dt>
							<dd><?php echo $nf_util->make_pass_($mem_company_row['mb_biz_no']);?></dd>
						<?php } ?>

						<dt>업소주소</dt>
						<dd><?php echo $nf_util->get_text($mem_company_row['mb_biz_address0'].' '.$mem_company_row['mb_biz_address1']);?></dd>
					</dl>
					<?php //if($member['mb_type']=='individual') {?>
					<ul class="btnbox">
						<?php if($read_allow && $member['mb_type']=='individual') {?>
							<?php if(in_array('online', $employ_info['requisition_arr'])) {?><li class="online_sup"><a href="#none" onClick="<?php echo $read_allow ? "nf_util.openWin('.employ_support-')" : "alert('면접지원은 열람권 서비스가 있어야 지원이 가능합니다.')";?>">면접지원</a></li><?php }?>
						<?php }else{ ?>
							<?php if(in_array('online', $employ_info['requisition_arr'])) {?><li class="online_sup"><a href="#none" onClick="javascript:alert('개인회원만 면접지원이 가능합니다.')">면접지원</a></li><?php }?>
						<?php }?>
						<?php if($env['use_message'] && $read_allow && $get_member['mb_message_view'] && $member['mb_type']=='individual') { ?>
							<li onClick="nf_util.openWin('.message-')" class="scrap_btn"><a href="#none"><i class="axi axi-mail2"></i> 쪽지보내기</a></li>
						<?php }else{ ?>
							<li onClick="javascript:alert('개인회원만 쪽지발송이 가능합니다.')" class="scrap_btn"><a href="#none"><i class="axi axi-mail2"></i> 쪽지보내기</a></li>
						<?php }?>
					</ul>
					<?php //}?>
				</div>
			</div>
		</div>

		<!--근무환경-->
		<?php
		$ph1 = $mem_company_row['mb_img1'];
		$ph2 = $mem_company_row['mb_img2'];
		$ph3 = $mem_company_row['mb_img3'];
		$ph4 = $mem_company_row['mb_img4'];
		if($ph1 || $ph2 || $ph3 || $ph4) { 
		?>
		<div class="tab">
			<div id="tab2" style="margin-top:-80px;position:absolute;"></div>
			<h2>근무환경</h2>
			<div class="job_tab2">
				<div class="company_img">
					<ul>
						<?php if($ph1) ?> <li style="background-image:url(<?php echo NFE_URL.'/data/member/'.$ph1;?>"></li>
						<?php if($ph2) ?> <li style="background-image:url(<?php echo NFE_URL.'/data/member/'.$ph2;?>"></li>
						<?php if($ph3) ?> <li style="background-image:url(<?php echo NFE_URL.'/data/member/'.$ph3;?>"></li>
						<?php if($ph4) ?> <li style="background-image:url(<?php echo NFE_URL.'/data/member/'.$ph4;?>"></li>
					</ul>
				 </div>
			</div>
		</div>
		<?php } ?>

		
		<div class="tab">
		<?php if(trim($mem_company_row['mb_movie'])) {?>
			<h2 id="tab2" style="margin-top:5rem;">업소홍보 동영상</h2>
			<div class="job_tab2">
				<div class="video">
					<?php echo stripslashes($mem_company_row['mb_movie']);?>
				</div>
			</div>
			<?php }?>
		</div>
		

		<!--상세요강-->
		<div class="tab">
			<div id="tab1" style="margin-top:-80px;position:absolute;"></div>
			<h2>상세요강</h2>
			<div class="job_tab1">
				<?php if($read_allow) {?>
				<p><?php echo stripslashes($em_row['wr_content']);?></p>
				<?php } else {?>
				<div class="open_pl">
					<p>상세요강은 <b>열람 신청</b>을 해야 볼 수 있습니다.</p>
					<button type="button" onClick="<?php echo $a_href_not_read;?>">열람신청하기</button>
				</div>
				<?php }?>
			</div>
		</div>
		<!--//상세요강-->



		


		<?php
		if($register_form_arr['register_form_employ']['테마선택']) {
		?>
		<div class="keyword">
			<ul>
				<?php
				if(is_array($employ_info['keyword_arr'])) { foreach($employ_info['keyword_arr'] as $k=>$v) {
				?>
				<li><a href="<?php echo NFE_URL;?>/main/search.php?top_keyword=<?php echo urlencode($v);?>"><?php echo $v;?></a></li>
				<?php
				} }?>
			</ul>
		</div>
		<?php
		}?>

		<div class="banner" style="overflow:hidden;margin-top:20px;">
			<?php
			$banner_arr = $nf_banner->banner_view('employ_H');
			echo $banner_arr['tag'];
			?>
		</div>

		<div class="caution">
			<ul>
				<li>· 본 정보는 <?php echo $nf_util->get_text($em_row['wr_company_name']);?>에서 <?php echo date("Y/m/d", strtotime($em_row['wr_wdate']));?> 이후로 제공한 자료이며, <?php echo $nf_util->get_text($env['site_name']);?>(은)는 그 내용상의 오류 및 지연, 그 내용을 신뢰하여 취해진 조치에 대하여 책임을 지지 않습니다.- </li>
				<li>· 본 정보는 <?php echo $nf_util->get_text($env['site_name']);?>의 동의없이 재배포할 수 없습니다.&lt;저작권자 ⓒ <?php echo $nf_util->get_text($env['site_name']);?>. 무단전재-재배포 금지&gt;</li>
			</ul>
		</div>
	</section>
</div>


<!--푸터영역-->
<?php
$page_code = 'employ';
$mno = $member['no'];
$info_no = $em_row['no'];
include NFE_PATH.'/include/etc/report.inc.php';
include NFE_PATH.'/include/job/employ_support.inc.php';
include NFE_PATH.'/include/etc/message.inc.php';

include '../include/footer.php';
?>