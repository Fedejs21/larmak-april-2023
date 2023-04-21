<?php

class ETC_CmsCompanyHistory_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_company_history';
    protected $title = 'Company History';
    protected $icon = 'eicon-history';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_company_history\/layout-image\/layout1.jpg"}}}]},{"name":"section_timelines","label":"Timelines","tab":"content","controls":[{"name":"timelines","type":"repeater","default":[{"timeline_year":"2001","timeline_title":"This is the heading","timeline_content":"Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo."}],"controls":[{"name":"timeline_year","label":"Timeline Year","type":"text","label_block":true,"default":"1996"},{"name":"timeline_title","label":"Content Title","type":"text","label_block":true,"default":"This is the heading"},{"name":"timeline_content","label":"Content","type":"textarea","rows":"10","default":"Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo."}],"title_field":"{{{ timeline_year }}}"}]},{"name":"style_section","label":"Text Style","tab":"style","controls":[{"name":"year_bg","label":"Years Background","type":"color","selectors":{"{{WRAPPER}} .cms-company-history .timeline-year":"background-color: {{VALUE}};","{{WRAPPER}} .cms-company-history .timeline-year:after":"background-color: {{VALUE}};"}},{"name":"year_color","label":"Years Color","type":"color","selectors":{"{{WRAPPER}} .cms-company-history .timeline-year":"color: {{VALUE}};"}},{"name":"content_color","label":"Content Color","type":"color","selectors":{"{{WRAPPER}} .cms-company-history .timeline-text":"color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}