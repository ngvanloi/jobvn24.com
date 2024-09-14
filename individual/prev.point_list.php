<!--header_meta-->
<?php include '../include/header_meta.php'; ?>
<!--header_wrap-->
<?php include '../include/header.php'; ?>
<!--사이드 배너-->
<?php include '../include/scroll_banner.php'; ?>

<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>포인트 내역<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260 my_sub">
	<section class="sub">
		<!--개인서비스 왼쪽 메뉴-->
		<?php
		$left_on['point_list'] = 'on';
		include '../include/indi_leftmenu.php';
		?>
		<div class="subcon_area">
			<section class="point_list">
				<h1>포인트 내역</h1>
				<ul class="help_text">
					<li>회원님의 포인트 내역을 확인할 수 있습니다.</li>
				</ul>
				<ul class="fr">
					<li>나의 포인트 : <span class="orange">1565 <em>P</em></span></li>
				</ul>
				<table class="style3">
					<tr>
						<th>일시</th>
						<th>적립/사용내역</th>
						<th>포인트내역</th>
					</tr>
					<tr>
						<td colspan="3">포인트 내역이 없습니다.</td>
					</tr>
					<tr>
						<td>2022.02.15</td>
						<td>회원 가입시 지급 포인트</td>
						<td><span class="blue">+ 100</span></td>
					</tr>
					<tr>
						<td>2022.02.15</td>
						<td>이력서 유료결제</td>
						<td><span class="red">- 100</span></td>
					</tr>
				</table>	
			</section>
			<!--페이징-->
			<?php include '../include/paging.php'; ?>
		</div>
	</section>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>