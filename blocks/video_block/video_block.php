<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_video_block_title = get_field( 'ef3_video_block_title' );
$ef3_video_file_url = get_field( 'ef3_video_file_url' );
$block = '';

$block .= '<div class="ef3_video_block">';
    $block .= '<div class="ef3_video_block_bg"></div>';
    $block .= '<div class="ef3_video_block_content">';
        $block .= '<div class="ef3_video_block_title">';
            $block .= '<h3>' . $ef3_video_block_title . '</h3>';
        $block .= '</div>';
            $block .= '<div class="ef3_video_iframe">';
            $block .= '<iframe width="100%" height="100%" src="' . $ef3_video_file_url  . ';controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
            $block .= '</div>';
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>