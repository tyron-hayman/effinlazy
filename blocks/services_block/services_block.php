<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_services_title = get_field( 'ef3_services_title' );
$ef3_services_columns = get_field( 'ef3_services_columns' );
$ef3_service_subtitle = get_field( 'ef3_service_subtitle' );
$ef3_services_sub_columns = get_field( 'ef3_services_sub_columns' );
$ef3_service_cta = get_field( 'ef3_service_cta' );
$ef3_service_sub_text = get_field( 'ef3_service_sub_text' );
$block = '';

$block .= '<div class="ef3_services_block">';
    $block .= '<div class="ef3_services_block_content">';
    $block .= '<h3>' . $ef3_services_title . '</h3>';

    $block .= '<div class="ef3_services_cols_main">';
        foreach($ef3_services_columns as $serv_main) {
            $block .= '<div class="ef3_services_cols">';
                $block .= '<h4>' . $serv_main['title'] . '</h4>';
                $block .= $serv_main['content'];
                if ( $serv_main['cta']["link_text"] != "" ) {
                    $block .= '<a href="' . $serv_main['cta']["link"] . '" class="ef3_buttons">' . $serv_main['cta']["link_text"] . '</a>';
                }
            $block .= '</div>';
        }
    $block .= '</div>';
    $block .= '<h3 class="ef3_services_block_subtitle">' . $ef3_service_subtitle . '</h3>';
    $block .= '<div class="ef3_services_cols_main">';
        foreach($ef3_services_sub_columns as $serv_main) {
            $block .= '<div class="ef3_services_cols">';
                $block .= '<h4>' . $serv_main['title'] . '</h4>';
                $block .= $serv_main['content'];
            $block .= '</div>';
        }
    $block .= '</div>';
    $block .= '<div class="ef3_service_block_footer">';
        $block .= '<h4>' . $ef3_service_sub_text . '</h4>';
        $block .= '<a href="' . $ef3_service_cta["link"] . '" class="ef3_buttons">' . $ef3_service_cta["link_text"] . '</a>';
    $block .= '</div>';
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>