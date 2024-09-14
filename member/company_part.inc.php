<?php
$mb_receive_arr = explode(",", $my_member['mb_receive']);
?>
<table class="style1">
	<colgroup>
		<col width="10%">
	</colgroup>
	<tbody>
		<?php if ((!$my_member['no'] && strpos($_SERVER['PHP_SELF'], "/member/update_form.php") === false) || $admin_page) { ?>
			<tr>
				<th><?php echo $icon_need; ?>회원아이디</th>
				<td>
					<?php if ($my_member['no']) { ?>
						<div><?php echo $my_member['mb_id']; ?></div>
					<?php } else { ?>
						<input type="text" name="mb_id" id="fmember_mb_id" onkeyup="nf_util.input_text(this)" hname="아이디" needed
							option="userid" minbyte="5" maxbyte="20" maxlength="20"><input type="hidden"
							class="check_mb_id- dupl-hidden-" name="check_mb_id" value="" message="아이디를 중복확인해주시기 바랍니다."
							needed /><button type="button" onClick="nf_member.check_uid('fmember_mb_id')"
							class="base2 basebtn gray MAL5">중복확인</button>
					<?php } ?>
				</td>
			</tr>
			<?php if (!$my_member['mb_is_sns']) { ?>
				<tr>
					<th><?php echo $icon_need; ?>비밀번호</th>
					<td><input type="password" name="mb_password" class="input10" hname="비밀번호" <?php echo $admin_page ? '' : 'needed'; ?> minbyte="5" maxbyte="20" option="userpw" maxlength="20"><span><em>* 5~20자 사이의 영문, 숫자,
								특수문자중 최소 2가지 이상 조합해주세요.</em></span></td>
				</tr>
				<?php
			}

			if ($admin_page) { ?>
				<tr>
					<th><?php echo $icon_need; ?>회원등급</th>
					<td>
						<select name="mb_level" hname="회원등급" needed>
							<option value="">회원등급 선택</option>
							<?php
							echo $nf_member->level_option($mem_row['mb_level']);
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
						<td><input type="password" name="mb_passwd2" class="input10" hname="비밀번호 확인" needed minbyte="5" maxbyte="20"
								option="userpw" maxlength="20" matching="mb_password"><span><em> * 비밀번호를 한번 더 입력해 주십시오.</em></span>
						</td>
					</tr>
					<?php
				}
			} ?>
			<?php
		} ?>
		<tr>
			<th>가입자명</th>
			<td><input type="text" name="mb_name" class="input10"
					value="<?php echo $nf_util->get_html($my_member['mb_name']); ?>" hname="가입자명"><span><em>* 실명인증
						사용을 위해 실명을 입력해주세요.</em></span></td>
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
		<?php
		if (!$company_row['mb_biz_email'])
			$company_row['mb_biz_email'] = $my_member['mb_email'];
		if (!$company_row['mb_biz_hphone'])
			$company_row['mb_biz_hphone'] = $my_member['mb_hphone'];
		include NFE_PATH . '/include/job/company_write.inc.php';
		?>
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

		if ($admin_page) { ?>
			<tr>
				<th>관리자메모</th>
				<td><textarea name="mb_memo" cols="30" rows="10"><?php echo stripslashes($mem_row['mb_memo']); ?></textarea>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>