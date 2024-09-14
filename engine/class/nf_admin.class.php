<?php
// : 상단메뉴
$_top_menus_ = array(
	'100000' => '구인구직관리',
	'200000' => '환경설정',
	'300000' => '회원관리',
	'400000' => '디자인관리',
	'500000' => '결제관리',
	'600000' => '커뮤니티관리',
	'700000' => '통계관리',
);

// : 메뉴관리
$_menu_array_ = array(
	'100'=>array(
		"eng_name" => "Job hunting",
		"link"=>NFE_URL."/nad/job/index.php",
		"new"=>true,
		"menus" => array(
			0 => array("code" => "100100", "name" => "구인공고 관리", 
				"sub_menu" => array(
					"100101"=>array("name" => "전체 구인공고 관리", "url" => NFE_URL."/nad/job/index.php", "new"=>true),
					"100102"=>array("name" => "진행중인 구인공고", "url" => NFE_URL."/nad/job/index.php?code=ing"),
					"100103"=>array("name" => "심사 구인공고 관리", "url" => NFE_URL."/nad/job/index.php?code=audit"),
					"100104"=>array("name" => "모집마감된 구인공고", "url" => NFE_URL."/nad/job/index.php?code=end"),
					"100105"=>array("name" => "서비스기간 만료 구인공고", "url" => NFE_URL."/nad/job/index.php?code=service_end"),
					"100106"=>array("name" => "구인공고 등록", "url" => NFE_URL."/nad/job/employ_modify.php"),
					"100107"=>array("name" => "신고 공고 관리", "url" => NFE_URL."/nad/job/employ_report.php"),
					"100108"=>array("name" => "면접지원 관리", "url" => NFE_URL."/nad/job/employ_become.php"),
					"100109"=>array("name" => "구인공고 스크랩 관리", "url" => NFE_URL."/nad/job/employ_scrap.php"),
				),
			),

			1 =>array("code" => "100200", "name" => "이력서 관리",
				"sub_menu" => array(
					"100201"=>array("name" => "이력서 관리", "url" => NFE_URL."/nad/job/resume.php", "new"=>true),
					"100202"=>array("name" => "이력서 등록", "url" => NFE_URL."/nad/job/resume_modify.php"),
					"100203"=>array("name" => "신고 이력서 관리", "url" => NFE_URL."/nad/job/resume_report.php"),
					"100204"=>array("name" => "서비스기간 만료 이력서", "url" => NFE_URL."/nad/job/resume.php?code=service_end"),
					"100206"=>array("name" => "면접제의 관리", "url" => NFE_URL."/nad/job/resume_become.php"),
					"100205"=>array("name" => "이력서 스크랩 관리", "url" => NFE_URL."/nad/job/resume_scrap.php"),
				),
			),
		)
	),

	'200'=>array(
		"eng_name" => "Environment",
		"link"=>NFE_URL."/nad/config/index.php",
		"menus" => array(
			0 => array("code" => "200100", "name" => "사이트 관리", 
				"sub_menu" => array(
					"200101"=>array("name" => "기본정보설정", "url" => NFE_URL."/nad/config/index.php"),
					"200102"=>array("name" => "사이트소개", "url" => NFE_URL."/nad/config/content.php?code=site_introduce"),
					"200103"=>array("name" => "이용약관", "url" => NFE_URL."/nad/config/content.php?code=membership"),
					"200104"=>array("name" => "개인정보취급방침", "url" => NFE_URL."/nad/config/content.php?code=privacy"),
					//"200105"=>array("name" => "게시판관리기준", "url" => NFE_URL."/nad/config/content.php?code=board_manage"),
					"200106"=>array("name" => "이메일무단수집거부", "url" => NFE_URL."/nad/config/content.php?code=email_not_collect"),
					"200107"=>array("name" => "사이트하단", "url" => NFE_URL."/nad/config/content.php?code=bottom_site"),
					"200108"=>array("name" => "메일하단", "url" => NFE_URL."/nad/config/content.php?code=bottom_email"),
				),
			),

			1 => array("code" => "200200", "name" => "서비스/출력수 설정", 
				"sub_menu" => array(
					"200201"=>array("name" => "SMS 환경설정", "url" => NFE_URL."/nad/config/sms.php"),
					"200202"=>array("name" => "지도설정", "url" => NFE_URL."/nad/config/map.php"),
					"200203"=>array("name" => "지역 밀어넣기", "url" => NFE_URL."/nad/config/insert_area.php"),
				),
			),

			2 => array("code" => "200300", "name" => "등록폼 관리", 
				"sub_menu" => array(
					"200301"=>array("name" => "업소회원 가입폼 설정", "url" => NFE_URL."/nad/config/register_form.php?code=company"),
					"200302"=>array("name" => "구인정보 항목 설정", "url" => NFE_URL."/nad/config/register_form.php?code=employ"),
					//"200303"=>array("name" => "이력서 항목 설정", "url" => NFE_URL."/nad/config/register_form.php?code=resume"),
					"200304"=>array("name" => "회원 탈퇴요청 사유", "url" => NFE_URL."/nad/config/category_insert.php?code=member_left_reason"),
					"200305"=>array("name" => "구인공고 신고 사유", "url" => NFE_URL."/nad/config/category_insert.php?code=job_employ_report_reason"),
					"200306"=>array("name" => "이력서 신고 사유", "url" => NFE_URL."/nad/config/category_insert.php?code=job_resume_report_reason"),
				),
			),

			3 => array("code" => "200400", "name" => "분류관리", 
				"sub_menu" => array(
					"200401"=>array("name" => "공통적용 분류", "url" => NFE_URL."/nad/config/category_insert.php?code=job_part"),
					"200402"=>array("name" => "구인정보 분류", "url" => NFE_URL."/nad/config/category_insert.php?code=job_document"),
					"200403"=>array("name" => "인재정보 분류", "url" => NFE_URL."/nad/config/category_insert.php?code=indi_tema"),
					"200404"=>array("name" => "회원가입 분류", "url" => NFE_URL."/nad/config/category_insert.php?code=member_left_reason"),
				),
			),

			4 => array("code" => "200500", "name" => "운영자관리", 
				"sub_menu" => array(
					"200501"=>array("name" => "관리자정보설정", "url" => NFE_URL."/nad/config/admin.php"),
					"200502"=>array("name" => "부관리자관리", "url" => NFE_URL."/nad/config/sadmin.php"),
					"200503"=>array("name" => "부관리자등록", "url" => NFE_URL."/nad/config/sadmin_modify.php"),
				),
			),
		)
	),


	'300'=>array(
		"eng_name" => "Member",
		"link"=>NFE_URL."/nad/member/index.php",
		"new"=>true,
		"menus" => array(
			0 => array("code" => "300100", "name" => "회원종합관리", 
			"sub_menu" => array(
					"300101"=>array("name" => "전체회원관리", "url" => NFE_URL."/nad/member/index.php"),
					"300102"=>array("name" => "불량회원관리", "url" => NFE_URL."/nad/member/bad_list.php"),
					"300103"=>array("name" => "탈퇴요청관리", "url" => NFE_URL."/nad/member/left_list.php"),
					"300104"=>array("name" => "탈퇴회원관리", "url" => NFE_URL."/nad/member/left_list.php?left=1"),
					"300105"=>array("name" => "회원등급/포인트설정", "url" => NFE_URL."/nad/member/level.php"),
					"300106"=>array("name" => "회원포인트관리", "url" => NFE_URL."/nad/member/point.php"),
					"300107"=>array("name" => "회원간쪽지발송내역", "url" => NFE_URL."/nad/member/memo.php"),
				),
			),

			1 => array("code" => "300200", "name" => "업소회원관리", 
			"sub_menu" => array(
					"300201"=>array("name" => "업소회원관리", "url" => NFE_URL."/nad/member/company.php", "new"=>true),
					"300202"=>array("name" => "업소회원등록", "url" => NFE_URL."/nad/member/company_insert.php"),
					"300203"=>array("name" => "업소정보관리", "url" => NFE_URL."/nad/member/company_info.php"),
				),
			),

			2 => array("code" => "300300", "name" => "개인회원관리", 
			"sub_menu" => array(
					"300301"=>array("name" => "개인회원관리", "url" => NFE_URL."/nad/member/individual.php", "new"=>true),
					"300302"=>array("name" => "개인회원등록", "url" => NFE_URL."/nad/member/individual_insert.php"),
				),
			),

			3 => array("code" => "300400", "name" => "회원CRM관리", 
			"sub_menu" => array(
					"300401"=>array("name" => "회원메일발송", "url" => NFE_URL."/nad/member/mail.php"),
					"300402"=>array("name" => "회원문자발송", "url" => NFE_URL."/nad/member/sms.php"),
					"300403"=>array("name" => "맞춤메일발송", "url" => NFE_URL."/nad/member/ma_mail.php"),
					//"300404"=>array("name" => "맞춤문자발송", "url" => NFE_URL."/nad/member/ma_sms.php"),
				),
			),
		)
	),


	'400'=>array(
		"eng_name" => "Design",
		"link"=>NFE_URL."/nad/design/index.php",
		"menus" => array(
			0 => array("code" => "400100", "name" => "기본디자인관리", 
			"sub_menu" => array(
					"400101"=>array("name" => "사이트디자인설정", "url" => NFE_URL."/nad/design/index.php"),
					"400102"=>array("name" => "사이트로고설정", "url" => NFE_URL."/nad/design/logo.php"),
					"400103"=>array("name" => "구인공고기본로고", "url" => NFE_URL."/nad/design/employ_logo.php"),
				),
			),
			1 => array("code" => "400200", "name" => "개별디자인관리", 
			"sub_menu" => array(
					"400201"=>array("name" => "서비스명설정", "url" => NFE_URL."/nad/design/service_name(employ).php"),
					"400203"=>array("name" => "배너관리", "url" => NFE_URL."/nad/design/banner.php"),
					"400204"=>array("name" => "팝업관리", "url" => NFE_URL."/nad/design/popup.php"),
					"400205"=>array("name" => "팝업등록", "url" => NFE_URL."/nad/design/popup_insert.php"),
					"400206"=>array("name" => "MAIL스킨관리", "url" => NFE_URL."/nad/design/mail_skin.php"),
				),
			),
		)
	),


	'500'=>array(
		"eng_name" => "Payment",
		"new"=>true,
		"link"=>NFE_URL."/nad/payment/index.php",
		"menus" => array(
			0 => array("code" => "500100", "name" => "결제환경관리", 
			"sub_menu" => array(
					"500101"=>array("name" => "결제환경설정", "url" => NFE_URL."/nad/payment/pg.php"),
					"500102"=>array("name" => "무통장입금계좌설정", "url" => NFE_URL."/nad/config/category_insert.php?code=online"),
					"500103"=>array("name" => "결제페이지설정", "url" => NFE_URL."/nad/payment/pg_page.php"),
					"500104"=>array("name" => "서비스별금액설정", "url" => NFE_URL."/nad/payment/service_pay_config.php"),
				),
			),
			1 => array("code" => "500200", "name" => "결제관리", 
			"sub_menu" => array(
					"500201"=>array("name" => "결제통합관리", "url" => NFE_URL."/nad/payment/index.php", "new"=>true),
					"500202"=>array("name" => "결제대기내역", "url" => NFE_URL."/nad/payment/index.php?pay_status=0"),
					"500203"=>array("name" => "결제완료내역", "url" => NFE_URL."/nad/payment/index.php?pay_status=1"),
					"500206"=>array("name" => "세금계산서신청내역", "url" => NFE_URL."/nad/payment/tax.php", "new"=>true),
					"500207"=>array("name" => "현금영수증신청내역", "url" => NFE_URL."/nad/payment/tax.php?code=individual", "new"=>true),
				),
			),
			2 => array("code" => "500300", "name" => "패키지결제관리", 
			"sub_menu" => array(
					"500301"=>array("name" => "구인정보 패키지 설정", "url" => NFE_URL."/nad/payment/service_package.php?code=employ"),
					"500302"=>array("name" => "구인정보 패키지 등록", "url" => NFE_URL."/nad/payment/service_package_insert.php?code=employ"),
					"500303"=>array("name" => "인재정보 패키지 설정", "url" => NFE_URL."/nad/payment/service_package.php?code=resume"),
					"500304"=>array("name" => "인재정보 패키지 등록", "url" => NFE_URL."/nad/payment/service_package_insert.php?code=resume"),
				),
			),
		)
	),

	'600'=>array(
		"eng_name" => "Board",
		"link"=>NFE_URL."/nad/board/index.php",
		"new"=>true,
		"menus" => array(
			0 => array("code" => "600100", "name" => "게시판관리", 
			"sub_menu" => array(
					"600101"=>array("name" => "게시판관리", "url" => NFE_URL."/nad/board/index.php"),
					"600102"=>array("name" => "게시물관리", "url" => NFE_URL."/nad/board/list.php"),
					"600103"=>array("name" => "게시판메인설정", "url" => NFE_URL."/nad/board/main.php"),
					"600104"=>array("name" => "메인게시판출력설정", "url" => NFE_URL."/nad/board/main.php?code=site_main"),
					"600105"=>array("name" => "신고 게시물관리", "url" => NFE_URL."/nad/board/bad_report.php"),
					"600106"=>array("name" => "댓글관리", "url" => NFE_URL."/nad/board/comment.php"),
				),
			),

			1 => array("code" => "600200", "name" => "운영자관리", 
			"sub_menu" => array(
					"600201"=>array("name" => "공지사항관리", "url" => NFE_URL."/nad/board/notice.php"),
					"600202"=>array("name" => "공지사항등록", "url" => NFE_URL."/nad/board/notice_insert.php"),
					"600203"=>array("name" => "고객문의 관리", "url" => NFE_URL."/nad/board/qna.php?type=0", "new"=>true),
					"600204"=>array("name" => "광고 &middot; 제휴문의 관리", "url" => NFE_URL."/nad/board/qna.php?type=1", "new"=>true),
				),
			),

			2 => array("code" => "600300", "name" => "설문조사관리", 
			"sub_menu" => array(
					"600301"=>array("name" => "설문조사관리", "url" => NFE_URL."/nad/board/poll.php"),
					"600302"=>array("name" => "설문조사등록", "url" => NFE_URL."/nad/board/poll_insert.php"),
				),
			),

			3 => array("code" => "600400", "name" => "분류관리", 
			"sub_menu" => array(
					"600401"=>array("name" => "공지사항 분류", "url" => NFE_URL."/nad/config/category_insert.php?code=notice"),
					"600402"=>array("name" => "고객문의 분류", "url" => NFE_URL."/nad/config/category_insert.php?code=on2on"),
					"600403"=>array("name" => "광고 &middot; 제휴문의 분류", "url" => NFE_URL."/nad/config/category_insert.php?code=concert"),
				),
			),
		),
	),

	'700'=>array(
		"eng_name" => "Statistics",
		"link"=>NFE_URL."/nad/statistics/index.php",
		"menus" => array(
			0 => array("code" => "700100", "name" => "통계현황", 
			"sub_menu" => array(
					"700101"=>array("name" => "접속통계", "url" => NFE_URL."/nad/statistics/index.php"),
				),
			),
			1 => array("code" => "700200", "name" => "검색어현황", 
			"sub_menu" => array(
					"700201"=>array("name" => "검색어통계", "url" => NFE_URL."/nad/statistics/keyword.php"),
				),
			),
		)
	),
);

