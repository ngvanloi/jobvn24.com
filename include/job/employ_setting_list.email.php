<table cellpadding="0" cellspacing="0" border="0" width="607px" style="border:1px solid #d5dbe0; border-bottom:none; border-top:2px solid #3b67ca; margin-top:20px">
	<tbody>
		<colgroup>
			<col width="100">
			<col width="100">
			<col width="120">
			<col width="100">
			<col width="100">
			<col width="">
		</colgroup>
		<tr>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">업체명</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">희망직종</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">희망근무지역</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">경력</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">학력</th>
			<th style="background:#f4f6f8; padding:10px 15px; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">마감일</th>
		</tr>
		<?php
		while($em_row=$db->afetch($employ_query)) {
			$em_info = $nf_job->employ_info($em_row);
		?>
		<tr>
			<td style="color:#555555; padding:10px 0px; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><a href="<?php echo domain;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>" target="_blank" style="color:blue"><?php echo $nf_util->get_text($em_row['wr_company_name']);?></a></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $em_info['job_type_text_arr2_one_txt'][0];?></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $em_info['area_text_arr2'][0][1].' '.$em_info['area_text_arr2'][0][2];?></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $em_info['career_txt'];?></td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $nf_job->school[$em_row['wr_ability']];?> 이상</td>
			<td style="color:#555555; font-size:14px; text-align:center; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $em_info['end_date'];?></td>
		</tr>
		<?php
		}?>
	</tbody>
</table>