<?php
$add_cate_arr = array('job_type', 'job_date', 'job_week', 'job_time', 'job_pay', 'job_type', 'job_computer', 'job_pay_employ', 'job_obstacle', 'job_veteran', 'job_language', 'job_language_exam');
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$nf_member->check_login('individual');

$_site_title_ = '이력서 관리';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '이력서 관리';
include NFE_PATH.'/include/m_title.inc.php';

$nf_util->sess_page_save("mypage_resume_list");

$where_arr = $nf_search->resume();
$_where = $where_arr['where'];
$q = "nf_resume as nr where `mno`=".intval($member['no'])." and `is_delete`=0 ".$_where;
$order = " order by nr.`no` desc";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 15;
$_arr['tema'] = 'B';
if($_GET['page_row']>0) $_arr['num'] = intval($_GET['page_row']);
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$resume_query = $db->_query("select * from ".$q.$order." limit ".$paging['start'].", ".$_arr['num']);
?>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['resume_list'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="rescurrent tab_style1">
				<p class="s_title">이력서 관리</p>
				<ul class="help_text">
					<li>공개된 이력서는 업소에서 열람 가능합니다.</li>	
				</ul>
				<div class="button_area">
					<ul class="fr">
						<li><a href="<?php echo NFE_URL;?>/individual/resume_regist.php"><button type="button" class="bbcolor">이력서 작성하기</button></a></li>
					</ul>
				</div>
				<?php
				include NFE_PATH.'/include/job/resume_list.my.php';
				?>
				<!--//tabcon-->
			</section>
			<div><?php echo $paging['paging'];?></div>
		</div>
	</section>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>
