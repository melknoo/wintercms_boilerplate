/*
 * Application
 */

$(document).tooltip({
    selector: "[data-toggle=tooltip]"
})


$(window).load(function() {
    var inputField = $('#suchfeld');
    autocompleteFunction(inputField);
});

function autocompleteFunction(inputField) {
    inputField.focus();
    inputField.autocomplete({
        source: function(request, response) {
            $.ajax('onAutocomplete', {
                type: 'POST',
                data: {
                    term: request.term
                },
                success: function(data) {
                    if(data.length) {
                        response(data);
                    }
                }
            })
        },
        minLength: 3
    });
}

/*
 * Auto hide navbar
 */
jQuery(document).ready(function($){
    var $header = $('.navbar-autohide'),
        scrolling = false,
        previousTop = 0,
        currentTop = 0,
        scrollDelta = 10,
        scrollOffset = 150

    $(window).on('scroll', function(){
        if (!scrolling) {
            scrolling = true

            if (!window.requestAnimationFrame) {
                setTimeout(autoHideHeader, 250)
            }
            else {
                requestAnimationFrame(autoHideHeader)
            }
        }
    })

    function autoHideHeader() {
        var currentTop = $(window).scrollTop()

        // Scrolling up
        if (previousTop - currentTop > scrollDelta) {
            $header.removeClass('is-hidden')
        }
        else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
            // Scrolling down
            $header.addClass('is-hidden')
        }

        previousTop = currentTop
        scrolling = false
    }

});