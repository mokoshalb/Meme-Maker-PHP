(function($) {
    "use strict";
    // caching selectors
    var mainWindow           = $(window),
        mainHeader           = $('header'),
        mainBody             = $('body'),
        mainStatus           = $('#status'),
        slickNavMenu         = $('#menu'),
        sfMenuExample        = jQuery("#sf-example"),
        scrollUp             = $('.totop');
    mainWindow.on('load', function() {
        slickNavMenu.slicknav();
        // Superfish Menu
        sfMenuExample.superfish({
            pathLevels: 1,
            delay: 1000,
            animation: {opacity: 'show'},
            animationOut: {opacity: 'hide'},
            speed: 'fast',
            speedOut: 'fast',
            cssArrows: true,
            disableHI: false,
        });
        // Scroll to Top
        mainWindow.on("scroll", function() {
            if ($(this).scrollTop() > 150){
                scrollUp.show();
            }
            else{
                scrollUp.hide();
            }
        });

        // Click event to scroll to top
        scrollUp.on("click", function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
})(jQuery);
$(document).ready(function(){
    $(document).on('click','.show_more_featured_posts',function(){
        var ID = $(this).attr('id');
        $('.show_more_featured_posts').hide();
        $('.ajax-loading').show();
        $.ajax({
            type:'POST',
            url:'ajax.php',
            data:'id='+ID,
            success:function(html){
                $(ID).remove();
                $('.view-more').remove();
                $('.abc').append(html);
                inito();
                $('.ajax-loading').hide();
            }
        });
    });
});