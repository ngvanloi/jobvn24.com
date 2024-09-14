<?php
$top_menu_code = "400201";
include '../include/header.php';

$service_em_len = count($nf_job->service_name['employ']['main']);
$service_re_len = count($nf_job->service_name['resume']['main']);
$service_len = $service_em_len+$service_re_len;
?>

<script type="text/javascript">
var ch_service_name = function(el, kind, service_k) {
	var form = document.forms['fwrite'];
	var txt = $(form).find("[name='service_name["+kind+"]["+service_k+"]']").val();
	$.post("../regist.php", "mode=service_name_write&kind="+kind+"&service_k="+service_k+"&val="+encodeURIComponent(txt), function(data){
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.msg;
		if(data.js) eval(data.js);
	});
}
</script>
<!-- 메인서비스명설정 -->
<div class="wrap">
	<?php include '../include/left_menu.php'; ?> <!--관리자 공통 좌측메뉴-->

	<section>
		<?php include '../include/title.php'; ?> <!--관리자 타이틀영역-->
		<div class="consadmin conbox">
			<div class="guide">
				<p><img src="../../images/ic/guide.gif" alt="가이드"></p>
				<ul>
					<li>해당 페이지의 안내는 메뉴얼을 참조하세요<button class="s_basebtn4 gray2"  onclick="window.open('../pop/guide.php#guide4-2','window','width=1400, height=800,left=0, top=0, scrollbard=1, scrollbars=yes, resizable=yes')">메뉴얼</button></li>
				</ul>
			</div>

			<?php
			include NFE_PATH.'/nad/include/service_name_title.inc.php';
			?>

			<form name="fwrite" action="../regist.php" method="post">
			<input type="hidden" name="mode" value="service_name_write" />
			<h6>메인 구인공고 서비스명 설정</h6>
			<table class="table3">
				<colgroup>
					<col width="40%">
					<col width="10%">
					<col width="7%">
					<col width="20%">
					<col width="">
				</colgroup>
				<thead>
					<tr>
						<th class="tac">위치안내</th>
						<th class="tac" colspan="3">현재 서비스명</th>
						<th class="tac">서비스명 수정</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 0;
					if(is_array($nf_job->service_name['employ']['main'])) { foreach($nf_job->service_name['employ']['main'] as $k=>$v) {
						$service_k = '0_'.$k;
					?>
					<tr>
						<?php if($count===0) {?>
						<td class="tac" rowspan="<?php echo intval($service_len);?>"><img src="../../images/nad/ervice_name(main).jpg" alt=""></td>
						<th rowspan="<?php echo intval($service_em_len);?>" class="tac">Thông tin việc làm</th>
						<?php }?>
						<th class="tac">구인<?php echo substr($nf_util->alphabet, $count, 1);?>영역</th>
						<td class="tac"><em class="service_name_txt"><?php echo $v;?></em> 구인정보</td>
						<td class="tac">
							<input type="text" name="service_name[employ][<?php echo $service_k;?>]" value="<?php echo $v;?>">
							<button type="button" onClick="ch_service_name(this, 'employ', '<?php echo $service_k;?>')" class="basebtn gray">수정</button>
						</td>
					</tr>
					<?php
						$count++;
					} }


					$count = 0;
					if(is_array($nf_job->service_name['resume']['main'])) { foreach($nf_job->service_name['resume']['main'] as $k=>$v) {
						$service_k = '0_'.$k;
					?>
					<tr>
						<?php if($count===0) {?>
						<th rowspan="<?php echo $service_re_len;?>" class="tac">Thông tin tài năng</th>
						<?php }?>
						<th class="tac">인재<?php echo substr($nf_util->alphabet, $count, 1);?>영역</th>
						<td class="tac"><em class="service_name_txt"><?php echo $v;?></em> 인재정보</td>
						<td class="tac">
							<input type="text" name="service_name[resume][<?php echo $service_k;?>]" value="<?php echo $v;?>">
							<button type="button" onClick="ch_service_name(this, 'resume', '<?php echo $service_k;?>')" class="basebtn gray">수정</button>
						</td>
					</tr>
					<?php
						$count++;
					} }?>
				</tbody>
			</table>
			</form>

		</div>
		<!--//conbox-->

		
		
	</section>
</div>
<!--//wrap-->

<?php include '../include/footer.php'; ?> <!--관리자 footer-->