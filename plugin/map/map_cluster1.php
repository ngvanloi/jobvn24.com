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

// ��Ŀ Ŭ�����ͷ��� �����մϴ� 
var clusterer = new kakao.maps.MarkerClusterer({
	map: nf_map.map, // ��Ŀ���� Ŭ�����ͷ� �����ϰ� ǥ���� ���� ��ü 
	averageCenter: true, // Ŭ�����Ϳ� ���Ե� ��Ŀ���� ��� ��ġ�� Ŭ������ ��Ŀ ��ġ�� ���� 
	minLevel: 10 // Ŭ������ �� �ּ� ���� ���� 
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