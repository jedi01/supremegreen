/* Studio Steen pluginTemplate.js - v0.0.1

  ----------------------------------------
  ----- Usage:
  ----------------------------------------
  $('#selector').pluginName();

  ----------------------------------------
  ----- With custom values:
  ----------------------------------------
  $('#selector').pluginName({
    customizableString: 'i changed it from the outside',
    customizableBoolean: false,
    onComplete: function(data) {
       ----------------------------------------
       ----- do your custom stuff here
       ----------------------------------------
       log(data) // if you want to get YEEEH!
    }
  });

  ----------------------------------------
  ----- If you want to call a function from outside:
  ----------------------------------------
  var plugin = $('#selector').pluginName();
  plugin.destroy();

*/
$.fn.customMap = function (options) {
  'use strict';

  var _elem     = $(this),  // instance to $('#selector')
      _this     = this,     // instance to this plugin
      _adresses = MAP_ADRESSES;
  // custom variables
  var o         = $.extend({
    marker:          undefined,
    map:             '',
    id:              0,
    position:        {lat: 52.38259, lng: 4.9216634}, // position with Amsterdam as fallback if getCoordinates() fails
    positions:       [],
    failedPositions: 0,
    APIkey:          'AIzaSyAMddyrWbl5Qj6Sha_qQfJnWCs3NHD94DQ'
  }, options);


  _this.init = function () {
    // console.log('initialize plugin custom maps', _adresses);
    _elem.addClass('initialized');

    /** lookup adress & get coordinates
     //  when done, starts map **/
    for (var index = 0; index < _adresses.length; ++index) {
      _this.getGeocodingCoordinates(_adresses[index]);
    }
  };

  _this.destroy = function () {
    // console.log('destroy plugin custom maps');
    _elem.removeClass('initialized');
  };

  /** Get geocoding data for adress **/
  _this.getGeocodingCoordinates = function (adress) {
    // console.log('getGeocodingCoordinates', adress);
    $.ajax({
      url:     'https://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURI(adress.name + ',' + adress.addressStreet + ',' + adress.addressPostalcode + ' ' + adress.addressCity) + '&key=' + o.APIkey,
      type:    'GET',
      data:    {
        format: 'json'
      },
      success: function (response) {
        if (typeof response.results !== 'undefined' && typeof response.results[0] !== 'undefined') {
          var position = response.results[0].geometry.location;
          position.id  = adress.id;
          // console.log("getGeocodingCoordinates result",position,adress);
          o.positions.push(position);
          if ((o.positions.length + o.failedPositions) === _adresses.length) {
            // console.log("getGeocodingCoordinates startMap", o.positions);
            _this.startMap();
          }
        }
      },
      error:   function (jqxhr, settings, thrownError) {
        // console.log('getGeocodingCoordinates error', jqxhr, settings, thrownError);
        o.failedPositions = o.failedPositions + 1;
        if ((o.positions.length + o.failedPositions) === _adresses.length) {
          // console.log("getGeocodingCoordinates startMap", o.positions);
          _this.startMap();
        }
      }
    });
  };

  _this.centerOn = function (id) {
    // console.log('centerOn', id, o.map);
    o.id = id;
    var pos;
    for (var index = 0; index < o.positions.length; ++index) {
      if (o.positions[index].id === o.id) {
        pos = o.positions[index];
      }
    }
    // console.log('centerOn pos',pos);
    if (typeof o.map !== 'undefined' && typeof pos !== 'undefined') {
      // console.log('centerOn Goahead', o.map, pos);
      o.map.setCenter(pos);
    }
  };

  _this.startMap = function () {
    if (window.google) {
      // console.log("Window.google exists");
      _this.initMap();
    }
    else {
      _this.getMaps();
    }
  };

  /** Load Google Maps script **/
  _this.getMaps = function () {
    $.getScript("https://maps.googleapis.com/maps/api/js?key=" + o.APIkey)
     .done(function (script, textStatus) {
       // console.log("getMaps done", textStatus);
       _this.initMap();
     })
     .fail(function (jqxhr, settings, exeption) {
       // console.log('getMaps fail', jqxhr, settings, exeption);
     });
  };

  /** Show google map **/
  _this.initMap = function () {
    var mapDiv        = _elem[0];
    var pos=o.position;
    for (var ind = 0; ind < o.positions.length; ++ind) {
      if (o.positions[ind].id === o.id) {
        pos = o.positions[ind];
      }
    }

    var styledMapType = new google.maps.StyledMapType(_this.stylesArray, {name: 'Green Fortune'});
    o.map             = new google.maps.Map(mapDiv, {
      center:               pos,
      zoom:                  11,
      mapTypeControlOptions: {
        mapTypeIds: ['styled_map', 'roadmap']
      }
    });

    // Associate the styled map with the MapTypeId and set it to display
    o.map.mapTypes.set('styled_map', styledMapType);
    o.map.setMapTypeId('styled_map');

    for (var index = 0; index < o.positions.length; ++index) {
      _this.setMarker(o.positions[index]);
    }
  };

  /** Set marker position **/
  _this.setMarker = function (position) {
    o.marker = new google.maps.Marker({
      position: position,
      map:      o.map,
      icon:     '/svg/marker.svg'
    });
  };

  /** JSON map styling (made with styling wizard) **/
  _this.stylesArray = [
    {
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#f5f5f5"
        }
      ]
    },
    {
      "elementType": "labels.icon",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#616161"
        }
      ]
    },
    {
      "elementType": "labels.text.stroke",
      "stylers":     [
        {
          "color": "#f5f5f5"
        }
      ]
    },
    {
      "featureType": "administrative.land_parcel",
      "elementType": "labels",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "administrative.land_parcel",
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#bdbdbd"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#eeeeee"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "labels.text",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#757575"
        }
      ]
    },
    {
      "featureType": "poi.business",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "poi.park",
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#e5e5e5"
        }
      ]
    },
    {
      "featureType": "poi.park",
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#9e9e9e"
        }
      ]
    },
    {
      "featureType": "road",
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#ffffff"
        }
      ]
    },
    {
      "featureType": "road",
      "elementType": "labels.icon",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.arterial",
      "elementType": "labels",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.arterial",
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#757575"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#dadada"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "labels",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#616161"
        }
      ]
    },
    {
      "featureType": "road.local",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.local",
      "elementType": "labels",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.local",
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#9e9e9e"
        }
      ]
    },
    {
      "featureType": "transit",
      "stylers":     [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "transit.line",
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#e5e5e5"
        }
      ]
    },
    {
      "featureType": "transit.station",
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#eeeeee"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "geometry",
      "stylers":     [
        {
          "color": "#c9c9c9"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "labels.text.fill",
      "stylers":     [
        {
          "color": "#9e9e9e"
        }
      ]
    }
  ];

  _this.init();

  return {
    'destroy': function () {
      _this.destroy();
    }
  };
};
$.fn.dropdownMenu = function (options) {
  'use strict';
  /* global currentUrls */

  var _elem = $(this),  // instance to $('#selector')
      _this = this;     // instance to this plugin

  // custom variables
  var o = $.extend({
    group:         _elem.find('.dropdown__group'),
    label:         _elem.find('.dropdown__group__label'),
    menu:          _elem.find('.dropdown__group__menu'),
    content:       _elem.find('.dropdown__content__option'),
    selected:      _elem.find('.dropdown__group__menu__option--selected'),
    allOptions:    undefined,
    selectOptions: undefined,
    currOption:    undefined,
    updateMap:     false,
    map:           undefined
  }, options);


  _this.init = function () {
    // console.log('Initialize dropDownMenu plugin');

    if (_elem.hasClass('initialized')) {
      return false;
    }

    // select input options of current dropdown
    o.allOptions    = $('.dropdown__group__menu__option', o.menu);
    o.selectOptions = $('select option', _elem);

    _this.addDropdownEventListeners();

    o.currOption = o.selected.length ? o.selected : o.menu.find('div').first();
    _this.updateView(false);

    _elem.addClass('initialized');
  };

  _this.destroy = function () {
    // console.log('destroy plugin');
    _elem.removeClass('initialized');
  };

  /**
   * Open/close toggle
   */
  _this.closeMenu = function () {
    o.label.removeClass('openLabel');
    o.menu.removeClass('openMenu');
    o.group.removeClass('openGroup');

    $('body').unbind('click');
  };

  _this.openMenu = function () {
    o.label.addClass('openLabel');
    o.menu.addClass('openMenu');
    o.group.addClass('openGroup');

    $('body').on('click', function (e) {
      e.stopPropagation();
      _this.closeMenu();
    });
  };

  _this.menuToggle = function () {
    if (o.label.hasClass('openLabel')) {
      _this.closeMenu();
    }
    else {
      _this.openMenu();
    }
  };

  _this.selectOption = function (e) {
    o.currOption = $(this);
    _this.updateView(true);
  };

  _this.updateView = function (byUser) {
    if (!o.currOption) {
      return false;
    }
    var currOptionValue = o.currOption.data('value');
    var currOptionText  = o.currOption.text();
    var hiddenValue;
    // console.log('dropdown.updateView currOptionValue', currOptionValue);

    if (o.updateMap && typeof o.map !== 'undefined') {
      // console.log('dropdown.updatemap',o.map);
      o.map.centerOn(currOptionValue);
    }

    // add text to label
    o.label[0].innerHTML = currOptionText;
    o.allOptions.removeClass('dropdown__group__menu__option--selected');
    o.currOption.addClass('dropdown__group__menu__option--selected');

    // update selection in hidden select element
    // console.log('dropdown.updateView selectOptions', o.selectOptions);
    o.selectOptions.each(function () {
      var currItem = $(this);
      // console.log('dropdown.updateView selectOptions', this, currItem[0].value, currOptionValue, parseInt(currItem[0].value) === currOptionValue);
      if (parseInt(currItem[0].value) === currOptionValue) {
        currItem.attr('selected', true);
        hiddenValue = currItem.text();
      }
      else {
        currItem.removeAttr('selected');
      }
    });

    // update content to show
    // console.log('updateView content', o.content);
    o.content.each(function () {
      // console.log('updateView content', this);
      var currItem = $(this);
      if (currItem.data('value') === currOptionValue) {
        currItem.addClass('dropdown__content__option--show');
      }
      else {
        currItem.removeClass('dropdown__content__option--show');
      }
    });

    // console.log('dropdown.updateView hiddenValue', hiddenValue);
    // check if this has a form and update the hidden value
    var sendTo = _elem.find('.dropdown__group--sendto');
    // console.log('updateView sendTo', o.content, sendTo,typeof hiddenValue !== 'undefined');
    // console.log(sendTo);
    if (sendTo.length) {
      if (typeof hiddenValue !== 'undefined') {

        sendTo.val(hiddenValue);
      }
      else {
        sendTo.val(currOptionValue);
      }
    }

    if (_elem.data('type') === 'langChanger' && byUser) {
      var urls             = $('.site__content').data('urls');
      window.location.href = urls[currOptionValue];
    }
  };

  _this.addDropdownEventListeners = function () {
    o.label.on('click', function (e) {
      e.stopPropagation();
      _this.menuToggle();
    });

    o.allOptions.each(function () {
      $(this).on('click', _this.selectOption);
    });
  };

  _this.init();

  return {
    'destroy': function () {
      _this.destroy();
    }
  };
};
/* Studio Steen pluginTemplate.js - v0.0.1

  ----------------------------------------
  ----- Usage:
  ----------------------------------------
  $('#selector').pluginName();

  ----------------------------------------
  ----- With custom values:
  ----------------------------------------
  $('#selector').pluginName({
    customizableString: 'i changed it from the outside',
    customizableBoolean: false,
    onComplete: function(data) {
       ----------------------------------------
       ----- do your custom stuff here
       ----------------------------------------
       log(data) // if you want to get YEEEH!
    }
  });

  ----------------------------------------
  ----- If you want to call a function from outside:
  ----------------------------------------
  var plugin = $('#selector').pluginName();
  plugin.destroy();

*/
$.fn.filtermenu = function (options) {
  'use strict';

  var _elem = $(this),  // instance to $('#selector')
      _this = this;     // instance to this plugin


  // Make shuffle element
  var Shuffle         = window.Shuffle;
  var element         = $('.section--projects__items'); //container of items to filter
  var shuffleInstance = new Shuffle(element, {
    itemSelector: '.section--projects__item'
  });

  // custom variables
  var o = $.extend({
    onComplete:         undefined,
    activeFilterBtnDiv: $('.section--projects__filters__activefilters'),
    activeFilterText:   $('.section--projects__filters__activefilters__title'),
    filterGroups:       $('.filter-group'),
    filterLabel:        $('.filter-label'),
    filterCategories:   {},
    allFilters:         {}
  }, options);

  _this.init = function () {
    // console.log('init filtermenu');
    _elem.addClass('initialized');

    _this.getFilterCategories();
    _this.addInputEventListeners();
    _this.filterMenuToggle();
    //
    var projectFilters = store('projectFilters');
    if (projectFilters !== null) {
      $.each(projectFilters, function (filterName, filters) {
        $.each(filters, function (i, value) {
          var elm = $('.filter-group[data-value=\'' + filterName + '\'] input[value=\'' + value + '\']');
          if (elm.length > 0) {
            $(elm.get(0)).prop('checked', true);
            _this.updateFilterArrays(elm.get(0), filterName);
          }
        });
      });
    }
  };

  /**
   * Find out how many filter categories there are
   */
  _this.getFilterCategories = function () {
    o.filterGroups.each(function (item, element) {
      o.filterCategories[$(element).data('value')] = $(element);
      o.allFilters[$(element).data('value')]       = [];
    });
  };

  /**
   * Get all inputs from all filter categories
   */
  _this.addInputEventListeners = function () {
    $.each(o.filterCategories, function (filterName, element) {
      element.find('input').each(function (i, currElement) {
        console.log('input', filterName);

        /** add event listeners **/
        $(currElement).on('change', function () {
          console.log('addInputEventListeners', filterName);
          _this.updateFilterArrays(this, filterName);
          _this.closeMenu();
        });

      });
    });
  };

  /**
   * Active filter buttons
   */
  _this.addFilterButton = function (element) {
    var text         = $(element).parent().text();
    var value        = element.value;
    var doesBtnExist = o.activeFilterBtnDiv.contents().filter(function () {
      return $(this).text() === text;
    });
    if (doesBtnExist.length === 0) {
      o.activeFilterBtnDiv.append('<button class="h5" value="' + value + '"><img src="/svg/close-btn.svg" alt="close">' + text + '</button>');
    }

    /**
     * show text before filter buttons:
     */
    o.activeFilterText.addClass('active');

  };

  _this.removeFilterButton = function (element) {
    var text = $(element).parent().text();
    o.activeFilterBtnDiv.contents().filter(function () {
      if ($(this).closest('button').text() === text) {
        $(this).closest('button').remove();
      }
    });
  };

  _this.eventListenerFilterBtn = function () {
    $.each(o.activeFilterBtnDiv.find('button'), function (index, element) {
      $(element).on('click', function () {

        var value = $(this).attr('value');

        $.each(o.filterCategories, function (index, filterGroup) {
          console.log('eventListenerFilterBtn', filterGroup, index);
          filterGroup.find('input').each(function (i, currElement) {
            /** uncheck corresponding menu item **/
            if ($(currElement).attr('value') === value) {
              $(this).prop('checked', false);

              /** add/remove current value to filter **/
              _this.updateFilterArrays(this, index);
            }
          });

        });
        $(this).remove();

      });
    });
  };

  /**
   * Update filter arrays
   */
  _this.updateFilterArrays = function (element, currFilter) {
    console.log('updateFilterArrays', element, currFilter);
    if (element.checked) {
      // add to filter array
      o.allFilters[currFilter].push(element.value);

      //add active class to corresponding label
      element.parentElement.classList.add('active');

      _this.addFilterButton(element);

    }
    else {
      // remove from filter array
      var x = o.allFilters[currFilter].indexOf(element.value);
      if (x !== -1) {
        o.allFilters[currFilter].splice(x, 1);
      }

      //remove active class from corresponding label
      element.parentElement.classList.remove('active');

      _this.removeFilterButton(element);
    }

    /** update event listeners for buttons **/
    _this.eventListenerFilterBtn();

    /** update filtering **/
    _this.updateFilter();
  };

  /**
   * If any of the arrays in the `Filter.allFilters` property have a length of more than zero,
   * that means there is an active filter (return true)
   */
  _this.hasActiveFilters = function () {
    return Object.keys(o.allFilters).some(function (key) {
      return o.allFilters[key].length > 0;
    });
  };

  /**
   * Determine whether an element passes the current filters. Return true to keep element
   */
  _this.checkElementPassesFilter = function (element) {
    var check = true;

    $.each(o.allFilters, function (key, value) {
      if (check && value.length > 0) {

        var filterCategory  = o.filterCategories[key].data('value');
        var dataAttrContent = element.getAttribute('data-' + filterCategory).split(" ");
        // console.log("checking for", filterCategory, ":", value, "has:", dataAttrContent);

        // the data attribute for each filter can contain multiple items. Check if any of these match
        var numMatches = 0;
        for (var i = 0; i < dataAttrContent.length; i++) {
          if (value.indexOf(dataAttrContent[i]) > -1) {
            // has current filter!
            numMatches++;
          }
        }
        // if numMatches !== the amount of items we're looking for, element should not pass filter
        if (numMatches !== value.length) {
          check = false;
        }

      }
    });

    return check;
  };

  /**
   * Filter shuffle based on the current state of filters
   */
  _this.updateFilter = function () {
    console.log(o.allFilters);
    store('projectFilters', o.allFilters);
    shuffleInstance.filter(function (element) {
      if (_this.hasActiveFilters()) {
        return _this.checkElementPassesFilter(element);
      }
      else {
        /**
         * removetext before filter buttons:
         */
        o.activeFilterText.removeClass('active');

        return Shuffle.ALL_ITEMS;
      }
    });
  };

  /**
   * Open/close toggle
   */
  _this.closeMenu = function () {
    o.filterLabel.removeClass('openLabel');
    o.filterLabel.find('ul').removeClass('open');
    $('.projects__whiteOverlay').remove();
  };
  _this.openMenu = function (element) {
    var whiteOverlay = document.createElement('div');
    whiteOverlay.className += 'projects__whiteOverlay';
    element.find('ul').addClass('open');
    element.addClass('openLabel');
    if (!$('.projects__whiteOverlay').length) {
      $('.site__content').prepend(whiteOverlay);
    }
  };

  _this.filterMenuToggle = function () {
    o.filterLabel.on('click', function (e) {
      if ($(this).find('ul').hasClass('open') && (e.target.lastElementChild !== null && e.target.lastElementChild.className === 'open')) {
        _this.closeMenu();
        return;
      }
      _this.openMenu($(this));

    });

    $(document).on('click', '.projects__whiteOverlay', function () {
      _this.closeMenu();
    });

    /** Mobile toggle for filter menu **/
    $('.section--projects__filters__toggleMobileFilters').on('click', function () {
      $(this).toggleClass('active');
      $('.section--projects__filters__menu').toggle();
    });

  };


  _this.destroy = function () {
    console.log('destroy plugin');
    _elem.removeClass('initialized');
  };

  _this.init();

  return {
    'destroy': function () {
      _this.destroy();
    }
  };
};

