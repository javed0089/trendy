/*

Page: main JS
Author: Surjith S M
URI: http://surjithctly.in/
Version: 1.0

*/

(function($) {
    "use strict";


    /* ============= Preloader Close on Click ============= */

    if ($('.loader-wrapper').length) {
        $('.loader-wrapper').on('click', function() {
            $(this).fadeOut();
        });
    }

    /* ============= Homepage Slider ============= */
    if ($('.flexslider').length) {
        $('.flexslider').flexslider({
            animation: "fade"
        });
    }
    /* ============= Partner Logo Carousel ============= */
    if ($('.logo-slides').length) {
        $(".logo-slides").owlCarousel({
            autoplay: true,
            autoplayTimeout: 3000,
            loop: true,
            margin: 10,
            nav: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                767: {
                    items: 3
                },
                991: {
                    items: 4
                },
                1199: {
                    items: 5
                }
            }

        });
    }

    /* ============= Percentage Slider ============= */

    if ($('#skills').length) {

        var skillsDiv = $('#skills');

        $(window).on('scroll', function() {
            var winT = $(window).scrollTop(),
            winH = $(window).height(),
            skillsT = skillsDiv.offset().top;
            if (winT + winH > skillsT) {
                $('.skillbar').each(function() {
                    $(this).find('.skillbar-bar').animate({
                        width: $(this).attr('data-percent')
                    }, 2000);
                });
            }
        });

    }

    /* ============= Service Slider ============= */

    if ($('.service-slider').length) {
        $('.service-slider').flexslider({
            animation: "slide",
            controlNav: false,
            directionNav: true,
            touch: true
        });
    }
    /* ============= Blog Slider ============= */
    if ($('.blog-slide').length) {
        $('.blog-slide').flexslider({
            controlNav: false,
            animation: "slide"
        });
    }

    /* ============= Stats Counter ============= */
    if ($('.counter').length) {
        $('.counter').counterUp({
            delay: 10,
            time: 1500
        });
    }


    $(window).load(function() {

        /* ============= Preloader ============= */

        if ($('.loader-wrapper').length) {
            $('.loader-wrapper').fadeOut();
        }


    }); // End Window.Load


    $(document).ready(function(){
        $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
                $(this).toggleClass('open');        
            },
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
                $(this).toggleClass('open');       
            }
            );
    });



    //Subcribe post request

    $('#js-subscribe-btn').on('click',function(e){ 

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var form_url = $('#subscribeUrl').val();
        e.preventDefault(); 
        $.ajax({

            type: "POST",
            url: form_url,
            dataType: 'JSON',
            data: { 
                _token: CSRF_TOKEN,
                email:$('#subscribeEmail').val()
            },
            beforeSend: function() {
             $('#loader').show();
         },
         complete: function(){
             $('#loader').hide();
         },
         success: function (data) {
            if(data.status=='success') {
                $('#msg').removeClass();
                $('#msg').addClass('ajax-success');
                $('#msg').text(data.msg);
                $('#msg').slideDown(1000);
                $('#subscribeEmail').val("");
            }
            else{
                $('#msg').removeClass();
                $('#msg').addClass('ajax-danger');
                $('#msg').text(data.msg);
                $('#msg').slideDown(1000);
                $('#subscribeEmail').val("");


            }
        },
        error: function(jqXHR, json, errorThrown) {
            $('#loader').hide();
            var errors = jqXHR.responseJSON;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; 
            });
            $('#msg').removeClass();
            $('#msg').addClass('ajax-danger');
            $('#msg').html( errorsHtml);
            $('#msg').slideDown(1000);
        }
    }); 
    }); 

      //Add to quote request

      $('#addToQuote .quote').on('click',function(e){ 
        e.preventDefault(); 
        var me = $(this),
        data = me.data('params');
        var getUrl=$(this).prev('input').val();
        
        $.ajax({
            type: "GET",
            url: getUrl,
            dataType: 'JSON',
            beforeSend: function() 
            {
             me.children('img').show();
         },
         complete: function(){
             me.children('img').hide().delay( 800 );
         },
         success: function (data) 
         {
            if(data.status=='success') 
            {
                $('#cartCount').text(data.count);
                me.next('#alert').text(data.msg);
                me.next('#alert').show(1000);
                me.next('#alert').removeClass();
                if(data.msg=='Product already added!')
                    me.next('#alert').addClass('ajax-danger');
                else
                    me.next('#alert').addClass('ajax-success');
            }
            else
            {
                me.next('#alert').removeClass();
                me.next('#alert').addClass('ajax-danger');
                me.next('#alert').text(data.msg);
                me.next('#alert').slideDown(1000);
                


            }
        },
        error: function(jqXHR, json, errorThrown) {
            $('#loader').hide();
            var errors = jqXHR.responseJSON;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; 
            });
            me.next('#alert').removeClass();
            me.next('#alert').addClass('ajax-danger');
            me.next('#alert').html( errorsHtml);
            me.next('#alert').slideDown(1000);
        }
    }); 

    });

      $('.main-header').affix({
          offset: {
            top: 120
        }
    });


      $(window).scroll(function(){
         var height = $(this).scrollTop();
         var brand = $("#smallLogo");
         if (height > 125){
           brand.show('slow');  
           $('.main-header').addClass('shrink') ;
       }
       else{
          brand.hide();
          $('.main-header').removeClass('shrink') ;
      }
  });


  })(jQuery);
