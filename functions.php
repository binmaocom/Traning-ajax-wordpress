<?php
/**
 * Ajax code.
 *
 */
function new_excerpt_more( $more ) {
	return ' ... <a class="more-link" href="' . get_permalink( get_the_ID() ) . '">Continue reading <span class="screen-reader-text">'. get_the_title() .'</span></a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function rs_add_jquery_ajax(){
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			//ajax load page
			$(document).on('click',"#load-more",function(e){
				loaded = $('.site-main article').length;
				$('#load-more .post-title').hide();
				$('#circleG').show();
				$.ajax({
					type : 'POST',
					data : {
						'action' : 'rs_load_page_ajax',
						'loaded' : loaded
					},
					url : '<?php echo admin_url( "admin-ajax.php" ); ?>',
					success: function(result) {
						if(result == ''){
							$('.nav-load-more-ajax').remove();
						}
						$('.site-main article').last().after(result);
						
						$('#load-more .post-title').show();
						$('#circleG').hide();
					}
				});
				e.preventDefault();
			});
			
			//ajax load more content
			$(document).on('click','.more-link',function(e){
				post_id = $(this).closest('article').attr('id');
				$(this).hide();
				entry_content = $(this).closest('.entry-content');
				$.ajax({
					type : 'POST',
					data : {
						'action' : 'rs_load_more_ajax',
						'post_id' : post_id
					},
					url : '<?php echo admin_url( "admin-ajax.php" ); ?>',
					success: function(result) {
						entry_content.html(result);
					}
				});
				e.preventDefault();
			});
		});
	</script>
	<style type="text/css">
	#load-more .post-title{	
		-webkit-transition: 1000ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
		-moz-transition: 1000ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
		-ms-transition: 1000ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
		-o-transition: 1000ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
		transition: 1000ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
	}
	</style>
<?php
}
add_action('wp_footer','rs_add_jquery_ajax');

//add ajax function to ajax load page wordpress
add_action('wp_ajax_rs_load_page_ajax', 'rs_load_page_ajax');
add_action('wp_ajax_nopriv_rs_load_page_ajax', 'rs_load_page_ajax');
function rs_load_page_ajax(){
	sleep(1);
	global $post;
	$loaded= intval( $_POST['loaded'] );
	$args = array( 
		'orderby'			=>	'date',
		'order'				=>	'ASC',
		'posts_per_page'	=>	get_option('posts_per_page'),
		'offset'			=>	$loaded
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
	die();
}
