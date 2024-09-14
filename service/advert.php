<?php
$_SERVER['__USE_API__'] = array('editor');
$_site_title_ = '광고 · 제휴 문의';
$add_cate_arr = array('concert', 'email');
include '../include/header_meta.php';
include '../include/header.php';
?>
<script type="text/javascript">
var submit_func = function(el) {
	if(!$("#indiagree")[0].checked) {
		alert("개인정보 수집 및 이용안내에 동의해주시기 바랍니다.");
		$("#indiagree")[0].focus();
		return false;
	}

	if(!validate(el)) {
		return false;
	}
}
</script>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>광고문의<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="register sub">
		<!--왼쪽 메뉴-->
		<?php include '../include/etc_leftmenu.php'; ?>

		<form name="fwrite" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return submit_func(this)">
		<input type="hidden" name="mode" value="cs_center_write" />
		<input type="hidden" name="type" value="1" />
		<?php
		include NFE_PATH.'/include/etc/google_recaptcha3.inc.php';
		?>
		<div class="subcon_area">
			<p class="s_title">광고 &middot; 제휴 문의</p>
			<div class="box_wrap">
				<ul class="help_text">
					<li>성공적인 비즈니스 사업을 위하여 귀사의 소중한 의견이나 제안을 받습니다.</li>
					<li>담당자 확인 후 이메일 혹은 연락처로 연락드리겠습니다.</li>
					<li>한번 등록한 내용은 수정이 불가능합니다.</li>
				</ul>

				
				<div class="terms">
					<h2>개인정보수집이용안내</h2>
					<div class="terms_box">
						<p><?php echo stripslashes($env['content_privacy']);?></p>
					</div>
					<p>
						<label for="indiagree" class="checkstyle1"><input type="checkbox" id="indiagree">개인정보 수집 및 이용안내에 동의합니다.</label>
					</p>
				</div>


				<table class="style1 MAT30">
					<colgroup>
					</colgroup>
					<tbody>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 문의분류</th>
							<td>
								<ul class="li_float">
									<?php
									if(is_array($cate_p_array['concert'][0])) { foreach($cate_p_array['concert'][0] as $k=>$v) {
									?>
									<li><label for="wr_cate_<?php echo $k;?>" class="radiostyle1" ><input type="radio" id="wr_cate_<?php echo $k;?>" name="wr_cate" value="<?php echo $k;?>" hname="문의분류" needed><?php echo stripslashes($v['wr_name']);?></label></li>
									<?php
									} }?>
								</ul>
							</td>
						</tr>
						<tr>
							<th>업소명</th>
							<td><input type="text" name="wr_biz_name" value="<?php echo $nf_util->get_html($member_ex['mb_company_name']);?>"></td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 담당자명</th>
							<td><input type="text" name="wr_name" hname="담당자명" needed value="<?php echo $nf_util->get_html($member['mb_name']);?>"></td>
						</tr>
						<tr>
							<th>연락처</i></th>
							<td class="size1">
								<input type="text" name="wr_phone[]" hname="연락처" value="<?php echo $nf_util->get_html($phone_arr[0]);?>"> -
								<input type="text" name="wr_phone[]" hname="연락처" value="<?php echo $nf_util->get_html($phone_arr[1]);?>"> -
								<input type="text" name="wr_phone[]" hname="연락처" value="<?php echo $nf_util->get_html($phone_arr[2]);?>">
							</td>
						</tr>
						<tr>
							<th>휴대폰</th>
							<td class="size1">
								<input type="text" name="wr_hphone[]" hname="휴대폰" value="<?php echo $nf_util->get_html($hphone_arr[0]);?>"> -
								<input type="text" name="wr_hphone[]" hname="휴대폰" value="<?php echo $nf_util->get_html($hphone_arr[1]);?>"> -
								<input type="text" name="wr_hphone[]" hname="휴대폰" value="<?php echo $nf_util->get_html($hphone_arr[2]);?>">
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 이메일</th>
							<td>
								<input type="text" name="wr_email[]" value="<?php echo $mem_email_arr[0];?>" hname="이메일" needed> @
								<input type="text" name="wr_email[]" value="<?php echo $mem_email_arr[1];?>" hname="이메일" needed id="wr_email_" hname="이메일" needed>
								<select onChange="nf_util.ch_value(this, '#wr_email_')">
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
							<th>홈페이지주소</th>
							<td><input type="text" name="wr_site" style="max-width:100% !important;" placeholder="https://를 포함해서 입력해주세요."></td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 제목</th>
							<td><input type="text" name="wr_subject" hname="제목" needed style="max-width:100%"></td>
						</tr>
						<tr>
							<th colspan="2" style="padding:1rem; text-align:center;"><i class="axi axi-ion-android-checkmark"></i> 내용</th>
						</tr>
						<tr>
							<td colspan="2"><textarea type="editor" hname="내용" needed name="wr_content" style="height:200px;"></textarea></td>
						</tr>
						<?php
							include NFE_PATH.'/include/kcaptcha.php';
						?>
					</tbody>
				</table>
				<div class="next_btn">
					<button type="button" class="base graybtn">돌아가기</button>
					<button type="submit" class="base">등록하기</button>
				</div>
			</div>
		</div>
		</form>
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>