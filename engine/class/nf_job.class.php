<?php
class nf_job extends nf_util {

	var $kind_of = array('employ'=>'구인', 'resume'=>'인재');
	var $kind_of_flip = array('employ'=>'resume', 'resume'=>'employ');
	var $kind_of_detail = array('employ'=>'/employ/employ_detail.php?no=', 'resume'=>'/resume/resume_detail.php?no=');
	var $resume_member = array();
	var $pay_service_arr = array('employ'=>'구인', 'resume'=>'인재', 'jump'=>'점프', 'read'=>'열람', "direct"=>"다이렉트결제");
	var $pay_service = array(
		'employ'=>
			array('read'=>'이력서 열람권', 'main'=>'구인정보 서비스', 'option'=>'강조옵션 상품', 'jump'=>'점프서비스'),

		'resume'=>
			array('main'=>'인재정보 서비스', 'option'=>'강조옵션 상품', 'jump'=>'점프서비스'),
	);

	var $employ_service_arr = array('package', 'main', 'sub', 'busy', 'option');
	var $resume_service_arr = array('package', 'main', 'sub', 'busy', 'option');

	var $school = array(-1=>'학력무관', 3=>'고등학교 졸업', 4=>'대학(2,3년제) 졸업', 5=>'대학(4년제) 졸업', 6=>'대학원 졸업'); // , 2=>'중학교 졸업'
	var $pay_price_css1 = array("시급"=>"hourly", "일급"=>"daily", "주급"=>"wpay", "월급"=>"salary", "연봉"=>"ysalary", "협의"=>"discussion", "TC"=>"per");
	var $pay_price_css2 = array("시급"=>"tcol3", "일급"=>"tcol2", "주급"=>"tcol7", "월급"=>"tcol1", "연봉"=>"tcol5", "협의"=>"tcol6", "TC"=>"tcol4");
	var $school_part = array(3=>'고등학교', 4=>'대학교(2,3학년)', 5=>'대학교(4학년)', 6=>'대학원');
	var $career_date_arr = array("1"=>"1년", "2"=>"2년", "3"=>"3년", "4"=>"4년", "5"=>"5년", "6"=>"6년", "7"=>"7년", "8"=>"8년", "9"=>"9년", "10"=>"10년이상");
	var $school_grade = array(0=>'석사', 1=>'박사');
	var $school_graduation = array(1=>'졸업', 3=>'졸업예정', 2=>'재학', 0=>'휴학', -1=>'중퇴');
	var $career_type = array(0=>"경력무관", 1=>"신입", 2=>"경력");
	var $army_arr = array(0=>'미필', 1=>'군필', 2=>'면제');
	var $resume_select_type = array("license"=>"자격증", "language"=>"외국어능력", "skill"=>"보유기술 및 능력", "prime"=>"수상·수료활동", "preferential"=>"구인우대사항");
	var $language_arr = array(0=>"상(회화능숙)", 1=>"중(일상대화)", 2=>"하(간단대화)");
	var $oa_arr = array('word'=>'워드 (한글·MS워드)', 'ppt'=>'프리젠테이션 (파워포인트)', 'excel'=>'스프레드시트 (엑셀)', 'internet'=>'인터넷 (정보검색)');
	var $oa_arr2 = array(
		'word'=>array(0=>'상 (표/도구활용가능)', 1=>'중 (문서편집 가능)', 2=>'하 (기본사용)', 4=>'해당없음'),
		'ppt'=>array(0=>'상 (챠트/효과 활용가능)', 1=>'중 (서식/도형 가능)', 2=>'하 (기본사용)', 4=>'해당없음'),
		'excel'=>array(0=>'상 (표/도구활용가능)', 1=>'중 (데이터 편집가능) ', 2=>'하 (기본사용)', 4=>'해당없음'),
		'internet'=>array(0=>'상 (정보수집 능숙)', 1=>'중 (정보수집 가능)', 2=>'하 (기본사용)', 4=>'해당없음'),
	);

	var $register_form = array(
		"company"=>"업소회원 회원가입시 필요한 필드를 선택하는 공간입니다. 사용유무를 선택하시면 됩니다.",
		"employ"=>"구인공고 등록시 필요한 필드를 선택하는 공간입니다. 사용유무를 선택하시면 됩니다.",
		"resume"=>"이력서 등록시 필요한 필드를 선택하는 공간입니다. 사용유무를 선택하시면 됩니다.",
	);

	var $member_service = array("read_resume"=>"이력서열람권", "read_employ"=>"구인정보열람권");
	var $service_etc = array("border"=>"테두리강조");
	var $etc_service = array("busy"=>"급구", "icon"=>"아이콘", "neon"=>"형광펜", 'color'=>"글자색", "bold"=>"굵은글자", "blink"=>"반짝칼라", "jump"=>"점프");
	var $service_count_arr = array('jump', 'read');
	var $service_only_count_arr = array('jump');
	var $person_arr = array('0', '00', '000');
	var $license_arr = array();

	var $sort_arr = array(
		'employ'=>array('wdate'=>array('ne.wr_wdate desc', '등록일순'), 'udate'=>array('ne.wr_udate desc', '최신업데이트순'), 'end_date'=>array('ne.wr_end_date desc', '마감일순'), 'career'=>array('ne.wr_career desc', '경력순')),

		'resume'=>array('wdate'=>array('nr.wr_wdate desc', '등록일순'), 'udate'=>array('nr.wr_udate desc', '최근수정일순'), 'career_up'=>array('nr.wr_career desc', '경력많은순'), 'career_down'=>array('nr.wr_career asc', '경력작은순')),
	);

