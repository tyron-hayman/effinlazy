<?php
/**
 * The template for displaying the footer
 *
 * @package EffinLazy2024
 */

$custom_logo_id = get_theme_mod( 'custom_logo' );
$logoImage = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$footercontent = get_field('footer_content', 'option');
$global_cta_content = get_field('global_cta_content', 'option');

$socialIcons = array(
    'linkedin' => 'LinkedIn',
    'facebook' => 'Facebook',
    'tiktok' => 'TikTok',
    'youtube' => 'Youtube',
    'instagram' => 'Instagram'
);
$footerSocials = $footercontent['social_links'];
$footerLinks = $footercontent['quick_links'];
?>
<div id="global_cta_footer">
    <div id="global_cta_footer_content">
        <h2><?php echo $global_cta_content["title"]; ?></h2>
        <?php 
            echo $global_cta_content["content"];
            if ( $global_cta_content["cta"]["title"] != "" ) {
                echo '<a href="' . $global_cta_content["cta"]["link"] . '" class="ef3_buttons">' . $global_cta_content["cta"]["title"] . '</a>';
            }
        ?>
    </div>
</div>
<div id="siteFooter">
    <div id="siteFooterInner">
        <div id="siteFooterContent">
            <div id="siteFooterContentInner">
                <div>
                    <?php if ( $logoImage[0] ) { ?>
                        <img class="w-full" src="<?php echo $logoImage[0]; ?>" alt="<?php bloginfo("name"); ?>" />
                    <?php } else {
                        echo '<h3>' . get_bloginfo('name') . '</h3>';
                    } ?>
                </div>
                <div>
                    <p><?php echo $footercontent['content']; ?></p>
                </div>
                <div>
                    <p>Email: <?php echo $footercontent['email']; ?></p>
                    <p>Phone: <?php echo $footercontent['phone']; ?></p>
                    <?php
                        foreach($footerSocials as $socialLink) {
                            $mediaType = $socialLink['social_media_type'];
                            echo '<a class="footer_icons" href="' . $socialLink["link"] . '" target="_blank">' . $socialIcons[$mediaType] . '</a>';
                        }
                    ?>
                </div>
                <div id="footer_copy">
                    <p>images and content owned by Effinlazy <?php echo date("Y"); ?> / design & development <a href="https://tyronhayman.me" target="_blank">tyronhayman.me</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>