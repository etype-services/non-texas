<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php print $rdf_namespaces; ?>>

<head>
<style>
 .sf-menu.sf-style-default a {
 /* border-left: 1px solid #000 !important;
  border-top: 1px solid #000 !important;
  padding: 0.75em 1em !important; */
  }
  .sf-menu.sf-style-pomegranate li, .sf-menu.sf-style-pomegranate.sf-navbar {
  background: #A8141A !important;
  text-transform: uppercase !important;
  font-size: 15px !important;
  border-bottom:0px !important;
  height:38px !important;
  min-height:38px !important;
  }
  .sf-menu.sf-style-pomegranate a
  {
color: #ffebee !important; 
  text-shadow:0px 0px !important;
  border:0px !important;
  padding: 0em 1em !important;
  height:38px !important;
  line-height:38px !important;
  } 
 .sf-menu.sf-style-pomegranate li:hover, .sf-menu.sf-style-pomegranate li.sfHover, .sf-menu.sf-style-pomegranate li.active a, .sf-menu.sf-style-pomegranate a:focus, .sf-menu.sf-style-pomegranate a:hover, .sf-menu.sf-style-pomegranate a:active, .sf-menu.sf-style-pomegranate.sf-navbar li li
 {
   background: #000 !important;
  color: #ffffff !important;
}
 .sf-menu.sf-style-pomegranate a:hover { text-decoration:underline !important; line-height: 38px !important;}
 .block-inner {overflow:hidden;}
</style>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>  
  <?php print $styles; ?>
  <?php print $scripts; ?>
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