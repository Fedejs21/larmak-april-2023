<?php
// Register Banner Box Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_image_pointers',
        'title' => esc_html__('Image with Pointers', 'energia' ),
        'icon' => 'eicon-info-box',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'energia' ),
                            'type' => Elementor_Theme_Core::LAYOUT_CONTROL,
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'energia' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_image_pointers/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'energia' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_image_pointers/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'energia' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_image_pointers/layout-image/layout3.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Banner Box', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image_bg',
                            'label' => esc_html__('Backround Image', 'energia' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Pointers List', 'energia'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'customer_image',
                                    'label' => esc_html__('Customer', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'energia'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'content_hover',
                                    'label' => esc_html__('Holder Style', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        'holder-right' => 'Holder Right',
                                        'holder-left'  => 'Holder Left'
                                    ],
                                    'default' => 'holder-right',
                                ),
                                array(
                                    'name' => 'item_postion',
                                    'label' => esc_html__('Item Postion', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                    'control_type' => 'responsive',
                                    'allowed_dimensions' => ['top', 'left'],
                                    'size_units' => [ 'px', '%' ],
                                    'range' => [
                                        '%' => [
                                            'min' => 0,
                                            'max' => 100,
                                        ],
                                    ],
                                    'selectors' => [
                                        '{{WRAPPER}} {{CURRENT_ITEM}}.item-pointer' => 'top: {{TOP}}{{UNIT}};left: {{LEFT}}{{UNIT}}',
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);