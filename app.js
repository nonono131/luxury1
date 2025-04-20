var $ = jQuery;

$(function () {
    // Mobile menu functionality
    $('.c-barmenu, .c-overlay').on('click', function () {
        $('.c-barmenu').toggleClass('active');
        $('.c-overlay').toggleClass('active');
        
        if ($('.c-overlay').hasClass('active')) {
            $('#nav').slideDown(300);
            $('body').css('overflow', 'hidden');
        } else {
            $('#nav').slideUp(300);
            $('body').css('overflow', 'auto');
        }
    });
    
    $('.p-nav__close').on('click', function() {
        $('.c-barmenu').removeClass('active');
        $('.c-overlay').removeClass('active');
        $('#nav').slideUp(300);
        $('body').css('overflow', 'auto');
    });

    // Close mobile menu when clicking a link
    $('#nav a').on('click', function () {
        if (window.innerWidth < 992) {
            $('.c-barmenu').removeClass('active');
            $('.c-overlay').removeClass('active');
            $('#nav').slideUp(300);
            $('body').css('overflow', 'auto');
        }
    });

    // Dropdown menus on hover for desktop
    if (window.innerWidth >= 992) {
        $('.nav-menu > li').hover(function () {
            $(this).find('ul').stop().slideDown(200);
        }, function () {
            $(this).find('ul').stop().slideUp(200);
        });
    }

    // Back to top button
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 300) {
            $('.c-arrowTop').addClass('active');
        } else {
            $('.c-arrowTop').removeClass('active');
        }
    });

    $('.c-arrowTop').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function (e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });

    // Adjust header padding on scroll
    $(window).on('scroll', function() {
        var header = $('#header');
        if ($(this).scrollTop() > 50) {
            header.addClass('header-scrolled');
        } else {
            header.removeClass('header-scrolled');
        }
    });

    // Handle window resize
    $(window).on('resize', function() {
        var windowWidth = window.innerWidth;
        if (windowWidth >= 992) {
            $('#nav').show();
            $('.c-overlay').removeClass('active');
            $('body').css('overflow', 'auto');
        } else {
            if (!$('.c-barmenu').hasClass('active')) {
                $('#nav').hide();
            }
        }
    });

    // Initialize sliders if they exist
    if ($('.swiper-container').length) {
        var thumbs = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    }

    // Hero slider initialization
    if ($('.hero-slider').length) {
        var heroSlider = new Swiper('.hero-slider', {
            loop: true,
            pagination: {
                el: '.hero-slider-pager',
                clickable: true,
            },
            navigation: {
                nextEl: '.hero-slider-controls__item--next',
                prevEl: '.hero-slider-controls__item--prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    }

    // Modal functionality for age verification
    if ($('#ageModal').length) {
        if ($.cookie('age_confirmed') !== 'true') {
            $('#ageModal').modal('show');
        }

        $('.enter-btn').on('click', function() {
            $.cookie('age_confirmed', 'true', { expires: 1, path: location.pathname });
        });
    }

    // Create placeholder images and videos
    function createPlaceholderImage(container, number) {
        var placeholderHtml = '<div class="placeholder-image" style="height: 100%; width: 100%;">' +
            '<span class="placeholder-number">' + number + '</span>' +
            'サンプル画像' +
            '</div>';
        $(container).html(placeholderHtml);
    }

    // Set up placeholder images
    $('.placeholder-image-container').each(function(index) {
        createPlaceholderImage(this, index + 1);
    });

    // Video play functionality
    $('.video-play-btn').on('click', function() {
        var videoUrl = $(this).data('video');
        if (videoUrl) {
            var videoFrame = '<iframe src="' + videoUrl + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            $(this).closest('.video-placeholder').html(videoFrame);
        }
    });
});
