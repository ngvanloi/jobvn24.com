<?php
include NFE_PATH.'/plugin/map/load_map.js.php';
?>
<div id="map_div" style="width:100%;height:<?php echo $map_height;?>px;z-index:1;"></div>

<?php
switch($env['map_engine']) {
	case "daum":
?>
<script type="text/javascript">
nf_map.map_start("map_div", {zoom:'10'});

// 마커 클러스터러를 생성합니다 
var clusterer = new kakao.maps.MarkerClusterer({
	map: nf_map.map, // 마커들을 클러스터로 관리하고 표시할 지도 객체 
	averageCenter: true, // 클러스터에 포함된 마커들의 평균 위치를 클러스터 마커 위치로 설정 
	minLevel: 10 // 클러스터 할 최소 지도 레벨 
});
</script>
<?php
	break;

	case "google":
?>
<script type="text/javascript">
nf_map.map_start("map_div", {zoom:'10'});
var clusterer;
</script>
<?php
	break;
}
?>