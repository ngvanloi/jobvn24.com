<?php
$my_resume_arr = array();
while($row=$db->afetch($resume_query)) {
	$my_resume_arr[$row['no']] = $row;
}

if(strpos($_SERVER['PHP_SELF'], '/nad/')!==false && !$re_row) {
?>
<div class="h_no">
	<h6>등록방법 및 회원기본정보<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<table>
		<colgroup>
			<col width="10%">
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo $icon_need;?>등록방법</th>
				<td>
					<label><input type="radio" name="input_type" value="self" checked>직접등록</label>
					<label><input type="radio" name="input_type" value="load" <?php echo $re_row['input_type']=='load' ? 'checked' : '';?>>불러오기</label>
				</td>
			</tr>
		</tbody>
		<tbody class="input_type- load-" style="display:<?php echo $re_row['input_type']=='load' ? 'table-row-group' : 'none';?>;">
			<tr><!--등록방법-불러오기 선택시 노출-->
				<th><?php echo $icon_need;?>회원선택</th>
				<td>
					<input type="text" id="find_member-" value="<?php echo $nf_util->get_html($re_row['wr_id']);?>" class="input10">
					<button type="button" class="basebtn blue" onClick="find_member('individual')">회원검색</button><span>이름,아이디,이메일로 검색</span>
					<ul class="calling MAT10 find_member_put-">
						<li>이름,아이디,이메일로 검색해주시기 바랍니다.</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th>이력서선택</th>
				<td>
					<select name="load_resume" onChange="nf_job.select_info(this)">
						<option value="">이력서선택</option>
						<?php
						if(is_array($my_resume_arr)) { foreach($my_resume_arr as $k=>$row) {
						?>
						<option value="<?php echo $row['no'];?>"><?php echo $row['wr_subject'];?></option>
						<?php
						} }?>
					</select>
				</td>
			</tr>
		</tbody>
		<tbody class="input_type- self-" style="display:<?php echo !$re_row || $re_row['input_type']=='self' ? 'table-row-group' : 'none';?>;">
			<tr>
				<th><?php echo $icon_need;?>이름</th>
				<td><input type="text" name="mb_name" value=""></td>
			</tr>
			<tr>
				<th>이력서사진 </th>
				<td>
					<div class="parent_file_upload-">
						<button type="button" class="gray basebtn" onClick="$('#file_upload-').click()">등록</button> <span class="blue"><b><?php echo strtoupper(implode(", ", $nf_util->photo_ext));?></b> 파일형식으로 <b>140*170픽셀, 100KB 용량 이내</b>의 파일을 권장합니다.</span>
						<div><input type="file" name="mb_photo" id="file_upload-" onChange="nf_util.ch_photo(this, $('.put_img-').find('img')[0])" style="display:none;" />
							<p class="my_img img put_img-"><img src="<?php echo NFE_URL;?>/images/no_imgicon.png" style="width:98px;height:119px;margin:0px;background-image:url('') !important;"><span><a href="#none" onClick="file_clean('#file_upload-')"><i class="axi axi-close"></i></a></span></p>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>생년월일/성별</th>
				<td>
					<input type="text" name="mb_birth" value="" class="datepicker_inp" style="width:100px;text-align:center;" />
					<em class="MAL10">
						<?php
						if(is_array($nf_util->gender_arr)) { foreach($nf_util->gender_arr as $k=>$v) {
							$checked = $_GET['wr_gender']==$k ? 'checked' : '';
						?>
						<label><input type="radio" name="mb_gender" <?php echo $checked;?> value="<?php echo $k;?>"><?php echo $v;?></label>
						<?php
						} }?>
					</em>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>연락처</th>
				<td>
					<input type="text" name="mb_phone[]" class="input10" hname="전화번호" <?php echo $icon_need ? 'needed' : '';?>> -
					<input type="text" name="mb_phone[]" class="input10" hname="전화번호" <?php echo $icon_need ? 'needed' : '';?>> -
					<input type="text" name="mb_phone[]" class="input10" hname="전화번호">
					<span class="bojotext">* 구인정보에 사용됩니다.</span>
				</td>
			</tr>
			<tr>
				<th>휴대폰</th>
				<td>
					<select name="mb_hphone[]" hname="휴대폰 국번">
					<?php
					if(is_array($nf_member->hphone_arr)) { foreach($nf_member->hphone_arr as $k=>$v) {
						$selected = $resume_info['hphone_arr'][0]==$k ? 'selected' : '';
					?>
					<option value="<?php echo $v;?>" <?php echo $selected;?>><?php echo $v;?></option>
					<?php } }?>
					</select> -
					<input type="text" name="mb_hphone[]" class="input10" hname="휴대폰 앞자리"> -
					<input type="text" name="mb_hphone[]" class="input10" hname="휴대폰 앞자리">
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>주소</th>
				<td class="area-address-">
					<input type="text" name="post" id="sample2_postcode" class="input10 post-" <?php echo $icon_need ? 'needed' : '';?>><button type="button" onClick="sample2_execDaumPostcode(this)" class="gray basebtn MAL5">주소검색</button><br>
					<input type="text" class="MAT5 address1-" name="mb_address0" <?php echo $icon_need ? 'needed' : '';?> id="sample2_address">
					<input type="text" class="MAT5" name="mb_address1" <?php echo $icon_need ? 'needed' : '';?> id="sample2_extraAddress">
					<?php
					include NFE_PATH.'/include/post.daum.php';
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>이메일</th>
				<td>
					<input type="text" class="input10" name="mb_email[]" value="" hname="이메일" <?php echo $icon_need ? 'needed' : '';?>> @
					<input type="text" class="input10 put-email-" name="mb_email[]" value="" hname="이메일 서비스 제공자" <?php echo $icon_need ? 'needed' : '';?>>
					<select onChange="nf_util.ch_email(this, '.put-email-')">
						<option value="">직접입력</option>
						<?php
						$checked = "";
						$area1 = "";
						if(is_array($cate_p_array['email'][0])) { foreach($cate_p_array['email'][0] as $k=>$v) {
						?>
						<option value="<?php echo $v['wr_name'];?>"><?php echo $v['wr_name'];?></option>
						<?php
						} }?>
					</select>
					<span class="bojotext">* 구인정보에 사용됩니다.</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php
}?>

