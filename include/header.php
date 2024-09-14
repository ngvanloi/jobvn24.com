<style type="text/css">
	.quick_my {
		display: none;
	}

	.m-submenu-child- {
		display: none;
	}

	.m-submenu-child-menu-child- {
		display: none;
	}
</style>

<div class="sticky_wrap">
	<div class="header_wrap">
		<header>
			<ul class="util">
				<li class="search"><a href=""><i class="axi axi-search3"></i></a></li>
				<?php
				if (sess_user_uid) {
					?>
					<li><a href="<?php echo NFE_URL; ?>/include/regist.php?mode=logout">로그아웃</a></li>
					<li><a href="#none" onClick="nf_util.openWin('.quick_my')"><?php echo $member['mb_nick']; ?>님 <i
								class="axi axi-keyboard-arrow-down"></i></a><!--개인회원으로 로그인되었을때-->
						<ul class="quick_my">
							<?php
							switch ($member['mb_type']) {
								case "individual":
									?>
									<li><a href="<?php echo NFE_URL; ?>/individual/index.php">MY개인서비스 홈</a></li>
									<li><a href="<?php echo NFE_URL; ?>/individual/resume_list.php">이력서 관리</a></li>
									<li><a href="<?php echo NFE_URL; ?>/individual/resume_interview.php">입사지원 관리</a></li>
									<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">회원정보수정</a></li>
									<?php
									break;

								case "company":
									?>
									<li><a href="<?php echo NFE_URL; ?>/company/index.php">MY업소서비스 홈</a></li>
									<li><a href="<?php echo NFE_URL; ?>/company/employ_list.php">구인공고 관리</a></li>
									<li><a href="<?php echo NFE_URL; ?>/company/apply_list.php">지원자 관리</a></li>
									<li><a href="<?php echo NFE_URL; ?>/company/pay.php">결제내역 관리</a></li>
									<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">업소정보수정</a></li>
									<?php
									break;
							}
							?>
						</ul>
					</li>
					<?php
				} else {
					?>
					<li><a href="<?php echo NFE_URL; ?>/member/login.php">đăng nhập</a></li>
					<li><a href="<?php echo NFE_URL; ?>/member/register.php">tham gia thành viên
						</a></li>
					<?php
				} ?>
				<li><a href="<?php echo NFE_URL; ?>/service/cs_center.php">trung tâm dịch vụ khách hàng
					</a></li>
				<li><a
						href="<?php echo NFE_URL; ?>/service/index.php?<?php echo $member['mb_type'] == 'individual' ? 'code=resume' : ''; ?>">Thông
						tin dịch vụ
					</a>
				</li>
			</ul>
			<div class="top_area">
				<h1 class="logo"><a href="<?php echo main_page; ?>"><img
							src="<?php echo NFE_URL . '/data/logo/' . $env['logo_top']; ?>" alt="로고"></a></h1>
				<div class="main_search">
					<form action="<?php echo NFE_URL; ?>/main/search.php" method="get">
						<div class="search_style">
							<label for="">
								<input type="text" name="top_keyword"
									value="<?php echo $nf_util->get_html($_GET['top_keyword']); ?>"
									placeholder="Vui lòng nhập từ cần tìm kiếm">
								<button type="submit"><i class="axi axi-search3"></i></button>
							</label>
						</div>
					</form>
				</div>
				<ul class="regist_btn">
					<li><a href="<?php echo NFE_URL; ?>/company/employ_regist.php"><span><img
									src="../images/employment_icon.png" alt="Đăng ký tin tuyển dụng
