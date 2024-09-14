<?php include '../include/html_top.php'; ?> <!--html_top-->
<?php include '../include/header.php'; ?> <!--관리자 탑메뉴-->


<!-- 결제페이지설정(구인) -->
<div class="wrap">
	<?php include '../include/left_menu.php'; ?> <!--관리자 공통 좌측메뉴-->

	<section>
		<?php include '../include/title.php'; ?> <!--관리자 타이틀영역-->
		<div class="consadmin conbox">
			<div class="guide">
				<p><img src="../../images/ic/guide.gif" alt="가이드"></p>
				<ul>
					<li>- 구인공고, 이력서 등록후 유료상품 안내 페이지로 이동 여부를 설정하는 페이지입니다.</li>
					<li>- 사용으로 체크시 구인공고, 이력서 등록후 바로 결제 페이지로 이동되어 결제를 유도합니다.</li>
					<li>- 결제페이지를 사용하지 않는 경우에는 구인공고, 이력서 등록후 바로 이곳에서 설정한 무료기간 만큼 자동으로 등록됩니다.</li>
				</ul>
			</div>

			<div class="ass_list">
				<table>
					<colgroup>
						<col width="8%">
					</colgroup>
					<tr>
						<th>페이지 설정</th>
						<td>
							<ul>
								<li class="on"><a href="./pg_page_audit.php">구인공고 심사 여부</a></li>
								<li><a href="./pg_page_employ.php">구인공고 결제 페이지</a></li>
								<li><a href="./pg_page_resume.php">이력서 결제 페이지</a></li>
							</ul>
						</td>
					</tr>
				</table>
			</div>

			
			<h6>구인공고 심사 여부</h6>
			<table class="table3">
				<colgroup>
					<col width="13%">
					<col width="%">
				</colgroup>
				<tr>
					<th>구인공고 심사 여부</th>
					<td>
						<label for=""><input type="radio">사용</label>
						<label for=""><input type="radio">미사용</label> <span>* '사용'을 선택한 경우 관리자가 구인공고를 승인해야만 구인공고가 홈페이지에 등록됩니다.</span>
					</td>
				</tr>
			</table>
		</div>
		<!--//conbox-->

		
		
	</section>
</div>
<!--//wrap-->

<?php include '../include/footer.php'; ?> <!--관리자 footer-->