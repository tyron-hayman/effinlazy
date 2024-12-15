<?php
/**
 * The main template file
*/
get_header();
?>
	<main id="primary_wrapper" class="site-main">
    <?php
		/**
		 * Homepage
		*/
		if ( !is_home() && is_front_page() ) {
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
			endif;
		}
		/**
		 * Interior generic pages
		*/
		if ( !is_home() && !is_front_page() ) {
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'interiorpage' );
				endwhile;
			endif;
		}
		/**
		 * Blogpage
		*/
		if ( is_home() ) { 
		?>
		<div id="blog_page_wrapper">
			<div id="blog_nav">
				<h1>The Blog</h1>
				<div id="blog_cats">
					<ul>
					<li><a class="current_blog_item" href="#" data-catid="all">All</a></li>
					<?php
					$categories = get_categories();
					foreach($categories as $category) {
					   echo '<li><a href="#" data-catid="' . $category->term_id . '">' . $category->name . '</a></li>';
					}
					?>
					</ul>
				</div>
			</div><!-- nav -->

			<div id="blog_content_wrap">

			</div><!-- content -->
		</div><!-- wrapper -->
		<?php } ?>
	</main><!-- #main -->

<?php
get_footer();
?>