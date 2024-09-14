<section class="focus">
	<div class="product_title">
		<p><?php echo $nf_job->service_name['resume']['main'][0];?> 인재정보</p>
		<?php if($env['service_resume_use']) {?><span><a href="<?php echo NFE_URL;?>/service/index.php?code=resume#service_loc_resume_<?php echo $arr['service_k'];?>">상품안내</a></span><?php }?>
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
	<div class="focus_wrap injae_wrap">
		<ul>
			<?php
			for($i=0; $i<$service_arr['list_limit']; $i++) {
				$re_row = $service_arr['list'][$i];
				$read_allow = $nf_job->read($member['no'], $re_row['no'], 'resume');
				$re_info = $nf_job->resume_info($re_row);		
				$bordercolor = $re_row['wr_service0_border']>=today ? 'bordercolor' : '';
				$bordercolor_val = $re_row['wr_service0_border']>=today ? $env['service_config_arr']['resume'][$arr['service_k']]['border_strong_color'] : $env['service_config_arr']['resume'][$arr['service_k']]['border_color'];

				if($re_row) {
			?>
			<li class="<?php echo $bordercolor;?>" style="border-color:<?php echo $bordercolor_val;?> !important">
				<a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>">
					<div class="toparea">
						<div class="photo">
							<p class="<?php echo $bordercolor;?>" style="background-image:url(<?php echo $re_info['photo_src'];?>); border-color:<?php echo $bordercolor_val;?> !important"></p>
						</div>
						<div class="textarea">
							<button type="button" class="scrap-star-" code="resume" no="<?php echo $re_row['no'];?>"><i class="axi <?php echo $nf_util->is_scrap($re_row['no'], 'resume') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button>
							<p class="myinfo line1">
							<?php echo $re_info['name_txt'];?> <em>(<?php echo $re_info['age_txt'];?>·<?php echo $re_info['gender_txt'];?>)</em>
								<?php
								echo $re_info['icon_focus0'];
								?>
							</p>
						</div>
					</div>
					<p class="title line2">
						<span class="<?php echo $re_info['bold_text'].$re_info['blink_text'];?>" style="<?php echo	$re_info['neon_text'].$re_info['color_text'];?>"><?php echo $re_info['icon_text'];?><?php echo $nf_util->get_text($re_row['wr_subject']);?></span>
					</p>
					<div class="bottomarea">
						<p class="injae_jb line1">
							<span class="<?php echo $nf_job->pay_price_css1[$re_info['pay_type']];?> sstyle"><?php echo $re_info['pay_type_short'];?></span> <?php echo $re_info['pay_txt_price'];?> <em><?php echo $re_info['area_text_arr2_txt'][0];?> / <?php echo $re_info['job_type_text_arr2_txt'][0];?></em>
						</p>
					</div>
				</a>
			</li>
				<?php } else {?>
			<li class="noproduct" style="border-color:<?php echo $bordercolor_val;?> !important">
				<a href="<?php echo NFE_URL;?>/service/index.php?code=resume&#service_loc_resume_<?php echo $arr['service_k'];?>">
					<div>
						<p><?php echo $nf_job->service_name['resume']['sub'][0];?> 인재 등록</p>
						<?php if($env['service_resume_use']) {?><span>상품안내 및 신청</span><?php }?>
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
<!--//focus 인재정보 구인정보-->
