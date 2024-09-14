<?php
include_once "../engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '열람한 구인정보';
include '../include/header_meta.php';
include '../include/header.php';

$employ_where = $nf_search->employ();

$_where = $employ_where['where'];
$q = "nf_read as nr right join nf_employ as ne on nr.`pno`=ne.`no` where nr.`code`='employ' and nr.`mno`=".intval($member['no'])." ".$_where;
$order = " order by nr.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$read_query = $db->_query("select *, nr.`no` as nr_no, nr.`mno` as nr_mno from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
?>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>열람한 구인정보<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['company_info'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="jobtable jobtable_sub tab_style3">
				<p class="s_title">열람한 구인정보</p>

				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="sub_serach reading">
					<?php
					if($nf_job->service_info['employ']['read']['use']) {
					?>
					<div class="sub_serach_box1">
						<?php
						if(($member_service['mb_employ_read_int']>0 || $member_service['mb_employ_read']>=today)) {
							if($member_service['mb_employ_read_int']>0) {
						?>
						<dl>
							<dt>보유한 열람권</dt>
							<dd><span class="orange"><?php echo $member_service['mb_employ_read_int'];?></span>건</dd>
						</dl>
						<?php
							}
							if($member_service['mb_employ_read']>today) {
						?>
						<dl>
							<dt>열람기간</dt>
							<dd><span class="orange">~ <?php echo $member_service['mb_employ_read'];?></span></dd>
						</dl>
						<?php
							}
						} else {
						?>
						<dl>
							<a href="<?php echo NFE_URL;?>/service/product_payment.php?code=read"><dd><span class="orange">열람권 충전요망</span></dd></a>
						</dl>
						<?php
						}?>
					</div>
					<?php
					}?>
					<div class="sub_serach_box2">
						<div class="search_style">
							<label for="">
								<input type="text" name="search_keyword" value="<?php echo $nf_util->get_html($_GET['search_keyword']);?>">
								<button type="submint"><i class="axi axi-search3"></i></button>
							</label>
						</div>
					</div>
				</div>
				<div class="button_area">
					<?php if($_arr['total']>0) {?>
					<ul class="fl">
						<li><button type="button" onclick="nf_util.all_check('#check_all', '.chk_')" class="white">전체선택</button></li>
						<li><button type="button" onclick="nf_util.ajax_select_confirm(this, 'flist', '열람권 사용으로 본경우 삭제하게 되면 다시 열람권 구매해야합니다.\n삭제하시겠습니까?')" url="../include/regist.php" mode="delete_select_read" tag="chk[]" check_code="checkbox" class="white">선택삭제</button></li>
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
					<p>열람한 구인정보가 없습니다.</p>
				</div>
				<?php
					break;

					default:
						while($row=$db->afetch($read_query)) {
							$employ_info = $nf_job->employ_info($row);
							$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($row['pno']));

							$chk_no = $row['nr_no'];
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
