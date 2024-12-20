<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_box_content_block = get_field( 'ef3_box_content_block' );
$block = '';

$block .= '<div class="ef3_box_content_block">';
    $block .= '<h2>' . $ef3_box_content_block["title"] . '</h2>';
    $block .= '<div class="ef3_box_content_block_content">';
        foreach($ef3_box_content_block["boxes"] as $ef3_box_content_box) {
            $block .= '<div class="ef3_box_content_box">';
                $block .= $ef3_box_content_box["content"];
            $block .= '</div>';
        }
    $block .= '</div>';
    if ( $ef3_box_content_block["cta"]["title"] != "" ) {
        $block .= '<div class="ef3_box_content_block_cta">';
            $block .= '<a href="' . $ef3_box_content_block["cta"]["link"] . '" class="ef3_buttons">' . $ef3_box_content_block["cta"]["title"] . '</a>';
        $block .= '</div>';
    }
$block .= '</div>';

echo $block;

?>