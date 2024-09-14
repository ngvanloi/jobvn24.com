<?php
$employ_query = $db->_query("select * from nf_employ as ne where `mno`=".intval($mno).$nf_job->employ_where." order by ne.`no` desc");
?>
<script type="text/javascript">
var ch_employ = function(el) {
	var form = document.forms['fsupport'];
	$.post(root+"/include/regist.php", "mode=get_support_employ&no="+el.value, function(data){
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.move;
		if(data.js) eval(data.js);
	});
}
</script>
<form name="fsupport" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
<input type="hidden" name="mode" value="support_write" />
<input type="hidden" name="pno" value="<?php echo $nf_util->get_html($re_row['no']);?>" />
<input type="hidden" name="page_code" value="<?php echo $page_code;?>" />
<div class="popup_layer job_offer resume_support-" style="display:none;">
	<div class="h6wrap">
		<h6>입사지원 제의</h6>
		<button type="button" onClick="nf_util.openWin('.resume_support-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<table class="style1">
		<tr>
			<th>구인공고선택</th>
			<td>
				<select name="info" hname="구인공고" needed onChange="ch_employ(this)">
					<option value="">구인정보를 선택해주세요</option>
					<?php
					while($row=$db->afetch($employ_query)) {
					?>
					<option value="<?php echo intval($row['no']);?>"><?php echo $nf_util->get_text($row['wr_subject']);?></option>
					<?php
					}
					?>
				</select>
			</td>
		</tr>
		<!--담당자명,연락처,휴대폰,이메일은 구인공고 선택하면 자동채워짐-->
		<tr>
			<th>구인담당자명</th>
			<td><input type="text" name="name" hname="구인담당자명" needed></td>
		</tr>
		<tr>
			<th>담당자연락처</th>
			<td><input type="text" name="phone" hname="담당자연락처" needed></td>
		</tr>
		<tr>
			<th>담당자휴대폰</th>
			<td><input type="text" name="hphone" hname="담당자휴대폰" needed></td>
		</tr>
		<tr>
			<th>담당자이메일</th>
			<td><input type="text" name="email" hname="담당자이메일" needed></td>
		</tr>
	</table>
	<div class="text_area">
		<textarea name="content" rows='10' placeholder="면접제의 내용을 입력해주세요." hname="면접제의 내용" needed></textarea>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.resume_support-')">취소</button></li>
		<li><button type="submit">전송</button></li>
	</ul>
</div>
</form>