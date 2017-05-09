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


    //Product List Side bar
    $(document).ready(function() {                                                               
      jQuery("#tree ul").hide();                                                       

      jQuery("#tree li").each(function() {                                                  
        var handleSpan = jQuery("<span></span>");
        handleSpan.addClass("handle");                                       
        handleSpan.prependTo(this);                                          

        if(jQuery(this).has("ul").size() > 0) {                              
          handleSpan.addClass("collapsed");                        
          handleSpan.click(function() {                            
            var clicked = jQuery(this);                  
            clicked.toggleClass("collapsed expanded");   
            clicked.siblings("ul").toggle();             
          });                                                      
        }                                                                    
      });     

      var li = $('#tree li.active');

      li.parents("ul").show();
      li.parents().siblings("span").toggleClass("collapsed expanded");

      jQuery("#tree li").each(function() 
      {
        if(jQuery(this).hasClass('active'))
        {
          var active = jQuery(this); 
          if(active.has("ul").size() > 0)
          {
           active.children('span').toggleClass("collapsed expanded");
           active.children("ul").toggle();
         }
       }
     });


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
            $('.cartCount').text(data.count);


            me.next('#alert').text(data.msg);
            me.next('#alert').show(1000);
            me.next('#alert').removeClass();
            if(data.msg=='Product already added!')
              me.next('#alert').addClass('ajax-danger');
            else{
              me.next('#alert').addClass('ajax-success');

             $('#side-cart-table > tbody:last-child').append(
                '<tr id='+ data.cartItem['item']['id'] +'><td><strong>'+ data.cartItem['item']['name_en'] +
                '</strong></td><td>'+ data.cartItem['quantity'] + '</td><td>MTN</td></tr>');

              $('#cartNoProducts').hide();
              if($('#updateCart').length==0)
                $('#side-cart-table').parent().append('<div id=\"updateCart\" class=\"center-block text-center\">'+
                  '<a class=\"btn btn-primary btn-sm\" href=\"/quoterequest\">Update Quote Request</a></div>'); 
            }
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



 //Remove Cart Item

 $('.removeCartItem').on('click',function(e){ 

  e.preventDefault(); 
  var me = $(this);
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

     $('.cartCount').text(data.count);

     if(me.closest('tbody').find('tr').length-1 === 0){
       me.closest('tbody').html('<div class=\"alert alert-danger alert-dismissable\">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
        '</button>Your cart is empty!</div>');
       $('#updateCart').remove();
       $('#side-cart-table').parent('.panel-body').html('<div id="cartNoProducts" class="alert alert-danger">' +
        'No products added</div>');
     }

     me.closest('tr').remove();
     $('#side-cart-table').find('#'+data.prodId).remove();


   }
   else
   {
    console.log("Item not deleted");



  }
},
error: function(jqXHR, json, errorThrown) {
  $('#loader').hide();
  var errors = jqXHR.responseJSON;
  var errorsHtml= '';
  $.each( errors, function( key, value ) {
    errorsHtml += '<li>' + value[0] + '</li>'; 
  });

  console.log("erros" + errorsHtml);
}

});

});



 //Update Cart Item

 $('.quote-form').on('submit',function(e){ 

  e.preventDefault(); 
  var me = $(this);
  me.find('#msg').slideUp(1000);
  var getUrl=$(this).attr('action');
  $.ajax({
    type: "POST",
    url: getUrl,
    dataType: 'JSON',
    data: $(this).serialize(),
    beforeSend: function() 
    {
     me.find('.updateCartItem').children('img').show();
   },
   complete: function(){
     me.find('.updateCartItem').children('img').hide().delay( 800 );
   },
   success: function (data) 
   {
     if(data.status=='success') {
      me.find('#msg').removeClass();
      me.find('#msg').addClass('ajax-success');
      me.find('#msg').text(data.msg);
      me.find('#msg').slideDown(1000);

    }
    else{
      me.find('#msg').removeClass();
      me.find('#msg').addClass('ajax-danger');
      me.find('#msg').text(data.msg);
      me.find('#msg').slideDown(1000);



    }
  },
  error: function(jqXHR, json, errorThrown) {
     me.find('.updateCartItem').children('img').hide();
    var errors = jqXHR.responseJSON;
    var errorsHtml= '';
    $.each( errors, function( key, value ) {
      errorsHtml += '<li>' + value[0] + '</li>'; 
    });


    me.find('#msg').removeClass();
    me.find('#msg').addClass('ajax-danger');
    me.find('#msg').html( errorsHtml);
    me.find('#msg').slideDown(1000);
  }

});

});







 $('.main-header').affix({
  offset: {
    top: 120
  }
});


 var lastTop = 120;
 $(window).scroll( function (evt) {
  var thisTop = $(this).scrollTop();

  if (thisTop > lastTop) 
  {
    $("#smallLogo").show('slow',function(){
     $('.main-header').addClass('shrink');
   });
  }
  else if(thisTop < lastTop)
  {
   $("#smallLogo").hide('fast',function(){
     $('.main-header').removeClass('shrink');
   });
 }

});





      //SideBar 

      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
      $("#menu-toggle-2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
        $('#menu-toggle-2 i').toggleClass('fa-chevron-right fa-chevron-left');
      });

      function initMenu() {
        $('#menu ul').hide();
        $('#menu ul').children('.current').parent().show();
      //$('#menu ul:first').show();
      $('#menu li a').click(
        function() {
          var checkElement = $(this).next();
          if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            return false;
          }
          if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#menu ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
            return false;
          }
        }
        );
    }
    $(document).ready(function() {initMenu();});

    $('#sidebar-container').hover(function () {
      $('#sidebar-wrapper').width('250px');
    }, function() {

      $('#sidebar-wrapper').width('');

    });

    $('#sidebar-accordion').on('show.bs.collapse', function () {

      if($('#wrapper').hasClass('toggled-2'))
       $("#wrapper").toggleClass("toggled toggled-2");
     if($('#menu-toggle-2 i').hasClass('fa-chevron-left'))
       $('#menu-toggle-2 i').toggleClass('fa-chevron-left fa-chevron-right');
   });


 $('#searchlink').on('click', function(e) {
      $(this).parent().toggleClass('open');
    });
 

  })(jQuery);
