<?php
include_once "../engine/_core.php";
//$nf_member->check_login('individual');

$_site_title_ = '내 이력서 열람 업소';
include '../include/header_meta.php';
include '../include/header.php';

// : 기본 where
$_where = " and nr.`pmno`=".intval($member['no'])." and mb_type='company'";

$q_ = "nf_not_read as nnr right join nf_read as nr on nnr.`exmno`=nr.`exmno` where nnr.`exmno` is null ".$_where;
$not_read_q_ = "nf_not_read as nnr left join nf_read as nr on nnr.`exmno`=nr.`exmno` where 1 ".$_where;

$q = $q_;
if($_GET['code']=='not_read') {
	$q = $not_read_q_;
}
$order = " order by nr.`no` desc";
$group = " group by nr.`exmno`";
$total = $db->query_fetch("select count(distinct(nr.`exmno`)) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$read_query = $db->_query("select *, nr.`no` as nr_no, nr.`exmno` as nr_exmno, nr.`mno` as nr_mno, nr.rdate as nr_rdate from ".$q.$group.$order." limit ".$paging['start'].", ".$_arr['num']);

// : 개수값
$q_total = !$_GET['code'] ? $total : $db->query_fetch("select count(distinct(nr.`mno`)) as c from ".$q_); // : 내이력서 열람업소수
$not_read_q_total = $_GET['code']=='not_read' ? $total : $db->query_fetch("select count(distinct(nr.`mno`)) as c from ".$not_read_q_); // : 열람제한업소 수
?>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>내 이력서 열람 업소<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['resume_open'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="open tab_style3">
				<p class="s_title">내 이력서 열람 업소</p>
				<ul class="help_text">
					<li>공개된 이력서를 열람한 업소명과 업종을 확인할 수 있습니다.</li>	
					<li>열람업소 중 이력서를 공개하고 싶지 않은 경우, 열람제한 설정을 통해 제한할 수 있습니다.</li>	
				</ul>

				<ul class="tab">
					<li class="<?php echo $_GET['code'] ? '' : 'on';?>"><a href="<?php echo $_SERVER['PHP_SELF'];?>">내 이력서 열람 업소<span>(<?php echo number_format(intval($q_total['c']));?>)</span></a></li>
					<li class="<?php echo $_GET['code']=='not_read' ? 'on' : '';?>"><a href="?code=not_read">열람제한 업소<span>(<?php echo number_format(intval($not_read_q_total['c']));?>)</span></a></li>
				</ul>
				<div class="tabcon"><!--온라인 입사지원-->
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<div class="no_content">
						<p>이력서 열람 업소이 없습니다.</p>
					</div>
					<?php
						break;

						default:
							$em_where = "";
							if($nf_payment->service_kind_arr['employ']['1_list']['is_pay']) $em_where .= " and (".implode(" or ", $nf_job->service_where['employ'])." or wr_service_busy>='".today."')";
							if(!$nf_payment->service_kind_arr['employ']['1_list']['is_pay'] && $env['service_employ_audit_use']) $em_where .= " and (".implode(" or ", $nf_job->service_where['employ'])." or wr_service_busy>='".today."')";
							while($row=$db->afetch($read_query)) {
								$employ_cnt = $db->query_fetch("select count(*) as c from nf_employ as ne where `mno`=? and `cno`=?".$nf_job->employ_where.$em_where, array($row['nr_mno'], $row['exmno']));
								$get_company_ex_row = $db->query_fetch("select * from nf_member_company where `no`=".intval($row['exmno']));
								$row = array_merge($row, $get_company_ex_row);
								$get_company_ex = $nf_member->get_member_ex_info($get_company_ex_row);
								$page_code = "individual";
								$company_cno = $row['exmno'];
								include NFE_PATH.'/include/job/company_list.inc.php';
							}
						break;
					}
					?>
				</div>
				<!--//tabcon-->
			</section>
			<!--페이징-->
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>

<?php
include NFE_PATH.'/include/job/read_not_company.inc.php';
?>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
