<?php
// var_dump($items);
// $field = field_get_items('node', $node, 'field_ad_image');
// $output = field_view_value('node', $node, 'field_ad_image', $image[0]);
?>
<div class="field_ad_image">
  <a href="<?php print render($content['field_ad_url']) ?>"><img src="<?php print file_create_url($items[0]['#item']['uri']); ?>" /></a>
</div>