<?php

/**
 * @file
 * Administrative page callbacks for the trusttxt module.
 */

/**
 * Administration settings form.
 *
 * @see system_settings_form()
 */
function trusttxt_admin_settings() {
  $form['trusttxt'] = array(
    '#type' => 'textarea',
    '#title' => t('Contents of trust.txt'),
    '#default_value' => variable_get('trusttxt', ''),
    '#cols' => 60,
    '#rows' => 20,
    '#wysiwyg' => FALSE,
  );

  return system_settings_form($form);
}
