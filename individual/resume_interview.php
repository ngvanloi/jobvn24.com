<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
include_once "../engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '면접제의 업소';
include '../include/header_meta.php';
include '../include/header.php';

$_where = "";
$q = "nf_accept as na where na.`code`='resume' and `del`=0 and `pdel`=0 and na.`pmno`=".intval($member['no'])." ".$_where;
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
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>면접제의 업소<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['resume_interview_input'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="current2 tab_style2">
				<p class="s_title">면접제의 업소</p>
				<ul class="help_text">
					<li>이력서가 공개중인 경우에 업소으로부터 받은 면접제의를 받을 수 있습니다.</li>	
				</ul>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="button_area">
					<?php if($_arr['total']>0) {?>
					<ul class="fl">
						<li><button type="button" onClick="nf_util.all_check('#check_all', '.chk_')" class="white">전체선택</button><input type="checkbox" id="check_all" style="display:none" /></li>
						<li><button type="button" onClick="nf_util.ajax_select_confirm(this, 'flist', '삭제하시겠습니까?')" url="../include/regist.php" mode="delete_select_accept_pmno" tag="chk[]" check_code="checkbox" class="white">선택삭제</button></li>
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
				<div class="tabcon"><!--온라인 입사지원-->
					<?php
					switch($_arr['total']<=0) {
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
							}
						break;
					}
					?>
					<!--//면접제의받은 공고일때-->
					
				</div>
				<!--//tabcon-->
			</section>
			<!--페이징-->
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php
$_GET['code'] = 'received';
$page_code = 'accept';
include NFE_PATH.'/include/etc/message.inc.php';
include NFE_PATH.'/include/job/resume_accept.info.php';
include '../include/footer.php';
?>
