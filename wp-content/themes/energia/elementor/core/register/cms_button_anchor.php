<?php
// Register Button Widget
use Elementor\Controls_Manager;

etc_add_custom_widget(
    array(
        'name' => 'cms_button_anchor',
        'title' => esc_html__('Button Anchor', 'energia' ),
        'icon' => 'eicon-anchor',
        'categories' => array( Elementor_Theme_Core::ETC_CATEGORY_NAME ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Anchor', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'anchor_id',
                            'label' => esc_html__('The ID of Menu Anchor.', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'placeholder' => esc_html__('For Example: About', 'energia' ),
                            'description' => esc_html__( 'This ID will be the CSS ID you will have to use in your own page, Without #.', 'energia' ),
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'anchor_note',
                            'type' => \Elementor\Controls_Manager::RAW_HTML,
                            'raw' => sprintf( esc_html__( 'Note: The ID link ONLY accepts these chars: %s', 'energia' ), '`A-Z, a-z, 0-9, _ , -`' ),
                            'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);