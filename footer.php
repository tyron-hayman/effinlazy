<?php
/**
 * The template for displaying the footer
 *
 * @package EffinLazy2024
 */

$custom_logo_id = get_theme_mod( 'custom_logo' );
$logoImage = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$footercontent = get_field('footer_content', 'option');
$socialIcons = array(
    'linkedin' => '<i class="fa-brands fa-linkedin"></i>',
    'facebook' => '<i class="fa-brands fa-square-facebook"></i>',
    'tiktok' => '<i class="fa-brands fa-tiktok"></i>',
    'youtube' => '<i class="fa-brands fa-youtube"></i>',
    'instagram' => '<i class="fa-brands fa-instagram"></i>'
);
$footerSocials = $footercontent['social_links'];
$footerLinks = $footercontent['quick_links'];
?>
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
                    <p>Email: <?php echo $footercontent['email']; ?></p>
                    <p>Phone: <?php echo $footercontent['phone']; ?></p>
                </div>
                <div>
                    <h4>Places to find me</h4>
                    <?php
                        foreach($footerSocials as $socialLink) {
                            $mediaType = $socialLink['social_media_type'];
                            echo '<a class="footer_icons" href="' . $socialLink["link"] . '" target="_blank">' . $socialIcons[$mediaType] . '</a>';
                        }
                    ?>
                </div>
                <div id="footer_quick_links">
                    <h4>Quick Links</h4>
                    <?php
                        foreach($footerLinks as $footerLink) {
                            echo '<a href="' . get_the_permalink($footerLink['link']) . '">' . get_the_title($footerLink['link']) . '</a>';
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