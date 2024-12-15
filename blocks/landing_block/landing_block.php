<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$landing_main_heading = get_field( 'landing_main_heading' );
$landing_sub_heading = get_field( 'landing_sub_heading' );
$landing_image_right = get_field( 'landing_image_right' );
$landing_image_left = get_field( 'landing_image_left' );
$ef3_landing_cta = get_field( 'ef3_landing_cta' );
$block = '';
$headingArr = explode(" ", $landing_main_heading);

$block .= '<div class="ef3_landing_block">';
        $block .= '<div class="ef3_landing_block_content">';
        $block .= '<div class="ef3_landing_block_content_inner">';
            $block .= '<h2>';
                foreach($headingArr as $word) {
                    $block .= '<span>' . $word . '</span>';
                }
            $block .= '</h2>';
            $block .= '<h3>' . $landing_sub_heading . '</h3>';
            $block .= '<a href="' . $ef3_landing_cta["link"] . '" class="ef3_buttons">' . $ef3_landing_cta["link_text"] . '</a>';
            $block .= '</div>';
        $block .= '</div>';
        $block .= '<div class="ef3_landing_block_image_right"><div style="background : url(' . $landing_image_right . ') center center no-repeat"></div></div>';
$block .= '</div>';

echo $block;

?>