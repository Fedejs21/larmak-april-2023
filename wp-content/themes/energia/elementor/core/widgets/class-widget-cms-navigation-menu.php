<?php

class ETC_CmsNavigationMenu_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_navigation_menu';
    protected $title = 'Navigation Menu';
    protected $icon = 'eicon-menu-bar';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"widget_title","label":"Widget Title","type":"textarea","label_block":true},{"name":"menu","label":"Select Menu","type":"select","options":{"compania":"Compa\u00f1\u00eda","footer-services":"Footer Services","footer-support":"Footer Support","main-menu":"Main Menu","menu-help":"Menu Help","our-services":"Our Services"}},{"name":"style","label":"Style","type":"select","options":{"default":"Default","inline":"Inline","e-sidebar-widget":"Sidebar Menu"},"default":"default"},{"name":"link_color","label":"Link Color","type":"color","selectors":{"{{WRAPPER}} .cms-navigation-menu ul.menu li a":"color: {{VALUE}} !important;"}},{"name":"link_color_hover","label":"Link Color Hover &amp; Active","type":"color","selectors":{"{{WRAPPER}} .cms-navigation-menu ul.menu li a:hover, {{WRAPPER}} .cms-navigation-menu ul.menu li.current_page_item > a":"color: {{VALUE}} !important;"}},{"name":"border_color_hover","label":"Border Color Hover &amp; Active","type":"color","condition":{"style":["inline","one-page"]},"selectors":{"{{WRAPPER}} .cms-navigation-menu.inline ul.menu > li > a:after":"background-color: {{VALUE}} !important;"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}