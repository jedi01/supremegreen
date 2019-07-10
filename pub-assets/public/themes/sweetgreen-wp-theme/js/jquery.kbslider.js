/*
 * KBSlider
 *
 * Rotating slider that mimics the famous 'Ken Burns' style photography. Features CSS Transforms
 * supported in modern browsers with fallbacks supported by jQuery Animate(). Also features full
 * screen images (background cover) with fallbacks supported by JQuery Anystretch.
 *
 * Version: v0.0.01 (05/24/2013)
 * Minimum requirements: jQuery v1.4+, jQuery Anystretch v1.2+, jQuery Transit 0.9.9+
 *
 */

;( function( $ ) {

  //____________________
  var   config,     $th,          timer,  dir,
        thiss,      thiss_image,  thiss_caption,
        next,       next_image,   next_caption,
        prev,       prev_image,   prev_caption,
        prev_cnt,   slides,       maxcnt,
        transTime,  slideTime,    initialImageScale,
        easing,     args,         scaleImages,
        autoSlide,  cnt = 1,      csstrans;

  //var csstrans = ( $( 'html' ).hasClass( 'csstransforms' ) ) ? true : false;

  //_____________
  var methods = {

    init: function( options )
    {
      return this.each( function()
      {

        $th = $( this );
        config = $th.data( 'KBSlider' );

        if( typeof( config ) == 'undefined' )
        {

          var defaults = {
            slideTime          : 8000,
            transTime          : 1500,
            initialImageScale  : 1.075,
            easing             : 'linear',
            imgEase            : 'linear',
            onSlideStart       : '',
            onSlideComplete    : '',
            scaleImages        : true,
            autoSlide          : true,
            csstrans           : true
          }

          config = $.extend( {} , defaults , options );

          $th.data( 'KBSlider' , config );
        }
        else
        {
          config = $.extend( {} , config , options );
        }

        transTime = config.transTime;
        slideTime = config.slideTime;
        initialImageScale = config.initialImageScale;
        easing = config.easing;
        imgEase = config.imgEase;
        scaleImages = config.scaleImages;
        autoSlide = config.autoSlide;
        csstrans = config.csstrans;

        // FIND ELEMENTS
        //th = $( this );
        slides = $th.find( '.item' );
        maxcnt = $th.find( '.item' ).length;

        // POSITION SLIDES
        slides.css( { opacity: '0' , position : 'absolute' , width : '100%' , height : '100%' } );

        // ANYSTRETCH BACKGROUND IMAGES
        slides.find( '.bg-image' ).each( function( i )
        {
          var th = $( this );
          var id = '#' + th.attr( 'id' );
          var img = th.attr( 'data-url' );
          $( id ).anystretch( img );
        });

        // START SLIDE ROTATION AND SET INTERVAL FOR ROTATION
        dir = 'next';
        rotate();

        if( autoSlide )
        {
          timer = window.setInterval( rotate , config.slideTime );
        }

      });
    },

    stop: function( options )
    {
      window.clearInterval( timer );
    },

    resume: function( options )
    {
      rotate();
      timer = window.setInterval( rotate , config.slideTime );
    },

    prev: function( options )
    {
      cnt = ( dir != 'prev' ) ? cnt = cnt - 2 : cnt;
      dir = 'prev';
      window.clearInterval( timer );
      rotate();
    },

    next: function( options )
    {
      cnt = ( dir != 'next' ) ? cnt + 2 : cnt;
      dir = 'next';
      window.clearInterval( timer );
      rotate();
    },

    destroy: function( options )
    {
      return $( this ).each( function()
      {
        var th = $( this );
        th.removeData( 'KBSlider' );
      });
    },

    val: function( options )
    {
      var someValue = this.eq(0).html();
      return someValue;
    }

  };

  //____________________
  var rotate = function()
  {
    // COUNTING
    switch( dir )
    {
      case 'prev' : if( cnt == 0 ) {
                      cnt = maxcnt;
                      prev_cnt = 1;
                    } else {
                      cnt = cnt;
                      prev_cnt = cnt + 1;
                    }
                    break;

      default :     if( cnt == maxcnt + 1 ) {
                      cnt = 1;
                      prev_cnt = maxcnt;
                    } else {
                      cnt = cnt;
                      prev_cnt = cnt - 1;
                    }
    }

    // FIND SLIDER ELEMENTS
    thiss = $th.find( '.item' ).eq( cnt - 1 ); // eq is a zero based index
    thiss_caption = thiss.find( '.content' );
    thiss_image = thiss.find( 'img' );

    next = $th.find( '.item' ).eq( cnt + 1 ); // eq is a zero based index
    next_caption = next.find( '.content' );
    next_image = next.find( 'img' );

    prev = $th.find( '.item' ).eq( prev_cnt - 1 ); // eq is a zero based index
    prev_caption = prev.find( '.content' );
    prev_image = prev.find( 'img' );

    args = {
      thisSlide    : thiss,
      thisNum      : cnt,
      thisCaption  : thiss_caption,
      thisImage    : thiss_image,
      nextSlide    : next,
      nextNum      : cnt + 1,
      nextCaption  : next_caption,
      nextImage    : next_image,
      prevSlide    : prev,
      prevNum      : prev_cnt,
      prevCaption  : prev_caption,
      prevImage    : prev_image
    }

    slideStart( args );

    // SLIDES
    $( prev ).css( { zIndex : 0 } );
    $( thiss ).css( { opacity : 0 , zIndex : maxcnt } );
    if( csstrans ) {
      $( thiss ).transition( { opacity : 1 } , transTime , easing , function()
      {
        $( prev ).css( { opacity : 0 });
        slideComplete( args );
      });
    } else {
      $( thiss ).animate( { opacity : 1 } , transTime , easing , function()
      {
        $( prev ).css( { opacity : 0 });
        slideComplete( args );
      });
    }

    // IMAGES
    if( csstrans && scaleImages ) {
      $( thiss_image ).show().transition( { scale: initialImageScale } , 0 )
        .transition( { scale: 1 } , slideTime + 500 , 'linear' );
    } else {
      $( thiss_image ).show();
    }

    // CAPTIONS
    $( thiss_caption ).css( { opacity : 0 } );
    if( csstrans ) {
      $( thiss_caption ).transition( { opacity : 1 , delay : 800 } , transTime , easing );
    } else {
      $( thiss_caption ).delay( 800 ).animate( { opacity : 1 } , transTime , easing );
    }

    switch( dir )
    {
      case 'prev' : cnt = cnt - 1; break;
      default : cnt++;
    }

  }

  var slideStart = function( args )
  {
    if( config.onSlideStart != '' )
    {
      config.onSlideStart( args );
    }
  }

  var slideComplete = function( args )
  {
    if( config.onSlideComplete != '' )
    {
      config.onSlideComplete( args );
    }
  }

  //_______________________
  $.fn.KBSlider = function()
  {
    var method = arguments[0];

    if( methods[ method ] ) {
      method = methods[ method ];
      arguments = Array.prototype.slice.call( arguments , 1 );
    } else if( typeof(method) == 'object' || !method ) {
      method = methods.init;
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.KBSlider' );
      return this;
    }

    return method.apply(this, arguments);
  }

} )( jQuery );
