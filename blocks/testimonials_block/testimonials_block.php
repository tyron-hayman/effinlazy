<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_testimonials_title = get_field( 'ef3_testimonials_title' );
$ef3_testimonials_cta = get_field( 'ef3_testimonials_cta' );
// get testimonials
$args = array( 'post_type' => 'testimonials', 'posts_per_page' => 8 );
$the_query = new WP_Query( $args );
$ef3_test_count = $the_query->found_posts;;

$block = '';

$block .= '<div class="ef3_testimonials_block">';
    $block .= '<div class="mouseFriend"><p>Drag</p></div>';
    $block .= '<div class="ef3_testimonials_block_content">';
        $block .= '<div class="ef3_testimonials_block_title">';
            $block .= '<h3>' . $ef3_testimonials_title . '</h3>';
            $block .= '<h4>8 / ' . $ef3_test_count  . '</h4>';
        $block .= '</div>';
        $block .= '<div class="ef3_testimonials_block_testimonials_wrap">';
            $block .= '<div class="ef3_testimonials_block_testimonials">';
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    $block .= '<div class="ef3_testimonials_block_testimonials_box">';
                        $urlData = str_replace(" ", "+", get_the_title());
                        $bgImage = 'https://avatar.iran.liara.run/public/boy?username='. $urlData;
                        if ( has_post_thumbnail( get_the_ID() ) ) {
                            $bgImage = get_the_post_thumbnail( get_the_ID(), 'full' );
                        }
                        $block .= '<div class="ef3_testimonials_block_testimonials_box_content">';
                            $block .= get_field('content', get_the_ID());
                        $block .= '</div>';
                        $block .= '<div class="ef3_testimonials_block_testimonials_author">';
                            $block .= '<div class="ef3_testimonials_block_testimonials_avatar" style="background: url(' . $bgImage . ') center center no-repeat"></div>';
                            $block .= '<h5>' . get_the_title() . '</h5>';
                        $block .= '</div>';
                        $block .= '</div>';
                endwhile;
                wp_reset_postdata();
                } else {
                    $block .= '<p>There have been no testimonials added to the website.';
                }
                $block .= '<div class="ef3_testimonials_block_testimonials_box end">';
                    $block .= '<div class="ef3_testimonials_block_testimonials_box_content">';
                        $block .= '<h6>' . $ef3_testimonials_cta["content"] . '</h6>';
                        $block .= '<a href="' . $ef3_testimonials_cta["link"] . '" class="ef3_buttons">' . $ef3_testimonials_cta["link_text"] . '</a>';
                    $block .= '</div>';
                $block .= '</div>';

            $block .= '</div>';
        $block .= '</div>';
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>