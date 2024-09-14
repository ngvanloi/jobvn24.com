<script type="text/javascript">
var resume_open = function(el, no) {
	$.post(root+"/include/regist.php", "mode=resume_open&no="+no, function(data){
		data = $.parseJSON(data);
		if(data.msg) alert(data.msg);
		if(data.move) location.href = data.move;
		if(data.js) eval(data.js);
	});
}
</script>
<div class="tabcon">
	<?php
	switch($total['c']<=0) {
		case true:
	?>
	<div class="no_content">
		<p>등록된 이력서가 없습니다. <br><a href="<?php echo NFE_URL;?>/individual/resume_regist.php"><button type="button">이력서 작성하기</button></p></a>
	</div>
	<?php
		break;


		default:
			while($re_row=$db->afetch($resume_query)) {
				$resume_info = $nf_job->resume_info($re_row);
				$get_service_info = $nf_payment->get_service_info($re_row, 'resume');

				$read_int = $db->query_fetch("select sum(visit) as c from nf_read where `mb_type`='company' and `code`='resume' and `pno`=".intval($re_row['no']));
	?>
	<div>
		<div class="img_box">
			<p class="injae" style="background-image:url(<?php echo $member['photo_src'];?>)"></p>
		</div>
		<div class="info_box">
			<a href="<?php echo NFE_URL;?>/resume/resume_detail.php?no=<?php echo $re_row['no'];?>">
				<h2><?php echo $nf_util->get_text($re_row['wr_subject']);?></h2>
				<dl>
					<dt>급여</dt>
					<dd><?php echo $resume_info['price_txt'];?></dd>
					<dt>희망근무지</dt>
					<dd>
						<?php
						$area_arr = array();
						if(is_array($resume_info['area_arr'])) { foreach($resume_info['area_arr'] as $k=>$v) {
							$v_arr = explode(",", substr($v,0,-1));
							$area_text = $v_arr[3];
							unset($v_arr[3]);
							$v_arr = array_diff($v_arr, array(""));
							$v_text = implode(",", $v_arr);
							$area_arr[] = strtr(strtr($v_text, $cate_array['area']), array(","=>" > ")).' '.$area_text;
						} }
						echo implode("<br/> ", $area_arr);
						?>
					</dd>
				</dl>
				<dl>
					<dt>희망직종</dt>
					<dd>
						<?php
						$job_type_arr = array();
						if(is_array($resume_info['job_type_arr'])) { foreach($resume_info['job_type_arr'] as $k=>$v) {
							$v_arr = array_diff(explode(",", $v), array(""));
							$v_txt = implode(",", $v_arr);
							$job_type_arr[] = strtr(strtr($v_txt, $cate_array['job_part']), array(","=>" > "));
						} }
						echo implode("<br/> ", $job_type_arr);
						?>
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
				<th>서비스 내역</th>
			</tr>
			<tr>
				<td>
					<ul>
						<li><span>등록일 :</span> <?php echo date("Y.m.d", strtotime($re_row['wr_wdate']));?></li>
						<li><span>수정일 :</span> <?php echo date("Y.m.d", strtotime($re_row['wr_udate']));?></li>
						<li><span>업소열람횟수 :</span> <span class="blue"><?php echo number_format(intval($read_int['c']));?></span>건</li>
					</ul>
				</td>
				<td>
					<?php
					if($get_service_info['count']>0) {
					?>
						<?php if($env['service_resume_use']) {?>
						<a href="<?php echo NFE_URL;?>/service/product_payment.php?code=resume&no=<?php echo $re_row['no'];?>"><button type="button" class="red">서비스연장·추가</button></a>
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
					<?php } else if($env['service_resume_use']) {?>
						<a href="<?php echo NFE_URL;?>/service/product_payment.php?code=resume&no=<?php echo $re_row['no'];?>"><button type="button" class="blue">서비스신청하기</button></a>
					<?php }?>
				</td>
			</tr>
		</table>
		<div class="assi_line">
			<ul>
				<li>이력서설정 : <button type="button" onClick="resume_open(this, '<?php echo $re_row['no'];?>')" class="resume_open- <?php echo $re_row['wr_open'] ? 'blue' : 'red';?>"><?php echo $re_row['wr_open'] ? '공개' : '비공개';?></button></a></li>
			</ul>
			<ul>
				<?php if($nf_payment->service_kind_arr['resume']['jump']['use']) {?>
				<li><!--점프권이 있을경우에 표기-->
					<dl>
						<dt><a href="#none" onClick="nf_job.click_jump('resume', '<?php echo $re_row['no'];?>')"><i class="axi axi-ion-arrow-up-c"></i> 점프하기</a></dt>
						<dd>남은 점프횟수 <span class="resume_jump_int-"><?php echo number_format(intval($member_service['mb_resume_jump_int']));?></span></dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt style="color:#fff; padding:0 3px;">자동점프</dt>
						<dd><label><input type="radio" name="wr_jump_use_<?php echo $re_row['no'];?>" onClick="nf_job.jump_use(this, 'resume', '<?php echo $re_row['no'];?>')" value="1" <?php echo $re_row['wr_jump_use']==='1' ? 'checked' : '';?>>사용</label> <label><input type="radio" name="wr_jump_use_<?php echo $re_row['no'];?>" onClick="nf_job.jump_use(this, 'resume', '<?php echo $re_row['no'];?>')" value="0" <?php echo $re_row['wr_jump_use']==='0' ? 'checked' : '';?>>미사용</label></dd>
					</dl>
				</li>
				<?php }?>
				<li><a href="<?php echo NFE_URL;?>/individual/resume_regist.php?no=<?php echo $re_row['no'];?>">수정</a></li>
				<li><a href="<?php echo NFE_URL;?>/individual/resume_regist.php?info_no=<?php echo $re_row['no'];?>" onClick="copy_resume('<?php echo $re_row['no'];?>')">복사</a></li>
				<li><a href="#none" onClick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $re_row['no'];?>" mode="delete_resume" url="<?php echo NFE_URL;?>/include/regist.php">삭제</a></li>
			</ul>
		</div>
	</div>
	<?php
			}
		break;
	}
	?>
	<a href="./resume_list.php"><button type="button" class="more">더보기 <i class="axi axi-plus"></i></button></a>
</div>