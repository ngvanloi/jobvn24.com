<?php
// 에러 정보
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
ini_set("display_errors", 1);

$PATH = $_SERVER['DOCUMENT_ROOT'];
$http = $_SERVER['HTTPS']=='on' ? 'https://' : 'http://';
$this_page = $_SERVER['REQUEST_URI'];//$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
if(!is_array($_SERVER['__USE_API__'])) $_SERVER['__USE_API__'] = array();
if(!is_array($_SERVER['__USE_ETC__'])) $_SERVER['__USE_ETC__'] = array();

if(PHP_INT_MAX == 2147483647) $bit_int = 32;
else $bit_int = 64;

define("NFE_URL", "");
define("NFE_PATH", $_SERVER['DOCUMENT_ROOT'].NFE_URL);
define("http", $http);
define("domain", $http.$_SERVER['HTTP_HOST']);
define("this_page", $this_page);
define("today", date("Y-m-d"));
define("today2", date("YmdHis"));
define("today_time", date("Y-m-d H:i:s"));
define("today_his", date("H:i:s"));
define("encode", "utf-8");
define("bit_int", $bit_int);
define("is_demo", 0);
define("main_page", NFE_URL.'/');
define("is_nickname", 0); //업체명 or 닉네임 사용여부

// 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정
// iframe 때문에 간혹 세션이 깨지는 경우를 방지함
@header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

// 강제 header 지정
@header("Content-Type: text/html; charset=".encode);

if (!$time_limit) $time_limit = 0;
@set_time_limit($time_limit);

## 디비접속 ##
$db_connect_type = 'PDO'; // : PDO가 설치안된경우에는 PDO대신에 아무글자를 넣으면 mysqli_로 실행합니다.
$db_host = "localhost";
$db_name = "ndg85";
$db_user = "ndg85";
$db_pass = "qwerty12";
include_once NFE_PATH."/engine/core.php";
############

// : 이전페이지가 관리자페이지인지 체크
$_back_admin_page_ = strpos($nf_util->page_back(), "/nad/")!==false ? true : false;
$admin_page = $_back_admin_page_;

// : 등록폼 모음
$icon_need = $admin_page ? '<em class="ess">*</em> ' : '<i class="axi axi-ion-android-checkmark"></i>';
$register_form_query = $db->_query("select * from nf_category where `wr_type` in ('register_form_company','register_form_employ','register_form_resume') and `wr_view`=1 order by wr_rank asc");
while($row=$db->afetch($register_form_query)) {
	$register_form_arr[$row['wr_type']][$row['wr_name']] = $row;
}

// : 이력서 선택사항 체크박스 출력여부
if(!$register_form_arr['register_form_resume']['자격증']) unset($nf_job->resume_select_type['license']);
if(!$register_form_arr['register_form_resume']['외국어능력']) unset($nf_job->resume_select_type['language']);
if(!$register_form_arr['register_form_resume']['보유기술및능력']) unset($nf_job->resume_select_type['skill']);
if(!$register_form_arr['register_form_resume']['수상.수료활동']) unset($nf_job->resume_select_type['prime']);
if(!$register_form_arr['register_form_resume']['구인우대사항']) unset($nf_job->resume_select_type['preferential']);

// : 환경변수
$env = $db->query_fetch("select * from `nf_config`");

// : $env['use_auth'] 변수는 환경설정엔 없고 아이핀,휴대폰인증,비바톤을 사용하면 true입니다.
if($env['use_ipin'] || $env['use_hphone'] || $env['use_bbaton']) $env['use_auth'] = true;
$env['bbaton_redirect_uri'] = domain.'/include/regist.php?mode=login_bbaton';
$env['naver_redirect_uri'] = domain.'/include/regist.php?mode=sns_login_process&engine=naver';
$env['naver_login_click'] = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$env['naver_id']."&redirect_uri=".urlencode($env['naver_redirect_uri']);

$env['sns_feed_arr'] = explode(",", $env['sns_feed']);
$env['sns_login_feed_arr'] = explode(",", $env['sns_login_feed']);
$env['service_config_arr'] = unserialize(stripslashes($env['service_config']));
$env['service_intro_arr'] = unserialize($env['service_intro']);
$env['service_name_arr'] = unserialize(stripslashes($env['service_name']));
$env['member_level_arr'] = $nf_util->get_unse($env['member_level']);
$env['member_point_arr'] = $nf_util->get_unse($env['member_point']);
if(!$env['map_engine']) $env['map_engine'] = "daum";
$nf_job->service_name_setting(); // : 서비스명 재정리
$nf_payment->pg_config();

// : 차단아이피
$intercept_ip = explode("\r\n", stripslashes($env['intercept_ip']));
if(is_array($intercept_ip)) { foreach($intercept_ip as $k=>$v) {
	if($v && strpos($_SERVER['REMOTE_ADDR'], strtr($v, array(".*"=>"")))!==false) exit;
} }

// : 점프함수 - footer.php 맨아래에서 실행합니다.
include_once NFE_PATH.'/engine/function/jump.function.php';


// : 카테고리 모음
$cate_area_array = array('SI'=>array(), 'GU'=>array()); // nf_category->get_area()에서 사용
$cate_array = array();
$cate_p_array = array();
$cate_first_array = array(); // : 각 카테고리 첫번째 값
//$cate_read_arr = array('board_menu', 'online', 'groups', 'job_part', 'area', 'job_pay', 'job_tema', 'job_date', 'job_target', 'job_type', 'notice', 'job_company', 'job_listed');
$cate_read_arr = array('board_menu', 'online', 'groups', 'job_part', 'area', 'job_pay', 'job_tema', 'indi_tema', 'notice', 'job_listed','job_document');
if($add_cate_arr) $cate_read_arr = array_merge($cate_read_arr, $add_cate_arr);
$nf_category->get_cate($cate_read_arr);

