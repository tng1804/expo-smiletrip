<?php
/**
 * onlysun Email Notification.
 *
 * @package onlysun
 */
/**
 * Create Email Notification page
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Email Notification',
		'menu_title' => 'Email Notification',
		'menu_slug' => 'email-notification',
		'capability' => 'edit_posts',
		'icon_url' => 'dashicons-email',
		'id' => 'email_notif',
		'post_id' => 'email_notif',
	));
}
/**
 * Add Email Notification field group
 */
if (function_exists('acf_add_local_field_group')) {

	acf_add_local_field_group(array(
		'key' => 'email_notif_settings',
		'title' => __('Settings', 'onlysun'),
		'fields' => array(
			array(
				'label' => __('Product Inquiry', 'onlysun'),
				'key' => 'tab_product_inquiry_email',
				'name' => 'tab_product_inquiry_email',
				'type' => 'tab',
				'placement' => 'left',
			),
			array(
				'label' => __('Receivers', 'onlysun'),
				'key' => 'product_inquiry_email_receivers',
				'name' => 'product_inquiry_email_receivers',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __('Add', 'onlysun'),
				'sub_fields' => array(
					array(
						'label' => __('Receiver', 'onlysun'),
						'key' => 'product_inquiry_email_receiver',
						'name' => 'product_inquiry_email_receiver',
						'type' => 'email',
					),
				),
			),
			// Vietnamese Templates
			array(
				'label' => __('Guest Subject (VI)', 'onlysun'),
				'key' => 'product_inquiry_email_guest_subject_vi',
				'name' => 'product_inquiry_email_guest_subject_vi',
				'type' => 'text',
				'default_value' => '[PhotoVault] Xác nhận yêu cầu đặt hàng in ảnh',
			),
			array(
				'label' => __('Admin Subject (VI)', 'onlysun'),
				'key' => 'product_inquiry_email_admin_subject_vi',
				'name' => 'product_inquiry_email_admin_subject_vi',
				'type' => 'text',
				'default_value' => '[PhotoVault] Yêu cầu đặt hàng in ảnh mới từ [name]',
			),
			array(
				'label' => __('Guest Message (VI)', 'onlysun'),
				'key' => 'product_inquiry_email_message_guest_vi',
				'name' => 'product_inquiry_email_message_guest_vi',
				'type' => 'wysiwyg',
				'instructions' => 'Email tags: [name], [phone], [email], [product_id], [product_name], [product_size], [product_material], [product_quantity], [message], [product_link]',
				'default_value' => '<div style="max-width: 800px; margin: 0 auto; background: #ffffff; font-family: Arial, sans-serif; border: 1px solid #e1e1e1;">
    <!-- Header -->
    <table style="background: #dc9814; color: #ffffff; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="font-size: 18px; font-weight: normal;" valign="middle">
                    <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-left: 10px; color: #ffffff; font-size: 20px; font-weight: bold;">PhotoVault</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="font-size: 14px; color: #ffffff;" align="right" valign="middle"><strong>Dịch vụ in ảnh cao cấp</strong></td>
            </tr>
        </tbody>
    </table>
    <!-- Greeting Alert Box -->
    <table style="background: linear-gradient(135deg, #fdf8ee 0%, #fffdf9 100%); border: 1px solid #f9e3b4; border-radius: 8px; margin: 20px; padding: 25px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-right: 15px; width: 40px; text-align: center;" valign="top">
                                    <p style="font-size: 40px; margin: 0;">📸</p>
                                </td>
                                <td>
                                    <h3 style="color: #8a5e00; margin: 0 0 10px; font-size: 20px; font-weight: bold;">Kính gửi Ông/Bà [name],</h3>
                                    <p style="color: #5c3e00; font-size: 15px; line-height: 1.6; margin: 0 0 10px;"><strong>Lời chào trân trọng từ PhotoVault!</strong></p>
                                    <p style="color: #5c3e00; font-size: 15px; line-height: 1.6; margin: 0;">Cảm ơn Quý khách đã tin tưởng và gửi yêu cầu đặt in ảnh tại PhotoVault. Chúng tôi xin xác nhận thông tin yêu cầu của Quý khách với nội dung chi tiết dưới đây:</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Contact Information -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Thông tin khách hàng</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;" width="35%">Họ và tên</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[name]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Số điện thoại</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[phone]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Email</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;"><a style="color: #dc9814; text-decoration: none;" href="mailto:[email]">[email]</a></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Product Details -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Chi tiết sản phẩm in</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[product_name]</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Message Section -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Lời nhắn từ khách hàng</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <p style="color: #333333; font-size: 14px; line-height: 1.6; margin: 0;">[message]</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Response Notice -->
    <table style="background: #fff9eb; border-left: 4px solid #dc9814; border-radius: 4px; margin: 20px; padding: 15px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <h4 style="color: #8a5e00; margin: 0 0 10px; font-size: 15px; font-weight: bold;">📢 Thông tin phản hồi:</h4>
                    <p style="color: #5c3e00; font-size: 13px; line-height: 1.7; margin: 0;">• Đội ngũ kỹ thuật viên của PhotoVault sẽ kiểm tra file ảnh, tỷ lệ kích thước và liên hệ xác nhận báo giá tốt nhất cho Quý khách trong vòng <strong>24 giờ làm việc</strong>.<br>• Xin vui lòng kiểm tra hộp thư đến (hoặc hộp thư rác / spam) để nhận thông tin sớm nhất.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Footer -->
    <table style="margin: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="text-align: center; color: #6c757d; font-size: 12px; line-height: 1.6;">
                    <p style="margin-bottom: 8px;"><strong>Trân trọng,</strong></p>
                    <p style="margin-bottom: 8px; font-weight: bold; color: #495057; font-size: 14px;">PhotoVault Team</p>
                    <p style="margin-top: 15px; font-size: 11px; color: #95a5a6;">© 2026 PhotoVault. All rights reserved.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>',
			),
			array(
				'label' => __('Admin Message (VI)', 'onlysun'),
				'key' => 'product_inquiry_email_message_admin_vi',
				'name' => 'product_inquiry_email_message_admin_vi',
				'type' => 'wysiwyg',
				'instructions' => 'Email tags: [name], [phone], [email], [product_id], [product_name], [product_size], [product_material], [product_quantity], [message], [product_link]',
				'default_value' => '<div style="max-width: 800px; margin: 0 auto; background: #ffffff; font-family: Arial, sans-serif; border: 1px solid #e1e1e1;">
    <!-- Header -->
    <table style="background: #dc9814; color: #ffffff; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="font-size: 18px; font-weight: normal;" valign="middle">
                    <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-left: 10px; color: #ffffff; font-size: 20px; font-weight: bold;">PhotoVault Admin</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="font-size: 14px; color: #ffffff;" align="right" valign="middle"><strong>Yêu cầu mới hệ thống</strong></td>
            </tr>
        </tbody>
    </table>
    <!-- Greeting Alert Box -->
    <table style="background: linear-gradient(135deg, #fdf8ee 0%, #fffdf9 100%); border: 1px solid #f9e3b4; border-radius: 8px; margin: 20px; padding: 25px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-right: 15px; width: 40px; text-align: center;" valign="top">
                                    <p style="font-size: 40px; margin: 0;">🔔</p>
                                </td>
                                <td>
                                    <h3 style="color: #8a5e00; margin: 0 0 10px; font-size: 20px; font-weight: bold;">Yêu cầu đặt hàng in ảnh mới từ [name]</h3>
                                    <p style="color: #5c3e00; font-size: 15px; line-height: 1.6; margin: 0;">Hệ thống vừa ghi nhận một yêu cầu tư vấn và đặt hàng in ảnh mới từ khách hàng với thông tin chi tiết dưới đây:</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Contact Information -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Thông tin khách hàng</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;" width="35%">Họ và tên</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[name]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Số điện thoại</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[phone]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Email</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;"><a style="color: #dc9814; text-decoration: none;" href="mailto:[email]">[email]</a></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Product Details -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Chi tiết sản phẩm in</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[product_name]</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Message Section -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Lời nhắn từ khách hàng</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <p style="color: #333333; font-size: 14px; line-height: 1.6; margin: 0;">[message]</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Response Notice -->
    <table style="background: #fff9eb; border-left: 4px solid #dc9814; border-radius: 4px; margin: 20px; padding: 15px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <h4 style="color: #8a5e00; margin: 0 0 10px; font-size: 15px; font-weight: bold;">📢 Hướng dẫn cho Admin:</h4>
                    <p style="color: #5c3e00; font-size: 13px; line-height: 1.7; margin: 0;">• Hãy chủ động liên hệ lại với khách hàng theo số điện thoại: <strong>[phone]</strong> hoặc email: <strong>[email]</strong> để tư vấn và gửi báo giá chi tiết.<br>• Yêu cầu này cũng đã được ghi nhận trong menu <strong>Product Inquiries</strong> của trang Dashboard quản trị.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Footer -->
    <table style="margin: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="text-align: center; color: #6c757d; font-size: 12px; line-height: 1.6;">
                    <p style="margin-bottom: 8px; font-weight: bold; color: #495057; font-size: 14px;">PhotoVault System Notification</p>
                    <p style="margin-top: 15px; font-size: 11px; color: #95a5a6;">© 2026 PhotoVault. All rights reserved.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>',
			),
			// English Templates
			array(
				'label' => __('Guest Subject (EN)', 'onlysun'),
				'key' => 'product_inquiry_email_guest_subject_en',
				'name' => 'product_inquiry_email_guest_subject_en',
				'type' => 'text',
				'default_value' => '[PhotoVault] Confirmation of Product Print Inquiry',
			),
			array(
				'label' => __('Admin Subject (EN)', 'onlysun'),
				'key' => 'product_inquiry_email_admin_subject_en',
				'name' => 'product_inquiry_email_admin_subject_en',
				'type' => 'text',
				'default_value' => '[PhotoVault] New Product Print Inquiry from [name]',
			),
			array(
				'label' => __('Guest Message (EN)', 'onlysun'),
				'key' => 'product_inquiry_email_message_guest_en',
				'name' => 'product_inquiry_email_message_guest_en',
				'type' => 'wysiwyg',
				'instructions' => 'Email tags: [name], [phone], [email], [product_id], [product_name], [product_size], [product_material], [product_quantity], [message], [product_link]',
				'default_value' => '<div style="max-width: 800px; margin: 0 auto; background: #ffffff; font-family: Arial, sans-serif; border: 1px solid #e1e1e1;">
    <!-- Header -->
    <table style="background: #dc9814; color: #ffffff; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="font-size: 18px; font-weight: normal;" valign="middle">
                    <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-left: 10px; color: #ffffff; font-size: 20px; font-weight: bold;">PhotoVault</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="font-size: 14px; color: #ffffff;" align="right" valign="middle"><strong>Premium Print Service</strong></td>
            </tr>
        </tbody>
    </table>
    <!-- Greeting Alert Box -->
    <table style="background: linear-gradient(135deg, #fdf8ee 0%, #fffdf9 100%); border: 1px solid #f9e3b4; border-radius: 8px; margin: 20px; padding: 25px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-right: 15px; width: 40px; text-align: center;" valign="top">
                                    <p style="font-size: 40px; margin: 0;">📸</p>
                                </td>
                                <td>
                                    <h3 style="color: #8a5e00; margin: 0 0 10px; font-size: 20px; font-weight: bold;">Dear Mr./Ms. [name],</h3>
                                    <p style="color: #5c3e00; font-size: 15px; line-height: 1.6; margin: 0 0 10px;"><strong>Warm greetings from PhotoVault!</strong></p>
                                    <p style="color: #5c3e00; font-size: 15px; line-height: 1.6; margin: 0;">Thank you for choosing PhotoVault for printing your precious images. We have received your order inquiry with the following details:</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Contact Information -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Customer Information</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;" width="35%">Name</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[name]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Phone</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[phone]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Email</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;"><a style="color: #dc9814; text-decoration: none;" href="mailto:[email]">[email]</a></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Product Details -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Product Print Details</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[product_name]</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Message Section -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Customer Message</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <p style="color: #333333; font-size: 14px; line-height: 1.6; margin: 0;">[message]</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Response Notice -->
    <table style="background: #fff9eb; border-left: 4px solid #dc9814; border-radius: 4px; margin: 20px; padding: 15px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <h4 style="color: #8a5e00; margin: 0 0 10px; font-size: 15px; font-weight: bold;">📢 Notice:</h4>
                    <p style="color: #5c3e00; font-size: 13px; line-height: 1.7; margin: 0;">• Our print technicians will review your photo file, check dimensions, and contact you with a quote within <strong>24 business hours</strong>.<br>• Please make sure to check your inbox (as well as spam/junk folder) for updates.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Footer -->
    <table style="margin: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="text-align: center; color: #6c757d; font-size: 12px; line-height: 1.6;">
                    <p style="margin-bottom: 8px;"><strong>Best regards,</strong></p>
                    <p style="margin-bottom: 8px; font-weight: bold; color: #495057; font-size: 14px;">PhotoVault Team</p>
                    <p style="margin-top: 15px; font-size: 11px; color: #95a5a6;">© 2026 PhotoVault. All rights reserved.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>',
			),
			array(
				'label' => __('Admin Message (EN)', 'onlysun'),
				'key' => 'product_inquiry_email_message_admin_en',
				'name' => 'product_inquiry_email_message_admin_en',
				'type' => 'wysiwyg',
				'instructions' => 'Email tags: [name], [phone], [email], [product_id], [product_name], [product_size], [product_material], [product_quantity], [message], [product_link]',
				'default_value' => '<div style="max-width: 800px; margin: 0 auto; background: #ffffff; font-family: Arial, sans-serif; border: 1px solid #e1e1e1;">
    <!-- Header -->
    <table style="background: #dc9814; color: #ffffff; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="font-size: 18px; font-weight: normal;" valign="middle">
                    <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-left: 10px; color: #ffffff; font-size: 20px; font-weight: bold;">PhotoVault Admin</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="font-size: 14px; color: #ffffff;" align="right" valign="middle"><strong>New Request Received</strong></td>
            </tr>
        </tbody>
    </table>
    <!-- Greeting Alert Box -->
    <table style="background: linear-gradient(135deg, #fdf8ee 0%, #fffdf9 100%); border: 1px solid #f9e3b4; border-radius: 8px; margin: 20px; padding: 25px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="padding-right: 15px; width: 40px; text-align: center;" valign="top">
                                    <p style="font-size: 40px; margin: 0;">🔔</p>
                                </td>
                                <td>
                                    <h3 style="color: #8a5e00; margin: 0 0 10px; font-size: 20px; font-weight: bold;">New print inquiry from [name]</h3>
                                    <p style="color: #5c3e00; font-size: 15px; line-height: 1.6; margin: 0;">The system has logged a new print order/consultation request with the following details:</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Contact Information -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Customer Information</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;" width="35%">Name</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[name]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Phone</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[phone]</td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px; color: #6c757d; text-transform: uppercase;">Email</td>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;"><a style="color: #dc9814; text-decoration: none;" href="mailto:[email]">[email]</a></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Product Details -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Product Print Details</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <table border="0" width="100%" cellspacing="0" cellpadding="8">
                        <tbody>
                            <tr>
                                <td style="font-weight: bold; color: #333333; font-size: 14px;">[product_name]</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Message Section -->
    <table style="background: #f8f9fa; border-radius: 8px; margin: 20px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="background: #e9ecef; padding: 12px; font-weight: bold; color: #495057; border-bottom: 1px solid #dee2e6; font-size: 15px;">Customer Message</td>
            </tr>
            <tr>
                <td style="padding: 15px; background: #ffffff;">
                    <p style="color: #333333; font-size: 14px; line-height: 1.6; margin: 0;">[message]</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Response Notice -->
    <table style="background: #fff9eb; border-left: 4px solid #dc9814; border-radius: 4px; margin: 20px; padding: 15px; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <h4 style="color: #8a5e00; margin: 0 0 10px; font-size: 15px; font-weight: bold;">📢 Instructions for Admin:</h4>
                    <p style="color: #5c3e00; font-size: 13px; line-height: 1.7; margin: 0;">• Please contact the customer via phone: <strong>[phone]</strong> or email: <strong>[email]</strong> to follow up.<br>• This inquiry is also recorded in the <strong>Product Inquiries</strong> Dashboard menu.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Footer -->
    <table style="margin: 20px; padding: 20px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6; width: calc(100% - 40px);" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="text-align: center; color: #6c757d; font-size: 12px; line-height: 1.6;">
                    <p style="margin-bottom: 8px; font-weight: bold; color: #495057; font-size: 14px;">PhotoVault System Notification</p>
                    <p style="margin-top: 15px; font-size: 11px; color: #95a5a6;">© 2026 PhotoVault. All rights reserved.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'email-notification',
				),
			),
		),
	));
}