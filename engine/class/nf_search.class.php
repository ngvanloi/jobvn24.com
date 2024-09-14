<?php
class nf_search extends nf_util {

	function __construct() {
		global $db;
	}

	## : 기본 검색 ########################

	function insert($arr) {
		global $db;
		$arr['content'] = trim($arr['content']);
		if(!$arr['content']) return false; // : 검색어가 없으면 저장하지 않습니다.

		$row = $db->query_fetch("select * from nf_search where `wr_wdate`>=? and `code`=? and `wr_content`=?", array(today.' 00:00:00', $arr['code'], $arr['content']));
		$_val = array();
		if(!$row) {
			$_val['code'] = $arr['code'];
			$_val['wr_content'] = $arr['content'];
			$_val['wr_wdate'] = today_time;
		}
		$_val['wr_hit'] = intval($row['wr_hit'])+1;
		$_val['wr_udate'] = today_time;
		$q = $db->query_q($_val);
		if($row) $db->_query("update nf_search set ".$q." where `no`=".intval($row['no']), $_val);
		else $db->_query("insert into nf_search set ".$q, $_val);
	}

	// : 회원검색
	function member() {
		global $is_admin;

		$_where = "";
		$_date_arr = array();
		$_keyword = array();
		$_login_count_arr = array();

		// : 관리자 권한 검색
		if($is_admin) {
			// : 날짜
			$field = $_GET['rdate'] ? 'mb_'.$_GET['rdate'] : 'mb_wdate';
			if($_GET['date1']) $_date_arr[] = "nm.`".$field."`>='".addslashes($_GET['date1'])." 00:00:00'";
			if($_GET['date2']) $_date_arr[] = "nm.`".$field."`<='".addslashes($_GET['date2'])." 23:59:59'";
			if($_date_arr[0]) $_where .= " and (".implode(" and ", $_date_arr).")";

			if($_GET['mb_type']) $_where .= " and `mb_type`='".addslashes($_GET['mb_type'])."'";
			if(strlen($_GET['mb_email_receive'])>0) $_where .= $_GET['mb_email_receive'] ? " and find_in_set('email', `mb_receive`)" : " and !find_in_set('email', `mb_receive`)";
			if(strlen($_GET['mb_sms_receive'])>0) $_where .= $_GET['mb_sms_receive'] ? " and find_in_set('sms', `mb_receive`)" : " and !find_in_set('sms', `mb_receive`)";
			if($_GET['mb_biz_type'][0]) $_where .= " and `mb_biz_type` in ('".implode("','", $_GET['mb_biz_type'])."')";
			if($_GET['mb_biz_success'][0]) $_where .= " and `mb_biz_success` in ('".implode("','", $_GET['mb_biz_success'])."')";
			if($_GET['mb_biz_form'][0]) $_where .= " and `mb_biz_form` in ('".implode("','", $_GET['mb_biz_form'])."')";

			// : 통합검색
			$_keyword['id'] = "nm.`mb_id`='".addslashes($_GET['search_keyword'])."'";
			$_keyword['name'] = "nm.`mb_name`='".addslashes($_GET['search_keyword'])."'";
			$_keyword['email'] = "nm.`mb_email`='".addslashes($_GET['search_keyword'])."'";
			$_keyword['nick'] = "nm.`mb_nick`='".addslashes($_GET['search_keyword'])."'";
			$_keyword['hphone'] = "replace(nm.`mb_hphone`,'-','')='".addslashes(strtr($_GET['search_keyword'], array('-'=>'')))."'";
			$_keyword['phone'] = "replace(nm.`mb_phone`,'-','')='".addslashes(strtr($_GET['search_keyword'], array('-'=>'')))."'";

			/*
			$_keyword['biz_fax'] = "replace(nmc.`mb_biz_fax`,'-','')='".addslashes(strtr($_GET['search_keyword'], array('-'=>'')))."'";
			$_keyword['ceo_name'] = "nmc.`mb_ceo_name`='".addslashes($_GET['search_keyword'])."'";
			$_keyword['company_name'] = "nmc.`mb_company_name`='".addslashes($_GET['search_keyword'])."'";
			$_keyword['biz_no'] = "nmc.`mb_biz_no`='".addslashes($_GET['search_keyword'])."'";
			*/
			if($_GET['search_keyword']) {
				if(array_key_exists($_GET['search_field'], $_keyword)) $_where .= " and ".$_keyword[$_GET['search_field']];
				else $_where .= " and (".implode(" or ", $_keyword).")";
			}

			if(!$_GET['login_count_all']) {
				if($_GET['login_count'][0]) $_login_count_arr[] = "nm.mb_login_count>=".intval($_GET['login_count'][0]);
				if($_GET['login_count'][1]) $_login_count_arr[] = "nm.mb_login_count<=".intval($_GET['login_count'][1]);
				if($_login_count_arr[0]) $_where .= " and (".implode(" and ", $_login_count_arr).")";
			}

			if($_GET['badness']) $_badness = " and nm.`mb_badness`=1";
			if($_GET['left_request']) $_where .= " and nm.`mb_left_request`=1";
			if($_GET['left']) $_where .= " and nm.`mb_left`=1";
			if($_GET['type']) $_where .= " and nm.`mb_type`='".addslashes($_GET['type'])."'";
		}

		$_where .= $_badness;

		$arr['where'] = $_where;

		return $arr;
	}

