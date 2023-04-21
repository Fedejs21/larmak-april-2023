<?php

class ETC_CmsImageCarousel_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_image_carousel';
    protected $title = 'Image Carousel';
    protected $icon = 'eicon-posts-carousel';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_image_carousel\/layout-image\/layout1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_image_carousel\/layout-image\/layout2.jpg"}}}]},{"name":"section_images","label":"Images","tab":"content","controls":[{"name":"images","label":"Select Image","type":"repeater","default":[{"item_image":"Client Image"}],"controls":[{"name":"item_image","label":"Item Image","type":"media","label_block":true}]}]},{"name":"section_carousel_settings","label":"Carousel Settings","tab":"settings","controls":[{"name":"slides_to_show","label":"Slides to Show","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3,"4":4,"5":5,"6":6,"7":7,"8":8,"9":9,"10":10}},{"name":"slides_to_scroll","label":"Slides to Scroll","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3,"4":4,"5":5,"6":6,"7":7,"8":8,"9":9,"10":10},"condition":{"slides_to_show!":"1"}},{"name":"slides_gutter","label":"Gutter","type":"number","control_type":"responsive","default":10,"condition":{"slides_to_show!":"1"},"selectors":{"{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide":"padding: {{VALUE}}px;","{{WRAPPER}} .cms-slick-carousel .slick-list":"margin: 0 -{{VALUE}}px;"}},{"name":"arrows","label":"Show Arrows","type":"switcher"},{"name":"dots","label":"Show Dots","type":"switcher"},{"name":"infinite","label":"Infinite Loop","type":"switcher","condition":{"layout!":"1"}},{"name":"speed","label":"Animation Speed","type":"number","default":500}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-slick','cms-clients-list-widget-js' );
}