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
$brocure_link = get_field('brocure_link', 'option');
?>
<div id="mainSiteNav">
<div class="mainSiteNav_inner">
    <div class="w-[150px] p-2 animationTargets">
        <a href="<?php echo site_url(); ?>">
            <?php if ( $logoImage[0] ) { ?>
            <img class="w-full" src="<?php echo $logoImage[0]; ?>" alt="<?php bloginfo("name"); ?>" />
            <?php } else {
                echo '<h3>' . get_bloginfo('name') . '</h3>';
            } ?>
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
        <li class="global_brochure_link animationTargets">
            <a href="<?php echo $brocure_link; ?>" target="_blank">
                <span class="hideMobile">Brochure</span>
                <span class="showMobile"><i class="fa-solid fa-file-arrow-down"></i></a>
            </a>
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
    <div class="siteLoaderText">
        <svg class="text">
            <text class="texto" x="0" y="70px" fill="#fff" stroke="#fff" stroke-width="2" font-size="48px">
            <tspan class="tp tp4">S</tspan>
            <tspan class="tp tp4" dx="-10px">I</tspan>
            <tspan class="tp tp4" dx="-10px">D</tspan>
            <tspan class="tp tp4" dx="-10px">S</tspan>
            <tspan class="tp tp4" dx="-10px">A</tspan>
            <tspan class="tp tp4" dx="-10px">R</tspan>
            <tspan class="tp tp4" dx="-10px">A</tspan>
            <tspan class="tp tp4" dx="-10px">I</tspan>
            <tspan class="tp tp4" dx="-10px">Y</tspan>
            <tspan class="tp tp4" dx="-10px">A</tspan>
            </text>
        </svg>
    </div>
</div>
<?php } ?>

<div id="global_search_wrap">
    <div id="global_search_wrap_bg"></div>
    <div id="global_search_box">
        <form id="global_search_form">
            <div id="global_search_input">
                <input type="text" name="global_search_input" id="global_search_input" placeholder="What are you looking for?" />
                <div class="search_loader"></div>
            </div>
        </form>
        <div id="search_results_wrap">
            <div id="search_results"></div>
        </div>
    </div>
</div>