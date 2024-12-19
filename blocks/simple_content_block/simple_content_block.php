<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_simple_content_block = get_field( 'ef3_simple_content_block' );
$block = '';

$block .= '<div class="ef3_simple_content_block">';
    $block .= '<div class="ef3_simple_content_block_content">';
        $block .= '<h2>' . $ef3_simple_content_block["title"] . '</h2>';
        $block .= $ef3_simple_content_block["content"];
        if ( $ef3_simple_content_block["cta"]["title"] != "" ) {
            $block .= '<a href="' . $ef3_simple_content_block["cta"]["link"] . '" class="ef3_buttons">' . $ef3_simple_content_block["cta"]["title"] . '</a>';
        }
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>