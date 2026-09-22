<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Caveat:wght@500;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- HEADER -->
  <header class="header">
    <div class="container nav">
      <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="SmileTrip - Trang chủ">
        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/smiletrip-logo-new.png' ) ); ?>" alt="SmileTrip - Smile trip, Smile life">
      </a>

      <nav class="menu">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
        <a href="#about">Về chúng tôi</a>
        <a href="#services">Dịch vụ</a>
        <a class="active" href="#lien-he">Liên hệ</a>
      </nav>

      <div class="header-actions">
        <a class="header-btn" href="#lien-he">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
          </svg>
          <span>Khám phá ngay</span>
        </a>

        <div class="lang-selector" tabindex="0">
          <span class="flag-icon">🇻🇳</span>
          <span class="lang-code">VI</span>
          <svg class="chevron" width="10" height="6" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 1l4 4 4-4"/>
          </svg>
        </div>
      </div>
    </div>
  </header>
