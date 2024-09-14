<?php
$employ_int = $db->query_fetch("select count(*) as c from nf_employ where `is_delete`=0 and `mno`=".intval($mem_row['no']));
?>
<table width="730" class="bg_col tf">
<colgroup>
<col width="100"><col><col width="100"><col>
</colgroup>
<tr>
	<th>아이디</td>
	<td><?php echo $mem_row['mb_id'];?></td>
	<th>이메일</td>
	<td><a href="#none" onClick="member_mno_click(this)" mno="<?php echo $mem_row['no'];?>" code="email-"><?php echo $mem_row['mb_email'];?></a></td>
</tr>
<tr>
	<th>이름/레벨</td>
	<td><?php echo $mem_row['mb_name'];?> / <?php echo $env['member_level_arr'][$mem_row['mb_level']]['name'];?></td>
	<th>닉네임</td>
	<td><?php echo $mem_row['mb_nick'];?></td>
</tr>
<tr>
	<th>대표자명(ceo)</td>
	<td><?php echo $mem_ex_row['mb_ceo_name'];?></td>
	<th>업소/점포명</td>
	<td><?php echo $mem_ex_row['mb_company_name'];?></td>
</tr>
<tr>
	<th>사업자번호</td>
	<td>
		<?php echo $mem_ex_row['mb_biz_no'];?>
	</td>
	<th>사업자등록증</td>
	<td>
		<?php if($register_form_arr['register_form_company']['사업자등록증첨부'] && is_file(NFE_PATH.'/data/member/'.$mem_ex_row['mb_biz_attach'])) {?>
			<img src="<?php echo NFE_URL;?>/data/member/<?php echo $mem_ex_row['mb_biz_attach'];?>" style="width:50px;height:50px;" />
			<?php if($is_admin) {?>
			<a href="<?php echo NFE_URL;?>/include/regist.php?mode=download_biz_attach&no=<?php echo $mem_ex_row['no'];?>">다운</a>
			<?php }?>
		<?php }?> 
	</td>
</tr>
<tr>
	<th>전화번호</td>
	<td><?php echo $mem_row['mb_phone'];?></td>
	<th>휴대폰</td>
	<td><?php echo $mem_row['mb_hphone'];?></td>
</tr>

<tr>
	<th>주소</td>
	<td colspan="3">[<?php echo $mem_row['mb_zipcode'];?>] <?php echo $mem_row['mb_address0'].' '.$mem_row['mb_address1'];?></td>
</tr>

<tr>
	<th>공고등록수</td>
	<td><a href="<?php echo NFE_URL;?>/employ/list_type.php?mno=<?php echo $mem_row['no'];?>" target="_blank"><?php echo number_format(intval($employ_int['c']));?> 건</a></td>
	<th>이력서열람</td>
	<td>
		<?php
		$read_arr = array();
		if($mem_service['mb_resume_read']>today) $read_arr[] = $mem_service['mb_resume_read'].'까지';
		if($mem_service['mb_resume_read_int']>0) $read_arr[] = number_format(intval($mem_service['mb_resume_read_int'])).'건';
		echo implode(" / ", $read_arr);
		?>
	</td>
</tr>
<tr>
	<th>가입일</td>
	<td><?php echo $mem_row['mb_wdate'];?></td>
	<th>최종로그인</td>
	<td><?php echo $mem_row['mb_last_login'];?></td>
</tr>
<tr>
	<th>포인트</td>
	<td><?php echo number_format(intval($mem_row['mb_point']));?>P</td>
	<th>방문수</td>
	<td><?php echo number_format(intval($mem_row['mb_login_count']));?>회</td>
</tr>
<tr><td colspan="4" class="lnb wbg" height="5"></td></tr>
<tr>
	<th>관리자메모</td>
	<td colspan="3"><?php echo stripslashes(nl2br($mem_row['mb_memo']));?></td>
</tr>
</table>