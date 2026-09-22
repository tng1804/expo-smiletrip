<?php
function photovault_init_product_inquiry() {
	// Add product inquiry post type
	register_post_type( 'product_inquiry',
		array ( 
			'labels' => array(
				'name' 				=> __( 'Product Inquiry', 'photovault' ),
				'singular_name' 	=> __( 'Product Inquiry', 'photovault' ),
				'menu_name' 		=> __( 'Product Inquiry', 'photovault' ),
				'name_admin_bar'    => __( 'Product Inquiry', 'photovault' ),
				'all_items'			=> __( 'All Product Inquiry', 'photovault' ),
				'add_new' 			=> __( 'Add Product Inquiry', 'photovault' ),
				'add_new_item' 		=> __( 'Add Product Inquiry', 'photovault' ),
				'edit_item' 		=> __( 'Edit Product Inquiry', 'photovault' ),
			),
			'description' 		=> __( 'Product Inquiry', 'photovault' ),
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'dashicons-calendar-alt',
			'capability_type' 	=> 'post',
			'public' 			=> false,
			'show_ui'			=> true,
			'has_archive' 		=> false,
			'supports' 			=> array(''),
		)
	);

	/**
	 * Add product inquiry field group
	 */
	if( function_exists('acf_add_local_field_group') ) {
		
		acf_add_local_field_group(	array(
			'key'		=> 'product_inquiry_settings',
			'title' 	=> __( 'Information', 'photovault' ),
			'fields' 	=> array (

				// User Information
				array (
					'label' 		=> __( 'Customer Name', 'photovault' ),
					'key'   		=> 'product_inquiry_name',
					'name'  		=> 'product_inquiry_name',
					'type'  		=> 'text',
					'required'		=> true,
					'show_column'	=> 1,
					'show_column_weight' => 20,
					'wrapper'       => array (
						'width' => '33',
					),
				),
				array (
					'label' 		=> __( 'Phone', 'photovault' ),
					'key'   		=> 'product_inquiry_phone',
					'name'  		=> 'product_inquiry_phone',
					'type'  		=> 'text',
					'required'		=> true,
					'show_column'	=> 1,
					'show_column_weight' => 40,
					'wrapper'       => array (
						'width' => '33',
					),
				),
				array (
					'label' 		=> __( 'Email', 'photovault' ),
					'key'   		=> 'product_inquiry_email',
					'name'  		=> 'product_inquiry_email',
					'type'  		=> 'email',
					'required'		=> true,
					'show_column'	=> 1,
					'show_column_weight' => 30,
					'wrapper'       => array (
						'width' => '34',
					),
				),
				// array (
				// 	'label' 		=> __( 'Address', 'photovault' ),
				// 	'key'   		=> 'product_inquiry_address',
				// 	'name'  		=> 'product_inquiry_address',
				// 	'type'  		=> 'text',
				// 	'required'		=> false,
				// 	'show_column'	=> 1,
				// 	'show_column_weight' => 35,
				// 	'wrapper'       => array (
				// 		'width' => '100',
				// 	),
				// ),
				array (
					'label' 		=> __( 'Message', 'photovault' ),
					'key'   		=> 'product_inquiry_message',
					'name'  		=> 'product_inquiry_message',
					'type'  		=> 'textarea',
					'wrapper'       => array (
						'width' => '100',
					),
				),


				array (
					'label' 		=> __( 'Danh sách sản phẩm', 'photovault' ),
					'key'   		=> 'product_inquiry_products',
					'name'  		=> 'product_inquiry_products',
					'type'  		=> 'repeater',
					'layout' 		=> 'table',
					'button_label' 	=> __( 'Thêm sản phẩm', 'photovault' ),
					'wrapper'       => array (
						'width' => '100',
					),
					'sub_fields' 	=> array (
						array (
							'label' 		=> __( 'Mã sản phẩm', 'photovault' ),
							'key'   		=> 'product_inquiry_item_id',
							'name'  		=> 'product_inquiry_item_id',
							'type'  		=> 'text',
							'wrapper'       => array (
								'width' => '15',
							),
						),
						array (
							'label' 		=> __( 'Tên sản phẩm', 'photovault' ),
							'key'   		=> 'product_inquiry_item_name',
							'name'  		=> 'product_inquiry_item_name',
							'type'  		=> 'text',
							'wrapper'       => array (
								'width' => '40',
							),
						),
						array (
							'label' 		=> __( 'Size', 'photovault' ),
							'key'   		=> 'product_inquiry_item_size',
							'name'  		=> 'product_inquiry_item_size',
							'type'  		=> 'text',
							'wrapper'       => array (
								'width' => '15',
							),
						),
						array (
							'label' 		=> __( 'Chất liệu', 'photovault' ),
							'key'   		=> 'product_inquiry_item_material',
							'name'  		=> 'product_inquiry_item_material',
							'type'  		=> 'text',
							'wrapper'       => array (
								'width' => '15',
							),
						),
						array (
							'label' 		=> __( 'Số lượng', 'photovault' ),
							'key'   		=> 'product_inquiry_item_quantity',
							'name'  		=> 'product_inquiry_item_quantity',
							'type'  		=> 'number',
							'wrapper'       => array (
								'width' => '15',
							),
						),
					),
				),
				array (
					'label' 		=> __( 'Submitted date', 'photovault' ),
					'key'   		=> 'product_inquiry_submitted_date',
					'name'  		=> 'product_inquiry_submitted_date',
					'type'  		=> 'date',
					'show_column'	=> 1,
					'show_column_weight' => 100,
					'wrapper'       => array (
						'width' => '50',
					),
				),
				array (
					'label' 		=> __( 'Status', 'photovault' ),
					'key'   		=> 'product_inquiry_status',
					'name'  		=> 'product_inquiry_status',
					'type'  		=> 'select',
					'show_column'	=> 1,
					'show_column_weight' => 110,
					'choices' => array (
						'new' => __( 'New', 'photovault' ),
						'contacted' => __( 'Contacted', 'photovault' ),
						'negotiating' => __( 'Negotiating', 'photovault'),
						'confirmed' => __( 'Confirmed', 'photovault' ),
						'cancelled' => __( 'Cancelled', 'photovault' ),
					),
					'wrapper'       => array (
						'width' => '50',
					),
				),
			),
			'location' => array (
				array (
					array (
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'product_inquiry',
					),
				),
			),
			'position' => 'normal',
			'label_placement' => 'left',
		));
	}
}
add_action( 'init', 'photovault_init_product_inquiry' );

