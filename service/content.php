<?php
include '../include/header_meta.php';
include '../include/header.php';
?>

<div class="wrap1260 my_sub">
	<section class="register sub">
		<!--왼쪽 메뉴-->
		<?php include '../include/etc_leftmenu.php'; ?>
		<div class="subcon_area">
			<p class="s_title"><?php echo $nf_util->content_config[$_GET['code']];?></p>
			<div class="box_wrap order_sub">
				<?php echo stripslashes($env['content_'.$_GET['code']]);?>
			</div>
		</div>
	</section>
</div>

<!--푸터영역-->
<?php include '../include/footer.php'; ?>