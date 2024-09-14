<?php
$_site_title_ = "Cộng đồng";
include "../engine/_core.php";

if(!$_GET['cno']) $_GET['cno'] = $nf_board->board_botable_k_arr[0];

// : Nếu không sử dụng trang chính
if(!$nf_board->main_row['use_main']) {
	$bo_table_array = array_keys($nf_board->board_botable_arr[$_GET['cno']]);
	die($nf_util->move_url(NFE_URL."/board/list.php?bo_table=".$bo_table_array[0], ""));
}

// : best of best
$max_hit_array = $nf_board->max_visit($_GET['cno'], $_arr);

include '../include/header_meta.php';
include '../include/header.php';

$m_title = $nf_board->board_menu[0][$_GET['cno']]['wr_name'];
include NFE_PATH.'/include/m_title.inc.php';
?>
<style type="text/css">
<?php if($nf_board->main_row['use_print']==='1') {?>
.commu .board .boardlist { width:100%; margin-right:0px; }
<?php }?>
</style>

<div class="wrap1260 my_sub">
	<section class="sub">
		<!--Menu bên trái dịch vụ cá nhân-->
		<?php
		include '../include/board_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="commu board_list ">
				<div class="banner" style="overflow:hidden;">
					<?php
					$banner_arr = $nf_banner->banner_view('board_B');
					echo $banner_arr['tag'];
					?>
				</div>
				<div class="side_con">
					<ul class="fl">
						<li><h6><?php echo $nf_board->board_menu[0][$_GET['cno']]['wr_name'];?></h6></li>
					</ul>
				</div>
				<?php
				if($nf_board->main_row['use_best']) {
					$bo_table = $max_hit_array[0]['bo_table'];
					$wr_no = $max_hit_array[0]['wr_no'];
				?>
				<div class="best">
					<h2>BEST OF BEST</h2>
					<div class="best1">
						<a href="<?php echo NFE_URL;?>/board/view.php?bo_table=<?php echo $bo_table;?>&no=<?php echo $wr_no;?>">
							<h3 class="line1"><?php echo $nf_util->get_text($max_hit_array[0]['wr_subject']);?></h3>
							<p class="line7"><?php echo $nf_util->get_text($max_hit_array[0]['wr_content']);?></p>
						</a>
					</div>
					<div class="best_list">
						<h3>Top của tuần</h3>
						<ul>
							<?php
							for($i=1; $i<$max_hit_array['length']; $i++) {
								$bo_table = $max_hit_array[$i]['bo_table'];
								$wr_no = $max_hit_array[$i]['wr_no'];
							?>
							<li class="line1"><span><?php echo $i;?></span><a href="<?php echo NFE_URL;?>/board/view.php?bo_table=<?php echo $bo_table;?>&no=<?php echo $wr_no;?>"><?php echo $nf_util->get_text($max_hit_array[$i]['wr_subject']);?></a></li>
							<?php
							}?>
						</ul>
					</div>
				</div>
				<?php
				}?>

				<section class="board">
					<?php
					asort($nf_board->board_brank_arr[$_GET['cno']]);
					if(is_array($nf_board->board_brank_arr[$_GET['cno']])) { foreach($nf_board->board_brank_arr[$_GET['cno']] as $bo_table=>$v) {
						$board_info = $bo_row = $nf_board->board_table_arr[$bo_table];
						$bo_print = $nf_board->main_row['print_board_un'][$bo_table];
						if(!$bo_print['view']) continue;
						if(!$nf_board->board_menu[$_GET['cno']][$board_info['code']]['wr_view']) continue; // : Sử dụng menu phụ của bảng

						$bo_type = $bo_print['print_type']=='talk' ? 'text' : $bo_print['print_type'];
						$cnt = $bo_print['print_cnt'];
						$img_width = $bo_print['img_width'];
						$img_height = $bo_print['img_height'];

						$_table = $nf_board->get_table($bo_table);
						$order = " order by wr_num, wr_reply";
						$q = $_table." as nwb where wr_reply='' ".$nf_board->list_where;
						$b_query = $db->_query("select * from ".$q.$order." limit 0, ".intval($cnt));

						include NFE_PATH.'/board/skin/main_'.$bo_type.'.inc.php';
					} }
					?>
				</section>
				<div class="banner" style="overflow:hidden;">
					<?php
					$banner_arr = $nf_banner->banner_view('board_C');
					echo $banner_arr['tag'];
					?>
				</div>
			</section>
		</div>
	</section>
</div>

<!--Khu vực chân trang-->
<?php include '../include/footer.php'; ?>
