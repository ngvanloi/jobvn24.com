<table cellpadding="0" cellspacing="0" border="0" width="607px" style="border:1px solid #d5dbe0; border-bottom:none; border-top:2px solid #3b67ca; margin-top:20px">
	<tbody>
		<colgroup>
			<col width="70">
			<col width="100">
			<col width="120">
			<col width="100">
			<col width="100">
			<col width="">
		</colgroup>
		<tr>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">성명</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">희망직종</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">희망근무지역</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">경력</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">학력</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">등록일</th>
		</tr>
		<?php
		while($re_row=$db->afetch($resume_query)) {
			$re_info = $nf_job->resume_info($re_row);
		?>
		<tr>
			<td style="color:#555555; padding:10px 0px; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><a href="<?php echo domain;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>" target="_blank" style="color:blue"><?php echo $re_info['name_txt'];?></a></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $re_info['job_type_text_arr2_one_txt'][0];?></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $re_info['area_text_arr2_txt'][0];?></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $re_info['career_txt'];?></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $nf_job->school[$re_row['wr_school_ability']];?></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo date("Y-m-d", strtotime($re_row['wr_wdate']));?></td>
		</tr>
		<?php
		}?>
	</tbody>
</table>