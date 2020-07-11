(function($) {
$(document).ready(function(){

    if (jQuery('.masonry-container').length != 0) {
        console.log("Fetched JSON from web");
        loadMasonary();
    } else {
        console.log("JSON data not found");
    }

});

})(jQuery);

/**
 * Function to initialize masonry library.
 */
var loadMasonary = function() {
    var $container = jQuery('.masonry-container');
    $container.imagesLoaded(function () {
        $container.masonry({
            columnWidth: '.item',
            itemSelector: '.item',
        });

        hideLoader();
    });
}

/**
 * Function to hide loader.
 */
var hideLoader = function() {
    if (jQuery('.loader-container').length != 0 && jQuery('.loader-container').css('opacity') == '1') {
       jQuery('.loader-container').fadeOut();
    }
}