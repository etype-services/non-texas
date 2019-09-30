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
      if (!empty($val)) {
        $matches = theme_get_setting('mailchimp_sections');
        foreach ($val as $item) {
          if (strpos($matches,$item->tid) !== false) {
            $variables['mailchimp_js'] = <<<EOT
 
<script>(function(t,e,s,o){var n,a,c;t.SMCX=t.SMCX||[],e.getElementById(o)||(n=e.getElementsByTagName(s),a=n[n.length-1],c=e.createElement(s),c.type="text/javascript",c.async=!0,c.id=o,c.src=["https:"===location.protocol?"https://":"http://","widget.surveymonkey.com/collect/website/js/tRaiETqnLgj758hTBazgd9CtyzhFcbPoDustZqz0RO8AukBdBd8Hq1042gLoX6Zf.js"].join(""),a.parentNode.insertBefore(c,a))})(window,document,"script","smcx-sdk");</script>

EOT;
            break;
          }
        }
      }
    }
  }
}