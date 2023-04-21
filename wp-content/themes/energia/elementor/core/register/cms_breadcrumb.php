<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_breadcrumb',
        'title' => esc_html__('Breadcrumb', 'energia'),
        'icon' => 'eicon-ellipsis-h',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_style_content',
                    'label' => esc_html__('Style', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'breadcrumb_color',
                            'label' => esc_html__('Breadcrumb Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-breadcrumb' => 'color: {{VALUE}} !important;',
                                '{{WRAPPER}} .cms-breadcrumb span' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'breadcrumb_last_color',
                            'label' => esc_html__('Last Item Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-breadcrumb li:last-child span' => 'color: {{VALUE}} !important;',
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
                                '{{WRAPPER}} .cms-breadcrumb' => 'text-align: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);