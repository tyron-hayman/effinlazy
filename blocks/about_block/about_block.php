<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_about_title = get_field( 'ef3_about_title' );
$ef3_about_subtitle = get_field( 'ef3_about_subtitle' );
$ef3_about_content = get_field( 'ef3_about_content' );
$ef3_about_cta = get_field( 'ef3_about_cta' );
$ef3_about_image = get_field( 'ef3_about_image' );
$block = '';

$block .= '<div class="ef3_about_block">';
    $block .= '<div class="ef3_about_block_content">';
        $block .= '<div class="ef3_about_block_content_l">';
            $block .= '<div class="ef3_about_image" style="background: url(' . $ef3_about_image . ') center center no-repeat"></div>';
        $block .= '</div>';
        $block .= '<div class="ef3_about_block_content_r">';
            $block .= '<h3>' . $ef3_about_title . '</h3>';
            $block .= '<h4>' . $ef3_about_subtitle . '</h4>';
            $block .= $ef3_about_content;
            if ( $ef3_about_cta["link_text"] != "" ) {
                $block .= '<a href="' . $ef3_about_cta["link"] . '" class="ef3_buttons">' . $ef3_about_cta["link_text"] . '</a>';
            }
        $block .= '</div>';
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>