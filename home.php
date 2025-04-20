<?php get_header(); ?>

<main id="main" role="main" class="p-index">
    <article>
        <!-- Hero Section with Image Slider -->
        <section id="hero" class="hero-section">
            <?php
            $imgs = [];
            for ($i = 1; $i <= IMG_SLIDER_COUNT_MAX; $i++) {
                if ($img = get_option('img_slider' . $i)) $imgs[] = $img;
            }
            ?>

            <?php if (!empty($imgs)) : ?>
                <div class="swiper-container hero-slider">
                    <ul class="swiper-wrapper hero-slider__inner">
                        <?php foreach ($imgs as $i => $img) : ?>
                            <li class="swiper-slide hero-slider__item">
                                <img src="<?php echo esc_attr($img); ?>" alt="スライダー画像<?php echo $i+1; ?>">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if (count($imgs) > 1) : ?>
                        <ul class="hero-slider-controls">
                            <li class="hero-slider-controls__item hero-slider-controls__item--prev"><i class="fa fa-angle-left" aria-hidden="true"></i></li>
                            <li class="hero-slider-controls__item hero-slider-controls__item--next"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        </ul>
                        <ul class="hero-slider-pager"></ul>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <!-- Placeholder if no slider images are set -->
                <div class="hero-placeholder">
                    <div class="container text-center">
                        <h1>もももも</h1>
                        <p class="hero-subtitle">MOMOMOMO</p>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <!-- About Section -->
        <?php
        $about_title = get_option('about_title') ?: 'コンセプト';
        $about_text = get_option('about_text') ?: 'もももも（MOMOMOMO）は皆様に最高のひとときをお過ごしいただくために、丁寧なおもてなしと満足のいくサービスをご提供いたします。心地よい空間と厳選されたスタッフがお客様の癒やしとリラクゼーションをお手伝いします。';
        ?>
        <section id="about" class="about-section">
            <div class="container">
                <h2 class="section-title"><?php echo esc_html($about_title); ?></h2>
                <div class="about-content">
                    <?php echo wpautop($about_text); ?>
                </div>
            </div>
        </section>

        <!-- Featured Video Section -->
        <section id="video" class="video-section">
            <div class="container">
                <h2 class="section-title">動画</h2>
                <div class="video-wrapper">
                    <!-- Video placeholder will be replaced with embedded video -->
                    <div class="video-placeholder">
                        <div class="placeholder-inner">
                            <i class="fa fa-play-circle video-play-btn" data-video="<?php echo esc_attr(get_option('main_video_url')); ?>"></i>
                            <p>動画が再生できます</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Staff Section -->
        <section id="today" class="staff-section">
            <div class="container">
                <h2 class="section-title">本日出勤</h2>
                <?php
                $today = current_time('Ymd');
                $casts = new WP_Query([
                    'post_type' => 'cast',
                    'posts_per_page' => -1,
                    'meta_query' => [
                        'relation' => 'AND',
                        [
                            'key' => $today . '_from',
                            'value' => '',
                            'type' => 'CHAR',
                            'compare' => '!='
                        ],
                        [
                            'key' => $today . '_to',
                            'value' => '',
                            'type' => 'CHAR',
                            'compare' => '!='
                        ],
                        // 以降はorderby用の名前付けのため
                        'from_clause' => [
                            'key' => $today . '_from',
                            'type' => 'TIME'
                        ],
                    ],
                    // 出勤時刻をTIMEに変換した値で昇順に
                    'orderby' => 'from_clause',
                    'order' => 'ASC',
                ]);
                ?>
                <?php if ($casts->have_posts()) : ?>
                    <div class="row staff-cards">
                        <?php while ($casts->have_posts()) : $casts->the_post(); ?>
                            <?php get_template_part('cast', 'loop'); ?>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p class="text-center">出勤予定がありません。</p>
                <?php endif; ?>
                <div class="text-center mt-4">
                    <a href="<?php echo home_url('/schedule'); ?>" class="btn">
                        <i class="fa fa-calendar" aria-hidden="true"></i>出勤予定をもっと見る
                    </a>
                </div>
            </div>
        </section>

        <!-- Ranking Section -->
        <?php if (is_active_sidebar('cast_ranking_area')) : ?>
            <section id="ranking" class="ranking-section">
                <div class="container">
                    <h2 class="section-title">ランキング</h2>
                    <div class="row ranking-cards">
                        <?php dynamic_sidebar('cast_ranking_area'); ?>
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?php echo home_url('/ranking'); ?>" class="btn">
                            <i class="fa fa-trophy" aria-hidden="true"></i>ランキングをもっと見る
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Event Section -->
        <?php $event_items = new WP_Query([
            'post_type' => 'event',
            'posts_per_page' => 5
        ]); ?>
        <?php if ($event_items->have_posts()) : ?>
            <section id="event" class="event-section">
                <div class="container">
                    <h2 class="section-title">イベント情報</h2>
                    <div class="row">
                        <div class="col-12 col-lg-9 mx-auto">
                            <div class="event-list">
                                <?php while ($event_items->have_posts()) : $event_items->the_post(); ?>
                                    <article class="event-item">
                                        <a href="<?php echo esc_url(home_url('/event#event' . $post->ID)); ?>" class="event-link">
                                            <?php if (get_post_meta($post->ID, 'from', true) != '' || get_post_meta($post->ID, 'to', true) != '') : ?>
                                                <span class="event-date">
                                                    【<?php echo (get_post_meta($post->ID, 'from', true) != '') ? get_post_meta($post->ID, 'from', true) : ''; ?> 〜 <?php echo (get_post_meta($post->ID, 'to', true) != '') ? get_post_meta($post->ID, 'to', true) : ''; ?>】
                                                </span>
                                            <?php endif; ?>
                                            <span class="event-title"><?php the_title(); ?></span>
                                        </a>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?php echo esc_url(home_url('/event')); ?>" class="btn">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>イベント情報一覧へ
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Access Section -->
        <section id="access" class="access-section">
            <div class="container">
                <h2 class="section-title">アクセス</h2>
                <?php if (get_option('google_map_url')) : ?>
                    <?php
                    $map_html = preg_replace(['/width=\\\\\\\".*\\\\\\\"/', '/height=\\\\\\\".*\\\\\\\"/'], '', get_option('google_map_url'));
                    $map_html = str_replace('<iframe', '<iframe class="embed-responsive-item"', $map_html);
                    ?>
                    <div class="embed-responsive embed-responsive-21by9 mb-5">
                        <?php echo $map_html; ?>
                    </div>
                <?php endif; ?>
                <div class="contact-info">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="contact-card">
                                <?php if (get_option('address')) : ?>
                                    <p class="mb-2"><i class="fa fa-map-marker"></i> <?php echo preg_replace('/\\n/', '<br>', esc_html(get_option('address'))); ?></p>
                                <?php endif; ?>
                                <?php if (get_option('access')) : ?>
                                    <p class="mb-2"><i class="fa fa-location-arrow"></i> <?php echo preg_replace('/\\n/', '<br>', esc_html(get_option('access'))); ?></p>
                                <?php endif; ?>
                                <?php if (get_option('tel')) : ?>
                                    <p class="mb-2"><i class="fa fa-phone"></i> <?php echo esc_html(get_option('tel')); ?></p>
                                <?php endif; ?>
                                <?php if (get_option('opening_hour')) : ?>
                                    <p class="mb-2"><i class="fa fa-clock-o"></i> <?php echo esc_html(get_option('opening_hour')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="<?php echo home_url('/access'); ?>" class="btn">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>詳しいアクセス方法はこちら
                    </a>
                </div>
            </div>
        </section>
    </article>

    <!-- Age Verification Modal -->
    <?php if (get_option('modal_flg') == 1) : ?>
        <div class="modal fade age-verification-modal" id="ageModal" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">年齢確認</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h2 class="mb-4">もももも</h2>
                            <?php echo wpautop(get_option('modal_text')); ?>
                            <?php if (get_option('permission_num')) : ?>
                                <p class="mb-3">届出交付番号：<?php echo esc_html(get_option('permission_num')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="enter-btn" data-dismiss="modal">ENTER</button>
                        <a class="exit-btn" href="https://google.com/">EXIT</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