// Add product inquiry columns
function photovault_product_inquiry_columns_head($cols) {		
	$new_cols = array(
		'cb'                                => '<input type="checkbox" />',
		'product_inquiry_name'              => __( 'Customer Name', 'photovault' ),
		'product_inquiry_phone'             => __( 'Phone', 'photovault' ),
		'product_inquiry_email'             => __( 'Email', 'photovault' ),
		// 'product_inquiry_address'           => __( 'Address', 'photovault' ),
		'product_inquiry_products'          => __( 'Sản phẩm', 'photovault' ),
		'product_inquiry_status'            => __( 'Status', 'photovault' ),
		'product_inquiry_submitted_date'    => __( 'Submitted date', 'photovault' ),
		'date'                              => __( 'Date', 'photovault' )
	);
	return $new_cols;
}
add_filter('manage_product_inquiry_posts_columns', 'photovault_product_inquiry_columns_head');

// Render product inquiry columns content
function photovault_product_inquiry_columns_content($column, $post_id) {
	switch ( $column ) {
		case 'product_inquiry_name':
			echo esc_html( get_post_meta( $post_id, 'product_inquiry_name', true ) );
			break;
		case 'product_inquiry_phone':
			echo esc_html( get_post_meta( $post_id, 'product_inquiry_phone', true ) );
			break;
		case 'product_inquiry_email':
			echo esc_html( get_post_meta( $post_id, 'product_inquiry_email', true ) );
			break;
		// case 'product_inquiry_address':
		// 	echo esc_html( get_post_meta( $post_id, 'product_inquiry_address', true ) );
		// 	break;
		case 'product_inquiry_products':
			$products = get_field( 'product_inquiry_products', $post_id );
			if ( is_array( $products ) && ! empty( $products ) ) {
				$names = array();
				foreach ( $products as $item ) {
					$names[] = esc_html( $item['product_inquiry_item_name'] ) . ' (ID: ' . esc_html( $item['product_inquiry_item_id'] ) . ')';
				}
				echo implode( '<br>', $names );
			} else {
				// Fallback to legacy fields
				$legacy_id = get_post_meta( $post_id, 'product_inquiry_product_id', true );
				$legacy_name = get_post_meta( $post_id, 'product_inquiry_product_name', true );
				if ( $legacy_name || $legacy_id ) {
					echo esc_html( $legacy_name ) . ' (ID: ' . esc_html( $legacy_id ) . ')';
				} else {
					echo '-';
				}
			}
			break;
		case 'product_inquiry_status':
			echo esc_html( get_post_meta( $post_id, 'product_inquiry_status', true ) );
			break;
		case 'product_inquiry_submitted_date':
			echo esc_html( get_post_meta( $post_id, 'product_inquiry_submitted_date', true ) );
			break;
	}
}
add_action('manage_product_inquiry_posts_custom_column', 'photovault_product_inquiry_columns_content', 10, 2);

// Set primary column for row actions
function photovault_product_inquiry_primary_column( $default, $screen ) {
	if ( 'edit-product_inquiry' === $screen ) {
	return 'product_inquiry_name';
	}
	return $default;
}
add_filter( 'list_table_primary_column', 'photovault_product_inquiry_primary_column', 10, 2 );