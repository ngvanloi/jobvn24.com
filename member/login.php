<?php
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$nf_member->check_not_login();

$_site_title_ = '로그인';
include '../include/header_meta.php';
include '../include/header.php';

$move_page = trim($_GET['page_url']) ? $_GET['page_url'] : $nf_util->page_back();
if(!$move_page) $move_page = NFE_URL.'/';

$m_title = '로그인';
include NFE_PATH.'/include/m_title.inc.php';
?>
<script type="text/javascript">
$(function(){
	$(".loginbox > .logintab > li").click(function(){
		$(".loginbox > .logintab > li").removeClass("on");
		$(this).addClass("on");
		var form = document.forms['flogin'];
		var kind = $(this).attr("kind");
		form.kind.value = kind;
	});

	<?php if(is_demo) {?>click_tab_login('company');<?php }?>
});
</script>
<div class="wrap1260 MAT20">
	<form name="flogin" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return validate(this)">
	<input type="hidden" name="mode" value="login_process" />
	<input type="hidden" name="kind" value="company" />
	<input type="hidden" name="url" value="<?php echo urlencode($move_page);?>" />
	<section class="login_sub sub">
		<div class="loginborder">
			<div class="centerwrap">
				<h3>로그인<span>사용하시는 아이디와 비밀번호를 입력하시기 바랍니다.</span></h3>
				<div>
					<div class="loginbox">
						<ul class="logintab">
							<li class="on" kind="company" <?php if(is_demo) {?>onClick="click_tab_login('company')"<?php }?>><a href="#none">업소회원</a></li>
							<li kind="individual" <?php if(is_demo) {?>onClick="click_tab_login('individual')"<?php }?>><a href="#none">개인회원</a></li>
						</ul>

						<div class="logininput">
							<p>
								<input type="text" name="mid" value="<?php echo $nf_util->get_html($save_id);?>" hname="아이디" needed placeholder="아이디">
								<input type="password" name="passwd" hname="비밀번호" needed value="" placeholder="비밀번호">
							</p>
							<button>로그인</button>
						</div>
						<ul class="loginlink">
							<li><label class="checkstyle1" ><input type="checkbox" name="save_id" value="1" <?php echo $save_id ? 'checked' : '';?>>아이디저장</label></li>
							<li><a href="<?php echo NFE_URL;?>/member/register.php">회원가입</a></li>
							<li><a href="<?php echo NFE_URL;?>/member/find_idpw.php">아이디/비밀번호 찾기</a></li>
						</ul>
						<ul class="snslogin">
							<?php if(in_array('naver', $env['sns_login_feed_arr'])) {?>
							<li class="naver"><a href="#none" onClick="nf_util.window_open('<?php echo $env['naver_login_click'];?>', 'naver', 500, 500)">N</a></li>
							<?php }?>
							<?php if(in_array('kakao_talk', $env['sns_login_feed_arr'])) {?>
							<li class="kakao"><a href="#none" onClick="kakaoLogin();"><i class="axi axi-comment2"></i></a></li>
							<?php }?>
							<?php
							if(in_array('facebook', $env['sns_login_feed_arr'])) {?>
							<li class="face"><a href="#none" onClick="fnFbCustomLogin();"><i class="axi axi-facebook"></i></a></li>
							<?php }?>
							<?php if(in_array('twitter', $env['sns_login_feed_arr'])) {?>
							<li class="twi"><a href=""><i class="axi axi-twitter"></i></a></li>
							<?php
							}?>
						</ul>
					</div>

<div id="status">
</div>

					<!--loginbox-->
					<?php
					$banner_arr = $nf_banner->banner_view('common_C');
					?>
					<div class="loginbanner banner"><?php echo $banner_arr['tag'];?></div>
				</div>
			</div>
		</div>
	</section>
	</form>
</div>

<!--푸터영역-->
<?php
include NFE_PATH.'/plugin/login/login_api.php';
include NFE_PATH.'/include/footer.php';
?>