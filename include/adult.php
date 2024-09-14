<?php
if($member['no'] && $member['is_adult']) return false; // : 성인이면 통과
if($member['no'] && $_SESSION['_auth_process_']['adult']) $db->_query("update nf_member set is_adult=1 where `no`=".intval($member['no'])); // : 한번 성인인증되면 is_adult=1 해주기
if($_SESSION['_auth_process_']['adult']) return false; // : 실명인증 성인체크
if($nf_util->is_adult($member['mb_birth'])) return false; // : 로그인한 회원 나이체크
?>
<script type="text/javascript" src="<?php echo NFE_URL;?>/plugin/auth/nf_auth.class.js"></script>
<section class="adult">
	<div class="adult_box">
		<div class="adult_ex">
			<p class="img"><img src="../images/comn/img_19adult1.gif" alt=""></p>
			<p class="txt">
				이 정보내용은 <span>청소년 유해 매체물</span>로서<br>
				정보통신망 이용 촉진 및 정보보호 등에 관한 법률 및 청소년 보호법의 규정에 의하여<br>
				<strong>19세 미만의 청소년은 이용할 수 없습니다.</strong>
			</p>
			<div class="adult_out">
				<p><b>19세 미만 또는 성인인증을 원하지 않으실 경우</b><br>
				청소년 유해 매체물을 제외한 [유흥 구인구직 홈페이지 - 넷퓨]의 모든컨텐츠 및 서비스를 이용 하실 수 있습니다.</p>
				<p><a href="<?php echo domain;?>">19세 미만 나가기</a></p>
			</div>
		</div>
		<table class="style3">
			<colgroup>
				<col style="width:<?php echo $member['no'] ? 100 : 50;?>%">
				<?php if(!$member['no']) {?><col style="width:50%"><?php }?>
			</colgroup>
			<thead>
				<tr>
					<th>비회원 성인인증</th>
					<?php if(!$member['no']) {?><th class="bl">회원 로그인</th><?php }?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?php if($env['use_ipin'] || $env['use_hphone']) {?>
						<ul class="base"><!--휴대폰, 아이핀 사용시 노출-->
							<?php if($env['use_hphone']) {?>
							<li><button type="button" onClick="nf_auth.auth_func('sms')">휴대폰 인증</button></li>
							<?php }
							if($env['use_ipin']) {
							?>
							<li><button type="button" onClick="nf_auth.auth_func('ipin')">아이핀 인증</button></li>
							<?php }?>
						</ul>
						<?php } else if($env['use_bbaton']) {?>
						<ul class="bbt"><!--비바톤 사용시 노출-->
							<li><button type="button" onClick="nf_auth.auth_func('bbaton')" class="bbt">비바톤 익명인증</button></li>
						</ul>
						<?php }?>
					</td>
					<?php if(!$member['no']) {?>
					<td class="bl">
						<form name="flogin" action="<?php echo NFE_URL;?>/include/regist.php" method="post" onSubmit="return validate(this)">
						<input type="hidden" name="mode" value="login_process" />
						<input type="hidden" name="url" value="<?php echo urlencode($_SERVER['REQUEST_URI']);?>" />
						<ul class="mem_cho">
							<li><label for="mb_company"><input type="radio" name="kind" checked hname="회원종류" needed <?php if(is_demo) {?>onClick="click_tab_login('company')"<?php }?> value="company" id="mb_company">업소회원</label></li>
							<li><label for="mb_individual"><input type="radio" name="kind" hname="회원종류" needed <?php if(is_demo) {?>onClick="click_tab_login('individual')"<?php }?> value="individual" id="mb_individual">개인회원</label></li>
						</ul>
						<div>
							<p>
								<input type="text" name="mid" value="<?php echo $nf_util->get_html($save_id);?>" placeholder="아이디" hname="아이디" needed>
								<input type="password" name="passwd" placeholder="비밀번호" hname="비밀번호" needed>
							</p>
							<button type="submit" class="login">로그인</button>
						</div>
						</form>
					</td>
					<?php }?>
					<script type="text/javascript">
					<?php if(is_demo) {?>click_tab_login('company');<?php }?>
					</script>
				</tr>
			</tbody>
		</table>
		<p class="domain"><?php echo domain;?></p>
	</div>
</section>

<?php
include NFE_PATH.'/plugin/auth/kcb/auth.inc.php';
?>