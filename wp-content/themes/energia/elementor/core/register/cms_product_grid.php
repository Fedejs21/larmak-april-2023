<?php
// Post term options
$post_term_options = array();
if(class_exists('WooCommerce')){
    $post_term_options = etc_get_grid_term_options('product', array('product_cat'));
}

// Register Post Grid Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_product_grid',
        'title' => esc_html__('Product Grid', 'energia' ),
        'icon' => 'eicon-products',
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
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_product_grid/layout-image/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'source',
                            'label' => esc_html__('Select Categories', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'multiple' => true,
                            'options' => $post_term_options,
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => esc_html__('Order By', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'date',
                            'options' => [
                                'date' => esc_html__('Date', 'energia' ),
                                'ID' => esc_html__('ID', 'energia' ),
                                'author' => esc_html__('Author', 'energia' ),
                                'title' => esc_html__('Title', 'energia' ),
                                'rand' => esc_html__('Random', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'order',
                            'label' => esc_html__('Sort Order', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'desc',
                            'options' => [
                                'desc' => esc_html__('Descending', 'energia' ),
                                'asc' => esc_html__('Ascending', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'limit',
                            'label' => esc_html__('Total items', 'energia' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => '6',
                        ),
                    ),
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Grid', 'energia' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'thumbnail',
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',
                        ),
                        array(
                            'name' => 'layout_type',
                            'label' => esc_html__('Grid Type', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'masonry',
                            'options' => [
                                'masonry' => esc_html__('Masonry', 'energia' ),
                                'basic' => esc_html__('Basic', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'filter',
                            'label' => esc_html__('Filter on Masonry', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'true' => esc_html__('Enable', 'energia' ),
                                'false' => esc_html__('Disable', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'filter_default_title',
                            'label' => esc_html__('Filter Default Title', 'energia' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('All', 'energia' ),
                            'condition' => [
                                'filter' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'filter_alignment',
                            'label' => esc_html__('Filter Alignment', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'center',
                            'options' => [
                                'center' => esc_html__('Center', 'energia' ),
                                'left' => esc_html__('Left', 'energia' ),
                                'right' => esc_html__('Right', 'energia' ),
                            ],
                            'condition' => [
                                'filter' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'pagination_type',
                            'label' => esc_html__('Pagination Type', 'energia' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'pagination' => esc_html__('Pagination', 'energia' ),
                                'loadmore' => esc_html__('Loadmore', 'energia' ),
                                'false' => esc_html__('Disable', 'energia' ),
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Item Gap', 'energia' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 15,
                            'selectors' => [
                                '{{WRAPPER}} .cms-grid .cms-grid-inner' => 'margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;',
                                '{{WRAPPER}} .cms-grid .grid-item' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;',
                                '{{WRAPPER}} .cms-grid .grid-sizer' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;',
                            ],
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
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);