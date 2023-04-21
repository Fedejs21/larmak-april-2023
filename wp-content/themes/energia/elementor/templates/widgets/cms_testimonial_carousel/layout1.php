<?php
$slides_to_show = $widget->get_setting('slides_to_show', '');
$slides_to_show_tablet = $widget->get_setting('slides_to_show_tablet', '');
$slides_to_show_mobile = $widget->get_setting('slides_to_show_mobile', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');
$slides_to_scroll_tablet = $widget->get_setting('slides_to_scroll_tablet', '');
$slides_to_scroll_mobile = $widget->get_setting('slides_to_scroll_mobile', '');

$slidesToShow = !empty($slides_to_show)?$slides_to_show:1;
$isSingleSlide = 1 === $slidesToShow;
$defaultLGDevicesSlidesCount = $isSingleSlide ? 1 : 1;
$slidesToShowTablet = !empty($slides_to_show_tablet)?$slides_to_show_tablet:$defaultLGDevicesSlidesCount;
$slidesToShowMobile = !empty($slides_to_show_mobile)?$slides_to_show_mobile:1;
if($isSingleSlide){
    $slidesToScroll = 1;
}
else{
    $slidesToScroll = !empty($slides_to_scroll)?$slides_to_scroll:$defaultLGDevicesSlidesCount;
}
$slidesToScrollTablet = !empty($slides_to_scroll_tablet)?$slides_to_scroll_tablet:$defaultLGDevicesSlidesCount;
$slidesToScrollMobile = !empty($slides_to_scroll_mobile)?$slides_to_scroll_mobile:1;

$arrows = $widget->get_setting('arrows');
$dots = $widget->get_setting('dots');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay', '');
$autoplay_speed = $widget->get_setting('autoplay_speed', '8000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '800');
$widget->add_render_attribute( 'carousel', [
    'class' => 'cms-slick-carousel',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => true,
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => '0',
    'data-speed' => $speed,
    'data-slidesToShow' => '1',
    'data-slidesToShowTablet' => '1',
    'data-slidesToShowMobile' => '1',
    'data-slidesToScroll' => '1',
    'data-slidesToScrollTablet' => '1',
    'data-slidesToScrollMobile' => '1',
] );
?>
<?php if(isset($settings['clients']) && !empty($settings['clients']) && count($settings['clients'])): ?>
    <div class="cms-testimonial-carousel layout1 cms-slick-slider">
        <div class="testimonial-inner">
            <div class="testimonial-carousel-inner">
                <div class="slick-primary-wrap">
                    <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                        <?php foreach ($settings['clients'] as $value): ?>
                            <div class="slick-slide">
                                <div class="client-content">
                                    <div class="said">
                                        <?php echo esc_attr($value['client_content']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="slick-nav-wrap">
                    <div class="cms-nav-carousel" data-nav="<?php echo esc_attr($settings['nav']); ?>">
                        <?php foreach ($settings['clients'] as $value_nav):
                            $img = etc_get_image_by_size( array(
                                'attach_id'  => $value_nav['client_image']['id'],
                                'thumb_size' => '60x60',
                                'class'      => '',
                            ));
                            $thumbnail = $img['thumbnail'];
                            ?>
                            <div class="slick-slide">
                                <div class="testimonial-holder">
                                    <?php if(!empty($value_nav['client_image']['id'])) { ?>
                                        <div class="client-image">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="client-meta">
                                        <div class="client-name"><span class="name-text"><?php echo esc_attr($value_nav['client_name']); ?></span></div>
                                        <span class="client-job"><?php echo esc_attr($value_nav['client_job']); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
