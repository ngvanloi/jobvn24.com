<?php
$count = 0;
$service_len = 0;
$service_type = $nf_job->service_name_k[$code][$type];
if(is_array($nf_job->service_name[$code][$service_type])) { foreach($nf_job->service_name[$code][$service_type] as $k=>$v) {
	if($nf_job->service_info[$code][$type.'_'.$k]['use']) $service_len++;
} }
if($nf_job->service_info[$code][$type.'_border']['use']) $service_len++;
$service_page_txt = $nf_job->service_name_k_txt[$service_type];

if($service_len>0) {
?>
<h4 id="<?php echo $code;?>_<?php echo $code_sub;?>"><span class="orange"><?php echo $service_page_txt.$nf_job->kind_of[$code];?> 페이지</span> 상품 <a href="<?php echo $service_ahref;?>"><button type="button">서비스 신청</button></a></h4>
<div class="tablewrap indi_product">
	<table class="style2 fl">
		<tr>
			<th>미리보기</th>
		</tr>
		<tr>
			<td class="tac"><img src="<?php echo NFE_URL;?>/images/<?php echo $code;?>_<?php echo $service_type;?>_product.jpg" /></td>
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
		if(is_array($nf_job->service_name[$code][$service_type])) { foreach($nf_job->service_name[$code][$service_type] as $k=>$v) {
			if($type.'_'.$k=='0_list' && !$nf_job->service_info[$code][$type.'_'.$k]['is_pay']) continue; // : 일반리스트가 무료면 안나와야함.
			if($nf_job->service_info[$code][$type.'_'.$k]['use']) {
				$price_query = $db->_query("select * from nf_service_price where `code`=? and `type`=? order by `rank` asc", array($code, $type.'_'.$k));
				$price_len = $db->num_rows($price_query);
				$colspan_len = $price_len;
				if($code=='resume' && $count===0 && strpos($_SERVER['PHP_SELF'], '/service/index.php')===false) $colspan_len += 2;
				if($price_len>0) {
					$count2 = 0;
					$click_service_add = '';
					while($row=$db->afetch($price_query)) {
						$click_service_add = "nf_payment.click_service_child(this, '".$type.'_'.$k."');";
		?>
		<tr>
			<?php if($count2===0) {?>
			<td rowspan="<?php echo $colspan_len;?>" style="position:relative;">
				<div id="service_loc_<?php echo $code;?>_<?php echo $type.'_'.$k;?>" style="top:0px;margin-top:-55px;position:absolute;"></div>
				<span class="area_f"><?php echo substr($nf_util->alphabet,$count,1);?>영역</span>
				<h5><?php echo $v;?><button type="button" onClick="intro_service(this, '<?php echo $code;?>', '<?php echo $service_type;?>')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<?php
					// : 원래 li로 해야하는데 http://job.netfu.co.kr/nad/design/index.php 여기에서의 서비스안내대로 출력해서 css가 잘 안나옵니다.
					echo stripslashes($env['service_intro_arr'][$code][$type.'_'.$k]);
					?>
				</ul>
			</td>
			<?php }?>
			<td class="tac"><?php echo number_format(intval($row['service_cnt'])).$nf_util->date_count_arr[$row['service_unit']];?></td>
			<td class="price tar">
				<?php if($row['service_percent']>0) {?><p class="sale"><span><?php echo $row['service_percent'];?>%</span><?php echo number_format(intval($row['service_price']));?>원</p><?php }?>
				<p><em><?php echo $nf_util->get_price_int($row['service_price'], $row['service_percent']);?></em><?php if($row['service_price']>0) {?>원<?php }?></p>
			</td>
			<td class="tac choice"><label class="radiostyle2" ><input type="checkbox" class="service_click-" name="service[<?php echo $code;?>][<?php echo $type.'_'.$k;?>]" value="<?php echo $row['no'];?>" onClick="nf_util.one_check(this);<?php echo $click_service_add;?>"></label></td>
		</tr>
		<?php
		if(($count===0 && $count2===$price_len-1 && $code=='resume') && strpos($_SERVER['PHP_SELF'], '/service/index.php')===false) {
			$service_row = $db->query_fetch("select * from nf_service where `code`=? and `type`=?", array($code, $type.'_'.$k));
			$option_arr = explode("/", $service_row['option']);
		?>
		<tr>
			<th colspan="3"><?php echo $v;?> 전용 아이콘선택</th>
		</tr>
		<tr>
			<td colspan="3">
				<ul class="li_float li_float img_icon"> <?php /* service_$type.'_'.$k_child- */?>
					<?php
					if(is_array($option_arr)) { foreach($option_arr as $k2=>$v2) {?>
					<li><label><input type="checkbox" onClick="nf_payment.click_service_icon_len(this, 3)" name="service_icon[<?php echo $code;?>][<?php echo $type.'_'.$k;?>][]" hname="<?php echo $v;?> 전용 아이콘" value="<?php echo $v2;?>" /><img src="<?php echo NFE_URL;?>/data/service_option/<?php echo $v2;?>" alt=""></label></li>
					<?php
					} }?>
				</ul>
			</td>
		</tr>
		<?php
		}
						$count2++;
					}
				}
			}
			$count++;
		} }
		?>
	</table>


	<?php
	if($nf_job->service_info[$code][$type.'_border']['use']) {
		$price_query = $db->_query("select * from nf_service_price where `code`=? and `type`=? order by `rank` asc", array($code, $type.'_border'));
		$price_len = $db->num_rows($price_query);
		if($price_len>0) {
	?>
	<table class="style2 fl MAT10">
		<tr>
			<th>미리보기</th>
		</tr>
		<tr>
			<td class="tac"><img src="<?php echo NFE_URL;?>/images/<?php echo $code;?>_<?php echo $service_type;?>_product_border.jpg" /></td>
		</tr>
	</table>
	<table class="style2 fr MAT10">
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
			<td rowspan="<?php echo $price_len;?>">
				<h5><?php echo $service_page_txt;?> <?php echo $nf_job->kind_of[$code];?> 테두리강조<button type="button" onClick="intro_service(this, '<?php echo $code;?>', '<?php echo $type;?>_border')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<li><?php echo $service_page_txt;?> <?php echo $nf_job->kind_of[$code];?> 상품을 이용하는 고객전용입니다.</li>
					<li>테두리 라인을 색상으로 처리해 <?php echo $nf_job->kind_of[$code];?>정보를 강조해줍니다.</li>
				</ul>
			</td>
			<?php
			}?>
			<td class="tac"><?php echo number_format(intval($row['service_cnt'])).$nf_util->date_count_arr[$row['service_unit']];?></td>
			<td class="price tar">
				<?php if($row['service_percent']>0) {?><p class="sale"><span><?php echo $row['service_percent'];?>%</span><?php echo number_format(intval($row['service_price']));?>원</p><?php }?>
				<p><em><?php echo $nf_util->get_price_int($row['service_price'], $row['service_percent']);?></em><?php if($row['service_price']>0) {?>원<?php }?></p>
			</td>
			<td class="tac choice"><label class="radiostyle2" ><input type="checkbox" class="service_click-" name="service[<?php echo $code;?>][<?php echo $type;?>_border]" value="<?php echo $row['no'];?>" onClick="nf_util.one_check(this)"></label></td>
		</tr>
		<?php
			$count++;
		}?>
	</table>
	<?php
		}
	}?>
</div>
<?php
}?>