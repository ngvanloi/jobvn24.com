<section class="">
	<div class="product_title">
		<p>최근 구인정보</p>
		<span><a href="<?php echo NFE_URL;?>/employ/list_type.php?#employ_list-">더보기</a></span>
	</div>
	<div class="lately">
		
		<div class="th_title">
			<ul>
				<li class="business_logo">&nbsp;</li>
				<li class="name"><?php if(is_nickname) { echo '닉네임'; }else{ echo '업소명'; } ?></li>
				<li class="locaiotn">근무지</li>
				<li class="jb">업종</li>
				<li class="resume_info">구인내용</li>
				<li class="pay">급여</li>
				<li class="date">마감일</li>
			</ul>
		</div>
		
		<?php
		if($service_arr['list_limit']>0) {
		?>
		<div class="td_con">
			<?php
			if(is_array($service_arr['list'])) { foreach($service_arr['list'] as $k=>$em_row) {
				$read_allow = $nf_job->read($member['no'], $em_row['no'], 'employ');
				$em_info = $nf_job->employ_info($em_row);
			?>
			<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>">
				<ul class="area area0">
					<li class="business_logo">
						<button type="button" class="scrap-star-" no="<?php echo $em_row['no'];?>" code="employ"><i class="axi <?php echo $nf_util->is_scrap($em_row['no'], 'employ') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button>
						<img src="../data/employ/202408/logo_bg_1723021181.jpg" alt="">
					</li>
					<li class="line1 name">
						<?php echo $nf_util->get_text($em_info['company_name_nick']);?>
					</li>
					<li class="line1 locaiotn">
						<?php echo $em_info['area_text_arr2'][0][1].' '.$em_info['area_text_arr2'][0][2];?>
						<p class="jb2"><?php echo $em_info['job_type_1'];?></p>
						<p class="date2"><?php echo $em_info['end_date'];?></p>
					</li>
					<li class="jb"><?php echo $em_info['job_type_1'];?></li>
					<li class="line1 resume_info"><span class="<?php echo $em_info['bold_text'].$em_info['blink_text'];?>" style="<?php echo $em_info['neon_text'].$em_info['color_text'];?>"><?php echo $em_info['busy_text'].$em_info['icon_text'];?><?php echo $nf_util->get_text($em_row['wr_subject']);?></span></li>
					<li class="pay"><?php if($em_info['pay_txt_first']) {?><span class="<?php echo $nf_job->pay_price_css1[$em_info['pay_txt_first']];?> sstyle"><?php echo $em_info['pay_txt_first'];?></span><?php }?> <?php echo $em_info['pay_txt_price'];?></li>
					<li class="date"><?php echo $em_info['end_date'];?><li>
				</ul>
			</a>
			<?php
			} }?>
		</div>
		<!--//td_con-->
	<?php
	}?>
	</div>
	<?php
	if($service_arr['list_limit']<=0) {
	?>
	<div class="no_employ">
		구인중인 공고가 없습니다.
	</div>
	<?php
	}?>
</section>
<!--//lately 최근구인정보-->