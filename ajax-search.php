<?php
//add ajax function to ajax search wordpress
add_action('wp_ajax_rs_load_search_ajax', 'rs_load_search_ajax_callback');
add_action('wp_ajax_nopriv_rs_load_search_ajax', 'rs_load_search_ajax_callback');
function rs_load_search_ajax_callback(){
	sleep(1);
	global $post;
	$search_key = ( $_POST['search_key'] );
	$args_search = array(  
		'post_status' => 'publish',
		's' => $search_key
	);

	// $query = new WP_Query($args);
	$args = array( 
		'orderby'			=>	'date',
		'order'				=>	'ASC',
		'posts_per_page'	=>	get_option('posts_per_page'),
		'offset'			=>	$loaded
	);
	$custom_posts = get_posts($args_search);
	if(count($custom_posts)){
	foreach($custom_posts as $i => $post) : setup_postdata($post);
	?>
						<li><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></li>
	<?php
	endforeach;
	}
	else{
	?>
						<li>No result</li>
	<?php		
	}
	wp_reset_postdata();
	die();
}

jQuery(document).ready(function($){
//ajax load search content
			var time_out;
			$(document).on('keyup','#search-input',function(e){
				var search_input = $(this);
				clearTimeout(time_out);
				time_out = setTimeout( function() {ajax_get_search_values(search_input);}, 1000);
				e.preventDefault();
			});
			function ajax_get_search_values(search_input){
				var parent_box = search_input.closest('.entry-content');
				parent_box.find('.box-result-search').html('');
				parent_box.find('.box-result-search').append('Loadding...');
				$.ajax({
					type : 'POST',
					data : {
						'action' : 'rs_load_search_ajax',
						'search_key' : search_input.val().trim()
					},
					url : '<?php echo admin_url( "admin-ajax.php" ); ?>',
					success: function(result) {
						parent_box.find('.box-result-search').html('');
						parent_box.find('.box-result-search').append(result);
						// console.log(result);
						console.log('success');
					},
					done: function(result){
						console.log('done');
					},
					error: function(result){
						console.log('error');
						// console.log(result);
					},
					// async: false,
					dataType: 'html',
					global: false
				});
			}
			$( document ).ajaxComplete(function() {
				alert('complete ajax trigger');
			});
		});
	</script>
