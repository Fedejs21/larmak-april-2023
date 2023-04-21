<?php
// Register Icon Box Widget
use Elementor\Controls_Manager;

etc_add_custom_widget(
    array(
        'name' => 'cms_fancy_box',
        'title' => esc_html__('Fancy Box', 'energia'),
        'icon' => 'eicon-icon-box',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'energia'),
                            'type' => Elementor_Theme_Core::LAYOUT_CONTROL,
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'energia'),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'energia'),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_fancy_box/layout-image/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Box Settings', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'box_height',
                            'label' => esc_html__('Box Height', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 300,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box.layout2' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '2',
                            ]
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
                                'layout' => '1',
                            ]
                        ),
                        array(
                            'name' => 'selected_image',
                            'label' => esc_html__('Image', 'energia' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'layout' => '3',
                            ]
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
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'energia'),
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                    ),
                ),
                array(
                    'name' => 'icon_style_settings',
                    'label' => esc_html__('Icon', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Primary Color', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-fancy-box .item-icon svg' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .cms-fancy-box:before' => 'background-color: {{VALUE}};',

                            ],
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Size', 'energia'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 10,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .cms-fancy-box .item-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'hover_animation',
                            'label' => esc_html__( 'Hover Animation', 'energia' ),
                            'type' => Controls_Manager::HOVER_ANIMATION,
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_settings',
                    'label' => esc_html__('Box Style', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'box_background',
                            'label' => esc_html__('Box Background', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'box_border',
                            'label' => esc_html__('Border Color', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box:before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_bottom_space',
                            'label' => esc_html__('Heading Bottom Spacing', 'energia'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 50,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Description Color', 'energia'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-fancy-box .item-description' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-fancy-box .item-content:before' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                                '{{WRAPPER}} .cms-fancy-box .item-content:after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);