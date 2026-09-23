<?php
/**
 * Multilingual support system for Expo Lead Theme.
 * Supported languages: Vietnamese (vi - default), English (en), Japanese (ja).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns supported languages configuration.
 *
 * @return array
 */
function expo_supported_languages() {
	return array(
		'en' => array(
			'code'        => 'en',
			'locale'      => 'en_US',
			'html_lang'   => 'en-US',
			'label'       => 'English',
			'short_label' => 'EN',
			'flag'        => '🇬🇧',
		),
		'vi' => array(
			'code'        => 'vi',
			'locale'      => 'vi_VN',
			'html_lang'   => 'vi-VN',
			'label'       => 'Tiếng Việt',
			'short_label' => 'VI',
			'flag'        => '🇻🇳',
		),
		'ja' => array(
			'code'        => 'ja',
			'locale'      => 'ja',
			'html_lang'   => 'ja',
			'label'       => '日本語',
			'short_label' => 'JA',
			'flag'        => '🇯🇵',
		),
	);
}

/**
 * Detects the current active language.
 * Priority: 1. URL query arg 'lang' -> 2. Cookie 'expo_lang' -> 3. Default 'en'
 *
 * @return string Language code ('en', 'vi', or 'ja')
 */
function expo_get_current_lang() {
	static $current_lang = null;
	if ( null !== $current_lang ) {
		return $current_lang;
	}

	$supported = expo_supported_languages();

	// 1. Check GET query param
	if ( isset( $_GET['lang'] ) ) {
		$req_lang = sanitize_key( wp_unslash( $_GET['lang'] ) );
		if ( isset( $supported[ $req_lang ] ) ) {
			$current_lang = $req_lang;
			return $current_lang;
		}
	}

	// 2. Check POST param (e.g. AJAX submission)
	if ( isset( $_POST['expo_lang'] ) ) {
		$post_lang = sanitize_key( wp_unslash( $_POST['expo_lang'] ) );
		if ( isset( $supported[ $post_lang ] ) ) {
			$current_lang = $post_lang;
			return $current_lang;
		}
	}

	// 3. Check Cookie
	if ( isset( $_COOKIE['expo_lang'] ) ) {
		$cookie_lang = sanitize_key( wp_unslash( $_COOKIE['expo_lang'] ) );
		if ( isset( $supported[ $cookie_lang ] ) ) {
			$current_lang = $cookie_lang;
			return $current_lang;
		}
	}

	// 4. Default fallback: English
	$current_lang = 'en';
	return $current_lang;
}

/**
 * Handles cookie setting when lang parameter is passed in URL.
 */
