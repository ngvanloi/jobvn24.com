<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
include_once "../engine/_core.php";

$get_member_company = $db->query_fetch("select * from nf_member_company where `no`=".intval($_GET['no']));
$get_member_status = $nf_job->get_member_status($get_member_company, 'company');
$is_interest = $db->query_fetch("select * from nf_interest where `mno`=? and `exmno`=? and `code`=?", array($member['no'], $get_member_company['no'], 'company'));

$_site_title_ = $get_member_company['mb_company_name']." 업소정보";
//$_site_content_ = $em_row['wr_content'];

include '../include/header_meta.php';
include '../include/header.php';
?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $env['map_daum_key'];?>&libraries=services,clusterer"></script>
<script type="text/javascript" src="/plugin/map/daum.class.js"></script>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>업소정보소개<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>

<div class="company_info_bg">
	<div class="wrap1260">
		<section class="company_info sub">
			<div class="info_top">
				<ul class="company_name">
					<li><img src="<?php echo NFE_URL.'/data/member/'.$get_member_company['mb_logo'];?>" alt=""></li>
					<li class="line1"><?php echo $nf_util->get_text($get_member_company['mb_company_name']);?></li>
				</ul>
				<ul class="share">
					<li><button type="button" onClick="nf_util.interest(this, 'company', '<?php echo $get_member_company['no'];?>')"><i class="axi <?php echo $is_interest ? 'axi-heart2' : 'axi-heart-o';?>"></i>관심업소 등록</button></li>
					<?php
					include NFE_PATH.'/include/etc/sns.inc.php';
					?>
				</ul>
			</div>
		</section>
	</div>
</div>

<div class="wrap1260">
	<section class="company_info sub">
		<div class="info_wrap">
			<ul class="fix_info">
				<li>
					<p>업소명</p>
					<p><?php echo $nf_util->get_text($get_member_company['mb_company_name']);?></p>
				</li>
				<li>
					<p>대표자명</p>
					<p><?php echo $nf_util->get_text($get_member_company['mb_ceo_name']);?></p>
				</li>
				<li>
					<p>업소분류</p>
					<p><?php echo $nf_util->get_text($get_member_company['mb_biz_type']);?></p>
				</li>
				<li>
					<p>구인중</p>
					<p><span><?php echo number_format(intval($get_member_status['employ_ing']));?></span>건</p>
				</li>
			</ul>
			<div class="box">
				<h2>업소정보</h2>
				<div class="detail">
					<dl>
						<dt>업소주소</dt>
						<dd><?php echo $nf_util->get_text('['.$get_member_company['mb_biz_zipcode'].'] '.$get_member_company['mb_biz_address0'].' '.$get_member_company['mb_biz_address1']);?></dd>
						<dt>홈페이지</dt>
						<dd><a href="<?php echo $nf_util->get_domain($get_member_company['mb_homepage']);?>" target="_blank"><?php echo $nf_util->get_domain($get_member_company['mb_homepage']);?></a></dd>
						<?php
						if($register_form_arr['register_form_company']['설립년도']) {
						?>
						<dt>설립년도</dt>
						<dd><?php echo $nf_util->get_text($get_member_company['mb_biz_foundation']);?></dd>
						<?php
						}?>
						<?php
						if($register_form_arr['register_form_company']['업소형태']) {
						?>
						<dt>업소형태</dt>
						<dd><?php echo $nf_util->get_text($get_member_company['mb_biz_form']);?></dd>
						<?php
						}?>
						<?php
						if($register_form_arr['register_form_company']['사원수']) {
						?>
						<dt>사원수</dt>
						<dd><?php echo number_format(intval($get_member_company['mb_biz_member_count']));?>명</dd>
						<?php
						}?>
						<?php
						if($register_form_arr['register_form_company']['자본금']) {
						?>
						<dt>자본금</dt>
						<dd><?php echo $nf_util->get_text($get_member_company['mb_biz_stock']);?></dd>
						<?php
						}?>
						<dt>팩스번호</dt>
						<dd><?php echo $nf_util->get_text($get_member_company['mb_biz_fax']);?></dd>
						<?php
						if($register_form_arr['register_form_company']['주요사업내용']) {
						?>
						<dt>주요사업내용</dt>
						<dd><?php echo $nf_util->get_text($get_member_company['mb_biz_content']);?></dd>
						<?php
						}?>
					</dl>
				</div>
				<div class="map">
					<div>
						<?php
						$address_txt = $get_member_company['mb_biz_address0'];
						include NFE_PATH.'/plugin/map/map_view2.php';
						?>
					</div>
				</div>
			</div>

			<?php
			if($register_form_arr['register_form_company']['업소개요 및 비전']) {
			?>
			<div class="box">
				<h2>업소개요 및 비전</h2>
				<div class="detail2">
					<p><?php echo stripslashes($get_member_company['mb_biz_vision']);?></p>
				</div>
			</div>
			<?php
			}?>

			<?php
			if($register_form_arr['register_form_company']['업소연혁 및 실적']) {
			?>
			<div class="box">
				<h2>업소연혁 및 실적</h2>
				<div class="detail2">
					<p><?php echo stripslashes($get_member_company['mb_biz_result']);?></p>
				</div>
			</div>
			<?php
			}?>
		</div>
		<!--//info_wrap-->
	</section>

	<?php
	$arr = array();
	$arr['service_k'] = '1_list';
	$arr['where'] = " and ne.`mno`=".intval($get_member_company['mno']).$employ_where['where'].$nf_job->not_adult_where.$_em_where;
	$arr['order'] = " order by ne.`no` desc";
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



<!--푸터영역-->
<?php include '../include/footer.php'; ?>