	var $service_name_k_txt = array('main'=>'');
	var $service_name_k = array(
		'employ'=>array(0=>'main'),
		'resume'=>array(0=>'main'),
	);
	var $service_name = array(
		'employ'=>
			array(
				"main"=>array(0=>"플래티넘", 1=>"그랜드", 2=>"리스트", 'list'=>'일반리스트')
			),

		'resume'=>
			array(
				"main"=>array(0=>'포커스', 1=>'플러스', 'list'=>'일반리스트')
			),
	);

	var $form_arr = array(
		'company'=>array(
			'사업자번호'=>array('use', 'need'),
			'사업자등록증첨부'=>array('use', 'need'),
			'상장여부'=>array('use', 'need'),
			'업소형태'=>array('use', 'need'),
			'주요사업내용'=>array('use', 'need'),
			'설립년도'=>array('use', 'need'),
			'사원수'=>array('use', 'need'),
			'자본금'=>array('use', 'need'),
			'매출액'=>array('use', 'need'),
			'업소개요 및 비전'=>array('use', 'need'),
			'업소연혁 및 실적'=>array('use', 'need'),
		),

		'employ'=>array(
			'인근지하철'=>array('use', 'need'),
			'복리후생'=>array('use', 'need'),
			'직급/직책'=>array('use', 'need'),
			'우대조건'=>array('use', 'need'),
			'자격증'=>array('use', 'need'),
			'모집대상'=>array('use', 'need'),
			'제출서류'=>array('use', 'need'),
			//'사전질문'=>array('use', 'need'),
			'담당자 휴대폰'=>array('use', 'need'),
			'담당자 팩스'=>array('use', 'need'),
			'담당자 이메일'=>array('use', 'need'),
			'테마선택'=>array('use', 'need'),
		),

		'resume'=>array(
			'학력사항'=>array('use', 'need'),
			'자격증'=>array('use', 'need'),
			'외국어능력'=>array('use', 'need'),
			'보유기술및능력'=>array('use', 'need'),
			'수상.수료활동'=>array('use', 'need'),
			'구인우대사항'=>array('use', 'need'),
		),
	);

	var $career = array('1년', '2년', '3년', '4년', '5년', '6년', '7년', '8년', '9년', '10년이상');
	var $oa = array('워드(한글·MS워드)', '프리젠테이션(파워포인트)', '스프레드시트(엑셀)', '인터넷(정보검색)');
	var $pay_conference = array(1=>'추후협의', 2=>'면접후결정');
	var $volume_check = array("always"=>"상시모집", "end"=>"구인시까지");
	var $requisition = array("online"=>"사이트내지원", "phone"=>"전화(문자)연락", "meet"=>"업소방문", "messanger"=>"메신져", "note"=>"쪽지");

	function __construct(){
		global $db, $nf_category;
		$this->employ_where = " and ne.`is_delete`=0 and ne.`wr_report`>=0 and ne.`wr_open`=1 and !(ne.`wr_end_date`!='always' and ne.`wr_end_date`!='end' and ne.`wr_end_date`<'".today."')";
		$this->end_date_where = " and ne.`is_delete`=0 and !(ne.`wr_end_date`!='always' and ne.`wr_end_date`!='end' and ne.`wr_end_date`<='".today."')";
		$this->not_end_date_where = " and ne.`is_delete`=0 and (ne.`wr_end_date`!='always' and ne.`wr_end_date`!='end' and ne.`wr_end_date`<='".today."')";


		$this->resume_where = " and nr.`is_delete`=0 and nr.`wr_report`>=0 and nr.`wr_open`=1";

		$service_query = $db->_query("select * from nf_service");
		$this->option_use_ = array();
		while($row=$db->afetch($service_query)) {
			if($row['use'] && array_key_exists($row['type'], $this->etc_service) && !in_array($row['type'], array('jump','busy'))) $this->option_use_[$row['code']]++;
			$service_arr[$row['code']][$row['type']] = $row;
			// : 박스광고+일반줄광고 where절
			$box_service_field = 'wr_service'.$row['type'];
			if($db->is_field('nf_'.$row['code'], $box_service_field) && strpos($box_service_field, 'border')===false) {
				$service_where_arr[$row['code']][$row['type']] = $box_service_field.">='".today."'";
			}
		}
		$this->service_info = $service_arr;
		$this->service_where = $service_where_arr;

		// : 유료형 종류별 서비스 키값모음
		if(is_array($this->service_name_k)) { foreach($this->service_name_k as $k=>$v) {
			if(is_array($v)){  foreach($v as $k2=>$v2) {
				$service_arr = $this->service_name[$k][$v2];
				if(is_array($service_arr)) { foreach($service_arr as $k3=>$v3) {
					$service_charge_arr[$k][$k2.'_'.$k3] = $v3;
				} }
			} }
		} }
		$this->service_charge_arr = $service_charge_arr;

		$this->read_employ_txt = '열람신청';
		$this->read_resume_txt = '열람신청';
	}

