<?php
if($_POST['mode']=='member_write') $_val2['is_public'] = 1;
if($mb_id) $_val2['mb_id'] = $mb_id;
if($mno) $_val2['mno'] = $mno;
$_val2['mb_ceo_name'] = $_POST['mb_ceo_name'];
$_val2['mb_company_name'] = $_POST['mb_company_name'];
$_val2['mb_biz_type'] = $_POST['mb_biz_type'];
$_val2['mb_biz_no'] = @implode("-", $_POST['mb_biz_no']);
if($mb_biz_attach) $_val2['mb_biz_attach'] = $mb_biz_attach;
$_val2['mb_biz_phone'] = $_POST['mb_phone'];
$_val2['mb_biz_hphone'] = $_POST['mb_hphone'];
$_val2['mb_biz_zipcode'] = $_POST['mb_zipcode'];
$_val2['mb_biz_address0'] = $_POST['mb_address0'];
$_val2['mb_biz_address1'] = $_POST['mb_address1'];
$_val2['mb_biz_email'] = @implode("@", $_POST['mb_email']);
$_val2['mb_biz_fax'] = @implode("-", $_POST['mb_biz_fax']);
$_val2['mb_biz_success'] = $_POST['mb_biz_success'];
$_val2['mb_biz_form'] = $_POST['mb_biz_form'];
$_val2['mb_biz_content'] = $_POST['mb_biz_content'];
$_val2['mb_biz_foundation'] = $_POST['mb_biz_foundation'];
$_val2['mb_biz_member_count'] = $_POST['mb_biz_member_count'];
$_val2['mb_biz_stock'] = $_POST['mb_biz_stock'];
$_val2['mb_biz_sale'] = $_POST['mb_biz_sale'];
$_val2['mb_biz_vision'] = $_POST['mb_biz_vision'];
$_val2['mb_biz_result'] = $_POST['mb_biz_result'];
if($mb_logo) $_val2['mb_logo'] = $mb_logo;
if($mb_img1) $_val2['mb_img1'] = $mb_img1;
if($mb_img2) $_val2['mb_img2'] = $mb_img2;
if($mb_img3) $_val2['mb_img3'] = $mb_img3;
if($mb_img4) $_val2['mb_img4'] = $mb_img4;

$_val2['mb_movie'] = $_POST['mb_movie'];

$_val2['mb_homepage'] = $nf_util->get_domain($_POST['mb_homepage']);
if(strpos($_SERVER['PHP_SELF'], '/nad/')!==false) $_val2['is_admin'] = 1;
$q2 = $db->query_q($_val2);
?>