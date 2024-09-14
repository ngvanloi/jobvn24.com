<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '면접지원인재';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '면접지원인재';
include NFE_PATH.'/include/m_title.inc.php';

$_where = " and na.`code`='employ' and na.`del`=0 and na.`pdel`=0 and na.`pmno`=".intval($member['no']);
if($_GET['eno']) $_where .= " and `pno`=".intval($_GET['eno']);
if($_GET['sel_no']) $_where .= "";
$q = "nf_accept as na where 1 ".$_where;
$order = " order by na.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$accept_query = $db->_query("select *, na.`no` as na_no from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
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

var ch_resume = function(el) {
	var form = document.forms['fsearch'];
	form.eno.value = el.value;
	form.submit();
}
</script>

<form name="fsearch" style="display:none">
<input type="hidden" name="eno" value="" />
</form>

<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['apply_list'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="ijcurrent tab_style2">
				<p class="s_title">면접지원인재</p>
				<ul class="help_text">					
					<li>지원자가 지원 취소하거나 이력서를 삭제할 경우 리스트에는 노출되나 이력서 내용은 확인하실 수 없습니다.</li>					
				</ul>
				<form name="flist" method="">
				<div class="button_area MAT10">
					<?php if($_arr['total']>0) {?>
					<ul class="fl">
						<li><button type="button" onClick="nf_util.all_check('#check_all', '.chk_')" class="white">전체선택</button><input type="checkbox" id="check_all" style="display:none" /></li>
						<li><button type="button" onClick="nf_util.ajax_select_confirm(this, 'flist', '삭제하시겠습니까?')" url="../include/regist.php" mode="delete_select_accept_pmno" tag="chk[]" check_code="checkbox" class="white">선택삭제</button></li>
					</ul>
					<?php }?>
					<ul class="fr">
						<li>
							<?php
							$accept_employ = $db->_query("select *, na.`no` as na_no from ".$q." group by `pno`");
							?>
							<select onChange="ch_resume(this)">
								<option value="">구인공고 입사지원 인재 전체</option>
								<?php
								while($row=$db->afetch($accept_employ)) {
									$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['pno']));
									$selected = $_GET['eno']==$row['pno'] ? 'selected' : '';
								?>
								<option value="<?php echo intval($row['pno']);?>" <?php echo $selected;?>><?php echo $nf_util->get_text($em_row['wr_subject']);?></option>
								<?php
								}?>
							</select>
						</li>
					</ul>
				</div>
				<div class="tabcon">
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<div class="no_content">
						<p>입사지원 인재정보가 없습니다.</p>
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
$_GET['code'] = 'received';
$page_code = 'accept';
include NFE_PATH.'/include/etc/message.inc.php';
include '../include/footer.php';
?>
