<?php
	header('Content-Type: text/html; charset=euc-kr');
	phpinfo();
	//**************************************************************************
	// ���ϸ� : ipin_popup1.php
	// - �ٴ�������
	// ������ ���� ��û ���� �Է� ȭ��
	//**************************************************************************
?>
<html>
<head>
<title>KCB ������ ���� ���� 1</title>
<script>
<!--
	function jsSubmit(){
		var popupWindow = window.open("ipin_popup2.php", "kcbPop", "left=200, top=100, status=0, width=450, height=550");
		popupWindow.focus()	;
	}
//-->
</script>
</head>
<body>
	<div><strong> - ������ ����</strong></div>
	<input type="button" value="������" onClick="jsSubmit();">
	
	<!-- ������ �˾� ó����� ���� = ipin_popup3 ���� �� �Է� -->
	<form name="kcbResultForm" method="post">
		<input type="hidden" name="CP_CD" />
		<input type="hidden" name="TX_SEQ_NO" />
		<input type="hidden" name="RSLT_CD" />
		<input type="hidden" name="RSLT_MSG" />
		
		<input type="hidden" name="RSLT_NAME" />
		<input type="hidden" name="RSLT_BIRTHDAY" />
		<input type="hidden" name="RSLT_SEX_CD" />
		<input type="hidden" name="RSLT_NTV_FRNR_CD" />
		
		<input type="hidden" name="DI" />
		<input type="hidden" name="CI" />
		<input type="hidden" name="CI2" />
		<input type="hidden" name="CI_UPDATE" />
		<input type="hidden" name="VSSN" />
		
		<input type="hidden" name="RETURN_MSG" />
	</form>
</body>
</html>
