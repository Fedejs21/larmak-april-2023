( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCMSPostCarouselHandler = function( $scope, $ ) {
        var breakpoints = elementorFrontend.config.breakpoints;
        var carousel = $scope.find(".cms-slick-carousel");
        var data = carousel.data();
        var slider_nav = $scope.find('.cms-nav-carousel');
        if (slider_nav.length === 0) {
            slider_nav = false;
        }
        var slickOptions = {
            slidesToShow: data.slidestoshow,
            slidesToScroll: data.slidestoscroll,
            autoplay: true === data.autoplay,
            autoplaySpeed: data.autoplayspeed,
            infinite: true === data.infinite,
            pauseOnHover: true === data.pauseonhover,
            speed: data.speed,
            centerMode: data.centermode,
            centerPadding: data.centerpadding,
            arrows: true === data.arrows,
            dots: true === data.dots,
            rtl: 'rtl' === data.dir,
            nextArrow: '<span class="slick-next fac fac-arrow-right"></span>',
            prevArrow: '<span class="slick-prev fac fac-arrow-left"></span>',
            asNavFor: slider_nav,
            responsive: [{
                breakpoint: breakpoints.lg,
                settings: {
                    slidesToShow: data.slidestoshowtablet,
                    slidesToScroll: data.slidestoscrolltablet,
                }
            }, {
                breakpoint: breakpoints.md,
                settings: {
                    slidesToShow: data.slidestoshowmobile,
                    slidesToScroll: data.slidestoscrollmobile,
                    centerPadding: '0px',
                }
            }]
        };
        // Slick run
        carousel.slick(slickOptions);
        if(typeof carousel.attr('data-centerMode') !== 'undefined') {
            carousel.slick('slickSetOption', 'slidesToScroll', parseInt(carousel.attr('data-slidesToScroll')), true);
        }
        var nav_for = $scope.find(".cms-nav-carousel");
        if(nav_for.length > 0){
            slickOptions.asNavFor = nav_for;
        }

        $('.cms-nav-carousel-arrow').parents('.elementor-element').addClass('hide-nav');

        $('.cms-nav-carousel-left').on('click', function () {
            $(this).parents('.elementor-element').find('.cms-slick-slider .slick-prev').trigger('click');
        });
        $('.cms-nav-carousel-right').on('click', function () {
            $(this).parents('.elementor-element').find('.cms-slick-slider .slick-next').trigger('click');
        });

    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cms_post_carousel.default', WidgetCMSPostCarouselHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cms_service_carousel.default', WidgetCMSPostCarouselHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cms_project_carousel.default', WidgetCMSPostCarouselHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cms_career_carousel.default', WidgetCMSPostCarouselHandler );
    } );
} )( jQuery );