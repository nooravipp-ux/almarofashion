<?php	

// Step 1 - Adding a custom tab to the Products Metabox
add_filter( 'woocommerce_product_data_tabs', 'add_oneclick_options_product_data_tab', 99 , 1 );
function add_oneclick_options_product_data_tab( $product_data_tabs ) {
    $product_data_tabs['oneclick-product-tab'] = array(
        'label' => __( 'OneClick', 'oneclick-wa-order' ), // translatable
        'target' => 'oneclick_options_product_data', // translatable
    );
    return $product_data_tabs;
}

// Step 2 - Adding and POPULATING (with data) custom fields in custom tab for Product Metabox
add_action( 'woocommerce_product_data_panels', 'add_oneclick_options_product_data_fields' );
function add_oneclick_options_product_data_fields() {
    global $post;

    $post_id = $post->ID;

    echo '<div id="oneclick_options_product_data" class="panel woocommerce_options_panel">';

    ## THE 6 DIFFERENT FIELD TYPES

    # 1. Text input field
    woocommerce_wp_text_input( array(
        'id'            => '_wa_order_button_text',
        'placeholder'   => __( 'Buy on WhatsApp', 'oneclick-wa-order' ), // (optional)
        'label'         => __( 'Button Text', 'oneclick-wa-order' ), // (optional)
        'description'   => __( 'Add custom button text. This will override the value on the plugin setting page.', 'oneclick-wa-order' ), // (optional)
        'desc_tip'      => true, // (optional) To show the description as a tip
    ) );

    // 2. Textarea input field
    woocommerce_wp_textarea_input( array(
        'id'        => '_wa_order_custom_message',
        'class'         => 'short', // (optional)
        'placeholder'   => __( 'Hello, I want to buy this product', 'oneclick-wa-order' ), // (optional)
        'description'      => __('Add custom message. This will override the value of Single Product Page custom message text on the plugin setting page.', 'oneclick-wa-order'),
        'label'     => __('Custom Message', 'woocommerce'),
        'desc_tip'  => true
    ) );

    // 3. Checkbox field
    woocommerce_wp_checkbox( array(
        'id'        => '_hide_wa_button',
        'description' => __('This will hide WhatsApp button only for this product.', 'woocommerce'),
        'label'     => __('Hide WhatsApp button?', 'woocommerce')
    ));

    echo '</div>';
}

// Step 3 - Saving custom fields data of custom products tab metabox
add_action( 'woocommerce_process_product_meta', 'shipping_costs_process_product_meta_fields_save' );
function shipping_costs_process_product_meta_fields_save( $post_id ){

    // save the text field data
    if( isset( $_POST['_wa_order_button_text'] ) )
        update_post_meta( $post_id, '_wa_order_button_text', esc_attr( $_POST['_wa_order_button_text'] ) );

    // save the textarea field data
    if( isset( $_POST['_wa_order_custom_message'] ) )
        update_post_meta( $post_id, '_wa_order_custom_message', esc_attr( $_POST['_wa_order_custom_message'] ) );

    // save the checkbox field data
    // Custom Product Text Field
    $wa_order_hide_wa_button = isset( $_POST['_hide_wa_button'] ) ? 'yes' : 'no';
        update_post_meta($post_id, '_hide_wa_button', esc_attr( $wa_order_hide_wa_button ));
}

// Icon
add_action('admin_head', 'wa_order_product_tab_icon');
function wa_order_product_tab_icon(){
	echo '<style>
	#woocommerce-product-data ul.wc-tabs li.oneclick-product-tab_options a:before{
		content: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>\')!important;
		color: #0073AA;
		font-size: inherit;
		font-weight: inherit!important;
		display: inline-block;
		vertical-align: middle;
		align-items: center;
		margin-bottom: -2px;
		margin-top: -5px;
		width: 0.875em;
		height: auto;
	}
	</style>';
}
