<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_contact_title = get_field( 'ef3_contact_title' );
$ef3_contact_subtitle = get_field( 'ef3_contact_subtitle' );
$ef3_contact_content = get_field( 'ef3_contact_content' );
$ef3_contact_frame_title = get_field( 'ef3_contact_frame_title' );
$block = '';

$block .= '<div class="ef3_contact_block">';
    $block .= '<div class="ef3_contact_block_content">';

    $block .= '<div class="ef3_contact_block_content_header">';
        $block .= '<h1>' . $ef3_contact_title . '</h1>';
        $block .= '<h2>' . $ef3_contact_subtitle . '</h2>';
    $block .= '</div>';
    $block .= '<div class="ef3_contact_block_content_inner">';
    $block .= do_shortcode($ef3_contact_content);

    $block .= '<div class="ef3_contact_block_contact_form">';
        $block .= '<form class="ef3_contact_form">';
            $block .= '<input type="text" class="ef3_contact_fields_scontrol" name="ef3_contact_fields_scontrol" />';
            $block .= '<input type="text" class="ef3_contact_fields" name="ef3_contact_name" placeholder="Your name*" />';
            $block .= '<input type="email" class="ef3_contact_fields" name="ef3_contact_email" placeholder="Your email*" />';
            $block .= '<input type="text" class="ef3_contact_fields" name="ef3_contact_subject" placeholder="The Subject*" />';
            $block .= '<textarea name="ef3_contact_message" placeholder="Your message*"></textarea>';
            $block .= '<button type="submit" class="ef3_form_submit_button">Submit</button>';
        $block .= '</form>';
    $block .= '</div>';

    $block .= '</div>';

    $block .= '<div class="ef3_contact_frame_wrap">';
        $block .= '<div><h3>' . $ef3_contact_frame_title . ' <i class="fa-solid fa-arrow-right"></i></h3></div>';
        $block .= '<div><iframe src="https://calendly.com/talktosid/coffee-with-sid-w?embed_domain=effinlazy.com&amp;embed_type=Inline" width="100%" height="1000" frameborder="0" title="Select a Date &amp; Time - Calendly"></iframe></div>';
    $block .= '</div>';
    
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>