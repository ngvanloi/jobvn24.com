<?php
$PATH = $_SERVER['DOCUMENT_ROOT'];
include_once $PATH."/engine/_core.php";
include '../include/header_meta.php';

$em_row = $db->query_fetch("select * from nf_employ where `no`=".intval($_GET['no']));
$employ_info = $nf_job->employ_info($em_row);
$num = intval($_GET['num']);
$lat = $em_row['wr_lat'.$num];
$lng = $em_row['wr_lng'.$num];

$area_arr = explode(",", $employ_info['doro_area_arr'][$num]);
$area_txt = $area_arr[1].' '.$area_arr[2].' '.$area_arr[3].' '.$area_arr[4];
$area_txt = $employ_info['doro_area_arr'][$num];
?>
<style>
	* {margin:0; padding:0;}
	p.s_title {font-size:20px; background:#f6f6f6; padding:10px; border-bottom:1px solid #ddd; font-weight:bold;}
</style>
<?php
include NFE_PATH.'/plugin/map/load_map.js.php';
?>
<p class="s_title">근무지역</p>
	<div style="font-size:1.8rem; padding:1rem; font-weight:bold;"><?php echo $area_txt;?></div>
	<div>
		<div id="map-view" style="width:100%;height:425px;"></div>
		<script type="text/javascript">
		nf_map.map_start("map-view", {'lat':"<?php echo $lat;?>", 'lng':"<?php echo $lng;?>"});
		nf_map.address_move_marker("<?php echo $lat;?>", "<?php echo $lng;?>", {});
		</script>
	</div>
</body>
</html>
