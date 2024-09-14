<script type="text/javascript">
var click_read_func = function(code) {
	$.post(root+"/include/regist.php", "mode=read_pay_use&code=<?php echo $page_code;?>&no=<?php echo $info_no;?>", function(data){
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.move;
	});
}

var click_no_open = function() {
	$(".no_open").css({"display":"none"});
}
</script>
<div class="no_open">
	<div class="no_open_words">
		<p>해당 <?php echo $page_code_txt;?>를 열람하시겠습니까?<br>열람시 <b>1건의 열람권이 차감</b>됩니다.</p>
		<button type="button" onClick="click_no_open()" class="close">기본정보열람</button>
		<button type="button" onClick="click_read_func('<?php echo $page_code;?>')" class="open">열람하기</button>
	</div>
</div>