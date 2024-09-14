<?php
$q = "nf_member_company as nmc where nmc.`mno`=".intval($member['no']);
$max_company_no = $db->query_fetch("select max(`no`) as c from ".$q);
$company_query = $db->_query("select *, if(nmc.is_public=1, ".intval($max_company_no['c']+1).", nmc.`no`) as sort_no from ".$q." order by nmc.`no` desc");
?>
<div class="popup_layer manager manager-" style="display:none;">
	<div class="h6wrap">
		<h6>담당자 추가</h6>
		<button type="button" onClick="nf_util.openWin('.manager-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<form name="fmanager" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
	<input type="hidden" name="mode" value="manager_write" />
	<input type="hidden" name="no" value="<?php echo $nf_util->get_html($manager_row['no']);?>" />
	<div class="scroll">
		<table class="style1">
			<colgroup>
				<col style="width:120px">
			</colgroup>
			<tr>
				<th>업소선택<i class="axi axi-ion-android-checkmark"></i></th>
				<td>
					<select name="cno" hname="업소정보" needed>
					<option value="">선택</option>
					<?php
					while($row=$db->afetch($company_query)) {
						$selected = $cno_no==$row['no'] ? 'selected' : '';
					?>
					<option value="<?php echo $row['no'];?>" <?php echo $selected;?>><?php echo $nf_util->get_text($row['mb_company_name']);?></option>
					<?php
					}?>
					</select>
				</td>
			</tr>
			<!-- <tr>
				<th>닉네임<i class="axi axi-ion-android-checkmark"></i></th>
				<td><input type="text" name="wr_nickname" value="<?php //echo $nf_util->get_html($manager_row['wr_nickname']);?>" hname="닉네임" needed></td>
			</tr> -->
			<tr>
				<th>담당자명<i class="axi axi-ion-android-checkmark"></i></th>
				<td><input type="text" name="name" value="<?php echo $nf_util->get_html($manager_row['wr_name']);?>" hname="담당자명" needed></td>
			</tr>
			<tr>
				<th>이메일<i class="axi axi-ion-android-checkmark"></i></th>
				<td>
					<input type="text" name="email[]" value="<?php echo $nf_util->get_html($email_arr[0]);?>" hname="이메일" needed> @
					<input type="text" name="email[]" value="<?php echo $nf_util->get_html($email_arr[1]);?>" hname="이메일" needed id="email_" hname="이메일" needed>
					<select onChange="nf_util.ch_value(this, '#email_')">
						<option value="">직접입력</option>
						<?php
						if(is_array($cate_p_array['email'][0])) { foreach($cate_p_array['email'][0] as $k=>$v) {
						?>
						<option value="<?php echo $nf_util->get_html($v['wr_name']);?>"><?php echo $v['wr_name'];?></option>
						<?php
						} }
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th>연락처<i class="axi axi-ion-android-checkmark"></i></th>
				<td class="size1">
					<input type="text" name="phone" hname="연락처" needed value="<?php echo $nf_util->get_html($phone_arr[0]);?>"> 
	
				</td>
			</tr>
			<tr>
				<th>휴대폰</th>
				<td class="size1">
					<input type="text" name="hphone" hname="휴대폰" value="<?php echo $nf_util->get_html($hphone_arr[0]);?>"> 

				</td>
			</tr>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.manager-')">취소</button></li>
		<li><button><?php echo $manager_row ? '수정' : '등록';?></button></li>
	</ul>
	</form>
</div>