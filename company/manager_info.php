<?php
$add_cate_arr = array('email');
include_once "../engine/_core.php";
$nf_member->check_login('company');

$_site_title_ = '구인 담당자 관리';
$_site_content_ = '구인담당자를 등록하시면 구인공고 등록 시 구인담당자를 입력하실 필요가 없어 구인공고 등록 시간을 단축하실 수 있습니다.';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '구인 담당자 관리';
include NFE_PATH.'/include/m_title.inc.php';

$q = "nf_manager as nm where 1 ".$_where;
$order = " order by nm.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 99999;
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$_arr['tema'] = 'B';
$paging = $nf_util->_paging_($_arr);

$manager_query = $db->_query("select * from ".$q.$order);
?>
<script type="text/javascript">
var manage_update = function(no) {
	$.post(root+"/include/regist.php", "mode=load_manager&no="+no, function(data){
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.move;
		if(data.js) eval(data.js);
	});
}
</script>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['manager_info'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="manager">
				<p class="s_title">구인 담당자 관리</p>
				<ul class="help_text">
					<li>구인담당자를 등록하시면 구인공고 등록 시 구인담당자를 입력하실 필요가 없어 구인공고 등록 시간을 단축하실 수 있습니다.</li>
				</ul>
				<div class="button_area">
					<?php if($_arr['total']>0) {?>
					<ul class="fl">
						<li><button type="button" onclick="nf_util.all_check('#check_all', '.chk_')" class="white">전체선택</button></li>
						<li><button type="button" onclick="nf_util.ajax_select_confirm(this, 'flist', '삭제하시겠습니까?')" url="../include/regist.php" mode="delete_select_manager" tag="chk[]" check_code="checkbox" class="white">선택삭제</button></li>
					</ul>
					<?php }?>
					<ul class="fr">
						<li><button type="button" onClick="manage_update('')" class="bbcolor">담당자 추가</button></li>
					</ul>
				</div>

				<form name="flist" method="post">
				<input type="hidden" name="mode" value="" />
				<table class="style3">
					<tr>
						<th><input type="checkbox" id="check_all" onclick="nf_util.all_check(this, '.chk_')"></th>
						<th>닉네임</th>
						<th>담당자명</th>
						<th>이메일</th>
						<th>연락처</th>
						<th>담당자관리</th>
					</tr>
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<tr>
						<td colspan="6">등록된 담당자가 없습니다.</td>
					</tr>
					<?php
						break;

						default:
							while($row=$db->afetch($manager_query)) {
					?>
					<tr>
						<td><input type="checkbox" class="chk_" name="chk[]" value="<?php echo $row['no'];?>"></td>
						<td><?php echo $nf_util->get_text($row['wr_nickname']);?></td>
						<td><?php echo $nf_util->get_text($row['wr_name']);?></td>
						<td><?php echo $nf_util->get_text($row['wr_email']);?></td>
						<td><?php echo $nf_util->get_text($row['wr_phone']);?></td>
						<td class="tac">
							<ul class="button">
								<li><button type="button" onClick="manage_update('<?php echo $row['no'];?>')">수정</button></li>
								<li><button type="button" class="gray common" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $row['no'];?>" mode="delete_manager" url="../include/regist.php">삭제</button></li>
							</ul>
						</td>
					</tr>
					<?php
							}
						break;
					}
					?>
				</table>
				</form>
			</section>
		</div>
	</section>
</div>

<div class="manager_box-">
<?php
include NFE_PATH.'/include/job/manager.inc.php';
?>
</div>

<!--푸터영역-->
<?php
include '../include/footer.php';
?>
