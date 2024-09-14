<?php
if($nf_job->service_info[$code]['busy']['use']) {
	$price_query = $db->_query("select * from nf_service_price where `code`=? and `type`=? order by `rank` asc", array($code, 'busy'));
	$length = $db->num_rows($price_query);
	if($length>0) {
?>
<h4 id="<?php echo $code;?>_busy"><span class="orange">급구<?php echo $nf_job->kind_of[$code];?> 페이지</span> 상품 <a href="<?php echo $service_ahref;?>"><button type="button">서비스 신청</button></a></h4>
<div class="tablewrap indi_product">
	<table class="style2 fl">
		<tr>
			<th>미리보기</th>
		</tr>
		<tr>
			<td class="tac"><img src="../images/<?php echo $code;?>_busy_product.jpg" alt="급구<?php echo $nf_job->kind_of[$code];?> 상품"></td>
		</tr>
	</table>
	<table class="style2 fr">
		<colgroup>
			<col width="53%">
			<col width="21%">
			<col width="26%">
		</colgroup>
		<tr>
			<th>서비스명</th>
			<th colspan="3">기간선택</th>
		</tr>
		<?php
		$count = 0;
		while($row=$db->afetch($price_query)) {
		?>
		<tr>
			<?php if($count===0) {?>
			<td rowspan="<?php echo $length;?>">
				<h5>급구 <?php echo $nf_job->kind_of[$code];?><button type="button" onClick="intro_service(this, '<?php echo $code;?>', 'busy')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<?php
					// : 원래 li로 해야하는데 http://job.netfu.co.kr/nad/design/index.php 여기에서의 서비스안내대로 출력해서 css가 잘 안나옵니다.
					echo stripslashes($env['service_intro_arr'][$code]['busy']);
					?>
				</ul>
			</td>
			<?php
			}?>
			<td class="tac"><?php echo number_format(intval($row['service_cnt'])).strtr($row['service_unit'], $nf_util->date_count_arr);?></td>
			<td class="price tar">
				<?php if($row['service_percent']>0) {?><p class="sale"><span><?php echo $row['service_percent'];?>%</span><?php echo number_format(intval($row['service_price']));?>원</p><?php }?>
				<p><em><?php echo $nf_util->get_price_int($row['service_price'], $row['service_percent']);?></em><?php if($row['service_price']>0) {?>원<?php }?></p>
			</td>
			<td class="tac choice"><label class="radiostyle2" ><input type="checkbox" class="service_click-" name="service[<?php echo $code;?>][busy]" value="<?php echo $row['no'];?>" onClick="nf_util.one_check(this)"></label></td>
		</tr>
		<?php
			$count++;
		}?>
	</table>
</div>
<!--//tablewrap-->
<?php
	}
}?>