<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

/**
 * @package     OneClick Chat to Order
 * @author      Walter Pinem
 * @link        https://walterpinem.me
 * @link        https://www.seniberpikir.com/oneclick-wa-order-woocommerce/
 * @copyright   Copyright (c) 2019, Walter Pinem, Seni Berpikir
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @category    Admin Page
 */

// Display error message if basic configuration is empty
function wa_order_check_input_empty(){
	$phone = get_option('wa_order_option_phone_number');
	$custom_message = get_option('wa_order_option_message');
	$button_text = get_option('wa_order_option_text_button');
	$error = __( '<p><strong>OneClick Chat to Order</strong> requires <strong> WhatsApp Number to be set!</strong> <a href="?page=wa-order&tab=button_config"><strong>Click here</strong></a> to fill it.</p>', 'oneclick-wa-order' );
	
	if ( $phone === '' || $custom_message === '' || $button_text === '' ) {
		printf( __( '<div class="error">%s</div>', 'oneclick-wa-order' ), $error );
	}
}
add_action('admin_notices', 'wa_order_check_input_empty');

// Start processing the WhatsApp button
function wa_order_add_button_plugin() {
	$showbutton = get_option(sanitize_text_field('wa_order_option_enable_single_product'));
	if ($showbutton === 'yes') {	
	global $product;
	//get and define phone number, custom message and button text
	$phone = get_option(sanitize_text_field('wa_order_option_phone_number'));
	$custom_message = get_option(sanitize_text_field('wa_order_option_message'));
	$target = get_option(sanitize_text_field('wa_order_option_target'));
	$hide_button = get_option(sanitize_text_field('wa_order_option_remove_btn'));
	$hide_button_mobile = get_option(sanitize_text_field('wa_order_option_remove_btn_mobile'));
	$gdpr_privacy_policy = get_option(sanitize_text_field('wa_order_gdpr_privacy_page'));
	$gdpr_status = get_option(sanitize_text_field('wa_order_gdpr_status_enable'));
	$gdpr_message = get_option(sanitize_text_field('wa_order_gdpr_message'));
	$hide_price = get_option(sanitize_text_field('wa_order_option_remove_price'));
	$hide_atc_button = get_option(sanitize_text_field('wa_order_option_remove_cart_btn'));
	
	//Set option hide add to cart button
	if ($hide_atc_button === 'yes') {
		?>
	<script>
		var elems = document.getElementsByName('add-to-cart');
		for (var i=0;i<elems.length;i+=1){
		  elems[i].style.display = 'none';
		}
	</script>	
		<?php
	}
		
	//Set option hide price
	if ($hide_price === 'yes') {
		?>
	<style>
			.woocommerce-Price-amount {
				display: none !important;
			}
	</style>
		<?php
	}

	// If yes, hide button on desktop & mobile
	if ($hide_button === 'yes') { ?>
	<style>
		@media screen and (min-width: 768px) {
			.wa-order-button, .gdpr_wa_button_input, .wa-order-gdprchk, button.gdpr_wa_button_input:disabled, button.gdpr_wa_button_input {
				display: none !important;
			}
		}	
	}
	</style>
		<?php
	}
		// Show both on desktop and mobile
		if ($hide_button === 'no') { ?>
		<style>
			@media screen and (min-width: 768px) {
 			.wa-order-button, .gdpr_wa_button_input, .wa-order-gdprchk, button.gdpr_wa_button_input:disabled, button.gdpr_wa_button_input {
				display: block !important;
				}
			}
		}
		</style>
			<?php
	}
		// Hide on desktop, show on mobile
		if ($hide_button_mobile === 'no') { ?>
		<style>
			@media screen and (max-width: 768px) {
			.wa-order-button, .gdpr_wa_button_input, .wa-order-gdprchk, button.gdpr_wa_button_input:disabled, button.gdpr_wa_button_input {
				display: block !important;
				}
			}
		}
		</style>
			<?php
	}

		// Show on desktop, hide on mobile
		if ($hide_button_mobile === 'yes') { ?>
		<style>
			@media screen and (max-width: 768px) {
			.wa-order-button, .gdpr_wa_button_input, .wa-order-gdprchk, button.gdpr_wa_button_input:disabled, button.gdpr_wa_button_input {
				display: none !important;
				}
			}		
		}
		</style>
			<?php
	}
	
	// Get the product info
	global $product;
	global $post;
	$product_url = get_permalink( $product->get_id() );
	$title = $product->get_name();
	$currency = get_woocommerce_currency_symbol();
	$price = wc_get_price_including_tax( $product );
	if ($button_text = get_post_meta( $post->ID, '_wa_order_button_text', true ));
	else $button_text = get_option(sanitize_text_field('wa_order_option_text_button'));

	if ($custom_message = get_post_meta( $post->ID, '_wa_order_custom_message', true ));
	else $custom_message = get_option(sanitize_text_field('wa_order_option_message'));

	if ($custom_message== '') $message_price= "Hello, I want to buy:";
	else $message_price= "$custom_message";

	if ($custom_message== '') $message_ex_price= "Hello, I want to buy:";
	else $message_ex_price= "$custom_message";
	
	// Labels
	$price_label = get_option( 'wa_order_option_price_label');
	$url_label = get_option( 'wa_order_option_url_label');
	$thanks_label = get_option( 'wa_order_option_thank_you_label');

	// URL Encoding
	$encode_custom_message_price = urlencode($message_price);
	$encode_custom_message_price_ex_price = urlencode($message_ex_price);
	$encode_title = urlencode($title);
	$encode_product_url = urlencode($product_url);
	$encode_thanks = urlencode($thanks_label);
	$encode_url_label = urlencode($url_label);
	$encode_price = urlencode($price);
	$encode_price_label = urlencode($price_label);

	// Message content with price
	$final_message_price = "$encode_custom_message_price%0D%0A%0D%0A*$encode_title*%0D%0A*$encode_price_label:*%20$currency$encode_price%0D%0A";
	// Remove product URL
	$removeproductURL = get_option(sanitize_text_field('wa_order_exclude_product_url'));
	if ($removeproductURL === 'yes') {
		$final_message_price .= "%0D%0A";
	} else {
		$final_message_price .= "*$encode_url_label:*%20$encode_product_url%0D%0A%0D%0A";
	}
	$final_message_price .= "$encode_thanks";
	// Button URL with price
	$button_url = "https://wa.me/$phone?text=$final_message_price";

	// Message content without price
	$final_message_ex_price = "$encode_custom_message_price_ex_price%0D%0A%0D%0A*$encode_title*%0D%0A";
	// Remove product URL
	$removeproductURL = get_option(sanitize_text_field('wa_order_exclude_product_url'));
	if ($removeproductURL === 'yes') {
		$final_message_ex_price .= "%0D%0A";
	} else {
		$final_message_ex_price .= "*$encode_url_label:*%20$encode_product_url%0D%0A%0D%0A";
	}
	$final_message_ex_price .= "$encode_thanks";
	// Button URL without price
	$button_url_ex_price = "https://wa.me/$phone?text=$final_message_ex_price";

	// Create button + URL
	$ex_price = get_option(sanitize_text_field('wa_order_exclude_price'));
	if ($ex_price === 'yes') {
	echo "<a id=\"sendbtn wa-order-button-click\" class=\"single_add_to_cart_button\" href=$button_url_ex_price class=\"wa-order-class\" role=\"button\" target=\"$target\"><button type=\"button\" id=\"sendbtn wa-order-button-click\" class=\"wa-order-button single_add_to_cart_button button alt\">$button_text</button></a>";
	} else {
		echo "<a id=\"sendbtn wa-order-button-click\" class=\"single_add_to_cart_button\" href=$button_url class=\"wa-order-class\" role=\"button\" target=\"$target\"><button type=\"button\" id=\"sendbtn wa-order-button-click\" class=\"wa-order-button single_add_to_cart_button button alt\">$button_text</button></a>";
	}

	// Display GDPR compliant checkbox
	if ($gdpr_status === 'yes') { ?>
	<?php global $product;
	$phone = get_option(sanitize_text_field('wa_order_option_phone_number'));
	$custom_message = get_option(sanitize_text_field('wa_order_option_message'));
	$target = get_option(sanitize_text_field('wa_order_option_target'));
	$gdpr_privacy_policy = get_option(sanitize_text_field('wa_order_gdpr_privacy_page'));
	$gdpr_status = get_option(sanitize_text_field('wa_order_gdpr_status_enable'));
	$gdpr_message = get_option(sanitize_text_field('wa_order_gdpr_message'));
	$product_url = get_permalink( $product->get_id() );
	$title = $product->get_name();
	$currency = get_woocommerce_currency_symbol();
	$price = wc_get_price_including_tax( $product );

	if ($button_text = get_post_meta( $post->ID, '_wa_order_button_text', true ));
	else $button_text = get_option(sanitize_text_field('wa_order_option_text_button'));

	if ($custom_message = get_post_meta( $post->ID, '_wa_order_custom_message', true ));
	else $custom_message = get_option(sanitize_text_field('wa_order_option_message'));

	if ($custom_message== '') $message_price= "Hello, I want to buy:";
	else $message_price= "$custom_message";

	if ($custom_message== '') $message_ex_price= "Hello, I want to buy:";
	else $message_ex_price= "$custom_message";
	
	// Labels
	$price_label = get_option( 'wa_order_option_price_label');
	$url_label = get_option( 'wa_order_option_url_label');
	$thanks_label = get_option( 'wa_order_option_thank_you_label');

	// URL Encoding
	$encode_custom_message_price = urlencode($message_price);
	$encode_custom_message_price_ex_price = urlencode($message_ex_price);
	$encode_title = urlencode($title);
	$encode_product_url = urlencode($product_url);
	$encode_thanks = urlencode($thanks_label);
	$encode_url_label = urlencode($url_label);
	$encode_price = urlencode($price);
	$encode_price_label = urlencode($price_label);

	// Message content with price
	$final_message_price = "$encode_custom_message_price%0D%0A%0D%0A*$encode_title*%0D%0A*$encode_price_label:*%20$currency$encode_price%0D%0A*$encode_url_label:*%20$encode_product_url%0D%0A%0D%0A$encode_thanks";
	$button_url = "https://wa.me/$phone?text=$final_message_price";

	// Message content without price
	$final_message_ex_price = "$encode_custom_message_price_ex_price%0D%0A%0D%0A*$encode_title*%0D%0A*$encode_url_label:*%20$encode_product_url%0D%0A%0D%0A$encode_thanks";
	$button_url_ex_price = "https://wa.me/$phone?text=$final_message_ex_price";

	// Create button + URL
	$ex_price = get_option(sanitize_text_field('wa_order_exclude_price'));

	if ($ex_price === 'yes') {
	?>
		<style>
		.wa-order-button, 
		.wa-order-button .wa-order-class {
			display: none !important;
		}	 
		</style>
	<label class="wa-button-gdpr2">
		<a id="sendbtn" href="<?= $button_url_ex_price ?>" class="gdpr_wa_button single_add_to_cart_button" role="button" target="<?= $target ?>">
			<button type="button" id="sendbtn2 wa-order-button-click" class="gdpr_wa_button_input single_add_to_cart_button button alt" disabled="disabled" onclick="WAOrder()">
				<?php _e( $button_text ) ?>
			</button>
		</a>
	</label>
		<div class="wa-order-gdprchk">
			<input type="checkbox" name="wa_order_gdpr_status_enable" class="css-checkbox wa_order_input_check" id="gdprChkbx" />
			<label for="gdprChkbx" class="label-gdpr"><?php echo do_shortcode( stripslashes (get_option( 'wa_order_gdpr_message' ))) ?></label>
        </div>
			<script type="text/javascript">
				document.getElementById('gdprChkbx').addEventListener('click', function (e) {
  				document.getElementById('sendbtn2 wa-order-button-click').disabled = !e.target.checked;
				});
			</script>
			<script>
				function WAOrder() {
					var phone = "<?php echo esc_attr($phone); ?>";
						wa_message = "<?php echo esc_attr($message_ex_price); ?>";
						button_url = "<?php echo esc_attr($button_url_ex_price); ?>";
						target = "<?php echo esc_attr($target); ?>";
				}
			</script>
	<?php } else { ?>
		<style>
		.wa-order-button, 
		.wa-order-button .wa-order-class {
			display: none !important;
		}
		</style>
	<label class="wa-button-gdpr2">
		<a id="sendbtn" href="<?= $button_url ?>" class="gdpr_wa_button single_add_to_cart_button" role="button" target="<?= $target ?>">
			<button type="button" id="sendbtn2 wa-order-button-click" class="gdpr_wa_button_input single_add_to_cart_button button alt" disabled="disabled" onclick="WAOrder()">
				<?php _e( $button_text ) ?>
			</button>
		</a>
	</label>
		<div class="wa-order-gdprchk">
			<input type="checkbox" name="wa_order_gdpr_status_enable" class="css-checkbox wa_order_input_check" id="gdprChkbx" />
			<label for="gdprChkbx" name="checkbox1_lbl" class="css-label lite-green-check"><?php echo do_shortcode( stripslashes (get_option( 'wa_order_gdpr_message' ))) ?></label>
        </div>
			<script type="text/javascript">
				document.getElementById('gdprChkbx').addEventListener('click', function (e) {
  				document.getElementById('sendbtn2 wa-order-button-click').disabled = !e.target.checked;
				});
			</script>
			<script>
				function WAOrder() {
					var phone = "<?php echo esc_attr($phone); ?>";
						wa_message = "<?php echo esc_attr($message); ?>";
						button_url = "<?php echo esc_attr($button_url); ?>";
						target = "<?php echo esc_attr($target); ?>";
				}
			</script>
		<?php
	}
}
}
}
add_action( 'woocommerce_after_add_to_cart_button', 'wa_order_add_button_plugin', 5 );

