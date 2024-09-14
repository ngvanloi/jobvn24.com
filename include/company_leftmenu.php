<div class="indi_menu left_menu">
	<div class="sub_mymenu">
		<h2>업소서비스<span><a href="<?php echo NFE_URL;?>/company/index.php"><i class="axi axi-home"></i></a></span></h2>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/company/employ_list.php">구인공고 관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li class="<?php echo $left_on['employ_regist'];?>"><a href="<?php echo NFE_URL;?>/company/employ_regist.php">구인공고 등록</a></li>
					<li class="<?php echo $left_on['employ_list'];?>"><a href="<?php echo NFE_URL;?>/company/employ_list.php">진행중인 구인공고</a></li>
					<li class="<?php echo $left_on['employ_list_end'];?>"><a href="<?php echo NFE_URL;?>/company/employ_list.php?code=end">마감된 구인공고</a></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/company/apply_list.php">인재 관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li class="<?php echo $left_on['apply_list'];?>"><a href="<?php echo NFE_URL;?>/company/apply_list.php">면접지원인재</a></li>
					<li class="<?php echo $left_on['interview'];?>"><a href="<?php echo NFE_URL;?>/company/interview.php">면접 제의 인재</a></li>
					<li class="<?php echo $left_on['scrap'];?>"><a href="<?php echo NFE_URL;?>/company/scrap.php">스크랩한 인재정보</a></li>
					<li class="<?php echo $left_on['resume_info'];?>"><a href="<?php echo NFE_URL;?>/company/resume_info.php">열람한 인재정보</a></li>
					<li class="<?php echo $left_on['customized'];?>"><a href="<?php echo NFE_URL;?>/company/customized.php">맞춤 인재정보</a></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/company/company_info.php">서비스 관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li class="<?php echo $left_on['company_info'];?>"><a href="<?php echo NFE_URL;?>/company/company_info.php">업소정보 관리</a></li>
					<li class="<?php echo $left_on['manager_info'];?>"><a href="<?php echo NFE_URL;?>/company/manager_info.php">구인 담당자 관리</a></li>
					<?php if($env['use_message']) {?><li class="<?php echo $left_on['mail'];?>"><a href="<?php echo NFE_URL;?>/member/mail.php">쪽지 관리</a></li><?php }?>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/member/pay.php">유료서비스<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li><a href="<?php echo NFE_URL;?>/service/index.php">유료서비스 안내</a></li>
					<li class="<?php echo $left_on['pay'];?>"><a href="<?php echo NFE_URL;?>/member/pay.php">유료결제내역</a></li>
					<li class="<?php echo $left_on['point_list'];?>"><a href="<?php echo NFE_URL;?>/member/point_list.php">포인트내역</a></li>

					<?php
					if($nf_payment->service_kind_arr['employ']['jump']['use']) {
					?>
					<li class="<?php echo $left_on['jump_list'];?> btd">
						<a href="javascript:void(0)">점프 서비스
						<?php if($member_service['mb_employ_jump_int']>0) {?>
						<span class="small">- 보유건수 : <em><?php echo number_format(intval($member_service['mb_employ_jump_int']));?></em>건</span>
						<?php }?>
						</a>
					</li>
					<li><button onclick="location.href='<?php echo NFE_URL;?>/service/product_payment.php?code=jump'">점프 서비스 구매하기</button></li>
					<?php
					}

					if($nf_payment->service_kind_arr['resume']['read']['use']) {
					?>
					<li class="btd">
						<a href="<?php echo NFE_URL;?>/company/resume_info.php">이력서 열람권
						<?php if($member_service['mb_resume_read_int']>0) {?>
							<span class="small">- 보유건수 : <em><?php echo number_format(intval($member_service['mb_resume_read_int']));?></em>건</span>
						<?php }?>
						<?php if($member_service['mb_resume_read']>=today) {?>
							<span class="small">- 보유기간 : <em>~ <?php echo $member_service['mb_resume_read'];?></em></span>
						<?php }?>
						</a>
					</li> <!--열람한 인재정보 링크와 동일-->
					<li><button onclick="location.href='<?php echo NFE_URL;?>/service/product_payment.php?code=read'">열람권 구매하기</button></li>
					<?php
					}?>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><a href="<?php echo NFE_URL;?>/member/update_form.php">업소정보관리<i class="axi axi-keyboard-arrow-down"></i></a></dt>
			<dd>
				<ul>
					<li class="<?php echo $left_on['update_form'];?>"><a href="<?php echo NFE_URL;?>/member/update_form.php">업소정보 수정</a></li>
					<li class="<?php echo $left_on['password_form'];?>"><a href="<?php echo NFE_URL;?>/member/password_form.php">비밀번호 변경</a></li>
					<li class="<?php echo $left_on['tax'];?>"><a href="<?php echo NFE_URL;?>/company/tax.php">세금계산서 발행신청</a></li>
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