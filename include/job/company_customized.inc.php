<div class="popup_layer custom customized-company-" style="display:none;">
	<div class="h6wrap">
		<h6>나의 맞춤 정보설정</h6>
		<button type="button" onClick="nf_util.openWin('.customized-company-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<form name="fcustomized" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
	<input type="hidden" name="mode" value="customized_company" />
	<div class="scroll">
		<table class="style1">
			<?php
			include NFE_PATH.'/include/job/company_customized.tr.php';
			?>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.customized-company-')">취소</button></li>
		<li><button>확인</button></li>
	</ul>
	</form>
</div>