<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php print $rdf_namespaces; ?>>
<style>
.sf-menu.sf-style-space li, .sf-menu.sf-style-space li li, .sf-menu.sf-style-space li li li, .sf-menu.sf-style-space.sf-navbar { background: #BED751 !important;
  font-size: 13px !important;
  text-transform: uppercase !important; }
.sf-menu.sf-style-space.sf-navbar li ul {   background-color: #79A38F !important;}
.sf-menu.sf-style-space a { color: #000 !important;
  padding: 0.75em .65em !important; }
.sf-menu.sf-style-space li:hover, .sf-menu.sf-style-space li.sfHover, .sf-menu.sf-style-space li.active a, .sf-menu.sf-style-space a:focus, .sf-menu.sf-style-space a:hover, .sf-menu.sf-style-space a:active {background: #79A38F !important;
  color: #fff !important;}
</style>
<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>  
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <title>Home Page |  Paris newspaper | Edgar County newspaper</title>
  <meta name="description" content="The Prairie Press | Paris newspaper ">
<meta name="keywords" content="The Prairie Press | Paris newspaper | Edgar County newspaper">
<meta property="og:image" content="http://www.prairiepress.net/sites/prairie/files/PrairiePress_Website.jpg">
<meta name="author" content="http://prairiepress.net"/>
<meta name="rating" content="General"/>
<meta name="revisit-after" content="7 days"/>
<meta name="robots" content="index, follow"/>



<meta name="email" content="forms@prairiepress.net"/>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
  
  <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body class="<?php print $classes; ?>"<?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>

</html>