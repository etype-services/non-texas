<?php

/**
 * @file
 * Definition of variables for Variable API module.
 */

/**
 * Implements hook_variable_info().
 */
function trusttxt_variable_info($options = array()) {
  $variables['trusttxt'] = array(
    'title' => t('Contents of trust.txt', array(), $options),
    'type' => 'text',
    'group' => 'trusttxt',
    'localize' => TRUE,
    'multidomain' => TRUE,
  );

  return $variables;
}

/**
 * Implements hook_variable_group_info().
 */
function trusttxt_variable_group_info() {
  $groups['trusttxt'] = array(
    'title' => t('trustTxt'),
    'description' => t('Configure trust.txt file.'),
    'access' => 'administer trust.txt',
    'path' => array('admin/config/system/trusttxt'),
  );

  return $groups;
}
