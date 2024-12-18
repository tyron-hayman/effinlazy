<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_box_content_boxes = get_field( 'ef3_box_content_boxes' );
$block = '';

$block .= '<div class="ef3_box_content_boxes_block">';
    foreach($ef3_box_content_boxes as $ef3_box_content) {
        $block .= '<div class="ef3_box_content_box">';
        $block .= '<div><h2>' . $ef3_box_content["content_box"]["title"] . '</h2></div>';
        $block .= '<div>' . $ef3_box_content["content_box"]["content"] . '</div>';
        $block .= '</div>';
    }
$block .= '</div>';

echo $block;

?>