/**********
 * VARIABLES
 *********/

var css3 = $( 'html' ).hasClass( 'cssanimations' ) ? true : false;
var no_touch = $( 'html' ).hasClass( 'no-touch' ) ? true : false;
var touch = $( 'html' ).hasClass( 'touch' ) ? true : false;
var lt_ie10 = $( 'html' ).hasClass( 'lt-ie10' ) ? true : false;
var lt_ie9 = $( 'html' ).hasClass( 'lt-ie9' ) ? true : false;
var wn = $( window );
var hash = window.location.hash;
var loca = hash.replace( '#' , '#' );
var slide = false;
var slid;
var homePageSlider;
var getAppTimer;
var playState;


/**********
 * FUNCTIONS
 *********/

  var windowPath = window.location.pathname,
      windowHash = window.location.hash;

 if (windowPath.indexOf('/contact') >= 0)
 {

   //accessibility additions
   $('input[type=file]').each(function() {
     var label = this.name.replace('-01', ' one').replace('-02', ' two').replace('-03', ' three');
     $(this).attr('aria-label', label);
   });

   $.fn.clearForm = function() {
     return this.each(function() {
       var type = this.type, tag = this.tagName.toLowerCase(), name = this.name;
       if (tag == 'form')
         return $(':input',this).clearForm();
       if ((type == 'text' && name != 'subject-field') || type == 'password' || tag == 'textarea')
         this.value = '';
       else if (type == 'checkbox' || type == 'radio')
         this.checked = false;
       else if (tag == 'select')
         this.selectedIndex = -1;
     });
   };

   $('.del_file').hide();

   var addRemoveFileListener = function () {
     $('input[type=file]').change(function () {
       var fileSize = this.files && this.files.length ?
              this.files[0].size/1024/1024 : 0;
       // hide any existing error message
       $(this).parent().find('.wpcf7-not-valid-tip').hide();
       $(this).parent().next().show();
       if (fileSize > 2) {
         var filePath = $(this).val();
         var fileName = filePath.split(/(\\|\/)/g).pop();
         // show the error message
         $(this).parent().append('<span class="wpcf7-not-valid-tip">' + fileName + ' is too large. File size cannot exceed 2mb.</span>');
       }
     });
   };

   addRemoveFileListener();

   //functionality for del-file link
   $('.del_file').on('click', function(e){

     $(this).hide();
     // hide error messages
     $(this).parent().find('.wpcf7-not-valid-tip').hide();
     var input_parent = $(this).parent();
     var input_wrap = input_parent.find('.wpcf7-form-control-wrap');

     //reset field value
     input_wrap.html(input_wrap.html());
     addRemoveFileListener();
     e.preventDefault();
   });


    $('.close-button, .close-form-button').on('click', function()
    {
      $('.contact-form-overlay').fadeOut();
    });

    $('.wpcf7').hide();
    $('.wpcf7 form').attr('enctype', 'multipart/form-data');


    function setStoreNameVisibility(form) {
      var field = $(form).find('select[name=store-name]').closest('p.form-field-select');
      if ($(form).find('[name=store-state]').val()) {
        field.show();
      } else {
        field.hide();
      }
    }

    $('.wpcf7 form').each(function(i, form) {
      setStoreNameVisibility(form);
    });

   $('.wpcf7 form').find('[name=store-state]').change(function(event) {
     var stateSelected = event.currentTarget.value;
     var form = $(event.currentTarget).closest('form');
     var allOptions = $(form).find('select[name=state-mapping] option');

     // remove all the current store name options
     $(form).find('select[name=store-name] option').each(function($index, $opt) {
       if ($index) {
         $opt.remove()
       }
     });

     if (stateSelected) {
       allOptions = allOptions.filter('[value=' + stateSelected + ']');
     }

     var namedOpts = allOptions.map(function(i, option) {
       return $(option).text();
     }).sort();

     $.each(namedOpts, function (i, $name) {
       $(form).find('select[name=store-name]').append('<option value="' + $name + '">' + $name + '</option>');
     });

     setStoreNameVisibility(form);
   });

    if (windowHash.indexOf('wpcf7') > -1)
    {
      $(windowHash).fadeIn();
    }

    if ($("#contact-form-result").val() == "true") {
      $('.content .header').hide();
      $('.content p.subject').hide();
      $('#contact form > p').hide();
      $('#contact form > section').hide();
      $('.wpcf7-form-control.wpcf7-recaptcha').hide();
      var confMsg = $('.wpcf7-response-output.wpcf7-mail-sent-ok')[0].textContent.split('\\n');
      var confHTML = confMsg.join("<br>");
      $('.wpcf7-response-output.wpcf7-mail-sent-ok').contents().replaceWith(confHTML);
      $('.wpcf7-response-output.wpcf7-mail-sent-ok').after('<a href="/contact" class="blackbtn">Have another comment?</a>');
    }

   function setMaxDate() {
     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth()+1; //January is 0!
     var yyyy = today.getFullYear();
     if(dd<10){
       dd='0'+dd
     }
     if(mm<10){
       mm='0'+mm
     }

     today = mm + '/' + dd + '/' + yyyy;

     $('input[name=date-ordered]').attr('max', today);
     $('input[name=date-ordered]').datepicker({maxDate: "+0D"});
     $('input[name=deadline]').datepicker({minDate: "+0D"});
     $('input[name=event-date]').datepicker({minDate: "+6W"});
   }

   setMaxDate();

   $('#contact #your-subject').change(function(e) {
     $('form').clearForm();
     $('.wpcf7').removeClass('active');
     $('.wpcf7').hide();
     $form_selected = this.value;
     $form_containor = $('#support-form-'+ $form_selected + ' .wpcf7');
     $form_containor.addClass('active');
     $form_containor.fadeIn();
     $form_containor.focus();
     headerHeight = $("#contact-header").height();
     $("html,body").animate({scrollTop:$form_containor.offset().top - headerHeight/2 + "px"}, 300);
   });


   var params = (new URL(document.location)).searchParams;
   var subject = params && params.get("subject");

   if (subject && subject === 'delivery' && windowHash.indexOf('wpcf7') === -1) {
     $('#contact #your-subject')
       .val(1)
       .trigger('change');

     var formFields = ['first-name', 'last-name', 'your-email', 'store-state', 'store-name', 'date-ordered', 'part-of-day', 'order-number'];

     for (var f = 0; f < formFields.length; f++) {
       var field = formFields[f];
       var fieldVal = params.get(field);
       var foundField = $('.wpcf7.active').find('[name=' + field + ']');

       if (foundField) {

         if (f === 3) {
           fieldVal = fieldVal.toUpperCase();
         } else if (f === 4) {
           fieldVal = fieldVal.split(' ').map(transformToUppercaseWord).join(' ');
         } else if (f === 6) {
           fieldVal = transformToUppercaseWord(fieldVal);
         }

         foundField.val(fieldVal);
         if (foundField[0].localName === 'select') {
           foundField.trigger('change');
         }
       }
     }
   }

 } else if (windowPath.indexOf('/our-story') >= 0) {
   if (window.innerWidth <= 480 ) {
      $('#sweetgreen-in-schools').next().css('padding-bottom', '50px');
   }
 }

