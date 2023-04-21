<?php
/**
 * Custom template tags for this theme.
 *
 * @package Energia
 */

/**
 * Header layout
 **/
function energia_page_loading()
{
    $page_loading = energia_get_opt( 'show_page_loading', false );

    if($page_loading) { ?>
        <div id="cms-loadding" class="cms-loader">
            <div class="loading-center-absolute">
                <div class="lds-dual-ring"></div>
            </div>
        </div>
    <?php }
}

/**
 * Header layout
 **/
function energia_header_layout()
{
    $header_layout = energia_get_opt( 'header_layout', '1' );
    $custom_header = energia_get_page_opt( 'custom_header', '0' );

    if ( $custom_header == '1' && is_page() || $custom_header == '1' || $custom_header == '1' && is_singular('service') || $custom_header == '1' && is_singular('project') )
    {
        $page_header_layout = energia_get_page_opt('header_layout');
        $header_layout = $page_header_layout;
        if($header_layout == '0') {
            return;
        }
    }
    if (is_404()){
        $header_layout = '2';
    }
    get_template_part( 'template-parts/header-layout', $header_layout );
}

/**
 * Page title layout
 **/
function energia_page_title_layout()
{
    get_template_part( 'template-parts/page-title', '' );
}

/**
 * Page title layout
 **/
function energia_footer()
{
    if (is_404()) {
        return true;
    }
    $footer_layout = energia_get_opt('footer_layout', 'custom');

    if (is_page()) {
        $page_footer_layout = energia_get_page_opt('footer_layout');
        $footer_layout = $page_footer_layout;
    }
    if ($footer_layout == '0') {
        return true;
    }
    get_template_part('template-parts/footer-layout-custom');
}

/**
 * Set primary content class based on sidebar position
 *
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function energia_primary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) || class_exists( 'WooCommerce' ) && (is_shop()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array( trim( $extra_class ) );
        switch ( $sidebar_pos )
        {
            case 'left':
                $class[] = 'content-has-sidebar float-right col-xl-8 col-lg-8 col-md-12';
                break;

            case 'right':
                $class[] = 'content-has-sidebar float-left col-xl-8 col-lg-8 col-md-12';
                break;

            default:
                $class[] = 'content-full-width col-12';
                break;
        }

        $class = implode( ' ', array_filter( $class ) );

        if ( $class )
        {
            echo ' class="' . esc_html($class) . '"';
        }
    } else {
        echo ' class="content-area col-12"';
    }
}

/**
 * Set secondary content class based on sidebar position
 *
 * @param  string $sidebar_pos
 * @param  string $extra_class
 */
function energia_secondary_class( $sidebar_pos, $extra_class = '' )
{
    if ( class_exists( 'WooCommerce' ) && (is_product_category()) ) :
        $sidebar_load = 'sidebar-shop';
    elseif (is_page()) :
        $sidebar_load = 'sidebar-page';
    else :
        $sidebar_load = 'sidebar-blog';
    endif;

    if ( is_active_sidebar( $sidebar_load ) ) {
        $class = array(trim($extra_class));
        switch ($sidebar_pos) {
            case 'left':
                $class[] = 'widget-has-sidebar sidebar-fixed col-xl-4 col-lg-4 col-md-12';
                break;

            case 'right':
                $class[] = 'widget-has-sidebar sidebar-fixed col-xl-4 col-lg-4 col-md-12';
                break;

            default:
                break;
        }

        $class = implode(' ', array_filter($class));

        if ($class) {
            echo ' class="' . esc_html($class) . '"';
        }
    }
}


/**
 * Prints HTML for breadcrumbs.
 */
function energia_breadcrumb()
{
    if ( ! class_exists( 'CMS_Breadcrumb' ) )
    {
        return;
    }

    $breadcrumb = new CMS_Breadcrumb();
    $entries = $breadcrumb->get_entries();

    if ( empty( $entries ) )
    {
        return;
    }

    ob_start();

    foreach ( $entries as $entry )
    {
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) )
        {
            continue;
        }

        echo '<li>';

        if ( ! empty( $entry['url'] ) )
        {
            printf(
                '<a class="breadcrumb-entry" href="%1$s">%2$s</a>',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] )
            );
        }
        else
        {
            printf( '<span class="breadcrumb-entry" >%s</span>', esc_html( $entry['label'] ) );
        }

        echo '</li>';
    }

    $output = ob_get_clean();

    if ( $output )
    {
        printf( '<ul class="cms-breadcrumb">%s</ul>', wp_kses_post($output));
    }
}


