<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    show_admin_bar(false);
}

function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

function effinlazyv3_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on EffinLazy2024, use a find and replace
		* to change 'effinlazy2024' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'effinlazyv3', get_template_directory() . '/languages' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-main' => esc_html__( 'Primary', 'effinlazyv3' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'effinlazyv3_setup' );

function wpdev_filter_login_head() {

	if ( has_custom_logo() ) :

		$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		?>
		<style type="text/css">
			.login h1 a {
				background-image: url(<?php echo esc_url( $image[0] ); ?>);
				-webkit-background-size: contain!important;
				background-size: contain!important;
				height: 150px;
				width: 100%;
			}
		</style>
		<?php
	endif;
}

add_action( 'login_head', 'wpdev_filter_login_head', 100 );

/**
 * Enqueue scripts and styles.
 */
function effinlazyv3_scripts() {
	$localize = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'siteurl' => get_bloginfo('url')
    );

    wp_enqueue_style( 'effinlazyv3-tailwind-output', get_template_directory_uri() . '/dist/output.css', array() );
	wp_enqueue_style( 'effinlazyv3-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'effinlazyv3-lenis-style', 'https://unpkg.com/lenis@1.1.14/dist/lenis.css', array() );
    wp_enqueue_style( 'effinlazyv3-main', get_template_directory_uri() . '/assets/css/main.css', array() );
	wp_enqueue_script( 'effinlazyv3-lenis', 'https://unpkg.com/lenis@1.1.14/dist/lenis.min.js');
	wp_enqueue_script( 'effinlazyv3-gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js');
	wp_enqueue_script( 'effinlazyv3-gsap-scroll', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js');
	wp_enqueue_script( 'effinlazyv3-gsap-drag', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Draggable.min.js');
	wp_enqueue_script( 'effinlazyv3-fontawesome', 'https://kit.fontawesome.com/137c57f16a.js');

	wp_enqueue_script( 'effinlazyv3-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _S_VERSION, true );
	wp_localize_script( 'effinlazyv3-main-js', 'ajaxObject', $localize );

}
add_action( 'wp_enqueue_scripts', 'effinlazyv3_scripts' );

// Global Search
function getSearchData() {
	$searchVal = $_POST["search_val"];
	
	$query_args = array( 's' => $searchVal );
	$query = new WP_Query( $query_args );

	echo json_encode($query->posts);
	die();
}
add_action( 'wp_ajax_nopriv_getSearchData', 'getSearchData' );
add_action( 'wp_ajax_getSearchData', 'getSearchData' );

// Get blogs
function getBlogData() {
	$searchVal = $_POST["search_val"];
	if ( $searchVal == "all" ) {
		$query_args = array(
			'post_type' => 'post',
		);
	} else {
		$query_args = array(
			'post_type' => 'post',
			'category__in' => array($searchVal),
		);
	}
	$query = new WP_Query( $query_args );

	echo json_encode($query->posts);
	die();
}
add_action( 'wp_ajax_nopriv_getBlogData', 'getBlogData' );
add_action( 'wp_ajax_getBlogData', 'getBlogData' );

// Build main nav menu
function buildMenu( $menu_id ) {
    $menu_lists = array();
    $sub_parent = 0;
    $menu_items = wp_get_nav_menu_items( $menu_id );
    foreach ( $menu_items as $menu_item ) {

        if ( in_array( $menu_item->object, array( 'page', 'custom' ) ) ) {
            $id = $menu_item->ID;
            $title = $menu_item->title;
            $link = $menu_item->url;
            $menu_item_parent = $menu_item->menu_item_parent;
    
            // if menu item has no parent, means this is the top-menu.
            if ( ! $menu_item_parent ) {
                $menu_lists[ $id ]['child'] = false;
                $menu_lists[ $id ]['id'] = $id;
                $menu_lists[ $id ]['title'] = $title;
                $menu_lists[ $id ]['link'] = $link;
    
                // add active field if current link and open url is same.
                if ( get_permalink() === $link ) {
                    $menu_lists[ $id ]['active'] = 'current-menu-item';
                }
            } else {
                // if parent menu is set, means this is 2nd level menu
                if ( isset( $menu_lists[ $menu_item_parent ] ) ) {
                    $menu_lists[ $menu_item_parent ]['child'] = true;
                    $menu_lists[ $menu_item_parent ][ $id ]['child'] = false;
                    $menu_lists[ $menu_item_parent ][ $id ]['id'] = $id;
                    $menu_lists[ $menu_item_parent ][ $id ]['title'] = $title;
                    $menu_lists[ $menu_item_parent ][ $id ]['link'] = $link;
    
                    // add active field to current menu item and its parent menu item if current link and open url is same.
                    if ( get_permalink() === $link ) {
                        $menu_lists[ $menu_item_parent ]['active'] = 'current-menu-item';
                        $menu_lists[ $menu_item_parent ][ $id ]['active'] = 'current-menu-item';
                    }
    
                    $sub_parent = $menu_item_parent;
                } elseif ( isset( $menu_lists[ $sub_parent ][ $menu_item_parent ] ) ) {
                    // if parent menu is set and their parent menu is also set, means this is 3rd level menu
                    $menu_lists[ $sub_parent ][ $menu_item_parent ]['child'] = true;
                    $menu_lists[ $sub_parent ][ $menu_item_parent ][ $id ]['id'] = $id;
                    $menu_lists[ $sub_parent ][ $menu_item_parent ][ $id ]['title'] = $title;
                    $menu_lists[ $sub_parent ][ $menu_item_parent ][ $id ]['link'] = $link;
    
                    // add active field to current menu item and its parent menu item if current link and open url is same.
                    if ( get_permalink() === $link ) {
                        $menu_lists[ $sub_parent ]['active'] = 'current-menu-item';
                        $menu_lists[ $sub_parent ][ $menu_item_parent ]['active'] = 'current-menu-item';
                        $menu_lists[ $sub_parent ][ $menu_item_parent ][ $id ]['active'] = 'current-menu-item';
                    }
                }
            }

        }
    }
    return $menu_lists;
}

// Register blocks
function register_layout_category( $categories ) {
	
	$categories[] = array(
		'slug'  => 'effinlazy-block-category',
		'title' => 'Effinlazy'
	);

	return $categories;
}

if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
	add_filter( 'block_categories_all', 'register_layout_category' );
} else {
	add_filter( 'block_categories', 'register_layout_category' );
}

function ef3_register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/landing_block' );
	register_block_type( __DIR__ . '/blocks/video_block' );
	register_block_type( __DIR__ . '/blocks/testimonials_block' );
	register_block_type( __DIR__ . '/blocks/services_block' );
	register_block_type( __DIR__ . '/blocks/deal_block' );
	register_block_type( __DIR__ . '/blocks/contact_block' );
	register_block_type( __DIR__ . '/blocks/headings_block' );
	register_block_type( __DIR__ . '/blocks/image_left_block' );
	register_block_type( __DIR__ . '/blocks/image_right_block' );
	register_block_type( __DIR__ . '/blocks/about_block' );
	register_block_type( __DIR__ . '/blocks/simple_content_block' );
	register_block_type( __DIR__ . '/blocks/accorian_block' );
	register_block_type( __DIR__ . '/blocks/boxcontent_block' );
	register_block_type( __DIR__ . '/blocks/stories_block' );
}
add_action( 'init', 'ef3_register_acf_blocks' );

add_filter( 'allowed_block_types_all', 'ef_allowed_block_types', 25, 2 );
 
function ef_allowed_block_types( $allowed_blocks, $editor_context ) {
 
	return array(
		'acf/contact-block',
		'acf/deal-block',
		'acf/landing-block',
		'acf/services-block',
		'acf/testimonials-block',
		'acf/video-block',
		'acf/headings-block',
		'core/paragraph',
		'acf/image-left-block-block',
		'acf/about-block',
		'acf/simple-content-block',
		'acf/accordian-block',
		'acf/image-right-block-block',
		'acf/boxcontent-block',
		'acf/stories-block'
	);
 
}

// Create custom post types
function create_posttype() {
    register_post_type( 'testimonials',
        array(
            'labels' => array(
                'name' => __( 'Testinomials' ),
                'singular_name' => __( 'Testimonial' )
            ),
            'public' => true,
			'supports' => array('title', 'thumbnail'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'testimonials'),
            'show_in_rest' => true,
        )
    );
}
add_action( 'init', 'create_posttype' );

// Send mail
function sendMail() {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = getEmailBody($_POST['name'], $_POST['email'], $_POST['message']);
	$to = get_bloginfo('admin_email');
	$response = '';

	$headers[] = 'From: Effinlazy <noreply@effinlazy.com>';

	if ( wp_mail( $to, $subject, $message, $headers ) ) {
		$response = "Success";
	} else {
		$response = "Something went wrong, please try again later.";
	}

	echo json_encode(array("messsage" => $response));
	die();
}
add_action( 'wp_ajax_nopriv_sendMail', 'sendMail' );
add_action( 'wp_ajax_sendMail', 'sendMail' );

function getEmailBody($name, $email, $body) {
	$variables = array();

	$variables['name'] = $name;
	$variables['email'] = $email;
	$variables['body'] = $body;

	$template = file_get_contents(get_template_directory() . "/email/email.html");

	foreach($variables as $key => $value)
	{
		$template = str_replace('{{ '.$key.' }}', $value, $template);
	}

	return $template;
}
?>