<table class="style1">
	<colgroup>
		<col width="10%">
	</colgroup>
	<tbody>
		<?php if ((!$my_member['no'] && strpos($_SERVER['PHP_SELF'], "/member/update_form.php") === false) || $admin_page) { ?>
			<tr>
				<th><?php echo $icon_need; ?>회원아이디</th>
				<td>
					<?php if ($mem_row) { ?>
						<div><?php echo $mem_row['mb_id']; ?></div>
					<?php } else { ?>
						<input type="text" name="mb_id" id="fmember_mb_id" value="<?php echo $mem_row['mb_id']; ?>" hname="아이디"
							needed option="userid" minbyte="5" maxbyte="20" maxlength="20" class="input10"
							onkeyup="nf_util.input_text(this)"><input type="hidden" class="check_mb_id- dupl-hidden-"
							name="check_mb_id" value="1" message="아이디를 중복확인해주시기 바랍니다." needed /><button type="button"
							onClick="nf_member.check_uid('fmember_mb_id')" class="base2 basebtn gray MAL5">중복확인</button>
					<?php } ?>
				</td>
			</tr>
			<?php if (!$member['mb_is_sns']) { ?>
				<tr>
					<th><?php echo $icon_need; ?>비밀번호</th>
					<td><input type="password" name="mb_password" hname="비밀번호" <?php echo $admin_page ? '' : 'needed'; ?>
							minbyte="5" maxbyte="20" option="userpw" maxlength="20" class="input10"><span><em>* 5~20자 사이의 영문,
								숫자, 특수문자중 최소 2가지 이상 조합해주세요.</em></span></td>
				</tr>
			<?php } ?>
			<?php if ($admin_page) { ?>
				<tr>
					<th>기본프로필사진</th>
					<td>
						<?php if (is_file(NFE_PATH . '/data/member/' . $my_member['mb_photo'])) { ?>
							<img src="<?php echo NFE_URL . '/data/member/' . $my_member['mb_photo']; ?>"
								style="width:50px;height:50px;" />
						<?php } ?>
						<input type="file" name="mb_photo"><span>권장 : 넓이 140px, 높이 170px, 100KB 용량 이내</span>
						<?php if ($nf_member->member_arr[$my_member['no']]['is_photo']) { ?>
							<button type="button" onClick="nf_member.delete_my_photo('<?php echo $my_member['no']; ?>')"
								style="border:1px solid #d5d5d5; margin-left:5px; padding:5px; height:auto; line-height:initial; vertical-align:middle;">파일삭제</button>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<th><?php echo $icon_need; ?>회원등급</th>
					<td>
						<select name="mb_level" hname="회원등급" needed>
							<option value="">회원등급 선택</option>
							<?php
							if (is_array($env['member_level_arr'])) {
								foreach ($env['member_level_arr'] as $k => $v) {
									if ($k <= 0)
										continue;
									$selected = $mem_row['mb_level'] == $k ? 'selected' : '';
									?>
									<option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $v['name']; ?>
										(<?php echo $k + 1; ?>레벨)</option>
									<?php
								}
							}
							?>
						</select>
					</td>
				</tr>
				<?php
			} else {
				if (!$member['mb_is_sns']) {
					?>
					<tr>
						<th><?php echo $icon_need; ?>비밀번호 확인</th>
						<td><input type="password" name="mb_passwd2" hname="비밀번호 확인" needed minbyte="5" maxbyte="20" option="userpw"
								class="input10" maxlength="20" matching="mb_password"><em> * 비밀번호를 한번 더 입력해 주십시오.</em></td>
					</tr>
					<?php
				}
			} ?>
			<?php
		} ?>
		<tr>
			<th>이름</th>
			<td><input type="text" name="mb_name" value="<?php echo $nf_util->get_html($my_member['mb_name']); ?>"
					hname="이름"><span><em>* 실명인증 사용을 위해 실명을 입력해주세요.</em></span></td>
		</tr>
		<tr>
			<th><?php echo $icon_need; ?>생년월일/성별</th>
			<td>
				<input type="text" name="mb_birth" value="<?php echo $nf_util->get_html($my_member['mb_birth']); ?>"
					hname="생년월일" needed readOnly class="datepicker_inp" style="width:100px;" />
				&nbsp;&nbsp;&nbsp;
				<label for="mb_gender_0" name="mb_gender" class="radiostyle1"><input type="radio" id="mb_gender_0"
						name="mb_gender" value="1" <?php echo $my_member['mb_gender'] === '1' ? 'checked' : ''; ?>
						hname="성별" needed>남</label>
				<label for="mb_gender_1" name="mb_gender" class="radiostyle1"><input type="radio" id="mb_gender_1"
						name="mb_gender" value="2" <?php echo $my_member['mb_gender'] === '2' ? 'checked' : ''; ?>
						hname="성별" needed>여</label>
			</td>
		</tr>
		<tr>
			<th>닉네임</th>
			<td>
				<input type="text" name="mb_nick" id="fmember_mb_nick" class="mb_nick_individual"
					value="<?php echo $nf_util->get_html($my_member['mb_nick']); ?>" onkeyup="nf_util.input_text(this)"
					hname="닉네임" needed><input type="hidden" class="check_mb_nick- dupl-hidden- mb_nick_individual"
					name="check_mb_nick" value="<?php echo $my_member['mb_nick'] ? '1' : ''; ?>"
					message="닉네임을 중복확인해주시기 바랍니다." />
				<!-- <button type="button" onClick="nf_member.check_nick('fmember_mb_nick')"
					class="base2 basebtn gray MAL5">중복확인</button> -->
				<br>
				<span><em> * 커뮤니티(게시판)등 익명성이 필요한 곳에서
						사용됩니다.</em></span><br><span><em>* 미입력 시 닉네임은 무작위로 지정됩니다.</em></span>
			</td>
		</tr>
		<tr>
			<th>이메일</th>
			<td>
				<input type="text" name="mb_email[]" hname="이메일" class="input10"
					value="<?php echo $nf_util->get_html($mb_email_arr[0]); ?>"> @
				<input type="text" name="mb_email[]" hname="이메일" class="input10"
					value="<?php echo $nf_util->get_html($mb_email_arr[1]); ?>" id="mb_email_" hname="이메일">
				<select onChange="nf_util.ch_value(this, '#mb_email_')">
					<option value="">직접입력</option>
					<?php
					if (is_array($cate_p_array['email'][0])) {
						foreach ($cate_p_array['email'][0] as $k => $v) {
							?>
							<option value="<?php echo $nf_util->get_html($v['wr_name']); ?>"><?php echo $v['wr_name']; ?>
							</option>
							<?php
						}
					}
					?>
				</select>
				<span><em>* 구인정보에 사용됩니다. 실제 정보를 입력해주세요</em></span>
			</td>
		</tr>
		<tr>
			<th><?php echo $icon_need; ?>연락처</th>
			<td class="">
				<input type="text" name="mb_phone" hname="연락처" needed class=""
					value="<?php echo $nf_util->get_html($mb_phone_arr[0]); ?>">
				<span><em>* 구인정보에 사용됩니다. 실제 정보를 입력해주세요</em></span>
			</td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td class="">
				<input type="text" name="mb_hphone" hname="휴대폰" class=""
					value="<?php echo $nf_util->get_html($mb_hphone_arr[0]); ?>">
			</td>
		</tr>
		<tr>
			<th>주소</th>
			<td class="area-address-">
				<input type="text" name="mb_address0" class="long100"
					value="<?php echo $nf_util->get_html($my_member['mb_address0']); ?>">
			</td>
		</tr>
		<!-- <tr>
			<th>홈페이지</th>
			<td><input type="text" name="mb_homepage"  value="<?php //echo $nf_util->get_html($my_member['mb_homepage']); ?>"></td>
		</tr> -->
		<tr>
			<th>SMS수신동의</th>
			<td><input type="checkbox" name="mb_receive[]" value="sms" <?php echo $my_member['mb_sms'] ? 'checked' : ''; ?> id="consent1"><label for="consent1" class="checkstyle1"></label>취업/구인관련 소식 등의 SMS수신</td>
		</tr>
		<tr>
			<th>이메일수신동의</th>
			<td><input type="checkbox" name="mb_receive[]" value="email" <?php echo $my_member['mb_email_view'] ? 'checked' : ''; ?> id="consent2"><label for="consent2" class="checkstyle1"></label>구인정보 등의 이메일 수신
			</td>
		</tr>
		<?php if ($env['use_message']) { ?>
			<tr>
				<th>쪽지수신동의</th>
				<td><input type="checkbox" name="mb_receive[]" value="message" <?php echo $my_member['mb_message_view'] ? 'checked' : ''; ?> id="consent3"><label for="consent3" class="checkstyle1"></label>회원간의 쪽지 수신</td>
			</tr>
			<?php
		}

		if ($admin_page) {
			?>
			<tr>
				<th>관리자메모</th>
				<td><textarea name="mb_memo" cols="30" rows="10"><?php echo stripslashes($mem_row['mb_memo']); ?></textarea>
				</td>
			</tr>
			<?php
		} ?>
	</tbody>
</table>