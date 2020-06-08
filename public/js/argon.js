/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/argon.js":
/*!*******************************!*\
  !*** ./resources/js/argon.js ***!
  \*******************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_license__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/license */ "./resources/js/components/license.js");
/* harmony import */ var _components_license__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_components_license__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_layout__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/layout */ "./resources/js/components/layout.js");
/* harmony import */ var _components_layout__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_components_layout__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_init_navbar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/init/navbar */ "./resources/js/components/init/navbar.js");
/* harmony import */ var _components_init_navbar__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_components_init_navbar__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _components_init_popover__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/init/popover */ "./resources/js/components/init/popover.js");
/* harmony import */ var _components_init_popover__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_components_init_popover__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _components_init_scroll_to__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/init/scroll-to */ "./resources/js/components/init/scroll-to.js");
/* harmony import */ var _components_init_scroll_to__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_components_init_scroll_to__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _components_init_tooltip__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/init/tooltip */ "./resources/js/components/init/tooltip.js");
/* harmony import */ var _components_init_tooltip__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_components_init_tooltip__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _components_init_chart_init__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/init/chart-init */ "./resources/js/components/init/chart-init.js");
/* harmony import */ var _components_init_chart_init__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_components_init_chart_init__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _components_custom_checklist__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/custom/checklist */ "./resources/js/components/custom/checklist.js");
/* harmony import */ var _components_custom_checklist__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_components_custom_checklist__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _components_custom_form_control__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./components/custom/form-control */ "./resources/js/components/custom/form-control.js");
/* harmony import */ var _components_custom_form_control__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_components_custom_form_control__WEBPACK_IMPORTED_MODULE_8__);

 // Init





 // Custom




/***/ }),

/***/ "./resources/js/components/custom/checklist.js":
/*!*****************************************************!*\
  !*** ./resources/js/components/custom/checklist.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Checklist
//


var Checklist = function () {
  //
  // Variables
  //
  var $list = $('[data-toggle="checklist"]'); //
  // Methods
  //
  // Init

  function init($this) {
    var $checkboxes = $this.find('.checklist-entry input[type="checkbox"]');
    $checkboxes.each(function () {
      checkEntry($(this));
    });
  }

  function checkEntry($checkbox) {
    if ($checkbox.is(':checked')) {
      $checkbox.closest('.checklist-item').addClass('checklist-item-checked');
    } else {
      $checkbox.closest('.checklist-item').removeClass('checklist-item-checked');
    }
  } //
  // Events
  //
  // Init


  if ($list.length) {
    $list.each(function () {
      init($(this));
    });
    $list.find('input[type="checkbox"]').on('change', function () {
      checkEntry($(this));
    });
  }
}();

/***/ }),

/***/ "./resources/js/components/custom/form-control.js":
/*!********************************************************!*\
  !*** ./resources/js/components/custom/form-control.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Form control
//


var FormControl = function () {
  // Variables
  var $input = $('.form-control'); // Methods

  function init($this) {
    $this.on('focus blur', function (e) {
      $(this).parents('.form-group').toggleClass('focused', e.type === 'focus');
    }).trigger('blur');
  } // Events


  if ($input.length) {
    init($input);
  }
}();

/***/ }),

