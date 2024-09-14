<?php
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
$get_sadmin = $nf_admin->get_sadmin(admin_id);

// : 권한이 맞지 않으면 각 권한별 첫 페이지로 이동합니다.
if($admin_info['wr_level']<10 && !@in_Array($top_menu_code, $get_sadmin['admin_menu_array'])) {
	$get_top_menu = $nf_admin->get_top_menu($get_sadmin['first_link']);
	@header("Location: ".domain.$get_top_menu['sub_menu_url']);
	exit;
}

include NFE_PATH.'/nad/include/html_top.php';

$sms_count = $nf_sms->netfu_sms_Ord();

$day_2 = date("Y-m-d", strtotime("-1 day"));
$is_new['300']['300201'] = $db->query_fetch("select no from nf_member where `mb_type`='company' and `is_delete`=0 and mb_left=0 and mb_left_request=0 and `mb_wdate`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;
$is_new['300']['300301'] = $db->query_fetch("select no from nf_member where `mb_type`='individual' and `is_delete`=0 and mb_left=0 and mb_left_request=0 and `mb_wdate`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;
$is_new['100']['100101'] = $db->query_fetch("select no from nf_employ as ne where ne.`is_delete`=0 and `wr_wdate`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;
$is_new['100']['100201'] = $db->query_fetch("select no from nf_resume as nr where `is_delete`=0 and `wr_wdate`>='".$day_2." 00:00:00' limit 1");
$is_new['500']['500201'] = $db->query_fetch("select no from nf_payment where `pay_wdate`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;
$is_new['500']['500206'] = $db->query_fetch("select no from nf_tax where `wr_type`='company' and `is_delete`=0 and `wdate`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;
$is_new['500']['500207'] = $db->query_fetch("select no from nf_tax where `wr_type`='individual' and `is_delete`=0 and `wdate`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;
$is_new['600']['600203'] = $db->query_fetch("select no from nf_cs where `wr_type`=0 and `wr_date`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;
$is_new['600']['600204'] = $db->query_fetch("select no from nf_cs where `wr_type`=1 and `wr_date`>='".$day_2." 00:00:00' limit 1") ? 1 : 0;


// : 공통 div폼
if(in_Array('send_email', $_SERVER['__USE_ETC__'])) include NFE_PATH.'/nad/include/email.inc.php'; // : 이메일
?>
<div class="layer_pop conbox popup_box- member-detail-" style="display:none;z-index:2;">
	<div class="h6wrap">
		<h6>회원정보</h6>
		<button type="button" onClick="$(this).closest('.member-detail-').css({'display':'none'})" class="close">X 창닫기</button>
	</div>
	<div class="table-">
	</div>
</div>



<script type="text/javascript">
var member_mno_click = function(el) {
	var mno = $(el).attr("mno");
	var nc_no = $(el).attr("nc_no");
	nc_no = nc_no ? nc_no : "";
	var code = $(el).attr("code");
	var obj = $(".conbox."+code);
	$.post(root+"/nad/regist.php", "mode=member_mno_click&code="+code+"&mno="+mno+"&nc_no="+nc_no, function(data){
		//document.write(data); 
		//alert(data);  
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.move;
		$(".conbox.popup_box-").css({"display":"none"});
		if(data.js) eval(data.js);
	});
}
</script>

<header>
	<nav class="main_nav">
		<ul class="navbar">
			<li><a href="<?php echo $_menu_array_['100']['menus'][0]['sub_menu']['100101']['url'];?>">admin</a></li>
			<?php
			if(is_Array($_menu_array_)) { foreach($_menu_array_ as $k=>$v) {
				if($admin_info['wr_level']<10 && !in_array($k, $_get_sadmin_['admin_menu_array'])) continue;
				$menu_txt = $_top_menus_[$k.'000'];

				$on = substr($top_menu_code,0,3)==$k ? 'on' : '';

				$sub_menu_k = array_keys($v['menus'][0]['sub_menu']);

				$new_icon = '';
				if($v['new'] && array_sum($is_new[$k])>0) $new_icon = '<img src="../../images/nad/new.png" alt="new">';
			?>
			<li class="<?php echo $on;?>">
				<a href="<?php echo $v['link'];?>"><?php echo $menu_txt.$new_icon;?></a>

				<ul class="nav_sub">
					<?php
					if(is_array($v['menus'])) { foreach($v['menus'] as $k2=>$v2) {
						if($admin_info['wr_level']<10 && !in_array($v2['code'], $_get_sadmin_['admin_menu_array'])) continue;
					?>
					<li>
						<span><?php echo $v2['name'];?></span>
						<ul class="nav_list">
							<?php
							if(is_array($v2['sub_menu'])) { foreach($v2['sub_menu'] as $k3=>$v3) {
								if($admin_info['wr_level']<10 && !in_array($k3, $_get_sadmin_['admin_menu_array'])) continue;
								$new_icon = '';
								if($v3['new'] && $is_new[$k][$k3]>0) $new_icon = '<img src="../../images/nad/new.png" alt="new">';
							?>
							<li><a href="<?php echo $v3['url'];?>"><?php echo $v3['name'];?><?php echo $new_icon;?></a></li>
							<?php
							} }?>
						</ul>
					</li>
					<?php } }?>
				</ul>
			</li>
			<?php
			} }
			?>

			<?php if($nf_sms->config['wr_use'] || $nf_sms->config['wr_lms_use']) {?>
			<li><a href="<?php echo NFE_URL."/nad/config/sms.php";?>">문자건수 : <?php echo intval($sms_count)>0 ? number_format(intval($sms_count)) : 0;?>건 남음</a></li>
			<?php }?>
		</ul>

		<?php
		$url = "https://netfu.co.kr/xml/notice.php?type=update";
		$ch = curl_init();                                 //curl 초기화
		curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
		$response = curl_exec($ch);
		curl_close($ch);
		$netfu_update_xml = json_decode(json_encode(simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA)), true);
		?>
		<div class="update">
			<p><a href="https://netfu.co.kr/board/notice.php" target="_blank"><span>SOLUTION</span><br>업데이트 알림</a></p>
			
			<ul class="cycle-slideshow" 
				data-cycle-fx=carousel
				data-cycle-timeout=3000
				data-cycle-carousel-visible=1
				data-cycle-slides=">li"
				data-cycle-carousel-vertical=true
			>
				<?php
				if(is_array($netfu_update_xml['DATA'])) { foreach($netfu_update_xml['DATA'] as $k=>$row) {
				?>
				<li><a href="<?php echo $row['URL'];?>" target="_blank"><?php echo $row['SUBJECT'];?></a></li>
				<?php
				} }
				?>
			</ul>
		</div>
	</nav>
</header>