// Single product custom metabox
// Hide button checkbox
add_action('wp_head', 'wa_order_execute_metabox_value');
function wa_order_execute_metabox_value(){
	global $post;
	// If is single product page and have the "engrave text option" enabled we display the field
	if ( is_product() && get_post_meta( $post->ID, '_hide_wa_button', true ) == 'yes' ) {
    ?>
        <style>
        	#sendbtn, #wa-order-button-click, .wa-order-button {
        		display: none!important;
        	}
        </style>
    <?php
}
}

// GDPR Page Selection
if ( ! function_exists( 'wa_order_options_dropdown' ) ) {
	function wa_order_options_dropdown( $args ) {
		global $wpdb;
		$query 		= $wpdb->get_results( "SELECT post_name, post_title FROM {$wpdb->posts} WHERE post_type = 'page'", ARRAY_A );
		$name 		= ( $args['name'] ) ? 'name="' . $args['name'] . '" ' : '';
		$multiple = ( isset( $args['multiple'] ) ) ? 'multiple' : '';
		echo '<select '.$name .' id="" class="wa_order-admin-select2 regular-text" '. $multiple .' >';		
			foreach ( $query as $key => $value ) {
				if ( $args['selected'] ) {
					if ( $multiple ) {
						if ( in_array( $value['post_name'], $args['selected']) ) {
							$selected = 'selected="selected"';
						} else {
							$selected = '';
						}
					} else {
						if ( $value['post_name'] == $args['selected'] ) {
							$selected = 'selected="selected"';
						} else {
							$selected = '';
						}
					}
				}
				echo '<option value="'.$value['post_name'].'" '. $selected .'>'.$value['post_title'].'</option>';		
			}
		echo '</select>';
	}
}