// : 메뉴별 개수 - /nad/config/sadmin_insert.php 이 페이지에서 사용하기 위해서
$_menu_array_count_ = array();
if(is_array($_menu_array_)) { foreach($_menu_array_ as $k=>$v) {
	if(is_array($v['menus'])) { foreach($v['menus'] as $k2=>$v2) {
		$_menu_array_count_[$k] += count($v2['sub_menu']); // : 대메뉴 rowspan 개수
		$_menu_array_count_[$v2['code']] = count($v2['sub_menu']); // : 중간메뉴 rowspan 개수
	} }
} }


class nf_admin extends nf_util {

	var $sess_adm_uid = "sess_admin_uid";

	function __construct(){
	}

	function admin_login($adm_id) {
		$_SESSION[$this->sess_adm_uid] = $adm_id;
	}

	function admin_logout() {
		$_SESSION[$this->sess_adm_uid] = "";
	}

	function check_admin($ajax='') {
		if(!$_SESSION[$this->sess_adm_uid]) {
			if($ajax) {
				$arr['msg'] = "관리자만 접근 가능합니다.";
				$arr['move'] = NFE_URL.'/';
				die(json_encode($arr));
			} else {
				die($this->move_url(NFE_URL.'/', "관리자만 접근 가능합니다."));
			}
		}
	}

