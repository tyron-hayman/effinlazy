<?php
/**
 * The template for displaying all single testimonials
 */
 
get_header(); 
?>
 
    <main id="primary_wrapper" class="site-main">
        <div id="testimonials_single">
            <?php
            while ( have_posts() ) : the_post();
            $main_content = get_field('main_content', get_the_ID());
            $headline = get_field('headline', get_the_ID());
            ?>
                <div id="testimonials_single_main_content">
                    <div class="testimonials_single_main_content_section">
                        <h1><?php the_title(); ?></h1>
                        <h4><?php echo $headline; ?></h4>
                    </div>
                    <div class="testimonials_single_main_content_section">
                        <h2>Introduction</h2>
                        <p><?php echo $main_content["introduction"]; ?></p>
                    </div>
                    <?php if ( $main_content["approach"]["steps"] ) { ?>
                    <div class="testimonials_single_main_content_section">
                        <h2>Approach</h2>
                        <p><?php echo $main_content["approach"]["content"]; ?></p>
                        <?php
                            if ( $main_content["approach"]["steps"] ) {
                                echo '<ul>';
                                foreach($main_content["approach"]["steps"] as $step) {
                                    echo '<li><strong>' . $step["title"] . '</strong>' . $step["content"] . '</li>';
                                }
                                echo '</ul>';
                            }
                        ?>
                    </div>
                    <?php } ?>
                    <?php if ( $main_content["solution_implementation"]["steps"] ) { ?>
                    <div class="testimonials_single_main_content_section">
                        <h2>Solution Implementation</h2>
                        <p><?php echo $main_content["solution_implementation"]["content"]; ?></p>
                        <?php
                            if ( $main_content["solution_implementation"]["steps"] ) {
                                echo '<ul>';
                                foreach($main_content["solution_implementation"]["steps"] as $step) {
                                    echo '<li><strong>' . $step["title"] . '</strong>' . $step["content"] . '</li>';
                                }
                                echo '</ul>';
                            }
                        ?>
                    </div>
                    <?php } ?>
                    <?php if ( $main_content["results"]["steps"] ) { ?>
                    <div class="testimonials_single_main_content_section">
                        <h2>Results</h2>
                        <p><?php echo $main_content["results"]["content"]; ?></p>
                        <?php
                            if ( $main_content["results"]["steps"] ) {
                                echo '<ul>';
                                foreach($main_content["results"]["steps"] as $step) {
                                    echo '<li><strong>' . $step["title"] . '</strong>' . $step["content"] . '</li>';
                                }
                                echo '</ul>';
                            }
                        ?>
                    </div>
                    <?php } ?>
                    <?php if ( $main_content["testimonial"] ) { ?>
                    <div class="testimonials_single_main_content_section single_testimonial">
                        <h2>Testimonial</h2>
                        <p><?php echo $main_content["testimonial"]; ?></p>
                    </div>
                    <?php } ?>
                    <?php if ( $main_content["call_to_action"] ) { ?>
                    <div class="testimonials_single_main_content_section">
                        <h2>Call to Action</h2>
                        <p><?php echo $main_content["call_to_action"]; ?></p>
                    </div>
                    <?php } ?>
                </div>
            <?php
            endwhile;
            ?>
        </div>
    </main><!-- .site-main -->
 
<?php get_footer(); ?>