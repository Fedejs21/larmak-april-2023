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
<div class="cms-fancy-box layout1">
    <div class="box-item-inner">
        <?php if ( $has_icon ) : ?>
            <div <?php etc_print_html($widget->get_render_attribute_string( 'item_icon' )); ?>>
                <?php
                if($is_new):
                    \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                    ?>
                <?php else: ?>
                    <i <?php etc_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                <?php endif; ?>
            </div>
        <?php endif; ?>
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
            <div class="item-button">
                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                    <span class="f-btn-icon"><i class="fac fac-arrow-right"></i></span>
                    <?php if(!empty($settings['button_text'])) : ?>
                        <span class="f-btn-text"><?php echo esc_attr($settings['button_text']); ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</div>