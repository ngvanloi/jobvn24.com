	<footer>
		<div class="b_menu">
			<div class="main_con_wrap2">
				<ul>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=site_introduce">Giới thiệu về cửa hàng</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=membership">Điều khoản sử dụng</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=privacy">Chính sách xử lý thông tin cá nhân</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/advert.php">Quảng cáo & Hợp tác</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/cs_center.php">Hỗ trợ khách hàng</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/index.php?<?php echo $member['mb_type']=='individual' ? 'code=resume' : '';?>">Hướng dẫn dịch vụ</a></li>
					<?php if($env['use_direct']) {?><li><a href="<?php echo NFE_URL;?>/service/direct.php">Thanh toán trực tiếp</a></li><?php }?>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=email_not_collect">Từ chối thu thập email trái phép</a></li>
					<?php if($env['rss_feed']) {?><li><a href="<?php echo NFE_URL;?>/rss.php"><img src="../images/rss.gif" alt="RSS" style="vertical-align:middle; margin-right:5px;">RSS</a></li><?php }?>
				</ul>
			</div>
		</div>
		<div class="b_wrap">
			<div class="main_con_wrap2">
				<div class="left_b">
					<p><img src="<?php echo NFE_URL.'/data/logo/'.$env['logo_bottom'];?>?t=<?php echo time();?>" alt=""></p>
					<p class="b_info"><?php echo stripslashes($env['content_bottom_site']);?></p>
				</div>
				<?php if($env['use_digital']) {?>
				<div class="right_b">
					<p><?php echo nl2br($nf_util->get_text($env['digital_content']));?></p>
				</div>
				<?php }?>
			</div>
			<div class="main_con_wrap3">
				<p><a href="https://netfu.co.kr/" target="_blank"><img src="../images/default/p_by.png" alt="Netfu - Trang tuyển dụng phản hồi, thiết kế trang web tuyển dụng phản hồi, sản xuất trang tuyển dụng phản hồi, https://netfu.co.kr"></a></p>
			</div>
		</div>
	</footer>
	<script type="text/javascript">
	nf_util.read_statistics();
	</script>
</div><!--//header.php에 있는 sticky_wrap 마침)-->

<?php if(is_demo) { ?>
<div class="sample_info">
	<p>
		Hiện tại, bạn đang xem <b class="col2">trang web</b><br>
		<b class="col1"> Demo người dùng Netfu Solution</b>.
	</p>
	<div>
		<p><b>Trang web bán giải pháp<br>netfu.co.kr</b></p>
		<a href="https://netfu.co.kr/homepage/all_homepage.php?group=job" target="_blank">Truy cập ngay <span>GO</span></a>
	</div>
</div>
<?php } ?>

</body>
</html>

<?php
// : 점프함수 사이트 뜨고 나서 읽히기 위해서 [ 자동점프입니다. ]
job_jump_func("12 hour");
?>