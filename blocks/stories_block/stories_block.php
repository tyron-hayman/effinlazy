<?php
/**
 * Landing Block template.
 *
 * @param array $block The block settings and attributes.
 */

$args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
$the_query = new WP_Query( $args );
$block = '';
$storyNum = 0;

$block .= '<div class="ef3_stories_block">';
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) : $the_query->the_post();

        $nameArr = explode(" ", get_the_title(get_the_ID()));
        $headline = get_field('headline', get_the_ID());
        $name = "";

        foreach ($nameArr as $letter) {
            $name .= mb_substr($letter, 0, 1);
        }

        $bgImage = 'https://ui-avatars.com/api/?name=' . $name . '&background=040404&color=fff';
        if ( has_post_thumbnail( get_the_ID() ) ) {
            $bgImage = get_the_post_thumbnail( get_the_ID(), 'full' );
        }

        $block .= '<div class="ef3_stories_box" style="top: ' . 200 + ($storyNum * 20) .'px;">';
            $block .= '<div class="ef3_stories_box_1">';
                $block .= '<div class="ef3_stories_box_av" style="background: url(' . $bgImage . ') center center no-repeat;"></div>';
            $block .= '</div>';
            $block .= '<div class="ef3_stories_box_2">';
                $block .= '<p>' . $headline . '</p>';
            $block .= '</div>';
            $block .= '<div class="ef3_stories_box_3">';
                $block .= '<a href="' . get_permalink(get_the_ID()) . '">Read More</a>';
            $block .= '</div>';
        $block .= '</div>';

        $storyNum++;
    endwhile;
    wp_reset_postdata();
}
$block .= '</div>';
$block .= '<div style="width: 100%; clear: both;"></div>';

echo $block;

?>