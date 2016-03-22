<?php
// var_dump($items);
// $field = field_get_items('node', $node, 'field_ad_image');
//$output = field_view_value('node', $node, 'field_ad_image', $image[0]);
?>
<div class="field_ad_image">
  <a href=""><img src="<?php print file_create_url($items[0]['uri']); ?>" /></a>
</div>