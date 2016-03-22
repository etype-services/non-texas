<?php
global $nid;
$node = node_load($nid);
//$field = field_get_items('node', $node, 'field_ad_image');
//$output = field_view_value('node', $node, 'field_ad_image', $image[0]);
?>
<div class="field_ad_image"><a href=""><?php echo $output; ?></a></div>