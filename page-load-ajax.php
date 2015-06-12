<?php
/*Template Name: Page test ajax */
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="box-search post type-post status-publish format-standard hentry category-uncategorized">
				<div class="entry-content">
					<div class="stop-ajax"><h3>Stop all ajax</h3></div>
					<h2 class="entry-title">Box search</h2>
					<input type="text" id="search-input" name="search-input" placeholder="Enter search key" />
					<ul class="box-result-search">
					</ul>
				</div>
			</div>
			<?php
			$args = array( 
				'orderby'			=>	'date',
				'order'				=>	'ASC',
				'posts_per_page'	=>	get_option('posts_per_page')
			);
			$custom_posts = get_posts($args);
			foreach($custom_posts as $i => $post) : setup_postdata($post);
			?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<div class="entry-header">
					<h2 class="entry-title"><?php the_title(); ?></h2>
				</div>
				<!-- .entry-header -->
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
				<!-- .entry-content -->
				<footer class="entry-footer">
					<span class="posted-on">
						<span class="screen-reader-text">Posted on </span>
						<a rel="bookmark" href="<?php the_permalink(); ?>">
							<time datetime="2015-05-20T02:04:32+00:00" class="entry-date published updated"><?php the_time(); ?></time>
						</a>
					</span>
					<span class="byline">
						<span class="author vcard">
							<span class="screen-reader-text">Author </span>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="url fn n"><?php the_author(); ?></a>
						</span>
					</span>
					<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
				</footer>
				<!-- .entry-footer -->
			</article>
			<?php
				endforeach;
				wp_reset_postdata();
			?>
			<nav role="navigation" class="nav-load-more-ajax navigation post-navigation">
				<h2 class="screen-reader-text">Post navigation</h2>
				<div class="nav-links">
					<div class="nav-previous">
						<a id="load-more" rel="prev" href="#">
							<span class="post-title">Load more</span>
						</a>
						<div id="circleG" style="display: none; padding-bottom: 65px;">
							<div id="circleG_1" class="circleG"></div>
							<div id="circleG_2" class="circleG"></div>
							<div id="circleG_3" class="circleG"></div>
						</div>
					</div>
				</div>
			</nav>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
