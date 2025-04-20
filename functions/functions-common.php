<?php

// 定数
define('IMG_SLIDER_COUNT_MAX', 3); // トップページの画像スライダーの枚数
define('HOME_RANKING_COUNT_MAX', 6); // トップページのランキングの表示件数
define('CAST_IMG_COUNT_MAX', 3); // キャスト画像、アイキャッチ画像以外に何枚表示させるか
define('CAST_SCHEDULE_UPDATE_COUNT_MAX', 14); // キャスト出勤予定日を何日分入力可能にするか
define('CAST_SCHEDULE_DISP_COUNT_MAX', 7); // キャスト出勤予定日を何日後まで表示するか

// アイキャッチ画像有効化
add_theme_support('post-thumbnails');

/**
 * 読み込むJSを設定
 */
function enqueue_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-cookie', 'https://cdn.jsdelivr.net/npm/jquery.cookie@1.4.1/jquery.cookie.min.js', array('jquery'), '1.4.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

/**
 * titleタグ設定
 */
add_theme_support('title-tag');
function change_title_separator($sep)
{
    return '|';
}
add_filter('document_title_separator', 'change_title_separator');

/**
 * カスタムメニュー
 */
register_nav_menu('headermenu', 'ヘッダーメニュー');
register_nav_menu('footermenu', 'フッターメニュー');

/**
 * Linuxタイムスタンプを渡し、mm/dd(曜日)の形式に変換する。
 */
function get_date_disp($time)
{
    $gmt_date = date('Y-m-d H:i:s', $time); // 一旦GMTの日時に変換する
    $week = ['日', '月', '火', '水', '木', '金', '土'];
    return get_date_from_gmt($gmt_date, 'm/d') . '(' . $week[get_date_from_gmt($gmt_date, 'w')] . ')';
}

/**
 * 画面表示用に変換する。
 */
function conv_to_disp($time)
{
    if (strlen($time) != 5) return '';

    $hour = substr($time, 0, 2);
    $minutes = substr($time, 3, 2);
    if (!is_numeric($hour) || !is_numeric($minutes)) return '';

    $hour = (int)$hour;

    if ($hour > 24) $hour -= 24;
    return date('H:i', strtotime("$hour:$minutes"));
}

/**
 * DBには05:00〜28:59の形式で保存するので、変換する。
 */
function conv_to_db($time)
{
    $time_arr = explode(':', $time);

    $hour = $time_arr[0];
    $minutes = $time_arr[1];
    if (!is_numeric($hour) || !is_numeric($minutes)) return '';

    // 数値型に変換
    $hour = (int)$hour;

    if ($hour < 5) {
        // 00:00〜04:59の場合、24:00〜28:59に変換する
        $hour += 24;
        return sprintf("%02d:%02d", $hour, $minutes);
    } else {
        return date('H:i', strtotime("$hour:$minutes"));
    }
}

/**
 * プレースホルダー画像生成用関数
 */
function get_placeholder_image($number = 1, $width = 800, $height = 600)
{
    return 'data:image/svg+xml;charset=UTF-8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" viewBox="0 0 ' . $width . ' ' . $height . '" preserveAspectRatio="none">
    <rect width="' . $width . '" height="' . $height . '" fill="#f8c8d9" />
    <text x="50%" y="50%" font-family="Arial" font-size="36" fill="#333" text-anchor="middle" dominant-baseline="middle">' . $number . '</text>
    </svg>');
}

/**
 * ウィジェットエリアの設定
 */
function widgets_init()
{
    register_sidebar(array(
        'name' => 'キャストプロフィール項目',
        'id' => 'cast_field_area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'ランキング表示エリア',
        'id' => 'cast_ranking_area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'サイドバーエリア',
        'id' => 'sidebar_widget_area',
        'before_widget' => '<div class="sidebar-widget mb-4">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sidebar-title">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'widgets_init');
