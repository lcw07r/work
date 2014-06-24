/*global jQuery, document*/
"use strict";
jQuery(document).ready(function () {

	jQuery("#youtube_feed_list li").quickpaginate({
        perpage: 4,
        showcounter: false,
        pager: jQuery("#youtube_feed_list_counter")
    });

	jQuery("#youtube_image_list li").quickpaginate({
        perpage: 4,
        showcounter: false,
        pager: jQuery("#youtube_image_list_counter")
    });

	jQuery("#flickr_feed_list li").quickpaginate({
        perpage: 4,
        showcounter: false,
        pager: jQuery("#flickr_feed_list_counter")
    });

	jQuery("#flickr_image_list li").quickpaginate({
        perpage: 4,
        showcounter: false,
        pager: jQuery("#flickr_image_list_counter")
    });
});