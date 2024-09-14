<?php
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";

// : 팝업 쿼리문 [ 팝업이 있으면 마우스드레그때문에 jqueryui를 사용합니다. ]
$popup_query = $db->_query("select * from nf_popup where `popup_view`=1");
$popup_length = $db->num_rows($popup_query);
if(!@in_array('jqueryui', $_SERVER['__USE_API__']) && $popup_length>0) array_push($_SERVER['__USE_API__'], 'jqueryui');

$original_site_title = $_site_title_;
$_site_title_ = (($_site_title_) ? $_site_title_.' - ' : '').$env['site_title'];
if(!$_site_content_) $_site_content_ = $env['meta_description'];
if(!$_site_keyword_) $_site_keyword_ = $env['meta_keywords'];
if(!$_site_title_not_description_ && $original_site_title) $_site_content_ = $original_site_title.' - '.$_site_content_;
if(!$_site_image_) $_site_image_ = '/data/logo/'.$env['logo_top'];
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=0, maximum-scale=5, user-scalable=yes">
<?php if(in_array('google', $env['sns_login_feed_arr'])) {?>
<meta name ="google-signin-client_id" content="구글값">
<?php }?>
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php echo $_site_title_;?></title>
<meta name="Description" content="<?php echo $nf_util->get_html($_site_content_);?>">
<meta name="Keywords" content="<?php echo $nf_util->get_html($_site_keyword_);?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $nf_util->get_html($_site_title_);?>">
<meta property="og:description" content="<?php echo $nf_util->get_html($_site_content_);?>">
<?php if($_site_image_) {?>
<meta property="og:image" content="<?php echo domain.$nf_util->get_html($_site_image_);?>">
<?php }?>
<meta property="og:url" content="<?php echo domain.this_page;?>">
<meta property="twitter:card" content="summary">
<meta property="twitter:title" content="<?php echo $nf_util->get_html($_site_title_);?>">
<meta property="twitter:description" content="<?php echo $nf_util->get_html($_site_content_);?>">
<?php if($_site_image_) {?>
<meta property="twitter:image" content="<?php echo domain.$nf_util->get_html($_site_image_);?>">
<?php }?>
<link rel="canonical" href="<?php echo domain.$_SERVER['REQUEST_URI'];?>" />
<link rel="icon" href="<?php echo domain;?>/data/favicon/<?php echo $env['favicon'];?>">
<link href="<?php echo NFE_URL;?>/css/default.css" rel="stylesheet" type="text/css">
<link href="<?php echo NFE_URL;?>/css/style.css" rel="stylesheet" type="text/css">
<?php if($env['site_color']) {?>
<link href="<?php echo NFE_URL;?>/css/<?php echo $env['site_color'];?>.css" rel="stylesheet" type="text/css">
<?php }?>
<link href="<?php echo NFE_URL;?>/css/axicon/axicon.min.css" rel="stylesheet" type="text/css" >
<link href="<?php echo NFE_URL;?>/css/swiper.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/earlyaccess/notosanskr.css" rel="stylesheet">
<script src="<?php echo NFE_URL;?>/_helpers/_js/jquery-3.5.1.js"></script>
<script type='text/javascript' src="<?php echo NFE_URL;?>/_helpers/_js/jquery.form.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo NFE_URL;?>/plugin/jquery/jqueryui/jquery-ui.min.css" />
<script type="text/javascript" src="<?php echo NFE_URL;?>/plugin/jquery/jqueryui/jquery-ui.min.js"></script>


<script src="<?php echo NFE_URL;?>/_helpers/_js/swiper.js"></script>
<script src="<?php echo NFE_URL;?>/_helpers/_js/jquery.cycle2.min.js"></script>
<script src="<?php echo NFE_URL;?>/_helpers/_js/jquery.cycle2.swipe.js"></script>
<script src="<?php echo NFE_URL;?>/_helpers/_js/script.js"></script>
<script src="<?php echo NFE_URL;?>/_helpers/_js/jquery.scrollfollow.js"></script>

<?php if(@in_array('editor', $_SERVER['__USE_API__'])) {?>
<script type="text/javascript" src='<?php echo NFE_URL;?>/plugin/editor/<?php echo is_mobile ? 'mobile_' : '';?>cheditor/cheditor.js?time=<?php echo time();?>'></script>
<?php }?>

