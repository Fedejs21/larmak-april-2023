<?php

class ETC_CmsProjectCarousel_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_project_carousel';
    protected $title = 'Project Carousel';
    protected $icon = 'eicon-posts-carousel';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_project_carousel\/layout-image\/layout1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_project_carousel\/layout-image\/layout2.jpg"},"3":{"label":"Layout 3","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_project_carousel\/layout-image\/layout3.jpg"}}}]},{"name":"source_section","label":"Source","tab":"content","controls":[{"name":"thumbnail","type":"image-size","control_type":"group","default":"full"},{"name":"source","label":"Select Categories","type":"select2","multiple":true,"options":{"finance|post_tag":"Finance","solar-panels|post_tag":"Solar Panels","systems|post_tag":"Systems","eco|project-category":"ECO","energy|project-category":"Energy","finance|project-category":"Finance","green-energy|project-category":"Green Energy","innovations|project-category":"Innovations","supply-chain|project-category":"Supply Chain"}},{"name":"orderby","label":"Order By","type":"select","default":"date","options":{"date":"Date","ID":"ID","author":"Author","title":"Title","rand":"Random"}},{"name":"order","label":"Sort Order","type":"select","default":"desc","options":{"desc":"Descending","asc":"Ascending"}},{"name":"limit","label":"Total items","type":"number","default":"6"},{"name":"num_words","label":"Number of Words","type":"number","default":30,"condition":{"layout!":"1"}},{"name":"button_text","label":"Button Text","type":"text","default":"Explore More"}]},{"name":"section_carousel_settings","label":"Carousel","tab":"content","controls":[{"name":"slides_to_show","label":"Slides to Show","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3,"4":4}},{"name":"slides_to_scroll","label":"Slides to Scroll","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3,"4":4},"condition":{"slides_to_show!":"1"}},{"name":"slides_gutter","label":"Gutter","type":"number","control_type":"responsive","default":15,"condition":{"slides_to_show!":"1"},"selectors":{"{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide":"padding: 0 {{VALUE}}px;","{{WRAPPER}} .cms-slick-carousel .slick-list":"margin: 0 -{{VALUE}}px;"}},{"name":"arrows","label":"Show Arrows","type":"switcher","default":"false"},{"name":"dots","label":"Show Dots","type":"switcher","default":"true"},{"name":"infinite","label":"Infinite Loop","type":"switcher","default":"true"},{"name":"speed","label":"Animation Speed","type":"number","default":500}]},{"name":"section_style_content","label":"Style","tab":"style","controls":[{"name":"heading_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .cms-project-carousel .entry-title":"color: {{VALUE}};"}},{"name":"content_color","label":"Content Color","type":"color","selectors":{"{{WRAPPER}} .cms-project-carousel .entry-content":"color: {{VALUE}};"}},{"name":"list_color","label":"List Color","type":"color","selectors":{"{{WRAPPER}} .cms-project-carousel .item-features li":"color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-slick','cms-post-carousel-widget-js' );
}