<div class="indi_menu left_menu">
	<div class="sub_mymenu">
		<h2>개인서비스<span><a href="<?php echo NFE_URL;?>/individual/index.php"><i class="axi axi-home"></i></a></span></h2>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/individual/resume_list.php">이력서 관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li><a href="<?php echo NFE_URL;?>/individual/resume_regist.php">새 이력서 작성</a></li>
					<li class="<?php echo $left_on['resume_list'];?>"><a href="<?php echo NFE_URL;?>/individual/resume_list.php">이력서 관리</a></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/individual/resume_onlines.php">면접지원 관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li class="<?php echo $left_on['resume_onlines'];?>"><a href="<?php echo NFE_URL;?>/individual/resume_onlines.php">지원 현황</a></li>
					<li class="<?php echo $left_on['resume_interview_input'];?>"><a href="<?php echo NFE_URL;?>/individual/resume_interview.php">면접제의 업소</a></li>
					<li class="<?php echo $left_on['resume_open'];?>"><a href="<?php echo NFE_URL;?>/individual/resume_open.php">내 이력서 열람 관리</a></li>
					<li class="<?php echo $left_on['company_info'];?>"><a href="<?php echo NFE_URL;?>/individual/company_info.php">열람한 구인정보</a></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/individual/customized.php">맞춤서비스 관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li class="<?php echo $left_on['scrap'];?>"><a href="<?php echo NFE_URL;?>/individual/scrap.php">스크랩한 구인정보</a></li>
					<li class="<?php echo $left_on['favorite_company'];?>"><a href="<?php echo NFE_URL;?>/individual/favorite_company.php">관심업소 정보</a></li>
					<li class="<?php echo $left_on['customized'];?>"><a href="<?php echo NFE_URL;?>/individual/customized.php">맞춤 구인정보</a></li>
					<?php if($env['use_message']) {?><li class="<?php echo $left_on['mail'];?>"><a href="<?php echo NFE_URL;?>/member/mail.php">쪽지 관리</a></li><?php }?>
					<!-- <li class="<?php echo $left_on['applycert'];?>"><a href="<?php echo NFE_URL;?>/individual/applycert.php">취업활동증명서</a></li> -->
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/service/index.php">유료서비스<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li><a href="<?php echo NFE_URL;?>/service/index.php?code=resume">유료서비스 안내</a></li>
					<li class="<?php echo $left_on['pay'];?>"><a href="<?php echo NFE_URL;?>/member/pay.php">유료결제내역</a></li>
					<li class="<?php echo $left_on['point_list'];?>"><a href="<?php echo NFE_URL;?>/member/point_list.php">포인트내역</a></li>

					<?php
					if($nf_payment->service_kind_arr['resume']['jump']['use']) {
					?>
					<li class="<?php echo $left_on['jump_list'];?> btd">
						<a href="javascript:void(0)">점프 서비스
							<?php if($member_service['mb_resume_jump_int']>0) {?>
							<span class="small">- 보유건수 : <em><?php echo number_format(intval($member_service['mb_resume_jump_int']));?></em>건</span>
							<?php }?>
						</a>
					</li>
					<li><button onclick="location.href='<?php echo NFE_URL;?>/service/product_payment.php?code=jump'">점프 서비스 구매하기</button></li>
					<?php
					}

					if($nf_payment->service_kind_arr['employ']['read']['use']) {
					?>
					<li class="btd">
						<a href="<?php echo NFE_URL;?>/individual/company_info.php">구인정보 열람권
							<?php if($member_service['mb_employ_read_int']>0) {?>
							<span class="small">- 보유건수 : <em><?php echo number_format(intval($member_service['mb_employ_read_int']));?></em>건</span>
							<?php }?>
							<?php if($member_service['mb_employ_read']>=today) {?>
							<span class="small">- 보유기간 : <em>~ <?php echo $member_service['mb_employ_read'];?></em></span>
							<?php }?>
						</a>
					</li> <!--열람한 구인정보 링크와 동일-->
					<li><button onclick="location.href='<?php echo NFE_URL;?>/service/product_payment.php?code=read'">열람권 구매하기</button></li>
					<?php
					}?>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="">개인정보관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li class="<?php echo $left_on['update_form'];?>"><a href="<?php echo NFE_URL;?>/member/update_form.php">개인정보 수정</a></li>
					<li class="<?php echo $left_on['password_form'];?>"><a href="<?php echo NFE_URL;?>/member/password_form.php">비밀번호 변경</a></li>
					<li class="<?php echo $left_on['tax'];?>"><a href="<?php echo NFE_URL;?>/individual/tax.php">현금영수증 발행신청</a></li>
					<li class="<?php echo $left_on['left_form'];?>"><a href="<?php echo NFE_URL;?>/member/left_form.php">회원탈퇴</a></li>
				</ul>
			</dd>
		</dl>
	</div>
	<div class="banner banner-group-br-">
		<?php
		$banner_arr = $nf_banner->banner_view('common_D');
		echo $banner_arr['tag'];
		?>
	</div>
</div>