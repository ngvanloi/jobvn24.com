<tr>
	<th>업직종</th>
	<td>
		<select title="1차직종 선택" class="check_seconds" name="wr_job_type[]" <?php echo $nf_category->kind_arr['job_part'][1]>1 ? 'onChange="nf_category.ch_category(this, 1)"' : '';?>>
			<option value="">= 1차 직종선택 =</option>
			<?php
			$checked = "";
			$job_part1 = $get_customized['customized']['wr_job_type'][0];
			if(is_array($cate_p_array['job_part'][0])) { foreach($cate_p_array['job_part'][0] as $k=>$v) {
				$selected = $get_customized['customized']['wr_job_type'][0]==$k ? 'selected' : '';
			?>
			<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
			<?php
			} }?>
		</select>
		<?php
		if($nf_category->kind_arr['job_part'][1]>=2) {
		?>
		<select title="2차직종 선택" class="check_seconds" name="wr_job_type[]" <?php echo $nf_category->kind_arr['job_part'][1]>2 ? 'onChange="nf_category.ch_category(this, 2)"' : '';?>>
			<option value="">= 2차 직종선택 =</option>
			<?php
			$checked = "";
			$job_part2 = $get_customized['customized']['wr_job_type'][1];
			if(is_array($cate_p_array['job_part'][$job_part1])) { foreach($cate_p_array['job_part'][$job_part1] as $k=>$v) {
				$selected = $get_customized['customized']['wr_job_type'][1]==$k ? 'selected' : '';
			?>
			<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
			<?php
			} }
			?>
		</select>
		<?php
		}
		if($nf_category->kind_arr['job_part'][1]>=3) {
		?>
		<select title="3차직종 선택" class="check_seconds" name="wr_job_type[]">
			<option value="">= 3차 직종선택 =</option>
			<?php
			$checked = "";
			if(is_array($cate_p_array['job_part'][$job_part2])) { foreach($cate_p_array['job_part'][$job_part2] as $k=>$v) {
				$selected = $get_customized['customized']['wr_job_type'][2]==$k ? 'selected' : '';
			?>
			<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
			<?php
			} }
			?>
		</select>
		<?php
		}?>
	</td>
</tr>
<tr>
	<th>근무지</th>
	<td>
		<select title="시·도 선택" name="wr_area[]" onChange="nf_category.ch_category(this, 1)" wr_type="area" class="MAB5 check_seconds">
			<option value="">시·도</option>
			<?php
			$checked = "";
			$area1 = $get_customized['customized']['wr_area'][0];
			$nf_category->get_area($area1);
			if(is_array($cate_p_array['area'][0])) { foreach($cate_p_array['area'][0] as $k=>$v) {
				$selected = $get_customized['customized']['wr_area'][0]==$v['wr_name'] ? 'selected' : '';
			?>
			<option value="<?php echo $v['wr_name'];?>" no="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
			<?php
			} }?>
		</select>
		<select title="시·군·구 선택" name="wr_area[]" onChange="nf_category.ch_category(this, 2)" wr_type="area" class="MAB5 check_seconds">
			<option value="">시·군·구</option>
			<?php
			$checked = "";
			$area2 = $get_customized['customized']['wr_area'][1];
			if(is_array($cate_area_array['SI'][$area1])) { foreach($cate_area_array['SI'][$area1] as $k=>$v) {
				$selected = $get_customized['customized']['wr_area'][1]==$v['wr_name'] ? 'selected' : '';
			?>
			<option value="<?php echo $v['wr_name'];?>" no="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
			<?php
			} }?>
		</select>		
	</td>
</tr>

<tr>
	<th>성별</th>
	<td>
		<ul class="li_float">
			<li><label><input type="checkbox" name="wr_gender[0]" value="0" <?php echo $get_customized['customized']['wr_gender'][0]==='0' ? 'checked' : '';?> onClick="nf_util.one_check(this)">성별무관</label></li>
			<?php
			if(is_array($nf_util->gender_arr)) { foreach($nf_util->gender_arr as $k=>$v) {
				$checked = $get_customized['customized']['wr_gender'][0]===(string)$k ? 'checked' : '';
			?>
			<li><label class="checkstyle1"><input type="checkbox" onClick="nf_util.one_check(this)" name="wr_gender[0]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
			<?php
			} }?>
		</ul>
	</td>
</tr>
<tr>
	<th>연령</th>
	<td>
		<ul class="li_float">
			<li><label class="checkstyle1"><input type="checkbox" name="wr_age_limit" value="0" <?php echo $get_customized['customized']['wr_age_limit']==='0' ? 'checked' : '';?> onClick="nf_util.one_check(this);nf_util.click_display('wr_age-', 'none')">연령무관</label></li>
			<li><label class="checkstyle1"><input type="checkbox" name="wr_age_limit" value="1" <?php echo $get_customized['customized']['wr_age_limit']==='1' ? 'checked' : '';?> onClick="nf_util.one_check(this);nf_util.click_display('wr_age-', 'inline')">연령제한있음</label></li>
		</ul>
		<p class="<?php echo $get_customized['customized']['wr_age_limit']==='1' ? '' : 'display-none-';?>" id="wr_age-">
			<input type="text" name="wr_age[]" style="width:60px;text-align:center;" value="<?php echo $get_customized['customized']['wr_age'][0];?>" hname="제한연령" />세 ~
			<input type="text" name="wr_age[]" style="width:60px;text-align:center;" value="<?php echo $get_customized['customized']['wr_age'][1];?>" hname="제한연령" />세
		</p>
	</td>
</tr>