	function cs() {
		global $is_admin;
		if($is_admin) {
			// : 날짜
			$field = 'wr_date';
			if($_GET['date1']) $_date_arr[] = "cs.`".$field."`>='".addslashes($_GET['date1'])." 00:00:00'";
			if($_GET['date2']) $_date_arr[] = "cs.`".$field."`<='".addslashes($_GET['date2'])." 23:59:59'";
			if($_date_arr[0]) $_where .= " and (".implode(" and ", $_date_arr).")";

			if($_GET['wr_cate']) $_where .= " and `wr_cate`=".intval($_GET['wr_cate']);

			// : 통합검색
			$_keyword['wr_subject'] = "cs.`wr_subject` like '%".addslashes($_GET['search_keyword'])."%'";
			$_keyword['wr_content'] = "cs.`wr_content` like '%".addslashes($_GET['search_keyword'])."%'";
			$_keyword['wr_name'] = "cs.`wr_name` like '%".addslashes($_GET['search_keyword'])."%'";

			if($_GET['search_keyword']) {
				if($_GET['search_field']=='wr_subject||wr_content') $_where .= " and (".$_keyword['wr_subject']." or ".$_keyword['wr_content'].")";
				if(array_key_exists($_GET['search_field'], $_keyword)) $_where .= " and ".$_keyword[$_GET['search_field']];
				else $_where .= " and (".implode(" or ", $_keyword).")";
			}
		}

		$arr['where'] = $_where;

		return $arr;
	}


	function service_where($code, $service_k="") {
		global $nf_job, $db;

		$arr = array();
		$arr['not_pay'] = array();
		$count = 0;
		$arr['wheres'] = array();
		$arr['service_field'] = array();
		if(is_array($nf_job->service_name[$code])) { foreach($nf_job->service_name[$code] as $k=>$v) {
			if(is_array($v)) { foreach($v as $k2=>$v2) {
				$field_k = $count."_".$k2;
				$field = 'wr_service'.$field_k;
				if(in_array($field_k, array('1_list'))) {
					$service_row = $db->query_fetch("select * from nf_service where `code`=? and `type`=?", array($code, $field_k));
					if(!$service_row['is_pay']) $arr['not_pay'][] = $field_k;
				}
				if($service_k && $service_k==$field_k) $arr['wheres'][] = $field.">='".today."'";
				else if(!$service_k) $arr['wheres'][] = $field.">='".today."'";
				$arr['service_field'][$field_k] = $field;
			} }
			$count++;
		} }

		$arr['where'] = implode(" or ", $arr['wheres']);

		return $arr;
	}

