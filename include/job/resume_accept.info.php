<script type="text/javascript">
var accept_view = function(no, code) {
	para = "";
	if(code) para = "&code="+code;
	$.post(root+"/include/regist.php", "mode=get_accept_view&no="+no+para, function(data){
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.move;
		if(data.js) eval(data.js);
	});
}
</script>
<div class="popup_layer job_offer resume_support_info-" style="display:none;">
	<div class="h6wrap">
		<h6>입사제의 메세지</h6>
		<button type="button" onClick="nf_util.openWin('.resume_support_info-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<table class="style1" style="float:initial; width:100%;">
			<tr>
				<th>구인공고명</th>
				<td class="info_subject-"></td>
			</tr>
			<tr>
				<th>구인담당자명</th>
				<td class="name-"></td>
			</tr>
			<tr>
				<th>담당자연락처</th>
				<td class="phone-"></td>
			</tr>
			<tr>
				<th>담당자휴대폰</th>
				<td class="hphone-"></td>
			</tr>
			<tr>
				<th>담당자이메일</th>
				<td class="email-"></td>
			</tr>
		</table>
		<div class="text_area content-">
			
		</div>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.resume_support_info-')">닫기</button></li>
	</ul>
</div>