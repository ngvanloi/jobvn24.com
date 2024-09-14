<?php
$resume_int = $db->query_fetch("select count(*) as c from nf_resume where `is_delete`=0 and `mno`=".intval($mem_row['no']));
?>
<table class="style1">
	<colgroup>
		<col width="10%">
	</colgroup>
	<tbody>
		<tr>
			<th>아이디</th>
			<td><?php echo $mem_row['mb_id'];?></td>
			<th>이메일</th>
			<td><a href="#none" onClick="member_mno_click(this)" mno="<?php echo $mem_row['no'];?>" code="email-"><?php echo $mem_row['mb_email'];?></a></td>
		</tr>
		<tr>
			<th>이름/레벨</th>
			<td><?php echo $mem_row['mb_name'];?> / <?php echo $env['member_level_arr'][$mem_row['mb_level']]['name'];?></td>
			<th>닉네임</th>
			<td><?php echo $mem_row['mb_nick'];?></td>
		</tr>
		<tr>
			<th>생년월일</th>
			<td><?php echo $mem_row['mb_birth'];?></td>
			<th>성별</th>
			<td><?php echo $nf_member->gender[$mem_row['mb_gender']];?></td>
		</tr>
		<tr>
			<th>전화번호</th>
			<td><?php echo $mem_row['mb_phone'];?></td>
			<th>휴대폰</th>
			<td><?php echo $mem_row['mb_hphone'];?></td>
		</tr>
		<tr>
			<th>가입일</th>
			<td><?php echo $mem_row['mb_wdate'];?></td>
			<th>최종로그인</th>
			<td><?php echo $mem_row['mb_last_login'];?></td>
		</tr>
		<tr>
			<th>포인트</th>
			<td><?php echo number_format(intval($mem_row['mb_point']));?>P</td>
			<th>방문수</th>
			<td><?php echo number_format(intval($mem_row['mb_login_count']));?>회</td>
		</tr>
		<tr>
			<th>이력서수</th>
			<td colspan=3><a href="<?php echo NFE_URL;?>/resume/resume_list.php?mno=<?php echo $mem_row['no'];?>" target="_blank"><?php echo $resume_int['c'];?>건</a></td>
		</tr>
		<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
		<tr>
			<th>관리자메모</th>
			<td colspan="3"><?php echo stripslashes(nl2br($mem_row['mb_memo']));?></td>
		</tr>
	</tbody>
</table>