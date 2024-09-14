<?php
$query = $db->_query("select * from nf_service_package where `wr_type`=? and `wr_use`=1 order by `wr_rank` asc", array($code));
$length = $db->num_rows($query);

if($length>0) {
?>
<h4 id="<?php echo $code;?>_package"><span class="orange">패키지</span> 상품 <a href="<?php echo $service_ahref;?>"><button type="button">서비스 신청</button></a></h4>
<div class="tablewrap package">
	<table class="style2">
		<colgroup>
			<col width="20%">
			<col width="%">
			<col width="10%">
		</colgroup>
		<tr>
			<th>패키지 명</th>
			<th>패키지 내용</th>
			<th>금액</th>
			<th class="choice">선택</th>
		</tr>
		<?php
		while($row=$db->afetch($query)) {
			$package_arr = $nf_payment->get_package('job', $row);
		?>
		<tr>
			<td class="tac"><?php echo $nf_util->get_text($row['wr_subject']);?></td>
			<td>
				<?php
				echo strip_tags(implode(" + ", $package_arr['service_txt_arr']));
				?>
				<ul class="product_info">
					<li><?php echo stripslashes($row['wr_content']);?></li>
				</ul>
			</td>
			<td class="price tar">
				<p><em><?php echo number_format(intval($row['wr_price']));?></em>원</p>
			</td>
			<td class="tac choice"><label class="radiostyle2" ><input type="checkbox" class="service_click-" name="service[<?php echo $code;?>][package]" value="<?php echo $row['no'];?>" onClick="nf_util.one_check(this)"></label></td>
		</tr>
		<?php
		}
		?>
	</table>
</div>
<!--//tablewrap-->
<?php
}?>