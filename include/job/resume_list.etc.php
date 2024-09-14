<div class="job_box"><!--반복-->
	<?php if(!$not_check) {?>
	<div class="check">
		<input type="checkbox" class="chk_" name="chk[]" value="<?php echo $chk_no;?>">
	</div>
	<?php }?>
	<div class="name">
		<h2><button type="button" class="scrap-star-" code="resume" no="<?php echo $row['nr_no'];?>"><i class="axi <?php echo $nf_util->is_scrap($row['nr_no'], 'resume') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button><?php echo $re_info['name_txt'];?> <?php echo $re_info['gender_age_txt'];?></h2>
	</div>
	<div class="resume_info">
		<a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $row['nr_no'];?>">
		<p class="title line1"><?php echo $nf_util->get_text($row['wr_subject']);?></p>		
		<p class="jb line1"><?php echo $re_info['job_type_text_arr2_txt'][0];?><!-- / <?php echo $nf_job->school[$row['wr_school_ability']];?>--></p>
	</a>
	</div>	
	<div class="pay tac">
		<p><span class="ysalary sstyle"><?php echo $re_info['pay_type_short'];?></span> <?php echo $re_info['pay_txt_price'];?></p>
	</div>
	<div class="career tac">
		<p style="line-height:20px"><?php echo implode("<br> ", $re_info['area_text_arr2_txt']);?></p>
	</div>
	<div class="date tac">
		<p><?php echo date("Y.m.d", strtotime($row['wr_wdate']));?></p>
	</div>
</div><!--//반복-->