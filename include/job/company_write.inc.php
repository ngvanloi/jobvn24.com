<?php
$mb_phone_arr = explode("-", $company_row['mb_biz_phone']);
$mb_hphone_arr = explode("-", $company_row['mb_biz_hphone']);
$mb_email_arr = explode("@", $company_row['mb_biz_email']);
$mb_fax_arr = explode("-", $company_row['mb_biz_fax']);
$mb_biz_no_arr = explode("-", $company_row['mb_biz_no']);
?>
<tr>
	<th>대표자명</th>
	<td><input type="text" name="mb_ceo_name" value="<?php echo $nf_util->get_html($company_row['mb_ceo_name']); ?>"
			hname="대표자명"></td>
</tr>
<tr>
	<th>업소/점포명</th>
	<td>
		<input type="text" name="mb_company_name"
			value="<?php echo $nf_util->get_html($company_row['mb_company_name']); ?>" hname="업소/점포명">
	</td>
</tr>
<!-- <tr>
	<th><?php //echo $icon_need; ?>업소분류</th>
	<td>
		<select title="업소분류선택" name="mb_biz_type" needed hname="업소분류">
			<option value="">업소분류 선택</option>
			<?php
			//if(is_array($cate_p_array['job_company'][0])) { foreach($cate_p_array['job_company'][0] as $k=>$v) {
			//$selected = $company_row['mb_biz_type']==$v['wr_name'] ? 'selected' : '';
			?>
			<option value="<?php //echo $nf_util->get_html($v['wr_name']); ?>" <?php //echo $selected; ?>><?php //echo $v['wr_name']; ?></option>
			<?php
			//} }
			?>
		</select>
	</td>
</tr> -->
<tr>
	<th>연락처</th>
	<td class="">
		<input type="text" name="mb_phone" hname="연락처" class=""
			value="<?php echo $nf_util->get_html($mb_phone_arr[0]); ?>">
	</td>
</tr>
<tr>
	<th>휴대폰</i></th>
	<td class="">
		<input type="text" name="mb_hphone" hname="휴대폰" class=""
			value="<?php echo $nf_util->get_html($mb_hphone_arr[0]); ?>">
	</td>
</tr>
<tr>
	<th>이메일</th>
	<td>
		<input type="text" name="mb_email[]" hname="이메일" class="input10"
			value="<?php echo $nf_util->get_html($mb_email_arr[0]); ?>"> @
		<input type="text" name="mb_email[]" hname="이메일" class="input10"
			value="<?php echo $nf_util->get_html($mb_email_arr[1]); ?>" id="mb_email_">
		<select onChange="nf_util.ch_value(this, '#mb_email_')">
			<option value="">직접입력</option>
			<?php
			if (is_array($cate_p_array['email'][0])) {
				foreach ($cate_p_array['email'][0] as $k => $v) {
					?>
					<option value="<?php echo $nf_util->get_html($v['wr_name']); ?>"><?php echo $v['wr_name']; ?></option>
					<?php
				}
			}
			?>
		</select>
		<!-- <span><span><em>* 입사지원에 사용됩니다. 실제 정보를 입력해주세요</em></span></span> -->
	</td>
</tr>

<!-- <tr>
	<th>팩스번호</th>
	<td class="size1">
		<input type="text" name="mb_biz_fax[]" hname="팩스 지역번호" class="input10" value="<?php //echo $nf_util->get_html($mb_fax_arr[0]); ?>" class="input10"> -
		<input type="text" name="mb_biz_fax[]" hname="팩스번호 앞자리" value="<?php //echo $nf_util->get_html($mb_fax_arr[1]); ?>" class="input10"> -
		<input type="text" name="mb_biz_fax[]" hname="팩스번호 뒷자리" value="<?php //echo $nf_util->get_html($mb_fax_arr[2]); ?>" class="input10">
	</td>
</tr> -->
<tr>
	<th>업소주소</th>
	<td class="area-address-">
		<input type="text" name="mb_address0" class="long100"
			value="<?php echo $nf_util->get_html($my_member['mb_address0']); ?>">
	</td>
</tr>
<tr>
	<th>업소로고</th>
	<td>
		<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_logo'])) { ?>
			<img src="<?php echo NFE_URL . '/data/member/' . $company_row['mb_logo']; ?>" style="width:50px;height:50px;" />
		<?php } ?>
		<input type="file" name="mb_logo"><span><em>[ 권장 : 넓이 400px, 높이 200px ]</em></span>
		<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_logo'])) { ?>
			<button type="button" onClick="nf_member.delete_my_logo('<?php echo $company_row['no']; ?>')"
				style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일삭제</button>
		<?php } ?>
	</td>
