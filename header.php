<?php
/**
 * The header for our theme
 *
 * @package EffinLazyV3
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logoImage = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
<div id="mainSiteNav">
<div class="mainSiteNav_inner">
    <div class="w-[150px] p-2 animationTargets">
        <a href="<?php echo site_url(); ?>">
            <img class="w-full" src="<?php echo $logoImage[0]; ?>" alt="<?php bloginfo("name"); ?>" />
        </a>
    </div>
    <div>
        <ul class="nav">
        <?php
            $menuItems = buildMenu('main-menu');
            $menu = '';
            foreach($menuItems as $items) {
                $activeClass = '';
                $tailwind = 'nav-items animationTargets';
                ( $items['active'] ) ? $activeClass =  $items['active']: $activeClass = '';
                $menu .= '<li class="hideOnMobile"><a href="' . $items['link'] . '" class="' . $tailwind . ' ' . $activeClass . '">' . $items['title'] . '</a></li>';
            }
            echo $menu;
        ?>
        <li class="showOnMobile openMobileMenu animationTargets"><a href="#"><i class="fa-solid fa-bars"></i></a>
        <li class="global_search_link animationTargets"><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </ul>
    </div>
</div>
</div><!-- site nav -->

<div id="mobile_menu">
    <a href="#" id="close_mobile_menu"><i class="fa-solid fa-xmark"></i></a>
    <ul class="mobile_nav">
        <?php
            $menuItems = buildMenu('main-menu');
            $menu = '';
            foreach($menuItems as $items) {
                $tailwind = 'nav-items-mobile animationTargets_mobile';
                $menu .= '<li><a href="' . $items['link'] . '" class="' . $tailwind . '">' . $items['title'] . '</a></li>';
            }
            echo $menu;
        ?>
        </ul>
</div><!-- mobile Menu -->

<?php if ( is_front_page() ) { ?>
<div id="siteLoader">
    <p><span>0</span>%</p>
</div>
<?php } ?>

<div id="global_search_wrap">
    <div id="global_search_wrap_bg"></div>
    <div id="global_search_box">
        <form id="global_search_form">
            <div id="global_search_input">
                <input type="text" name="global_search_input" id="global_search_input" placeholder="Enter your search query..." />
                <div class="search_loader"></div>
            </div>
            <p>Press <img src="<?php bloginfo('template_directory'); ?>/assets/images/escape.png" width="40" height="40" alt="escape button" /> or click / tap background to close search.</p>
        </form>
        <div id="search_results"></div>
    </div>
</div>