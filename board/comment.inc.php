<?php
if(!$bo_row['bo_use_comment']) return false;
$q = $_table." where `wr_parent`=".intval($_GET['no'])." and `wr_is_comment`=1 and wr_del=0 and `wr_comment_reply`=''";
$total = $db->query_fetch("select count(*) as c from ".$q);

$_arr = array();
$_arr['num'] = 10;
$_arr['total'] = $total['c'];
$paging = $nf_util->_paging_($_arr);

$query = $db->_query("select * from ".$q." order by `wr_datetime` desc limit ".$paging['start'].", ".$_arr['num']);
$nums = $db->num_rows($query);
?>
<style type="text/css">
.reply_con_write-comment- { display:none; }
.comment_comment_list- { display:none; }
</style>
<div id="reply_comment_body-" class="reply_con">

	<form name="fcomment" action="./regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
	<input type="hidden" name="mode" value="board_write" />
	<input type="hidden" name="code" value="comment_insert" />
	<input type="hidden" name="bo_table" value="<?php echo $bo_table;?>" />
	<input type="hidden" name="no" value="<?php echo intval($b_row['wr_no']);?>" />
	<h3>Tất cả bình luận <em class="rpy_num"><?php echo number_format(intval($b_row['wr_comment']));?></em></h3>
	<div class="reply_con_write">
		<?php if(!$member['no']) {?>
		<div class="input_area">
			<ul>
				<li><label>Tên</label><input type="text" name="wr_name" hname="Tên" needed></li>
				<li><label>Mật khẩu</label><input type="password" name="wr_password" hname="Mật khẩu" needed></li>
				<li><label>Nhập mã xác thực tự động</label><input type="text" name="rand_number" hname="Mã xác thực tự động" needed>
				<span><img src="<?php echo NFE_URL;?>/include/rand_text.php?no=<?php echo $b_row['wr_no'];?>&bo_table=<?php echo $bo_table;?>" align="absmiddle"></span>
				</li>
			</ul>
		</div>
		<?php }?>
		<div class="text_area">
			<textarea name="wr_content" hname="Nội dung bình luận" needed placeholder="Nhập bình luận."></textarea>
			<button>Đăng</button>
		</div>
	</div>
	</form>

	<div class="comment_comment-form" style="display:none;">
		<form name="fcomment_comment" action="./regist.php" method="post">
		<input type="hidden" name="mode" value="board_write" />
		<input type="hidden" name="no" value="<?php echo intval($b_row['wr_no']);?>" />
		<input type="hidden" name="comment_id" value="" />
		<input type="hidden" name="code" value="" />
		<input type="hidden" name="bo_table" value="<?php echo $bo_table;?>" />
		<input type="hidden" name="wr_name" value="" hname="Tên" needed />
		<input type="password" name="wr_password" value="" hname="Mật khẩu" needed />
		<input type="hidden" name="rand_number" value="" hname="Mã xác thực tự động" <?php echo $member['no'] ? '' : 'needed';?> />
		<textarea name="wr_content" value="" hname="Nội dung bình luận" needed></textarea>
		</form>
	</div>


	<ul class="reply_list">
		<?php
		while($row=$db->afetch($query)) {
			$b_info = $nf_board->info($row, $board_info);

			$is_secret = $row['wr_secret'];
			if($row['mno'] && $row['mno']==$member['no']) $is_secret = false; // : Bình luận bí mật của tôi
			if($b_row['mno'] && $b_row['mno']==$member['no']) $is_secret = false; // : Chủ bài viết gốc
			if($is_admin) $is_secret = false; // : Quyền quản trị viên
			if($_SESSION['board_view_'.$bo_table.'_'.$row['wr_no']]) $is_secret = false; // : Truy cập qua mật khẩu

			$is_blind = false;
			$is_del = false;
			if($row['wr_blind']) $is_blind = true;
			if($row['wr_del']) $is_del = true;
		?>
		<li class="comment_li-" id="comment_li-<?php echo $row['wr_no'];?>-">
			<?php
			include NFE_PATH.'/board/comment.inc.inc.php';
			?>
		</li>
		<?php
		}
		/*
		?>
		<li>
			<div class="top">
				<p>Hong Gil Dong<span>2022-02-02</span></p>
				<ul>
					<li><a href=""><i class="axi axi-create"></i> Trả lời</a></li>
					<li><a href=""><i class="axi axi-settings"></i> Chỉnh sửa</a></li>
					<li><a href=""><i class="axi axi-trash-o"></i> Xoá</a></li>
				</ul>
			</div>
			<p>Nội dung bình luận nội dung bình luận...</p>
			<!--Ví dụ chỉnh sửa-->
			<div class="reply_con_write">
				<form action="">
					<?php if(!$member['no']) {?>
					<div class="input_area">
						<ul>
							<li><label>Tên</label><input type="text" name="wr_name" hname="Tên" needed haname="Tên"></li>
							<li><label>Mật khẩu</label><input type="password" name="wr_password" hname="Mật khẩu" needed haname="Mật khẩu"></li>
							<li><label>Nhập mã xác thực tự động</label><input type="text" name="rand_number" hname="Mã xác thực tự động" needed haname="Nhập mã xác thực tự động">
							<span><img src="<?php echo NFE_URL;?>/include/rand_text.php?no=<?php echo $b_row['wr_no'];?>&bo_table=<?php echo $bo_table;?>" align="absmiddle"></span>
							</li>
						</ul>
					</div>
					<?php }?>
					<div class="text_area">
						<textarea name="wr_content" hname="Nội dung bình luận" needed placeholder="Nhập bình luận."></textarea>
						<button>Đăng</button>
					</div>
				</form>
			</div>
			<!--//Ví dụ chỉnh sửa-->
			<div class="bottom">
				<p><button type="button">Bình luận (0)</button></p>
				<ul>
					<li><button	type="button"><i class="axi axi-thumbs-o-up"></i>0</button></li>
					<li><button	type="button"><i class="axi axi-thumbs-o-down"></i>0</button></li>
				</ul>
			</div>
			<ul class="re_reply_list">
				<li>
					<div class="top">
						<p>Hong Gil Dong<span>2022-02-02</span></p>
						<ul>
							<li><a href=""><i class="axi axi-trash-o"></i> Xóa</a></li>
						</ul>
					</div>
					<p>Nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận</p>
					<div class="bottom">
						<ul>
							<li><button	type="button"><i class="axi axi-thumbs-o-up"></i>0</button></li>
							<li><button	type="button"><i class="axi axi-thumbs-o-down"></i>0</button></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<li>
			<div class="top">
				<p>Hong Gil Dong<span>2022-02-02</span></p>
				<ul>
					<li><a href=""><i class="axi axi-create"></i> Trả lời</a></li>
					<li><a href=""><i class="axi axi-settings"></i> Chỉnh sửa</a></li>
					<li><a href=""><i class="axi axi-trash-o"></i> Xóa</a></li>
				</ul>
			</div>
			<p>Nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận</p>
			<div class="bottom">
				<p><button type="button">Bình luận (0)</button></p>
				<ul>
					<li><button	type="button"><i class="axi axi-thumbs-o-up"></i>0</button></li>
					<li><button	type="button"><i class="axi axi-thumbs-o-down"></i>0</button></li>
				</ul>
			</div>
			<ul class="re_reply_list">
				<li>
					<div class="top">
						<p>Hong Gil Dong<span>2022-02-02</span></p>
						<ul>
							<li><a href=""><i class="axi axi-settings"></i> Chỉnh sửa</a></li>
							<li><a href=""><i class="axi axi-trash-o"></i> Xóa</a></li>
						</ul>
					</div>
					<p>Nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận</p>
					<div class="bottom">
						<ul>
							<li><button	type="button"><i class="axi axi-thumbs-o-up"></i>0</button></li>
							<li><button	type="button"><i class="axi axi-thumbs-o-down"></i>0</button></li>
						</ul>
					</div>
				</li>
				<li>
					<div class="top">
						<p>Hong Gil Dong<span>2022-02-02</span></p>
						<ul>
							<li><a href=""><i class="axi axi-settings"></i> Chỉnh sửa</a></li>
							<li><a href=""><i class="axi axi-trash-o"></i> Xóa</a></li>
						</ul>
					</div>
					<p>Nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận nội dung bình luận</p>
					<div class="bottom">
						<ul>
							<li><button	type="button"><i class="axi axi-thumbs-o-up"></i>0</button></li>
							<li><button	type="button"><i class="axi axi-thumbs-o-down"></i>0</button></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		*/
		?>
	</ul>
</div>