<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$current_lang = function_exists( 'expo_get_current_lang' ) ? expo_get_current_lang() : 'en';
$languages    = function_exists( 'expo_supported_languages' ) ? expo_supported_languages() : array();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'lang-' . esc_attr( $current_lang ) ); ?>>
<?php wp_body_open(); ?>

  <!-- HEADER -->
  <header class="header container">
    <div class="nav">
      <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( expo_t( 'brand_aria' ) ); ?>">
        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/smiletrip-logo.png' ) ); ?>" alt="<?php echo esc_attr( expo_t( 'brand_alt' ) ); ?>">
      </a>

      <nav class="menu">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( expo_t( 'nav_home' ) ); ?></a>
        <a href="#about"><?php echo esc_html( expo_t( 'nav_about' ) ); ?></a>
        <a href="#services"><?php echo esc_html( expo_t( 'nav_services' ) ); ?></a>
        <a class="active" href="#lien-he"><?php echo esc_html( expo_t( 'nav_contact' ) ); ?></a>
      </nav>

      <div class="header-actions">
        <a class="header-btn" href="#lien-he">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
          </svg>
          <span><?php echo esc_html( expo_t( 'cta_explore' ) ); ?></span>
        </a>

        <div class="lang-dropdown-wrapper" id="langDropdownWrapper">
          <button type="button" class="lang-selector" id="langSelectorBtn" aria-haspopup="true" aria-expanded="false" aria-label="Select Language">
            <span class="flag-icon"><?php echo esc_html( isset( $languages[ $current_lang ]['flag'] ) ? $languages[ $current_lang ]['flag'] : '🇻🇳' ); ?></span>
            <span class="lang-code"><?php echo esc_html( isset( $languages[ $current_lang ]['short_label'] ) ? $languages[ $current_lang ]['short_label'] : 'VI' ); ?></span>
            <svg class="chevron" width="10" height="6" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 1l4 4 4-4"/>
            </svg>
          </button>
          <div class="lang-dropdown-menu" id="langDropdownMenu" role="menu">
            <?php foreach ( $languages as $code => $info ) : ?>
              <a href="<?php echo esc_url( expo_get_lang_url( $code ) ); ?>" class="lang-dropdown-item <?php echo $code === $current_lang ? 'active' : ''; ?>" role="menuitem" data-lang="<?php echo esc_attr( $code ); ?>">
                <span class="flag-icon"><?php echo esc_html( $info['flag'] ); ?></span>
                <span class="lang-title"><?php echo esc_html( $info['label'] ); ?></span>
                <span class="lang-badge"><?php echo esc_html( $info['short_label'] ); ?></span>
                <?php if ( $code === $current_lang ) : ?>
                  <svg class="lang-check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </header>
