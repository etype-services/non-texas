<?php

/**
 * Export last 10 published nodes from site to concatenation db
 */
function etype_wire_node_export() {

  /* get last 10 published nodes from this site */
  $results = db_select('node', 'n')
    ->fields('n')
    ->condition('type', 'article')
    ->condition('status', '1')
    ->orderBy('changed', 'DESC')
    ->range(0, 10)
    ->execute();

  $nodes = [];
  while ($n = $results->fetchAssoc()) {
    $nodes[] = $n;
  }

  if (count($nodes) > 0) {

    $dbHandle = _etype_wire_connect();

    global $base_url;
    $site_name = variable_get('site_name', 'Drupal');
    $etype_wire_cluster = variable_get('etype_wire_cluster');

    /* hack for if cluster is not set up */
    if (empty($etype_wire_cluster)) {
      $etype_wire_cluster = ['main' => 'main'];
    }
    $cluster = implode($etype_wire_cluster, ',');

    /* Delete old nodes */
    $sql = "DELETE FROM node WHERE `site_name` LIKE '$site_name'";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();

    foreach ($nodes as $node) {
      $object = node_load($node['nid']);
      $wrapper = entity_metadata_wrapper('node', $object);

      // var_dump($wrapper);
      // exit;

      $body = $wrapper->body->value();
      $safe_body = $body['safe_value'];

      if (isset ($wrapper->field_kicker)) {
        $kicker = $wrapper->field_kicker->value();
        var_dump($kicker);
      }
      else {
        $kicker = ['safe_value'];
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
`nid`, `vid`, `type`, `language`, `title`, `body`, `file`, `kicker`, `caption`, `uid`, `status`, `created`, `changed`, `comment`, `promote`, `sticky`, `tnid`, `translate`, `uuid`, `site`, `site_name`, `cluster`)
VALUES (
    '" . $node['nid'] . "',
    '" . $node['vid'] . "',
     'article',
     '" . $node['language'] . "',
      " . $dbHandle->quote($node['title']) . ",
       " . $dbHandle->quote($safe_body) . ",
        '" . $file_path . "',
         '" . $safe_kicker . "',
          " . $dbHandle->quote($safe_caption) . ",
           '" . $node['uid'] . "',
            '0',
             '" . $node['created'] . "',
              '" . $node['changed'] . "',
               '" . $node['comment'] . "',
                '0',
                 '0',
                  '" . $node['tnid'] . "',
                   '" . $node['translate'] . "',
                    '" . $node['uuid'] . "',
                     ?,
                      ?,
                       ?)";

      // echo $sql ."\n\n";
      $stmt = $dbHandle->prepare($sql);
      // var_dump($stmt);
      // echo "----------------------\n\n";
      try {
        $stmt->execute(["$base_url", "$site_name", "$cluster"]);
      } catch (Exception $e) {
        // var_dump($stmt);
        // var_dump($safe_body);
        echo "There was an error inserting the data";
        watchdog('etype_wire', "There was an error inserting the data for $base_url.",
          [], WATCHDOG_ERROR);
      }
    }
  }
}
