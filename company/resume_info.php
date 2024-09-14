<?php
include_once "../engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '열람한 인재정보';
include '../include/header_meta.php';
include '../include/header.php';

$resume_where = $nf_search->resume();

$_where = $employ_where['where'];
if($_GET['search_txt']) {
	$_search['name'] = "nm.`mb_name` like '%".addslashes($_GET['search_txt'])."%'";
	$_search['subject'] = "nr.`wr_subject` like '%".addslashes($_GET['search_txt'])."%'";

	if($_GET['search_k']) $_where .= " and ".$_search[$_GET['search_k']];
	else $_where .= " and (".implode(" or ", $_search).")";
}
$q = "nf_read as nread right join (nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno`) on nread.`pno`=nr.`no` where nread.`code`='resume' and nread.`mno`=".intval($member['no'])." ".$_where;
$order = " order by nread.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$read_query = $db->_query("select *, nread.`no` as nread_no, nr.`no` as nr_no, nread.`mno` as nr_mno from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
?>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>열람한 인재정보<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--업소서비스 왼쪽 메뉴-->
		<?php
		$left_on['resume_info'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="jobtable jobtable_sub tab_style3">
				<p class="s_title">열람한 인재정보</p>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="sub_serach reading">
					<?php if($nf_job->service_info['resume']['read']['use']) {?>
					<div class="sub_serach_box1">
					<?php
						if(($member_service['mb_resume_read_int']>0 || $member_service['mb_resume_read']>=today)) {
							if($member_service['mb_resume_read_int']>0) {
						?>
						<dl>
							<dt>보유한 열람권</dt>
							<dd><span class="orange"><?php echo $member_service['mb_resume_read_int'];?></span>건</dd>
						</dl>
						<?php
							}
							if($member_service['mb_resume_read']>today) {
						?>
						<dl>
							<dt>열람기간</dt>
							<dd><span class="orange">~ <?php echo $member_service['mb_resume_read'];?></span></dd>
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
					<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
					<div class="sub_serach_box2">
						<select name="search_k">
							<option value=""></option>
							<option value="name" <?php echo $_GET['search_k']==='name' ? 'selected' : '';?>>이름</option>
							<option value="subject" <?php echo $_GET['search_k']==='subject' ? 'selected' : '';?>>이력서 제목</option>
						</select>
						
						<div class="search_style">
							<label for="">
								<input type="text" name="search_txt" value="<?php echo $nf_util->get_html($_GET['search_txt']);?>">
								<button type="submint"><i class="axi axi-search3"></i></button>
							</label>
						</div>
					</div>
					</form>
				</div>
				<div class="button_area">
					<?php if($_arr['total']>0) {?>
					<ul class="fl">
						<li><button type="button" onclick="nf_util.all_check('#check_all', '.chk_')" class="white">전체선택</button></li>
						<li><button type="button" onclick="nf_util.ajax_select_confirm(this, 'flist', '삭제하시겠습니까?')" url="../include/regist.php" mode="delete_select_read" tag="chk[]" check_code="checkbox" class="white">선택삭제</button></li>
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
				<input type="hidden" name="code" value="resume" />
				<table class="style3">
					<colgroup>
						<col width="5%">
						<col width="16%">
						<col width="38%">
						<col width="13%">
						<col width="16%">
						<col width="12%">
					</colgroup>	
					<tr>
						<th><input type="checkbox" id="check_all" onclick="nf_util.all_check(this, '.chk_')"></th>
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
					<p>검색된 열람인재정보가 없습니다.</p>
				</div>
				<?php
					break;

					default:
						while($row=$db->afetch($read_query)) {
							$re_info = $nf_job->resume_info($row);
							$chk_no = $row['nread_no'];
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
<?php include '../include/footer.php'; ?>