function energia_entry_link_pages()
{
    wp_link_pages( array(
        'before'      => '<div class="page-links">',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
}


if ( ! function_exists( 'energia_entry_excerpt' ) ) :
    /**
     * Print post excerpt based on length.
     *
     * @param  integer $length
     */
    function energia_entry_excerpt( $length = 55 )
    {
        $cms_the_excerpt = get_the_excerpt();
        if(!empty($cms_the_excerpt)) {
            echo esc_html($cms_the_excerpt);
        } else {
            echo wp_kses_post(energia_get_the_excerpt( $length ));
        }
    }
endif;

/**
 * Prints post edit link when applicable
 */
function energia_entry_edit_link()
{
    edit_post_link(
        sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                esc_html__( 'Edit', 'energia' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<div class="entry-edit-link"><i class="fa fa-edit"></i>',
        '</div>'
    );
}

if(!function_exists('energia_ajax_paginate_links')){
    function energia_ajax_paginate_links($link){
        $parts = parse_url($link);
        parse_str($parts['query'], $query);
        if(isset($query['page']) && !empty($query['page'])){
            return '#' . $query['page'];
        }
        else{
            return '#1';
        }
    }
}

add_action( 'wp_ajax_energia_get_pagination_html', 'energia_get_pagination_html' );
add_action( 'wp_ajax_nopriv_energia_get_pagination_html', 'energia_get_pagination_html' );
if(!function_exists('energia_get_pagination_html')){
    function energia_get_pagination_html(){
        try{
            if(!isset($_POST['query_vars'])){
                throw new Exception(__('Something went wrong while requesting. Please try again!', 'energia'));
            }
            $query = new WP_Query($_POST['query_vars']);
            ob_start();
            energia_posts_pagination( $query,  true );
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status' => true,
                    'message' => esc_html__('Load Successfully!', 'energia'),
                    'data' => array(
                        'html' => $html,
                        'query_vars' => $_POST['query_vars'],
                        'post' => $query->have_posts()
                    ),
                )
            );
        }
        catch (Exception $e){
            wp_send_json(array('status' => false, 'message' => $e->getMessage()));
        }
        die;
    }
}

/**
 * Prints posts pagination based on query
 *
 * @param  WP_Query $query     Custom query, if left blank, this will use global query ( current query )
 * @return void
 */
function energia_posts_pagination( $query = null, $ajax = false )
{
    if($ajax){
        add_filter('paginate_links', 'energia_ajax_paginate_links');
    }

    $classes = array();

    if ( empty( $query ) )
    {
        $query = $GLOBALS['wp_query'];
    }

    if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
    {
        return;
    }

    $paged = $query->get( 'paged', '' );

    if ( ! $paged && is_front_page() && ! is_home() )
    {
        $paged = $query->get( 'page', '' );
    }

    $paged = $paged ? intval( $paged ) : 1;

    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) )
    {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $html_prev = '<i class="fac fac-arrow-left"></i>';
    $html_next = '<i class="fac fac-arrow-right"></i>';
    $paginate_links_args = array(
        'base'     => $pagenum_link,
        'total'    => $query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => $html_prev,
        'next_text' => $html_next,
    );
    if($ajax){
        $paginate_links_args['format'] = '?page=%#%';
    }
    $links = paginate_links( $paginate_links_args );
    if ( $links ):
    ?>
    <nav class="navigation posts-pagination <?php echo esc_attr($ajax?'ajax':''); ?>">
        <div class="posts-page-links">
            <?php
                printf($links);
            ?>
        </div>
    </nav>
    <?php
    endif;
}

/**
 * Prints archive meta on blog
 */
if ( ! function_exists( 'energia_archive_meta' ) ) :
    function energia_archive_meta() {
        $archive_author_on = energia_get_opt( 'archive_author_on', false );
        $archive_categories_on = energia_get_opt( 'archive_categories_on', true );
        $archive_comments_on = energia_get_opt( 'archive_comments_on', true );
        $archive_date_on = energia_get_opt( 'archive_date_on', true );
        if($archive_author_on || $archive_comments_on || $archive_categories_on || $archive_date_on) : ?>
            <ul class="entry-meta">
                <?php if($archive_categories_on && !empty(get_the_terms(get_the_ID(),'category'))) : ?>
                    <li class="item-category"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></li>
                <?php endif; ?>
                <?php if($archive_author_on) : ?>
                    <li class="item-author">
                        <span><?php echo esc_html__('By', 'energia'); ?></span>
                        <?php the_author_posts_link(); ?>
                    </li>
                <?php endif; ?>
                <?php if($archive_date_on) : ?>
                    <li><?php echo get_the_date(); ?></li>
                <?php endif; ?>
                <?php if($archive_comments_on) : ?>
                    <li class="item-comment"><a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_html__('No Comments', 'energia'),esc_html__('Comment: 1', 'energia'),esc_html__('Comments: %', 'energia')); ?></a></li>
                <?php endif; ?>
            </ul>
        <?php endif; }
endif;

if ( ! function_exists( 'energia_post_meta' ) ) :
    function energia_post_meta() {
        $post_author_on = energia_get_opt( 'post_author_on', true );
        $post_categories_on = energia_get_opt( 'post_categories_on', true );
        $post_date_on = energia_get_opt( 'post_date_on', true );
        $post_comments_on = energia_get_opt( 'post_comments_on', false );
        if($post_author_on || $post_comments_on || $post_categories_on || $post_date_on) : ?>
            <ul class="entry-meta">
                <?php if($post_date_on) : ?>
                    <li class="item-date"><?php echo get_the_date(); ?></li>
                <?php endif; ?>
                <?php if($post_categories_on ) : ?>
                    <li class="item-category"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></li>
                <?php endif; ?>
                <?php if($post_author_on) : ?>
                    <li class="item-author">
                        <?php the_author_posts_link(); ?>
                    </li>
                <?php endif; ?>
                <?php if($post_comments_on) : ?>
                    <li class="item-comment">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo comments_number(esc_html__('No Comments', 'energia'),esc_html__('Comment: 1', 'energia'),'<span>Comments: </span>'.esc_html__('%', 'energia')); ?>
                        </a></li>
                <?php endif; ?>
            </ul>
        <?php endif; }
endif;

