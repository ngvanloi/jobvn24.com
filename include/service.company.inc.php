<!--div class="button_area">
	<button class="base">서비스 신청</button>
</div-->

<?php
if($env['service_employ_use']) {
?>
<ul class="service_quick company">
	<?php
	if(is_array($nf_job->pay_service['employ'])) { foreach($nf_job->pay_service['employ'] as $k=>$v) {
	?>
	<li class="<?/*on*/?>"><a href="#none" onClick="nf_job.move_service('employ_<?php echo $k;?>')"><?php echo $v;?></a></li>
	<?php
	} }?>
</ul>
<?php
}?>


<?php
// : 이력서열람권
$code = 'employ';
$service_ahref = NFE_URL.'/service/product_payment.php?code=read';
include NFE_PATH.'/include/service/read.service.inc.php';
?>


<?php
// : 패키지
if($env['service_employ_use']) {
	$code = 'employ';
	$service_ahref = NFE_URL.'/company/employ_regist.php';
	include NFE_PATH.'/include/service/package.service.inc.php';
}
?>


<?php
// : 리스트 메인
if($env['service_employ_use']) {
	$code = 'employ';
	$type = '0';
	$code_sub = 'main';
	$service_ahref = NFE_URL.'/company/employ_regist.php';
	include NFE_PATH.'/include/service/list.service.inc.php';
}
?>


<?php
// : 리스트 서브
if($env['service_employ_use']) {
	$code = 'employ';
	$type = '1';
	$code_sub = 'sub';
	$service_ahref = NFE_URL.'/company/employ_regist.php';
	include NFE_PATH.'/include/service/list.service.inc.php';
}
?>


<?php
// : 급구
if($env['service_employ_use']) {
	$code = 'employ';
	$service_ahref = NFE_URL.'/company/employ_regist.php';
	include NFE_PATH.'/include/service/busy.service.inc.php';
}
?>


<?php
$code = 'employ';
if($env['service_employ_use'] && $nf_job->option_use_['employ']>0) {
	$service_ahref = NFE_URL.'/company/employ_regist.php';
	include NFE_PATH.'/include/service/option.service.inc.php';
}
?>


<?php
$code = 'employ';
$service_ahref = NFE_URL.'/service/product_payment.php?code=jump';
include NFE_PATH.'/include/service/jump.service.inc.php';
?>

<?php if(strpos($_SERVER['PHP_SELF'], '/service/product_payment.php')===false) {?>
<div class="next_btn">
	<button class="base" onClick="location.href='<?php echo NFE_URL;?>/company/employ_regist.php'">구인공고 등록</button>
</div>
<?php }?>