<?php
$_site_title_ = "서비스 안내";
include '../include/header_meta.php';
include '../include/header.php';
?>
<style type="text/css">
.pay-view- { display:none; }
</style>
<script type="text/javascript">
var click_service_tab = function(k) {
	$(".top_tab").find("li").removeClass("on");
	$(".top_tab").find("li").eq(k).addClass("on");
	$(".service_body-").css({"display":"none"});
	$(".service_body-").eq(k).css({"display":"block"});
}
</script>
<div class="m_title">
	<button class="back" onclick="history.back()"><i class="axi axi-keyboard-arrow-left"></i></button>서비스 안내<button class="forward" onclick="history.forward()"><i class="axi axi-keyboard-arrow-right"></i></button>
</div>
<div class="wrap1260">
	 <div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('common_F');
		echo $banner_arr['tag'];
		?>
	</div>
	<section class="sub service service_main">
		<ul class="top_tab">
			<li class="<?php echo $_GET['code']!='resume' ? 'on' : '';?>"><a href="#none" onClick="click_service_tab(0)">업소 유료서비스</a></li>
			<li class="<?php echo $_GET['code']=='resume' ? 'on' : '';?>"><a href="#none" onClick="click_service_tab(1)">개인 유료서비스</a></li>
		</ul>

		<div class="service_body-" style="display:<?php echo $_GET['code']!='resume' ? 'block' : 'none';?>;">
			<div class="service_info">
				<h3>업소 유료서비스 안내</h3>
				<p>유료서비스는 선택사항이며, 유료서비스를 이용하지 않은 구인공고는 일반리스트에 등록됩니다. <br> 업소 유료서비스는 <span class="wine">로그인 후, 구인공고를 등록하셔야 이용 가능</span>합니다. 이용 방법은 아래와 같습니다.</p>
				<div class="service_way">
					<dl>
						<dt>&lt; 이미 구인공고가 등록되어있는 상태일때 &gt;</dt>
						<dd>① MY업소서비스 메뉴 - 진행중인 구인공고 메뉴 접속 > ② 서비스를 이용할 구인공고란의 ‘서비스 신청하기’버튼 클릭 > ③ 원하는 서비스 선택후 결제</dd>
					</dl>
					<dl>
						<dt>&lt; 구인공고를 새로 등록 해야할때 &gt;</dt>
						<dd>① 구인공고 작성 > ② '유료 구인공고 등록' 버튼 클릭 > ③ 원하는 서비스 선택후 결제</dd>
					</dl>
				</div>
				<p>서비스를 연장 또는 서비스 추가 구매를 하고싶으시다면 ‘업소서비스 메뉴 - 진행중인 구인공고 메뉴’에서 서비스를 적용할 구인공고의 ‘서비스 연장·추가’버튼을 클릭하여 추가 결제해주시면 됩니다.</p>
			</div>

			<div class="banner" style="overflow:hidden;">
				<?php
				$banner_arr = $nf_banner->banner_view('common_G');
				echo $banner_arr['tag'];
				?>
			</div>

			<?php
			include NFE_PATH.'/include/service.company.inc.php';
			?>
		</div>


		<div class="service_body-" style="display:<?php echo $_GET['code']=='resume' ? 'block' : 'none';?>;">
			<!--@@@@@@--------개인유료서비스 안내 시작---------------@@@@@@@-->
			<div class="service_info">
				<h3>개인 유료서비스 안내</h3>
				<p>유료서비스는 선택사항이며, 유료서비스를 이용하지 않은 이력서는 일반리스트에 등록됩니다. <br> 개인 유료서비스는 <span class="wine">로그인 후, 이력서를 등록하셔야 이용 가능</span>합니다. 이용 방법은 아래와 같습니다.</p>
				<div class="service_way">
					<dl>
						<dt>&lt; 이미 이력서가 등록되어있는 상태일때 &gt;</dt>
						<dd>① MY개인서비스 메뉴 - 이력서 관리 메뉴 접속 > ② 서비스를 이용할 이력서란의 ‘서비스 신청하기’버튼 클릭 > ③ 원하는 서비스 선택후 결제</dd>
					</dl>
					<dl>
						<dt>&lt; 이력서를 새로 등록하는 경우 &gt;</dt>
						<dd>① 이력서 작성 > ② ‘유료 인재공고 등록’ 버튼 클릭 > ③ 원하는 서비스 선택후 결제</dd>
					</dl>
				</div>
				<p>서비스를 연장 또는 서비스 추가 구매를 하고싶으시다면 ‘개인서비스 메뉴 - 이력서 관리 메뉴’에서 서비스를 적용할 이력서의 ‘서비스 연장·추가’버튼을 클릭하여 추가 결제해주시면 됩니다.</p>
			</div>

			<div class="banner" style="overflow:hidden;">
				<?php
				$banner_arr = $nf_banner->banner_view('common_G');
				echo $banner_arr['tag'];
				?>
			</div>

			<?php
			include NFE_PATH.'/include/service.individual.inc.php';
			?>
		</div>

	</section>
</div>



<!--푸터영역-->
<?php
include NFE_PATH.'/include/service_intro.box.php';
include NFE_PATH.'/include/footer.php';
?>