/**
 * Set Customer Cookie
 */
if ( ! function_exists( 'energia_set_cookie' ) ) :
    function energia_set_cookie($cname, $cvalue, $exdays)
    {
        $extimes = $exdays*24*60*60;
        setcookie($cname, $cvalue, time() + $extimes);
    }
endif;
/**
 * Get Customer Cookie
 */
if ( ! function_exists( 'energia_get_cookie' ) ) :
    function energia_get_cookie($cname)
    {
        if (!empty($_COOKIE[$cname])){
            return $_COOKIE[$cname];
        }else{
            return false;
        }
    }
endif;

/**
 * Prints tag list
 */
if ( ! function_exists( 'energia_entry_tagged_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function energia_entry_tagged_in()
    {
        ob_start();
        $before_tags = ob_get_clean();
        $tags_list = get_the_tag_list( $before_tags, ', ' );
        if ( $tags_list )
        {
            echo '<div class="clearfix">';
            echo '<div class="entry-tags">';
            printf('%2$s', '', $tags_list);
            echo '</div>';
            echo '</div>';
        }
    }
endif;

/**
 * List socials share for post.
 */
function energia_socials_share_default() { ?>
    <div class="entry-social-wrap">
        <label><?php echo esc_html__('Share', 'energia');?></label>
        <ul>
            <li><a class="fb-social" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>"><i class="fab fac-facebook-f"></i></a></li>
            <li><a class="tw-social" title="Twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fab fac-twitter"></i></a></li>
            <li><a class="pin-social" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_post_thumbnail_url('full'); ?>&media=&description=<?php echo urlencode(the_title_attribute('echo=0')); ?>"><i class="fab fac-pinterest-p"></i></a></li>
        </ul>
    </div>
    <?php
}

/**
 * Related Project
 */
function energia_project_related_post()
{
    $post_related_on = true;
    if($post_related_on) {
        global $post;
        $current_id = $post->ID;
        $post_number = '5';
        $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'project', 'post_status' => 'publish'));
        if (count($query_similar->posts) > 1) {
            wp_enqueue_script( 'owl-carousel' );
            wp_enqueue_script( 'energia-carousel' );
            ?>
            <div class="cms-related-post">
                <h4 class="widget-title"><?php echo esc_html__('Related Posts', 'energia'); ?></h4>
                <div class="cms-related-post-inner owl-carousel" data-item-xs="1" data-item-sm="2" data-item-md="3" data-item-lg="3" data-item-xl="3" data-item-xxl="3" data-margin="30" data-loop="false" data-autoplay="false" data-autoplaytimeout="5000" data-smartspeed="250" data-center="false" data-arrows="false" data-bullets="true" data-stagepadding="0" data-stagepaddingsm="0" data-rtl="false">
                    <?php foreach ($query_similar->posts as $post):
                        $thumbnail_url = '';
                        if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                            $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'energia-medium', false);
                        endif;
                        if ($post->ID !== $current_id) : ?>
                            <div class="grid-item">
                                <div class="grid-item-inner">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="item-featured">
                                            <a href="<?php the_permalink(); ?>"><img alt="<?php echo esc_attr__('project image', 'energia');?>" src="<?php echo esc_url($thumbnail_url[0]); ?>" /></a>
                                        </div>
                                    <?php } ?>
                                    <div class="body-content">
                                        <h3 class="item-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="item-category"><?php the_terms( $post->ID, 'project-category', '', ', ' ); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        <?php }
    }

    wp_reset_postdata();
}
/**
 * Search Popup
 */
function energia_search_popup()
{
    $search_on = energia_get_opt( 'search_on', false );
    if($search_on) { ?>
        <div class="cms-modal cms-modal-search">
            <div class="cms-modal-close"><i class="zmdi zmdi-close"></i></div>
            <div class="cms-modal-content">
                <form role="search" method="get" class="search-form-popup" action="<?php echo esc_url(home_url( '/' )); ?>">
                    <div class="searchform-wrap">
                        <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                        <input type="text" placeholder="<?php echo esc_attr__('Type Words Then Enter', 'energia'); ?>" id="search" name="s" class="search-field" />
                    </div>
                </form>
            </div>
        </div>
    <?php }
}
/**
 * Sidebar Hidden
 */
function energia_sidebar_hidden()
{
    $hidden_sidebar_on = energia_get_opt( 'hidden_sidebar_on', false );
    if($hidden_sidebar_on && is_active_sidebar('sidebar-hidden')) { ?>
        <div class="cms-hidden-sidebar">
            <div class="cms-hidden-close fa fa-close"></div>
            <div class="cms-hidden-sidebar-inner">
                <?php dynamic_sidebar( 'sidebar-hidden' ); ?>
            </div>
        </div>
    <?php }
}
/**
 * User custom fields.
 */
