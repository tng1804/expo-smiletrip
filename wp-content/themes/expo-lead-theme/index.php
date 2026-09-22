<?php
get_header();
$status = isset( $_GET['expo_status'] ) ? sanitize_key( wp_unslash( $_GET['expo_status'] ) ) : '';
?>
  <!-- HERO -->
  <section class="hero" style="background-image: url('<?php echo esc_url( get_theme_file_uri( 'assets/images/expo-smiletrip-hero.png' ) ); ?>')">
    <div class="container hero-content">
      <div class="hero-copy">
        <div class="eyebrow">EXPO SMILETRIP</div>
        <h1>
          Liên hệ với chúng tôi<br>
          <span class="highlight-orange">
            Để hành trình của bạn<br>
            <span class="line-plane-wrap">
              trọn vẹn hơn
              <svg class="title-plane-svg" viewBox="0 0 90 35" fill="none">
                <path d="M5 28 Q 45 5, 80 18" stroke="#f55223" stroke-width="2" stroke-dasharray="4 4"/>
                <path d="M78 12 L87 18 L77 24 Z" fill="#f55223"/>
              </svg>
            </span>
          </span>
        </h1>
        <p class="hero-description">
          Hãy chia sẻ nhu cầu của bạn, đội ngũ Expo SmileTrip sẵn sàng lắng nghe và tư vấn, mang đến những giải pháp du lịch phù hợp nhất.
        </p>

        <!-- 3 Feature Badges -->
        <div class="hero-features">
          <div class="feature-item">
            <div class="feature-icon feature-icon--orange">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L3 14h7v8l10-12h-7z"/></svg>
            </div>
            <div class="feature-text">
              <strong>Nhanh chóng</strong>
              <span>Phản hồi sớm nhất</span>
            </div>
          </div>

          <div class="feature-item">
            <div class="feature-icon feature-icon--blue">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.58 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2z"/></svg>
            </div>
            <div class="feature-text">
              <strong>Thuận tiện</strong>
              <span>Dễ dàng kết nối</span>
            </div>
          </div>

          <div class="feature-item">
            <div class="feature-icon feature-icon--green">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div class="feature-text">
              <strong>Tận tâm</strong>
              <span>Đồng hành cùng bạn</span>
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
        <div class="section-label">THÔNG TIN LIÊN HỆ</div>

        <h2>Chúng tôi luôn sẵn sàng<br>hỗ trợ bạn</h2>

        <p>
          Dù bạn có câu hỏi, cần tư vấn tour hay hợp tác cùng chúng tôi, đừng ngần ngại liên hệ. Expo SmileTrip sẽ phản hồi trong thời gian sớm nhất.
        </p>

        <div class="contact-item">
          <div class="contact-icon contact-icon--orange">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div>
            <strong>Hotline</strong>
            <div class="value"><b>+84 24 1234 5678</b></div>
            <div class="value-sub">(8:00 – 18:00, Thứ 2 – Thứ 7)</div>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon contact-icon--orange">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <strong>Email</strong>
            <div class="value"><b>info@smiletrip.vn</b></div>
          </div>
        </div>

        <div class="contact-item">
          <div class="contact-icon contact-icon--orange">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div>
            <strong>Địa chỉ</strong>
            <div class="value">
              Số 123 Đường Du Lịch, Quận Hoàn Kiếm,<br>
              Hà Nội, Việt Nam
            </div>
          </div>
        </div>

        <div class="social">
          <div class="social-title">Kết nối với chúng tôi</div>
          <div class="social-links">
            <a href="#" aria-label="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" aria-label="Instagram">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="#" aria-label="YouTube">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#fff"/></svg>
            </a>
            <a href="#" aria-label="LinkedIn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
            </a>
          </div>
        </div>

        <!-- Decorative curved flight path bottom left -->
        <div class="contact-decorative">
          <svg class="flight-path-svg" viewBox="0 0 260 80" fill="none">
            <path d="M10 65 Q 90 20, 180 50 T 230 40" stroke="#024cb5" stroke-width="2" stroke-dasharray="5 5"/>
            <path d="M228 35 L238 41 L226 46 Z" fill="#024cb5"/>
          </svg>
          <div class="handwritten-note">
            <div>Khám phá</div>
            <div>Thế giới cùng</div>
            <div class="note-smile-row">nụ cười !</div>
            <div class="smile-underline-arc"></div>
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
            <h3>Gửi cho chúng tôi tin nhắn</h3>
            <p>Vui lòng điền đầy đủ thông tin, chúng tôi sẽ liên hệ lại sớm nhất.</p>
          </div>
        </div>

        <form id="expoContactForm" class="expo-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
          <div id="expoNoticeContainer">
            <?php if ( 'success' === $status ) : ?>
                <div class="expo-notice expo-notice--success" role="status">Cảm ơn bạn. Thông tin đã được gửi thành công.</div>
            <?php elseif ( 'invalid' === $status ) : ?>
                <div class="expo-notice expo-notice--error" role="alert">Vui lòng kiểm tra lại các trường bắt buộc và địa chỉ email.</div>
            <?php elseif ( 'error' === $status ) : ?>
                <div class="expo-notice expo-notice--error" role="alert">Không thể gửi thông tin lúc này. Vui lòng thử lại.</div>
            <?php endif; ?>
          </div>

          <input type="hidden" name="action" value="expo_lead_submit">
          <?php wp_nonce_field( 'expo_lead_submit', 'expo_lead_nonce' ); ?>
          <div class="expo-honeypot" aria-hidden="true">
              <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          </div>

          <div class="field">
            <label for="expo-name">Họ và tên <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </span>
              <input id="expo-name" name="name" type="text" placeholder="Nhập họ và tên của bạn" required autocomplete="name">
            </div>
          </div>

          <div class="field">
            <label for="expo-email">Email <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </span>
              <input id="expo-email" name="email" type="email" placeholder="Nhập địa chỉ email" required autocomplete="email">
            </div>
          </div>

          <div class="field">
            <label for="expo-phone">Số điện thoại <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </span>
              <input id="expo-phone" name="phone" type="tel" placeholder="Nhập số điện thoại" required autocomplete="tel">
            </div>
          </div>

          <div class="field">
            <label for="expo-service">Dịch vụ quan tâm <span class="required">*</span></label>
            <div class="input-with-icon">
              <span class="field-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
              </span>
              <select id="expo-service" name="service" required>
                <option value="">Chọn dịch vụ</option>
                <option value="Tour du lịch">Tour du lịch</option>
                <option value="Vé máy bay">Vé máy bay</option>
                <option value="Khách sạn & lưu trú">Khách sạn & lưu trú</option>
                <option value="Combo du lịch">Combo du lịch</option>
                <option value="Tư vấn">Tư vấn</option>
                <option value="Đặt dịch vụ">Đặt dịch vụ</option>
                <option value="Hợp tác">Đối tác / Hợp tác kinh doanh</option>
                <option value="Khác">Khác</option>
              </select>
            </div>
          </div>

          <div class="field field--full">
            <label for="expo-message">Nội dung tin nhắn <span class="required">*</span></label>
            <div class="input-with-icon input-with-icon--textarea">
              <span class="field-icon field-icon--textarea">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              </span>
              <textarea id="expo-message" name="message" maxlength="500" placeholder="Bạn muốn chia sẻ điều gì?" required></textarea>
            </div>
            <div class="char-count"><span id="msgCharCount">0</span>/500</div>
          </div>

          <button id="expoSubmitBtn" class="submit-btn" type="submit">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
            <span class="btn-text">GỬI TIN NHẮN</span>
          </button>

          <p class="privacy">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block;vertical-align:middle;margin-right:3px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Thông tin của bạn được bảo mật và chỉ sử dụng để liên hệ.
          </p>
        </form>
      </section>

    </div>

    <!-- Full-bleed Bottom Wave Banner -->
    <!-- <div class="ocean-wave-banner" style="background-image: url('<?php //echo esc_url( get_theme_file_uri( 'assets/images/smilestrip-bottom-hero.png' ) ); ?>');"></div> -->
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
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
            if (btnText) btnText.textContent = 'Đang gửi...';
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
            noticeContainer.innerHTML = '<div class="expo-notice expo-notice--error" role="alert">Có lỗi xảy ra khi kết nối. Vui lòng thử lại sau.</div>';
          })
          .finally(function() {
            if (submitBtn) {
              submitBtn.disabled = false;
              if (btnText) btnText.textContent = 'GỬI TIN NHẮN';
            }
          });
        });
      }
    });
  </script>
<?php get_footer(); ?>
