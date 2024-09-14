<section class="platinum">
	<div class="product_title">
		<p><?php echo $nf_job->service_name['employ']['sub'][0];?> 구인정보</p>
		<?php if($env['service_employ_use']) {?><span><a href="<?php echo NFE_URL;?>/service/index.php?#service_loc_employ_<?php echo $arr['service_k'];?>">상품안내</a></span><?php }?>
	</div>
	<?php
	switch($service_arr['list_limit']<=0) {
		case true:
	?>
	<div class="no_employ">
		구인중인 공고가 없습니다.
	</div>
	<?php
		break;


		default:
	?>
	<div class="platinum_list pla_pri">
		<ul class="num<?php echo intval($service_arr['limit_arr'][0]);?>">
			<?php
			for($i=0; $i<$service_arr['list_limit']; $i++) {
				$em_row = $service_arr['list'][$i];
				$read_allow = $nf_job->read($member['no'], $em_row['no'], 'employ');
				$em_info = $nf_job->employ_info($em_row);
				$bordercolor = $em_row['wr_service1_border']>=today ? 'bordercolor' : '';
				$bordercolor_val = $em_row['wr_service1_border']>=today ? $env['service_config_arr']['employ'][$arr['service_k']]['border_strong_color'] : $env['service_config_arr']['employ'][$arr['service_k']]['border_color'];

				if($em_row) {
			?>
			<li class="common <?php echo $em_info['wr_logo_type'];?>_ver <?php echo $bordercolor;?>" style="border-color:<?php echo $bordercolor_val;?> !important;">
				<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>">
					<div class="toparea"><p <?php if($em_info['logo_'.$em_info['wr_logo_type']]) {?>style="background-image:url(<?php echo $em_info['logo_'.$em_info['wr_logo_type']];?>)"<?php }?> class="<?php echo $em_info['logo_class'];?>"><?php echo $em_info['logo_text'];?></p><button type="button" class="scrap-star-" code="employ" no="<?php echo $em_row['no'];?>"><i class="axi <?php echo $nf_util->is_scrap($em_row['no'], 'employ') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button></div><!--스크랩되었을때 i class="axi axi-star3 scrap"-->
					<div class="textarea">
						<h2 class="line1"><?php echo $nf_util->get_text($em_row['wr_company_name']);?></h2>
						<p class="title line2 <?php echo $em_info['bold_text'].$em_info['blink_text'];?>" style="<?php echo $em_info['neon_text'].$em_info['color_text'];?>"><?php echo $em_info['icon_text'];?><?php echo $nf_util->get_text($em_row['wr_subject']);?></p>
						<?php if($em_info['wr_logo_type']!='bg') {?>
						<div class="asi_wrap">
							<p class="date line1 bgcol1"><?php echo $em_info['end_date'];?></p>
							<p class="location line1"><?php echo $em_info['area_text_arr2'][0][1];?> · <?php if($em_info['pay_txt_first']) {?><span class="<?php echo $nf_job->pay_price_css1[$em_info['pay_txt_first']];?> sstyle"><?php echo $em_info['pay_txt_first'];?></span><?php }?> <?php echo $em_info['pay_txt_price'];?>
							</p>
						</div>
						<?php }?>
					</div>
				</a>
			</li>
			<?php
				} else {
			?>
			<li class="common noproduct" style="border-color:<?php echo $bordercolor_val;?> !important;">
				<a href="<?php echo NFE_URL;?>/service/index.php?#service_loc_employ_<?php echo $arr['service_k'];?>">
					<div>
						<p><?php echo $nf_job->service_name['employ']['sub'][0];?> 구인 등록</p>
						<?php if($env['service_employ_use']) {?><span>상품안내 및 신청</span><?php }?>
					</div>
				</a>
			</li>
			<?php
				}
			}?>
		</ul>
	</div>
	<?php
		break;
	}
	?>
</section>
<!--//platinum 플래티넘구인정보-->