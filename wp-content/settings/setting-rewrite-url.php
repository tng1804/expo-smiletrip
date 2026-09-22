<?php
/**
 * =====================================================
 * PHOTOVAULT CREATOR PUBLIC SLUG SYSTEM (Production Ready)
 * =====================================================
 *
 * Features:
 *  auto generate khi register
 *  check duplicate
 *  reserved slug
 *  sanitize
 *  rewrite /slug/
 *  redirect slug cũ
 *  cache lookup nhanh
 *
 * META KEYS:
 * public_slug
 * public_slug_old
 *
 * 
 * Original URL STRUCTURE:
 * /collection/                          → collection page
 * /collection-detail/?id=1                          → collection detail page
 * /photobook/                              → photobook list
 * /photobook/?id=1                          → photobook detail page
 * /gallery-wall/                          → gallery wall list
 * /gallery-wall/?id=1                          → gallery wall detail page
 * /personalized-album/                          → personalized album list
 * /personalized-album/?id=1                          → personalized album detail page
 * /share-with-me/?code=1                    → share-with-me detail page
 * 
 * Rewrite rule URL STRUCTURE:
 * /{public_slug}/                            → creator profile
 * /{public_slug}/collection/                → danh sách collections
 * /{public_slug}/collection/{slug}/         → collection detail
 * /{public_slug}/collection/published/      → published collections
 * /{public_slug}/collection/published/{slug}/ → published collection detail
 * /{public_slug}/photobook/                 → danh sách photobooks
 * /{public_slug}/photobook/{slug}/          → photobook detail
 * /{public_slug}/personalized-album/        → danh sách albums
 * /{public_slug}/personalized-album/{slug}/ → album detail
 * /{public_slug}/gallery-wall/              → danh sách gallery walls
 * /{public_slug}/gallery-wall/{slug}/       → gallery wall detail
 * /{public_slug}/shared/                     → share-with-me
 */


/* =====================================================
 * CONFIG
 * ===================================================== */
function photovault_reserved_slugs()
{
    return array(
        'about',
        'login',
        'register',
        'collection',
        'photobook',
        'personalized-album',
        'album',
        'gallery-wall',
        'shared',
        'admin',
        'wp-admin',
        'wp-login',
        'api',
        'search',
        'creator',
    );
}

/* =====================================================
 * AUTO FLUSH REWRITE RULES KHI UPDATE CODE VERSION
 * ===================================================== */

/**
 * Tăng version mỗi lần bạn sửa rewrite rules.
 */
define('PHOTOVAULT_REWRITE_VERSION', '1.1.29');

function photovault_maybe_flush_rewrite_rules()
{
    $saved_version = get_option('photovault_rewrite_version');

    if ($saved_version !== PHOTOVAULT_REWRITE_VERSION) {

        // register rules trước khi flush
        photovault_register_rewrite_rules();

        flush_rewrite_rules(false); // false = soft flush

        update_option(
            'photovault_rewrite_version',
            PHOTOVAULT_REWRITE_VERSION
        );
    }
}
add_action('init', 'photovault_maybe_flush_rewrite_rules', 20);


/* =====================================================
 * CACHE HELPERS
 * ===================================================== */
function photovault_cache_key($slug)
{
    return 'creator_slug_' . md5($slug);
}


/* =====================================================
 * CHECK SLUG EXISTS
 * ===================================================== */
function photovault_slug_exists($slug, $exclude_user_id = 0, $exclude_partner_id = '')
{
    global $wpdb;

    // 1. Check in user meta
    $sql_user = "
        SELECT user_id
        FROM {$wpdb->usermeta}
        WHERE meta_key = 'public_slug'
        AND meta_value = %s
    ";

    $params_user = array($slug);

    if ($exclude_user_id) {
        $sql_user .= " AND user_id != %d";
        $params_user[] = $exclude_user_id;
    }

    $sql_user .= " LIMIT 1";

    $user_exists = $wpdb->get_var(
        $wpdb->prepare($sql_user, ...$params_user)
    );

    if (!empty($user_exists)) {
        return true;
    }

    // 2. Check in partner teams
    $table_partner = $wpdb->prefix . 'partner_teams';
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_partner}'") === $table_partner) {
        $sql_partner = "
            SELECT id
            FROM {$table_partner}
            WHERE public_slug = %s
        ";
        $params_partner = array($slug);

        if (!empty($exclude_partner_id)) {
            $sql_partner .= " AND partner_id != %s";
            $params_partner[] = $exclude_partner_id;
        }

        $sql_partner .= " LIMIT 1";

        $partner_exists = $wpdb->get_var(
            $wpdb->prepare($sql_partner, ...$params_partner)
        );

        if (!empty($partner_exists)) {
            return true;
        }
    }

    return false;
}


