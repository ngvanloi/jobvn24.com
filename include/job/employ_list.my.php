<div class="tabcon">
	<?php
	switch($_arr['total']<=0) {
		case true:
	?>
	<div class="no_content">
		<p><?php echo $_GET['code']=='end' ? '마감된' : '진행중인';?> 구인공고가 없습니다. <br><a href="<?php echo NFE_URL;?>/company/employ_regist.php"><button type="button">공고 작성하기</button></a></p>
	</div>
	<?php
		break;


		default:
			while($em_row=$db->afetch($employ_query)) {
				$employ_info = $nf_job->employ_info($em_row);
				$get_service_info = $nf_payment->get_service_info($em_row, 'employ');
				$accept_int = $db->query_fetch("select count(*) as c from nf_accept where `pmno`=? and `pno`=?", array($member['no'], $em_row['no']));
	?>
	<div>
		<div class="img_box">
			<p class="company <?php echo $employ_info['logo_class'];?>" <?php if($employ_info['logo_'.$employ_info['wr_logo_type']]) {?>style="background-image:url(<?php echo $employ_info['logo_'.$employ_info['wr_logo_type']];?>)"<?php }?>><?php echo $employ_info['logo_text'];?></p>
		</div>
		<div class="info_box">
			<a href="<?php echo NFE_URL;?>/employ/employ_detail.php?no=<?php echo $em_row['no'];?>">
				<h2><?php echo $nf_util->get_text($em_row['wr_subject']);?></h2>
				<dl>
					<dt>업소명</dt>
					<dd><?php echo $nf_util->get_text($em_row['wr_company_name']);?>&nbsp;</dd>					
					<dt>급여</dt>
					<dd><?php echo $employ_info['pay_txt'];?>&nbsp;</dd>
				</dl>
				<dl>					
					<dt>업·직종</dt>
					<dd>
						<?php
						$job_type_arr = array();
						if(is_array($employ_info['job_type_arr'])) { foreach($employ_info['job_type_arr'] as $k=>$v) {
							$v_arr = array_diff(explode(",", $v), array(""));
							$v_txt = implode(",", $v_arr);
							$job_type_arr[] = strtr(strtr($v_txt, $cate_array['job_part']), array(","=>" > "));
						} }
						echo implode("<br/> ", $job_type_arr);
						?>&nbsp;
					</dd>
					<dt>근무지</dt>
					<dd>
						<?php
						$area_arr = array();
						if(is_array($employ_info['area_arr'])) { foreach($employ_info['area_arr'] as $k=>$v) {
							$v_arr = explode(",", substr($v,0,-1));
							$area_text = $v_arr[4];
							$work_time = $v_arr[5] ? '재택근무' : '';
							unset($v_arr[4]);
							unset($v_arr[5]);
							$v_arr = array_diff($v_arr, array(""));
							$v_text = implode(",", $v_arr);
							$area_arr[] = strtr(strtr($v_text, $cate_array['area']), array(","=>" ")).' '.$area_text.($work_time ? ' ('.$work_time.')' : '');
						} }
						echo implode("<br/> ", $area_arr);
						?>&nbsp;
					</dd>
				</dl>
			</a>
		</div>
		<table>
			<colgroup>
				<col width="50%">
				<col width="50%">
			</colgroup>
			<tr>
				<th>부가정보</th>
				<th>유료서비스 내역</th>
			</tr>
			<tr>
				<td>
					<ul>
						<li><span>등록일 :</span> <?php echo date("Y.m.d", strtotime($em_row['wr_wdate']));?></li>
						<li><span>마감일 :</span> <?php echo $employ_info['end_date'];?></li>
						<li><a href="<?php echo NFE_URL;?>/company/apply_list.php?eno=<?php echo $em_row['no'];?>"><span>지원자 :</span> <span class="blue"><?php echo number_format(intval($accept_int['c']));?></span> 명</a></li>
					</ul>
				</td>
				<td>
					<?php
					if($get_service_info['count']>0) {
					?>
						<?php if($env['service_employ_use']) {?>
						<a href="<?php echo NFE_URL;?>/service/product_payment.php?code=employ&no=<?php echo $em_row['no'];?>"><button type="button" class="red">서비스연장·추가</button></a>
						<?php }?>
						<ul>
							<?php
							foreach($get_service_info['text'] as $k=>$v) {
								$get_date = $get_service_info['date'][$k];
							?>
							<li><?php echo $v;?> (~ <?php echo date("Y/m/d", strtotime($get_date));?>)</li>
							<?php
							}?>
						</ul>
					<?php } else if($env['service_employ_use']) {?>
						<a href="<?php echo NFE_URL;?>/service/product_payment.php?code=employ&no=<?php echo $em_row['no'];?>"><button type="button" class="blue">서비스신청하기</button></a>
					<?php }?>
				</td>
			</tr>
		</table>
		<div class="assi_line">
			<ul>
				<li>공고수정일 : <?php echo date("Y.m.d", strtotime($em_row['wr_udate']));?></li>
			</ul>
			<ul>
				<?php if($nf_payment->service_kind_arr['employ']['jump']['use']) {?>
				<li><!--점프권이 있을경우에 표기-->
					<dl>
						<dt><a href="#none" onClick="nf_job.click_jump('employ', '<?php echo $em_row['no'];?>')"><i class="axi axi-ion-arrow-up-c"></i> 점프하기</a></dt>
						<dd>남은 점프횟수 <span class="employ_jump_int-"><?php echo number_format(intval($member_service['mb_employ_jump_int']));?></span></dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt style="color:#fff; padding:0 3px;">자동점프</dt>
						<dd><label><input type="radio" name="wr_jump_use_<?php echo $em_row['no'];?>" onClick="nf_job.jump_use(this, 'employ', '<?php echo $em_row['no'];?>')" value="1" <?php echo $em_row['wr_jump_use']==='1' ? 'checked' : '';?>>사용</label> <label><input type="radio" name="wr_jump_use_<?php echo $em_row['no'];?>" onClick="nf_job.jump_use(this, 'employ', '<?php echo $em_row['no'];?>')" value="0" <?php echo $em_row['wr_jump_use']==='0' ? 'checked' : '';?>>미사용</label></dd>
					</dl>
				</li>
				<?php }?>
				<?php if($_GET['code']!='end') {?>
				<li><a href="#none" onClick="nf_job.click_end_date('<?php echo $em_row['no'];?>')">마감</a></li>
				<?php }?>
				<li><a href="<?php echo NFE_URL;?>/company/employ_regist.php?no=<?php echo $em_row['no'];?>">수정</a></li>
				<li><a href="<?php echo NFE_URL;?>/company/employ_regist.php?code=copy&no=<?php echo $em_row['no'];?>">복사</a></li>
				<li><a href="#none" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo intval($em_row['no']);?>" mode="delete_employ" url="../include/regist.php">삭제</a></li>
			</ul>
		</div>
	</div>
	<?php
			}
		break;
	}


	if(strpos($_SERVER['PHP_SELF'], "/company/employ_list.php")!==false) {
	?>
	<div class="select_area">
		<ul class="fr">
			<li>
				<select name="page_row" onChange="nf_util.ch_page_row(this, 'fsearch1')">
					<option value="15" <?php echo $_GET['page_row']=='15' ? 'selected' : '';?>>15개씩 보기</option>
					<option value="30" <?php echo $_GET['page_row']=='30' ? 'selected' : '';?>>30개씩 보기</option>
					<option value="50" <?php echo $_GET['page_row']=='50' ? 'selected' : '';?>>50개씩 보기</option>
					<option value="100" <?php echo $_GET['page_row']=='100' ? 'selected' : '';?>>100개씩 보기</option>
				</select>
			</li>
		</ul>
	</div>
	<?php
	}?>


	<?php
	$btn_more = false;
	if(strpos($_SERVER['PHP_SELF'], '/company/index.php')!==false) $btn_more = true;
	if($btn_more) {
	?>
	<a href="<?php echo NFE_URL;?>/company/employ_list.php"><button type="button" class="more">더보기 <i class="axi axi-plus"></i></button></a>
	<?php
	}?>
</div>
<!--//tabcon-->