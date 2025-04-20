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
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/lib/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/lib/css/swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/app.css?v=<?php echo $version; ?>" media="screen">
    <script src="<?php echo get_template_directory_uri(); ?>/lib/js/popper.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/lib/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/lib/js/swiper-bundle.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/app.js?v=<?php echo $version; ?>"></script>
</head>

<body <?php body_class(['d-flex', 'flex-column', 'h-100']); ?>>
    <header id="header" class="p-header">
        <div class="container-lg px-2 px-lg-3">
            <div class="row no-gutters header-row">
                <div class="col-7 col-md-5 pb-2">
                    <?php if (is_front_page() || is_home()) : ?>
                        <h1 class="p-header__siteTitle">
                            <a class="text-decoration-none site-logo" href="<?php echo esc_url(home_url()); ?>">もももも</a>
                            <span class="english-name">momomomo</span>
                        </h1>
                    <?php else : ?>
                        <div class="p-header__siteTitle">
                            <a class="text-decoration-none site-logo" href="<?php echo esc_url(home_url()); ?>">もももも</a>
                            <span class="english-name">momomomo</span>
                        </div>
                    <?php endif; ?>
                    <div class="site-description"><?php bloginfo('description'); ?></div>
                </div>
                <div class="col-4 col-md-6 d-flex flex-column flex-lg-row align-items-end align-items-lg-center justify-content-center justify-content-lg-end">
                    <div class="d-inline-block mb-1 mr-lg-2">
                        <ul class="p-header__snsIcon">
                            <?php if (get_option('sns_twitter')) : ?>
                                <li>
                                    <a href="<?php echo get_option('sns_twitter'); ?>" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (get_option('sns_instagram')) : ?>
                                <li>
                                    <a href="<?php echo get_option('sns_instagram'); ?>" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (get_option('sns_line')) : ?>
                                <li>
                                    <a href="<?php echo get_option('sns_line'); ?>" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/LINE_SOCIAL_Basic.png" alt="LINE">
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if (get_option('opening_hour') || get_option('tel')) : ?>
                        <div class="header-contact-info">
                            <?php if (get_option('opening_hour')) : ?>
                                <div class="opening-hours">営業時間: <?php echo get_option('opening_hour'); ?></div>
                            <?php endif; ?>
                            <?php if (get_option('tel')) : ?>
                                <div class="p-header__tel">
                                    <?php if (get_option('tel_not_link') == 1) : ?>
                                        TEL: <tel class="tel-number"><?php echo get_option('tel'); ?></tel>
                                    <?php else : ?>
                                        TEL: <a class="tel-number" href="tel:<?php echo get_option('tel'); ?>"><?php echo get_option('tel'); ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-1 d-flex d-lg-none flex-column justify-content-center align-items-center c-barmenu">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        <div class="p-headerNav">
            <nav id="nav" class="container mobile-nav">
                <div class="nav-header d-lg-none">
                    <div class="nav-title">メニュー</div>
                    <div class="p-nav__close"><i class="fa fa-times" aria-hidden="true"></i></div>
                </div>
                <?php wp_nav_menu([
                    'theme_location' => 'headermenu',
                    'container'     => false,
                    'items_wrap'    => '<ul class="%2$s">%3$s</ul>',
                    'menu_class'    => 'nav-menu row justify-content-center flex-column flex-lg-row py-1',
                    'link_before' => '<span>',
                    'link_after' => '</span>'
                ]);
                ?>
            </nav>
        </div>
        <div class="c-overlay"></div>
    </header>
    
    <div class="container mt-3"><!-- Main content container start -->
