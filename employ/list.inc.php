<?php
$service_txt = '구인정보';
if($arr['service_k']=='busy') $service_txt = '급구 구인정보';

// : 마감일순 - 마감임박순
// : 경력순 - 경력 높은순
?>
<section class="jobtable sub">
	<div class="side_con">
		<p class="s_title"><?php echo $service_txt;?><span>총<em class="red"><?php echo number_format(intval($service_arr['total']));?></em>건</span></p>
		<?php if(!$not_is_search_part) {?>
		<div class="select_area">
			<select name="sort_employ" onChange="nf_job.ch_sort(this, 'fsearch1')" code="employ">
				<?php
				if(is_array($nf_job->sort_arr['employ'])) { foreach($nf_job->sort_arr['employ'] as $k=>$v) {
				?>
				<option value="<?php echo $k;?>" <?php echo $_GET['sort_employ']==$k ? 'selected' : '';?>><?php echo $v[1];?></option>
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
			<col width="10%">
			<col width="10%">
			<col width="10%">
			<col width="10%">
			<col>			
			<col width="12%">
			<col width="12%">
		</colgroup>	
		<tr>
			<th>&nbsp;</th>
			<th><?php if(is_nickname) { echo '닉네임'; }else{ echo '업소명'; } ?></th>
			<th>근무지</th>
			<th>업종</th>
			<th>구인 정보</th>
			<th>급여</th>
			<th>모집마감일</th>
		</tr>
	</table>
	<?php
	switch($service_arr['total']<=0) {
		case true:
		?>
	<div class="no_content">
		<p>구인중인 공고가 없습니다.</p>
	</div>
		<?php
		break;


		default:
			if(is_array($service_arr['list'])) { foreach($service_arr['list'] as $k=>$em_row) {
				$read_allow = $nf_job->read($member['no'], $em_row['no'], 'employ');
				$em_info = $nf_job->employ_info($em_row);
				$bordercolor = $em_row['wr_service1_border']>=today ? 'bordercolor' : '';
				//echo '<pre>';
				//print_R($em_info);
				//echo '</pre>';
			?>
	<div class="job_box">
		<div class="business_logo">
			<button type="button" class="scrap-star-" code="employ" no="<?php echo $em_row['no'];?>"><i class="axi <?php echo $nf_util->is_scrap($em_row['no'], 'employ') ? 'axi-star3 scrap' : 'axi-star-o';?>"></i></button>
			<img src="<?php echo $em_info['logo_'.$em_info['wr_logo_type']];?>" alt="">
		</div>
		<div class="name">
			<h2 class="line1"><?php echo $nf_util->get_text($em_info['company_name_nick']);?></h2>
		</div>
		<div class="locaiotn line1">
			<?php echo $em_info['area_text_arr2'][0][1].' '.$em_info['area_text_arr2'][0][2];?>
			<p class="jb2"><?php echo $em_info['job_type_1'];?></p>
			<p class="date2"><?php echo $em_info['end_date'];?></p>
		</div>
		<div class="jb line1">
			<?php echo $em_info['job_type_1'];?>
		</div>
		<div class="resume_info">
			<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>">
				<p class="title line1 <?php echo $em_info['bold_text'].$em_info['blink_text'];?>">
				<span style="<?php echo $em_info['neon_text'].$em_info['color_text'];?>">
					<?php echo $em_info['busy_text'].$em_info['icon_text'];?><?php echo $nf_util->get_text($em_row['wr_subject']);?>
				</span>
				</p>
			</a>
		</div>	
		<div class="pay tac">
			<p><?php if($em_info['pay_txt_first']) {?><span class="<?php echo $nf_job->pay_price_css1[$em_info['pay_txt_first']];?> sstyle"><?php echo $em_info['pay_txt_first'];?></span><?php }?> <?php echo $em_info['pay_txt_price'];?></p>
		</div>
		<div class="date tac">
			<p><?php echo $em_info['end_date'];?></p>
		</div>
	</div>
			<?php
			} }
		break;
	}
	?>

	<!--페이징-->
	<div><?php echo $paging['paging'];?></div>
</section>