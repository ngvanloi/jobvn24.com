<form name="fmessage" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
<input type="hidden" name="mode" value="message_write" />
<input type="hidden" name="pno" value="<?php echo $nf_util->get_html($info_no);?>" />
<input type="hidden" name="no" value="" />
<input type="hidden" name="page_code" value="<?php echo $page_code;?>" />
<input type="hidden" name="code" value="<?php echo $nf_util->get_html($_GET['code']);?>" />
<div class="popup_layer mail message-" style="display:none;">
	<div class="h6wrap">
		<h6>쪽지보내기</h6>
		<button type="button" onClick="nf_util.openWin('.message-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<table class="style1">
		<colgroup>
			<col style="width:180px">
		</colgroup>
		<tr>
			<th>받는사람(닉네임)</th>
			<td>
				<?php if(in_array($page_code, array('input'))) {?>
				<input type="text" name="nick" value="">
				<?php } else {?>
				<span class="put_nick-"><?php echo $get_member['mb_nick'];?></span>
				<?php }?>
			</td>
		</tr>
	</table>
	<div class="text_area">
		<textarea name="content" placeholder="내용을 입력해주세요"></textarea>
	</div>	
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.message-')">취소</button></li>
		<li><button type="submit">보내기</button></li>
	</ul>
</div>
</form>