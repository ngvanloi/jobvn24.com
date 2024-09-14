<?php
$add_cate_arr = array('job_company', 'job_listed', 'job_company_type');
$top_menu_code = '300203';
include '../include/header.php';

$nf_util->sess_page_save("company_info_list");

$where_arr = $nf_search->member();
$_where = $where_arr['where'];

$q = "nf_member as nm right join nf_member_company as nmc on nm.`no`=nmc.`mno` where nmc.`is_delete`=0 ".$_where;
$order = " order by nmc.`no` desc";
if($_GET['sort']) $order = " order by `".addslashes($_GET['sort'])."` ".$_GET['sort_lo'];
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$_SESSION['admin_mem_q'] = $q.$order;
$mem_query = $db->_query("select *, nmc.`no` as nmc_no from ".$_SESSION['admin_mem_q']." limit ".$paging['start'].", ".$_arr['num']);
?>
<script type="text/javascript">
var ch_page_row = function(el) {
	var form = document.forms['fsearch'];
	form.page_row.value = el.value;
	form.submit();
}

var click_sort = function(sort, sort_lo) {
	var form = document.forms['fsearch'];
	form.sort.value = sort;
	form.sort_lo.value = sort_lo;
	form.submit();
}
</script>
<!-- 업소정보관리 -->
<div class="wrap">
	<?php include '../include/left_menu.php'; ?> <!--관리자 공통 좌측메뉴-->

	<section>
		<?php include '../include/title.php'; ?> <!--관리자 타이틀영역-->
		<div class="consadmin conbox">
			<div class="guide">
				<p><img src="../../images/ic/guide.gif" alt="가이드"></p>
				<ul>
					<li>- 업소회원의 업소정보를 관리 하는 페이지입니다.</li>
					<li>- <b>회원ID 하나로 여러 업소정보를 등록하실수 있으며 등록된 업소정보로 여러 구인공고를 올릴수 있습니다.</b></li>					
				</ul>
			</div>
			<form name="fsearch" action="" method="get">
				<input type="hidden" name="page_row" value="<?php echo $nf_util->get_html($_GET['page_row']);?>" />
				<input type="hidden" name="sort" value="<?php echo $nf_util->get_html($_GET['sort']);?>" />
				<input type="hidden" name="sort_lo" value="<?php echo $nf_util->get_html($_GET['sort_lo']);?>" />
				<div class="search">
	
					<div class="bg_w">
						<select name="search_field">
							<option value="">통합검색</option>
							<option value="id" <?php echo $_GET['search_field']=='id' ? 'selected' : '';?>>아이디</option>
							<option value="ceo_name" <?php echo $_GET['search_field']=='ceo_name' ? 'selected' : '';?>>대표자명</option>
							<option value="company_name" <?php echo $_GET['search_field']=='company_name' ? 'selected' : '';?>>업소명</option>
							<option value="biz_no" <?php echo $_GET['search_field']=='biz_no' ? 'selected' : '';?>>사업자등록번호</option>
							<option value="phone" <?php echo $_GET['search_field']=='phone' ? 'selected' : '';?>>전화번호</option>
							<option value="hphone" <?php echo $_GET['search_field']=='hphone' ? 'selected' : '';?>>휴대폰번호</option>
							<option value="biz_fax" <?php echo $_GET['search_field']=='biz_fax' ? 'selected' : '';?>>팩스번호</option>
							<option value="email" <?php echo $_GET['search_field']=='email' ? 'selected' : '';?>>이메일</option>
						</select>
						<input type="text" name="search_keyword" value="<?php echo $nf_util->get_html($_GET['search_keyword']);?>">
						<input type="submit" class="blue" value="검색"></input>
						<button class="black">초기화</button>
					</div>
				</div>
				<!--//search-->
			</form>
			<h6>회원관리<span>총 <b><?php echo number_format(intval($_arr['total']));?></b>명의 회원이 검색되었습니다.</span>
				<p class="h6_right">
					<select name="page_row" onChange="ch_page_row(this)">
						<option value="15" <?php echo $_GET['page_row']=='15' ? 'selected' : '';?>>15개출력</option>
						<option value="30" <?php echo $_GET['page_row']=='30' ? 'selected' : '';?>>30개출력</option>
						<option value="50" <?php echo $_GET['page_row']=='50' ? 'selected' : '';?>>50개출력</option>
						<option value="100" <?php echo $_GET['page_row']=='100' ? 'selected' : '';?>>100개출력</option>
					</select>
				</p>
			</h6>
			<div class="table_top_btn">
				<button type="button" onclick="nf_util.all_check('#check_all', '.chk_')" class="gray"><strong>A</strong> 전체선택</button>
				<button type="button" onclick="nf_util.ajax_select_confirm(this, 'flist', '삭제하시겠습니까?')" url="../../include/regist.php" mode="delete_select_company_info" tag="chk[]" check_code="checkbox" class="gray"><strong>-</strong> 선택삭제</button>
				<!-- <a href="<?php echo NFE_URL;?>/nad/member/company_insert.php"><button type="button" class="blue"><strong>+</strong> 업소정보등록</button></a> -->
			</div>
			<form name="flist" method="">
			<table class="table4">
				<colgroup>
					<col width="3%">
					<col width="">
					<col width="">
					<col width="">
					<col width="">
					<col width="">
					<col width="">
					<col width="">
					<col width="">		
					<col width="7%">
				</colgroup>
				<?php
				$mb_id_order = strpos($_GET['sort_lo'], 'asc')!==false && $_GET['sort']=='mb_id' ? 'desc' : 'asc';
				?>
				<thead>
					<tr>
						<th><input type="checkbox" id="check_all" onclick="nf_util.all_check(this, '.chk_')"></th>
						<th><a href="#none" onClick="click_sort('mb_id', '<?php echo $mb_id_order;?>')">회원ID<?php echo $mb_id_order=='desc' ? '▲' : '▼';?></a></th>
						<th>대표업소</th>
						<th>대표자명</th>
						<th>업소명</th>
						
						<th>사업자등록번호</th>
						<th>연락처</th>
						<th>휴대폰번호</th>
		
						<th>이메일</th>

						<th>편집</th>
					</tr>
				</thead>
				<tbody>
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<tr><td colspan="15" class="no_list"></td></tr>
					<?php
						break;


						default:
							while($mem_row=$db->afetch($mem_query)) {
								$update_url = $mem_row['mb_type']=='company' ? './company_insert.php' : './individual_insert.php';
					?>
					<tr class="tac">
						<td>
							<?php if(!$mem_row['is_public']) {?>
							<input type="checkbox" name="chk[]" class="chk_" value="<?php echo $mem_row['no'];?>">
							<?php }?>
						</td>
						<td><a href="#none" onClick="member_mno_click(this)" class="blue fwb" nc_no="<?php echo $mem_row['no'];?>"><?php echo $nf_util->get_text($mem_row['mb_id']);?></a></td>
						<td><?php echo $mem_row['is_public'] ? 'O' : '';?></td>
						<td><?php echo $nf_util->get_text($mem_row['mb_ceo_name']);?></td>
						<td><?php echo $nf_util->get_text($mem_row['mb_company_name']);?></td>
			
						<td><?php echo $nf_util->get_text($mem_row['mb_biz_no']);?></td>
						<td><?php echo $nf_util->get_text($mem_row['mb_biz_phone']);?></td>
						<td><?php echo $nf_util->get_text($mem_row['mb_biz_hphone']);?></td>
					
						<td><?php echo $nf_util->get_text($mem_row['mb_biz_email']);?></td>
		
						<td>
							<a href="<?php echo NFE_URL;?>/nad/member/company_info_regist.php?no=<?php echo $mem_row['nmc_no'];?>"><button type="button" class="gray common"><i class="axi axi-plus2"></i> 수정</button></a>
							<?php if(!$mem_row['is_public']) {?>
							<a><button type="button" class="gray common" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $mem_row['no'];?>" mode="delete_company_info" url="<?php echo NFE_URL;?>/include/regist.php"><i class="axi axi-minus2"></i> 삭제</button></a>
							<?php }?>
						</td>
					</tr>
					<?php
							}
						break;
					}
					?>
				</tbody>
			</table>
			<div class="table_top_btn bbn">
				<button type="button" onclick="nf_util.all_check('#check_all', '.chk_')" class="gray"><strong>A</strong> 전체선택</button>
				<button type="button" onclick="nf_util.ajax_select_confirm(this, 'flist', '삭제하시겠습니까?')" url="<?php echo NFE_URL;?>/include/regist.php" mode="delete_select_company_info" tag="chk[]" class="gray"><strong>-</strong> 선택삭제</button>
				<!-- <a href="<?php echo NFE_URL;?>/nad/member/company_insert.php"><button type="button" class="blue"><strong>+</strong> 업소정보등록</button></a></button> -->
			</div>

			<div><?php echo $paging['paging'];?></div>
		</div>
		<!--//payconfig conbox-->


		
	</section>
</div>
<!--//wrap-->

<?php include '../include/footer.php'; ?> <!--관리자 footer-->