<?php
$default_settings = [
    'widget_title' => '',
    'menu' => '',
    'style' => '',
    'menu_sticky' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
if(!empty($menu)) : ?>
    <div class="cms-custom-menu-wrap">
        <div class="cms-navigation-menu <?php echo esc_attr($style).' '.esc_attr($menu_sticky); ?>">
            <?php if(!empty($widget_title)) : ?>
                <h3 class="widget-title"><?php etc_print_html( nl2br($widget_title) ); ?></h3>
            <?php endif; ?>
            <?php wp_nav_menu(array(
                    'fallback_cb' => '',
                    'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                    'menu'        => $menu
                )
            ); ?>
        </div>
    </div>
<?php endif; ?>