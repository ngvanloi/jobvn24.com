<?php
include_once "../engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '취업활동증명서';
include '../include/header_meta.php';
include '../include/header.php';

$_where = "";
$q = "nf_employ as ne right join nf_accept as na on ne.`no`=na.`pno` where na.`code`='employ' and na.`del`=0 and na.`mno`=".intval($member['no'])." ".$_where;
$order = " order by na.`no` desc";
$group = " group by ne.`no`";
$total = $db->query_fetch("select count(distinct na.`pno`) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$company_query = $db->_query("select * from ".$q.$group.$order." limit ".$paging['start'].", ".$_arr['num']);

$m_title = '취업활동증명서';
include NFE_PATH.'/include/m_title.inc.php';
?>
<script type="text/javascript">
var print_proof_resume = function(no) {
	var form = document.forms['flist'];
	var len = $(form).find("[name='chk[]']:checked").length;
	if(len<=0) {
		alert("취업활동증명서를 발급받을 업소정보를 선택해주시기 바랍니다.");
	} else {
		var para = $(form).serialize();
		window.open('../popup/print_proof_resume.php?'+para, 'print_proof_resume', 'width=700,height=800,location=no,scrollbars=yes')
	}
}
</script>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['applycert'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="applycert tab_style3">
				<p class="s_title">취업활동증명서</p>
				<ul class="help_text">
					<li>회원님의 입사지원 활동 내역에 대한 증명서를 발급해 드리는 서비스로 노동부 고용안정센터 등에 증명 자료로 제출하실 수 있습니다.</li>
					<li>온라인 지원 취소, 지원한 업소이 탈퇴한 경우는 증명서 발급이 불가합니다.</li>	
				</ul>
				<form name="fsearch1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
				<div class="date_search">
					<ul class="fl">
						<li>조회기간&nbsp;&nbsp;</li>
						<li class="on"><button class="white">1주일</button></li>
						<li><button class="white">1개월</button></li>
						<li><button class="white">3개월</button></li>
					</ul>
					<ul class="fr">
						<li><input type="text"> ~ <input type="text"> <button class="bbcolor">검색</button></li>
						<li>
							<select name="" id="">
								<option value="">10개씩 보기</option>
								<option value="">20개씩 보기</option>
							</select>
						</li>
					</ul>
				</div>
				</form>

				<form name="flist">
				<table class="style3">
					<colgroup>
						<col width="8%">
						<col width="12%">
						<col width="15%">
						<col width="">
					</colgroup>
					<tr>
						<th><input type="checkbox" id="check_all" onclick="nf_util.all_check(this, '.chk_')"></th>
						<th>지원일</th>
						<th>업소명</th>
						<th>구인공고제목</th>
					</tr>
					<?php
					switch($_arr['total']<=0) {
						case true:
					?>
					<tr>
						<td colspan="4">취업활동 내역이 없습니다.</td>
					</tr>
					<?php
						break;

						default:
							while($row=$db->afetch($company_query)) {
								$company_row = $db->query_fetch("select * from nf_member_company where `no`=?", array($row['cno']));
					?>
					<tr>
						<td><input type="checkbox" name="chk[]" value="<?php echo $row['no'];?>" class="chk_"></td>
						<td><?php echo date("Y.m.d", strtotime($row['sdate']));?></td>
						<td><?php echo $company_row['mb_company_name'];?></td>
						<td align="left"><?php echo $row['wr_subject'];?></td>
					</tr>
					<?php
							}
						break;
					}
					?>
					
					
				</table>

				<?php if($_arr['total']>0) {?>
				<div class="button_area">
					<ul class="fl">
						<li><button type="button" class="white" onclick="print_proof_resume()">취업활동증명서 발급받기</button></li>
					</ul>
				</div>
				<?php }?>
				</form>
			</section>
			<!--페이징-->
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>
