<?php
$count = 1;
if (isset($_COOKIE["eunice"])) {
    $count = (int)$_COOKIE["eunice"];
}
if($count<=5)
{
setcookie("eunice", $count + 1, time() + (60 * 60 * 24 * 30));
}
else {

}
$ua = $_SERVER["HTTP_USER_AGENT"];
/*    ====    Detect the OS    ====    */
// ---- Mobile ----
    // Android
    
    $android        = strpos($ua, 'Android') ? true : false;
     
    // iPhone
    $iphone        = strpos($ua, 'iPhone') ? true : false;
?>
<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php print $rdf_namespaces; ?>>

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>  
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
  <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
   <link href="/sites/eunicearchive.etypegoogle7.com/themes/masthead/templates/popupdata/styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/sites/eunicearchive.etypegoogle7.com/themes/masthead/templates/popupdata/css-pop.js"></script>
</head>

<!-- -----Load Body Based on OS type Start-------->
<?php
if($android && $count<=5)
{ ?>
<body onload="popup('popUpDiv')" class="<?php print $classes; ?>"<?php print $attributes;?>>
<?php } 
elseif($iphone && $count<=5)
{ ?>
<body onload="popup('popUpDiv')" class="<?php print $classes; ?>"<?php print $attributes;?>>
<?php }
else
{ ?>
<body class="<?php print $classes; ?>"<?php print $attributes;?>>
<?php } ?>
<!------- Load Body Based on OS type End --------->
<!--POPUP-->  
    <div id="blanket" style="display:none;text-align:right;height:100%;top:25% !important;"></div>
	
	<div id="popUpDiv" style="display:none;text-align:center;top:25% !important;">
 <div style="text-align:right;width:100%;height:44%;">
 <a href="#" onclick="popup('popUpDiv')" style="margin-right: 3%;"><img src="/sites/eunicearchive.etypegoogle7.com/themes/masthead/templates/popupdata/close_icon.png" width="70" height="70" style="margin-top:1%;"></a></div>
		<?php if($android) { ?><a href="https://play.google.com/store/apps/details?id=com.etype.eunicenews.android.rssviewer&hl=en" >
		<img src="/sites/eunicearchive.etypegoogle7.com/themes/masthead/templates/popupdata/EuniceAnd.jpg" style="width:100%;border:0px solid;" /> </a> <?php } if($iphone) { ?><a href="https://itunes.apple.com/us/app/the-eunice-news-rss/id912315311?mt=8" >
	<img src="/sites/eunicearchive.etypegoogle7.com/themes/masthead/templates/popupdata/EuniceIOS.jpg" style="width:100%;border:0px solid;" /></a><?php } ?>
		
	
	</div>	
<!-- / POPUP-->  
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>

</html>
