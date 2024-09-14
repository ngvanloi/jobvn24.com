<?php
$member_mid = $em_row['wr_id'] ? $em_row['wr_id'] : $member_row['mb_id'];
$wr_logo_type = $em_row['wr_logo_type'] ? $em_row['wr_logo_type'] : ($env['employ_logo']=='all' ? 'text' : $env['employ_logo']);
if($env['employ_logo']!='all') $wr_logo_type = $env['employ_logo'];
//echo '<pre>';
//print_R($company_m_query); 
//echo '<pre>';
?>
<style type="text/css">
.display-none- { display:none; }
.requisition- { display:none; }
.conbox.popup_box- { display:none; cursor:pointer; }
.disabled { background-color:#efefef !important; }
.click-logo-td- > div { display:none; }

.category_group- > .parent- { margin-top:5px; }
.category_group- > .parent-:nth-child(1) { margin-top:0px; }
</style>
<div class="h_no">
	<h6>등록방법</h6>
	<table>
		<colgroup>
			<col width="10%">
		</colgroup>
		<tr>
			<th>등록방법 <em class="ess">*</em></th>
			<td>
				<label><input type="radio" name="input_type" value="self" checked>직접등록</label>
				<label><input type="radio" name="input_type" value="load" <?php echo $em_row['input_type']=='load' || $member_row ? 'checked' : '';?>>불러오기</label>
			</td>
		</tr>
		</tbody>
		<tbody class="input_type- load-" style="display:<?php echo $em_row['input_type']=='load' || $member_row ? 'table-row-group' : 'none';?>;">
		<tr><!--등록방법-불러오기 선택시 노출-->
			<th>회원선택 <em class="ess">*</em></th>
			<td>
				<input type="text" id="find_member-" value="<?php echo $nf_util->get_html($member_row['mb_id']);?>" class="input10">
				<button type="button" class="basebtn blue" onClick="find_member('company')">회원검색</button><span>이름,아이디,이메일로 검색</span>
				<ul class="calling MAT10 find_member_put-">
					<li>이름,아이디,이메일로 검색해주시기 바랍니다.</li>
				</ul>
			</td>
		</tr>
		<tr>
			<th>구인공고선택</th>
			<td>
				<select name="load_employ" onChange="nf_job.select_info(this)">
					<option value="">구인공고선택</option>
					<?php
					if(is_array($employ_query)) { foreach($employ_query as $k=>$row) {
						$selected = $row['no']==$_GET['info_no'] ? 'selected' : '';
					?>
					<option value="<?php echo $row['no'];?>" <?php echo $selected;?>><?php echo $row['wr_subject'];?></option>
					<?php
					} }?>
				</select>
			</td>
		</tr>
		
		<tr>
			<th>홈페이지</th>
			<td><input type="text" name="wr_page" value="<?php echo $nf_util->get_html($employ_info['wr_page']);?>" hname="홈페이지" placeholder="http://"></td>
		</tr>
	</table>
</div>

<div class="title">
	<div class="side_con">
		<h6>구인 제목</h6>
		<div class="h_right">
			<select title="구인공고 불러오기" onChange="nf_job.select_info(this)">
				<option value="">구인공고 불러오기</option>
				<?php
				if(is_array($employ_query)) { foreach($employ_query as $k=>$row) {
					$selected = $row['no']==$_GET['info_no'] ? 'selected' : '';
				?>
				<option value="<?php echo $row['no'];?>" <?php echo $selected;?>><?php echo $row['wr_subject'];?></option>
				<?php
				} }?>
			</select>
		</div>
	</div>
	<table>
		<tr>
			<th><input type="text" name="wr_subject" hname="구인제목" needed value="<?php echo $nf_util->get_html($em_row['wr_subject']);?>" placeholder="구인공고 제목을 입력해주세요."></th>
		</tr>
	</table>
</div>

<div class="p_work box_wrap">
	<h6>근무지정보<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tr>
				<th rowspan="2"><?php echo $icon_need;?>업소로고</th>
				<td class="click-logo-">
					<ul class="li_float">
						<?php if(in_array($env['employ_logo'], array('text', 'all'))) {?>
						<li><label><input type="radio" name="wr_logo_type" value="text" checked>텍스트로고</label></li>
						<?php }?>
						<?php if(in_array($env['employ_logo'], array('logo', 'all'))) {?>
						<li><label><input type="radio" name="wr_logo_type" value="logo" <?php echo $wr_logo_type=='logo' ? 'checked' : '';?> >이미지로고</label></li>
						<?php }?>
						<?php if(in_array($env['employ_logo'], array('bg', 'all'))) {?>
						<li><label><input type="radio" name="wr_logo_type" value="bg" <?php echo $wr_logo_type=='bg' ? 'checked' : '';?>>배경로고</label></li>
						<?php }?>
					</ul>
				</td>
			</tr>
			<tr>
				<?php
				$logo_val = is_file(NFE_PATH.'/data/employ/'.$em_row['wr_logo']) ? $em_row['wr_logo'] : "";
				$logo_bg_val = is_file(NFE_PATH.'/data/employ/'.$em_row['wr_logo_bg']) ? $em_row['wr_logo_bg'] : "";
				?>
				<td class="click-logo-td-">
					<?php if(in_array($env['employ_logo'], array('text', 'all'))) {?>
					<div val="text" style="display:<?php echo $wr_logo_type=='text' ? 'block' : '';?>;">
						<input placeholder="로고명을 입력하세요" type="text" name="wr_logo_text" hname="업소로고명" <?php echo $logo_val || $logo_bg_val ? '' : 'needed';?> value="<?php echo $nf_util->get_html($em_row['wr_logo_text']);?>">
					</div>
					<?php }?>
					<?php if(in_array($env['employ_logo'], array('logo', 'all'))) {?>
					<div val="logo" class="parent_file_upload-" style="display:<?php echo $wr_logo_type=='logo' ? 'block' : '';?>;"><!--이미지로고일때-->
						<div class="one">
							<button type="button" onClick="nf_job.click_file(this, 'file_upload-', 'logo')" class="gray basebtn">이미지로고 등록</button> <span class="blue bojotext"><b><?php echo strtoupper(implode(", ", $nf_util->photo_ext));?></b> 파일형식으로 <b>400*200픽셀, 100KB 용량 이내</b>의 파일을 권장합니다.</span>
						</div>
						<p class="logo_box logotype_box logo_img img put_img-" style="<?php if(is_file(NFE_PATH.'/data/employ/'.$logo_val)) {?>background-image:url(<?php echo NFE_URL.'/data/employ/'.$logo_val;?>);<?php }?>"><span><a href="#none" onClick="nf_job.click_file_delete(this, 'logo')"><i class="axi axi-close"></i></a></span></p>
						<input type="hidden" name="wr_logo" class="put_image-" hname="이미지로고" value="<?php echo $logo_val;?>" />
					</div>
					<?php }?>
					<?php if(in_array($env['employ_logo'], array('bg', 'all'))) {?>
					<div val="bg" class="parent_file_upload-" style="display:<?php echo $wr_logo_type=='bg' ? 'block' : '';?>;"><!--배경로고일때-->
						<div class="one">
							<button type="button" onClick="nf_job.click_file(this, 'file_upload-', 'logo_bg')" class="gray basebtn">배경로고 등록</button><span class="blue bojotext"><b><?php echo strtoupper(implode(", ", $nf_util->photo_ext));?></b> 파일형식으로 <b>400*200픽셀, 100KB 용량 이내</b>의 파일을 권장합니다.</span>
						</div>
						<p class="bg_box logotype_box bglogo_img img put_img-" style="<?php if(is_file(NFE_PATH.'/data/employ/'.$logo_bg_val)) {?>background-image:url(<?php echo NFE_URL.'/data/employ/'.$logo_bg_val;?>);<?php }?>"><span><a href="#none" onClick="nf_job.click_file_delete(this, 'logo_bg')"><i class="axi axi-close"></i></a></span></p>
						<input type="hidden" name="wr_logo_bg" hname="배경로고" class="put_image-" value="<?php echo $logo_bg_val;?>" />
					</div>
					<?php }?>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>업소명</th>
				<td><input type="text" name="wr_company_name" value="<?php echo $is_modify ? $nf_util->get_html($employ_info['wr_company_name']) : $nf_util->get_html($company_m_query['mb_company_name']);?>" hname="업소/점포명" needed></td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>업·직종</th>
				<td>
					<span class="blue bojotext">* 최대 3개 등록가능</span>
					<div class="check_job_part- category_group-">
						<?php
						for($i=0; $i<$employ_info['job_type_cnt']; $i++) {
							$mt5 = $i>0 ? 'MAT5' : '';
							$job_type_arr = explode(",", $employ_info['job_type_arr'][$i]);
						?>
						<div class="parent- <?php echo $mt5;?>" tag_name="wr_job_type">
							<select class="check_seconds" name="wr_job_type[<?php echo $i;?>][]" <?php echo $nf_category->kind_arr['job_part'][1]>1 ? 'onChange="nf_category.ch_category(this, 1)"' : '';?>>
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
							<select class="check_seconds" name="wr_job_type[<?php echo $i;?>][]" <?php echo $nf_category->kind_arr['job_part'][1]>2 ? 'onChange="nf_category.ch_category(this, 2)"' : '';?>>
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
							<select class="check_seconds" name="wr_job_type[<?php echo $i;?>][]">
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
					<div class="MAT5"><label ><input type="checkbox" name="wr_beginner" value="1" <?php echo $em_row['wr_beginner'] ? 'checked' : '';?> >초보가능</label></div>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>근무지역</th>
				<td>					
					<div class="check_area- category_group-">
					<?php
					for($i=0; $i<$employ_info['area_cnt']; $i++) {
						$mt5 = $i>0 ? 'MAT5' : '';
						$area_arr = explode(",", $employ_info['area_arr'][$i]);
					?>
					<div class="parent- <?php echo $mt5;?> area-address-">
						<select class="check_seconds wr-area-" name="wr_area[<?php echo $i;?>][]" onChange="nf_category.ch_category(this, 1);nf_job.move_map(this, 'iframe_map')" wr_type="area" hname="근무지역" needed class="MAB5">
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
						<select class="check_seconds wr-area-" name="wr_area[<?php echo $i;?>][]" onChange="nf_category.ch_category(this, 2);nf_job.move_map(this, 'iframe_map')" wr_type="area" hname="근무지역"  class="MAB5">
							<option value="">시·군·구</option>
							<?php
							$checked = "";
							$area2 = $area_arr[2];
							$nf_category->get_area($area1, $area2);
							if(is_array($cate_area_array['SI'][$area1])) { foreach($cate_area_array['SI'][$area1] as $k=>$v) {
								$selected = $area2==$v['wr_name'] ? 'selected' : '';
							?>
							<option value="<?php echo $v['wr_name'];?>" no="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select>
						<select class="check_seconds wr-area-" hname="근무지역"  name="wr_area[<?php echo $i;?>][]" id="" class="MAB5" onChange="nf_job.move_map(this, 'iframe_map')">
							<option value="">읍·면·동</option>
							<?php
							$checked = "";
							if(is_array($cate_area_array['GU'][$area1][$area2])) { foreach($cate_area_array['GU'][$area1][$area2] as $k=>$v) {
								$selected = $area_arr[3]==$v['wr_name'] ? 'selected' : '';
							?>
							<option value="<?php echo $v['wr_name'];?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select>
						<input type="text" name="wr_area_add" class="" placeholder="상세주소를 입력해주세요"> 
						<!-- <div class="MAT5"><label><input type="checkbox" name="wr_area[<?php echo $i;?>][]" <?php echo $area_arr[4] ? 'checked' : '';?> value="1"> 재택근무 가능</label></div> -->
					</div>
					<?php
					}?>
					</div>
					<?php
					include NFE_PATH.'/include/post.daum.php';
					?>
				</td>
			</tr>

			<?php
			if($register_form_arr['register_form_employ']['인근지하철']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['인근지하철']['wr_0']) echo $icon_need;?>인근지하철</th>
				<td>
					<div class="check_subway- category_group-">
					<?php
					for($i=0; $i<$employ_info['subway_cnt']; $i++) {
						$subway_arr = explode(",", $employ_info['subway_arr'][$i]);
					?>
					<div class="parent-">
						<select class="check_seconds" hname="지하철 지역" <?php if($register_form_arr['register_form_employ']['인근지하철']['wr_0']) echo 'needed';?> name="wr_subway[<?php echo $i;?>][]" onChange="nf_category.ch_category(this, 1)">
							<option value="">지역</option>
							<?php
							$checked = "";
							$subway1 = $subway_arr[1];
							if(is_array($cate_p_array['subway'][0])) { foreach($cate_p_array['subway'][0] as $k=>$v) {
								$selected = $subway1==$k ? 'selected' : '';
							?>
							<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select>
						<select class="check_seconds" hname="지하철 호선" <?php if($register_form_arr['register_form_employ']['인근지하철']['wr_0']) echo 'needed';?> name="wr_subway[<?php echo $i;?>][]" onChange="nf_category.ch_category(this, 2)">
							<option value="">호선</option>
							<?php
							$checked = "";
							$subway2 = $subway_arr[2];
							if(is_array($cate_p_array['subway'][$subway1])) { foreach($cate_p_array['subway'][$subway1] as $k=>$v) {
								$selected = $subway2==$k ? 'selected' : '';
							?>
							<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select>
						<select class="check_seconds"  hname="지하철역" <?php if($register_form_arr['register_form_employ']['인근지하철']['wr_0']) echo 'needed';?> name="wr_subway[<?php echo $i;?>][]">
							<option value="">지하철역</option>
							<?php
							$checked = "";
							if(is_array($cate_p_array['subway'][$subway2])) { foreach($cate_p_array['subway'][$subway2] as $k=>$v) {
								$selected = $subway_arr[3]==$k ? 'selected' : '';
							?>
							<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
							<?php
							} }?>
						</select>
						<input class="check_seconds" type="text" name="wr_subway[<?php echo $i;?>][]" value="<?php echo $nf_util->get_html($subway_arr[4]);?>" maxlength="50" placeholder="출구, 소요시간 등">
						<button type="button" onClick="nf_util.clone_tag(this, '.check_subway-', 3)" class="gray basebtn regist_btn1"><?php echo $i===0 ? '추가' : '삭제';?></button>
					</div>
					<?php }?>
					</div>
				</td>
			</tr>
			<?php
			}?>
		</table>
	</div>
</div>

<div class="w_condition box_wrap">
	<h6>근무조건<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>

			<!-- <tr>
				<th><?php echo $icon_need;?>근무기간</th>
				<td>
					<ul class="li_float">
					<?php
					$count = 0;
					//if(is_array($cate_p_array['job_date'][0])) { foreach($cate_p_array['job_date'][0] as $k=>$v) {
						//$checked = $k==$em_row['wr_date'] || $count===0 ? 'checked' : '';
					?>
					<li><label><input type="radio" name="wr_date" hname="근무기간" needed value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
					<?php
						//$count++;
					//} }?>
					</ul>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>근무요일</th>
				<td>
					<ul class="li_float">
					<?php
					//$count = 0;
					//if(is_array($cate_p_array['job_week'][0])) { foreach($cate_p_array['job_week'][0] as $k=>$v) {
						//$checked = $k==$em_row['wr_week'] || $count===0 ? 'checked' : '';
					?>
					<li><label><input type="radio" name="wr_week" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
					<?php
					//} }?>
					</ul>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>근무시간</th>
				<td>
					<select name="wr_stime[]" hname="근무시간" <?php echo $em_row['wr_time_conference'] ? '' : 'needed';?>>
						<option value="">선택</option>
						<?php
						//for($i=0; $i<24; $i++) {
							//$hour_int = sprintf("%02d", $i);
							//$selected = $employ_info['stime_arr'][0]==$hour_int ? 'selected' : '';
						?>
						<option value="<?php echo $hour_int;?>" <?php echo $selected;?>><?php echo $hour_int;?>시</option>
						<?php
						//}?>
					</select>
					<select name="wr_etime[]" hname="근무시간" <?php echo $em_row['wr_time_conference'] ? '' : 'needed';?>>
						<option value="">선택</option>
						<?php
						//for($i=0; $i<6; $i++) {
							//$minute_int = sprintf("%02d", $i*10);
							//$selected = $employ_info['stime_arr'][1]==$minute_int ? 'selected' : '';
						?>
						<option value="<?php echo $minute_int;?>" <?php echo $selected;?>><?php echo $minute_int;?>분</option>
						<?php
						//}?>
					</select>~

					<select name="wr_stime[]" hname="근무시간" <?php echo $em_row['wr_time_conference'] ? '' : 'needed';?>>
						<option value="">선택</option>
						<?php
						//for($i=0; $i<24; $i++) {
							//$hour_int = sprintf("%02d", $i);
							//$selected = $employ_info['etime_arr'][0]==$hour_int ? 'selected' : '';
						?>
						<option value="<?php echo $hour_int;?>" <?php echo $selected;?>><?php echo $hour_int;?>시</option>
						<?php
						//}?>
					</select>
					<select name="wr_etime[]" hname="근무시간" <?php echo $em_row['wr_time_conference'] ? '' : 'needed';?>>
						<option value="">선택</option>
						<?php
						//for($i=0; $i<6; $i++) {
							//$minute_int = sprintf("%02d", $i*10);
							//$selected = $employ_info['etime_arr'][1]==$minute_int ? 'selected' : '';
						?>
						<option value="<?php echo $minute_int;?>" <?php echo $selected;?>><?php echo $minute_int;?>분</option>
						<?php
						//}?>
					</select>
					<div class="MAT5">
						<label><input type="checkbox" name="wr_time_conference" onClick="nf_job.click_time_conference(this)" value="1" <?php //echo $em_row['wr_time_conference'] ? 'checked' : '';?> style="MAL5"> 시간협의</label>
					</div>
				</td>
			</tr> -->
			<tr>
				<th rowspan="2"><?php echo $icon_need;?>급여</th>
				<td>					
					<select name="wr_pay_type" hname="급여" <?php echo $em_row['wr_pay_conference'] ? 'disabled' : 'needed';?>>
						<option value="">= 급여 =</option>
						<?php
						if(is_array($cate_p_array['job_pay'][0])) { foreach($cate_p_array['job_pay'][0] as $k=>$v) {
							$selected = $em_row['wr_pay_type']==$k ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
						<?php
						} }?>
					</select>
					<input type="text" name="wr_pay" hname="급여" <?php echo $em_row['wr_pay_conference'] ? 'disabled' : 'needed';?> value="<?php echo $nf_util->get_html($em_row['wr_pay']);?>" class="input10">원 
					<!-- <span class="blue bojotext  MAT10">* 최저임금 : <?php echo number_format(intval($env['time_pay']));?>원</span> -->
				<td>
			</tr>
			<tr>
				<td>
					<div>
						<ul class="li_float">
							<?php
							if(is_array($nf_job->pay_conference)) { foreach($nf_job->pay_conference as $k=>$v) {
								$checked = $em_row['wr_pay_conference']==$k ? 'checked' : '';
							?>
							<li><label><input type="checkbox" name="wr_pay_conference" onClick="nf_util.one_check(this);nf_job.click_pay_conference(this)" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
							<?php
							} }?>
						</ul>
						<!-- <span class="blue bojotext MAT10"> (당사는 본 구인건과 관련하여 '최저임금법'을 준수합니다.)</span> -->
					</div>
				</td>
			</tr>
			<!-- <tr>
				<td>
					<div>
						<ul class="li_float">
						<?php
						//if(is_array($cate_p_array['job_pay_support'][0])) { foreach($cate_p_array['job_pay_support'][0] as $k=>$v) {
							//$checked = is_array($employ_info['pay_support_arr']) && in_array($k, $employ_info['pay_support_arr']) ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_pay_support[]" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
						<?php
						//} }?>
						</ul>
					</div>
				</td>
			</tr> -->
			<tr>
				<th>테마선택</th>
				<td>
					<ul class="li_float">
					<?php
					if(is_array($cate_p_array['job_tema'][0])) { foreach($cate_p_array['job_tema'][0] as $k=>$v) {
						$checked = is_array($employ_info['work_type_arr']) && in_array($k, $employ_info['work_type_arr']) ? 'checked' : '';
					?>
					<li><label><input type="checkbox" name="wr_work_type[]" hname="테마선택"  value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
					<?php
					} }?>
						</ul>
				</td>
			</tr>
			<tr>
				<th>보장제도</th>
				<td>
					<ul class="li_float">
						<?php
						if(is_array($cate_p_array['job_document'][0])) { foreach($cate_p_array['job_document'][0] as $k=>$v) {
							$checked = is_array($employ_info['target_arr']) && in_array($k, $employ_info['target_arr']) ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_target[]" hname="보장제도" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
						<?php
						} }?>
					</ul>
				</td>
			</tr>
			<?php
			if($register_form_arr['register_form_employ']['복리후생']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['복리후생']['wr_0']) echo $icon_need;?>복리후생</th>
				<td>
					<button type="button" class="basebtn gray regist_btn3" onclick="nf_util.initLayerPosition('welfare-', '', '', 1)">선택</button>
					<span class="put_wr_welfare"><?php echo strtr(strtr($em_row['wr_welfare'], array(","=>", ")), $cate_array['job_welfare']);?></span>
				</td>
			</tr>
			<?php
			}?>
		</table>
	</div>
</div>

	
<div class="appli box_wrap">
	<h6>지원조건<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tr>
				<th><?php echo $icon_need;?>성별</th>
				<td>
					<ul class="li_float">
						<li><label><input type="radio" name="wr_gender" value="0" checked>성별무관</label></li>
						<?php
						if(is_array($nf_util->gender_arr)) { foreach($nf_util->gender_arr as $k=>$v) {
							$checked = $em_row['wr_gender']==$k ? 'checked' : '';
						?>
						<li><label><input type="radio" name="wr_gender" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
						<?php
						} }?>
					</ul>
					<span class="bojotext blue"><i class="axi axi-exclamation-circle"></i> 구인에서 남녀를 차별하거나, 여성근로자를 구인할 때 직무수행에 불필요한 용모, 키, 체중 등의 신체조건, 미혼조건을 제시 또는 요구하는 경우 남녀 고용평등법 위반 에 따른 500만원이하의 벌금이 부과될 수 있습니다.</span>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>연령</th>
				<td>
					<ul class="li_float">
						<li><label><input type="radio" name="wr_age_limit" value="0" checked onClick="nf_util.click_display('wr_age-', 'none')">연령무관</label></li>
						<li><label><input type="radio" name="wr_age_limit" value="1" <?php echo $em_row['wr_age_limit'] ? 'checked' : '';?> onClick="nf_util.click_display('wr_age-', 'inline')">연령제한</label></li>
					</ul>
					<em class="<?php echo $em_row['wr_age_limit'] ? '' : 'display-none-';?>" id="wr_age-">
						<input type="text" name="wr_age[]" style="width:60px;text-align:center;" value="<?php echo $employ_info['age_arr'][0];?>" hname="제한연령" />세이상 ~
						<input type="text" name="wr_age[]" style="width:60px;text-align:center;" value="<?php echo $employ_info['age_arr'][1];?>" hname="제한연령" />세이하
					</em>
					<span class="bojotext blue MAT5"><i class="axi axi-exclamation-circle"></i> 구인시 합리적인 이유 없이 연령제한을 하는 경우 연령차별금지법 위반에 해당되어 500만원 이하의 벌금이 부과될 수 있습니다.</span>
				</td>
			</tr>
			<!-- <tr>
				<th><?php echo $icon_need;?>학력조건</th>
				<td>
					<ul class="li_float">
						<?php
						$count = 0;
						//if(is_array($nf_job->school)) { foreach($nf_job->school as $k=>$v) {
							//$checked = $count===0 || $em_row['wr_ability']==$k ? 'checked' : '';
						?>
						<li><label><input type="radio" name="wr_ability" <?php echo $checked;?> value="<?php echo $k;?>"><?php echo $v;?></label></li>
						<?php
							$count++;
						//} }
						?>
					</ul>
					<p class="MAT10"><label ><input type="checkbox" name="wr_ability_end" value="1" <?php echo $em_row['wr_ability_end'] ? 'checked' : '';?>>졸업예정자 가능</label> </p>
				</td>
			</tr>
			<tr>
				<th><?php echo $icon_need;?>경력사항</th>
				<td>
					<ul class="li_float">
						<?php
						$count = 0;
						//if(is_array($nf_job->career_type)) { foreach($nf_job->career_type as $k=>$v) {
							//$checked = $count===0 || $em_row['wr_career_type']==$k ? 'checked' : '';
						?>
						<li><label><input type="radio" name="wr_career_type" onClick="nf_job.ch_career(this)" <?php echo $checked;?> value="<?php echo $k;?>"><?php echo $v;?></label></li>
						<?php
							$count++;
						//} }
						?>
					</ul>
					<span class="wr_career-" style="display:<?php echo $em_row['wr_career_type']=='2' ? 'inline' : 'none';?>;">
						<select name="wr_career" hname="경력" <?php echo $em_row['wr_career_type']=='2' ? 'needed' : '';?>>
							<option value="">= 경력선택 =</option>
							<?php
							//if(is_array($nf_job->career_date_arr)) { foreach($nf_job->career_date_arr as $k=>$v) {
								//$selected = $em_row['wr_career']==$k ? 'selected' : ''
							?>
							<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v;?></option>
							<?php
							//} }
							?>
						</select>
					</span>
				</td>
			</tr> -->
			<?php
			if($register_form_arr['register_form_employ']['직급/직책']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['직급/직책']['wr_0']) echo $icon_need;?>직급/직책</th>
				<td>
					<button type="button" onclick="nf_util.initLayerPosition('grade_position-', '', '', 1)" class="basebtn gray regist_btn3">선택</button>
					<span class="put_wr_grade">직급 : <?php echo strtr(strtr($em_row['wr_grade'], array(","=>", ")), $cate_array['job_grade']);?></span>
					<span class="put_wr_position">직책 : <?php echo strtr(strtr($em_row['wr_position'], array(","=>", ")), $cate_array['job_position']);?></span>
				</td>
			</tr>
			<?php
			}?>
			<?php
			if($register_form_arr['register_form_employ']['우대조건']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['우대조건']['wr_0']) echo $icon_need;?>우대조건</th>
				<td>
					<button type="button" onclick="nf_util.initLayerPosition('preferential-', '', '', 1)" class="basebtn gray regist_btn3">선택</button>
					<span class="put_wr_preferential"><?php echo strtr(strtr($em_row['wr_preferential'], array(","=>", ")), $cate_array['job_conditions']);?></span>
				</td>
			</tr>
			<?php
			}?>
			<?php
			if($register_form_arr['register_form_employ']['자격증']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['자격증']['wr_0']) echo $icon_need;?>자격증</th>
				<td><input type="text" name="wr_license" hname="자격증" <?php if($register_form_arr['register_form_employ']['자격증']['wr_0']) echo 'needed';?> value="<?php echo $nf_util->get_html($em_row['wr_license']);?>" placeholder="ex) 운전면허증1종, 컴퓨터기능사1급"></td>
			</tr>
			<?php
			}?>
		</table>
	</div>
</div>


<div class="group box_wrap">
	<h6>모집내용<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tr class="personnel">
				<th><?php echo $icon_need;?>모집인원</th>
				<td>
					<ul class="li_float">
						<li><label for="" style="margin-right:0">
						<?php
						if(!in_array($em_row['wr_person'], $nf_job->person_arr)) {
							$wr_person = $nf_util->get_html($em_row['wr_person']);
							$wr_person_needed = "needed";
						}
						if(in_array($em_row['wr_person'], $nf_job->person_arr)) {
							$wr_person_disabled = 'disabled';
						}
						?> <input type="text" class="input10 <?php echo $wr_person_disabled;?>" <?php echo $wr_person_disabled;?> name="wr_person" hname="모집인원" <?php echo $wr_person_needed;?> value="<?php echo $wr_person;?>">명
						</label></li>
						<?php
						if(is_Array($nf_job->person_arr)) { foreach($nf_job->person_arr as $k=>$v) {
							$checked = $em_row['wr_person']===$v ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_volumes[]" onClick="nf_util.one_check(this);nf_job.click_volume(this)" value="<?php echo $v;?>" <?php echo $checked;?>><?php echo $v;?>명</label></li>
						<?php
						} }?>
					</ul>
				</td>
			</tr>
			<tr class="group_close">
				<th><?php echo $icon_need;?>모집종료일</th>
				<td>
					<ul class="li_float">
						<?php
						if(!array_key_exists($em_row['wr_end_date'], $nf_job->volume_check)) {
							$wr_end_date = $nf_util->get_html($em_row['wr_end_date']);
							$wr_end_date_needed = "needed";
						}
						if(array_key_exists($em_row['wr_end_date'], $nf_job->volume_check)) {
							$wr_end_date_disabled = 'disabled';
						}
						?>
						<li>날짜선택 <input type="text" name="wr_end_date" value="<?php echo $wr_end_date;?>" <?php echo $wr_end_date_disabled;?> hname="모집종료일" <?php echo $wr_end_date_needed;?> class="input10 datepicker_inp_enddate <?php echo $wr_end_date_disabled;?>"></label> </li>
						<?php
						if(is_array($nf_job->volume_check)) { foreach($nf_job->volume_check as $k=>$v) {
							$checked = $k==$em_row['wr_end_date'] ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="end_date_check[]" onClick="nf_util.one_check(this);nf_job.click_end_date_check(this)" value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v;?></label></li>
						<?php
						} }?>
					</ul>
				</td>
			</tr>
			<tr class="receipt">
				<th><?php echo $icon_need;?>접수방법</th>
				<td>
					<ul class="li_float">
						<?php
						if(is_array($nf_job->requisition)) { foreach($nf_job->requisition as $k=>$v) {
							$checked = is_array($employ_info['requisition_arr']) && in_array($k, $employ_info['requisition_arr']) ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_requisition[]" onClick="nf_job.click_requisition(this)" hname="접수방법" needed <?php echo $checked;?> value="<?php echo $k;?>"><?php echo $v;?></label></li>
						<?php
						} }?>
					</ul>
					<!-- <div class="MAT10 requisition_online- requisition-" style="display:<?php //echo in_array('online', $employ_info['requisition_arr']) ? 'block' : 'none';?>;"> 
						<ul class="li_float">
							<li><label><input type="checkbox" name="wr_form" value="1" <?php echo $em_row['wr_form'] ? 'checked' : '';?> onClick="nf_util.click_block(this, '.wr_form_attach-c')" />자사양식지원</label></li>
							<span class="wr_form_attach-c" style="display:<?php echo $em_row['wr_form'] ? 'block' : 'none';?>;">
							<li><label><input type="radio" class="chk" name="wr_form_required" value="1" checked>필수</label></li>
							<li><label><input type="radio" class="chk" name="wr_form_required" value="0" <?php echo !$em_row['wr_form_required'] ? 'checked' : '';?>>선택</label></li>
							</span>
						</ul>	
						<p class="MAT10 wr_form_attach-c" style="display:<?php echo $em_row['wr_form'] ? 'block' : 'none';?>;"><input type="file" name="wr_form_attach"> <?php //if(is_file(NFE_PATH.'/data/employ/'.$em_row['wr_form_attach'])) {?><a href="<?php echo NFE_URL;?>/include/regist.php?mode=wr_form_attach_download&no=<?php echo $em_row['no'];?>"><button type="button" style="border:1px solid #ddd; font-size:12px; padding:3px 5px; color:#555; ">파일다운</button></a> &nbsp;&nbsp;&nbsp; <button class="form_attach_delete-" style="border:1px solid #ddd;font-size:12px; padding:3px 5px; color:#555;" type="button" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $em_row['no'];?>" mode="delete_employ_attach" url="<?php echo NFE_URL;?>/include/regist.php">파일삭제</button><?php //}?></p>
					</div>
					<div class="MAT10 requisition_homepage- requisition-" style="display:<?php echo in_array('homepage', $employ_info['requisition_arr']) ? 'block' : 'none';?>;">
						<input type="text" class="long100" name="wr_homepage" value="<?php echo $nf_util->get_html($em_row['wr_homepage']);?>" placeholder="접수받을 홈페이지 링크등록 : http://나 https://를 포함해서 등록해주시기 바랍니다.">
					</div> -->
				</td>
			</tr>
			<?php
			if($register_form_arr['register_form_employ']['모집대상']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['모집대상']['wr_0']) echo $icon_need;?>모집대상</th>
				<td>
					<ul class="li_float">
						<?php
						if(is_array($cate_p_array['job_target'][0])) { foreach($cate_p_array['job_target'][0] as $k=>$v) {
							$checked = is_array($employ_info['target_arr']) && in_array($k, $employ_info['target_arr']) ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_target[]" hname="모집대상" <?php if($register_form_arr['register_form_employ']['모집대상']['wr_0']) echo 'needed';?> value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
						<?php
						} }?>
					</ul>
				</td>
			</tr>
			<?php
			}?>
			<?php
			if($register_form_arr['register_form_employ']['제출서류']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['제출서류']['wr_0']) echo $icon_need;?>제출서류</th>
				<td>
					<ul class="li_float">
						<?php
						if(is_array($cate_p_array['job_document'][0])) { foreach($cate_p_array['job_document'][0] as $k=>$v) {
							$checked = is_array($employ_info['papers_arr']) && in_array($k, $employ_info['papers_arr']) ? 'checked' : '';
						?>
						<li><label><input type="checkbox" name="wr_papers[]" hname="제출서류" <?php if($register_form_arr['register_form_employ']['모집대상']['wr_0']) echo 'needed';?> value="<?php echo $k;?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></li>
						<?php
						} }?>
					</ul>
				</td>
			</tr>
			<?php
			}?>
			<?php
			/*
			if($register_form_arr['register_form_employ']['사전질문']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['사전질문']['wr_0']) echo $icon_need;?>사전질문</th>
				<td>
					<textarea name="wr_pre_question" hname="사전질문" <?php if($register_form_arr['register_form_employ']['사전질문']['wr_0']) echo 'needed';?> cols="30" rows="10" placeholder="사전인터뷰 질문을 등록하시면 온라인 입사지원시 지원자가 이력서와 함께 질문에 대한 답변을 작성해서 보냅니다."><?php echo stripslashes($em_row['wr_pre_question']);?></textarea>
				</td>
			</tr>
			<?php
			}
			*/?>
		</table>
	</div>
</div>

<div class="manager box_wrap">
	<div class="side_con">
		<h6>인사 담당자 정보<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
		<div class="h_right">
			<?php
			$manager_query = $db->_query("select * from nf_manager as nm where nm.`mno`=".intval($member['no'])." and `cno`=".intval($cno_no));
			?>
			<select title="담당자정보 불러오기" name="ch_manager" onChange="nf_job.ch_manager(this)">
				<option value="">담당자정보 불러오기</option>
				<?php
				while($manager_row=$db->afetch($manager_query)) {
				?>
				<option value="<?php echo intval($manager_row['no']);?>"><?php echo $nf_util->get_text($manager_row['wr_name']);?></option>
				<?php
				}?>
			</select>
		</div>
	</div>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tbody>
			<!-- <tr>
				<th><?php echo $icon_need;?>닉네임</th>
				<td><input type="text" name="wr_nickname" value="<?php //echo $nf_util->get_html($em_row['wr_nickname']);?>" hname="닉네임" needed></td>
			</tr> -->
			<tr>
				<th>담당자명</th>
				<td><input type="text" name="wr_name" value="<?php echo $nf_util->get_html($em_row['wr_name']);?>" hname="담당자명" ></td>
			</tr>
			<tr class="">
				<th>연락처</th>
				<td>
					<input type="text" class="long" name="wr_phone" value="<?php echo $nf_util->get_html($employ_info['phone_arr'][0]);?>" hname="전화번호" >
					
					<span><label><input type="checkbox" name="manager_not_view[]" value="phone" <?php echo is_array($employ_info['manager_not_view_arr']) && in_array('phone', $employ_info['manager_not_view_arr']) ? 'checked' : '';?>>비노출</label></span>
				</td>
			</tr>
			<?php
			if($register_form_arr['register_form_employ']['담당자 휴대폰']) {
			?>
			<tr class="num">
				<th><?php if($register_form_arr['register_form_employ']['담당자 휴대폰']['wr_0']) echo $icon_need;?>휴대폰</th>
				<td>
					<input type="text" class="input10" name="wr_hphone[]" value="<?php echo $nf_util->get_html($employ_info['hphone_arr'][0]);?>" hname="휴대폰" <?php if($register_form_arr['register_form_employ']['담당자 휴대폰']['wr_0']) echo 'needed';?>> -
					<input type="text" class="input10" name="wr_hphone[]" value="<?php echo $nf_util->get_html($employ_info['hphone_arr'][1]);?>" hname="휴대폰 앞자리" <?php if($register_form_arr['register_form_employ']['담당자 휴대폰']['wr_0']) echo 'needed';?>> -
					<input type="text" class="input10" name="wr_hphone[]" value="<?php echo $nf_util->get_html($employ_info['hphone_arr'][2]);?>" hname="휴대폰 뒷앞자리" <?php if($register_form_arr['register_form_employ']['담당자 휴대폰']['wr_0']) echo 'needed';?>>
					<span><label><input type="checkbox" name="manager_not_view[]" value="hphone" <?php echo is_array($employ_info['manager_not_view_arr']) && in_array('hphone', $employ_info['manager_not_view_arr']) ? 'checked' : '';?>>비노출</label></span>
				</td>
			</tr>
			<?php
			}?>
			<?php
			if($register_form_arr['register_form_employ']['담당자 팩스']) {
			?>
			<tr class="num">
				<th><?php if($register_form_arr['register_form_employ']['담당자 팩스']['wr_0']) echo $icon_need;?>팩스번호</th>
				<td>
					<input type="text" class="input10" name="wr_fax[]" value="<?php echo $nf_util->get_html($employ_info['fax_arr'][0]);?>" hname="팩스번호" <?php if($register_form_arr['register_form_employ']['담당자 팩스']['wr_0']) echo 'needed';?>> -
					<input type="text" class="input10" name="wr_fax[]" value="<?php echo $nf_util->get_html($employ_info['fax_arr'][1]);?>" hname="팩스번호 앞자리" <?php if($register_form_arr['register_form_employ']['담당자 팩스']['wr_0']) echo 'needed';?>> -
					<input type="text" class="input10" name="wr_fax[]" value="<?php echo $nf_util->get_html($employ_info['fax_arr'][2]);?>" hname="팩스번호 뒷자리" <?php if($register_form_arr['register_form_employ']['담당자 팩스']['wr_0']) echo 'needed';?>>
					<span><label><input type="checkbox" name="manager_not_view[]" value="fax" <?php echo is_array($employ_info['manager_not_view_arr']) && in_array('fax', $employ_info['manager_not_view_arr']) ? 'checked' : '';?>>비노출</label></span>
				</td>
			</tr>
			<?php
			}?>
			<?php
			if($register_form_arr['register_form_employ']['담당자 이메일']) {
			?>
			<tr>
				<th><?php if($register_form_arr['register_form_employ']['담당자 이메일']['wr_0']) echo $icon_need;?>이메일</th>
				<td>
					<input type="text" class="input10" name="wr_email[]" value="<?php echo $nf_util->get_html($employ_info['email_arr'][0]);?>" hname="이메일" <?php if($register_form_arr['register_form_employ']['담당자 이메일']['wr_0']) echo 'needed';?>> @
					<input type="text" class="input10" name="wr_email[]" value="<?php echo $nf_util->get_html($employ_info['email_arr'][1]);?>" hname="이메일 서비스 제공자" <?php if($register_form_arr['register_form_employ']['담당자 이메일']['wr_0']) echo 'needed';?>>
					<select onChange="nf_util.ch_email(this)">
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
					<span><label><input type="checkbox" name="manager_not_view[]" value="email" <?php echo is_array($employ_info['manager_not_view_arr']) && in_array('email', $employ_info['manager_not_view_arr']) ? 'checked' : '';?>>비노출</label></span>
				</td>
			</tr>
			<?php
			}?>
			<tr>
				<th>SNS 메신져</th>
				<td>
					<select name="wr_messanger" hname="SNS 메신져">
						<option value="">선택</option>
						<?php
						if(is_array($cate_p_array['job_listed'][0])) { foreach($cate_p_array['job_listed'][0] as $k=>$v) {
							$selected = $em_row['wr_messanger']==$k ? 'selected' : '';
						?>
						<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
						<?php
						} }?>
					</select> 
					<input type="text" name="wr_messanger_id" hname="메신져 아이디" value="<?php echo $nf_util->get_html($em_row['wr_messanger_id']);?>" class="input10"> 
				</td>
			</tr>
		</table>
	</div>
</div>


<div class="recruitment box_wrap">
	<div class="side_con">
		<h6>상세모집요강<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
		<!-- <div class="h_right">
			<button type="button" onClick="nf_job.put_skin_content(this)" class="blue basebtn">입력한 내용으로 모집요강 적용</button>
		</div> -->
	</div>
	<!-- <div class="common_box click-skin-">
		<ul>
			<li class="<?php //echo !$em_row['wr_content_skin'] ? 'on' : '';?>" skin=""><a ><img src="../../images/skin0.png" alt="스킨사용안함"></a></li>
			<li class="<?php //echo $em_row['wr_content_skin']==1 ? 'on' : '';?>" skin="1"><a ><img src="../../images/skin1.png" alt="스킨1"></a></li>
			<li class="<?php //echo $em_row['wr_content_skin']==2 ? 'on' : '';?>" skin="2"><a ><img src="../../images/skin2.png" alt="스킨2"></a></li>
			<li class="<?php //echo $em_row['wr_content_skin']==3 ? 'on' : '';?>" skin="3"><a ><img src="../../images/skin3.png" alt="스킨3"></a></li>
		</ul>
	</div> -->
	<div class="click-skin-td-">
		<div class="write">
			<script type="text/javascript">prev_click_detail_skin = "<?php echo $em_row['wr_content_skin'];?>";</script>
			<textarea type="editor" name="wr_content" style="height:300px;" hname="모집요강내용" nofocus><?php echo stripslashes($em_row['wr_content']);?></textarea>
		</div>
		<input type="hidden" name="wr_content_skin" value="<?php echo $em_row['wr_content_skin'];?>" />
	</div>
</div>

<?php /* ?>
<div class="img_box box_wrap">
	<h6>업소 이미지/동영상 등록<span> <em class="ess">*</em>표시는 필수 입력사항</span></h6>
	<div class="common_box">
		<table class="com_table">
			<colgroup>
				<col width="10%">
			</colgroup>
			<tr>
				<td colspan="2">
					<div class="parent_file_upload-">
						<div class="one">
							<button type="button" onClick="nf_job.click_file(this, 'file_upload-', 'company')" class="gray basebtn">이미지 등록</button><span class="blue bojotext"><b><?php echo strtoupper(implode(", ", $nf_util->photo_ext));?></b> 파일형식으로 <b>100KB 용량 이내</b>의 파일을 권장합니다.</span>
						</div>
						<div class="two">
							<ul>
							<?php
							for($i=0; $i<4; $i++) {
								$photo_val = is_file(NFE_PATH.'/data/employ/'.$employ_info['photo_arr'][$i]) ? $employ_info['photo_arr'][$i] : '';
							?>
							<li class="company_img img put_img-" style="<?php if(is_file(NFE_PATH.'/data/employ/'.$photo_val)) {?>background-image:url(<?php echo NFE_URL.'/data/employ/'.$photo_val;?>);<?php }?>"><span><a href="#none" onClick="nf_job.click_file_delete(this, 'company', <?php echo intval($i);?>)"><i class="axi axi-close"></i></a></span><input type="hidden" name="wr_photo[]" value="<?php echo $photo_val;?>" class="put_image-" /></li>
							<?php
							}?>
							</ul>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<th>동영상 등록</th>
				<td><textarea name="wr_movie"><?php echo stripslashes($em_row['wr_movie']);?></textarea><span class="blue bojotext">* iframe 형식으로 동영상을 넣으실 수 있습니다.</span></td>
			</tr>	
		</table>
	</div>
</div>
<?php */ ?>


<?php
if($register_form_arr['register_form_employ']['테마선택']) {
?>
<div class="keyword box_wrap">
	<h6>테마선택</h6>
		
			<table class="table3">
				<colgroup>
					<col width="25%">
					<col width="25%">
					<col width="25%">
					<col width="25%">
				</colgroup>
				<?php
				$_width = 4;
				$count = 0;
				if(is_array($cate_p_array['job_tema'][0])) { foreach($cate_p_array['job_tema'][0] as $k=>$v) {
					echo $count%$_width===0 ? '<tr>' : '';
					$checked = is_array($employ_info['keyword_arr']) && in_array($v['wr_name'], $employ_info['keyword_arr']) ? 'checked' : '';
				?>
					<td><label><input type="checkbox" name="wr_keyword[]" hname="테마" <?php if($register_form_arr['register_form_employ']['테마선택']['wr_0']) echo 'needed';?> value="<?php echo $v['wr_name'];?>" <?php echo $checked;?>><?php echo $v['wr_name'];?></label></td>
				<?php
					$count++;
				} }
				$remain_len = $nf_util->get_remain($count, $_width);
				echo str_repeat('<td></td>', $remain_len);
				?>
			</table>
		
</div>
<?php
}?>