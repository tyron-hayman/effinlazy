<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_about_block_content = get_field( 'ef3_about_block_content' );
$block = '';

$block .= '<div class="ef3_about_block">';
        $block .= '<div class="ef3_about_block_content">';
            $block .= '<h2 class="ef3_about_block_content_title">' . $ef3_about_block_content["title"] . '</h2>';
            $block .= '<div class="ef3_about_block_image"><div style="background: url(' . $ef3_about_block_content["image"] . ') center center no-repeat;"></div></div>';
            $block .= $ef3_about_block_content["content"];
        $block .= '</div>';
    $block .= '</div>';

echo $block;

?>