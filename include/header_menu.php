<!--스킨1,2  스킨1 = skin1, 스킨2 = skin2-->
<?php
$site_color_skin = 'skin' . $env['menu_skin'];
?>
<div id="head_top" class="nav_wrap <?php echo $site_color_skin; ?>">
	<nav>
		<div class="nav_div">
			<ul class="left_nav nav">

				<li><a href="<?php echo NFE_URL; ?>/employ/list_type.php">Thông tin tuyển dụng</a></li>
				<li class="line_plus">|</li>
				<li><a href="<?php echo NFE_URL; ?>/resume/resume_list.php">Thông tin ứng viên</a></li>
			</ul>
			<ul class="right_nav nav">
				<?php if (empty($member) || $member['mb_type'] == 'company') { ?>
					<li><a href="<?php echo NFE_URL; ?>/company/index.php">Dịch vụ kinh doanh<span><i
									class="axi axi-keyboard-arrow-down"></i></span></a>
						<div class="menubg">
							<ul class="menuwrap">
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/company/employ_list.php">Quản lý tin tuyển
												dụng</a><i class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/company/employ_regist.php">Đăng ký tin tuyển
													dụng</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/employ_list.php">Thông tin tuyển
													dụng đang tiến hành</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/employ_list.php?code=end">Đã đóng
													tin tuyển dụng</a></li>
										</ul>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/company/apply_list.php">quản lý ứng viên</a><i
												class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/company/apply_list.php">Ứng viên ứng tuyển
													vào công ty</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/interview.php">Ứng viên được đề xuất
													phỏng vấn</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/scrap.php">Thông tin ứng viên đã
													lưu</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/resume_info.php">Thông tin ứng viên
													đã xem</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/customized.php">Thông tin ứng tuyển
													phù hợp</a></li>
										</ul>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/company/company_info.php">Quản lý dịch vụ</a><i
												class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/company/company_info.php">Quản lý thông tin
													doanh nghiệp</a></li>
											<li><a href="<?php echo NFE_URL; ?>/company/manager_info.php">Quản lý nhà tuyển
													dụng</a></li>
											<?php if ($env['use_message']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/member/mail.php">Quản lý tin nhắn</a></li>
											<?php } ?>
										</ul>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/service/index.php">Dịch vụ trả phí</a><i
												class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/service/index.php">Thông tin dịch vụ trả
													phí</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/pay.php">Chi tiết thanh toán</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/point_list.php">Chi tiết điểm</a>
											</li>
											<?php if ($nf_job->service_info['employ']['jump']['use']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/company/employ_list.php">Lịch sử nhảy bạn
														có</a></li>
											<?php } ?>
											<?php if ($nf_job->service_info['resume']['read']['use']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/company/resume_info.php">Quyền xem hồ sơ</a>
													<?php if ($member['no']) { ?>
														<dl class="assistant">
															<dt>Đã giữ<span
																	class="orange"><?php echo number_format(intval($member_service['mb_resume_read_int'])); ?></span>vé
																xem
															</dt>
															<dd><a
																	href="<?php echo NFE_URL; ?>/service/product_payment.php?code=read">Mua
																	vé xem<i class="axi axi-keyboard-arrow-right"></i></a></dd>
														</dl>
													<?php } ?>
												</li>
											<?php } ?>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/member/update_form.php">Quản lý thông tin doanh
												nghiệp</a><i class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">Chỉnh sửa thông tin
													doanh nghiệp</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/password_form.php">Thay đổi mật
													khẩu</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</li>
				<?php } ?>
				<?php if (empty($member) || $member['mb_type'] == 'individual') { ?>
					<li><a href="<?php echo NFE_URL; ?>/individual/index.php">Dịch vụ cá nhân<span><i
									class="axi axi-keyboard-arrow-down"></i></span></a>
						<div class="menubg">
							<ul class="menuwrap">
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/individual/resume_list.php">Quản lý hồ sơ xin
												việc</a><i class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_regist.php">Tạo hồ sơ
													mới</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_list.php">Quản lý hồ sơ
													xin việc</a></li>
										</ul>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/individual/resume_onlines.php">Quản lý hồ sơ xin
												việc</a><i class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_onlines.php">Trạng thái
													đăng kí trực tuyến</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_interview.php">Địa điểm
													phỏng vấn</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/resume_open.php">Quản lý lượt xem
													hồ sơ của tôi</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/company_info.php">Thông tin việc
													làm đã xem</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/individual/customized.php">Quản lý dịch vụ tùy
												chỉnh</a><i class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/individual/scrap.php">Thông tin tuyển dụng
													đã lưu</a></li>
											<li><a href="<?php echo NFE_URL; ?>/individual/favorite_company.php">Thông tin
													về các doanh nghiệp quan tâm</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/individual/customized.php">Thông tin công
													việc phù hợp</a></li>
											<?php if ($env['use_message']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/member/mail.php">Quản lý tin nhắn</a></li>
											<?php } ?>
											<!-- <li><a href="<?php echo NFE_URL; ?>/individual/applycert.php">취업활동증명서</a></li> -->
										</ul>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/service/index.php">Dịch vụ trả phí</a><i
												class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/service/index.php?code=resume">Thông tin
													dịch vụ trả phí</a>
											</li>
											<li><a href="<?php echo NFE_URL; ?>/member/pay.php">
													Chi tiết thanh toán</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/point_list.php">Chi tiết điểm
												</a></li>
											<?php if ($nf_job->service_info['resume']['jump']['use']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/individual/resume_list.php">Lịch sử nhảy bạn
														có</a>
												</li>
											<?php } ?>
											<?php if ($nf_job->service_info['employ']['read']['use']) { ?>
												<li><a href="<?php echo NFE_URL; ?>/individual/company_info.php">Phiếu xem thông
														tin việc làm
													</a>
													<?php if ($member['no']) { ?>
														<dl class="assistant">
															<dt>Đã giữ <span
																	class="orange"><?php echo number_format(intval($member_service['mb_employ_read_int'])); ?></span>vé
																xem
															</dt>
															<dd><a
																	href="<?php echo NFE_URL; ?>/service/product_payment.php?code=read">Mua
																	vé xem<i class="axi axi-keyboard-arrow-right"></i></a></dd>
														</dl>
													<?php } ?>
												</li>
											<?php } ?>
										</ul>
									</div>
								</li>
								<li class="menubox3"><!--반복-->
									<div>
										<p><a href="<?php echo NFE_URL; ?>/member/update_form.php">Quản lý thông tin cá nhân
											</a><i class="axi axi-keyboard-arrow-right"></i></p>
										<ul>
											<li><a href="<?php echo NFE_URL; ?>/member/update_form.php">Chỉnh sửa thông tin
													cá nhân
												</a></li>
											<li><a href="<?php echo NFE_URL; ?>/member/password_form.php">Thay đổi mật khẩu
												</a></li>

										</ul>
									</div>
								</li>
							</ul>

						</div>
						<!--//menubg-->
					</li>
				<?php } ?>
			</ul>
		</div>
	</nav>
</div>
<!--//스킨1, 2-->

<?php
// : 스크롤 광고
include NFE_PATH . '/include/scroll_banner.php';
?>