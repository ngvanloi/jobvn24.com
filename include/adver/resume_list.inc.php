<section class="lately_injae">
	<div class="product_title">
		<p>최근 인재정보</p>
		<span><a href="<?php echo NFE_URL;?>/resume/resume_list.php?#resume_list-">더보기</a></span>
	</div>
	<?php
	switch($service_arr['list_limit']<=0) {
		case true:
	?>
	<div class="no_resume">
		등록된 인재정보가 없습니다.
	</div>
	<?php
		break;


		default:
	?>
	<ul class="injae_list">
		<?php
		if(is_array($service_arr['list'])) { foreach($service_arr['list'] as $k=>$re_row) {
			$read_allow = $nf_job->read($member['no'], $re_row['no'], 'resume');
			$re_info = $nf_job->resume_info($re_row);
		?>
		<li>
			<a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>">
				<div class="lately1">
					<p class="myinfo line1"><?php echo $re_info['name_txt'];?> <span><?php echo $re_info['gender_age_txt'];?></span></p>
					<p class="scrap"><button type="button" class="scrap-star-" code="resume" no="<?php echo $re_row['no'];?>"><i class="axi <?php echo $nf_util->is_scrap($re_row['no'], 'resume') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button></p>
					<p class="title line1">
						<span class="<?php echo $re_info['bold_text'].$re_info['blink_text'];?>" style="<?php echo $re_info['neon_text'].$re_info['color_text'];?>">	<?php echo $re_info['busy_text'].$re_info['icon_text'];?><?php echo $nf_util->get_text($re_row['wr_subject']);?></span>
					</p>
				</div>
				<div class="lately2">
					<p class="location line1"><?php echo $re_info['area_text_arr2_txt'][0];?></p>
					<p class="job line1"><?php echo $re_info['job_type_text_arr2_txt'][0];?></p>
				</div>
				<div class="lately3">
					<p class="salary line1"><span class="<?php echo $nf_job->pay_price_css1[$re_info['pay_type']];?> sstyle"><?php echo $re_info['pay_type_short'];?></span> <?php echo $re_info['pay_txt_price'];?></p>
					
				</div>
			</a>
		</li>
		<?php
		} }?>
	</ul>
	<?php
		break;
	}
	?>
</section>