	function get_member_status($type_member, $mb_type) {
		global $db, $nf_search, $nf_payment, $env;

		$arr = array();
		switch($mb_type) {
			case "company":
			case "company_member":
				if(count($this->service_where['employ'])>0) {
					$get_service_where = $nf_search->service_where('employ');

					if($nf_payment->service_kind_arr['employ']['0_list']['is_pay']) $service_where = "(".implode(" or ", $this->service_where['employ'])." or wr_service_busy>='".today."')";
					if(!$nf_payment->service_kind_arr['employ']['0_list']['is_pay'] && $env['service_employ_audit_use']) $service_where = "(".implode(" or ", $this->service_where['employ'])." or wr_service_busy>='".today."')";
					if(!$env['service_employ_use']) $service_where = "(".implode(" or ", $this->service_where['employ'])." or wr_service_busy>='".today."')";

					$service_where = " and ".$service_where; // : 서비스까지 체크할경우 서비스 사용하는
					$service_not_where = " and !".$service_where; // : 서비스까지 체크할경우 서비스사용안하는
				}
				$_where = " and ne.`cno`=".intval($type_member['no']);
				if($mb_type=='company_member') $_where = " and ne.`mno`=".$type_member['no'];
				$_where .= " and `is_delete`=0";
				$base_where = $this->employ_where.$service_where;
				$employ_ing = $db->query_fetch("select count(*) as c from nf_employ as ne where 1 ".$_where." ".$base_where);
				$employ_end = $db->query_fetch("select count(*) as c from nf_employ as ne where 1 ".$_where." and !(1 ".$base_where.")");

				$arr['employ_ing'] = $employ_ing['c'];
				$arr['employ_end'] = $employ_end['c'];

				if($mb_type=='company_member') {
					$accept = $db->query_fetch("select count(*) as c from nf_accept as na where na.`code`='employ' and na.`pdel`=0 and na.`pmno`=".intval($type_member['no'])." and pdel=0");
					$accept2 = $db->query_fetch("select count(*) as c from nf_accept as na where na.`code`='resume' and na.`mno`=".intval($type_member['no'])." and del=0");
					$scrap = $db->query_fetch("select count(*) as c from nf_scrap as ns right join (nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno`) on ns.`pno`=nr.`no` where ns.`code`='resume' and ns.`mno`=".intval($type_member['no']));
					$message = $db->query_fetch("select count(*) as c from nf_message as nm where 1 and `pdel`=0 and `rdate`='1000-01-01 00:00:00' and `pmno`=".intval($type_member['no']));

					$get_customized = $this->get_customized($type_member['mb_id']);
					$_SERVER['customized_get'] = $get_customized['customized'];

					$where_arr = $nf_search->resume();
					unset($_SERVER['customized_get']);
					$service_where = $nf_search->service_where('resume');
					$_where = $where_arr['where'];
					if($_where) {
						$customized = $db->query_fetch("select count(*) as c from nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno` where 1 ".$_where.$this->resume_where);
					}

					$arr['accept'] = intval($accept['c']);
					$arr['accept2'] = intval($accept2['c']);
					$arr['scrap'] = intval($scrap['c']);
					$arr['message'] = intval($message['c']);
					$arr['customized'] = intval($customized['c']);
				}
			break;

			case "individual":
				$resume_ing = $db->query_fetch("select count(*) as c from nf_resume as nr where nr.`mno`=".intval($type_member['no'])." ".$this->resume_where);
				$arr['resume_ing'] = $resume_ing['c'];

				$accept = $db->query_fetch("select count(*) as c from nf_accept as na where na.`code`='employ' and `del`=0 and na.`mno`=".intval($type_member['no']));
				$scrap = $db->query_fetch("select count(*) as c from nf_scrap as ns right join nf_employ as ne on ns.`pno`=ne.`no` where ns.`code`='employ' and ns.`mno`=".intval($type_member['no']));
				$resume_open = $db->query_fetch("select count(distinct nr.`mno`) as c from (nf_not_read as nnr right join nf_member_company as nmc on nnr.`exmno`=nmc.`no`) right join ((nf_member as nm right join nf_read as nr on nm.`no`=nr.`mno`) right join nf_resume as nr2 on nr.`pno`=nr2.`no`) on nmc.`no`=nr.`exmno` where nm.`mb_type`='company' and nmc.`no`=nr.`exmno` and nr.`code`='resume' and nr2.`mno`=".intval($type_member['no'])." and nnr.`exmno` is null");
				$favorite = $db->query_fetch("select count(*) as c from nf_interest as ni right join nf_member_company as nmc on ni.`exmno`=nmc.`no` where ni.`mno`=".intval($type_member['no']));
				$resume_not_open = $db->query_fetch("select count(distinct nr.`mno`) as c from (nf_not_read as nnr left join nf_member_company as nmc on nnr.`exmno`=nmc.`no`) right join ((nf_member as nm right join nf_read as nr on nm.`no`=nr.`mno`) right join nf_resume as nr2 on nr.`pno`=nr2.`no`) on nmc.`no`=nr.`exmno` where nm.`mb_type`='company' and nmc.`no`=nr.`exmno` and nr.`code`='resume' and nr2.`mno`=".intval($type_member['no'])." and nnr.`exmno`=nmc.`no`");
				$message = $db->query_fetch("select count(*) as c from nf_message as nm where 1 and `pdel`=0 and `rdate`='1000-01-01 00:00:00' and `pmno`=".intval($type_member['no']));

				$get_customized = $this->get_customized($type_member['mb_id']);
				$_SERVER['customized_get'] = $get_customized['customized'];

				$where_arr = $nf_search->employ();
				unset($_SERVER['customized_get']);
				$service_where = $nf_search->service_where('employ');
				$_where = $where_arr['where'];
				if($_where) {
					$customized = $db->query_fetch("select count(*) as c from nf_employ as ne where 1".$_where.$this->employ_where);
				}

				$arr['accept'] = intval($accept['c']);
				$arr['scrap'] = intval($scrap['c']);
				$arr['resume_open'] = intval($resume_open['c']);
				$arr['resume_not_open'] = intval($resume_not_open['c']);
				$arr['favorite'] = intval($favorite['c']);
				$arr['message'] = intval($message['c']);
				$arr['customized'] = intval($customized['c']);
			break;
		}

		return $arr;
	}

