<div class="job_box"><!--반복-->
	<?php if(!$not_check) {?>
	<div class="check">
		<input type="checkbox" class="chk_" name="chk[]" value="<?php echo $chk_no;?>">
	</div>
	<?php }?>
	<div class="name">
		<h2><button type="button" class="scrap-star-" code="employ" no="<?php echo $em_row['no'];?>"><i class="axi <?php echo $nf_util->is_scrap($em_row['no'], 'employ') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button><?php echo $nf_util->get_text($row['wr_company_name']);?></h2>
	</div>
	<div class="resume_info">
		<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $row['no'];?>">
			<p class="title line1"><?php echo $nf_util->get_text($row['wr_subject']);?></p>
			<p class="locaiotn line1"><i class="axi axi-location-on"></i> <?php echo implode(", ", $employ_info['area_text_arr2_txt']);?></p>
			<p class="jb line1"><?php echo implode(", ", $employ_info['job_type_text_arr2_txt']);?><!--/ <?php echo $nf_job->school[$em_row['wr_ability']];?>--></p>
		</a>
	</div>	
	<div class="pay tac">
		<p><?php if($employ_info['pay_txt_first']) {?><span class="ysalary sstyle"><?php echo $employ_info['pay_txt_first'];?></span><?php }?> <?php echo $employ_info['pay_txt_price'];?></p>
	</div>
	<div class="career tac">
		<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $row['no'];?>">
		<p><?php echo $employ_info['wr_nickname'];?></p>
		</a>
	</div>
	<div class="date tac">
		<p><?php echo $employ_info['end_date'];?></p>
	</div>
</div><!--//반복-->