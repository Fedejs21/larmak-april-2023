<?php
/**
 * Helper functions for the theme
 *
 * @package Energia
 */

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function energia_get_opt( $opt_id, $default = false ) {
	$opt_name = energia_get_opt_name();
	if ( empty( $opt_name ) ) {
		return $default;
	}

	global ${$opt_name};
	if ( ! isset( ${$opt_name} ) || ! isset( ${$opt_name}[ $opt_id ] ) ) {
		$options = get_option( $opt_name );
	} else {
		$options = ${$opt_name};
	}
	if ( ! isset( $options ) || ! isset( $options[ $opt_id ] ) || $options[ $opt_id ] === '' ) {
		return $default;
	}
	if ( is_array( $options[ $opt_id ] ) && is_array( $default ) ) {
		foreach ( $options[ $opt_id ] as $key => $value ) {
			if ( isset( $default[ $key ] ) && $value === '' ) {
				$options[ $opt_id ][ $key ] = $default[ $key ];
			}
		}
	}

	return $options[ $opt_id ];
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function energia_get_page_opt( $opt_id, $default = false ) {
	$page_opt_name = energia_get_page_opt_name();
	if ( empty( $page_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}

	// Get page option for Shop Page
    if(class_exists('WooCommerce') && is_shop()){
        $id = get_option( 'woocommerce_shop_page_id' );
    }

	return $options = ! empty($id) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}

/**
 *
 * Get post format values.
 *
 * @param $post_format_key
 * @param bool $default
 *
 * @return bool|mixed
 */
function energia_get_post_format_value( $post_format_key, $default = false ) {
	global $post;

	return $value = ! empty( $post->ID ) ? get_post_meta( $post->ID, $post_format_key, true ) : $default;
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function energia_get_opt_name() {
	return apply_filters( 'energia_opt_name', 'cms_theme_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function energia_get_page_opt_name() {
	return apply_filters( 'energia_page_opt_name', 'cms_page_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function energia_get_post_opt_name() {
	return apply_filters( 'energia_post_opt_name', 'energia_post_options' );
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title'
 */
function energia_get_page_titles() {
	$title = '';

	// Default titles
	if ( ! is_archive() ) {
		// Posts page view
		if ( is_home() ) {
			// Only available if posts page is set.
			if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
				$title = get_post_meta( $page_for_posts, 'custom_title', true );
				if ( empty( $title ) ) {
					$title = get_the_title( $page_for_posts );
				}
			}
			if ( is_front_page() ) {
				$title = esc_html__( 'Blog', 'energia' );
			}
		} // Single page view
        elseif ( is_page() ) {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		} elseif ( is_404() ) {
			$title = esc_html__( '404', 'energia' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results', 'energia' );
		} else {
			$title = get_post_meta( get_the_ID(), 'custom_title', true );
			if ( ! $title ) {
				$title = get_the_title();
			}
		}
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author:', 'energia' ) . ' ' . get_the_author();
	} // Author
	else {
		$title = get_the_archive_title();
		if( (class_exists( 'WooCommerce' ) && is_shop()) ) {
			$title = esc_html__( 'Our Products', 'energia' );
		}
	}

	return array(
		'title' => $title,
	);
}

/**
 * Generates an excerpt from the post content with custom length.
 * Default length is 55 words, same as default the_excerpt()
 *
 * The excerpt words amount will be 55 words and if the amount is greater than
 * that, then the string '&hellip;' will be appended to the excerpt. If the string
 * is less than 55 words, then the content will be returned as it is.
 *
 * @param int $length Optional. Custom excerpt length, default to 55.
 * @param int|WP_Post $post Optional. You will need to provide post id or post object if used outside loops.
 *
 * @return string           The excerpt with custom length.
 */
function energia_get_the_excerpt( $length = 55, $post = null ) {
	$post = get_post( $post );

	if ( empty( $post ) || 0 >= $length ) {
		return '';
	}

	if ( post_password_required( $post ) ) {
		return esc_html__( 'Post password required.', 'energia' );
	}

	$content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$excerpt_more = apply_filters( 'energia_excerpt_more', '&hellip;' );
	$excerpt      = wp_trim_words( $content, $length, $excerpt_more );

	return $excerpt;
}


/**
 * Check if provided color string is valid color.
 * Only supports 'transparent', HEX, RGB, RGBA.
 *
 * @param  string $color
 *
 * @return boolean
 */
function energia_is_valid_color( $color ) {
	$color = preg_replace( "/\s+/m", '', $color );

	if ( $color === 'transparent' ) {
		return true;
	}

	if ( '' == $color ) {
		return false;
	}

	// Hex format
	if ( preg_match( "/(?:^#[a-fA-F0-9]{6}$)|(?:^#[a-fA-F0-9]{3}$)/", $color ) ) {
		return true;
	}

	// rgb or rgba format
	if ( preg_match( "/(?:^rgba\(\d+\,\d+\,\d+\,(?:\d*(?:\.\d+)?)\)$)|(?:^rgb\(\d+\,\d+\,\d+\)$)/", $color ) ) {
		preg_match_all( "/\d+\.*\d*/", $color, $matches );
		if ( empty( $matches ) || empty( $matches[0] ) ) {
			return false;
		}

		$red   = empty( $matches[0][0] ) ? $matches[0][0] : 0;
		$green = empty( $matches[0][1] ) ? $matches[0][1] : 0;
		$blue  = empty( $matches[0][2] ) ? $matches[0][2] : 0;
		$alpha = empty( $matches[0][3] ) ? $matches[0][3] : 1;

		if ( $red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255 || $alpha < 0 || $alpha > 1.0 ) {
			return false;
		}
	} else {
		return false;
	}

	return true;
}

/**
 * Minify css
 *
 * @param  string $css
 *
 * @return string
 */
function energia_css_minifier( $css ) {
	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );
	// Remove spaces before and after comment
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	// Remove comment blocks, everything between /* and */, unless
	// preserved with /*! ... */ or /** ... */
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	// Remove space before , ; { } ( ) >
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	// Converts all zeros value into short-hand
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	// Shortern 6-character hex color codes to 3-character where possible
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}

/**
 * Header Tracking Code to wp_head hook.
 */
function energia_header_code() {
	$site_header_code = energia_get_opt( 'site_header_code' );
	if ( $site_header_code !== '' ) {
		print wp_kses( $site_header_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_head', 'energia_header_code' );

/**
 * Footer Tracking Code to wp_footer hook.
 */
function energia_footer_code() {
	$site_footer_code = energia_get_opt( 'site_footer_code' );
	if ( $site_footer_code !== '' ) {
		print wp_kses( $site_footer_code, wp_kses_allowed_html() );
	}
}

add_action( 'wp_footer', 'energia_footer_code' );

/**
 * Custom Comment List
 */
function energia_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo ''.$tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		    <div class="comment-inner">
		        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 90); ?>
		        <div class="comment-content">
		            <h4 class="comment-title">
		            	<?php printf( '%s', get_comment_author_link() ); ?>
		            </h4>
		            <div class="comment-meta">
		            	<span class="comment-date">
	                        <?php echo get_comment_date().' - '.get_comment_time(); ?>
	                    </span>
		            </div>
		            <div class="comment-text"><?php comment_text(); ?></div>
		            <div class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array(
							'add_below' => $add_below,
							'depth'     => $depth,
							'max_depth' => $args['max_depth']
						) ) ); ?>
		            </div>
		        </div>
		    </div>
		<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif;
}

/**
 * Add field subtitle to post.
 */
function energia_add_subtitle_field() {
	global $post;

	$screen = get_current_screen();

	if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

		$value = get_post_meta( $post->ID, 'post_subtitle', true );

		echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_html__( 'Subtitle', 'energia' ) . '" style="width: 100%;margin-top: 4px;"></div>';
	}
}

add_action( 'edit_form_after_title', 'energia_add_subtitle_field' );

/**
 * Save custom theme meta
 */
function energia_save_meta_boxes( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_subtitle'] ) ) {
		update_post_meta( $post_id, 'post_subtitle', $_POST['post_subtitle'] );
	}
}

add_action( 'save_post', 'energia_save_meta_boxes' );

// Custom Post type
add_filter( 'cms_extra_post_types', 'energia_add_posttype' );
function energia_add_posttype( $postypes ) {
	$postypes['portfolio'] = array(
		'status' => false,
		'args'       => array(
			'rewrite'             => array(
                'slug'       => ''
 		 	),
		),
	);

	$service_slug = energia_get_opt( 'service_slug', 'solution' );
	$postypes['service'] = array(
		'status'     => true,
		'item_name'  => esc_html__( 'Services', 'energia' ),
		'items_name' => esc_html__( 'Services', 'energia' ),
		'args'       => array(
			'menu_icon'          => 'dashicons-hammer',
			'supports'           => array(
				'title',
				'thumbnail',
				'editor',
                'excerpt',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'             => array(
                'slug'       => $service_slug
 		 	),
		),
        'labels'     => array(
            'add_new_item' => esc_html__('Add New Service', 'energia'),
            'edit_item' => esc_html__('Edit Service', 'energia'),
            'view_item' => esc_html__('View Service', 'energia'),
        )
	);

    $project_slug = energia_get_opt( 'project_slug', 'project' );
    $postypes['project'] = array(
        'status'     => true,
        'item_name'  => esc_html__( 'Projects', 'energia' ),
        'items_name' => esc_html__( 'Projects', 'energia' ),
        'args'       => array(
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'taxonomies' => array('post_tag'),
            'rewrite'             => array(
                'slug'       => $project_slug
            ),
        ),
        'labels'     => array(
            'add_new_item' => esc_html__('Add New Project', 'energia'),
            'edit_item' => esc_html__('Edit Project', 'energia'),
            'view_item' => esc_html__('View Project', 'energia'),
        )
    );
    $postypes['footer'] = array(
        'status'     => true,
        'item_name'  => esc_html__( 'Footers', 'energia' ),
        'items_name' => esc_html__( 'Footers', 'energia' ),
        'args'       => array(
            'menu_icon'          => 'dashicons-editor-insertmore',
            'supports'           => array(
                'title',
                'editor',
            ),
            'public'             => true,
            'publicly_queryable' => true,
        ),
        'labels'     => array()
    );
	return $postypes;
}

add_filter( 'cms_extra_taxonomies', 'energia_add_tax' );
function energia_add_tax( $taxonomies ) {
	$taxonomies['service-category'] = array(
		'status'     => true,
		'post_type'  => array( 'service' ),
		'taxonomy' => esc_html__( 'Category', 'energia' ),
		'taxonomies' => esc_html__( 'Categories', 'energia' ),
		'args'       => array(),
		'labels'     => array()
	);
    $taxonomies['project-category'] = array(
        'status'     => true,
        'post_type'  => array( 'project' ),
        'taxonomy' => esc_html__( 'Category', 'energia' ),
        'taxonomies' => esc_html__( 'Categories', 'energia' ),
        'args'       => array(),
        'labels'     => array()
    );
	
	return $taxonomies;
}

function energia_add_cpt_support() {
    $cpt_support = get_option( 'elementor_cpt_support' );

    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'service', 'project', 'footer', 'cms-mega-menu' ];
        update_option( 'elementor_cpt_support', $cpt_support );
    } else if( ! in_array( 'service', $cpt_support ) ) {
        $cpt_support[] = 'service';
        update_option( 'elementor_cpt_support', $cpt_support );
    } else if( ! in_array( 'project', $cpt_support ) ) {
        $cpt_support[] = 'project';
        update_option( 'elementor_cpt_support', $cpt_support );
    } else if( ! in_array( 'footer', $cpt_support ) ) {
        $cpt_support[] = 'footer';
        update_option( 'elementor_cpt_support', $cpt_support );
    } else if( ! in_array( 'cms-mega-menu', $cpt_support ) ) {
        $cpt_support[] = 'cms-mega-menu';
        update_option( 'elementor_cpt_support', $cpt_support );
    }
}
add_action( 'after_switch_theme', 'energia_add_cpt_support');

