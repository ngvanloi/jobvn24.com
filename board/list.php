<?php
$_site_title_ = "Cộng đồng";
include "../engine/_core.php";

$bo_table = $_GET['bo_table'];
$_SESSION['board_list_'.$bo_table] = $_SERVER['REQUEST_URI'];
$bo_row = $db->query_fetch("select * from nf_board where `bo_table`=?", array($bo_table));
$_GET['cno'] = $bo_row['pcode'];
$auth = $nf_board->auth($bo_table, 'list', 'alert');
$board_info = $nf_board->board_info($bo_row);

include '../include/header_meta.php';
include '../include/header.php';

if(trim($_GET['search_keyword'])) {
	$_table = $nf_board->get_table($_GET['bo_table']);
	$nf_search->insert(array('code'=>'board', 'content'=>trim($_GET['search_keyword'])));
}

$m_title = $board_info['cate1_txt'];
include NFE_PATH.'/include/m_title.inc.php';
?>

<div class="wrap1260 my_sub">
	<section class="sub">
		<!-- Thực đơn bên trái dịch vụ cá nhân -->
		<?php include '../include/board_leftmenu.php'; ?>
		<div class="subcon_area">
			<?php if(stripslashes($bo_row['bo_content_head'])) {?>
			<div class="commu_t_txt"><?php echo stripslashes($bo_row['bo_content_head']);?></div>
			<?php }?>
			<section class="commu board_list">
				<div class="side_con">
					<ul class="fl">
						<li><h6><?php echo $nf_util->get_text($nf_board->board_table_arr[$bo_table]['bo_subject']);?></h6></li>
					</ul>
					<form name="fbsearch" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="bo_table" value="<?php echo $nf_util->get_html($bo_table);?>" />
					<input type="hidden" name="bunru" value="<?php echo $nf_util->get_html($_GET['bunru']);?>" />
					<ul class="fr">
						<li>
							<select name="search_field">
								<option value="">Chọn</option>
								<option value="wr_subject" <?php echo $_GET['search_field']=='wr_subject' ? 'selected' : '';?>>Tiêu đề</option>
								<option value="sub+con" <?php echo $_GET['search_field']=='sub+con' ? 'selected' : '';?>>Tiêu đề+Nội dung</option>
							</select>
							<input type="text" name="search_keyword" value="<?php echo $nf_util->get_html($_GET['search_keyword']);?>">
							<button>Tìm kiếm</button>
						</li>
						<li>
							<select name="page_row" onChange="nf_util.ch_page_row(this, 'fbsearch')">
								<option value="15" <?php echo $_GET['page_row']=='15' ? 'selected' : '';?>>Hiển thị 15 mục</option>
								<option value="30" <?php echo $_GET['page_row']=='30' ? 'selected' : '';?>>Hiển thị 30 mục</option>
								<option value="50" <?php echo $_GET['page_row']=='50' ? 'selected' : '';?>>Hiển thị 50 mục</option>
								<option value="100" <?php echo $_GET['page_row']=='100' ? 'selected' : '';?>>Hiển thị 100 mục</option>
							</select>
						</li>
					</ul>
					</form>
				</div>

				<?php if($bo_row['bo_category_list']) {?>
				<ul class="tab_menu">
					<li class="<?php echo $_GET['bunru'] ? '' : 'on';?>"><a href="./list.php?bo_table=<?php echo $bo_table;?>">Tất cả</a></li>
					<?php
					if(is_Array($board_info['bo_category_list_arr'])) { foreach($board_info['bo_category_list_arr'] as $k=>$v) {
						$on = $v==$_GET['bunru'] ? 'on' : '';
					?>
					<li class="<?php echo $on;?>"><a href="./list.php?bo_table=<?php echo $bo_table;?>&bunru=<?php echo $v;?>"><?php echo $nf_util->get_text($v);?></a></li>
					<?php
					} }?>
				</ul>
				<?php }?>

				<?php
				// : Danh sách bảng tin
				$skin = $bo_row['bo_type'];
				include './list.inc.php';
				?>
				<div class="wr_btn_con">
					<?php if($nf_board->auth($bo_table, 'write')) {?>
					<a href="./write.php?bo_table=<?php echo $bo_table;?>"><button type="button"><i class="axi axi-pencil-square"></i>Viết bài</button></a>
					<?php }?>
				</div>

				<?php if(stripslashes($bo_row['bo_content_tail'])) {?>
				<div class="commu_b_txt"><?php echo stripslashes($bo_row['bo_content_tail']);?></div>
				<?php }?>

			</section>
		</div>
	</section>
</div>

<!-- Khu vực chân trang -->
<?php include '../include/footer.php'; ?>
