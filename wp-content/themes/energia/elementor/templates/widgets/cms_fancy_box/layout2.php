<?php
$widget->add_render_attribute( 'selected_icon', 'class' );
$has_icon = ! empty( $settings['selected_icon'] );
$hover_animation = $widget->get_setting('hover_animation', '');

if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );

    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
    }

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
    }
}

if ( $has_icon ) {
    $widget->add_render_attribute( 'i', 'class', $settings['selected_icon'] );
    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
}
// Add Attributes
$widget->add_render_attribute( 'item_icon', 'class', [ 'item-icon', 'elementor-animation-' . $settings['hover_animation'] ] );
$widget->add_inline_editing_attributes( 'title_text', 'none' );
$link_attributes = $widget->get_render_attribute_string( 'link' );

$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-fancy-box layout2">
    <div class="box-item-inner">
        <div class="item-content">
            <h3 class="item-title">
                <?php echo etc_print_html($settings['title_text']); ?>
            </h3>
            <?php
            if (!empty($settings['description_text'])){
                ?>
                <div class="item-description">
                    <?php echo esc_html($settings['description_text']); ?>
                </div>
                <?php
            }
            ?>
            <?php if(!empty($settings['button_text'])) : ?>
                <div class="item-button">
                    <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                        <i class="fac fac-arrow-right"></i>
                        <?php if(!empty($settings['button_text'])) : ?>
                            <span><?php echo esc_attr($settings['button_text']); ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>