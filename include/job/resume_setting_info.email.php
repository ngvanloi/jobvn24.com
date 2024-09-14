<?php
$job_type_arr = array();
$job_type1 = $get_customized['customized']['wr_job_type'][0];
$job_type2 = $get_customized['customized']['wr_job_type'][1];
$job_type3 = $get_customized['customized']['wr_job_type'][2];
$job_type_arr[] = $cate_p_array['job_part'][0][$job_type1]['wr_name'];
$job_type_arr[] = $cate_p_array['job_part'][$job_type1][$job_type2]['wr_name'];
$job_type_arr[] = $cate_p_array['job_part'][$job_type2][$job_type3]['wr_name'];

$area_arr = array();
$area1 = $get_customized['customized']['wr_area'][0];
$area2 = $get_customized['customized']['wr_area'][1];
$area3 = $get_customized['customized']['wr_area'][2];
$area_arr[] = $cate_p_array['area'][0][$area1]['wr_name'];
$area_arr[] = $cate_p_array['area'][$area1][$area2]['wr_name'];
$area_arr[] = $cate_p_array['area'][$area2][$area3]['wr_name'];
if($get_customized['customized']['wr_home_work']) $wr_home_work = " (재택근무)";

$job_date = $cate_p_array['job_date'][0][$get_customized['customized']['wr_date']]['wr_name'];

$job_week = $cate_p_array['job_week'][0][$get_customized['customized']['wr_week']]['wr_name'];

$job_time = $cate_p_array['job_time'][0][$get_customized['customized']['wr_time']]['wr_name'];

$job_date_week_time = array();
if($job_date) $job_date_week_time[] = $job_date;
if($job_week) $job_date_week_time[] = $job_week;
if($job_time) $job_date_week_time[] = $job_time;

$school = $nf_job->school_part[$get_customized['customized']['wr_school_ability']];
if($get_customized['customized']['wr_school_ability_end']) $school_end = ' (졸업예정자가능)';

if(strlen($get_customized['customized']['wr_career_type'][0])>0) {
	switch($get_customized['customized']['wr_career_type'][0]) {
		case "0":
			$career_text = "경력무관";
		break;

		case "2":
			$career_text = intval($get_customized['customized']['wr_career'])<12 ? intval($get_customized['customized']['wr_career']).'개월' : (intval($get_customized['customized']['wr_career'])/12).'년';
			$career_text .= strpos($get_customized['customized']['wr_career'], 'down')!==false ? '이하' : '이상';
		break;

		default:
			$career_text = $nf_job->career_type[$get_customized['customized']['wr_career_type'][0]];
		break;
	}
}

if(strlen($get_customized['customized']['wr_gender'])>0) {
	$wr_gender = $get_customized['customized']['wr_gender'] ? $nf_util->gender_arr[$get_customized['customized']['wr_gender']] : "성별무관";
}

if(strlen($get_customized['customized']['wr_age_limit'])>0) {
	$wr_age_limit = $get_customized['customized']['wr_age_limit'] ? '연령무관' : $get_customized['customized']['wr_age'][0].'세 ~ '.$get_customized['customized']['wr_age'][1].'세';
}

if($get_customized['customized']['wr_work_type'][0]) {
	$wr_work_type_text = implode(", ", $get_customized['customized']['wr_work_type']);
	$wr_work_type = strtr($wr_work_type_text, $cate_array['job_type']);
}
?>
<table cellpadding="0" cellspacing="0" border="0" width="607px" style="border:1px solid #d5dbe0; border-bottom:none; border-top:2px solid #3b67ca; margin-top:20px">
	<tbody>
		<colgroup>
			<col width="30%">
			<col width="70%">
		</colgroup>
		<?php if($job_type_arr[0]) {?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">희망직종</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo implode(">", array_diff($job_type_arr, array("")));?></td>
		</tr>
		<?php }?>
		<?php if($area_arr[0]) {?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">희망근무지역</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo implode(">", array_diff($area_arr, array(""))).$wr_home_work;?></td>
		</tr>
		<?php }
		if($job_date || $job_week || $job_time) {
		?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">근무일시</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo implode(" / ", $job_date_week_time);?></td>
		</tr>
		<?php
		}
		if($school) {
		?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">학력</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $school.$school_end;?></td>
		</tr>
		<?php
		}
		if($career_text) {
		?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">경력</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $career_text;?></td>
		</tr>
		<?php
		}
		if($wr_gender) {
		?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">성별</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $wr_gender;?></td>
		</tr>
		<?php
		}
		if($wr_age_limit) {
		?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">연령</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $wr_age_limit;?></td>
		</tr>
		<?php
		}
		if($wr_work_type) {
		?>
		<tr>
			<th style="background:#f4f6f8; color:#333; font-size:14px; text-align:center; vertical-align:middle;border-bottom:1px solid #d5dbe0">근무형태</th>
			<td style="color:#555555; font-size:14px; padding:10px 15px; vertical-align:middle; line-height:1.4rem;border-bottom:1px solid #d5dbe0"><?php echo $wr_work_type;?></td>
		</tr>
		<?php
		}?>
	</tbody>
</table>