<script type='text/javascript' src="<?php echo NFE_URL;?>/_helpers/_js/nf_util.class.js"></script>
<script type='text/javascript' src="<?php echo NFE_URL;?>/_helpers/_js/form.js"></script>
<script type='text/javascript' src="<?php echo NFE_URL;?>/_helpers/_js/nf_category.class.js"></script>
<script type='text/javascript' src="<?php echo NFE_URL;?>/_helpers/_js/nf_job.class.js"></script>
<script type='text/javascript' src="<?php echo NFE_URL;?>/_helpers/_js/nf_board.class.js"></script>

<style type="text/css">
.drag-skin- { cursor:pointer; }
.password-box- { display:none !important; }
.password-box-.on { display:flex !important;} 
</style>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript">
var root = "<?php echo NFE_URL;?>";
var site_ip = "<?php echo $_SERVER['REMOTE_ADDR'];?>";
var map_engine = "<?php echo $env['map_engine'];?>";
var editor_max_size = <?php echo intval($env['editor_max_size'] * 1048576);?>;
var _link = location.href;
var _subject = document.title;
var _img = $("meta[property='og\\:image']").attr("content");
var _description = $("meta[property='og\\:description']").attr("content");

var add_favorite = function(){
	var top_menu_code = "<?php echo $top_menu_code;?>";
	var top_menu = "<?php echo $top_menu_txt;?>";
	var middle_menu = "<?php echo $middle_menu_txt;?>";
	var sub_menu = "<?php echo $sub_menu_txt;?>";
	var url = "<?php echo $sub_menu_url;?>";

	confirm_msgs = "[ " + top_menu + " > ";
	confirm_msgs += (middle_menu) ? middle_menu + " > " : "";
	confirm_msgs += (sub_menu) ? sub_menu : "";

	var confirm_msg = confirm_msgs + " ] 를 퀵메뉴에 추가 하시겠습니까?";

	if(confirm(confirm_msg)){

		$.post(root+"/nad/regist.php", "mode=quick_insert&top_menu_code="+top_menu_code, function(data){
			data = $.parseJSON(data);
			if(data.msg) alert(data.msg);
			if(data.js) eval(data.js);
		});
	}
}

var del_favorite = function(el) {
	var code = $(el).attr("code");
	if(confirm("삭제하시겠습니까?")) {
		$.post(root+"/nad/regist.php", "mode=quick_delete&top_menu_code="+code, function(data){
			data = $.parseJSON(data);
			if(data.msg) alert(data.msg);
			if(data.js) eval(data.js);
		});
	}
}

Kakao.init("<?php echo $env['kakao'];?>");

<?php
// : 데모체크
if(is_demo) {?>
	var click_tab_login = function(mb_type) {
		$.post(root+"/include/regist.php", "mode=click_tab_login&mb_type="+mb_type, function(data){
			data = $.parseJSON(data);
			if(data.js) eval(data.js);
		});
	}
<?php
}?>
</script>

<?php
echo stripslashes($env['head_scripts']);
?>


<?php if(in_array('map', $_SERVER['__USE_API__'])) {?>
<script type="text/javascript" src='<?php echo NFE_URL;?>/plugin/map/<?php echo $env['map_engine'];?>.class.js?time=<?php echo time();?>'></script>
<?php }?>

</head>

<body>

<?php
if(strpos($_SERVER['PHP_SELF'], '.inc.')===false) {
	
	if($env['use_adult'] && strpos($_SERVER['PHP_SELF'], '/regist.php')===false) {
		// : 성인인증 사용시 사용
		include NFE_PATH.'/include/adult.php';
	}


	// : 팝업
	if($popup_length>0) {
		while($popup_row=$db->afetch($popup_query)) {
			$popup_allow = true;
			if($_COOKIE['popup_'.$popup_row['no']]) $popup_allow = false;
			if(!$popup_row['popup_sub_view'] && strpos($_SERVER['PHP_SELF'], NFE_URL.'/index.php')===false) $popup_allow = false;
			if(!$popup_allow) continue;

			if(!$popup_row['popup_unlimit']) {
				if(substr($popup_row['popup_begin'],0,4)!='1000' && $popup_row['popup_begin']>today.' '.date("H").':00:00') continue;
				if(substr($popup_row['popup_end'],0,4)!='1000' && $popup_row['popup_end']<today.' '.date("H").':00:00') continue;
			}
			include NFE_PATH.'/include/etc/popup.inc.php';
		}
	}

	include NFE_PATH.'/include/password.inc.php';
}
?>