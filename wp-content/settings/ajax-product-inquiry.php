<?php
/**
 * PhotoVault Product Inquiry
 */
function photovault_product_inquiry() {
	$lang = isset($_COOKIE['site_lang']) && in_array($_COOKIE['site_lang'], array('vi', 'en')) ? $_COOKIE['site_lang'] : 'vi';

	$name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
	$phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
	// $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
	// $address = isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '';
	$message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';



	if ( ! is_user_logged_in() ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Please login to continue.', 'photovault' ) ) );
		die();
	}

	$current_user = wp_get_current_user();
	$email = $current_user->user_email;

	header('Content-Type: application/json');

	$name = trim($name);
	if ( $name == '' ) {
		$msg = ($lang === 'en') ? 'Please enter your Name.' : 'Vui lòng nhập Họ tên.';
		echo json_encode( array( 'status' => false, 'message' => $msg ) );
		die();
	}

	$clean_phone = str_replace(' ', '', $phone);
	if ( $clean_phone == '' ) {
		$msg = ($lang === 'en') ? 'Please enter your Phone number.' : 'Vui lòng nhập Số điện thoại.';
		echo json_encode( array( 'status' => false, 'message' => $msg ) );
		die();
	}

	if ( ! preg_match('/^\+?[0-9]{9,15}$/', $clean_phone) ) {
		$msg = ($lang === 'en')
			? 'Phone number is invalid. It must be between 9 and 15 digits and can start with +.'
			: 'Số điện thoại không hợp lệ. Phải từ 9 đến 15 chữ số và có thể bắt đầu bằng +.';
		echo json_encode( array( 'status' => false, 'message' => $msg ) );
		die();
	}

	if ( $email == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Please input your Email.', 'photovault' ) ) );
		die();
	}
	if ( ! is_email( $email ) ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Email is incorrect.', 'photovault' ) ) );
		die();
	}
	// if ( $address == '' ) {
	// 	echo json_encode( array( 'status' => false, 'message'=> __( 'Please input your Address.', 'photovault' ) ) );
	// 	die();
	// }

	$products_json = isset($_POST['products_json']) ? stripslashes($_POST['products_json']) : '';
	$products = array();
	if ( ! empty($products_json) ) {
		$products = json_decode($products_json, true);
	}



	if ( empty($products) ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Please select at least one product.', 'photovault' ) ) );
		die();
	}



	// 1. Insert CPT product_inquiry
	$inquiry_id = wp_insert_post( array(
		'post_type'    => 'product_inquiry',
		'post_status'  => 'private',
		'meta_input'   => array(
			'product_inquiry_name'              => $name,
			'product_inquiry_phone'             => $phone,
			'product_inquiry_email'             => $email,
			// 'product_inquiry_address'           => $address,
			'product_inquiry_message'           => $message,
			'product_inquiry_submitted_date'    => date('Y-m-d'),
			'product_inquiry_status'            => 'new',
		)
	) );

	if ( $inquiry_id && ! is_wp_error($inquiry_id) ) {
		$acf_products = array();
		foreach ( $products as $item ) {
			$item_id = isset($item['product_id']) ? intval($item['product_id']) : 0;
			$acf_products[] = array(
				'product_inquiry_item_id'       => $item_id,
				'product_inquiry_item_name'     => $item_id ? get_the_title($item_id) : '',
				'product_inquiry_item_size'     => isset($item['size']) ? sanitize_text_field($item['size']) : '',
				'product_inquiry_item_material' => isset($item['material']) ? sanitize_text_field($item['material']) : '',
				'product_inquiry_item_quantity' => isset($item['quantity']) ? intval($item['quantity']) : 1,
			);
		}
		update_field('product_inquiry_products', $acf_products, $inquiry_id);
	}

	// 2. Fetch language from cookie or post parameter
	$lang = isset($_COOKIE['site_lang']) && in_array($_COOKIE['site_lang'], array('vi', 'en')) ? $_COOKIE['site_lang'] : 'vi';

	// 3. Get Email settings from ACF options page
	$to_receivers = get_field('product_inquiry_email_receivers', 'email_notif');
	$to = array();
	if ( is_array($to_receivers) ) {
		foreach ( $to_receivers as $r ) {
			if ( !empty($r['product_inquiry_email_receiver']) ) {
				$to[] = $r['product_inquiry_email_receiver'];
			}
		}
	}
	if ( empty($to) ) {
		$to[] = get_option('admin_email');
	}

	// Load templates depending on language
	$admin_subject = get_field("product_inquiry_email_admin_subject_{$lang}", 'email_notif');
	$guest_subject = get_field("product_inquiry_email_guest_subject_{$lang}", 'email_notif');
	$admin_body_template = get_field("product_inquiry_email_message_admin_{$lang}", 'email_notif');
	$guest_body_template = get_field("product_inquiry_email_message_guest_{$lang}", 'email_notif');

	// Fallback to default if language version is empty
	if ( empty($admin_subject) ) {
		$admin_subject = get_field("product_inquiry_email_admin_subject_vi", 'email_notif');
	}
	if ( empty($guest_subject) ) {
		$guest_subject = get_field("product_inquiry_email_guest_subject_vi", 'email_notif');
	}
	if ( empty($admin_body_template) ) {
		$admin_body_template = get_field("product_inquiry_email_message_admin_vi", 'email_notif');
	}
	if ( empty($guest_body_template) ) {
		$guest_body_template = get_field("product_inquiry_email_message_guest_vi", 'email_notif');
	}

	$list_html = '<ul style="margin: 0; padding-left: 20px; font-weight: normal; color: #333333; font-size: 14px; line-height: 1.6;">';
	$total_qty = 0;
	foreach ( $products as $item ) {
		$item_id = isset($item['product_id']) ? intval($item['product_id']) : 0;
		$item_name = $item_id ? get_the_title($item_id) : '';
		$item_link = $item_id ? get_permalink($item_id) : '';
		$item_size = isset($item['size']) ? sanitize_text_field($item['size']) : '';
		$item_mat = isset($item['material']) ? sanitize_text_field($item['material']) : '';
		$item_qty = isset($item['quantity']) ? intval($item['quantity']) : 1;
		$total_qty += $item_qty;

		$mat_label = $item_mat;
		if ( strtolower($item_mat) === 'standard' ) {
			$mat_label = ($lang === 'en') ? 'Fuji Paper' : 'Giấy Fuji';
		} elseif ( strtolower($item_mat) === 'silk' ) {
			$mat_label = ($lang === 'en') ? 'Silk Paper' : 'Giấy lụa';
		}

		$size_lbl = ($lang === 'en') ? 'Size' : 'Kích thước';
		$mat_lbl = ($lang === 'en') ? 'Material' : 'Chất liệu';
		$qty_lbl = ($lang === 'en') ? 'Qty' : 'Số lượng';

		$list_html .= '<li style="margin-bottom: 8px;">';
		if ( $item_link ) {
			$list_html .= '<a style="color: #dc9814; text-decoration: none; font-weight: bold;" href="' . esc_url($item_link) . '">' . esc_html($item_name) . '</a>';
		} else {
			$list_html .= '<strong style="color: #333;">' . esc_html($item_name) . '</strong>';
		}

		$details = array();
		if ( ! empty($item_size) ) {
			$details[] = $size_lbl . ': ' . esc_html($item_size);
		}
		if ( ! empty($mat_label) ) {
			$details[] = $mat_lbl . ': ' . esc_html($mat_label);
		}
		$details[] = $qty_lbl . ': ' . esc_html($item_qty);

		$list_html .= ' (' . implode(', ', $details) . ')';
		$list_html .= '</li>';
	}
	$list_html .= '</ul>';

	$product_title = $list_html;

	$admin_subject = str_replace('[name]', $name, $admin_subject);

	// Process admin email body
	$admin_body = $admin_body_template;
	$admin_body = str_replace('[name]', $name, $admin_body);
	$admin_body = str_replace('[phone]', $phone, $admin_body);
	$admin_body = str_replace('[email]', $email, $admin_body);
	// $admin_body = str_replace('[address]', $address, $admin_body);
	$admin_body = str_replace('[message]', $message, $admin_body);
	$admin_body = str_replace('[product_name]', $product_title, $admin_body);

	// Process guest email body
	$guest_body = $guest_body_template;
	$guest_body = str_replace('[name]', $name, $guest_body);
	$guest_body = str_replace('[phone]', $phone, $guest_body);
	$guest_body = str_replace('[email]', $email, $guest_body);
	// $guest_body = str_replace('[address]', $address, $guest_body);
	$guest_body = str_replace('[message]', $message, $guest_body);
	$guest_body = str_replace('[product_name]', $product_title, $guest_body);

	$headers = array(
		'Reply-To: ' . $email,
		'Content-Type: text/html; charset=UTF-8',
		'Cc: mark.tran@brightsoftsolution.com'
	);

	// Send to admin
	wp_mail( $to, $admin_subject, $admin_body, $headers );

	// Send to customer
	$guest_headers = array(
		'Content-Type: text/html; charset=UTF-8'
	);
	wp_mail( $email, $guest_subject, $guest_body, $guest_headers );

	$success_msg = ($lang === 'en') 
		? 'Thank you for your order inquiry. Your information has been submitted successfully!' 
		: 'Cảm ơn bạn đã gửi yêu cầu đặt hàng. Thông tin đã được gửi thành công!';

	echo json_encode( array( 'status' => true, 'message' => $success_msg ) );
	die();
}
add_action( 'wp_ajax_nopriv_photovault_product_inquiry', 'photovault_product_inquiry' );
add_action( 'wp_ajax_photovault_product_inquiry', 'photovault_product_inquiry' );