"></span>Đăng ký tin tuyển dụng
						</a></li>
					<li><a href="<?php echo NFE_URL; ?>/individual/resume_regist.php"><span><!--img src="img/resume_icon.png"--></span></span>Đăng
							ký sơ yếu lý lịch
						</a>
					</li>
					<li class="m_menubtn"><a href="#none" onClick="nf_util.openWin('.m-menu-body-', 'block')"><i
								class="axi axi-menu2"></i></a></li>
				</ul>
			</div>
		</header>
		<!--스킨1,2  스킨1 = skin1, 스킨2 = skin2-->

		<!--//스킨1, 2-->

		<div class="bgblack"></div> <!--메뉴hover시 깔리는bg-->



		<!--모바일메뉴-->
		<?php
		$_mb_type_ = $member['mb_type'] ? $member['mb_type'] : 'company';
		$member_menu_chk = $member['no'] ? 1 : 0;
		?>
		<section class="m_nav m-menu-body-" style="display:none">
			<div class="m_menu">
				<div class="m_top">
					<div class="">
						<?php if ($member['no']) { ?>
							<p><?php echo $member['mb_name']; ?>님 <span><a
										href="<?php echo NFE_URL; ?>/include/regist.php?mode=logout">đăng xuất
									</a></span></p>
							<!--로그인 후-->
						<?php } else { ?>
							<p>Vui lòng đăng nhập
								<span><a href="<?php echo NFE_URL; ?>/member/login.php">đăng nhập
									</a></span>
							</p>
							<!--로그인 전-->
						<?php } ?>
						<button type="button" class="m_menu_close" onClick="nf_util.noneWin('.m-menu-body-')"><i
								class="axi axi-ion-close"></i></button>
					</div>
					<ul>
						<li
							style="display:<?php echo (!$member['no'] || $member['mb_type'] == 'company') ? 'block' : 'none'; ?>;">
							<a href="<?php echo NFE_URL; ?>/company/employ_regist.php"><i class="axi axi-paper"></i>Đăng
								ký thông tin việc làm
							</a>
						</li>
						<li
							style="display:<?php echo (!$member['no'] || $member['mb_type'] == 'individual') ? 'block' : 'none'; ?>;">
							<a href="<?php echo NFE_URL; ?>/individual/resume_regist.php"><i
									class="axi axi-pencil"></i>Đăng ký sơ yếu lý lịch
							</a>
						</li>
						<li><a href="<?php echo NFE_URL; ?>/<?php echo $_mb_type_; ?>/index.php">Dịch vụ của tôi
							</a></li>
					</ul>
				</div>
				<?php if (!$member_menu_chk) { //회원이 아닐때 ?>
					<ul class="m_nav_1d">
						<li><a href="#none" class="<?php echo !$_COOKIE['_m-submenu-'] ? 'on' : ''; ?> m-submenu-" k=0>Thông
								tin việc làm
							</a>
							<ul class="m-submenu-child- m_nav_2d"
								style="display:<?php echo !$_COOKIE['_m-submenu-'] ? 'block' : 'none'; ?>;">
								<li><a href="<?php echo NFE_URL; ?>/employ/list_type.php" class="arrow_no">Xem tất cả thông
										tin việc làm
									</a>
								</li>
								<?php if ($nf_category->job_part_adult) { ?>
									<li><a href="<?php echo NFE_URL; ?>/employ/list_type.php?code=adult" class="arrow_no">19+
											Thông tin việc làm</a></li>
								<?php } ?>
								<li><a href="#none" class="on m-submenu-child-menu-" k=0 parent="ul">Cơ hội việc làm theo
										ngành/nghề nghiệp
									</a>
									<ul class="m_nav_3d m-submenu-child-menu-child-"
										style="display:<?php echo !$_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
										<?php
										if (is_array($cate_p_array['job_part'][0])) {
											foreach ($cate_p_array['job_part'][0] as $k => $v) {
												?>
												<li><a
														href="<?php echo NFE_URL; ?>/employ/list_type.php?code=job_part&wr_job_type[]=<?php echo $v['no']; ?>#employ-list-start-">-
														&nbsp;<?php echo $v['wr_name']; ?></a></li>
												<?php
											}
										} ?>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=1 parent="ul">Theo khu vực
									</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
										<?php
										if (is_array($cate_p_array['area'][0])) {
											foreach ($cate_p_array['area'][0] as $k => $v) {
												?>
												<li><a
														href="<?php echo NFE_URL; ?>/employ/list_type.php?code=area&wr_area[]=<?php echo $v['wr_name']; ?>#employ-list-start-">-
														&nbsp;<?php echo $v['wr_name']; ?></a></li>
												<?php
											}
										} ?>
									</ul>
								</li>
							</ul>
						</li>
						<li><a href="javascript:void(0)"
								class="<?php echo $_COOKIE['_m-submenu-'] === '1' ? 'on' : ''; ?> m-submenu-" k=1>Thông tin
								nhân tài
							</a>
							<ul class="m-submenu-child- m_nav_2d"
								style="display:<?php echo $_COOKIE['_m-submenu-'] === '1' ? 'block' : 'none'; ?>;">
								<li><a href="<?php echo NFE_URL; ?>/resume/resume_list.php" class="arrow_no">Xem tất cả
										thông tin tài năng
									</a>
								</li>
								<li><a href="javascript:void(0)" class="on m-submenu-child-menu-" k=0 parent="ul">Theo
										ngành/nghề nghiệp tài năng</a>
									<ul class="m_nav_3d m-submenu-child-menu-child-"
										style="display:<?php echo !$_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
										<?php
										if (is_array($cate_p_array['job_part'][0])) {
											foreach ($cate_p_array['job_part'][0] as $k => $v) {
												?>
												<li><a
														href="<?php echo NFE_URL; ?>/resume/resume_list.php?code=job_part&wr_job_type[]=<?php echo $v['no']; ?>#employ-list-start-">-
														&nbsp;<?php echo $v['wr_name']; ?></a></li>
												<?php
											}
										} ?>
									</ul>
								</li>
								<li><a href="javascript:void(0)" class="m-submenu-child-menu-" k=1 parent="ul">지역별</a>
									<ul class="m_nav_3d m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
										<?php
										if (is_array($cate_p_array['area'][0])) {
											foreach ($cate_p_array['area'][0] as $k => $v) {
												?>
												<li><a
														href="<?php echo NFE_URL; ?>/resume/resume_list.php?code=area&wr_area[]=<?php echo $v['wr_name']; ?>&#resume-list-start-"><?php echo $v['wr_name']; ?></a>
												</li>
												<?php
											}
										} ?>
									</ul>
								</li>
							</ul>
						</li>
						<li
							style="display:<?php echo (!$member['no'] || $member['mb_type'] == 'company') ? 'block' : 'none'; ?>;">
							<a href="#none" class="<?php echo $_COOKIE['_m-submenu-'] === '2' ? 'on' : ''; ?> m-submenu-"
								k=2><?php echo $member['no'] ? 'MY서비스' : '업소서비스'; ?></a>
							<ul class="m-submenu-child- m_nav_2d"
								style="display:<?php echo $_COOKIE['_m-submenu-'] === '2' ? 'block' : 'none'; ?>;">
								<li><a href="<?php echo NFE_URL; ?>/<?php echo $_mb_type_; ?>/index.php"
										class="arrow_no">업소서비스 홈</a></li>
								<li><a href="#none" class="m-submenu-child-menu-" k=0 parent="ul">구인공고 관리</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/company/employ_regist.php">구인공고등록</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company/employ_list.php">진행중인 구인공고</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company//employ_list.php?code=end">마감된 구인공고</a>
										</li>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=1 parent="ul">인재 관리</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/company/apply_list.php">입사지원인재</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company/interview.php">면접·입사 제의 인재</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company/scrap.php">스크랩한 인재정보</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company/resume_info.php">열람한 인재정보</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company/customized.php">맞춤 인재정보</a></li>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=2 parent="ul">서비스 관리</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '2' ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/company/company_info.php">업소정보 관리</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company/manager_info.php">구인 담당자 관리</a></li>
										<li><a href="<?php echo NFE_URL; ?>/member/mail.php">쪽지 관리</a></li>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=3 parent="ul">유료서비스</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '3' ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/service/index.php">유료서비스 안내</a></li>
										<li><a href="<?php echo NFE_URL; ?>/member/pay.php">유료결제내역</a></li>
										<li><a href="<?php echo NFE_URL; ?>/member/point_list.php">포인트내역</a></li>
										<?php if ($nf_job->service_info['employ']['jump']['use']) { ?>
											<li><a href="<?php echo NFE_URL; ?>/company/jump_list.php">보유한 점프내역</a>
												<?php if ($member['no'] && $member['mb_type'] == 'company') { ?>
													<dl class="assistant">
														<dt>보유한 점프내역 <span
																class="orange"><?php echo number_format(intval($member_service['mb_employ_jump_int'])); ?></span>건
														</dt>
														<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=jump">점프
																서비스 구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
													</dl>
												<?php } ?>
											</li>
											<?php
										}
										if ($nf_job->service_info['resume']['read']['use']) { ?>
											<li><a href="<?php echo NFE_URL; ?>/company/resume_info.php">이력서 열람권</a>
												<?php if ($member['no'] && $member['mb_type'] == 'company') { ?>
													<dl class="assistant">
														<dt>보유한 열람권 <span
																class="orange"><?php echo number_format(intval($member_service['mb_resume_read_int'])); ?></span>건
														</dt>
														<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=read">열람권
																구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
													</dl>
												<?php } ?>
											</li>
										<?php } ?>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=4 parent="ul">업소정보관리</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '4' ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">업소정보 수정</a></li>
										<li><a href="<?php echo NFE_URL; ?>/member/password_form.php">비밀번호 변경</a></li>
										<li><a href="<?php echo NFE_URL; ?>/company/tax.php">세금계산서 발행신청</a></li>
										<li><a href="<?php echo NFE_URL; ?>/member/left_form.php">회원탈퇴</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li
							style="display:<?php echo (!$member['no'] || $member['mb_type'] == 'individual') ? 'block' : 'none'; ?>;">
							<a href="#none" class="<?php echo $_COOKIE['_m-submenu-'] === '3' ? 'on' : ''; ?> m-submenu-"
								k=3><?php echo $member['no'] ? 'MY서비스' : '개인서비스'; ?></a>
							<ul class="m-submenu-child- m_nav_2d"
								style="display:<?php echo $_COOKIE['_m-submenu-'] === '3' ? 'block' : 'none'; ?>;">
								<li><a href="<?php echo NFE_URL; ?>/<?php echo $_mb_type_; ?>/index.php"
										class="arrow_no">개인서비스 홈</a></li>
								<li><a href="#none" class="m-submenu-child-menu-" k=0 parent="ul">이력서 관리</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/individual/resume_regist.php">새 이력서 작성</a></li>
										<li><a href="<?php echo NFE_URL; ?>/individual/resume_list.php">이력서 관리</a></li>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=1 parent="ul">입사지원 관리</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/individual/resume_onlines.php">온라인 지원 현황</a>
										</li>
										<li><a href="<?php echo NFE_URL; ?>/individual/resume_interview.php">입사제의 업소</a>
										</li>
										<li><a href="<?php echo NFE_URL; ?>/individual/resume_open.php">내 이력서 열람 관리</a></li>
										<li><a href="<?php echo NFE_URL; ?>/individual/company_info.php">열람한 구인정보</a></li>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=2 parent="ul">맞춤서비스 관리</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '2' ? 'block' : 'none'; ?>;">
										<li><a href="<?php echo NFE_URL; ?>/individual/scrap.php">스크랩한 구인정보</a></li>
										<li><a href="<?php echo NFE_URL; ?>/individual/favorite_company.php">관심업소 정보</a>
										</li>
										<li><a href="<?php echo NFE_URL; ?>/individual/customized.php">맞춤 구인정보</a></li>
										<li><a href="<?php echo NFE_URL; ?>/member/mail.php">쪽지 관리</a></li>
										<li><a href="<?php echo NFE_URL; ?>/individual/applycert.php">취업활동증명서</a></li>
									</ul>
								</li>
								<li><a href="#none" class="m-submenu-child-menu-" k=3 parent="ul">유료서비스</a>
									<ul class="m_nav_3d  m-submenu-child-menu-child-"
										style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '3' ? 'block' : 'none'; ?>;"">
								<li><a href=" <?php echo NFE_URL; ?>/service/index.php?code=resume">유료서비스 안내</a>
								</li>
								<li><a href="<?php echo NFE_URL; ?>/member/pay.php">유료결제내역</a></li>
								<li><a href="<?php echo NFE_URL; ?>/member/point_list.php">포인트내역</a></li>
								<?php if ($nf_job->service_info['resume']['jump']['use']) { ?>
									<li><a href="<?php echo NFE_URL; ?>/individual/jump_list.php">보유한 점프내역</a>
										<?php if ($member['no'] && $member['mb_type'] == 'individual') { ?>
											<dl class="assistant">
												<dt>보유한 점프내역 <span
														class="orange"><?php echo number_format(intval($member_service['mb_resume_jump_int'])); ?></span>건
												</dt>
												<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=jump">점프 서비스
														구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
											</dl>
										<?php } ?>
									</li>
									<?php
								}

								if ($nf_job->service_info['employ']['read']['use']) { ?>
									<li><a href="<?php echo NFE_URL; ?>/individual/company_info.php">구인정보 열람권</a>
										<?php if ($member['no'] && $member['mb_type'] == 'individual') { ?>
											<dl class="assistant">
												<dt>보유한 열람권 <span
														class="orange"><?php echo number_format(intval($member_service['mb_employ_read_int'])); ?></span>건
												</dt>
												<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=read">열람권
														구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
											</dl>
										<?php } ?>
									</li>
								<?php } ?>
							</ul>
						</li>
						<li><a href="#none" class="m-submenu-child-menu-" k=4 parent="ul">개인정보관리</a>
							<ul class="m_nav_3d  m-submenu-child-menu-child-"
								style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '4' ? 'block' : 'none'; ?>;">
								<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">개인정보 수정</a></li>
								<li><a href="<?php echo NFE_URL; ?>/member/password_form.php">비밀번호 변경</a></li>
								<li><a href="<?php echo NFE_URL; ?>/individual/tax.php">현금영수증 발행신청</a></li>
								<li><a href="<?php echo NFE_URL; ?>/member/left_form.php">회원탈퇴</a></li>
							</ul>
						</li>
					</ul>
					</li>
					</ul>

				<?php } else { //회원일때 ?>

					<ul class="m_nav_1d">

						<?php if ($member['mb_type'] == 'company') { //업소회원 ?>

							<li><a href="#none" class="<?php echo !$_COOKIE['_m-submenu-'] ? 'on' : ''; ?> m-submenu-"
									k=0>구인정보</a>
								<ul class="m-submenu-child- m_nav_2d"
									style="display:<?php echo !$_COOKIE['_m-submenu-'] ? 'block' : 'none'; ?>;">
									<li><a href="<?php echo NFE_URL; ?>/employ/list_type.php" class="arrow_no">구인정보 전체보기</a>
									</li>
									<?php if ($nf_category->job_part_adult) { ?>
										<li><a href="<?php echo NFE_URL; ?>/employ/list_type.php?code=adult" class="arrow_no">19금
												구인정보</a></li>
									<?php } ?>
									<li><a href="#none" class="on m-submenu-child-menu-" k=0 parent="ul">업·직종별 구인</a>
										<ul class="m_nav_3d m-submenu-child-menu-child-"
											style="display:<?php echo !$_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
											<?php
											if (is_array($cate_p_array['job_part'][0])) {
												foreach ($cate_p_array['job_part'][0] as $k => $v) {
													?>
													<li><a
															href="<?php echo NFE_URL; ?>/employ/list_type.php?code=job_part&wr_job_type[]=<?php echo $v['no']; ?>#employ-list-start-">-
															&nbsp;<?php echo $v['wr_name']; ?></a></li>
													<?php
												}
											} ?>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=1 parent="ul">지역별</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
											<?php
											if (is_array($cate_p_array['area'][0])) {
												foreach ($cate_p_array['area'][0] as $k => $v) {
													?>
													<li><a
															href="<?php echo NFE_URL; ?>/employ/list_type.php?code=area&wr_area[]=<?php echo $v['wr_name']; ?>#employ-list-start-">-
															&nbsp;<?php echo $v['wr_name']; ?></a></li>
													<?php
												}
											} ?>
										</ul>
									</li>
								</ul>
							</li>
							<li
								style="display:<?php echo (!$member['no'] || $member['mb_type'] == 'company') ? 'block' : 'none'; ?>;">
								<a href="#none" class="<?php echo $_COOKIE['_m-submenu-'] === '1' ? 'on' : ''; ?> m-submenu-"
									k=1><?php echo $member['no'] ? 'MY서비스' : '업소서비스'; ?></a>
								<ul class="m-submenu-child- m_nav_2d"
									style="display:<?php echo $_COOKIE['_m-submenu-'] === '1' ? 'block' : 'none'; ?>;">
									<li><a href="<?php echo NFE_URL; ?>/<?php echo $_mb_type_; ?>/index.php"
											class="arrow_no">업소서비스 홈</a></li>
									<li><a href="#none" class="m-submenu-child-menu-" k=0 parent="ul">구인공고 관리</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/company/employ_regist.php">구인공고등록</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/employ_list.php">진행중인 구인공고</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company//employ_list.php?code=end">마감된 구인공고</a>
											</li>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=1 parent="ul">인재 관리</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/company/apply_list.php">입사지원인재</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/interview.php">면접·입사 제의 인재</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/scrap.php">스크랩한 인재정보</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/resume_info.php">열람한 인재정보</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/customized.php">맞춤 인재정보</a></li>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=2 parent="ul">서비스 관리</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '2' ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/company/company_info.php">업소정보 관리</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/manager_info.php">구인 담당자 관리</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/mail.php">쪽지 관리</a></li>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=3 parent="ul">유료서비스</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '3' ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/service/index.php">유료서비스 안내</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/pay.php">유료결제내역</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/point_list.php">포인트내역</a></li>
											<?php if ($nf_job->service_info['employ']['jump']['use']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/company/jump_list.php">보유한 점프내역</a>
													<?php if ($member['no'] && $member['mb_type'] == 'company') { ?>
														<dl class="assistant">
															<dt>보유한 점프내역 <span
																	class="orange"><?php echo number_format(intval($member_service['mb_employ_jump_int'])); ?></span>건
															</dt>
															<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=jump">점프
																	서비스 구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
														</dl>
													<?php } ?>
												</li>
												<?php
											}
											if ($nf_job->service_info['resume']['read']['use']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/company/resume_info.php">이력서 열람권</a>
													<?php if ($member['no'] && $member['mb_type'] == 'company') { ?>
														<dl class="assistant">
															<dt>보유한 열람권 <span
																	class="orange"><?php echo number_format(intval($member_service['mb_resume_read_int'])); ?></span>건
															</dt>
															<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=read">열람권
																	구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
														</dl>
													<?php } ?>
												</li>
											<?php } ?>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=4 parent="ul">업소정보관리</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '4' ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">업소정보 수정</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/password_form.php">비밀번호 변경</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/tax.php">세금계산서 발행신청</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/left_form.php">회원탈퇴</a></li>
										</ul>
									</li>
								</ul>
							</li>

						<?php } else { //개인회원 ?>

							<li><a href="javascript:void(0)"
									class="<?php echo !$_COOKIE['_m-submenu-'] ? 'on' : ''; ?> m-submenu-" k=0>인재정보</a>
								<ul class="m-submenu-child- m_nav_2d"
									style="display:<?php echo !$_COOKIE['_m-submenu-'] ? 'block' : 'none'; ?>;">
									<li><a href="<?php echo NFE_URL; ?>/resume/resume_list.php" class="arrow_no">인재정보 전체보기</a>
									</li>
									<li><a href="javascript:void(0)" class="on m-submenu-child-menu-" k=0 parent="ul">업·직종별
											인재</a>
										<ul class="m_nav_3d m-submenu-child-menu-child-"
											style="display:<?php echo !$_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
											<?php
											if (is_array($cate_p_array['job_part'][0])) {
												foreach ($cate_p_array['job_part'][0] as $k => $v) {
													?>
													<li><a
															href="<?php echo NFE_URL; ?>/resume/resume_list.php?code=job_part&wr_job_type[]=<?php echo $v['no']; ?>#employ-list-start-">-
															&nbsp;<?php echo $v['wr_name']; ?></a></li>
													<?php
												}
											} ?>
										</ul>
									</li>
									<li><a href="javascript:void(0)" class="m-submenu-child-menu-" k=1 parent="ul">지역별</a>
										<ul class="m_nav_3d m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
											<?php
											if (is_array($cate_p_array['area'][0])) {
												foreach ($cate_p_array['area'][0] as $k => $v) {
													?>
													<li><a
															href="<?php echo NFE_URL; ?>/resume/resume_list.php?code=area&wr_area[]=<?php echo $v['wr_name']; ?>&#resume-list-start-"><?php echo $v['wr_name']; ?></a>
													</li>
													<?php
												}
											} ?>
										</ul>
									</li>
								</ul>
							</li>
							<li
								style="display:<?php echo (!$member['no'] || $member['mb_type'] == 'individual') ? 'block' : 'none'; ?>;">
								<a href="#none" class="<?php echo $_COOKIE['_m-submenu-'] === '1' ? 'on' : ''; ?> m-submenu-"
									k=1><?php echo $member['no'] ? 'MY서비스' : '개인서비스'; ?></a>
								<ul class="m-submenu-child- m_nav_2d"
									style="display:<?php echo $_COOKIE['_m-submenu-'] === '1' ? 'block' : 'none'; ?>;">
									<li><a href="<?php echo NFE_URL; ?>/<?php echo $_mb_type_; ?>/index.php"
											class="arrow_no">개인서비스 홈</a></li>
									<li><a href="#none" class="m-submenu-child-menu-" k=0 parent="ul">이력서 관리</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_regist.php">새 이력서 작성</a></li>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_list.php">이력서 관리</a></li>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=1 parent="ul">입사지원 관리</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '1' ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_onlines.php">온라인 지원 현황</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_interview.php">입사제의 업소</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_open.php">내 이력서 열람 관리</a></li>
											<li><a href="<?php echo NFE_URL; ?>/individual/company_info.php">열람한 구인정보</a></li>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=2 parent="ul">맞춤서비스 관리</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '2' ? 'block' : 'none'; ?>;">
											<li><a href="<?php echo NFE_URL; ?>/individual/scrap.php">스크랩한 구인정보</a></li>
											<li><a href="<?php echo NFE_URL; ?>/individual/favorite_company.php">관심업소 정보</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/customized.php">맞춤 구인정보</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/mail.php">쪽지 관리</a></li>
											<li><a href="<?php echo NFE_URL; ?>/individual/applycert.php">취업활동증명서</a></li>
										</ul>
									</li>
									<li><a href="#none" class="m-submenu-child-menu-" k=3 parent="ul">유료서비스</a>
										<ul class="m_nav_3d  m-submenu-child-menu-child-"
											style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '3' ? 'block' : 'none'; ?>;"">
								<li><a href=" <?php echo NFE_URL; ?>/service/index.php?code=resume">유료서비스 안내</a>
									</li>
									<li><a href="<?php echo NFE_URL; ?>/member/pay.php">유료결제내역</a></li>
									<li><a href="<?php echo NFE_URL; ?>/member/point_list.php">포인트내역</a></li>
									<?php if ($nf_job->service_info['resume']['jump']['use']) { ?>
										<li><a href="<?php echo NFE_URL; ?>/individual/jump_list.php">보유한 점프내역</a>
											<?php if ($member['no'] && $member['mb_type'] == 'individual') { ?>
												<dl class="assistant">
													<dt>보유한 점프내역 <span
															class="orange"><?php echo number_format(intval($member_service['mb_resume_jump_int'])); ?></span>건
													</dt>
													<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=jump">점프 서비스
															구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
												</dl>
											<?php } ?>
										</li>
										<?php
									}

									if ($nf_job->service_info['employ']['read']['use']) { ?>
										<li><a href="<?php echo NFE_URL; ?>/individual/company_info.php">구인정보 열람권</a>
											<?php if ($member['no'] && $member['mb_type'] == 'individual') { ?>
												<dl class="assistant">
													<dt>보유한 열람권 <span
															class="orange"><?php echo number_format(intval($member_service['mb_employ_read_int'])); ?></span>건
													</dt>
													<dd><a href="<?php echo NFE_URL; ?>/service/product_payment.php?code=read">열람권
															구매하기<i class="axi axi-keyboard-arrow-right"></i></a></dd>
												</dl>
											<?php } ?>
										</li>
									<?php } ?>
								</ul>
							</li>
							<li><a href="#none" class="m-submenu-child-menu-" k=4 parent="ul">개인정보관리</a>
								<ul class="m_nav_3d  m-submenu-child-menu-child-"
									style="display:<?php echo $_COOKIE['_m-submenu-child-menu-'] === '4' ? 'block' : 'none'; ?>;">
									<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">개인정보 수정</a></li>
									<li><a href="<?php echo NFE_URL; ?>/member/password_form.php">비밀번호 변경</a></li>
									<li><a href="<?php echo NFE_URL; ?>/individual/tax.php">현금영수증 발행신청</a></li>
									<li><a href="<?php echo NFE_URL; ?>/member/left_form.php">회원탈퇴</a></li>
								</ul>
							</li>
						</ul>
						</li>
					<?php } ?>
					</ul>

				<?php } ?>
				<script type="text/javascript">
					nf_util.click_tab(".m-submenu-");
					nf_util.click_tab(".m-submenu-child-menu-");
				</script>
				<div class="m_bottom">

				</div>
			</div>
		</section>
		<!--//모바일메뉴-->
	</div>
	<ul class="custom_top">
		<li><a href="<?php echo NFE_URL; ?>/employ/list_type.php">구인정보</a></li>
		<li><a href="<?php echo NFE_URL; ?>/resume/resume_list.php">인재정보</a></li>
	</ul>
	<?php
	include NFE_PATH . '/include/header_menu.php';
	?>