/* =====================================================
 * SANITIZE SLUG
 * ===================================================== */
function photovault_clean_slug($slug)
{
    $slug = sanitize_title($slug);
    $slug = trim($slug, '-');

    if (!$slug) {
        $slug = 'creator';
    }

    return $slug;
}


/* =====================================================
 * GENERATE UNIQUE SLUG
 * ===================================================== */
function photovault_generate_public_slug($text, $user_id = 0, $partner_id = '')
{
    $base = photovault_clean_slug($text);

    if (in_array($base, photovault_reserved_slugs(), true)) {
        $base .= '-user';
    }

    $slug = $base;
    $i = 2;

    while (photovault_slug_exists($slug, $user_id, $partner_id)) {
        $slug = $base . '-' . $i;
        $i++;
    }

    return $slug;
}


/* =====================================================
 * REGISTER USER => AUTO CREATE SLUG
 * ===================================================== */
add_action('user_register', function ($user_id) {

    $user = get_userdata($user_id);

    if (!$user) {
        return;
    }

    $slug = photovault_generate_public_slug($user->display_name, $user_id);

    update_user_meta($user_id, 'public_slug', $slug);
});


/* =====================================================
 * MIGRATION: BACKFILL public_slug FOR EXISTING USERS
 * Chạy 1 lần qua: /wp-admin/?run_slug_migration=1
 * hoặc WP-CLI: wp eval 'pv_migrate_backfill_public_slug();'
 * ===================================================== */
function pv_migrate_backfill_public_slug()
{
    $page     = 1;
    $per_page = 100;
    $total    = 0;

    do {
        $users = get_users([
            'number'  => $per_page,
            'paged'   => $page,
            'fields'  => ['ID', 'display_name'],
        ]);

        if (empty($users)) {
            break;
        }

        foreach ($users as $user) {
            // Bỏ qua nếu đã có slug
            $existing = get_user_meta($user->ID, 'public_slug', true);
            if (!empty($existing)) {
                continue;
            }

            $slug = photovault_generate_public_slug($user->display_name, $user->ID);
            update_user_meta($user->ID, 'public_slug', $slug);
            $total++;
        }

        $page++;
    } while (count($users) === $per_page);

    return $total;
}

// Trigger qua admin URL: /wp-admin/?run_slug_migration=1
add_action('admin_init', function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['run_slug_migration']) && $_GET['run_slug_migration'] === '1') {
        $count = pv_migrate_backfill_public_slug();
        wp_die("Migration hoàn tất. Đã cập nhật public_slug cho <strong>{$count}</strong> user(s).");
    }
});


/* =====================================================
 * ACF FIELD
 * ===================================================== */
add_action('acf/init', function () {

    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_creator_profile',
        'title' => 'Creator Profile',
        'fields' => array(
            array(
                'key' => 'field_public_slug',
                'label' => 'Public Slug',
                'name' => 'public_slug',
                'type' => 'text',
                'required' => 1,
                'instructions' => 'URL public của creator. Ví dụ: tran-ngoc → ' . home_url('/tran-ngoc/'),
                'wrapper' => array(
                    'id' => 'acf-field-public-slug-wrap',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'user_form',
                    'operator' => '==',
                    'value' => 'edit',
                ),
            ),
        ),
    ));
});


/* =====================================================
 * LOAD VALUE IF EMPTY
 * ===================================================== */
add_filter('acf/load_value/name=public_slug', function ($value, $post_id) {

    if (strpos($post_id, 'user_') !== 0) {
        return $value;
    }

    $user_id = (int) str_replace('user_', '', $post_id);

    if (!$value) {

        $user = get_userdata($user_id);

        if ($user) {
            $value = photovault_generate_public_slug($user->display_name, $user_id);
            update_user_meta($user_id, 'public_slug', $value);
        }
    }

    return $value;

}, 10, 2);


