<?php
/**
 * Template part for displaying default header layout
 */
$sticky_on = energia_get_opt( 'sticky_on', false );
$search_on = energia_get_opt( 'search_on', false );
$cart_on = energia_get_opt( 'cart_on', false );
$h_btn_on = energia_get_opt( 'h_btn_on', 'hide' );

$h_btn_text = energia_get_opt( 'h_btn_text' );
$h_btn_link_type = energia_get_opt( 'h_btn_link_type', 'page' );
$h_btn_link = energia_get_opt( 'h_btn_link' );
$h_btn_link_custom = energia_get_opt( 'h_btn_link_custom' );
$h_btn_target = energia_get_opt( 'h_btn_target', '_self' );
if($h_btn_link_type == 'page') {
    $h_btn_url = get_permalink($h_btn_link);
} else {
    $h_btn_url = $h_btn_link_custom;
}
$menu_phone_label = energia_get_opt( 'menu_phone_label' );
$menu_phone_number = energia_get_opt( 'menu_phone_number' );
$phone_result = preg_replace('#[ () ]*#', '', $menu_phone_number);
$email_label = energia_get_opt( 'email_label' );
$email_text = energia_get_opt( 'email_text' );
$email_link = energia_get_opt( 'email_link' );
$time_label = energia_get_opt( 'time_label' );
$time = energia_get_opt( 'time' );
$note_text = energia_get_opt( 'note_text' );
$menu_phone_icon = energia_get_opt( 'menu_phone_icon' );

?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout3 fixed-height <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div class="site-header-top">
            <div class="container">
                <div class="row">
                    <div class="header-top-left">
                        <div class="header-top-item-inner note-text">
                            <?php if(!empty($note_text)) : ?>
                                <?php echo wp_kses_post($note_text); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="header-top-right">
                        <?php if(!empty($email_text)) : ?>
                            <div class="header-top-item">
                                <i class="fas fac-envelope"></i>
                                <div class="header-top-item-inner">
                                    <span><?php echo esc_html($email_label); ?></span>
                                    <a href="<?php echo esc_attr($email_link); ?>" target="_blank"><?php echo esc_html($email_text); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($time)) : ?>
                            <div class="header-top-item">
                                <i class="fas fac-clock"></i>
                                <div class="header-top-item-inner">
                                    <span><?php echo esc_attr($time_label); ?></span>
                                    <span><?php echo esc_attr($time); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="site-header-social">
                            <?php energia_social_media(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="site-header" class="site-header-main">
            <div class="container">
                <div class="row">
                    <div class="site-branding">
                        <?php get_template_part( 'template-parts/header-branding' ); ?>
                    </div>
                    <div class="site-navigation">
                        <nav class="main-navigation">
                            <?php get_template_part( 'template-parts/header-menu' ); ?>
                        </nav>
                        <?php
                        if (($h_btn_on == 'show') || $search_on || $cart_on || !empty($menu_phone_number) ){
                            ?>
                            <div class="site-tool">
                                <?php if(!empty($menu_phone_number)) : ?>
                                    <div class="site-header-item menu-phone">
                                        <?php
                                        if(!empty($menu_phone_icon['url'])){
                                            ?> <img src="<?php echo esc_url($menu_phone_icon['url']);?>" alt="<?php echo esc_html__('Menu Phone Icon', 'energia');?>"> <?php
                                        }
                                        ?>
                                        <div class="phone-text">
                                            <div class="p-label"><?php echo esc_html($menu_phone_label); ?></div>
                                            <div><a href="tel:<?php echo esc_attr($phone_result); ?>"><?php echo esc_html($menu_phone_number); ?></a></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($search_on) : ?>
                                    <div class="site-header-item site-header-search">
                                        <span class="h-btn-search"><i class="far fa-search"></i></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($h_btn_on == 'show') : ?>
                                    <div class="site-header-item site-header-button">
                                        <a class="btn" href="<?php echo esc_url($h_btn_url); ?>" target="<?php echo esc_attr($h_btn_target); ?>" title="<?php echo esc_html($h_btn_text); ?>">
                                            <?php echo wp_kses_post($h_btn_text); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(class_exists('Woocommerce')){
                                    if($cart_on){ ?>
                                        <div class="site-header-item cart-icon-wrap">
                                            <div class="cart-desktop icon-wrap">
                                                <a href="#" class="open-cart">
                                                    <span class="cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
                                                    <i class="fas fac-shopping-cart"></i>
                                                </a>
                                                <div class="widget_shopping_cart_content">
                                                    <?php woocommerce_mini_cart(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="main-menu-mobile">
                <span class="btn-nav-mobile open-menu">
                    <span></span>
                </span>
            </div>
        </div>
    </div>
</header>