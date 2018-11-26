<?php

db_insert('system')->fields(array(
    'name',
    'type',
    'status',
    'schema_version',
  ))
  ->values(array(
    'name' => 'phpseclib',
    'type' => 'module',
    'status' => '1',
    'schema_version' => '0',
  ))
  ->execute();

db_insert('variable')->fields(array(
    'name',
    'value',
  ))
  ->values(array(
    'name' => 'phpseclib_ssh2_enabled',
    'value' => serialize(TRUE),
  ))
  ->values(array(
    'name' => 'phpseclib_ssh1_enabled',
    'value' => serialize(TRUE),
  ))
  ->values(array(
    'name' => 'phpseclib_sftp_enabled',
    'value' => serialize(TRUE),
  ))
  ->values(array(
    'name' => 'phpseclib_crypt_enabled',
    'value' => serialize(TRUE),
  ))
  ->values(array(
    'name' => 'phpseclib_biginteger_enabled',
    'value' => serialize(TRUE),
  ))
  ->execute();
