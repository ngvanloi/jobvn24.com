<li>
	<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>" target="_blank">
		<div class="order1">
		<?php if($em_info['wr_logo_type'] == 'text') { ?>
			<p class="txt"><span class="line2">	<?php echo $em_info['logo_text'];?></span></p>
		<?php }else{ ?>
			<p class="<?php echo $em_info['logo_'.$em_info['wr_logo_type']] ? 'logo' : 'line2';?>" <?php if($em_info['logo_'.$em_info['wr_logo_type']]) {?>style="background-image:url(<?php echo $em_info['logo_'.$em_info['wr_logo_type']];?>)"<?php }?>><?php echo $em_info['logo_text'];?></p>
		<?php } ?>
			<div class="right_box">
				<p class="area line2"><i class="axi axi-location-on"></i> <?php echo $em_info['area_text_arr2_txt'][0];?></p>
				<p class="km line1"><?php echo $nf_util->get_distance_int($em_row['map_distance']);?></p>
			</div>
		</div>
		<div class="order2">
			<p class="corporation"><?php echo $nf_util->get_text($em_info['company_name_nick']);?></p>
			<p class="tit line1"><?php echo $nf_util->get_text($em_row['wr_subject']);?></p>
			<p class="pay"><?php if($em_info['pay_txt_first']) {?><span class="<?php echo $nf_job->pay_price_css1[$em_info['pay_txt_first']];?> sstyle"><?php echo $em_info['pay_txt_first'];?></span><?php }?> <?php echo $em_info['pay_txt_price'];?></p>
		</div>
	</a>
</li>