/***/ "./resources/js/components/init/chart-init.js":
/*!****************************************************!*\
  !*** ./resources/js/components/init/chart-init.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Charts
//


function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var Charts = function () {
  // Variable
  var $toggle = $('[data-toggle="chart"]');
  var mode = 'light'; //(themeMode) ? themeMode : 'light';

  var fonts = {
    base: 'Open Sans'
  }; // Colors

  var colors = {
    gray: {
      100: '#f6f9fc',
      200: '#e9ecef',
      300: '#dee2e6',
      400: '#ced4da',
      500: '#adb5bd',
      600: '#8898aa',
      700: '#525f7f',
      800: '#32325d',
      900: '#212529'
    },
    theme: {
      'default': '#172b4d',
      'primary': '#5e72e4',
      'secondary': '#f4f5f7',
      'info': '#11cdef',
      'success': '#2dce89',
      'danger': '#f5365c',
      'warning': '#fb6340'
    },
    black: '#12263F',
    white: '#FFFFFF',
    transparent: 'transparent'
  }; // Methods
  // Chart.js global options

  function chartOptions() {
    // Options
    var options = {
      defaults: {
        global: {
          responsive: true,
          maintainAspectRatio: false,
          defaultColor: mode == 'dark' ? colors.gray[700] : colors.gray[600],
          defaultFontColor: mode == 'dark' ? colors.gray[700] : colors.gray[600],
          defaultFontFamily: fonts.base,
          defaultFontSize: 13,
          layout: {
            padding: 0
          },
          legend: {
            display: false,
            position: 'bottom',
            labels: {
              usePointStyle: true,
              padding: 16
            }
          },
          elements: {
            point: {
              radius: 0,
              backgroundColor: colors.theme['primary']
            },
            line: {
              tension: .4,
              borderWidth: 4,
              borderColor: colors.theme['primary'],
              backgroundColor: colors.transparent,
              borderCapStyle: 'rounded'
            },
            rectangle: {
              backgroundColor: colors.theme['warning']
            },
            arc: {
              backgroundColor: colors.theme['primary'],
              borderColor: mode == 'dark' ? colors.gray[800] : colors.white,
              borderWidth: 4
            }
          },
          tooltips: {
            enabled: true,
            mode: 'index',
            intersect: false
          }
        },
        doughnut: {
          cutoutPercentage: 83,
          legendCallback: function legendCallback(chart) {
            var data = chart.data;
            var content = '';
            data.labels.forEach(function (label, index) {
              var bgColor = data.datasets[0].backgroundColor[index];
              content += '<span class="chart-legend-item">';
              content += '<i class="chart-legend-indicator" style="background-color: ' + bgColor + '"></i>';
              content += label;
              content += '</span>';
            });
            return content;
          }
        }
      }
    }; // yAxes

    Chart.scaleService.updateScaleDefaults('linear', {
      gridLines: {
        borderDash: [2],
        borderDashOffset: [2],
        color: mode == 'dark' ? colors.gray[900] : colors.gray[300],
        drawBorder: false,
        drawTicks: false,
        drawOnChartArea: true,
        zeroLineWidth: 0,
        zeroLineColor: 'rgba(0,0,0,0)',
        zeroLineBorderDash: [2],
        zeroLineBorderDashOffset: [2]
      },
      ticks: {
        beginAtZero: true,
        padding: 10,
        callback: function callback(value) {
          if (!(value % 10)) {
            return value;
          }
        }
      }
    }); // xAxes

    Chart.scaleService.updateScaleDefaults('category', {
      gridLines: {
        drawBorder: false,
        drawOnChartArea: false,
        drawTicks: false
      },
      ticks: {
        padding: 20
      },
      maxBarThickness: 10
    });
    return options;
  } // Parse global options


  function parseOptions(parent, options) {
    for (var item in options) {
      if (_typeof(options[item]) !== 'object') {
        parent[item] = options[item];
      } else {
        parseOptions(parent[item], options[item]);
      }
    }
  } // Push options


  function pushOptions(parent, options) {
    for (var item in options) {
      if (Array.isArray(options[item])) {
        options[item].forEach(function (data) {
          parent[item].push(data);
        });
      } else {
        pushOptions(parent[item], options[item]);
      }
    }
  } // Pop options


  function popOptions(parent, options) {
    for (var item in options) {
      if (Array.isArray(options[item])) {
        options[item].forEach(function (data) {
          parent[item].pop();
        });
      } else {
        popOptions(parent[item], options[item]);
      }
    }
  } // Toggle options


  function toggleOptions(elem) {
    var options = elem.data('add');
    var $target = $(elem.data('target'));
    var $chart = $target.data('chart');

    if (elem.is(':checked')) {
      // Add options
      pushOptions($chart, options); // Update chart

      $chart.update();
    } else {
      // Remove options
      popOptions($chart, options); // Update chart

      $chart.update();
    }
  } // Update options


  function updateOptions(elem) {
    var options = elem.data('update');
    var $target = $(elem.data('target'));
    var $chart = $target.data('chart'); // Parse options

    parseOptions($chart, options); // Toggle ticks

    toggleTicks(elem, $chart); // Update chart

    $chart.update();
  } // Toggle ticks


  function toggleTicks(elem, $chart) {
    if (elem.data('prefix') !== undefined || elem.data('prefix') !== undefined) {
      var prefix = elem.data('prefix') ? elem.data('prefix') : '';
      var suffix = elem.data('suffix') ? elem.data('suffix') : ''; // Update ticks

      $chart.options.scales.yAxes[0].ticks.callback = function (value) {
        if (!(value % 10)) {
          return prefix + value + suffix;
        }
      }; // Update tooltips


      $chart.options.tooltips.callbacks.label = function (item, data) {
        var label = data.datasets[item.datasetIndex].label || '';
        var yLabel = item.yLabel;
        var content = '';

        if (data.datasets.length > 1) {
          content += '<span class="popover-body-label mr-auto">' + label + '</span>';
        }

        content += '<span class="popover-body-value">' + prefix + yLabel + suffix + '</span>';
        return content;
      };
    }
  } // Events
  // Parse global options


  if (window.Chart) {
    parseOptions(Chart, chartOptions());
  } // Toggle options


  $toggle.on({
    'change': function change() {
      var $this = $(this);

      if ($this.is('[data-add]')) {
        toggleOptions($this);
      }
    },
    'click': function click() {
      var $this = $(this);

      if ($this.is('[data-update]')) {
        updateOptions($this);
      }
    }
  }); // Return

  return {
    colors: colors,
    fonts: fonts,
    mode: mode
  };
}();

/***/ }),

