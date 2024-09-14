<h4 id="<?php echo $code;?>_option"><span class="orange">강조옵션 </span> 상품 <a href="<?php echo $service_ahref;?>"><button type="button">서비스 신청</button></a></h4>
<div class="tablewrap accent">
	<table class="style2">
		<tr>
			<th class="m_none">미리보기</th>
			<th>서비스명</th>
			<th colspan="3">기간선택</th>
		</tr>
		<!--아이콘-->
		<?php
		$subject_class = array('neon'=>'bgcol', 'color'=>'tcol', 'bold'=>'fwb');
		$option_subject_text = array('employ'=>'함께 업소을 꾸려나갈 인재를 모집합니다.', 'resume'=>'모든일에 최선을 다하는 열정을 가지고 있습니다.');
		if(is_array($nf_job->etc_service)) { foreach($nf_job->etc_service as $k=>$v) {
			if(in_array($k, array('busy', 'jump'))) continue;
			if(!$nf_job->service_info[$code][$k]['use']) continue;
			$price_query = $db->_query("select * from nf_service_price where `code`=? and `type`=? order by `rank` asc", array($code, $k));
			$length = $db->num_rows($price_query);
			$count = 0;
			while($row=$db->afetch($price_query)) {
		?>
		<tr>
			<?php
			if($count===0) {
			?>
			<td rowspan="<?php echo $length;?>" class="ij_preview">
				<div>
					<p class="title line1 <?php echo $subject_class[$k];?><?php if(in_array($k, array('neon','color'))) {?>1<?php }?>"><?php if($k==='icon') {?><img src="../images/icon_company_00.gif"><?php }?><span class="<?php echo $k=='blink' ? 'service-blink-' : '';?>"><?php echo $option_subject_text[$code];?></span></p>
				</div>
				<?php if(in_array($k, array('icon', 'neon', 'color'))) {?>
				<div>
					<p class="title line1 <?php echo $subject_class[$k];?><?php if(in_array($k, array('neon','color'))) {?>2<?php }?>"><?php if($k==='icon') {?><img src="../images/icon_company_01.gif"><?php }?><?php echo $option_subject_text[$code];?>
					</p>
				</div>
				<?php }?>
			</td>
			<?php
				$option_arr = explode("/", $nf_job->service_info[$code][$k]['option']);
				$click_service_add = '';
				switch($k) {
					case "icon":
						$click_service_add = "nf_payment.click_option_child(this, '".$k."');";
			?>
			<td rowspan="<?php echo $length;?>">
				<h5><?php echo $v;?><button type="button" onClick="intro_service(this, '<?php echo $code;?>', '<?php echo $k;?>')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<li><?php echo $nf_job->kind_of[$code];?>정보 리스트 제목 앞을 아이콘으로 강조 효과</li>
				</ul>
				<ul class="li_float img_icon option_<?php echo $k;?>_child_rado-">
					<?php
					if(is_array($option_arr)) { foreach($option_arr as $k2=>$v2) {
						if(is_file(NFE_PATH.'/data/service_option/'.$v2)) {
					?>
					<li><label><input type="radio" class="pay-view-" hname="아이콘 옵션" name="service_option[<?php echo $code;?>][<?php echo $k;?>]" value="<?php echo $v2;?>"><img src="<?php echo NFE_URL;?>/data/service_option/<?php echo $v2;?>" alt=""></label></li>
					<?php
						}
					} }?>
				</ul>
			</td>
			<?php
					break;


					case "neon":
						$click_service_add = "nf_payment.click_option_child(this, '".$k."');";
			?>
			<td rowspan="<?php echo $length;?>">
				<h5>형광펜<button type="button" onClick="intro_service(this, '<?php echo $code;?>', '<?php echo $k;?>')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<li><?php echo $nf_job->kind_of[$code];?>정보 리스트 제목을 형광펜 강조 효과</li>
				</ul>
				<ul class="li_float img_icon option_<?php echo $k;?>_child_rado-">
					<?php
					if(is_array($option_arr)) { foreach($option_arr as $k2=>$v2) {
					?>
					<li><label><input type="radio" class="pay-view-" hname="형광펜 옵션" name="service_option[<?php echo $code;?>][<?php echo $k;?>]" value="<?php echo $v2;?>">
					<p class="title bgcol1" style="background-color:<?php echo $v2;?>">형광펜강조효과</p></label>
					</li>
					<?php
					} }?>
				</ul>
			</td>
			<?php
					break;


					case "color":
						$click_service_add = "nf_payment.click_option_child(this, '".$k."');";
			?>
			<td rowspan="<?php echo $length;?>">
				<h5>글자색<button type="button" onClick="intro_service(this, '<?php echo $code;?>', '<?php echo $k;?>')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<li><?php echo $nf_job->kind_of[$code];?>정보 리스트 제목을 글자색으로 강조 효과</li>
				</ul>
				<ul class="li_float img_icon option_<?php echo $k;?>_child_rado-">
					<?php
					if(is_array($option_arr)) { foreach($option_arr as $k2=>$v2) {
					?>
					<li><label><input type="radio" class="pay-view-" hname="글자색 옵션" name="service_option[<?php echo $code;?>][<?php echo $k;?>]" value="<?php echo $v2;?>"><p class="title tcol1" style="color:<?php echo $v2;?> !important">글자색강조효과</p></label></li>
					<?php
					} }?>
				</ul>
			</td>
			<?php
					break;


					case "bold":
			?>
			<td rowspan="<?php echo $length;?>">
				<h5>굵은글자<button type="button" onClick="intro_service(this, '<?php echo $code;?>', '<?php echo $k;?>')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<li><?php echo $nf_job->kind_of[$code];?>정보 리스트 제목을 굵은 글자로 강조 효과</li>
				</ul>
			</td>
			<?php
					break;


					case "blink":
			?>
			<td rowspan="<?php echo $length;?>">
				<h5>반짝칼라 글자<button type="button" onClick="intro_service(this, '<?php echo $code;?>', '<?php echo $k;?>')"><i class="axi axi-question-circle"></i></button></h5>
				<ul class="product_info">
					<li><?php echo $nf_job->kind_of[$code];?>정보 리스트 제목을 반짝칼러 강조 효과</li>
				</ul>
			</td>
			<?php
					break;
				}
			}?>
			<td class="tac"><?php echo number_format(intval($row['service_cnt'])).strtr($row['service_unit'], $nf_util->date_count_arr);?></td>
			<td class="price tar">
				<?php if($row['service_percent']>0) {?><p class="sale"><span><?php echo $row['service_percent'];?>%</span><?php echo number_format(intval($row['service_price']));?>원</p><?php }?>
				<p><em><?php echo $nf_util->get_price_int($row['service_price'], $row['service_percent']);?></em><?php if($row['service_price']>0) {?>원<?php }?></p>
			</td>
			<td class="tac choice"><label class="radiostyle2" ><input type="checkbox" class="service_click-" name="service[<?php echo $code;?>][<?php echo $k;?>]" value="<?php echo $row['no'];?>" onClick="nf_util.one_check(this);<?php echo $click_service_add;?>"></label></td>
		</tr>
		<?php
				$count++;
			}
		} }
		?>
	</table>
</div>
<!--//tablewrap-->