</tr>
<tr>
	<th>업소이미지</th>
	<td>
		<ul class="company_join_img">
			<li>
				<input type="file" name="mb_img1"><span><em>[ 권장 : 넓이 286px, 높이 160px ]</em></span>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img1'])) { ?>
					<button type="button" onClick="nf_member.delete_my_img1('<?php echo $company_row['no']; ?>')"
						style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일삭제</button>
				<?php } ?>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img1'])) { ?>
					<img src="<?php echo NFE_URL . '/data/member/' . $company_row['mb_img1']; ?>"
						style="width:50px;height:50px;" />
				<?php } ?>
			</li>
			<li>
				<input type="file" name="mb_img2"><span><em>[ 권장 : 넓이 286px, 높이 160px ]</em></span>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img2'])) { ?>
					<button type="button" onClick="nf_member.delete_my_img2('<?php echo $company_row['no']; ?>')"
						style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일삭제</button>
				<?php } ?>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img2'])) { ?>
					<img src="<?php echo NFE_URL . '/data/member/' . $company_row['mb_img2']; ?>"
						style="width:50px;height:50px;" />
				<?php } ?>
			</li>
			<li>
				<input type="file" name="mb_img3"><span><em>[ 권장 : 넓이 286px, 높이 160px ]</em></span>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img3'])) { ?>
					<button type="button" onClick="nf_member.delete_my_img3('<?php echo $company_row['no']; ?>')"
						style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일삭제</button>
				<?php } ?>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img3'])) { ?>
					<img src="<?php echo NFE_URL . '/data/member/' . $company_row['mb_img3']; ?>"
						style="width:50px;height:50px;" />
				<?php } ?>
			</li>
			<li>
				<input type="file" name="mb_img4"><span><em>[ 권장 : 넓이 286px, 높이 160px ]</em></span>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img4'])) { ?>
					<button type="button" onClick="nf_member.delete_my_img4('<?php echo $company_row['no']; ?>')"
						style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일삭제</button>
				<?php } ?>
				<?php if (is_file(NFE_PATH . '/data/member/' . $company_row['mb_img4'])) { ?>
					<img src="<?php echo NFE_URL . '/data/member/' . $company_row['mb_img4']; ?>"
						style="width:50px;height:50px;" />
				<?php } ?>
			</li>
		</ul>



	</td>
</tr>
<tr>
	<th>업소동영상</th>
	<td><textarea name="mb_movie"><?php echo stripslashes($company_row['mb_movie']); ?></textarea><span
			class="blue bojotext">* iframe 형식으로 동영상을 넣으실 수 있습니다.</span></td>
</tr>

<!-- <tr>
	<th>홈페이지</th>
	<td><input type="text" name="mb_homepage" value="<?php //echo $nf_util->get_html($company_row['mb_homepage']); ?>" class="long" placeholder="http://"></td>