	function service_name_setting() {
		global $env;
		if(is_array($env['service_name_arr'])) { foreach($env['service_name_arr'] as $kind=>$array) {
			if(is_array($array)) { foreach($array as $service_k=>$name) {
				$service_k_arr = explode("_", $service_k);
				$sub_k = $this->service_name_k[$kind][$service_k_arr[0]];
				$this->service_name[$kind][$sub_k][$service_k_arr[1]] = $name;
			} }
		} }
	}

	function service_query($code, $arr) {
		global $db, $env;

		$adver_w = $env['service_config_arr'][$code][$arr['service_k']]['width'];
		$adver_h = $env['service_config_arr'][$code][$arr['service_k']]['height'];

		// : 급구는 일반리스트 개수로
		if(in_array($arr['service_k'], array('busy', '0_list'))) {
			$adver_w = $env['service_config_arr'][$code]['0_list']['width'];
			$adver_h = $env['service_config_arr'][$code]['0_list']['height'];
		}

		if(!$arr['limit']) {
			$arr['limit'] = intval($adver_w*$adver_h);
		}

		switch($code) {
			case "employ":
				$q = "nf_employ as ne where 1 ".$arr['where'].$this->employ_where;
			break;

			case "resume":
				$q = "nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno` where 1 ".$this->resume_where.$arr['where']; // .$this->resume_where
			break;
		}

		$page_int = $_GET['page'];
		$start = $this->start_page($page_int, $arr);
		if(strpos($arr['service_k'], '_list')===false) $start = 0; // : 박스광고는 limit 시작을 0부터
		$limit = " limit ".$start.", ".$arr['limit'];
		if(!$arr['field_set']) $arr['field_set'] = '*';
		$arr['q_all'] = "select ".$arr['field_set']." from ".$q.$arr['order'].$limit;
		$query = $db->_query($arr['q_all']);
//echo $arr['q_all'].' <=== <br>';    
		$arr['query'] = $query;
		if($arr['service_k']=='0_list') {
			$total = $db->query_fetch("select count(*) as c from ".$q);
			$total = $total['c'];
		} else {
			$total = $db->num_rows($query);
		}

		if($adver_w) {
			$arr['list_limit'] = $arr['limit']<$total ? $arr['limit'] : $total+$this->get_remain($total, $adver_w);
		} else {
			$arr['list_limit'] = $arr['limit'];
		}

		while($em_row = $db->afetch($query)) {
			$arr['list'][] = $em_row;
		}

		$arr['q'] = $q;
		$arr['total'] = $total;
		$arr['limit_arr'] = array($adver_w, $adver_h);

		return $arr;
	}

	function get_customized($mb_id) {
		global $db;
		$member = $db->query_fetch("select * from nf_member where `mb_id`=?", array($mb_id));
		$arr['customized'] = unserialize(stripslashes($member['mb_customized']));
		if(!$arr['customized']) $arr['customized'] = array();
		return $arr;
	}

