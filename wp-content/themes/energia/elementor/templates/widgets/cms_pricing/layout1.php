<?php
$default_settings = [
    'title' => '',
    'description' => '',
    'description2' => '',
    'price' => '',
    'time' => '',
    'button_text' => '',
    'button_link' => '',
    'content_list' => '',
    'style' => 'style1',
    'slashed_style' => 'sl-invisible',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
if ( ! empty( $button_link['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $button_link['url'] );

    if ( $button_link['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $button_link['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
?>
<div class="cms-pricing-layout1 <?php echo esc_attr($style); ?>">
	<div class="cms-pricing-inner">
        <div class="pricing-holder">
            <h3 class="pricing-title"><?php echo esc_html($title); ?></h3>
            <div class="pricing-description"><?php echo esc_html($description); ?></div>
            <div class="pricing-gap"></div>
            <div class="pricing-price"><?php echo esc_html($price); ?><span><?php echo esc_html($time); ?></span></div>
            <div class="pricing-button">
                <a class="btn btn-secondary" <?php etc_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                    <?php echo esc_html($button_text); ?>
                    <i class="fas fac-arrow-circle-right"></i>
                </a>
            </div>
            <div class="pricing-description2"><?php echo esc_html($description2); ?></div>
			<?php if(isset($settings['content_list']) && !empty($settings['content_list']) && count($settings['content_list'])): ?>
			    <ul class="cms-pricing-feature <?php echo esc_attr($slashed_style); ?>">
			        <?php
			        	foreach ($settings['content_list'] as $key => $cms_list): ?>
			            <li class="<?php if ($cms_list['pricing_list_item_slashed']){echo esc_attr('item-slashed');} ?>">
                            <i aria-hidden="true" class="fas fa-check-circle"></i><?php echo esc_html($cms_list['content'])?>
                        </li>
			        <?php endforeach; ?>
			    </ul>
			<?php endif; ?>
		</div>
	</div>
    <?php
    if ( $settings['highlight'] == 'true' ){
        ?><span class="pricing-highlight bg-image"></span><?php
    }
    ?>
</div>