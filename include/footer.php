	<footer>
		<div class="b_menu">
			<div class="main_con_wrap2">
				<ul>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=site_introduce">업소소개</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=membership">이용약관</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=privacy">개인정보취급방침</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/advert.php">광고 &middot; 제휴 문의</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/cs_center.php">고객문의</a></li>
					<li><a href="<?php echo NFE_URL;?>/service/index.php?<?php echo $member['mb_type']=='individual' ? 'code=resume' : '';?>">서비스안내</a></li>
					<?php if($env['use_direct']) {?><li><a href="<?php echo NFE_URL;?>/service/direct.php">다이렉트 결제</a></li><?php }?>
					<li><a href="<?php echo NFE_URL;?>/service/content.php?code=email_not_collect">이메일무단수집거부</a></li>
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
				<p><a href="https://netfu.co.kr/" target="_blank"><img src="../images/default/p_by.png" alt="넷퓨 반응형구인구직, 반응형 구인구직 홈페이지제작, 반응형 구인구직 사이트제작, https://netfu.co.kr"></a></p>
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
		현재 보고계신 <b class="col2">사이트</b>는<br>
		<b class="col1"> 넷퓨솔루션 사용자데모</b>입니다.
	</p>
	<div>
		<p><b>웹솔루션 홈페이지 판매<br>netfu.co.kr</b></p>
		<a href="https://netfu.co.kr/homepage/all_homepage.php?group=job" target="_blank">바로가기 <span>GO</span></a>
	</div>
</div>
<?php } ?>

</body>
</html>

<?php
// : 점프함수 사이트 뜨고 나서 읽히기 위해서 [ 자동점프입니다. ]
job_jump_func("12 hour");
?>