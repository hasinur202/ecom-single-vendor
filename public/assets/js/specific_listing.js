function sticktothetop() {
    var t = $("#stick_here"),
        i = $(".elemento_stick"),
        e = $(window).scrollTop();
    t.offset().top < e ? (i.addClass("sticky"), t.height(i.outerHeight())) : (i.removeClass("sticky"), t.height(0))
}
jQuery(function(t) { t(window).scroll(sticktothetop), sticktothetop() }), $(".filters_listing_1 .dropdown-menu .filter_type ul").on("click", function(t) { t.stopPropagation() }), $("a.open_filters").on("click", function() { $(".filter_col").toggleClass("show"), $("main").toggleClass("freeze"), $(".layer").toggleClass("layer-is-visible") });
var $headingFilters = $(".filter_type h4 a");
$headingFilters.on("click", function() { $(this).toggleClass("opened") }), $headingFilters.on("click", function() { $(this).toggleClass("closed") });