<?php
if (!isset($_include))
	$_include = "";
if (!isset($_POST['mode']))
	$_POST['mode'] = "";
if (!isset($_GET['mode']))
	$_GET['mode'] = "";
if (in_array($_POST['mode'], array('check_nick', 'member_write', 'delete_member', 'delete_select_member')))
	$not_mb_type_check = true;
if (in_array($_GET['mode'], array('logout')))
	$not_mb_type_check = true;

if (!$_include) {
	if (in_array($_POST['mode'], array('put_skin_content')))
		$add_cate_arr = array('job_target', 'job_document', 'job_conditions', 'job_grade', 'job_grade', 'job_position');
	if ($_POST['mode'] == 'btn_category')
		$add_cate_arr = array('subway', 'job_pay');
	if (in_array($_POST['mode'], array('load_manager')))
		$add_cate_arr = array('email');

	if (in_array($_POST['mode'], array('get_map_employ')))
		$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions', 'job_employ_report_reason');

	include "../engine/_core.php";
}

// : 결제 pay_oid값으로 결제인지 아닌지 판단하기 - 결제할때 post값이 추가정보를 못받는 경우가 있어서 이렇게 했음.
if ($_POST['param_opt_2']) {
	$_POST['mode'] = $_POST['param_opt_1'];
	$_POST['pno'] = $_POST['param_opt_2'];
}

// : toss결제시
if ($_GET['paymentKey'] && $_GET['orderId'] && $_GET['amount']) {
	$_POST['mode'] = "payment_process";
	$oid_arr = explode("_", $_GET['orderId']);
	$_POST['orderId'] = $_GET['orderId'];
	$_POST['amount'] = $_GET['amount'];
}

