<?php
$top_menu_code = "400103";
include '../include/header.php';
?>
<script type="text/javascript">
var upload_img = function(el, code) {
	var form = document.forms['fwrite'];
	form.code.value = code;
	nf_util.ajax_submit(form);
}
</script>
<!-- 구인공고기본로고 -->
<div class="wrap">
	<?php include '../include/left_menu.php'; ?> <!--관리자 공통 좌측메뉴-->

	<section class="basic_logo">
		<?php include '../include/title.php'; ?> <!--관리자 타이틀영역-->
		<div class="consadmin conbox">
			<div class="guide">
				<p><img src="../../images/ic/guide.gif" alt="가이드"></p>
				<ul>
					<li>- 구인공고 등록시, 로고 이미지가 등록이 되어있지 않으면 기본 이미지가 구인공고에 노출됩니다.</li>
				</ul>
			</div>
			
			<form  name="fwrite" action="../regist.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="mode" value="employ_logo_write" />
			<input type="hidden" name="code" value="" />
			<h6>구인공고 기본 이미지 로고 설정</h6>
			<table>
				<colgroup>
					<col width="10%">
				</colgroup>
				<tbody>
					<tr>
						<th>기본 이미지 로고 등록</th>
						<td><input type="file" name="img" class="MAR5 input20"><button type="button" class="s_basebtn2 gray" onClick="upload_img(this, 'img')">등록</button><span> [ 권장사이즈 : 넓이 400px 이하, 높이 140px ]</span></td>
					</tr>
					<tr>
						<th>등록된 이미지 로고</th>
						<td>
							<ul class="logo1">
								<li class="MAB5">
									<p><img src="<?php echo NFE_URL.'/data/logo/'.$env['employ_logo_img'];?>?t=<?php echo time();?>" alt="구인공고 기본이미지 로고"></p>	
								</li>
							</ul>
						</td>
					</tr>
				</tbody>
			 </table>

			 <h6>구인공고 기본 배경 로고 설정</h6>
			<table>
				<colgroup>
					<col width="10%">
				</colgroup>
				<tbody>
					<tr>
						<th>기본 배경 로고 등록</th>
						<td><input type="file" name="bg" class="MAR5 input20"><button type="button" class="s_basebtn2 gray" onClick="upload_img(this, 'bg')">등록</button><span> [ 권장사이즈 : 넓이 400px 이하, 높이 200px ]</span></td>
					</tr>
					<tr>
						<th>등록된 이미지 로고</th>
						<td>
							<ul class="logo2">
								<li class="MAB5">
									<p><img src="<?php echo NFE_URL.'/data/logo/'.$env['employ_logo_bg'];?>?t=<?php echo time();?>" alt="구인공고 기본배경 로고"></p>	
								</li>
							</ul>
						</td>
					</tr>
				</tbody>
			 </table>
			 </form>



		</div>
		<!--//conbox-->

	

		
	</section>
</div>
<!--//wrap-->

<?php include '../include/footer.php'; ?> <!--관리자 footer-->