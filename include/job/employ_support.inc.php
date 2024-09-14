<?php
$resume_query = $db->_query("select * from nf_resume as nr where `mno`=".intval($mno).$nf_job->resume_where." order by nr.`no` desc");
?>
<form name="fsupport" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
<input type="hidden" name="mode" value="support_write" />
<input type="hidden" name="pno" value="<?php echo $nf_util->get_html($em_row['no']);?>" />
<input type="hidden" name="page_code" value="<?php echo $page_code;?>" />
<div class="popup_layer support employ_support-" style="display:none;">
	<div class="h6wrap">
		<h6>면접지원</h6>
		<button type="button" onClick="nf_util.openWin('.employ_support-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<h2>이력서 선택</h2>
	<table class="style1">
		<tr>
			<th>지원 제목</th>
			<td><input type="text" name="subject" value="" hname="지원 제목" needed></td>
		</tr>
		<tr>
			<th>이력서선택</th>
			<td>
				<select name="info" hname="이력서" needed>
					<option value="">이력서를 선택해주세요.</option>
					<?php
					while($row=$db->afetch($resume_query)) {
					?>
					<option value="<?php echo intval($row['no']);?>"><?php echo $nf_util->get_text($row['wr_subject']);?></option>
					<?php
					}
					?>
				</select>
			</td>
		</tr>
	</table>
	<h2>첨부파일 직접 등록</h2>
	<table class="style1">
		<tr>
			<th>첨부파일</th>
			<td><input type="file" name="attach" value=""></td>
		</tr>
	</table>
	<h2>연락처공개설정</h2>
	<ul class="li_float">
		<li><label><input type="checkbox" name="view[]" value="phone" checked>연락처</label></li>
		<li><label><input type="checkbox" name="view[]" value="email" checked>이메일</label></li>
		<!-- <li><label><input type="checkbox" name="view[]" value="homepage" checked>홈페이지</label></li> -->
		<li><label><input type="checkbox" name="view[]" value="address" checked>주소</label></li>
	</ul>
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.employ_support-')">취소</button></li>
		<li><button type="submit">지원</button></li>
	</ul>
</div>
</form>