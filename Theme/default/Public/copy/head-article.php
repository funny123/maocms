<!DOCTYPE html>
<html>
<head>
<title><?php echo mc_title(); ?></title>
<?php echo mc_seo(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/style.css" type="text/css" media="screen" />
<link href="<?php echo mc_theme_url(); ?>/css/media.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo mc_theme_url(); ?>/js/jquery.min.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo mc_theme_url(); ?>/js/html5shiv.min.js"></script>
<script src="<?php echo mc_theme_url(); ?>/js/respond.min.js"></script>
<![endif]-->
</head>
<body style="padding-top:0px;">
<a id="site-top"></a>
<div id="single-head-img" class="pr">
	<a id="logo-single" title="返回首页" href="<?php echo mc_site_url(); ?>"><img src="<?php echo mc_theme_url(); ?>/img/logo2.jpg"></a>
	<div class="single-head-img shi1" style="background-image: url(<?php if(mc_fmimg($_GET['id'])) : echo mc_fmimg($_GET['id']); else : echo mc_theme_url().'/img/user_bg.jpg'; endif; ?>);"></div>
	<div class="single-head-img shi2"></div>
	<div class="single-head-img shi3">
		<h1><?php echo mc_user_display_name($_GET['id']); ?></h1>
		<h4><?php echo mc_cut_str(strip_tags(mc_get_page_field($_GET['id'],'content')), 65); ?></h4>
	</div>
</div>