<?php
header("Content-Type:text/html; charset=euc-kr;"); 
?>
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY CANCEL REQUEST</title>
<meta charset="euc-kr">
<style>
	html,body {height: 100%;}
	form {overflow: hidden;}
</style>
<script type="text/javascript">
function reqCancel(){
	document.cancelForm.submit();
}
</script>
</head>
<body> 
<form name="cancelForm" method="post" target="_self" action="cancelResult.php">
	<table>
		<tr>
			<th>���ŷ� ID</th>
			<td><input type="text" name="TID" value="" /></td>
		</tr>
		<tr>
			<th>��� �ݾ�</th>
			<td><input type="text" name="CancelAmt" value="" /></td>
		</tr>
		<tr>
			<th>�κ���� ����</th>
			<td>
				<input type="radio" name="PartialCancelCode" value="0" checked="checked"/> ��ü���
				<input type="radio" name="PartialCancelCode" value="1"/> �κ����
			</td>
		</tr>
	</table>
	<a href="#" onClick="reqCancel();">�� û</a>				
</form>				
</body>
</html>