/*
* SESSION 설정 (GNUBOARD 참고)
*/
//@ini_set('memory_limit','1024M');	// mysql 메모리 사이즈를 늘림
ini_set("session.use_trans_sid", 0);	// PHPSESSID를 자동으로 넘기지 않음
ini_set("url_rewriter.tags","");			// 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)
ini_set("max_input_vars", 5000);	// post 값 설정

$sess_dir = NFE_PATH.'/engine/session';
ini_set('session.save_path', $sessdir);
session_save_path($sess_dir);

if (isset($SESSION_CACHE_LIMITER))
	@session_cache_limiter($SESSION_CACHE_LIMITER);
else
	@session_cache_limiter("no-cache, must-revalidate");


/*
* 기본환경설정
*/
//ini_set("session.cache_expire", $env['session_time']); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", ($env['session_time']*60)); // session data의 garbage collection 존재 기간을 지정 (초)
ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
ini_set("session.gc_divisor", 1); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.

//session_set_cookie_params(($env['session_time']*60), "/");
ini_set("session.cookie_domain", "");

// 세션 스타트~
session_start();

// : 로그인한 회원정보
if(trim($_SESSION['sess_user_uid'])) {
	$mem_row = $db->query_fetch("select * from nf_member where `mb_id`=?", array($_SESSION['sess_user_uid']));
	if($mem_row) {
		$nf_member->get_member($mem_row['no']);
		$member = $nf_member->member_arr[$mem_row['no']];

		if($mem_row && $member['mb_type']) {
			$_where = "";
			$member_info_array = $nf_member->get_member_ex($member['no']);
			$member_ex = $member_info_array['member_ex'];
			$member_service = $member_info_array['member_se'];
		}

		$member_tax = $db->query_fetch("select * from nf_tax where `mno`=".intval($member['no']));
	}
}

// : SNS가입했는데 회원종류선택해서 가입안하면 강제로 회원종류선택 페이지로 이동
if(!$not_mb_type_check && !$mem_row['mb_type'] && $mem_row && strpos($_SERVER['PHP_SELF'], '/nad/')===false) {
	die(header('Location: '.NFE_URL.'/member/login_select.php'));
}

define("sess_user_uid", $member['mb_id']);

// : 급구아이콘 정보
$employ_busy_row = $db->query_fetch("select * from nf_service where `code`='employ' and `type`='busy'");
$resume_busy_row = $db->query_fetch("select * from nf_service where `code`='resume' and `type`='busy'");
$employ_busy_icon = $employ_busy_row['option'];
$resume_busy_icon = $resume_busy_row['option'];


$save_id = $nf_util->Decrypt($_COOKIE['save_id']);
## 관리자정보 ##
$is_admin = false;
$is_super_admin = false;	// 최고관리자 체크
$admin_info = $db->query_fetch("select * from nf_admin where `wr_id`='".$_SESSION[$nf_admin->sess_adm_uid]."'");

define("admin_id", $admin_info['wr_id']); // : 지우면 안됨
define("admin_no", $admin_info['no']); // : 지우면 안됨

if($admin_info) {
	if($admin_info['wr_level']<10) $_get_sadmin_ = $nf_admin->get_sadmin(admin_id);
	if($admin_info) {
		$is_admin = true;
		if($admin_info['wr_level']==10) {
			$is_super_admin = true;
		}
		$admin_name = $admin_info['wr_name'];
		$admin_nick = $admin_info['wr_nick'];
	}
}
##########

// : 모바일 체크
$mAgent = array("iPhone","iPod","Android","Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony");
$chkMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
	if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
		$chkMobile = true;
		break;
	}
}
define("is_mobile", $chkMobile);

if(!$is_admin && $env['under_construction'] && strpos($_SERVER['PHP_SELF'], '/nad/')===false && strpos($_SERVER['PHP_SELF'], '/include/construction.html')===false) {
	header('Location: '.NFE_URL.'/include/construction.html');
	exit;
}


// : 각 정보별 검색
if(count($nf_category->job_part_adult_arr)>0) {
	$nf_job->adult_where = " and (`wr_job_type` like '%,".implode(",%' or `wr_job_type` like '%,", $nf_category->job_part_adult_arr).",%')"; // : 성인직종 검색
	$nf_job->not_adult_where = " and !(`wr_job_type` like '%,".implode(",%' or `wr_job_type` like '%,", $nf_category->job_part_adult_arr).",%')"; // : 성인직종이 아닌거 검색
}


$_em_where = "";
// : 일반유료
if($nf_payment->service_kind_arr['employ']['0_list']['is_pay']) $_em_where .= " and (".implode(" or ", $nf_job->service_where['employ'])." or wr_service_busy>='".today."')";
// : 일반무료+심사중
if(!$nf_payment->service_kind_arr['employ']['0_list']['is_pay'] && $env['service_employ_audit_use']) $_em_where .= " and (".implode(" or ", $nf_job->service_where['employ'])." or wr_service_busy>='".today."')";

$_re_where = "";
// : 일반유료
if($nf_payment->service_kind_arr['resume']['0_list']['is_pay']) $_re_where .= " and (".implode(" or ", $nf_job->service_where['resume'])." or wr_service_busy>='".today."')";

// : 19금 직종 개수
$nf_category->job_part_adult_cnt = count($nf_category->job_part_adult_arr);
?>
