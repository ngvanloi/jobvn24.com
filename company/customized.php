<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_time', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
include_once "../engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '맞춤 인재정보';
$_site_content_ = '맞춤정보를 이용하시면 매번 검색을 이용하실 필요가 없습니다.';
include '../include/header_meta.php';
include '../include/header.php';

$get_customized = $nf_job->get_customized($member['mb_id']);

$_GET = array_merge($get_customized['customized'], $_GET);

$where_arr = $nf_search->resume();
$service_where = $nf_search->service_where('resume');
$_where = $where_arr['where'];
if($_where) {
	$q = "nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno` where 1 ".$_where.$nf_job->resume_where;
	$order = " order by nr.`no` desc";
	$total = $db->query_fetch("select count(*) as c from ".$q);

	$_arr = array();
	$_arr['num'] = 15;
	if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
	$_arr['total'] = $total['c'];
	$_arr['tema'] = 'B';
	$paging = $nf_util->_paging_($_arr);

	$resume_query = $db->_query("select *, nr.`no` as nr_no from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
}
?>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['customized'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="jobtable tab_style3">
				<p  class="s_title">맞춤 인재정보</p>
				<ul class="help_text">
					<li>맞춤정보를 이용하시면 매번 검색을 이용하실 필요가 없습니다.</li>	
				</ul>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="button_area">
					<ul class="fr">
						<li><button type="button" onClick="nf_util.openWin('.customized-company-')" class="border">나의 맞춤 정보설정</button></li>
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

				<form name="flist">
				<table>
					<colgroup>
						<col width="18%">
						<col width="41%">
						<col width="13%">
						<col width="16%">
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
				switch($_arr['total']<=0) {
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
				</form>
			</section>
			<!--페이징-->
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>


<!--푸터영역-->
<?php
include NFE_PATH.'/include/job/company_customized.inc.php';
include '../include/footer.php';
?>