/* =====================================================
 * SAVE FIELD => SANITIZE + UNIQUE + OLD SLUG
 * ===================================================== */
add_filter('acf/update_value/name=public_slug', function ($value, $user_id_raw) {

    $user_id = (int) str_replace('user_', '', $user_id_raw);

    if (!$user_id) {
        return $value;
    }

    $old_slug = get_user_meta($user_id, 'public_slug', true);

    $value = photovault_generate_public_slug($value, $user_id);

    if ($old_slug && $old_slug !== $value) {
        update_user_meta($user_id, 'public_slug_old', $old_slug);
        wp_cache_delete(photovault_cache_key($old_slug), 'users');
    }

    wp_cache_delete(photovault_cache_key($value), 'users');

    return $value;

}, 10, 2);


/* =====================================================
 * FAST LOOKUP USER BY SLUG
 * ===================================================== */
function photovault_resolve_public_slug($slug)
{
    global $wpdb;

    $slug = photovault_clean_slug($slug);

    $cache_key = 'resolved_slug_' . md5($slug);

    $cached = wp_cache_get($cache_key, 'users');

    if ($cached !== false) {
        return $cached;
    }

    // 1. Check user meta
    $user_id = $wpdb->get_var($wpdb->prepare("
        SELECT user_id
        FROM {$wpdb->usermeta}
        WHERE meta_key = 'public_slug'
        AND meta_value = %s
        LIMIT 1
    ", $slug));

    if ($user_id) {
        $result = [
            'type' => 'personal',
            'id' => (int) $user_id,
            'partner_id' => '',
            'slug' => $slug,
         ];
        wp_cache_set($cache_key, $result, 'users', HOUR_IN_SECONDS);
        return $result;
    }

    // 2. Check partner teams
    $table_partner = $wpdb->prefix . 'partner_teams';
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_partner}'") === $table_partner) {
        $partner = $wpdb->get_row($wpdb->prepare("
            SELECT admin_user_id, partner_id
            FROM {$table_partner}
            WHERE public_slug = %s
            LIMIT 1
        ", $slug));

        if ($partner) {
            $result = [
                'type' => 'studio',
                'id' => (int) $partner->admin_user_id,
                'partner_id' => $partner->partner_id,
                'slug' => $slug,
            ];
            wp_cache_set($cache_key, $result, 'users', HOUR_IN_SECONDS);
            return $result;
        }
    }

    $result = null;
    wp_cache_set($cache_key, $result, 'users', HOUR_IN_SECONDS);
    return $result;
}

/**
 * Summary of photovault_get_user_by_slug
 * @param mixed $slug
 * @return int|mixed
 */
function photovault_get_user_by_slug($slug)
{
    $resolved = photovault_resolve_public_slug($slug);
    return $resolved ? $resolved['id'] : 0;
}


/* =====================================================
 * REWRITE RULES
 * ===================================================== */
add_action('init', 'photovault_register_rewrite_rules');

function photovault_register_rewrite_rules()
{
    // /profile/{slug} => /{slug}/
    add_rewrite_rule(
        '^profile/([^/]+)/?$',
        'index.php?&pvt_section=profile&pvt_creator_slug=$matches[1]',
        'top'
    );

    // {slug}/shop/page/{n}/ ( PROFILE SHOP – paged)
    add_rewrite_rule(
        '^([^/]+)/shop/page/([0-9]+)/?$',
        'index.php?&pvt_section=shop&pvt_creator_slug=$matches[1]&pvt_page_slug=profile&paged=$matches[2]',
        'top'
    );

    // {slug}/shop/ ( PROFILE SHOP)
    add_rewrite_rule(
        '^([^/]+)/shop/?$',
        'index.php?&pvt_section=shop&pvt_creator_slug=$matches[1]&pvt_page_slug=profile',
        'top'
    );

    // Standalone routes (không có creator slug prefix) → redirect về current user
    // /collection/
    add_rewrite_rule(
        '^collection/?$',
        'index.php?pvt_section=collection&pvt_page_slug=collection',
        'top'
    );

    // /collection-detail/{slug}/
    add_rewrite_rule(
        '^collection-detail/([^/]+)/?$',
        'index.php?pvt_section=collection-detail&pvt_item_slug=$matches[1]',
        'top'
    );

    // Embed collection: /embed/collection/?id=xxxx  (standalone, no creator slug)
    add_rewrite_rule(
        '^embed/collection/?$',
        'index.php?pvt_section=embed_collection',
        'top'
    );

    // /{slug}/collection/
    add_rewrite_rule(
        '^([^/]+)/collection/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_page_slug=collection&pvt_section=collection',
        'top'
    );

    // /{slug}/collection/{collection_slug}/  ← add trước → nằm dưới trong danh sách
    add_rewrite_rule(
        '^([^/]+)/collection/([^/]+)/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=collection&pvt_item_slug=$matches[2]',
        'top'
    );

    // /{slug}/collection/published/{collection_slug}/  ← add sau → nằm TRÊN → match trước {item_slug}
    add_rewrite_rule(
        '^([^/]+)/collection/published/([^/]+)/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=collection&pvt_item_slug=$matches[2]&pvt_sub_section=published',
        'top'
    );

    // /{slug}/photobook/
    add_rewrite_rule(
        '^([^/]+)/photobook/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=photobook',
        'top'
    );

    // /{slug}/photobook/{photobook_slug}/
    add_rewrite_rule(
        '^([^/]+)/photobook/([^/]+)/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=photobook&pvt_item_slug=$matches[2]',
        'top'
    );

    // /{slug}/personalized-album/
    add_rewrite_rule(
        '^([^/]+)/personalized-album/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=personalized-album',
        'top'
    );

    // /{slug}/personalized-album/{album_slug}/
    add_rewrite_rule(
        '^([^/]+)/personalized-album/([^/]+)/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=personalized-album&pvt_item_slug=$matches[2]',
        'top'
    );

    // /{slug}/gallery-wall/
    add_rewrite_rule(
        '^([^/]+)/gallery-wall/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=gallery-wall',
        'top'
    );

    // /{slug}/gallery-wall/{wall_slug}/
    add_rewrite_rule(
        '^([^/]+)/gallery-wall/([^/]+)/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=gallery-wall&pvt_item_slug=$matches[2]',
        'top'
    );

    // /{slug}/shared/
    add_rewrite_rule(
        '^([^/]+)/shared/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_section=shared',
        'top'
    );

    // /{slug}/ → creator public profile
    // Dùng 'top' để luôn match trước WP catch-all.
    // Conflict với WP pages (my-account, cart...) được xử lý bởi
    // filter 'request' bên dưới: nếu slug là WP page thực sự thì
    // swap pvt_creator_slug → pagename trước khi WP_Query chạy.
    add_rewrite_rule(
        '^([^/]+)/?$',
        'index.php?pvt_creator_slug=$matches[1]&pvt_page_slug=profile',
        'top'
    );
}


/* =====================================================
 * QUERY VARS
 * ===================================================== */
add_filter('query_vars', function ($vars) {
    $vars[] = 'pvt_creator_slug';
    $vars[] = 'pvt_section';
    $vars[] = 'pvt_sub_section';
    $vars[] = 'pvt_item_slug';
    $vars[] = 'pvt_user_slug';
    $vars[] = 'pvt_page_slug'; // slug để xác định page type (ví dụ: 'profile')
    $vars[] = 'pvt_profile_type';
    $vars[] = 'pvt_partner_id';

    return $vars;
});

/**
 * Get current route
 * @return array
 */
function pvt_current_route()
{
    $page_slug = get_query_var('pvt_page_slug');
    if (empty($page_slug)) {
        $page_slug = get_query_var('pvt_section');
    }
    return [
        'page_slug' => $page_slug
    ];
}

/**
 * Check current route
 * @param string $section
 * @return bool
 */
function is_current_route($section = '')
{
    $current_route = pvt_current_route();
    return $current_route['page_slug'] === $section;
}

/* =====================================================
 * PHOTOVAULT CUSTOM ROUTE SLUGS
 *
 * Danh sách slug single-segment MÀ PHOTOVAULT sở hữu.
 * Những slug này sẽ LUÔN đi qua rewrite router của photovault,
 * không bao giờ bị swap về WP page dù có WP page trùng slug.
 *
 * Lưu ý: những slug này đã có rule riêng với pvt_section nên
 * thường không rơi vào '^([^/]+)/?$'. Danh sách này là lớp
 * bảo vệ bổ sung, tránh trường hợp ai đó tạo WP page trùng tên.
 * ===================================================== */
function photovault_custom_route_slugs()
{
    return array(
        // Photovault section pages
        'collection',
        // 'photobook',
        // 'personalized-album',
        // 'gallery-wall',
        'shared',
        'profile',
        // Legacy / alternative slugs
        'collection-detail',
    );
}


/* =====================================================
 * REQUEST FILTER: swap pvt_creator_slug → pagename
 * nếu URL thực sự là một WP page (my-account, cart...)
 *
 * Luồng xử lý:
 *   1. Nếu slug thuộc photovault_custom_route_slugs()
 *      → không swap, để photovault router xử lý.
 *   2. Nếu có WP page publish với slug đó
 *      → swap pvt_creator_slug → pagename để WP serve đúng.
 *   3. Ngược lại → giữ nguyên, template_redirect sẽ
 *      lookup creator profile hoặc force 404.
 * ===================================================== */
add_filter('request', 'photovault_maybe_swap_creator_slug_to_page');

function photovault_maybe_swap_creator_slug_to_page($query_vars)
{
    // Chỉ xử lý khi URL là single-segment /{slug}/:
    //   - pvt_creator_slug được set (rule '^([^/]+)/?$' đã match)
    //   - pvt_section KHÔNG set (nếu có section là rule 2-segment, không phải profile)
    // Lưu ý: không check pvt_page_slug ở đây vì filter 'request' và
    // 'query_vars' cùng chạy trong parse_request() — extraction
    // có thể chưa xảy ra tại thời điểm này.
    if (!isset($query_vars['pvt_creator_slug']) || isset($query_vars['pvt_section'])) {
        return $query_vars;
    }

    $slug = $query_vars['pvt_creator_slug'];

    // Slug thuộc photovault → luôn đi qua router riêng, không bao giờ swap
    if (in_array($slug, photovault_custom_route_slugs(), true)) {
        return $query_vars;
    }

    // Kiểm tra WP page thực sự (cover cả WooCommerce pages)
    $page = get_page_by_path($slug);

    if ($page && $page->post_status === 'publish') {
        // Là WP/WC page → swap để WP_Query xử lý đúng
        unset($query_vars['pvt_creator_slug']);
        unset($query_vars['pvt_page_slug']);
        $query_vars['pagename'] = $slug;
        $query_vars['page_id']  = $page->ID;
    }
    // else: không có WP page → giữ pvt_creator_slug → template_redirect lookup creator

    return $query_vars;
}

function photovault_get_profile_info_from_public_slug($public_slug)
{
    $resolved = photovault_resolve_public_slug($public_slug);
    return $resolved ?? [];
}

/**
 * Get the public slug of the user.
 *
 * @param int $user_id User ID.
 * @return string User public slug.
 */
function get_user_public_slug($user_id)
{
    $slug = get_user_meta($user_id, 'public_slug', true);
    return $slug ? $slug : '';
}


/**
 * Get the public share URL of a collection.
 *
 * @param int $collection_id Collection ID.
 * @return string Collection share URL.
 */
function get_collection_share_url(int $collection_id): string
{
    $owner_public_slug = pvt_get_collection_owner_public_slug($collection_id);
    if (!$owner_public_slug) return '';

    $share_code = get_term_meta($collection_id, '_short_code', true);
    if (!$share_code) return '';

    return generate_share_url_by_shortcode($owner_public_slug, $share_code) ?? '';
}

/**
 * Get the public slug of the collection owner.
 *
 * @param int $collection_id Collection ID.
 * @return string Collection owner public slug.
 */
function pvt_get_collection_owner_public_slug(int $collection_id): string
{
    $owner_public_slug = '';

    $term = get_term($collection_id, 'collection');
    if (!$term) return $owner_public_slug;

    $studio_id = get_term_meta($collection_id, 'studio_id', true);
    if(!empty($studio_id)) {
        $owner_public_slug = pv_get_studio_public_slug($studio_id);
    } else {
        $collection_author_id = get_collection_owner($collection_id);
        if (!$collection_author_id) return $owner_public_slug;

        $owner_public_slug = get_user_public_slug($collection_author_id);
    }

    return $owner_public_slug;
}

/**
 * Get the creator slug from the URL.
 *
 * @param string $url URL.
 * @return string Creator slug.
 */
function get_creator_slug_from_url($url) {
    if (empty($url)) {
        return '';
    }

    $path = parse_url($url, PHP_URL_PATH);

    if (empty($path)) {
        return '';
    }

    $segments = array_values(array_filter(explode('/', $path)));

    return $segments[0] ?? '';
}


/* =====================================================
 * TEMPLATE ROUTER
 * ===================================================== */
add_action('template_redirect', 'photovault_template_router', 10);

function photovault_template_router()
{
    $creator_slug = get_query_var('pvt_creator_slug');
    $section = get_query_var('pvt_section');

    // ── Standalone embed route: /embed/collection/?id=xxx ──────────────────
    if ($section === 'embed_collection') {
        photovault_load_template('templates/collection-embed.php');
        return;
    }

    // Standalone route: /collection/, /photobook/, v.v. → redirect về current context
    if (!$creator_slug && $section) {
        if (!is_user_logged_in()) {
            require_login_redirect();
            exit;
        }

        $active_profile      = pv_get_active_profile();
        $active_public_slug = $active_profile['public_slug'];

        if (!$active_public_slug) {
            require_login_redirect();
            exit;
        }

        // /collection-detail/{slug}/ → /{creator}/collection/{slug}/
        if ($section === 'collection-detail') {
            $item_slug = get_query_var('pvt_item_slug');
            if ($item_slug) {
                wp_redirect(home_url('/' . $active_public_slug . '/collection/' . $item_slug . '/'), 302);
            } else {
                wp_redirect(home_url('/' . $active_public_slug . '/collection/'), 302);
            }
            exit;
        }

        // Collection, Photobook
        wp_redirect(home_url('/' . $active_public_slug . '/' . $section . '/'), 302);
        exit;
    }

    if (!$creator_slug) {
        return;
    }

    // Lookup user theo public_slug meta
    $resolved = photovault_resolve_public_slug($creator_slug);

    if (!$resolved) {
        // Thử redirect slug cũ
        photovault_maybe_redirect_old_slug($creator_slug);

        photovault_force_404();
        return;
    }

    $user_id = $resolved['id'];
    $user = get_userdata($user_id);
    $item = get_query_var('pvt_item_slug');
    $sub = get_query_var('pvt_sub_section');

    // Truyền context cho template
    set_query_var('pvt_user', $user);
    set_query_var('pvt_user_id', $user_id);
    set_query_var('pvt_creator_slug', $creator_slug);
    set_query_var('pvt_profile_type', $resolved['type']);
    set_query_var('pvt_partner_id', $resolved['partner_id']);

    switch ($section) {

        case 'collection':
            if ($sub === 'published') {
                if ($item) {
                    // /{slug}/collection/published/{collection_slug}/
                    set_query_var('pvt_collection_slug', $item);
                    photovault_load_template('templates/collection-publish.php');
                }
            } elseif ($sub === 'embed') {
                // /collection/embed/
                photovault_load_template('templates/collection-embed.php');
            } elseif ($item) {
                // /{slug}/collection/{collection_slug}/
                set_query_var('pvt_collection_slug', $item);
                photovault_load_template('templates/collection-detail.php');
            } else {
                // /{slug}/collection/
                photovault_load_template('templates/collections-template.php');
            }
            break;
        case 'collection-detail':
            if ($item) {
                // /{slug}/collection-detail/{collection_slug}/
                set_query_var('pvt_collection_slug', $item);
                photovault_load_template('templates/collection-detail.php');
            }
            break;

        case 'photobook':
            photovault_load_template('templates/photobook.php');
            break;

        case 'personalized-album':
            photovault_load_template('templates/album-editor.php');
            break;

        case 'gallery-wall':
            photovault_load_template('templates/gallery-wall.php');
            break;

        case 'shared':
            photovault_load_template('templates/view-image.php');
            break;
        
        case 'profile':
            // /profile/{slug}/ → 301 redirect → /{slug}/
            wp_redirect(home_url('/' . $creator_slug . '/'), 301);
            exit;

        case 'shop':
            set_query_var('pvt_user_slug', $creator_slug);
            photovault_load_template('templates/profile-product.php');
            break;

        default:
            // /{slug}/ → public profile
            set_query_var('pvt_user_slug', $creator_slug);
            photovault_load_template('templates/public-profile.php');
            break;
    }
}


/* =====================================================
 * HELPER: LOAD TEMPLATE
 * ===================================================== */
function photovault_load_template($relative_path)
{
    $file = get_theme_file_path($relative_path);

    if (file_exists($file)) {
        // WordPress's main WP_Query returns no posts for custom query vars,
        // so it automatically sets is_404 = true and sends status 404 before
        // template_redirect fires. Reset to 200 before serving our template.
        global $wp_query;
        $wp_query->is_404 = false;
        status_header(200);

        include $file;
        exit;
    }

    // Fallback: 404
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
}

// // Fallback: 404
function photovault_force_404()
{
    global $wp_query;

    $wp_query->set_404();
    status_header(404);
    nocache_headers();

    include get_query_template('404');
    exit;
}


/* =====================================================
 * HELPER: REDIRECT OLD SLUG
 * ===================================================== */
function photovault_maybe_redirect_old_slug($slug)
{
    $users = get_users(array(
        'meta_key' => 'public_slug_old',
        'meta_value' => $slug,
        'number' => 1,
        'fields' => 'ID',
    ));

    if (!empty($users[0])) {
        $new_slug = get_user_meta($users[0], 'public_slug', true);

        if ($new_slug) {
            wp_redirect(home_url('/' . $new_slug . '/'), 301);
            exit;
        }
    }
}


/* =====================================================
 * FLUSH REWRITE RULES khi đổi theme
 * ===================================================== */
add_action('after_switch_theme', function () {
    photovault_register_rewrite_rules();
    flush_rewrite_rules();
});


/* =====================================================
 * GENERATE URLS (helper functions)
 * ===================================================== */

function photovault_creator_url($user)
{
    $slug = is_object($user)
        ? get_user_meta($user->ID, 'public_slug', true)
        : get_user_meta($user, 'public_slug', true);

    if (!$slug) {
        return home_url('/');
    }

    return home_url('/' . $slug . '/');
}

function photovault_creator_collections_url($user)
{
    $slug = is_object($user)
        ? get_user_meta($user->ID, 'public_slug', true)
        : get_user_meta($user, 'public_slug', true);

    return $slug ? home_url('/' . $slug . '/collections/') : home_url('/');
}

function photovault_collection_url($user_id, $collection_slug)
{
    $public_slug = get_user_meta($user_id, 'public_slug', true);

    if (!$public_slug) {
        return '#';
    }

    return home_url('/' . $public_slug . '/collections/' . $collection_slug . '/');
}

function photovault_photobook_url($user_id, $photobook_slug)
{
    $public_slug = get_user_meta($user_id, 'public_slug', true);

    if (!$public_slug) {
        return '#';
    }

    return home_url('/' . $public_slug . '/photobooks/' . $photobook_slug . '/');
}

// Only for gallery wall, photobook, personalized album
function photovault_custom_product_url_by_product_id($product_id, $page_slug)
{
    $author_product_id = get_author_id_by_product_id($product_id);
    $public_slug = get_user_meta($author_product_id, 'public_slug', true);

    if (!$public_slug) {
        return '#';
    }

    return home_url('/' . $public_slug . '/' . $page_slug . '/?id=' . $product_id . '&type=view');
}

/**
 * Summary of photovault_collection_page_url
 * @param string $public_slug
 * @return string
 */
function photovault_collection_page_url(string $public_slug):string
{
    return home_url('/' . $public_slug . '/collection/');
}

/**
 * Summary of photovault_collection_detail_url
 * @param string $public_slug
 * @param string $collection_slug
 * @return string
 */
function photovault_collection_detail_url(string $public_slug, string $collection_slug): string
{
    return home_url('/' . $public_slug . '/collection/' . $collection_slug . '/');
}

/**
 * Get embed URL for a collection.
 *
 * @param int $collection_id  Term ID of the collection.
 * @return string             Full embed URL.
 */
function get_collection_embed_url( $collection_id ) {
    return home_url( '/embed/collection/?id=' . absint( $collection_id ) );
}


/* =====================================================
 * AJAX: CHECK SLUG EXISTS (admin)
 * ===================================================== */
add_action('wp_ajax_pvt_check_slug', 'photovault_ajax_check_slug');

function photovault_ajax_check_slug()
{
    check_ajax_referer('pvt_check_slug_nonce', 'nonce');

    if (!current_user_can('edit_users') && !current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Permission denied.'), 403);
    }

    $slug = isset($_POST['slug']) ? sanitize_title(trim($_POST['slug'])) : '';
    $exclude_user = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
    $exclude_partner = isset($_POST['partner_id']) ? sanitize_text_field(trim($_POST['partner_id'])) : '';

    if (!$slug) {
        wp_send_json_error(array('message' => 'Slug không được để trống.'));
    }

    if (in_array($slug, photovault_reserved_slugs(), true)) {
        wp_send_json_error(array(
            'message' => '"' . esc_html($slug) . '" là slug bị cấm (reserved). Vui lòng chọn tên khác.',
            'reserved' => true,
        ));
    }

    $exists = photovault_slug_exists($slug, $exclude_user, $exclude_partner);

    if ($exists) {
        wp_send_json_error(array(
            'message' => '"' . esc_html($slug) . '" đã được sử dụng.',
            'taken' => true,
        ));
    }

    wp_send_json_success(array(
        'message' => '"' . esc_html($slug) . '" có thể sử dụng.',
        'slug' => $slug,
    ));
}


/* =====================================================
 * ENQUEUE ADMIN JS: Debounce slug checker
 * ===================================================== */
add_action('admin_enqueue_scripts', 'photovault_enqueue_slug_checker_script');

function photovault_enqueue_slug_checker_script($hook)
{
    // Load trên trang edit user, profile và trang Partner Management
    $is_partner_page = (strpos($hook, 'partner-management') !== false);
    if (!in_array($hook, array('user-edit.php', 'profile.php'), true) && !$is_partner_page) {
        return;
    }

    // Lấy user_id đang edit
    $user_id = 0;
    if (in_array($hook, array('user-edit.php', 'profile.php'), true)) {
        $user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : get_current_user_id();
    }

    wp_enqueue_script(
        'pvt-slug-checker',
        get_theme_file_uri('assets/js/admin/slug-checker.js'),
        array('jquery'),
        filemtime(get_theme_file_path('assets/js/admin/slug-checker.js')),
        true
    );

    wp_localize_script('pvt-slug-checker', 'pvtSlugChecker', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('pvt_check_slug_nonce'),
        'userId' => $user_id,
        'homeUrl' => home_url('/'),
        'debounce' => 500,
        'i18n' => array(
            'checking' => 'Đang kiểm tra...',
            'available' => '✓ Có thể sử dụng',
            'taken' => '✗ Slug đã được dùng',
            'reserved' => '✗ Slug bị cấm',
            'empty' => 'Vui lòng nhập slug',
            'error' => 'Lỗi khi kiểm tra slug',
        ),
    ));
}
// Giải pháp 3 tầng:
// Request: /trngoc003/
//     ↓
// [Rule 'top'] → pvt_creator_slug=trngoc003
//     ↓
// [filter 'request'] → get_page_by_path('trngoc003') = null → KHÔNG swap
//     ↓
// [WP_Query] → pvt_creator_slug còn nguyên
//     ↓
// [template_redirect] → load public-profile.php
// Request: /my-account/
//     ↓
// [Rule 'top'] → pvt_creator_slug=my-account
//     ↓
// [filter 'request'] → get_page_by_path('my-account') = WC page → SWAP → pagename=my-account
//     ↓
// [WP_Query] → is_page() = true
//     ↓
// [template_redirect] → pvt_creator_slug không set → return → WP serve my-account