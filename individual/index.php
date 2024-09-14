<?php
$add_cate_arr = array('job_type', 'job_date', 'job_week', 'job_time', 'job_pay', 'job_type', 'job_computer', 'job_pay_employ', 'job_obstacle', 'job_veteran', 'job_language', 'job_language_exam');
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '마이페이지 메인';
include '../include/header_meta.php';
include '../include/header.php';

$get_member_status = $nf_job->get_member_status($member, 'individual');

$m_title = '개인서비스홈';
include NFE_PATH.'/include/m_title.inc.php';
?>
<style type="text/css">
.accept-div- { display:none; }
.popup_layer { display:none; }
</style>
<script type="text/javascript">
var reply_message = function(el, code, no) {
	var form = document.forms['fmessage'];
	$.post(root+"/include/regist.php", "mode=get_message_info&code="+code+"&no="+no, function(data){
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.move;
		if(data.js) eval(data.js);
	});
}
</script>
<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_member.class.js"></script>
<div class="my_bgwrap">
	<div class="wrap1260">
		<section class="indi_main my_common sub">
			<div class="my_infobox">
				<div class="top">
					<div class="img parent_photo_upload-">
						<p class="put_img-" style="background-image:url(<?php echo $member['photo_src'];?>)"><button type="button" onClick="$('.popup_layer.ijimg').css({'display':'block'})"><i class="axi axi-photo-camera"></i></button></p>
					</div>
					<div class="text">
						<h3><?php echo $nf_util->get_text($member['mb_name']);?> <span>(<?php echo $nf_util->get_text($member['mb_id']);?>)</span></h3>
						<div class="in_btn">
							<button type="button"><a href="<?php echo NFE_URL;?>/member/update_form.php">개인정보수정</a></button>
							<?php if($env['use_message']) {?>
							<dl>
								<dt>새로운 쪽지 <span><a href="<?php echo NFE_URL;?>/member/mail.php"><?php echo number_format(intval($get_member_status['message']));?></a></span>개</dt>
								<dd><a href="<?php echo NFE_URL;?>/member/mail.php">쪽지 관리</a></dd>
							</dl>
							<?php }?>
						</div>
					</div>
				</div>
				<div class="bottom">
					<dl>
						<dt>나이</dt>
						<dd><?php echo $nf_util->get_age($member['mb_birth']);?>세</dd>
					</dl>
					<dl>
						<dt>이메일</dt>
						<dd><?php echo $nf_util->get_text($member['mb_email']);?></dd>
					</dl>
					<dl>
						<dt>연락처</dt>
						<dd><?php echo $nf_util->get_text((strtr($member['mb_phone'],array('-'=>'')) ? $member['mb_phone'] : $member['mb_hphone']));?></dd>
					</dl>
					<dl>
						<dt><?php if($env['member_point_arr']['use_point']) {?>포인트<?php }?></dt>
						<dd><?php if($env['member_point_arr']['use_point']) {?><a href="<?php echo NFE_URL;?>/member/point_list.php"><?php echo number_format(intval($member['mb_point']));?> <span class="orange">ⓟ</span></a><?php }?></dd>
					</dl>
					<dl>
						<dt>주소</dt>
						<dd>[<?php echo $member['mb_zipcode'];?>] <?php echo $member['mb_address0'].' '.$member['mb_address1'];?></dd>
					</dl>
					<!-- <dl>
						<dt>홈페이지</dt>
						<dd><a href="<?php //echo $nf_util->get_domain($member['mb_homepage']);?>" target="_blank"><?php //echo $nf_util->get_domain($member['mb_homepage']);?></a></dd>
					</dl> -->
				</div>
			</div>
			<div class="my_situbox">
				<ul>
					<li>
						<a href="<?php echo NFE_URL;?>/individual/resume_onlines.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['accept']));?></dt>
								<dd>지원현황</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/individual/scrap.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['scrap']));?></dt>
								<dd>스크랩구인</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/individual/resume_open.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['resume_open']));?></dt>
								<dd>이력서 열람업소</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/individual/favorite_company.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['favorite']));?></dt>
								<dd>관심업소</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/individual/resume_open.php?code=not_read">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['resume_not_open']));?></dt>
								<dd>이력서 열람제한</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/individual/customized.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['customized']));?></dt>
								<dd>맞춤 구인정보</dd>
							</dl>
						</a>
					</li>
				</ul>
				<div class="service">
					<p><em>일자리를 빠르고 쉽게 지원하려면 이력서를 작성하고 공고에 지원해보세요</em><button type="button" onClick="location.href='<?php echo NFE_URL;?>/individual/resume_regist.php';">이력서 작성하기</button></p>
					<p><em><span>이력서 강조 서비스</span>를 이용해 구인자의 눈길을 끌어보세요</em><button type="button" onClick="location.href='<?php echo NFE_URL;?>/service/index.php?code=resume';">서비스 알아보기</button></p>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="my_common">
	<div class="wrap1260">
		<div class="my_sub">
			<!--개인서비스 왼쪽 메뉴-->
			<?php
			include '../include/indi_leftmenu.php';
			?>
		</div>	
		<div class="my_sub">
			<section class="current2 tab_style2 sub">
				<h2>지원현황</h2> <!--최대3개출력-->
				<?php
				$_where = "";
				$resume_onlines_q = "nf_accept as na where na.`code`='employ' and `del`=0 and na.`mno`=".intval($member['no'])." ".$_where;
				$resume_onlines_total = $db->query_fetch("select count(*) as c from ".$resume_onlines_q);

				$_where = "";
				$resume_interview_q = "nf_accept as na where na.`code`='resume' and `del`=0 and `pdel`=0 and na.`pmno`=".intval($member['no'])." ".$_where;
				$resume_interview_total = $db->query_fetch("select count(*) as c from ".$resume_interview_q);
				?>
				<ul class="tab">
					<li class="on click-accept-tab-"><a href="#none">면접지원 <span>(<?php echo number_format(intval($resume_onlines_total['c']));?>)</span></a></li>
					<li class="click-accept-tab-"><a href="#none">면접제의 업소 <span>(<?php echo number_format(intval($resume_interview_total['c']));?>)</span></a></li>
				</ul>
				<?php
				$order = " order by na.`no` desc";
				$accept_query = $db->_query("select * from ".$resume_onlines_q.$order." limit 0, 3");
				?>
				<div class="tabcon accept-div- click-accept-tab-child-" style="display:block;"><!--온라인 입사지원-->
					<?php
					switch($resume_onlines_total['c']<=0) {
						case true:
					?>
					<div class="no_content">
						<p>면접지원 정보가 없습니다.</p>
					</div>
					<?php
						break;


						default:
							while($row=$db->afetch($accept_query)) {
								$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['pno']));
								$employ_info = $nf_job->employ_info($em_row);
								$re_row = $db->query_fetch("select * from nf_resume where `no`=".intval($row['sel_no']));
								$get_member = $db->query_fetch("select * from nf_member where `no`=".intval($em_row['mno']));

								$read_allow = $nf_job->read_allow($member['no'], $row['pno'], 'employ');

								$page_code = 'resume_onlines';
								$del_mode = 'mno';
								$not_checkbox = true;
								include NFE_PATH.'/include/job/employ_list.etc2.php';
							}
						break;
					}
					?>
					<a href="<?php echo NFE_URL;?>/individual/resume_onlines.php"><button type="button" class="more">더보기 <i class="axi axi-plus"></i></button></a>
				</div>

				<?php
				$order = " order by na.`no` desc";
				$accept_query = $db->_query("select * from ".$resume_interview_q.$order." limit 0, 3");
				?>
				<div class="tabcon accept-div- click-accept-tab-child-"><!--면접제의 입사지원-->
					<?php
					switch($resume_interview_total['c']<=0) {
						case true:
					?>
					<div class="no_content">
						<p>면접제의 정보가 없습니다.</p>
					</div>
					<?php
						break;


						default:
							while($row=$db->afetch($accept_query)) {
								$re_row = $db->query_fetch("select * from nf_resume where `no`=".intval($row['pno']));
								$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['sel_no']));
								$get_member = $db->query_fetch("select * from nf_member where `no`=".intval($em_row['mno']));
								$employ_info = $nf_job->employ_info($em_row);

								$read_allow = $nf_job->read_allow($member['no'], $row['sel_no'], 'employ');

								$page_code = 'resume_interview';
								$del_mode = 'pmno';
								include NFE_PATH.'/include/job/employ_list.etc2.php';
								include NFE_PATH.'/include/job/resume_accept.info.php';
							}
						break;
					}
					?>
					<a href="<?php echo NFE_URL;?>/individual/resume_interview.php"><button type="button" class="more">더보기 <i class="axi axi-plus"></i></button></a>
				</div>
				<!--//tabcon-->
			</section>
			<script type="text/javascript">
			nf_util.click_tab('.click-accept-tab-');
			</script>

			<section class="rescurrent tab_style1 sub">
				<h2>이력서 관리</h2>
				<?php
				$q = "nf_resume as ne where `mno`=".intval($member['no'])." and is_delete=0 ".$_where;
				$order = " order by ne.`no` desc";
				$total = $db->query_fetch("select count(*) as c from ".$q);

				$_arr = array();
				$_arr['num'] = 3;
				if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
				$_arr['total'] = $total['c'];
				$paging = $nf_util->_paging_($_arr);

				$resume_query = $db->_query("select * from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
				include NFE_PATH.'/include/job/resume_list.my.php';
				?>
			</section>


			<section class="customij jobtable sub">
				<div class="side_con">
					<p class="s_title">맞춤 구인정보<span>나만을 위한 맞춤 구인정보를 설정하여 확인할수 있습니다.</span></p>
					<a href="<?php echo NFE_URL;?>/individual/customized.php"><button type="button">나의 맞춤 정보설정</button></a>
				</div>
				<table>
					<colgroup>
						<col width="18%">
						<col width="45%">
						<col width="13%">
						<col width="12%">
						<col width="12%">
					</colgroup>	
					<tr>
						<th>업소명</th>
						<th>구인 정보</th>
						<th>급여</th>
						<th>닉네임</th>
						<th>모집마감일</th>
					</tr>
				</table>
				<?php
				$get_customized = $nf_job->get_customized($member['mb_id']);
				$_SERVER['customized_get'] = $get_customized['customized'];

				$where_arr = $nf_search->employ();
				unset($_SERVER['customized_get']);
				$service_where = $nf_search->service_where('employ');
				$_where = $where_arr['where'];
				if($_where) {
					$q = "nf_employ as ne where 1 ".$_where;
					if($_GET['code']=='end') $q .= " and (".$service_where['where'].")".$nf_job->not_end_date_where;
					else $q .= $nf_job->employ_where;
					$order = " order by ne.`no` desc";
					$total = $db->query_fetch("select count(*) as c from ".$q);

					$employ_query = $db->_query("select * from ".$q.$order." limit 0, 5");
				}
				?>
				<?php
				switch($total['c']<=0 || !$_where) {
					case true:
				?>
				<div class="no_content">
					<p><?php echo $_where ? '맞춤 구인정보가 없습니다.' : '맞춤설정해주시기 바랍니다.';?></p>
				</div>
				<?php
					break;

					default:
						while($row=$db->afetch($employ_query)) {
							$employ_info = $nf_job->employ_info($row);

							$not_check = true;
							include NFE_PATH.'/include/job/employ_list.etc.php';
						}
					break;
				}
				?>
			</section>
		</div>
	</div>
</div>


<!--푸터영역-->
<?php
include NFE_PATH.'/include/etc/photo.individual.inc.php';
$_GET['code'] = 'send';
$page_code = 'accept';
include NFE_PATH.'/include/etc/message.inc.php';
include '../include/footer.php';
?>