	function employ_info($row) {
		global $cate_array, $env, $employ_busy_icon, $read_allow;

		$arr['job_type_cnt'] = 1;
		$arr['area_cnt'] = 1;
		$arr['subway_cnt'] = 1;
		$arr['area_text_arr2_txt'] = array();
		$arr['job_type_text_arr2_txt'] = array();

		if($row) {
			$arr = $row;

			// $env['employ_logo'] - text, logo, bg

			$arr['phone_arr'] = explode("-", $row['wr_phone']);
			$arr['hphone_arr'] = explode("-", $row['wr_hphone']);
			$arr['fax_arr'] = explode("-", $row['wr_fax']);
			$arr['email_arr'] = explode("@", $row['wr_email']);

			$arr['job_type_arr'] = explode(chr(10), $row['wr_job_type']);
			$arr['job_type_cnt'] = count($arr['job_type_arr'])>0 ? count($arr['job_type_arr']) : 1;
			$arr['job_type_text_arr'] = explode(chr(10), strtr($row['wr_job_type'], $cate_array['job_part']));
			$arr['area_arr'] = explode(chr(10), $row['wr_area']);
			$arr['area_cnt'] = count($arr['area_arr'])>0 ? count($arr['area_arr']) : 1;
			$arr['doro_area_arr'] = explode(chr(10), $row['wr_doro_area']);

			if(is_array($cate_array['subway'])) {
				$arr['subway_arr'] = explode(chr(10), $row['wr_subway']);
				$arr['subway_text_arr'] = explode(chr(10), strtr($row['wr_subway'], $cate_array['subway']));
				$arr['subway_cnt'] = count($arr['subway_arr'])>0 ? count($arr['subway_arr']) : 1;
			}

			if(is_array($arr['job_type_text_arr'])) { foreach($arr['job_type_text_arr'] as $k=>$v) {
				if($v) {
					
					$job_type_text_arr2 = $arr['job_type_text_arr2'][] = explode(",", $v);
					$arr['job_type_text_arr2_txt'][] = (is_array($job_type_text_arr2)) ? implode(">", array_diff($job_type_text_arr2, array(""))) : "";
					$arr['job_type_text_arr2_one_txt'][] = array_pop(array_diff($job_type_text_arr2, array("")));
					$arr['job_type_1'] = $job_type_text_arr2[1];  //업종1개만 노출시 첫번째 업종값
				}
			} }

			if(is_array($arr['area_arr'])) { foreach($arr['area_arr'] as $k=>$v) {
				if($v) {
					$arr['safsd'][] = $v;
					$area_text_arr2 = $arr['area_text_arr2'][] = explode(",", $v);
					$arr['area_text_arr22_txt'][] = (is_array($area_text_arr2)) ? $area_text_arr2[1].' '.$area_text_arr2[2] : "";
					$arr['area_text_arr2_txt'][] = (is_array($area_text_arr2)) ? $area_text_arr2[1].' '.$area_text_arr2[2].' '.$area_text_arr2[3] : "";
				}
			} }

			$arr['stime_arr'] = explode(":", $row['wr_stime']);
			$arr['etime_arr'] = explode(":", $row['wr_etime']);
			$arr['time_txt'] = $row['wr_time_conference'] ? '시간협의' : $row['wr_stime'].' ~ '.$row['wr_etime'];
			$arr['photo_arr'] = explode(",", $row['wr_photo']);
			$arr['pay_support_arr'] = explode(",", $row['wr_pay_support']);
			$arr['work_type_arr'] = explode(",", $row['wr_work_type']);
			$arr['welfare_arr'] = explode(",", $row['wr_welfare']);
			$arr['age_etc_arr'] = explode(",", $row['wr_age_etc']);
			$arr['age_arr'] = explode("-", $row['wr_age']);
			$arr['grade_arr'] = explode(",", $row['wr_grade']);
			$arr['position_arr'] = explode(",", $row['wr_position']);
			$arr['preferential_arr'] = explode(",", $row['wr_preferential']);
			$arr['requisition_arr'] = explode(",", $row['wr_requisition']); if(!is_array($arr['requisition_arr'])) $arr['requisition_arr'] = array();
			$arr['target_arr'] = explode(",", $row['wr_target']);
			$arr['papers_arr'] = explode(",", $row['wr_papers']);
			$arr['keyword_arr'] = array_diff(explode(",", $row['wr_keyword']), array(""));
			$arr['manager_not_view_arr'] = explode(",", $row['manager_not_view']);

			// : 디자인관리 > 사이트디자인설정 > 구인공고 로고설정에 텍스트, 이미지, 배경 사용한경우
			if($env['employ_logo']!='all') $arr['wr_logo_type'] = $env['employ_logo'];

			switch($arr['wr_logo_type']) {
				case "bg":
					$logo_val = is_file(NFE_PATH.'/data/employ/'.$row['wr_logo_bg']) ? $row['wr_logo_bg'] : "";
					$arr['logo_code'] = 'image';
					if($logo_val) $arr['logo_bg'] = NFE_URL.'/data/employ/'.$row['wr_logo_bg'];
					else $arr['logo_bg'] = NFE_URL.'/data/logo/'.$env['employ_logo_bg'];
					$arr['logo_class'] = 'logo_bg-';
				break;

				case "logo":
					$logo_val = is_file(NFE_PATH.'/data/employ/'.$row['wr_logo']) ? $row['wr_logo'] : "";
					$arr['logo_code'] = 'image';
					if($logo_val) $arr['logo_logo'] = NFE_URL.'/data/employ/'.$row['wr_logo'];
					else $arr['logo_logo'] = NFE_URL.'/data/logo/'.$env['employ_logo_img'];
				break;
			}

			// : bg나 로고가 없으면 text형입니다.
			if(!$arr['logo_'.$arr['wr_logo_type']]) $arr['logo_text'] = $row['wr_logo_text'] ? $row['wr_logo_text'] : $row['wr_company_name'];
			$arr['logo_image'] = $arr['logo_'.$arr['wr_logo_type']]; // : 출력이미지
			$arr['is_logo_image'] = $logo_val ? true : false;
			if(!$arr['logo_class']) $arr['logo_class'] = 'line2';

			$arr['career_txt'] = $this->career_type[$row['wr_career_type']];
			if($row['wr_career_type']=='2') $arr['career_txt'] .= ' '.$this->career_date_arr[$row['wr_career']];
			$arr['career_txt2'] = $row['wr_career_type']=='2' ? $this->career_date_arr[$row['wr_career']].'이상' : $this->career_type[$row['wr_career_type']];
			$arr['pay_txt'] = $row['wr_pay_conference'] ? $this->pay_conference[$row['wr_pay_conference']] : $cate_array['job_pay'][$row['wr_pay_type']].' '.number_format(intval($row['wr_pay'])).'원';
			$arr['pay_txt_first'] = $row['wr_pay_conference'] ? "협의" : $cate_array['job_pay'][$row['wr_pay_type']];
			$arr['pay_txt_price'] = $row['wr_pay_conference'] ? $this->pay_conference[$row['wr_pay_conference']] : number_format(intval($row['wr_pay'])).'원';

			$arr['end_date'] = array_key_exists($row['wr_end_date'], $this->volume_check) ? $this->volume_check[$row['wr_end_date']] : ($row['wr_end_date']>=today ? $row['wr_end_date'] : '마감');

			$arr['end_date_text'] = $row['wr_end_date']==today ? '오늘마감' : '접수중';

			$arr['gender_text'] = !$row['wr_gender'] ? '성별무관' : $this->gender_arr[$row['wr_gender']];

			// : 성별
			if(!$row['wr_age_limit']) $arr['age_text'] = '연령무관';
			else {
				if(!$arr['age_arr'][0] || !$arr['age_arr'][1]) {
					$arr['age_text'] = !$arr['age_arr'][0] ? $arr['age_arr'][1].'까지' : $arr['age_arr'][0].'이상';
				} else {
					$arr['age_text'] = strtr($row['wr_age'], array('-'=>'세 ~ ')).'세';
				}
			}

			// : 옵션, 아이콘
			if($row['wr_service_icon']>=today && is_file(NFE_PATH.'/data/service_option/'.$row['wr_service_icon_value']))
				$arr['icon_text'] = '<img src="'.NFE_URL.'/data/service_option/'.$row['wr_service_icon_value'].'">';
			if($row['wr_service_busy']>=today && is_file(NFE_PATH.'/data/service_option/'.$employ_busy_icon))
				$arr['busy_text'] = '<img src="'.NFE_URL.'/data/service_option/'.$employ_busy_icon.'">';
			if($row['wr_service_neon']>=today) $arr['neon_text'] = 'background:'.$row['wr_service_neon_value'].' !important;';
			if($row['wr_service_color']>=today) $arr['color_text'] = 'color:'.$row['wr_service_color_value'].';';
			if($row['wr_service_bold']>=today) $arr['bold_text'] = ' fwb';
			if($row['wr_service_blink']>=today) $arr['blink_text'] = ' service-blink-';
			
			//업체명 or 닉네임 노출
			$arr['company_name_nick'] = is_nickname ? $row['wr_nickname'] : $row['wr_company_name'];
		}
		return $arr;
	}

