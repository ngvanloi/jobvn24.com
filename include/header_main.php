<?php
	$notice_query = $db->_query("select * from nf_notice order by wr_date desc limit 3");
?>
	<div class="top_con_wrap">
		<section>
			<div class="top1">	
				<div class="main_notice">
					<h3>공지사항 <a href="<?php echo NFE_URL;?>/board/notice_list.php"><i class="axi axi-ion-android-add"></i></a></h3>
					<ul>
						<?php while($row=$db->afetch($notice_query)) { ?>
						<li><a href="<?php echo NFE_URL;?>/board/notice_view.php?no=<?php echo $row['no'];?>" class="line1"><?php echo $row['wr_subject'];?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="main_visual" style="position:relative;overflow:hidden;"><!--order0-->
					<?php
					$banner_arr = $nf_banner->banner_view('main_A');
					echo $banner_arr['tag'];
					?>
					<div class="main_A-cycle-pager"></div>
				</div>
				<!--//main_visual-->
				<?php
				switch(!$member['no']) {
					case true:
				?>
				<script type="text/javascript">
				var click_main_login = function(code) {
					var form = document.forms['flogin'];
					form.kind.value = code;
					$(".main-login-radio-[value='"+code+"']").prop('checked', true);
					$(".main-login-form-").eq(0).css({"display":"none"});
					$(".main-login-form-").eq(1).css({"display":"flex"});
					<?php if(is_demo) {?>click_tab_login(code);<?php }?>
				}
				$(function(){
					$(".main-login-radio-").click(function(){
						var form = document.forms['flogin'];
						<?php if(is_demo) {?>click_tab_login($(this).val());<?php }?>
						form.kind.value = $(this).val();
					});
				});
				</script>
				<div class="main_login logout main-login-form-"><!--로그인전-->
					<div class="login_choice">
						<a href="javascript:void(0)" onClick="click_main_login('individual')">
							<p><img src="../images/login_icon1.png" alt="개인회원로그인"></p>
							<em>개인회원<br>로그인</em>
						</a>
						<a href="javascript:void(0)" onClick="click_main_login('company')">
							<p><img src="../images/login_icon2.png" alt="업소회원로그인"></p>
							<em>업소회원<br>로그인</em>
						</a>
					</div>
					<div class="assistant_box">
						<ul>
							<li><a href="<?php echo NFE_URL;?>/member/register.php">회원가입</a></li>
							<li><a href="<?php echo NFE_URL;?>/member/find_idpw.php">ID/PW찾기</a></li>
						</ul>
						<ul class="sns_login">
							<?php if(in_array('naver', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)" onClick="nf_util.window_open('<?php echo $env['naver_login_click'];?>', 'naver', 500, 500)"><img src="../images/main_sns3.png" alt="네이버로그인"></a></li>
							<?php }?>
							<?php if(in_array('kakao_talk', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)" onClick="kakaoLogin();"><img src="../images/main_sns1.png" alt="카카오로그인"></a></li>
							<?php }?>
							<?php
							if(in_array('facebook', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)" onClick="fnFbCustomLogin();"><img src="../images/main_sns4.png" alt="페이스북로그인"></a></li>
							<?php }?>
							<?php if(in_array('twitter', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)"><img src="../images/main_sns2.png" alt="트위터로그인"></a></li>
							<?php }?>
						</ul>	
					</div>
				</div>

				<div class="main_login logout login_form main-login-form-" style="display:none;"><!--로그하기-->
					<ul class="choice_member">
						<li><label><input type="radio" name="kind" class="main-login-radio-" value="individual">개인회원</label></li>
						<li><label><input type="radio" name="kind" class="main-login-radio-" value="company">업소회원</label></li>
					</ul>
					<form name="flogin" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return validate(this)">
					<input type="hidden" name="kind" value="" />
					<input type="hidden" name="mode" value="login_process" />
					<input type="hidden" name="url" value="/" />
					<div class="form_style">
						<p>
							<input type="text" name="mid" placeholder="아이디">	
							<input type="password" name="passwd" placeholder="비밀번호">	
						</p>
						<button>로그인</button>
					</div>
					</form>
					<div class="assistant_box">
						<ul>
							<li><a href="<?php echo NFE_URL;?>/member/register.php">회원가입</a></li>
							<li><a href="<?php echo NFE_URL;?>/member/find_idpw.php">ID/PW찾기</a></li>
						</ul>
						<ul class="sns_login">
							<?php if(in_array('naver', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)" onClick="nf_util.window_open('<?php echo $env['naver_login_click'];?>', 'naver', 500, 500)"><img src="../images/main_sns3.png" alt="네이버로그인"></a></li>
							<?php }?>
							<?php if(in_array('kakao_talk', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)" onClick="kakaoLogin();"><img src="../images/main_sns1.png" alt="카카오로그인"></a></li>
							<?php }?>
							<?php
							/*
							if(in_array('facebook', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)" onClick="fnFbCustomLogin();"><img src="../images/main_sns4.png" alt="페이스북로그인"></a></li>
							<?php }?>
							<?php if(in_array('twitter', $env['sns_login_feed_arr'])) {?>
								<li><a href="javascript:void(0)"><img src="../images/main_sns2.png" alt="트위터로그인"></a></li>
							<?php }
							*/
							?>
						</ul>
					</div>
				</div>
				<?php
					break;


					default:
						$member_code = $member['mb_type']=='company' ? 'company_member' : 'individual';
						$get_member_status = $nf_job->get_member_status($member, $member_code);
				?>
				<div class="main_login login"><!--로그인 후-->
					<p>
						<?php echo $member['mb_name'];?>님 <span><a href="<?php echo NFE_URL;?>/member/update_form.php">정보수정</a></span>
					</p>
					<div class="login_info">
						<dl>
							<dt><i class="axi axi-paper-stack"></i></dt>
							<dd><a href="<?php echo NFE_URL;?>/<?php echo $member['mb_type']=='company' ? 'company/employ_list.php' : 'individual/resume_list.php';?>" class="line1"><?php echo $member['mb_type']=='company' ? '구인공고' : '이력서';?> : <span class="orange"><?php echo number_format(intval($get_member_status['employ_ing'])+intval($get_member_status['employ_end']));?></span></a></dd><!--업소일때는 '구인공고'-->
						</dl>
						<dl>
							<dt><i class="axi axi-control-point-duplicate"></i></dt>
							<dd><a href="<?php echo NFE_URL;?>/member/point_list.php"  class="line1">포인트 : <span class="orange"><?php echo number_format(intval($member['mb_point']));?></span></a></dd>
						</dl>
						<dl>
							<dt><i class="axi axi-mail"></i></dt>
							<dd><a href="<?php echo NFE_URL;?>/member/mail.php"  class="line1">새쪽지 : <span class="orange"><?php echo number_format(intval($get_member_status['message']));?></span></a></dd>
						</dl>
						<dl>
							<dt><i class="axi axi-star-o"></i></dt>
							<dd><a href="<?php echo NFE_URL;?>/<?php echo $member['mb_type'];?>/scrap.php"  class="line1">스크랩 : <span class="orange"><?php echo number_format(intval($get_member_status['scrap']));?></span></a></dd>
						</dl>
					</div>
					<div>
						<button type="button" onClick="location.href='<?php echo NFE_URL;?>/<?php echo $member['mb_type'];?>/index.php';">MY <?php echo $nf_member->mb_type[$member['mb_type']];?>서비스</button>
						<button type="button" onClick="location.href='<?php echo NFE_URL;?>/include/regist.php?mode=logout';">로그아웃</button>
					</div>
				</div>
				<?php
					break;
				}
				?>
			</div>
			<!--top1-->
			<div class="top2">
				

				<div class="location">
					<h3><span>지역별</span> 구인정보</h3>
					<ul>
						<?php
						if(is_array($cate_p_array['area'][0])) { foreach($cate_p_array['area'][0] as $k=>$v) {
						?>
						<li><a href="<?php echo NFE_URL;?>/employ/list_type.php?area_multi[]=<?php echo $v['no'];?>&area_text_multi[]=<?php echo $v['wr_name'];?> 전체"><?php echo $v['wr_name'];?></a></li>
						<?php
						} }?>
						<li><a href="<?php echo NFE_URL;?>/employ/list_type.php">전국</a></li>
					</ul>
				</div>
				<!--//location-->

				<div class="b_type">
					<h3><span>업종별</span> 구인정보</h3>
					<ul>
						<?php
						if(is_array($cate_p_array['job_part'][0])) { foreach($cate_p_array['job_part'][0] as $k=>$v) {
						?>
						<li><a href="<?php echo NFE_URL;?>/employ/list_type.php?code=job_part&job_part_multi[]=<?php echo $v['no'];?>&job_part_text_multi[]=<?php echo $v['wr_name'];?>"><?php echo $v['wr_name'];?></a></li>
						<?php
						} }?>
					</ul>
				</div>
<?
/*
							echo '<pre>';
							print_R($cate_p_array['job_tema'][0]);
							echo '</pre>';	
*/
?>
				<div class="tema">
					<h3><span>테마별</span> 구인정보
						<em>
							<button href=# id=prev3><i class="axi axi-keyboard-arrow-left"></i></button>
							<button href=# id=next3><i class="axi axi-keyboard-arrow-right"></i></button>
						</em>
					</h3>
					<div class="tema_box">
						<div class="cycle-slideshow vertical"
						data-cycle-fx=carousel
						data-cycle-next="#next3"
						data-cycle-prev="#prev3"
						data-cycle-timeout=5000
						data-cycle-carousel-visible=5
						data-cycle-carousel-vertical=true
						data-cycle-timeout=1000
						data-cycle-slides="> ul"
						>
							<?php
							$_width = 4;
							$count = 0;
							$length = count($cate_p_array['job_tema'][0]);

							if(is_array($cate_p_array['job_tema'][0])) { foreach($cate_p_array['job_tema'][0] as $k=>$v) {
								
								$checked = is_array($employ_info['wr_work_type']) && in_array($v['no'], $employ_info['wr_work_type']) ? 'checked' : '';

								if($count%9===0) echo '<ul>';
							?>
							<li><a href="<?php echo NFE_URL;?>/employ/list_type.php?wr_work_type[]=<?php echo $v['no'];?>" class="line1"><?php echo $v['wr_name'];?></a></li>
							<?php
								$count++;
								if($count%9===0 || $length===$count) echo '</ul>';
							} }
							?>
						</div>
					</div>
				</div>
				<!--//tema-->

				<div class="guaranteed">
					<h3><span>보장</span> 제도
						<em>
							<button href=# id=prev4><i class="axi axi-keyboard-arrow-left"></i></button>
							<button href=# id=next4><i class="axi axi-keyboard-arrow-right"></i></button>
						</em>
					</h3>
					<div class="guaranteed_box">
						<div class="cycle-slideshow vertical"
						data-cycle-fx=carousel
						data-cycle-next="#next4"
						data-cycle-prev="#prev4"
						data-cycle-timeout=5000
						data-cycle-carousel-visible=5
						data-cycle-carousel-vertical=true
						data-cycle-timeout=1000
						data-cycle-slides="> ul"
						>
							<?php
							$_width = 4;
							$count = 0;
							$length = count($cate_p_array['job_document'][0]);
							if(is_array($cate_p_array['job_document'][0])) { foreach($cate_p_array['job_document'][0] as $k=>$v) {
								
								$checked = is_array($employ_info['wr_target']) && in_array($v['no'], $employ_info['wr_target']) ? 'checked' : '';

								if($count%6===0) echo '<ul>';
							?>
							<li><a href="<?php echo NFE_URL;?>/employ/list_type.php?wr_target[]=<?php echo $v['no'];?>" class="line1"><?php echo $v['wr_name'];?></a></li>
							<?php
								$count++;
								if($count%6===0 || $length===$count) echo '</ul>';
							} }
							?>
						</div>
					</div>
				</div>
			</div>
			<!--//top2-->
		</section>
	</div>