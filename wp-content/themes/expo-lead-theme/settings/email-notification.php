<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the ACF Options Page and editable lead email templates.
 */
function expo_lead_register_email_settings() {
	if ( ! function_exists( 'acf_add_options_page' ) || ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Email Notification', 'expo-lead' ),
			'menu_title' => __( 'Email Notification', 'expo-lead' ),
			'menu_slug'  => 'expo-email-notification',
			'capability' => 'manage_options',
			'icon_url'   => 'dashicons-email-alt',
			'post_id'    => 'expo_email_notification',
		)
	);

	$default_admin_body = '<div style="max-width: 680px; margin: 0 auto; background: #ffffff; font-family: \'DM Sans\', Arial, sans-serif; border: 1px solid #e6e2da; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: linear-gradient(135deg, #102d3d 0%, #1a4257 100%); color: #ffffff; padding: 25px 30px;">
        <tbody>
            <tr>
                <td valign="middle">
                    <div style="font-size: 22px; font-weight: bold; letter-spacing: -0.5px; color: #ffffff;">
                        EXPO <span style="color: #df572b;">SmileTrip</span> Admin
                    </div>
                    <div style="font-size: 12px; color: #b0c4cf; margin-top: 4px;">Thông báo yêu cầu tư vấn mới</div>
                </td>
                <td align="right" valign="middle" style="font-size: 13px; color: #df572b; font-weight: bold;">
                    🔔 Lead mới
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #fbf6ee; border-bottom: 1px solid #f4e8d8; padding: 25px 30px;">
        <tbody>
            <tr>
                <td style="padding-right: 15px; width: 42px; text-align: center;" valign="top">
                    <p style="font-size: 32px; margin: 0; line-height: 1;">🔔</p>
                </td>
                <td>
                    <h3 style="color: #102d3d; margin: 0 0 8px; font-size: 18px; font-weight: bold;">Yêu cầu tư vấn mới từ [name]</h3>
                    <p style="color: #4f5d63; font-size: 14px; line-height: 1.6; margin: 0;">
                        Hệ thống vừa ghi nhận một thông tin khách hàng tiềm năng mới gửi từ Website với chi tiết dưới đây:
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 25px 30px;">
        <tbody>
            <tr>
                <td style="padding-bottom: 12px; font-weight: bold; color: #102d3d; font-size: 15px; border-bottom: 2px solid #df572b;">
                    📋 Thông tin khách hàng
                </td>
            </tr>
            <tr>
                <td style="padding-top: 15px;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="10" style="background: #fbfaf6; border-radius: 8px; border: 1px solid #e6e2da;">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px; color: #768184; width: 35%;">Họ và tên:</td>
                                <td style="font-weight: bold; color: #102d3d; font-size: 14px;">[name]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #768184;">Email:</td>
                                <td style="font-weight: bold; color: #df572b; font-size: 14px;"><a href="mailto:[email]" style="color: #df572b; text-decoration: none;">[email]</a></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #768184;">Số điện thoại:</td>
                                <td style="font-weight: bold; color: #102d3d; font-size: 14px;"><a href="tel:[phone]" style="color: #102d3d; text-decoration: none;">[phone]</a></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #768184;">Dịch vụ quan tâm:</td>
                                <td style="font-weight: bold; color: #df572b; font-size: 14px;">[service]</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 0 30px 25px;">
        <tbody>
            <tr>
                <td style="padding-bottom: 10px; font-weight: bold; color: #102d3d; font-size: 14px;">
                    💬 Nội dung tin nhắn:
                </td>
            </tr>
            <tr>
                <td style="background: #f8faf8; border-left: 4px solid #3b5c4f; padding: 15px; border-radius: 0 8px 8px 0; color: #4f5d63; font-size: 14px; line-height: 1.6;">
                    [message]
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 0 30px 25px;">
        <tbody>
            <tr>
                <td style="background: #fff8f5; border: 1px solid #ffdcd2; border-radius: 8px; padding: 18px;">
                    <h4 style="color: #df572b; margin: 0 0 8px; font-size: 14px; font-weight: bold;">⚡ Hướng dẫn cho Admin:</h4>
                    <p style="color: #5c453e; font-size: 13px; line-height: 1.6; margin: 0;">
                        • Hãy chủ động liên hệ lại với khách hàng theo số điện thoại <strong>[phone]</strong> hoặc email <strong>[email]</strong>.<br>
                        • Thông tin này cũng đã được lưu trong mục <strong>Khách hàng tiềm năng</strong> trên Dashboard quản trị WordPress.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #faf9f5; border-top: 1px solid #e6e2da; padding: 20px 30px; text-align: center;">
        <tbody>
            <tr>
                <td style="color: #768184; font-size: 12px; line-height: 1.6;">
                    <p style="margin: 0 0 6px; font-weight: bold; color: #102d3d;">Expo SmileTrip System Notification</p>
                    <p style="margin: 0; font-size: 11px; color: #a0aab0;">© 2026 Expo SmileTrip. All rights reserved.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>';

	$default_customer_body = '<div style="max-width: 680px; margin: 0 auto; background: #ffffff; font-family: \'DM Sans\', Arial, sans-serif; border: 1px solid #e6e2da; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: linear-gradient(135deg, #102d3d 0%, #1a4257 100%); color: #ffffff; padding: 25px 30px;">
        <tbody>
            <tr>
                <td valign="middle">
                    <div style="font-size: 22px; font-weight: bold; letter-spacing: -0.5px; color: #ffffff;">
                        EXPO <span style="color: #df572b;">SmileTrip</span>
                    </div>
                    <div style="font-size: 12px; color: #b0c4cf; margin-top: 4px;">More Smiles, More Journeys</div>
                </td>
                <td align="right" valign="middle" style="font-size: 13px; color: #df572b; font-weight: bold;">
                    ✈️ Xác nhận đăng ký
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #fbf6ee; border-bottom: 1px solid #f4e8d8; padding: 25px 30px;">
        <tbody>
            <tr>
                <td style="padding-right: 15px; width: 42px; text-align: center;" valign="top">
                    <p style="font-size: 32px; margin: 0; line-height: 1;">💌</p>
                </td>
                <td>
                    <h3 style="color: #102d3d; margin: 0 0 8px; font-size: 18px; font-weight: bold;">Xin chào [name],</h3>
                    <p style="color: #4f5d63; font-size: 14px; line-height: 1.6; margin: 0;">
                        Cảm ơn bạn đã liên hệ với <strong>Expo SmileTrip</strong>. Chúng tôi đã nhận được thông tin yêu cầu tư vấn dịch vụ của bạn với chi tiết bên dưới:
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 25px 30px;">
        <tbody>
            <tr>
                <td style="padding-bottom: 12px; font-weight: bold; color: #102d3d; font-size: 15px; border-bottom: 2px solid #df572b;">
                    📋 Thông tin đã đăng ký
                </td>
            </tr>
            <tr>
                <td style="padding-top: 15px;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="10" style="background: #fbfaf6; border-radius: 8px; border: 1px solid #e6e2da;">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px; color: #768184; width: 35%;">Họ và tên:</td>
                                <td style="font-weight: bold; color: #102d3d; font-size: 14px;">[name]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #768184;">Email:</td>
                                <td style="font-weight: bold; color: #df572b; font-size: 14px;">[email]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #768184;">Số điện thoại:</td>
                                <td style="font-weight: bold; color: #102d3d; font-size: 14px;">[phone]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #768184;">Dịch vụ quan tâm:</td>
                                <td style="font-weight: bold; color: #df572b; font-size: 14px;">[service]</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 0 30px 25px;">
        <tbody>
            <tr>
                <td style="padding-bottom: 10px; font-weight: bold; color: #102d3d; font-size: 14px;">
                    💬 Lời nhắn từ bạn:
                </td>
            </tr>
            <tr>
                <td style="background: #f8faf8; border-left: 4px solid #3b5c4f; padding: 15px; border-radius: 0 8px 8px 0; color: #4f5d63; font-size: 14px; line-height: 1.6;">
                    [message]
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 0 30px 25px;">
        <tbody>
            <tr>
                <td style="background: #fff8f5; border: 1px solid #ffdcd2; border-radius: 8px; padding: 18px;">
                    <h4 style="color: #df572b; margin: 0 0 8px; font-size: 14px; font-weight: bold;">📢 Thông tin phản hồi:</h4>
                    <p style="color: #5c453e; font-size: 13px; line-height: 1.6; margin: 0;">
                        • Đội ngũ tư vấn viên của Expo SmileTrip sẽ trực tiếp xem xét và liên hệ phản hồi cho bạn qua điện thoại hoặc email trong vòng <strong>24 giờ làm việc</strong>.<br>
                        • Nếu cần hỗ trợ khẩn cấp, vui lòng gọi Hotline: <strong>+84 24 1234 5678</strong>.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="background: #faf9f5; border-top: 1px solid #e6e2da; padding: 20px 30px; text-align: center;">
        <tbody>
            <tr>
                <td style="color: #768184; font-size: 12px; line-height: 1.6;">
                    <p style="margin: 0 0 6px; font-weight: bold; color: #102d3d;">Expo SmileTrip Team</p>
                    <p style="margin: 0; font-size: 11px; color: #a0aab0;">© 2026 Expo SmileTrip. All rights reserved.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>';

	acf_add_local_field_group(
		array(
			'key'    => 'group_expo_lead_email_settings',
			'title'  => __( 'Lead email templates', 'expo-lead' ),
			'fields' => array(
				array(
					'key'          => 'field_expo_lead_email_receivers',
					'label'        => __( 'Notification recipients', 'expo-lead' ),
					'name'         => 'expo_lead_email_receivers',
					'type'         => 'repeater',
					'layout'       => 'table',
					'button_label' => __( 'Add recipient', 'expo-lead' ),
					'sub_fields'   => array(
						array(
							'key'   => 'field_expo_lead_email_receiver',
							'label' => __( 'Email', 'expo-lead' ),
							'name'  => 'email',
							'type'  => 'email',
						),
					),
				),
				array(
					'key'           => 'field_expo_lead_email_admin_subject',
					'label'         => __( 'Admin subject', 'expo-lead' ),
					'name'          => 'expo_lead_email_admin_subject',
					'type'          => 'text',
					'default_value' => '[Expo SmileTrip] Khách hàng mới: [name]',
				),
				array(
					'key'           => 'field_expo_lead_email_admin_body',
					'label'         => __( 'Admin message', 'expo-lead' ),
					'name'          => 'expo_lead_email_admin_body',
					'type'          => 'wysiwyg',
					'instructions'  => __( 'Available tags: [name], [email], [phone], [service], [message]', 'expo-lead' ),
					'default_value' => $default_admin_body,
				),
				array(
					'key'           => 'field_expo_lead_email_customer_subject',
					'label'         => __( 'Customer subject', 'expo-lead' ),
					'name'          => 'expo_lead_email_customer_subject',
					'type'          => 'text',
					'default_value' => '[Expo SmileTrip] Cảm ơn bạn đã liên hệ với chúng tôi',
				),
				array(
					'key'           => 'field_expo_lead_email_customer_body',
					'label'         => __( 'Customer message', 'expo-lead' ),
					'name'          => 'expo_lead_email_customer_body',
					'type'          => 'wysiwyg',
					'instructions'  => __( 'Available tags: [name], [email], [phone], [service], [message]', 'expo-lead' ),
					'default_value' => $default_customer_body,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'expo-email-notification',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'expo_lead_register_email_settings' );

