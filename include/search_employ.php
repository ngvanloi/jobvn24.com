<script type="text/javascript">
$(function(){
	$(".search-tab-body- > .btn-").click(function(){
		var index = $(this).index();
		$(".s_choice").css({"display":"none"});
		$(".s_choice").eq(index).css({"display":"block"});

		$(".search-tab-body- > .btn-").removeClass("on");
		$(this).addClass("on");
	});


	nf_category.search_put_on(document.forms['fsearch1']);
});
</script>
<section class="sub_search">
	<div class="depth_wrap">
		<ul class="depth_btn search-tab-body-">
			<li class="<?php echo $_GET['code']=='area'? 'on' : '';?> btn-"><button type="button">Chọn vùng<span><i class="axi axi-keyboard-arrow-down"></i></span></button></li>
			<li class="<?php echo $_GET['code']=='job_part' ? 'on' : '';?> btn-"><button type="button">Chọn ngành/nghề nghiệp<span><i class="axi axi-keyboard-arrow-down"></i></span></button></li>
			<li class="<?php echo $_GET['code']=='etc' ? 'on' : '';?> btn-"><button type="button">Tìm kiếm chi tiết<span><i class="axi axi-keyboard-arrow-down"></i></span></button></li>
			<li>
				<div class="search_word">
					<p>Thuật ngữ tìm kiếm</p> <input type="text" name="search_keyword" value="<?php echo $nf_util->get_html($_GET['search_keyword']);?>">
					<button type="submit">Kiểm tra</button>
				</div>
			</li>
		</ul>
		
		<!--지역선택-->
		<div class="s_choice btn_category- p1 area-cate-body--" code="area" txt="지역" style="display:<?php echo $_GET['code']=='area' ? 'block' : 'none';?>;">
			<ul class="choice1">
				<?php
				$count = 0;
				if(is_array($cate_p_array['area'][0])) { foreach($cate_p_array['area'][0] as $k=>$v) {
					$on = $k==$_GET['area'][0] ? 'on' : '';
				?>
				<li class="<?php echo $on;?>"><button type="button" onClick="nf_category.btn_category(this, 1)" no="<?php echo $v['no'];?>"><?php echo $v['wr_name'];?></button></li>
				<?php
					$count++;
				} }
				?>
			</ul>
			<ul class="choice2" style="display:<?php echo $_GET['area'][0] ? 'block' : 'none';?>;">
			</ul>
		</div>
		<!--//지역선택-->


		<!--업직종선택 *지역선택과 스타일 같음*-->
		<div class="s_choice btn_category- p1 job_part-cate-body--" code="job_part" txt="업직종" style="display:<?php echo $_GET['code']=='job_part' ? 'block' : 'none';?>;">
			<ul class="choice1">
				<?php
				$count = 0;
				if(is_array($cate_p_array['job_part'][0])) { foreach($cate_p_array['job_part'][0] as $k=>$v) {
					if($nf_category->job_part_adult) {
						if($_GET['code']=='adult' && !$v['wr_adult']) continue;
						if($_GET['code']!='adult' && $v['wr_adult']) continue;
					}
					$on = $k==$_GET['job_part'][0] ? 'on' : '';
				?>
				<li class="<?php echo $on;?>"><button type="button" onClick="nf_category.btn_category(this<?php echo $nf_category->kind_arr['job_part'][1]>2 ? ', 1' : '';?>)" no="<?php echo $v['no'];?>"><?php echo $v['wr_name'];?></button></li>
				<?php
				} }?>
			</ul>
			<ul class="choice2" style="display:<?php echo ($_GET['job_part'][0]) ? 'block' : 'none';?>;">
			</ul>
			<ul class="choice3" style="display:<?php echo ($_GET['job_part'][0]) ? 'block' : 'none';?>;">
			</ul>
		</div>
		<!--//업직종선택-->

		<!--구인:상세검색-->
		<div class="s_choice" style="display:<?php echo $_GET['code']=='etc' ? 'block' : 'none';?>;">
			<table class="select_table">
				<colgroup>
					<col width="10%">
					<col width="40%">
					<col width="10%">
					<col width="40%">
				</colgroup>
				<tr>
					<th>Lương</th>
					<td colspan="3">
						<div class="btn_category- p2" code="job_pay" txt="급여">
							<ul class="choice2">
								<?php
								if(is_array($cate_p_array['job_pay'][0])) { foreach($cate_p_array['job_pay'][0] as $k=>$v) {
									$on = $k==$_GET['job_pay'][0] ? 'on' : '';
								?>
								<li class="<?php echo $on;?>"><button type="button" onClick="nf_category.btn_category(this, 1)" no="<?php echo $v['no'];?>"><?php echo $v['wr_name'];?></button></li>
								<?php
								} }?>
							</ul>
							<ul class="choice3" style="display:none;">
							</ul>
							</div>
							<?php
							if(is_array($nf_job->pay_conference)) { foreach($nf_job->pay_conference as $k=>$v) {
								$checked = is_array($_GET['wr_pay_conference']) && in_array($k, $_GET['wr_pay_conference']) ? 'checked' : '';
							?>
							<p class="label"><label><input type="checkbox" name="wr_pay_conference[]" value="<?php echo $k;?>" <?php echo $checked;?>> <?php echo $v;?></label></p>
							<?php
							} }?>
					</td>
				</tr>				
				<tr>
					<th>Theo chủ đề</th>	
					<td colspan="3">
						<ul class="li_float">
							<?php
							if(is_array($cate_p_array['job_tema'][0])) { foreach($cate_p_array['job_tema'][0] as $k=>$v) {
								$checked = is_array($_GET['wr_work_type']) && in_array($k, $_GET['wr_work_type']) ? 'checked' : '';
							?>
							<li><label><input type="checkbox" name="wr_work_type[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
							<?php
							} }?>
						</ul>
					</td>
				</tr>
				<tr>
					<th>Hệ thống đảm bảo</th>	
					<td colspan="3">
						<ul class="li_float">
							<?php
							if(is_array($cate_p_array['job_document'][0])) { foreach($cate_p_array['job_document'][0] as $k=>$v) {
								$checked = is_array($_GET['wr_target']) && in_array($k, $_GET['wr_target']) ? 'checked' : '';
							?>
							<li><label><input type="checkbox" name="wr_target[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
							<?php
							} }?>
						</ul>
					</td>
				</tr>
				<tr>
					<th>Ngày đăng ký</th>	
					<td colspan="3">
						<ul class="li_float">
							<li><label><input type="radio" name="regist_date" value="" <?php echo !$_GET['regist_date'] ? 'checked' : '';?>>전체</label></li>
							<li><label><input type="radio" name="regist_date" value="7day" <?php echo $_GET['regist_date']=='7day' ? 'checked' : '';?>>7일이내 등록</label></li>
							<li><label><input type="radio" name="regist_date" value="3day" <?php echo $_GET['regist_date']=='3day' ? 'checked' : '';?>>3일이내 등록</label></li>
							<li><label><input type="radio" name="regist_date" value="today" <?php echo $_GET['regist_date']=='today' ? 'checked' : '';?>>오늘등록</label></li>
						</ul>
					</td>
				</tr>
			</table>
		</div>
		<!--구인:상세검색-->


	</div>
	<!--//depth_wrap-->

	<div class="btn_area">
		<ul class="selection search-result-text-">
			
		</ul>
		<ul class="btn">
			<li><button type="button" onClick="nf_category.btn_category_reset(this)">Cài lại</button></li>
			<li><button>Tìm kiếm</button></li>
		</ul>
	</div>
</section>