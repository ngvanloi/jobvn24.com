<!--div class="button_area">
	<button class="base">서비스 신청</button>
</div-->

<?php
if($env['service_employ_use']) {
?>
<ul class="service_quick">
	<?php
	if(is_array($nf_job->pay_service['resume'])) { foreach($nf_job->pay_service['resume'] as $k=>$v) {
		if(!$env['service_resume_use'] && in_array($k, $nf_job->resume_service_arr)) continue;
	?>
	<li class="<?/*on*/?>"><a href="#none" onClick="nf_job.move_service('resume_<?php echo $k;?>')"><?php echo $v;?></a></li>
	<?php
	} }?>
</ul>
<?php
}?>


<?php
// : 이력서열람권
$code = 'resume';
$service_ahref = NFE_URL.'/service/product_payment.php?code=read';
include NFE_PATH.'/include/service/read.service.inc.php';



// : 패키지
if($env['service_resume_use']) {
	$code = 'resume';
	include NFE_PATH.'/include/service/package.service.inc.php';
}


// : 리스트 메인
if($env['service_resume_use']) {
	$code = 'resume';
	$type = '0';
	$code_sub = 'main';
	$service_ahref = NFE_URL.'/individual/resume_regist.php';
	include NFE_PATH.'/include/service/list.service.inc.php';
}


// : 리스트 서브
if($env['service_resume_use']) {
	$code = 'resume';
	$type = '1';
	$code_sub = 'sub';
	$service_ahref = NFE_URL.'/individual/resume_regist.php';
	include NFE_PATH.'/include/service/list.service.inc.php';
}


// : 급구
if($env['service_resume_use']) {
	$code = 'resume';
	$service_ahref = NFE_URL.'/individual/resume_regist.php';
	include NFE_PATH.'/include/service/busy.service.inc.php';
}

// : 옵션
if($env['service_resume_use'] && $nf_job->option_use_['resume']>0) {
	$code = 'resume';
	$service_ahref = NFE_URL.'/individual/resume_regist.php';
	include NFE_PATH.'/include/service/option.service.inc.php';
}


$code = 'resume';
$service_ahref = NFE_URL.'/service/product_payment.php?code=jump';
include NFE_PATH.'/include/service/jump.service.inc.php';
?>

<?php if(strpos($_SERVER['PHP_SELF'], '/service/product_payment.php')===false) {?>
<!--//tablewrap-->
<div class="next_btn">
	<button class="base" onClick="location.href='<?php echo NFE_URL;?>/individual/resume_regist.php'">이력서 등록</button>
</div>
<?php }?>
<!--//@@@@@@--------개인유료서비스 안내 끝---------------@@@@@@@-->