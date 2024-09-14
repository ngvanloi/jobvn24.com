<form name="ffile" action="<?php echo NFE_URL;?>/include/regist.php" method="post" enctype="multipart/form-data" onSubmit="return nf_util.ajax_submit(this)">
<input type="hidden" name="mode" value="company_logo_upload" />
<input type="hidden" name="no" value="<?php echo intval($re_row['no']);?>" />
<input type="hidden" name="code" value="" />
<div class="popup_layer ijimg">
	<div class="h6wrap">
		<h6>사진등록/수정</h6>
		<button type="button" onClick="$('.popup_layer.ijimg').css({'display':'none'})"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="text_info">
		GIF, JPEG, JPG, PNG 파일형식으로 사이즈:가로220/세로:제한없음, 100KB 용량 이내의 파일 등록을 권장합니다.
	</div>
	<p class="file">
		<input type="file" name="file_upload" hname="사진" needed id="file_upload-" />
		<?php if($member_ex['is_mb_logo']) {?><button type="button" onClick="nf_member.delete_my_logo()" style="border:1px solid #d5d5d5; padding:5px; margin-left:5px;">파일삭제</button><?php }?>
	</p>
	<ul class="btn">
		<li><button type="button" onClick="$('.popup_layer.ijimg').css({'display':'none'})">취소</button></li>
		<li><button type="submit">확인</button></li>
	</ul>
</div>
</form>