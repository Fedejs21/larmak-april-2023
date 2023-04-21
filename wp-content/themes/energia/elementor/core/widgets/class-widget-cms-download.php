<?php

class ETC_CmsDownload_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_download';
    protected $title = 'Download';
    protected $icon = 'eicon-file-download';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_download\/layout-image\/layout1.jpg"}}}]},{"name":"section_list","label":"Content","tab":"content","controls":[{"name":"el_title","label":"Element Title","type":"textarea","label_block":true},{"name":"download","label":"Download Lists","type":"repeater","default":[],"controls":[{"name":"title","label":"Title","type":"textarea","label_block":true},{"name":"selected_image","label":"Icon Image","type":"media"},{"name":"link","label":"Link","type":"url"},{"name":"background","label":"Background","type":"color","default":"","selectors":{"{{WRAPPER}} {{CURRENT_ITEM}}":"background-color: {{VALUE}};"}},{"name":"hover_background","label":"Hover Background","type":"color","default":"","selectors":{"{{WRAPPER}} {{CURRENT_ITEM}}:hover":"background-color: {{VALUE}};"}}],"title_field":"{{{ title }}}"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}