// Display Floating Button
function display_floating_button() {
	global $wp;
	$floating = get_option(sanitize_text_field('wa_order_floating_button'));
	if ( $floating === 'yes' ) {
	$floating_position = get_option(sanitize_text_field('wa_order_floating_button_position'));
	$custom_message = get_option(sanitize_text_field('wa_order_floating_message'));
	$floating_target = get_option(sanitize_text_field('wa_order_floating_target'));
	$button_text = get_option(sanitize_text_field('wa_order_option_text_button'));
	$target = get_option(sanitize_text_field('wa_order_option_target'));
	$phone = get_option('wa_order_option_phone_number');
	$tooltip_enable = get_option(sanitize_text_field('wa_order_floating_tooltip_enable'));
	$tooltip = get_option(sanitize_text_field('wa_order_floating_tooltip'));
	$floating_mobile = get_option(sanitize_text_field('wa_order_floating_hide_mobile'));

	// Include source page URL
	$include_source = get_option(sanitize_text_field('wa_order_floating_source_url'));
	$src_label = get_option(sanitize_text_field('wa_order_floating_source_url_label'));
	if ($src_label== '') $source_label= "From URL:";
		else $source_label= "$src_label";
	if ( $include_source === 'yes') {
		$source_url = home_url(add_query_arg(array(), $wp->request));
		$floating_message = urlencode(" ".$custom_message."\r\n\r\n*".$source_label."* ".$source_url." ");
	} else {
		$floating_message = $custom_message;
	}

	$floating_link = "https://wa.me/$phone?text=$floating_message";

	    if ( $floating_position === 'left' ) { ?>
			<a id="sendbtn" class="floating_button" href="<?php echo $floating_link ?>" role="button" target="<?php echo $floating_target ?>">
			</a>

				<style>
					.floating_button {
						left: 20px;
					}
					@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
					    .floating_button {
					        left: 10px!important;
					    }
					}
				</style>

	 	<?php  } elseif ( $floating_position === 'right' ) { ?>
		<a id="sendbtn" class="floating_button" href="<?php echo $floating_link ?>" role="button" target="<?php echo $floating_target ?>">
		</a>
			<style>
				.floating_button {
					right: 20px;
				}
				@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
				    .floating_button {
				        right: 10px!important;
				    }
				}
			</style>			
     <?php
    }
}
}
add_filter('wp_head', 'display_floating_button');

