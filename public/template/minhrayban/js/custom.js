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
  gallery:{
    enabled:true
  }
});


    /*===Map==*/
    // $("#map").gmap3({
    //     marker: {
    //         address: "117 Nguyễn Văn Thoại - Quận Sơn Trà - TP Đà Nẵng",
    //         options: {
    //             icon: "images/location.png"
    //         }
    //     },
    //     overlay: {
    //         address: "117 Nguyễn Văn Thoại - Quận Sơn Trà - TP Đà Nẵng",
    //         options: {
    //             content: '<div class="style-tooltip-map"><i class="icon-ib icon-scissors"></i>Tầng 2, 123 Đỗ Quang TP. Đà Nẵng, Việt Nam</div>',
    //             offset: {
    //                 y: -120,
    //                 x: 20
    //             }
    //         }
    //     },
    //     map: {
    //         options: {
    //             styles: [{
    //                 stylers: [{
    //                     "saturation": 0
    //                 }]
    //             }, ],
    //             zoom: 15
    //         }
    //     }
    // });
});
