<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  CMS_Post_Metabox $metabox
 */

add_action( 'cms_post_metabox_register', 'energia_page_options_register' );

function energia_page_options_register( $metabox ) {

	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'energia' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'product' ) ) {
		$metabox->set_args( 'product', array(
			'opt_name'            => 'product_option',
			'display_name'        => esc_html__( 'Product Settings', 'energia' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            => energia_get_page_opt_name(),
			'display_name'        => esc_html__( 'Page Settings', 'energia' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_audio' ) ) {
		$metabox->set_args( 'cms_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'energia' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_link' ) ) {
		$metabox->set_args( 'cms_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'energia' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_quote' ) ) {
		$metabox->set_args( 'cms_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'energia' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_video' ) ) {
		$metabox->set_args( 'cms_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'energia' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_gallery' ) ) {
		$metabox->set_args( 'cms_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'energia' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/* Extra Post Type */

	if ( ! $metabox->isset_args( 'service' ) ) {
		$metabox->set_args( 'service', array(
			'opt_name'            => 'service_option',
			'display_name'        => esc_html__( 'Service Settings', 'energia' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

    if ( ! $metabox->isset_args( 'project' ) ) {
        $metabox->set_args( 'project', array(
            'opt_name'            => 'project_option',
            'display_name'        => esc_html__( 'Project Settings', 'energia' ),
            'show_options_object' => false,
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ) );
    }

	/**
	 * Config post meta options
	 *
	 */
	$metabox->add_section( 'post', array(
		'title'  => esc_html__( 'Post Settings', 'energia' ),
		'icon'   => 'el el-refresh',
		'fields' => array(
			array(
				'id'             => 'post_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-post #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'energia' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'energia' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'energia' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_post',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Sidebar', 'energia' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_post_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'energia' ),
				'options'      => array(
					'left'  => esc_html__('Left', 'energia'),
	                'right' => esc_html__('Right', 'energia'),
	                'none'  => esc_html__('Disabled', 'energia')
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_post', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

	/**
	 * Config page meta options
	 *
	 */
	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Header', 'energia' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'energia' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'energia' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'energia' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'energia' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                    '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
				),
				'default'      => energia_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
            array(
                'id'      => 'custom_main_menu',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Main Menu', 'energia' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'    => 'main_menu_select',
                'type'  => 'select',
                'title' => esc_html__( 'Select Menu', 'energia' ),
                'data'  => 'menus',
                'args'  => array(
                    'hide_empty' => false,
                    'orderby'    => 'name',
                ),
                'required'     => array( 0 => 'custom_main_menu', 1 => 'equals', 2 => '1' ),
            ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Page Title', 'energia' ),
		'icon'   => 'el el-indent-left',
		'fields' => array(
            array(
                'id'           => 'custom_pagetitle',
                'type'         => 'button_set',
                'title'        => esc_html__( 'Page Title', 'energia' ),
                'options'      => array(
                    'themeoption'  => esc_html__( 'Theme Option', 'energia' ),
                    'hide'  => esc_html__( 'Elementor Content', 'energia' ),
                ),
                'default'      => 'themeoption',
                'desc'           => esc_html__( 'Inherit from Theme Option or build-in Elementor Content', 'energia' ),
            ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Content', 'energia' ),
		'desc'   => esc_html__( 'Settings for content area.', 'energia' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
				'id'       => 'content_bg_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'energia' ),
				'subtitle' => esc_html__( 'Content background color.', 'energia' ),
				'output'   => array( 'background-color' => 'body' )
			),
			array(
				'id'             => 'content_padding',
				'type'           => 'spacing',
				'output'         => array( '#content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'energia' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'energia' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_page',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Sidebar', 'energia' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_page_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'energia' ),
				'options'      => array(
					'left'  => esc_html__( 'Left', 'energia' ),
					'right' => esc_html__( 'Right', 'energia' ),
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_page', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

    $metabox->add_section('page', array(
        'title' => esc_html__('Footer', 'energia'),
        'desc' => esc_html__('Settings for page footer.', 'energia'),
        'icon' => 'el el-website',
        'fields' => array(
            array(
                'id'      => 'custom_footer',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Footer', 'energia' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'       => 'footer_layout',
                'type'     => 'button_set',
                'title'    => esc_html__('Layout', 'energia'),
                'subtitle' => esc_html__('Select a layout for upper footer area.', 'energia'),
                'options'  => array(
                    '1'  => esc_html__('Default', 'energia'),
                    'custom'  => esc_html__('Custom', 'energia'),
                    '0'  => esc_html__('No footer', 'energia'),

                ),
                'default'  => '1',
                'required' => array( 0 => 'custom_footer', 1 => 'equals', 2 => '1' ),
                'force_output' => true
            ),
            array(
                'id'          => 'footer_layout_custom',
                'type'        => 'select',
                'title'       => esc_html__('Custom Layout', 'energia'),
                'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','energia'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
                'options'     => energia_list_post('footer'),
                'default'     => '',
                'required' => array( 0 => 'footer_layout', 1 => 'equals', 2 => 'custom' ),
                'force_output' => true
            ),
        )
    ));

	$metabox->add_section( 'product', array(
		'title'  => esc_html__( 'Header', 'energia' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'energia' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'energia' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'energia' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'energia' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                    '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
				),
				'default'      => energia_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
		)
	) );


	/**
	 * Config post format meta options
	 *
	 */

	$metabox->add_section( 'cms_pf_video', array(
		'title'  => esc_html__( 'Video', 'energia' ),
		'fields' => array(
			array(
				'id'    => 'post-video-url',
				'type'  => 'text',
				'title' => esc_html__( 'Video URL', 'energia' ),
				'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'energia' )
			),

			array(
				'id'    => 'post-video-file',
				'type'  => 'editor',
				'title' => esc_html__( 'Video Upload', 'energia' ),
				'desc'  => esc_html__( 'Upload video file', 'energia' )
			),

			array(
				'id'    => 'post-video-html',
				'type'  => 'textarea',
				'title' => esc_html__( 'Embadded video', 'energia' ),
				'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'energia' )
			)
		)
	) );

	$metabox->add_section( 'cms_pf_gallery', array(
		'title'  => esc_html__( 'Gallery', 'energia' ),
		'fields' => array(
			array(
				'id'       => 'post-gallery-lightbox',
				'type'     => 'switch',
				'title'    => esc_html__( 'Lightbox?', 'energia' ),
				'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'energia' ),
				'default'  => true
			),
			array(
				'id'       => 'post-gallery-images',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Gallery Images ', 'energia' ),
				'subtitle' => esc_html__( 'Upload images or add from media library.', 'energia' )
			)
		)
	) );

	$metabox->add_section( 'cms_pf_audio', array(
		'title'  => esc_html__( 'Audio', 'energia' ),
		'fields' => array(
			array(
				'id'          => 'post-audio-url',
				'type'        => 'text',
				'title'       => esc_html__( 'Audio URL', 'energia' ),
				'description' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'energia' ),
				'validate'    => 'url',
				'msg'         => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_link', array(
		'title'  => esc_html__( 'Link', 'energia' ),
		'fields' => array(
			array(
				'id'       => 'post-link-url',
				'type'     => 'text',
				'title'    => esc_html__( 'URL', 'energia' ),
				'validate' => 'url',
				'msg'      => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_quote', array(
		'title'  => esc_html__( 'Quote', 'energia' ),
		'fields' => array(
			array(
				'id'    => 'post-quote-cite',
				'type'  => 'text',
				'title' => esc_html__( 'Cite', 'energia' )
			)
		)
	) );

	/**
	 * Config service meta options
	 *
	 */
	$metabox->add_section( 'service', array(
		'title'  => esc_html__( 'General', 'energia' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
	            'id'       => 'service_icon',
	            'type'     => 'media',
	            'title'    => esc_html__('Icon Image', 'energia'),
	            'default' => ''
	        ),
            array(
                'id'       => 'service_feature',
                'type'     => 'multi_text',
                'title'    => esc_html__('Feature', 'energia'),
                'validate' => 'html',
            ),
			array(
				'id'             => 'service_content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-service #content' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'energia' ),
				'subtitle'     => esc_html__( 'Content site paddings.', 'energia' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'energia' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );
	$metabox->add_section( 'service', array(
		'title'  => esc_html__( 'Header', 'energia' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'energia' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'energia' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'energia' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'energia' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                    '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                    '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
				),
				'default'      => energia_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
		)
	) );
	$metabox->add_section( 'service', array(
		'title'  => esc_html__( 'Page Title', 'energia' ),
		'icon'   => 'el el-indent-left',
		'fields' => array(
			array(
				'id'           => 'custom_pagetitle',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Page Title', 'energia' ),
				'options'      => array(
					'themeoption'  => esc_html__( 'Theme Option', 'energia' ),
					'hide'  => esc_html__( 'Elementor Content', 'energia' ),
				),
				'default'      => 'themeoption',
                'desc'           => esc_html__( 'Inherit from Theme Option or build-in Elementor Content', 'energia' ),
			),
		)
	) );

    /**
     * Config project meta options
     *
     */
    $metabox->add_section( 'project', array(
        'title'  => esc_html__( 'General', 'energia' ),
        'icon'   => 'el-icon-website',
        'fields' => array(
            array(
                'id' => 'project_icon',
                'type' => 'media',
                'title' => esc_html__('Project Icon Image', 'energia'),
            ),
            array(
                'id'    => 'box_description',
                'type'  => 'textarea',
                'rows'  => 3,
                'title' => esc_html__( 'Box Description', 'energia' ),
                'desc'  => esc_html__( 'Show in box content of single project', 'energia' )
            ),
            array(
                'id' => 'box_btn_text',
                'type' => 'text',
                'title' => esc_html__('Box Button Text', 'energia'),
                'default' => '',
                'force_output' => true
            ),
            array(
                'id' => 'box_btn_link',
                'type' => 'text',
                'title' => esc_html__('Box Button Link', 'energia'),
                'default' => '',
                'force_output' => true
            ),
            array(
                'id'             => 'project_content_padding',
                'type'           => 'spacing',
                'output'         => array( '.single-project #content' ),
                'right'          => false,
                'left'           => false,
                'mode'           => 'padding',
                'units'          => array( 'px' ),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Content Padding', 'energia' ),
                'subtitle'     => esc_html__( 'Content site paddings.', 'energia' ),
                'desc'           => esc_html__( 'Default: Theme Option.', 'energia' ),
                'default'        => array(
                    'padding-top'    => '',
                    'padding-bottom' => '',
                    'units'          => 'px',
                )
            ),
        )
    ) );
    $metabox->add_section( 'project', array(
        'title'  => esc_html__( 'Header', 'energia' ),
        'desc'   => esc_html__( 'Header settings for the page.', 'energia' ),
        'icon'   => 'el-icon-website',
        'fields' => array(
            array(
                'id'      => 'custom_header',
                'type'    => 'switch',
                'title'   => esc_html__( 'Custom Header', 'energia' ),
                'default' => false,
                'indent'  => true
            ),
            array(
                'id'           => 'header_layout',
                'type'         => 'image_select',
                'title'        => esc_html__( 'Layout', 'energia' ),
                'subtitle'     => esc_html__( 'Select a layout for header.', 'energia' ),
                'options'      => array(
                    '0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
                    '1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
                    '2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                    '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                    '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
                ),
                'default'      => energia_get_option_of_theme_options( 'header_layout' ),
                'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
                'force_output' => true
            ),
        )
    ) );
    $metabox->add_section( 'project', array(
        'title'  => esc_html__( 'Page Title', 'energia' ),
        'icon'   => 'el el-indent-left',
        'fields' => array(
            array(
                'id'           => 'custom_pagetitle',
                'type'         => 'button_set',
                'title'        => esc_html__( 'Page Title', 'energia' ),
                'options'      => array(
                    'themeoption'  => esc_html__( 'Theme Option', 'energia' ),
                    'hide'  => esc_html__( 'Elementor Content', 'energia' ),
                ),
                'default'      => 'themeoption',
                'desc'           => esc_html__( 'Inherit from Theme Option or build-in Elementor Content', 'energia' ),
            ),
        )
    ) );

}

function energia_get_option_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option( energia_get_opt_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}