	function resume_info($row) {
		global $cate_array, $cate_p_array, $db, $nf_member, $resume_busy_icon, $read_allow;
		$category_array = $cate_array;
		$category_array['area']['all'] = '전체';

		if(!$nf_member->member_arr[$row['mno']]) {
			$mem_row = $nf_member->get_member($row['mno']);
		}

		if(!$this->resume_member[$row['mno']]) {
			$this->resume_member[$row['mno']] = $db->query_fetch("select * from nf_member where `no`=".intval($row['mno']));
		}
		$row['mb_name'] = $this->resume_member[$row['mno']]['mb_name'];
		$row['mb_gender'] = $this->resume_member[$row['mno']]['mb_gender'];
		$row['mb_birth'] = $this->resume_member[$row['mno']]['mb_birth'];

		$arr['job_type_cnt'] = 1;
		$arr['area_cnt'] = 1;
		if($row) {
			$arr = $row;

			if(is_file(NFE_PATH.'/data/member/'.$nf_member->member_arr[$row['mno']]['mb_photo']) && $read_allow)
				$arr['photo_src'] = NFE_URL.'/data/member/'.$nf_member->member_arr[$row['mno']]['mb_photo'];
			else
				$arr['photo_src'] = ($mem_row['mb_gender']==='1') ? NFE_URL.'/images/m_injae.png' : NFE_URL.'/images/w_injae.png';

			// : 성별, 나이는 열람안해도 공개
			$arr['name_txt'] = $read_allow ? $row['mb_name'] : mb_substr($row['mb_name'], 0, 1, "UTF-8").'○○';
			$arr['gender_txt'] = $nf_member->gender_short_arr[$row['mb_gender']];
			$arr['age_txt'] = $this->get_age($row['mb_birth']);
			$arr['gender_age_txt'] = '('.$arr['age_txt'].'·'.$arr['gender_txt'].')';

			if($row['_is_read_']) {
				$arr['name_txt'] = $row['mb_name'];
			}

			$arr['job_type_arr'] = explode(chr(10), $row['wr_job_type']);
			$arr['job_type_text_arr'] = explode(chr(10), strtr($row['wr_job_type'], $cate_array['job_part']));
			$arr['job_type_cnt'] = count($arr['job_type_arr'])>0 ? count($arr['job_type_arr']) : 1;
			$arr['area_arr'] = explode(chr(10), strtr($row['wr_area'], array("all"=>"전체")));
			$arr['area_cnt'] = count($arr['area_arr'])>0 ? count($arr['area_arr']) : 1;

			$arr['career_txt'] = $this->get_month_year($row['wr_career']);
			$arr['career2_txt'] = $row['wr_career']<=0 ? '신입' : '경력 | '.$arr['career_txt'];
			$arr['career3_txt'] = $row['wr_career']<=0 ? '신입' : '경력 '.$arr['career_txt'];

			$arr['work_type_arr'] = explode(",", $row['wr_work_type']);
			$arr['computer_arr'] = explode(",", $row['wr_computer']);
			$arr['treatment_service_arr'] = explode(",", $row['wr_treatment_service']);
			$arr['military_sdate_arr'] = explode("-", $row['wr_military_sdate']);
			$arr['military_edate_arr'] = explode("-", $row['wr_military_edate']);
			$arr['calltime_arr'] = explode("-", $row['wr_calltime']);
			$arr['attach_arr'] = $this->get_unse($row['wr_attach']);

			$arr['calltime_txt'] = $row['wr_calltime_always'] ? '언제나 가능' : $arr['calltime_arr'][0].':00 ~ '.$arr['calltime_arr'][1].':00';

			if(is_array($arr['job_type_text_arr'])) { foreach($arr['job_type_text_arr'] as $k=>$v) {
				if($v) {
					$job_type_text_arr2 = $arr['job_type_text_arr2'][] = explode(",", $v);
					$arr['job_type_text_arr2_txt'][] = (is_array($job_type_text_arr2)) ? implode(">", array_diff($job_type_text_arr2, array(""))) : "";
					$arr['job_type_text_arr2_one_txt'][] = array_pop(array_diff($job_type_text_arr2, array("")));
					$arr['job_type_1'] = $job_type_text_arr2[1];  //업종1개만 노출시 첫번째 업종값
				}
			} }

			if(is_array($arr['area_arr'])) { foreach($arr['area_arr'] as $k=>$v) {
				if($v) {
					$area_text_arr2 = $arr['area_text_arr2'][] = explode(",", $v);
					$arr['area_text_arr2_txt'][] = (is_array($area_text_arr2)) ? $area_text_arr2[1].' '.$area_text_arr2[2] : "";
					$arr['area_text_arr2_txt2'][] = $area_text_arr2[3];
					
				}
			} }

			$arr['pay_type'] = $row['wr_pay_conference'] ? '협의' : $cate_array['job_pay'][$row['wr_pay_type']];
			$arr['pay_type_short'] = mb_substr($arr['pay_type'],0,1,"UTF-8");
			$arr['pay_txt_price'] = $row['wr_pay_conference'] ? $this->pay_conference[$row['wr_pay_conference']] : number_format(intval($row['wr_pay'])).'원';
			$arr['price_txt'] = $cate_p_array['job_pay'][0][$row['wr_pay_type']]['wr_name'] ? $cate_p_array['job_pay'][0][$row['wr_pay_type']]['wr_name'].' '.number_format(intval($row['wr_pay'])) : '';
			if($row['wr_pay_conference']) $arr['price_txt'] = '추후협의';

			// : 옵션, 아이콘
			$arr['wr_service0_0_value_arr'] = explode(",", $row['wr_service0_0_value']);
			$arr['wr_service1_0_value_arr'] = explode(",", $row['wr_service1_0_value']);
			if(is_array($arr['wr_service0_0_value_arr'])) { foreach($arr['wr_service0_0_value_arr'] as $k=>$v) {
				if(is_file(NFE_PATH.'/data/service_option/'.$v)) $arr['icon_focus0'] .= '<img src="'.NFE_URL.'/data/service_option/'.$v.'"> ';
			} }
			if(is_array($arr['wr_service1_0_value_arr'])) { foreach($arr['wr_service1_0_value_arr'] as $k=>$v) {
				if(is_file(NFE_PATH.'/data/service_option/'.$v)) $arr['icon_focus1'] .= '<img src="'.NFE_URL.'/data/service_option/'.$v.'"> ';
			} }

			if($row['wr_service_icon']>=today && is_file(NFE_PATH.'/data/service_option/'.$row['wr_service_icon_value']))
				$arr['icon_text'] = '<img src="'.NFE_URL.'/data/service_option/'.$row['wr_service_icon_value'].'">';
			if($row['wr_service_busy']>=today && is_file(NFE_PATH.'/data/service_option/'.$resume_busy_icon))
				$arr['busy_text'] = '<img src="'.NFE_URL.'/data/service_option/'.$resume_busy_icon.'">';
			if($row['wr_service_neon']>=today) $arr['neon_text'] = 'background:'.$row['wr_service_neon_value'].' !important;';
			if($row['wr_service_color']>=today) $arr['color_text'] = 'color:'.$row['wr_service_color_value'].';';
			if($row['wr_service_bold']>=today) $arr['bold_text'] = ' fwb';
			if($row['wr_service_blink']>=today) $arr['blink_text'] = ' service-blink-';
		}
		return $arr;
	}

