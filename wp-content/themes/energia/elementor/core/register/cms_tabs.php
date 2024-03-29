<?php
$elementor_templates = get_posts([
    'post_type' => 'elementor_library',
    'numberposts' => -1,
    'post_status' => 'publish',
]);
$elementor_templates_opt = [
    '' => esc_html__( 'Select Template', 'energia' ),
];
if($elementor_templates){
    foreach ($elementor_templates as $template) {
        $elementor_templates_opt[$template->ID] = $template->post_title;
    }
}
// Register Tabs Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_tabs',
        'title' => esc_html__( 'Tabs', 'energia' ),
        'icon' => 'eicon-tabs',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'scripts' => [
          'cms-tabs-widget-js',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_tabs',
                    'label' => esc_html__( 'Tabs', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'active_tab',
                            'label' => esc_html__( 'Active Tab', 'energia' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 1,
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'tabs',
                            'label' => esc_html__( 'Tabs Items', 'energia' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'tab_title',
                                    'label' => esc_html__( 'Title', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__( 'Tab Title', 'energia' ),
                                    'placeholder' => esc_html__( 'Tab Title', 'energia' ),
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'title_icon',
                                    'label' => esc_html__('Title Icon', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'content_type',
                                    'label' => esc_html__( 'Content Type', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'text_editor',
                                    'options' => [
                                        'text_editor' => esc_html__( 'Text Editor', 'energia' ),
                                        'template' => esc_html__( 'Template', 'energia' ),
                                    ],
                                ),
                                array(
                                    'name' => 'tab_content',
                                    'label' => esc_html__( 'Content', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'default' => esc_html__( 'Tab Content', 'energia' ),
                                    'placeholder' => esc_html__( 'Tab Content', 'energia' ),
                                    'show_label' => false,
                                    'condition' => [
                                        'content_type' => 'text_editor'
                                    ],
                                ),
                                array(
                                    'name' => 'tab_content_template',
                                    'label' => esc_html__( 'Template', 'energia' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => '',
                                    'options' => $elementor_templates_opt,
                                    'condition' => [
                                        'content_type' => 'template'
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ tab_title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_tab',
                    'label' => esc_html__('Style', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'tab_background',
                            'label' => esc_html__('Tab Background', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tabs .cms-tab-title' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'tab_color',
                            'label' => esc_html__('Tab Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tabs .cms-tab-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-tabs .cms-tab-title svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'tab_active_background',
                            'label' => esc_html__('Tab Active Background', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tabs .cms-tab-title.active' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'tab_active_color',
                            'label' => esc_html__('Tab Active Color', 'energia' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-tabs .cms-tab-title.active' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-tabs .cms-tab-title.active svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);