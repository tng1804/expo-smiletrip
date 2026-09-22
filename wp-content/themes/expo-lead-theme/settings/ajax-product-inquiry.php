<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Send lead notifications using the ACF email settings with HTML fallbacks.
 */
function expo_lead_send_notifications( $lead ) {
	$settings_id = 'expo_email_notification';
	$recipients  = function_exists( 'get_field' ) ? get_field( 'expo_lead_email_receivers', $settings_id ) : array();
	$to          = array();

	if ( is_array( $recipients ) ) {
		foreach ( $recipients as $recipient ) {
			$email = isset( $recipient['email'] ) ? sanitize_email( $recipient['email'] ) : '';
			if ( $email && is_email( $email ) ) {
				$to[] = $email;
			}
		}
	}

	if ( empty( $to ) ) {
		$to[] = get_option( 'admin_email' );
	}

	$subject_tags = array(
		'[name]'    => $lead['name'],
		'[email]'   => $lead['email'],
		'[phone]'   => $lead['phone'],
		'[service]' => $lead['service'],
		'[message]' => $lead['message'],
	);
	$body_tags    = array(
		'[name]'    => esc_html( $lead['name'] ),
		'[email]'   => esc_html( $lead['email'] ),
		'[phone]'   => esc_html( $lead['phone'] ),
		'[service]' => esc_html( $lead['service'] ),
		'[message]' => nl2br( esc_html( $lead['message'] ) ),
	);

	$admin_subject    = function_exists( 'get_field' ) ? get_field( 'expo_lead_email_admin_subject', $settings_id ) : '';
	$admin_body       = function_exists( 'get_field' ) ? get_field( 'expo_lead_email_admin_body', $settings_id ) : '';
	$customer_subject = function_exists( 'get_field' ) ? get_field( 'expo_lead_email_customer_subject', $settings_id ) : '';
	$customer_body    = function_exists( 'get_field' ) ? get_field( 'expo_lead_email_customer_body', $settings_id ) : '';

	// Default HTML Fallbacks
	if ( empty( $admin_subject ) ) {
		$admin_subject = '[Expo SmileTrip] Khách hàng mới: [name]';
	}
	if ( empty( $customer_subject ) ) {
		$customer_subject = '[Expo SmileTrip] Cảm ơn bạn đã liên hệ với chúng tôi';
	}

	if ( empty( $admin_body ) ) {
		$admin_body = '<div style="max-width: 680px; margin: 0 auto; background: #ffffff; font-family: \'DM Sans\', Arial, sans-serif; border: 1px solid #e6e2da; border-radius: 12px; overflow: hidden;">
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: linear-gradient(135deg, #102d3d 0%, #1a4257 100%); color: #ffffff; padding: 25px 30px;">
        <tbody><tr><td valign="middle"><div style="font-size: 22px; font-weight: bold; color: #ffffff;">EXPO <span style="color: #df572b;">SmileTrip</span> Admin</div><div style="font-size: 12px; color: #b0c4cf; margin-top: 4px;">Thông báo yêu cầu tư vấn mới</div></td><td align="right" valign="middle" style="font-size: 13px; color: #df572b; font-weight: bold;">🔔 Lead mới</td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #fbf6ee; border-bottom: 1px solid #f4e8d8; padding: 25px 30px;">
        <tbody><tr><td style="padding-right: 15px; width: 42px; text-align: center;" valign="top"><p style="font-size: 32px; margin: 0; line-height: 1;">🔔</p></td><td><h3 style="color: #102d3d; margin: 0 0 8px; font-size: 18px; font-weight: bold;">Yêu cầu tư vấn mới từ [name]</h3><p style="color: #4f5d63; font-size: 14px; line-height: 1.6; margin: 0;">Hệ thống vừa ghi nhận thông tin đăng ký tư vấn mới từ khách hàng với chi tiết dưới đây:</p></td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 25px 30px;">
        <tbody><tr><td style="padding-bottom: 12px; font-weight: bold; color: #102d3d; font-size: 15px; border-bottom: 2px solid #df572b;">📋 Thông tin khách hàng</td></tr>
        <tr><td style="padding-top: 15px;"><table border="0" width="100%" cellspacing="0" cellpadding="10" style="background: #fbfaf6; border-radius: 8px; border: 1px solid #e6e2da;"><tbody>
            <tr><td style="font-size: 13px; color: #768184; width: 35%;">Họ và tên:</td><td style="font-weight: bold; color: #102d3d; font-size: 14px;">[name]</td></tr>
            <tr><td style="font-size: 13px; color: #768184;">Email:</td><td style="font-weight: bold; color: #df572b; font-size: 14px;"><a href="mailto:[email]" style="color: #df572b; text-decoration: none;">[email]</a></td></tr>
            <tr><td style="font-size: 13px; color: #768184;">Số điện thoại:</td><td style="font-weight: bold; color: #102d3d; font-size: 14px;"><a href="tel:[phone]" style="color: #102d3d; text-decoration: none;">[phone]</a></td></tr>
            <tr><td style="font-size: 13px; color: #768184;">Dịch vụ quan tâm:</td><td style="font-weight: bold; color: #df572b; font-size: 14px;">[service]</td></tr>
        </tbody></table></td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 0 30px 25px;">
        <tbody><tr><td style="padding-bottom: 10px; font-weight: bold; color: #102d3d; font-size: 14px;">💬 Nội dung tin nhắn:</td></tr>
        <tr><td style="background: #f8faf8; border-left: 4px solid #3b5c4f; padding: 15px; border-radius: 0 8px 8px 0; color: #4f5d63; font-size: 14px; line-height: 1.6;">[message]</td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #faf9f5; border-top: 1px solid #e6e2da; padding: 20px 30px; text-align: center;">
        <tbody><tr><td style="color: #768184; font-size: 12px; line-height: 1.6;"><p style="margin: 0 0 6px; font-weight: bold; color: #102d3d;">Expo SmileTrip System Notification</p><p style="margin: 0; font-size: 11px; color: #a0aab0;">© 2026 Expo SmileTrip. All rights reserved.</p></td></tr></tbody>
    </table>
</div>';
	}

	if ( empty( $customer_body ) ) {
		$customer_body = '<div style="max-width: 680px; margin: 0 auto; background: #ffffff; font-family: \'DM Sans\', Arial, sans-serif; border: 1px solid #e6e2da; border-radius: 12px; overflow: hidden;">
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: linear-gradient(135deg, #102d3d 0%, #1a4257 100%); color: #ffffff; padding: 25px 30px;">
        <tbody><tr><td valign="middle"><div style="font-size: 22px; font-weight: bold; color: #ffffff;">EXPO <span style="color: #df572b;">SmileTrip</span></div><div style="font-size: 12px; color: #b0c4cf; margin-top: 4px;">More Smiles, More Journeys</div></td><td align="right" valign="middle" style="font-size: 13px; color: #df572b; font-weight: bold;">✈️ Xác nhận đăng ký</td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #fbf6ee; border-bottom: 1px solid #f4e8d8; padding: 25px 30px;">
        <tbody><tr><td style="padding-right: 15px; width: 42px; text-align: center;" valign="top"><p style="font-size: 32px; margin: 0; line-height: 1;">💌</p></td><td><h3 style="color: #102d3d; margin: 0 0 8px; font-size: 18px; font-weight: bold;">Xin chào [name],</h3><p style="color: #4f5d63; font-size: 14px; line-height: 1.6; margin: 0;">Cảm ơn bạn đã liên hệ với <strong>Expo SmileTrip</strong>. Chúng tôi đã nhận được thông tin yêu cầu tư vấn dịch vụ của bạn với chi tiết dưới đây:</p></td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 25px 30px;">
        <tbody><tr><td style="padding-bottom: 12px; font-weight: bold; color: #102d3d; font-size: 15px; border-bottom: 2px solid #df572b;">📋 Thông tin đã đăng ký</td></tr>
        <tr><td style="padding-top: 15px;"><table border="0" width="100%" cellspacing="0" cellpadding="10" style="background: #fbfaf6; border-radius: 8px; border: 1px solid #e6e2da;"><tbody>
            <tr><td style="font-size: 13px; color: #768184; width: 35%;">Họ và tên:</td><td style="font-weight: bold; color: #102d3d; font-size: 14px;">[name]</td></tr>
            <tr><td style="font-size: 13px; color: #768184;">Email:</td><td style="font-weight: bold; color: #df572b; font-size: 14px;">[email]</td></tr>
            <tr><td style="font-size: 13px; color: #768184;">Số điện thoại:</td><td style="font-weight: bold; color: #102d3d; font-size: 14px;">[phone]</td></tr>
            <tr><td style="font-size: 13px; color: #768184;">Dịch vụ quan tâm:</td><td style="font-weight: bold; color: #df572b; font-size: 14px;">[service]</td></tr>
        </tbody></table></td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 0 30px 25px;">
        <tbody><tr><td style="padding-bottom: 10px; font-weight: bold; color: #102d3d; font-size: 14px;">💬 Lời nhắn từ bạn:</td></tr>
        <tr><td style="background: #f8faf8; border-left: 4px solid #3b5c4f; padding: 15px; border-radius: 0 8px 8px 0; color: #4f5d63; font-size: 14px; line-height: 1.6;">[message]</td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 0 30px 25px;">
        <tbody><tr><td style="background: #fff8f5; border: 1px solid #ffdcd2; border-radius: 8px; padding: 18px;"><h4 style="color: #df572b; margin: 0 0 8px; font-size: 14px; font-weight: bold;">📢 Thông tin phản hồi:</h4><p style="color: #5c453e; font-size: 13px; line-height: 1.6; margin: 0;">• Đội ngũ tư vấn viên của Expo SmileTrip sẽ trực tiếp xem xét và liên hệ phản hồi cho bạn qua điện thoại hoặc email trong vòng <strong>24 giờ làm việc</strong>.<br>• Nếu cần hỗ trợ khẩn cấp, vui lòng gọi Hotline: <strong>+84 24 1234 5678</strong>.</p></td></tr></tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #faf9f5; border-top: 1px solid #e6e2da; padding: 20px 30px; text-align: center;">
        <tbody><tr><td style="color: #768184; font-size: 12px; line-height: 1.6;"><p style="margin: 0 0 6px; font-weight: bold; color: #102d3d;">Expo SmileTrip Team</p><p style="margin: 0; font-size: 11px; color: #a0aab0;">© 2026 Expo SmileTrip. All rights reserved.</p></td></tr></tbody>
    </table>
</div>';
	}

	$admin_subject    = strtr( $admin_subject, $subject_tags );
	$admin_body       = strtr( $admin_body, $body_tags );
	$customer_subject = strtr( $customer_subject, $subject_tags );
	$customer_body    = strtr( $customer_body, $body_tags );

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'Reply-To: ' . $lead['email'],
	);

	wp_mail( $to, $admin_subject, $admin_body, $headers );

	$customer_headers = array(
		'Content-Type: text/html; charset=UTF-8',
	);
	wp_mail( $lead['email'], $customer_subject, $customer_body, $customer_headers );
}

/**
 * Handle AJAX submission for Expo lead form.
 */
function expo_lead_ajax_submit() {
	header( 'Content-Type: application/json' );

	if ( ! isset( $_POST['expo_lead_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['expo_lead_nonce'] ) ), 'expo_lead_submit' ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Mã xác thực không hợp lệ. Vui lòng làm mới trang và thử lại.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	if ( ! empty( $_POST['website'] ) ) {
		echo wp_json_encode(
			array(
				'status'  => true,
				'message' => __( 'Cảm ơn bạn. Thông tin đã được gửi thành công.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	$name = trim( $name );
	if ( empty( $name ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Vui lòng nhập Họ và tên của bạn.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	if ( empty( $email ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Vui lòng nhập địa chỉ Email.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	if ( ! is_email( $email ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Địa chỉ Email không đúng định dạng.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	$clean_phone = str_replace( array( ' ', '-', '.' ), '', $phone );
	if ( empty( $clean_phone ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Vui lòng nhập Số điện thoại.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	if ( ! preg_match( '/^\+?[0-9]{9,15}$/', $clean_phone ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Số điện thoại không hợp lệ (từ 9 đến 15 chữ số).', 'expo-lead' ),
			)
		);
		wp_die();
	}

	if ( empty( $service ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Vui lòng chọn dịch vụ bạn quan tâm.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	$lead_id = wp_insert_post(
		array(
			'post_type'   => 'expo_lead',
			'post_status' => 'private',
			'post_title'  => $name,
			'post_content'=> $message,
		),
		true
	);

	if ( is_wp_error( $lead_id ) ) {
		echo wp_json_encode(
			array(
				'status'  => false,
				'message' => __( 'Không thể gửi thông tin lúc này. Vui lòng thử lại.', 'expo-lead' ),
			)
		);
		wp_die();
	}

	$lead = array(
		'name'    => $name,
		'email'   => $email,
		'phone'   => $phone,
		'service' => $service,
		'message' => $message,
	);

	if ( function_exists( 'update_field' ) ) {
		update_field( 'expo_lead_email', $email, $lead_id );
		update_field( 'expo_lead_phone', $phone, $lead_id );
		update_field( 'expo_lead_service', $service, $lead_id );
		update_field( 'expo_lead_message', $message, $lead_id );
	} else {
		update_post_meta( $lead_id, 'expo_lead_email', $email );
		update_post_meta( $lead_id, 'expo_lead_phone', $phone );
		update_post_meta( $lead_id, 'expo_lead_service', $service );
		update_post_meta( $lead_id, 'expo_lead_message', $message );
	}

	expo_lead_send_notifications( $lead );

	echo wp_json_encode(
		array(
			'status'  => true,
			'message' => __( 'Cảm ơn bạn! Thông tin của bạn đã được gửi thành công. Đội ngũ Expo SmileTrip sẽ liên hệ lại sớm nhất.', 'expo-lead' ),
		)
	);
	wp_die();
}
add_action( 'wp_ajax_nopriv_expo_lead_submit', 'expo_lead_ajax_submit' );
add_action( 'wp_ajax_expo_lead_submit', 'expo_lead_ajax_submit' );