// Display Floating Button with Tooltip
function display_floating_tooltip() {
	global $wp;
	$floating = get_option(sanitize_text_field('wa_order_floating_button'));
	$floating_position = get_option(sanitize_text_field('wa_order_floating_button_position'));
	$custom_message = get_option(sanitize_text_field('wa_order_floating_message'));
	$floating_target = get_option(sanitize_text_field('wa_order_floating_target'));
	$button_text = get_option(sanitize_text_field('wa_order_option_text_button'));
	$target = get_option(sanitize_text_field('wa_order_option_target'));
	$phone = get_option('wa_order_option_phone_number');
	$tooltip_enable = get_option(sanitize_text_field('wa_order_floating_tooltip_enable'));
	$tooltip = get_option(sanitize_text_field('wa_order_floating_tooltip'));
	$floating_mobile = get_option(sanitize_text_field('wa_order_floating_hide_mobile'));

	// Include source page URL
	$include_source = get_option(sanitize_text_field('wa_order_floating_source_url'));
	$src_label = get_option(sanitize_text_field('wa_order_floating_source_url_label'));
	if ($src_label== '') $source_label= "From URL:";
		else $source_label= "$src_label";
	if ( $include_source === 'yes') {
		$source_url = home_url(add_query_arg(array(), $wp->request));
		$floating_message = urlencode(" ".$custom_message."\r\n\r\n*".$source_label."* ".$source_url." ");
	} else {
		$floating_message = $custom_message;
	}

	$floating_link = "https://wa.me/$phone?text=$floating_message";

		if ( $floating === 'yes' && $floating_position === 'left' && $tooltip_enable === 'yes' ) { ?>
			<a id="sendbtn" href="<?php echo $floating_link ?>" role="button" target="<?php echo $floating_target ?>" class="floating_button">
			    <div class="label-container">
			    	<div class="label-text"><?php echo $tooltip ?></div>
			    </div>
			</a>
			<style>
			.floating_button {
				left: 20px;
			}
				.label-container {
  					left: 85px;
				}		
			</style>
		<?php  } elseif ( $floating === 'yes' && $floating_position === 'right' && $tooltip_enable === 'yes' ) { ?>
			<a id="sendbtn" href="<?php echo $floating_link ?>" role="button" target="<?php echo $floating_target ?>" class="floating_button">
			    <div class="label-container">
			    	<div class="label-text"><?php echo $tooltip ?></div>
			    </div>
			</a>
			<style>
				.floating_button {
					right: 20px;
				}
				.label-container {
  					right: 85px;
				}				
			</style>	
     <?php
    }
}
add_filter('wp_head', 'display_floating_tooltip');