	function resume_individual($mno) {
		global $db;
		$row = $db->query_fetch("select * from nf_member as nm right join nf_member_individual as nmi on nm.`no`=nmi.`mno` where nm.`no`=".intval($mno));

		$arr = $row;
		if($row['wr_school_ability']) $arr['school_text'] = $this->school_part[$row['wr_school_ability']].$this->school_graduation[$row['wr_school_ability_end']];
		$arr['school_type_arr'] = explode(",", $row['wr_school_type']);
		$arr['wr_school_info'] = $this->get_unse($row['wr_school_info']);
		$arr['career_info'] = $this->get_unse($row['wr_career_info']);
		$arr['license_arr'] = $this->get_unse($row['wr_license']);
		$arr['language_arr'] = $this->get_unse($row['wr_language']);
		$arr['oa_arr'] = $this->get_unse($row['wr_oa']);
		$arr['computer_arr'] = explode(",", $row['wr_computer']);
		$arr['treatment_service_arr'] = explode(",", $row['wr_treatment_service']);
		$arr['military_sdate_arr'] = explode("-", $row['wr_military_sdate']);
		$arr['military_edate_arr'] = explode("-", $row['wr_military_edate']);

		return $arr;
	}

	function get_member() {
	}

	// : 열람여부 체크 [ 무료로 볼수 있는지 체크하기 ]
	function read_allow($mno, $pno, $code) {
		global $db, $nf_payment, $nf_member;
		$reverse_code = $code=='resume' ? 'employ' : 'resume';

		$_where = "";
		if($mno) {
			$get_member = $db->query_fetch("select * from nf_member where `no`=".intval($mno));
			if($member['mb_type']=='company') $_where .= " and `is_public`=1";
			$get_member_ex = $db->query_fetch("select * from nf_member_".$get_member['mb_type']." where `mno`=? ".$_where, array($get_member['no']));
			$get_member_se = $db->query_fetch("select * from nf_member_service where `mno`=?", array($get_member['no']));
		}

		// : 열람서비스 사용안하면 무조건 공개 [ 무조건 공개에서 read테이블에 저장시키는게 맞을지.. ]
		$service_row = $db->query_fetch("select * from nf_service where `code`=? and `type`=?", array($code, 'read'));

		$arr = $nf_member->get_member_ex($mno);
		$get_member = $arr['member'];
		$get_member_ex = $arr['member_ex'];
		$get_member_se = $arr['member_se'];

		$info_table = "nf_".$code;
		$row = $db->query_fetch("select * from nf_read_pay where `mno`=? and `pno`=? and `code`=?", array(intval($get_member['no']), $pno, $code));
		$info_row = $db->query_fetch("select * from ".$info_table." where `no`=?", array($pno));

		$allow_read = $get_member['no'] && $get_member['no'] && $get_member['no']===$info_row['mno'] ? true : false; // : 본인은 확인가능
		if(!$nf_payment->service_kind_arr[$code]['read']['use']) $allow_read = true; // : 열람서비스 사용안하면 무조건 볼 수 있게.
		if($row['pay_read']) $allow_read = true; // : 차감으로 읽은경우
		if($get_member_se['mb_'.$code.'_read']>=today) $allow_read = true; // : 열람기간이 남은경우
		if(!$service_row['use']) $allow_read = true; // : 열람서비스 사용안하면 무조건 공개

		// : 입사지원, 입사제의 한경우 그 정보의 주인은 봐야함.
		if(!$allow_read) {
			$accept_row = $db->query_fetch("select * from nf_accept where `code`=? and `sel_no`=? and `pmno`=? and `mno`=?", array($reverse_code, $pno, $get_member['no'], $info_row['mno']));
			if($accept_row) {
				$accept_row['view_arr'] = explode(",", $accept_row['view']);
				$allow_read = true;
			}
		}

		$arr['allow'] = $allow_read;
		$arr['read_row'] = $row;
		$arr['info_row'] = $info_row;
		$arr['accept_row'] = $accept_row;
		return $arr;
	}

