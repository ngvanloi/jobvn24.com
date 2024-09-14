<style type="text/css">
.display-none- { display:none; }
</style>
<div class="popup_layer  custom customized-individual-" style="display:none;">
	<div class="h6wrap">
		<h6>나의 맞춤 정보설정</h6>
		<button type="button" onClick="nf_util.openWin('.customized-individual-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<form name="fcustomized" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
	<input type="hidden" name="mode" value="customized_individual" />

	<div class="scroll">
		<table class="style1">
			<?php
			include NFE_PATH.'/include/job/individual_customized.tr.php';
			?>
		</table>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.customized-individual-')">취소</button></li>
		<li><button>확인</button></li>
	</ul>
	</form>
</div>