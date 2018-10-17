<?php
/**
 * Created by PhpStorm.
 * User: charlie
 * Date: 10/17/18
 * Time: 1:00 PM
 */

function iolaregister_preprocess_html() {
  echo 'yes';
  if ($node = menu_get_object()) {
    $item = entity_load('field_section', array($node->nid));
    print_r($item);
  }
}