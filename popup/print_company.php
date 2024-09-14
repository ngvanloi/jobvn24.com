<?php
$add_cate_arr = array('subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions', 'job_employ_report_reason');
include_once "../engine/_core.php";
$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($_GET['no']));
$mem_company_row = $db->query_fetch("select * from nf_member_company where `no`=".intval($em_row['cno']));
$employ_info = $nf_job->employ_info($em_row);

$m_title = $nf_util->get_html($em_row['wr_subject']);
?>
<!doctype html>
<html lang="ko">
 <head>
  <title><?php echo $m_title;?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <link href="../css/default.css" rel="stylesheet" type="text/css">
  <link href="../css/style.css" rel="stylesheet" type="text/css">
 </head>
<body>
<style type="text/css">
@media print {
	.readBtn.clearfix { display:none; }
}
</style>
<script type="text/javascript">
window.print();
</script>

<div class="readBtn clearfix" >
	<ul style="float:right; overflow:hidden; padding:0; margin:10px 20px;">
		<li style="float:left;list-style:none; "><a href="#none" onClick="window.print()" style="display:block; padding:3px 5px; font-size:13px; text-decoration:none; border:1px solid #ddd;">인쇄</a></li>
	</ul>
</div>

<section class="print_pop">
	<div class="top">
		<ul class="date">
			<li>등록일 : <?php echo substr($em_row['wr_wdate'],0, 10);?></li>
			<li>모집인원 : <?php echo $em_row['wr_person'];?>명</li>
			<li>모집마감일 : <?php echo $employ_info['end_date'];?></li>
		</ul>
		<p class="logo">
			<img src="<?php echo NFE_URL.'/data/logo/'.$env['logo_top'];?>" alt="<?php echo $nf_util->get_text($env['site_title']);?>">
		</p>
	</div>
	<div class="title">
		<?php echo $nf_util->get_text($em_row['wr_subject']);?>
	</div>
	<div class="table_wrap">
		<table class="style2">
			<colgroup>
				<col style="width:25%">
				<col style="width:20%">
				<col style="width:55%">
			</colgroup>
			<tbody>
				<tr>
					<td rowspan="6" class="logo"><img src="<?php echo $employ_info['logo_'.$employ_info['wr_logo_type']];?>" alt="<?php echo $nf_util->get_text($em_row['wr_company_name']);?>"></td>
					<th>업소명</th>
					<td><?php echo $nf_util->get_text($mem_company_row['mb_company_name']);?></td>
				</tr>
				<tr>
					<th>대표자명</th>
					<td><?php echo $nf_util->get_text($mem_company_row['mb_ceo_name']);?></td>
				</tr>
				<tr>
					<th>업소형태</th>
					<td><?php echo $nf_util->get_text($mem_company_row['mb_biz_type']);?></td>
				</tr>
				<tr>
					<th>주요사업</th>
					<td><?php echo $nf_util->get_text($mem_company_row['mb_biz_content']);?></td>
				</tr>
				<tr>
					<th>업소주소</th>
					<td><?php echo $nf_util->get_text('('.$mem_company_row['mb_biz_zipcode'].') '.$mem_company_row['mb_biz_address0'].' '.$mem_company_row['mb_biz_address1']);?></td>
				</tr>
				<tr>
					<th>홈페이지</th>
					<td><?php echo $nf_util->get_text($mem_company_row['mb_homepage']);?></td>
				</tr>
			</tbody>
		</table>
	</div>

	<h2>지원조건</h2>
	<table class="style2">
		<colgroup>
			<col style="width:20%">
			<col style="width:80%">
		</colgroup>
		<tr>
			<th>경력</th>
			<td><?php echo $employ_info['career_txt'];?></td>
		</tr>
		<tr>
			<th>학력</th>
			<td><?php echo $nf_job->school[$em_row['wr_ability']];?></td>
		</tr>
		<tr>
			<th>연령</th>
			<td><?php echo $employ_info['age_txt'];?></td>
		</tr>
		<tr>
			<th>성별</th>
			<td><?php echo $employ_info['gender_text'];?></td>
		</tr>
		<tr>
			<th>직급/직책</th>
			<td><?php echo strtr(strtr($em_row['wr_grade'], array(","=>", ")), $cate_array['job_grade']);?> @@ <?php echo strtr(strtr($em_row['wr_position'], array(","=>", ")), $cate_array['job_position']);?></td>
		</tr>
		<tr>
			<th>우대</th>
			<td><?php echo strtr(strtr($em_row['wr_preferential'], array(","=>", ")), $cate_array['job_conditions']);?></td>
		</tr>
		<tr>
			<th>우대자격증</th>
			<td><?php echo $nf_util->get_text($em_row['wr_license']);?></td>
		</tr>
	</table>

	<h2>근무조건</h2>
	<table class="style2">
		<colgroup>
			<col style="width:20%">
			<col style="width:80%">
		</colgroup>
		<tr>
			<th>근무형태</th>
			<td><?php echo strtr($em_row['wr_work_type'], $cate_array['job_type']);?></td>
		</tr>
		<tr>
			<th>근무기간</th>
			<td><?php echo $cate_array['job_date'][$em_row['wr_date']];?></td>
		</tr>
		<tr>
			<th>근무요일</th>
			<td><?php echo $cate_array['job_week'][$em_row['wr_week']];?></td>
		</tr>
		<tr>
			<th>근무시간</th>
			<td><?php echo $em_row['wr_stime'].' ~ '.$em_row['wr_etime'];?></td>
		</tr>
		<tr>
			<th>급여</th>
			<td><?php echo $employ_info['pay_txt'];?></td>
		</tr>
		<tr>
			<th>급여조건</th>
			<td><?php echo strtr($em_row['wr_pay_support'], $cate_array['job_pay_support']);?></td>
		</tr>
	</table>

	<h2>상세요강</h2>
	<table class="style2">
		<tr>
			<td><?php echo stripslashes($em_row['wr_content']);?></td>
		</tr>
	</table>

	<h2>근무환경</h2>
	<table class="style2">
		<colgroup>
			<col style="width:20%">
			<col style="width:80%">
		</colgroup>
		<tr>
			<th>근무지역</th>
			<td>
				<?php
				if(is_array($employ_info['area_text_arr2_txt'])) { foreach($employ_info['area_text_arr2_txt'] as $k=>$v) {
					echo $v.'<br/>';
				} }
				?>
			</td>
		</tr>
		<tr>
			<th>급여조건</th>
			<td><?php if($employ_info['pay_txt_first']) {?><span class="salary sstyle"><?php echo $employ_info['pay_txt_first'];?></span><?php }?> <?php echo $employ_info['pay_txt_price'];?></td>
		</tr>
		<tr>
			<th>근무시간</th>
			<td><?php echo $cate_array['job_date'][$em_row['wr_date']];?>/<?php echo $cate_array['job_week'][$em_row['wr_week']];?>/<?php echo $em_row['wr_stime'];?> ~ <?php echo $em_row['wr_etime'];?></td>
		</tr>
		<tr>
			<th>인근지하철</th>
			<td>
				<?php
				if(is_array($employ_info['subway_text_arr'])) { foreach($employ_info['subway_text_arr'] as $k=>$v) {
					$v_subway_txt = explode(",", substr(substr($v,0,-1),1));
					echo $v_subway_txt[0].'>'.$v_subway_txt[1].'>'.$v_subway_txt[2].'<br/>';
				} }
				?>
			</td>
		</tr>
		<tr>
			<th>복리후생</th>
			<td>
				<?php
				$job_welfare_arr = array();
				if(is_array($cate_p_array['job_welfare'][0])) { foreach($cate_p_array['job_welfare'][0] as $k=>$v) {
					if(is_array($cate_p_array['job_welfare'][$k])) { foreach($cate_p_array['job_welfare'][$k] as $k2=>$v2) {
						if(in_array($k2, $employ_info['welfare_arr'])) {
							if(!$job_welfare_arr[$v['wr_name']]) $job_welfare_arr[$v['wr_name']] = array();
							$job_welfare_arr[$v['wr_name']][] = $v2['wr_name'];
						}
					} }
				} }

				if(is_array($job_welfare_arr)) { foreach($job_welfare_arr as $k=>$v) {
				?>
				<div>
					<?php echo $k.' : '.implode(",", $v);?>
				</div>
				<?php
				} }
				?>
			</td>
		</tr>
	</table>

	<h2>지원정보/방법</h2>
	<table class="style2">
		<colgroup>
			<col style="width:20%">
			<col style="width:80%">
		</colgroup>
		<tr>
			<th>접수방법</th>
			<td>
				<?php
				$requisition_arr = $nf_job->requisition;
				$requisition_arr[','] = ', ';
				echo strtr($employ_info['wr_requisition'], $requisition_arr);
				?>
			</td>
		</tr>
		<tr>
			<th>제출서류</th>
			<td>
				<?php
				$job_document_arr = $cate_array['job_document'];
				$job_document_arr[','] = ', ';
				echo strtr($employ_info['wr_papers'], $job_document_arr);
				?>
			</td>
		</tr>
		<?php if(is_file(NFE_PATH.'/data/employ/'.$em_row['wr_form_attach'])) {?>
		<tr>
			<th>서류파일</th>
			<td>
				<a href="<?php echo NFE_URL;?>/include/regist.php?mode=wr_form_attach_download&no=<?php echo $em_row['no'];?>" class="blue"><?php echo $nf_util->get_text($em_row['wr_form_attach_name']);?></a>
			</td>
		</tr>
		<?php }?>
		<tr>
			<th>사전질문</th>
			<td><?php echo stripslashes(nl2br($em_row['wr_pre_question']));?></td>
		</tr>
	</table>

	<h2>담당자 정보</h2>
	<table class="style2">
		<colgroup>
			<col style="width:20%">
			<col style="width:80%">
		</colgroup>
		<tr>
			<th>담당자</th>
			<td><?php echo $nf_util->get_text($em_row['wr_name']);?></td>
		</tr>
		<tr>
			<th>연락처</th>
			<td><?php echo $nf_util->in_array('phone', $employ_info['manager_not_view_arr']) ? '비공개' : $nf_util->get_text($em_row['wr_phone']);?></td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td><?php echo $nf_util->in_array('hphone', $employ_info['manager_not_view_arr']) ? '비공개' : $nf_util->get_text($em_row['wr_hphone']);?></td>
		</tr>
		<tr>
			<th>팩스</th>
			<td><?php echo $nf_util->in_array('fax', $employ_info['manager_not_view_arr']) ? '비공개' : $nf_util->get_text($em_row['wr_fax']);?></td>
		</tr>
		<tr>
			<th>이메일</th>
			<td><?php echo $nf_util->in_array('email', $employ_info['manager_not_view_arr']) ? '비공개' : $nf_util->get_text($em_row['wr_email']);?></td>
		</tr>
	</table>
</section>


</body>
</html>