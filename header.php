<?php
// デバッグモードの場合、CSSとJSをキャッシュしない
if (WP_DEBUG) {
    $version = date('YmdHis');
} else {
    $theme = wp_get_theme();
    $version = $theme->Version;
}
?>
<!DOCTYPE html>
<html lang="ja" class="h-100">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(['d-flex', 'flex-column', 'h-100']); ?>>
    <header id="header" class="p-header pt-1">
        <div class="container-lg px-2 px-lg-3">
            <div class="row no-gutters align-items-center">
                <div class="col-lg-4 col-8 pb-2">
                    <?php if (is_front_page() || is_home()) : ?>
                        <h1 class="p-header__siteTitle site-logo">
                            <a class="text-decoration-none" href="https://momomomo.online/">
                                <img src="http://momomomo.online/wp-content/uploads/2025/04/IMG_2519.jpg" alt="もももも" class="img-fluid">
                            </a>
                        </h1>
                    <?php else : ?>
                        <div class="p-header__siteTitle site-logo">
                            <a class="text-decoration-none" href="https://momomomo.online/">
                                <img src="http://momomomo.online/wp-content/uploads/2025/04/IMG_2519.jpg" alt="もももも" class="img-fluid">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-8 col-4 d-flex flex-column flex-lg-row align-items-end align-items-lg-center justify-content-end pr-1 pr-lg-0">
                    <div class="header-info ml-lg-auto text-right">
                        <div class="header-info__hours">営業時間 10:00-24:00</div>
                        <div class="p-header__tel">
                            <a class=".h5" href="tel:000-0000-0000">
                                <i class="fa fa-phone" aria-hidden="true"></i> 000-0000-0000
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-flex d-lg-none flex-column justify-content-center align-items-center c-barmenu">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="p-headerNav">
            <?php wp_nav_menu([
                'theme_location' => 'global-nav', // 変更: theme_location を 'global-nav' に
                'container'     => 'nav',
                'container_id'     => 'global-nav-container', // ID変更
                'container_class'     => 'container',
                'items_wrap'    => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'menu_class'    => 'global-nav__list row justify-content-center flex-column flex-lg-row column py-1',
                // 'link_before' と 'link_after' はデザインに応じて調整
                // 'link_before' => '<span>',
                // 'link_after' => '</span>'
            ]);
            ?>
        </div>
        <div class="c-overlay"></div>
    </header>
