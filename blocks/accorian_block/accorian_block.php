<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_accordion_title = get_field( 'ef3_accordion_title' );
$ef3_accordion_content = get_field( 'ef3_accordion_content' );
$block = '';

$block .= '<div class="ef3_accordion_block">';
    $block .= '<h2>' . $ef3_accordion_title . '</h2>';
    $block .= '<div class="ef3_accordion_block_content">';
        foreach($ef3_accordion_content as $ef3_accordion_item) {
            $block .= '<div class="ef3_accordion_item">';
                $block .= '<h3>' . $ef3_accordion_item["accordion_item"]["title"] . '</h3>';
                $block .= '<div class="ef3_accordion_item_text">';
                    $block .= '<p>' . $ef3_accordion_item["accordion_item"]["content"] . '</p>';
                $block .= '</div>';
            $block .= '</div>';
        }
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>