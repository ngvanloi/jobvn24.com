<?php
header("Content-Type:text/html; charset=euc-kr;"); 

$merchantKey = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==";
$mid = "nicepay00m";
$moid = "nicepay_api_3.0_test";		
$cancelMsg = "����û";
$tid = $_POST['TID'];			
$cancelAmt = $_POST['CancelAmt']; 
$partialCancelCode = $_POST['PartialCancelCode'];

$ediDate = date("YmdHis");
$signData = bin2hex(hash('sha256', $mid . $cancelAmt . $ediDate . $merchantKey, true));

try{
	$data = Array(
		'TID' => $tid,
		'MID' => $mid,
		'Moid' => $moid,
		'CancelAmt' => $cancelAmt,
		'CancelMsg' => $cancelMsg,
		'PartialCancelCode' => $partialCancelCode,
		'EdiDate' => $ediDate,
		'SignData' => $signData
	);	
	$response = reqPost($data, "https://webapi.nicepay.co.kr/webapi/cancel_process.jsp"); //��� API ȣ��
	jsonRespDump($response);
}catch(Exception $e){
	$e->getMessage();
	$ResultCode = "9999";
	$ResultMsg = "��Ž���";
}

// API CALL foreach ����
function jsonRespDump($resp){
	$resp_utf = iconv("EUC-KR", "UTF-8", $resp); 
	$respArr = json_decode($resp_utf);
	foreach ( $respArr as $key => $value ){
		echo "$key=". iconv("UTF-8", "EUC-KR", $value)."<br />";
	}
}

//Post api call
function reqPost(Array $data, $url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);					//connection timeout 15 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));	//POST data
	curl_setopt($ch, CURLOPT_POST, true);
	$response = curl_exec($ch);
	curl_close($ch);	 
	return $response;
}
?>