jQuery(document).ready(function ($) {
    "use strict";

    $("body").on("click",".triggerAcc",function(e){
        e.preventDefault();
        var thisPanel = $(this).parents(".accordian-panel").find(".accordian-content");
        $(this).parents(".accordian-wrapper").find(".accordian-content").not(thisPanel).slideUp();
        thisPanel.slideToggle();
        return false;
    });
    
    $(".accordian-panel").eq(0).find(".accordian-content").show();


      window.prettyPrint && prettyPrint()
    /* ******************************************************************** */
    /*                        PRELOADER                                     */
    /* ******************************************************************** */

    $(window).load(function() {
        if( $('.xdocs-pre-loader').length ){
            // Animate loader off screen
            $(".xdocs-pre-loader").fadeOut("slow");
        }
    });
});