	## : 기본 검색 ########################



	function employ() {
		global $is_admin, $cate_p_array, $cate_array, $nf_category;
		if($_SERVER['customized_get']) $get_var = $_SERVER['customized_get'];
		else $get_var = $_GET;

		$_where = "";
		$_date_arr = array();
		$_keyword = array();
		$service_arr = array();
		$wr_career_type = array();
		$career_arr = array();
		$wr_gender = array();
		$end_date_arr = array();

		$area_multi = array();
		$area_text_multi = array();
		$job_part_multi = array();
		$job_pay_multi = array();
		$subway_multi = array();

		$wr_time_arr = array();
		$wr_time_arr2 = array();
		$job_conditions_arr = array();
		$wr_target_arr = array();

		$tema_arr = array();

		$wr_job_type = array();
		$wr_area = array();
		$wr_subway = array();
		$job_welfare_arr = array();
		$wr_work_type_arr = array();

		if($get_var['wr_job_type'][0]) $wr_job_type = array_diff($get_var['wr_job_type'], array(""));
		if($get_var['wr_area'][0]) $wr_area = array_diff($get_var['wr_area'], array(""));
		if($get_var['wr_subway'][0]) $wr_subway = array_diff($get_var['wr_subway'], array(""));
		if(strlen($get_var['wr_career_type'][0])>0) $wr_career_type = $get_var['wr_career_type'];
		if($get_var['wr_volumes_no']==='0') array_push($wr_career_type, $get_var['wr_volumes_no']);
		if($get_var['wr_gender']) $wr_gender = $get_var['wr_gender'];
		if($get_var['wr_gender_no']==='0') array_push($wr_gender, $get_var['wr_gender_no']);

		if($get_var['area_multi'][0]) $area_multi = array_diff($get_var['area_multi'], array("", ',', ' ,'));
		if($get_var['area_text_multi'][0]) $area_text_multi = $get_var['area_text_multi'];

		if($get_var['job_part_multi'][0]) $job_part_multi = array_diff($get_var['job_part_multi'], array(""));
		if($get_var['job_pay_multi'][0]) $job_pay_multi = array_diff($get_var['job_pay_multi'], array(""));
		if($get_var['subway_multi'][0]) $subway_multi = array_diff($get_var['subway_multi'], array(""));

		if($get_var['job_conditions'][0]) $job_conditions_arr = array_diff($get_var['job_conditions'], array(""));
		if($get_var['job_welfare'][0]) $job_welfare_arr = array_diff($get_var['job_welfare'], array(""));
		if($get_var['wr_target'][0]) $wr_target_arr = array_diff($get_var['wr_target'], array(""));
		if($get_var['wr_work_type'][0]) $wr_work_type_arr = array_diff($get_var['wr_work_type'], array(""));

		if($get_var['tema'][0]) $tema_arr = array_diff($get_var['tema'], array(""));

		if(count($area_text_multi)>0) $_where .= " and (`wr_area` like '%,".strtr(implode(",%' or `wr_area` like '%,", $area_text_multi), array("+전체"=>"", ">"=>",", " 전체"=>"")).",%')";
		//if(count($area_multi)>0) $_where .= " and (`wr_area` like '%,".implode(",%' or `wr_area` like '%,", $area_multi).",%')";
		if(count($job_part_multi)>0) $_where .= " and (`wr_job_type` like '%,".implode(",%' or `wr_job_type` like '%,", $job_part_multi).",%')";
		if(count($subway_multi)>0) $_where .= " and (`wr_subway` like '%,".implode(",%' or `wr_subway` like '%,", $subway_multi).",%')";
		if(count($job_pay_multi)>0) {
			//$cate_p_array['job_pay']
			if(is_array($job_pay_multi)) { foreach($job_pay_multi as $k=>$v) {
				$v_arr = explode(",", $v);
				$get_pay_value_arr = explode("~", $cate_array['job_pay'][$v_arr[1]]);

				$job_pay_int = array();
				$job_pay_arr[$k] = "`wr_pay_type`='".$v_arr[0]."'";
				if($get_pay_value_arr[0]) $job_pay_int[] = "`wr_pay`>=".intval($get_pay_value_arr[0]);
				if($get_pay_value_arr[1]) $job_pay_int[] = "`wr_pay`<=".intval($get_pay_value_arr[1]);
				if($job_pay_int[0]) $job_pay_arr[$k] .= " and (".implode(" and ", $job_pay_int).")";
			} }
			$_where .= " and (".implode(" or ", $job_pay_arr).")";
		}

		// : 근무기간 - 단기, 장기
		if(strlen($get_var['wr_date_k'])>0) {
			if(is_array($cate_p_array['job_date'][0])) { foreach($cate_p_array['job_date'][0] as $k=>$v) {
				if($v['wr_'.intval($get_var['wr_date_k'])]) {
					$get_var['wr_date'][] = $v['no'];
				}
			} }
		}

		// : 직종
		if(count($wr_job_type)>0) $_where .= " and `wr_job_type` like binary '%,".implode(",", $wr_job_type).",%'";
		// : 지역
		if(count($wr_area)>0) {
			if($get_var['wr_area_home']) $wr_area_home = " and `wr_area` like '%,1,%'"; // : 재택 [ 지역에 1을 쓸 일이 없기 때문 ]
			$_where .= " and (`wr_area` like binary '%,".implode(",", $wr_area).",%' ".$wr_area_home.")";
		}
		// : 지하철
		if(count($wr_subway)>0) $_where .= " and `wr_subway` like binary '%,".implode(",", $wr_subway).",%'";

		// : 날짜
		$field = $get_var['rdate'] ? $get_var['rdate'] : 'wr_wdate';
		if($get_var['date1']) $_date_arr[] = "ne.`".$field."`>='".addslashes($get_var['date1'])." 00:00:00'";
		if($get_var['date2']) $_date_arr[] = "ne.`".$field."`<='".addslashes($get_var['date2'])." 23:59:59'";
		if($_date_arr[0]) $_where .= " and (".implode(" and ", $_date_arr).")";

		// : 서비스
		if(is_array($get_var['service'])) { foreach($get_var['service'] as $k=>$v) {
			$service_arr[] = "ne.`wr_service".$v."`>='".today."'";
		} }
		if($service_arr[0]) $_where .= " and (".implode(" or ", $service_arr).")";

		// : 경력
		if(strlen($wr_career_type[0])>0) {
			if(is_array($wr_career_type) && in_array('2', $wr_career_type) && $get_var['wr_career']) {
				$career_arr[] = "(`wr_career_type`='2' and `wr_career`>='".addslashes($get_var['wr_career'])."')";
				$wr_career_type = array_diff($wr_career_type, array('2'));
				sort($wr_career_type);
			}
			if(is_array($wr_career_type) && strlen($wr_career_type[0])>0) $career_arr[] = "`wr_career_type` in (".implode(",", $wr_career_type).")";
			if(is_array($career_arr) && $career_arr[0]) $_where .= " and (".implode(" or ", $career_arr).")";
		}
		if($get_var['wr_career_type__']) $_where .= " and `wr_career_type`=".intval($get_var['wr_career_type__']);

		// : 성별
		if(is_array($wr_gender) && strlen($wr_gender[0])>0) $_where .= " and `wr_gender` in (".implode(",", $wr_gender).")";

		// : 나이
		if($get_var['wr_age_limit']==='1') {
			$_where .= " and `wr_age_limit`='".addslashes($get_var['wr_age_limit'])."'";
			if($get_var['wr_age'][1]) $wr_age_arr[] = "`wr_age`>='".addslashes($get_var['wr_age'][1])."'";
			if($get_var['wr_age'][0]) $wr_age_arr[] = "`wr_age`<='".addslashes($get_var['wr_age'][0])."'";
			if($wr_age_arr[0]) $_where .= " and (".implode(" and ", $wr_age_arr).")";
		}

		// : 학력
		if($get_var['wr_ability_end']) $_where .= " and wr_ability_end=1";
		if(strlen($get_var['wr_ability'][0])>0) $_where .= " and `wr_ability` in (".implode(",", $get_var['wr_ability']).")";
		if($get_var['wr_ability__']) $_where .= " and `wr_ability`>=".intval($get_var['wr_ability__']);

		// : 마감일
		if($get_var['wr_end_date'] || strlen($get_var['volume_check'][0])>0) {
			if($get_var['wr_end_date']) $end_date_arr[] = "`wr_end_date`>='".today."'";
			if(strlen($get_var['volume_check'][0])>0) $end_date_arr[] = "`wr_end_date` in ('".implode("','", $get_var['volume_check'])."')";
			$_where .= " and (".implode(" or ", $end_date_arr).")";
		}

		if(strlen($get_var['wr_pay_conference'][0])>0) $_where .= " and `wr_pay_conference` in (".implode(",", $get_var['wr_pay_conference']).")"; // : 급여		
		if(is_array($get_var['wr_date'])) $_where .= " and `wr_date` in ('".implode("','", $get_var['wr_date'])."')"; // : 근무기간
		else if(strlen($get_var['wr_date'])>0) $_where .= " and `wr_date`='".addslashes($get_var['wr_date'])."'"; // : 근무기간
		if($get_var['wr_week']) $_where .= " and `wr_week`='".addslashes($get_var['wr_week'])."'"; // : 근무요일

		// : 근무시간
		if(strlen($get_var['wr_stime'][0])>0) $wr_time_arr[] = "`wr_stime`>='".addslashes($get_var['wr_stime'][0].':'.$get_var['wr_etime'][0])."'";
		if(strlen($get_var['wr_etime'][0])>0) $wr_time_arr[] = "`wr_etime`<='".addslashes($get_var['wr_stime'][1].':'.$get_var['wr_etime'][1])."'";
		if($wr_time_arr[0] || $get_var['wr_time_conference']) {
			if($wr_time_arr[0]) $wr_time_arr2[] = implode(" and ", $wr_time_arr);
			if($get_var['wr_time_conference']) $wr_time_arr2[] = "wr_time_conference=1";
			$_where .= " and (".implode(" or ", $wr_time_arr2).")"; // : 근무요일
		}

		// : 접수방법
		if(strlen($get_var['wr_requisition'][0])>0) $_where .= " and (INSTR(`wr_requisition`,'".implode("')>0 or INSTR(`wr_requisition`,'", $get_var['wr_requisition'])."')>0)";

		// : 우대조건
		if(strlen($job_conditions_arr[0])>0) $_where .= " and (find_in_set('".implode("', `wr_preferential`) or find_in_set('", $job_conditions_arr)."', `wr_preferential`))";

		// : 복리후생
		if(strlen($job_welfare_arr[0])>0) $_where .= " and (find_in_set('".implode("', `wr_welfare`) or find_in_set('", $job_welfare_arr)."', `wr_welfare`))";

		// : 대상별
		if(strlen($wr_target_arr[0])>0) $_where .= " and (find_in_set('".implode("', `wr_target`) or find_in_set('", $wr_target_arr)."', `wr_target`))";

		// : 근무형태
		if(strlen($wr_work_type_arr[0])>0) $_where .= " and (find_in_set('".implode("', `wr_work_type`) or find_in_set('", $wr_work_type_arr)."', `wr_work_type`))";

		// : 등록일
		if($get_var['regist_date']) $_where .= $get_var['regist_date']=='today' ? " and `wr_wdate`>='".today." 00:00:00'" : " and `wr_wdate`>='".date("Y-m-d", strtotime("-".$get_var['regist_date']))."'";

		// : 업소회원주키
		if($get_var['cno']) $_where .= " and ne.`cno`=".intval($get_var['cno']);

		// : 회원주키 [ 관리자만 가능 ]
		if($get_var['mno'] && admin_id) $_where .= " and ne.`mno`=".intval($get_var['mno']);

		// : 테마
		if(count($tema_arr)>0) $_where .= " and find_in_set('".implode("', `wr_keyword`) or find_in_set('", $tema_arr)."', `wr_keyword`)";


		// : 통합검색
		$_keyword['wr_company_name'] = "ne.`wr_company_name` like '%".addslashes($get_var['search_keyword'])."%'";
		$_keyword['wr_name'] = "ne.`wr_name` like '%".addslashes($get_var['search_keyword'])."%'";
		$_keyword['wr_nickname'] = "ne.`wr_nickname` like '%".addslashes($get_var['search_keyword'])."%'";
		$_keyword['wr_email'] = "ne.`wr_email` like '%".addslashes($get_var['search_keyword'])."%'";
		$_keyword['wr_hphone'] = "replace(ne.`wr_hphone`,'-','') like '%".addslashes(strtr($get_var['search_keyword'], array('-'=>'')))."%'";
		$_keyword['wr_phone'] = "replace(ne.`wr_phone`,'-','') like '%".addslashes(strtr($get_var['search_keyword'], array('-'=>'')))."%'";
		$_keyword['wr_id'] = "ne.`wr_id` like '%".addslashes($get_var['search_keyword'])."%'";
		$_keyword['wr_subject'] = "ne.`wr_subject` like '%".addslashes($get_var['search_keyword'])."%'";
		$_keyword['wr_keyword'] = "find_in_set('".addslashes($get_var['search_keyword'])."', ne.`wr_keyword`)";
		if($get_var['search_keyword']) {
			if(array_key_exists($get_var['search_field'], $_keyword)) $_where .= " and ".$_keyword[$get_var['search_field']];
			else $_where .= " and (".implode(" or ", $_keyword).")";
		}

		$arr['where'] = $_where;

		return $arr;
	}

