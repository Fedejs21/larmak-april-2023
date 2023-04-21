<?php
etc_add_custom_widget(
    array(
        'name' => 'cms_pricing',
        'title' => esc_html__('Pricing', 'energia'),
        'icon' => 'eicon-editor-list-ul',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_pricing/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'placeholder' => esc_html__('Enter your title', 'energia' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'description',
                            'label' => esc_html__('Description', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'placeholder' => esc_html__('Enter your description', 'energia' ),
                            'rows' => 3,
                            'show_label' => false,
                        ),
                        array(
                            'name' => 'description2',
                            'label' => esc_html__('Description2', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'placeholder' => esc_html__('Enter your description', 'energia' ),
                            'rows' => 4,
                            'show_label' => false,
                        ),
                        array(
                            'name' => 'highlight',
                            'label' => esc_html__('Highlight', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Feature', 'energia'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'energia'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'pricing_list_item_slashed',
                                    'label' => esc_html__('Slashed', 'energia'),
                                    'type' => \Elementor\Controls_Manager::SWITCHER,
                                    'description' => esc_html__('Item will invisible but keep height', 'energia')
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                        array(
                            'name' => 'price',
                            'label' => esc_html__('Price', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'time',
                            'label' => esc_html__('Time', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                        ),
                        array(
                            'name' => 'button_link',
                            'label' => esc_html__('Link', 'energia' ),
                            'type' => \Elementor\Controls_Manager::URL,
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'energia'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Default',
                                'style2' => 'Primary',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'slashed_style',
                            'label' => esc_html__('Slashed Style', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'sl-invisible' => 'Hidden',
                                'sl-slash' => 'Slash',
                            ],
                            'default' => 'sl-invisible',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);