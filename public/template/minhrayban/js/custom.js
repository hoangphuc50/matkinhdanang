$(document).ready(function() {

    /*==loADING---*/

    setTimeout(function() {
        $(".loading").fadeOut(2000);
    }, 2000);
    setTimeout(function() {
        $(".loading img").fadeOut(1000);
    }, 2000);
    // MENU MOBILE
    $(".mobile-btn").click(function() {
        $(".mobile-menu").stop().slideToggle(300);
        $(".main-menu").addClass("no-bg");
    });
    $(".mobile-menu li a").click(function() {
        $(".mobile-menu").slideUp();
        $(".main-menu").removeClass("no-bg");
    });

    /*===wow==*/
    new WOW().init();

    // BX SLIDER
    $('.bxslider').bxSlider({
        pager: false,
        controls: true
    });
    // SLIDE DOI TAC
    $('.marquee').marquee({
        //speed in milliseconds of the marquee
        speed: 13000,

        //gap in pixels between the tickers
        delayBeforeStart: 0,
        //'left' or 'right'
        direction: 'left',
        //true or false - should the marquee be duplicated to show an effect of continues flow

        //on hover pause the marquee - using jQuery plugin https://github.com/tobia/Pause
        pauseOnHover: true
    });


    $('.gallery-item').magnificPopup({
        removalDelay: 300,

        // Class that is added to popup wrapper and background
        // make it unique to apply your CSS animations just to this exact popup
        mainClass: 'mfp-fade',
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    //FOR CART
    $(".up-down .plus").click(function() {
        var number_of_item = $(".up-down .num").val();
        if(number_of_item >= 1){
            number_of_item++;
        }else{
            number_of_item = 1;
        }
        $(".up-down .num").val(number_of_item);
    });
    $(".up-down .minus").click(function() {
        var number_of_item = $(".up-down .num").val();
        if(number_of_item > 1){
            number_of_item--;
        }else{
            number_of_item = 1;
        }
        $(".up-down .num").val(number_of_item);
    });

    $(".add-cart").click(function() {
        // var data = $(".add-cart-form").serialize();
        // $.ajax({
        //     type: "GET",
        //     url: "/cart/add",
        //     data: data,
        //     success: function(respon) {
        //         $(".cart-panel").html(respon);
        //     }
        // });
        // return false;
        $(".add-cart-form").submit();
    });
    $(document).on('click','.cart-update-qty .updatebtn',function(){
        var data = $(this).parent().parent().find("form").serialize();
        $.ajax({
            type: "GET",
            url: "/cart/update",
            data: data,
            success: function(respon) {
                $(".cart-index-content").html(respon);
            }
        });
        return false;
    })
    /*
    $(".cart-update-qty .updatebtn").click(function() {
        var data = $(this).parent().parent().find("form").serialize();
        $.ajax({
            type: "GET",
            url: "/cart/update",
            data: data,
            success: function(respon) {
                $(".cart-index-content").html(respon);
            }
        });
        return false;
    });
    */
});
