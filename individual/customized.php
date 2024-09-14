<?php
$add_cate_arr = array('email', 'subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
include_once "../engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '맞춤 구인정보';
$_site_content_ = '나만을 위한 맞춤 구인정보를 설정하여 확인할수 있습니다.';
include '../include/header_meta.php';
include '../include/header.php';

$get_customized = $nf_job->get_customized($member['mb_id']);

$_GET = array_merge($get_customized['customized'], $_GET);

$where_arr = $nf_search->employ();
$service_where = $nf_search->service_where('employ');
$_where = $where_arr['where'];
if($_where) {
	$q = "nf_employ as ne where 1 ".$_where;
	if($_GET['code']=='end') $q .= " and (".$service_where['where'].")".$nf_job->not_end_date_where;
	else $q .= $nf_job->employ_where;
	$order = " order by ne.`no` desc";
	$total = $db->query_fetch("select count(*) as c from ".$q);

	$_arr = array();
	$_arr['num'] = 15;
	if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
	$_arr['total'] = $total['c'];
	$_arr['tema'] = 'B';
	$paging = $nf_util->_paging_($_arr);

	$employ_query = $db->_query("select * from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
}
$m_title = '맞춤 구인정보';
include NFE_PATH.'/include/m_title.inc.php';
?>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['customized'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="jobtable">
				<p class="s_title">맞춤 구인정보</p>
				<ul class="help_text">
					<li>나만을 위한 맞춤 구인정보를 설정하여 확인할수 있습니다.</li>	
				</ul>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="button_area">
					<ul class="fr">
						<li>
							<button type="button" onClick="nf_util.openWin('.customized-individual-')" class="border">나의 맞춤 정보설정</button>
						</li>
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
						<th>업소명</th>
						<th>구인 정보</th>
						<th>급여</th>
						<th>닉네임</th>
						<th>모집마감일</th>
					</tr>
				</table>
				<?php
				switch($_arr['total']<=0) {
					case true:
				?>
				<div class="no_content">
					<p><?php echo $_where ? '맞춤 구인정보가 없습니다.' : '맞춤설정해주시기 바랍니다.';?></p>
				</div>
				<?php
					break;

					default:
						while($row=$db->afetch($employ_query)) {
							$employ_info = $nf_job->employ_info($row);
							$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['no']));

							$not_check = true;
							include NFE_PATH.'/include/job/employ_list.etc.php';
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
include NFE_PATH.'/include/job/individual_customized.inc.php';
include '../include/footer.php';
?>