<?php
function job_jump_insert($code, $row) {
	global $db;

	$_val = array();
	$_val['action'] = $row['action'];
	$_val['code'] = $code;
	$_val['mno'] = $row['mno'];
	$_val['mb_id'] = $row['wr_id'];
	$_val['cnt'] = $row['c'];
	$_val['pno'] = $row['nos'];
	$_val['sdate'] = today_time;
	$q = $db->query_q($_val);
	$insert = $db->_query("insert into nf_jump set ".$q, $_val);
}

function job_jump_func($time) {
	global $nf_employ, $nf_search, $db, $nf_job;

	// : 구인정보 점프
	if($nf_job->service_info['employ']['jump']['use']) {
		$service_where = $nf_search->service_where('employ');
		$where_basic = " and (".$service_where['where'].")".$nf_job->employ_where;
		$_where = " ne.wr_jump_use=1 and '".today_time."'>=DATE_ADD(wr_jdate, INTERVAL ".$time.") ".$where_basic;

		$select = $db->_query("select * from nf_member_service as nms right join nf_employ as ne on nms.`mno`=ne.`mno` where mb_employ_jump_int>0 and ne.`mno`>0 and ".$_where);
		while($row=$db->afetch($select)) {
			$minus_update = $db->_query("update nf_member_service as nms set `mb_employ_jump_int`=`mb_employ_jump_int`-1 where `mb_employ_jump_int`>0 and `mno`=".intval($row['mno']));
			if($minus_update) {
				$update = $db->_query("update nf_employ set `wr_jdate`='".date("Y-m-d H:i:").sprintf("%02d", rand(0,59))."' where `no`=".intval($row['no']));
				$row['action'] = 'auto';
				$row['nos'] = $row['no'];
				$row['c'] = 1;
				job_jump_insert('employ', $row);
			}
		}
	}


	// : 인재정보 점프
	if($nf_job->service_info['resume']['jump']['use']) {
		$service_where = $nf_search->service_where('resume');
		$where_basic = " and (".$service_where['where'].")".$nf_job->resume_where;
		$_where = " nr.wr_jump_use=1 and '".today_time."'>=DATE_ADD(wr_jdate, INTERVAL ".$time.") ".$where_basic;

		$select = $db->_query("select * from nf_member_service as nms right join nf_resume as nr on nms.`mno`=nr.`mno` where mb_resume_jump_int>0 and nr.`mno`>0 and ".$_where);
		while($row=$db->afetch($select)) {
			$minus_update = $db->_query("update nf_member_service as nms set `mb_resume_jump_int`=`mb_resume_jump_int`-1 where `mb_resume_jump_int`>0 and `mno`=".intval($row['mno']));
			if($minus_update) {
				$update = $db->_query("update nf_resume set `wr_jdate`='".date("Y-m-d H:i:").sprintf("%02d", rand(0,59))."' where `no`=".intval($row['no']));
				$row['action'] = 'auto';
				$row['nos'] = $row['no'];
				$row['c'] = 1;
				job_jump_insert('resume', $row);
			}
		}
	}
}
?>