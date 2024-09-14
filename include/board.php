<div class="main_con_wrap">
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('main_I');
		echo $banner_arr['tag'];
		?>
	</div>

	<section class="board">
		<?php
		if(is_array($nf_board->board_mrank_arr)) {
			asort($nf_board->board_mrank_arr);
			foreach($nf_board->board_mrank_arr as $bo_table=>$rank) {
				$bo_row = $nf_board->board_table_arr[$bo_table];
				$board_info = $nf_board->board_info($bo_row);
				$bo_print = $nf_board->main_row['print_main_un'][$bo_table];
				if(!$bo_print['view']) continue;

				$bo_type = $bo_print['print_type']=='talk' ? 'text' : $bo_print['print_type'];
				$cnt = $bo_print['print_cnt'];
				$img_width = $bo_print['img_width'];
				$img_height = $bo_print['img_height'];

				$_table = $nf_board->get_table($bo_table);
				$order = " order by wr_num, wr_reply";
				$q = $_table." as nwb where wr_reply='' ".$nf_board->list_where;
				$b_query = $db->_query("select * from ".$q.$order." limit 0, ".intval($cnt));

				include NFE_PATH.'/board/skin/main_'.$bo_type.'.inc.php';
			}
		}
		?>
	</section>
	<!--//board-->
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('main_J');
		echo $banner_arr['tag'];
		?>
	</div>
	<section class="necessary">
		<div class="client_center common">
			<div>
				<h3>고객센터</h3>
				<p class="num"><?php echo stripslashes($env['call_center']);?></p>
			</div>
			<div>
				<p class="site_info"><?php echo stripslashes(nl2br($env['call_time']));?>
				</p>
			</div>
			<ul>
				<li><a href="<?php echo NFE_URL;?>/service/cs_center.php">고객센터</a></li>
				<li><a href="mailto:<?php echo $env['email'];?>">이메일 문의</a></li>
			</ul>
		</div>
		<?php if($env['pay_view']) {?>
		<div class="peak common">
			<div>
				<h3>최저임금법</h3>
				<p class="num"><?php echo number_format(intval($env['time_pay']));?>원</p>
			</div>
			<div>
				<table>
					<colgroup>
						<col width="20%">
						<col width="40%">
						<col width="40%">
					</colgroup>
					<thead>
						<tr>
							<th class="graybg"></th>
							<th>주간</th>
							<th>야간</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="graybg">시급</td>
							<td><span><?php echo number_format(intval($env['time_pay']));?></span>원</td>
							<td><span><?php echo number_format(intval($env['time_pay'])*1.5);?></span>원</td>
						</tr>
						<tr>
							<td class="graybg">일급</td>
							<td><span><?php echo number_format(intval($env['time_pay'])*8);?></span>원</td>
							<td><span><?php echo number_format(intval($env['time_pay'])*8*1.5);?></span>원</td>
						</tr>
					</tbody>
				</table>
			</div>
			<p class="info">
				일급 : 하루8시간 근무기준<br>
				(근로계약 1년 이내 체결시 수습기간에도 최저임금 보장해야함)
			</p>
		</div>
		<?php
		}


		$notice_query = $db->_query("select * from nf_notice order by wr_date desc limit 3");
		?>
		<div class="text_board common">
			<h3>공지사항 <span><a href="<?php echo NFE_URL;?>/board/notice_list.php"><button type="button"><i class="axi axi-plus"></i></button></a></span></h3>
			<ul>
				<?php
				while($row=$db->afetch($notice_query)) {
				?>
				<li><a href="<?php echo NFE_URL;?>/board/notice_view.php?no=<?php echo $row['no'];?>" class="line1"><?php echo $row['wr_subject'];?></a><span class="line1"><?php echo substr($row['wr_date'], 0, 10);?></span></li>
				<?php
				}?>
			</ul>
		</div>
	</section>
	<!--necessary 하단필수박스-->
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('main_K');
		echo $banner_arr['tag'];
		?>
	</div>
</div>