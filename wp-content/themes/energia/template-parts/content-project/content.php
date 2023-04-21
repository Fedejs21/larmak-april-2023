<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Energia
 */

$box_description = get_post_meta(get_the_ID(), 'box_description', true);
$box_btn_text = get_post_meta(get_the_ID(), 'box_btn_text', true);
$box_btn_link = get_post_meta(get_the_ID(), 'box_btn_link', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-featured">
        <div class="project-image">
            <?php the_post_thumbnail('full'); ?>
        </div>
        <div class="project-info">
            <div class="info-text">
                <div class="project-category"><?php the_terms( get_the_ID(), 'project-category', '', ', ' ); ?></div>
                <h3 class="project-title">
                    <?php the_title(); ?>
                </h3>
                <div class="box-description">
                    <?php echo esc_html($box_description);?>
                </div>
            </div>
            <?php if(!empty($box_btn_text)) : ?>
                <div class="box-button">
                    <a class="btn" href="<?php echo esc_url($box_btn_link); ?>" target="_blank">
                        <?php echo wp_kses_post($box_btn_text); ?>
                        <i class="fas fac-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="entry-body">
        <div class="entry-content clearfix">
            <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links">',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <div class="project-tags-share">
            <?php energia_entry_tagged_in(); ?>
            <div class="project-social-share">
                <ul>
                    <li><a class="fb-social" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>"><i class="fab fac-facebook-f"></i></a></li>
                    <li><a class="tw-social" title="Twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fab fac-twitter"></i></a></li>
                    <li><a class="pin-social" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_post_thumbnail_url('full'); ?>&media=&description=<?php echo urlencode(the_title_attribute('echo=0')); ?>"><i class="fab fac-pinterest-p"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="project-related">
            <?php energia_project_related_post(); ?>
        </div>
    </div>
</article><!-- #post -->