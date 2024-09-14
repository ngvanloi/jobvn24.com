<section class="jobtable sub">
	<div class="side_con">
		<p class="s_title">인재정보<span>총<em class="red"><?php echo number_format(intval($_arr['total']));?></em>건</span></p>
		<?php if(!$not_is_search_part) {?>
		<div class="select_area">
			<select name="sort_resume" onChange="nf_job.ch_sort(this, 'fsearch1')" code="resume">
				<?php
				if(is_array($nf_job->sort_arr['resume'])) { foreach($nf_job->sort_arr['resume'] as $k=>$v) {
				?>
				<option value="<?php echo $k;?>" <?php echo $_GET['sort_resume']==$k ? 'selected' : '';?>><?php echo $v[1];?></option>
				<?php
				} }
				?>
			</select>
			<select name="page_row" onChange="nf_job.ch_page_row(this, 'fsearch1')" code="resume">
				<option value="20" <?php echo $_GET['page_row']=='20' ? 'selected' : '';?>>20개씩보기</option>
				<option value="30" <?php echo $_GET['page_row']=='30' ? 'selected' : '';?>>30개씩보기</option>
			</select>
		</div>
		<?php }?>
	</div>
	<table>
		<colgroup>
			<col width="8%">
			<col width="13%">
			<col>
			<col width="10%">
			<col width="10%">
			<col width="12%">
			<col width="12%">
		</colgroup>	
		<tr>
			<th>&nbsp;</th>
			<th>이름</th>
			<th>이력서 정보</th>
			<th>희망지역</th>
			<th>희망업종</th>
			<th>희망급여</th>
			<th>등록일</th>
		</tr>
	</table>
	<?php
	switch($service_arr['total']<=0) {
		case true:
		?>
	<div class="no_content">
		<p>등록된 인재정보가 없습니다.</p>
	</div>
		<?php
		break;


		default:
			if(is_array($service_arr['list'])) { foreach($service_arr['list'] as $k=>$re_row) {
				$resume_individual = $nf_job->resume_individual($re_row['mno']);
				$read_allow = $nf_job->read($member['no'], $re_row['no'], 'resume');
				$re_info = $nf_job->resume_info($re_row);
			?>
	<div class="job_box"><!--반복-->
		<div class="injae_logo">
			<button type="button" class="scrap-star-" code="resume" no="<?php echo $re_row['no'];?>"><i class="axi <?php echo $nf_util->is_scrap($re_row['no'], 'resume') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button>
			<img src="<?php echo $re_info['photo_src'];?>" alt="">
		</div>
		<div class="name">
			<h2 class="line1"><?php echo $re_info['name_txt'];?> <?php echo $re_info['gender_age_txt'];?></h2>
		</div>
		<div class="resume_info">
			<a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>">
				<p class="title line1 <?php echo $re_info['bold_text'].$re_info['blink_text'];?>">
				<span style="<?php echo $re_info['neon_text'].$re_info['color_text'];?>"><?php echo $re_info['busy_text'].$re_info['icon_text'];?><?php echo $nf_util->get_text($re_row['wr_subject']);?></span>
				</p>
			</a>
		</div>	
		<div class="h_area">
			<p><?php echo $re_info['area_text_arr2_txt'][0];?></p>
			<p class="h_type2"><?php echo $re_info['job_type_1'];?></p>
			<p class="date2"><?php echo date("Y.m.d", strtotime($re_row['wr_wdate']));?></p>
		</div>
		<div class="h_type">
			<p><?php echo $re_info['job_type_1'];?></p>
		</div>
		<div class="pay tac">
			<p><span class="sstyle <?php echo $nf_job->pay_price_css1[$re_info['pay_type']];?>"><?php echo $re_info['pay_type_short'];?></span> <?php echo $re_info['pay_txt_price'];?></p>
		</div>

		<div class="date tac">
			<p><?php echo date("Y.m.d", strtotime($re_row['wr_wdate']));?></p>
		</div>
	</div><!--//반복-->
	<?php
			} }
		break;
	}
	?>

	<!--페이징-->
	<div><?php echo $paging['paging'];?></div>
</section>	