// Hide Button on Mobile
function hide_floating_button() {
	$floating_mobile = get_option(sanitize_text_field('wa_order_floating_hide_mobile'));
	if ( $floating_mobile === 'yes' ) { ?>
			<style>
			@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
				.floating_button {
					display: none !important;
				}
			}		
			</style>
     <?php
    }     
}
add_filter('wp_head', 'hide_floating_button');

// Shortcode Function
function wa_order_shortcode_button( $atts, $content = null ) {
		$phone = get_option('wa_order_option_phone_number');
        $target_blank = get_option('wa_order_shortcode_target');
        $custom_message = get_option('wa_order_shortcode_message');

    if ( $button_text = get_option(sanitize_text_field('wa_order_shortcode_text_button')) )
    $out = "<a id=\"sendbtn\" class=\"shortcode_wa_button\" href=\"https://wa.me/" .$phone. "?text=" . $custom_message . "\" target=".$target_blank."><span>" .do_shortcode($content). "$button_text</span></a>";
    else
    	$out = "<a id=\"sendbtn\" class=\"shortcode_wa_button_nt\" href=\"https://wa.me/" .$phone. "?text=" . $custom_message . "\"" .$target_blank."><span>" .do_shortcode($content). "</span></a>";
    return $out;
}
add_shortcode('wa-order', 'wa_order_shortcode_button');

