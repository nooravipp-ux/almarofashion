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

// Donate button
function wa_order_donate_button_shortcode( $atts , $content = null ) {
  return '<center>
<div class="donate-container">
<p>To keep this plugin free, I spent cups of coffee building it. If you love and find it really useful for your business, you can always</p>
<a href="https://www.paypal.me/WalterPinem" target="_blank">
<button class="donatebutton">
  ☕ Buy Me a Coffee
  </button>
</a>
</div>
</center>';
}
add_shortcode( 'donate', 'wa_order_donate_button_shortcode' );


// Build plugin admin setting page
function wa_order_add_admin_page() {
    // Generate Chat to Order Admin Page
    add_menu_page( 'OneClick Chat to Order Options', 'Chat to Order', 'manage_options', 'wa-order', 'wa_order_create_admin_page', plugin_dir_url( dirname( __FILE__ ) ) . '/assets/images/wa-icon.svg', 98 );

    // Begin building
    add_action( 'admin_init', 'wa_order_register_settings' );
        }
    add_action( 'admin_menu', 'wa_order_add_admin_page' );

function wa_order_register_settings() {

    // Register the settings
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_phone_number' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_enable_single_product' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_message' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_text_button' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_target' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_exclude_price' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_exclude_product_url' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_quantity_label' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_price_label' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_url_label' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_total_amount_label' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_payment_method_label' );
    register_setting( 'wa-order-settings-group-button-config', 'wa_order_option_thank_you_label' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_option_remove_btn' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_option_remove_btn_mobile' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_option_remove_price' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_option_remove_cart_btn' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_option_remove_quantity' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_display_option_shop_loop_hide_desktop' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_display_option_shop_loop_hide_mobile' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_display_option_cart_hide_desktop' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_display_option_cart_hide_mobile' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_display_option_checkout_hide_desktop' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_display_option_checkout_hide_mobile' );
    register_setting( 'wa-order-settings-group-display-options', 'wa_order_option_convert_phone_order_details' );
    register_setting( 'wa-order-settings-group-gdpr', 'wa_order_gdpr_status_enable' );
    register_setting( 'wa-order-settings-group-gdpr', 'wa_order_gdpr_message' );
    register_setting( 'wa-order-settings-group-gdpr', 'wa_order_gdpr_privacy_page' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_button' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_button_position' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_message' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_target' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_tooltip_enable' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_tooltip' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_hide_mobile' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_source_url' );
    register_setting( 'wa-order-settings-group-floating', 'wa_order_floating_source_url_label' );
    register_setting( 'wa-order-settings-group-shortcode', 'wa_order_shortcode_message' );
    register_setting( 'wa-order-settings-group-shortcode', 'wa_order_shortcode_text_button' );
    register_setting( 'wa-order-settings-group-shortcode', 'wa_order_shortcode_target' );
    register_setting( 'wa-order-settings-group-cart-options', 'wa_order_option_add_button_to_cart' );
    register_setting( 'wa-order-settings-group-cart-options', 'wa_order_option_cart_custom_message' );
    register_setting( 'wa-order-settings-group-cart-options', 'wa_order_option_cart_button_text' );
    register_setting( 'wa-order-settings-group-cart-options', 'wa_order_option_cart_hide_checkout' );
    register_setting( 'wa-order-settings-group-cart-options', 'wa_order_option_cart_hide_product_url' );
    register_setting( 'wa-order-settings-group-cart-options', 'wa_order_option_cart_open_new_tab' );
    register_setting( 'wa-order-settings-group-cart-options', 'wa_order_option_cart_enable_variations' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_enable_button_thank_you' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_custom_thank_you_title' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_custom_thank_you_subtitle' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_custom_thank_you_button_text' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_custom_thank_you_custom_message' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_custom_thank_you_open_new_tab' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_custom_thank_you_inclue_coupon' );
    register_setting( 'wa-order-settings-group-order-completion', 'wa_order_option_custom_thank_you_coupon_label' );
    register_setting( 'wa-order-settings-group-shop-loop', 'wa_order_option_enable_button_shop_loop' );
    register_setting( 'wa-order-settings-group-shop-loop', 'wa_order_option_hide_atc_shop_loop' );
    register_setting( 'wa-order-settings-group-shop-loop', 'wa_order_option_button_text_shop_loop' );
    register_setting( 'wa-order-settings-group-shop-loop', 'wa_order_option_custom_message_shop_loop' );
    register_setting( 'wa-order-settings-group-shop-loop', 'wa_order_option_shop_loop_hide_product_url' );
    register_setting( 'wa-order-settings-group-shop-loop', 'wa_order_option_shop_loop_exclude_price' );
    register_setting( 'wa-order-settings-group-shop-loop', 'wa_order_option_shop_loop_open_new_tab' );
}

    // Delete option upon deactivation
function wa_order_deactivation() {
    delete_option( 'wa_order_option_phone_number' );
    delete_option( 'wa_order_option_enable_single_product' );
    delete_option( 'wa_order_option_message' );
    delete_option( 'wa_order_option_text_button' );
    delete_option( 'wa_order_option_target' );
    delete_option( 'wa_order_exclude_product_url' );
    delete_option( 'wa_order_option_remove_btn' );
    delete_option( 'wa_order_option_remove_btn_mobile' );
    delete_option( 'wa_order_option_remove_price' );
    delete_option( 'wa_order_option_remove_cart_btn' );
    delete_option( 'wa_order_option_remove_quantity' );
    delete_option( 'wa_order_display_option_shop_loop_hide_desktop' );
    delete_option( 'wa_order_display_option_shop_loop_hide_mobile' );
    delete_option( 'wa_order_display_option_cart_hide_desktop' );
    delete_option( 'wa_order_display_option_cart_hide_mobile' );
    delete_option( 'wa_order_display_option_checkout_hide_desktop' );
    delete_option( 'wa_order_display_option_checkout_hide_mobile' );
    delete_option( 'wa_order_option_convert_phone_order_details' );
    delete_option( 'wa_order_gdpr_status_enable' );
    delete_option( 'wa_order_gdpr_message' );
    delete_option( 'wa_order_gdpr_privacy_page' );
    delete_option( 'wa_order_floating_button' );
    delete_option( 'wa_order_floating_button_position' );
    delete_option( 'wa_order_floating_message' );
    delete_option( 'wa_order_floating_target' );
    delete_option( 'wa_order_floating_tooltip_enable' );
    delete_option( 'wa_order_floating_tooltip' );
    delete_option( 'wa_order_floating_hide_mobile' );
    delete_option( 'wa_order_floating_source_url' );
    delete_option( 'wa_order_floating_source_url_label' );
    delete_option( 'wa_order_shortcode_message' );
    delete_option( 'wa_order_shortcode_text_button' );
    delete_option( 'wa_order_shortcode_target' );
    delete_option( 'wa_order_option_add_button_to_cart' );
    delete_option( 'wa_order_option_cart_custom_message' );
    delete_option( 'wa_order_option_cart_button_text' );
    delete_option( 'wa_order_option_cart_hide_checkout' );
    delete_option( 'wa_order_option_cart_hide_product_url' );
    delete_option( 'wa_order_option_cart_open_new_tab' );
    delete_option( 'wa_order_option_cart_enable_variations' );
    delete_option( 'wa_order_option_quantity_label' );
    delete_option( 'wa_order_option_price_label' );
    delete_option( 'wa_order_option_url_label' );
    delete_option( 'wa_order_option_total_amount_label' );
    delete_option( 'wa_order_option_payment_method_label' );
    delete_option( 'wa_order_option_thank_you_label' ); 
    delete_option( 'wa_order_option_enable_button_thank_you' );
    delete_option( 'wa_order_option_custom_thank_you_title' ); 
    delete_option( 'wa_order_option_custom_thank_you_subtitle' );
    delete_option( 'wa_order_option_custom_thank_you_button_text' );
    delete_option( 'wa_order_option_custom_thank_you_custom_message' );
    delete_option( 'wa_order_option_custom_thank_you_open_new_tab' );
    delete_option( 'wa_order_option_custom_thank_you_inclue_coupon' );
    delete_option( 'wa_order_option_custom_thank_you_coupon_label' );
    delete_option( 'wa_order_option_enable_button_shop_loop' ); 
    delete_option( 'wa_order_option_hide_atc_shop_loop' );
    delete_option( 'wa_order_option_button_text_shop_loop' );
    delete_option( 'wa_order_option_custom_message_shop_loop' );
    delete_option( 'wa_order_option_shop_loop_hide_product_url' );
    delete_option( 'wa_order_option_shop_loop_exclude_price' );
    delete_option( 'wa_order_option_shop_loop_open_new_tab' );
}
register_deactivation_hook( __FILE__, 'wa_order_deactivation' );

    // Begin Building the Admin Option
function wa_order_create_admin_page(){
     if( $active_tab = isset( $_GET[ 'tab' ] ) ) {
            $active_tab = esc_attr($_GET[ 'tab' ]);
        } else if( $active_tab == 'button_config' ) {
            $active_tab = 'button_config';
        } else if( $active_tab == 'floating_button' ) {
            $active_tab = 'floating_button';
        } else if( $active_tab == 'display_option' ) {
            $active_tab = 'display_option';
        } else if( $active_tab == 'shop_page' ) {
            $active_tab = 'shop_page';    
        } else if( $active_tab == 'cart_button' ) {
            $active_tab = 'cart_button'; 
        } else if( $active_tab == 'thanks_page' ) {
            $active_tab = 'thanks_page';        
        } else if( $active_tab == 'gdpr_notice' ) {
            $active_tab = 'gdpr_notice';
        } else if( $active_tab == 'generate_shortcode' ) {
            $active_tab = 'generate_shortcode';
        } else if( $active_tab == 'tutorial_support' ) {
            $active_tab = 'tutorial_support';                   
        } else {
            $active_tab = 'welcome';
        } // end if/else 
?>
    <div class="wrap OCWAORDER_pluginpage_title">
        <h1><?php _e( 'OneClick Chat to Order', 'oneclick-wa-order' ); ?></h1>
        <hr>

<h2 class="nav-tab-wrapper">
    <a href="?page=wa-order&tab=welcome" class="nav-tab <?php echo esc_attr( $active_tab == 'welcome' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Welcome', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=button_config" class="nav-tab <?php echo esc_attr( $active_tab == 'button_config' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Basic', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=floating_button" class="nav-tab <?php echo esc_attr( $active_tab == 'floating_button' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Floating', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=display_option" class="nav-tab <?php echo esc_attr( $active_tab == 'display_option' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Display Options', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=shop_page" class="nav-tab <?php echo esc_attr( $active_tab == 'shop_page' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Shop', 'oneclick-wa-order' ); ?></a>
        <a href="?page=wa-order&tab=cart_button" class="nav-tab <?php echo esc_attr( $active_tab == 'cart_button' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Cart', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=thanks_page" class="nav-tab <?php echo esc_attr( $active_tab == 'thanks_page' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Checkout', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=gdpr_notice" class="nav-tab <?php echo esc_attr( $active_tab == 'gdpr_notice' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'GDPR', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=generate_shortcode" class="nav-tab <?php echo esc_attr( $active_tab == 'generate_shortcode' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Shortcode', 'oneclick-wa-order' ); ?></a>
    <a href="?page=wa-order&tab=tutorial_support" class="nav-tab <?php echo esc_attr( $active_tab == 'tutorial_support' ) ? 'nav-tab-active' : ''; ?>"><?php _e( 'Support', 'oneclick-wa-order' ); ?></a>
</h2>

            <?php if ( $active_tab == 'generate_shortcode' ) { ?>
                <!-- Custom Shortcode -->
                <form method="post" action="options.php">
                <?php settings_errors(); ?>
                <?php settings_fields( 'wa-order-settings-group-shortcode' ); ?> 
                <?php do_settings_sections( 'wa-order-settings-group-shortcode' ); ?>
                <h2 class="section_wa_order"><?php _e( 'Generate Shortcode', 'oneclick-wa-order' ); ?></h2>
                <p>
                    <?php _e('Use shortcode to display chat to order button anywhere on your site.', 'oneclick-wa-order'); ?>
                        <br />
                </p>
                <table class="form-table">
                    <tbody>
                        <tr class="wa_order_btn_text">
                            <th scope="row">
                                <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Text on Button', 'oneclick-wa-order' ); ?></b></label>
                            </th>
                            <td>
                                <input type="text" name="wa_order_shortcode_text_button" class="wa_order_input" value="<?php echo get_option('wa_order_shortcode_text_button'); ?>" placeholder="<?php _e( 'e.g. Order via WhatsApp', 'oneclick-wa-order' ); ?>">
                            </td>
                        </tr>
                        <tr class="wa_order_message">
                            <th scope="row">
                                <label class="wa_order_message_label" for="message_wbw"><b><?php _e( 'Custom Message', 'oneclick-wa-order' ); ?></b></label>
                            </th>
                            <td>
                                <textarea name="wa_order_shortcode_message" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. Hello, I need to know more about', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_shortcode_message'); ?></textarea>
                                <p class="description">
                                    <?php _e( 'Enter custom message, e.g. <code>Hello, I need to know more about</code>', 'oneclick-wa-order' ); ?></p></td>
                        </tr>
                        <tr class="wa_order_target">
                            <th scope="row">
                                <label class="wa_order_copy_label" for="wa_order_copy"><b><?php _e( 'Copy Shortcode', 'oneclick-wa-order' ); ?></b></label>
                            </th>
                            <td>
                                <input style="letter-spacing: 1px;" class="wa_order_shortcode_input" onClick="this.setSelectionRange(0, this.value.length)" value="[wa-order]" />
                                    <br>
                            </td>
                        </tr>

                        <tr class="wa_order_target">
                            <th scope="row">
                                <label class="wa_order_target_label" for="wa_order_target"><b><?php _e( 'Open in New Tab?', 'oneclick-wa-order' ); ?></b></label>
                            </th>
                            <td>
                                <input type="checkbox" name="wa_order_shortcode_target" class="wa_order_input_check" value="_blank" <?php checked( get_option( 'wa_order_shortcode_target'), '_blank' );?>>
                                <?php _e( 'Yes, Open in New Tab', 'oneclick-wa-order' ); ?>
                                    <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                    </tbody>
                </table>
        <?php submit_button(); ?>
        </form>
 <?php } elseif( $active_tab == 'button_config' ) { ?>
    <!-- Basic Configurations -->
    <form method="post" action="options.php">
    <?php settings_errors(); ?>
    <?php settings_fields( 'wa-order-settings-group-button-config' ); ?> 
    <?php do_settings_sections( 'wa-order-settings-group-button-config' ); ?>

    <h2 class="section_wa_order"><?php _e( 'Basic Configuration', 'oneclick-wa-order' ); ?></h2>
    <p>
        <?php _e('WhatsApp number is <strong style="color:red;">required</strong>. Please enter your WhatsApp number first to receive every sent message.', 'oneclick-wa-order'); ?>
            <br />
    </p>
    <table class="form-table">
        <tbody>
            <tr class="wa_order_number">
                <th scope="row">
                    <label class="wa_order_number_label" for="phone_number"><b><?php _e( 'WhatsApp Number', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="number" name="wa_order_option_phone_number" class="wa_order_input" value="<?php echo get_option('wa_order_option_phone_number'); ?>" placeholder="<?php _e( 'e.g. 6281234567890', 'oneclick-wa-order' ); ?>">
                    <p class="description">
                        <?php _e( 'Enter number including country code, e.g. <code><b>62</b>81234567890</code>', 'oneclick-wa-order' ); ?></p>
                </td>
            </tr>
                </tbody>
            </table>
            <hr>
            <table class="form-table">
                <tbody>  
    <h2 class="section_wa_order"><?php _e( 'Single Product Page', 'oneclick-wa-order' ); ?></h2>
    <p>
        <?php _e('These configurations will be only effective on single product page.', 'oneclick-wa-order'); ?>
            <br />
    </p>

    <tr class="wa_order_target">
        <th scope="row">
            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Display Button?', 'oneclick-wa-order' ); ?></b></label>
        </th>
        <td>
            <input type="checkbox" name="wa_order_option_enable_single_product" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_enable_single_product'), 'yes' );?>>
            <?php _e( 'This will display WhatsApp button on single product page', 'oneclick-wa-order' ); ?>
                <br>
        </td>
    </tr> 

            <tr class="wa_order_message">
                <th scope="row">
                    <label class="wa_order_message_label" for="message_owo"><b><?php _e( 'Custom Message', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <textarea name="wa_order_option_message" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. Hello, I want to buy:', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_option_message'); ?></textarea>
                    <p class="description">
                        <?php _e( 'Fill this form with custom message, e.g. <code>Hello, I want to buy:</code>', 'oneclick-wa-order' ); ?>
                    </p>
                </td>
            </tr>

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Text on Button', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_option_text_button" class="wa_order_input" value="<?php echo get_option('wa_order_option_text_button'); ?>" placeholder="<?php _e( 'e.g. Order via WhatsApp', 'oneclick-wa-order' ); ?>">
                </td>
            </tr>

            <tr class="wa_order_target">
                <th scope="row">
                    <label class="wa_order_target_label" for="wa_order_target"><b><?php _e( 'Open in New Tab?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_option_target" class="wa_order_input_check" value="_blank" <?php checked( get_option( 'wa_order_option_target'), '_blank' );?>>
                    <?php _e( 'Yes, Open in New Tab', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
                </tbody>
            </table>            
    <table class="form-table">
        <tbody>            
            <h2 class="section_wa_order"><?php _e( 'Exclusion', 'oneclick-wa-order' ); ?></h2>
            <p><?php _e( 'The following option is only for the output message you\'ll receieve on WhatsApp. To hide some elements, please go to <a href="admin.php?page=wa-order&tab=display_option"><strong>Display Options</strong></a> tab.', 'oneclick-wa-order' ); ?></p>
            <tr class="wa_order_price">
                <th scope="row">
                    <label class="wa_order_price_label" for="wa_order_price"><b><?php _e( 'Exclude Price?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_exclude_price" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_exclude_price'), 'yes' );?>>
                    <?php _e( 'Yes, exclude price in WhatsApp message.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>

            <tr class="wa_order_price">
                <th scope="row">
                    <label class="wa_order_price_label" for="wa_order_price"><b><?php _e( 'Remove Product URL?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_exclude_product_url" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_exclude_product_url'), 'yes' );?>>
                    <?php _e( 'This will remove product URL from WhatsApp message sent from single product page.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>

        </tbody>
    </table>
    <hr>
    <table class="form-table">
        <tbody>            
            <h2 class="section_wa_order"><?php _e( 'Text Translations', 'oneclick-wa-order' ); ?></h2>
            <p><?php _e( 'You can translate the following strings which will be included in the sent message. By default, the labels are used in the message. You can translate or change them below accordingly.', 'oneclick-wa-order' ); ?></p>

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Quantity', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_option_quantity_label" class="wa_order_input" value="<?php echo get_option('wa_order_option_quantity_label', 'Quantity'); ?>" placeholder="<?php _e( 'e.g. Quantity', 'oneclick-wa-order' ); ?>">
                </td>
            </tr>

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Price', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_option_price_label" class="wa_order_input" value="<?php echo get_option('wa_order_option_price_label', 'Price'); ?>" placeholder="<?php _e( 'e.g. Price', 'oneclick-wa-order' ); ?>">
                </td>
            </tr>


            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'URL', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_option_url_label" class="wa_order_input" value="<?php echo get_option('wa_order_option_url_label', 'URL'); ?>" placeholder="<?php _e( 'e.g. Link', 'oneclick-wa-order' ); ?>">
                </td>
            </tr>

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Total Amount', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_option_total_amount_label" class="wa_order_input" value="<?php echo get_option('wa_order_option_total_amount_label', 'Total Price'); ?>" placeholder="<?php _e( 'e.g. Total Amount', 'oneclick-wa-order' ); ?>">
                </td>
            </tr>      

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Payment Method', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_option_payment_method_label" class="wa_order_input" value="<?php echo get_option('wa_order_option_payment_method_label', 'Payment Method'); ?>" placeholder="<?php _e( 'e.g. Payment via', 'oneclick-wa-order' ); ?>">
                </td>
            </tr>   

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Thank you!', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_option_thank_you_label" class="wa_order_input" value="<?php echo get_option('wa_order_option_thank_you_label', 'Thank you!'); ?>" placeholder="<?php _e( 'e.g. Thank you in advance!', 'oneclick-wa-order' ); ?>">
                </td>
            </tr>

        </tbody>
    </table>
    <hr>
        <?php submit_button(); ?>
        </form>
<?php } elseif( $active_tab == 'floating_button' ) { ?>
    <form method="post" action="options.php">
    <?php settings_errors(); ?>
    <?php settings_fields( 'wa-order-settings-group-floating' ); ?> 
    <?php do_settings_sections( 'wa-order-settings-group-floating' ); ?>
    <!-- Floating Button -->
    <h2 class="section_wa_order"><?php _e( 'Floating Button', 'oneclick-wa-order' ); ?></h2>
    <p>
        <?php _e('Enable / disable a floating WhatsApp button on your entire pages. You can configure the floating button below.', 'oneclick-wa-order'); ?>
            <br />
    </p>
    <table class="form-table">
        <tbody>
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Display Floating Button?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_floating_button" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_floating_button'), 'yes' );?>>
                    <?php _e( 'This will show floating WhatsApp Button', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
            <th scope="row">
                <label>
                    <?php _e('Floating Button Position', 'oneclick-wa-order') ?>
                </label>
            </th>
            <td>
                <input type="radio" name="wa_order_floating_button_position" value="left" <?php checked( 'left', get_option( 'wa_order_floating_button_position'), true); ?>>
                <?php _e( 'Left', 'oneclick-wa-order' ); ?>
                    <input type="radio" name="wa_order_floating_button_position" value="right" <?php checked( 'right', get_option( 'wa_order_floating_button_position'), true); ?>>
                    <?php _e( 'Right', 'oneclick-wa-order' ); ?>
            </td>
            </tr>
            <tr class="wa_order_message">
                <th scope="row">
                    <label class="wa_order_message_label" for="message_wbw"><b><?php _e( 'Custom Message', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <textarea name="wa_order_floating_message" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. Hello, I need to know more about', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_floating_message'); ?></textarea>
                    <p class="description">
                        <?php _e( 'Enter custom message, e.g. <code>Hello, I need to know more about</code>', 'oneclick-wa-order' ); ?></p>
                    </td>
            </tr>

            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Display Tooltip?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_floating_tooltip_enable" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_floating_tooltip_enable'), 'yes' );?>>
                    <?php _e( 'This will show a custom tooltip', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="floating_tooltip"><b><?php _e( 'Button Tooltip', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_floating_tooltip" class="wa_order_input" value="<?php echo get_option('wa_order_floating_tooltip'); ?>" placeholder="<?php _e( 'e.g. Let\'s Chat', 'oneclick-wa-order' ); ?>">
                    <p class="description">
                        <?php _e( 'Use this to greet your customers. The tooltip container size is very <br>limited so make sure to make it as short as possible.', 'oneclick-wa-order' ); ?></p>
                </td>
            </tr>                         

            <tr class="wa_order_target">
                <th scope="row">
                    <label class="wa_order_target_label" for="wa_order_target"><b><?php _e( 'Hide Floating Button on Mobile?', 'oneclick-wa-order' ); ?></b></label>
                </th>                                
                <td>
                    <input type="checkbox" name="wa_order_floating_hide_mobile" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_floating_hide_mobile'), 'yes' );?>>
                    <?php _e( 'This will hide Floating Button on Mobile.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>

            <tr class="wa_order_target">
                <th scope="row">
                    <label class="wa_order_target_label" for="wa_order_target"><b><?php _e( 'Show Source Page URL?', 'oneclick-wa-order' ); ?></b></label>
                </th>                                
                <td>
                    <input type="checkbox" name="wa_order_floating_source_url" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_floating_source_url'), 'yes' );?>>
                    <?php _e( 'This will include the URL of the page where the button is clicked in the message.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>

            <tr class="wa_order_btn_text">
                <th scope="row">
                    <label class="wa_order_btn_txt_label" for="wa_order_floating_source_url_label"><b><?php _e( 'Source Page URL Label', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="text" name="wa_order_floating_source_url_label" class="wa_order_input" value="<?php echo get_option('wa_order_floating_source_url_label'); ?>" placeholder="<?php _e( 'From URL:', 'oneclick-wa-order' ); ?>">
                    <p class="description">
                        <?php _e( 'Add a label for the source page URL. <code>e.g. From URL:</code>', 'oneclick-wa-order' ); ?></p>
                </td>
            </tr>     

            <tr class="wa_order_target">
                <th scope="row">
                    <label class="wa_order_target_label" for="wa_order_target"><b><?php _e( 'Open in New Tab?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_floating_target" class="wa_order_input_check" value="_blank" <?php checked( get_option( 'wa_order_floating_target'), '_blank' );?>>
                    <?php _e( 'Yes, Open in New Tab', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
        <?php submit_button(); ?>
        </form>
<?php } elseif( $active_tab == 'display_option' ) { ?>
    <form method="post" action="options.php">
    <?php settings_errors(); ?>
    <?php settings_fields( 'wa-order-settings-group-display-options' ); ?> 
    <?php do_settings_sections( 'wa-order-settings-group-display-options' ); ?>
    <h2 class="section_wa_order"><?php _e( 'Display Options', 'oneclick-wa-order' ); ?></h2>
        <p>
        <?php _e('Here, you can configure some options for hiding elements to convert customers phone number into clickable WhatsApp link.', 'oneclick-wa-order'); ?>
            <br />
    </p>
    <hr>
    <!-- Single Product Page Display Options -->
    <table class="form-table">
        <tbody>
            <h3 class="section_wa_order"><?php _e( 'Single Product Page', 'oneclick-wa-order' ); ?></h3>
            <p><?php _e( 'The following options will be only effective on single product page.', 'oneclick-wa-order' ); ?></p>
            <!-- Hide Button on Desktop -->
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Hide Button on Desktop?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_option_remove_btn" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_remove_btn'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Desktop.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
            <!-- Hide Button on Mobile -->
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Hide Button on Mobile?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_option_remove_btn_mobile" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_remove_btn_mobile'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Mobile.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>

			<tr class="wa_order_option_remove_quantity">
			    <th scope="row">
			        <label class="wa_order_option_remove_quantity" for="wa_order_option_remove_quantity"><b><?php _e( 'Hide Product Quantity Option?', 'oneclick-wa-order' ); ?></b></label>
			    </th>
			    <td>
			        <input type="checkbox" name="wa_order_option_remove_quantity" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_remove_quantity'), 'yes' );?>>
			        <?php _e( 'This will hide product quantity option field.', 'oneclick-wa-order' ); ?>
			            <br>
			    </td>
			</tr>

            <tr class="wa_order_remove_price">
                <th scope="row">
                    <label class="wa_order_price_label" for="wa_order_remove_price"><b><?php _e( 'Hide Price in Product Page?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_option_remove_price" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_remove_price'), 'yes' );?>>
                    <?php _e( 'This will hide price in Product page.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
            
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_remove_add_btn"><b><?php _e( 'Hide Add to Cart button?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_option_remove_cart_btn" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_remove_cart_btn'), 'yes' );?>>
                    <?php _e( 'This will hide Add to Cart button.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- END of Single Product Page Display Options -->
    <hr>
    <!-- Shop Loop Display Options -->
        <table class="form-table">
        <tbody>            
            <h2 class="section_wa_order"><?php _e( 'Shop Loop Page', 'oneclick-wa-order' ); ?></h2>
            <p><?php _e( 'The following options will be only effective on shop loop page.', 'oneclick-wa-order' ); ?></p>
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_remove_add_btn"><b><?php _e( 'Hide Button on Desktop?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_display_option_shop_loop_hide_desktop" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_display_option_shop_loop_hide_desktop'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Desktop.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_remove_add_btn"><b><?php _e( 'Hide Button on Mobile?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_display_option_shop_loop_hide_mobile" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_display_option_shop_loop_hide_mobile'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Mobile.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- END of Shop Loop Display Options -->
    <hr>

        <!-- Cart Display Options -->
        <table class="form-table">
        <tbody>            
            <h2 class="section_wa_order"><?php _e( 'Cart Page', 'oneclick-wa-order' ); ?></h2>
            <p><?php _e( 'The following options will be only effective on cart page.', 'oneclick-wa-order' ); ?></p>
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_remove_add_btn"><b><?php _e( 'Hide Button on Desktop?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_display_option_cart_hide_desktop" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_display_option_cart_hide_desktop'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Desktop.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_remove_add_btn"><b><?php _e( 'Hide Button on Mobile?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_display_option_cart_hide_mobile" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_display_option_cart_hide_mobile'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Mobile.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- END of Cart Display Options -->
    <hr>

        <!-- Checkout / Thank You Page Display Options -->
        <table class="form-table">
        <tbody>            
            <h2 class="section_wa_order"><?php _e( 'Thank You Page', 'oneclick-wa-order' ); ?></h2>
            <p><?php _e( 'The following options will be only effective on cart page.', 'oneclick-wa-order' ); ?></p>
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_remove_add_btn"><b><?php _e( 'Hide Button on Desktop?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_display_option_checkout_hide_desktop" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_display_option_checkout_hide_desktop'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Desktop.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_remove_add_btn"><b><?php _e( 'Hide Button on Mobile?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_display_option_checkout_hide_mobile" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_display_option_checkout_hide_mobile'), 'yes' );?>>
                    <?php _e( 'This will hide WhatsApp Button on Mobile.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- END of Checkout / Thank You Page Display Options -->
    <hr>
    <!-- Miscellaneous Display Options -->
    <table class="form-table">
        <tbody>            
            <h2 class="section_wa_order"><?php _e( 'Miscellaneous', 'oneclick-wa-order' ); ?></h2>
            <p><?php _e( 'An additional option you might need.', 'oneclick-wa-order' ); ?></p>

            <tr class="wa_order_remove_add_btn">
                <th scope="row">
                    <label class="wa_order_remove_add_label" for="wa_order_convert_phone"><b><?php _e( 'Convert Phone Number into WhatsApp in Order Details?', 'oneclick-wa-order' ); ?></b></label>
                </th>
                <td>
                    <input type="checkbox" name="wa_order_option_convert_phone_order_details" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_convert_phone_order_details'), 'yes' );?>>
                    <?php _e( 'This will convert phone number link into WhatsApp chat link.', 'oneclick-wa-order' ); ?>
                        <br>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- END of Miscellaneous Display Options -->
    <hr>
        <?php submit_button(); ?>
    </form>
        <?php } elseif ( $active_tab == 'shop_page' ) { ?>
            <!-- Custom Shortcode -->
            <form method="post" action="options.php">
            <?php settings_errors(); ?>
            <?php settings_fields( 'wa-order-settings-group-shop-loop' ); ?> 
            <?php do_settings_sections( 'wa-order-settings-group-shop-loop' ); ?>
            <h2 class="section_wa_order"><?php _e( 'WhatsApp Button on Shop Page', 'oneclick-wa-order' ); ?></h2>
            <p>
                <?php _e('Add custom WhatsApp button on <strong>Shop</strong> page or product loop page right under / besides of the <strong>Add to Cart</strong> button.', 'oneclick-wa-order'); ?>
                    <br />
            </p>
            <table class="form-table">
                <tbody>
                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Display button on Shop page?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_enable_button_shop_loop" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_enable_button_shop_loop'), 'yes' );?>>
                            <?php _e( 'This will display WhatsApp button on Shop page', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr> 

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Hide Add to Cart button?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_hide_atc_shop_loop" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_hide_atc_shop_loop'), 'yes' );?>>
                            <?php _e( 'This will only display WhatsApp button and hide the <code>Add to Cart</code> button', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>                    

                    <tr class="wa_order_btn_text">
                        <th scope="row">
                            <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Text on Button', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="text" name="wa_order_option_button_text_shop_loop" class="wa_order_input" value="<?php echo get_option('wa_order_option_button_text_shop_loop'); ?>" placeholder="<?php _e( 'e.g. Buy via WhatsApp', 'oneclick-wa-order' ); ?>">
                        </td>
                    </tr>
                    <tr class="wa_order_message">
                        <th scope="row">
                            <label class="wa_order_message_label" for="message_wbw"><b><?php _e( 'Custom Message', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <textarea name="wa_order_option_custom_message_shop_loop" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. Hello, I want to purchase:', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_option_custom_message_shop_loop'); ?></textarea>
                            <p class="description">
                                <?php _e( 'Enter custom message, e.g. <code>Hello, I want to purchase:</code>', 'oneclick-wa-order' ); ?></p></td>
                    </tr>

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Exclude Price?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_shop_loop_exclude_price" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_shop_loop_exclude_price'), 'yes' );?>>
                            <?php _e( 'This will remove product price from WhatsApp message sent from Shop loop page.', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Remove Product URL?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_shop_loop_hide_product_url" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_shop_loop_hide_product_url'), 'yes' );?>>
                            <?php _e( 'This will remove product URL from WhatsApp message sent from Shop loop page.', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Open in New Tab?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_shop_loop_open_new_tab" value="_blank" class="wa_order_input_check" <?php checked( get_option( 'wa_order_option_shop_loop_open_new_tab'), '_blank' );?>>
                            <?php _e( 'Yes, Open in New Tab', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr> 

                </tbody>
            </table>
            <hr>
                </tbody>
            </table>
    <?php submit_button(); ?>
    </form>
        <?php } elseif ( $active_tab == 'cart_button' ) { ?>
            <!-- Custom Shortcode -->
            <form method="post" action="options.php">
            <?php settings_errors(); ?>
            <?php settings_fields( 'wa-order-settings-group-cart-options' ); ?> 
            <?php do_settings_sections( 'wa-order-settings-group-cart-options' ); ?>
            <h2 class="section_wa_order"><?php _e( 'WhatsApp Button on Cart Page', 'oneclick-wa-order' ); ?></h2>
            <p>
                <?php _e('Add custom WhatsApp button on <strong>Cart</strong> page right under the <strong>Proceed to Checkout</strong> button.', 'oneclick-wa-order'); ?>
                    <br />
            </p>
            <table class="form-table">
                <tbody>
                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Display button on Cart page?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_add_button_to_cart" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_add_button_to_cart'), 'yes' );?>>
                            <?php _e( 'This will display WhatsApp button on Cart page', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr> 

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Hide Proceed to Checkout button?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_cart_hide_checkout" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_cart_hide_checkout'), 'yes' );?>>
                            <?php _e( 'This will only display WhatsApp button and hide the <code>Proceed to Checkout</code> button', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>                    

                    <tr class="wa_order_btn_text">
                        <th scope="row">
                            <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Text on Button', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="text" name="wa_order_option_cart_button_text" class="wa_order_input" value="<?php echo get_option('wa_order_option_cart_button_text'); ?>" placeholder="<?php _e( 'e.g. Complete Order via WhatsApp', 'oneclick-wa-order' ); ?>">
                        </td>
                    </tr>
                    <tr class="wa_order_message">
                        <th scope="row">
                            <label class="wa_order_message_label" for="message_wbw"><b><?php _e( 'Custom Message', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <textarea name="wa_order_option_cart_custom_message" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. Hello, I want to purchase the item(s) below:', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_option_cart_custom_message'); ?></textarea>
                            <p class="description">
                                <?php _e( 'Enter custom message, e.g. <code>Hello, I want to purchase the item(s) below:</code>', 'oneclick-wa-order' ); ?></p></td>
                    </tr>

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Remove Product URL?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_cart_hide_product_url" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_cart_hide_product_url'), 'yes' );?>>
                            <?php _e( 'This will remove product URL from WhatsApp message sent from Cart page.', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Include Product Variation?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_cart_enable_variations" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_cart_enable_variations'), 'yes' );?>>
                            <?php _e( 'This will include the product variation in the message. Note: Works only for one variation of each product.', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr> 

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Open in New Tab?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_cart_open_new_tab" class="wa_order_input_check" value="_blank" <?php checked( get_option( 'wa_order_option_cart_open_new_tab'), '_blank' );?>>
                            <?php _e( 'Yes, Open in New Tab', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr> 

                </tbody>
            </table>
            <hr>
                </tbody>
            </table>
    <?php submit_button(); ?>
    </form>
        <?php } elseif ( $active_tab == 'thanks_page' ) { ?>
            <!-- Custom Shortcode -->
            <form method="post" action="options.php">
            <?php settings_errors(); ?>
            <?php settings_fields( 'wa-order-settings-group-order-completion' ); ?> 
            <?php do_settings_sections( 'wa-order-settings-group-order-completion' ); ?>


            <h2 class="section_wa_order"><?php _e( 'Thank You Page Customization', 'oneclick-wa-order' ); ?></h2>
            <p>
                <?php _e('Add a WhatsApp button on <strong>Thank You</strong> / <strong>Order Received</strong>. If enabled, it will add a new section under the <strong>Order Received</strong> or <strong>Thank You</strong> title and override default text by using below data, including adding a WhatsApp button to send order details. <br /><strong>Tip:</strong> You can use this to make it quick for your customers to send their own order receipt to you via WhatsApp.', 'oneclick-wa-order'); ?>
                    <br />
            </p>
            <table class="form-table">
                <tbody>
                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Enable Setting?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_enable_button_thank_you" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_enable_button_thank_you'), 'yes' );?>>
                            <?php _e( 'This will override default appearance and add a WhatsApp button.', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>               
                    <tr class="wa_order_btn_text">
                        <th scope="row">
                            <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Text on Button', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="text" name="wa_order_option_custom_thank_you_button_text" class="wa_order_input" value="<?php echo get_option('wa_order_option_custom_thank_you_button_text'); ?>" placeholder="<?php _e( 'e.g. Send Order Details', 'oneclick-wa-order' ); ?>">
                            <p class="description">
                                <?php _e( 'Enter the text on WhatsApp button.<code>e.g. Send Order Details</code>', 'oneclick-wa-order' ); ?>
                            </p>
                        </td>
                    </tr>
                    <tr class="wa_order_message">
                        <th scope="row">
                            <label class="wa_order_message_label" for="message_wbw"><b><?php _e( 'Custom Message', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <textarea name="wa_order_option_custom_thank_you_custom_message" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. Hello, here\'s my order details:', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_option_custom_thank_you_custom_message'); ?></textarea>
                            <p class="description">
                                <?php _e( 'Enter custom message to send along with order details. e.g. <br><code>Hello, here\'s my order details:</code>', 'oneclick-wa-order' ); ?></p></td>
                    </tr>
                    <tr class="wa_order_btn_text">
                        <th scope="row">
                            <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Custom Title', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="text" name="wa_order_option_custom_thank_you_title" class="wa_order_input" value="<?php echo get_option('wa_order_option_custom_thank_you_title'); ?>" placeholder="<?php _e( 'e.g. Thanks and You\'re  Awesome', 'oneclick-wa-order' ); ?>">
                            <p class="description">
                                <?php _e( 'You can personalize the title by changing it here. This will be shown like this:<br/> <code>[your custom title], [customer\'s first name]</code>.<br/>e.g. Thanks and You\'re  Awesome, Igor!', 'oneclick-wa-order' ); ?>
                            </p>
                        </td>
                    </tr>
                    <tr class="wa_order_message">
                        <th scope="row">
                            <label class="wa_order_message_label" for="message_wbw"><b><?php _e( 'Custom Subtitle', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <textarea name="wa_order_option_custom_thank_you_subtitle" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. For faster response, send your order details by clicking below button.', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_option_custom_thank_you_subtitle'); ?></textarea>
                            <p class="description">
                                <?php _e( 'Enter custom subtitle. e.g. <br><code>For faster response, send your order details by clicking below button.</code>', 'oneclick-wa-order' ); ?></p></td>
                    </tr>

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Include Coupon Discount?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_custom_thank_you_inclue_coupon" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_option_custom_thank_you_inclue_coupon'), 'yes' );?>>
                            <?php _e( 'This will include coupon code and its deduction amount, including a label (the label must be set below if it\'s enabled).', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>

                    <tr class="wa_order_btn_text">
                        <th scope="row">
                            <label class="wa_order_btn_txt_label" for="text_button"><b><?php _e( 'Coupon Label', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="text" name="wa_order_option_custom_thank_you_coupon_label" class="wa_order_input" value="<?php echo get_option('wa_order_option_custom_thank_you_coupon_label'); ?>" placeholder="<?php _e( 'e.g. Voucher Code', 'oneclick-wa-order' ); ?>">
                            <p class="description">
                                <?php _e( 'Enter a label. e.g. <code>Voucher Code</code>', 'oneclick-wa-order' ); ?>
                            </p>
                        </td>
                    </tr>

                    <tr class="wa_order_target">
                        <th scope="row">
                            <label class="wa_order_remove_btn_label" for="wa_order_remove_wa_order_btn"><b><?php _e( 'Open in New Tab?', 'oneclick-wa-order' ); ?></b></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wa_order_option_custom_thank_you_open_new_tab" class="wa_order_input_check" value="_blank" <?php checked( get_option( 'wa_order_option_custom_thank_you_open_new_tab'), '_blank' );?>>
                            <?php _e( 'Yes, Open in New Tab', 'oneclick-wa-order' ); ?>
                                <br>
                        </td>
                    </tr>

            </tbody>
        </table> 
    <hr>    
        <?php submit_button(); ?>
    </form>       
<?php } elseif( $active_tab == 'gdpr_notice' ) { ?>
    <form method="post" action="options.php">
    <?php settings_errors(); ?>
    <?php settings_fields( 'wa-order-settings-group-gdpr' ); ?> 
    <?php do_settings_sections( 'wa-order-settings-group-gdpr' ); ?>
        <!-- GDPR Notice -->
        <h2 class="section_wa_order"><?php _e( 'GDPR Notice', 'oneclick-wa-order' ); ?></h2>
        <p>
            <?php _e('You can enable or disable the GDPR notice to make your site more GDPR compliant. <br>The GDPR notice you configure below will be displayed right under the WhatsApp Order button. <br>
            Please note that this option will only show the GDPR notice on single product page.', 'oneclick-wa-order'); ?>
                <br />
        </p>
        <table class="form-table">
            <tbody>

                <tr>
                    <th scope="row">
                        <label>
                            <?php _e('Enable GDPR Notice', 'oneclick-wa-order') ?>
                        </label>
                    </th>
                    <td>
                        <input type="checkbox" name="wa_order_gdpr_status_enable" class="wa_order_input_check" value="yes" <?php checked( get_option( 'wa_order_gdpr_status_enable'), 'yes' ); ?>>
                        <?php _e( 'Check to Enable GDPR Notice.', 'oneclick-wa-order' ) ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label>
                            <?php _e('GDPR Message', 'oneclick-wa-order') ?>
                        </label>
                    </th>
                    <td>
                        <textarea name="wa_order_gdpr_message" class="wa_order_input_areatext" rows="5" placeholder="<?php _e( 'e.g. I have read the [gdpr_link]', 'oneclick-wa-order' ); ?>"><?php echo get_option('wa_order_gdpr_message'); ?></textarea>
                        <p class="description">
                            <?php printf( __('Use %s to display Privacy Policy page link.', 'oneclick-wa-order') , '<code>[gdpr_link]</code>' ) ?></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label>
                            <?php _e('Privacy Policy Page', 'oneclick-wa-order') ?>
                        </label>
                    </th>
                    <td>
                        <?php wa_order_options_dropdown( 
                            array(
                                'name'      => 'wa_order_gdpr_privacy_page',
                                'selected'  => ( get_option('wa_order_gdpr_privacy_page')), 
                                ) 
                            ) 
                        ?>
                    </td>
                </tr>
            </tbody>
        </table> 
    <hr>    
        <?php submit_button(); ?>
    </form>
 <?php } elseif( $active_tab == 'tutorial_support' ) { ?>
    <!-- Begin creating plugin admin page --> 
    <div class="wrap">
            <div class="feature-section one-col wrap about-wrap">
     
        <div class="about-text">
            <h4><?php printf( __( "<strong>OneClick Chat to Order</strong> is Waiting for Your Feedback", 'oneclick-wa-order' )); ?></h>
        </div>
                <div class="indo-about-description">
                    <?php printf( __( "<strong>OneClick Chat to Order</strong> is my second plugin and it's open source. I acknowledge that there are still a lot to fix, here and there, that's why I really need your feedback. <br>Let's get in touch and show some love by <a href=\"https://wordpress.org/support/plugin/oneclick-whatsapp-order/reviews/?rate=5#new-post\" target=\"_blank\"><strong>leaving a review</strong></a>.", 'oneclick-wa-order' )); ?>
                        </div>                    

<table class="tg" style="table-layout: fixed; width: 269px">
    <colgroup>
        <col style="width: 105px">
            <col style="width: 164px">
    </colgroup>
    <tr>
        <th class="tg-kiyi">
        	<?php _e( 'Author:', 'oneclick-wa-order' ); ?></th>
        <th class="tg-fymr">
        	<?php _e( 'Walter Pinem', 'oneclick-wa-order' ); ?></th>
    </tr>
    <tr>
        <td class="tg-kiyi">
        	<?php _e( 'Website:', 'oneclick-wa-order' ); ?></td>
        <td class="tg-fymr"><a href="https://walterpinem.me/" target="_blank">
        	<?php _e( 'walterpinem.me', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-kiyi" rowspan="2"></td>
        <td class="tg-fymr"><a href="https://www.seniberpikir.com/" target="_blank">
        	<?php _e( 'www.seniberpikir.com', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-fymr"><a href="https://kerjalepas.com/" target="_blank">
        	<?php _e( 'www.kerjalepas.com', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-kiyi">
        	<?php _e( 'Email:', 'oneclick-wa-order' ); ?></td>
        <td class="tg-fymr"><a href="mailto:hello@walterpinem.me" target="_blank">
        	<?php _e( 'hello@walterpinem.me', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-kiyi"><?php _e( 'More:', 'oneclick-wa-order' ); ?></td>
        <td class="tg-fymr"><a href="https://youtu.be/LuURM5vZyB8" target="_blank">
            <?php _e( 'Complete Tutorial', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-kiyi" rowspan="3"></td>
        <td class="tg-fymr"><a href="https://walterpinem.me/projects/contact/" target="_blank">
            <?php _e( 'Support & Feature Request', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-fymr"><a href="https://walterpinem.me/portfolio/" target="_blank">
        	<?php _e( 'Portfolio', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-fymr"><a href="https://www.linkedin.com/in/walterpinem/" target="_blank">
        	<?php _e( 'Linkedin', 'oneclick-wa-order' ); ?></a></td>
    </tr>
    <tr>
        <td class="tg-kiyi" rowspan="3"></td>
        <td class="tg-fymr"><a href="https://www.paypal.me/WalterPinem" target="_blank">
        	<?php _e( 'Donate', 'oneclick-wa-order' ); ?></a></td>
    </tr>
</table>
<br>

<?php echo do_shortcode("[donate]"); ?>

<center><p><?php printf( __( "Created with ❤ and ☕ in Central Jakarta, Indonesia by <a href=\"https://walterpinem.me\" target=\"_blank\"><strong>Walter Pinem</strong></a>", 'oneclick-wa-order' )); ?></p></center>             
    </div>
    </div>
  <?php } elseif ( $active_tab == 'welcome' ) { ?>
    <!-- Begin creating plugin admin page --> 
    <div class="wrap">
            <div class="feature-section one-col wrap about-wrap">
    <!-- <div class="wp-badge welcome__logo"></div> --> 
        <div class="indo-title-text"><h2><?php printf( __( 'Thank you for using <br>OneClick Chat to Order', 'oneclick-wa-order' )); ?></h2>
    <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/oneclick-chat-to-order.png'; ?>" />
        </div>
     
        <div class="feature-section one-col about-text">
            <h3><?php printf( __( "Make It Easy for Customers to Reach You!", 'oneclick-wa-order' )); ?></h3>
        </div>
                <div class="feature-section one-col indo-about-description">
        <?php printf( __( "<strong>OneClick Chat to Order</strong> will make it easier for your customers to order your products directly through WhatsApp with a single click on a single product page or a floating button. Make them well-engaged and fasten the purchase process.", 'oneclick-wa-order' )); ?>                
            </div>
    <div class="clear"></div>
    <hr />
    <div class="feature-section one-col">
        <h3 style="text-align: center;"><?php _e( 'Watch the Complete Overview and Tutorial', 'oneclick-wa-order' ); ?></h3>
        <div class="headline-feature feature-video">
            <div class='embed-container'>
                <iframe src='https://www.youtube.com/embed/?listType=playlist&list=PLwazGJFvaLnBTOw4pNvPcsFW1ls4tn1Uj' frameborder='0' allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <hr />
        <div class="feature-section one-col">
            <div class="indo-get-started"><h3><?php _e( 'Let\'s Get Started', 'oneclick-wa-order' ); ?></h3>
            <ul>
                <li><strong><?php _e( 'Step #1:', 'oneclick-wa-order' ); ?></strong> <?php _e( 'Start adding your <strong>WhatsApp number</strong> including custom message and button text on <a href="admin.php?page=wa-order&tab=button_config"><strong>Button Configurations</strong></a> setting panel.', 'oneclick-wa-order' ); ?></li>
                <li><strong><?php _e( 'Step #2:', 'oneclick-wa-order' ); ?></strong> <?php _e( 'Show a fancy<strong> Floating Button</strong> with customized message and tooltip which you can customize easily on <a href="admin.php?page=wa-order&tab=floating_button"><strong>Floating Button</strong></a> setting panel.', 'oneclick-wa-order' ); ?></li>
                <li><strong><?php _e( 'Step #3:', 'oneclick-wa-order' ); ?></strong> <?php _e( 'Configure some options to <strong>display or hide buttons</strong>, including the WhatsApp button on <a href="admin.php?page=wa-order&tab=display_option"><strong>Display Options</strong></a> setting panel.', 'oneclick-wa-order' ); ?></li>
                <li><strong><?php _e( 'Step #4:', 'oneclick-wa-order' ); ?></strong> <?php _e( 'Make your online store GDPR-ready by showing <strong>GDPR Notice</strong> right under the WhatsApp Order button on <a href="admin.php?page=wa-order&tab=gdpr_notice"><strong>GDPR Notice</strong></a> setting panel.', 'oneclick-wa-order' ); ?></li>
                <li><strong><?php _e( 'Step #5:', 'oneclick-wa-order' ); ?></strong> <?php _e( 'Display WhatsApp button anywhere you like with a <strong>single shortcode</strong>. You can generate it with a customized message and a nice text on button on <a href="admin.php?page=wa-order&tab=generate_shortcode"><strong>Generate Shortcode</strong></a> setting panel.', 'oneclick-wa-order' ); ?></li>
                <li><strong><?php _e( 'Step #6:', 'oneclick-wa-order' ); ?></strong> <?php _e( '<strong>Have an inquiry?</strong> Find out how to reach me out on <a href="admin.php?page=wa-order&tab=tutorial_support"><strong>Support</strong></a> panel.', 'oneclick-wa-order' ); ?></li>
            </ul>
         </div>
         </div>
<!-- iframe -->     <hr>
        <div class="feature-section two-col">
            <div class="col">
                <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/simple-chat-button.png'; ?>" />
                <h3><?php _e( 'Simple Chat to Order Button', 'oneclick-wa-order' ); ?></h3>
                <p><?php _e( 'Replace the default Add to Cart button or simply show both. Once the Chat to Order button is clicked, the message along with the product details are sent to you through WhatsApp.', 'oneclick-wa-order' ); ?></p>
            </div>
            <div class="col">
                <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/fancy-floating-button.png'; ?>" />
                <h3><?php _e( 'Fancy Floating Button', 'oneclick-wa-order' ); ?></h3>
                <p><?php _e( 'Make it easy for any customers/visitors to reach you out through a click of a floating WhatsApp button, displayed on the left of right with tons of customization options.', 'oneclick-wa-order' ); ?></p>
            </div>
        </div>
     
        <div class="feature-section two-col">
            <div class="col">
                <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/display-this-or-hide-that.png'; ?>" />
                <h3><?php _e( 'Display This or Hide That', 'oneclick-wa-order' ); ?></h3>
                <p><?php _e( 'Wanna hide some buttons or elements you don\'t like? You have the command to rule them all. Just visit the panel and all of the options are there to configure.', 'oneclick-wa-order' ); ?></p>
            </div>
     
            <div class="col">
                <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/gdpr-ready.png'; ?>" />
                <h3><?php _e( 'Make It GDPR-Ready', 'oneclick-wa-order' ); ?></h3>
                <p><?php _e( 'The regulations are real and it\'s time to make your site ready for them. Make your site GDPR-ready with some simple configurations, really easy!', 'oneclick-wa-order' ); ?></p>
            </div>
        </div>

        <div class="feature-section two-col">
            <div class="col">
                <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/shortcode.png'; ?>" />
                <h3><?php _e( 'Shortcode Generator', 'oneclick-wa-order' ); ?></h3>
                <p><?php _e( 'Are the previous options still not enough for you? You can extend the flexibility to display a WhatsApp button using a shortcode, which you can generate easily.', 'oneclick-wa-order' ); ?></p>
            </div>
     
            <div class="col">
                <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/documentation.png'; ?>" />
                <h3><?php _e( 'Comprehensive Documentation', 'oneclick-wa-order' ); ?></h3>
                <p><?php _e( 'You will not be left alone. My complete documentation or tutorial will always help and support all your needs to get started.', 'oneclick-wa-order' ); ?></p>
            </div>
        </div>    
        	<br>
        	<?php echo do_shortcode("[donate]"); ?>
        <center><p><?php printf( __( "Created with ❤ and ☕ in Central Jakarta, Indonesia by <a href=\"https://walterpinem.me\" target=\"_blank\"><strong>Walter Pinem</strong></a>", 'oneclick-wa-order' )); ?></p></center>
     
    </div>
    </div>    
		<br>
    </div>
    <?php
	}
}