$.fn.isInViewport = function () {
  'use strict';

  var elementTop    = $(this).offset().top;
  var elementBottom = elementTop + $(this).outerHeight();

  var viewportTop    = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();

  return elementBottom > viewportTop && elementTop < viewportBottom;
};
function isMobile() {
  'use strict';
  var m = {
    Android:    function () {
      return !!navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
      return !!navigator.userAgent.match(/BlackBerry/i);
    },
    iOS:        function () {
      return !!navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Windows:    function () {
      return !!navigator.userAgent.match(/IEMobile/i);
    },
    any:        function () {
      return (m.Android() || m.BlackBerry() || m.iOS() || m.Windows());
    }
  };

  return m.any();
}
/* Studio Steen pluginTemplate.js - v0.0.1

  ----------------------------------------
  ----- Usage:
  ----------------------------------------
  $('#selector').pluginName();

  ----------------------------------------
  ----- With custom values:
  ----------------------------------------
  $('#selector').pluginName({
    customizableString: 'i changed it from the outside',
    customizableBoolean: false,
    onComplete: function(data) {
       ----------------------------------------
       ----- do your custom stuff here
       ----------------------------------------
       log(data) // if you want to get YEEEH!
    }
  });

  ----------------------------------------
  ----- If you want to call a function from outside:
  ----------------------------------------
  var plugin = $('#selector').pluginName();
  plugin.destroy();

*/
$.fn.navigation = function (options) {
  'use strict';

  var _elem = $(this),  // instance to $('#selector')
      _this = this;     // instance to this plugin

  // custom variables
  var tl, subTL;

  var o = $.extend({
    navBar:   $('.nav-bar'),
    navWrap:  $('.nav-wrap'),
    openBtn:  $('.nav-bar__hamburger'),
    closeBtn: $('.nav-wrap__close-icon'),
    onOpen:   undefined,
    onClose:  undefined
  }, options);


  _this.init = function () {
    _elem.addClass('nav-initialized');

    o.navWrap.find('.nav__li').each(function (index, link) {
      var obj      = $(link);
      var openBtn  = obj.find('.nav__a');
      var closeBtn = obj.find('.nav__sub-ul__a--back');
      var subNav   = obj.find('.nav__sub-ul');

      if (subNav.length) {
        openBtn.on('click', function () {
          _this.openSubnav(subNav);
        });
        closeBtn.on('click', function () {
          _this.closeSubnav(subNav);
        });
      }
    });

    o.openBtn.click(_this.openNav);
    o.closeBtn.click(_this.closeNav);
  };

  _this.openSubnav = function (nav) {
    subTL = new TimelineMax();
    subTL.set(nav, {className: '+=active'});
    subTL.set(nav.closest('.nav__li').find('.nav__a'), {className: '+=hover'});
    subTL.to(nav, 0.3, {display: 'block', opacity: 1});
  };

  _this.closeSubnav = function (nav) {
    if (!nav) {
      if ($('.nav__sub-ul.active').length) {
        nav = $('.nav__sub-ul.active');
      }
      else {
        return false;
      }
    }
    subTL = new TimelineMax();
    subTL.set(nav.closest('.nav__li').find('.nav__a'), {className: '-=hover'});
    subTL.to(nav, 0.3, {opacity: 0});
    subTL.set(nav, {clearProps: 'all', className: '-=active'});
  };

  _this.openNav = function () {
    console.log('openNav');
    tl = new TimelineMax();
    tl.set(o.navBar, {className: '+=nav-bar--hide'});
    tl.set(o.navWrap, {display: 'block'});
    tl.to(o.navWrap, 0.5, {force3D: true, x: '0%', ease: Power3.easeInOut});
    tl.add(function () {
      if (typeof (o.onOpen) === 'function') {
        o.onOpen(true);
      }
    });
  };

  _this.closeNav = function () {
    console.log('closeNav');
    tl = new TimelineMax();
    tl.set(o.navBar, {className: '-=nav-bar--hide'});
    tl.to(o.navWrap, 0.5, {force3D: true, x: '100%', ease: Power3.easeInOut});
    tl.set([o.navBar, o.navWrap], {clearProps: 'all'});
    tl.add(function () {
      if (typeof (o.onClose) === 'function') {
        o.onClose(true);
      }
    });
  };

  _this.destroy = function () {
    _elem.removeClass('nav-initialized');
  };

  if (_elem.data('plugin') === undefined) {
    _elem.data('plugin', _this);
    _this.init();
  }

};
$(function () {
  'use strict';
  /* global $, TweenLite, TweenMax, TimelineMax, Power0, ScrollMagic, console, Barba, Promise, SplitText, isMobile, lightGallery */

  var _this = this,
      _win  = $(window),
      _body = $('body');

  var _curScroll       = _win.scrollTop();
  var _touchY          = 0;
  var _touchEndY       = 0;
  var _touchX          = 0;
  var _touchEndX       = 0;
  var _canScroll       = true;
  var _stickyScrolling = false;
  var _scrollingDown   = true;
  var _projectData     = null;
  var _scrollTimer;

  var _hoverClasses = ['carousel__item', 'section--projects__item', 'section--text__list__item', 'section--solutions__item', 'section--img-wall__item'];

  var _scrollMagic;
  var _photoSwipe;

  var _map = $('#map');

  /* ===================
      initialize site, only called once
     =================== */
  _this.init = function () {
    _win.scroll(_this.onScroll).scroll();
    _this.setupHoverEvents();
    _this.setupBarba();
    _body.navigation();
    _this.setupContactform();
    _this.setupCallback();

    // everything is loaded!
    _body.addClass('loaded');
    _this.newPageLoad();

    var tl = new TimelineMax();
    tl.set('.page-switch__shape--top', {force3D: true, y: '-100%', ease: Power2.easeInOut});
    tl.set('.page-switch__shape--bottom', {force3D: true, y: '100%', ease: Power2.easeInOut});
    tl.to('.preloader', 0.7, {autoAlpha: 0, ease: Power2.easeInOut}, '+=4.5');
    tl.from('.nav-bar', 0.5, {force3D: true, y: '-100', ease: Power1.easeInOut}, '-=0.4');
    objectFitImages();
  };

  _this.setupHoverEvents = function () {
    _body.on('mouseenter', 'a', function () {
      var t = $(this);
      _hoverClasses.forEach(function (cl, i) {
        if (t.hasClass(cl)) {
          TweenMax.set('.' + cl, {className: '+=inactive'});
          TweenMax.set(t, {className: '-=inactive'});
        }
      });
      if (t.find('.btn').length) {
        t.find('.btn').addClass('hover');
      }
    }).on('mouseleave', 'a', function () {
      var t = $(this);
      _hoverClasses.forEach(function (cl, i) {
        if (t.hasClass(cl)) {
          TweenMax.set('.' + cl, {className: '-=inactive'});
        }
      });
      if ($(this).find('.btn').length) {
        $(this).find('.btn').removeClass('hover');
      }
    });
  };

  /* ===================
      Barba plugin for PJAX pageload
     =================== */
  _this.setupBarba = function () {
    var clickedElement = null;

    var fadeTransition = Barba.BaseTransition.extend({
      start:      function () {
        // console.log('Barba.fadeTransition.start');
        this.clickedElement = clickedElement;
        _canScroll          = false;
        Promise
          .all([this.newContainerLoading, this.animateOut()])
          .then(this.animateIn.bind(this));
      },
      animateOut: function () {
        var def = Barba.Utils.deferred();
        var tl  = new TimelineMax();
        tl.to($(this.oldContainer), 0.35, {opacity: 0});
        tl.add(function () {
          def.resolve();
        });
        return def.promise;
      },
      animateIn:  function () {
        var t  = this;
        var tl = new TimelineMax();
        tl.add(function () {
          t.done();
          _this.newPageLoad();
        });
        tl.set(_win, {scrollTo: 0});
        tl.from($(this.newContainer), 0.5, {opacity: 0});
      }
    });

    var detailNavTransition = Barba.BaseTransition.extend({
      start:      function () {
        this.clickedElement = clickedElement;
        this.parameter      = $(clickedElement).data('parameter');
        _canScroll          = false;
        Promise
          .all([this.newContainerLoading, this.animateOut()])
          .then(this.animateIn.bind(this));
      },
      animateOut: function () {
        var def = Barba.Utils.deferred();
        var tl  = new TimelineMax();
        // console.log('parameter = ', this.parameter);
        tl.to($(this.oldContainer), 0.25, {
          opacity: 0,
          x:       (this.parameter === 'prev' ? '10%' : '-10%'),
          ease:    Power1.easeIn
        });
        tl.add(function () {
          def.resolve();
        });
        return def.promise;
      },
      animateIn:  function () {
        var t  = this;
        var tl = new TimelineMax();
        tl.add(function () {
          t.done();
          _this.newPageLoad();
        });
        tl.set(_win, {scrollTo: 0});
        tl.from($(this.newContainer), 0.25, {
          opacity: 0,
          x:       (this.parameter === 'prev' ? '-10%' : '10%'),
          ease:    Power1.easeOut
        });
      }
    });

    var shapeTransition = Barba.BaseTransition.extend({
      start:      function () {
        // console.log('Barba.shapeTransition.start');
        this.clickedElement = clickedElement;
        _canScroll          = false;
        Promise
          .all([this.newContainerLoading, this.animateOut()])
          .then(this.animateIn.bind(this));
      },
      animateOut: function () {
        var def = Barba.Utils.deferred();
        var tl  = new TimelineMax();
        tl.to('.page-switch__shape--top', 0.5, {force3D: true, y: '0%', ease: Power3.easeInOut});
        tl.to('.page-switch__shape--bottom', 0.5, {force3D: true, y: '0%', ease: Power3.easeInOut}, '-=0.5');
        tl.add(function () {
          def.resolve();
        });
        return def.promise;
      },
      animateIn:  function () {
        var t  = this;
        var tl = new TimelineMax();
        tl.add(function () {
          t.done();
          _this.newPageLoad();
        });
        tl.set(_win, {scrollTo: 0});
        tl.to('.page-switch__shape--top', 0.5, {force3D: true, y: '-100%', ease: Power3.easeIn});
        tl.to('.page-switch__shape--bottom', 0.5, {force3D: true, y: '100%', ease: Power3.easeIn}, '-=0.5');
      }
    });

    var fsimgTransition = Barba.BaseTransition.extend({
      start: function () {
        // console.log('Barba.fsimgTransition.start');
        this.clickedElement = clickedElement;

        Promise
          .all([this.newContainerLoading, this.animateOut()])
          .then(this.animateIn.bind(this));
      },

      animateOut: function () {
        // console.log('Barba.fsimgTransition.animateOut', clickedElement);
        var def    = Barba.Utils.deferred();
        var tl     = new TimelineMax();
        var img    = $(this.clickedElement).find('figure');
        var cloned = img.clone();
        cloned.appendTo(this.oldContainer);

        tl.set(cloned, {
          position: 'absolute',
          top:      img.offset().top,
          left:     img.offset().left,
          width:    img.width(),
          height:   img.height(),
          margin:   0
        });
        tl.to(cloned, 0.7, {
          top:    _win.scrollTop(),
          left:   0,
          width:  '100%',
          height: '100vh',
          ease:   Power3.easeInOut
        });
        tl.set(cloned, {position: 'fixed', top: 0});
        tl.set(_win, {scrollTo: 0});
        tl.add(function () {
          def.resolve();
        });
        return def.promise;
      },

      animateIn: function () {
        // console.log('Barba.fsimgTransition.animateIn');
        this.done();
        _this.newPageLoad();
      }
    });

    var hsimgTransition = Barba.BaseTransition.extend({
      start: function () {
        // console.log('Barba.hsimgTransition.start');
        this.clickedElement = clickedElement;

        Promise
          .all([this.newContainerLoading, this.animateOut()])
          .then(this.animateIn.bind(this));
      },

      animateOut: function () {
        // console.log('Barba.hsimgTransition.animateOut', clickedElement);
        var def    = Barba.Utils.deferred();
        var tl     = new TimelineMax();
        var img    = $(this.clickedElement).find('figure');
        var cloned = img.clone();
        cloned.appendTo(this.oldContainer);

        tl.set(cloned, {
          position: 'absolute',
          top:      img.offset().top,
          left:     img.offset().left,
          width:    img.width(),
          height:   img.height(),
          margin:   0
        });
        tl.to(cloned, 0.7, {
          top:    _win.scrollTop(),
          left:   0,
          width:  '100%',
          height: '60vh',
          ease:   Power3.easeInOut
        });
        tl.to(img.closest('.site__content').find('.section'), 0.5, {opacity: 0}, '-=0.7');
        tl.set(cloned, {position: 'fixed', top: 0});
        tl.set(_win, {scrollTo: 0});
        tl.add(function () {
          def.resolve();
        });
        return def.promise;
      },

      animateIn: function () {
        // console.log('Barba.hsimgTransition.animateIn');
        this.done();
        _this.newPageLoad();
      }
    });

    // Barba settings
    Barba.Pjax.getTransition = function () {
      var transition = fadeTransition;
      switch ($(clickedElement).data('transition')) {
        case 'project':
          transition = hsimgTransition;
          break;
        case 'blog':
          transition = hsimgTransition;
          break;
        case 'detailNav':
          transition = detailNavTransition;
          break;
        default:
          transition = shapeTransition;
      }

      return transition;
    };

    Barba.Dispatcher.on('linkClicked', function (e) {
      clickedElement = e;
      _canScroll     = false;
      _body.data('plugin').closeNav();
      _body.data('plugin').closeSubnav();
    });

    Barba.Dispatcher.on('newPageReady', function () {
      clickedElement = null;
      _canScroll     = true;

    });
    Barba.Pjax.Dom.wrapperId      = 'site';
    Barba.Pjax.Dom.containerClass = 'site__content';
    Barba.Pjax.cacheEnabled       = false;
    Barba.Pjax.start();
    Barba.Prefetch.init();
  };


  /* ===================
      newPageLoad, called after every pageload
     =================== */
  _this.newPageLoad = function () {
    var pageType = $('.site__content').data('type');
    // console.log('_this.newPageLoad', pageType);

    // destroy plugins
    if ($('.slick-initialized').length) {
      $('.slick-initialized').slick('unslick').removeClass('slick-initialized slick-slider');
    }
    if (_scrollMagic) {
      _scrollMagic.destroy();
      _scrollMagic = null;
    }

    if ($('.section--img-wall__photos').length) {
      $('.section--img-wall__photos').lightGallery({
        download:  false,
        counter:   false,
        cssEasing: 'cubic-bezier(0.25, 0, 0.25, 1)'
      });
    }

    // init plugins
    _this.initSlick();
    _this.initScrollMagic();
    if ($('.section--projects__filters').length) {
      $('.section--projects__filters').filtermenu();
    }

    // animate stuff
    var tl  = new TimelineMax();
    var arr = [];
    if ($('.section--fsimg').length) {
      arr = [
        '.section--fsimg__title',
        '.section--fsimg__subtitle',
        '.section--fsimg__btn'
      ];
    }
    else if ($('.section--hsimg').length) {
      arr = [
        '.section--hsimg__title',
        '.section--hsimg__subtitle',
        '.section--hsimg__btn'
      ];
    }
    tl.staggerFrom(arr, 0.5, {
      force3D: true,
      y:       40,
      opacity: 0,
      ease:    Power1.easeOut,
      // clearProps: 'all'
    }, 0.15, '+=0.25');

    if ($('#map').length) {
      _map = $('#map');
      _map.customMap();
    }

    // Dropdown menu
    if ($('.dropdown').length >= 1) {
      $('.dropdown').each(function () {
        $(this).dropdownMenu({updateMap: $(this).hasClass('dropdown--maps'), map: _map});
      });
    }
    // console.log(pageType);
    if (pageType === 'project.item') {
      // console.log('pageType.project.item', _projectData, projectFilters);
      if (_projectData === null) {
        // console.log('pageType.project.item _projectData start load');
        $.ajax({
          dataType: 'json',
          url:      '/project-data',
          success:  function (data) {
            // console.log('pageType.project.item _projectData loaded', data);
            _projectData = data;
            _this.updateProjectNav();
          }
        });
      }
      else {
        _this.updateProjectNav();
      }
    }
    if (pageType === 'home') {
      // $('.site__content[data-type=\'home\'] a[data-transition=\'project\']').on('click', function (project) {
        store.remove('projectFilters');
      // });
    }
    if (pageType === 'solution.item') {
      $('.site__content[data-type=\'solution.item\'] a[data-transition=\'project\']').on('click', function (project) {
        store('projectFilters', {'solution': [$('.site__content').data('slug')]});
      });
    }
  };

  _this.updateProjectNav = function () {
    $('.detail-nav__btn--next').removeClass('detail-nav__btn--show');
    $('.detail-nav__btn--prev').removeClass('detail-nav__btn--show');
    var currentSlug = $('.site__content').data('slug');
    if (currentSlug !== null && currentSlug !== 'null') {
      var currentProject = _projectData.find(function (project) {
        return project.slug === currentSlug;
      });
      if (typeof currentProject !== 'undefined') {
        var projectFilters   = store('projectFilters');
        // console.log('updateProjectNav currentSlug', currentSlug, currentProject,projectFilters);
        var selectedProjects = _projectData.filter(function (project) {
          return _this.projectFilter(project, projectFilters);
        });
        // console.log('updateProjectNav selectedProjects', selectedProjects);
        var nextProject      = selectedProjects.find(function (project) {
          return project.order > currentProject.order;
        });
        // console.log('updateProjectNav nextProject', nextProject);
        if (typeof nextProject !== 'undefined') {
          $('.detail-nav__btn--next').text(nextProject.title);
          $('.detail-nav__btn--next').attr('href', nextProject.url);
          $('.detail-nav__btn--next').addClass('detail-nav__btn--show');
        }
        var prevProject = selectedProjects.reverse().find(function (project) {
          return project.order < currentProject.order;
        });
        // console.log('updateProjectNav prevProject', prevProject);
        if (typeof prevProject !== 'undefined') {
          $('.detail-nav__btn--prev').text(prevProject.title);
          $('.detail-nav__btn--prev').attr('href', prevProject.url);
          $('.detail-nav__btn--prev').addClass('detail-nav__btn--show');
        }
      }
    }
  };
  _this.projectFilter    = function (project, filters) {
    var check = true;

    $.each(filters, function (key, value) {
      if (check && value.length > 0) {
        var dataAttrContent = project[key];
        var numMatches      = 0;
        for (var i = 0; i < dataAttrContent.length; i++) {
          if (value.indexOf(dataAttrContent[i]) > -1) {
            numMatches++;
          }
        }
        if (numMatches !== value.length) {
          check = false;
        }
      }
    });

    return check;
  };
  /* ===================
      initSlick
     =================== */
  _this.initSlick = function () {
    // console.log('_this.initSlick', $('.carousel').length);
    $('.carousel').slick({
      infinite:       false,
      dots:           true,
      arrows:         false,
      slidesToShow:   5,
      slidesToScroll: 5,
      responsive:     [
        {
          breakpoint: 1400,
          settings:   {
            slidesToShow:   4,
            slidesToScroll: 4
          }
        },
        {
          breakpoint: 1200,
          settings:   {
            slidesToShow:   3,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 750,
          settings:   {
            slidesToShow:   2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 580,
          settings:   {
            slidesToShow:   1.5,
            slidesToScroll: 1
          }
        }
      ]
    });
  };


  /* ===================
      initScrollMagic
     =================== */
  _this.initScrollMagic = function () {
    // console.log('_this.initScrollMagic', $('.section').length);
    _scrollMagic = new ScrollMagic.Controller();

    $('.section').each(function (i, section) {
      var el = $(section);
      var tl;

      if (el.hasClass('section--fsimg') || el.hasClass('section--hsimg')) {
        var c = el.hasClass('section--fsimg') ? '.section--fsimg' : '.section--hsimg';
        tl    = new TimelineMax();
        tl.to(el.find(c + '__inner'), 1, {opacity: 0.3, ease: Power0.easeNone});
        tl.to(el.find(c + '__content'), 1, {
          y:       _win.height() / (el.hasClass('section--fsimg') ? 3 : 5),
          scale:   0.75,
          opacity: 0.3,
          ease:    Power0.easeNone
        }, '-=1');
        new ScrollMagic.Scene({
          triggerElement: section,
          triggerHook:    0,
          duration:       el.hasClass('section--fsimg') ? 1000 : 750
        }).setTween(tl).addTo(_scrollMagic);
      }
      else if (el.hasClass('section--quote')) {
        var split = new SplitText(el.find('.section--quote__title'), {type: 'words'});
        tl        = new TimelineMax();
        tl.staggerFrom(split.words, 0.5, {force3D: true, y: 25, opacity: 0, ease: Power1.easeOut}, 0.1);
        new ScrollMagic.Scene({
          triggerElement: section,
          triggerHook:    0.7
        }).setTween(tl).addTo(_scrollMagic);
      }
      else if (el.hasClass('section--carousel')) {
        tl = new TimelineMax();
        tl.staggerFrom(el.find('.section--carousel__title, .section--carousel__text, .carousel__item'), 0.5, {
          force3D: true,
          y:       25,
          opacity: 0,
          // clearProps: 'all',
          ease:    Power1.easeOut
        }, 0.1);
        new ScrollMagic.Scene({
          triggerElement: section,
          triggerHook:    0.7
        }).setTween(tl).addTo(_scrollMagic);
      }
      else if (el.hasClass('section--projects')) {
        // nothing
      }
      else if (el.hasClass('section--footer')) {
        // nothing
      }
      else {
        el.find('h1, h2, h3, h4, h5, img, p, .btn, .table tr, ul li').each(function (i, obj) {
          tl = new TimelineMax();
          tl.from(obj, 0.5, {
            force3D: true,
            y:       25,
            opacity: 0,
            // clearProps: 'all',
            ease:    Power1.easeOut
          });
          new ScrollMagic.Scene({
            triggerElement: obj,
            triggerHook:    0.9
          }).setTween(tl).addTo(_scrollMagic);
        });
      }
    });
  };


  /* ===================
    onScroll
   =================== */

  _this.onScroll = function (e) {
    if (isMobile()) {
      // console.log(e.type);
      if (e.type === 'touchstart') {
        _touchY = e.originalEvent.touches[0].clientY;
        _touchX = e.originalEvent.touches[0].clientX;
      }
      if (e.type === 'touchmove') {
        _touchEndY     = e.originalEvent.touches[0].clientY;
        _touchEndX     = e.originalEvent.touches[0].clientX;
        _scrollingDown = (_touchY > _touchEndY);
      }
      if (e.type === 'touchend') {
      }
    }
    else {
      var st         = _win.scrollTop();
      _scrollingDown = (st === _curScroll) ? _scrollingDown : (st > _curScroll);
      if (_stickyScrolling || st <= 0) {
        return false;
      }

      window.clearTimeout(_scrollTimer);
      _scrollTimer = window.setTimeout(_this.checkSnap, 10);
      _curScroll   = st;
      TweenMax.set('.nav-bar', {className: (_scrollingDown ? '+=' : '-=') + 'nav-bar--hide'});

    }
  };

  _this.checkSnap = function () {
    var inView   = [];
    var fsInView = [];

    $('.section').each(function () {
      if ($(this).isInViewport()) {
        inView.push($(this));
        if ($(this).hasClass('section--fsimg')) {
          fsInView.push($(this));
        }
      }
    });

    if (fsInView.length) {
      var pos, section;
      if (_scrollingDown) {
        if (fsInView[1]) {
          section = fsInView[1];
        }
        else if (inView[1] && !inView[1].hasClass('section--fsimg')) {
          section = inView[1];
        }
      }
      else {
        if (fsInView.length === 1) {
          section = fsInView[0];
        }
        else if (fsInView[1]) {
          section = fsInView[0];
        }
        else if (inView[0].hasClass('section--fsimg')) {
          if ((inView[0].offset().top + _win.scrollTop()) - (_win.scrollTop() / 4) > _curScroll) {
            section = fsInView[0];
          }
        }
      }

      if (section) {
        pos = section.offset().top;
        // _stickyScrolling = true;

        // TweenMax.to(_win, (0.6), {
        //   scrollTo:   {force3D: true, y: pos, autoKill: false},
        //   ease:       Power1.easeInOut,
        //   onUpdate:   function () {
        //     _curScroll = _win.scrollTop();
        //   },
        //   onComplete: function () {
        //     _stickyScrolling = false;
        //     // console.log('onComplete');
        //   }
        // });
      }
    }
  };

  _this.setupContactform = function () {
    var formDOM = $('.form__contact');

    $.each(formDOM, function (index, form) {
      // console.log('setupContactform.submit each', index, form);
      $(form).on('submit', function (e) {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $(form).find('.form__result').removeClass('form__result--show');
        // console.log('setupContactform.submit', index, form, $('meta[name="csrf-token"]').attr('content'));

        var fields = [
              'name',
              'email',
              'phone',
              'message',
              'sendTo'
            ],
            data   = {type: 'contact', client: 'yKnDmCJw9zjZB1zoqGVzN6377Byhut'};

        // filter data
        $.each($(form).serializeArray(), function (index, field) {
            if (field.name !== null && field.value !== null) {
              if (field.name === 'sendTo') {
                data[field.name] = parseInt(field.value) ? parseInt(field.value) : 0;
                return;
              }
              if ($.trim(field.value) !== '') {
                data[field.name] = field.value;
              }
            }
          }
        );

        // console.log('setupContactform.submit data', data);

        // validate
        var formValid = true;
        $.each(fields, function (index, name) {
          var valid = true;
          if (typeof data[name] === 'undefined') {
            valid = false;
          }
          if (valid === false) {
            formValid = false;
            $(form).find('[name="' + name + '"]').addClass('form__field--error');
          }
        });

        // //send ajax
        if (formValid === true) {
          // console.log('setupContactform.submit formValid');
          $(form).find('.form__result--loading').addClass('form__result--show');
          $(form).find('.form__fields').addClass('form__fields--hide');
          $.ajax({
            url:      CONTACT_URL,
            type:     'POST',
            dataType: 'json',
            async:    true,
            data:     data,
            success:  function (data, textStatus, jqXHR) {
              // console.log('success', data, textStatus, jqXHR);
              $(form).find('.form__result').removeClass('form__result--show');
              $(form).find('.form__result--success').addClass('form__result--show');
            },
            error:    function (jqXHR, textStatus, errorThrown) {
              // console.log('error', jqXHR, textStatus, errorThrown, typeof jqXHR.responseJSON !== 'undefined');
              $(form).find('.form__result').removeClass('form__result--show');
              if (typeof jqXHR.responseJSON !== 'undefined') {
                // console.log('error jqXHR.responseJSON', jqXHR.responseJSON);
                $(form).find('.form__result--error-message').addClass('form__result--show');
                var errorlist = '<ul>';
                $.each(jqXHR.responseJSON.errors, function (name, message) {
                  errorlist = errorlist + '<li>' + message + '</li>';
                });
                errorlist = errorlist + '</ul>';
                $(form).find('.form__result__error-message').html($(errorlist));
              }
              else {
                $(form).find('.form__result--error').addClass('form__result--show');
              }
              $(form).find('.form__fields').removeClass('form__fields--hide');
            }
          });
        }
        else {
          TweenMax.delayedCall(1, function () {
            $(form).find('.form__field--error').removeClass('form__field--error');
          });
        }

      });
    });
  }; //end contact form


  _this.setupCallback = function () {
    var formDOM = $('.form__callback');

    $.each(formDOM, function (index, form) {
      // console.log('setupCallback.submit each', index, form);
      $(form).on('submit', function (e) {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $(form).find('.form__result').removeClass('form__result--show');
        // console.log('setupCallback.submit', index, form, $('meta[name="csrf-token"]').attr('content'));

        var fields = [
              'name',
              'phone',
              'sendTo'
            ],
            data   = {type: 'callback', client: 'yKnDmCJw9zjZB1zoqGVzN6377Byhut'};

        // filter data
        $.each($(form).serializeArray(), function (index, field) {
            if (field.name !== null && field.value !== null) {
              if (field.name === 'sendTo') {
                data[field.name] = parseInt(field.value) ? parseInt(field.value) : 0;
                return;
              }
              if ($.trim(field.value) !== '') {
                data[field.name] = field.value;
              }
            }
          }
        );

        // console.log('setupCallback.submit data', data);

        // validate
        var formValid = true;
        $.each(fields, function (index, name) {
          var valid = true;
          if (typeof data[name] === 'undefined') {
            valid = false;
          }
          if (valid === false) {
            formValid = false;
            $(form).find('[name="' + name + '"]').addClass('form__field--error');
          }
        });

        // //send ajax
        if (formValid === true) {
          // console.log('setupCallback.submit formValid');
          $(form).find('.form__result--loading').addClass('form__result--show');
          $(form).find('.form__fields').addClass('form__fields--hide');
          $.ajax({
            url:      CONTACT_URL,
            type:     'POST',
            dataType: 'json',
            async:    true,
            data:     data,
            success:  function (data, textStatus, jqXHR) {
              // console.log('success', data, textStatus, jqXHR);
              $(form).find('.form__result').removeClass('form__result--show');
              $(form).find('.form__result--success').addClass('form__result--show');
            },
            error:    function (jqXHR, textStatus, errorThrown) {
              // console.log('error', jqXHR, textStatus, errorThrown, typeof jqXHR.responseJSON !== 'undefined');
              $(form).find('.form__result').removeClass('form__result--show');
              if (typeof jqXHR.responseJSON !== 'undefined') {
                // console.log('error jqXHR.responseJSON', jqXHR.responseJSON);
                $(form).find('.form__result--error-message').addClass('form__result--show');
                var errorlist = '<ul>';
                $.each(jqXHR.responseJSON.errors, function (name, message) {
                  errorlist = errorlist + '<li>' + message + '</li>';
                });
                errorlist = errorlist + '</ul>';
                $(form).find('.form__result__error-message').html($(errorlist));
              }
              else {
                $(form).find('.form__result--error').addClass('form__result--show');
              }
              $(form).find('.form__fields').removeClass('form__fields--hide');
            }
          });
        }
        else {
          // console.log('setupCallback.submit formValid FALSE');
          TweenMax.delayedCall(1, function () {
            $(form).find('.form__field--error').removeClass('form__field--error');
          });
        }

      });
    });
  }; //end contact form

  /* ===================
     Call the init for awesomeness
     =================== */

  _this.init();

});