	function get_sadmin($wr_id) {
		global $db, $_top_menus_;
		$admin_row = $db->query_fetch("select * from nf_admin where `wr_id`='".$wr_id."'");
		$arr['admin_menu_array'] = unserialize(stripslashes($admin_row['admin_menu']));

		$arr['first_link'] = '';
		if(is_array($arr['admin_menu_array'])) { foreach($arr['admin_menu_array'] as $k=>$v) {
			$end_txt = substr($v, 5, 1);
			if(strlen($v)==3) {
				$arr['txt'][] = $_top_menus_[$v.'000'];
			} else if($end_txt>0)  {
				if(!$arr['first_link']) $arr['first_link'] = $v;
			}
		} }
		return $arr;
	}

	function get_top_menu($top_menu_code) {
		global $_top_menus_, $_menu_array_;

		$arr['top_menu_code_head'] = substr($top_menu_code, 0, 3);
		$arr['top_menu_code_middle'] = substr($top_menu_code, 3, 1);
		$arr['top_menu_txt'] = $_top_menus_[$arr['top_menu_code_head'].'000'];
		$arr['middle_menu_txt'] = $_menu_array_[$arr['top_menu_code_head']]['menus'][$arr['top_menu_code_middle']-1]['name'];
		$arr['sub_menu_txt'] = $_menu_array_[$arr['top_menu_code_head']]['menus'][$arr['top_menu_code_middle']-1]['sub_menu'][$top_menu_code]['name'];
		$arr['sub_menu_url'] = $_menu_array_[$arr['top_menu_code_head']]['menus'][$arr['top_menu_code_middle']-1]['sub_menu'][$top_menu_code]['url'];

		return $arr;
	}
}
?>