add_action( 'show_user_profile', 'energia_user_fields' );
add_action( 'edit_user_profile', 'energia_user_fields' );
function energia_user_fields($user){

    $user_facebook = get_user_meta($user->ID, 'user_facebook', true);
    $user_twitter = get_user_meta($user->ID, 'user_twitter', true);
    $user_linkedin = get_user_meta($user->ID, 'user_linkedin', true);
    $user_skype = get_user_meta($user->ID, 'user_skype', true);
    $user_google = get_user_meta($user->ID, 'user_google', true);
    $user_youtube = get_user_meta($user->ID, 'user_youtube', true);
    $user_vimeo = get_user_meta($user->ID, 'user_vimeo', true);
    $user_tumblr = get_user_meta($user->ID, 'user_tumblr', true);
    $user_rss = get_user_meta($user->ID, 'user_rss', true);
    $user_pinterest = get_user_meta($user->ID, 'user_pinterest', true);
    $user_instagram = get_user_meta($user->ID, 'user_instagram', true);
    $user_yelp = get_user_meta($user->ID, 'user_yelp', true);

    ?>
    <h3><?php esc_html_e('Social', 'energia'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_facebook"><?php esc_html_e('Facebook', 'energia'); ?></label></th>
            <td>
                <input id="user_facebook" name="user_facebook" type="text" value="<?php echo esc_attr(isset($user_facebook) ? $user_facebook : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_twitter"><?php esc_html_e('Twitter', 'energia'); ?></label></th>
            <td>
                <input id="user_twitter" name="user_twitter" type="text" value="<?php echo esc_attr(isset($user_twitter) ? $user_twitter : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_linkedin"><?php esc_html_e('Linkedin', 'energia'); ?></label></th>
            <td>
                <input id="user_linkedin" name="user_linkedin" type="text" value="<?php echo esc_attr(isset($user_linkedin) ? $user_linkedin : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_skype"><?php esc_html_e('Skype', 'energia'); ?></label></th>
            <td>
                <input id="user_skype" name="user_skype" type="text" value="<?php echo esc_attr(isset($user_skype) ? $user_skype : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_google"><?php esc_html_e('Google', 'energia'); ?></label></th>
            <td>
                <input id="user_google" name="user_google" type="text" value="<?php echo esc_attr(isset($user_google) ? $user_google : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_youtube"><?php esc_html_e('Youtube', 'energia'); ?></label></th>
            <td>
                <input id="user_youtube" name="user_youtube" type="text" value="<?php echo esc_attr(isset($user_youtube) ? $user_youtube : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_vimeo"><?php esc_html_e('Vimeo', 'energia'); ?></label></th>
            <td>
                <input id="user_vimeo" name="user_vimeo" type="text" value="<?php echo esc_attr(isset($user_vimeo) ? $user_vimeo : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_tumblr"><?php esc_html_e('Tumblr', 'energia'); ?></label></th>
            <td>
                <input id="user_tumblr" name="user_tumblr" type="text" value="<?php echo esc_attr(isset($user_tumblr) ? $user_tumblr : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_rss"><?php esc_html_e('Rss', 'energia'); ?></label></th>
            <td>
                <input id="user_rss" name="user_rss" type="text" value="<?php echo esc_attr(isset($user_rss) ? $user_rss : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_pinterest"><?php esc_html_e('Pinterest', 'energia'); ?></label></th>
            <td>
                <input id="user_pinterest" name="user_pinterest" type="text" value="<?php echo esc_attr(isset($user_pinterest) ? $user_pinterest : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_instagram"><?php esc_html_e('Instagram', 'energia'); ?></label></th>
            <td>
                <input id="user_instagram" name="user_instagram" type="text" value="<?php echo esc_attr(isset($user_instagram) ? $user_instagram : ''); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="user_yelp"><?php esc_html_e('Yelp', 'energia'); ?></label></th>
            <td>
                <input id="user_yelp" name="user_yelp" type="text" value="<?php echo esc_attr(isset($user_yelp) ? $user_yelp : ''); ?>" />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save user custom fields.
 */
add_action( 'personal_options_update', 'energia_save_user_custom_fields' );
add_action( 'edit_user_profile_update', 'energia_save_user_custom_fields' );
function energia_save_user_custom_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    if(isset($_POST['user_facebook']))
        update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
    if(isset($_POST['user_twitter']))
        update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
    if(isset($_POST['user_linkedin']))
        update_user_meta( $user_id, 'user_linkedin', $_POST['user_linkedin'] );
    if(isset($_POST['user_skype']))
        update_user_meta( $user_id, 'user_skype', $_POST['user_skype'] );
    if(isset($_POST['user_google']))
        update_user_meta( $user_id, 'user_google', $_POST['user_google'] );
    if(isset($_POST['user_youtube']))
        update_user_meta( $user_id, 'user_youtube', $_POST['user_youtube'] );
    if(isset($_POST['user_vimeo']))
        update_user_meta( $user_id, 'user_vimeo', $_POST['user_vimeo'] );
    if(isset($_POST['user_tumblr']))
        update_user_meta( $user_id, 'user_tumblr', $_POST['user_tumblr'] );
    if(isset($_POST['user_rss']))
        update_user_meta( $user_id, 'user_rss', $_POST['user_rss'] );
    if(isset($_POST['user_pinterest']))
        update_user_meta( $user_id, 'user_pinterest', $_POST['user_pinterest'] );
    if(isset($_POST['user_instagram']))
        update_user_meta( $user_id, 'user_instagram', $_POST['user_instagram'] );
    if(isset($_POST['user_yelp']))
        update_user_meta( $user_id, 'user_yelp', $_POST['user_yelp'] );
}
/* Author Social */
function energia_get_user_social() {

    $user_facebook = get_user_meta(get_the_author_meta( 'ID' ), 'user_facebook', true);
    $user_twitter = get_user_meta(get_the_author_meta( 'ID' ), 'user_twitter', true);
    $user_linkedin = get_user_meta(get_the_author_meta( 'ID' ), 'user_linkedin', true);
    $user_skype = get_user_meta(get_the_author_meta( 'ID' ), 'user_skype', true);
    $user_google = get_user_meta(get_the_author_meta( 'ID' ), 'user_google', true);
    $user_youtube = get_user_meta(get_the_author_meta( 'ID' ), 'user_youtube', true);
    $user_vimeo = get_user_meta(get_the_author_meta( 'ID' ), 'user_vimeo', true);
    $user_tumblr = get_user_meta(get_the_author_meta( 'ID' ), 'user_tumblr', true);
    $user_rss = get_user_meta(get_the_author_meta( 'ID' ), 'user_rss', true);
    $user_pinterest = get_user_meta(get_the_author_meta( 'ID' ), 'user_pinterest', true);
    $user_instagram = get_user_meta(get_the_author_meta( 'ID' ), 'user_instagram', true);
    $user_yelp = get_user_meta(get_the_author_meta( 'ID' ), 'user_yelp', true);

    ?>
    <ul class="user-social">
        <?php if(!empty($user_facebook)) { ?>
            <li><a href="<?php echo esc_url($user_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_twitter)) { ?>
            <li><a href="<?php echo esc_url($user_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_rss)) { ?>
            <li><a href="<?php echo esc_url($user_rss); ?>"><i class="fa fa-rss"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_google)) { ?>
            <li><a href="<?php echo esc_url($user_google); ?>"><i class="fa fa-google-plus"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_skype)) { ?>
            <li><a href="<?php echo esc_url($user_skype); ?>"><i class="fa fa-skype"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_pinterest)) { ?>
            <li><a href="<?php echo esc_url($user_pinterest); ?>"><i class="fa fa-pinterest"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_vimeo)) { ?>
            <li><a href="<?php echo esc_url($user_vimeo); ?>"><i class="fa fa-vimeo-square"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_instagram)) { ?>
            <li><a href="<?php echo esc_url($user_instagram); ?>"><i class="fa fa-instagram"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_linkedin)) { ?>
            <li><a href="<?php echo esc_url($user_linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_youtube)) { ?>
            <li><a href="<?php echo esc_url($user_youtube); ?>"><i class="fa fa-youtube"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_yelp)) { ?>
            <li><a href="<?php echo esc_url($user_yelp); ?>"><i class="fa fa-yelp"></i></a></li>
        <?php } ?>
        <?php if(!empty($user_tumblr)) { ?>
            <li><a href="<?php echo esc_url($user_tumblr); ?>"><i class="fa fa-tumblr"></i></a></li>
        <?php } ?>

    </ul> <?php
}

