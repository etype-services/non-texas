<?php

/**
 * @file
 * Administration pages provided by EType Wire module.
 */


/**
 * Menu callback for admin/content/wirecontent. Displays all Wire Content on the site.
 * @param string $order
 * @return string
 */
function etype_wire_admin_content() {

    global $base_url;

    $pattern = '/http:\\/\\/(www)*\./i';
    $sub = '';
    $url = preg_replace($pattern, $sub, $base_url);

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
    } else {
        $order = 'site_name';
        $sort = 'DESC';
    }

    /* connect to wire db */
    $dbHandle = _etype_wire_connect();
    $sql = "
SELECT * FROM `node` n 
LEFT JOIN `node_site` ns ON n.nid = ns.original_nid 
WHERE (n.site NOT LIKE \"%$url%\" 
AND (ns.site_base is NULL OR ns.site_base NOT LIKE \"%$url%\"))
ORDER BY $order $sort
";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $wirenodes = $stmt->fetchAll();
    return theme('wire_admin_content', array('wirenodes' => $wirenodes));
}

/**
 * Generate a list of all wire content available on this site.
 */
function theme_wire_admin_content($variables) {

    $nodes = $variables['wirenodes'];

    /* sortable header - theough the fields do not work */
    $header = array(
        t('Title'),
        array('data' => t('Paper'), 'field' => 'site_name'),
        array('data' => t('Published'), 'field' => 'created'),
        t('Operations')
    );

    $rows = array();
    foreach ($nodes as $node) {
        $rows[] = array(
            l($node->title, $node->site . '/node/' . $node->nid, array("target" => "_blank")),
            $node->site_name,
            format_date($node->created),
            l(t('Add'), 'admin/wirecontent/' . $node->nid . '/add')
        );
    }

    if (empty($rows)) {
        $message = t('No wire content available.');
        $rows[] = array(
            array('data' => $message, 'colspan' => 4),
        );
    }

    return theme('table', array('header' => $header, 'rows' => $rows));
}