/***/ "./resources/js/components/init/navbar.js":
/*!************************************************!*\
  !*** ./resources/js/components/init/navbar.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Navbar
//


var Navbar = function () {
  // Variables
  var $nav = $('.navbar-nav, .navbar-nav .nav');
  var $collapse = $('.navbar .collapse');
  var $dropdown = $('.navbar .dropdown'); // Methods

  function accordion($this) {
    $this.closest($nav).find($collapse).not($this).collapse('hide');
  }

  function closeDropdown($this) {
    var $dropdownMenu = $this.find('.dropdown-menu');
    $dropdownMenu.addClass('close');
    setTimeout(function () {
      $dropdownMenu.removeClass('close');
    }, 200);
  } // Events


  $collapse.on({
    'show.bs.collapse': function showBsCollapse() {
      accordion($(this));
    }
  });
  $dropdown.on({
    'hide.bs.dropdown': function hideBsDropdown() {
      closeDropdown($(this));
    }
  });
}(); //
// Navbar collapse
//


var NavbarCollapse = function () {
  // Variables
  var $nav = $('.navbar-nav'),
      $collapse = $('.navbar .navbar-custom-collapse'); // Methods

  function hideNavbarCollapse($this) {
    $this.addClass('collapsing-out');
  }

  function hiddenNavbarCollapse($this) {
    $this.removeClass('collapsing-out');
  } // Events


  if ($collapse.length) {
    $collapse.on({
      'hide.bs.collapse': function hideBsCollapse() {
        hideNavbarCollapse($collapse);
      }
    });
    $collapse.on({
      'hidden.bs.collapse': function hiddenBsCollapse() {
        hiddenNavbarCollapse($collapse);
      }
    });
  }
}();

/***/ }),

/***/ "./resources/js/components/init/popover.js":
/*!*************************************************!*\
  !*** ./resources/js/components/init/popover.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Popover
//


var Popover = function () {
  // Variables
  var $popover = $('[data-toggle="popover"]'),
      $popoverClass = ''; // Methods

  function init($this) {
    if ($this.data('color')) {
      $popoverClass = 'popover-' + $this.data('color');
    }

    var options = {
      trigger: 'focus',
      template: '<div class="popover ' + $popoverClass + '" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
    };
    $this.popover(options);
  } // Events


  if ($popover.length) {
    $popover.each(function () {
      init($(this));
    });
  }
}();

/***/ }),

/***/ "./resources/js/components/init/scroll-to.js":
/*!***************************************************!*\
  !*** ./resources/js/components/init/scroll-to.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Scroll to (anchor links)
//


var ScrollTo = function () {
  //
  // Variables
  //
  var $scrollTo = $('.scroll-me, [data-scroll-to], .toc-entry a'); //
  // Methods
  //

  function scrollTo($this) {
    var $el = $this.attr('href');
    var offset = $this.data('scroll-to-offset') ? $this.data('scroll-to-offset') : 0;
    var options = {
      scrollTop: $($el).offset().top - offset
    }; // Animate scroll to the selected section

    $('html, body').stop(true, true).animate(options, 600);
    event.preventDefault();
  } //
  // Events
  //


  if ($scrollTo.length) {
    $scrollTo.on('click', function (event) {
      scrollTo($(this));
    });
  }
}();

/***/ }),

