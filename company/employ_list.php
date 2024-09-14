<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '구인공고 현황';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '구인공고 현황';
include NFE_PATH.'/include/m_title.inc.php';

$member_status = $nf_job->get_member_status($member, 'company_member');
$nf_util->sess_page_save("mypage_employ_list");

$where_arr = $nf_search->employ();
$service_where = $nf_search->service_where('employ');
$_where = $where_arr['where'];

$basic_where = "";
if($nf_payment->service_kind_arr['employ']['0_list']['is_pay']) $basic_where = "(".implode(" or ", $nf_job->service_where['employ'])." or wr_service_busy>='".today."')";
if(!$nf_payment->service_kind_arr['employ']['0_list']['is_pay'] && $env['service_employ_audit_use']) $basic_where = "(".implode(" or ", $nf_job->service_where['employ'])." or wr_service_busy>='".today."')";
if(!$basic_where) $basic_where = " 1 ";

$where_basic = $basic_where.$nf_job->end_date_where;
$q = "nf_employ as ne where `mno`=".intval($member['no'])." and `is_delete`=0 ".$_where;
if($_GET['code']=='end') $q .= " and !(".$where_basic.")";
else $q .= " and ".$where_basic;

$order = " order by ne.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$_arr['tema'] = 'B';
$paging = $nf_util->_paging_($_arr);

$employ_query = $db->_query("select * from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
?>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		if($_GET['code']=='end') $left_on['employ_list_end'] = 'on';
		else $left_on['employ_list'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="current2 tab_style1">
				<p class="s_title">구인공고 현황</p>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<input type="hidden" name="code" value="<?php echo $nf_util->get_html($_GET['code']);?>" />
				<input type="hidden" name="page_row" value="<?php echo $nf_util->get_html($_GET['page_row']);?>" />
				<div class="sub_serach">
					<div>
						<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
							<select name="search_field">
								<option value="">선택</option>
								<option value="wr_subject" <?php echo $_GET['search_field']=='wr_subject' ? 'selected' : '';?>>구인공고 제목</option>
								<option value="wr_content" <?php echo $_GET['search_field']=='wr_content' ? 'selected' : '';?>>구인공고 내용</option>
								<option value="wr_company_name" <?php echo $_GET['search_field']=='wr_company_name' ? 'selected' : '';?>>업소명</option>
								<option value="wr_name" <?php echo $_GET['search_field']=='wr_name' ? 'selected' : '';?>>담당자명</option>
							</select>
							
							<div class="search_style">
								<label>
									<input type="text" name="search_keyword" value="<?php echo $nf_util->get_html($_GET['search_keyword']);?>">
									<button type="submint"><i class="axi axi-search3"></i></button>
								</label>
							</div>
						</form>
					</div>
				</div>
				</form>
				<ul class="tab">
					<li class="<?php echo $_GET['code'] ? '' : 'on';?>"><a href="<?php echo NFE_URL;?>/company/employ_list.php">진행중인 구인공고 <span>(<?php echo number_format(intval($member_status['employ_ing']));?>)</span></a></li>
					<li class="<?php echo $_GET['code']=='end' ? 'on' : '';?>"><a href="<?php echo NFE_URL;?>/company/employ_list.php?code=end">마감된 구인공고 <span>(<?php echo number_format(intval($member_status['employ_end']));?>)</span></a></li>
				</ul>
				<?php
				include NFE_PATH.'/include/job/employ_list.my.php';
				?>
				
			</section>
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>
