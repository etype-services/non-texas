<?php

function etype_pico_admin() {

  $form = [];

  $etype_picoPublisherId = variable_get('etype_picoPublisherId');

  $form['etype_picoPublisherId'] = [
    '#type' => 'textfield',
    '#title' => t('Pico Id'),
    '#size' => 55,
    '#default_value' => $etype_picoPublisherId,
  ];

  return system_settings_form($form);
}