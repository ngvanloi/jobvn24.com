<?php
if(count($_GET['chk'])>0) {
	$nos = implode(",", $_GET['chk']);
}
if($nos) {
	$query = $db->_query("select * from nf_employ as ne right join nf_accept as na on ne.`no`=na.`pno` where na.`code`='employ' and na.`del`=0 and na.`no` in (".$nos.") and na.`mno`=? group by ne.`cno`", array($member['no']));
	$length = $db->num_rows($query);
}

if($length<=0 || !$nos) {
	die($nf_util->close_url("취업활동증명서를 출력할 업소정보가 없습니다."));
}

$cnt_row = $db->query_fetch("select sum(cnt) as c from nf_proof");

$cnt_txt = sprintf("%05d", $cnt_row['c']+1);
if($cnt_row['c']>=99999) $cnt_txt = sprintf("%06d", $cnt_row['c']+1);
if($cnt_row['c']>=999999) $cnt_txt = sprintf("%07d", $cnt_row['c']+1);
?>
<form name="femail">
<?php if(is_array($_GET['chk'])) { foreach($_GET['chk'] as $k=>$v) {?>
<input type="hidden" name="chk[]" value="<?php echo $v;?>" />
<?php } }?>
</form>
<section id="print" class="content_wrap clearfix">
	<div class="print" id="rightContent"> 
		<div class="listWrap positionR mt20">
			<?php if(!$btn_none) {?>
			<div class="readBtn clearfix">
				<ul style="float:right; overflow:hidden; padding:0; margin:10px 20px;">
					<li style="float:left; margin-right:10px;list-style:none; "><a href="#none" onClick="proof_click('email')" style="display:block; padding:3px 5px; font-size:13px; text-decoration:none; border:1px solid #ddd;">이메일</a></li>
					<li style="float:left;list-style:none; "><a href="#none" onClick="proof_click('print')" style="display:block; padding:3px 5px; font-size:13px; text-decoration:none; border:1px solid #ddd;">인쇄</a></li>
				</ul>
			</div>
			<?php }?>

			<div id="emailArea" style="width:642px; margin:0 auto;">
			<table width="100%" cellspacing="0" cellpadding="0" bordercolor="#000000" border="2" bgcolor="#FFFFFF" bordercolordark="#000000">
			<tbody>
			<tr>
				<td style="padding:10px" class="orange">
					<table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:12px; font-family:gulim; text-align:left;">
					<tbody>
					<tr class="B_text14">
						<td width="61%" valign="bottom" height="50" style="padding-left:10px;" class="B_text15">제  - <span class="b"><?php echo $cnt_txt;?></span>호</td>
						<td width="39%" valign="bottom" align="right" height="50" class="B_text14"><a target="_blank" href="<?php echo domain;?>"><img src="<?php echo NFE_URL.'/data/logo/'.$env['logo_top'];?>?t=<?php echo time();?>" alt=""></a></td>
					</tr>
					<tr><td height="5"></td></tr>
					<tr><td height="1" style="border-top:1px solid #ccc; line-height:1; font-size:0;" colspan="2">&nbsp;</td></tr>
					<tr><td colspan="2">&nbsp;</td></tr>
					<tr>
						<td align="center" class="" colspan="2" style="font:30px  Batang,sans-serif ;  font-weight:bold; letter-spacing:-1px;">취업활동 증명서</td>
					</tr>
					<tr><td height="30" colspan="2">&nbsp;</td></tr>
					<tr>
						<td align="center" colspan="2">
							<table width="95%" cellspacing="0" cellpadding="0" border="0" style="font-size:12px; font-family:gulim; text-align:left; border:2px solid #ccc">
							<tbody>
							<tr>
								<td style="padding:10px">
									<table width="100%" cellspacing="0" cellpadding="3" border="0" bgcolor="#FFFFFF" style="border-collapse:collapse; font-size:12px; font-family:gulim; text-align:left;">
									<tbody>
									<tr>
										<td width="19%" height="25">- 성&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;명 </td>
										<td width="81%" height="25">: <?php echo $nf_util->get_text($member['mb_name']);?></td>
									</tr>
									<tr>
										<td width="19%" height="25">- 생&nbsp;&nbsp;년&nbsp;&nbsp;월&nbsp;&nbsp;일 </td>
										<td width="81%" height="25">: <?php echo $nf_util->get_text($member['mb_birth']);?></td>
									</tr>
									<tr>
										<td width="19%" height="25">- 주&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소 </td>
										<td width="81%" height="25">: <?php echo $nf_util->get_text('['.$member['mb_zipcode'].'] '.$member['mb_address0'].' '.$member['mb_address1']);?></td>
									</tr>
										<tr>
										<td width="19%" height="25">- 연&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;락&nbsp;&nbsp;&nbsp;&nbsp;처</td>
										<td width="81%" height="25">: <?php echo $nf_util->get_text($member['mb_hphone'] ? $member['mb_hphone'] : $member['mb_phone']);?></td>
									</tr>
									</tbody>
									</table>
								</td>
							</tr>
							</tbody>
							</table>
						</td>
					</tr>
					<tr><td height="30" colspan="2">&nbsp;</td></tr>
					<tr>
						<td height="20" style="padding-left:17px;" colspan="2">
							<b>홍길동</b>님의 취업활동 현황입니다.
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2">
							<table width="95%" cellspacing="0" cellpadding="0" border="0" style="font-size:12px; font-family:gulim; text-align:left;">
							<tbody>
							<tr><td height="2" style="border-top:2px solid #666; line-height:1; font-size:0;" colspan="4">&nbsp;</td></tr>
							<tr bgcolor="#F0F0F0" align="center">
								<td width="14%" height="30">입지원일</td>
								<td width="28%" height="30">업소명</td>
								<td width="42%" height="30">주소</td>
								<td width="16%" height="30">연락처</td>
							</tr>
							<tr align="center"><td height="2" style="border-top:2px solid #666; line-height:1; font-size:0;" colspan="4">&nbsp;</td></tr>
							
							<?php
							while($row=$db->afetch($query)) {
								$company_row = $db->query_fetch("select * from nf_member_company where `no`=?", array($row['cno']));
							?>
							<tr align="center">
								<td width="14%" height="40"><?php echo date("Y.m.d", strtotime($row['sdate']));?></td>
								<td width="28%" height="40"><?php echo $nf_util->get_text($company_row['mb_company_name']);?></td>
								<td width="42%" height="40"><?php echo $nf_util->get_text($company_row['mb_biz_zipcode'].' '.$company_row['mb_biz_zipcode']);?></td>
								<td width="16%" height="40"><?php echo $company_row['mb_biz_phone'] ? $company_row['mb_biz_phone'] : $company_row['mb_biz_hphone'];?></td>
							</tr>
							
							<tr><td height="1" style="border-top:1px solid #666; line-height:1; font-size:0;" colspan="4">&nbsp;</td></tr>
							<?php
							}?>
							</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" height="70" colspan="2"><b><?php echo $nf_util->get_text($member['mb_name']);?></b>님은 <span><?php echo $env['site_name'];?></span>의 입사지원시스템을 통하여 상기 업소에 입사지원하였음을 증명합니다.</td>
					</tr>
					<tr>
						<td align="center" height="60" colspan="2"><?php echo date("Y년 m월 d일");?></td>
					</tr>
					<tr>
						<td align="center" height="100" colspan="2">
							<p style="font:30px  Batang,sans-serif ; letter-spacing: -1px;"><?php echo $env['site_name'];?></p>
						</td>
					</tr>
				</tbody>
				</table>
				</td>
			</tr>
			</tbody>
			</table>
			</div>

		</div>  
	</div>
</section>