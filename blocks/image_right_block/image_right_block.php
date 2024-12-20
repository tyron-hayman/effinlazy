<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_image_right_block_content = get_field( 'ef3_image_right_block_content' );
$block = '';

$block .= '<div class="ef3_image_right_block">';
    $block .= '<div class="ef3_image_right_block_content">';
        $block .= '<h2>' . $ef3_image_right_block_content["title"] . '</h2>';
        $block .= '<div class="ef3_image_right_block_left">';
            $block .= $ef3_image_right_block_content["content"];
        $block .= '</div>';
        $block .= '<div class="ef3_image_right_block_right">';
            $block .= '<div class="ef3_image_right_block_image" style="background: url(' . $ef3_image_right_block_content["image"] . ') center center no-repeat"><div></div></div>';
        $block .= '</div>';
    $block .= '</div>';
    if ( $ef3_image_right_block_content["scroll_button_text"] != "" ) {
        $block .= '<div class="ef3_ef3_image_right_block_btn" style="width: 100%">';
            $block .= '<a href="#" class="ef3_buttons">' . $ef3_image_right_block_content["scroll_button_text"] . '</a>';
        $block .= '</div>';
    }
    $block .= '</div>';

echo $block;

?>