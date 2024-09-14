<div>
	<div class="img_box">
		<?php if(!$not_checkbox) {?><input type="checkbox" name="chk[]" class="chk_" value="<?php echo $row['no'];?>"><?php }?>
		<p class="company" <?php if($employ_info['logo_'.$employ_info['wr_logo_type']]) {?>style="background-image:url(<?php echo $employ_info['logo_'.$employ_info['wr_logo_type']];?>)"<?php }?> class="<?php echo $employ_info['logo_class'];?>"><?php echo $employ_info['logo_text'];?></p>
	</div>
	<div class="info_box">
		<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>">
			<h2><?php echo $nf_util->get_text($row['subject']);?></h2>
			<dl>
				<dt>업소명</dt>
				<dd><?php echo $nf_util->get_text($em_row['wr_company_name']);?>&nbsp;</dd>

				<dt>급여</dt>
				<dd><?php echo $employ_info['pay_txt'];?>&nbsp;</dd>
			</dl>
			<dl>
				<dt>업·직종</dt>
				<dd><?php echo implode(", ", $employ_info['job_type_text_arr2_txt']);?></dd>
				<dt>근무지</dt>
				<dd><?php echo implode(", ", $employ_info['area_text_arr2_txt']);?></dd>
			</dl>
		</a>
	</div>
	<table>
		<colgroup>
			<col width="50%">	
			<col width="50%">	
		</colgroup>
		<tr>
			<td>
				<ul>
					<li><span>공고등록일 :</span> <?php echo date("Y.m.d", strtotime($em_row['wr_wdate']));?></li>
					<li><span>공고마감일 :</span> <?php echo $employ_info['end_date'];?></li>
					<?php if($page_code=='resume_onlines') {?>
					<li>
						<span>이력서 :</span>
						<?php if($row['rdate']=='1000-01-01 00:00:00') {?>
						<span class="red">미열람</span>
						<?php } else {?>
						<span class="blue">열람 <?php echo date("Y.m.d", strtotime($row['rdate']));?></span>
						<?php }?>
					</li>
					<?php }?>
				</ul>
			</td>
			<td>
				<ul class="btn">
					<?php
					switch($page_code) {
						case "resume_onlines":
					?>
					<li><a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $row['sel_no'];?>" target="_blank"><button type="button">이력서보기</button></a></li>
					<?php
						break;

						case "resume_interview":
					?>
					<li><button type="button" onClick="accept_view('<?php echo $row['no'];?>')">입사제의 메세지</button></li>
					<?php
						break;
					}
					?>
				</ul>
			</td>
		</tr>
	</table>
	<div class="assi_line">
		<ul>
			<?php
			switch($page_code) {
				case "resume_onlines":
			?>
			<li>지원일 : <?php echo date("Y.m.d", strtotime($row['sdate']));?></li>
			<?php
				break;

				case "resume_interview":
			?>
			<li>제의요청일 : <?php echo date("Y.m.d", strtotime($row['sdate']));?></li>
			<?php
				break;
			}?>
		</ul>
		<ul>
			<?php
			if($env['use_message'] && $read_allow['allow'] && $get_member['mb_message_view']) {
				$put_code = $member['mb_type']=='individual' ? 'accept_you' : 'accept_my';
			?>
			<li><a href="#none" onClick="reply_message(this, '<?php echo $put_code;?>', '<?php echo $row['no'];?>')">쪽지</a></li>
			<?php
			}

			switch($page_code) {
				case "resume_onlines":
			?>
			<li><a href="#none" onclick="nf_util.ajax_post(this, '입사지원을 취소하시겠습니까?')" no="<?php echo $row['no'];?>" mode="delete_accept_<?php echo $del_mode;?>" url="<?php echo NFE_URL;?>/include/regist.php">입사지원취소</a></li>
			<?php
				break;

				case "resume_interview":
			?>
			<li><a href="#none" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $row['no'];?>" mode="delete_accept_<?php echo $del_mode;?>" url="<?php echo NFE_URL;?>/include/regist.php">삭제</a></li>
			<?php
				break;
			}
			?>
		</ul>
	</div>
</div>