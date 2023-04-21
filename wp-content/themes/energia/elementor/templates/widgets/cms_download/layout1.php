<?php
$default_settings = [
    'el_title' => '',
    'download' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<?php if(isset($download) && !empty($download) && count($download)): ?>
    <div class="cms-download e-sidebar-widget">
    	<?php if(!empty($el_title)) : ?>
    		<h3 class="widget-title"><?php echo esc_attr($el_title); ?></h3>
    	<?php endif; ?>
        <?php foreach ($download as $index => $item):
        	$link_key = $widget->get_repeater_setting_key( 'title', 'download', $index );
        	if ( ! empty( $item['link']['url'] ) ) {
			    $widget->add_render_attribute( $link_key, 'href', $item['link']['url'] );
                $widget->add_render_attribute( $link_key, 'class', [
                    'download-btn',
                    'elementor-repeater-item-' . $item['_id'],
                ] );

			    if ( $item['link']['is_external'] ) {
			        $widget->add_render_attribute( $link_key, 'target', '_blank' );
			    }

			    if ( $item['link']['nofollow'] ) {
			        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
			    }
			}
			$link_attributes = $widget->get_render_attribute_string( $link_key );
        	?>
            <div class="item--download">
            	<a <?php echo etc_print_html($link_attributes); ?>>
                    <span class="download-title"><?php echo esc_html($item['title']); ?></span>
	            	<?php if(!empty($item['selected_image']['url'])) : ?>
	            		<span class="download-icon">
                            <img src="<?php echo esc_url($item['selected_image']['url']);?>" alt="download-icon">
                        </span>
	            	<?php endif; ?>
	            </a>
           </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
