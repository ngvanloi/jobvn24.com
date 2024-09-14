<?php
$_SERVER['__USE_API__'] = array('map');
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";

$_site_title_ = '지도검색';
include '../include/header_meta.php';
include '../include/header.php';

$m_title = '지도검색';
include NFE_PATH.'/include/m_title.inc.php';
?>
<style type="text/css">
.map_box- { display:none; }
.map_box-.on { display:block; }
</style>
<!-- 지도검색 -->
<div class="wrap1260 MAT20">
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('common_I');
		echo $banner_arr['tag'];
		?>
	</div>
	<section class="sub map">
		<p class="s_title">지도검색</p>
			<div class="map_wrap">
				<div class="map_area0">
					<ul class="map_list">
						<div class="map-list-"></div>
					</ul>
					<div class="map-list-paging-"></div>
				</div>
				<div class="map_area">
					<?php
					$map_height = 900;
					include NFE_PATH.'/plugin/map/map_cluster1.php';
					?>
					<div class="map_search area-address-" style="z-index:2;">
						<label>
							<input type="text" name="map_address" class="full_address-" onClick="sample2_execDaumPostcode(this)">
							<button type="button"><i class="axi axi-search3"></i></button>
						</label>
					</div>
					<?php
					$address_move_latlng_nor_marker = true;
					include NFE_PATH.'/include/post.daum.php';
					?>
					<script type="text/javascript">
					var map_load = function(page) {
						page = page ? page : 1;
						var map_width = $("#map_div").width();
						var latlng = nf_map.get_latlng();
						$.post(root+"/include/regist.php", "mode=get_map_employ&page="+page+"&width="+map_width+"&lat="+latlng.lat+"&lng="+latlng.lng+'&zoom='+nf_map.get_zoom(), function(data){
							data = $.parseJSON(data);
							if(data.js) eval(data.js);

							if(nf_map.get_zoom()>7) {
								$(".map_box-").removeClass("on");
							} else {
								$(".map_box-").addClass("on");
							}
						});
					}
					map_load();
					nf_map.zoom_change('map_load()');
					nf_map.dragend('map_load()');
					</script>
				</div>
			</div>
	</section>
	<div class="banner" style="overflow:hidden;">
		<?php
		$banner_arr = $nf_banner->banner_view('common_J');
		echo $banner_arr['tag'];
		?>
	</div>
</div>


<!--푸터영역-->
<?php include '../include/footer.php'; ?>

