<?php
$add_cate_arr = array('job_date', 'job_week', 'job_pay', 'subway', 'job_conditions', 'job_welfare', 'job_target', 'job_type');
$_site_title_ = "구인정보";
include '../include/header_meta.php';

// : 성인직종은 성인값으로 get값 넣습니다. - 자동으로 성인검색 체크합니다.
if(in_Array($_GET['wr_job_type'][0], $nf_category->job_part_adult_arr)) $_GET['code'] = 'adult';

if($_GET['code']=='adult') {
	// : 성인인증 사용시 사용
	include NFE_PATH.'/include/adult.php';
}

include '../include/header.php';

if(trim($_GET['search_keyword'])) {
	$nf_search->insert(array('code'=>'employ', 'content'=>trim($_GET['search_keyword'])));
}
$employ_where = $nf_search->employ();

// : 19금 검색
if($_GET['code']=='adult') $employ_where['where'] .= $nf_job->adult_where;
else $employ_where['where'] .= $nf_job->not_adult_where;

$m_title = '구인정보';
include NFE_PATH.'/include/m_title.inc.php';
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

<div class="wrap1260 MAT20">
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('employ_A');
		echo $banner_arr['tag'];
		?>
	</div>

	<section class="employ_main sub">
		<p class="s_title">Thông tin việc làm</p>
		<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
		<input type="hidden" name="sort_employ" value="<?php echo $nf_util->get_html($_GET['sort_employ']);?>" />
		<input type="hidden" name="page_row" value="<?php echo $nf_util->get_html($_GET['page_row']);?>" />
		<input type="hidden" name="search_list" value="<?php echo $nf_util->get_html($_GET['search_list']);?>" />
		<input type="hidden" name="code" value="<?php echo $nf_util->get_html($_GET['code']);?>" />
		<?php
		include NFE_PATH.'/include/search_employ.php';
		?>
		</form>

<!--구인공고 영역-->
		<div style="margin-top:-20px;position:absolute;" id="employ-list-start-"></div>
		<div class="main_con_wrap">
			<?php
			$arr = array();
			$arr['service_k'] = '0_0';
			if($env['service_config_arr']['employ'][$arr['service_k']]['use']) {
				$arr['where'] = " and ne.`wr_service".$arr['service_k']."`>='".today."'".$employ_where['where'];
				$arr['order'] = " order by ne.`wr_jdate` desc";
				$service_arr = $nf_job->service_query('employ', $arr);
				if(!$_GET['cno'] || $service_arr['total']>0) {
			?>
				<div class="banner" style="overflow:hidden;">
					<?php
					$banner_arr = $nf_banner->banner_view('employ_B');
					echo $banner_arr['tag'];
					?>
				</div>
			<?php
					include NFE_PATH.'/include/adver/employ_0_0.inc.php';
				}
			}
			?>

			<?php
			$arr = array();
			$arr['service_k'] = '0_1';
			if($env['service_config_arr']['employ'][$arr['service_k']]['use']) {
				$arr['where'] = " and ne.`wr_service".$arr['service_k']."`>='".today."'".$employ_where['where'];
				$arr['order'] = " order by ne.`wr_jdate` desc";
				$service_arr = $nf_job->service_query('employ', $arr);
				if(!$_GET['cno'] || $service_arr['total']>0) {
			?>
				<div class="banner" style="overflow:hidden;">
					<?php
					$banner_arr = $nf_banner->banner_view('employ_C');
					echo $banner_arr['tag'];
					?>
				</div>
			<?php
					include NFE_PATH.'/include/adver/employ_0_1.inc.php';
				}
			}
			?>

			<?php
			$arr = array();
			$arr['service_k'] = '0_2';
			if($env['service_config_arr']['employ'][$arr['service_k']]['use']) {
				$arr['where'] = " and ne.`wr_service".$arr['service_k']."`>='".today."'".$employ_where['where'];
				$arr['order'] = " order by ne.`wr_jdate` desc";
				$service_arr = $nf_job->service_query('employ', $arr);
				if(!$_GET['cno'] || $service_arr['total']>0) {
			?>
				<div class="banner" style="overflow:hidden;">
					<?php
					$banner_arr = $nf_banner->banner_view('employ_D');
					echo $banner_arr['tag'];
					?>
				</div>
			<?php
					include NFE_PATH.'/include/adver/employ_0_2.inc.php';
				}
			}
			?>
		</div>

	</section>

	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('employ_E');
		echo $banner_arr['tag'];
		?>
	</div>
	<div id="employ_list-"></div>
	<div class="employ_list_sub">
	<?php
	$arr = array();
	$arr['service_k'] = '0_list';
	$arr['where'] = $employ_where['where'].$_em_where;
	$arr['order'] = " order by ne.`wr_jdate` desc";
	if($_GET['sort_employ']) $arr['order'] = " order by ".$nf_job->sort_arr['employ'][$_GET['sort_employ']][0];
	if($_GET['page_row']>0) $arr['limit'] = intval($_GET['page_row']);
	$service_arr = $nf_job->service_query('employ', $arr);

	$_arr = array();
	$_arr['tema'] = 'B';
	$_arr['num'] = $service_arr['limit'];
	$_arr['total'] = $service_arr['total'];
	$_arr['anchor'] = '#employ_list-';
	$paging = $nf_util->_paging_($_arr);
	include NFE_PATH.'/employ/list.inc.php';	
	?>
	</div>
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('employ_F');
		echo $banner_arr['tag'];
		?>
	</div>

</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>

