<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$landing_main_heading = get_field( 'landing_main_heading' );
$landing_sub_heading = get_field( 'landing_sub_heading' );
$landing_image_right = get_field( 'landing_image_right' );
$ef3_landing_cta = get_field( 'ef3_landing_cta' );
$ef3_landing_quotes = get_field('ef3_landing_quotes');
$block = '';

$block .= '<div class="ef3_landing_block">';
        $block .= '<div class="ef3_landing_block_inner">';
            $block .= '<div class="ef3_landing_block_content">';
                $block .= '<div class="ef3_landing_block_content_left">';
                    $block .= '<h2>' . $landing_main_heading . '</h2>';
                    $block .= '<h3>' . $landing_sub_heading . '</h3>';
                    $block .= '<a href="' . $ef3_landing_cta["link"] . '" class="ef3_buttons">' . $ef3_landing_cta["link_text"] . '</a>';
                $block .= '</div>';
                $block .= '<div class="ef3_landing_block_content_right">';
                    $block .= '<div class="ef3_landing_image"><div style="background: url(' . $landing_image_right . ') center center no-repeat"></div><div class="ef3_landing_boxes box1"></div><div class="ef3_landing_boxes box2"></div></div>';
                $block .= '</div>';
            $block .= '</div>';
        $block .= '</div>';
        $block .= '<div class="ef3_quotes_wrap">';
        foreach($ef3_landing_quotes as $ef3_landing_quote) {
            $block .= '<div class="ef3_quotes_item">';
                $block .= '<p>"' . $ef3_landing_quote['quote'] . '"</p>';
            $block .= '</div>';
        }
        $block .= '</div>';
$block .= '</div>';

echo $block;

?>