<?php

class ETC_CmsBreadcrumb_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_breadcrumb';
    protected $title = 'Breadcrumb';
    protected $icon = 'eicon-ellipsis-h';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"section_style_content","label":"Style","tab":"style","controls":[{"name":"breadcrumb_color","label":"Breadcrumb Color","type":"color","selectors":{"{{WRAPPER}} .cms-breadcrumb":"color: {{VALUE}} !important;","{{WRAPPER}} .cms-breadcrumb span":"color: {{VALUE}} !important;"}},{"name":"breadcrumb_last_color","label":"Last Item Color","type":"color","selectors":{"{{WRAPPER}} .cms-breadcrumb li:last-child span":"color: {{VALUE}} !important;"}},{"name":"text_align","label":"Alignment","type":"choose","control_type":"responsive","options":{"left":{"title":"Left","icon":"fa fa-align-left"},"center":{"title":"Center","icon":"fa fa-align-center"},"right":{"title":"Right","icon":"fa fa-align-right"}},"selectors":{"{{WRAPPER}} .cms-breadcrumb":"text-align: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}