switch ($_POST['mode']) {

	## : 구인구직정보 ############################################
	case "company_select_interest":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			$nos = implode(", ", $_POST['chk']);
			$arr['msg'] = "업소정보를 선택해주시기 바랍니다.";
			if ($nos) {
				$query = $db->_query("select * from nf_member_company where `no` in (" . $nos . ")");
				while ($row = $db->afetch($query)) {
					$interest_row = $db->query_fetch("select * from nf_interest where `mno`=? and `exmno`=? and `code`=?", array($member['no'], $row['no'], 'company'));
					if ($interest_row)
						continue;

					$_val = array();
					$_val['code'] = 'company';
					$_val['exmno'] = $row['no'];
					$_val['mno'] = intval($member['no']);
					$_val['mb_id'] = $member['mb_id'];
					$_val['pmno'] = intval($row['mno']);
					$_val['pmb_id'] = $row['mb_id'];
					$_val['rdate'] = today_time;
					$q = $db->query_q($_val);
					$insert = $db->_query("insert into nf_interest set " . $q, $_val);
				}
				$arr['msg'] = "관심업소으로 등록했습니다.";
				$arr['move'] = $nf_util->page_back();
			}
		}
		die(json_encode($arr));
		break;

	case "search_company_info":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";

			$_val = array();
			$_val['mb_company_name'] = $_POST['mb_company_name'];
			if ($_POST['mb_biz_type'])
				$_val['mb_biz_type'] = $_POST['mb_biz_type'];
			$q = $db->query_q($_val, " and ");
			$query = $db->_query("select * from nf_member_company where " . $q . " order by `no` desc", $_val);
			$nums = $db->num_rows($query);

			ob_start();
			while ($row = $db->afetch($query)) {
				$employ_cnt = $db->query_fetch("select count(*) as c from nf_employ as ne where `mno`=? and `cno`=?" . $_em_where . $nf_job->employ_where, array($row['mno'], $row['no']));
				?>
				<tr>
					<td><input type="checkbox" name="chk[]" class="chk_" value="<?php echo $row['no']; ?>"></td>
					<td><?php echo $nf_util->get_text($row['mb_company_name']); ?></td>
					<td><?php echo $nf_util->get_text($row['mb_biz_type']); ?></td>
					<td><a href="<?php echo NFE_URL; ?>/employ/list_type.php?cno=<?php echo $row['no']; ?>" class="blue"
							target="_blank"><?php echo number_format(intval($employ_cnt['c'])); ?></a> 건</td>
				</tr>
				<?php
			}
			$arr['tag'] = ob_get_clean();
			if ($nums <= 0)
				$arr['tag'] = '<tr><td colspan="4" align="center">검색된 업소정보가 없습니다.</td></tr>';

			$arr['js'] = '
			$("#company_list_tbody-").html(data.tag);
			';
		}

		die(json_encode($arr));
		break;

	// : 내사진 지우기
	case "delete_my_photo":
		$mno = $member['no'];
		if ($_POST['no'])
			$mno = $_POST['no'];
		$_where = "";
		if (!$is_admin)
			$_where = " and `no`=" . intval($member['no']);
		$get_member = $db->query_fetch("select * from nf_member where `no`=" . intval($mno) . $_where);
		$nf_member->get_member($get_member['no']);
		$is_photo = $nf_member->member_arr[$get_member['no']]['is_photo'];
		$photo_src = $nf_member->member_arr[$get_member['no']]['photo_src'];

		$arr['msg'] = '삭제할 사진이 없습니다.';
		if ($is_photo) {
			unlink(NFE_PATH . $photo_src);
			$arr['msg'] = '사진삭제가 완료되었습니다.';
		}
		$arr['move'] = $nf_util->page_back();
		die(json_encode($arr));
		break;


	// : 내사진 지우기
	case "delete_my_logo":
		$no = $member_ex['no'];
		if ($_POST['no'])
			$no = $_POST['no'];
		$_where = "";
		if (!$is_admin)
			$_where = " and `mno`=" . intval($member['no']);
		$get_member_ex = $db->query_fetch("select * from nf_member_company where `no`=" . intval($no) . $_where);
		$get_member_ex = $nf_member->get_member_ex_info($get_member_ex);
		$is_photo = $get_member_ex['is_mb_logo'];
		$photo_src = $get_member_ex['mb_logo_src'];

		$arr['msg'] = '삭제할 사진이 없습니다.';
		if ($is_photo) {
			unlink(NFE_PATH . $photo_src);
			$arr['msg'] = '사진삭제가 완료되었습니다.';
		}
		$arr['move'] = $nf_util->page_back();
		die(json_encode($arr));
		break;

	// : 내사진 지우기
	case "delete_my_img1":
		$no = $member_ex['no'];
		if ($_POST['no'])
			$no = $_POST['no'];
		$_where = "";
		if (!$is_admin)
			$_where = " and `mno`=" . intval($member['no']);
		$get_member_ex = $db->query_fetch("select * from nf_member_company where `no`=" . intval($no) . $_where);
		$get_member_ex = $nf_member->get_member_ex_info($get_member_ex);
		$is_photo = $get_member_ex['is_mb_img1'];
		$photo_src = $get_member_ex['mb_img1_src'];

		$arr['msg'] = '삭제할 사진이 없습니다.';
		if ($is_photo) {
			unlink(NFE_PATH . $photo_src);
			$arr['msg'] = '사진삭제가 완료되었습니다.';
		}
		$arr['move'] = $nf_util->page_back();
		die(json_encode($arr));
		break;
	// : 내사진 지우기
	case "delete_my_img2":
		$no = $member_ex['no'];
		if ($_POST['no'])
			$no = $_POST['no'];
		$_where = "";
		if (!$is_admin)
			$_where = " and `mno`=" . intval($member['no']);
		$get_member_ex = $db->query_fetch("select * from nf_member_company where `no`=" . intval($no) . $_where);
		$get_member_ex = $nf_member->get_member_ex_info($get_member_ex);
		$is_photo = $get_member_ex['is_mb_img2'];
		$photo_src = $get_member_ex['mb_img2_src'];

		$arr['msg'] = '삭제할 사진이 없습니다.';
		if ($is_photo) {
			unlink(NFE_PATH . $photo_src);
			$arr['msg'] = '사진삭제가 완료되었습니다.';
		}
		$arr['move'] = $nf_util->page_back();
		die(json_encode($arr));
		break;
	// : 내사진 지우기
	case "delete_my_img3":
		$no = $member_ex['no'];
		if ($_POST['no'])
			$no = $_POST['no'];
		$_where = "";
		if (!$is_admin)
			$_where = " and `mno`=" . intval($member['no']);
		$get_member_ex = $db->query_fetch("select * from nf_member_company where `no`=" . intval($no) . $_where);
		$get_member_ex = $nf_member->get_member_ex_info($get_member_ex);
		$is_photo = $get_member_ex['is_mb_img3'];
		$photo_src = $get_member_ex['mb_img3_src'];

		$arr['msg'] = '삭제할 사진이 없습니다.';
		if ($is_photo) {
			unlink(NFE_PATH . $photo_src);
			$arr['msg'] = '사진삭제가 완료되었습니다.';
		}
		$arr['move'] = $nf_util->page_back();
		die(json_encode($arr));
		break;
	// : 내사진 지우기
	case "delete_my_img4":
		$no = $member_ex['no'];
		if ($_POST['no'])
			$no = $_POST['no'];
		$_where = "";
		if (!$is_admin)
			$_where = " and `mno`=" . intval($member['no']);
		$get_member_ex = $db->query_fetch("select * from nf_member_company where `no`=" . intval($no) . $_where);
		$get_member_ex = $nf_member->get_member_ex_info($get_member_ex);
		$is_photo = $get_member_ex['is_mb_img4'];
		$photo_src = $get_member_ex['mb_img4_src'];

		$arr['msg'] = '삭제할 사진이 없습니다.';
		if ($is_photo) {
			unlink(NFE_PATH . $photo_src);
			$arr['msg'] = '사진삭제가 완료되었습니다.';
		}
		$arr['move'] = $nf_util->page_back();
		die(json_encode($arr));
		break;

	// : 내사진 지우기
	case "delete_my_biz_attach":
		$no = $member_ex['no'];
		if ($_POST['no'])
			$no = $_POST['no'];
		$_where = "";
		if (!$is_admin)
			$_where = " and `mno`=" . intval($member['no']);
		$get_member_ex = $db->query_fetch("select * from nf_member_company where `no`=" . intval($no) . $_where);
		$get_member_ex = $nf_member->get_member_ex_info($get_member_ex);
		$is_photo = $get_member_ex['is_biz_attach'];
		$photo_src = $get_member_ex['biz_attach_src'];

		$arr['msg'] = '삭제할 사업자등록증이 없습니다.';
		if ($is_photo) {
			unlink(NFE_PATH . $photo_src);
			$arr['msg'] = '사업자등록증이 삭제 완료되었습니다.';
		}
		$arr['move'] = $nf_util->page_back();
		die(json_encode($arr));
		break;


	case "read_pay_use":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			if (!$nf_job->service_info[$_POST['code']]['read']['use']) {
				$arr['move'] = $nf_util->page_back();
			} else {
				$info_table = "nf_" . $code;
				$mno = $member['no'];
				$pno = $_POST['no'];
				$code = $_POST['code'];
				$allow_arr = $nf_job->read_allow($mno, $pno, $code);
				$allow_read = $allow_arr['allow'];
				$get_member = $allow_arr['member'];
				$get_member_ex = $allow_arr['member_ex'];
				$get_member_se = $allow_arr['member_se'];
				$read_row = $allow_arr['read_row'];

				if ($get_member_se['no']) {
					// : 한번도 결제로 읽지 않거나 열람기간이 없는경우 차감해서 읽게 함.
					$read_int_field = 'mb_' . $code . '_read_int';
					if (!$allow_read && $get_member_se[$read_int_field] > 0) {
						$minus = $db->_query("update nf_member_service set `" . $read_int_field . "`=`" . $read_int_field . "`-1 where `mno`=" . intval($get_member['no']));
						if ($minus) {
							include_once NFE_PATH . '/engine/function/read_insert.function.php';
							$minus_read_int = true;
							read_insert($mno, $code, $pno, array('_val_pay_read' => true));
							$arr['move'] = $nf_util->page_back();
						}
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	case "jump_process":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "건수가 없습니다.";
			$arr['move'] = "";
			if ($member_service['mb_' . $_POST['code'] . '_jump_int'] > 0) {
				$arr['msg'] = "정상적인 방식으로 이용해주시기 바랍니다.";
				if (array_key_exists($_POST['code'], $nf_job->kind_of)) {
					$arr['msg'] = "삭제된 " . $nf_job->kind_of[$_POST['code']] . "정보입니다.";
					$info_row = $db->query_fetch("select * from nf_" . $_POST['code'] . " where `no`=? and `mno`=?", array($_POST['no'], $member['no']));
					switch ($_POST['code']) {
						case 'employ':
							$max_row = $db->query_fetch("select * from nf_" . $_POST['code'] . " as ne where 1 order by `wr_jdate` desc limit 1");
							break;

						case 'resume':
							$max_row = $db->query_fetch("select * from nf_" . $_POST['code'] . " as nr where 1 order by `wr_jdate` desc limit 1");
							break;
					}
					if ($max_row['no'] == $_POST['no'])
						$arr['msg'] = "이미 최상단에 노출되고 있습니다.";
					else {
						if ($info_row) {
							$jump_field = "mb_" . $_POST['code'] . "_jump_int";
							$update = $db->_query("update nf_" . $_POST['code'] . " set `wr_jdate`=? where `no`=?", array(today_time, $_POST['no']));
							if ($update) {
								$update = $db->_query("update nf_member_service set `" . $jump_field . "`=`" . $jump_field . "`-1 where `mno`=?", array($member['no']));
								$nums = $db->num_rows($update);

								$_arr['mno'] = $member['no'];
								$_arr['wr_id'] = $member['mb_id'];
								$_arr['c'] = 1;
								$_arr['nos'] = $_POST['no'];
								$_arr['action'] = 'click';
								job_jump_insert($_POST['code'], $_arr);
								$arr['js'] = '
								$(".' . $_POST['code'] . '_jump_int-").html("' . number_format(intval($member_service[$jump_field]) - intval($nums)) . '");
								';
							}
							$arr['msg'] = $nf_job->kind_of[$_POST['code']] . "정보를 점프했습니다.";
						}
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	case "delete_employ_attach":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "권한이 없습니다.";
			$arr['move'] = "/";
			$em_row = $db->query_fetch("select * from nf_employ where `no`=? and `mno`=?", array($_POST['no'], $member['no']));
			if ($em_row) {
				$arr['msg'] = "이미 삭제된 파일입니다.";
				$arr['move'] = "";
				$arr['js'] = '
				$(".form_attach_delete-").css({"display":"none"});
				';
				if (NFE_PATH . '/data/employ/' . $em_row['wr_form_attach']) {
					if (unlink(NFE_PATH . '/data/employ/' . $em_row['wr_form_attach'])) {
						$update = $db->_query("update nf_employ set `wr_form_attach`='', `wr_form_attach_name`='' where `no`=?", array($em_row['no']));
						$arr['msg'] = "파일삭제가 완료되었습니다.";
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	case "get_map_employ":
		$_data = $_POST;
		$_data['alias'] = 'ne.';
		$_data['field_lat'] = 'wr_lat0';
		$_data['field_lng'] = 'wr_lng0';
		$distance_field = $nf_util->distance_q($_data);
		$_data['type'] = 'where';
		$_data['distance'] = $nf_util->distance_int($_POST['width'], $_POST['zoom']) / 2;
		$distance_w = $nf_util->distance_q($_data);

		$where_arr = $nf_search->employ();
		$service_where = $nf_search->service_where('employ');
		$_where = $where_arr['where'];
		$where_basic = "(" . $service_where['where'] . ")" . $nf_job->employ_where;

		$arr = array();
		$arr['service_k'] = '1_list';
		//$arr['where'] = $where_basic.$employ_where['where'];
		if ($env['map_engine'] != 'google')
			$arr['where'] .= $distance_w;
		$arr['order'] = " order by map_distance asc";
		$arr['page'] = $_POST['page'];
		$arr['limit'] = 4;

		$start = ($_POST['page'] > 0) ? $nf_util->start_page($_POST['page'], $arr) : 0;
		if (!$arr['field_set'])
			$arr['field_set'] = '*';
		$q = "nf_employ as ne where 1 " . $arr['where'] . $nf_job->employ_where . $_em_where;
		$q_all = "select *, " . $distance_field . $_field . " from " . $q . $arr['order'];
		//echo $q_all.' <=== <br>';
		$query = $db->_query($q_all);
		$arr['q_all'] = $q_all;

		$total = $db->query_fetch("select count(*) as c from " . $q);

		$_arr = array();
		$_arr['tema'] = 'B';
		$_arr['num'] = $arr['limit'];
		$_arr['total'] = $total['c'];
		$_arr['click'] = 'js';
		$_arr['code'] = 'map';
		$_arr['page'] = $_POST['page'];
		$_arr['group'] = 5;
		$paging = $nf_util->_paging_($_arr);

		ob_start();
		$count = 0;
		while ($em_row = $db->afetch($query)) {
			$em_info = $nf_job->employ_info($em_row);
			ob_start();
			include NFE_PATH . '/include/job/employ.map.php';
			$_content = ob_get_clean();
			$arr['positions'][] = array('lat' => $em_row['wr_lat0'], 'lng' => $em_row['wr_lng0'], 'content' => $_content);

			if ($count >= $start && $count < ($start + $arr['limit'])) {
				include NFE_PATH . '/include/job/employ_map.box.php';
			}
			$count++;
		}
		$arr['tag_list'] = ob_get_clean();
		if (!$arr['tag_list'])
			$arr['tag_list'] = '<p class="no_s_employ">주변에 검색된 구인정보가 없습니다.</p>';
		$arr['paging'] = $paging['paging'];

		$arr['js'] = '
		$(".map-list-").html(data.tag_list);
		$(".map-list-paging-").html(data.paging);
		nf_map.ajax_clusterer(data);
		';

		die(json_encode($arr));
		break;

	case "proof_email_send":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			if ($member['mb_type'] != 'individual') {
				$arr['msg'] = "개인회원만 이용 가능합니다.";
				$arr['move'] = "/";
			} else {
				if (count($_POST['chk']) > 0)
					$nos = implode(",", $_POST['chk']);
				if ($nos) {
					$query = $db->_query("select * from nf_employ as ne right join nf_accept as na on ne.`no`=na.`pno` where na.`code`='employ' and na.`del`=0 and na.`no` in (" . $nos . ") and na.`mno`=? group by ne.`cno`", array($member['no']));

					$_GET = $_POST;
					ob_start();
					$btn_none = true;
					include NFE_PATH . '/include/job/proof_resume.inc.php';
					$_arr['content'] = ob_get_clean();

					$_arr['subject'] = $member['mb_name'] . "님 " . today . " 취업활동 증명서입니다.";
					$_arr['email'] = $member['mb_email'];
					$email = $nf_email->send_mail($_arr);
					if ($email) {
						$arr['msg'] = "취업활동증명서를 메일로 발송했습니다.";
						$code = $_POST['code'] == 'print' ? 'print' : 'email';
						$cnt_row = $db->query_fetch("select * from nf_proof where `sdate`=? and `code`=?", array(today, $code));
						$_val = array();
						$_val['cnt'] = $cnt_row['cnt'] + 1;
						$_val['code'] = $code;
						$_val['sdate'] = today;
						$q = $db->query_q($_val);
						if ($cnt_row)
							$db->_query("update nf_proof set " . $q . " where `no`=" . intval($cnt_row['no']), $_val);
						else
							$db->_query("insert into nf_proof set " . $q, $_val);

						if ($code == 'print') {
							$arr['js'] = '
							window.print();
							';
						}
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	case "rep_company":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$get_company = $db->query_fetch("select * from nf_member_company where `mno`=? and `no`=?", array($member['no'], $_POST['no']));
			if (!$get_company) {
				$arr['msg'] = "본인의 대표업소으로 선택하셔야합니다.";
			} else {
				$update = $db->_query("update nf_member_company set `is_public`=0 where `mno`=?", array($member['no']));
				$update = $db->_query("update nf_member_company set `is_public`=1 where `no`=?", array($get_company['no']));
				$arr['msg'] = "대표업소으로 설정이 완료되었습니다.";
				$arr['move'] = $nf_util->page_back();
			}
		}
		die(json_encode($arr));
		break;

	case "load_manager":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			$manager_row = $db->query_fetch("select * from nf_manager where `no`=? and `mno`=?", array($_POST['no'], $member['no']));
			if ($manager_row) {
				$email_arr = explode("@", $manager_row['wr_email']);
				$phone_arr = explode("-", $manager_row['wr_phone']);
				$hphone_arr = explode("-", $manager_row['wr_hphone']);
				//$fax_arr = explode("-", $manager_row['wr_fax']);
			}
			if ($_POST['no'] && !$manager_row) {
				$arr['msg'] = "삭제된 담당자정보입니다.";
				$arr['move'] = $nf_util->page_back();
			} else {
				ob_start();
				$cno_no = $manager_row['cno'];
				include NFE_PATH . '/include/job/manager.inc.php';
				$arr['tag'] = ob_get_clean();

				$arr['js'] = '
				$(".manager_box-").html(data.tag);
				nf_util.openWin(".manager-");
				';
			}
		}
		die(json_encode($arr));
		break;

	case "manager_write":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {

			$manager_row = $db->query_fetch("select * from nf_manager where `no`=? and `mno`=?", array($_POST['no'], $member['no']));

			$_val = array();
			$_val['mno'] = $member['no'];
			$_val['cno'] = $_POST['cno'];
			$_val['wr_id'] = $member['mb_id'];
			$_val['wr_name'] = $_POST['name'];
			//$_val['wr_nickname'] = $_POST['wr_nickname'];
			$_val['wr_phone'] = $_POST['phone'];
			$_val['wr_hphone'] = $_POST['hphone'];
			if ($_POST['email'][0])
				$_val['wr_email'] = implode("@", $_POST['email']);
			$_val['wr_wdate'] = today_time;
			$q = $db->query_q($_val);

			if ($manager_row)
				$query = $db->_query("update nf_manager set " . $q . " where `no`=" . intval($manager_row['no']), $_val);
			else
				$query = $db->_query("insert into nf_manager set " . $q, $_val);

			$arr['msg'] = ($manager_row ? '수정' : '등록') . "이 완료되었습니다.";
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	case "report_write":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			$member_sel_kind = array("employ" => "individual", "resume" => "company");
			if ($member_sel_kind[$_POST['page_code']] != $member['mb_type']) {
				$arr['msg'] = $nf_member->mb_type[$member_sel_kind[$_POST['page_code']]] . "회원만 신고가능합니다.";
			} else {
				$report_row = $db->query_fetch("select * from nf_report where `pno`=? and `code`=? and `mno`=?", array($_POST['pno'], $_POST['page_code'], $member['no']));
				$info_row = $db->query_fetch("select * from nf_" . $_POST['page_code'] . " where `no`=" . intval($_POST['pno']));
				if (!$info_row)
					$arr['msg'] = "삭제된 " . $nf_job->kind_of[$_POST['page_code']] . "정보입니다.";
				if ($report_row)
					$arr['msg'] = "이미 신고한 " . $nf_job->kind_of[$_POST['page_code']] . "정보입니다.";
				if (!$arr['msg']) {
					$get_member = $db->query_fetch("select * from nf_member where `no`=?", array($info_row['mno']));
					$_val = array();
					$_val['code'] = $_POST['page_code'];
					$_val['pno'] = $_POST['pno'];
					$_val['sel_no'] = $_POST['select'];
					$_val['mno'] = $member['no'];
					$_val['mb_id'] = $member['mb_id'];
					$_val['mb_name'] = $member['mb_name'];
					$_val['pmno'] = $get_member['no'];
					$_val['pmb_id'] = $get_member['mb_id'];
					$_val['pmb_name'] = $get_member['mb_name'];
					$_val['sdate'] = today_time;
					$q = $db->query_q($_val);
					$query = $db->_query("insert into nf_report set " . $q, $_val);
					$arr['msg'] = "신고했습니다.";
				}
			}
			$arr['js'] = '
			nf_util.openWin(".report-", "none");
			';
		}
		die(json_encode($arr));
		break;

	case "get_accept_view":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$mno_field = $member['mb_type'] == 'company' ? 'mno' : 'pmno';
			$accept_row = $db->query_fetch("select * from nf_accept where `no`=? and `" . $mno_field . "`=?", array($_POST['no'], $member['no']));
			if ($accept_row) {
				$arr['msg'] = "삭제된 인재정보입니다.";
				$arr['move'] = "";
				$info_row = $db->query_fetch("select * from nf_" . $accept_row['code'] . " where `no`=? and `mno`=?", array($accept_row['pno'], $accept_row['pmno']));
				if ($_POST['code']) {
					$info_row = $db->query_fetch("select * from nf_" . $_POST['code'] . " where `no`=? and `mno`=?", array($accept_row['sel_no'], $accept_row['mno']));
				}
				if ($info_row) {
					$arr['msg'] = "";
					$arr['row'] = $accept_row;

					$arr['info_subject'] = '<a href="' . NFE_URL . '/employ/employ_detail.php?no=' . $accept_row['pno'] . '" class="blue" target="_blank">' . $info_row['wr_subject'] . '</a>';

					if ($_POST['code']) {
						$arr['info_subject'] = '<a href="' . NFE_URL . '/employ/employ_detail.php?no=' . $accept_row['sel_no'] . '" class="blue" target="_blank">' . $info_row['wr_subject'] . '</a>';
					}
					$arr['js'] = '
					$(".info_subject-").html(data.info_subject);
					$(".name-").html(data.row.name);
					$(".phone-").html(data.row.phone);
					$(".hphone-").html(data.row.hphone);
					$(".email-").html(data.row.email);
					$(".content-").html(data.row.content);
					nf_util.openWin(".resume_support_info-", "block");
					';
				}
			}
		}
		die(json_encode($arr));
		break;

	case "get_support_employ":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			$info_row = $db->query_fetch("select * from nf_employ where `no`=" . intval($_POST['no']) . " and `mno`=" . intval($member['no']));
			$arr['js'] = '
			form.name.value = "' . $nf_util->get_text($info_row['wr_name']) . '";
			form.phone.value = "' . $nf_util->get_text($info_row['wr_phone']) . '";
			form.hphone.value = "' . $nf_util->get_text($info_row['wr_hphone']) . '";
			form.email.value = "' . $nf_util->get_text($info_row['wr_email']) . '";
			';
		}
		die(json_encode($arr));
		break;

	case "support_write":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			if ($_POST['page_code'] == 'employ' && $member['mb_type'] == 'company')
				$arr['msg'] = "개인회원만 이용 가능합니다.";
			if ($_POST['page_code'] == 'resume' && $member['mb_type'] == 'individual')
				$arr['msg'] = "업소회원만 이용 가능합니다.";
			if (!$arr['msg']) {
				$arr['msg'] = "정보가 없거나 진행중인 구인정보가 아닙니다.";
				$arr['move'] = $nf_util->page_back();
				if ($_POST['page_code'] == 'employ') {
					$row = $db->query_fetch("select * from `nf_" . $_POST['page_code'] . "` as ne where ne.`no`=?" . $nf_job->employ_where, array($_POST['pno']));
					$other_member = $db->query_fetch("select * from nf_member where `no`=" . intval($row['mno']));
					$other_row = $db->query_fetch("select * from `nf_resume` as nr where nr.`no`=? " . $nf_job->resume_where, array($_POST['info']));
					$company_name = $row['wr_company_name'];
					$sms_name = $member['mb_name'];
					$sms_phone = $other_member['mb_hphone'];
				} else {
					$row = $db->query_fetch("select * from `nf_" . $_POST['page_code'] . "` as nr where nr.`no`=?" . $nf_job->resume_where, array($_POST['pno']));
					$other_member = $db->query_fetch("select * from nf_member where `no`=" . intval($row['mno']));
					$other_row = $db->query_fetch("select * from `nf_employ` as ne where ne.`no`=? " . $nf_job->employ_where, array($_POST['info']));
					$company_name = $other_row['wr_company_name'];
					$sms_name = $other_member['mb_name'];
					$sms_phone = $other_member['mb_hphone'];
				}
				$get_member = $db->query_fetch("select * from nf_member where `no`=" . intval($row['mno']));

				$_where = "";
				if ($_POST['page_code'] == 'employ')
					$_where .= " and `sel_no`=" . intval($_POST['info']);
				$accept_row = $db->query_fetch("select * from nf_accept where `pno`=? and `sel_no`=? and `code`=? and `mno`=?" . $_where, array($_POST['pno'], $_POST['info'], $_POST['page_code'], $member['no']));

				$msg_part = "";
				if ($_POST['page_code'] == 'employ')
					$msg_part = "입사지원";
				if ($_POST['page_code'] == 'resume')
					$msg_part = "입사지원제의";

				if ($accept_row) {
					$arr['msg'] = "이미 " . $msg_part . "을(를) 신청했습니다.";
					$arr['js'] = '
					nf_util.openWin(".' . $_POST['page_code'] . '_support-");
					';
					$arr['move'] = "";
				} else if ($row) {

					$arr['msg'] = $msg_part . "이(가) 완료되었습니다.";
					$arr['move'] = "";
					$upload_allow = $nf_util->filesize_check($_FILES['attach']['size']);
					if (!$upload_allow) {
						$tmp = $_FILES['attach']['tmp_name'];
						$fname = $_FILES['attach']['name'];
						$accept_date = date("Ym");
						$dir_arr = $nf_util->get_dir_date("accept", $accept_date);
						if ($tmp) {
							$ext = $nf_util->get_ext($_FILES['attach']['name']);
							if (in_array($ext, $nf_util->attach_ext)) {
								$attach = $dir_arr['date'] . '/' . $_POST['page_code'] . '_' . time() . "." . $ext;
								if (move_uploaded_file($tmp, NFE_PATH . $dir_arr['dir'] . $attach)) {
								}
							}
						}
					}

					$_val = array();
					$_val['code'] = $_POST['page_code'];
					$_val['pno'] = $row['no'];
					$_val['sel_no'] = $_POST['info'];
					$_val['mno'] = $member['no'];
					$_val['mb_id'] = $member['mb_id'];
					$_val['mb_name'] = $member['mb_name'];
					$_val['pmno'] = $get_member['no'];
					$_val['pmb_id'] = $get_member['mb_id'];
					$_val['pmb_name'] = $get_member['mb_name'];
					$_val['subject'] = $_POST['subject'];
					$_val['name'] = $_POST['name'];
					$_val['phone'] = $_POST['phone'];
					$_val['hphone'] = $_POST['hphone'];
					$_val['email'] = $_POST['email'];
					$_val['content'] = $_POST['content'];
					$attach = $_val['attach'] = $attach;
					$_val['attach_name'] = $fname;
					$_val['view'] = $_POST['view'][0] ? implode(",", $_POST['view']) : "";
					$sdate = $_val['sdate'] = today_time;
					$q = $db->query_q($_val);
					$insert = $db->_query("insert into nf_accept set " . $q, $_val);

					if ($insert) {
						switch ($_POST['page_code']) {
							// : 입사지원제의
							case "resume":
								$sms_arr = array();
								$sms_arr['phone'] = $sms_phone;
								$sms_arr['name'] = $sms_name;
								$sms_arr['company_name'] = $company_name;
								$nf_sms->send_sms_resume_accept($sms_arr);

								$is_attach = is_file(NFE_PATH . '/data/accept/' . $attach) ? '홈페이지 로그인후 파일 다운로드 가능' : '';
								$email_arr = array();
								$phone_txt = $_POST['hphone'] ? $_POST['hphone'] : $_POST['phone'];
								$ch_email_text = array("{지원자명}" => $other_member['mb_name'], "{지원자아이디}" => $other_member['mb_id'], "{업소명}" => $company_name, "{담당자명}" => $_POST['name'], "{담당자전화번호}" => $phone_txt, "{담당자이메일}" => $_POST['email'], "{발송일}" => $sdate, "{입사지원내용}" => nl2br($_POST['content']));
								$mail_skin = $db->query_fetch("select * from nf_mail_skin where `skin_name`='proposal_become'");
								$email_arr['subject'] = strtr("{업소명}에서 {지원자명}님께 입사지원 요청을 하였습니다.", $ch_email_text);
								$email_arr['email'] = $other_member['mb_email'];
								$email_content = strtr($mail_skin['content'], $ch_email_text);
								$email_arr['content'] = strtr(stripslashes($email_content), $nf_email->ch_content($_val));
								$nf_email->send_mail($email_arr);
								break;

							//입사지원
							case "employ":
								$sms_arr = array();
								$sms_arr['phone'] = $sms_phone;
								$sms_arr['name'] = $sms_name;
								$sms_arr['company_name'] = $company_name;
								$nf_sms->send_sms_employ_online($sms_arr);

								$is_attach = is_file(NFE_PATH . '/data/accept/' . $attach) ? '홈페이지 로그인후 파일 다운로드 가능' : '첨부안함';
								$email_arr = array();

								$mb_phone = is_array($_POST['view']) && in_array('phone', $_POST['view']) ? $member['mb_phone'] : '비공개';
								$mb_hphone = is_array($_POST['view']) && in_array('phone', $_POST['view']) ? $member['mb_hphone'] : '비공개';
								$mb_email = is_array($_POST['view']) && in_array('email', $_POST['view']) ? $member['mb_email'] : '비공개';
								$mb_homepage = is_array($_POST['view']) && in_array('homepage', $_POST['view']) ? $member['mb_homepage'] : '비공개';

								$ch_email_text = array("{지원자아이디}" => $member['mb_id'], "{지원자명}" => $member['mb_name'], "{지원자전화번호}" => $mb_phone, "{지원자휴대폰}" => $mb_hphone, "{지원자이메일}" => $mb_email, "{지원자홈페이지}" => $mb_homepage, "{정규직 이력서}" => stripslashes($other_row['wr_subject']), "{파일첨부}" => $is_attach, "{지원일}" => $sdate, "{사전질문답변}" => nl2br(stripslashes($row['wr_pre_question'])));
								$mail_skin = $db->query_fetch("select * from nf_mail_skin where `skin_name`='online_become'");
								$email_arr['subject'] = strtr("{지원자명}님이 온라인 입사지원을 하였습니다.", $ch_email_text);
								$email_arr['email'] = $other_member['mb_email'];
								$email_content = strtr($mail_skin['content'], $ch_email_text);
								$email_arr['content'] = strtr(stripslashes($email_content), $nf_email->ch_content($_val));
								$nf_email->send_mail($email_arr);
								break;
						}
					}

					$arr['js'] = '
					nf_util.openWin(".' . $_POST['page_code'] . '_support-");
					';
				}
			}
		}
		die(json_encode($arr));
		break;

	// : 내이력서열람업소 삭제
	case "delete_read_company_info":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['move'] = $nf_util->page_back();
			$arr['msg'] = "삭제권한이 없습니다.";
			$row = $db->query_fetch("select * from nf_read where `pmno`=? and `no`=? and `code`=?", array($member['no'], $_POST['no'], 'resume'));
			if ($row) {
				$arr['msg'] = "삭제가 완료되었습니다.";
				$delete = $db->_query("delete from nf_read where `pmno`=? and `exmno`=?", array($member['no'], $row['exmno']));
				$delete = $db->_query("delete from nf_not_read where `mno`=? and `exmno`=?", array($member['no'], $row['exmno']));
			}
		}
		die(json_encode($arr));
		break;

	case "not_open":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$read_row = $db->query_fetch("select *, nr.`mno` as nr_mno, nr.`mb_id` as nr_mb_id from nf_read as nr right join nf_resume as nr2 on nr.`pno`=nr2.`no` where nr.`no`=? and nr.`pmno`=? and code=?", array($_POST['no'], $member['no'], 'resume'));

			$not_read_row = $db->query_fetch("select * from nf_not_read where `pmno`=? and exmno=? and mno=?", array($read_row['nr_mno'], $read_row['exmno'], $member['no']));
			if ($not_read_row) {
				$arr['msg'] = "열람제한 해제했습니다.";
				$query = $db->_query("delete from nf_not_read where `no`=" . intval($not_read_row['no']));
			} else {
				$arr['msg'] = "열람제한했습니다.";
				if ($read_row['exmno']) {
					$_val = array();
					$_val['exmno'] = $read_row['exmno'];
					$_val['mno'] = $member['no'];
					$_val['mb_id'] = $member['mb_id'];
					$_val['pmno'] = $read_row['nr_mno'];
					$_val['pmb_id'] = $read_row['nr_mb_id'];
					$q = $db->query_q($_val);
					$query = $db->_query("insert into nf_not_read set " . $q, $_val);
				}
			}
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	case "ch_company":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "업소정보가 없습니다.";
			$arr['move'] = "";
			$get_company = $db->query_fetch("select * from nf_member_company where `mno`=? and `no`=?", array($member['no'], $_POST['no']));
			$get_company_info = $nf_member->get_member_ex_info($get_company);

			$manager_query = $db->_query("select * from nf_manager where `mno`=? and `cno`=?", array($member['no'], $get_company['no']));
			if ($get_company) {

				ob_start();
				?>
				<option value="">담당자정보 불러오기</option>
				<?php
				while ($manager_row = $db->afetch($manager_query)) {
					?>
					<option value="<?php echo intval($manager_row['no']); ?>"><?php echo $nf_util->get_text($manager_row['wr_name']); ?>
					</option>
					<?php
				}
				$arr['manager'] = ob_get_clean();

				$arr['msg'] = "";
				$arr['row'] = $get_company;
				$arr['js'] = '
				$(".info_box").find(".company_name-").html(data.row.mb_company_name);
				$(".info_box").find(".ceo_name-").html(data.row.mb_ceo_name);
				$(".info_box").find(".biz_type-").html(data.row.mb_biz_type);
				$(".info_box").find(".biz_content-").html(data.row.mb_biz_content);
				$(".info_box").find(".biz_address-").html("["+data.row.mb_biz_zipcode+"] "+data.row.mb_biz_address0+" "+data.row.mb_biz_address1);
				$(".info_box").find(".homepage-").html(data.row.mb_homepage);
				$(".info_box").find(".logo_img_put-").css({"background-image":"url(' . $get_company_info['mb_logo_src'] . ')"});

				$(form).find("[name=\'ch_manager\']").html(data.manager);
				';
			}
		}
		die(json_encode($arr));
		break;

	case "ch_manager":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "담당자정보가 없습니다.";
			$arr['move'] = "";
			$manager_row = $db->query_fetch("select * from nf_manager where `no`=? and `mno`=?", array($_POST['no'], $member['no']));
			$manager_row['phone_arr'] = $manager_row['wr_phone'];
			$manager_row['hphone_arr'] = $manager_row['wr_hphone'];
			$manager_row['email_arr'] = explode("@", $manager_row['wr_email']);
			if ($manager_row) {
				$arr['msg'] = "";
				$arr['row'] = $manager_row;
				$arr['js'] = '
				form.wr_name.value = data.row.wr_name;				
				$(form).find("[name=\'wr_phone\']").eq(0).val(data.row.phone_arr).prop("selected", true);

				$(form).find("[name=\'wr_hphone\']").eq(0).val(data.row.hphone_arr).prop("selected", true);
	
				$(form).find("[name=\'wr_email[]\']").eq(0).val(data.row.email_arr[0]);
				$(form).find("[name=\'wr_email[]\']").eq(1).val(data.row.email_arr[1]);
				';
			}
		}
		die(json_encode($arr));
		break;

	case "customized_individual":
	case "customized_company":
	case "customized_write":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		$mb_no = $member['no'];
		if (admin_id && strpos($nf_util->page_back(), '/nad/') !== false)
			$mb_no = $_POST['mb_no'];
		if ($member['no'] || admin_id) {
			$update = $db->_query("update nf_member set `mb_customized`=?, custo_date=? where `no`=?", array(serialize($_POST), today_time, $mb_no));
			$arr['msg'] = "맞춤정보를 설정했습니다.";
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	case "resume_open":
		$arr['msg'] = "삭제된 이력서 정보입니다.";
		$_where = "";
		if (!admin_id)
			$_where = " and `mno`=" . intval($member['no']);
		$re_row = $db->query_fetch("select * from nf_resume where `no`=" . intval($_POST['no']) . " " . $_where);
		if ($re_row) {
			$open_val = $re_row['wr_open'] ? 0 : 1;
			$update = $db->_query("update nf_resume set `wr_open`=" . intval($open_val) . " where `no`=" . intval($re_row['no']));
			$arr['msg'] = $nf_util->open_arr[$open_val] . " 로 설정했습니다.";

			$arr['js'] = '
			var open_val = "' . $open_val . '";
			if(open_val=="1") {
				$(el).removeClass("red");
				$(el).addClass("blue");
			} else {
				$(el).removeClass("blue");
				$(el).addClass("red");
			}
			$(el).html("' . $nf_util->open_arr[$open_val] . '");
			';
		}
		die(json_encode($arr));
		break;

	case "copy_resume":
		$_where = "";
		if (!admin_id)
			$_where = " and `mno`=" . intval($member['no']);
		$re_row = $db->query_afetch("select * from nf_resume where `no`=" . intval($_POST['no']) . " " . $_where);
		unset($re_row['no']);

		$arr['msg'] = "복사할 이력서정보가 없습니다.";
		if ($re_row) {
			if (is_array($re_row)) {
				foreach ($re_row as $k => $val) {
					if (strpos($k, 'wr_service') === false)
						$_val[$k] = $val;
				}
			}
			$q = $db->query_q($_val);
			$insert = $db->_query("insert into nf_resume set " . $q, $_val);
			$arr['msg'] = "이력서정보를 복사하였습니다.";
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	case "get_employ_skin":
		$arr['msg'] = "권한이 없습니다.";
		$arr['move'] = "/";
		if ($member['no'] || admin_id) {
			$arr['msg'] = "";
			$arr['move'] = "";

			$em_row = $db->query_fetch("select * from nf_employ where `no`=1");

			// : 스킨불러오기
			if (intval($_POST['skin']) > 0) {
				ob_start();
				include NFE_PATH . '/include/skin/employ' . intval($_POST['skin']) . '.php';
				$arr['tag'] = ob_get_clean();

				// : 입력한 내용 불러오기
			} else {
				$arr['tag'] = stripslashes($em_row['wr_content']);
			}

			$arr['js'] = '
			_editor_use["wr_content"].putContents(data.tag);
			click_skin_html[get_skin] = data.tag;
			';

			// : style태그로 css를 /include/skin/employ1~3.php 안에 넣으면 에디터에서 사라지는 현상이 있음
			// : 그냥 employ skin파일안에 link태그로 css연결하면 되네요;; 아래 소스는 에디터소스에서 사용할지 몰라 남깁니다. ㅠㅠ
			/*
					 if(intval($_POST['skin'])>0) {
						 $arr['js'] .= '
						 $(_editor_use["wr_content"].cheditor.editArea.contentWindow.document).find("body").prepend(\'<link rel="stylesheet" type="text/css" href="'.NFE_URL.'/css/editor_employ.skin.css" />\');
						 ';
					 }
					 */

		}
		die(json_encode($arr));
		break;

	case "ch_end_date":
		$arr['msg'] = "권한이 없습니다.";
		$arr['move'] = main_page;
		if ($member['no']) {
			$em_row = $db->query_fetch("select * from nf_employ where `mno`=" . intval($member['no']) . " and `no`=" . intval($_POST['no']));
			$update = $db->_query("update nf_employ set `wr_end_date`='1000-01-01' where `no`=" . intval($em_row['no']));
			$arr['msg'] = "마감으로 설정했습니다.";
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	// : 구인정보 로고, 배경로고, 업소이미지
	case "employ_upload":
		$mode_arr = explode("_", $_POST['mode']);
		$table = 'nf_' . $mode_arr[0];
		$allow = ($member['no'] || admin_id) ? true : false;
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($allow) {
			$arr['msg'] = "";
			$arr['move'] = "";

			$tmp = $_FILES['file_upload']['tmp_name'];
			$dir = '/data/' . $mode_arr[0] . '/';
			if ($tmp) {
				$arr['msg'] = $nf_util->filesize_check($_FILES['file_upload']['size']);
				if (!$arr['msg']) {
					$ext = $nf_util->get_ext($_FILES['file_upload']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$file_name = $_POST['code'] . '_' . time() . "." . $ext;
						$fname = $file_name;
						$img_dir = 'tmp/' . $fname;
						$nf_util->make_thumbnail($tmp, NFE_PATH . $dir . $img_dir, 400, 120);

						$arr['js'] = '
						var put_img_eq = 0;
						';

						if ($_POST['code'] == 'company') {
							$arr['js'] = '
							var put_img_sel = -1;
							$(img_obj).closest(".parent_file_upload-").find(".put_image-").each(function(i){
								if(!$(this).val() && put_img_sel<0) {
									put_img_eq = i;
									put_img_sel = i;
								}
							});
							';
						}

						$arr['js'] .= '
						$(img_obj).closest(".parent_file_upload-").find(".put_img-").eq(put_img_eq).css({"background-image":"url(\'' . $dir . $img_dir . '\')"});
						$(img_obj).closest(".parent_file_upload-").find(".put_image-").eq(put_img_eq).val("' . $img_dir . '");
						';
					} else {
						$arr['msg'] = '사진은 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
						die(json_encode($arr));
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	case "resume_photo_upload":
		$mode_arr = explode("_", $_POST['mode']);
		$allow = ($member['no'] || admin_id) ? true : false;
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($allow) {
			$arr['msg'] = "";
			$arr['move'] = "";

			$arr['msg'] = $nf_util->filesize_check($_FILES['file_upload']['size']);
			if (!$arr['msg']) {
				$dir_arr = $nf_util->get_dir_date('member', $nf_member->member_arr[$member['no']]['mb_wdate']);

				$tmp = $_FILES['file_upload']['tmp_name'];
				if ($tmp) {
					$ext = $nf_util->get_ext($_FILES['file_upload']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$file_name = $dir_arr['date'] . '/photo_' . time() . "." . $ext;
						$nf_util->make_thumbnail($tmp, NFE_PATH . $dir_arr['dir'] . $file_name, 140, 170);
						$update = $db->_query("update nf_member set `mb_photo`=? where `no`=?", array($file_name, $member['no']));
						if ($update && is_file(NFE_PATH . $dir_arr['dir'] . $member['mb_photo']))
							unlink(NFE_PATH . $dir_arr['dir'] . $member['mb_photo']);

						$arr['msg'] = "사진변경이 완료되었습니다.";
						$arr['js'] = '
						$(".parent_photo_upload-").find("p.put_img-").eq(0).css({"background-image":"url(\'' . NFE_URL . $dir_arr['dir'] . $file_name . '\')"});
						$(".popup_layer.ijimg").css({"display":"none"})
						';
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	case "company_logo_upload":
		$allow = ($member['no'] || admin_id) ? true : false;
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($allow) {
			$arr['msg'] = "";
			$arr['move'] = "";

			$arr['msg'] = $nf_util->filesize_check($_FILES['file_upload']['size']);
			if (!$arr['msg']) {
				$dir_arr = $nf_util->get_dir_date('member', $member['mb_wdate']);

				$tmp = $_FILES['file_upload']['tmp_name'];
				if ($tmp) {
					$ext = $nf_util->get_ext($_FILES['file_upload']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$file_name = $dir_arr['date'] . '/logo_' . time() . "." . $ext;
						$nf_util->make_thumbnail($tmp, NFE_PATH . $dir_arr['dir'] . $file_name, 140, 170);
						$update = $db->_query("update nf_member_company set `mb_logo`=? where `no`=? and is_public=1", array($file_name, $member_ex['no']));
						if ($update && is_file(NFE_PATH . $dir_arr['dir'] . $member_ex['mb_logo']))
							unlink(NFE_PATH . $dir_arr['dir'] . $member_ex['mb_logo']);

						$arr['msg'] = "로고 변경이 완료되었습니다.";
						$arr['js'] = '
						$(".parent_photo_upload-").find("p.put_img-").eq(0).css({"background-image":"url(\'' . NFE_URL . $dir_arr['dir'] . $file_name . '\')"});
						$(".popup_layer.ijimg").css({"display":"none"});
						';
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	// : 이미지 삭제버튼 누른경우 - tmp에 저장된 이미지만 삭제됩니다.
	case "employ_img_delete":
		$allow = ($member['no'] || admin_id) ? true : false;
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($allow) {
			$arr['msg'] = "";
			$arr['move'] = "";
			$dir = '/data/employ/';
			// : tmp속 이미지만 삭제됩니다. - 수정시에 삭제하면 문제가 되기 때문
			if (strpos($_POST['photo_img'], 'tmp/') !== false) {
				if (is_file(NFE_PATH . $dir . $_POST['photo_img']))
					unlink(NFE_PATH . $dir . $_POST['photo_img']);
			}

			$arr['js'] = '
			$(el).closest(".parent_file_upload-").find(".put_img-").eq(eq).css({"background-image":"url(' . NFE_URL . '/images/no_imgicon.png)"});
			$(el).closest(".parent_file_upload-").find(".put_image-").eq(eq).val("");
			';
		}
		die(json_encode($arr));
		break;


	case "put_skin_content":
		$em_row = $db->query_fetch("select * from nf_employ where `no`=" . intval($_POST['no']));
		if (strpos($nf_util->page_back(), "/nad/") === false && $member['no']) {
			$company_row = $db->query_fetch("select * from nf_member_company where `no`=" . intval($_POST['cno']));
			$mb_biz_vision = $company_row['mb_biz_vision'];
		} else {
			$company_row = $db->query_fetch("select * from nf_member_company where `no`=" . intval($em_row['cno']));
			$mb_biz_vision = $company_row['mb_biz_vision'];
		}

		$arr['row']['wr_subject'] = stripslashes($_POST['wr_subject']);
		$arr['row']['mb_biz_vision'] = stripslashes($mb_biz_vision);
		$arr['row']['wr_person'] = @in_array($_POST['wr_volumes'][0], $nf_job->person_arr) ? $_POST['wr_volumes'][0] : intval($_POST['wr_person']);
		$arr['row']['wr_school'] = $nf_job->school[$_POST['wr_ability']];
		$arr['row']['wr_career'] = $nf_job->career_type[$_POST['wr_career_type']];
		if ($_POST['wr_career_type'] == '2')
			$arr['row']['wr_career'] .= ' ' . $nf_job->career_date_arr[$_POST['wr_career']];
		$arr['row']['wr_target'] = strtr(@implode(", ", $_POST['wr_target']), $cate_array['job_target']);
		$arr['row']['wr_papers'] = strtr(@implode(", ", $_POST['wr_papers']), $cate_array['job_document']);
		$arr['row']['wr_preferential'] = strtr(@implode(", ", $_POST['wr_preferential']), $cate_array['job_conditions']);
		$arr['row']['wr_grade'] = strtr(@implode(", ", $_POST['wr_grade']), $cate_array['job_grade']) . ' / ' . strtr(@implode(",", $_POST['wr_position']), $cate_array['job_position']);
		$arr['row']['wr_license'] = stripslashes($_POST['wr_license']);
		$arr['js'] = '
		if($(_editor_use["wr_content"].doc.body).find(".wr_subject--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_subject--").html(data.row.wr_subject);
		if($(_editor_use["wr_content"].doc.body).find(".mb_biz_vision--")[0]) $(_editor_use["wr_content"].doc.body).find(".mb_biz_vision--").html(data.row.mb_biz_vision);
		if($(_editor_use["wr_content"].doc.body).find(".wr_person--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_person--").html(data.row.wr_person);
		if($(_editor_use["wr_content"].doc.body).find(".wr_school--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_school--").html(data.row.wr_school);
		if($(_editor_use["wr_content"].doc.body).find(".wr_career--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_career--").html(data.row.wr_career);
		if($(_editor_use["wr_content"].doc.body).find(".wr_target--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_target--").html(data.row.wr_target);
		if($(_editor_use["wr_content"].doc.body).find(".wr_papers--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_papers--").html(data.row.wr_papers);
		if($(_editor_use["wr_content"].doc.body).find(".wr_preferential--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_preferential--").html(data.row.wr_preferential);
		if($(_editor_use["wr_content"].doc.body).find(".wr_grade--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_grade--").html(data.row.wr_grade);
		if($(_editor_use["wr_content"].doc.body).find(".wr_license--")[0]) $(_editor_use["wr_content"].doc.body).find(".wr_license--").html(data.row.wr_license);
		';
		die(json_encode($arr));
		break;

	// : 구인정보 등록
	case "employ_write":

		$wr_job_type = array();
		$wr_area = array();
		$wr_subway = array();

		$charge = !$_POST['charge'] ? false : ($_POST['charge'] == 'audit' ? false : true);
		$mno = strpos($nf_util->page_back(), '/nad/') !== false && admin_id ? $_POST['mno'] : $member['no'];
		$mem_row = $db->query_fetch("select * from nf_member where `no`=" . intval($mno));
		$em_row = $db->query_fetch("select * from nf_employ where `no`=" . intval($_POST['no']));
		$is_modify = !$em_row || $_POST['info_no'] || $_POST['code'] == 'copy' ? false : true;
		$employ_info = $nf_job->employ_info($em_row);
		$em_date = $em_row['wr_wdate'] ? date("Ym", strtotime($em_row['wr_wdate'])) : date("Ym");
		$dir_arr = $nf_util->get_dir_date("employ", $em_date);
		$wr_photo_arr = explode(",", $em_row['wr_photo']);

		if ($em_row['mno']) {
			$member_ex_row = $db->query_fetch("select * from nf_member_company where `is_public`=1 and `mno`=" . intval($em_row['mno']));
		}

		if (!$mem_row && $_POST['input_type'] == 'self') {
			$mem_row = $db->query_fetch("select * from nf_member where `mb_id`=?", array($_POST['mb_id']));
			$_mem = array();
			$_mem['mb_type'] = 'company';
			$_mem['mb_id'] = $_POST['mb_id'];
			$_mem['mb_name'] = $_POST['wr_name'];
			//$_mem['mb_birth'] = $_POST['mb_birth'];
			//$_mem['mb_gender'] = intval($_POST['mb_gender']);
			//if($_POST['wr_phone'][1]) $_mem['mb_phone'] = implode("-", $_POST['wr_phone']);
			$_mem['mb_phone'] = $_POST['wr_phone'];
			if ($_POST['wr_hphone'][1])
				$_mem['mb_hphone'] = implode("-", $_POST['wr_hphone']);
			//$_mem['mb_zipcode'] = $_POST['post'];
			//$_mem['mb_address0'] = $_POST['mb_address0'];
			//$_mem['mb_address1'] = $_POST['mb_address1'];
			$_mem['mb_wdate'] = today_time;
			$_mem['mb_udate'] = today_time;
			if ($_POST['wr_email'][0])
				$_mem['mb_email'] = implode("@", $_POST['wr_email']);

			$mem_q = $db->query_q($_mem);

			if (!$mem_row) {
				$query = $db->_query("insert into nf_member set " . $mem_q, $_mem);
				$mem_row = $db->query_fetch("select * from nf_member where `mb_id`=?", array($_POST['mb_id']));
			} else {
				$query = $db->_query("update nf_member set " . $mem_q . " where `no`=" . intval($mem_row['no']), $_mem);
			}
		}

		// : 회원정보 테이블
		$member_ex_row = $mem_com = $db->query_fetch("select * from nf_member_company where `mno`=" . intval($mem_row['no']));
		if (!$mem_com) {
			$_mem_com = array();
			$_mem_com['mb_id'] = $mem_row['mb_id'];
			$_mem_com['mno'] = $mem_row['no'];
			$_mem_com['mb_company_name'] = $_POST['wr_company_name'];
			if ($_POST['wr_email'][0])
				$_mem_com['mb_biz_email'] = implode("@", $_POST['wr_email']);
			if ($_POST['wr_fax'][0])
				$_mem_com['mb_biz_fax'] = implode("-", $_POST['wr_fax']);
			$_mem_com['is_admin'] = 1;
			$_mem_q = $db->query_q($_mem_com);
			$insert = $db->_query("insert into nf_member_company set " . $_mem_q, $_mem_com);
			$member_ex_row = $mem_com = $db->query_fetch("select * from nf_member_company where `mno`=" . intval($mem_row['no']));
		}
		$mem_service_row = $db->query_fetch("select * from nf_member_service where `mno`=" . intval($mem_row['no']));
		if (!$mem_service_row) {
			$db->_query("insert into nf_member_service set `mno`=?, `mb_id`=?", array($mem_row['no'], $mem_row['mb_id']));
			$mem_service_row = $db->query_fetch("select * from nf_member_service where `mno`=" . intval($mem_row['no']));
		}

		// : 직종
		if (is_array($_POST['wr_job_type'])) {
			if ($_POST['wr_job_type'][0][0])
				$wr_job_type[] = "," . implode(",", $_POST['wr_job_type'][0]) . ",";
			if ($_POST['wr_job_type'][1][0])
				$wr_job_type[] = "," . implode(",", $_POST['wr_job_type'][1]) . ",";
			if ($_POST['wr_job_type'][2][0])
				$wr_job_type[] = "," . implode(",", $_POST['wr_job_type'][2]) . ",";
		}

		// : 지역
		$wr_area = array();
		if (is_array($_POST['wr_area'])) {
			if ($_POST['wr_area'][0][0])
				$wr_area[] = "," . implode(",", $_POST['wr_area'][0]) . " " . $_POST['wr_area_add'];
			//if($_POST['wr_area'][1][0]) $wr_area[] = ",".implode(",", $_POST['wr_area'][1]).",";
			//if($_POST['wr_area'][2][0]) $wr_area[] = ",".implode(",", $_POST['wr_area'][2]).",";
		}

		// : 지하철
		$wr_subway = array();
		if (is_array($_POST['wr_subway'])) {
			if ($_POST['wr_subway'][0][0])
				$wr_subway[] = "," . implode(",", $_POST['wr_subway'][0]) . ",";
			if ($_POST['wr_subway'][1][0])
				$wr_subway[] = "," . implode(",", $_POST['wr_subway'][1]) . ",";
			if ($_POST['wr_subway'][2][0])
				$wr_subway[] = "," . implode(",", $_POST['wr_subway'][2]) . ",";
		}

		// : 로고
		$wr_use_photo = (is_file(NFE_PATH . $dir_arr['dir'] . $_POST['wr_logo']) || is_file(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo_bg'])) ? true : false;
		if (is_file(NFE_PATH . $dir_arr['dir'] . $_POST['wr_logo'])) {
			if (strpos($_POST['wr_logo'], 'tmp/') !== false) {
				$ch_logo = strtr($_POST['wr_logo'], array('tmp' => $dir_arr['date']));
				if (copy(NFE_PATH . $dir_arr['dir'] . $_POST['wr_logo'], NFE_PATH . $dir_arr['dir'] . $ch_logo)) {
					unlink(NFE_PATH . $dir_arr['dir'] . $_POST['wr_logo']);
					$_POST['wr_logo'] = $ch_logo;
					$wr_use_photo = true;
				}

				// : 불러오기로 로고 복사해야할경우
			} else if ($_POST['info_no']) {
				// : 로고
				if (is_file(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo'])) {
					$wr_logo_ext = $nf_util->get_ext($em_row['wr_logo']);
					$wr_logo_val = $dir_arr['date'] . '/logo_' . time() . '.' . $wr_logo_ext;
					if (copy(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo'], NFE_PATH . $dir_arr['dir'] . $wr_logo_val)) {
						$_POST['wr_logo'] = $wr_logo_val;
						$wr_use_photo = true;
					}
				}
			}
		}
		if (!$_POST['info_no'] && is_file(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo']) && $em_row['wr_logo'] != $_POST['wr_logo']) {
			unlink(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo']);
		}

		// : 배경로고
		if (is_file(NFE_PATH . $dir_arr['dir'] . $_POST['wr_logo_bg']) && strpos($_POST['wr_logo_bg'], 'tmp/') !== false) {
			$ch_logo = strtr($_POST['wr_logo_bg'], array('tmp' => $dir_arr['date']));
			if (copy(NFE_PATH . $dir_arr['dir'] . $_POST['wr_logo_bg'], NFE_PATH . $dir_arr['dir'] . $ch_logo)) {
				unlink(NFE_PATH . $dir_arr['dir'] . $_POST['wr_logo_bg']);
				$_POST['wr_logo_bg'] = $ch_logo;
			}

			// : 불러오기로 복사해야할 경우
		} else if ($_POST['info_no']) {
			// : 배경로고
			if (is_file(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo_bg'])) {
				$wr_logo_bg_ext = $nf_util->get_ext($em_row['wr_logo_bg']);
				$wr_logo_bg_val = $dir_arr['date'] . '/logo_bg_' . time() . '.' . $wr_logo_bg_ext;
				if (copy(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo_bg'], NFE_PATH . $dir_arr['dir'] . $wr_logo_bg_val))
					$_POST['wr_logo_bg'] = $wr_logo_bg_val;
			}
		}
		if (!$_POST['info_no'] && is_file(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo_bg']) && $em_row['wr_logo_bg'] != $_POST['wr_logo_bg']) {
			unlink(NFE_PATH . $dir_arr['dir'] . $em_row['wr_logo_bg']);
		}

		// : 업소 이미지
		$wr_photo = array();
		if (is_array($_POST['wr_photo'])) {
			foreach ($_POST['wr_photo'] as $k => $v) {
				if (is_file(NFE_PATH . $dir_arr['dir'] . $employ_info['photo_arr'][$k]) && $employ_info['photo_arr'][$k] != $v) {
					unlink(NFE_PATH . $dir_arr['dir'] . $employ_info['photo_arr'][$k]);
				}

				if ($v && is_file(NFE_PATH . $dir_arr['dir'] . $v) && strpos($v, 'tmp/') !== false) {
					$ch_photo = strtr($v, array('tmp' => $dir_arr['date']));
					if (copy(NFE_PATH . $dir_arr['dir'] . $v, NFE_PATH . $dir_arr['dir'] . $ch_photo)) {
						unlink(NFE_PATH . $dir_arr['dir'] . $v);
						$v = $ch_photo;
						$wr_use_photo = true;
					}

					// : 불러오기로 복사해야할 경우
				} else if ($_POST['info_no']) {
					// : 사진
					if (is_file(NFE_PATH . $dir_arr['dir'] . $v)) {
						$wr_photo_ext = $nf_util->get_ext($v);
						$wr_photo_val = $dir_arr['date'] . '/company' . $k . '_' . time() . '.' . $wr_photo_ext;
						if (copy(NFE_PATH . $dir_arr['dir'] . $v, NFE_PATH . $dir_arr['dir'] . $wr_photo_val)) {
							$v = $wr_photo_val;
							$wr_use_photo = true;
						}
					}
				}

				$wr_photo[] = $v;
			}
		}

		$upload_allow = $nf_util->filesize_check($_FILES['wr_form_attach']['size']);
		if (!$upload_allow) {
			$file_tmp = $_FILES['wr_form_attach']['tmp_name'];
			if ($file_tmp) {
				$file_ext = $nf_util->get_ext($_FILES['wr_form_attach']['name']);
				if (!in_array($file_ext, $nf_util->ext_not_upload))
					$wr_form_attach_val = $dir_arr['date'] . '/file_' . time() . '.' . $file_ext;
				if (!in_array($file_ext, $nf_util->ext_not_upload) && move_uploaded_file($file_tmp, NFE_PATH . $dir_arr['dir'] . $wr_form_attach_val)) {
					$wr_form_attach_name = $_FILES['wr_form_attach']['name'];
					if (is_file(NFE_PATH . $dir_arr['dir'] . $em_row['wr_form_attach']))
						unlink(NFE_PATH . $dir_arr['dir'] . $em_row['wr_form_attach']);
				} else {
					// : 불러오기로 복사해야할 경우
					if ($_POST['info_no']) {
						// : 첨부
						if (!$wr_form_attach_val && $em_row['wr_form_attach']) {
							$wr_form_attach_part_ext = $nf_util->get_ext($em_row['wr_form_attach']);
							$wr_form_attach_part_val = $dir_arr['date'] . '/file_' . time() . '.' . $wr_form_attach_part_ext;
							if (copy(NFE_PATH . $dir_arr['dir'] . $em_row['wr_form_attach'], NFE_PATH . $dir_arr['dir'] . $wr_form_attach_part_val))
								$wr_form_attach_val = $wr_form_attach_part_val;
						}
					} else {
						$wr_form_attach_val = "";
					}
				}
			}
		}

		$_val = array();
		if ($mem_row) {
			$_val['mno'] = $mem_row['no'];
			$_val['wr_id'] = $mem_row['mb_id'];
		}

		$cno = $_POST['cno'] ? intval($_POST['cno']) : intval($em_row['cno']);
		if (!$cno)
			$cno = $member_ex_row['no'];

		$is_adult = 0;
		if (is_Array($wr_job_type)) {
			foreach ($wr_job_type as $k => $job_part) {
				$job_part_arr = explode(",", $job_part);
				if (is_array($job_part_arr)) {
					foreach ($job_part_arr as $k => $part) {
						if (in_Array($part, $nf_category->job_part_adult_arr))
							$is_adult = 1;
					}
				}
			}
		}

		$_val['cno'] = $cno; // : 업소회원주키
		$_val['wr_logo_type'] = $_POST['wr_logo_type'];
		$_val['wr_logo'] = $_POST['wr_logo'];
		$_val['wr_logo_bg'] = $_POST['wr_logo_bg'];
		$_val['wr_logo_text'] = $_POST['wr_logo_text'];
		$_val['wr_name'] = $_POST['wr_name'];
		$_val['wr_phone'] = $_POST['wr_phone'] ? $_POST['wr_phone'] : "";
		$_val['wr_hphone'] = $_POST['wr_hphone'][0] ? implode("-", $_POST['wr_hphone']) : "";
		$_val['wr_nickname'] = $_POST['wr_nickname'];
		$_val['wr_email'] = $_POST['wr_email'][0] ? implode("@", $_POST['wr_email']) : "";
		$_val['wr_page'] = $_POST['wr_page'];
		$_val['wr_company'] = $cno;
		$_val['wr_company_name'] = $_POST['wr_company_name'];
		$_val['wr_subject'] = $_POST['wr_subject'];
		$_val['wr_job_type'] = $wr_job_type[0] ? implode(chr(10), $wr_job_type) : "";
		$_val['wr_is_adult'] = $is_adult;
		$_val['wr_beginner'] = $_POST['wr_beginner'];
		$_val['wr_area'] = ($wr_area[0]) ? implode(chr(10), $wr_area) : "";
		$_val['wr_doro_area'] = $_POST['wr_doro_area'][0] ? implode(chr(10), $_POST['wr_doro_area']) : '';
		$_val['wr_address'] = $_POST['wr_address'];
		$_val['wr_lat0'] = $_POST['map_int'][0][0];
		$_val['wr_lng0'] = $_POST['map_int'][0][1];
		$_val['wr_lat1'] = $_POST['map_int'][1][0];
		$_val['wr_lng1'] = $_POST['map_int'][1][1];
		$_val['wr_lat2'] = $_POST['map_int'][2][0];
		$_val['wr_lng2'] = $_POST['map_int'][2][1];
		$_val['wr_subway'] = implode(chr(10), $wr_subway);
		//$_val['wr_college_area'] = $_POST['sadfsdfd'];
		//$_val['wr_college_vicinity'] = $_POST['sadfsdfd'];
		$_val['wr_use_photo'] = $wr_use_photo;
		$_val['wr_photo'] = ($wr_photo[0]) ? implode(",", $wr_photo) : "";
		$_val['wr_date'] = $_POST['wr_date'];
		$_val['wr_week'] = $_POST['wr_week'];
		$_val['wr_stime'] = $_POST['wr_stime'][0] . ':' . $_POST['wr_etime'][0];
		$_val['wr_etime'] = $_POST['wr_stime'][1] . ':' . $_POST['wr_etime'][1];
		$_val['wr_time_conference'] = $_POST['wr_time_conference'];
		$_val['wr_pay_type'] = $_POST['wr_pay_type'];
		$_val['wr_pay'] = $_POST['wr_pay'];
		$_val['wr_pay_conference'] = $_POST['wr_pay_conference'];
		$_val['wr_pay_support'] = ($_POST['wr_pay_support'][0]) ? implode(",", $_POST['wr_pay_support']) : "";
		$_val['wr_work_type'] = ($_POST['wr_work_type'][0]) ? implode(",", $_POST['wr_work_type']) : "";
		//$_val['wr_welfare_read'] = $_POST['sadfsdfd'];
		if ($_POST['wr_welfare'][0])
			$_val['wr_welfare'] = implode(",", $_POST['wr_welfare']);
		$_val['wr_gender'] = $_POST['wr_gender'];
		$_val['wr_age_limit'] = $_POST['wr_age_limit'];
		$_val['wr_age'] = implode("-", $_POST['wr_age']);
		$_val['wr_age_etc'] = ($_POST['wr_age_etc'][0]) ? implode(",", $_POST['wr_age_etc']) : "";
		$_val['wr_ability'] = $_POST['wr_ability'];
		$_val['wr_ability_end'] = $_POST['wr_ability_end'];
		$_val['wr_career_type'] = $_POST['wr_career_type'];
		$_val['wr_career'] = $_POST['wr_career'];
		$_val['wr_grade'] = ($_POST['wr_grade'][0]) ? implode(",", $_POST['wr_grade']) : "";
		$_val['wr_position'] = ($_POST['wr_position'][0]) ? implode(",", $_POST['wr_position']) : "";
		$_val['wr_preferential'] = ($_POST['wr_preferential'][0]) ? implode(",", $_POST['wr_preferential']) : "";
		$_val['wr_person'] = in_array($_POST['wr_volumes'][0], $nf_job->person_arr) ? $_POST['wr_volumes'][0] : $_POST['wr_person'];
		$_val['wr_target'] = ($_POST['wr_target'][0]) ? implode(",", $_POST['wr_target']) : "";
		$_val['wr_end_date'] = $_POST['wr_end_date'] ? $_POST['wr_end_date'] : $_POST['end_date_check'][0];
		$_val['wr_requisition'] = ($_POST['wr_requisition'][0]) ? implode(",", $_POST['wr_requisition']) : "";
		$_val['wr_homepage'] = $_POST['wr_homepage'];
		$_val['wr_form'] = $_POST['wr_form'];
		$_val['wr_form_required'] = $_POST['wr_form_required'];
		if ($wr_form_attach_val)
			$_val['wr_form_attach'] = $wr_form_attach_val;
		if ($wr_form_attach_name)
			$_val['wr_form_attach_name'] = $wr_form_attach_name;
		$_val['wr_papers'] = ($_POST['wr_papers'][0]) ? implode(",", $_POST['wr_papers']) : "";
		$_val['wr_pre_question'] = $_POST['wr_pre_question'];
		$_val['wr_content'] = $_POST['wr_content'];
		$_val['wr_content_skin'] = $_POST['wr_content_skin'];
		$_val['wr_udate'] = today_time;
		$_val['wr_keyword'] = ($_POST['wr_keyword'][0]) ? implode(",", $_POST['wr_keyword']) : "";
		$_val['manager_not_view'] = is_array($_POST['manager_not_view']) && count($_POST['manager_not_view']) > 0 ? implode(",", $_POST['manager_not_view']) : "";
		$_val['input_type'] = $_POST['input_type'];
		$_val['wr_movie'] = $_POST['wr_movie'];
		$_val['wr_license'] = $_POST['wr_license'];
		$_val['is_audit'] = $_POST['charge'] == 'audit' ? 1 : 0;
		$_val['wr_messanger'] = $_POST['wr_messanger'];
		$_val['wr_messanger_id'] = $_POST['wr_messanger_id'];

		if (!$is_modify) {
			$_val['wr_open'] = 1;
			$_val['wr_wdate'] = today_time;
			$_val['wr_jdate'] = today_time;
			$_val['wr_is_admin'] = admin_id ? 1 : 0;
		}

		// : 첫 등록일때에만 결제페이지사용여부가 미사용인경우 무료로 주기
		$service_insert_use = false;
		if (!$is_modify && !$env['service_employ_use']) {
			// : 유료서비스 사용안하는경우
			$service_free_query = $db->_query("select * from nf_service where `code`='employ' and is_charge=0");
			while ($service_row = $db->afetch($service_free_query)) {
				if (!array_key_exists($service_row['type'], $nf_job->service_charge_arr['employ']))
					continue; // : 구인정보 기간서비스들만 실행
				$free_date_arr = explode(" ", $service_row['free_date']);
				if ($free_date_arr[0] && $free_date_arr[1]) {
					$free_date = date("Y-m-d", strtotime($service_row['free_date']));
					$_val['wr_service' . $service_row['type']] = $free_date;
					$service_insert_use = true;
				}
			}
		}

		$em_no = $em_row['no'];
		$q = $db->query_q($_val);
		if ($em_row && !$_POST['info_no'] && $_POST['code'] != 'copy')
			$query = $db->_query("update nf_employ set " . $q . " where `no`=" . intval($em_row['no']), $_val);
		else {
			$query = $db->_query("insert into nf_employ set " . $q, $_val);
			if ($query) {
				$em_no = $db->last_id();
				$sms_arr = array();
				$sms_arr['phone'] = $member['mb_hphone'];
				$sms_arr['name'] = $member['mb_name'];
				$nf_sms->send_sms_employ_write($sms_arr);
			}
		}

		$arr['msg'] = ($is_modify ? "수정" : "등록") . "이 완료되었습니다.";
		if ($_POST['info_no'])
			$arr['msg'] = '불러오기로 등록이 완료되었습니다.';
		if (strpos($nf_util->page_back(), '/nad/') === false) {
			$arr['move'] = NFE_URL . '/company/employ_list.php';
			if ($em_row && $_POST['code'] == 'copy' && !$service_insert_use)
				$arr['move'] = NFE_URL . '/company/employ_list.php?code=end';
			if ($charge)
				$arr['move'] = NFE_URL . '/service/product_payment.php?code=employ&no=' . $em_no;
		} else {
			$arr['move'] = $nf_util->sess_page("admin_employ_list");
		}

		die($nf_util->move_url($arr['move'], $arr['msg']));
		break;

	// : 이력서 등록
	case "resume_write":
		$wr_job_type = array();
		$wr_area = array();

		if (strpos($nf_util->page_back(), '/nad/') !== false && admin_id)
			$control_my = 'admin';

		$charge = $_POST['charge'];
		$mno = "";
		if (strpos($nf_util->page_back(), '/nad/') === false)
			$mno = $member['no'];
		$re_row = $db->query_fetch("select * from nf_resume where `no`=" . intval($_POST['no']));
		if ($re_row)
			$mno = $re_row['mno'];

		$mem_row = $db->query_fetch("select * from nf_member where `no`=" . intval($mno));
		$is_modify = !$re_row || $_POST['info_no'] ? false : true;
		$resume_info = $nf_job->resume_info($re_row);
		$em_date = $re_row['wr_wdate'] ? date("Ym", strtotime($re_row['wr_wdate'])) : date("Ym");
		$dir_arr = $nf_util->get_dir_date("resume", $em_date);

		// : 직종
		if (is_array($_POST['wr_job_type'])) {
			if ($_POST['wr_job_type'][0][0])
				$wr_job_type[] = "," . implode(",", $_POST['wr_job_type'][0]) . ",";
			if ($_POST['wr_job_type'][1][0])
				$wr_job_type[] = "," . implode(",", $_POST['wr_job_type'][1]) . ",";
			if ($_POST['wr_job_type'][2][0])
				$wr_job_type[] = "," . implode(",", $_POST['wr_job_type'][2]) . ",";
		}

		// : 지역
		if (is_array($_POST['wr_area'])) {
			if ($_POST['wr_area'][0][0])
				$wr_area[] = "," . implode(",", $_POST['wr_area'][0]) . ",";
			if ($_POST['wr_area'][1][0])
				$wr_area[] = "," . implode(",", $_POST['wr_area'][1]) . ",";
			if ($_POST['wr_area'][2][0])
				$wr_area[] = "," . implode(",", $_POST['wr_area'][2]) . ",";
		}
		$wr_home_work = $_POST['wr_area'][0][2] || $_POST['wr_area'][1][2] || $_POST['wr_area'][2][2] ? 1 : 0;

		if (!$mem_row && $_POST['input_type'] == 'self') {
			$mem_row = $db->query_fetch("select * from nf_member where `mb_id`=?", array($_POST['mb_id']));
			$mb_wdate = $mem_row['mb_wdate'] ? $mem_row['mb_wdate'] : today_time;
			$upload_allow = $nf_util->filesize_check($_FILES['mb_photo']['size']);
			if (!$upload_allow) {
				$mb_photo_tmp = $_FILES['mb_photo']['tmp_name'];
				if ($mb_photo_tmp) {
					$dir_arr = $nf_util->get_dir_date('member', $mb_wdate);
					$ext = $nf_util->get_ext($_FILES['mb_photo']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$mb_photo = $dir_arr['date'] . '/photo_' . time() . "." . $ext;
						$nf_util->make_thumbnail($mb_photo_tmp, NFE_PATH . $dir_arr['dir'] . $mb_photo, 140, 170);
						if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_row['mb_photo']))
							unlink(NFE_PATH . $dir_arr['dir'] . $mem_row['mb_photo']);
					} else {
						$arr['msg'] = '사진은 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
						die(json_encode($arr));
					}
				}
			}
			$_mem = array();
			$_mem['mb_type'] = 'individual';
			$_mem['mb_id'] = $_POST['mb_id'];
			$_mem['mb_name'] = $_POST['mb_name'];
			$_mem['mb_birth'] = $_POST['mb_birth'];
			$_mem['mb_gender'] = intval($_POST['mb_gender']);
			if ($_POST['mb_phone'][1])
				$_mem['mb_phone'] = implode("-", $_POST['mb_phone']);
			if ($_POST['mb_hphone'][1])
				$_mem['mb_hphone'] = implode("-", $_POST['mb_hphone']);
			$_mem['mb_zipcode'] = $_POST['post'];
			$_mem['mb_address0'] = $_POST['mb_address0'];
			$_mem['mb_address1'] = $_POST['mb_address1'];
			$_mem['mb_wdate'] = today_time;
			$_mem['mb_udate'] = today_time;
			$_mem['mb_photo'] = $mb_photo;
			if ($_POST['mb_email'][0])
				$_mem['mb_email'] = implode("@", $_POST['mb_email']);

			$mem_q = $db->query_q($_mem);

			if (!$mem_row) {
				$query = $db->_query("insert into nf_member set " . $mem_q, $_mem);
				$mem_row = $db->query_fetch("select * from nf_member where `mb_id`=?", array($_POST['mb_id']));
			} else {
				$query = $db->_query("update nf_member set " . $mem_q . " where `no`=" . intval($mem_row['no']), $_mem);
			}
		}

		// : 개인회원정보 테이블
		$mem_indi = $db->query_fetch("select * from nf_member_individual where `mno`=" . intval($mem_row['no']));
		if (!$mem_indi) {
			$insert = $db->_query("insert into nf_member_individual set `mb_id`=?, `mno`=?", array($mem_row['mb_id'], $mem_row['no']));
			$mem_indi = $db->query_fetch("select * from nf_member_individual where `mno`=" . intval($mem_row['no']));
		}
		$mem_service_row = $db->query_fetch("select * from nf_member_service where `mno`=" . intval($mem_row['no']));
		if (!$mem_service_row) {
			$db->_query("insert into nf_member_service set `mno`=?, `mb_id`=?", array($mem_row['no'], $mem_row['mb_id']));
			$mem_service_row = $db->query_fetch("select * from nf_member_service where `mno`=" . intval($mem_row['no']));
		}

		$re_date = $re_row['wr_wdate'] ? date("Ym", strtotime($re_row['wr_wdate'])) : date("Ym");
		$dir_arr = $nf_util->get_dir_date("resume", $re_date);
		$attach_arr = array();
		if (is_array($_FILES['wr_attach']['tmp_name']))
			$attach_length = count($_FILES['wr_attach']['tmp_name']);
		if (is_array($resume_info['attach_arr']))
			$is_attach_length = count($resume_info['attach_arr']);
		if (is_array($_FILES['wr_attach']['tmp_name'])) {
			foreach ($_FILES['wr_attach']['tmp_name'] as $k => $tmp) {
				$file_name = $_FILES['wr_attach']['name'][$k];
				if ($tmp) {
					$upload_allow = $nf_util->filesize_check($_FILES['wr_attach']['size'][$k]);
					if (!$upload_allow) {
						$ext = $nf_util->get_ext($file_name);
						$attach_file = 'file' . $k . '_' . time() . '.' . $ext;
						$attach_arr[$k] = array('file' => $dir_arr['date'] . '/' . $attach_file, 'txt' => $file_name);
						if (in_array($ext, $nf_util->attach_ext) && move_uploaded_file($tmp, NFE_PATH . $dir_arr['dir'] . $attach_arr[$k]['file'])) {
							if (is_file(NFE_PATH . $dir_arr['dir'] . $resume_info['attach_arr'][$k]['file']))
								unlink(NFE_PATH . $dir_arr['dir'] . $resume_info['attach_arr'][$k]['file']);
						}
					}
				} else {
					// : 복사하기인경우
					if ($_POST['info_no']) {
						// : 사진
						if (is_file(NFE_PATH . $dir_arr['dir'] . $resume_info['attach_arr'][$k]['file'])) {
							$attach_copy_ext = $nf_util->get_ext($resume_info['attach_arr'][$k]['file']);
							$attach_file = 'file' . $k . '_' . time() . '.' . $attach_copy_ext;
							$attach_arr[$k] = array('file' => $dir_arr['date'] . '/' . $attach_file, 'txt' => $resume_info['attach_arr'][$k]['txt']);
							copy(NFE_PATH . $dir_arr['dir'] . $resume_info['attach_arr'][$k]['file'], NFE_PATH . $dir_arr['dir'] . $attach_arr[$k]['file']);
						}
					} else {
						$attach_arr[$k] = $resume_info['attach_arr'][$k];
					}
				}
			}
		}
		// : 이 이후 삭제된 이미지 [ 수정전엔 3개였는데 수정후 1개로 줄은 상태면 2개 삭제되야함
		for ($i = $attach_length; $i < $is_attach_length; $i++) {
			$file_arr = $resume_info['attach_arr'][$i];
			unset($attach_arr[$i]);
			if (is_file(NFE_PATH . $dir_arr['dir'] . $file_arr['file']))
				unlink(NFE_PATH . $dir_arr['dir'] . $file_arr['file']);
		}

		// : 경력 개월값 합산.
		$career_int = 0;
		if (is_array($_POST['wr_career_arr']['syear'])) {
			foreach ($_POST['wr_career_arr']['syear'] as $k => $syear) {
				$year_cha = intval($_POST['wr_career_arr']['eyear'][$k] - $syear);
				$month_cha = intval($_POST['wr_career_arr']['emonth'][$k] - $_POST['wr_career_arr']['smonth'][$k]);

				$career_int += ($year_cha * 12) + $month_cha;
			}
		}

		$_individual = array();
		$_individual['mno'] = $mem_row['no'];
		$_individual['mb_id'] = $mem_row['mb_id'];
		$_individual['wr_school_ability'] = $_POST['wr_school_ability'];
		$_individual['wr_school_ability_end'] = $_POST['wr_school_ability_end'];
		$_individual['wr_school_type'] = (strlen($_POST['wr_school_type'][0]) > 0) ? implode(",", $_POST['wr_school_type']) : "";
		$_individual['wr_school_info'] = serialize($_POST['wr_school_arr']);
		$_individual['wr_career'] = intval($career_int);
		$_individual['wr_career_use'] = $_POST['wr_career_use'];
		$_individual['wr_career_info'] = serialize($_POST['wr_career_arr']);
		$_individual['wr_license_use'] = is_array($_POST['resume_select']) && in_array('license', $_POST['resume_select']) ? 1 : 0;
		$_individual['wr_license'] = serialize($_POST['wr_license']);
		$_individual['wr_language_use'] = is_array($_POST['resume_select']) && in_array('language', $_POST['resume_select']) ? 1 : 0;
		$_individual['wr_language'] = serialize($_POST['wr_language']);
		$_individual['wr_skill_use'] = is_array($_POST['resume_select']) && in_array('skill', $_POST['resume_select']) ? 1 : 0;
		$_individual['wr_oa'] = serialize($_POST['wr_oa']);
		$_individual['wr_computer'] = strlen($_POST['wr_computer'][0]) > 0 ? implode(",", $_POST['wr_computer']) : "";
		$_individual['wr_specialty'] = $_POST['wr_specialty'];
		$_individual['wr_specialty_etc'] = $_POST['wr_specialty_etc'];
		$_individual['wr_prime_use'] = is_array($_POST['resume_select']) && in_array('prime', $_POST['resume_select']) ? 1 : 0;
		$_individual['wr_prime'] = $_POST['wr_prime'];
		$_individual['wr_preferential_use'] = is_array($_POST['resume_select']) && in_array('preferential', $_POST['resume_select']) ? 1 : 0;
		$_individual['wr_impediment_use'] = $_POST['wr_impediment_use'];
		$_individual['wr_impediment_level'] = $_POST['wr_impediment_level'];
		$_individual['wr_impediment_name'] = $_POST['wr_impediment_name'];
		$_individual['wr_marriage'] = $_POST['wr_marriage'];
		$_individual['wr_military'] = $_POST['wr_military'];
		$_individual['wr_military_content'] = $_POST['wr_military_content'];
		$_individual['wr_military_sdate'] = $_POST['wr_military_year'][0] . '-' . sprintf("%02d", $_POST['wr_military_month'][0]);
		$_individual['wr_military_edate'] = $_POST['wr_military_year'][1] . '-' . sprintf("%02d", $_POST['wr_military_month'][1]);
		$_individual['wr_veteran_use'] = $_POST['wr_veteran_use'];
		$_individual['wr_veteran'] = $_POST['wr_veteran'];
		$_individual['wr_treatment_use'] = $_POST['wr_treatment_use'];
		$_individual['wr_treatment_service'] = (strlen($_POST['wr_treatment_service'][0]) > 0) ? implode(",", $_POST['wr_treatment_service']) : "";
		$_individual['wr_sensitive'] = $_POST['wr_sensitive'];
		$individual_q = $db->query_q($_individual);
		if ($mem_indi)
			$update = $db->_query("update nf_member_individual set " . $individual_q . " where `mno`=" . intval($mem_row['no']), $_individual);
		else
			$update = $db->_query("insert into nf_member_individual set " . $individual_q, $_individual);

		$_val = array();
		$_val['input_type'] = $_POST['input_type'];
		if ($wr_area[0])
			$_val['wr_area'] = implode(chr(10), $wr_area);
		$_val['wr_home_work'] = $wr_home_work;
		if ($wr_job_type[0])
			$_val['wr_job_type'] = implode(chr(10), $wr_job_type);
		//$_val['wr_work_direct'] = $_POST['wr_work_direct']; // 초보가능 삭제함
		$_val['wr_date'] = $_POST['wr_date'];
		$_val['wr_week'] = $_POST['wr_week'];
		$_val['wr_time'] = $_POST['wr_time'];
		$_val['wr_pay_type'] = $_POST['wr_pay_type'];
		$_val['wr_pay'] = intval(strtr($_POST['wr_pay'], array("," => "")));
		$_val['wr_pay_conference'] = $_POST['wr_pay_conference'];
		$_val['wr_work_type'] = (strlen($_POST['wr_work_type'][0]) > 0) ? implode(",", $_POST['wr_work_type']) : "";
		$_val['wr_school_ability'] = $_POST['wr_school_ability'];
		$_val['wr_school_ability_end'] = $_POST['wr_school_ability_end'];
		$_val['wr_school_type'] = (strlen($_POST['wr_school_type'][0]) > 0) ? implode(",", $_POST['wr_school_type']) : "";
		$_val['wr_career'] = intval($career_int);
		$_val['wr_career_use'] = $_POST['wr_career_use'];
		$_val['wr_subject'] = $_POST['wr_subject'];
		$_val['wr_introduce'] = $_POST['wr_introduce'];
		$_val['wr_movie'] = $_POST['wr_movie'];
		$_val['is_homepage'] = $_POST['is_homepage'];
		$_val['is_phone'] = $_POST['is_phone'];
		$_val['is_address'] = $_POST['is_address'];
		$_val['is_email'] = $_POST['is_email'];
		$_val['wr_calltime'] = (strlen($_POST['wr_calltime'][0]) > 0) ? implode("-", $_POST['wr_calltime']) : "";
		$_val['wr_calltime_always'] = $_POST['wr_calltime_always'];
		$_val['wr_udate'] = today_time;
		$_val['wr_attach'] = serialize($attach_arr);
		$_val['wr_open'] = $_POST['wr_open'];
		$_val['wr_messanger'] = $_POST['wr_messanger'];
		$_val['wr_messanger_id'] = $_POST['wr_messanger_id'];

		if (!$is_modify) {
			$_val['wr_id'] = $_POST['mb_id'] ? $_POST['mb_id'] : $mem_row['mb_id'];
			$_val['mno'] = $mem_row['no'];
			$_val['wr_wdate'] = today_time;
			$_val['wr_jdate'] = today_time;
			$_val['wr_is_admin'] = admin_id ? 1 : 0;
		}

		$_val['wr_license_use'] = is_array($_POST['resume_select']) && in_array('license', $_POST['resume_select']) ? 1 : 0;
		$_val['wr_language_use'] = is_array($_POST['resume_select']) && in_array('language', $_POST['resume_select']) ? 1 : 0;
		$_val['wr_skill_use'] = is_array($_POST['resume_select']) && in_array('skill', $_POST['resume_select']) ? 1 : 0;
		$_val['wr_prime_use'] = is_array($_POST['resume_select']) && in_array('prime', $_POST['resume_select']) ? 1 : 0;
		$_val['wr_preferential_use'] = is_array($_POST['resume_select']) && in_array('preferential', $_POST['resume_select']) ? 1 : 0;

		// : 첫 등록일때에만 결제페이지사용여부가 미사용인경우 무료로 주기
		if (!$is_modify && !$env['service_resume_use']) {
			// : 유료서비스 사용안하는경우
			$service_free_query = $db->_query("select * from nf_service where `code`='resume' and is_charge=0");
			while ($service_row = $db->afetch($service_free_query)) {
				if (!array_key_exists($service_row['type'], $nf_job->service_charge_arr['resume']))
					continue; // : 인재정보 기간서비스들만 실행
				$free_date_arr = explode(" ", $service_row['free_date']);
				if ($free_date_arr[0] && $free_date_arr[1]) {
					$free_date = date("Y-m-d", strtotime($service_row['free_date']));
					$_val['wr_service' . $service_row['type']] = $free_date;
				}
			}
		}

		$re_no = $re_row['no'];
		$q = $db->query_q($_val);
		if ($re_row && !$_POST['info_no'])
			$query = $db->_query("update nf_resume set " . $q . " where `no`=" . intval($re_row['no']), $_val);
		else {
			$query = $db->_query("insert into nf_resume set " . $q, $_val);

			if ($query) {
				$re_no = $db->last_id();
				$sms_arr = array();
				$sms_arr['phone'] = $member['mb_hphone'];
				$sms_arr['name'] = $member['mb_name'];
				$nf_sms->send_sms_resume_write($sms_arr);
			}
		}

		$arr['msg'] = $is_modify ? "수정이 완료되었습니다." : "등록이 완료되었습니다.";
		if ($_POST['info_no'])
			$arr['msg'] = "복사가 완료되었습니다.";
		$arr['move'] = '/individual/resume_list.php';
		if ($charge)
			$arr['move'] = NFE_URL . '/service/product_payment.php?code=resume&no=' . $re_no;
		if (strpos($nf_util->page_back(), '/nad/') !== false)
			$arr['move'] = $nf_util->sess_page("admin_resume_list");

		die($nf_util->move_url($arr['move'], $arr['msg']));

		break;

	// : 업소정보 추가
	case "company_write":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {

			if (strpos($nf_util->page_back(), '/member/update_form.php') !== false || strpos($nf_util->page_back(), '/company/company_info_regist.php') !== false) {
				$mb_id = $member['mb_id'];
				$mno = $member['no'];
			}
			if (strpos($nf_util->page_back(), "/nad/") !== false) {
				$mem_row = $db->query_fetch("select * from nf_member where `no`=" . intval($_POST['mno']));
				$mno = $mem_row['no'];
				$mb_id = $mem_row['mb_id'];
			}

			$_where = "";
			if (!$is_admin)
				$_where .= " and `mno`=" . intval($mno);
			$company_row = $db->query_fetch("select * from nf_member_company where `no`=" . intval($_POST['no']) . $_where);

			$upload_allow = $nf_util->filesize_check($_FILES['mb_logo']['size']);
			if (!$upload_allow) {
				$mb_logo_tmp = $_FILES['mb_logo']['tmp_name'];
				if ($mb_logo_tmp) {
					$dir_arr = $nf_util->get_dir_date('member', $member['mb_wdate']);
					if ($mb_logo_tmp) {
						$ext = $nf_util->get_ext($_FILES['mb_logo']['name']);
						if (in_array($ext, $nf_util->photo_ext)) {
							$mb_logo = $dir_arr['date'] . '/logo_' . time() . "." . $ext;
							$nf_util->make_thumbnail($mb_logo_tmp, NFE_PATH . $dir_arr['dir'] . $mb_logo, 140, 170);
							if (is_file(NFE_PATH . $dir_arr['dir'] . $company_row['mb_logo']))
								unlink(NFE_PATH . $dir_arr['dir'] . $company_row['mb_logo']);
						}
					}
				}
			}

			$mb_biz_attach_tmp = $_FILES['mb_biz_attach']['tmp_name'];
			if ($mb_biz_attach_tmp) {
				$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
				$ext = $nf_util->get_ext($_FILES['mb_biz_attach']['name']);
				if (in_array($ext, $nf_util->photo_ext)) {
					$mb_biz_attach = $dir_arr['date'] . '/biz_' . time() . "." . $ext;
					$nf_util->make_thumbnail($mb_biz_attach_tmp, NFE_PATH . $dir_arr['dir'] . $mb_biz_attach, 1000);
					if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_biz_attach']))
						unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_biz_attach']);
				}
			}

			$upload_allow = $nf_util->filesize_check($_FILES['mb_img1']['size']);
			if (!$upload_allow) {
				$mb_img1_tmp = $_FILES['mb_img1']['tmp_name'];
				if ($mb_img1_tmp) {
					$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
					$ext = $nf_util->get_ext($_FILES['mb_img1']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$mb_img1 = $dir_arr['date'] . '/img1_' . time() . "." . $ext;
						$nf_util->make_thumbnail($mb_img1_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img1, 286, 160);
						if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img1']))
							unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img1']);
					} else {
						$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
						$arr['move'] = $nf_util->page_back();
						die(json_encode($arr));
					}
				}
			}
			$upload_allow = $nf_util->filesize_check($_FILES['mb_img2']['size']);
			if (!$upload_allow) {
				$mb_img2_tmp = $_FILES['mb_img2']['tmp_name'];
				if ($mb_img2_tmp) {
					$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
					$ext = $nf_util->get_ext($_FILES['mb_img2']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$mb_img2 = $dir_arr['date'] . '/img2_' . time() . "." . $ext;
						$nf_util->make_thumbnail($mb_img2_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img2, 286, 160);
						if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img2']))
							unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img2']);
					} else {
						$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
						$arr['move'] = $nf_util->page_back();
						die(json_encode($arr));
					}
				}
			}
			$upload_allow = $nf_util->filesize_check($_FILES['mb_img3']['size']);
			if (!$upload_allow) {
				$mb_img3_tmp = $_FILES['mb_img3']['tmp_name'];
				if ($mb_img3_tmp) {
					$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
					$ext = $nf_util->get_ext($_FILES['mb_img3']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$mb_img3 = $dir_arr['date'] . '/img3_' . time() . "." . $ext;
						$nf_util->make_thumbnail($mb_img3_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img3, 286, 160);
						if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img3']))
							unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img3']);
					} else {
						$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
						$arr['move'] = $nf_util->page_back();
						die(json_encode($arr));
					}
				}
			}
			$upload_allow = $nf_util->filesize_check($_FILES['mb_img4']['size']);
			if (!$upload_allow) {
				$mb_img4_tmp = $_FILES['mb_img4']['tmp_name'];
				if ($mb_img4_tmp) {
					$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
					$ext = $nf_util->get_ext($_FILES['mb_img4']['name']);
					if (in_array($ext, $nf_util->photo_ext)) {
						$mb_img4 = $dir_arr['date'] . '/img4_' . time() . "." . $ext;
						$nf_util->make_thumbnail($mb_img4_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img4, 286, 160);
						if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img4']))
							unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img4']);
					} else {
						$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
						$arr['move'] = $nf_util->page_back();
						die(json_encode($arr));
					}
				}
			}

			$_val2 = array();
			include NFE_PATH . '/engine/function/mb_type_company.query.php';
			if ($company_row) {
				$query = $db->_query("update nf_member_company set " . $q2 . " where `no`=" . intval($company_row['no']), $_val2);
			} else {
				$query = $db->_query("insert into nf_member_company set " . $q2, $_val2);
			}

			$arr['msg'] = ($company_row ? "수정" : "등록") . "이 완료되었습니다.";
			$arr['move'] = NFE_URL . '/company/company_info.php';
			if (strpos($nf_util->page_back(), '/nad/') !== false)
				$arr['move'] = $_SESSION['company_info_list'] ? $_SESSION['company_info_list'] : NFE_URL . '/nad/member/company_info.php';
		}
		die(json_encode($arr));
		break;

	//################## 삭제 ##################//
	case "delete_resume":
	case "delete_select_resume":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$arr['msg'] = "삭제할 이력서가 없습니다.";
			$nos = $_POST['chk'][0] ? implode(",", $_POST['chk']) : $_POST['no'];
			$_where = "";
			if (!admin_id)
				$_where .= " and `mno`=" . intval($member['no']);
			$query = $db->_query("select * from nf_resume where `no` in (" . $nos . ") " . $_where);
			while ($row = $db->afetch($query)) {
				$delete = $db->_query("update nf_resume set `is_delete`=1 where `no`=" . intval($row['no']));
			}
			$arr['msg'] = "삭제가 완료되었습니다.";
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	case "delete_employ":
	case "employ_select_delete":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$arr['msg'] = "삭제할 구인정보가 없습니다.";
			$nos = $_POST['chk'][0] && $_POST['mode'] == 'employ_select_delete' ? implode(",", $_POST['chk']) : $_POST['no'];
			$_where = "";
			if (!admin_id)
				$_where .= " and `mno`=" . intval($member['no']);
			$query = $db->_query("select * from nf_employ where `no` in (" . $nos . ") " . $_where);
			while ($row = $db->afetch($query)) {
				$delete = $db->_query("update nf_employ set `is_delete`=1 where `no`=" . intval($row['no']));
			}
			$arr['msg'] = "삭제가 완료되었습니다.";
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	case "delete_select_scrap":
	case "delete_scrap":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$nos = $_POST['mode'] == 'delete_scrap' ? $_POST['no'] : implode(",", $_POST['chk']);
			$arr['msg'] = "이미 삭제된 정보입니다.";
			$arr['move'] = $nf_util->page_back();
			if ($nos) {
				$_where = " and `mno`=" . intval($member['no']);
				if (admin_id && strpos($nf_util->page_back(), "/nad/") !== false)
					$_where = "";
				$delete = $db->_query("delete from nf_scrap where `no` in (" . $nos . ") and `code`=?" . $_where, array($_POST['code']));
				$arr['msg'] = "삭제가 완료되었습니다.";
			}
		}
		die(json_encode($arr));
		break;

	case "delete_select_read":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$nos = implode(",", $_POST['chk']);
			$arr['msg'] = "이미 삭제된 정보입니다.";
			$arr['move'] = $nf_util->page_back();
			if ($nos) {
				$query = $db->_query("select * from nf_read where `no` in (" . $nos . ") and `mno`=? and `code`=?", array($member['no'], $_POST['code']));
				while ($row = $db->afetch($query)) {
					$delete = $db->_query("delete from nf_read where `pno`=? and `mno`=? and `code`=?", array($row['pno'], $row['mno'], $row['code']));
				}
				$arr['msg'] = "삭제가 완료되었습니다.";
			}
		}
		die(json_encode($arr));
		break;

	case "delete_company_info":
	case "delete_select_company_info":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$nos = $_POST['no'];
			if ($_POST['mode'] == 'delete_select_company_info' && admin_id)
				$nos = implode(",", $_POST['chk']);
			$arr['msg'] = "이미 삭제된 정보입니다.";
			$arr['move'] = $nf_util->page_back();
			if ($nos) {
				$_where = " and `mno`=" . intval($member['no']);
				if (admin_id)
					$_where = "";
				$query = $db->_query("select * from nf_member_company where `no` in (" . $nos . ") and `is_public`=0 " . $_where);
				while ($row = $db->afetch($query)) {
					//if(is_file(NFE_PATH.'/data/member/'.$row['mb_logo'])) unlink(NFE_PATH.'/data/member/'.$row['mb_logo']);
					$delete = $db->_query("update nf_member_company set `is_delete`=1 where `no`=" . intval($row['no']));
				}
				$arr['msg'] = "삭제가 완료되었습니다.";
			}
		}
		die(json_encode($arr));
		break;

	// : 입사지원 삭제
	case "delete_accept_pmno":
	case "delete_select_accept_pmno":
	case "delete_accept_mno":
	case "delete_select_accept_mno":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$nos = $_POST['no'];
			$mode_arr = explode("_", $_POST['mode']);
			$mno_field = array_pop($mode_arr);
			if (strpos($_POST['mode'], '_select_') !== false)
				$nos = implode(",", $_POST['chk']);
			$query = $db->_query("select * from nf_accept where `no` in (" . $nos . ") and `" . $mno_field . "`=" . intval($member['no']));

			$delete_field = $mno_field == 'pmno' ? 'pdel' : 'del';
			while ($accept_row = $db->afetch($query)) {
				// : 본인이 제의나 지원하고 삭제나 취소누르면 데이터삭제입니다.
				$delete = $db->_query("update nf_accept set " . $delete_field . "=1 where `no`=?", array($accept_row['no'])); // - 디비삭제안하고 한다면 이거로 사용
				$arr['msg'] = $member['mb_type'] == 'individual' ? "입사지원 취소가 완료되었습니다." : "입사제의가 취소되었습니다.";
				if ($delete_field == 'pdel')
					$arr['msg'] = "삭제가 완료되었습니다.";
			}
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;

	// : 담당자정보 삭제
	case "delete_manager":
	case "delete_select_manager":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$nos = $_POST['mode'] == 'delete_manager' ? $_POST['no'] : implode(",", $_POST['chk']);
			$arr['msg'] = "이미 삭제된 정보입니다.";
			$arr['move'] = $nf_util->page_back();
			if ($nos) {
				$delete = $db->_query("delete from nf_manager where `no` in (" . $nos . ") and `mno`=?", array($member['no']));
				$arr['msg'] = "삭제가 완료되었습니다.";
			}
		}
		die(json_encode($arr));
		break;
	//################## 삭제 ##################//

	## : 구인구직정보 ############################################






	## : 기본 정보 ############################################
	case "click_tab_login":
		switch ($_POST['mb_type']) {
			case "individual":
				$arr['js'] = '
				var form = document.forms["flogin"];
				$(form).find("[name=\'mid\']").val("indi01");
				$(form).find("[name=\'passwd\']").val("indi01");
				';
				break;

			default:
				$arr['js'] = '
				var form = document.forms["flogin"];
				$(form).find("[name=\'mid\']").val("company1");
				$(form).find("[name=\'passwd\']").val("company1");
				';
				break;
		}
		die(json_encode($arr));
		break;
	// : 로그인
	case "login_process":
		$arr = array();
		$_val = array();
		$_val['mb_id'] = $_POST['mid'];
		$_val['mb_password'] = md5($_POST['passwd']);
		$_val['mb_type'] = $_POST['kind'];
		$q = $db->query_q($_val);
		$mem_row = $db->query_fetch("select * from nf_member where `mb_id`=? and `mb_password`=? and `mb_type`=? and `mb_left_request`=0 and `mb_left`=0 and `is_delete`=0", $_val);
		if (!$mem_row) {
			$arr['msg'] = "등록된 아이디를 찾을 수 없습니다.\\n아이디를 확인해주세요.";
		}
		if ($mem_row['mb_badness']) {
			$arr['msg'] = "고객님은 임시적으로 로그인을 할수 없습니다.\\n자세한 사항은 관리자에게 문의 해주세요.";
		}

		$arr['move'] = $nf_util->page_back();
		if (!$arr['msg']) {
			if ($_POST['save_id']) {
				$save_id = $nf_util->Encrypt($mem_row['mb_id']);
				$nf_util->cookie_save("save_id", $save_id, "yes", "1 month");
			}
			$nf_member->login($mem_row['no']);
			$arr['move'] = urldecode($_POST['url']);
			if (strpos($arr['move'], '/member/login.php') !== false || strpos($arr['move'], '/regist.php') !== false)
				$arr['move'] = main_page;
		}
		if ($env['login_return'] === '1')
			$arr['move'] = main_page;
		if ($env['login_return'] === '2')
			$arr['move'] = stripslashes($env['login_return_page']);

		die($nf_util->move_url($arr['move'], $arr['msg']));
		break;


	############### 결제관련 ################
	// : 가격 가져오기
	case "click_service":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";

			$use_point = intval(strtr($_POST['use_point'], array(',' => '')));
			if ($use_point > 0) {
				if ($member['mb_point'] < $use_point) {
					$arr['msg'] = "포인트는 " . number_format(intval($member['mb_point'])) . "p까지 사용 가능합니다.";
					$arr['js'] = '
					form.use_point.value = "";
					nf_payment.click_service_func();
					';
				}
			}

			if (!$arr['msg']) {
				$arr['price_hap'] = 0;
				$post_service = $_POST['service'];
				$post_arr = $_POST;
				$load_db_price = true;
				ob_start();
				include NFE_PATH . '/include/payment/service.inc.php';
				$arr['tag'] = ob_get_clean();

				$price_result = $arr['price_hap'] - $use_point;
				if ($use_point > $arr['price_hap'])
					$price_result = 0;

				$arr['js'] = '
				$(".click_service_list-").html(data.tag);
				if($(".price-hap-")[0]) $(".price-hap-").html("' . number_format(intval($arr['price_hap'])) . '");
				if($(".price-result-")[0]) $(".price-result-").html("' . number_format(intval($price_result)) . '");
				';

				if ($use_point > $arr['price_hap']) {
					$arr['js'] = '
					form.use_point.value = "' . number_format(intval($arr['price_hap'])) . '";
					if($(".price-result-")[0]) $(".price-result-").html(' . number_format(intval($price_result)) . ');
					';
				}

				$pay_method_tag = $price_result <= 0 ? 'none' : 'block';
				$arr['js'] .= '
					$(".pay-method-p").each(function(){
						var tagname = $(this)[0].tagName;
						var display = "' . $pay_method_tag . '";
						if(display=="none") $(this).css({"display":"none"});
						else {
							if(tagname=="TR") display = "table-row";
							if(tagname=="TABLE") display = "table";
							$(this).css({"display":display});
						}
					});
				';
			}
		}
		die(json_encode($arr));
		break;

	case "payment_start":
		$arr['msg'] = "로그인하셔야 이용 가능합니다.";
		$arr['move'] = NFE_URL . "/member/login.php?url=" . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";

			// : 무통장입금시 sms
			if ($_POST['pay_methods'] == 'bank') {
				$sms_arr = array();
				$sms_arr['phone'] = $member['mb_hphone'];
				$sms_arr['name'] = $member['mb_name'];
				$nf_sms->send_sms_online_pay_process($sms_arr);
			}

			// : 포인트체크
			$use_point = intval(strtr($_POST['use_point'], array(',' => '')));
			if ($use_point > 0) {
				if ($member['mb_point'] < $use_point) {
					$arr['msg'] = "포인트는 " . number_format(intval($member['mb_point'])) . "p까지 사용 가능합니다.";
					$arr['js'] = '
					form.use_point.value = "";
					nf_payment.click_service_func();
					';
					die(json_encode($arr));
				}
			}

			$price_hap = 0;
			$service_arr = array();

			if (!$_POST['code'])
				$_POST['code'] = $member['mb_type'] == 'company' ? 'employ' : 'resume';

			switch ($_POST['code']) {
				case "employ":
				case "resume":
				case "read":
				case "jump":
					if (is_array($_POST['service'])) {
						foreach ($_POST['service'] as $k => $v) {
							if (is_array($v)) {
								foreach ($v as $k2 => $v2) {
									switch ($k2) {
										case "package":
											$price_row = $db->query_fetch("select * from nf_service_package where `wr_type`=? and `wr_use`=1 and `no`=?", array($k, $v2));
											$price_hap += $price_row['wr_price'];
											$service_k = $k . '_package';
											$price_arr[$service_k] = $price_row;
											$service_arr[$service_k] = $service_k;
											break;

										default:
											$price_row = $db->query_fetch("select * from nf_service_price where `code`=? and `type`=? and `no`=?", array($k, $k2, $v2));
											$price_hap += $nf_util->get_sale($price_row['service_percent'], $price_row['service_price']);
											$service_k = $price_row['code'] . '_' . $price_row['type'];
											$price_arr[$service_k] = $price_row;
											$service_arr[$service_k] = $service_k;
											break;
									}
								}
							}
						}
					}
					break;


				case "direct":
					$price_hap = intval(strtr($_POST['price'], array(',' => '')));
					$service_arr[] = $_POST['content'];
					$price_arr = array();
					break;
			}

			// : 결제금액보다 포인트가 더 높은경우는 결제금액만큼
			if ($use_point > $price_hap)
				$use_point = $price_hap;
			$price_result = $price_hap - $use_point;

			// : 주문번호 초기화 - 결제하기 버튼누를때 생성합니다.
			$pay_oid = $_POST['code'] . '_' . $_POST['no'] . '_' . time();

			$pay_row = $db->query_fetch("select * from nf_payment where `pay_oid`=? and pay_mno=?", array($pay_oid, $member['no']));

			$_val = array();
			$_val['pay_no'] = $_POST['no'];
			$_val['pay_oid'] = $pay_oid;
			$_val['pay_type'] = $_POST['code'];
			$_val['pay_pg'] = $nf_payment->pg;
			$_val['pay_method'] = $_POST['pay_methods'];
			$_val['pay_mno'] = $member['no'];
			$_val['pay_uid'] = $member['mb_id'];
			$_val['pay_name'] = $member['mb_name'];
			$_val['pay_phone'] = $member['mb_hphone'] ? $member['mb_hphone'] : $member['mb_phone'];
			$_val['pay_email'] = $member['mb_email'];
			$_val['pay_price'] = $price_hap;
			$_val['pay_dc'] = $use_point;
			$_val['pay_bank'] = $_POST['depositor'];
			$_val['pay_bank_name'] = $_POST['bank'];
			$_val['pay_wdate'] = today_time;
			$_val['pay_service'] = implode(",", $service_arr);
			$_val['tax_status'] = $_POST['tax_use'] ? 1 : 0;
			$_val['post_text'] = serialize($_POST);
			$_val['price_text'] = serialize($price_arr);
			$q = $db->query_q($_val);
			if ($pay_row)
				$query = $db->_query("update nf_payment set " . $q . " where `no`=" . intval($pay_row['no']), $_val);
			else
				$query = $db->_query("insert into nf_payment set " . $q, $_val);

			$pay_no = $pay_row['no'] ? $pay_row['no'] : $db->last_id();

			// : 무료인경우 [ 포인트를 다 사용한 경우 ]
			if ($price_result <= 0) {
				include NFE_PATH . '/engine/function/payment.function.php';
				$pay_row = $db->query_fetch("select * from nf_payment where `no`=?", array($pay_no));
				payment_process($pay_row, 1);
			}

			// : 포인트를 사용하면서 무통장이거나 무료로 결제시
			if ($use_point > 0 && ($_POST['pay_methods'] == 'bank' || $price_result <= 0)) {
				$point_arr = array();
				$point_arr['member'] = $member;
				$point_arr['code'] = $nf_job->pay_service_arr[$_POST['code']] . '서비스 결제 무통장 신청';
				$point_arr['use_point'] = -$use_point;
				$point_arr['rel_id'] = $pay_no;
				$point_arr['rel_action'] = $_POST['code'];
				$point_arr['rel_table'] = 'nf_payment';
				if ($query)
					$nf_point->insert($point_arr);
			}

			// : 무통장이나 무료
			if ($_POST['pay_methods'] == 'bank' || $price_result <= 0) {
				$arr['move'] = NFE_URL . "/service/payment_complete.php?no=" . $pay_no;

				// : 결제
			} else {
				$nf_payment->pg_config();

				$pay_arr['price'] = $price_hap;
				$pay_arr['mb_name'] = $member['mb_name'];
				$pay_arr['mb_phone'] = $member['mb_hphone'] ? $member['mb_hphone'] : $member['mb_phone'];
				$pay_arr['mb_email'] = $member['mb_email'];
				$pay_arr['pno'] = $pay_no;
				$pay_arr['gname'] = $nf_job->pay_service_arr[$_POST['code']];
				$pay_arr['pay_oid'] = $pay_oid;
				$arr = $nf_payment->pg_start($pay_arr);
			}
		}
		die(json_encode($arr));
		break;

	case "payment_process":
		$nf_payment->pg_config();
		$pno = $_POST['pno'];

		switch ($nf_payment->pg) {
			case "toss":
				$pay_row = $db->query_fetch("select * from nf_payment where `pay_oid`=?", array($_POST['orderId']));
				$_POST['pno'] = $pay_no = $pay_row['no'];
				break;

			default:
				$pay_row = $db->query_fetch("select * from nf_payment where `no`=" . intval($_POST['pno']));
				break;
		}

		// : 결제완료된 경우 처리하지 않게 하기
		if ($pay_row['pay_status']) {
			die($nf_util->move_url("이미 결제된 정보입니다.", NFE_URL . "/"));
		}

		$post_unse = $nf_util->get_unse($pay_row['post_text']);

		$pg_price = $_POST[$nf_payment->pg_price_arr[$nf_payment->pg]];

		if ($pay_row['pay_price'] != $pg_price) {
			$arr['msg'] = "정상적인 방식으로 결제해주시기 바랍니다.";
			$arr['move'] = "/";
			if (is_mobile)
				$arr['move'] = "/m/";
		} else {
			include NFE_PATH . '/engine/function/payment.function.php';

			$pg_process = false;
			switch ($nf_payment->pg) {
				case "kcp":
					$price = $pay_row['pay_price'];
					include NFE_PATH . "/plugin/PG/kcp/kcp_api_pay.php";
					break;

				case "nicepay":
					$price = $pay_row['pay_price'];
					include NFE_PATH . "/plugin/PG/nicepay/payResult_utf.php";
					break;

				case "toss":
					$data = array(
						'paymentKey' => $_GET['paymentKey'],
						'orderId' => $_POST['orderId'],
						'amount' => intval($pay_row['pay_price']),
					);

					$headers = array(
						"Authorization: Basic dGVzdF9za196WExrS0V5cE5BcldtbzUwblgzbG1lYXhZRzVSOg==",
						"Content-Type: application/json",
					);

					$url = "https://api.tosspayments.com/v1/payments/confirm";
					$ch = curl_init();                                 //curl 초기화
					curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
					curl_setopt($ch, CURLOPT_HEADER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));       //POST data
					curl_setopt($ch, CURLOPT_POST, true);              //true시 post 전송 
					$response = curl_exec($ch);

					$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
					$header = substr($response, 0, $header_size);
					$body = substr($response, $header_size);
					$body_decode = json_decode($body, true);

					curl_close($ch);

					if ($body_decode['mId']) {
						payment_process($pay_row, 1);
						$nf_payment->pg_process($pay_row, $body_decode);
						$pg_process = true;
					}
					break;
			}

			if ($pg_process === true) {
				$arr['msg'] = "";
				$arr['move'] = NFE_URL . "/service/payment_complete.php?no=" . $_POST['pno'];
			} else {
				$arr['msg'] = "결제가 실패되었습니다.\\n관리자에게 문의해주시기 바랍니다.";
				$arr['move'] = NFE_URL . "/";
			}
		}

		die($nf_util->move_url($arr['move'], $arr['msg']));

		break;
	############### 결제관련 ################

	case "cs_center_write":
		$recaptcha_allow = $nf_util->recaptcha_check();
		if (!$recaptcha_allow['success']) {
			die($nf_util->move_url($recaptcha_allow['move'], $recaptcha_allow['msg']));
		}

		// 회원이 아닐 경우 자동등록방지 확인
		$arr = $nf_util->captcha_key_check();
		if (!$arr['msg']) {
			$_val = array();
			$_val['wr_type'] = intval($_POST['type']);
			$_val['wr_cate'] = $_POST['wr_cate'];
			$_val['wr_id'] = $member['mb_id'];
			$_val['mno'] = $member['no'];
			$_val['wr_name'] = $_POST['wr_name'];
			//$_val['wr_biz'] = $_POST['sdfd'];
			$_val['wr_biz_name'] = $_POST['wr_biz_name']; // : 업소명
			//$_val['wr_biz_type'] = $_POST['sdfd'];
			$_val['wr_email'] = implode("@", $_POST['wr_email']);
			$_val['wr_phone'] = implode("-", $_POST['wr_phone']);
			$_val['wr_hphone'] = implode("-", $_POST['wr_hphone']);
			$_val['wr_site'] = $_POST['wr_site'];
			$_val['wr_subject'] = $_POST['wr_subject'];
			$_val['wr_content'] = $_POST['wr_content'];
			$_val['wr_date'] = today_time;
			$_val['wr_ip'] = $_SERVER['REMOTE_ADDR'];
			$q = $db->query_q($_val);

			$query = $db->_query("insert into nf_cs set " . $q, $_val);
			$arr['msg'] = "등록이 완료되었습니다.";
			$arr['move'] = main_page;
		}
		die($nf_util->move_url($arr['move'], $arr['msg']));
		break;

	case "get_category_list":
		$cate_table = 'nf_category';
		if ($_POST['wr_type'] == 'area')
			$cate_table = 'nf_area';

		$row = $db->query_fetch("select * from " . $cate_table . " where `no`=" . intval($_POST['no']));
		$query = $db->_query("select * from " . $cate_table . " where `pnos` like ? and wr_view=1 order by wr_rank asc", array($row['pnos'] . $_POST['no'] . ','));
		$tag = "";
		if ($row['wr_type'] == 'area' && strpos($nf_util->page_back(), "resume") !== false)
			$tag = '<option value="all">전체</option>';
		ob_start();
		while ($row = $db->afetch($query)) {
			$value = $_POST['wr_type'] == 'area' ? $row['wr_name'] : intval($row['no']);
			?>
			<option value="<?php echo $value; ?>" no="<?php echo intval($row['no']); ?>"><?php echo $row['wr_name']; ?></option>';
			<?php
		}
		$arr['tag'] = $tag . ob_get_clean();
		$arr['js'] = '
		$(obj).eq(num).html(\'<option value="">\'+first_txt+\'</option>\'+data.tag);
		';
		die(json_encode($arr));
		break;

	case "check_uid":
		$_where = "";
		$arr['msg'] = "";
		$val = trim($_POST['val']);
		$check_id = $db->query_fetch("select * from nf_member where `mb_id`=?", array($val));
		if (!preg_match("/^[a-z]/i", $val) || preg_match("/[^a-z0-9]/i", $val) || strlen($val) < 5 || strlen($val) > 20)
			$arr['msg'] = "영문자로 시작하는 5~20자의 영문 소문자와 숫자의 조합만 사용할 수 있습니다.";
		if ($check_id['mb_id'])
			$arr['msg'] = "이미 사용중인 아이디입니다. ssss";
		if (!$_POST['val'])
			$arr['msg'] = "아이디를 입력해주시기 바랍니다.";
		if (!$arr['msg']) {
			$arr['msg'] = "사용가능한 아이디입니다.";
			$arr['js'] = '
			$(".check_mb_id-").val("1");
			';
		} else {
			$arr['js'] = '
			$("#"+id).val("");
			';
		}
		die(json_encode($arr));
		break;

	case "check_nick":
		$_where = "";
		$arr['msg'] = "";
		$val = trim($_POST['val']);
		$check_nick = $db->query_fetch("select * from nf_member where `mb_nick`=?", array($val));

		$get_member = $member;
		if (strpos($nf_util->page_back(), '/nad/') !== false)
			$get_member = $nf_member->get_member($_POST['mno']);

		if ($check_nick['mb_nick'])
			$arr['msg'] = "Vui lòng thay đổi biệt hiệu của bạn vì nó trùng lặp
		";
		if (!$_POST['val'])
			$arr['msg'] = "닉네임을 입력해주시기 바랍니다.";
		if ($get_member['no'] && $get_member['mb_nick'] == $check_nick['mb_nick'])
			$arr['msg'] = ""; // : 본인 닉네임인경우
		if (!$arr['msg']) {
			$arr['msg'] = "Vui lòng thay đổi biệt hiệu của bạn vì nó trùng lặp
			";
			$arr['js'] = '
			$(".check_mb_nick-").val("1");
			';
		} else {
			$arr['js'] = '
			$("#"+id).val("");
			';
		}
		die(json_encode($arr));
		break;

	case "password_modify":
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['move'] = "";
			$arr['move'] = "";
			if ($_POST['passwd'] != $_POST['ch_passwd'])
				$arr['msg'] = "새로운 비밀번호 확인을 정확히 입력해주세요.";
			if (!$nf_util->check_word($_POST['passwd'], 2))
				$arr['msg'] = "5~20자 사이의 영문, 숫자, 특수문자중 최소 2가지 이상 조합으로 입력해주세요.";
			else {
				$check_passwd = $db->query_fetch("select * from nf_member where `no`=? and `mb_password`=?", array($member['no'], md5($_POST['this_passwd'])));
				if (!$check_passwd)
					$arr['msg'] = "현재 비밀번호를 정확히 입력해주세요.";
				else {
					$update = $db->_query("update nf_member set `mb_password`=? where `no`=?", array(md5($_POST['passwd']), $member['no']));
					$arr['msg'] = "비밀번호 변경이 완료되었습니다.";
					$arr['move'] = "/";
				}
			}
		}
		die(json_encode($arr));
		break;

	case "member_write":
	case "member_modify":
		if (!$_include) {
			$recaptcha_allow = $nf_util->recaptcha_check();
			if (!$recaptcha_allow['success']) {
				die(json_encode($recaptcha_allow));
			}
		}

		$admin_page = false;
		$mem_row = "";
		$get_member = $member; // : 로그인회원
		$mb_id = $get_member['mb_id'];
		if (strpos($nf_util->page_back(), '/nad/') !== false) {
			$admin_page = true;
			$mb_id = $_POST['mb_id'];
		}
		if (strpos($nf_util->page_back(), '/nad/') !== false && $_POST['mno']) {
			$nf_member->get_member($_POST['mno']); // : 관리자 수정회원
			$get_member = $nf_member->member_arr[$_POST['mno']];
			$mb_id = $get_member['mb_id'];
		}
		if (!sess_user_uid && strpos($nf_util->page_back(), '/nad/') === false)
			$mb_id = $_POST['mb_id'];

		// : 아이디체크
		if (!$mem_row)
			$mem_row = $db->query_fetch("select * from nf_member where `mb_id`=?", array($mb_id));
		$is_sns_member_update = $mem_row['mb_is_sns'] && $mem_row['mb_type'] ? true : false; // : sns가입시 회원수정여부
		if ($mem_row) {
			// : 로그인하지 않는경우 [ 회원가입인경우 ]
			if (!sess_user_uid && !admin_id) {
				$arr['msg'] = "중복된 아이디가 있습니다.";
				$arr['move'] = $nf_util->page_back();
			} else {
				if (!$admin_page && !$_POST['mb_password'] && !$get_member) {
					$arr['msg'] = "비밀번호를 입력해주시기 바랍니다.";

					// : sns가입은 비밀번호입력이 필요없으므로 아래 if문을 사용하지 않습니다.
				} else if (!$admin_page && md5($_POST['mb_password']) != $mem_row['mb_password'] && !in_array($prev_mode, array('sns_login_process')) && !$mem_row['mb_is_sns']) {
					$arr['msg'] = "비밀번호를 정확히 입력해주시기 바랍니다.";

				} else {
					if ($mem_row['mb_type'])
						$_POST['mb_type'] = $mem_row['mb_type'];
				}
			}
		}

		if ($_POST['mb_type']) {
			$_ex_where = $_POST['mb_type'] == 'company' ? " and `is_public`=1" : "";
			$mem_ex_row = $db->query_fetch("select * from nf_member_" . $_POST['mb_type'] . " where `mb_id`=?" . $_ex_where, array($mb_id));
		}

		// : 아이디와 닉네임체크
		if ($_POST['mb_id'] && !in_array($prev_mode, array('sns_login_process'))) {
			if (!$arr['msg']) {
				$check_nick = $db->query_fetch("select * from nf_member where `mb_nick`=?", array($_POST['mb_nick']));
				if ($check_nick['mb_nick'] && $get_member['mb_nick'] != $check_nick['mb_nick'])
					$arr['msg'] = "이미 사용중인 닉네임입니다.";
				if (!$mem_row && !$_POST['mb_nick'])
					$arr['msg'] = "닉네임을 입력해주시기 바랍니다.";

				if ($check_nick['mb_id'] && $get_member['mb_id'] != $check_nick['mb_id'])
					$arr['msg'] = "Vui lòng thay đổi biệt hiệu của bạn vì nó trùng lặp";
				if (!$mem_row && !$_POST['mb_id'])
					$arr['msg'] = "아이디를 입력해주시기 바랍니다.";
			}
		}

		$upload_allow = $nf_util->filesize_check($_FILES['mb_photo']['size']);
		if (!$upload_allow) {
			$mb_photo_tmp = $_FILES['mb_photo']['tmp_name'];
			if ($mb_photo_tmp) {
				$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
				$ext = $nf_util->get_ext($_FILES['mb_photo']['name']);
				if (in_array($ext, $nf_util->photo_ext)) {
					$mb_photo = $dir_arr['date'] . '/photo_' . time() . "." . $ext;
					$nf_util->make_thumbnail($mb_photo_tmp, NFE_PATH . $dir_arr['dir'] . $mb_photo, 140, 170);
					if (is_file(NFE_PATH . $dir_arr['dir'] . $get_member['mb_photo']))
						unlink(NFE_PATH . $dir_arr['dir'] . $get_member['mb_photo']);
				} else {
					$arr['msg'] = '사진은 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
					$arr['move'] = $nf_util->page_back();
					die(json_encode($arr));
				}
			}
		}

		$upload_allow = $nf_util->filesize_check($_FILES['mb_logo']['size']);
		if (!$upload_allow) {
			$mb_logo_tmp = $_FILES['mb_logo']['tmp_name'];
			if ($mb_logo_tmp) {
				$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
				$ext = $nf_util->get_ext($_FILES['mb_logo']['name']);
				if (in_array($ext, $nf_util->photo_ext)) {
					$mb_logo = $dir_arr['date'] . '/logo_' . time() . "." . $ext;
					$nf_util->make_thumbnail($mb_logo_tmp, NFE_PATH . $dir_arr['dir'] . $mb_logo, 140, 170);
					if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_logo']))
						unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_logo']);
				} else {
					$arr['msg'] = '로고는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
					$arr['move'] = $nf_util->page_back();
					die(json_encode($arr));
				}
			}
		}

		$mb_biz_attach_tmp = $_FILES['mb_biz_attach']['tmp_name'];
		if ($mb_biz_attach_tmp) {
			$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
			$ext = $nf_util->get_ext($_FILES['mb_biz_attach']['name']);
			if (in_array($ext, $nf_util->photo_ext)) {
				$mb_biz_attach = $dir_arr['date'] . '/biz_' . time() . "." . $ext;
				$nf_util->make_thumbnail($mb_biz_attach_tmp, NFE_PATH . $dir_arr['dir'] . $mb_biz_attach, 1000);
				if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_biz_attach']))
					unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_biz_attach']);
			} else {
				$arr['msg'] = '사업자등록증 파일은 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
				$arr['move'] = $nf_util->page_back();
				die(json_encode($arr));
			}
		}

		$upload_allow = $nf_util->filesize_check($_FILES['mb_img1']['size']);
		if (!$upload_allow) {
			$mb_img1_tmp = $_FILES['mb_img1']['tmp_name'];
			if ($mb_img1_tmp) {
				$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
				$ext = $nf_util->get_ext($_FILES['mb_img1']['name']);
				if (in_array($ext, $nf_util->photo_ext)) {
					$mb_img1 = $dir_arr['date'] . '/img1_' . time() . "." . $ext;
					$nf_util->make_thumbnail($mb_img1_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img1, 286, 160);
					if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img1']))
						unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img1']);
				} else {
					$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
					$arr['move'] = $nf_util->page_back();
					die(json_encode($arr));
				}
			}
		}
		$upload_allow = $nf_util->filesize_check($_FILES['mb_img2']['size']);
		if (!$upload_allow) {
			$mb_img2_tmp = $_FILES['mb_img2']['tmp_name'];
			if ($mb_img2_tmp) {
				$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
				$ext = $nf_util->get_ext($_FILES['mb_img2']['name']);
				if (in_array($ext, $nf_util->photo_ext)) {
					$mb_img2 = $dir_arr['date'] . '/img2_' . time() . "." . $ext;
					$nf_util->make_thumbnail($mb_img2_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img2, 286, 160);
					if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img2']))
						unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img2']);
				} else {
					$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
					$arr['move'] = $nf_util->page_back();
					die(json_encode($arr));
				}
			}
		}
		$upload_allow = $nf_util->filesize_check($_FILES['mb_img3']['size']);
		if (!$upload_allow) {
			$mb_img3_tmp = $_FILES['mb_img3']['tmp_name'];
			if ($mb_img3_tmp) {
				$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
				$ext = $nf_util->get_ext($_FILES['mb_img3']['name']);
				if (in_array($ext, $nf_util->photo_ext)) {
					$mb_img3 = $dir_arr['date'] . '/img3_' . time() . "." . $ext;
					$nf_util->make_thumbnail($mb_img3_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img3, 286, 160);
					if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img3']))
						unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img3']);
				} else {
					$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
					$arr['move'] = $nf_util->page_back();
					die(json_encode($arr));
				}
			}
		}
		$upload_allow = $nf_util->filesize_check($_FILES['mb_img4']['size']);
		if (!$upload_allow) {
			$mb_img4_tmp = $_FILES['mb_img4']['tmp_name'];
			if ($mb_img4_tmp) {
				$dir_arr = $nf_util->get_dir_date('member', $mem_row['mb_wdate']);
				$ext = $nf_util->get_ext($_FILES['mb_img4']['name']);
				if (in_array($ext, $nf_util->photo_ext)) {
					$mb_img4 = $dir_arr['date'] . '/img4_' . time() . "." . $ext;
					$nf_util->make_thumbnail($mb_img4_tmp, NFE_PATH . $dir_arr['dir'] . $mb_img4, 286, 160);
					if (is_file(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img4']))
						unlink(NFE_PATH . $dir_arr['dir'] . $mem_ex_row['mb_img4']);
				} else {
					$arr['msg'] = '업소이미지는 ' . implode(", ", $nf_util->photo_ext) . '확장자만 허용합니다.';
					$arr['move'] = $nf_util->page_back();
					die(json_encode($arr));
				}
			}
		}

		if (!$arr['msg']) {
			// : 기본 회원 테이블
			$_val = array();
			$_val2 = array();

			if (!$mem_row) {
				$_val['mb_id'] = $mb_id;
				$_val['mb_level'] = $_POST['mb_level'] && $is_admin ? $_POST['mb_level'] : $env['member_point_arr']['register_level'];
				if (in_array($prev_mode, array('sns_login_process')))
					$_val['mb_is_sns'] = $_POST['engine'];
			}

			if (!$mem_row['mb_type'] && $_POST['mb_type']) {
				$_val['mb_type'] = $_POST['mb_type'];
			}

			if ((!$mem_row || admin_id) && trim($_POST['mb_password']))
				$_val['mb_password'] = md5($_POST['mb_password']);
			$_val['mb_sms'] = @in_array('sms', $_POST['mb_receive']) ? 1 : 0;
			$mb_name = $_val['mb_name'] = $_POST['mb_name'];
			$_val['mb_nick'] = $_POST['mb_nick'];
			$_val['mb_email'] = @implode("@", $_POST['mb_email']);
			$_val['mb_email_view'] = @in_array('email', $_POST['mb_receive']) ? 1 : 0;
			$_val['mb_phone'] = $_POST['mb_phone'];
			$mb_hphone = $_val['mb_hphone'] = $_POST['mb_hphone'];
			$_val['mb_message_view'] = @in_array('message', $_POST['mb_receive']) ? 1 : 0;
			$_val['mb_receive'] = @implode(",", $_POST['mb_receive']);
			$_val['mb_zipcode'] = $_POST['mb_zipcode'];
			$_val['mb_address0'] = $_POST['mb_address0'];
			$_val['mb_address1'] = $_POST['mb_address1'];
			$_val['mb_homepage'] = $nf_util->get_domain($_POST['mb_homepage']);
			$_val['mb_udate'] = today_time;
			if (trim($_POST['mb_memo']))
				$_val['mb_memo'] = $_POST['mb_memo'];
			if ($mb_photo)
				$_val['mb_photo'] = $mb_photo;

			if (trim($_POST['mb_birth']))
				$_val['mb_birth'] = $_POST['mb_birth'];
			if (trim($_POST['mb_gender']))
				$_val['mb_gender'] = $_POST['mb_gender'];

			if (!$mem_row) {
				$_val['mb_point'] = intval($mb_point);
				$_val['mb_wdate'] = today_time;
				$_val['mb_login_count'] = 1;
				$_val['mb_last_login'] = today_time;

				if (strpos($_SERVER['PHP_SELF'], '/nad/') !== false)
					$_val['is_admin'] = 1;

				if ($_SESSION['certify_info']) {
					if (!$db->is_field('nf_member', 'mb_auth_di'))
						$db->_query("alter table nf_member add mb_auth_di varchar(255) comment '실명인증 DI'");
					if (!$db->is_field('nf_member', 'mb_auth_ci'))
						$db->_query("alter table nf_member add mb_auth_ci varchar(255) comment '실명인증 CI'");
					$_val['mb_auth_di'] = $_SESSION['certify_info']['4'];
					$_val['mb_auth_ci'] = $_SESSION['certify_info']['5'];
				}
			}

			$_val['mb_foreigner'] = "";
			$_val['mb_phone_view'] = "";
			$_val['mb_hphone_view'] = "";
			$_val['mb_address_road'] = "";
			$_val['mb_address_view'] = "";
			$_val['mb_homepage_view'] = "";
			$_val['is_adult'] = $_POST['mb_birth'] && $nf_util->is_adult($_POST['mb_birth']) ? 1 : 0;

			$q = $db->query_q($_val);

			if ($mem_row) {
				$mno = $mem_row['no'];
				$query = $db->_query("update nf_member set " . $q . " where `no`=" . intval($mno), $_val);
			} else {
				$query = $db->_query("insert into nf_member set " . $q, $_val);
				$mno = $db->last_id();
				$query = $db->_query("insert into nf_member_service set `mno`=?, `mb_id`=?", array($mno, $_val['mb_id']));

				$register_level_point = intval($env['member_level_arr'][intval($env['member_point_arr']['register_level'])]['point']);
				if ($register_level_point > 0) {
					$nf_member->get_member($mno);
					$_point = array();
					$_point['member'] = $nf_member->member_arr[$mno];
					$_point['code'] = '회원가입 활동포인트';
					$_point['use_point'] = $env['member_level_arr'][intval($env['member_point_arr']['register_level'])]['point'];
					$_point['rel_table'] = 'netk_member';
					$_point['rel_id'] = '';
					$_point['rel_action'] = 'member_write';
					$update = $nf_point->insert($_point);
				}

				/*
							if($env['member_point_arr']['register_point']>0) {
								$nf_member->get_member($mno);
								$_point = array();
								$_point['member'] = $nf_member->member_arr[$mno];
								$_point['code'] = '회원가입';
								$_point['use_point'] = $env['member_point_arr']['register_point'];
								$_point['rel_table'] = 'netk_member';
								$_point['rel_id'] = '';
								$_point['rel_action'] = 'member_write';
								$update = $nf_point->insert($_point);
							}
							*/
			}

			// : 관리자가 강제로 포인트를 준경우 활동포인트값 강제초기화
			if ($_POST['mb_level'] && $is_admin && $_POST['mb_level'] != $mem_row['mb_level']) {
				$update = $db->_query("update nf_member set `mb_level`=" . intval($_POST['mb_level']) . ", `mb_add_point`=" . intval($env['member_level_arr'][intval($_POST['mb_level'])]['point']) . " where `no`=" . intval($mem_row['no']));
			}

			// : 회원종류관련
			if ($_POST['mb_type']) {
				if ($_POST['mb_type'] == 'company') {
					$_val2 = array();
					include NFE_PATH . '/engine/function/mb_type_company.query.php';
					if ($mem_ex_row) {
						$query = $db->_query("update nf_member_company set " . $q2 . " where `is_public`=1 and `mno`=" . intval($mno), $_val2);
					} else {
						$query = $db->_query("insert into nf_member_company set " . $q2, $_val2);
					}
				} else {
					$_val2 = array();
					$_val2['mb_id'] = $mb_id;
					$_val2['mno'] = $mno;
					$q2 = $db->query_q($_val2);

					if ($mem_ex_row) {
						$query = $db->_query("update nf_member_individual set " . $q2 . " where `mno`=" . intval($mno), $_val2);
					} else {
						$query = $db->_query("insert into nf_member_individual set " . $q2, $_val2);
					}
				}
			}

			$msg = $mem_row && $member['mb_type'] && $get_member['mb_id'] ? '회원수정' : '회원등록';
			if (strpos($nf_util->page_back(), "/nad/") !== false)
				$msg = $get_member['mb_id'] ? '회원수정' : '회원등록';
			$arr['msg'] = $msg . '이 완료되었습니다.';

			if (strpos($nf_util->page_back(), '/nad/') !== false) {
				$arr['move'] = './index.php';
				parse_str($_POST['back_page'], $output);
				if (strpos($_POST['back_page'], "/nad/member/index.php") !== false)
					$arr['move'] = $nf_util->sess_page('member_list');
				if (strpos($_POST['back_page'], "/nad/member/bad_list.php") !== false)
					$arr['move'] = $nf_util->sess_page('bad_member_list');
				if (strpos($_POST['back_page'], "/nad/member/individual.php") !== false)
					$arr['move'] = $nf_util->sess_page('individual_list');
				if (strpos($_POST['back_page'], "/nad/member/company.php") !== false)
					$arr['move'] = $nf_util->sess_page('company_list');
				if (strpos($_POST['back_page'], "/nad/member/left_list.php") !== false)
					$arr['move'] = $nf_util->sess_page('left_request_list');
				if (strpos($_POST['back_page'], "/nad/member/left_list.php") !== false && $output['left'])
					$arr['move'] = $nf_util->sess_page('left_list');
				if ($_POST['process'] == 'save_next_write') {
					if ($_POST['mb_type'] == 'company')
						$arr['move'] = NFE_URL . '/nad/member/company_insert.php';
					else
						$arr['move'] = NFE_URL . '/nad/member/individual_insert.php';
				}
			} else {
				if (strpos($nf_util->page_back(), "/member/update_form.php") === false)
					$nf_member->login($mno);
				if ($_POST['mb_type'])
					$arr['move'] = NFE_URL . "/" . $_POST['mb_type'] . "/index.php";

				// : sms 가입시
				if (!$mem_row) {
					$sms_arr['phone'] = $mb_hphone;
					$sms_arr['name'] = $mb_name;
					$nf_sms->send_sms_member_write($sms_arr);

					$email_arr = array();
					$mail_skin = $db->query_fetch("select * from nf_mail_skin where `skin_name`='member_regist'");
					$email_arr['subject'] = "[" . $env['site_name'] . "] 회원가입을 축하합니다.";
					$email_arr['email'] = $_val['mb_email'];
					$email_arr['content'] = strtr(stripslashes($mail_skin['content']), $nf_email->ch_content($_val));
					$nf_email->send_mail($email_arr);

					// : 수정시
				} else {
					$sms_arr['phone'] = $mb_hphone;
					$sms_arr['name'] = $mb_name;
					$nf_sms->send_sms_member_modify($sms_arr);
				}
			}
		}

		if (!in_array($prev_mode, array('sns_login_process'))) {
			die(json_encode($arr));
		} else {
			return false;
		}
		break;

	### : 카테고리 시작 ###############
	case "btn_category":
		$cate_table = 'nf_category';
		if ($_POST['wr_type'] == 'area')
			$cate_table = 'nf_area';

		$cate_row = $db->query_fetch("select * from " . $cate_table . " where `no`=" . intval($_POST['no']));
		$parent_cate_row = $db->query_fetch("select * from " . $cate_table . " where `no`=" . intval($cate_row['pno']));
		$is_adult = $cate_row['wr_adult'] || $parent_cate_row['wr_adult'] ? 'adult' : '';

		if (in_Array($_POST['wr_type'], array('area'))) {
			if (!$cate_row['pno']) {
				$nf_category->get_area($cate_row['wr_name']);
				$__cate_array = $cate_area_array['SI'][$cate_row['wr_name']];
			} else {
				$nf_category->get_area($parent_cate_row['wr_name'], $cate_row['wr_name']);
				$__cate_array = $cate_area_array['GU'][$parent_cate_row['wr_name']][$cate_row['wr_name']];
			}
		} else {
			$__cate_array = $cate_p_array[$cate_row['wr_type']][$_POST['no']];
		}

		$k_int = $_POST['ul_cnt'] == $_POST['num'] + 1 ? '' : ', ' . intval($_POST['num'] + 1);
		ob_start();
		?>
		<li class=""><button type="button" onClick="nf_category.btn_category(this)" no="<?php echo $cate_row['no']; ?>"><input
					type="checkbox"><?php echo $cate_row['wr_name']; ?> 전체</button></li>
		<?php
		$count = 0;
		if (is_array($__cate_array)) {
			foreach ($__cate_array as $k => $v) {
				if ($nf_category->job_part_adult && $_POST['wr_type'] == 'job_part') {
					if ($_POST['code'] == 'adult' && (!$is_adult && !$v['wr_adult']))
						continue;
					if ($_POST['code'] != 'adult' && ($is_adult || $v['wr_adult']))
						continue;
				}
				?>
				<li class=""><button type="button" onClick="nf_category.btn_category(this<?php echo $k_int; ?>)"
						no="<?php echo $v['no']; ?>"><input type="checkbox"><?php echo $v['wr_name']; ?></button></li>
				<?php
				$count++;
			}
		}
		$arr['tag'] = ob_get_clean();
		$arr['count'] = $count;
		$arr['pno'] = $_POST['no'];
		$display = $arr['count'] > 0 ? 'block' : 'none';

		$arr['js'] = '
		$(el).closest(".btn_category-").find("ul").eq(num).html(data.tag);
		$(el).closest(".btn_category-").find("ul").eq(num).css({"display":"' . $display . '"});
		nf_category.put_var_category_on(el, $(el).closest(".btn_category-").find("ul").eq(num));
		';

		die(json_encode($arr));
		break;
	### : 카테고리 끝 ################

	// : 스크랩
	case "scrap":
		$_member_arr = array('employ' => 'individual', 'resume' => 'company');
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['move'] = "";
			if ($_member_arr[$_POST['code']] != $member['mb_type']) {
				$arr['msg'] = $nf_member->mb_type[$_member_arr[$_POST['code']]] . "만 이용 가능합니다.";
			} else {
				$row = $db->query_fetch("select * from nf_scrap where `mno`=? and `pno`=? and `code`=?", array($member['no'], $_POST['no'], $_POST['code']));

				$info_row = $db->query_fetch("select * from nf_" . $_POST['code'] . " where `no`=?", array($_POST['no']));
				$other_member = $db->query_fetch("select * from nf_member where `no`=?", array($info_row['mno']));

				if ($row) {
					$delete = $db->_query("delete from nf_scrap where `no`=" . intval($row['no']));
					$arr['msg'] = "스크랩을 취소했습니다.";
					$arr['js'] = '
					if($(el).find("i")[0]) {
						$(el).find("i").removeClass("axi-star3");
						$(el).find("i").removeClass("scrap");
						$(el).find("i").addClass("axi-star-o");
					}
					';
				} else {
					$_val = array();
					$_val['code'] = $_POST['code'];
					$_val['pno'] = intval($_POST['no']);
					$_val['mno'] = intval($member['no']);
					$_val['mb_id'] = $member['mb_id'];
					$_val['mb_name'] = $member['mb_name'];
					$_val['pmno'] = intval($other_member['no']);
					$_val['pmb_id'] = $other_member['mb_id'];
					$_val['pmb_name'] = $other_member['mb_name'];
					$_val['rdate'] = today_time;
					$q = $db->query_q($_val);
					$insert = $db->_query("insert into nf_scrap set " . $q, $_val);
					$arr['msg'] = "스크랩했습니다.";
					$arr['js'] = '
					if($(el).find("i")[0]) {
						$(el).find("i").removeClass("axi-star-o");
						$(el).find("i").addClass("scrap");
						$(el).find("i").addClass("axi-star3");
					}
					';
				}
			}
		}
		die(json_encode($arr));
		break;

	// : 관심
	case "interest":
		$_member_arr = array('company' => 'individual', 'individual' => 'company');
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['move'] = "";
			if ($_member_arr[$_POST['code']] != $member['mb_type']) {
				$arr['msg'] = $nf_member->mb_type[$_member_arr[$_POST['code']]] . "만 이용 가능합니다.";
			} else {
				$get_member_company = $db->query_fetch("select * from nf_member_company where `no`=" . intval($_POST['no']));
				$row = $db->query_fetch("select * from nf_interest where `mno`=? and `exmno`=? and `code`=?", array($member['no'], $get_member_company['no'], $_POST['code']));

				$arr['msg'] = "업소정보가 없습니다.";
				if ($get_member_company) {
					if ($row) {
						$delete = $db->_query("delete from nf_interest where `no`=" . intval($row['no']));
						$arr['msg'] = "관심업소을 해제했습니다.";
						$arr['js'] = '
						if($(el).find("i")[0]) {
							$(el).find("i").removeClass("axi-heart2");
							$(el).find("i").addClass("axi-heart-o");
						}
						';
						// : 관심업소 페이지에서 해제시에는 새로고침
						if (strpos($nf_util->page_back(), "/individual/favorite_company.php") !== false) {
							$arr['js'] = '
							location.reload();
							';
						}
					} else {
						$_val = array();
						$_val['code'] = $_POST['code'];
						//$_val['pno'] = intval($_POST['no']);
						$_val['exmno'] = $get_member_company['no'];
						$_val['mno'] = intval($member['no']);
						$_val['mb_id'] = $member['mb_id'];
						$_val['pmno'] = intval($get_member_company['mno']);
						$_val['pmb_id'] = $get_member_company['mb_id'];
						$_val['rdate'] = today_time;
						$q = $db->query_q($_val);
						$insert = $db->_query("insert into nf_interest set " . $q, $_val);
						$arr['msg'] = "관심업소으로 등록했습니다.";
						$arr['js'] = '
						if($(el).find("i")[0]) {
							$(el).find("i").removeClass("axi-heart-o");
							$(el).find("i").addClass("axi-heart2");
						}
						';
					}
				}
			}
		}
		die(json_encode($arr));
		break;

	case "get_message_info":
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		$arr['js'] = '';
		if ($member['no']) {
			if ($_POST['no']) {
				switch ($_POST['code']) {
					// : 입사지원에서 쪽지보낼때
					case "accept_my":
					case "accept_you":
						$mno_field = $_POST['code'] == 'accept_my' ? 'mno' : 'pmno';
						$get_mno = $_POST['code'] == 'accept_my' ? 'pmno' : 'mno';
						$row = $db->query_fetch("select * from nf_accept where `no`=? and `" . $mno_field . "`=?", array($_POST['no'], $member['no']));
						$arr['js'] = '
						form.pno.value = "' . intval($row['no']) . '";
						';
						break;

					// : 쪽지리스트에서 보낼때
					default:
						$_where = " and `rdate`='1000-01-01 00:00:00' and `pmno`=" . intval($member['no']);
						if ($_POST['code'] == 'received')
							$_where = " and `pmno`=" . intval($member['no']);
						if ($_POST['code'] == 'send')
							$_where = " and `mno`=" . intval($member['no']);
						$row = $db->query_fetch("select * from nf_message where `no`=" . intval($_POST['no']) . $_where);
						$get_mno = $_POST['code'] == 'send' ? 'pmno' : 'mno';
						break;
				}

				$get_member = $db->query_fetch("select * from nf_member where `no`=" . intval($row[$get_mno]));
				switch ($_POST['code']) {
					// : 입사지원에서 쪽지보낼때
					case "accept":
						$arr['msg'] = "쪽지보낼 권한이 없습니다.";
						break;

					// : 쪽지리스트에서 보낼때
					default:
						$arr['msg'] = "답장 권한이 없습니다.";
						break;
				}
				$arr['move'] = $nf_util->page_back();
			} else {
				$row = array('no' => '');
			}

			if ($row) {
				$arr['msg'] = "";
				$arr['move'] = "";
				$arr['js'] .= '
				nf_util.openWin(".message-");
				if($(".put_nick-")[0]) $(".put_nick-").html("' . $get_member['mb_nick'] . '");
				form.no.value = no;
				';

				if (in_array($_POST['code'], array('page_code', 'received', 'send'))) {
					$arr['js'] .= '
					$(form.nick).val("' . $get_member['mb_nick'] . '");
					';
				}
			}

			if ($row['no']) {
				$arr['js'] .= '
				$(form.nick).attr("disabled", "disabled");
				';
			} else {
				$arr['js'] .= '
				$(form.nick).removeAttr("disabled");
				';
			}
		}
		die(json_encode($arr));
		break;

	// : 쪽지등록
	case "message_write":
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = $nf_util->page_back();
			$row = $db->query_fetch("select * from nf_message where `no`=" . intval($_POST['no']));
			// : 쪽지작성
			if ($_POST['page_code'] != 'input') {
				$info_row = $db->query_fetch("select * from nf_" . $_POST['page_code'] . " where `no`=" . intval($_POST['pno']));
				$get_member = $db->query_fetch("select * from nf_member where `no`=" . intval($info_row['mno']));

				// : 마이페이지 답장이나 쪽지보내기
			} else {
				// : 쪽지보내기
				if ($_POST['nick']) {
					$get_member = $db->query_fetch("select * from nf_member where `no`!=? and `mb_nick`=?", array($member['no'], $_POST['nick']));
					$arr['msg'] = "이 닉네임으로 검색된 회원이 없습니다.";
					if ($member['mb_nick'] == $_POST['nick'])
						$arr['msg'] = "본인에게는 쪽지를 보낼 수 없습니다.";
					if ($get_member) {
						$arr['msg'] = "";
						$arr['move'] = "";
						$info_row['mno'] = $get_member['no'];
						$info_row['wr_id'] = $get_member['mb_id'];
					}
					if ($arr['msg'])
						$arr['move'] = "";
					// : 답장
				} else {
					$get_mno = $_POST['code'] == 'send' ? 'pmno' : 'mno';
					$get_member = $db->query_fetch("select * from nf_member where `no`=" . intval($row[$get_mno]));
					$arr['msg'] = "답장을 보낼 회원이 존재하지 않습니다.";
					if ($get_member) {
						$arr['msg'] = "";
						$info_row['mno'] = $get_member['no'];
						$info_row['wr_id'] = $get_member['mb_id'];
					}
				}
			}
			if (!$arr['msg']) {

				$pmno = $info_row['mno'];
				$pmb_id = $info_row['wr_id'];
				$pmb_nick = $get_member['mb_nick'];
				switch ($_POST['page_code']) {
					case "accept":
						$member_mno = $_POST['code'] == 'send' ? $info_row['pmno'] : $info_row['mno'];
						$get_member = $db->query_fetch("select * from nf_member where `no`=" . intval($member_mno));
						$pmno = $get_member['no'];
						$pmb_id = $get_member['mb_id'];
						$pmb_nick = $get_member['mb_nick'];
						break;
				}

				$_val = array();
				$_val['mno'] = $member['no'];
				$_val['mb_id'] = $member['mb_id'];
				$_val['mb_nick'] = $member['mb_nick'];
				$_val['pmno'] = $pmno;
				$_val['pmb_id'] = $pmb_id;
				$_val['pmb_nick'] = $pmb_nick;
				$_val['sdate'] = today_time;
				$_val['content'] = $_POST['content'];

				// : 답장
				if ($row) {
					$_val['code'] = 'reply';
					$_val['pno'] = $row['pno']; // : 답장 쪽지주키값
					$_val['rno'] = $row['no']; // : 답장 쪽지주키값

					// : 쪽지작성
				} else {
					$_val['code'] = $_POST['page_code'];
					$_val['pno'] = $_POST['pno'];
				}

				$q = $db->query_q($_val);
				$insert = $db->_query("insert into nf_message set " . $q, $_val);
				$arr['move'] = "";
				if (in_array($_POST['page_code'], array('reply', 'input'))) {
					$page_back_arr = explode("?", $nf_util->page_back());
					$arr['move'] = $page_back_arr[0] . '?code=send';
				}
				$arr['msg'] = "쪽지전송이 완료되었습니다.";
				$arr['js'] = '
				nf_util.openWin(".message-");
				';
			}
		}
		die(json_encode($arr));
		break;

	// : 쪽지확인
	case "click_message":
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		$arr['js'] = '';
		if ($member['no']) {
			$_where = " and `rdate`='1000-01-01 00:00:00' and `pmno`=" . intval($member['no']);
			if ($_POST['code'] == 'received')
				$_where = " and `pmno`=" . intval($member['no']);
			if ($_POST['code'] == 'send')
				$_where = " and `mno`=" . intval($member['no']);
			$row = $db->query_fetch("select * from nf_message where `no`=" . intval($_POST['no']) . $_where);
			$get_mno = $_POST['code'] == 'send' ? 'mno' : 'pmno';

			$arr['msg'] = "";
			$arr['move'] = "";

			// : 받는사람만 읽기저장해야함
			if ($row['pmno'] == $member['no'] && $row['rdate'] == '1000-01-01 00:00:00') {
				$arr['msg'] = "";
				$arr['move'] = "";
				$update = $db->_query("update nf_message set `rdate`=? where `no`=" . intval($row['no']), array(today_time));
				$arr['js'] = '
				var trObj = $(el).closest("tr");
				trObj.find(".date_read").html("' . today_time . '");
				trObj.find(".is_read").html("O");
				';
			}

			// : 폼 열기
			if ($row[$get_mno] == $member['no']) {
				$arr['row'] = $row;
				$arr['msg'] = "";
				$arr['move'] = "";
				$arr['js'] .= '
				var tr_index = $(el).closest("tr").index();
				$(el).closest("tbody").find("tr").eq(tr_index+1).css({"display":"table-row"});
				';
			}
		}
		die(json_encode($arr));
		break;

	case "tax_write":

		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		$arr['js'] = '';
		if ($is_admin || $member['no']) {
			$_where = "";
			if (strpos($nf_util->page_back(), '/nad/') === false)
				$_where = " and `mno`=" . intval($member['no']);
			else
				$_where = " and `no`=" . intval($_POST['no']);
			$tax_row = $db->query_fetch("select * from nf_tax where 1 " . $_where);

			$mem_row = $member;
			if (strpos($nf_util->page_back(), '/nad/') !== false) {
				$mem_row = $db->query_fetch("select * from nf_member where `no`=" . intval($tax_row['mno']));
			}

			$_val = array();
			if (!$tax_row) {
				$_val['mno'] = $member['no'];
				$_val['wr_type'] = $member['mb_type'];
				$_val['wr_id'] = $member['mb_id'];
			}
			$_val['wr_name'] = $_POST['wr_name'] ? $_POST['wr_name'] : $member['mb_name'];
			if ($_POST['wr_email'][0])
				$_val['wr_email'] = implode("@", $_POST['wr_email']);
			if ($_POST['wr_hphone'][1])
				$_val['wr_hphone'] = implode("-", $_POST['wr_hphone']);
			if ($_POST['wr_phone'][1])
				$_val['wr_phone'] = implode("-", $_POST['wr_phone']);
			$_val['wr_pay_date'] = $_POST['wr_pay_date'];
			$_val['wr_price'] = $_POST['wr_price'];
			$_val['wr_content'] = $_POST['wr_content'];
			if (!$tax_row)
				$_val['wdate'] = today_time;
			if (strpos($nf_util->page_back(), '/nad/') === false)
				$_val['udate'] = today_time;

			if ($mem_row['mb_type'] == 'company') {
				$_val['wr_manager'] = $_POST['manager'];
				if ($_POST['biz_no'][0])
					$_val['wr_biz_no'] = implode("-", $_POST['biz_no']);
				$_val['wr_company_name'] = $_POST['company_name'];
				$_val['wr_ceo_name'] = $_POST['ceo_name'];
				$_val['wr_zipcode'] = $_POST['zipcode'];
				$_val['wr_address0'] = $_POST['address0'];
				$_val['wr_address1'] = $_POST['address1'];
				$_val['wr_condition'] = $_POST['condition'];
				$_val['wr_item'] = $_POST['item'];
			}

			if ($_POST['wr_memo'])
				$_val['wr_memo'] = $_POST['wr_memo'];

			$q = $db->query_q($_val);

			if ($tax_row)
				$query = $db->_query("update nf_tax set " . $q . " where `no`=" . intval($tax_row['no']), $_val);
			else
				$query = $db->_query("insert into nf_tax set " . $q, $_val);
			$arr['msg'] = ($tax_row ? '수정' : '등록') . "이 완료되었습니다.";
			$arr['move'] = $nf_util->page_back();
			if (strpos($nf_util->page_back(), '/nad/') !== false)
				$arr['move'] = $nf_util->sess_page('tax_list_admin');
		}
		die($nf_util->move_url($arr['move'], $arr['msg']));
		break;


	case "click_jump_use":
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		$arr['js'] = '';
		if ($member['no']) {
			$arr['msg'] = "";
			$arr['move'] = "";
			$_table = 'nf_' . $_POST['code'];
			$info_row = $db->query_fetch("select * from " . $_table . " where `no`=? and `mno`=?", array($_POST['no'], $member['no']));
			$arr['msg'] = "삭제된 정보입니다.";
			$arr['move'] = $nf_util->page_back();
			if ($info_row) {
				$update = $db->_query("update " . $_table . " set `wr_jump_use`=? where `no`=?", array($_POST['val'], $info_row['no']));
				$arr['msg'] = $nf_util->use_arr[$_POST['val']] . "으로 변경했습니다.";
				$arr['move'] = "";
			}
		}
		die(json_encode($arr));
		break;


	case "get_ajax_paging":
		switch ($_POST['code']) {
			case "map":
				$_include = true;
				$_POST['mode'] = 'get_map_employ';
				include NFE_PATH . '/include/regist.php';
				break;


			// : 관리자 회원문자발송
			case "member_sms":
				$_include = true;
				$_POST['mode'] = 'member_ajax_search';
				include NFE_PATH . '/nad/regist.php';
				break;
		}
		exit;
		break;


	case "find_id":
	case "find_pw":
		$arr['msg'] = "이미 로그인된 상태입니다.";
		$arr['move'] = "/";
		if (!$member['no']) {
			$_val = array();
			$_val['mb_name'] = $_POST['name'];
			$_val['mb_email'] = $_POST['email'];
			$_where = " and `mb_name`=? and `mb_email`=?";
			if ($_POST['mode'] == 'find_pw') {
				$_val['mb_id'] = $_POST['mid'];
				$_where .= " and `mb_id`=?";
			}
			$q = $db->query_q($_val);
			$mem_row = $db->query_fetch("select * from nf_member where 1" . $_where, $_val);
			if ($mem_row) {
				switch ($_POST['mode']) {
					case "find_id":
						$arr['msg'] = "";
						$arr['move'] = "";
						ob_start();
						?>
						<!--아이디찾은 후 아이디노출-->
						<div class="find_id">
							<p class="txt"></p>
							<p class="id_view">입력한 정보로 조회된 아이디는 <b class="red"><?php echo $mem_row['mb_id']; ?></b> 입니다.</p>
							<div class="next_btn">
								<a href="<?php echo NFE_URL; ?>/"><button type="button" class="base darkbluebtn">메인홈으로</button></a>
								<a href="<?php echo NFE_URL; ?>/member/login.php"><button type="button" class="base">로그인하기</button></a>
							</div>
						</div>
						<!--//아이디찾은 후 아이디노출-->
						<?php
						$arr['tag'] = ob_get_clean();
						$arr['js'] = '
						$(".input_wrap-child-").eq(0).html(data.tag);
						';
						break;

					case "find_pw":
						$mem_row['mb_password'] = $nf_util->rand_word(10);
						$mail_skin = $db->query_fetch("select * from nf_mail_skin where `skin_name`='member_find'");
						$update = $db->_query("update nf_member set `mb_password`=? where `no`=?", array(md5($mem_row['mb_password']), $mem_row['no']));
						$email_arr['subject'] = "[" . $env['site_name'] . "] 문의하신 회원 아이디/비밀번호 입니다.";
						$email_arr['email'] = $mem_row['mb_email'];
						$email_arr['content'] = strtr(stripslashes($mail_skin['content']), $nf_email->ch_content($mem_row));
						$nf_email->send_mail($email_arr);
						$arr['msg'] = "비밀번호를 메일로 전송했습니다.";
						$arr['move'] = "/member/login.php";

						$sms_arr = array();
						$sms_arr['phone'] = $mem_row['mb_hphone'];
						$sms_arr['name'] = $mem_row['mb_name'];
						$sms_arr['mb_password'] = $mem_row['mb_password'];
						$nf_sms->send_sms_passwd_find($sms_arr);
						break;
				}
			} else {
				$arr['msg'] = "찾으시는 정보가 없습니다.";
				$arr['move'] = "";
			}
		}
		die(json_encode($arr));
		break;


	case "click_poll":
		$arr['msg'] = "";
		$poll_row = $db->query_fetch("select * from nf_poll where `no`=? and `use`=1", array($_POST['no']));
		$is_my_poll = $db->query_fetch("select * from nf_poll_member where `pno`=? and `mno`=?", array($poll_row['no'], $member['no']));


		$code_vote = $_POST['code'] == 'vote' && $_POST['view'] == 'vote' ? 'vote' : 'result';
		switch ($code_vote) {
			case 'vote':
				if (!$member['no'] && $poll_row['poll_member']) {
					$arr['msg'] = "회원만 이용 가능합니다.";
					$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
				}

				$poll_vote_arr = explode(",", $_COOKIE['poll_vote_' . $poll_row['no']]);

				// : 한번만 투표가능
				if (!$poll_row['poll_overlap'] && ($is_my_poll || $_COOKIE['poll_vote_' . $poll_row['no']]))
					$arr['msg'] = "이미 선택한 설문조사입니다.";
				// : 중복 가능하지만 같은번호는 한번만 투표 가능
				if ($poll_row['poll_overlap'] && (($member['no'] && $is_my_poll['sel_no'] == $_POST['val']) || (in_array($_POST['val'], $poll_vote_arr))))
					$arr['msg'] = "이미 선택한 설문조사입니다.";
				if (!$poll_row)
					$arr['msg'] = "삭제된 설문조사입니다.";

				if (!$arr['msg']) {
					$_val = array();
					$_val['pno'] = $poll_row['no'];
					$_val['mno'] = $member['no'];
					$_val['mb_id'] = $member['mb_id'];
					$_val['sel_no'] = $_POST['val'];
					$_val['ip'] = $_SERVER['REMOTE_ADDR'];
					$_val['sdate'] = today_time;
					$q = $db->query_q($_val);
					$insert = $db->_query("insert into nf_poll_member set " . $q, $_val);
					if ($insert) {
						$update = $db->_query("update nf_poll set `cnt`=`cnt`+1 where `no`=?", array($poll_row['no']));
						$arr['msg'] = "투표가 완료되었습니다.";
						$poll_vote_val = $_COOKIE['poll_vote_' . $poll_row['no']] . ',' . $_POST['val'];
						$nf_util->cookie_save('poll_vote_' . $poll_row['no'], $poll_vote_val, "yes", "100 year");
					} else {
						$arr['msg'] = '투표가 실패되었습니다.\n운영자에게 문의하시기 바랍니다.';
					}
				}
				$add_js = '
				$(el).closest(".qa-body-").find(".btn-vote-").css({"display":"none"});
				$(el).closest(".qa-body-").attr("view", "result");
				';
				break;

			default:
				$view_text = $_POST['code'] == 'result' ? 'vote' : 'vote';
				if ($_POST['code'] == 'result') {
					$add_js = '
					$(el).closest(".qa-body-").find(".btn-result-").css({"display":"none"});
					';
				} else {
					$add_js = '
					$(el).closest(".qa-body-").find(".btn-result-").css({"display":"block"});
					';
				}
				$add_js .= '
				$(el).closest(".qa-body-").attr("view", "' . $_POST['code'] . '");
				';
				if ($_POST['code'] == 'vote') {
					$add_js .= '
					$(el).closest(".qa-body-").attr("view", "' . $_POST['code'] . '");
					';
				}
				break;
		}

		$poll_content = unserialize($poll_row['poll_content']);
		$vote_ = array();
		$query = $db->_query("select count(`sel_no`) as c, `sel_no` from nf_poll_member where `pno`=? group by `sel_no`", array($poll_row['no']));
		while ($row = $db->afetch($query)) {
			$vote_[$row['sel_no'] - 1] = $row['c'];
		}
		$vote_cnt = array_sum($vote_);

		$per_hap_ = 0;
		if (is_array($poll_content))
			$poll_cnt = count($poll_content);

		ob_start();
		if (is_array($poll_content)) {
			foreach ($poll_content as $k => $v) {

				switch ($_POST['view']) {
					case 'result':
						?>
						<li><label><input type="radio" name="poll[<?php echo $poll_row['no']; ?>]"
									value="<?php echo ($k + 1); ?>"><?php echo $v; ?></label></li>
						<?php
						break;

					default:
						$per_ = sprintf("%0.1f", $vote_[$k] / $vote_cnt * 100);
						if (($poll_cnt - 1) == $k)
							$per_ = sprintf("%0.1f", 100 - $per_hap_);
						if (!$vote_[$k])
							$per_ = 0;
						$per_hap_ += $per_;
						?>
						<li><?php echo $v; ?>
							<p><span style="width:<?php echo $per_; ?>%;"></span></p><em><?php echo $per_; ?>%
								[<?php echo number_format(intval($vote_[$k])); ?>표]</em>
						</li>
						<?php
						break;
				}
			}
		}
		$arr['vote_result'] = ob_get_clean();

		$arr['js'] = '
		$(el).closest(".qa-body-").find(".answer-body-").html(data.vote_result);
		$(el).closest(".qa-body-").find(".btn-result-").css({"display":"none"});
		';
		$arr['js'] .= $add_js;
		die(json_encode($arr));
		break;


	case "password_write":
		switch ($_POST['kind']) {
			case "board":
				$bo_table = trim($_POST['bo_table']);
				$_table = $nf_board->get_table($bo_table);
				$bo_row = $db->query_fetch("select * from nf_board where `bo_table`=?", array($bo_table));
				$board_info = $nf_board->board_info($bo_row);
				$row = $db->query_fetch("select * from " . $_table . " where `wr_no`=" . intval($_POST['no']));
				$b_info = $nf_board->info($row, $board_info);

				$arr['msg'] = "게시물이 없습니다.";
				if (!$_POST['pw'])
					$arr['msg'] = "비밀번호를 입력해주시기 바랍니다.";
				else if ($row) {
					$arr['msg'] = "";
					if ($row['wr_password'] != md5($_POST['pw']))
						$arr['msg'] = "비밀번호를 정확히 입력해주시기 바랍니다.";
					else {
						$_SESSION['board_view_' . $bo_table . '_' . $row['wr_no']] = today_time;
						switch ($_POST['code']) {
							case "write":
								$arr = $nf_board->auth_move($_POST['code'], $bo_table, $row['wr_no']);
								break;

							case "read":
								if ($row['wr_is_comment']) {
									ob_start();
									include NFE_PATH . '/board/comment.inc.inc.php';
									$arr['comment_tag'] = ob_get_clean();
									$arr['js'] = '
									$("#comment_li-' . $row['wr_no'] . '-").html(data.comment_tag);
									';
								} else
									$arr = $nf_board->auth_move($_POST['code'], $bo_table, $row['wr_no']);
								break;

							case "delete":
								$arr['js'] = '
								nf_board.click_delete(el, "' . $bo_table . '", "' . intval($row['wr_no']) . '");
								';
								break;
						}
					}
				}
				break;
		}

		if ($arr['msg']) {
			$arr['js'] = '
			var pass_form = document.forms["fpassword"];
			$(pass_form).find("[name=\'pw\']").val("");
			';
		}
		die(json_encode($arr));
		break;


	// : 로그분석 읽기
	case "read_statistics":
		$arr = $nf_statistics->visit();
		die(json_encode($arr));
		break;


	//################## 삭제 ##################//
	case "delete_select_message":
	case "delete_message":
		$arr['msg'] = "로그인하셔야 이용가능합니다.";
		if (!$member['no'] && !admin_id)
			$arr['move'] = NFE_URL . '/member/login.php?page_url=' . urlencode($nf_util->page_back());
		if ($member['no'] || admin_id) {
			$nos = $_POST['mode'] == 'delete_message' ? $_POST['no'] : implode(",", $_POST['chk']);

			$_where = " and `pmno`=" . intval($member['no']);
			$field_del = 'p';

			if ($_POST['code'] == 'send') {
				$_where = " and `mno`=" . intval($member['no']);
				$field_del = '';
			}

			if (admin_id && strpos($nf_util->page_back(), "/nad/") !== false)
				$_where = ""; // : 관리자는 회원체크 안함.

			if ($nos) {
				if (admin_id && strpos($nf_util->page_back(), "/nad/") !== false)
					$delete = $db->_query("delete from nf_message where `no` in (" . $nos . ")" . $_where);
				else
					$update = $db->_query("update nf_message set `" . $field_del . "del`=?, `" . $field_del . "ddate`=? where `no` in (" . $nos . ")" . $_where, array(1, today_time));
			}
			$arr['msg'] = "삭제가 완료되었습니다.";
			$arr['move'] = $nf_util->page_back();
		}
		die(json_encode($arr));
		break;


	case "delete_member":
	case "delete_select_member":
		$arr['msg'] = "정상적으로 접근해주시기 바랍니다.";
		$arr['move'] = NFE_URL . "/";
		if ($member['no'] || admin_id) {
			$mno = intval($member['no']);
			$admin_control = false;
			if (strpos($nf_util->page_back(), '/nad/') !== false && admin_id)
				$admin_control = true;

			// : 관리자
			if ($admin_control)
				$mno = intval($_POST['chk'][0]) > 0 ? implode(",", $_POST['chk']) : intval($_POST['no']);
			// : 사용자
			else {
				$mem_row = $db->query_fetch("select * from nf_member where `no`=? and `mb_password`=? and `mb_email`=?", array($mno, md5($_POST['passwd']), $_POST['email']));
				if (!$mem_row) {
					$arr['msg'] = "정보를 정확히 입력해주시기 바랍니다.";
					$arr['move'] = $nf_util->page_back();
					die(json_encode($arr));
				}
			}
			$query = $db->_query("select * from nf_member where `no` in (" . $mno . ")");
			while ($row = $db->afetch($query)) {
				$delete = $db->_query("delete from nf_interest where `mno`=" . intval($row['no'])); // : 관심업소
				$delete = $db->_query("delete from nf_scrap where `mno`=" . intval($row['no'])); // : 스크랩
				$delete = $db->_query("delete from nf_cs where `mno`=" . intval($row['no'])); // : 광고제휴문의
				$delete = $db->_query("delete from nf_jump where `mno`=" . intval($row['no'])); // : 점프내역
				$delete = $db->_query("delete from nf_read where `mno`=" . intval($row['no'])); // : 읽은내역
				$delete = $db->_query("delete from nf_report where `mno`=" . intval($row['no'])); // : 신고내역
				$delete = $db->_query("delete from nf_not_read where `mno`=" . intval($row['no'])); // : 열람제한
				$accept_query = $db->_query("select * from nf_accept where `mno`=" . $row['no']); // : 내가 한 입사지원, 입사제의
				while ($accept_row = $db->afetch($accept_query)) {
					if (is_file(NFE_PATH . '/data/accept/' . $accept_row['attach']))
						unlink(NFE_PATH . '/data/accept/' . $accept_row['attach']);
				}
				$delete = $db->_query("delete from nf_accept where `mno`=" . intval($row['no'])); // : 입사지원

				if ($admin_control)
					$update = $db->_query("update nf_member set `mb_left`=1, `mb_left_reason_type`='_admin_', `mb_left_reason`='관리자삭제', `mb_left_date`='" . today_time . "' where `no`=" . intval($row['no'])); // : 회원내역
				$update = $db->_query("update nf_member_company set `is_delete`=1 where `mno`=" . intval($row['no'])); // : 업소회원내역
				$update = $db->_query("update nf_member_individual set `is_delete`=1 where `mno`=" . intval($row['no'])); // : 개인회원내역
				$update = $db->_query("update nf_member_service set `is_delete`=1 where `mno`=" . intval($row['no'])); // : 회원서비스

				$update = $db->_query("update nf_employ set `is_delete`=1 where `mno`=" . intval($row['no'])); // : 구인정보
				$update = $db->_query("update nf_resume set `is_delete`=1 where `mno`=" . intval($row['no'])); // : 이력서
				$update = $db->_query("update nf_message set `del`=1 where `mno`=" . intval($row['no'])); // : 쪽지내역
				$delete = $db->_query("update nf_point set `is_delete`=1 where `mno`=" . intval($row['no'])); // : 포인트내역
			}
			$arr['msg'] = "삭제가 완료되었습니다.";
			$arr['move'] = (strpos($nf_util->page_back(), '/nad/') !== false) ? $nf_util->page_back() : NFE_URL . '/';

			// : 사용자 탈퇴후 로그아웃시키기
			if (!$admin_control) {
				// : 탈퇴SMS
				$sms_arr = array();
				$sms_arr['phone'] = $mem_row['mb_hphone'];
				$sms_arr['name'] = $mb_hphone['mb_name'];
				$nf_sms->send_sms_member_secession($sms_arr);

				$_val = array();
				$_val['mb_left_request'] = 1;
				$_val['mb_left_request_date'] = today_time;
				$_val['mb_left_reason'] = $_POST['left_reason'] == 'etc' ? $_POST['content'] : $_POST['left_reason'];
				$q = $db->query_q($_val);
				$update = $db->_query("update nf_member set " . $q . " where `no`=" . intval($mno), $_val);
				$nf_member->logout();
				$arr['msg'] = "탈퇴가 완료되었습니다.";
			}
		}
		die(json_encode($arr));
		break;
	//################## 삭제 ##################//

	## : 기본 정보 ############################################




	default:

		switch ($_GET['mode']) {

			case "download_support":
				$accept_row = $db->query_fetch("select * from nf_accept where `no`=" . intval($_GET['no']));
				if (is_file(NFE_PATH . '/data/accept/' . $accept_row['attach'])) {
					$nf_util->file_download(NFE_PATH . '/data/accept/' . $accept_row['attach'], $accept_row['attach_name']);
				}
				exit;
				break;

			case "download_notice":
				$notice_row = $db->query_fetch("select * from nf_notice where `no`=" . intval($_GET['no']));
				$file_arr = $nf_util->get_unse($notice_row['wr_file']);
				$file_name_arr = $nf_util->get_unse($notice_row['wr_file_name']);

				$get_file = $file_arr[$_GET['k']];
				$get_filename = $file_name_arr[$_GET['k']];

				if (is_file(NFE_PATH . '/data/notice/' . $get_file)) {
					$nf_util->file_download(NFE_PATH . '/data/notice/' . $get_file, $get_filename);
				}
				exit;
				break;


			case "download_resume_file":
				$re_row = $db->query_fetch("select * from nf_resume where `no`=" . intval($_GET['no']));
				$resume_info = $nf_job->resume_info($re_row);

				$nf_util->file_download(NFE_PATH . '/data/resume/' . $resume_info['attach_arr'][$_GET['k']]['file'], $resume_info['attach_arr'][$_GET['k']]['txt']);
				exit;
				break;


			case "download_biz_attach":
				$row = $db->query_fetch("select * from nf_member_company where `no`=" . intval($_GET['no']));
				$ext = $nf_util->get_ext($row['mb_biz_attach']);
				$nf_util->file_download(NFE_PATH . '/data/member/' . $row['mb_biz_attach'], $row['mb_company_name'] . '.' . $ext);
				exit;
				break;


			case "wr_form_attach_download":
				$em_row = $db->query_fetch("select * from nf_employ as ne where ne.`no`=?" . $nf_job->employ_where, array($_GET['no']));
				$arr['msg'] = "삭제된 구인정보입니다.";
				$arr['move'] = $nf_util->page_back();
				if ($em_row) {
					$nf_util->file_download(NFE_PATH . '/data/employ/' . $em_row['wr_form_attach'], $em_row['wr_form_attach_name']);
					exit;
				}
				die($nf_util->move_url($arr['move'], $arr['msg']));
				break;



			###################모듈 시작######################

			case "sns_login_process":
				switch ($_GET['engine']) {
					case "naver":
						$_POST = $_GET;
						$_POST['mode'] = "sns_login_process";
						$_POST['engine'] = "naver";
						include NFE_PATH . "/plugin/login/regist.php";
						break;
				}
				exit;
				break;

			// : 비바톤 인증
			case "login_bbaton":

				function curl_func($url, $param, $headers, $method = 1)
				{
					$cu = curl_init();
					curl_setopt($cu, CURLOPT_URL, $url);
					curl_setopt($cu, CURLOPT_POST, $method);
					if (is_array($param))
						curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query($param));
					curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($cu, CURLOPT_TIMEOUT, 20);
					curl_setopt($cu, CURLOPT_HEADER, true);
					curl_setopt($cu, CURLOPT_HTTPHEADER, $headers);
					$response = curl_exec($cu);
					curl_close($cu);
					return $response;
				}

				$url = "https://bauth.bbaton.com/oauth/token";
				$param = array(
					'grant_type' => 'authorization_code',
					'redirect_uri' => $env['bbaton_redirect_uri'],
					'code' => $_GET['code'],
				);

				$client_id = $env['bbaton_id'];
				$secret_key = $env['bbaton_key'];

				$headers = array(
					"Content-type: application/x-www-form-urlencoded",
					"Authorization: Basic " . base64_encode($client_id . ':' . $secret_key)
				);

				$token = curl_func($url, $param, $headers);
				$txt_start = strpos($token, "{");
				$json_txt = substr($token, $txt_start);
				$json_arr = json_decode($json_txt, true);

				$url = "https://bapi.bbaton.com/v2/user/me";
				$param = "";
				$headers = array(
					"Authorization: " . $json_arr['token_type'] . ' ' . $json_arr['access_token']
				);
				$user = curl_func($url, "", $headers, 0);
				$txt_start = strpos($user, "{");
				$json_txt = substr($user, $txt_start);
				$json_arr = json_decode($json_txt, true);

				$gender = $json_arr['gender'] == 'M' ? 'M' : 'F';
				$adult = $json_arr['adult_flag'] == 'Y' ? true : false;
				if ($json_arr['birth_year'] >= 20)
					$adult = true;
				$_arr = array(
					'REQ_SEQ' => "",
					'RES_SEQ' => "",
					'AUTH_TYPE' => "",
					'NAME' => "",
					'BIRTHDATE' => "",
					'GENDER' => $gender,
					'NATIONALINFO' => "",
					'DI' => "",
					'CI' => "",
					'MOBILE_NO' => "",
					'MOBILE_CO' => "",
					'adult' => $adult,
					'age' => $json_arr['birth_year'],
					'AUTH' => $json_arr
				);

				if ($json_arr['result_code'] == '00') {
					$_SESSION['_auth_process_'] = $_arr;
				}

				if ($json_arr['adult_flag'] != 'Y' && $env['use_adult']) {
					?>
					<script type="text/javascript">
						alert("성인만 접속이 가능합니다.");
						window.close();
					</script>
					<?php
				} else {
					$move_url = 'window.opener.location.href = "' . $_SESSION['page_code_auth'] . '";';
					if (!$_SESSION['page_code_auth']) {
						$move_url = 'window.opener.location.reload();';
					}
					$_SESSION['page_code_auth'] = "";
					?>
					<script type="text/javascript">
						//window.opener = window.open('', "parent_auth");
						<?php echo $move_url; ?>
						window.close();
					</script>
					<?php
				}
				exit;
				break;

			case "logout":
				$nf_member->logout();
				$arr['move'] = NFE_URL . '/';
				die($nf_util->move_url($arr['move']));
				break;

			###################모듈 끝######################
		}

		break;
}
?>