function energia_social_share_product() { ?>
    <a class="fb-social hover-effect" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="zmdi zmdi-facebook"></i></a>
    <a class="tw-social hover-effect" title="Twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="zmdi zmdi-twitter"></i></a>
    <a class="pin-social hover-effect" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(the_post_thumbnail_url( 'full' )); ?>&media=&description=<?php the_title(); ?>"><i class="zmdi zmdi-pinterest"></i></a>
    <?php
}

function energia_product_nav() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="product-previous-next">
            <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { ?>
                <a class="nav-link-prev" href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><i class="fa fa-long-arrow-left"></i></a>
            <?php } ?>
            <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') { ?>
                <a class="nav-link-next" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><i class="fa fa-long-arrow-right"></i></a>
            <?php } ?>
        </div>
    <?php }
}

/**
 * Social Media
 */
function energia_social_media()
{
    $social_media = energia_get_opt('social_media');
    $social = array();
    if (!empty($social_media['enabled'])){
        $social = $social_media['enabled'];
    }
    if ($social) : foreach ($social as $key => $value) { ?>
        <?php switch ($key) {

            case 'facebook':
                echo '<a title="Facebook" href="' . esc_url(energia_get_opt('social_facebook_url')) . '"><i class="fab fac-facebook-f"></i></a>';
                break;

            case 'twitter':
                echo '<a title="Twitter" href="' . esc_url(energia_get_opt('social_twitter_url')) . '"><i class="fab fac-twitter"></i></a>';
                break;

            case 'instagram':
                echo '<a title="Instagram" href="' . esc_url(energia_get_opt('social_instagram_url')) . '"><i class="fab fac-instagram"></i></a>';
                break;

            case 'behance':
                echo '<a title="Behance" href="' . esc_url(energia_get_opt('social_behance_url')) . '"><i class="fab fac-behance"></i></a>';
                break;

            case 'dribbble':
                echo '<a title="Dribbble" href="' . esc_url(energia_get_opt('social_dribbble_url')) . '"><i class="fab fac-dribbble"></i></a>';
                break;

            case 'linkedin':
                echo '<a title="Linkedin" href="' . esc_url(energia_get_opt('social_inkedin_url')) . '"><i class="fab fac-linkedin-in"></i></a>';
                break;

            case 'rss':
                echo '<a title="Rss" href="' . esc_url(energia_get_opt('social_rss_url')) . '"><i class="fas fac-rss"></i></a>';
                break;

            case 'google':
                echo '<a title="Google+" href="' . esc_url(energia_get_opt('social_google_url')) . '"><i class="fab fac-google-plus-g"></i></a>';
                break;

            case 'skype':
                echo '<a title="Skype" href="' . esc_url(energia_get_opt('social_skype_url')) . '"><i class="fab fac-skype"></i></a>';
                break;

            case 'pinterest':
                echo '<a title="Pinterest" href="' . esc_url(energia_get_opt('social_pinterest_url')) . '"><i class="fab fac-pinterest"></i></a>';
                break;

            case 'vimeo':
                echo '<a title="Vimeo" href="' . esc_url(energia_get_opt('social_vimeo_url')) . '"><i class="fab fac-vimeo-v"></i></a>';
                break;

            case 'youtube':
                echo '<a title="Youtube" href="' . esc_url(energia_get_opt('social_youtube_url')) . '"><i class="fab fac-youtube"></i></a>';
                break;

            case 'yelp':
                echo '<a title="Yelp" href="' . esc_url(energia_get_opt('social_yelp_url')) . '"><i class="fab fac-yelp"></i></a>';
                break;

            case 'tumblr':
                echo '<a title="Tumblr" href="' . esc_url(energia_get_opt('social_tumblr_url')) . '"><i class="fab fac-tumblr"></i></a>';
                break;

        }
    }
    endif;
}

