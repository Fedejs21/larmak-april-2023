<?php
// Register Video Player Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_video_player',
        'title' => esc_html__('Video Player', 'energia' ),
        'icon' => 'eicon-play',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => array(

        ),
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_video_player/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Video Player', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'video_style',
                            'label' => esc_html__('Style', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-image' => 'Image',
                                'style-background' => 'Background',
                            ],
                            'default' => 'style-image',
                        ),
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Video Alignment', 'energia' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__('Left', 'energia' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'energia' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Right', 'energia' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                            ],
                            'condition' => [
                                'video_style' => 'style-background'
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-video-player' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Choose Image', 'energia' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'video_style' => 'style-image'
                            ],
                        ),
                        array(
                            'name' => 'video_link',
                            'label' => esc_html__('Link', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => 'https://www.youtube.com/watch?v=SF4aHwxHtZ0'
                        ),
                        array(
                            'name' => 'description',
                            'label' => esc_html__('Description', 'energia'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name'  =>  'button_size',
                            'type'  =>  \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Button Size', 'energia'),
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 50,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-video-player .btn-video' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],

                        ),
                        array(
                            'name'  =>  'icont_font_size',
                            'type'  =>  \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Icon Font Size', 'energia'),
                            'separator' => 'before',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 80,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-video-player .btn-video i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],

                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);