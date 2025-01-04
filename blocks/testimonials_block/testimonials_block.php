<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$ef3_testimonials_title = get_field( 'ef3_testimonials_title' );
$ef3_testimonials_cta = get_field( 'ef3_testimonials_cta' );
// get testimonials
$args = array( 'post_type' => 'testimonials', 'posts_per_page' => 8, 'order' => 'ASC', 'orderby' => 'date' );
$the_query = new WP_Query( $args );
$ef3_test_count = $the_query->found_posts;
$avNum = 1;

$block = '';

$block .= '<div class="ef3_testimonials_block">';
    $block .= '<div class="mouseFriend"><p>Drag</p></div>';
    $block .= '<div class="ef3_testimonials_block_content">';
        $block .= '<div class="ef3_testimonials_block_title">';
            $block .= '<h3>' . $ef3_testimonials_title . '</h3>';
        $block .= '</div>';
        $block .= '<div class="ef3_testimonials_block_testimonials_wrap">';
            $block .= '<div class="ef3_testimonials_block_testimonials">';
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    $block .= '<div class="ef3_testimonials_block_testimonials_box">';
                        $urlData = str_replace(" ", "+", get_the_title());

                        $words = explode(" ", get_the_title());
                            $acronym = "";

                            foreach ($words as $w) {
                                $acronym .= mb_substr($w, 0, 1);
                            }

                        $bgImage = 'https://ui-avatars.com/api/?name=' . $acronym . '&background=040404&color=fff';
                        if ( has_post_thumbnail( get_the_ID() ) ) {
                            $bgImage = get_the_post_thumbnail( get_the_ID(), 'full' );
                        }
                        $block .= '<div class="ef3_testimonials_block_testimonials_box_content">';
                            $block .= get_field('content', get_the_ID());
                        $block .= '</div>';
                        $block .= '<div class="ef3_testimonials_block_testimonials_author">';
                            $block .= '<div class="ef3_testimonials_block_testimonials_avatar" style="background: url(' . $bgImage . ') center center no-repeat"></div>';
                            $block .= '<h5>' . $acronym . '</h5>';
                        $block .= '</div>';
                        $block .= '</div>';
                        $avNum++;
                endwhile;
                wp_reset_postdata();
                } else {
                    $block .= '<p>There have been no testimonials added to the website.';
                }
                $block .= '<div class="ef3_testimonials_block_testimonials_box end">';
                    $block .= '<div class="ef3_testimonials_block_testimonials_box_content">';
                        $block .= '<h6>' . $ef3_testimonials_cta["content"] . '</h6>';
                        if ( $ef3_testimonials_cta["link"] ) {
                            $block .= '<a href="' . $ef3_testimonials_cta["link"] . '" class="ef3_buttons">' . $ef3_testimonials_cta["link_text"] . '</a>';
                        }
                        $block .= '</div>';
                $block .= '</div>';

            $block .= '</div>';
        $block .= '</div>';
    $block .= '</div>';
$block .= '</div>';

echo $block;

?>