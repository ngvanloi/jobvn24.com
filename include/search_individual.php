<script type="text/javascript">
var ch_career = function(el) {
	var display = el.value==='2' ? 'inline' : 'none';
	$(".wr_career-").css({"display":display});
}

var click_clean_age = function(el) {
	var form = document.forms['fsearch1'];
	if(el.checked) {
		$(form).find("[name='wr_age[]']").val("");
		$(form).find("[name='wr_age[]']").attr("disabled", "disabled");
	} else {
		$(form).find("[name='wr_age[]']").removeAttr("disabled");
	}
}

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
			<li class="<?php echo $_GET['code']=='area'? 'on' : '';?> btn-"><button type="button">지역선택<span><i class="axi axi-keyboard-arrow-down"></i></span></button></li>
			<li class="<?php echo $_GET['code']=='job_part' ? 'on' : '';?> btn-"><button type="button">업·직종 선택<span><i class="axi axi-keyboard-arrow-down"></i></span></button></li>
			<li class="<?php echo $_GET['code']=='etc' ? 'on' : '';?> btn-"><button type="button">상세검색<span><i class="axi axi-keyboard-arrow-down"></i></span></button></li>
			<li>
				<div class="search_word">
					<p>검색어</p> <input type="text" name="search_keyword" value="<?php echo $nf_util->get_html($_GET['search_keyword']);?>">
					<button type="submit">확인</button>
				</div>
			</li>
		</ul>

		<!--지역선택-->
		<div class="s_choice btn_category- p1" code="area" txt="지역" style="display:<?php echo $_GET['code']=='area' ? 'block' : 'none';?>;">
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
		<div class="s_choice btn_category- p1" code="job_part" txt="업직종" style="display:<?php echo $_GET['code']=='job_part' ? 'block' : 'none';?>;">
			<ul class="choice1">
				<?php
				$count = 0;
				if(is_array($cate_p_array['job_part'][0])) { foreach($cate_p_array['job_part'][0] as $k=>$v) {
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

		<!--인재검색-->
		<div class="s_choice" style="display:<?php echo $_GET['code']=='etc' ? 'block' : 'none';?>;">
			<table class="select_table">
				<colgroup>
					<col width="10%">
					<col width="40%">
					<col width="10%">
					<col width="40%">
				</colgroup>			
				<tr>
					<th>급여</th>
					<td colspan="3">
						<select name="wr_pay_type">
							<option value="">==급여==</option>
							<?php
							if(is_array($cate_p_array['job_pay'][0])) { foreach($cate_p_array['job_pay'][0] as $k=>$v) {
								$selected = $_GET['wr_pay_type']==$k ? 'selected' : '';
							?>
							<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select> 
						<input type="text" name="wr_pay" onkeyup="this.value=this.value.number_format()" value="<?php echo number_format(intval($nf_util->get_intval($_GET['wr_pay'])));?>">원 
						<select name="wr_pay_up">
							<option value="1" <?php echo $_GET['wr_pay_up']==='1' ? 'selected' : '';?>>이상</option>
							<option value="-1" <?php echo $_GET['wr_pay_up']==='-1' ? 'selected' : '';?>>이하</option>
						</select>
						<p class="label"><label><input type="checkbox" name="wr_pay_conference" value="1" <?php echo $_GET['wr_pay_conference'] ? 'checked' : '';?>>추후협의</label></p>
					</td>
				</tr>
				
				<tr class="select_wide">
					<th>나이</th>
					<td>
						<input type="text" name="wr_age[]" value="<?php echo $nf_util->get_html($_GET['wr_age'][0]);?>" style="width:50px;" />세↑
						~
						<input type="text" name="wr_age[]" value="<?php echo $nf_util->get_html($_GET['wr_age'][1]);?>" style="width:50px;" />세↓
						<p class="label"><label><input type="checkbox" name="wr_age_limit" onClick="click_clean_age(this)" value="1" <?php echo $_GET['wr_age_limit'] ? 'checked' : '';?>>무관</label></p>
					</td>
					<th>성별</th>
					<td>
						<ul class="li_float">
							<?php
							if(is_array($nf_util->gender_arr)) { foreach($nf_util->gender_arr as $k=>$v) {
								$checked = $_GET['wr_gender'][0]==$k ? 'checked' : '';
							?>
							<li><label><input type="checkbox" name="wr_gender[]" onClick="nf_util.one_check(this)" <?php echo $checked;?> value="<?php echo $k;?>"><?php echo $v;?></label></li>
							<?php
							} }?>
						</ul>
					</td>
				</tr>
				<tr>
					<th>테마</th>
					<td colspan="3">
						<ul class="li_float">
							<?php
							if(is_array($cate_p_array['indi_tema'][0])) { foreach($cate_p_array['indi_tema'][0] as $k=>$v) {
								$checked = is_array($_GET['wr_work_type']) && in_array($k, $_GET['wr_work_type']) ? 'checked' : '';
							?>
							<li><label><input type="checkbox" name="wr_work_type[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
							<?php
							} }?>
						</ul>
					</td>
				</tr>
				<tr>
					<th>등록일</th>	
					<td colspan="3">
						<ul class="li_float">
							<li><label><input type="radio" name="regist_date" value="" <?php echo !$_GET['regist_date'] ? 'checked' : '';?>>전체</label></li>
							<li><label><input type="radio" name="regist_date" value="7 day" <?php echo $_GET['regist_date']=='7 day' ? 'checked' : '';?>>7일이내 등록</label></li>
							<li><label><input type="radio" name="regist_date" value="3 day" <?php echo $_GET['regist_date']=='3 day' ? 'checked' : '';?>>3일이내 등록</label></li>
							<li><label><input type="radio" name="regist_date" value="today" <?php echo $_GET['regist_date']=='today' ? 'checked' : '';?>>오늘등록</label></li>
						</ul>
					</td>
				</tr>
			</table>
		</div>
		<!--//인재:상세검색-->
	</div>
	<!--//depth_wrap-->

	<div class="btn_area">
		<ul class="selection search-result-text-">
		</ul>
		<ul class="btn">
			<li><button type="button" onClick="nf_category.btn_category_reset(this)">초기화</button></li>
			<li><button>검색</button></li>
		</ul>
	</div>

</section>