/**
 * Get Post List
 */
if(!function_exists('energia_list_post')){
    function energia_list_post($post_type = 'post', $default = false){
        $post_list = array();
        $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1'));
        foreach($posts as $post){
            $post_list[$post->ID] = $post->post_title;
        }
        return $post_list;
    }
}

add_filter( 'cms_enable_megamenu', 'energia_enable_megamenu' );
function energia_enable_megamenu() {
	return false;
}
add_filter( 'cms_enable_onepage', 'energia_enable_onepage' );
function energia_enable_onepage() {
	return false;
}

// remove <br> in contact form7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/* Show/hide CMS Carousel */
add_filter( 'enable_cms_carousel', 'energia_enable_cms_carousel' );
function energia_enable_cms_carousel() {
	return false;
}

/* ------Disable Lazy loading---- */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

/* Create Demo Data */
add_filter('swa_ie_export_mode', 'energia_enable_export_mode');
function energia_enable_export_mode()
{
    return false;
}
add_filter('swa_post_types', 'function_swa_post_types');
function function_swa_post_types($post_type)
{
    $post_type[] = 'timetable_weekdays';
    $post_type[] = 'events';
    return $post_type;
}
/* Dashboard Theme */
add_filter('cms_documentation_link',function(){
     return 'http://doc.farost.net/energia';
});

add_filter('cms_ticket_link', 'energia_add_cms_ticket_link');
function energia_add_cms_ticket_link($url)
{
    $url = array('type' => 'url', 'link' => '#');
    return $url;
}
add_filter('cms_video_tutorial_link',function(){
     return '#';
});

add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'energia-elementor-custom-editor', get_template_directory_uri() . '/assets/css/elementor-custom-editor.css', array(), '1.0.0' );
} );