<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef_heading_content = get_field( 'ef_heading_content' );
$block = '';

$block .= '<div class="ef3_heading_block">';
    $block .= $ef_heading_content;
$block .= '</div>';

echo $block;

?>