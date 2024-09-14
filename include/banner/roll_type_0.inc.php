<?php
// : 고정배너
$group_name_child = "";
while($row=$db->afetch($banner_query)) {
	$get_banner = $this->get_banner($row);
	if($group_name_child==$row['wr_g_name']) continue; // : 고정형은 제일위에거 하나만 출력함
	$group_name_child = $row['wr_g_name'];
?>
<div class="item_ banner_list_child_" style="float:left;<?php echo $get_banner['css'];?>">
	<?php if($row['wr_url']) {?><a href="<?php echo $this->get_http($row['wr_url']);?>" <?php echo $get_banner['target'];?>><?php }?>
		<?php echo $get_banner['content'];?>
	<?php if($row['wr_url']) {?></a><?php }?>
</div>
<?php
}
?>