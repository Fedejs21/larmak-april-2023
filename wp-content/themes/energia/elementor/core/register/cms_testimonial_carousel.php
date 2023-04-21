<?php
$slides_to_show = range( 1, 5 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

// Register Contact Form 7 Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_testimonial_carousel',
        'title' => esc_html__('Testimonial Carousel', 'energia'),
        'icon' => 'eicon-testimonial-carousel',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_testimonial_carousel/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'energia' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_testimonial_carousel/layout-image/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_clients',
                    'label' => esc_html__('Clients', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'clients',
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [
                                [
                                    'client_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'energia' ),
                                    'client_image' => esc_html__( 'Client Image', 'energia' ),
                                    'client_name' => esc_html__( 'John Doe', 'energia' ),
                                    'client_job' => esc_html__( 'Designer', 'energia' ),
                                    'client_link' => esc_html__( 'http://client-link.com', 'energia' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'client_content',
                                    'label' => __( 'Content', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => '10',
                                    'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                                ),
                                array(
                                    'name' => 'client_image',
                                    'label' => esc_html__('Avatar Image', 'energia'),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'client_name',
                                    'label' => esc_html__('Client Name', 'energia'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'default' => esc_html__( 'John Doe', 'energia' )
                                ),
                                array(
                                    'name'  =>  'client_job',
                                    'label' => __( 'Job', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => 'Designer',
                                ),
                                array(
                                    'name' => 'rating',
                                    'label' => esc_html__('Rating', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'star5',
                                    'options' => [
                                        'star1' => esc_html__('1 Star', 'energia' ),
                                        'star2' => esc_html__('2 Star', 'energia' ),
                                        'star3' => esc_html__('3 Star', 'energia' ),
                                        'star4' => esc_html__('4 Star', 'energia' ),
                                        'star5' => esc_html__('5 Star', 'energia' ),
                                    ],
                                ),
                                array(
                                    'name' => 'client_link',
                                    'label' => esc_html__('Client URL', 'energia'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                    'placeholder' => esc_html__('http://client-link.com', 'energia'),
                                ),
                            ),
                            'title_field' => '{{{ client_name }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_styling',
                    'label' => esc_html__('Settings', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'client_content_color',
                            'label' => esc_html__('Text Color', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-content p' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-testimonial-carousel .client-content .said' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'client_name_color',
                            'label' => esc_html__('Name Color', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-name .name-text' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'client_job_color',
                            'label' => esc_html__('Job Color', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-job' => 'color: {{VALUE}};',
                            ],
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
                            'name' => 'slides_to_scroll',
                            'label' => esc_html__('Slides to Scroll', 'energia'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'options' => [
                                    '' => esc_html__( 'Default', 'energia' ),
                                ] + $slides_to_show,
                            'condition' => [
                                'slides_to_show!' => '1',
                            ],
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
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'energia'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'energia'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Speed', 'energia'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => [
                                'autoplay' => 'true'
                            ]
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
                        array(
                            'name' => 'nav',
                            'label' => esc_html__('Nav Slides To Show', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                            ],
                            'default' => '3',
                            'condition' => [
                                'layout' => ['1','2'],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);