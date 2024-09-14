<script type="text/javascript">
var company_interest = function() {
	var form = document.forms['fsearch_list'];
	nf_util.ajax_submit(form);
}
</script>
<div class="popup_layer limit company-interest-" style="display:none;">
	<div class="h6wrap">
		<h6>관심업소 등록</h6>
		<button type="button" onClick="nf_util.openWin('.company-interest-')"><i class="axi axi-ion-close-round"></i></button>
	</div>
	<div class="scroll">
		<form name="fsearch_part" action="../include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
		<input type="hidden" name="mode" value="search_company_info" />
		<table class="style1">
			<tr>
				<th>업소명</th>
				<td>
					<input type="text" name="mb_company_name" value="<?php echo $nf_util->get_html($company_row['mb_company_name']);?>" hname="업소/점포명" needed>
				</td>
			</tr>
			<tr>
				<th>업소분류</th>
				<td>
					<select title="업소분류선택" name="mb_biz_type" hname="업소분류">
					<option value="">업소분류 선택</option>
					<?php
					if(is_array($cate_p_array['job_company'][0])) { foreach($cate_p_array['job_company'][0] as $k=>$v) {
						$selected = $company_row['mb_biz_type']==$v['wr_name'] ? 'selected' : '';
					?>
					<option value="<?php echo $nf_util->get_html($v['wr_name']);?>" <?php echo $selected;?>><?php echo $v['wr_name'];?></option>
					<?php
					} }
					?>
				</select>
				</td>
			</tr>
		</table>
		<ul class="btn" style="margin-bottom:2rem;">
			<li><button>검색</button></li>
		</ul>
		</form>

		<form name="fsearch_list" action="../include/regist.php" method="post" onSubmit="return nf_util.ajax_submit(this)">
		<input type="hidden" name="mode" value="company_select_interest" />
		<table class="style3">
			<thead>
			<tr>
				<th><input type="checkbox" onclick="nf_util.all_check(this, '.chk_')"></th>
				<th>업소명</th>
				<th>업소분류</th>
				<th>진행중인 공고</th>
			</tr>
			</thead>
			<tbody id="company_list_tbody-">
			<tr>
				<td colspan="4" align="center">검색해주시기 바랍니다.</td>
			</tr>
			</tbody>
		</table>
		</form>
	</div>
	<ul class="btn">
		<li><button type="button" onClick="nf_util.openWin('.company-interest-')">취소</button></li>
		<li><button type="button" onClick="company_interest()">업소 등록</button></li>
	</ul>
</div>