</tr> -->
<?php
if ($register_form_arr['register_form_company']['사업자번호']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['사업자번호']['wr_0'])
			echo $icon_need; ?>사업자 번호</th>
		<td class="size1">
			<input type="text" name="mb_biz_no[]" hname="사업자번호" <?php if ($register_form_arr['register_form_company']['사업자번호']['wr_0'])
				echo 'needed'; ?>
				value="<?php echo $nf_util->get_html($mb_biz_no_arr[0]); ?>" class="input10"> -
			<input type="text" name="mb_biz_no[]" hname="사업자번호" <?php if ($register_form_arr['register_form_company']['사업자번호']['wr_0'])
				echo 'needed'; ?>
				value="<?php echo $nf_util->get_html($mb_biz_no_arr[1]); ?>" class="input10"> -
			<input type="text" name="mb_biz_no[]" hname="사업자번호" <?php if ($register_form_arr['register_form_company']['사업자번호']['wr_0'])
				echo 'needed'; ?>
				value="<?php echo $nf_util->get_html($mb_biz_no_arr[2]); ?>" class="input10">
		</td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['사업자등록증첨부']) {
	$mb_biz_attach = is_file(NFE_PATH . '/data/member/' . $company_row['mb_biz_attach']);
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['사업자등록증첨부']['wr_0'])
			echo $icon_need; ?>사업자등록증</th>
		<td class="size1">
			<input type="file" name="mb_biz_attach" hname="사업자등록증첨부" <?php if ($register_form_arr['register_form_company']['사업자등록증첨부']['wr_0'] && !$mb_biz_attach)
				echo 'needed'; ?> />
			<?php
			if ($mb_biz_attach) {
				?>
				<img src="<?php echo NFE_URL; ?>/data/member/<?php echo $company_row['mb_biz_attach']; ?>"
					style="width:50px;height:50px;" />
				<?php if ($is_admin) { ?>
					<a href="<?php echo NFE_URL; ?>/include/regist.php?mode=download_biz_attach&no=<?php echo $company_row['no']; ?>"
						style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일다운</a>
				<?php } ?>
				<button type="button" onClick="nf_member.delete_my_biz_attach('<?php echo $company_row['no']; ?>')"
					style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일삭제</button>
				<?php
			} ?>
			<span><span><em>* 이미지(jpg, jpeg, gif, png)만 등록 가능합니다.</em></span></span>
		</td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['상장여부']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['상장여부']['wr_0'])
			echo $icon_need; ?>상장여부</th>
		<td>
			<select title="상장여부선택" name="mb_biz_success" <?php if ($register_form_arr['register_form_company']['상장여부']['wr_0'])
				echo 'needed'; ?> hname="상장여부">
				<option value="">상장여부 선택</option>
				<?php
				if (is_array($cate_p_array['job_listed'][0])) {
					foreach ($cate_p_array['job_listed'][0] as $k => $v) {
						$selected = $company_row['mb_biz_success'] == $v['wr_name'] ? 'selected' : '';
						?>
						<option value="<?php echo $nf_util->get_html($v['wr_name']); ?>" <?php echo $selected; ?>>
							<?php echo $v['wr_name']; ?>
						</option>
						<?php
					}
				}
				?>
			</select>
		</td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['업소형태']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['업소형태']['wr_0'])
			echo $icon_need; ?>업소형태</th>
		<td>
			<select title="업소형태선택" name="mb_biz_form" <?php if ($register_form_arr['register_form_company']['업소형태']['wr_0'])
				echo 'needed'; ?> hname="업소형태">
				<option value="">업소형태 선택</option>
				<?php
				if (is_array($cate_p_array['job_company_type'][0])) {
					foreach ($cate_p_array['job_company_type'][0] as $k => $v) {
						$seletced = $company_row['mb_biz_form'] == $v['wr_name'] ? 'selected' : '';
						?>
						<option value="<?php echo $nf_util->get_html($v['wr_name']); ?>" <?php echo $seletced; ?>>
							<?php echo $v['wr_name']; ?>
						</option>
						<?php
					}
				}
				?>
			</select>
		</td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['주요사업내용']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['주요사업내용']['wr_0'])
			echo $icon_need; ?>주요사업내용</th>
		<td><input type="text" name="mb_biz_content" hname="주요사업내용" <?php if ($register_form_arr['register_form_company']['주요사업내용']['wr_0'])
			echo 'needed'; ?>
				value="<?php echo $nf_util->get_html($company_row['mb_biz_content']); ?>" class="long100"></td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['설립년도']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['설립년도']['wr_0'])
			echo $icon_need; ?>설립년도</th>
		<td>
			<select name="mb_biz_foundation" hname="설립년도" <?php if ($register_form_arr['register_form_company']['설립년도']['wr_0'])
				echo 'needed'; ?>>
				<option value="">년도</option>
				<?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					$selected = $company_row['mb_biz_foundation'] == $i ? 'selected' : '';
					?>
					<option value="<?php echo intval($i); ?>" <?php echo $selected; ?>><?php echo intval($i); ?></option>
					<?php
				} ?>
			</select>
			설립
		</td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['사원수']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['사원수']['wr_0'])
			echo $icon_need; ?>사원수</th>
		<td><input type="text" name="mb_biz_member_count"
				value="<?php echo $nf_util->get_html($company_row['mb_biz_member_count']); ?>" hname="사원수" <?php if ($register_form_arr['register_form_company']['사원수']['wr_0'])
					   echo 'needed'; ?>> 명 <span><em>( 예 : 200
					)</em></span></td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['자본금']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['자본금']['wr_0'])
			echo $icon_need; ?>자본금</th>
		<td><input type="text" name="mb_biz_stock" hname="자본금" <?php if ($register_form_arr['register_form_company']['자본금']['wr_0'])
			echo 'needed'; ?>
				value="<?php echo $nf_util->get_html($company_row['mb_biz_stock']); ?>"> 원 <span><em>( 예 : 3억 5천만
					)</em></span></td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['매출액']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['매출액']['wr_0'])
			echo $icon_need; ?>매출액</th>
		<td><input type="text" name="mb_biz_sale" hname="매출액" <?php if ($register_form_arr['register_form_company']['매출액']['wr_0'])
			echo 'needed'; ?>
				value="<?php echo $nf_util->get_html($company_row['mb_biz_sale']); ?>"> 원 <span><em>( 예 : 3억 5천만
					)</em></span></td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['업소개요 및 비전']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['업소개요 및 비전']['wr_0'])
			echo $icon_need; ?>업소개요 및 비전</th>
		<td><textarea type="editor" name="mb_biz_vision" hname="업소개요 및 비전" <?php if ($register_form_arr['register_form_company']['업소개요 및 비전']['wr_0'])
			echo 'needed'; ?>
				style="height:200px;width:100% !important;"><?php echo stripslashes($company_row['mb_biz_vision']); ?></textarea>
		</td>
	</tr>
	<?php
} ?>
<?php
if ($register_form_arr['register_form_company']['업소연혁 및 실적']) {
	?>
	<tr>
		<th><?php if ($register_form_arr['register_form_company']['업소연혁 및 실적']['wr_0'])
			echo $icon_need; ?>업소연혁 및 실적</th>
		<td><textarea type="editor" name="mb_biz_result" hname="업소연혁 및 실적" <?php if ($register_form_arr['register_form_company']['업소연혁 및 실적']['wr_0'])
			echo 'needed'; ?>
				style="height:200px;width:100% !important;"><?php echo stripslashes($company_row['mb_biz_result']); ?></textarea>
		</td>
	</tr>
	<?php
} ?>