function transformToUppercaseWord(str) {
  if (str[0] === '(') {
    return str[0] + str[1].toUpperCase() + str.slice(2);
  }

  return str[0].toUpperCase() + str.slice(1);
}

 $( '.bg-image' ).css( 'opacity' , '0' );

// PAGE LOAD INDICATOR
if( $( '#spinner' ).length > 0 )
{
  var div = document.createElement( 'div' );
  var con = document.getElementById( 'spinner' );
  div.id = 'loading';
  con.appendChild( div );
  var opts = { lines: 17, length: 0,  width: 8, radius: 11, corners: 1, rotate: 0, direction: 1, color: '#FFF', speed: 1,  trail: 60, shadow: false,  hwaccel: false, className: 'spinner', zIndex: 2e9, top: 'auto', left: 'auto' };
  var target = document.getElementById( 'loading' );
  var spinner = new Spinner( opts).spin( target );
  target.appendChild( spinner.el );
}

var touchStartOrClick = "click";

if (Modernizr.touch){
  MBP.hideUrlBarOnLoad();
  MBP.scaleFix();
  touchStartOrClick = "touchstart";
}

// LOAD YOUTUBE API SCRIPT
if( $( '.vid-youtube' ).length > 0 )
{
  var tag = document.createElement( 'script' );
  var firstScriptTag;
  tag.src = "https://www.youtube.com/iframe_api";
  firstScriptTag = document.getElementsByTagName( 'script' )[ 0 ];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

$( '#sidenav' ).css( {
  marginTop : -($('#sidenav').height()/2),
  top       : '50%'
} );


$( window ).load( function()
{

  /**
   * GOOGLE TRACK EXTERNAL LINKS
   */
  // $( 'a[rel="no-follow"] , a[rel="external"] , a[rel="nofollow"]' ).gaTrackExternal();

  /**
  *  HIDE SPIN INDICATOR
  */
  $( '#spinner' ).transit( { opacity : 0 } , '1000' , function() { $( this ).hide(); } );


  /**
  * STRETCH BACKGROUND IMAGES - FOR DESKTOP ONLY
  */
  if ( lt_ie9 )
  {
    $( '.bg-image' ).each( function( i )
    {
      var th = $( this );
      var id = '#' + th.attr( 'id' );
      var img = th.attr( 'data-url' );

      $( id ).anystretch( img );
      $( id ).transit( { opacity : 1 } , '500' );
      $( '.section-video .vid-overlay, .section-instagram .vid-overlay' ).transit( { opacity : 1 } , '500' );
    });
  }
  else
  {
    $( '.bg-image' ).transit( { opacity : 1 } , '500' );
    $( '.section-video .vid-overlay, .section-instagram .vid-overlay' ).transit( { opacity : 1 } , '500' );
  }


  /**
  *  MODAL EVENT LISTENERS
  */
  $( 'a[title="modal"]' ).each( function()
  {
    var th = $( this ).attr( 'data-toggle' , "modal" );
    th.attr( 'data-toggle' , 'modal' );
  });

  $( '#get-the-app .get-the-app' ).click( function( e )
  {
    e.preventDefault();
    $( '#get-the-app' ).toggleClass( 'active' );
  });

  var openGetTheAppSlider = function(e)
  {
    if (document.location.pathname == "/") {
      e.preventDefault();
      var remove_active_to = $( '#mobile-nav, #main, #header, #footer' );
      remove_active_to.removeClass( 'active-sidebar' );
      $( '#get-the-app .get-the-app' ).click();
    }
  };

  $( '#menu-get-the-app .get-the-app' ).click(openGetTheAppSlider);

  $( '#mobile-menu-get-the-app .get-the-app' ).click(openGetTheAppSlider);

  $( 'article' ).bind( 'click' , function()
  {
    $( '#get-the-app' ).removeClass( 'active' );
  });

  // YOUTUBE MODAL
  $( '.section-video a.cta, .cta-youtube' ).click( function( e )
  {
    var th = $( this );
    var thp = th.parents( '.section' );
    var thvm = th.attr( 'rel' );
    var modal = thp.find( '#' + thvm );

    th.addClass( 'player-loaded' );

    e.preventDefault();
    setUpNewPlayer( modal );
    modal.fadeIn();
    modal.addClass( 'vid-playing' );
    modal.removeClass( 'hide-modal' );

    $( '.vid-overlay' ).addClass( 'theater pointer' ).attr( 'title' , 'Close Video' )
    .bind( 'click' , function ( e ) {
      $( this ).unbind( 'click' );
      playState = '';
      hideVidModal( e.target , 'kill' );
    });

  });

  // HOMEPAGE GALLERY - See jquery.kbslider for slide counting and rotation.
  // Specific transitions are handeled in kbslideStart. Slide Element Containers
  // are passed through in the args object.
  $( '.section-rotating-slide-home .gallery-wrap' ).KBSlider(
  {
    slideTime          : 8000,
    transTime          : 1500,
    initialImageScale  : 1.075,
    easing             : 'linear',
    onSlideStart       : kbslideStart,
    onSlideComplete    : kbslideComplete,
    imgEase            : 'easeOutSine',
    scaleImages        : true,
  });

  $( '.section-rotating-slide-page .gallery-wrap' ).KBSlider(
  {
    slideTime          : 8000,
    transTime          : 1500,
    easing             : 'linear',
    onSlideStart       : kbslideStart,
    onSlideComplete    : kbslideComplete,
    imgEase            : 'easeOutSine',
    scaleImages        : false,
  });

  $( '.section-rotating-slide .cta-youtube' ).click( function( e )
  {
    $( '.gallery-wrap' ).KBSlider( 'stop' );
  });

  $( '.section-rotating-slide .sweetgreen-icon-arrow-left-circle' ).click( function( e )
  {
    $( '.gallery-wrap' ).KBSlider( 'prev' );
  });

  $( '.section-rotating-slide .sweetgreen-icon-arrow-right-circle' ).click( function( e )
  {
    $( '.gallery-wrap' ).KBSlider( 'next' );
  });

  /**
  *  SALAD SLIDER
  */
  $( '.slider' ).each(function(index) {
    $(this).iosSlider({
      snapToChildren: true,
      desktopClickDrag: false,
      infiniteSlider: true,
      snapSlideCenter: true,
      responsiveSlideContainer: false,
      responsiveSlides: true,
      navSlideSelector: $(".slider-indicators .pointer"),
      navPrevSelector: $(this).parent().find('.sweetgreen-icon-arrow-left-circle'),
      navNextSelector: $(this).parent().find('.sweetgreen-icon-arrow-right-circle'),
      onSlideStart: slideStart,
      onSlideComplete: slideComplete,
      onSlideChange: slideChange,
      onSliderLoaded: slideChange,
      stageCSS: {
        overflow: 'visible'
      }
    });
  });

  $( '.farmer-slider' ).iosSlider(
    {
      snapToChildren:           true,
      desktopClickDrag:         false,
      infiniteSlider:           true,
      snapSlideCenter:          true,
      responsiveSlideContainer: false,
      responsiveSlides:         true,
      navSlideSelector:         $( ".slider-indicators .pointer" ),
      navPrevSelector:          $( '.section-farmer-slider .sweetgreen-icon-arrow-left-circle' ),
      navNextSelector:          $( '.section-farmer-slider .sweetgreen-icon-arrow-right-circle' ),
      onSlideStart:             slideStart,
      onSlideComplete:          slideComplete,
      onSlideChange:            slideChangeFarmer,
      onSliderLoaded:           slideChangeFarmer,
      stageCSS: {
        overflow: 'visible'
      }
    });

  /**
  *  TURN IMGS HOLDING SVGS INTO EMBEDED SVGS WITH CUSTOM COLOR
  */
  $( 'img.svg' ).each( function()
  {
      var $img = $( this );
      var imgID = $img.attr( 'id' );
      var imgClass = $img.attr( 'class' );
      var imgURL = $img.attr( 'src' );
      var fill = $img.attr( 'style' );

      jQuery.get( imgURL , function( data )
      {
          var $svg = jQuery( data ).find( 'svg' ); // Get the SVG tag, ignore the rest
          if( typeof imgID !== 'undefined' )
          {
              $svg = $svg.attr( 'id' , imgID ); // Add replaced image's ID to the new SVG
          }
          if( typeof imgClass !== 'undefined' )
          {
              $svg = $svg.attr( 'class' , imgClass + ' replaced-svg' ); // Add replaced image's classes to the new SVG
              $svg = $svg.attr( 'style' , fill );
          }
          $svg = $svg.removeAttr( 'xmlns:a' ); // Remove any invalid XML tags as per http://validator.w3.org
          $img.replaceWith( $svg ); // Replace image with new SVG
      });

  });

  /**
  *  MOBILE MENU EVENT LISTENER
  */
  $( '.mobile-menu , a.sidebar-get-the-app' ).click( function( e )
  {
    var add_active_to = $( '#mobile-nav, #main, #header, #footer' );
    e.preventDefault;
    add_active_to.toggleClass( 'active-sidebar' );
    $( '#main > article' ).bind( 'click' , deactivateSidebar );
  });


  $( '.section-menu-tabs a' ).click( function(e)
  {
    var trgt = $( this ).attr( 'id' );
    var parent = $( this ).parents( '.section-menu-tabs' );
    parent.find( '.tab' ).removeClass( 'active' );
    parent.find( '.' + trgt ).addClass( 'active' );
  });

  if ( $('.share-twitter').length > 0 || $('.share-facebook').length > 0 )
  {
    shareInit();
  }

});

function shareInit()
{
  $('.share-twitter').sharrre( {
    share: {
      twitter: true
    },
    enableHover: false,
    enableTracking: true,
    buttons: { 
      url: $(".twitter").attr("data-url") 
    },
    click: function(api, options){
      api.simulateClick();
      api.openPopup('twitter');
    }
  });
  $('.share-facebook').sharrre( {
    share: {
      facebook: true
    },
    enableHover: false,
    enableTracking: true,
    click: function(api, options){
      api.simulateClick();
      api.openPopup('facebook');
    }
  });
}

function deactivateSidebar()
{
  $( '#mobile-nav, #main, #header, #footer' ).removeClass( 'active-sidebar' );
  $( '#main > article' ).unbind( 'click' );
}

// JOBS TABLE SORTING
$("#jobs_table_sort").tablesorter({ 
    widgets: ['zebra'],
    sortList: [[2,0]]
}); 



// FOR GALLERY SLIDER
function slideStart( args )
{
  slide = true;
  $( '.slide-title' ).addClass( 'trans' );
}
function slideComplete( args )
{
  var obj = args.currentSlideObject[ 0 ].id;
  slide = false;
  $( '#' + obj ).find( '.slide-title' ).removeClass( 'trans' );
}
function slideChange( args )
{
  resizeArticles();
  var num = args.currentSlideNumber;
  $( ".slider-indicators .pointer" ).removeClass( 'active' );
  $( ".slider-indicators .pointer" ).eq(num-1).addClass( 'active' );
}

function slideChangeFarmer( args )
{
  var num = args.currentSlideNumber;

  var slides = $( ".slider-inner .item" );

  slides.removeClass( 'active' );
  slides.eq(num-1).addClass( 'active' );
  var slideHeight = slides.eq(num-1).height();

  $("#supply-network .section-farmer-slider").height(slideHeight);
}


// HOMEPAGE SLIDER FUNCTIONS
function kbslideStart( args )
{
  dly = 800;
  ttl = args.thisCaption.find( 'h1' );
  cta = args.thisCaption.find( 'h2' );

  cta.css( 'opacity' , '0' );

  if( css3 ) {
    ttl.transit( { x : '-=80px' } , 0 ).transit( { x : '+=80px' , delay : dly } , 1500 );
    cta.transit( { x : '-=80px' } , 0 ).transit( { x : '+=80px' , opacity : 1 , delay : dly + 400 } , 1500 );
  } else {
    ttl.animate( { x : '-=80px' } , 0 ).delay( dly ).animate( { x : '+=80px' } , 1500 );
    cta.animate( { x : '-=80px' } , 0 ).delay( dly + 400 ).animate( { x : '+=80px' , opacity : 1 } , 1500 );
  }
}
function kbslideComplete( args )
{

}

// YOUTUBE PLAYER FUNCTIONS
function setUpNewPlayer( modal )
{
  var player_ID = modal.find( '.vid-youtube' ).attr( 'id' );
  var video_ID = getParameterByName( 'v' , modal.find( '.vid-youtube' ).attr( 'data-url' ) );
  onYouTubeIframeAPIReady( player_ID , video_ID );
}
function onYouTubeIframeAPIReady( player_ID , video_ID )
{
  if (!player_ID) {
    return;
  }
  var player;
  if( touch ) {
    player = new YT.Player( player_ID, { videoId: video_ID });
  } else {
    player = new YT.Player( player_ID, {
      videoId: video_ID,
      events: { 'onReady': playerPlay , 'onStateChange': playerPause }
    });
  }
}
function playerPlay( e )
{
  e.target.playVideo();
}
function playerPause( e )
{
  var target = $( e.target.getVideoEmbedCode() );
  var th = $( '#' + target.attr( 'id' ) );
  var playerTimer;

  playState = e.data;

  //console.log( e.data );

  if ( playState == 0 || playState == 2 ) // When player ends || When Player is paused
  {
    playerTimer = setTimeout( function()
    {
      hideVidModal( th , 'pause' );
    } , 3000 );
  }
  if ( playState == 1 ) // When player is playing
  {
    clearTimeout( playerTimer );
  }
}

function hideVidModal( target , method )
{
  var modal, ifram, cta, attr_data, attr_class, attr_id;
  var th = $( target );
  var thp = th.parents( '.section' );

  //console.log( target + ' ' + method );

  if ( playState != 1 )
  {

    modal = thp.find( '.vid-playing' );
    ifram = modal.find( 'iframe' );
    cta = thp.find( '.cta' );

    attr_data = ifram.attr( 'data-url' );
    attr_class = ifram.attr( 'class' );
    attr_id = ifram.attr( 'id' );

    modal.addClass( 'hide-modal' );
    modal.removeClass( 'vid-playing' );
    modal.fadeOut( function()
    {
      cta.removeClass( 'player-loaded' );
      if ( method === 'kill' )
      {
        modal.append( '<div class="' + attr_class + '" id="' + attr_id + '" data-url="' + attr_data + '"></div>' );
        ifram.remove();
      }
    });

    $( '.vid-overlay' ).unbind( 'click' ).removeClass( 'theater pointer' ).removeAttr( 'title' );

  }

}
// GET QUERY VAR FROM STRING
function getParameterByName( name , string )
{
  name = name.replace( /[\[]/ , "\\\[" ).replace( /[\]]/ , "\\\]" );
  var regex = new RegExp( "[\\?&]" + name + "=([^&#]*)" ) , results = regex.exec( string );
  return results == null ? "" : decodeURIComponent( results[1].replace( /\+/g , " " ) );
}

resizeArticles();

// RESPONSIVE LISTENER
$( wn ).bind( 'resize' , function() { 
  var resizeTim = setTimeout( function()
  {
    resizeArticles(); 
    clearTimeout( resizeTim );
  } , 500 );
});

// RESPONSIVE HANDLER
function resizeArticles()
{
  var wh = wn.height();
  var ww = wn.width();
  var bh = $( 'body' ).height();
  var vert_align = $( '.vertical-align' );
  var win_height = $( '.win-height' );

  var vid_modal = $( '.vid-modal' );
  var vid_modal_w = $( '.vid-modal' ).width();
  var modalWidth = ( ww <= 1024 ) ? ww - 20 : 1024 - 200;
  var modalHeight = modalWidth / 1.67;
  var modalLeftOffset = -( modalWidth / 2 );
  var modalTopOffset = -( modalHeight / 2 );

  var sliderh = $( '.section-slider' ).find( '.slider-inner > .item' ).height();

  var seasonal_bg = $( '.section-menu-top' ).find( '.bg-image' );

  // VERTICALLY ALIGN ALL ELEMENTS WITH .vert-align SELECTOR
  if ( ww >= 480 && vert_align.height() <= wh && document.location.pathname.indexOf('contact') == -1)
  {
    vert_align.css( { top : '50%' , left: '50%' , margin : 0 , position : 'absolute' } );
    vert_align.css( 'margin-top' , - ( vert_align.height() / 2 ) );
    vert_align.css( 'margin-left' , - ( vert_align.width() / 2 ) );
    vert_align.parents( 'section' ).find( '.wrap' ).css( 'padding' , 0 );
  }
  else
  {
    vert_align.css( { top : '0' , left : '0' , margin : '0 auto' , position : 'static' } );
  }

  // ADJUST YOU TUBE MODAL POSITIONING
  vid_modal.css({
    width : modalWidth ,
    marginLeft : modalLeftOffset ,
    height : modalHeight ,
    marginTop : modalTopOffset
  });

  // MAKE ALL ELEMENTS WITH .win-height SELECTOR WINDOW HEIGHT
  win_height.css( 'min-height' , wh );
  win_height.find( '.wrap' ).css( 'min-height' , wh );

  // SNAP MOBILE MENU BACK INTO POSITION IF SCALING BACK
  if ( ww >= 860 )
  {
    $( '#mobile-nav, #main, #header, #footer' ).removeClass( 'active-sidebar' );
  }

  // ADJUST HEIGHT OF SLIDERS
  $( '.section-slider' ).css( { height : sliderh } );

  // MOVE SEASONAL BG IMAGE TO THE TOP SPACE
  if ( ww <= 480 )
  {
    $( '.section-menu-top > .wrap' ).append( seasonal_bg );
    seasonal_bg.addClass( 'mobile' );
  }
  else if ( seasonal_bg.hasClass( 'mobile' ) && ww >= 480 )
  {
    $( '.section-menu-top' ).append( seasonal_bg );
  }

  $( '#get-the-app' ).removeClass( 'trans' );
  clearTimeout( getAppTimer );
  getAppTimer = setTimeout( function()
  {
    $( '#get-the-app' ).addClass( 'trans' );
  } , 500 );

  // MAKE SURE MAP IS PAGE HEIGHT
  if ( wh > $( '#locations' ).height() )
  {
    $( '#main' ).css( 'min-height' , wh );
  }
}

var focusIframe = function (frame) {
  scroll(0,100);
  var inputElement = document.getElementById('hiddenInput');
  inputElement.style.visibility = 'visible'; // unhide the input
  inputElement.focus(); // focus on it so keyboard pops
  inputElement.blur(); // blur on it so keyboard closes
  inputElement.style.visibility = 'hidden'; // hide it again
};

/**
 * HEADER SCROLL FUNCTION
 */
var lastScrollTop = 0;
function bindscroll(){ 
  var th = $( this );
  var st = th.scrollTop();
  if( st > lastScrollTop && st > 100 )
  {
    $( '#header' ).addClass( 'sub' );
  } else {
    $( '#header' ).removeClass( 'sub' );
  }
  lastScrollTop = st;
}


// DOC Ready
$(document).ready(function($)
{
  var ww = wn.width();

  $(".not-mobile #sidenav").scrollspy({offset:0});
  $("#sidenav a").smoothScrollTo();

  if ( ww <= 480 )
  {
    $( 'a.get-the-app' ).smoothScrollTo();
  }

  $( 'a.sidebar-get-the-app' ).smoothScrollTo();

  $( 'a.location' ).click( function()
  {
    $( "html,body" ).animate( { scrollTop : $('#map_canvas').offset().top - 116 } , 300 );
  } );
  $('.app-store > li > a').trackGA();

});

(function($) {
  $.fn.trackGA = function() {
    return $(this).click(function () {
      var category = $(this).attr('data-ga-category') || undefined; // required
      var action = $(this).attr('data-ga-action') || undefined; // required
      var label = $(this).attr('data-ga-label') || undefined;
      var value = parseInt($(this).attr('data-ga-value'), 10) || undefined;
      ga('send', 'event', category, action, label, value);
    });
  };
  $.fn.UpdateScrollspy = function() {
    return $('[data-spy="scroll"]').each(function() {
      $(this).scrollspy("refresh")
    })
  };


  $.fn.smoothScrollTo = function() {
    return this.on("click", function(b) {
      headerHeight = 0 < $("#header").size ? $("#header").height() : 0;
      var link = $(this).attr("href");
      var targetId = link.substr(link.indexOf('#'));
      $("html,body").animate({scrollTop:$(targetId).offset().top - headerHeight + "px"}, 300);
      b.preventDefault()
    })
  };

})($);

/* temporary fix*/
if (window.location.pathname.indexOf('/careers/')==0) { jQuery('section[id=""]').hide(); }

/* adding back model mail chimp signup and cookie */
/*! jquery.cookie v1.4.1 | MIT */
! function(a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof exports ? a(require("jquery")) : a(jQuery)
}(function(a) {
    function b(a) {
        return h.raw ? a : encodeURIComponent(a)
    }

    function c(a) {
        return h.raw ? a : decodeURIComponent(a)
    }

    function d(a) {
        return b(h.json ? JSON.stringify(a) : String(a))
    }

    function e(a) {
        0 === a.indexOf('"') && (a = a.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
        try {
            return a = decodeURIComponent(a.replace(g, " ")), h.json ? JSON.parse(a) : a
        } catch (b) {}
    }

    function f(b, c) {
        var d = h.raw ? b : e(b);
        return a.isFunction(c) ? c(d) : d
    }
    var g = /\+/g,
        h = a.cookie = function(e, g, i) {
            if (void 0 !== g && !a.isFunction(g)) {
                if (i = a.extend({}, h.defaults, i), "number" == typeof i.expires) {
                    var j = i.expires,
                        k = i.expires = new Date;
                    k.setTime(+k + 864e5 * j)
                }
                return document.cookie = [b(e), "=", d(g), i.expires ? "; expires=" + i.expires.toUTCString() : "", i.path ? "; path=" + i.path : "", i.domain ? "; domain=" + i.domain : "", i.secure ? "; secure" : ""].join("")
            }
            for (var l = e ? void 0 : {}, m = document.cookie ? document.cookie.split("; ") : [], n = 0, o = m.length; o > n; n++) {
                var p = m[n].split("="),
                    q = c(p.shift()),
                    r = p.join("=");
                if (e && e === q) {
                    l = f(r, g);
                    break
                }
                e || void 0 === (r = f(r)) || (l[q] = r)
            }
            return l
        };
    h.defaults = {}, a.removeCookie = function(b, c) {
        return void 0 === a.cookie(b) ? !1 : (a.cookie(b, "", a.extend({}, c, {
            expires: -1
        })), !a.cookie(b))
    }
});

$(function() {

  $('div.modal').modal({ keyboard: false });

  $('.modal').on('shown.bs.modal', function (e) {
    $('body').css('overflow-y', 'hidden');
    $('body').css('width', '100%');
    $('body').css('position', 'fixed');

  });
  $('.modal').on('hidden.bs.modal', function (e) {
    $('body').css('overflow-y', '');
    $('body').css('width', '');
    $('body').css('position', '');
  });

  var mailCaptureIframeSrc = 'https://sweetgreen.us5.list-manage.com/subscribe?u=935cde8faa405d2d908226449&id=653a41a842';
  var urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results && results[1];
  };

  $('#mailchimp-signup').on('show.bs.modal', function () {
    var version = urlParam("version");
    if (version && version==='2') {
      mailCaptureIframeSrc += "&version=2";
    }
    $('#modalMailCapture').attr('src', mailCaptureIframeSrc);
  });

  $('#mailchimp-signup').on('shown.bs.modal', function () {
    $('#mailchimp-signup').attr('aria-hidden', 'false');
    $('.modal-header .sweetgreen-icon-x').attr('tabindex', '0');
    $('.modal-header .sweetgreen-icon-x').focus();
  });

  $('#mailchimp-signup').on('hidden.bs.modal', function() {
    $('#mailchimp-signup').attr('aria-hidden', 'true');
    $('#modalMailCapture').attr('src', '');
    $('.modal-header .sweetgreen-icon-x').attr('tabindex', '-1');
    $('li.email button').attr('tabindex', '0');
    $('li.email button').focus();
   });

  var handleMessage = function(event) {
    if (!event || !event.origin)
      return;
    var isMailChimp = event.origin.includes("//sweetgreen.us5.list-manage1.com");
    var isDeskSupport = event.origin.includes("sweetgreen.desk.com") || event.origin.includes("support.sweetgreen.com");
    var isPostRequest = (event.data.request === "postUri");
    var isChangeUri = (event.data.request === "deleteUri");
    var isDeskHeight = (typeof event.data.request == "undefined") && (typeof event.data == "string") && (event.data.indexOf("px") >= 0);
    if (isMailChimp && !isPostRequest) {
      $('#mailchimp-signup').modal('hide');
    } else if (isDeskSupport) {
      if (isDeskHeight) {
        $('#deskSupport').css('height', event.data);
      }
      // else if (isChangeUri) {
      //   focusIframe();
      // }
    }
  };

  window.addEventListener("message", handleMessage, false);

    if (document.location.pathname ==="/" && ($.cookie('modal_shown') != 'true' || document.location.search.indexOf('signup=true') > 0)) {
        $.cookie('modal_shown', 'true', {
            expires: 7,
            path: '/'
        });
      setTimeout(function(){
       $("#footer .mailcapture").click();
      }, 1000);
    }

});
/* model mail chimp signup and cookie */
