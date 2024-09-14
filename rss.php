<?php
$add_cate_arr = array('email', 'subway', 'job_date', 'job_week', 'job_pay', 'job_pay_support', 'job_type', 'job_welfare', 'job_grade', 'job_position', 'job_age', 'job_target', 'job_document', 'job_tema', 'job_conditions');
include "./engine/_core.php";
header('Content-type: text/xml; charset=utf-8'); 
$now = date("D, d M Y H:i:s O");

$employ_query = $db->_query("select * from nf_employ as ne where 1 ".$nf_job->employ_where);
?>
<rss version="2.0">
<channel>
	<title><?php echo $env['site_title'];?></title>
	<link><?php echo domain;?></link>
	<description><?php echo $env['meta_description'];?></description>
	<language>ko</language>
	<pubDate><?php echo $now;?></pubDate>
	<lastBuildDate><?php echo $now;?></lastBuildDate>
	<docs><?php echo domain;?>/index.php</docs>
	<generator><?php echo $env['site_name'];?> RSS FEED Generator</generator>
	<managingEditor><?php echo $env['email'];?></managingEditor>
	<webMaster><?php echo $env['email'];?></webMaster>

	<?php
	while($row=$db->afetch($employ_query)) {
		$employ_info = $nf_job->employ_info($row);

		$area_arr = array();
		if(is_array($employ_info['area_text_arr'])) { foreach($employ_info['area_text_arr'] as $k=>$v) {
			$v_arr = explode(",", $v);
			$area_arr[] = $v_arr[1].' '.$v_arr[2].' '.$v_arr[3].' '.$v_arr[4];
		} }

		$author = $read_allow ? $nf_util->get_text($row['wr_name']) : $nf_job->read_employ_txt;
		$pubDate = date("D, d M Y H:i:s O",strtotime($row['wr_udate']))==date("D, d M Y H:i:s O",strtotime(0000-00-00)) ? date("D, d M Y H:i:s O",strtotime($row['wr_wdate'])) : date("D, d M Y H:i:s O",strtotime($row['wr_udate']));
	?>
	<item>
		<title><![CDATA[<?php echo $nf_util->get_text($row['wr_subject']);?>]]></title>
		<link><?php echo domain;?>/employ/employ_detail.php?no=<?php echo $row['no'];?></link>
		<category><![CDATA[업소명:<?php echo $nf_util->get_text($row['wr_company_name']);?>]]></category>
		<category><![CDATA[근무지역:<?php echo $nf_util->get_text(implode(", ", $area_arr));?>]]></category>
		<category><![CDATA[모집인원:<?php echo $row['wr_person'];?>]]></category>
		<category><![CDATA[급여조건:<?php echo strtr($row['wr_pay_support'], $cate_array['job_pay_support']);?>]]></category>		
		<category><![CDATA[연령:<?php echo $employ_info['age_txt'];?>]]></category>
		<category><![CDATA[성별:<?php echo $employ_info['gender_text'];?>]]></category>
		<category><![CDATA[마감일:<?php echo $employ_info['end_date'];?>]]></category>
		<description><![CDATA[<?php echo stripslashes($row['wr_content']);?>]]></description>
		<author><?php echo $author;?></author>
		<pubDate><?php echo $pubDate;?></pubDate>
	</item>
	<?php
	}?>

</channel>
</rss>