function energia_social_footer() {
    $f_social_facebook_url = energia_get_opt( 'f_social_facebook_url' );
    $f_social_twitter_url = energia_get_opt( 'f_social_twitter_url' );
    $f_social_inkedin_url = energia_get_opt( 'f_social_inkedin_url' );
    $f_social_instagram_url = energia_get_opt( 'f_social_instagram_url' );
    $f_social_google_url = energia_get_opt( 'f_social_google_url' );
    $f_social_skype_url = energia_get_opt( 'f_social_skype_url' );
    $f_social_pinterest_url = energia_get_opt( 'f_social_pinterest_url' );
    $f_social_vimeo_url = energia_get_opt( 'f_social_vimeo_url' );
    $f_social_youtube_url = energia_get_opt( 'f_social_youtube_url' );
    $f_social_yelp_url = energia_get_opt( 'f_social_yelp_url' );
    $f_social_tumblr_url = energia_get_opt( 'f_social_tumblr_url' );
    $f_social_tripadvisor_url = energia_get_opt( 'f_social_tripadvisor_url' );

    if(!empty($f_social_tripadvisor_url)) :
        echo '<a href="'.esc_url($f_social_tripadvisor_url).'" target="_blank"><i class="fa fa-tripadvisor"></i></a>';
    endif;
    if(!empty($f_social_facebook_url)) :
        echo '<a href="'.esc_url($f_social_facebook_url).'" target="_blank"><i class="fa fa-facebook"></i></a>';
    endif;
    if(!empty($f_social_twitter_url)) :
        echo '<a href="'.esc_url($f_social_twitter_url).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    endif;
    if(!empty($f_social_inkedin_url)) :
        echo '<a href="'.esc_url($f_social_inkedin_url).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
    endif;
    if(!empty($f_social_instagram_url)) :
        echo '<a href="'.esc_url($f_social_instagram_url).'" target="_blank"><i class="fa fa-instagram"></i></a>';
    endif;
    if(!empty($f_social_google_url)) :
        echo '<a href="'.esc_url($f_social_google_url).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    endif;
    if(!empty($f_social_skype_url)) :
        echo '<a href="'.esc_url($f_social_skype_url).'" target="_blank"><i class="fa fa-skype"></i></a>';
    endif;
    if(!empty($f_social_pinterest_url)) :
        echo '<a href="'.esc_url($f_social_pinterest_url).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    endif;
    if(!empty($f_social_vimeo_url)) :
        echo '<a href="'.esc_url($f_social_vimeo_url).'" target="_blank"><i class="fa fa-vimeo-square"></i></a>';
    endif;
    if(!empty($f_social_youtube_url)) :
        echo '<a href="'.esc_url($f_social_youtube_url).'" target="_blank"><i class="fa fa-youtube"></i></a>';
    endif;
    if(!empty($f_social_yelp_url)) :
        echo '<a href="'.esc_url($f_social_yelp_url).'" target="_blank"><i class="fa fa-yelp"></i></a>';
    endif;
    if(!empty($f_social_tumblr_url)) :
        echo '<a href="'.esc_url($f_social_tumblr_url).'" target="_blank"><i class="fa fa-tumblr"></i></a>';
    endif;
}