<div class="title">
	<div class="side_con">
		<h6>이력서 제목</h6>
		<div class="h_right">
			<select title="이력서 불러오기" onChange="nf_job.select_info(this)">
				<option value="">이력서 불러오기</option>
				<?php
				if(is_array($my_resume_arr)) { foreach($my_resume_arr as $k=>$row) {
				?>
				<option value="<?php echo $row['no'];?>"><?php echo $row['wr_subject'];?></option>
				<?php
				} }?>
			</select>
		</div>
	</div>
	<table>
		<tr>
			<th><input type="text" name="wr_subject" hname="이력서 제목" needed value="<?php echo $nf_util->get_html($re_row['wr_subject']);?>" placeholder="이력서 제목을 입력해주세요."></th>
		</tr>
	</table>
</div>

<div class="box_wrap">
	<h6>희망근무조건<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tr>
				<th><?php echo $icon_need;?>근무지</th>
				<td>
					<span class="blue bojotext">* 최대 3개 등록가능</span>
					<div class="check_area- category_group-">
					<?php
					for($i=0; $i<$resume_info['area_cnt']; $i++) {
						$mt5 = $i>0 ? 'MAT5' : '';
						$area_arr = explode(",", $resume_info['area_arr'][$i]);
					?>
					<div class="parent- <?php echo $mt5;?> MAB5">
						<select name="wr_area[<?php echo $i;?>][]" hname="근무지" needed onChange="nf_category.ch_category(this, 1)" wr_type="area" class="MAB5 check_seconds">
							<option value="">시·도</option>
							<?php
							$checked = "";
							$area1 = $area_arr[1];
							$nf_category->get_area($area1);
							if(is_array($cate_p_array['area'][0])) { foreach($cate_p_array['area'][0] as $k=>$v) {
								$selected = $area1==$v['wr_name'] ? 'selected' : '';
							?>
							<option value="<?php echo $v['wr_name'];?>" no="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select>
						<?php
						$area2 = $area_arr[2];
						?>
						<select name="wr_area[<?php echo $i;?>][]" hname="근무지" needed onChange="nf_category.ch_category(this, 2)" wr_type="area" class="MAB5 check_seconds">
							<option value="">시·군·구</option>
							<option value="all" <?php echo $area2=='전체' ? 'selected' : '';?>>전체</option>
							<?php
							$checked = "";
							if(is_array($cate_area_array['SI'][$area1])) { foreach($cate_area_array['SI'][$area1] as $k=>$v) {
								$selected = $area2==$v['wr_name'] ? 'selected' : '';
							?>
							<option value="<?php echo $v['wr_name'];?>" no="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select><button type="button" onClick="nf_util.clone_tag(this, '.check_area-', 3)" class="gray basebtn regist_btn1 ">추가</button><br>
						<!-- <div class="MAT5 MAL3"><label><input type="checkbox" name="wr_area[<?php echo $i;?>][]" <?php echo $area_arr[3] ? 'checked' : '';?> value="1"> 재택근무 가능</label></div> -->
					</div>
					<?php }?>
					</div>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>업·직종</th>
				<td>
					<span class="blue bojotext">* 최대3개 등록가능</span>
					<div class="check_job_part- category_group-">
						<?php
						for($i=0; $i<$resume_info['job_type_cnt']; $i++) {
							$job_type_arr = explode(",", $resume_info['job_type_arr'][$i]);
						?>
						<div class="parent-" tag_name="wr_job_type">
							<select class="check_seconds" hname="업·직종" needed name="wr_job_type[<?php echo $i;?>][]" <?php echo $nf_category->kind_arr['job_part'][1]>1 ? 'onChange="nf_category.ch_category(this, 1)"' : '';?>>
								<option value="">= 1차 직종선택 =</option>
								<?php
								$checked = "";
								$job_part1 = $job_type_arr[1];
								if(is_array($cate_p_array['job_part'][0])) { foreach($cate_p_array['job_part'][0] as $k=>$v) {
									$selected = $job_part1==$k ? 'selected' : '';
								?>
								<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
								<?php
								} }?>
							</select>
							<?php
							if($nf_category->kind_arr['job_part'][1]>=2) {
							?>
							<select class="check_seconds" hname="업·직종"  name="wr_job_type[<?php echo $i;?>][]" <?php echo $nf_category->kind_arr['job_part'][1]>2 ? 'onChange="nf_category.ch_category(this, 2)"' : '';?>>
								<option value="">= 2차 직종선택 =</option>
								<?php
								$checked = "";
								$job_part2 = $job_type_arr[2];
								if(is_array($cate_p_array['job_part'][$job_part1])) { foreach($cate_p_array['job_part'][$job_part1] as $k=>$v) {
									$selected = $job_part2==$k ? 'selected' : '';
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
							<select class="check_seconds" hname="업·직종"  name="wr_job_type[<?php echo $i;?>][]">
								<option value="">= 3차 직종선택 =</option>
								<?php
								$checked = "";
								if(is_array($cate_p_array['job_part'][$job_part2])) { foreach($cate_p_array['job_part'][$job_part2] as $k=>$v) {
									$selected = $job_type_arr[3]==$k ? 'selected' : '';
								?>
								<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
								<?php
								} }
								?>
							</select>
							<?php
							}?>
							<button type="button" onClick="nf_util.clone_tag(this, '.check_job_part-', 3)" class="gray basebtn regist_btn1 "><?php echo $i===0 ? '추가' : '삭제';?></button>
						</div>
						<?php }?>
					</div>
				</td>
			</tr>
			<!-- <tr>
				<th><?php echo $icon_need;?>근무일시</th>
				<td>
					<select name="wr_date" hname="근무기간" needed>
						<option value="">-- 근무기간 --</option>
						<?php
						$count = 0;
						//if(is_array($cate_p_array['job_date'][0])) { foreach($cate_p_array['job_date'][0] as $k=>$v) {
							//$selected = $k==$re_row['wr_date'] ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
						<?php
							//$count++;
						//} }?>
					</select>
					<select name="wr_week" hname="근무요일" needed>
						<option value="">-- 근무요일 --</option>
						<?php
						//$count = 0;
						//if(is_array($cate_p_array['job_week'][0])) { foreach($cate_p_array['job_week'][0] as $k=>$v) {
							//$selected = $k==$re_row['wr_week'] ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
						<?php
							//$count++;
						//} }?>
					</select>
					<select name="wr_time" hname="근무시간" needed>
						<option value="">-- 근무시간 --</option>
						<?php
						//$count = 0;
						//if(is_array($cate_p_array['job_time'][0])) { foreach($cate_p_array['job_time'][0] as $k=>$v) {
							//$selected = $k==$re_row['wr_time'] ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
						<?php
							//$count++;
						//} }?>
					</select>
					<div class="MAT5 MAL3">
						<label><input type="checkbox" name="wr_work_direct" value="1" <?php echo $re_row['wr_work_direct'] ? 'checked' : '';?>>즉시출근가능</label>
					</div>	
				</td>
			</tr> -->
			
			<tr>
				<th><?php echo $icon_need;?>급여</th>
				<td>
					<!-- <span class="bojotext">* 최저임급 : <?php echo number_format(intval($env['time_pay']));?>원</span> -->
					<select name="wr_pay_type" hname="급여" <?php echo $re_row['wr_pay_conference'] ? 'disabled' : 'needed';?>>
						<option value="">급여</option>
						<?php
						if(is_array($cate_p_array['job_pay'][0])) { foreach($cate_p_array['job_pay'][0] as $k=>$v) {
							$selected = $re_row['wr_pay_type']==$k ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
						<?php
						} }?>
					</select> 
					<input type="text" name="wr_pay" hname="급여" <?php echo $re_row['wr_pay_conference'] ? 'disabled' : 'needed';?> value="<?php echo $nf_util->get_html($re_row['wr_pay']);?>" class="input10"> 
					<div class="MAT5 MAL3">
						<label class="MAL5"><input type="checkbox" onClick="nf_job.click_pay_conference(this)" name="wr_pay_conference" value="1" <?php echo $re_row['wr_pay_conference'] ? 'checked' : '';?>>추후협의</label> 
					</div>
				</td>
			</tr>
			<tr>
				<th>테마선택</th>
				<td>
					<ul class="li_float">
						<?php
						if(is_array($cate_p_array['indi_tema'][0])) { foreach($cate_p_array['indi_tema'][0] as $k=>$v) {
							$checked = is_array($resume_info['work_type_arr']) && in_array($k, $resume_info['work_type_arr']) ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_work_type[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
						<?php
						} }?>
					</ul>
				</td>
			</tr>
			<!-- <tr>
				<th><?php echo $icon_need;?>근무형태</th>
				<td>
					<ul class="li_float">
						<?php
						//if(is_array($cate_p_array['job_type'][0])) { foreach($cate_p_array['job_type'][0] as $k=>$v) {
							//$checked = is_array($resume_info['work_type_arr']) && in_array($k, $resume_info['work_type_arr']) ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_work_type[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
						<?php
						//} }?>
					</ul>
				</td>
			</tr> -->
		</table>
	</div>
</div>

<?php
if($register_form_arr['register_form_resume']['학력사항']) {
?>
<div class="edh box_wrap">
	<h6>학력사항<span> <em class="ess">*</em>표시는 필수 입력사항 - 학력사항을 수정하면 모든 이력서의 학력사항이 수정됩니다.</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tr>
				<th><?php if($register_form_arr['register_form_resume']['학력사항']['wr_0']) echo $icon_need;?>학력</th>
				<td>
					<select name="wr_school_ability" onChange="nf_job.ch_school(this)" hname="학력" <?php echo $register_form_arr['register_form_resume']['학력사항']['wr_0'] ? 'needed' : '';?>>
						<option value="">-- 학력선택 --</option>
						<?php
						$count = 0;
						if(is_array($nf_job->school_part)) { foreach($nf_job->school_part as $k=>$v) {
							$selected = $resume_individual['wr_school_ability']==$k ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v;?></option>
						<?php
							$count++;
						} }
						?>
					</select>
					<select name="wr_school_ability_end" hname="학력상태" <?php echo $register_form_arr['register_form_resume']['학력사항']['wr_0'] ? 'needed' : '';?>>
						<option value="">상태</option>
						<?php
						if(is_array($nf_job->school_graduation)) { foreach($nf_job->school_graduation as $k=>$v) {
							$selected = $resume_individual['wr_school_ability_end']===(string)$k ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v;?></option>
						<?php
						} }?>
					</select>
					<div class="MAT5 MAL3">
						<ul class="li_float MAT10">
							<li>입력할 학력선택 : </li>
								<?php
								if(is_array($nf_job->school_part)) { foreach($nf_job->school_part as $k=>$v) {
									$checked = is_array($resume_individual['school_type_arr']) && in_array($k, $resume_individual['school_type_arr']) ? 'checked' : '';
								?>
								<li><label><input type="checkbox" onClick="nf_job.click_school_chk(this)" name="wr_school_type[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
								<?php
								} }?>
							</ul>
					</div>
				</td>
			</tr>
			<?php
			$count = 0;
			if(is_array($nf_job->school_part)) { foreach($nf_job->school_part as $k=>$v) {
			?>
			<tr class="school_level" school_level="<?php echo $k;?>" style="display:<?php echo in_array($k, $resume_individual['school_type_arr']) ? 'table-row' : 'none';?>;">
				<th><?php echo $v;?></th>
				<td class="check_school_part- category_group-"><!--기존것 참고해서 프로그램-->
					<?php
					if(is_array($resume_individual['wr_school_info'])) $length = count($resume_individual['wr_school_info'][$k]['name']);
					if($length<=0) $length = 1;
					for($k_num=0; $k_num<$length; $k_num++){
					?>
					<div class="parent-">
						<input type="text" name="wr_school_arr[<?php echo $k;?>][name][]" value="<?php echo $nf_util->get_html($resume_individual['wr_school_info'][$k]['name'][$k_num]);?>" class="input10" placeholder="출신학교입력">
						<?php
						if($k>=4) {
						?>
						<input type="text" name="wr_school_arr[<?php echo $k;?>][specialize][]" value="<?php echo $nf_util->get_html($resume_individual['wr_school_info'][$k]['specialize'][$k_num]);?>" class="input10" placeholder="전공입력">
						<?php
						}
						if($k>=6) {
						?>
						<select name="wr_school_arr[<?php echo $k;?>][grade][]">
							<option value="">학위</option>
							<?php
							if(is_array($nf_job->school_grade)) { foreach($nf_job->school_grade as $k2=>$v2) {
								$selected = $resume_individual['wr_school_info'][$k]['grade'][$k_num]==$k2 ? 'selected' : '';
							?>
							<option value="<?php echo $k2;?>" <?php echo $selected;?>><?php echo $v2;?></option>
							<?php
							} }?>
						</select>
						<?php
						}?>
						<select name="wr_school_arr[<?php echo $k;?>][syear][]">
							<option value="">년도</option>
							<?php
							for($i=date("Y"); $i>=1900; $i--) {
								$selected = $resume_individual['wr_school_info'][$k]['syear'][$k_num]==$i ? 'selected' : '';
							?>
							<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
							<?php
							}?>
						</select>년~
						<select name="wr_school_arr[<?php echo $k;?>][eyear][]">
							<option value="">년도</option>
							<?php
							for($i=date("Y"); $i>=1900; $i--) {
								$selected = $resume_individual['wr_school_info'][$k]['eyear'][$k_num]==$i ? 'selected' : '';
							?>
							<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
							<?php
							}?>
						</select>년
						<select name="wr_school_arr[<?php echo $k;?>][graduation][]">
							<option value="">상태</option>
							<?php
							if(is_array($nf_job->school_graduation)) { foreach($nf_job->school_graduation as $k2=>$v2) {
								$selected = $resume_individual['wr_school_info'][$k]['graduation'][$k_num]===(string)$k2 ? 'selected' : '';
							?>
							<option value="<?php echo $k2;?>" <?php echo $selected;?>><?php echo $v2;?></option>
							<?php
							} }?>
						</select>

						<?php
						if($k>=4) {
						?>
						<button type="button" onclick="nf_util.clone_tag(this, '.check_school_part-', 5)" class="gray basebtn regist_btn1 "><?php echo $k_num>0 ? '삭제' : '추가';?></button>
						<?php
						}?>
					</div>
					<?php
					}?>
				</td>
			</tr>
			<?php
			} }?>
		</table>
	</div>
</div>
<?php
}?>

<?php if($c_check_ == '1') { //영역을 삭제할려고 임의로 변수값 만듬; ?>
<div class="carrerbox box_wrap">
	<h6>경력사항 <span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tbody>
			<tr>
				<th>경력</th>
				<td colspan="2">
					<label><input type="checkbox" name="wr_career_use" <?php echo $resume_individual['wr_career_use'] ? 'checked' : '';?> onClick="nf_job.click_career(this)" value="1">경력있음</label>
				</td>
			</tr>
			</tbody>
			<tbody class="check_career-" style="display:<?php echo $resume_individual['wr_career_use'] ? 'table-row-group' : 'none';?>">
			<?php
			if(is_array($resume_individual['career_info']['name'])) $length = count($resume_individual['career_info']['name']);
			if($length<=0) $length = 1;
			for($k_num=0; $k_num<$length; $k_num++) {
			?>
			<tr class="parent- career_list">
				<th><?php echo $icon_need;?>경력사항<br><button type="button" onClick="nf_util.clone_tag(this, '.check_career-', 10)" class="gray basebtn regist_btn2 "><?php echo $k_num>0 ? '삭제' : '추가';?></button></th>
				<td>
					<div>
						<dl>
							<dt><?php echo $icon_need;?>업소명</dt>
							<dd><input type="text" name="wr_career_arr[name][<?php echo $k_num;?>]" value="<?php echo $nf_util->get_html($resume_individual['career_info']['name'][$k_num]);?>" class="input10 check_seconds"></dd>
						</dl>
						<dl>
							<dt><?php echo $icon_need;?>근무직종</dt>
							<dd>
								<div class="check_career_job_part- category_group-">
									<?php
									for($i=0; $i<1; $i++) {
										$job_type_arr = explode(",", $resume_info['job_type_arr'][$i]);
									?>
									<div class="parent-">
										<select class="check_seconds" name="wr_career_arr[job_type][<?php echo $k_num;?>][]" onChange="nf_category.ch_category(this, 1)">
											<option value="">= 1차 직종선택 =</option>
											<?php
											$job_part1 = $resume_individual['career_info']['job_type'][$k_num][0];
											if(is_array($cate_p_array['job_part'][0])) { foreach($cate_p_array['job_part'][0] as $k=>$v) {
												$selected = $job_part1==$k ? 'selected' : '';
											?>
											<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
											<?php
											} }?>
										</select>
										<select class="check_seconds" name="wr_career_arr[job_type][<?php echo $k_num;?>][]" onChange="nf_category.ch_category(this, 2)">
											<option value="">= 2차 직종선택 =</option>
											<?php
											$job_part2 = $resume_individual['career_info']['job_type'][$k_num][1];
											if(is_array($cate_p_array['job_part'][$job_part1])) { foreach($cate_p_array['job_part'][$job_part1] as $k=>$v) {
												$selected = $job_part2==$k ? 'selected' : '';
											?>
											<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
											<?php
											} }
											?>
										</select>
										<select class="check_seconds" name="wr_career_arr[job_type][<?php echo $k_num;?>][]">
											<option value="">= 3차 직종선택 =</option>
											<?php
											if(is_array($cate_p_array['job_part'][$job_part2])) { foreach($cate_p_array['job_part'][$job_part2] as $k=>$v) {
												$selected = $resume_individual['career_info']['job_type'][$k_num][2]==$k ? 'selected' : '';
											?>
											<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
											<?php
											} }
											?>
										</select>
									</div>
									<?php }?>
								</div>
							</dd>
						</dl>
						<dl>
							<dt><?php echo $icon_need;?>근무기간</dt>
							<dd>
								<select class="check_seconds" name="wr_career_arr[syear][<?php echo $k_num;?>]" hname="근무기간 시작년도">
									<option value="">년</option>
									<?php
									for($i=date("Y"); $i>=1900; $i--) {
										$selected = $resume_individual['career_info']['syear'][$k_num]==$i ? 'selected' : '';
									?>
									<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
									<?php
									}?>
								</select>
								년
								<select class="check_seconds" name="wr_career_arr[smonth][<?php echo $k_num;?>]" hname="근무기간 시작월">
									<option value="">월</option>
									<?php
									for($i=1; $i<=12; $i++) {
										$selected = $resume_individual['career_info']['smonth'][$k_num]==$i ? 'selected' : '';
									?>
									<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
									<?php
									}?>
								</select>
								월 ~
								<select class="check_seconds" name="wr_career_arr[eyear][<?php echo $k_num;?>]" hname="근무기간 마지막년도">
									<option value="">년</option>
									<?php
									for($i=date("Y"); $i>=1900; $i--) {
										$selected = $resume_individual['career_info']['eyear'][$k_num]==$i ? 'selected' : '';
									?>
									<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
									<?php
									}?>
								</select>
								년
								<select class="check_seconds" name="wr_career_arr[emonth][<?php echo $k_num;?>]" hname="근무기간 마지막월">
									<option value="">월</option>
									<?php
									for($i=1; $i<=12; $i++) {
										$selected = $resume_individual['career_info']['emonth'][$k_num]==$i ? 'selected' : '';
									?>
									<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
									<?php
									}?>
								</select>
								월
							</dd>
						</dl>
						<dl>
							<dt><?php echo $icon_need;?>담당업무</dt>
							<dd><input class="check_seconds" type="text" name="wr_career_arr[industry][<?php echo $k_num;?>]" value="<?php echo $nf_util->get_html($resume_individual['career_info']['industry'][$k_num]);?>" hname="담당업무"></dd>
						</dl>
						<dl>
							<dt>상세업무 내용</dt>
							<dd><input type="text" class="check_seconds" name="wr_career_arr[content][<?php echo $k_num;?>]" value="<?php echo $nf_util->get_html($resume_individual['career_info']['content'][$k_num]);?>"></dd>
						</dl>
					</div>
				</td>
			</tr>
			<?php
			}?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>
<div class="self_intro box_wrap">
	<h6>자기소개서 <span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<textarea type="editor" name="wr_introduce" style="height:300px;" hname="자기소개서" needed nofocus><?php echo stripslashes($re_row['wr_introduce']);?></textarea>
	<!-- <h5>첨부파일<span class="blue MAB10">* 파일당 00MB 용량 이내의 파일만 등록 가능합니다.</span></h5>
	<ul class="file check_attach-">
		<?php
		//if(is_array($resume_info['attach_arr'])) $length = count($resume_info['attach_arr']);
		//if($length<=0) $length = 1;
		//for($i=0; $i<$length; $i++) {
			//$get_ext = $nf_util->get_ext($resume_info['attach_arr'][$i]['file']);
		?>
		<li class="parent-">
			<input type="file" name="wr_attach[]">
			<?php //if(is_file(NFE_PATH.'/data/resume/'.$resume_info['attach_arr'][$i]['file'])) {?>
			<a class="not_copy MAL10" href="<?php echo NFE_URL;?>/include/regist.php?mode=download_resume_file&no=<?php echo $re_row['no'];?>&k=<?php echo $i;?>"><button type="button" class="basebtn gray">다운로드</button></a>
			<?php //}?>
			<button type="button" onClick="nf_util.clone_tag(this, '.check_attach-', 3)" class="basebtn gray"><?php echo $i===0 ? '파일추가' : '파일삭제';?></button>
		</li>
		<?php
		//}?>
	</ul> -->

	<!-- <h5>동영상<span class="blue">* iframe 형식으로 동영상을 넣으실 수 있습니다.</span></h5>
	<textarea name="wr_movie"><?php //echo stripslashes($re_row['wr_movie']);?></textarea> -->
</div>

<div class="setting box_wrap">
	<h6>이력서 설정 <span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tr>
				<th><?php echo $icon_need;?>공개여부</th>
				<td>
					<dl>
						<dt>이력서</dt>
						<dd>
							<ul>
								<li><label><input type="radio" name="wr_open" value="1" checked>공개</label></li>
								<li><label><input type="radio" name="wr_open" value="0" <?php echo $re_row && !$re_row['wr_open'] ? 'checked' : '';?>>비공개</label></li>
							</ul>
						</dd>
					</dl>
					<!-- <dl>
						<dt>홈페이지</dt>
						<dd>
							<ul>
								<li><label><input type="radio" name="is_homepage" value="1" checked>공개</label></li>
								<li><label><input type="radio" name="is_homepage" value="0" <?php //echo $re_row && !$re_row['is_homepage'] ? 'checked' : '';?>>비공개</label></li>
							</ul>
						</dd>
					</dl> -->
					<dl>
						<dt>연락처</dt>
						<dd>
							<ul>
								<li><label><input type="radio" name="is_phone" value="1" checked>공개</label></li>
								<li><label><input type="radio" name="is_phone" value="0" <?php echo $re_row && !$re_row['is_phone'] ? 'checked' : '';?>>비공개</label></li>
							</ul>
						</dd>
					</dl>
					<dl>
						<dt>주소</dt>
						<dd>
							<ul>
								<li><label><input type="radio" name="is_address" value="1" checked>공개</label></li>
								<li><label><input type="radio" name="is_address" value="0" <?php echo $re_row && !$re_row['is_address'] ? 'checked' : '';?>>비공개</label></li>
							</ul>
						</dd>
					</dl>
					<dl>
						<dt>이메일</dt>
						<dd>
							<ul>
								<li><label><input type="radio" name="is_email" value="1" checked>공개</label></li>
								<li><label><input type="radio" name="is_email" value="0" <?php echo $re_row && !$re_row['is_email'] ? 'checked' : '';?>>비공개</label></li>
							</ul>
						</dd>
					</dl>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>연락가능시간</th>	
				<td colspan="4">
					<select name="wr_calltime[]" hname="연락가능시간"  <?php echo $re_row['wr_calltime_always'] ? 'disabled' : 'needed';?>>
						<option value="">시간</option>
						<?php
						for($i=0; $i<24; $i++) {
							$hour_int = sprintf("%02d", $i);
							$seletced = $resume_info['calltime_arr'][0]==$hour_int ? 'selected' : '';
						?>
						<option value="<?php echo $hour_int;?>" <?php echo $seletced;?>><?php echo $hour_int;?></option>
						<?php
						}?>
					</select>
					~
					<select name="wr_calltime[]" hname="연락가능시간" <?php echo $re_row['wr_calltime_always'] ? 'disabled' : 'needed';?>>
						<option value="">시간</option>
						<?php
						for($i=0; $i<24; $i++) {
							$hour_int = sprintf("%02d", $i);
							$seletced = $resume_info['calltime_arr'][1]==$hour_int ? 'selected' : '';
						?>
						<option value="<?php echo $hour_int;?>" <?php echo $seletced;?>><?php echo $hour_int;?></option>
						<?php
						}?>
					</select>
					<div class="MAT5 MAL3">
						<label><input type="checkbox" name="wr_calltime_always" onClick="nf_job.click_calltime_always(this)" value="1" <?php echo $re_row['wr_calltime_always'] ? 'checked' : '';?>>언제나가능</label>
					</div>
				</td>
			</tr>
			<tr>
				<th>SNS 메신져</th>
				<td>
					<select name="wr_messanger" hname="SNS 메신져">
						<option value="">선택</option>
						<?php
						if(is_array($cate_p_array['job_listed'][0])) { foreach($cate_p_array['job_listed'][0] as $k=>$v) {
							$selected = $re_row['wr_messanger']==$k ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
						<?php
						} }?>
					</select> 
					<input type="text" name="wr_messanger_id" hname="메신져 아이디" value="<?php echo $nf_util->get_html($re_row['wr_messanger_id']);?>" class="input10"> 
				</td>
			</tr>

		</table>
	</div>
</div>

<!-- <div class="choice box_wrap"> -->
	<!-- <h6>선택사항</h6>
	<ul class="choice_box">
		<?php
		//if(is_array($nf_job->resume_select_type)) { foreach($nf_job->resume_select_type as $k=>$v) {
			//$checked = $re_row['wr_'.$k.'_use'] ? 'checked' : '';
		?>
		<li><label><input type="checkbox" name="resume_select[]" <?php echo $checked;?> onClick="nf_job.click_resume_select(this)" value="<?php echo $k;?>"><?php echo $v;?></label></li>
		<?php
		//} }?>
	</ul> -->


	<?php
	if($register_form_arr['register_form_resume']['자격증']) {
	?>
	<div class="check_license_opener-" style="display:<?php echo $re_row['wr_license_use'] ? 'block' : 'none';?>">
		<!--자격증-->
		<div class="common_box license">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tbody class="check_license-">
				<?php
				if(is_array($resume_individual['license_arr']['name'])) $length = count($resume_individual['license_arr']['name']);
				if($length<=0) $length = 1;
				for($k_num=0; $k_num<$length; $k_num++) {
				?>
				<tr class="parent-">
					<th><?php if($register_form_arr['register_form_resume']['자격증']['wr_0']) echo $icon_need;?>자격증<br><button type="button" onClick="nf_util.clone_tag(this, '.check_license-', 10)" class="gray s_basebtn MAT10 regist_btn2"><?php echo $k_num>0 ? '삭제' : '추가';?></button></th>	
					<td>
						<div>
							<dl>
								<dt><?php if($register_form_arr['register_form_resume']['자격증']['wr_0']) echo $icon_need;?>자격증명</dt>
								<dd><input type="text" name="wr_license[name][]" value="<?php echo $nf_util->get_html($resume_individual['license_arr']['name'][$k_num]);?>"></dd>
							</dl>
							<dl>
								<dt><?php if($register_form_arr['register_form_resume']['자격증']['wr_0']) echo $icon_need;?>발행처</dt>
								<dd><input type="text" name="wr_license[public][]" value="<?php echo $nf_util->get_html($resume_individual['license_arr']['public'][$k_num]);?>"></dd>
							</dl>
							<dl>
								<dt><?php if($register_form_arr['register_form_resume']['자격증']['wr_0']) echo $icon_need;?>취득년도</dt>
								<dd>
									<select name="wr_license[date][]">
										<option value="">년</option>
										<?php
										for($i=date("Y"); $i>=1900; $i--) {
											$selected = $resume_individual['license_arr']['date'][$k_num]==$i ? 'selected' : '';
										?>
										<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
										<?php
										}?>
									</select> 년
								</dd>
							</dl>
						</div>
					</td>
				</tr>
				<?php
				}?>
			</tbody>
		</table>
		</div>
		<!--//자격증-->
	</div>
	<?php
	}?>

	<?php
	if($register_form_arr['register_form_resume']['외국어능력']) {
	?>
	<div class="check_language_opener-" style="display:<?php echo $re_row['wr_language_use'] ? 'block' : 'none';?>">
		<!--외국어능력-->
		<div class="common_box language">
			<table class="com_table">
				<colgroup>
					<col width="10%">
				</colgroup>
				<tbody class="check_language-">
					<?php
					if(is_array($resume_individual['language_arr']['name'])) $length = count($resume_individual['language_arr']['name']);
					if($length<=0) $length = 1;
					for($k_num=0; $k_num<$length; $k_num++) {
					?>
					<tr class="parent-">
						<th><?php if($register_form_arr['register_form_resume']['외국어능력']['wr_0']) echo $icon_need;?>외국어능력<br><button type="button" onClick="nf_util.clone_tag(this, '.check_language-', 10)" this_child="check_language_exam-" class="gray s_basebtn MAT10 regist_btn2"> <?php echo $k_num>0 ? '삭제' : '추가';?></button></th>
						<td>
							<div>
								<dl>
									<dt><?php if($register_form_arr['register_form_resume']['외국어능력']['wr_0']) echo $icon_need;?>외국어</dt>
									<dd class="parent-">
										<select name="wr_language[name][<?php echo $k_num;?>]" class="check_seconds MAR10">
											<option value="">외국어선택</option>
											<?php
											if(is_array($cate_p_array['job_language'][0])) { foreach($cate_p_array['job_language'][0] as $k=>$v) {
												$selected = $resume_individual['language_arr']['name'][$k_num]==$k ? 'selected' : '';
											?>
											<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
											<?php
											} }?>
										</select>
										<ul class="class">
											<?php
											if(is_array($nf_job->language_arr)) { foreach($nf_job->language_arr as $k=>$v) {
												$checked = $resume_individual['language_arr']['level'][$k_num]==$k ? 'checked' : '';
											?>
											<li><label><input class="check_seconds" type="radio" name="wr_language[level][<?php echo $k_num;?>]" onClick="nf_job.click_language_level(this)" <?php echo $checked;?> value="<?php echo $k;?>"><?php echo $v;?></label></li>
											<?php
											} }?>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>어학연수</dt>
									<dd>
										<ul class="li_float">
											<li><label><input type="checkbox" class="check_seconds" name="wr_language[study][<?php echo $k_num;?>]" <?php echo $resume_individual['language_arr']['study'][$k_num] ? 'checked' : '';?> value="1" onClick="nf_job.click_language_study(this)" />어학연수 경험있음</label></li>
											<li><span class="language_study-" style="display:;">
											<select class="check_seconds" name="wr_language[study_date][<?php echo $k_num;?>]">
											<option value="">연수기간 선택</option>
											<option value="6 month" <?php echo $resume_individual['language_arr']['study_date'][$k_num]=='6 month' ? 'selected' : '';?>>6개월</option>
											<?php
											for($i=1; $i<=10; $i++) {
												$selected = $resume_individual['language_arr']['study_date'][$k_num]==$i.' year' ? 'selected' : '';
											?>
											<option value="<?php echo $i;?> year" <?php echo $selected;?>><?php echo $i;?>년</option>
											<?php
											}
											?>
											<option value="11 year" <?php echo $selected = $resume_individual['language_arr']['study_date'][$k_num]=='11 year' ? 'selected' : '';?>>10년이상</option>
											</select>
											</span></li>

										</ul>
									</dd>
								</dl>
							</div>
							<div class="check_language_exam-">
								<?php
								if(is_array($resume_individual['language_arr']['license'][$k_num])) $length2 = count($resume_individual['language_arr']['license'][$k_num]);
								if($length2<=0) $length2 = 1;
								for($k_num2=0; $k_num2<$length2; $k_num2++) {
								?>
								<div class="parent- add_exam">
									<dl>
										<dt>공인시험</dt>
										<dd>
											<select class="check_seconds" name="wr_language[license][<?php echo $k_num;?>][]">
												<option value="">공인시험선택</option>
												<?php
												if(is_array($cate_p_array['job_language_exam'][0])) { foreach($cate_p_array['job_language_exam'][0] as $k=>$v) {
													$selected = $resume_individual['language_arr']['license'][$k_num][$k_num2]==$k ? 'selected' : '';
												?>
												<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
												<?php
												} }?>
											</select>
											<button type="button" onClick="nf_util.clone_tag(this, '.check_language_exam-', 3)" class="basebtn gray regist_btn1"><?php echo $k_num2===0 ? '추가' : '삭제';?></button>
										</dd>
									</dl>
									<dl>
										<dt>점수/등급</dt>
										<dd><input type="text" class="check_seconds" name="wr_language[license_level][<?php echo $k_num;?>][]" value="<?php echo $nf_util->get_html($resume_individual['language_arr']['license_level'][$k_num][$k_num2]);?>"></dd>
									</dl>
									<dl>
										<dt>취득년도</dt>
										<dd>
											<select class="check_seconds" name="wr_language[license_date][<?php echo $k_num;?>][]">
												<option value="">년도선택</option>
												<?php
												for($i=date("Y"); $i>=1900; $i--) {
													$selected = $resume_individual['language_arr']['license_date'][$k_num][$k_num2]==$i ? 'selected' : '';
												?>
												<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
												<?php
												}?>
											</select> 년
										</dd>
									</dl>
								</div>
								<?php
								}?>
							</div>
						</td>
					</tr>
					<?php
					}?>
				</tbody>
			</table>
		</div>
		<!--//외국어능력-->
	</div>
	<?php
	}?>

	<?php
	if($register_form_arr['register_form_resume']['보유기술및능력']) {
	?>
	<div class="check_skill_opener-" style="display:<?php echo $re_row['wr_skill_use'] ? 'block' : 'none';?>">
		<!--OA능력-->
		<div class="common_box technology">
			<table class="com_table">
				<colgroup>
					<col width="10%">
				</colgroup>
				<tbody>
					<tr>
						<th><?php if($register_form_arr['register_form_resume']['보유기술및능력']['wr_0']) echo $icon_need;?>OA능력</th>
						<td>
							<div>
								<?php
								if(is_array($nf_job->oa_arr)) { foreach($nf_job->oa_arr as $k=>$v) {
								?>
								<dl>
									<dt><?php echo $v;?></dt>
									<dd>
										<ul class="class">
											<?php
											if(is_array($nf_job->oa_arr2[$k])) { foreach($nf_job->oa_arr2[$k] as $k2=>$v2) {
												$checked = $resume_individual['oa_arr'][$k]==$k2 ? 'checked' : '';
											?>
											<li><label><input type="radio" name="wr_oa[<?php echo $k;?>]" <?php echo $checked;?> value="<?php echo $k2;?>"><?php echo $v2;?></label></li>
											<?php
											} }?>
										</ul>
									</dd>
								</dl>
								<?php
								} }?>
							</div>
						</td>
					</tr>
					<tr>
						<th><?php echo $icon_need;?>컴퓨터능력</th>
						<td>
							<ul class="class">
								<?php
								$checked = "";
								if(is_array($cate_p_array['job_computer'][0])) { foreach($cate_p_array['job_computer'][0] as $k=>$v) {
									$checked = is_array($resume_individual['computer_arr']) && in_array($k, $resume_individual['computer_arr']) ? 'checked' : '';
								?>
								<li><label><input type="checkbox" name="wr_computer[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
								<?php
								} }?>
							</ul>
						</td>
					</tr>	
				</tbody>
			</table>
		</div>
		<!--// OA능력-->
	</div>
	<?php
	}?>

	<?php
	if($register_form_arr['register_form_resume']['수상.수료활동']) {
	?>
	<div class="check_prime_opener-" style="display:<?php echo $re_row['wr_prime_use'] ? 'block' : 'none';?>">
		<!--수상수료활동-->
		<div class="common_box awards">
			<table class="com_table">
				<colgroup>
					<col width="10%">
				</colgroup>
				<tbody>
					<tr>
						<th><?php if($register_form_arr['register_form_resume']['수상.수료활동']['wr_0']) echo $icon_need;?>수상·수료활동</th>
						<td><textarea name="wr_prime" cols="30" rows="10"><?php echo stripslashes($resume_individual['wr_prime']);?></textarea></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!--//수상수료활동-->
	</div>
	<?php
	}?>

	<?php
	if($register_form_arr['register_form_resume']['구인우대사항']) {
	?>
	<div class="check_preferential_opener-" style="display:<?php echo $re_row['wr_preferential_use'] ? 'block' : 'none';?>">
		<!--구인우대사항-->
		<div class="common_box preferential">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tbody>
				<tr>
					<th><?php if($register_form_arr['register_form_resume']['구인우대사항']['wr_0']) echo $icon_need;?>국가보훈</th>
					<td>
						<ul class="li_float">
							<?php
							if(is_array($nf_job->target_arr)) { foreach($nf_job->target_arr as $k=>$v) {
								$checked = $resume_individual['wr_veteran_use']==$k ? 'checked' : '';
							?>
							<li><label><input type="radio" name="wr_veteran_use" onClick="nf_job.click_veteran(this)" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
							<?php
							} }
							?>
						</ul>
						<span class="veteran-" style="display:<?php echo $resume_individual['wr_veteran_use']==$k ? 'inline' : 'none';?>;">
							<select name="wr_veteran"><!--대상선택시 노출-->
								<option value="">대상사유</option>
								<?php
								if(is_array($cate_p_array['job_veteran'][0])) { foreach($cate_p_array['job_veteran'][0] as $k=>$v) {
									$selected = $resume_individual['wr_veteran']==$k ? 'selected' : '';
								?>
								<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
								<?php
								} }?>
							</select>
						</span>
					</td>
				</tr>
				<tr>
					<th><?php if($register_form_arr['register_form_resume']['구인우대사항']['wr_0']) echo $icon_need;?>고용지원금</th>
					<td>
						<ul class="li_float">
							<?php
							if(is_array($nf_job->target_arr)) { foreach($nf_job->target_arr as $k=>$v) {
								$checked = $resume_individual['wr_treatment_use']==$k ? 'checked' : '';
							?>
							<li><label><input type="radio" name="wr_treatment_use" onClick="nf_job.click_treatment_use(this)" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
							<?php
							} }?>
						</ul>
						<ul class="li_float">
							<div class="MAT5 treatment_service-" style="display:<?php echo $resume_individual['wr_treatment_use'] ? 'block' : 'none';?>"><!--대상선택시 노출-->
								<?php
								$checked = "";
								if(is_array($cate_p_array['job_pay_employ'][0])) { foreach($cate_p_array['job_pay_employ'][0] as $k=>$v) {
									$checked = is_array($resume_individual['treatment_service_arr']) && in_array($k, $resume_individual['treatment_service_arr']) ? 'checked' : '';
								?>
								<li><label><input type="checkbox" name="wr_treatment_service[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
								<?php
								} }?>
							</div>
						</ul>
					</td>
				</tr>
				<tr>
					<th><?php if($register_form_arr['register_form_resume']['구인우대사항']['wr_0']) echo $icon_need;?>병역여부</th>
					<td>
						<ul class="li_float">
							<?php
							if(is_array($nf_job->army_arr)) { foreach($nf_job->army_arr as $k=>$v) {
								$checked = $resume_individual['wr_military']==$k ? 'checked' : '';
							?>
							<li><label><input type="radio" name="wr_military" onClick="nf_job.click_military_use(this)" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
							<?php
							} }?>
						</ul>
						<div class="MAT5 wr_militray_2-" style="display:<?php echo $resume_individual['wr_military']==='2' ? 'block' : 'none';?>"><!--면제선택시 노출-->
							<input type="text" name="wr_military_content" value="<?php echo $nf_util->get_html($resume_individual['wr_military_content']);?>" placeholder="[선택]면제사유">
						</div>
						<div class="MAT5 wr_militray_1-" style="display:<?php echo $resume_individual['wr_military']==='1' ? 'block' : 'none';?>"><!--군필선택시 노출-->
							<select name="wr_military_year[]">
								<option value="">년</option>
								<?php
								for($i=date("Y"); $i>=1900; $i--) {
									$selected = $resume_individual['military_sdate_arr'][0]==$i ? 'selected' : '';
								?>
								<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
								<?php
								}?>
							</select> 년
							<select name="wr_military_month[]">
								<option value="">월</option>
								<?php
								for($i=1; $i<=12; $i++) {
									$_int = sprintf("%02d", $i);
									$selected = $resume_individual['military_sdate_arr'][1]==$_int ? 'selected' : '';
								?>
								<option value="<?php echo $_int;?>" <?php echo $selected;?>><?php echo $_int;?></option>
								<?php
								}?>
							</select> 월 ~
							<select name="wr_military_year[]">
								<option value="">년</option>
								<?php
								for($i=date("Y"); $i>=1900; $i--) {
									$selected = $resume_individual['military_edate_arr'][0]==$i ? 'selected' : '';
								?>
								<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
								<?php
								}?>
							</select> 년
							<select name="wr_military_month[]">
								<option value="">월</option>
								<?php
								for($i=1; $i<=12; $i++) {
									$_int = sprintf("%02d", $i);
									$selected = $resume_individual['military_edate_arr'][1]==$_int ? 'selected' : '';
								?>
								<option value="<?php echo $_int;?>" <?php echo $selected;?>><?php echo $_int;?></option>
								<?php
								}?>
							</select> 월
						</div>
					</td>
				</tr>
				<tr>
					<th><?php if($register_form_arr['register_form_resume']['구인우대사항']['wr_0']) echo $icon_need;?>장애여부</th>
					<td>
						<ul class="li_float">
							<?php
							if(is_array($nf_job->target_arr)) { foreach($nf_job->target_arr as $k=>$v) {
								$checked = $resume_individual['wr_impediment_use']==$k ? 'checked' : '';
							?>
							<li><label><input type="radio" name="wr_impediment_use" onClick="nf_job.click_impediment_use(this)" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
							<?php
							} }?>
						</ul>
						<div class="MAT5 impediment_use-" style="display:<?php echo $resume_individual['wr_impediment_use'] ? 'block' : 'none';?>"><!--대상선택시 노출-->
							<select name="wr_impediment_level">
								<option value="">등급</option>
								<?php
								$checked = "";
								if(is_array($cate_p_array['job_obstacle'][0])) { foreach($cate_p_array['job_obstacle'][0] as $k=>$v) {
									$selected = $resume_individual['wr_impediment_level']==$k ? 'selected' : '';
								?>
								<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
								<?php
								} }?>
							</select>
							<input type="text" name="wr_impediment_name" value="<?php echo $nf_util->get_html($resume_individual['wr_impediment_name']);?>" placeholder="[선택]장애내용 입력">
						</div>
					</td>
				</tr>
				<tr>
					<th><?php if($register_form_arr['register_form_resume']['구인우대사항']['wr_0']) echo $icon_need;?>민감정보<br>처리동의</th>
					<td>
						<label><input type="checkbox" name="wr_sensitive" value="1" <?php echo $resume_individual['wr_sensitive'] ? 'checked' : '';?>>처리에 동의합니다.</label>
						<div class="scroll_box MAT5">
							<b>당사는 개인정보보호법 제23조에 따라 상기의 개인정보에 대한 개별 동의사항에 대하여 다음과 같이 귀하의 민감정보(보훈대상, 장애여부, 고용지원금 등)를 처리(수집/이용, 제공 등) 하고자 합니다.</b><br><br>
							수집·이용목적 : 이력서 서비스 제공 <br>
							보유기간 : 회원 탈퇴 시  또는 동의 철회시
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!--//구인우대사항-->
	</div>
	<?php
	}?>
<!-- </div> -->
<!--//choice-->

