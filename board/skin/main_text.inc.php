<div class="text_board boardlist">
	<h2><?php echo $nf_util->get_text($bo_row['bo_subject']);?> <a href="<?php echo NFE_URL;?>/board/list.php?bo_table=<?php echo $bo_table;?>"><span><button><i class="axi axi-plus"></i></button></span></a></h2>
	<ul>
		<?php
		while($row=$db->afetch($b_query)) {
			$b_info = $nf_board->info($row, $board_info);
		?>
		<li><a href="<?php echo $b_info['a_href'];?>" class="line1"><?php echo $b_info['list_subject'];?></a><span class="line1"><?php echo date("y.m.d", strtotime($row['wr_datetime']));?></span></li>
		<?php
		}
		?>
	</ul>
</div>