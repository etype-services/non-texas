<?php
/**
 * Created by PhpStorm.
 * User: charlie
 * Date: 10/17/18
 * Time: 1:00 PM
 */

function iolaregister_preprocess_html(&$variables) {
  if ($node = menu_get_object()) {
    if ($node->type = 'article') {
      $node_wrapper = entity_metadata_wrapper('node', $node);
      $val = $node_wrapper->field_section->value();
      if ($val[0]->tid == 458) {
        $variables['mailchimp_js'] = <<<EOT

<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"1b2c72e5a787c1eeb66fea624","lid":"71b8cfbbd0","uniqueMethods":true}) })</script>

EOT;
      }
    }
  }
}