<?php
$count = 0;
if(is_array($nf_util->sns_arr)) { foreach($nf_util->sns_arr as $k=>$v) {
	$count++;
	if(!in_array($k, $env['sns_feed_arr'])) continue;
?>
<li><a href="javascript:void(0)" id="btn_sns_<?php echo $k;?>" onClick="nf_util.share_sns(this, '<?php echo $k;?>')"><img src="../../images/main_sns_<?php echo $k;?>.png" alt="<?php echo $v;?>공유"></a></li>
<?php
} }
?>


<?php if(in_array('kakao_talk', $env['sns_feed_arr'])) {?>
<script type="text/javascript">
// 카카오링크 버튼 생성
Kakao.Link.createDefaultButton({
	container: '#btn_sns_kakao_talk', // HTML에서 작성한 ID값
	objectType: 'feed',
	content: {
	title: _subject, // 보여질 제목
	description: _description, // 보여질 설명
	imageUrl: _img, // 콘텐츠 URL
	link: {
		mobileWebUrl: _link,
		webUrl: _link
	}
	}
});
</script>
<?php }?>