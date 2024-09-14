<?php
include_once NFE_PATH."/engine/class/db.class.php"; // DB Class
include_once NFE_PATH."/engine/class/nf_util.class.php"; // util Class
include_once NFE_PATH."/engine/class/nf_admin.class.php"; // admin Class
include_once NFE_PATH."/engine/class/nf_category.class.php"; // 카테고리 Class
include_once NFE_PATH."/engine/class/nf_banner.class.php"; // 배너 Class
include_once NFE_PATH."/engine/class/nf_job.class.php"; // 예약 Class
include_once NFE_PATH."/engine/class/nf_payment.class.php"; // 결제 Class
include_once NFE_PATH."/engine/class/nf_tag.class.php"; // 태그모음 Class
include_once NFE_PATH."/engine/class/nf_sms.class.php"; // SMS Class
include_once NFE_PATH."/engine/class/nf_email.class.php"; // 이메일 Class
include_once NFE_PATH."/engine/class/nf_statistics.class.php"; // 이메일 Class
include_once NFE_PATH."/engine/class/nf_member.class.php"; // 이메일 Class
include_once NFE_PATH."/engine/class/nf_search.class.php"; // 검색 Class
include_once NFE_PATH."/engine/class/nf_point.class.php"; // 포인트 Class
include_once NFE_PATH."/engine/class/nf_board.class.php"; // 게시판 Class

$db = new DBConnection();
$nf_util = new nf_util();

$nf_admin = new nf_admin();
$nf_category = new nf_category();
$nf_banner = new nf_banner();
$nf_job = new nf_job();
$nf_payment = new nf_payment();
$nf_tag = new nf_tag();
$nf_sms = new nf_sms();
$nf_email = new nf_email();
$nf_statistics = new nf_statistics();
$nf_member = new nf_member();
$nf_search = new nf_search();
$nf_point = new nf_point();
$nf_board = new nf_board();
?>