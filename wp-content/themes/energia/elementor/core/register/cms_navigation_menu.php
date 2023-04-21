<?php
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) && ! empty( $menus ) ) {
    foreach ( $menus as $single_menu ) {
        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
            $custom_menus[ $single_menu->slug ] = $single_menu->name;
        }
    }
} else {
    $custom_menus = '';
}
etc_add_custom_widget(
    array(
        'name' => 'cms_navigation_menu',
        'title' => esc_html__('Navigation Menu', 'energia'),
        'icon' => 'eicon-menu-bar',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'widget_title',
                            'label' => esc_html__('Widget Title', 'energia'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'menu',
                            'label' => esc_html__('Select Menu', 'energia'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => $custom_menus,
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'default' => 'Default',
                                'inline' => 'Inline',
                                'e-sidebar-widget' => 'Sidebar Menu'
                            ],
                            'default' => 'default',
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-navigation-menu ul.menu li a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Link Color Hover & Active', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-navigation-menu ul.menu li a:hover, {{WRAPPER}} .cms-navigation-menu ul.menu li.current_page_item > a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'border_color_hover',
                            'label' => esc_html__('Border Color Hover & Active', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'style' => array('inline', 'one-page'),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-navigation-menu.inline ul.menu > li > a:after' => 'background-color: {{VALUE}} !important;',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);