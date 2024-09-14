<?php
header("Content-Type:text/html; charset=euc-kr;"); 
/*
*******************************************************
* <������û �Ķ����>
* ������ Form �� ������ ������û �Ķ�����Դϴ�.
* ���������������� �⺻(�ʼ�) �Ķ���͸� ���õǾ� ������, 
* �߰� ������ �ɼ� �Ķ���ʹ� �����޴����� �����ϼ���.
*******************************************************
*/  

$merchantKey = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // ����Ű
$MID         = "nicepay00m"; // �������̵�
$goodsName   = "���̽�����"; // ������ǰ��
$price       = "1004"; // ������ǰ�ݾ�
$buyerName   = "���̽�"; // �����ڸ� 
$buyerTel	 = "01000000000"; // �����ڿ���ó
$buyerEmail  = "happy@day.co.kr"; // �����ڸ����ּ�        
$moid        = "mnoid1234567890"; // ��ǰ�ֹ���ȣ                     
$returnURL	 = "http://localhost:8080/payResult.php"; // ���������(������) - ����� ����â ����

/*
*******************************************************
* <�ؽ���ȣȭ> (�������� ������)
* SHA-256 �ؽ���ȣȭ�� �ŷ� �������� �������� ����Դϴ�. 
*******************************************************
*/ 
$ediDate = date("YmdHis");
$hashString = bin2hex(hash('sha256', $ediDate.$MID.$price.$merchantKey, true));
?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST</title>
<meta charset="euc-kr">
<style>
	html,body {height: 100%;}
	form {overflow: hidden;}
</style>
<!-- �Ʒ� js�� PC ����â ���� js�Դϴ�.(����� ����â ���� �ʿ� ����) -->
<script src="https://web.nicepay.co.kr/v3/webstd/js/nicepay-3.0.js" type="text/javascript"></script>
<script type="text/javascript">
//����â ���� ��û�� ����˴ϴ�.
function nicepayStart(){
	if(checkPlatform(window.navigator.userAgent) == "mobile"){//����� ����â ����
		document.payForm.action = "https://web.nicepay.co.kr/v3/v3Payment.jsp";
		document.payForm.submit();
	}else{//PC ����â ����
		goPay(document.payForm);
	}
}

//[PC ����â ����]���� ���� ��û�� ����˴ϴ�. <<'nicepaySubmit()' �̸� ���� �Ұ���>>
function nicepaySubmit(){
	document.payForm.submit();
}

//[PC ����â ����]����â ���� �Լ� <<'nicepayClose()' �̸� ���� �Ұ���>>
function nicepayClose(){
	alert("������ ��� �Ǿ����ϴ�");
}

//pc, mobile ����(���̵带 ���� ���� �Լ��Դϴ�.)
function checkPlatform(ua) {
	if(ua === undefined) {
		ua = window.navigator.userAgent;
	}
	
	ua = ua.toLowerCase();
	var platform = {};
	var matched = {};
	var userPlatform = "pc";
	var platform_match = /(ipad)/.exec(ua) || /(ipod)/.exec(ua) 
		|| /(windows phone)/.exec(ua) || /(iphone)/.exec(ua) 
		|| /(kindle)/.exec(ua) || /(silk)/.exec(ua) || /(android)/.exec(ua) 
		|| /(win)/.exec(ua) || /(mac)/.exec(ua) || /(linux)/.exec(ua)
		|| /(cros)/.exec(ua) || /(playbook)/.exec(ua)
		|| /(bb)/.exec(ua) || /(blackberry)/.exec(ua)
		|| [];
	
	matched.platform = platform_match[0] || "";
	
	if(matched.platform) {
		platform[matched.platform] = true;
	}
	
	if(platform.android || platform.bb || platform.blackberry
			|| platform.ipad || platform.iphone 
			|| platform.ipod || platform.kindle 
			|| platform.playbook || platform.silk
			|| platform["windows phone"]) {
		userPlatform = "mobile";
	}
	
	if(platform.cros || platform.mac || platform.linux || platform.win) {
		userPlatform = "pc";
	}
	
	return userPlatform;
}
</script>
</head>
<body>
<form name="payForm" method="post" action="payResult.php">
	<table>
		<tr>
			<th>���� ����</th>
			<td><input type="text" name="PayMethod" value=""></td>
		</tr>
		<tr>
			<th>���� ��ǰ��</th>
			<td><input type="text" name="GoodsName" value="<?php echo($goodsName)?>"></td>
		</tr>
		<tr>
			<th>���� ��ǰ�ݾ�</th>
			<td><input type="text" name="Amt" value="<?php echo($price)?>"></td>
		</tr>				
		<tr>
			<th>���� ���̵�</th>
			<td><input type="text" name="MID" value="<?php echo($MID)?>"></td>
		</tr>	
		<tr>
			<th>��ǰ �ֹ���ȣ</th>
			<td><input type="text" name="Moid" value="<?php echo($moid)?>"></td>
		</tr> 
		<tr>
			<th>�����ڸ�</th>
			<td><input type="text" name="BuyerName" value="<?php echo($buyerName)?>"></td>
		</tr>
		<tr>
			<th>�����ڸ� �̸���</th>
			<td><input type="text" name="BuyerEmail" value="<?php echo($buyerEmail)?>"></td>
		</tr>		
		<tr>
			<th>������ ����ó</th>
			<td><input type="text" name="BuyerTel" value="<?php echo($buyerTel)?>"></td>
		</tr>	 
		<tr>
			<th>�����Ϸ� ���ó�� URL<!-- (����� ����â ����)PC ����â ���� �ʿ� ���� --></th>
			<td><input type="text" name="ReturnURL" value="<?php echo($returnURL)?>"></td>
		</tr>
		<tr>
			<th>��������Աݸ�����(YYYYMMDD)</th>
			<td><input type="text" name="VbankExpDate" value=""></td>
		</tr>		
					
		<!-- �ɼ� -->	 
		<input type="hidden" name="GoodsCl" value="1"/>						<!-- ��ǰ����(�ǹ�(1),������(0)) -->
		<input type="hidden" name="TransType" value="0"/>					<!-- �Ϲ�(0)/����ũ��(1) --> 
		<input type="hidden" name="CharSet" value="euc-kr"/>				<!-- ���� �Ķ���� ���ڵ� ��� -->
		<input type="hidden" name="ReqReserved" value=""/>					<!-- ���� �����ʵ� -->
					
		<!-- ���� �Ұ��� -->
		<input type="hidden" name="EdiDate" value="<?php echo($ediDate)?>"/>			<!-- ���� �����Ͻ� -->
		<input type="hidden" name="SignData" value="<?php echo($hashString)?>"/>	<!-- �ؽ��� -->
	</table>
	<a href="#" class="btn_blue" onClick="nicepayStart();">�� û</a>
</form>
</body>
</html>