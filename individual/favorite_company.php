<?php
include_once "../engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '관심업소 정보';
include '../include/header_meta.php';
include '../include/header.php';

$q = "nf_interest as ni left join nf_member_company as nmc on ni.`exmno`=nmc.`no` where ni.`mno`=".intval($member['no']);
$order = " order by ni.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$interest_query = $db->_query("select *, ni.`no` as ni_no, ni.`exmno` as ni_exmno, ni.`mno` as ni_mno, ni.`pmno` as ni_pmno, ni.rdate as ni_rdate from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
?>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>관심업소 정보<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['favorite_company'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">

			<section class="concern tab_style3">
				<p class="s_title">관심업소 정보</p>
				<ul class="help_text">
					<li>관심업소은 최대 30개 까지 등록하실 수 있습니다.</li>
					<li>취업하고 싶어하는 업소을 관심업소으로 등록하면 해당 업소의 구인여부를 확인하실 수 있습니다.</li>	
				</ul>

				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<input type="hidden" name="page_row" value="<?php echo intval($_GET['page_row']);?>" />
				</form>

				<ul class="tab">
					<li class="on"><a href="">관심업소 목록<span>(<?php echo number_format(intval($_arr['total']));?>)</span></a></li>
				</ul>

				<div class="tabcon"><!--온라인 입사지원-->
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<div class="no_content">
						<p>관심업소 목록이 없습니다.</p>
					</div>
					<?php
						break;

						default:
							while($row=$db->afetch($interest_query)) {
								$get_company_ex_row = $db->query_fetch("select * from nf_member_company where `no`=".intval($row['ni_exmno']));
								$get_company_ex = $nf_member->get_member_ex_info($get_company_ex_row);
								$employ_cnt = $db->query_fetch("select count(*) as c from nf_employ as ne where `mno`=? and `cno`=?".$_em_where.$nf_job->employ_where, array($row['ni_pmno'], $row['ni_exmno']));

								$page_code = 'interest';
								$company_cno = $row['ni_exmno'];
								include NFE_PATH.'/include/job/company_list.inc.php';
							}
						break;
					}
					?>

					<div class="select_area">
						<ul class="fr">
							<li><button type="button" onClick="nf_util.openWin('.company-interest-')">관심업소 등록</button></li>
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
				</div>
				<!--//tabcon-->
			</section>
			<!--페이징-->
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>

<?php
include NFE_PATH.'/include/job/company_interest.inc.php';
?>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