	// : 읽기 함수
	function read($mno, $pno, $code) {
		global $db, $is_admin, $nf_payment, $not_read_div_box, $accept_row;

		//if($is_admin) return true; // : 관리자는 무조건 허용 그리고 읽은것을 디비에 저장안해야함.

		$info_table = "nf_".$code;
		$allow_arr = $this->read_allow($mno, $pno, $code);
		$allow_read = $allow_arr['allow'];
		$get_member = $allow_arr['member'];
		$get_member_ex = $allow_arr['member_ex'];
		$get_member_se = $allow_arr['member_se'];
		$info_row = $allow_arr['info_row'];
		$accept_row = $allow_arr['accept_row'];

		// : 열람료를 내야 보는 경우에는 건수가 있나 체크하기
		if($get_member_se['no']) {
			// : 한번도 결제로 읽지 않거나 열람기간이 없는경우 차감해서 읽게 함.
			$read_int_field = 'mb_'.$code.'_read_int';
			if(!$allow_read && $get_member_se[$read_int_field]>0) {
				// : 안읽었을경우 confirm으로 사용권 사용할지 물어보기
				$not_read_div_box = true;
			}
		}

		// : 상세페이지가 아니면 여기까지 실행
		if(strpos($_SERVER['PHP_SELF'], 'detail.php')===false) return $allow_read;

		// : 입사지원, 면접제의 목록중 상대방이 내것을 볼경우 /////////////
		if($accept_row) $db->_query("update nf_accept set `rdate`=? where `no`=?", array(today_time, $accept_row['no']));
		//////////////////////////////////////////////////////////////

		read_insert($mno, $code, $pno, $allow_arr);

		$update = $db->_query("update ".$info_table." set `wr_hit`=`wr_hit`+1 where `no`=?", array($info_row['no']));

		// : 읽기권한
		return $allow_read;
	}
}
?>