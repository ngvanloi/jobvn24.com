<?php
include_once "../engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '스크랩한 구인정보';
include '../include/header_meta.php';
include '../include/header.php';

$q = "nf_scrap as ns right join nf_employ as ne on ns.`pno`=ne.`no` where ns.`code`='employ' and ns.`mno`=".intval($member['no'])." ".$_where;
$order = " order by ns.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$scrap_query = $db->_query("select *, ns.`no` as ns_no, ns.`mno` as ns_mno from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
?>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>스크랩한 구인정보<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['scrap'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="jobtable jobtable_sub tab_style3">
				<p class="s_title">스크랩한 구인정보</p>
				<ul class="help_text">
					<li>업소이 구인공고를 삭제한 경우, 스크랩한 구인정보도 동시에 삭제됩니다.</li>	
				</ul>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="button_area">
					<?php if($_arr['total']>0) {?>
					<ul class="fl">
						<li><button type="button" onclick="nf_util.all_check('#check_all', '.chk_')" class="white">전체선택</button></li>
						<li><button type="button" onclick="nf_util.ajax_select_confirm(this, 'flist', '삭제하시겠습니까?')" url="../include/regist.php" mode="delete_select_scrap" tag="chk[]" check_code="checkbox" class="white">선택삭제</button></li>
					</ul>
					<?php }?>
					<ul class="fr">
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
				<input type="hidden" name="code" value="employ" />
				<table class="style3">
					<colgroup>
						<col width="5%">
						<col width="16%">
						<col width="40%">
						<col width="13%">
						<col width="14%">
						<col width="12%">
					</colgroup>	
					<tr>
						<th><input type="checkbox" id="check_all" onclick="nf_util.all_check(this, '.chk_')"></th>
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
					<p>스크랩한 구인정보가 없습니다.</p>
				</div>
				<?php
					break;

					default:
						while($row=$db->afetch($scrap_query)) {
							$employ_info = $nf_job->employ_info($row);
							$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['pno']));

							$chk_no = $row['ns_no'];
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
<?php include '../include/footer.php'; ?>