if(!function_exists('energia_get_post_grid_layout1')){
    function energia_get_post_grid_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom' && $thumbnail_size != 'full'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = '768x568';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $author = get_user_by('id', $post->post_author);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) && $show_thumbnail == 'true'): ?>
                            <div class="entry-featured">
                                <div class="post-image">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                </div>
                                <?php if($show_categories == 'true'): ?>
                                    <div class="post-category"><?php the_terms( $post->ID, 'category', '', ', ' ); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="entry-body">
                            <<?php etc_print_html($title_tag);?> class="entry-title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                            </<?php etc_print_html($title_tag);?>>
                            <ul class="entry-meta">
                                <?php if($show_post_date == 'true'): ?>
                                    <li class="post-date"><?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?></li>
                                <?php endif; ?>
                                <?php if($show_author == 'true'): ?>
                                    <li class="author">
                                        <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a></li>
                                <?php endif; ?>
                            </ul>
                            <?php if($show_excerpt == 'true'): ?>
                                <div class="entry-content">
                                    <?php
                                        if(!empty($post->post_excerpt)){
                                            echo wp_trim_words( $post->post_excerpt, $num_words, $more = null );
                                        }
                                        else{
                                            $content = strip_shortcodes( $post->post_content );
                                            $content = apply_filters( 'the_content', $content );
                                            $content = str_replace(']]>', ']]&gt;', $content);
                                            $content = wp_trim_words( $content, $num_words, '&hellip;' );
                                            echo wp_kses_post($content);
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if($show_button == 'true'): ?>
                                <div class="entry-readmore">
                                    <a class="btn-more" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        <span><?php echo esc_attr($button_text); ?></span>
                                        <i class="fas fac-arrow-circle-right"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}

if(!function_exists('energia_get_service_grid_layout1')){
    function energia_get_service_grid_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom' && $thumbnail_size != 'full'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = '320x240';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $service_icon = get_post_meta($post->ID, 'service_icon', true);
                $service_feature = get_post_meta($post->ID, 'service_feature', true);
                $result_feature = count($service_feature);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <?php if(!empty($service_icon)) : ?>
                            <div class="item-icon">
                                <img src="<?php echo esc_url($service_icon['url']); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
                            </div>

                        <?php endif; ?>
                        <div class="entry-body">
                            <h3 class="entry-title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                            </h3>
                            <?php if($show_excerpt == 'true'): ?>
                                <div class="entry-content">
                                    <?php
                                    if (!empty($post->post_excerpt)) {
                                        echo wp_trim_words($post->post_excerpt, $num_words, '.');
                                    } else {
                                        $content = strip_shortcodes($post->post_content);
                                        $content = apply_filters('the_content', $content);
                                        $content = str_replace(']]>', ']]&gt;', $content);
                                        $content = wp_trim_words($content, $num_words, '&hellip;');
                                        echo wp_kses_post($content);
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($service_feature)) : ?>
                                <ul class="item-feature">
                                    <?php for($i=0; $i<$result_feature; $i++) { ?>
                                        <li><i class="fas fa-check-circle"></i><?php echo isset($service_feature[$i])?esc_html( $service_feature[$i] ):''; ?></li>
                                    <?php } ?>
                                </ul>
                            <?php endif; ?>
                            <?php if($show_button == 'true'): ?>
                                <div class="entry-readmore">
                                    <a class="service-readmore btn btn-secondary" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr($button_text); ?> <i class="fac fac-arrow-right"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}

if(!function_exists('energia_get_project_grid_layout1')){
    function energia_get_project_grid_layout1($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom' && $thumbnail_size != 'full'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = '370x275';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $project_icon = get_post_meta($post->ID, 'project_icon', true);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) ): ?>
                            <div class="entry-featured">
                                <a class="item-feauted" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="entry-body">
                            <div class="item-category"><?php the_terms( $post->ID, 'project-category', '', ', ' ); ?></div>
                            <h3 class="entry-title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                            </h3>
                            <?php if($show_excerpt == 'true'): ?>
                                <div class="entry-content">
                                    <?php
                                    if (!empty($post->post_excerpt)) {
                                        echo wp_trim_words($post->post_excerpt, $num_words, '.');
                                    } else {
                                        $content = strip_shortcodes($post->post_content);
                                        $content = apply_filters('the_content', $content);
                                        $content = str_replace(']]>', ']]&gt;', $content);
                                        $content = wp_trim_words($content, $num_words, '&hellip;');
                                        echo wp_kses_post($content);
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if($show_button == 'true'): ?>
                                <div class="entry-readmore">
                                    <a class="project-more" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr($button_text); ?> <i class="fac fac-arrow-right"></i></a>
                                </div>
                            <?php endif; ?>
                    </div>
                </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}
if(!function_exists('energia_get_project_grid_layout2')){
    function energia_get_project_grid_layout2($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom' && $thumbnail_size != 'full'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = '370x275';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $project_icon = get_post_meta($post->ID, 'project_icon', true);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) ): ?>
                            <div class="entry-featured">
                                <a class="item-feauted" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="entry-body">
                            <h3 class="entry-title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                            </h3>
                            <div class="item-category"><?php the_terms( $post->ID, 'project-category', '', ', ' ); ?></div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}
if(!function_exists('energia_get_project_grid_layout3')){
    function energia_get_project_grid_layout3($posts = [], $settings = []){
        extract($settings);
        if($thumbnail_size != 'custom' && $thumbnail_size != 'full'){
            $img_size = $thumbnail_size;
        }
        elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        }
        else{
            $img_size = '370x275';
        }
        if (is_array($posts)):
            foreach ($posts as $post):
                $img_id = get_post_thumbnail_id($post->ID);
                $img = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                $project_icon = get_post_meta($post->ID, 'project_icon', true);
                ?>
                <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                    <div class="grid-item-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false) ): ?>
                            <div class="entry-featured">
                                <a class="item-feauted" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="entry-body">
                            <h3 class="entry-title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                            </h3>
                            <div class="item-category"><?php the_terms( $post->ID, 'project-category', '', ', ' ); ?></div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
    }
}

function energia_get_product_grid_layout1($posts = [], $settings = [])
{
    extract($settings);
    if($thumbnail_size != 'custom'){
        $img_size = $thumbnail_size;
    }
    elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
        $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
    }
    else{
        $img_size = 'full';
    }
    if (is_array($posts)):
        foreach ($posts as $post):
            $img_id = get_post_thumbnail_id($post->ID);
            $img = etc_get_image_by_size( array(
                'attach_id'  => $img_id,
                'thumb_size' => $img_size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
            $product = wc_get_product( $post->ID );
            $regular_price = get_post_meta( $post->ID, '_regular_price', true);
            $sale_price = get_post_meta( $post->ID, '_sale_price', true);
            $product_sale = '';
            ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="grid-item-inner woocommerce-product-inner">
                    <?php
                    if(!empty($sale_price) && $product->is_on_sale()) {
                        $product_sale = intval( ( (intval($regular_price) - intval($sale_price)) / intval($regular_price) ) * 100);
                        echo '<span class="onsale">'.$product_sale.'%</span>';
                    }
                    ?>
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): ?>
                        <div class="item-featured woocommerce-product-header">
                            <a class="woocommerce-product-details" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                            <div class="woocommerce-product-meta">
                                <div class="woocommerce-add-to-cart">
                                    <?php
                                    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                        sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button ajax_add_to_cart %s product_type_%s">%s</a>',
                                            esc_url( $product->add_to_cart_url() ),
                                            esc_attr( $product->get_id() ),
                                            esc_attr( $product->get_sku() ),
                                            $product->is_purchasable() ? 'add_to_cart_button' : '',
                                            esc_attr( $product->get_type() ),
                                            esc_html( $product->add_to_cart_text() )
                                        ),
                                        $product );
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="woocommerce-product-holder">
                        <h3 class="woocommerce-product-title">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                        </h3>
                        <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
    endif;
}

if(!function_exists('energia_get_post_grid')){
    function energia_get_post_grid($posts = [], $settings = []){
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return false;
        }
        switch ($settings['template_type']) {
            case 'post_grid_layout1':
                energia_get_post_grid_layout1($posts, $settings);
                break;
            case 'service_grid_layout1':
                energia_get_service_grid_layout1($posts, $settings);
                break;
            case 'project_grid_layout1':
                energia_get_project_grid_layout1($posts, $settings);
                break;
            case 'project_grid_layout2':
                energia_get_project_grid_layout2($posts, $settings);
                break;
            case 'project_grid_layout3':
                energia_get_project_grid_layout3($posts, $settings);
                break;
            case 'product_grid_layout1':
                energia_get_product_grid_layout1($posts, $settings);
            default:
                return false;
                break;
        }
    }
}

