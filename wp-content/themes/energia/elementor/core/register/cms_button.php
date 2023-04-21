<?php
// Register Button Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_button',
        'title' => esc_html__('Button', 'energia' ),
        'icon' => 'eicon-button',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'energia' ),
                                'btn-fullwidth' => esc_html__('Full Width', 'energia' ),
                                'white-hover' => esc_html__('White Hover', 'energia' ),
                                'btn-secondary' => esc_html__('Secondary', 'energia' ),
                                'btn-white' => esc_html__('White', 'energia' ),
                                'btn-white-secondary' => esc_html__('White Secondary', 'energia' ),
                                'btn-outline' => esc_html__('Outline', 'energia' ),
                                'btn-outline-secondary' => esc_html__('Outline Secondary', 'energia' ),
                                'btn-outline-white' => esc_html__('Outline White', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'text',
                            'label' => esc_html__('Text', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Click here', 'energia'),
                            'placeholder' => esc_html__('Click here', 'energia'),
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'energia' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__('https://your-link.com', 'energia' ),
                            'default' => [
                                'url' => '#',
                            ],
                        ),
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'energia' ),
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
                            'selectors' => [
                                '{{WRAPPER}} .cms-button' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Icon', 'energia' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'label_block' => true,
                            'fa4compatibility' => 'icon',
                        ),
                        array(
                            'name' => 'icon_align',
                            'label' => esc_html__('Icon Position', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'right',
                            'options' => [
                                'right' => esc_html__('After', 'energia' ),
                                'left' => esc_html__('Before', 'energia' ),
                            ],
                            'condition' => [
                                'btn_icon!' => '',
                            ],
                        ),
                        array(
                            'name' => 'icon_indent',
                            'label' => esc_html__('Icon Spacing', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 5,
                                    'max' => 50,
                                ],
                            ],
                            'condition' => [
                                'btn_icon!' => '',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-button .cms-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .cms-button .cms-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_button',
                    'label' => esc_html__('Button Style', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'text_color',
                            'label' => esc_html__('Text Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-button .btn' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'hover_background',
                            'label' => esc_html__('Hover Background', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-button .btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'hover_color',
                            'label' => esc_html__('Hover Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-button .btn:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'button_border_radius',
                            'label' => __( 'Border Radius', 'energia' ),
                            'type' =>\Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'button_padding',
                            'label' => esc_html__('Padding', 'energia'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units'    => ['px', 'em', '%'],
                            'separator' => 'before',
                            'selectors'     => [
                                '{{WRAPPER}} .cms-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                            ]
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);