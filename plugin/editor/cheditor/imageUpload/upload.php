<?php
require_once("config.php");

//----------------------------------------------------------------------------
//
//
$tempfile = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];

$type = substr($filename, strrpos($filename, ".")+1);
$found = false;
switch ($type) {
	case "jpg":
	case "jpeg":
	case "gif":
	case "png":
		$found = true;
}

if ($found != true) {
	exit;
}

// ���� ���� �̸�: ����Ͻú���_��������8��
// 20140327125959_abcdefghi.jpg
// ���� ���� �̸�: $_POST["origname"]
$savefile = SAVE_DIR . '/' . $filename;

move_uploaded_file($tempfile, $savefile);

if($_GET['is_news'] ){	// ���� �϶��� ���͸�ũ ���

	$imgsize = @getimagesize($savefile);
	$filesize = filesize($savefile);

	/*
	$get_config = $news_config_control->get_config(1);	 // ���͸�ũ ���� ����
	$watermark_size = explode("/",$get_config['wr_watermark_size']);

	// ���͸�ũ ����
	if( $get_config['wr_watermark'] && ($watermark_size[0] <= $imgsize[0] && $watermark_size[1] <= $imgsize[1] ) ){
		make_watermark($savefile);
	}
	*/

} else {	 // �Ϲ� �� �ۼ� �϶�

	$imgsize = getimagesize($savefile);
	$filesize = filesize($savefile);

	if (!$imgsize) {
		$filesize = 0;
		$random_name = '-ERR';
		unlink($savefile);
	};

}

$rdata = sprintf('{"fileUrl": "%s/%s", "filePath": "%s", "fileName": "%s", "fileSize": "%d" }',
	SAVE_URL,
	$filename,
	$savefile,
	$filename,
	$filesize );

echo $rdata;
?>
