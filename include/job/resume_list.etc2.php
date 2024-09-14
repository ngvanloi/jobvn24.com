<div><!--반복-->
	<div class="img_box">
		<?php if(!$not_checkbox) {?><input type="checkbox" name="chk[]" class="chk_" value="<?php echo $check_no;?>"><?php }?>
		<p class="injae" style="background-image:url(<?php echo $get_member['photo_src'];?>)"></p>
	</div>
	<div class="info_box">
		<a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>" target="_blank">
			<h2><?php echo $nf_util->get_text($row['subject']);?></h2>
			<dl>
				
				<dt>급여</dt>
				<dd><?php echo $resume_info['pay_type'];?> <?php echo number_format(intval($re_row['wr_pay']));?>원&nbsp;</dd>
				<dt>근무지</dt>
				<dd><?php echo implode("<br> ", $resume_info['area_text_arr2_txt']);?></dd>
			</dl>
			<dl>
				<dt>연락처</dt>
				<dd><?php echo $not_phone ? '비공개' : $get_member['mb_hphone'];?>&nbsp;</dd>
				<dt>이메일</dt>
				<dd><?php echo $not_email ? '비공개' : $get_member['mb_email'];?>&nbsp;</dd>				
				<dt>주소</dt>
				<dd><?php if($not_address) {?>비공개<?php } else {?>[<?php echo $get_member['mb_zipcode'];?>] <?php echo $get_member['mb_address1'].' '.$get_member['mb_address1'];?><?php }?></dd>
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
					<li><h3><?php echo $resume_info['name_txt'].$resume_info['gender_age_txt'];?></h3></li>
					<li><span>지원업소 :</span> <?php echo $nf_util->get_text($em_row['wr_company_name']);?></li>					
					<li><span>입사지원일 :</span> <?php echo date("Y.m.d", strtotime($row['sdate']));?></li>
					<li><span>이력서 :</span> <span class="<?php echo $row['rdate']=='1000-01-01 00:00:00' ? 'red' : 'blue';?>"><?php echo $row['rdate']=='1000-01-01 00:00:00' ? '미열람' : '열람 '.date("Y.m.d", strtotime($row['rdate']));?></span></li>
				</ul>
			</td>
			<td>
				<ul class="btn">
					<li><a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>" target="_blank"><button type="button">이력서보기</button></a></li>
					<?php if($is_attach) {?>
					<li><a href="<?php echo NFE_URL;?>/include/regist.php?mode=download_support&no=<?php echo $row['no'];?>"><button type="button">첨부파일 다운</button></a></li>
					<?php }?>
				</ul>
			</td>
		</tr>
	</table>
	<div class="assi_line">
		<ul>
			<li>지원한 공고 : <a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>" target="_blank"><?php echo $nf_util->get_text($em_row['wr_subject']);?></a></li>
		</ul>
		<ul>
			<?php if($env['use_message'] && $read_allow['allow'] && $get_member['mb_message_view']) {?><li><a href="#none" onClick="reply_message(this, 'accept_you', '<?php echo $row['no'];?>')">쪽지</a></li><?php }?>
			<li><a href="#none" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $check_no;?>" mode="delete_accept_pmno" url="../include/regist.php">삭제</a></li>
		</ul>
	</div>
</div>