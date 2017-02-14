<?php


/**
 * Export last 10 published nodes from site to concatenation db
 */
function etype_wire_node_export() {

  /* get last 10 published nodes from this site */
  $results = db_select('node', 'n')
    ->fields('n')
    ->condition('status', 0, '!=')
    ->condition('type', 'article')
    ->condition('status', '1')
    ->orderBy('created', 'DESC')
    ->range(0, 10)
    ->execute();

  $nodes = array();
  while ($n = $results->fetchAssoc()) {
    $nodes[] = $n;
  }

  $mysqli = new mysqli("104.196.22.53", "etype_wire", "GeMay9k60gL1=2Q", "wire");

  /* check connection */
  if (mysqli_connect_errno()) {
    watchdog('etype_wire', "EType Wire connect failed: %error", array('%error' => mysqli_connect_error()), WATCHDOG_ERROR);
    exit();
  }

  if (count($nodes) > 0) {

    global $base_url;
    $site_name = variable_get('site_name', 'Drupal');

    /* Delete old nodes */
    $sql = "DELETE FROM node WHERE `site` = '$base_url'";
    if ($mysqli->query($sql) !== TRUE) {
      // echo $sql . "\n";
      watchdog('etype_wire', "EType Wire delete failed: %error", array('%error' => $mysqli->error), WATCHDOG_ERROR);
    }

    foreach ($nodes as $node) {
      $object = node_load($node['nid']);
      $wrapper = entity_metadata_wrapper('node', $object);

      // var_dump($wrapper);
      // exit;

      $body = $wrapper->body->value();
      $safe_body = strip_tags($body['safe_value']);

      if (isset ($wrapper->field_kicker)) {
        $kicker = $wrapper->field_kicker->value();
      }
      else {
        $kicker = '';
      }
      $safe_kicker = strip_tags($kicker['safe_value']);

      $image_uri = isset($wrapper->field_image[0]->value()['uri']) ? $wrapper->field_image[0]->value()['uri'] : '';
      if (!empty($image_uri)) {
        // create real url
        $file_path = file_create_url($image_uri);
        // get caption
        $caption = isset($wrapper->field_image[0]->value()['image_field_caption']['value']) ? $wrapper->field_image[0]->value()['image_field_caption']['value'] : '';
        $safe_caption = strip_tags($caption);
      }
      else {
        $file_path = '';
        $safe_caption = '';
      }

      $sql = "INSERT INTO node (
`nid`, `vid`, `type`, `language`, `title`, `body`, `file`, `kicker`, `caption`, `uid`, `status`, `created`, `changed`, `comment`, `promote`, `sticky`, `tnid`, `translate`, `uuid`, `site`, `site_name`) 
VALUES ('" . $node['nid'] . "', '" . $node['vid'] . "', 'article', '" . $node['language'] . "', '" . $node['title'] . "', '" . $safe_body . "', '" . $file_path . "', '" . $safe_kicker . "', '" . $safe_caption . "', '" . $node['uid'] . "', '0', '" . $node['created'] . "', '" . $node['changed'] . "', '" . $node['comment'] . "', '0', '0', '" . $node['tnid'] . "', '" . $node['translate'] . "', '" . $node['uuid'] . "', \"$base_url\", \"$site_name\")";
      if ($mysqli->query($sql) !== TRUE) {
        watchdog('etype_wire', "EType Wire insert failed: %error", array('%error' => $mysqli->error), WATCHDOG_ERROR);
      }
    }

  }

  $mysqli->close();

}