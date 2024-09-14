<div class="left_menu">
	<div class="sub_mymenu">
		<h2>업소소개</h2>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/content.php?code=site_introduce">업소소개<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/content.php?code=membership">이용약관<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/content.php?code=privacy">개인정보취급방침<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/advert.php">광고 &middot; 제휴 문의<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/cs_center.php">고객센터<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/index.php?code=resume">서비스안내<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
		<?php if($env['use_direct']) {?>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/direct.php">다이렉트 결제<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
		<?php }?>
		<dl>
			<dt style="letter-spacing:-1px;"><a href="<?php echo NFE_URL;?>/service/content.php?code=email_not_collect">이메일무단수집거부<i class="axi axi-keyboard-arrow-down"></i></a></dt>
		</dl>
	</div>
	<div class="banner">
		<?php
		$banner_arr = $nf_banner->banner_view('common_E');
		echo $banner_arr['tag'];
		?>
	</div>
</div>