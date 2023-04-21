<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
etc_add_custom_widget(
    array(
        'name' => 'cms_fancy_box_carousel',
        'title' => esc_html__('Fancy Box Carousel', 'energia'),
        'icon' => 'eicon-info-box',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(
            'jquery-slick',
            'cms-clients-list-widget-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__( 'Layout', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__( 'Templates', 'energia' ),
                            'type' => Elementor_Theme_Core::LAYOUT_CONTROL,
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'energia' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box_carousel/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'energia' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box_carousel/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'energia' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box_carousel/layout-image/layout3.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_boxs',
                    'label' => esc_html__('Box Settings', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'boxs',
                            'label' => esc_html__('', 'energia'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'illustration_style',
                                    'label' => esc_html__('Illustration Style', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        'image' => 'Image',
                                        'icon' => 'Icon',
                                    ],
                                    'default' => 'image',
                                ),
                                array(
                                    'name' => 'selected_image',
                                    'label' => esc_html__('Illustration Image', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'condition' => [
                                        'illustration_style' => 'image',
                                    ],
                                ),
                                array(
                                    'name' => 'selected_icon',
                                    'label' => esc_html__('Icon', 'energia'),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                    'condition' => [
                                        'illustration_style' => 'icon',
                                    ],
                                ),
                                array(
                                    'name' => 'title_text',
                                    'label' => esc_html__('Title', 'energia'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => esc_html__('This is the heading', 'energia'),
                                    'placeholder' => esc_html__('Enter your title', 'energia'),
                                    'rows' => 4,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'description_text',
                                    'label' => esc_html__('Description', 'energia'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'energia'),
                                    'placeholder' => esc_html__('Enter your description', 'energia'),
                                    'rows' => 6,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'button_text',
                                    'label' => esc_html__('Button Text', 'energia'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => '',
                                    'condition' => [
                                        'illustration_style' => 'icon',
                                    ],
                                ),
                                array(
                                    'name' => 'item_index',
                                    'label' => esc_html__('Item Index', 'energia'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => '',
                                    'condition' => [
                                        'illustration_style' => 'image',
                                    ],
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'energia'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'condition' => [
                                        'illustration_style' => 'icon',
                                    ],
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel Settings', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'slides_to_show',
                            'label' => esc_html__('Slides to Show', 'energia'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'options' => [
                                    '' => esc_html__( 'Default', 'energia' ),
                                ] + $slides_to_show,
                        ),
                        array(
                            'name' => 'slides_gutter',
                            'label' => esc_html__('Gutter', 'energia'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 10,
                            'condition' => [
                                'slides_to_show!' => '1',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide' => 'padding: {{VALUE}}px;',
                                '{{WRAPPER}} .cms-slick-carousel .slick-list' => 'margin: 0 -{{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'energia'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'dots',
                            'label' => esc_html__('Show Dots', 'energia'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'energia'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'energia'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                    ),
                ),
                array(
                    'name' => 'box_style',
                    'label' => esc_html__('Box Style', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'index_color',
                            'label' => esc_html__('Index Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box-carousel .item-index' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box-carousel .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Description Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box-carousel .item-description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box-carousel .item-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-fancy-box-carousel .item-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);