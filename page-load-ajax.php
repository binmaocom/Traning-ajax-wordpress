<?php
/*Template Name: Page ajax */
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
						<style>
							#circleG{
								width:149.33333333333334px;
							}
							.circleG{
								background-color:#FFFFFF;
								float:left;
								height:32px;
								margin-left:17px;
								width:32px;
								-moz-animation-name:bounce_circleG;
								-moz-animation-duration:1.9500000000000002s;
								-moz-animation-iteration-count:infinite;
								-moz-animation-direction:normal;
								-moz-border-radius:21px;
								-webkit-animation-name:bounce_circleG;
								-webkit-animation-duration:1.9500000000000002s;
								-webkit-animation-iteration-count:infinite;
								-webkit-animation-direction:normal;
								-webkit-border-radius:21px;
								-ms-animation-name:bounce_circleG;
								-ms-animation-duration:1.9500000000000002s;
								-ms-animation-iteration-count:infinite;
								-ms-animation-direction:normal;
								-ms-border-radius:21px;
								-o-animation-name:bounce_circleG;
								-o-animation-duration:1.9500000000000002s;
								-o-animation-iteration-count:infinite;
								-o-animation-direction:normal;
								-o-border-radius:21px;
								animation-name:bounce_circleG;
								animation-duration:1.9500000000000002s;
								animation-iteration-count:infinite;
								animation-direction:normal;
								border-radius:21px;
							}
							#circleG_1{
								-moz-animation-delay:0.39s;
								-webkit-animation-delay:0.39s;
								-ms-animation-delay:0.39s;
								-o-animation-delay:0.39s;
								animation-delay:0.39s;
							}
							#circleG_2{
								-moz-animation-delay:0.9099999999999999s;
								-webkit-animation-delay:0.9099999999999999s;
								-ms-animation-delay:0.9099999999999999s;
								-o-animation-delay:0.9099999999999999s;
								animation-delay:0.9099999999999999s;
							}
							#circleG_3{
								-moz-animation-delay:1.1700000000000002s;
								-webkit-animation-delay:1.1700000000000002s;
								-ms-animation-delay:1.1700000000000002s;
								-o-animation-delay:1.1700000000000002s;
								animation-delay:1.1700000000000002s;
							}
							@-moz-keyframes bounce_circleG{
								0%{
								}
								50%{
									background-color:#000000}
								100%{
								}
							}
							@-webkit-keyframes bounce_circleG{
								0%{
								}
								50%{
									background-color:#000000}
								100%{
								}
							}
							@-ms-keyframes bounce_circleG{
								0%{
								}
								50%{
									background-color:#000000}
								100%{
								}
							}
							@-o-keyframes bounce_circleG{
								0%{
								}
								50%{
									background-color:#000000}
								100%{
								}
							}
							@keyframes bounce_circleG{
								0%{
								}
								50%{
									background-color:#000000}
								100%{
								}
							}
							</style>
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
