<?php
$_site_title_ = '고객센터';
$add_cate_arr = array('on2on', 'email');
$_SERVER['__USE_API__'] = array('editor');
include '../include/header_meta.php';
include '../include/header.php';

$phone_arr = explode("-", $member['mb_phone']);
$hphone_arr = explode("-", $member['mb_hphone']);
$mem_email_arr = explode("@", $member['mb_email']);

$m_title = '다이렉트 결제';
include NFE_PATH.'/include/m_title.inc.php';
?>
<style type="text/css">
.bank-tr- { display:none; }
.tax-c- { display:none; }
.tax-tr- { display:none; }
</style>
<script type="text/javascript" src="<?php echo NFE_URL;?>/_helpers/_js/nf_payment.class.js"></script>
<script type="text/javascript">
$(function(){
	nf_payment.click_service();
});
</script>
<div class="wrap1260 my_sub">
	<section class="register sub">
		<!--왼쪽 메뉴-->
		<?php include '../include/etc_leftmenu.php'; ?>
		<div class="subcon_area">
		<p class="s_title">다이렉트 결제</p>
			<form name="fpayment" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
			<input type="hidden" name="mode" value="payment_start" />
			<input type="hidden" name="code" value="direct" />
			<div class="box_wrap">
				<ul class="help_text">
					<li>서비스 신청 단계의 필요없이 바로 결제할 수 있는 페이지입니다.</li>
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

				<h3 class="MAT30">회원정보 입력</h3>

				<table class="style1">
					<colgroup>
					</colgroup>
					<tbody>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 이름</th>
							<td><input type="text" name="name" hname="이름" needed value="<?php echo $nf_util->get_html($member['mb_name']);?>"></td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 연락처</th>
							<td class="size1">
								<input type="text" name="hphone[]" value="<?php echo $hphone_arr[0];?>" hname="연락처" needed> -
								<input type="text" name="hphone[]" value="<?php echo $hphone_arr[1];?>" hname="연락처" needed> -
								<input type="text" name="hphone[]" value="<?php echo $hphone_arr[2];?>" hname="연락처" needed>
							</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 이메일</th>
							<td>
								<input type="text" name="email[]" value="<?php echo $nf_util->get_html($mem_email_arr[0]);?>" hname="이메일" needed> @
								<input type="text" name="email[]" id="mb_email_" value="<?php echo $nf_util->get_html($mem_email_arr[1]);?>" hname="이메일" needed>
								<select title="메일선택" onChange="nf_util.ch_value(this, '#mb_email_')">
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
					</tbody>
				</table>

				<h2>결제사항 정보 입력</h2>
				<table class="style1">
					<tbody>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 결제금액</th>
							<td><input type="text" name="price" hname="결제금액" needed onkeyup="this.value=this.value.number_format(this)"> 원</td>
						</tr>
						<tr>
							<th><i class="axi axi-ion-android-checkmark"></i> 결제내용</th>
							<td><textarea name="content" id="" placeholder="어떤것에 관한 결제를 진행하는지 간단히 내용을 작성해주세요."></textarea></td>
						</tr>
						<?php
						include NFE_PATH.'/include/etc/payment_method.inc.php';
						?>
					</tbody>
				</table>
				<div class="next_btn">
					<button type="button" class="base graybtn">돌아가기</button>
					<button class="base">결제하기</button>
				</div>
			</div>
			</form>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php
include NFE_PATH.'/include/pg_start.php';
include '../include/footer.php';
?>