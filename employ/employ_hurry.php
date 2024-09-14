<?php
$add_cate_arr = array('job_date', 'job_week', 'job_pay', 'subway', 'job_conditions', 'job_welfare', 'job_target', 'job_type');
$_site_title_ = "급구 구인정보";
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '급구 구인정보';
include NFE_PATH.'/include/m_title.inc.php';

if(trim($_GET['search_keyword'])) {
	$nf_search->insert(array('code'=>'employ', 'content'=>trim($_GET['search_keyword'])));
}
$employ_where = $nf_search->employ();

// : 19금 검색
if($_GET['code']=='adult') $employ_where['where'] .= " and (`wr_job_type` like '%,".implode(",%') or `wr_job_type` like '%,", $nf_category->job_part_adult_arr).",%')";
else if($nf_category->job_part_adult_cnt>0) $employ_where['where'] .= " and !(`wr_job_type` like '%,".implode(",%') or `wr_job_type` like '%,", $nf_category->job_part_adult_arr).",%')";
?>

<div class="wrap1260 MAT20">
	<section class="employ_main sub">
		<p class="s_title">급구 구인정보</p>
		<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
		<input type="hidden" name="sort_employ" value="<?php echo $nf_util->get_html($_GET['sort_employ']);?>" />
		<input type="hidden" name="page_row" value="<?php echo $nf_util->get_html($_GET['page_row']);?>" />
		<input type="hidden" name="search_list" value="<?php echo $nf_util->get_html($_GET['search_list']);?>" />
		<input type="hidden" name="code" value="<?php echo $nf_util->get_html($_GET['code']);?>" />
		<?php
		include NFE_PATH.'/include/search_employ.php';
		?>
		</form>
	</section>

	<div class="employ_list_sub">
	<?php
	$arr = array();
	$arr['service_k'] = 'busy';
	$arr['where'] = " and ne.`wr_service_".$arr['service_k']."`>='".today."'".$employ_where['where'];
	$arr['order'] = " order by ne.`wr_jdate` desc";
	if($_GET['page_row']>0) $arr['limit'] = intval($_GET['page_row']);
	$service_arr = $nf_job->service_query('employ', $arr);

	$_arr = array();
	$_arr['tema'] = 'B';
	$_arr['num'] = $service_arr['limit'];
	$_arr['total'] = $service_arr['total'];
	$paging = $nf_util->_paging_($_arr);
	include NFE_PATH.'/employ/list.inc.php';
	?>
	</div>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>