function expo_handle_lang_cookie() {
	if ( isset( $_GET['lang'] ) ) {
		$req_lang  = sanitize_key( wp_unslash( $_GET['lang'] ) );
		$supported = expo_supported_languages();
		if ( isset( $supported[ $req_lang ] ) ) {
			if ( ! isset( $_COOKIE['expo_lang'] ) || $_COOKIE['expo_lang'] !== $req_lang ) {
				// Cookie lasts for 1 year
				setcookie( 'expo_lang', $req_lang, time() + ( 365 * DAY_IN_SECONDS ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, is_ssl(), false );
				$_COOKIE['expo_lang'] = $req_lang;
			}
		}
	}
}
add_action( 'init', 'expo_handle_lang_cookie' );

/**
 * Adjust HTML language attributes according to selected language.
 */
function expo_filter_language_attributes( $output ) {
	$lang = expo_get_current_lang();
	$supported = expo_supported_languages();
	if ( isset( $supported[ $lang ] ) ) {
		return 'lang="' . esc_attr( $supported[ $lang ]['html_lang'] ) . '"';
	}
	return $output;
}
add_filter( 'language_attributes', 'expo_filter_language_attributes' );

/**
 * Adjust WordPress locale according to current language.
 */
function expo_filter_locale( $locale ) {
	$lang = expo_get_current_lang();
	$supported = expo_supported_languages();
	if ( isset( $supported[ $lang ] ) ) {
		return $supported[ $lang ]['locale'];
	}
	return $locale;
}
add_filter( 'locale', 'expo_filter_locale' );

/**
 * Build URL for switching language.
 *
 * @param string $lang_code
 * @return string
 */
function expo_get_lang_url( $lang_code ) {
	return add_query_arg( 'lang', $lang_code );
}

/**
 * Master dictionary of translations.
 *
 * @return array
 */
function expo_get_translations_map() {
	return array(
		// ================= HEADER & NAV =================
		'brand_alt' => array(
			'vi' => 'SmileTrip - Smile trip, Smile life',
			'en' => 'SmileTrip - Smile trip, Smile life',
			'ja' => 'SmileTrip - Smile trip, Smile life',
		),
		'brand_aria' => array(
			'vi' => 'SmileTrip - Trang chủ',
			'en' => 'SmileTrip - Home',
			'ja' => 'SmileTrip - ホーム',
		),
		'nav_home' => array(
			'vi' => 'Trang chủ',
			'en' => 'Home',
			'ja' => 'ホーム',
		),
		'nav_about' => array(
			'vi' => 'Về chúng tôi',
			'en' => 'About Us',
			'ja' => '会社概要',
		),
		'nav_services' => array(
			'vi' => 'Dịch vụ',
			'en' => 'Services',
			'ja' => 'サービス',
		),
		'nav_contact' => array(
			'vi' => 'Liên hệ',
			'en' => 'Contact',
			'ja' => 'お問い合わせ',
		),
		'cta_explore' => array(
			'vi' => 'Khám phá ngay',
			'en' => 'Explore Now',
			'ja' => '今すぐ発見',
		),

		// ================= HERO =================
		'hero_eyebrow' => array(
			'vi' => 'EXPO SMILETRIP',
			'en' => 'EXPO SMILETRIP',
			'ja' => 'EXPO SMILETRIP',
		),
		'hero_title_line1' => array(
			'vi' => 'Liên hệ với chúng tôi',
			'en' => 'Connect With Us',
			'ja' => 'お問い合わせ',
		),
		'hero_title_line2' => array(
			'vi' => 'Để hành trình của bạn',
			'en' => 'To Make Your Journey',
			'ja' => 'あなたの旅を',
		),
		'hero_title_highlight' => array(
			'vi' => 'trọn vẹn hơn',
			'en' => 'More Complete',
			'ja' => 'より豊かに',
		),
		'hero_desc' => array(
			'vi' => 'Hãy chia sẻ nhu cầu của bạn, đội ngũ Expo SmileTrip sẵn sàng lắng nghe và tư vấn, mang đến những giải pháp du lịch phù hợp nhất.',
			'en' => 'Share your travel needs with us. The Expo SmileTrip team is ready to listen, consult, and provide the most suitable travel solutions.',
			'ja' => 'ご要望をお聞かせください。Expo SmileTripチームが親身にお伺いし、最適な旅行プランをご提案いたします。',
		),
		'feat_fast_title' => array(
			'vi' => 'Nhanh chóng',
			'en' => 'Fast & Prompt',
			'ja' => '迅速な対応',
		),
		'feat_fast_sub' => array(
			'vi' => 'Phản hồi sớm nhất',
			'en' => 'Quickest response',
			'ja' => 'スピーディーに返答',
		),
		'feat_conv_title' => array(
			'vi' => 'Thuận tiện',
			'en' => 'Convenient',
			'ja' => '便利・スムーズ',
		),
		'feat_conv_sub' => array(
			'vi' => 'Dễ dàng kết nối',
			'en' => 'Seamless connection',
			'ja' => '手軽にコンタクト',
		),
		'feat_ded_title' => array(
			'vi' => 'Tận tâm',
			'en' => 'Dedicated',
			'ja' => '誠心誠意',
		),
		'feat_ded_sub' => array(
			'vi' => 'Đồng hành cùng bạn',
			'en' => 'Always by your side',
			'ja' => '旅に寄り添うサポート',
		),

		// ================= CONTACT INFO =================
		'contact_label' => array(
			'vi' => 'THÔNG TIN LIÊN HỆ',
			'en' => 'CONTACT INFORMATION',
			'ja' => 'お問い合わせ先',
		),
		'contact_heading' => array(
			'vi' => 'Chúng tôi luôn sẵn sàng<br>hỗ trợ bạn',
			'en' => 'We are always ready<br>to support you',
			'ja' => 'いつでもお気軽に<br>ご相談ください',
		),
		'contact_desc' => array(
			'vi' => 'Dù bạn có câu hỏi, cần tư vấn tour hay hợp tác cùng chúng tôi, đừng ngần ngại liên hệ. Expo SmileTrip sẽ phản hồi trong thời gian sớm nhất.',
			'en' => 'Whether you have questions, need tour consultation, or wish to partner with us, do not hesitate to reach out. Expo SmileTrip will respond promptly.',
			'ja' => 'ご質問やツアーのご相談、業務提携についてなど、お気軽にお問い合わせください。Expo SmileTripより迅速にご連絡いたします。',
		),
		'hotline_label' => array(
			'vi' => 'Hotline',
			'en' => 'Hotline',
			'ja' => 'ホットライン',
		),
		'email_label' => array(
			'vi' => 'Email',
			'en' => 'Email',
			'ja' => 'メール',
		),
		'address_label' => array(
			'vi' => 'Địa chỉ',
			'en' => 'Address',
			'ja' => '所在地',
		),
		'address_value' => array(
			'vi' => 'Tầng 10, Geleximco Building, 36 Hoàng Cầu, <br>Phường Ô Chợ Dừa, Hà Nội, Việt Nam',
			'en' => '10th Floor, Geleximco Building, 36 Hoang Cau, <br>O Cho Dua Ward, Hanoi, Vietnam',
			'ja' => 'ベトナム ハノイ市 オーチョードゥア街区 ホアンカウ36<br>ゲレキシムコビル 10階',
		),

		// 3 Branch Locations
		'contact_branch_jp_title' => array(
			'vi' => 'Trụ sở chính tại Nhật Bản',
			'en' => 'Head Office in Japan',
			'ja' => '日本本社',
		),
		'contact_city_osaka' => array(
			'vi' => 'Osaka:',
			'en' => 'Osaka:',
			'ja' => '大阪:',
		),
		'contact_addr_osaka' => array(
			'vi' => 'Ookini Higashishinsaibashi Building 303, 1-13-3 Shimanouchi, Chuo-ku, Osaka-shi, Osaka-fu 542-0082',
			'en' => 'Ookini Higashishinsaibashi Building 303, 1-13-3 Shimanouchi, Chuo-ku, Osaka-shi, Osaka-fu 542-0082',
			'ja' => '〒542-0082 大阪府大阪市中央区島之内1-13-3 おおきに東心斎橋ビル 303',
		),

		'contact_branch_vn_title' => array(
			'vi' => 'Việt Nam',
			'en' => 'Vietnam',
			'ja' => 'ベトナム',
		),
		'contact_city_hanoi' => array(
			'vi' => 'Hà Nội:',
			'en' => 'Hanoi:',
			'ja' => 'ハノイ:',
		),
		'contact_addr_hanoi' => array(
			'vi' => 'Tầng 10, Geleximco Building, 36 Hoàng Cầu, Phường Ô Chợ Dừa',
			'en' => '10th Floor, Geleximco Building, 36 Hoang Cau Street, O Cho Dua Ward',
			'ja' => 'オチョドゥア街区 ホアンカウ通り36 ゲレキシムコビル 10階',
		),
		'contact_city_hcm' => array(
			'vi' => 'TP. Hồ Chí Minh:',
			'en' => 'Ho Chi Minh City:',
			'ja' => 'ホーチミン:',
		),
		'contact_addr_hcm' => array(
			'vi' => 'Tầng 8, Qunimex Building, 18 Nguyễn Thị Diệu, Phường Xuân Hòa',
			'en' => '8th Floor, Qunimex Building, 18 Nguyen Thi Dieu Street, Xuan Hoa Ward',
			'ja' => 'スアンホア街区 グエンティジウ通り18 クニメックスビル 8階',
		),

		'contact_branch_fr_title' => array(
			'vi' => 'Pháp',
			'en' => 'France',
			'ja' => 'フランス',
		),
		'contact_city_paris' => array(
			'vi' => 'Paris:',
			'en' => 'Paris:',
			'ja' => 'パリ:',
		),
		'contact_addr_paris' => array(
			'vi' => '238 Rue de Charenton, 75012 Paris',
			'en' => '238 Rue de Charenton, 75012 Paris',
			'ja' => '238 Rue de Charenton, 75012 パリ',
		),

		'contact_tel_label' => array(
			'vi' => 'Tel:',
			'en' => 'Tel:',
			'ja' => 'TEL:',
		),
		'contact_email_label' => array(
			'vi' => 'Email:',
			'en' => 'Email:',
			'ja' => 'Email:',
		),
		'social_title' => array(
			'vi' => 'Kết nối với chúng tôi',
			'en' => 'Connect with us',
			'ja' => '公式SNS',
		),
		'note_line1' => array(
			'vi' => 'Khám phá',
			'en' => 'Discover',
			'ja' => '笑顔で巡る',
		),
		'note_line2' => array(
			'vi' => 'Thế giới cùng',
			'en' => 'The world with',
			'ja' => '素晴らしい',
		),
		'note_line3' => array(
			'vi' => 'nụ cười !',
			'en' => 'a smile !',
			'ja' => '世界の旅！',
		),

		// ================= FORM =================
		'form_title' => array(
			'vi' => 'Gửi cho chúng tôi tin nhắn',
			'en' => 'Send Us a Message',
			'ja' => 'メッセージを送信',
		),
		'form_subtitle' => array(
			'vi' => 'Vui lòng điền đầy đủ thông tin, chúng tôi sẽ liên hệ lại sớm nhất.',
			'en' => 'Please fill in all details, we will get in touch with you shortly.',
			'ja' => '必要事項をご入力ください。担当者より折り返しご連絡いたします。',
		),
		'field_name' => array(
			'vi' => 'Họ và tên',
			'en' => 'Full Name',
			'ja' => 'お名前（氏名）',
		),
		'field_name_ph' => array(
			'vi' => 'Nhập họ và tên của bạn',
			'en' => 'Enter your full name',
			'ja' => 'お名前を入力してください',
		),
		'field_email' => array(
			'vi' => 'Email',
			'en' => 'Email',
			'ja' => 'メールアドレス',
		),
		'field_email_ph' => array(
			'vi' => 'Nhập địa chỉ email',
			'en' => 'Enter your email address',
			'ja' => 'メールアドレスを入力してください',
		),
		'field_phone' => array(
			'vi' => 'Số điện thoại',
			'en' => 'Phone Number',
			'ja' => '電話番号',
		),
		'field_phone_ph' => array(
			'vi' => 'Nhập số điện thoại',
			'en' => 'Enter your phone number',
			'ja' => '電話番号を入力してください',
		),
		'field_service' => array(
			'vi' => 'Dịch vụ quan tâm',
			'en' => 'Service of Interest',
			'ja' => 'ご希望のサービス',
		),
		'field_service_select' => array(
			'vi' => 'Chọn dịch vụ',
			'en' => 'Select a service',
			'ja' => 'サービスを選択してください',
		),

		// Service Options (Updated according to SmileTrip services)
		'svc_tour_service' => array(
			'vi' => 'Tour du lịch (Tour Service)',
			'en' => 'Tour Service',
			'ja' => 'ツアー手配 (Tour Service)',
		),
		'svc_flight_tickets' => array(
			'vi' => 'Vé máy bay (Flight Tickets)',
			'en' => 'Flight Tickets',
			'ja' => '航空券手配 (Flight Tickets)',
		),
		'svc_car_rental' => array(
			'vi' => 'Thuê xe (Car Rental)',
			'en' => 'Car Rental',
			'ja' => 'レンタカー (Car Rental)',
		),
		'svc_visa' => array(
			'vi' => 'Visa',
			'en' => 'Visa',
			'ja' => 'ビザ手配 (Visa)',
		),
		'svc_hotel_booking' => array(
			'vi' => 'Đặt khách sạn (Hotel Booking)',
			'en' => 'Hotel Booking',
			'ja' => 'ホテル予約 (Hotel Booking)',
		),
		'svc_fast_track' => array(
			'vi' => 'Dịch vụ Fast Track',
			'en' => 'Fast Track',
			'ja' => 'ファストトラック (Fast Track)',
		),
		'svc_esim' => array(
			'vi' => 'eSIM',
			'en' => 'eSIM',
			'ja' => 'eSIM',
		),
		'svc_travel_insurance' => array(
			'vi' => 'Bảo hiểm du lịch (Travel Insurance)',
			'en' => 'Travel Insurance',
			'ja' => '旅行保険 (Travel Insurance)',
		),
		'svc_other' => array(
			'vi' => 'Khác',
			'en' => 'Other',
			'ja' => 'その他',
		),

		'field_message' => array(
			'vi' => 'Nội dung tin nhắn',
			'en' => 'Message',
			'ja' => 'お問い合わせ内容',
		),
		'field_message_ph' => array(
			'vi' => 'Bạn muốn chia sẻ điều gì?',
			'en' => 'What would you like to share?',
			'ja' => 'ご要望やご質問などをご記入ください',
		),
		'btn_submit' => array(
			'vi' => 'GỬI TIN NHẮN',
			'en' => 'SEND MESSAGE',
			'ja' => '送信する',
		),
		'btn_sending' => array(
			'vi' => 'Đang gửi...',
			'en' => 'Sending...',
			'ja' => '送信中...',
		),
		'privacy_note' => array(
			'vi' => 'Thông tin của bạn được bảo mật và chỉ sử dụng để liên hệ.',
			'en' => 'Your information is confidential and used solely for contact purposes.',
			'ja' => 'お客様の個人情報は厳重に管理され、お問い合わせ対応のみに使用されます。',
		),

		// ================= STATUS & ALERTS =================
		'notice_success' => array(
			'vi' => 'Cảm ơn bạn. Thông tin đã được gửi thành công.',
			'en' => 'Thank you. Your information has been submitted successfully.',
			'ja' => 'ありがとうございます。お問い合わせを送信いたしました。',
		),
		'notice_invalid' => array(
			'vi' => 'Vui lòng kiểm tra lại các trường bắt buộc và địa chỉ email.',
			'en' => 'Please check all required fields and your email address.',
			'ja' => '必須項目およびメールアドレスをご確認ください。',
		),
		'notice_error' => array(
			'vi' => 'Không thể gửi thông tin lúc này. Vui lòng thử lại.',
			'en' => 'Unable to submit information right now. Please try again.',
			'ja' => '現在送信できません。しばらく経ってから再度お試しください。',
		),
		'notice_conn_error' => array(
			'vi' => 'Có lỗi xảy ra khi kết nối. Vui lòng thử lại sau.',
			'en' => 'A connection error occurred. Please try again later.',
			'ja' => '通信エラーが発生しました。時間をおいて再度お試しください。',
		),
		'ajax_success' => array(
			'vi' => 'Cảm ơn bạn! Thông tin của bạn đã được gửi thành công. Đội ngũ Expo SmileTrip sẽ liên hệ lại sớm nhất.',
			'en' => 'Thank you! Your information has been submitted successfully. Expo SmileTrip team will contact you shortly.',
			'ja' => 'ありがとうございます！お問い合わせを正常に受け付けました。Expo SmileTripチームより折り返しご連絡いたします。',
		),

		// Validation errors
		'err_nonce' => array(
			'vi' => 'Mã xác thực không hợp lệ. Vui lòng làm mới trang và thử lại.',
			'en' => 'Security token is invalid. Please refresh the page and try again.',
			'ja' => 'セキュリティトークンが無効です。ページを更新して再度お試しください。',
		),
		'err_name' => array(
			'vi' => 'Vui lòng nhập Họ và tên của bạn.',
			'en' => 'Please enter your full name.',
			'ja' => 'お名前を入力してください。',
		),
		'err_email' => array(
			'vi' => 'Vui lòng nhập địa chỉ Email.',
			'en' => 'Please enter your email address.',
			'ja' => 'メールアドレスを入力してください。',
		),
		'err_email_format' => array(
			'vi' => 'Địa chỉ Email không đúng định dạng.',
			'en' => 'Invalid email address format.',
			'ja' => 'メールアドレスの形式が正しくありません。',
		),
		'err_phone' => array(
			'vi' => 'Vui lòng nhập Số điện thoại.',
			'en' => 'Please enter your phone number.',
			'ja' => '電話番号を入力してください。',
		),
		'err_phone_format' => array(
			'vi' => 'Số điện thoại không hợp lệ (từ 9 đến 15 chữ số).',
			'en' => 'Invalid phone number (must be 9 to 15 digits).',
			'ja' => '電話番号が無効です（9〜15桁の数字）。',
		),
		'err_service' => array(
			'vi' => 'Vui lòng chọn dịch vụ bạn quan tâm.',
			'en' => 'Please select a service of interest.',
			'ja' => 'ご希望のサービスを選択してください。',
		),

		// ================= FOOTER =================
		'footer_rights' => array(
			'vi' => '© 2026 Expo SmileTrip. All rights reserved.',
			'en' => '© 2026 Expo SmileTrip. All rights reserved.',
			'ja' => '© 2026 Expo SmileTrip. All rights reserved.',
		),
		'footer_privacy' => array(
			'vi' => 'Chính sách bảo mật',
			'en' => 'Privacy Policy',
			'ja' => 'プライバシーポリシー',
		),
		'footer_terms' => array(
			'vi' => 'Điều khoản sử dụng',
			'en' => 'Terms of Use',
			'ja' => '利用規約',
		),
		'footer_contact' => array(
			'vi' => 'Liên hệ',
			'en' => 'Contact Us',
			'ja' => 'お問い合わせ',
		),
	);
}

/**
 * Returns translated string for given key.
 *
 * @param string      $key
 * @param string|null $lang
 * @return string
 */
function expo_t( $key, $lang = null ) {
	if ( null === $lang ) {
		$lang = expo_get_current_lang();
	}

	$map = expo_get_translations_map();

	if ( isset( $map[ $key ] ) ) {
		if ( isset( $map[ $key ][ $lang ] ) ) {
			return $map[ $key ][ $lang ];
		}
		if ( isset( $map[ $key ]['en'] ) ) {
			return $map[ $key ]['en'];
		}
		if ( isset( $map[ $key ]['vi'] ) ) {
			return $map[ $key ]['vi'];
		}
	}

	return $key;
}

/**
 * Returns array of services localized.
 *
 * @param string|null $lang
 * @return array Array of [ 'value' => '...', 'label' => '...' ]
 */
function expo_get_localized_services( $lang = null ) {
	if ( null === $lang ) {
		$lang = expo_get_current_lang();
	}
	return array(
		array(
			'value' => expo_t( 'svc_tour_service', $lang ),
			'label' => expo_t( 'svc_tour_service', $lang ),
		),
		array(
			'value' => expo_t( 'svc_flight_tickets', $lang ),
			'label' => expo_t( 'svc_flight_tickets', $lang ),
		),
		array(
			'value' => expo_t( 'svc_car_rental', $lang ),
			'label' => expo_t( 'svc_car_rental', $lang ),
		),
		array(
			'value' => expo_t( 'svc_visa', $lang ),
			'label' => expo_t( 'svc_visa', $lang ),
		),
		array(
			'value' => expo_t( 'svc_hotel_booking', $lang ),
			'label' => expo_t( 'svc_hotel_booking', $lang ),
		),
		array(
			'value' => expo_t( 'svc_fast_track', $lang ),
			'label' => expo_t( 'svc_fast_track', $lang ),
		),
		array(
			'value' => expo_t( 'svc_esim', $lang ),
			'label' => expo_t( 'svc_esim', $lang ),
		),
		array(
			'value' => expo_t( 'svc_travel_insurance', $lang ),
			'label' => expo_t( 'svc_travel_insurance', $lang ),
		),
		array(
			'value' => expo_t( 'svc_other', $lang ),
			'label' => expo_t( 'svc_other', $lang ),
		),
	);
}

/**
 * Returns translations needed for frontend JavaScript.
 *
 * @param string|null $lang
 * @return array
 */
function expo_get_js_translations( $lang = null ) {
	if ( null === $lang ) {
		$lang = expo_get_current_lang();
	}
	return array(
		'lang'              => $lang,
		'btn_submit'        => expo_t( 'btn_submit', $lang ),
		'btn_sending'       => expo_t( 'btn_sending', $lang ),
		'notice_conn_error' => expo_t( 'notice_conn_error', $lang ),
	);
}
