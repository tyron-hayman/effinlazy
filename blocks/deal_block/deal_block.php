<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_deal_cta = get_field( 'ef3_deal_cta' );
$block = '';

$block .= '<div class="ef3_deal_block">';
    $block .= '<div class="ef3_about_block_content">';
        $block .= '<div class="ef3_about_block_content_l">';
            $block .= '<div class="ef3_deal_block_image" style="background: url(' . $ef3_deal_cta['image'] . ') center center no-repeat;"></div>';
            $block .= '<h3>' . $ef3_deal_cta['title'] . '</h3>';
        $block .= '</div>';
        $block .= '<div class="ef3_about_block_content_r">';
            $block .= $ef3_deal_cta['content'];
            $block .= '<a href="' . $ef3_deal_cta['cta']["link"] . '" class="ef3_buttons">' . $ef3_deal_cta['cta']["link_text"] . '</a>';
        $block .= '</div>';
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>