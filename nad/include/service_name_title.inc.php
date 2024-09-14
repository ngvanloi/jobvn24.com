<?php
$_code = 'main';
if(strpos($_SERVER['PHP_SELF'], 'employ')!==false) $_code = 'employ';
if(strpos($_SERVER['PHP_SELF'], 'resume')!==false) $_code = 'resume';
?>
<div class="ass_list">
	<table>
		<colgroup>
			<col width="8%">
		</colgroup>
		<tr>
			<th>서비스 영역</th>
			<td>
				<ul>					
					<li class="<?php echo $_code=='employ' ? 'on' : '';?>"><a href="./service_name(employ).php">구인정보 서비스명 설정</a></li>
					<li class="<?php echo $_code=='resume' ? 'on' : '';?>"><a href="./service_name(resume).php">인재정보 서비스명 설정</a></li>
				</ul>
			</td>
		</tr>
	</table>
</div>