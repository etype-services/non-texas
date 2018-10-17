<?php
/**
 * Created by PhpStorm.
 * User: charlie
 * Date: 10/17/18
 * Time: 1:00 PM
 */

function iolaregister_preprocess_html() {
  if ($node = menu_get_object()) {
    dpm($node);
  }
}