// Hide Product Quantity
function wa_order_remove_quantity( $return, $product ) {
	if ( get_option(sanitize_text_field('wa_order_option_remove_quantity')) )
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wa_order_remove_quantity', 10, 2 );

// Convert phone number link into WhatsApp chat link in Order Details page
function wa_order_convert_phone_link() {
	$convert_phone_no = get_option(sanitize_text_field('wa_order_option_convert_phone_order_details'));
	if ( $convert_phone_no === 'yes' ) { ?>
		<script text/javascript>
			function wa_order_chage_href(){
			var number=document.querySelector(".address p:nth-of-type(3) a").text;
			if (number !=null){
			var changephonelinktowhatsapp="https://wa.me/"+number;
			document.querySelector(".address p:nth-of-type(3) a").setAttribute("href", changephonelinktowhatsapp);
			}
			}window.onload=wa_order_chage_href;
		</script>
     <?php
    }     
}
if ( is_admin()) { 
	add_action('admin_head','wa_order_convert_phone_link');
}

// Add WhatsApp button on Cart page just below the Proceed to Checkout button
function wa_order_add_button_to_cart_page( $variations ) { 
		 $add_button_to_cart = get_option(sanitize_text_field('wa_order_option_add_button_to_cart'));
		 $hide_checkout_button = get_option(sanitize_text_field('wa_order_option_cart_hide_checkout'));
	if ( $add_button_to_cart === 'yes') {

			$phone = get_option(sanitize_text_field('wa_order_option_phone_number'));
			$items= WC()->cart->get_cart();

			$custom_message = get_option('wa_order_option_cart_custom_message');
			$cart_button_text = get_option('wa_order_option_cart_button_text');

			if ($custom_message== '') $message= "Hello, I want to buy:";
			else $message = "$custom_message\r\n";

			$currency= get_woocommerce_currency();

			foreach($items as $item ) { 
			    $_product =  wc_get_product( $item['product_id']);
			    $product_name= $_product->get_name();
			    $qty= $item['quantity'];            
			    $price= $item['line_subtotal'];
			    $var= $item['variation'];
			    $format_price = number_format($price, 2, '.', ',');
			    $product_url  = get_post_permalink($item['product_id']);
			    $total_amount = floatval( preg_replace( '#[^\d.]#', '', WC()->cart->cart_contents_total ) );
			    $format_total = number_format($total_amount, 2, '.', ',');

			    $quantity_label = get_option( 'wa_order_option_quantity_label');
			    $price_label 	= get_option( 'wa_order_option_price_label');
			    $url_label 		= get_option( 'wa_order_option_url_label');
			    $thanks_label 	= get_option( 'wa_order_option_thank_you_label');
			    $total_label 	= get_option( 'wa_order_option_total_amount_label');

			    $target = get_option(sanitize_text_field('wa_order_option_cart_open_new_tab'));

			    // Remove product URL
			    $removeproductURL = get_option(sanitize_text_field('wa_order_option_cart_hide_product_url'));

			    // Include product variation
			    $include_variation = get_option(sanitize_text_field('wa_order_option_cart_enable_variations'));			    

			    if ( $item['variation_id'] > 0 && $_product->is_type( 'variable' ) && $include_variation === 'yes' ) {
			    $variations = $_product->get_available_variations();

			    foreach ($_product->get_attributes() as $taxonomy => $attribute_obj ) {
			        // Get the attribute label
			        $attribute_label_name = wc_attribute_label($taxonomy);
			    }

			    foreach( $_product->get_variation_attributes() as $taxonomy => $terms_slug ){
			        // To get the attribute label (in WooCommerce 3+)
			        $taxonomy_label = wc_attribute_label( $taxonomy, $_product );

			        // Setting some data in an array
			        $variations_attributes_and_values[$taxonomy] = array('label' => $taxonomy_label);

			        foreach($terms_slug as $term) {
			        	if( isset( $taxonomy->term_id ) ){
			            // Getting the term object from the slug
			            $term_obj  = get_term_by('slug', $term, $taxonomy, true);
			            $term_id   = $term_obj->term_id; // The ID  <==  <==  <==  <==  <==  <==  HERE
			            $term_name = $term_obj->name; // The Name
			            $term_slug = $term_obj->slug; // The Slug
			            $variations[$term_slug] = get_post_meta( $variations[ 'variation_id' ], $term_slug, true );
			            // $term_description = $term_obj->description; // The Description

			            // Setting the terms ID and values in the array
			            $variations_attributes_and_values[$taxonomy]['terms'][$term_id] = array(
			                'name'        => $term_name,
			                'slug'        => $term_slug
			            );
			        	}
			        }
			    }

			        // Retrieve data if a product has variation
			        foreach( $item['variation'] as $variations ){
			        	$variation_label = ucfirst($attribute_label_name);
			            $product_variation = ucfirst($variations);
			            $variation_output = "\r\n*".$variation_label.":* ".$product_variation."";
			        }
			    }
			    else {
			    	// Return empty if not
			    	$variation_output = '';
			    }

			    if ($removeproductURL === 'yes') {
			    	$message.= "\r\n*".$product_name."*".$variation_output."\r\n*".$quantity_label.":* ".$qty."\r\n*".$price_label.":* ".$currency." ".$format_price." \r\n";
			    } else {
			    	$message.= "\r\n*".$product_name."*".$variation_output."*".$quantity_label.":* ".$qty."\r\n*".$price_label.":* ".$currency." ".$format_price." \r\n*".$url_label.":* ".$product_url."\r\n";
			    }
			}
			
			$message.="\r\n*".$total_label.":* ".$currency." ".$format_total."\r\n\r\n".$thanks_label."";
			$button_url = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.urlencode($message);
	?>
	<div class="wc-proceed-to-checkout">
		    <a id="sendbtn" href="<?php echo $button_url ?>" target="<?php echo $target ?>" class="wa-order-checkout checkout-button button">
		    	<?php echo $cart_button_text ?>
		    </a>
	</div>	    
    <?php
	}
}
add_action( 'woocommerce_after_cart_totals', 'wa_order_add_button_to_cart_page' );

// Remove proceed to checkout button on Cart page
function disable_checkout_button_no_shipping() { 
	$hide_checkout_button = get_option(sanitize_text_field('wa_order_option_cart_hide_checkout'));
	if ($hide_checkout_button === 'yes') {
        remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
    }
}
add_action( 'woocommerce_proceed_to_checkout', 'disable_checkout_button_no_shipping', 1 );

// Custom Thank You title
function wa_order_thank_you_override( $title, $id ) {
	$override_thankyou_page = get_option(sanitize_text_field('wa_order_option_enable_button_thank_you'));
	if ( $override_thankyou_page === 'yes') {
	    global $wp;
	    $phone = get_option(sanitize_text_field('wa_order_option_phone_number'));
	    $custom_title = get_option('wa_order_option_custom_thank_you_title');
	    $custom_subtitle = get_option('wa_order_option_custom_thank_you_subtitle');
	    $button_text = get_option('wa_order_option_custom_thank_you_button_text');
	    $custom_message = get_option('wa_order_option_custom_thank_you_custom_message');
	    $thanks_label = get_option( 'wa_order_option_thank_you_label');

	    if ($custom_message== '') $message= "Hello, here's my order details:\r\n";
	    	else $message= "$custom_message\r\n";
	    if ($custom_title== '') $thetitle= "Thanks and You're Awesome";
	    	else $thetitle= "$custom_title";
	    if ($custom_subtitle== '') $subtitle= "For faster response, send your order details by clicking below button.";
	    	else $subtitle= "$custom_subtitle";
	    if ($button_text== '') $button= "Send Order Details";
	    	else $button= "$button_text";

	    $order_id = (int) $wp->query_vars['order-received'];
		if ( $order_id ) {
			$order = new WC_Order( $order_id );
		}
        if ( isset ( $order ) ) {
		    $first_name = $order->get_billing_first_name();
			$last_name = $order->get_billing_last_name();
			$thetitle = $thetitle. ', ' .$first_name. '!';
			$subtitle = $subtitle;
			$customer = $first_name . ' ' . $last_name;
			$customer_email = $order->get_billing_email();
			$adress_1 = $order->get_billing_address_1();
			$adress_2 = $order->get_billing_address_2();
			$postcode = $order->get_billing_postcode();
			$state = $order->get_billing_state();
			$country = $order->get_billing_country();
			$customer_phone = $order->get_billing_phone();
			$full_state = WC()->countries->get_states( $country )[$state];
			$full_country = WC()->countries->get_countries( $country )[$country];
			$address = "\r\n".$adress_1."\r\n".$adress_2."\r\n".$postcode."\r\n".$full_state."\r\n".$full_country."\r\n".$customer_phone."\r\n".$customer_email."";
			$total_label = get_option( 'wa_order_option_total_amount_label');
			$payment_label = get_option( 'wa_order_option_payment_method_label');
			$price = $order->get_total();
			$format_price = number_format($price, 2, '.', ',');
			$currency= get_woocommerce_currency();
			$total_price = "\r\n*".$total_label.":*\r\n".$currency." ".$format_price."\r\n";
			$payment_method = $order->get_payment_method_title();
			$payment = "*".$payment_label.":*\r\n".$payment_method."\r\n";
			$date = $order->get_date_created()->format ('F j, Y - g:i A');
        }
        $order = new WC_Order( $order_id );
        foreach ( $order->get_items() as $item_id => $item ) {
           	$name = $item->get_name();
           	$quantity = $item->get_quantity();
           	$message.=" ".$quantity."x - *".$name."*\r\n";
        }

        // Coupon item
        $order_items = $order->get_items('coupon');

        // Let's loop
        foreach( $order_items as $item_id => $item ){

            // Retrieving the coupon ID reference
            $coupon_post_obj = get_page_by_title( $item->get_name(), OBJECT, 'shop_coupon' );
            $coupon_id = $coupon_post_obj->ID;

            // Retrive an instance of WC_Coupon object
            $coupon = new WC_Coupon($coupon_id);

            // Conditional discount type + its symbol
            if( $coupon->is_type( 'fixed_cart' ) ) {
            	$pre_symbol = $currency;
            } elseif ( $coupon->is_type( 'percent' ) ) {
            	$pre_symbol = "%";
            } else {
            	$pre_symbol = "";
            }

            // Check if any discount code used and enabled from admin plugin setting
            $include_coupon = get_option(sanitize_text_field('wa_order_option_custom_thank_you_inclue_coupon'));
            if (  $order->get_total_discount() > 0 && $include_coupon === 'yes' ) { 
            	$coupons  = $order->get_coupon_codes();
            	$coupons  = count($coupons) > 0 ? implode(',', $coupons) : '';
            	$discount = $order->get_total_discount();
            	$coupon_label = get_option(sanitize_text_field('wa_order_option_custom_thank_you_coupon_label'));
            	if ($coupon_label== '') $voucher_label= "Voucher Code:";
            	else $voucher_label= "$coupon_label";
            	if( $coupon->is_type( 'fixed_cart' ) ) {
            		$discount_fixed = $coupon->get_amount();
            		$discount_format = "".$pre_symbol." ".$discount_fixed."";
            	} elseif ( $coupon->is_type( 'percent' ) ) {
            		$discount_percent = $coupon->get_amount();
            		$discount_format = "".$discount_percent."".$pre_symbol." (-".$currency." ".$discount.")";
            	} else {
            		$discount_format = "";
            	}
                $coupon_code = "*".$voucher_label."*\r\n".ucfirst($coupons).": -".$discount_format."";
                $message.="\r\n".$coupon_code."";
            } else {  // return empty if none
            	$message.="";
            }
        }
        
        	// Final output of the message
        	$message.="\r\n".$total_price."\r\n".$payment."\r\n*".$customer."* ".$address."\r\n\r\n".$thanks_label."\r\n\r\n(".$date.")";
        	$button_url = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.urlencode($message);
        	$target = get_option(sanitize_text_field('wa_order_option_custom_thank_you_open_new_tab'));

            $final_output = '<div class="thankyoucustom_wrapper">
            <h1 class="thankyoutitle">'.$thetitle.'</h1>
            <p class="subtitle">'.$subtitle.'</p>
            <a id="sendbtn" href="'.$button_url.'" target="'.$target.'" class="wa-order-thankyou">
            	'.$button.'
            </a>
            </div>';
    return $final_output;
	}
}
add_filter( 'woocommerce_thankyou_order_received_text', 'wa_order_thank_you_override', 10, 2 );

// Add WhatsApp button under each product on Shop page
function wa_order_display_button_shop_page() {
	$enable_button = get_option(sanitize_text_field('wa_order_option_enable_button_shop_loop'));
	if ( $enable_button === 'yes' ) {
	global $product;

	$phone = get_option(sanitize_text_field('wa_order_option_phone_number'));
	$button_text = get_option(sanitize_text_field('wa_order_option_button_text_shop_loop'));
	$custom_message = get_option(sanitize_text_field('wa_order_option_custom_message_shop_loop'));
	if ($button_text== '') $button_txt= "Buy via WhatsApp";
		else $button_txt= "$button_text";
	if ($custom_message== '') $custom_msg= "Hello, I want to purchase:";
		else $custom_msg= "$custom_message";

	$product_url = $product->get_permalink();
	$text  = __( ''.$button_txt.'', 'oneclick-wa-order' );
	$product_title = $product->get_name();
	$link_title = sprintf( __( 'Complete order on WhatsApp to buy %s', 'oneclick-wa-order' ), $product_title );
	$class = sprintf( 'button add_to_cart_button wa-shop-button product_type_%s', $product->get_type() );
	$currency = get_woocommerce_currency_symbol();
	$price = wc_get_price_including_tax( $product );
	
	// Labels
	$price_label = get_option( 'wa_order_option_price_label');
	$url_label = get_option( 'wa_order_option_url_label');
	$thanks_label = get_option( 'wa_order_option_thank_you_label');

	// URL Encoding
	$encode_custom_message = urlencode($custom_msg);
	$encode_title = urlencode($product_title);
	$encode_product_url = urlencode($product_url);
	$encode_thanks = urlencode($thanks_label);
	$encode_url_label = urlencode($url_label);
	$encode_price = urlencode($price);
	$encode_price_label = urlencode($price_label);

	    $final_message ="$encode_custom_message%0D%0A%0D%0A*$encode_title*";

	    	    // Exclude Price
	    	    $excludeprice = get_option(sanitize_text_field('wa_order_option_shop_loop_exclude_price'));
	    	    if ($excludeprice === 'yes') {
	    	    	$final_message .= "";
	    	    } else {
	    	    	$final_message .= "%0A*$encode_price_label:*%20$currency$encode_price";
	    	    }

	    	    // Remove product URL
	    	    $removeproductURL = get_option(sanitize_text_field('wa_order_option_shop_loop_hide_product_url'));
	    	    if ($removeproductURL === 'yes') {
	    	    	$final_message .= "";
	    	    } else {
	    	    	$final_message .= "%0A*$encode_url_label:*%20$encode_product_url";
	    	    }

	    	    $final_message.= "%0D%0A%0D%0A$encode_thanks";

	$button_url = "https://wa.me/$phone?text=$final_message";
	$target = get_option(sanitize_text_field('wa_order_option_shop_loop_open_new_tab'));

	$format = '<a id="sendbtn" href="%1$s" target="'.$target.'" title="%2$s" class="$class">%4$s</a>';
		?>
		    <a id="sendbtn" href="<?php echo $button_url ?>" title="<?php echo $link_title ?>" target="<?php echo $target ?>" class="<?php echo $class ?>">
		    	<?php echo $button_text ?>
		    </a>
	    <?php
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'wa_order_display_button_shop_page', 10, 3 );

// Option to remove Add to Cart on Shop page product loop
if ( get_option(sanitize_text_field('wa_order_option_hide_atc_shop_loop')) === 'yes' ) {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
// Alternative way to force hide the Add to Cart button on shop loop page
add_action('wp_head', 'wa_order_alternative_way_hide_shop_loop');
function wa_order_alternative_way_hide_shop_loop(){
if ( get_option(sanitize_text_field('wa_order_option_hide_atc_shop_loop')) === 'yes' ) {
		?>
		<style>
			.add_to_cart_button, .ajax_add_to_cart {
				display: none!important;
			}
			.wa-shop-button {
				display: inline-block!important;
			}
		</style>
	    <?php
	}
}

// Hide WhatsApp button on selected pages
add_action('wp_head', 'wa_order_display_options');
function wa_order_display_options(){
// Hide button on shop loop - desktop
if ( get_option(sanitize_text_field('wa_order_display_option_shop_loop_hide_desktop')) === 'yes' ) {
		?>
		<style>
			@media only screen and (min-width: 768px) {
			.wa-shop-button{display:none!important;}
			}
		</style>
	    <?php
	}
// Hide button on shop loop - mobile
if ( get_option(sanitize_text_field('wa_order_display_option_shop_loop_hide_mobile')) === 'yes' ) {
		?>
		<style>
			@media only screen and (max-width: 767px) {
			.wa-shop-button{display:none!important;}
			}
		</style>
	    <?php
	}
// Hide button on cart page - desktop
if ( get_option(sanitize_text_field('wa_order_display_option_cart_hide_desktop')) === 'yes' ) {
		?>
		<style>
			@media only screen and (min-width: 767px) {
			.wc-proceed-to-checkout .wa-order-checkout{display:none!important;}
			}
		</style>
	    <?php
	}
// Hide button on cart page - mobile
if ( get_option(sanitize_text_field('wa_order_display_option_cart_hide_mobile')) === 'yes' ) {
		?>
		<style>
			@media only screen and (max-width: 767px) {
			.wc-proceed-to-checkout .wa-order-checkout{display:none!important;}
			}
		</style>
	    <?php
	}
// Hide button on thank you page - desktop
if ( get_option(sanitize_text_field('wa_order_display_option_checkout_hide_desktop')) === 'yes' ) {
		?>
		<style>
			@media only screen and (min-width: 767px) {
			a.wa-order-thankyou{display:none!important;}
			}
		</style>
	    <?php
	}
// Hide button on thank you page - mobile
if ( get_option(sanitize_text_field('wa_order_display_option_checkout_hide_mobile')) === 'yes' ) {
		?>
		<style>
			@media only screen and (max-width: 767px) {
			a.wa-order-thankyou{display:none!important;}
			}
		</style>
	    <?php
	}
}