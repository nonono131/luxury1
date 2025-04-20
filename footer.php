</div>
<footer id="footer" class="p-footer py-3 mt-auto">
    <?php
    if (has_nav_menu('footermenu')) {
        wp_nav_menu([
            'theme_location' => 'footermenu',
            'container'     => 'nav',
            'container_class'     => 'mb-3 container',
            'items_wrap'    => '<ul class="%2$s">%3$s</ul>',
            'menu_class'    => 'row justify-content-lg-center text-center p-footerNav__inner'
        ]);
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="footer-brand">
                    <h3 class="footer-title">もももも</h3>
                    <div class="footer-subtitle">momomomo</div>
                </div>
                <?php if (get_option('sns_twitter') || get_option('sns_instagram') || get_option('sns_line')) : ?>
                    <div class="footer-social">
                        <ul class="p-footer__snsIcon">
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
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h3 class="contact-title">お問い合わせ</h3>
                <div class="contact-info">
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
    <div class="text-center mt-4">Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a> All Rights Reserved.</div>
    <a class="c-arrowTop" href="#"><i class="fa fa-angle-up"></i></a>
    <?php wp_footer(); ?>
</footer>
</body>

</html>
