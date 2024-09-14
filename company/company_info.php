<?php
$_site_title_ = '업소정보 관리';
include '../include/header_meta.php';
include '../include/header.php';
$nf_member->check_login('company');

$_where = "";
$q = "nf_member_company as nmc where nmc.`mno`=".intval($member['no'])." ".$_where;

$order = " order by `sort_no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$max_company_no = $db->query_fetch("select max(`no`) as c from ".$q);
$company_query = $db->_query("select *, if(nmc.is_public=1, ".intval($max_company_no['c']+1).", nmc.`no`) as sort_no from ".$q.$order);
?>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>업소정보 관리<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['company_info'] = 'on';
		include '../include/company_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="concern tab_style3">
				<p class="s_title">업소정보 관리</p>
				<ul class="help_text">
					<li>업소정보를 등록하시면 구인공고 등록 시 업소정보를 입력하실 필요가 없어 구인공고 등록 시간을 단축하실 수 있습니다.</li>	
					<li>업소정보별 구인공고를 구분하여 등록 하실 수 있습니다.</li>	
				</ul>
				<ul class="tab">
					<li class="on"><a href="">등록된 업소<span>(<?php echo number_format(intval($total['c']));?>)</span></a></li>
				</ul>
				<div class="tabcon">
					<?php
					switch($total['c']<=0) {
						case true:
					?>
					<?php
						break;


						default:
							while($row=$db->afetch($company_query)) {
								$get_company_ex_row = $row;
								$get_company_ex = $nf_member->get_member_ex_info($get_company_ex_row);
								$employ_cnt = $db->query_fetch("select count(*) as c from nf_employ as ne where `mno`=? and `cno`=? ".$_em_where.$nf_job->employ_where, array($member['no'], $row['no']));
								$page_code = "company";
								$company_cno = $row['no'];
								include NFE_PATH.'/include/job/company_list.inc.php';
							}
						break;
					}
					?>
					<div class="select_area">
						<ul class="fr">
							<li><a href="<?php echo NFE_URL;?>/company/company_info_regist.php"><button type="button">업소정보 추가</button></a></li>
						</ul>
					</div>
				</div>
				<!--//tabcon-->
			</section>
			<!--페이징-->
		</div>
	</section>
</div>




<!--푸터영역-->
<?php include '../include/footer.php'; ?>
