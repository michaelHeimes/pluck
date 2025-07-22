<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/genericons.css">
 
    <link rel="icon" href="<?php bloginfo('template_url');?>/images/favicon.ico" type="image/x-icon"/>
    <link href="<?php bloginfo('template_url');?>/images/favicon.png" rel="apple-touch-icon" sizes="76x76" />
    <link rel="stylesheet" href="https://use.typekit.net/tif1emf.css">

    
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>
	<section id="wrapper">
		
        <header id="header-part">
            <a href="<?php echo home_url(); ?>" class="logo">
                <img class="main" src="<?php the_field('logo-image1','option'); ?>" alt="">
                <img class="white" src="<?php the_field('logo-image2','option'); ?>" alt="">
                <img class="dark" src="<?php the_field('logo-image3','option'); ?>" alt="">
            </a>
			
                
            <div class="desktop-nav">
                <?php wp_nav_menu( array( 'menu' => 'main-menu') ); ?>
            </div>
            
            <a href="#" class="menu_trigger mobile-nav">Menu</a>
            
            <div class="menu_bar mobile-nav">
                <a href="#" class="close">close</a>
                <?php wp_nav_menu( array( 'menu' => 'main-menu') ); ?>
            </div>   
            

			
            <div class="clear"></div>
		</header>

		<div id="content-part">
