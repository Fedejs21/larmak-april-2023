<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}

if(class_exists('Newsletter')) {
    $forms = array_filter( (array) get_option( 'newsletter_forms', array() ) );

    $newsletter_forms = array(
        'default' => esc_html__( 'Default Form', 'energia' )
    );

    if ( $forms )
    {
        $index = 1;
        foreach ( $forms as $key => $form )
        {
            $newsletter_forms[ $key ] = sprintf( esc_html__( 'Form %s', 'energia' ), $index );
            $index ++;
        }
    }
} else {
    $newsletter_forms = '';
}

$opt_name = energia_get_opt_name();
$theme = wp_get_theme();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => class_exists('Elementor_Theme_Core') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'energia'),
    'page_title'           => esc_html__('Theme Options', 'energia'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'show_options_object' => false,
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => class_exists('Elementor_Theme_Core') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
    'templates_path'       => get_template_directory() . '/inc/templates/redux/'
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'energia'),
    'icon'   => 'el-icon-home',
    'fields' => array(
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'title'    => esc_html__('Favicon', 'energia'),
            'default' => ''
        ),
        array(
            'id'       => 'show_page_loading',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Page Loading', 'energia'),
            'subtitle' => esc_html__('Enable page loading effect when you load site.', 'energia'),
            'default'  => false
        ),
        array(
            'id'       => 'dev_mode',
            'type'     => 'switch',
            'title'    => esc_html__('Dev Mode (not recommended)', 'energia'),
            'description' => 'no minimize , generate css over time...',
            'default'  => false
        ),
    )
));

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Header', 'energia'),
    'icon'   => 'el-icon-website',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Layout', 'energia'),
            'subtitle' => esc_html__('Select a layout for header.', 'energia'),
            'options'  => array(
                '1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
                '2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
                '4' => get_template_directory_uri() . '/assets/images/header-layout/h4.jpg',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'sticky_on',
            'type'     => 'switch',
            'title'    => esc_html__('Sticky Header', 'energia'),
            'subtitle' => esc_html__('Header will be sticked when applicable.', 'energia'),
            'default'  => false
        ),
        array(
            'id'       => 'search_on',
            'type'     => 'switch',
            'title'    => esc_html__('Search Icon', 'energia'),
            'default'  => false
        ),
        array(
            'id' => 'cart_on',
            'type' => 'switch',
            'title' => esc_html__('Cart Icon', 'energia'),
            'subtitle' => esc_html__('Cart icon will be show when turn on.', 'energia'),
            'default' => false
        ),
        array(
            'id'       => 'language_switch',
            'type'     => 'switch',
            'title'    => esc_html__('Language Switch', 'energia'),
            'default'  => false
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Top Bar', 'energia'),
    'icon'       => 'el el-website',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'note_text',
            'type'    => 'textarea',
            'title'   => esc_html__('Note Text', 'energia'),
            'rows' => 3,
            'default' => '',
            'force_output' => true
        ),
        array(
            'id'      => 'phone_label',
            'type'    => 'text',
            'title'   => esc_html__('Phone Label', 'energia'),
            'default' => '',
            'force_output' => true
        ),
        array(
            'id'      => 'phone_number',
            'type'    => 'text',
            'title'   => esc_html__('Phone Number', 'energia'),
            'default' => '',
        ),
        array(
            'id'       => 'menu_phone_icon',
            'type'     => 'media',
            'title'    => esc_html__('Menu Phone Icon', 'energia'),
            'default' => ''
        ),
        array(
            'id'      => 'menu_phone_label',
            'type'    => 'text',
            'title'   => esc_html__('Menu Phone Label', 'energia'),
            'default' => '',
            'force_output' => true
        ),
        array(
            'id'      => 'menu_phone_number',
            'type'    => 'text',
            'title'   => esc_html__('Menu Phone Number', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'email_label',
            'type'    => 'text',
            'title'   => esc_html__('Email Label', 'energia'),
            'default' => '',
            'force_output' => true
        ),
        array(
            'id'      => 'email_text',
            'type'    => 'text',
            'title'   => esc_html__('Email Text', 'energia'),
            'default' => '',
        ),
        array(
            'id' => 'email_link',
            'type' => 'text',
            'title' => esc_html__('Email Link', 'energia'),
            'default' => '',
            'force_output' => true
        ),
        array(
            'id'      => 'time_label',
            'type'    => 'text',
            'title'   => esc_html__('Time Label', 'energia'),
            'default' => '',
            'force_output' => true
        ),
        array(
            'id'      => 'time',
            'type'    => 'text',
            'title'   => esc_html__('Time', 'energia'),
            'default' => '',
        ),
        array(
            'id'=>'short_link1',
            'type' => 'textarea',
            'title' => esc_html__('Short Link 1', 'energia'),
            'validate' => 'html_custom',
            'rows' => 3,
            'default' => '',
        ),
        array(
            'id'=>'short_link2',
            'type' => 'textarea',
            'title' => esc_html__('Short Link 2', 'energia'),
            'validate' => 'html_custom',
            'rows' => 3,
            'default' => '',
        ),
        array(
            'id'=>'short_link3',
            'type' => 'textarea',
            'title' => esc_html__('Short Link 32', 'energia'),
            'validate' => 'html_custom',
            'rows' => 3,
            'default' => '',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Logo', 'energia'),
    'icon'       => 'el el-picture',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'title'    => esc_html__('Logo Dark', 'energia'),
             'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-dark.png'
            )
        ),
        array(
            'id'       => 'logo_light',
            'type'     => 'media',
            'title'    => esc_html__('Logo Light', 'energia'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-light.png'
            )
        ),
        array(
            'id'       => 'logo_mobile',
            'type'     => 'media',
            'title'    => esc_html__('Logo Tablet & Mobile', 'energia'),
             'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-dark.png'
            )
        ),
        array(
            'id'       => 'logo_maxh',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Max height', 'energia'),
            'subtitle' => esc_html__('Enter number.', 'energia'),
            'width'    => false,
            'unit'     => 'px'
        ),
        array(
            'id'       => 'logo_maxh_sm',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Max height Tablet & Mobile', 'energia'),
            'subtitle' => esc_html__('Enter number.', 'energia'),
            'width'    => false,
            'unit'     => 'px'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Navigation', 'energia'),
    'icon'       => 'el el-lines',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'font_menu',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Google Font', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'font-style'  => false,
            'font-weight'  => true,
            'text-align'  => false,
            'font-size'  => false,
            'line-height'  => false,
            'color'  => false,
            'output'      => array('.primary-menu > li > a, body .primary-menu .sub-menu li a'),
            'units'       => 'px',
        ),
        array(
            'id'       => 'menu_font_size',
            'type'     => 'text',
            'title'    => esc_html__('Font Size', 'energia'),
            'validate' => 'numeric',
            'desc'     => 'Enter number',
            'msg'      => 'Please enter number',
            'default'  => ''
        ),
        array(
            'id'       => 'menu_text_transform',
            'type'     => 'select',
            'title'    => esc_html__('Text Transform', 'energia'),
            'options'  => array(
                '' => esc_html__('Default', 'energia'),
                'uppercase' => esc_html__('Uppercase', 'energia'),
                'capitalize'  => esc_html__('Capitalize', 'energia'),
                'lowercase'  => esc_html__('Lowercase', 'energia'),
                'initial'  => esc_html__('Initial', 'energia'),
                'inherit'  => esc_html__('Inherit', 'energia'),
                'none'  => esc_html__('None', 'energia'),
            ),
            'default'  => ''
        ),
        array(
            'title' => esc_html__('Main Menu', 'energia'),
            'type'  => 'section',
            'id' => 'main_menu',
            'indent' => true
        ),
        array(
            'id'      => 'main_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Color', 'energia'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'title' => esc_html__('Sticky Menu', 'energia'),
            'type'  => 'section',
            'id' => 'sticky_menu',
            'indent' => true
        ),
        array(
            'id'      => 'sticky_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Color', 'energia'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),

        array(
            'title' => esc_html__('Button Navigation', 'energia'),
            'type'  => 'section',
            'id' => 'button_navigation',
            'indent' => true
        ),
        array(
            'id'       => 'h_btn_on',
            'type'     => 'button_set',
            'title'    => esc_html__('Show/Hide Button', 'energia'),
            'options'  => array(
                'show'  => esc_html__('Show', 'energia'),
                'hide'  => esc_html__('Hide', 'energia')
            ),
            'default'  => 'hide',
        ),
        array(
            'id' => 'h_btn_text',
            'type' => 'text',
            'title' => esc_html__('Button Text', 'energia'),
            'default' => '',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_link_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Link Type', 'energia'),
            'options'  => array(
                'page'  => esc_html__('Page', 'energia'),
                'custom'  => esc_html__('Custom', 'energia')
            ),
            'default'  => 'page',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'    => 'h_btn_link',
            'type'  => 'select',
            'title' => esc_html__( 'Page Link', 'energia' ),
            'data'  => 'page',
            'args'  => array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ),
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'page' ),
            'force_output' => true
        ),
        array(
            'id' => 'h_btn_link_custom',
            'type' => 'text',
            'title' => esc_html__('Custom Link', 'energia'),
            'default' => '',
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_target',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Target', 'energia'),
            'options'  => array(
                '_self'  => esc_html__('Self', 'energia'),
                '_blank'  => esc_html__('Blank', 'energia')
            ),
            'default'  => '_self',
            'required' => array( 0 => 'h_btn_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Page Title', 'energia'),
    'icon'   => 'el-icon-map-marker',
    'fields' => array(

        array(
            'id'           => 'pagetitle',
            'type'         => 'button_set',
            'title'        => esc_html__( 'Page Title', 'energia' ),
            'options'      => array(
                'show'  => esc_html__( 'Show', 'energia' ),
                'hide'  => esc_html__( 'Hide', 'energia' ),
            ),
            'default'      => 'show',
        ),

        array(
            'id'       => 'ptitle_bg',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'energia'),
            'subtitle' => esc_html__('Page title background.', 'energia'),
            'output'   => array('body #pagetitle'),
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true,
            'transparent' => false,
        ),
        array(
            'id'       => 'ptitle_color',
            'type'     => 'color',
            'title'    => esc_html__('Text Color', 'energia'),
            'subtitle' => esc_html__('Text color.', 'energia'),
            'output'   => array('body #pagetitle h1.page-title', 'body #pagetitle .page-title-inner .cms-breadcrumb', 'body #pagetitle .page-title-inner .cms-breadcrumb span'),
            'default'  => '',
            'transparent' => false,
            'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id' => 'ptitle_paddings',
            'type' => 'spacing',
            'title' => esc_html__('Content Paddings', 'energia'),
            'subtitle' => esc_html__('Content page title paddings.', 'energia'),
            'mode' => 'padding',
            'units' => array('em', 'px', '%'),
            'top' => true,
            'right' => false,
            'bottom' => true,
            'left' => false,
            'output' => array('#pagetitle.pagetitle'),
            'default' => array(
                'top' => '',
                'right' => '',
                'bottom' => '',
                'left' => '',
                'units' => 'px',
            )
        ),
        array(
            'id' => 'ptitle_content_align',
            'type' => 'button_set',
            'title' => esc_html__('Content Align', 'energia'),
            'options' => array(
                'left' => esc_html__('Left', 'energia'),
                'center' => esc_html__('Center', 'energia'),
                'right' => esc_html__('Right', 'energia'),
            ),
            'default' => 'left'
        ),
        array(
            'title' => esc_html__('Breadcrumb', 'energia'),
            'type' => 'section',
            'id' => 'pt_breadcrumb',
            'indent' => true
        ),
        array(
            'id' => 'breadcrumb_on',
            'type' => 'switch',
            'title' => esc_html__('Breadcrumb', 'energia'),
            'default' => false
        ),
    )
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'energia'),
    'icon'  => 'el-icon-pencil',
    'fields'     => array(
        array(
            'id'       => 'content_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Background Color', 'energia'),
            'subtitle' => esc_html__('Content background color.', 'energia'),
            'output' => array('background-color' => 'body')
        ),
        array(
            'id'             => 'content_padding',
            'type'           => 'spacing',
            'output'         => array('.single #content'),
            'right'   => false,
            'left'    => false,
            'mode'           => 'padding',
            'units'          => array('px'),
            'units_extended' => 'false',
            'title'          => esc_html__('Content Padding', 'energia'),
            'subtitle' => esc_html__('Single Post Content Padding.', 'energia'),
            'desc'           => esc_html__('Default: Top-110px, Bottom-110px', 'energia'),
            'default'            => array(
                'padding-top'   => '',
                'padding-bottom'   => '',
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'search_field_placeholder',
            'type'    => 'text',
            'title'   => esc_html__('Search Form - Text Placeholder', 'energia'),
            'default' => '',
            'desc'           => esc_html__('Default: Search Keywords...', 'energia'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive', 'energia'),
    'icon'       => 'el-icon-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'archive_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'energia'),
            'subtitle' => esc_html__('Select a sidebar position for blog home, archive, search...', 'energia'),
            'options'  => array(
                'left'  => esc_html__('Left', 'energia'),
                'right' => esc_html__('Right', 'energia'),
                'none'  => esc_html__('Disabled', 'energia')
            ),
            'default'  => 'right'
        ),
        array(
            'id'       => 'archive_author_on',
            'title'    => esc_html__('Author', 'energia'),
            'subtitle' => esc_html__('Show author name on each post.', 'energia'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'archive_date_on',
            'title'    => esc_html__('Date', 'energia'),
            'subtitle' => esc_html__('Show date posted on each post.', 'energia'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_categories_on',
            'title'    => esc_html__('Categories', 'energia'),
            'subtitle' => esc_html__('Show category names on each post.', 'energia'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_comments_on',
            'title'    => esc_html__('Comments', 'energia'),
            'subtitle' => esc_html__('Show comments count on each post.', 'energia'),
            'type'     => 'switch',
            'default'  => true,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'energia'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'post_bg_color',
            'type'        => 'color',
            'title'       => esc_html__('Content Background Color', 'energia'),
            'transparent' => false,
            'default'     => '',
            'required' => array( 0 => 'single_post_layout', 1 => 'equals', 2 => 'real-estate' ),
            'force_output' => true
        ),
        array(
            'id'       => 'post_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'energia'),
            'subtitle' => esc_html__('Select a sidebar position', 'energia'),
            'options'  => array(
                'left'  => esc_html__('Left', 'energia'),
                'right' => esc_html__('Right', 'energia'),
                'none'  => esc_html__('Disabled', 'energia')
            ),
            'default'  => 'right'
        ),
        array(
            'id' => 'post_title_on',
            'title' => esc_html__('Title', 'energia'),
            'subtitle' => esc_html__('Show title on single post.', 'energia'),
            'type' => 'switch',
            'default' => false
        ),
        array(
            'id'       => 'post_author_on',
            'title'    => esc_html__('Author', 'energia'),
            'subtitle' => esc_html__('Show author name on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_author_info_on',
            'title'    => esc_html__('Author Info', 'energia'),
            'subtitle' => esc_html__('Show author info name on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => false
        ),
        array(
            'id'       => 'post_date_on',
            'title'    => esc_html__('Date', 'energia'),
            'subtitle' => esc_html__('Show date on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_categories_on',
            'title'    => esc_html__('Categories', 'energia'),
            'subtitle' => esc_html__('Show category names on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_tags_on',
            'title'    => esc_html__('Tags', 'energia'),
            'subtitle' => esc_html__('Show tag names on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_comments_on',
            'title'    => esc_html__('Comments', 'energia'),
            'subtitle' => esc_html__('Show comments count on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => false
        ),
        array(
            'id'       => 'post_social_share_on',
            'title'    => esc_html__('Social Share', 'energia'),
            'subtitle' => esc_html__('Show social share on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'post_navigation_on',
            'title'    => esc_html__('Navigation', 'energia'),
            'subtitle' => esc_html__('Show navigation on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'post_comments_form_on',
            'title'    => esc_html__('Comments Form', 'energia'),
            'subtitle' => esc_html__('Show comments form on single post.', 'energia'),
            'type'     => 'switch',
            'default'  => true
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Post Type Slug', 'energia'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'service_slug',
            'type' => 'text',
            'title' => esc_html__('Service Slug', 'energia'),
            'default' => '',
            'subtitle' => esc_html__('The slug name cannot be the same as a page name. Make sure to regenertate permalinks, after making changes.', 'energia'),
        ),
        array(
            'id' => 'project_slug',
            'type' => 'text',
            'title' => esc_html__('Project Slug', 'energia'),
            'default' => '',
            'subtitle' => esc_html__('The slug name cannot be the same as a page name. Make sure to regenertate permalinks, after making changes.', 'energia'),
        ),
        array(
            'id'      => 'single_archive_url',
            'type'    => 'text',
            'title'   => esc_html__('Single Doctor Archive Url', 'energia'),
            'default' => '',
        ),
    )
));

/*--------------------------------------------------------------
# Shop
--------------------------------------------------------------*/
if(class_exists('Woocommerce')) {
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Shop', 'energia'),
        'icon'   => 'el el-shopping-cart',
        'fields' => array(
            array(
                'id'       => 'sidebar_shop',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Position', 'energia'),
                'subtitle' => esc_html__('Select a sidebar position for archive shop.', 'energia'),
                'options'  => array(
                    'left'  => esc_html__('Left', 'energia'),
                    'right' => esc_html__('Right', 'energia'),
                    'none'  => esc_html__('Disabled', 'energia')
                ),
                'default'  => 'right'
            ),
            array(
                'title' => esc_html__('Products displayed per page', 'energia'),
                'id' => 'product_per_page',
                'type' => 'slider',
                'subtitle' => esc_html__('Number product to show', 'energia'),
                'default' => 9,
                'min'  => 4,
                'step' => 1,
                'max' => 50,
                'display_value' => 'text'
            ),
            array(
                'id' => 'product_per_row',
                'type' => 'button_set',
                'title' => esc_html__('Product per row', 'energia'),
                'options' => array(
                    '3' => esc_html__('3 Column', 'energia'),
                    '4' => esc_html__('4 Column', 'energia'),
                    '5' => esc_html__('5 Column', 'energia'),
                ),
                'default' => '4',
                'force_output' => true
            ),
            array(
                'id'       => 'shop_ptitle_bg',
                'type'     => 'background',
                'title'    => esc_html__('Page Title Background', 'energia'),
                'subtitle' => esc_html__('Shop Products Page title background.', 'energia'),
                'output'   => array('body.woocommerce.archive #pagetitle'),
                'required' => array( 0 => 'pagetitle', 1 => 'equals', 2 => 'show' ),
                'force_output' => true,
                'transparent' => false,
            ),
            array(
                'id' => 'content_paddings',
                'type' => 'spacing',
                'title' => esc_html__('Content Paddings', 'energia'),
                'subtitle' => esc_html__('Content shop paddings.', 'energia'),
                'mode' => 'padding',
                'units' => array('em', 'px', '%'),
                'top' => true,
                'right' => false,
                'bottom' => true,
                'left' => false,
                'output' => array('body.woocommerce #content'),
                'default' => array(
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'units' => 'px',
                )
            ),
        )
    ));
}

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Footer', 'energia'),
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'       => 'footer_layout',
            'type'     => 'button_set',
            'title'    => esc_html__('Layout', 'energia'),
            'subtitle' => esc_html__('Select a layout for upper footer area.', 'energia'),
            'options'  => array(
                'custom'  => esc_html__('Custom', 'energia'),
                '0'  => esc_html__('No Footer', 'energia'),
            ),
            'default'  => 'custom'
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
        array(
            'id' => 'back_totop_on',
            'type' => 'switch',
            'title' => esc_html__('Back to Top Button', 'energia'),
            'subtitle' => esc_html__('Show back to top button when scrolled down.', 'energia'),
            'default' => true
        ),
    )
));

/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Colors', 'energia'),
    'icon'   => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'energia'),
            'subtitle'    => esc_html__('Main Color', 'energia'),
            'transparent' => false,
            'default'     => '#32c36c'
        ),
        array(
            'id'          => 'secondary_color',
            'type'        => 'color',
            'title'       => esc_html__('Secondary Color', 'energia'),
            'subtitle'    => esc_html__('For Title, Heading', 'energia'),
            'transparent' => false,
            'default'     => '#253745'
        ),
        array(
            'id' => 'theme_color_01',
            'type' => 'color',
            'title' => esc_html__('Theme Color 01', 'energia'),
            'subtitle'    => esc_html__('Used in several places', 'energia'),
            'transparent' => false,
            'default' => '#616161'
        ),
        array(
            'id' => 'theme_color_02',
            'type' => 'color',
            'title' => esc_html__('Theme Color 02', 'energia'),
            'subtitle'    => esc_html__('Used in several places', 'energia'),
            'transparent' => false,
            'default' => '#2b3e4b'
        ),
        array(
            'id' => 'theme_color_03',
            'type' => 'color',
            'title' => esc_html__('Theme Color 03', 'energia'),
            'subtitle'    => esc_html__('Used in several places', 'energia'),
            'transparent' => false,
            'default' => '#4aab3d'
        ),
        array(
            'id'      => 'link_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Link Colors', 'energia'),
            'default' => array(
                'regular' => 'inherit',
                'hover'   => '#32c36c',
                'active'  => '#32c36c'
            ),
            'output'  => array('a')
        )
    )
));

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
$custom_font_selectors_1 = Redux::getOption($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'energia'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'       => 'body_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Body Default Font', 'energia'),
            'options'  => array(
                'Default'  => esc_html__('Default', 'energia'),
                'Google-Font'  => esc_html__('Google Font', 'energia'),
            ),
            'default'  => 'Default',
        ),
        array(
            'id'          => 'font_main',
            'type'        => 'typography',
            'title'       => esc_html__('Body Google Font', 'energia'),
            'subtitle'    => esc_html__('This will be the default font of your website.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'line-height'  => true,
            'font-size'  => true,
            'text-align'  => false,
            'output'      => array('body'),
            'units'       => 'px',
            'required' => array( 0 => 'body_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'       => 'heading_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Heading Default Font', 'energia'),
            'options'  => array(
                'Default'  => esc_html__('Default', 'energia'),
                'Google-Font'  => esc_html__('Google Font', 'energia'),
            ),
            'default'  => 'Default',
        ),
        array(
            'id'          => 'font_h1',
            'type'        => 'typography',
            'title'       => esc_html__('H1', 'energia'),
            'subtitle'    => esc_html__('This will be the default font for all H1 tags of your website.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h1', '.h1', '.text-heading'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h2',
            'type'        => 'typography',
            'title'       => esc_html__('H2', 'energia'),
            'subtitle'    => esc_html__('This will be the default font for all H2 tags of your website.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h2', '.h2'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h3',
            'type'        => 'typography',
            'title'       => esc_html__('H3', 'energia'),
            'subtitle'    => esc_html__('This will be the default font for all H3 tags of your website.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h3', '.h3'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h4',
            'type'        => 'typography',
            'title'       => esc_html__('H4', 'energia'),
            'subtitle'    => esc_html__('This will be the default font for all H4 tags of your website.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h4', '.h4'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h5',
            'type'        => 'typography',
            'title'       => esc_html__('H5', 'energia'),
            'subtitle'    => esc_html__('This will be the default font for all H5 tags of your website.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h5', '.h5'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h6',
            'type'        => 'typography',
            'title'       => esc_html__('H6', 'energia'),
            'subtitle'    => esc_html__('This will be the default font for all H6 tags of your website.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => array('h6', '.h6'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Fonts Selectors', 'energia'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_1',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'energia'),
            'subtitle'    => esc_html__('This will be the font that applies to the class selector.', 'energia'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => $custom_font_selectors_1,
            'units'       => 'px',

        ),
        array(
            'id'       => 'custom_font_selectors_1',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'energia'),
            'subtitle' => esc_html__('Add class selectors to apply above font.', 'energia'),
            'validate' => 'no_html'
        )
    )
));

/* 404 Page /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('404 Page', 'energia'),
    'icon'   => 'el-cog-alt el',
    'fields' => array(
        array(
            'id'       => 'heading_404_page',
            'type'     => 'text',
            'title'    => esc_html__('Heading Text', 'energia'),
            'default' => '',
        ),
        array(
            'id'       => 'content_404_page',
            'type'     => 'textarea',
            'title'    => esc_html__('Content', 'energia'),
            'default' => '',
        ),
        array(
            'id'       => 'btn_text_404_page',
            'type'     => 'text',
            'title'    => esc_html__('Button Text', 'energia'),
            'default' => '',
            'desc' => esc_html__('Default: Take me go back home', 'energia')
        ),
        array(
            'id'       => 'bg_404_page',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'energia'),
            'output'   => array('body.error404 .error-404'),
            'background-color' => false
        ),
    ),
));

/* Social Media */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Social Media', 'energia'),
    'icon' => 'el el-twitter',
    'subsection' => false,
    'fields' => array(
        array(
            'id' => 'social_media',
            'type' => 'sorter',
            'title' => 'Enable and Sort',
            'desc' => 'Choose which social networks are displayed and edit where they link to.',
            'options' => array(
                'enabled' => array(),
                'disabled' => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'instagram' => 'Instagram',
                    'behance' => 'Behance',
                    'dribbble' => 'Dribbble',
                    'google' => 'Google',
                    'youtube' => 'Youtube',
                    'vimeo' => 'Vimeo',
                    'tumblr' => 'Tumblr',
                    'pinterest' => 'Pinterest',
                    'yelp' => 'Yelp',
                    'skype' => 'Skype',
                    'linkedin' => 'Linkedin',
                    'rss' => 'Rss',
                )
            ),
        ),
        array(
            'id'      => 'social_facebook_url',
            'type'    => 'text',
            'title'   => esc_html__('Facebook URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_twitter_url',
            'type'    => 'text',
            'title'   => esc_html__('Twitter URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_instagram_url',
            'type'    => 'text',
            'title'   => esc_html__('Instagram URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_behance_url',
            'type'    => 'text',
            'title'   => esc_html__('Behance URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_dribbble_url',
            'type'    => 'text',
            'title'   => esc_html__('Dribbble URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_inkedin_url',
            'type'    => 'text',
            'title'   => esc_html__('Inkedin URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_rss_url',
            'type'    => 'text',
            'title'   => esc_html__('Rss URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_google_url',
            'type'    => 'text',
            'title'   => esc_html__('Google URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_skype_url',
            'type'    => 'text',
            'title'   => esc_html__('Skype URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_pinterest_url',
            'type'    => 'text',
            'title'   => esc_html__('Pinterest URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_vimeo_url',
            'type'    => 'text',
            'title'   => esc_html__('Vimeo URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_youtube_url',
            'type'    => 'text',
            'title'   => esc_html__('Youtube URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_yelp_url',
            'type'    => 'text',
            'title'   => esc_html__('Yelp URL', 'energia'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tumblr_url',
            'type'    => 'text',
            'title'   => esc_html__('Tumblr URL', 'energia'),
            'default' => '',
        ),
    )
));

/* Custom Code /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom Code', 'energia'),
    'icon'   => 'el-icon-edit',
    'fields' => array(

        array(
            'id'       => 'site_header_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Header Custom Codes', 'energia'),
            'subtitle' => esc_html__('It will insert the code to wp_head hook.', 'energia'),
        ),
        array(
            'id'       => 'site_footer_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Footer Custom Codes', 'energia'),
            'subtitle' => esc_html__('It will insert the code to wp_footer hook.', 'energia'),
        ),

    ),
));

/* Custom CSS /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom CSS', 'energia'),
    'icon'   => 'el-icon-adjust-alt',
    'fields' => array(

        array(
            'id'   => 'customcss',
            'type' => 'info',
            'desc' => esc_html__('Custom CSS', 'energia')
        ),

        array(
            'id'       => 'site_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'energia'),
            'subtitle' => esc_html__('Advanced CSS Options. You can paste your custom CSS Code here.', 'energia'),
            'mode'     => 'css',
            'validate' => 'css',
            'theme'    => 'chrome',
            'default'  => ""
        ),

    ),
));