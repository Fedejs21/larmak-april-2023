<?php

class ETC_CmsPostGrid_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_post_grid';
    protected $title = 'Blog Grid';
    protected $icon = 'eicon-posts-grid';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_post_grid\/layout-image\/layout1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/larmak-april-2023\/wp-content\/themes\/energia\/elementor\/templates\/widgets\/cms_post_grid\/layout-image\/layout2.jpg"}}}]},{"name":"source_section","label":"Source","tab":"content","controls":[{"name":"source","label":"Select Categories","type":"select2","multiple":true,"options":{"battery-materials|category":"Battery Materials","refined-products|category":"Refined Products","solar-modules|category":"Solar Modules","solar-pv-materials|category":"Solar PV Materials","wind-generators|category":"Wind Generators","battery|post_tag":"Battery","enenrgy|post_tag":"Enenrgy","finance|post_tag":"Finance","insights-2|post_tag":"Insights","research|post_tag":"Research","solar|post_tag":"Solar","solar-panels|post_tag":"Solar Panels","systems|post_tag":"Systems"}},{"name":"orderby","label":"Order By","type":"select","default":"date","options":{"date":"Date","ID":"ID","author":"Author","title":"Title","rand":"Random"}},{"name":"order","label":"Sort Order","type":"select","default":"desc","options":{"desc":"Descending","asc":"Ascending"}},{"name":"limit","label":"Total items","type":"number","default":"6"}]},{"name":"grid_section","label":"Grid","tab":"content","controls":[{"name":"layout_type","label":"Grid Type","type":"select","default":"basic","options":{"basic":"Basic","masonry":"Masonry"}},{"name":"thumbnail","type":"image-size","control_type":"group","default":"full"},{"name":"filter","label":"Filter on Masonry","type":"select","default":"false","options":{"true":"Enable","false":"Disable"}},{"name":"filter_default_title","label":"Filter Default Title","type":"text","default":"All","condition":{"filter":"true"}},{"name":"filter_alignment","label":"Filter Alignment","type":"select","default":"center","options":{"center":"Center","left":"Left","right":"Right"},"condition":{"filter":"true"}},{"name":"pagination_type","label":"Pagination Type","type":"select","default":"false","options":{"pagination":"Pagination","loadmore":"Loadmore","false":"Disable"}},{"name":"gap","label":"Item Gap","type":"number","control_type":"responsive","default":15,"selectors":{"{{WRAPPER}} .cms-grid .cms-grid-inner":"margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;","{{WRAPPER}} .cms-grid .grid-item":"padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;","{{WRAPPER}} .cms-grid .grid-sizer":"padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;"}},{"name":"col_xs","label":"Columns XS Devices","type":"select","default":"1","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_sm","label":"Columns SM Devices","type":"select","default":"2","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_md","label":"Columns MD Devices","type":"select","default":"3","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_lg","label":"Columns LG Devices","type":"select","default":"3","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_xl","label":"Columns XL Devices","type":"select","default":"3","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}}]},{"name":"display_section","label":"Display Options","tab":"content","controls":[{"name":"show_thumbnail","label":"Show Thumbnail","type":"switcher","default":"true","separator":"after"},{"name":"title_tag","label":"HTML Tag","type":"select","default":"h3","options":{"h1":"H1","h2":"H2","h3":"H3","h4":"H4","h5":"H5","h6":"H6"},"condition":{"show_title":"true"},"separator":"after"},{"name":"show_excerpt","label":"Show Excerpt","type":"switcher","default":"true"},{"name":"num_words","label":"Number of Words","type":"number","default":25,"condition":{"show_excerpt":"true"},"separator":"after"},{"name":"show_button","label":"Show Action Button","type":"switcher","default":"true"},{"name":"button_text","label":"Button Text","type":"text","default":"Read more","condition":{"show_button":"true"},"separator":"after"},{"name":"show_meta","label":"Show Meta","type":"switcher","default":"true"},{"name":"show_post_date","label":"Show Post Date","type":"switcher","default":"true","condition":{"show_meta":"true"}},{"name":"show_author","label":"Show Author","type":"switcher","default":"true","condition":{"show_meta":"true"}},{"name":"show_categories","label":"Show Categories","type":"switcher","default":"true","condition":{"show_meta":"true"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'imagesloaded','isotope','cms-post-grid-widget-js' );
}