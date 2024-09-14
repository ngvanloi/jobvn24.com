<?php
$add_cate_arr = array('job_date', 'job_week', 'job_time', 'job_type');
$_site_title_ = "급구 인재정보";

include '../include/header_meta.php';
include '../include/header.php';

if(trim($_GET['search_keyword'])) {
	$nf_search->insert(array('code'=>'resume', 'content'=>trim($_GET['search_keyword'])));
}
$resume_where = $nf_search->resume();
?>
<script type="text/javascript">
<?php
if($_GET['search_list']) {
?>
$(function(){
	var loc = $("#<?php echo $_GET['search_list'];?>")[0].offsetTop;
	window.scrollTo({top:loc});
});
<?php }?>
</script>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>Thông tin tài năng<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>

<div class="wrap1260 MAT20">
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('resume_A');
		echo $banner_arr['tag'];
		?>
	</div>

	<section class="sub">
		<p class="s_title">Thông tin tài năng</p>
		<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
		<input type="hidden" name="sort_resume" value="<?php echo $nf_util->get_html($_GET['sort_resume']);?>" />
		<input type="hidden" name="page_row" value="<?php echo $nf_util->get_html($_GET['page_row']);?>" />
		<input type="hidden" name="search_list" value="<?php echo $nf_util->get_html($_GET['search_list']);?>" />
		<input type="hidden" name="code" value="<?php echo $nf_util->get_html($_GET['code']);?>" />
		<?php
		include NFE_PATH.'/include/search_individual.php';
		?>
		</form>
	</section>
	<div class="resume_list_sub">
	<?php
	$arr = array();
	$arr['service_k'] = 'busy';
	$arr['where'] = " and nr.`wr_service_".$arr['service_k']."`>='".today."'".$resume_where['where'];
	$arr['order'] = " order by nr.`wr_jdate` desc";
	if($_GET['sort_resume']) $arr['order'] = " order by ".$nf_job->sort_arr['resume'][$_GET['sort_resume']][0];
	if($_GET['page_row']>0) $arr['limit'] = intval($_GET['page_row']);
	$service_arr = $nf_job->service_query('resume', $arr);

	$_arr = array();
	$_arr['tema'] = 'B';
	$_arr['num'] = $service_arr['limit'];
	$_arr['total'] = $service_arr['total'];
	$paging = $nf_util->_paging_($_arr);
	include NFE_PATH.'/resume/list.inc.php';
	?>
	</div>

	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('resume_E');
		echo $banner_arr['tag'];
		?>
	</div>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>

