<?php

/**
 * @file
 * Administration pages provided by EType Wire module.
 */


/**
 * Menu callback for admin/content/wirecontent. Displays all Wire Content on
 * the site.
 *
 * @param string $order
 *
 * @return string
 */
function etype_wire_admin_content() {

  global $base_url;

  $pattern = '/http:\\/\\/(www)*\./i';
  $sub = '';
  $url = preg_replace($pattern, $sub, $base_url);

  /* cluster */
  $string = '';
  $etype_wire_cluster = variable_get('etype_wire_cluster');
  $tmp = [];
  foreach ($etype_wire_cluster as $k => $v) {
    if (strlen($v) > 1) {
      $tmp[] = " cluster REGEXP '$v' ";
    }
  }
  if (count($tmp) > 0) {
    $string = implode($tmp, ' OR ');
    $string = ' AND ( ' . $string . ' ) ';
  }

  /* sorting */
  if (isset($_GET['order'])) {
    switch ($_GET['order']) {
      case 'Paper';
        $order = 'site_name';
        break;

      case 'Published';
        $order = 'created';
        break;

      default:
        $order = 'site_name';
    }
    $sort = $_GET['sort'];
  }
  else {
    $order = 'site_name';
    $sort = 'DESC';
  }

  /* connect to wire db */
  $dbHandle = _etype_wire_connect();
  $sql = "
SELECT * FROM `node` n
LEFT JOIN `node_site` ns ON n.nid = ns.original_nid
WHERE (
  n.site NOT LIKE \"$url\"
  AND (ns.site_base is NULL OR ns.site_base NOT LIKE \"$url\")
  $string
)
ORDER BY $order $sort
";
  $stmt = $dbHandle->prepare($sql);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $wire_nodes = $stmt->fetchAll();
  return theme('wire_admin_content', ['wire_nodes' => $wire_nodes]);
}

/**
 * Generate a list of all wire content available on this site.
 *
 * @param $variables
 *
 * @return string
 */
function theme_wire_admin_content($variables) {

  $nodes = $variables['wire_nodes'];

  /* sortable header */
  $header = [
    t('Title'),
    ['data' => t('Paper'), 'field' => 'site_name'],
    ['data' => t('Published'), 'field' => 'created'],
    t('Operations'),
  ];

  $rows = [];
  foreach ($nodes as $node) {
    $rows[] = [
      l($node->title, $node->site . '/node/' . $node->nid, ["target" => "_blank"]),
      $node->site_name,
      format_date($node->created),
      l(t('Add'), 'admin/wirecontent/' . $node->nid . '/add'),
    ];
  }

  if (empty($rows)) {
    $message = t('No wire content available.');
    $rows[] = [
      ['data' => $message, 'colspan' => 4],
    ];
  }

  return theme('table', ['header' => $header, 'rows' => $rows]);
}

/**
 * Admin settings form -- needs to be customized to each user
 * TODO set up clusters to be administered through config
 *
 * @return mixed
 *
 */
function etype_wire_admin() {

  /* get current setting */
  $etype_wire_cluster_default = variable_get('etype_wire_cluster', 'main');

  /* set cluster options */
  $etype_wire_cluster_options = [
    'main' => 'Main',
  ];

  $form = [];

  $form['etype_wire_cluster'] = [
    '#title' => t('Site Cluster'),
    '#multiple' => TRUE,
    '#description' => t("The cluster that this site belongs to."),
    '#weight' => '1',
    '#type' => 'checkboxes',
    '#options' => $etype_wire_cluster_options,
    '#default_value' => $etype_wire_cluster_default,
  ];

  return system_settings_form($form);
}
