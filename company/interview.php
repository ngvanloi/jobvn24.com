<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
include_once "../engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '면접 제의 인재';
include '../include/header_meta.php';
include '../include/header.php';

$_where = "";
$q = "nf_accept as na where na.`code`='resume' and na.`del`=0 and na.`mno`=".intval($member['no'])." ".$_where;
$order = " order by na.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$accept_query = $db->_query("select * from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
?>
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
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>면접 제의 인재<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['interview'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="current2 tab_style2">
				<p class="s_title">면접 제의 인재</p>
				<ul class="help_text">
					<li>인재정보를 통해 수집된 개인정보 및 이력서는 개인정보보호정책에 의거 인재구인의 목적으로만 이용하셔야 합니다.</li>
					<li>인재의 연락처를 열람하시려면 이력서 열람서비스를 이용하셔야 하며, 이력서의 상세정보는 열람서비스 이용기간에만 확인가능합니다.</li>	
				</ul>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="button_area">
					<?php if($_arr['total']>0) {?>
					<ul class="fl">
						<li><button type="button" onClick="nf_util.all_check('#check_all', '.chk_')" class="white">전체선택</button><input type="checkbox" id="check_all" style="display:none" /></li>
						<li><button type="button" onClick="nf_util.ajax_select_confirm(this, 'flist', '면접제의를 취소하시겠습니까?')" url="../include/regist.php" mode="delete_select_accept_mno" tag="chk[]" check_code="checkbox" class="white">면접제의 선택취소</button></li>
					</ul>
					<?php }?>
					<ul class="fr">
						<li>
							<select name="page_row" onChange="nf_util.ch_page_row(this, 'fsearch1')">
								<option value="15" <?php echo $_arr['num']=='15' ? 'selected' : '';?>>15개씩 보기</option>
								<option value="20" <?php echo $_arr['num']=='20' ? 'selected' : '';?>>20개씩 보기</option>
								<option value="30" <?php echo $_arr['num']=='30' ? 'selected' : '';?>>30개씩 보기</option>
								<option value="50" <?php echo $_arr['num']=='50' ? 'selected' : '';?>>50개씩 보기</option>
							</select>
						</li>
					</ul>
				</div>
				</form>

				<form name="flist" method="">
				<div class="tabcon"><!--온라인 입사지원-->
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<div class="no_content">
						<p>면접제의한 인재 정보가 없습니다.</p>
					</div>
					<?php
						break;


						default:
							while($row=$db->afetch($accept_query)) {
								$re_row = $db->query_fetch("select * from nf_resume where `no`=".intval($row['pno']));
								$resume_info = $nf_job->resume_info($re_row);
								$resume_individual = $nf_job->resume_individual($re_row['mno']);
								$nf_member->get_member($re_row['mno']);
								$get_member = $nf_member->member_arr[$re_row['mno']];
								$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['sel_no']));
								$employ_info = $nf_job->employ_info($em_row);

								$read_allow = $nf_job->read_allow($member['no'], $row['pno'], 'resume');

								$del_mode = 'mno';
								$not_homepage = $re_row['is_homepage'] ? true : false;
								$not_phone = $re_row['is_phone'] ? true : false;
								$not_address = $re_row['is_address'] ? true : false;
								$not_email = $re_row['is_email'] ? true : false;
					?>
					<div><!--반복-->
						<div class="img_box">
							<?php if(!$not_checkbox) {?><input type="checkbox" name="chk[]" class="chk_" value="<?php echo $row['no'];?>"><?php }?>
							<p class="injae" style="background-image:url(<?php echo $get_member['photo_src'];?>)"></p>
						</div>
						<div class="info_box">
							<a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>" target="_blank">
								<h2><?php echo $re_row['wr_subject'];?></h2>
								<dl>

									<dt>급여</dt>
									<dd><?php echo $resume_info['pay_type'];?> <?php echo number_format(intval($re_row['wr_pay']));?>원&nbsp;</dd>
									<dt>근무지</dt>
									<dd><?php echo implode("<br> ", $resume_info['area_text_arr2_txt']);?></dd>
									<dt>업직종</dt>
									<dd><?php echo implode("<br> ", $resume_info['job_type_text_arr2_txt']);?></dd>
								</dl>
								<dl>
									<dt>휴대폰</dt>
									<dd><?php echo $not_phone ? '비공개' : $get_member['mb_hphone'];?>&nbsp;</dd>
									<dt>이메일</dt>
									<dd><?php echo $not_email ? '비공개' : $get_member['mb_email'];?>&nbsp;</dd>
									<dt>메신져</dt>
									<dd><?php echo $cate_p_array['job_listed'][0][$resume_info['wr_messanger']]['wr_name'].' : '.$resume_info['wr_messanger_id'] ;?>&nbsp;</dd>
									<dt>주소</dt>
									<dd><?php if($not_address) {?>비공개<?php } else {?>[<?php echo $get_member['mb_zipcode'];?>] <?php echo $get_member['mb_address1'].' '.$get_member['mb_address1'];?><?php }?></dd>

								</dl>
							</a>
						</div>
						<table>
							<colgroup>
								<col width="50%">	
								<col width="50%">	
							</colgroup>
							<tr>
								<td>
									<ul>
										<li><h3><?php echo $resume_info['name_txt'].$resume_info['gender_age_txt'];?></h3></li>
									</ul>
								</td>
								<td>
									<ul class="btn">
										<li><a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>" target="_blank"><button type="button">이력서보기</button></a></li>
										<li><button type="button" onClick="accept_view('<?php echo $row['no'];?>', 'employ')">면접제의 메세지</button></li>
									</ul>
								</td>
							</tr>
						</table>
						<div class="assi_line">
							<ul>
								<li>제의요청일 : <?php echo date("Y.m.d", strtotime($row['sdate']));?></a></li>
							</ul>
							<ul>
								<?php if($env['use_message'] && $read_allow['allow'] && $get_member['mb_message_view']) {?><li><a href="#none" onClick="reply_message(this, 'accept_my', '<?php echo $row['no'];?>')">쪽지</a></li><?php }?>
								<li><a href="#none" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $row['no'];?>" mode="delete_accept_<?php echo $del_mode;?>" url="<?php echo NFE_URL;?>/include/regist.php">면접제의 취소</a></li>
							</ul>
						</div>
					</div>
					<?php
							}
						break;
					}
					?>
					<!--//면접제의받은 공고일때-->
					
				</div>
				</form>
				<!--//tabcon-->
			</section>
			<!--페이징-->
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php
$_GET['code'] = 'send';
$page_code = 'accept';
include NFE_PATH.'/include/job/resume_accept.info.php';
include NFE_PATH.'/include/etc/message.inc.php';
include '../include/footer.php';
?>
