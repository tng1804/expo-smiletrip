<?php
get_header();
$current_lang = function_exists( 'expo_get_current_lang' ) ? expo_get_current_lang() : 'en';
$status       = isset( $_GET['expo_status'] ) ? sanitize_key( wp_unslash( $_GET['expo_status'] ) ) : '';
?>
  <!-- HERO -->
  <section class="hero" style="background-image: url('<?php echo esc_url( get_theme_file_uri( 'assets/images/expo-smiletrip-hero.png' ) ); ?>')">
    <div class="container hero-content">
      <div class="hero-copy">
        <div class="eyebrow"><?php echo esc_html( expo_t( 'hero_eyebrow' ) ); ?></div>
        <h1>
          <?php echo esc_html( expo_t( 'hero_title_line1' ) ); ?><br>
          <span class="highlight-orange">
            <?php echo esc_html( expo_t( 'hero_title_line2' ) ); ?><br>
            <span class="line-plane-wrap">
              <?php echo esc_html( expo_t( 'hero_title_highlight' ) ); ?>
              <svg class="title-plane-svg" viewBox="0 0 90 35" fill="none">
                <path d="M5 28 Q 45 5, 80 18" stroke="#f55223" stroke-width="2" stroke-dasharray="4 4"/>
                <path d="M78 12 L87 18 L77 24 Z" fill="#f55223"/>
              </svg>
            </span>
          </span>
        </h1>
        <p class="hero-description">
          <?php echo esc_html( expo_t( 'hero_desc' ) ); ?>
        </p>

        <!-- 3 Feature Badges -->
        <div class="hero-features">
          <div class="feature-item">
            <div class="feature-icon feature-icon--orange">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h7v8l10-12h-7z"/></svg>
            </div>
            <div class="feature-text">
              <strong><?php echo esc_html( expo_t( 'feat_fast_title' ) ); ?></strong>
              <span><?php echo esc_html( expo_t( 'feat_fast_sub' ) ); ?></span>
            </div>
          </div>

          <div class="feature-item">
            <div class="feature-icon feature-icon--blue">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.58 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2z"/></svg>
            </div>
            <div class="feature-text">
              <strong><?php echo esc_html( expo_t( 'feat_conv_title' ) ); ?></strong>
              <span><?php echo esc_html( expo_t( 'feat_conv_sub' ) ); ?></span>
            </div>
          </div>

          <div class="feature-item">
            <div class="feature-icon feature-icon--green">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div class="feature-text">
              <strong><?php echo esc_html( expo_t( 'feat_ded_title' ) ); ?></strong>
              <span><?php echo esc_html( expo_t( 'feat_ded_sub' ) ); ?></span>
            </div>
          </div>
        </div>
      </div>
      <!-- Right side is rendered by the banner background image -->
      <div class="hero-banner-spacer" aria-hidden="true"></div>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <main class="contact" id="lien-he">
    <div class="container contact-grid">

      <!-- CONTACT INFO -->
      <section class="contact-info">
        <div class="section-label"><?php echo esc_html( expo_t( 'contact_label' ) ); ?></div>

        <h2><?php echo wp_kses( expo_t( 'contact_heading' ), array( 'br' => array() ) ); ?></h2>

        <p>
          <?php echo esc_html( expo_t( 'contact_desc' ) ); ?>
        </p>

        <div class="contact-branches">

          <!-- Branch 1: Japan -->
          <div class="contact-branch-card">
            <div class="branch-header">
              <h3 class="branch-title"><?php echo esc_html( expo_t( 'contact_branch_jp_title' ) ); ?></h3>
              <span class="branch-flag" aria-label="Japan">🇯🇵</span>
            </div>
            <div class="branch-location">
              <span class="branch-city"><?php echo esc_html( expo_t( 'contact_city_osaka' ) ); ?></span>
              <span class="branch-addr"><?php echo esc_html( expo_t( 'contact_addr_osaka' ) ); ?></span>
            </div>
            <div class="branch-meta">
              <span class="branch-meta-item">
                <span class="meta-label"><?php echo esc_html( expo_t( 'contact_tel_label' ) ); ?></span>
                <a href="tel:+81678604755">(+81) 6-7860-4755</a>
              </span>
              <span class="branch-meta-sep">|</span>
              <span class="branch-meta-item">
                <span class="meta-label"><?php echo esc_html( expo_t( 'contact_email_label' ) ); ?></span>
                <a href="mailto:landtour@smiletrip.jp">landtour@smiletrip.jp</a>
              </span>
            </div>
          </div>

          <!-- Branch 2: Vietnam -->
          <div class="contact-branch-card">
            <div class="branch-header">
              <h3 class="branch-title"><?php echo esc_html( expo_t( 'contact_branch_vn_title' ) ); ?></h3>
              <span class="branch-flag" aria-label="Vietnam">🇻🇳</span>
            </div>

            <!-- Hanoi -->
            <div class="branch-sub-item">
              <div class="branch-location">
                <span class="branch-city"><?php echo esc_html( expo_t( 'contact_city_hanoi' ) ); ?></span>
                <span class="branch-addr"><?php echo esc_html( expo_t( 'contact_addr_hanoi' ) ); ?></span>
              </div>
              <div class="branch-meta">
                <span class="branch-meta-item">
                  <span class="meta-label"><?php echo esc_html( expo_t( 'contact_tel_label' ) ); ?></span>
                  <a href="tel:+84934592320">(+84) 934-592-320</a>
                </span>
                <span class="branch-meta-sep">|</span>
                <span class="branch-meta-item">
                  <span class="meta-label"><?php echo esc_html( expo_t( 'contact_email_label' ) ); ?></span>
                  <a href="mailto:air.ticket@smiletrip.vn">air.ticket@smiletrip.vn</a>
                </span>
              </div>
            </div>

            <div class="branch-sub-divider"></div>

            <!-- Ho Chi Minh City -->
            <div class="branch-sub-item">
              <div class="branch-location">
                <span class="branch-city"><?php echo esc_html( expo_t( 'contact_city_hcm' ) ); ?></span>
                <span class="branch-addr"><?php echo esc_html( expo_t( 'contact_addr_hcm' ) ); ?></span>
              </div>
              <div class="branch-meta">
                <span class="branch-meta-item">
                  <span class="meta-label"><?php echo esc_html( expo_t( 'contact_tel_label' ) ); ?></span>
                  <a href="tel:+84777068807">(+84) 777-068-807</a>
                </span>
                <span class="branch-meta-sep">|</span>
                <span class="branch-meta-item">
                  <span class="meta-label"><?php echo esc_html( expo_t( 'contact_email_label' ) ); ?></span>
                  <a href="mailto:sgn@smiletrip.vn">sgn@smiletrip.vn</a>
                </span>
              </div>
            </div>
          </div>

          <!-- Branch 3: France -->
          <div class="contact-branch-card">
            <div class="branch-header">
              <h3 class="branch-title"><?php echo esc_html( expo_t( 'contact_branch_fr_title' ) ); ?></h3>
              <span class="branch-flag" aria-label="France">🇫🇷</span>
            </div>
            <div class="branch-location">
              <span class="branch-city"><?php echo esc_html( expo_t( 'contact_city_paris' ) ); ?></span>
              <span class="branch-addr"><?php echo esc_html( expo_t( 'contact_addr_paris' ) ); ?></span>
            </div>
            <div class="branch-meta">
              <span class="branch-meta-item">
                <span class="meta-label"><?php echo esc_html( expo_t( 'contact_tel_label' ) ); ?></span>
                <a href="tel:+33188484777">(+33) 188-484-777</a>
              </span>
              <span class="branch-meta-sep">|</span>
              <span class="branch-meta-item">
                <span class="meta-label"><?php echo esc_html( expo_t( 'contact_email_label' ) ); ?></span>
                <a href="mailto:contact@smiletrip.fr">contact@smiletrip.fr</a>
              </span>
            </div>
          </div>

        </div>
      </section>

      <!-- FORM CARD -->
      <section class="form-card">
        <div class="form-heading">
          <div class="form-heading-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <h3><?php echo esc_html( expo_t( 'form_title' ) ); ?></h3>
            <p><?php echo esc_html( expo_t( 'form_subtitle' ) ); ?></p>
          </div>
        </div>

        <form id="expoContactForm" class="expo-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
          <div id="expoNoticeContainer">
            <?php if ( 'success' === $status ) : ?>
                <div class="expo-notice expo-notice--success" role="status"><?php echo esc_html( expo_t( 'notice_success' ) ); ?></div>
            <?php elseif ( 'invalid' === $status ) : ?>
                <div class="expo-notice expo-notice--error" role="alert"><?php echo esc_html( expo_t( 'notice_invalid' ) ); ?></div>
            <?php elseif ( 'error' === $status ) : ?>
                <div class="expo-notice expo-notice--error" role="alert"><?php echo esc_html( expo_t( 'notice_error' ) ); ?></div>
            <?php endif; ?>
          </div>

          <input type="hidden" name="action" value="expo_lead_submit">
          <input type="hidden" name="expo_lang" value="<?php echo esc_attr( $current_lang ); ?>">
          <?php wp_nonce_field( 'expo_lead_submit', 'expo_lead_nonce' ); ?>
          <div class="expo-honeypot" aria-hidden="true">
              <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          </div>

          <div class="field">
            <label for="expo-name"><?php echo esc_html( expo_t( 'field_name' ) ); ?> <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </span>
              <input id="expo-name" name="name" type="text" placeholder="<?php echo esc_attr( expo_t( 'field_name_ph' ) ); ?>" required autocomplete="name">
            </div>
          </div>

          <div class="field">
            <label for="expo-email"><?php echo esc_html( expo_t( 'field_email' ) ); ?> <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </span>
              <input id="expo-email" name="email" type="email" placeholder="<?php echo esc_attr( expo_t( 'field_email_ph' ) ); ?>" required autocomplete="email">
            </div>
          </div>

          <div class="field">
            <label for="expo-phone"><?php echo esc_html( expo_t( 'field_phone' ) ); ?> <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </span>
              <input id="expo-phone" name="phone" type="tel" placeholder="<?php echo esc_attr( expo_t( 'field_phone_ph' ) ); ?>" required autocomplete="tel">
            </div>
          </div>

          <div class="field">
            <label for="expo-service"><?php echo esc_html( expo_t( 'field_service' ) ); ?> <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
              </span>
              <select id="expo-service" name="service" required>
                <option value=""><?php echo esc_html( expo_t( 'field_service_select' ) ); ?></option>
                <?php foreach ( expo_get_localized_services( $current_lang ) as $service_item ) : ?>
                  <option value="<?php echo esc_attr( $service_item['value'] ); ?>"><?php echo esc_html( $service_item['label'] ); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="field field--full">
            <label for="expo-message"><?php echo esc_html( expo_t( 'field_message' ) ); ?> <span class="required">*</span></label>
            <div class="input-with-icon input-with-icon--textarea">
              <span class="field-icon field-icon--textarea">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              </span>
              <textarea id="expo-message" name="message" maxlength="500" placeholder="<?php echo esc_attr( expo_t( 'field_message_ph' ) ); ?>" required></textarea>
            </div>
            <div class="char-count"><span id="msgCharCount">0</span>/500</div>
          </div>

          <button id="expoSubmitBtn" class="submit-btn" type="submit">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
            <span class="btn-text"><?php echo esc_html( expo_t( 'btn_submit' ) ); ?></span>
          </button>

          <p class="privacy">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block;vertical-align:middle;margin-right:3px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <?php echo esc_html( expo_t( 'privacy_note' ) ); ?>
          </p>
        </form>
      </section>

      <!-- FULL-WIDTH SOCIAL & BRAND BANNER -->
      <div class="contact-bottom-bar">
        <div class="bottom-bar-social">
          <div class="social-title"><?php echo esc_html( expo_t( 'social_title' ) ); ?></div>
          <div class="social-links-pill">
            <a href="https://www.facebook.com/SmileTripJapan" target="_blank" rel="noopener noreferrer" class="social-pill social-pill--fb" aria-label="Facebook">
              <span class="social-pill-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
              </span>
              <span class="social-pill-text">
                <strong class="pill-name">Facebook</strong>
                <span class="pill-handle">SmileTrip Japan</span>
              </span>
            </a>

            <a href="https://www.tiktok.com/@smiletripjapan" target="_blank" rel="noopener noreferrer" class="social-pill social-pill--tiktok" aria-label="TikTok">
              <span class="social-pill-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
              </span>
              <span class="social-pill-text">
                <strong class="pill-name">TikTok</strong>
                <span class="pill-handle">@smiletripjapan</span>
              </span>
            </a>

            <a href="https://zalo.me/+84934592320" target="_blank" rel="noopener noreferrer" class="social-pill social-pill--zalo" aria-label="Zalo">
              <span class="social-pill-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.49 10.2722v-.4496h1.3467v6.3218h-.7704a.576.576 0 01-.5763-.5729l-.0006.0005a3.273 3.273 0 01-1.9372.6321c-1.8138 0-3.2844-1.4697-3.2844-3.2823 0-1.8125 1.4706-3.2822 3.2844-3.2822a3.273 3.273 0 011.9372.6321l.0006.0005zM6.9188 7.7896v.205c0 .3823-.051.6944-.2995 1.0605l-.03.0343c-.0542.0615-.1815.206-.2421.2843L2.024 14.8h4.8948v.7682a.5764.5764 0 01-.5767.5761H0v-.3622c0-.4436.1102-.6414.2495-.8476L4.8582 9.23H.1922V7.7896h6.7266zm8.5513 8.3548a.4805.4805 0 01-.4803-.4798v-7.875h1.4416v8.3548H15.47zM20.6934 9.6C22.52 9.6 24 11.0807 24 12.9044c0 1.8252-1.4801 3.306-3.3066 3.306-1.8264 0-3.3066-1.4808-3.3066-3.306 0-1.8237 1.4802-3.3044 3.3066-3.3044zm-10.1412 5.253c1.0675 0 1.9324-.8645 1.9324-1.9312 0-1.065-.865-1.9295-1.9324-1.9295s-1.9324.8644-1.9324 1.9295c0 1.0667.865 1.9312 1.9324 1.9312zm10.1412-.0033c1.0737 0 1.945-.8707 1.945-1.9453 0-1.073-.8713-1.9436-1.945-1.9436-1.0753 0-1.945.8706-1.945 1.9453 0 1.0746.8697 1.9453 1.945 1.9453z"/></svg>
              </span>
              <span class="social-pill-text">
                <strong class="pill-name">Zalo</strong>
                <span class="pill-handle">(+84) 934 592 320</span>
              </span>
            </a>
          </div>
        </div>

        <div class="bottom-bar-decorative">
          <svg class="flight-path-svg" viewBox="0 0 260 80" fill="none">
            <path d="M10 65 Q 90 20, 180 50 T 230 40" stroke="#024cb5" stroke-width="2" stroke-dasharray="5 5"/>
            <path d="M228 35 L238 41 L226 46 Z" fill="#024cb5"/>
          </svg>
          <div class="handwritten-note">
            <div><?php echo esc_html( expo_t( 'note_line1' ) ); ?></div>
            <div><?php echo esc_html( expo_t( 'note_line2' ) ); ?></div>
            <div class="note-smile-row"><?php echo esc_html( expo_t( 'note_line3' ) ); ?></div>
            <div class="smile-underline-arc"></div>
          </div>
        </div>
      </div>

    </div>

    <!-- Full-bleed Bottom Wave Banner -->
    <!-- <div class="ocean-wave-banner" style="background-image: url('<?php //echo esc_url( get_theme_file_uri( 'assets/images/smilestrip-bottom-hero.png' ) ); ?>');"></div> -->
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Language dropdown toggle
      var langWrapper = document.getElementById('langDropdownWrapper');
      var langBtn = document.getElementById('langSelectorBtn');
      if (langBtn && langWrapper) {
        langBtn.addEventListener('click', function(e) {
          e.stopPropagation();
          var isOpen = langWrapper.classList.toggle('is-open');
          langBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', function(e) {
          if (!langWrapper.contains(e.target)) {
            langWrapper.classList.remove('is-open');
            langBtn.setAttribute('aria-expanded', 'false');
          }
        });

        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            langWrapper.classList.remove('is-open');
            langBtn.setAttribute('aria-expanded', 'false');
          }
        });
      }

      var msgInput = document.getElementById('expo-message');
      var counter = document.getElementById('msgCharCount');
      if (msgInput && counter) {
        msgInput.addEventListener('input', function() {
          counter.textContent = this.value.length;
        });
      }

      var form = document.getElementById('expoContactForm');
      var noticeContainer = document.getElementById('expoNoticeContainer');
      var submitBtn = document.getElementById('expoSubmitBtn');
      var btnText = submitBtn ? submitBtn.querySelector('.btn-text') : null;
      var defaultBtnText = (window.expo_i18n && window.expo_i18n.btn_submit) ? window.expo_i18n.btn_submit : 'GỬI TIN NHẮN';
      var sendingBtnText = (window.expo_i18n && window.expo_i18n.btn_sending) ? window.expo_i18n.btn_sending : 'Đang gửi...';
      var connErrText    = (window.expo_i18n && window.expo_i18n.notice_conn_error) ? window.expo_i18n.notice_conn_error : 'Có lỗi xảy ra khi kết nối. Vui lòng thử lại sau.';

      if (form) {
        form.addEventListener('submit', function(e) {
          if (!window.expo_ajax || !window.expo_ajax.ajax_url) {
            return;
          }
          e.preventDefault();

          var formData = new FormData(form);
          formData.set('action', 'expo_lead_submit');

          if (submitBtn) {
            submitBtn.disabled = true;
            if (btnText) btnText.textContent = sendingBtnText;
          }
          noticeContainer.innerHTML = '';

          fetch(window.expo_ajax.ajax_url, {
            method: 'POST',
            body: formData
          })
          .then(function(res) { return res.json(); })
          .then(function(data) {
            if (data.status) {
              noticeContainer.innerHTML = '<div class="expo-notice expo-notice--success" role="status">' + data.message + '</div>';
              form.reset();
              if (counter) counter.textContent = '0';
            } else {
              noticeContainer.innerHTML = '<div class="expo-notice expo-notice--error" role="alert">' + data.message + '</div>';
            }
          })
          .catch(function(err) {
            noticeContainer.innerHTML = '<div class="expo-notice expo-notice--error" role="alert">' + connErrText + '</div>';
          })
          .finally(function() {
            if (submitBtn) {
              submitBtn.disabled = false;
              if (btnText) btnText.textContent = defaultBtnText;
            }
          });
        });
      }
    });
  </script>
<?php get_footer(); ?>