add_action( 'wp_ajax_energia_load_more_post_grid', 'energia_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_energia_load_more_post_grid', 'energia_load_more_post_grid' );
if(!function_exists('energia_load_more_post_grid')){
    function energia_load_more_post_grid(){
        try{
            if(!isset($_POST['settings'])){
                throw new Exception(__('Something went wrong while requesting. Please try again!', 'energia'));
            }
            $settings = $_POST['settings'];
            set_query_var('paged', $settings['paged']);
            extract(etc_get_posts_of_grid($settings['posttype'], [
                'source' => isset($settings['source'])?$settings['source']:'',
                'orderby' => isset($settings['orderby'])?$settings['orderby']:'date',
                'order' => isset($settings['order'])?$settings['order']:'desc',
                'limit' => isset($settings['limit'])?$settings['limit']:'6',
                'post_ids' => '',
            ]));
            ob_start();
            energia_get_post_grid($posts, $settings);
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status' => true,
                    'message' => esc_html__('Load Successfully!', 'energia'),
                    'data' => array(
                        'html' => $html,
                        'paged' => $settings['paged'],
                        'posts' => $posts,
                        'max' => $max,
                    ),
                )
            );
        }
        catch (Exception $e){
            wp_send_json(array('status' => false, 'message' => $e->getMessage()));
        }
        die;
    }
}

/**
* Display navigation to next/previous post when applicable.
*/
function energia_post_nav_default() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="nav-links">
            <div class="nav-item nav-post-prev">
                <?php
                if ( is_a( $previous_post , 'WP_Post' )) {
                    ?>
                    <a href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>" class="btn">
                        <i class="fas fac-arrow-left"></i>
                        <?php echo esc_html__('Previous Post', 'energia'); ?>
                    </a>
                    <?php
                } ?>
            </div>
            <div class="nav-item nav-post-next">
                <?php if ( is_a( $next_post , 'WP_Post' )) {
                    ?>
                    <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>" class="btn">
                        <?php echo esc_html__('Next Post', 'energia'); ?>
                        <i class="fas fac-arrow-right"></i>
                    </a>
                    <?php
                } ?>
            </div>
        </div><!-- .nav-links -->
    <?php }
}
/**
 * Custom Widget Archive Counts
 */
add_filter('wp_list_categories', 'energia_cat_count_span');
function energia_cat_count_span($output) {
    $dir = is_rtl() ? 'left' : 'right';
    $output = str_replace("\t", '', $output);
    $output = str_replace("\n</li>", '</li>', $output);
    $output = str_replace('</a> (', '<span class="count '.$dir.'">(', $output);
    $output = str_replace(")</li>", ')</span></a></li>', $output);
    $output = str_replace("(", '', $output);
    $output = str_replace(")", '', $output);
    return $output;
}
// For shop with other structure
add_filter('wp_list_categories', 'energia_wc_cat_count_span');
function energia_wc_cat_count_span($links) {
    $dir = is_rtl() ? 'left' : 'right';
    $links = str_replace('</a> <span class="count">', ' <span class="count '.$dir.'">', $links);
    $links = str_replace('</span>', '</span></a>', $links);
    return $links;
}