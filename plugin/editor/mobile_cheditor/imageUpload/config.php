<?php
	// ---------------------------------------------------------------------------

	# 이미지가 저장될 디렉토리의 전체 경로를 설정합니다.
	# 끝에 슬래쉬(/)는 붙이지 않습니다.
	# 주의: 이 경로의 접근 권한은 쓰기, 읽기가 가능하도록 설정해 주십시오.
	$PATH = $_SERVER['DOCUMENT_ROOT'];
	include_once $PATH. "/engine/_core.php";
	include_once NFE_PATH.'/engine/function/make_watermark.function.php';

	$ym = date("ym", time());

	define("SAVE_DIR", NFE_PATH. '/data/editor/'.$ym);
	define("SAVE_URL", NFE_URL. '/data/editor/'.$ym);

	@mkdir(SAVE_DIR, 0707);
	@chmod(SAVE_DIR, 0707);
?>