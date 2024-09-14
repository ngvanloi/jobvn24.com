<?php
$add_cate_arr = array('email', 'subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '마이페이지 메인';
include '../include/header_meta.php';
include '../include/header.php';

$get_member_status = $nf_job->get_member_status($member, 'company_member');

$m_title = '업소서비스';
include NFE_PATH.'/include/m_title.inc.php';
?>
<style type="text/css">
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
		<section class="company_main my_common sub">
			<div class="my_infobox">
				<div class="top">
					<div class="img parent_photo_upload-">
						<p class="put_img-" <?php if($member_ex['mb_logo_src']) {?>style="background-image:url(<?php echo $member_ex['mb_logo_src'];?>);"<?php }?>><button type="button" onClick="$('.popup_layer.ijimg').css({'display':'block'})"><i class="axi axi-photo-camera"></i></button></p>
					</div>
					<div class="text">
						<h3><?php echo $member_ex['mb_company_name'];?> <span>(<?php echo $member['mb_id'];?>)</span></h3>
						<div class="in_btn">
							<button type="button"><a href="<?php echo NFE_URL;?>/member/update_form.php">업소정보수정</a></button>
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
						<dt>대표자명</dt>
						<dd><?php echo $nf_util->get_text($member_ex['mb_ceo_name']);?></dd>
					</dl>
					<dl>
						<dt>담당자명</dt>
						<dd><?php echo $nf_util->get_text($member['mb_name']);?></dd>
					</dl>
					<dl>
						<dt>닉네임</dt>
						<dd><?php echo $nf_util->get_text($member['mb_nick']);?></dd>
					</dl>
					<dl>
						<dt><?php if($env['member_point_arr']['use_point']) {?>포인트<?php }?></dt>
						<dd><?php if($env['member_point_arr']['use_point']) {?><a href="<?php echo NFE_URL;?>/member/point_list.php"><?php echo number_format(intval($member['mb_point']));?> <span class="orange">ⓟ</span></a><?php }?></dd>
					</dl>
					<dl>
						<dt>사업자번호</dt>
						<dd><?php echo $nf_util->get_text($member_ex['mb_biz_no']);?></dd>
					</dl>
					<dl>
						<dt>업소주소</dt>
						<dd><?php echo $nf_util->get_text($member_ex['mb_biz_address0'].' '.$member_ex['mb_biz_address1']);?></dd>
					</dl>
				</div>
			</div>
			<div class="my_situbox">
				<ul>
					<li>
						<a href="<?php echo NFE_URL;?>/company/employ_list.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['employ_ing']));?></dt>
								<dd>진행중인 공고</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/company/employ_list.php?code=end">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['employ_end']));?></dt>
								<dd>마감된 공고</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/company/apply_list.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['accept']));?></dt>
								<dd>지원한 인재</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/company/scrap.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['scrap']));?></dt>
								<dd>스크랩한 인재</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/company/interview.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['accept2']));?></dt>
								<dd>면접제의</dd>
							</dl>
						</a>
					</li>
					<li>
						<a href="<?php echo NFE_URL;?>/company/customized.php">
							<dl>
								<dt><?php echo number_format(intval($get_member_status['customized']));?></dt>
								<dd>맞춤 인재정보</dd>
							</dl>
						</a>
					</li>
				</ul>
				<div class="service">
					<p><em>많은 인재들이 당신의 업소에 지원 할 수 있게 구인공고를 작성해보세요</em> <button type="button" onClick="location.href='<?php echo NFE_URL;?>/company/employ_regist.php';">구인공고 작성하기</button></p>
					<p><em><span>구인공고 강조 서비스</span>를 이용해 구직자의 눈길을 끌어보세요</em><button type="button" onClick="location.href='<?php echo NFE_URL;?>/service/index.php';">서비스 알아보기</button></a></p>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="my_common">
	<div class="wrap1260 ">
		<div class="my_sub">
			<!--업소서비스 왼쪽 메뉴-->
			<?php
			include '../include/company_leftmenu.php';
			?>
		</div>	
		<div class="my_sub">
			<section class="current tab_style1 sub">
				<h2>구인공고현황</h2>
				<?php
				$where_arr = $nf_search->employ();
				$service_where = $nf_search->service_where('employ');
				$_where = $where_arr['where'].$_em_where;
				$q = "nf_employ as ne where `mno`=".intval($member['no'])." and `is_delete`=0 ".$_where;
				$q .= $nf_job->employ_where;

				$order = " order by ne.`no` desc";
				$total = $db->query_fetch("select count(*) as c from ".$q);

				$_arr = array();
				$_arr['num'] = 3;
				if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
				$_arr['total'] = $total['c'];

				$employ_query = $db->_query("select * from ".$q.$order." limit 0, ".$_arr['num']);

				include NFE_PATH.'/include/job/employ_list.my.php';
				?>
			</section>

			<section class="ijcurrent tab_style2 sub">
				<h2>지원 인재 현황</h2>
				<?php
				$_where = " and na.`code`='employ' and na.`del`=0 and na.`pdel`=0 and na.`pmno`=".intval($member['no']);
				$q = "nf_accept as na where 1 ".$_where;
				$order = " order by na.`no` desc";
				$total = $db->query_fetch("select count(*) as c from ".$q);

				$_arr = array();
				$_arr['num'] = 3;
				$_arr['tema'] = 'B';
				if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
				$_arr['total'] = $total['c'];
				$paging = $nf_util->_paging_($_arr);

				$accept_query = $db->_query("select *, na.`no` as na_no from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
				?>
				<div class="tabcon">
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<div class="no_content">
						<p>면접지원 인재정보가 없습니다.</p>
					</div>
					<?php
						break;


						default:
							while($row=$db->afetch($accept_query)) {
								$re_row = $db->query_fetch("select * from nf_resume where `no`=".intval($row['sel_no']));
								$re_row['_is_read_'] = true;
								$resume_info = $nf_job->resume_info($re_row);
								$resume_individual = $nf_job->resume_individual($re_row['mno']);
								$nf_member->get_member($re_row['mno']);
								$get_member = $nf_member->member_arr[$re_row['mno']];
								$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['pno']));

								$is_attach = false;
								if(is_file(NFE_PATH.'/data/accept/'.$row['attach'])) $is_attach = true;

								$read_allow = $nf_job->read_allow($member['no'], $row['sel_no'], 'resume');

								$not_checkbox = true;
								$check_no = $row['no'];
								$view_arr = explode(",", $row['view']);
								$not_phone = in_array('phone', $view_arr) ? false : true;
								$not_email = in_array('email', $view_arr) ? false : true;
								$not_homepage = in_array('homepage', $view_arr) ? false : true;
								$not_address = in_array('address', $view_arr) ? false : true;
								include NFE_PATH.'/include/job/resume_list.etc2.php';
							}
						break;
					}
					?>
					<a href="<?php echo NFE_URL;?>/company/apply_list.php"><button type="button" class="more">더보기 <i class="axi axi-plus"></i></button></a>
				</div>
				<!--//tabcon-->
			</section>

			<section class="customij jobtable sub">
				<div class="side_con">
					<p class="s_title">맞춤 인재정보<span>업소을 위한 맞춤 인재정보를 설정하여 확인할수 있습니다.</span></p>
					<a href="<?php echo NFE_URL;?>/company/customized.php"><button type="button">나의 맞춤 정보설정</button></a>
				</div>
				<?php
				$get_customized = $nf_job->get_customized($member['mb_id']);
				$_SERVER['customized_get'] = array_merge($get_customized['customized'], $_GET);

				$where_arr = $nf_search->resume();
				$service_where = $nf_search->service_where('resume');
				$_where = $where_arr['where'];
				if($_where) {
					$q = "nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno` where 1 ".$_where.$nf_job->resume_where;
					$order = " order by nr.`no` desc";
					$total = $db->query_fetch("select count(*) as c from ".$q);

					$_arr = array();
					$_arr['num'] = 3;
					if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
					$_arr['total'] = $total['c'];
					$_arr['tema'] = 'B';
					$paging = $nf_util->_paging_($_arr);

					$resume_query = $db->_query("select *, nr.`no` as nr_no from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
				}
				?>
				<table>
					<colgroup>
						<col width="18%">
						<col width="45%">
						<col width="13%">
						<col width="12%">
						<col width="12%">
					</colgroup>	
					<tr>
						<th>이름</th>
						<th>이력서 정보</th>
						<th>희망급여</th>
						<th>희망지역</th>
						<th>등록일</th>
					</tr>
				</table>
				<?php
				switch($_arr['total']<=0 || !$_where) {
					case true:
				?>
				<div class="no_content">
					<p><?php echo $_where ? '맞춤 인재정보가 없습니다.' : '맞춤설정해주시기 바랍니다.';?></p>
				</div>
				<?php
					break;

					default:
						while($row=$db->afetch($resume_query)) {
							$re_info = $nf_job->resume_info($row);
							$not_check = true;
							include NFE_PATH.'/include/job/resume_list.etc.php';
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
include NFE_PATH.'/include/etc/photo.inc.php';
$_GET['code'] = 'received';
$page_code = 'accept';
include NFE_PATH.'/include/etc/message.inc.php';
include '../include/footer.php';
?>
