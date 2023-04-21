<?php

class ETC_CmsButton_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_button';
    protected $title = 'Button';
    protected $icon = 'eicon-button';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"style","label":"Style","type":"select","default":"btn-default","options":{"btn-default":"Default","btn-fullwidth":"Full Width","white-hover":"White Hover","btn-secondary":"Secondary","btn-white":"White","btn-white-secondary":"White Secondary","btn-outline":"Outline","btn-outline-secondary":"Outline Secondary","btn-outline-white":"Outline White"}},{"name":"text","label":"Text","type":"text","default":"Click here","placeholder":"Click here"},{"name":"link","label":"Link","type":"url","placeholder":"https:\/\/your-link.com","default":{"url":"#"}},{"name":"text_align","label":"Alignment","type":"choose","control_type":"responsive","options":{"left":{"title":"Left","icon":"fa fa-align-left"},"center":{"title":"Center","icon":"fa fa-align-center"},"right":{"title":"Right","icon":"fa fa-align-right"}},"selectors":{"{{WRAPPER}} .cms-button":"text-align: {{VALUE}};"}},{"name":"btn_icon","label":"Icon","type":"icons","label_block":true,"fa4compatibility":"icon"},{"name":"icon_align","label":"Icon Position","type":"select","default":"right","options":{"right":"After","left":"Before"},"condition":{"btn_icon!":""}},{"name":"icon_indent","label":"Icon Spacing","type":"slider","range":{"px":{"min":5,"max":50}},"condition":{"btn_icon!":""},"selectors":{"{{WRAPPER}} .cms-button .cms-align-icon-right":"margin-left: {{SIZE}}{{UNIT}};","{{WRAPPER}} .cms-button .cms-align-icon-left":"margin-right: {{SIZE}}{{UNIT}};"}}]},{"name":"section_style_button","label":"Button Style","tab":"style","controls":[{"name":"text_color","label":"Text Color","type":"color","selectors":{"{{WRAPPER}} .cms-button .btn":"color: {{VALUE}};"}},{"name":"hover_background","label":"Hover Background","type":"color","selectors":{"{{WRAPPER}} .cms-button .btn:hover":"background-color: {{VALUE}}; border-color: {{VALUE}};"}},{"name":"hover_color","label":"Hover Color","type":"color","selectors":{"{{WRAPPER}} .cms-button .btn:hover":"color: {{VALUE}};"}},{"name":"button_border_radius","label":"Border Radius","type":"dimensions","size_units":["px","%"],"selectors":{"{{WRAPPER}} .cms-button .btn":"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"}},{"name":"button_padding","label":"Padding","type":"dimensions","control_type":"responsive","size_units":["px","em","%"],"separator":"before","selectors":{"{{WRAPPER}} .cms-button .btn":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}