<?php
$_SERVER['__USE_API__'] = array('editor');
$top_menu_code = '400101';
include '../include/header.php';
?>
<!-- 사이트디자인설정 -->
<div class="wrap">
	<?php include '../include/left_menu.php'; ?> <!--관리자 공통 좌측메뉴-->

	<section class="design_index">
		<?php include '../include/title.php'; ?> <!--관리자 타이틀영역-->
		<div class="consadmin conbox">
			<div class="guide">
				<p><img src="../../images/ic/guide.gif" alt="가이드"></p>
				<ul>
					<li>해당 페이지의 안내는 메뉴얼을 참조하세요<button class="s_basebtn4 gray2"  onclick="window.open('../pop/guide.php#guide4-1','window','width=1400, height=800,left=0, top=0, scrollbard=1, scrollbars=yes, resizable=yes')">메뉴얼</button></li>
				</ul>
			</div>
			
			
			<h6>사이트기본설정</h6>
			<form name="fwrite" action="../regist.php" method="post" onSubmit="return validate(this)">
			<input type="hidden" name="mode" value="design_config" />
			<table>
				<colgroup>
					<col width="12%">
				</colgroup>
				<tbody>
					<tr>
						<th>사이트기본색</th>
						<td class="color_choice">
							<label><input type="radio" name="site_color" value="black" <?php echo $env['site_color']=='black' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_gr"></label> <!-- black.css -->
							<label><input type="radio" name="site_color" value="yellow" <?php echo $env['site_color']=='yellow' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_yel"></label> <!-- yellow.css -->
							<label><input type="radio" name="site_color" value="orange" <?php echo $env['site_color']=='orange' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_org"></label> <!-- orange.css -->
							<label><input type="radio" name="site_color" value="red1" <?php echo $env['site_color']=='red1' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_dho"></label> <!-- red1.css -->
							<label><input type="radio" name="site_color" value="red2" <?php echo $env['site_color']=='red2' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_red"></label> <!-- red2.css -->
							<label><input type="radio" name="site_color" value="pink" <?php echo $env['site_color']=='pink' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_pk"></label> <!-- pink.css -->
							<label><input type="radio" name="site_color" value="purple" <?php echo $env['site_color']=='purple' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_pp"></label> <!-- purple.css -->
							<label><input type="radio" name="site_color" value="green1" <?php echo $env['site_color']=='green1' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_lgr"></label> <!-- green1.css -->
							<label><input type="radio" name="site_color" value="green2" <?php echo $env['site_color']=='green2' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_grn"></label> <!-- green2.css -->
							<label><input type="radio" name="site_color" value="greenblue" <?php echo $env['site_color']=='greenblue' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_bgr"></label> <!-- greenblue.css -->
							<label><input type="radio" name="site_color" value="white_blue" <?php echo $env['site_color']=='white_blue' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_wbl"></label> <!-- white_blue.css -->
							<label><input type="radio" name="site_color" value="blue" <?php echo $env['site_color']=='blue' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_dbl"></label> <!-- blue.css -->
							<label><input type="radio" name="site_color" value="deep_blue" <?php echo $env['site_color']=='deep_blue' ? 'checked' : '';?>><img src="../../images/comn/b.gif" alt="" class="grf_indi"></label> <!-- deep_blue.css -->
						</td>
					</tr>
					<tr>
						<th>구인공고 로고 설정</th>	
						<td>
							<table class="table3" style="width:auto;">
								<tr>
									<th><label><input type="radio" name="employ_logo" value="text" <?php echo $env['employ_logo']=='text' ? 'checked' : '';?>>텍스트로고</label></th>
									<th><label><input type="radio" name="employ_logo" value="logo" <?php echo $env['employ_logo']=='logo' ? 'checked' : '';?>>이미지로고</label></th>
									<th><label><input type="radio" name="employ_logo" value="bg" <?php echo $env['employ_logo']=='bg' ? 'checked' : '';?>>배경로고</label></th>
									<th><label><input type="radio" name="employ_logo" value="all" <?php echo $env['employ_logo']=='all' ? 'checked' : '';?>>텍스트로고 + 이미지로고 + 배경로고</label></th>
								</tr>
								<tr>
									<td>
										<dl>
											<dt class="MAB5"><span>* 텍스트로고 예시 _ 텍스트로고만 사용</span></dt>
											<dd><img src="../../images/text_ex1.jpg" alt=""></dd>
										</dl>
									</td>
									<td>
										<dl>
											<dt class="MAB5"><span>* 이미지로고 예시 _ 이미지로만 사용</span></dt>
											<dd><img src="../../images/logo_ex1.jpg" alt=""></dd>
										</dl>
									</td>
									<td>
										<dl>
											<dt class="MAB5"><span>* 배경로고 예시 _ 배경로고만 사용</span></dt>
											<dd><img src="../../images/bg_ex1.jpg" alt=""></dd>
										</dl>
									</td>
									<td>
										<dl>
											<dt class="MAB5"><span>* 텍스트로고, 이미지로고, 배경로고를 함께 사용합니다.</span></dt>
											<dt class="MAB5"><span>* 텍스트로고로 선택한 업소은 텍스 로고가 출력되고,  <br>&nbsp;&nbsp;&nbsp;이미지로고로 선택한 업소은 이미지로고가 출력되고, <br>&nbsp;&nbsp;&nbsp;배경로고로 선택한 업소은 배경로고가 출력되는 방식입니다.	</span></dt>
										</dl>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th>지도검색 사용 유무</th>
						<td>
							<label><input type="radio" name="use_map" value="1" checked>사용</label>
							<label><input type="radio" name="use_map" value="0" <?php echo !$env['use_map'] ? 'checked' : '';?>>미사용</label>
						</td>
					</tr>
				</tbody>
			 </table>

			<h6>상단메뉴 설정</h6>
			<table>
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th rowspan="2">메뉴 스타일</th>
					<td>
						<label><input type="radio" name="menu_skin" value="1" checked><b class="MAR10">Design 01</b><img src="../../images/nad/t_01.jpg" alt="스킨1"></label>
					</td>
				</tr>
				<tr>
					<td>
						<label><input type="radio" name="menu_skin" value="2" <?php echo $env['menu_skin']==='2' ? 'checked' : '';?>><b class="MAR10">Design 02</b><img src="../../images/nad/t_02.jpg" alt="스킨2"></label>
					</td>
				</tr>
			</table>

			<div class="flex_btn">
				<button type="submit" class="save_btn">저장하기</button>
			</div>


			<h6>구인공고 서비스 출력설정</h6>
			<?php
			$count = 0;
			if(is_array($nf_job->service_name['employ']['main'])) { foreach($nf_job->service_name['employ']['main'] as $k=>$v) {
				$table_c = $count===0 ? '' : 'MAT10 bt';
				$service_k = '0_'.$k;
				if($k==='list') continue;
			?>
			<table class="<?php echo $table_c;?>">
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th rowspan="2"><?php echo $v;?> 구인정보</th>
					<td>
						<label><input type="checkbox" name="service_config[employ][<?php echo $service_k;?>][use]" value="1" <?php echo $env['service_config_arr']['employ'][$service_k]['use'] ? 'checked' : '';?>>출력 </label><span class="">* 예시 : 가로 출력건수 3 / 세로 출력건수 5 입력시, 15건이 출력됨(3 X 5).</span>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table3" style="width:auto;">
							<tr>
								<th class="tac">가로 출력건수 X 세로 출력건수</th>
								<th class="tac" colspan="2">테두리칼라설정</th>
							</tr>
							<tr>
								<td>
									가로 
									<?php
									$service_width = 6;
									if(in_array($service_k, array('0_2', '0_3'))) $service_width = 5;
									if(in_array($service_k, array('0_4'))) $service_width = 4;

									if($service_k == '0_2') { //리스트형은 가로 2개로 고정
									?>
									<select name="service_config[employ][0_2][width]" >
										<?php
										for($i=2; $i<=2; $i++) {
										?>
										<option value="<?php echo $i;?>" <?php echo $env['service_config_arr']['employ'][$service_k]['width']==$i ? 'selected' : '';?>><?php echo $i;?></option>
										<?php
										}?>
									</select>
									<?php }else{ ?>
									<select name="service_config[employ][<?php echo $service_k;?>][width]" >
										<?php
										for($i=3; $i<=$service_width; $i++) {
										?>
										<option value="<?php echo $i;?>" <?php echo $env['service_config_arr']['employ'][$service_k]['width']==$i ? 'selected' : '';?>><?php echo $i;?></option>
										<?php
										}?>
									</select>
									<?php } ?>
									<b>X</b> 세로 
									<input type="text" name="service_config[employ][<?php echo $service_k;?>][height]" value="<?php echo $env['service_config_arr']['employ'][$service_k]['height'];?>" class="input10" placeholder="숫자입력">
								</td>
								<td>일반 : <input type="text" name="service_config[employ][<?php echo $service_k;?>][border_color]" value="<?php echo $env['service_config_arr']['employ'][$service_k]['border_color'];?>" class="input10 color_picker"><!--button class="basebtn gray MAL5"><img src="../../images/nad/color_choice.png" alt="">색상표</button--></td>
								<td>테두리강조상품 : <input type="text" name="service_config[employ][<?php echo $service_k;?>][border_strong_color]" value="<?php echo $env['service_config_arr']['employ'][$service_k]['border_strong_color'];?>" class="input10 color_picker"><!--button class="basebtn gray MAL5"><img src="../../images/nad/color_choice.png" alt="">색상표</button--></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th><?php echo $v;?> 서비스안내</th>
					<td><textarea type="editor" name="service_intro[employ][<?php echo $service_k;?>]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['employ'][$service_k]);?></textarea></td>
				</tr>
			</table>
			<?php
				$count++;
			} }
			
			
			$service_k = '0_new';
			?>
			<table class="MAT10 bt">
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th>메인 최근 공고 리스트</th>
					<td><label for=""><input type="checkbox" name="service_config[employ][<?php echo $service_k;?>][use]" value="1" <?php echo $env['service_config_arr']['employ'][$service_k]['use'] ? 'checked' : '';?>>출력</label> /   &nbsp;
					출력건수
					<input type="hidden" name="service_config[employ][<?php echo $service_k;?>][width]" value="1" />
					<input type="text" class="input10" name="service_config[employ][<?php echo $service_k;?>][height]" value="<?php echo $env['service_config_arr']['employ'][$service_k]['height'];?>">건
					<span>출력 설정하시면 메인 페이지 하단에 최근 구인공고 리스트가 출력됩니다</span></td>
				</tr>
				<tr>
					<th>메인 최근 공고 리스트 서비스안내</th>
					<td><textarea type="editor" name="service_intro[employ][<?php echo $service_k;?>]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['employ'][$service_k]);?></textarea></td>
				</tr>
			</table>
			<?php 
			$service_k = '0_list';
			?>
			<table class="MAT10 bt">
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th>서브 일반 구인 리스트</th>
					<td>1페이지 당 출력건수
					<input type="hidden" name="service_config[employ][<?php echo $service_k;?>][width]" value="1" />
					<input type="text" class="input10" name="service_config[employ][<?php echo $service_k;?>][height]" value="<?php echo $env['service_config_arr']['employ'][$service_k]['height'];?>">건
					<span>1페이지당 출력되는 건수입니다. </span></td>
				</tr>
				<tr>
					<th>일반 구인 리스트 서비스안내</th>
					<td><textarea type="editor" name="service_intro[employ][<?php echo $service_k;?>]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['employ'][$service_k]);?></textarea></td>
				</tr>
			</table>

			<div class="flex_btn">
				<button type="submit" class="save_btn">저장하기</button>
			</div>


			<h6>인재정보 서비스 출력설정</h6>
			<?php
			$count = 0;
			if(is_array($nf_job->service_name['resume']['main'])) { foreach($nf_job->service_name['resume']['main'] as $k=>$v) {
				$table_c = $count===0 ? '' : 'MAT10 bt';
				$service_k = '0_'.$k;
				if($k==='list') continue;
			?>
			<table class="<?php echo $table_c;?>">
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th rowspan="2"><?php echo $v;?> 인재정보</th>
					<td>
						<label for=""><input type="checkbox" name="service_config[resume][<?php echo $service_k;?>][use]" value="1" <?php echo $env['service_config_arr']['resume'][$service_k]['use'] ? 'checked' : '';?>>출력</label>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table3" style="width:auto;">
							<tr>
								<th class="tac">총출력수</th>
								<th class="tac" colspan="2">테두리칼라설정</th>
							</tr>
							<tr>
								<td>
									<input type="hidden" name="service_config[resume][<?php echo $service_k;?>][width]" value="3" />3 x
									<input type="text" name="service_config[resume][<?php echo $service_k;?>][height]" class="input10" value="<?php echo $env['service_config_arr']['resume'][$service_k]['height'];?>"> 건
								</td>
								<td>일반 : <input type="text" name="service_config[resume][<?php echo $service_k;?>][border_color]" value="<?php echo $env['service_config_arr']['resume'][$service_k]['border_color'];?>" class="input10 color_picker"><!--button class="basebtn gray MAL5"><img src="../../images/nad/color_choice.png" alt="">색상표</button--></td>
								<td>테두리강조상품 : <input type="text" name="service_config[resume][<?php echo $service_k;?>][border_strong_color]" value="<?php echo $env['service_config_arr']['resume'][$service_k]['border_strong_color'];?>" class="input10 color_picker"><!--button class="basebtn gray MAL5"><img src="../../images/nad/color_choice.png" alt="">색상표</button--></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th><?php echo $v;?> 서비스안내</th>
					<td><textarea type="editor" name="service_intro[resume][<?php echo $service_k;?>]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['resume'][$service_k]);?></textarea></td>
				</tr>
			</table>
			<?php
				$count++;
			} }
			
			
			$service_k = '0_new';
			?>
			<table class="MAT10 bt">
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th>메인 최근 인재 리스트</th>
					<td><label><input type="checkbox" name="service_config[resume][<?php echo $service_k;?>][use]" value="1" <?php echo $env['service_config_arr']['resume'][$service_k]['use'] ? 'checked' : '';?>>출력</label> /  &nbsp;
					출력건수
					<input type="hidden" name="service_config[resume][<?php echo $service_k;?>][width]" value="1" />
					<input type="text" class="input10" name="service_config[resume][<?php echo $service_k;?>][height]" value="<?php echo $env['service_config_arr']['resume'][$service_k]['height'];?>">건
					<span>출력 설정하시면 메인 페이지 하단에 최근 이력서 리스트가 출력됩니다</span></td>
				</tr>
				<tr>
					<th>메인 최근 인재 리스트 서비스안내</th>
					<td><textarea type="editor" name="service_intro[resume][<?php echo $service_k;?>]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['resume'][$service_k]);?></textarea></td>
				</tr>
			</table>
			<?php
			$service_k = '0_list';
			?>
			<table class="MAT10 bt">
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th>서브 일반 인재 리스트</th>
					<td>1페이지 당 출력건수
					<input type="hidden" name="service_config[resume][<?php echo $service_k;?>][width]" value="1" />
					<input type="text" class="input10" name="service_config[resume][<?php echo $service_k;?>][height]" value="<?php echo $env['service_config_arr']['resume'][$service_k]['height'];?>">건
					<span>1페이지당 출력되는 건수입니다. </span></td>
				</tr>
				<tr>
					<th>일반 인재 리스트 서비스안내</th>
					<td><textarea type="editor" name="service_intro[resume][<?php echo $service_k;?>]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['resume'][$service_k]);?></textarea></td>
				</tr>
			</table>

			<div class="flex_btn">
				<button type="submit" class="save_btn">저장하기</button>
			</div>


			<h6>기타 서비스 안내 설정</h6>
			<table>
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th>급구구인 서비스안내</th>
					<td><textarea type="editor" name="service_intro[employ][busy]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['employ']['busy']);?></textarea></td>
				</tr>
				<tr>
					<th>구인공고 점프 서비스안내</th>
					<td><textarea type="editor" name="service_intro[employ][jump]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['employ']['jump']);?></textarea></td>
				</tr>
				<tr>
					<th>이력서 열람 서비스안내</th>
					<td><textarea type="editor" name="service_intro[resume][read]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['resume']['read']);?></textarea></td>
				</tr>
			</table>

			<table class="MAT10 bt">
				<colgroup>
					<col width="12%">
				</colgroup>
				<tr>
					<th>급구인재 서비스안내</th>
					<td><textarea type="editor" name="service_intro[resume][busy]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['resume']['busy']);?></textarea></td>
				</tr>
				<tr>
					<th>이력서 점프 서비스안내</th>
					<td><textarea type="editor" name="service_intro[resume][jump]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['resume']['jump']);?></textarea></td>
				</tr>
				<tr>
					<th>구인공고 열람 서비스안내</th>
					<td><textarea type="editor" name="service_intro[employ][read]" cols="30" rows="10"><?php echo stripslashes($env['service_intro_arr']['employ']['read']);?></textarea></td>
				</tr>
			</table>

			<div class="flex_btn">
				<button type="submit" class="save_btn">저장하기</button>
			</div>
			</form>

		</div>
		<!--//conbox-->


		
	</section>
</div>
<!--//wrap-->

<?php include '../include/footer.php'; ?> <!--관리자 footer-->