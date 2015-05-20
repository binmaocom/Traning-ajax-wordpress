<?php
add_action( 'wp_footer', 'add_to_cart_action_javascript' );
function add_to_cart_action_javascript() {?>
	<script>
	( function( $ ) {
		$(document).on('click','.button_add_car',function(event){
			current_click = this;
			$(current_click).parents('.summary').find('.ajax_loading').show();
			href = $(this).attr('href');
			href += $('#number_quantity').val();
			$.ajax({
				type: "GET",
				url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
			})
			.done(function(){
				$(current_click).parents('.summary').find('.ajax_loading').hide();
				$(current_click).parents('.summary').find('.view_cart').show();
			});
			return false;
		});
	} )( jQuery );
	</script>
<?php }
add_action('wp_loaded', 'add_to_car_customer');
function add_to_car_customer(){
	global $woocommerce;
	if(is_ajax() && isset($_GET['product_id']) && isset($_GET['quantity']))
	{
		$woocommerce->cart->add_to_cart( $_GET['product_id'], $_GET['quantity'] );
		add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
		echo 'ok!';
	}
	exit;
}
?>
<!-- button add to cart in frontend -->
<a class="button_add_car" href="<?php echo home_url() ?>/?product_id=<?php echo $post->ID ?>&quantity=">Add to Cart</a>
