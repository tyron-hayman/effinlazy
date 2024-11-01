<?php
/**
 * The template for displaying all single posts and attachments
 */
 
get_header(); ?>
 
    <main id="primary_wrapper" class="site-main">
        <div id="blog_page_wrapper_single">
            <?php
            while ( have_posts() ) : the_post();
            ?>
                <div id="blog_single_header">
                    <h1><?php the_title(); ?></h1>
                </div><!-- header -->
                <div id="blog_single_data">
                    <h2>Written By: <span><?php the_author(); ?></span></h2>
                    <h2>Written On: <span><?php the_date(); ?></span></h2>
                </div><!-- info -->
                <div id="blog_single_content">
                    <?php the_content(); ?>
                    <a href="<?php bloginfo('url'); ?>/blog" class="ef3_buttons">Back to blog</a>
                </div><!-- content -->
            <?php
            endwhile;
            ?>
        </div>
    </main><!-- .site-main -->
 
<?php get_footer(); ?>