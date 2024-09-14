<div><!--반복-->
	<div class="info">
		<div class="img_box">
			<p class="company" style="background-image:url(<?php echo $get_company_ex['mb_logo_src'];?>)"></p>
		</div>
		<div class="text_box">
			<h3>
				<?php if($row['is_public'] && $page_code=='company') {?><span>대표업소</span><?php }?>
				<?php echo $nf_util->get_text($row['mb_company_name']);?></h3>
			<dl>
				<dt>대표자명</dt>
				<dd><?php echo $nf_util->get_text($row['mb_ceo_name']);?></dd>
				<dt>전화번호</dt>
				<dd><?php echo $nf_util->get_text($row['mb_biz_phone'] ? $row['mb_biz_phone'] : $row['mb_biz_hphone']);?></dd>
				<dt>업소주소</dt>
				<dd class="line1"><?php echo $nf_util->get_text('['.$row['mb_biz_zipcode'].'] '.$row['mb_biz_address0'].' '.$row['mb_biz_address1']);?></dd>
			</dl>

		</div>
		<div class="btn">
			<ul>				
				<li><a href="<?php echo NFE_URL;?>/employ/list_type.php?cno=<?php echo $company_cno;?>">진행중인 공고(<?php echo number_format(intval($employ_cnt['c']));?>)</a></li>
				<?php
				switch($page_code) {
					// : 업소정보관리
					case "company":
						if(!$row['is_public']) {
				?>
					<li><a href="#none" onClick="nf_job.rep_company('<?php echo $row['no'];?>')">대표업소설정</a></li>
						<?php
						}?>
					<li><a href="<?php echo NFE_URL;?>/company/company_info_regist.php?no=<?php echo $row['no'];?>">수정</a></li>
					<li><a href="#none" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $row['no'];?>" mode="delete_company_info" url="../include/regist.php">삭제</a></li>
				<?php
					break;
					// : 내이력서 열람업소
					case "individual":
				?>
					<li><a href="#none" onClick="nf_job.not_open(this, '<?php echo $row['nr_no'];?>')"><?php echo $_GET['code']=='not_read' ? '열람제한해제' : '열람제한하기';?></a></li>
					<li><a href="#none" onclick="nf_util.ajax_post(this, '삭제하시겠습니까?')" no="<?php echo $row['nr_no'];?>" mode="delete_read_company_info" url="../include/regist.php">삭제</a></li>
				<?php
					break;

					// : 관심업소
					case "interest":
				?>
				<li><a href="#none" onClick="nf_util.interest(this, 'company', '<?php echo $company_cno;?>')">관심업소 해제</a></li>
				<?php
					break;
				}
				?>
			</ul>
		</div>
	</div>

	<?php
	switch($page_code) {
		// : 내이력서 열람업소
		case "individual":
	?>
	<div class="assi_line">
		<ul class="fl">
			<li>열람한 이력서 : <span><a href="" class="blue"><?php echo $nf_util->get_text($row['wr_subject']);?></a></span></li>
		</ul>
		<ul class="fr">
			<li>열람일 : <?php echo date("Y.m.d", strtotime($row['nr_rdate']));?></li>
		</ul>
	</div>
	<?php
		break;

		// : 관심업소
		case "interest":
	?>
	<div class="assi_line">
		<ul class="fr">
			<li>관심업소 등록일 : <?php echo date("Y.m.d", strtotime($row['ni_rdate']));?></li>
		</ul>
	</div>
	<?php
		break;
	}
	?>
</div><!--반복-->