/***/ "./resources/js/components/init/tooltip.js":
/*!*************************************************!*\
  !*** ./resources/js/components/init/tooltip.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Tooltip
//


var Tooltip = function () {
  // Variables
  var $tooltip = $('[data-toggle="tooltip"]'); // Methods

  function init() {
    $tooltip.tooltip();
  } // Events


  if ($tooltip.length) {
    init();
  }
}();

/***/ }),

/***/ "./resources/js/components/layout.js":
/*!*******************************************!*\
  !*** ./resources/js/components/layout.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
//
// Layout
//


var Layout = function () {
  function pinSidenav() {
    $('.sidenav-toggler').addClass('active');
    $('.sidenav-toggler').data('action', 'sidenav-unpin');
    $('body').removeClass('g-sidenav-hidden').addClass('g-sidenav-show g-sidenav-pinned');
    $('body').append('<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target=' + $('#sidenav-main').data('target') + ' />'); // Store the sidenav state in a cookie session

    Cookies.set('sidenav-state', 'pinned');
  }

  function unpinSidenav() {
    $('.sidenav-toggler').removeClass('active');
    $('.sidenav-toggler').data('action', 'sidenav-pin');
    $('body').removeClass('g-sidenav-pinned').addClass('g-sidenav-hidden');
    $('body').find('.backdrop').remove(); // Store the sidenav state in a cookie session

    Cookies.set('sidenav-state', 'unpinned');
  } // Set sidenav state from cookie


  var $sidenavState = Cookies.get('sidenav-state') ? Cookies.get('sidenav-state') : 'pinned';

  if ($(window).width() > 1200) {
    if ($sidenavState == 'pinned') {
      pinSidenav();
    }

    if (Cookies.get('sidenav-state') == 'unpinned') {
      unpinSidenav();
    }

    $(window).resize(function () {
      if ($('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
        $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
      }
    });
  }

  if ($(window).width() < 1200) {
    $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
    $('body').removeClass('g-sidenav-show');
    $(window).resize(function () {
      if ($('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
        $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
      }
    });
  }

  $("body").on("click", "[data-action]", function (e) {
    e.preventDefault();
    var $this = $(this);
    var action = $this.data('action');
    var target = $this.data('target'); // Manage actions

    switch (action) {
      case 'sidenav-pin':
        pinSidenav();
        break;

      case 'sidenav-unpin':
        unpinSidenav();
        break;

      case 'search-show':
        target = $this.data('target');
        $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-showing');
        setTimeout(function () {
          $('body').removeClass('g-navbar-search-showing').addClass('g-navbar-search-show');
        }, 150);
        setTimeout(function () {
          $('body').addClass('g-navbar-search-shown');
        }, 300);
        break;

      case 'search-close':
        target = $this.data('target');
        $('body').removeClass('g-navbar-search-shown');
        setTimeout(function () {
          $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-hiding');
        }, 150);
        setTimeout(function () {
          $('body').removeClass('g-navbar-search-hiding').addClass('g-navbar-search-hidden');
        }, 300);
        setTimeout(function () {
          $('body').removeClass('g-navbar-search-hidden');
        }, 500);
        break;
    }
  }); // Add sidenav modifier classes on mouse events

  $('.sidenav').on('mouseenter', function () {
    if (!$('body').hasClass('g-sidenav-pinned')) {
      $('body').removeClass('g-sidenav-hide').removeClass('g-sidenav-hidden').addClass('g-sidenav-show');
    }
  });
  $('.sidenav').on('mouseleave', function () {
    if (!$('body').hasClass('g-sidenav-pinned')) {
      $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hide');
      setTimeout(function () {
        $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
      }, 300);
    }
  }); // Make the body full screen size if it has not enough content inside

  $(window).on('load resize', function () {
    if ($('body').height() < 800) {
      $('body').css('min-height', '100vh');
      $('#footer-main').addClass('footer-auto-bottom');
    }
  });
}();

/***/ }),

/***/ "./resources/js/components/license.js":
/*!********************************************!*\
  !*** ./resources/js/components/license.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*!

=========================================================
* Argon Dashboard PRO - v1.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/

/***/ }),

/***/ "./resources/scss/argon.scss":
/*!***********************************!*\
  !*** ./resources/scss/argon.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************************************!*\
  !*** multi ./resources/js/argon.js ./resources/scss/argon.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\Workspace\web\digitalAgent\packages\microboard\resources\js\argon.js */"./resources/js/argon.js");
module.exports = __webpack_require__(/*! D:\Workspace\web\digitalAgent\packages\microboard\resources\scss\argon.scss */"./resources/scss/argon.scss");


/***/ })

/******/ });