<?php

/**
 * @file
 * Functions to add Wire content.
 */

function etype_wire_node_add($nid) {

  /* some basic error testing */
  if (!isset($nid)) {
    drupal_set_message(t('Unable to continue, no node id available'), 'error');
    drupal_goto('admin/content/wirecontent');
    return;
  }

  global $base_url;

  /* connect to wire db and get desired node */
  $dbHandle = _etype_wire_connect();

  function get_all($dbHandle, $base_url, $nid) {
    $sql = "SELECT * FROM node WHERE nid = $nid";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $result = $stmt->fetchAll();
    return $result;
  }

  $nodes = get_all($dbHandle, $base_url, $nid);

  if (count($nodes) == 0) {
    drupal_set_message(t('Unable to continue, no nodes available'), 'error');
    drupal_goto('admin/content/wirecontent');
    return;
  }

  $old_node = $nodes[0];

  global $user;
  $entity_type = 'node';

  $new_node = entity_create($entity_type, array(
    'type' => 'article',
    'uid' => $user->uid,
    'status' => 0
  ));

  $entity = entity_metadata_wrapper($entity_type, $new_node);

  $entity->title->set($old_node->title);
  $entity->body->set(array('value' => check_plain($old_node->body)));

  // kicker does not work
  //if (isset($entity->field_kicker)) {
  //  $entity->field_kicker->set($old_node->kicker);
  //}

  $entity->language(LANGUAGE_NONE);

  if (!empty($old_node->file)) {
    $old_file_path = $old_node->file;

    // system_retrieve_file does not set path correctly, so needs to be set explicitly
    $arr = explode('files/', $old_file_path);
    $path = 'public://' . $arr[1];
    $file = system_retrieve_file($old_file_path, $path, TRUE, FILE_EXISTS_RENAME);
    $file->display = '1';
    $file->description = "";
    $file->image_field_caption = array(
      'value' => $old_node->caption,
      'format' => 'plain_text'
    );
    $file = file_save($file);
    $entity->field_image->set(array((array) $file));
  } else {
    $entity->field_image->set(array());
  }

  $entity->save(TRUE);
  $new_nid = $entity->getIdentifier();

  // record saved node
  global $base_url;
  $sql = "INSERT INTO node_site SET `original_nid` = $nid, `real_nid` = $new_nid, `site_base` = '$base_url' ";
  $stmt = $dbHandle->prepare($sql);
  // !!!$stmt->execute();

  drupal_set_message(t('Node added.'));
  drupal_goto('node/' . $new_nid . '/edit');

}