	function resume() {
		global $cate_p_array;

		if($_SERVER['customized_get']) $get_var = $_SERVER['customized_get'];
		else $get_var = $_GET;

		$use_member_individual = false; // : 개인회원의 이력서 회원정보 부르면 해당 테이블 join해야함.
		$use_member = false; // : 회원테이블, 이력서 테이블 join

		$_date_arr = array();
		$service_arr = array();
		$wr_career_type = array();

		$area_multi = array();
		$area_text_multi = array();
		$job_part_multi = array();

		$wr_age_arr = array();

		$wr_job_type = array();
		$wr_area = array();
		$wr_work_type_arr = array();
		$wr_career_type2_arr = array();
		$wr_career_type2_part_arr = array();

		if($get_var['wr_job_type'][0]) $wr_job_type = array_diff($get_var['wr_job_type'], array(""));
		if($get_var['wr_area'][0]) $wr_area = array_diff($get_var['wr_area'], array(""));

		if($get_var['area_multi'][0]) $area_multi = array_diff($get_var['area_multi'], array(""));
		if($get_var['area_text_multi'][0]) $area_text_multi = $get_var['area_text_multi'];

		if($get_var['job_part_multi'][0]) $job_part_multi = array_diff($get_var['job_part_multi'], array(""));

		if($get_var['wr_work_type'][0]) $wr_work_type_arr = array_diff($get_var['wr_work_type'], array(""));
		if($get_var['wr_career_type2']) $wr_career_type2_arr = explode("~", $get_var['wr_career_type2']);

		// : 근무기간 - 단기, 장기
		if(strlen($get_var['wr_date_k'])>0) {
			if(is_array($cate_p_array['job_date'][0])) { foreach($cate_p_array['job_date'][0] as $k=>$v) {
				if($v['wr_'.intval($get_var['wr_date_k'])]) {
					$get_var['wr_date'][] = $v['no'];
				}
			} }
		}

		// : 직종
		if(count($wr_job_type)>0) $_where .= " and `wr_job_type` like binary '%,".implode(",", $wr_job_type).",%'";

		// : 지역
		if(count($wr_area)>0) {
			if($wr_area[1]=='all') unset($wr_area[1]);
			if($wr_area[2]=='all') unset($wr_area[2]);
			$_where .= " and `wr_area` like binary '%,".implode(",", $wr_area).",%'";
		}

		if(count($area_text_multi)>0) $_where .= " and (`wr_area` like '%,".strtr(implode(",%' or `wr_area` like '%,", $area_text_multi), array(" 전체"=>"", "+전체"=>"", ">"=>",")).",%')";
		//if(count($area_multi)>0) $_where .= " and (`wr_area` like '%,".implode(",%' or `wr_area` like '%,", $area_multi).",%')";
		if(count($job_part_multi)>0) $_where .= " and (`wr_job_type` like '%,".implode(",%' or `wr_job_type` like '%,", $job_part_multi).",%')";

		if($get_var['wr_home_work']) $_where .= " and `wr_home_work`=1";

		// : 날짜
		$field = $get_var['rdate'] ? $get_var['rdate'] : 'wr_wdate';
		if($get_var['date1']) $_date_arr[] = "nr.`".$field."`>='".addslashes($get_var['date1'])." 00:00:00'";
		if($get_var['date2']) $_date_arr[] = "nr.`".$field."`<='".addslashes($get_var['date2'])." 23:59:59'";
		if($_date_arr[0]) $_where .= " and (".implode(" and ", $_date_arr).")";

		// : 회원주키 [ 관리자만 가능 ]
		if($get_var['mno'] && admin_id) $_where .= " and nr.`mno`=".intval($get_var['mno']);

		// : 서비스
		if(is_array($get_var['service'])) { foreach($get_var['service'] as $k=>$v) {
			$service_arr[] = "nr.`wr_service".$v."`>='".today."'";
		} }
		if($service_arr[0]) $_where .= " and (".implode(" or ", $service_arr).")";

		// : 경력
		if($get_var['wr_career_type'][0]) {
			if($get_var['wr_career_type'][0]==='1') $_where .= " and nr.`wr_career`<=0";
			else {
				$_where .= " and nr.`wr_career_use`=1";
				if($get_var['wr_career']) {
					if(strpos($get_var['wr_career'], 'down')) {
						$_where .= " and nr.`wr_career`<=".intval($get_var['wr_career']);
					} else {
						$_where .= " and nr.`wr_career`>=".intval($get_var['wr_career']);
					}
				}
			}
		}

		if(count($wr_career_type2_arr)>0) {
			if($wr_career_type2_arr[0]) $wr_career_type2_part_arr[] = "nr.`wr_career`>=".intval($wr_career_type2_arr[0]*12);
			if($wr_career_type2_arr[1]) $wr_career_type2_part_arr[] = "nr.`wr_career`<=".intval($wr_career_type2_arr[1]*12);
			if($wr_career_type2_part_arr[0]) $_where .= " and (".implode(" and ", $wr_career_type2_part_arr).")";
		}

		// : 성별
		if(strlen($wr_gender[0])>0) $_where .= " and `wr_gender` in (".implode(",", $wr_gender).")";

		// : 최종학력
		if($get_var['wr_school_ability_end']) $_where .= " and wr_school_ability_end=1";
		if(is_array($get_var['wr_school_ability'])) {
			$_where .= " and nr.`wr_school_ability` in ('".implode("','", $get_var['wr_school_ability'])."')";
		} else if(strlen($get_var['wr_school_ability'])>0) {
			$_where .= " and nr.`wr_school_ability`='".addslashes($get_var['wr_school_ability'])."'";
		}

		// : 근무기간
		if(is_array($get_var['wr_date'])) $_where .= " and `wr_date` in ('".implode("','", $get_var['wr_date'])."')"; // : 근무기간
		else if(strlen($get_var['wr_date'])>0) $_where .= " and `wr_date`='".addslashes($get_var['wr_date'])."'"; // : 근무기간

		// : 근무요일
		if($get_var['wr_week']) $_where .= " and `wr_week`='".addslashes($get_var['wr_week'])."'";

		// : 근무시간
		if($get_var['wr_time']) $_where .= " and `wr_time`='".addslashes($get_var['wr_time'])."'";

		// : 즉시출근
		if($get_var['wr_work_direct']) $_where .= " and `wr_work_direct`=".intval($get_var['wr_work_direct']);

		// : 급여
		if($get_var['wr_pay_type']) $_where .= " and `wr_pay_type`='".addslashes($get_var['wr_pay_type'])."'";
		if($get_var['wr_pay']) {
			$wr_pay_up = $get_var['wr_pay_up']==='1' ? '>=' : '<=';
			$_where .= " and `wr_pay`".$wr_pay_up."".intval(strtr($get_var['wr_pay'], array(','=>'')));
		}


		if($get_var['wr_pay_conference']) $_where .= " and `wr_pay_conference`=".intval($get_var['wr_pay_conference']);

		// : 성별
		if(strlen($get_var['wr_gender'][0])>0) $_where .= " and `mb_gender`=".intval($get_var['wr_gender'][0]);

		// : 나이
		if(strlen($get_var['wr_age_limit'])<=0) $get_var['wr_age_limit'] = '0'; // : 맞춤구인정보(연령제한있음) 검색같은경우 나이검색 사용여부개념이므로 상세검색에는 무조건 0을 부여해줍니다.
		if($get_var['wr_age_limit']==='0') {
			if(is_array($get_var['wr_age']) && $get_var['wr_age'][1]) $wr_age_arr[] = "`mb_birth`>='".$this->get_birth($get_var['wr_age'][1])."-01-01'";
			if(is_array($get_var['wr_age']) && $get_var['wr_age'][0]) $wr_age_arr[] = "`mb_birth`<='".$this->get_birth($get_var['wr_age'][0])."-12-31'";
			if($wr_age_arr[0]) $_where .= " and (".implode(" and ", $wr_age_arr).")";
		}

		// : 근무형태
		if(strlen($wr_work_type_arr[0])>0) $_where .= " and (find_in_set('".implode("', `wr_work_type`) or find_in_set('", $wr_work_type_arr)."', `wr_work_type`))";

		// : 등록일
		if($get_var['regist_date']) $_where .= $get_var['regist_date']=='today' ? " and `wr_wdate`='".today."'" : " and `wr_wdate`>='".date("Y-m-d", strtotime("-".$get_var['regist_date']))."'";

		// : 통합검색
		if($get_var['search_keyword']) {
			$_keyword['mb_name'] = "nm.`mb_name` like '%".addslashes($get_var['search_keyword'])."%'";
			$_keyword['mb_id'] = "nm.`mb_id` like '%".addslashes($get_var['search_keyword'])."%'";
			$_keyword['wr_subject'] = "nr.`wr_subject` like '%".addslashes($get_var['search_keyword'])."%'";
		
			$use_member = true;
			if(array_key_exists($get_var['search_field'], $_keyword)) $_where .= " and ".$_keyword[$get_var['search_field']];
			else $_where .= " and (".implode(" or ", $_keyword).")";
		}

		$arr['where'] = $_where;

		if($use_member_individual) $arr['table'] = "nf_member_individual as nmi right join nf_resume as nr on nmi.`mno`=nr.`mno`";
		if($use_member) $arr['table'] = "nf_member as nm right join nf_resume as nr on nm.`no`=nr.`mno`";
		else $arr['table'] = "nf_resume as nr";

		return $arr;
	}
}
?>