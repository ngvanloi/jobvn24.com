<?php
	// ---------------------------------------------------------------------------

	# �̹����� ����� ���丮�� ��ü ��θ� �����մϴ�.
	# ���� ������(/)�� ������ �ʽ��ϴ�.
	# ����: �� ����� ���� ������ ����, �бⰡ �����ϵ��� ������ �ֽʽÿ�.
	$PATH = $_SERVER['DOCUMENT_ROOT'];
	include_once $PATH. "/engine/_core.php";
	include_once NFE_PATH.'/engine/function/make_watermark.function.php';

	$ym = date("ym", time());

	define("SAVE_DIR", NFE_PATH. '/data/editor/'.$ym);
	define("SAVE_URL", NFE_URL. '/data/editor/'.$ym);

	@mkdir(SAVE_DIR, 0707);
	@chmod(SAVE_DIR, 0707);
?>