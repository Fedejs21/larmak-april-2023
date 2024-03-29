<?php
// Register Post Grid Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_image_gallery',
        'title' => esc_html__('Image Gallery', 'energia' ),
        'icon' => 'eicon-gallery-grid',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => [
            'imagesloaded',
            'isotope',
            'cms-post-grid-widget-js',
        ],
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_image_gallery/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Image Gallery', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'wp_gallery',
                            'label' => __( 'Add Images', 'energia' ),
                            'type' => \Elementor\Controls_Manager::GALLERY,
                            'show_label' => false,
                            'dynamic' => [
                                'active' => true,
                            ],
                        ),
                        array(
                            'name' => 'thumbnail',
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                        ),
                        array(
                            'name' => 'col_xs',
                            'label' => esc_html__('Columns XS Devices', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => esc_html__('1', 'energia' ),
                                '2' => esc_html__('2', 'energia' ),
                                '3' => esc_html__('3', 'energia' ),
                                '4' => esc_html__('4', 'energia' ),
                                '6' => esc_html__('6', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'col_sm',
                            'label' => esc_html__('Columns SM Devices', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => esc_html__('1', 'energia' ),
                                '2' => esc_html__('2', 'energia' ),
                                '3' => esc_html__('3', 'energia' ),
                                '4' => esc_html__('4', 'energia' ),
                                '6' => esc_html__('6', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'col_md',
                            'label' => esc_html__('Columns MD Devices', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '2',
                            'options' => [
                                '1' => esc_html__('1', 'energia' ),
                                '2' => esc_html__('2', 'energia' ),
                                '3' => esc_html__('3', 'energia' ),
                                '4' => esc_html__('4', 'energia' ),
                                '6' => esc_html__('6', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'col_lg',
                            'label' => esc_html__('Columns LG Devices', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => esc_html__('1', 'energia' ),
                                '2' => esc_html__('2', 'energia' ),
                                '3' => esc_html__('3', 'energia' ),
                                '4' => esc_html__('4', 'energia' ),
                                '6' => esc_html__('6', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'col_xl',
                            'label' => esc_html__('Columns XL Devices', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => esc_html__('1', 'energia' ),
                                '2' => esc_html__('2', 'energia' ),
                                '3' => esc_html__('3', 'energia' ),
                                '4' => esc_html__('4', 'energia' ),
                                '6' => esc_html__('6', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'gallery_rand',
                            'label' => __( 'Order By', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '' => __( 'Default', 'energia' ),
                                'rand' => __( 'Random', 'energia' ),
                            ],
                            'default' => '',
                        ),
                    ),
                ),
                array(
                    'name' => 'gallery_images_section',
                    'label' => esc_html__('Images', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Image Gap', 'energia' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 15,
                            'selectors' => [
                                '{{WRAPPER}} .cms-grid .cms-grid-inner' => 'margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;',
                                '{{WRAPPER}} .cms-grid .grid-item' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px; margin-top: {{VALUE}}px; margin-bottom: {{VALUE}}px;',
                                '{{WRAPPER}} .cms-grid .grid-sizer' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'caption_section',
                    'label' => esc_html__('Caption', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'gallery_display_caption',
                            'label' => __( 'Display', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'none',
                            'options' => [
                                'none' => __( 'Hide', 'energia' ),
                                '' => __( 'Show', 'energia' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'display: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'caption_align',
                            'label' => __( 'Alignment', 'energia' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'energia' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'energia' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'energia' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name' => 'caption_color',
                            'label' => __( 'Text Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name' => 'caption_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .grid-item .image-caption',
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);