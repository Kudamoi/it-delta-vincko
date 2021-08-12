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
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/js/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/blocks/modules/addSensors/addSensors.js":
/*!*****************************************************!*\
  !*** ./src/blocks/modules/addSensors/addSensors.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(".price__bonuses-info").on("click", function () {
  $(".price__bonuses-info-m").addClass("vis");
  $(".price__bonuses-close").addClass("vis");
  $(".section-result__price-bonuses-container").addClass("vis");
  $(".section-result__price-rub-container").removeClass("vis");
  $(".price__bonuses-info").removeClass("vis");
  $(".installment__calculator-left").removeClass("vis");
  $(".price__bonuses").addClass("h-full");
  $(".installment__calculator").addClass("border-vis");
  $(".installment .price__result").removeClass("vis");
});
$(".price__bonuses-close").on("click", function () {
  $(".price__bonuses-info-m").removeClass("vis");
  $(".price__bonuses-close").removeClass("vis");
  $(".section-result__price-bonuses-container").removeClass("vis");
  $(".section-result__price-rub-container").addClass("vis");
  $(".price__bonuses-info").addClass("vis");
  $(".installment__calculator-left").addClass("vis");
  $(".installment__calculator").removeClass("border-vis");
  $(".price__bonuses").removeClass("h-full");
  $(".installment .price__result").addClass("vis");
});

function closeOpenBlock2(blockSelector, btnSelector, btnSelector2) {
  var block = document.querySelector(blockSelector),
      btn = document.querySelector(btnSelector);
  btn2 = document.querySelector(btnSelector2);

  if (btn) {
    btn.addEventListener('click', function () {
      if (block.classList.contains('close')) {
        block.classList.remove('close');
        btn2.innerHTML = 'Свернуть';
      } else {
        block.classList.add('close');
        btn2.innerHTML = 'Развернуть';
      }
    });
  }
}

closeOpenBlock2('.slider__under-block-1', '.slider__under-title', '.close-btn');
closeOpenBlock2('.slider__under-block-1', '.close-btn-3', '.close-btn');
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/autorisation/autorisation.js":
/*!*********************************************************!*\
  !*** ./src/blocks/modules/autorisation/autorisation.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(document).ready(function () {
  function timer(parent) {
    parent.find(".popup__wait-time").css("display", "block");
    parent.find(".popup__wait").css("display", "block");

    var _Seconds = 20,
        _int;

    parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок

    _int = setInterval(function () {
      // запускаем интервал
      if (_Seconds > 0) {
        _Seconds--; // вычитаем 1

        parent.find('.popup__wait-num').text(_Seconds); // выводим получившееся значение в блок
      } else {
        parent.find(".popup__wait-repeat").css("display", "block");
        parent.find(".popup__wait-time").css("display", "none");
        clearInterval(_int); // очищаем интервал, чтобы он не продолжал работу при _Seconds = 0
      }
    }, 1000);
  }

  function showBtn(selector, parent, switcher) {
    if (selector.inputmask("isComplete")) {
      /* $(".popup__form--phone .grey-border-button").css("display", "none");
       $(".popup__form--phone .popup__code").css("display", "block");
         */
      parent.find(".popup__form--" + switcher + " .grey-border-button--unactive").removeClass("grey-border-button--unactive");
      parent.find(".popup__form--" + switcher + " .grey-border-button").addClass("grey-border-button--active");
      parent.find(".popup__form--" + switcher + " .grey-border-button--active").on("click", function () {
        parent.find(".popup__form--" + switcher + " .grey-border-button").css("display", "none");
        parent.find(".popup__form--" + switcher + " .popup__code").css("display", "block");
        timer(parent);
      });
    } else {
      parent.find(".popup__form--" + switcher + " .grey-border-button").addClass("grey-border-button--unactive");
      parent.find(".popup__form--" + switcher + " .grey-border-button").removeClass("grey-border-button--active");
    }
  }

  var selector = document.getElementsByClassName("phone-input");
  var popupers = $(".popup");
  popupers.each(function (index) {
    var parent = $(this);
    var phone = parent.find(".phone-input");
    var email = parent.find(".email-input");
    phone.inputmask("+7(999) 999-9999");
    showBtn(phone, parent, "phone");
    phone.keyup(function () {
      showBtn(phone, parent, "phone");
    });
    email.inputmask("email");
    showBtn(email, parent, "mail");
    email.on("keyup", function () {
      showBtn(email, parent, "mail");
    });
    parent.find(".popup__wait-repeat").on("click", function () {
      parent.find(".popup__wait-repeat").css("display", "none");
      parent.find(".popup__wait-time").css("display", "block");
      timer(parent);
    });
    parent.find(".popup__code").mask("9999", {
      completed: function completed() {
        parent.find(".popup__send-code").css("display", "grid");
      }
    });
    parent.find(".popup__send-code").on("click", function () {
      parent.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
      parent.find(".popup__wait-time").css("opacity", "0");
      parent.find(".popup__wait-time").css("display", "block");
      parent.find(".popup__success").css("display", "flex");
      parent.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
      parent.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
    });
  });
  var popups = $(".popup");
  popups.each(function (index) {
    var close1 = $(this).find(".popup__close");
    var close2 = $(this).find(".popup__wall");
    var popup = $(this);
    close1.on("click", function () {
      popup.addClass("hidden");
    });
    close2.on("click", function () {
      popup.addClass("hidden");
    });
  });
  var items = $(".pass-wrapper");
  items.each(function (index) {
    var eye = $(this).children(".pass__eye");
    var input = $(this).children("input");
    var open = 0;
    eye.on("click", function () {
      if (open == 0) {
        input.attr("type", "text");
        open = 1;
      } else {
        input.attr("type", "password");
        open = 0;
      }
    });
  });
  var left = 1;
  $(".popup__switch").on("click", function () {
    if (left == 1) {
      $(this).addClass("popup__switch--right");
      $(".popup__switch-item-left").removeClass("popup__switch-item--active");
      $(".popup__switch-item-right").addClass("popup__switch-item--active");
      $(".popup__form--phone").css("display", "none");

      if (window.innerWidth > 780) {
        $(".popup__form--mail").css("display", "grid");
      } else {
        $(".popup__form--mail").css("display", "flex");
      }

      left = 0;
    } else {
      $(this).removeClass("popup__switch--right");
      $(".popup__switch-item-left").addClass("popup__switch-item--active");
      $(".popup__switch-item-right").removeClass("popup__switch-item--active");
      $(".popup__form--mail").css("display", "none");

      if (window.innerWidth > 780) {
        $(".popup__form--phone").css("display", "grid");
      } else {
        $(".popup__form--phone").css("display", "flex");
      }

      left = 1;
    }
  });
  $(".new-pass-button").on("click", function () {
    $(".popup").addClass("hidden");
    $(".popup--new-pass").removeClass("hidden");
  });
  $(".to-registration").on("click", function () {
    $(".popup").addClass("hidden");
    $(".popup--registration").removeClass("hidden");
  });
  $(".to-login").on("click", function () {
    $(".popup").addClass("hidden");
    $(".popup--login").removeClass("hidden");
  });
  $(".forget-pass").on("click", function () {
    $(".popup").addClass("hidden");
    $(".popup--forget").removeClass("hidden");
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/bonuses/bonuses.js":
/*!***********************************************!*\
  !*** ./src/blocks/modules/bonuses/bonuses.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$("#useless").on("click", function () {
  $(".useless-modal").addClass("vis");
});
$(".useless-modal__close").on("click", function () {
  $(".useless-modal").removeClass("vis");
});

if ($(window).width() <= '767') {
  $('.useless-modal__text').attr('placeholder', 'Напишите Ваши' + '\n' + 'пожелания');
  $('.useless-modal__text').attr('rows', '3');
}
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/complect/complect.js":
/*!*************************************************!*\
  !*** ./src/blocks/modules/complect/complect.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {if (!document.querySelector('.complect__slider')) {} else {
  var colorOnClick = function colorOnClick(allEl, el, text) {
    el.addEventListener('click', function () {
      allEl.forEach(function (item) {
        item.classList.remove('active');
      });
      el.classList.add('active');
      textBlock.innerHTML = text;
    });
  };

  // Блоки с характеристикой
  var closeOpenBlock = function closeOpenBlock(blockSelector, btnSelector) {
    var block = document.querySelector(blockSelector),
        btn = document.querySelector(btnSelector);

    if (btn) {
      btn.addEventListener('click', function () {
        if (block.classList.contains('close')) {
          block.classList.remove('close');
          btn.innerHTML = 'Свернуть';
        } else {
          block.classList.add('close');
          btn.innerHTML = 'Развернуть';
        }
      });
    }
  };

  // Селектор цвета
  var white = document.querySelector('.complect__slider-datchiki-color-choice .white'),
      black = document.querySelector('.complect__slider-datchiki-color-choice .black'),
      allColor = document.querySelectorAll('.complect__slider-datchiki-color-choice .color'),
      textBlock = document.querySelector('.complect__slider-datchiki-color-text > span');
  colorOnClick(allColor, white, 'Белый');
  colorOnClick(allColor, black, 'Черный');
  var сomplectSliderItems = document.querySelectorAll('.complect__slider-wrapper-item'),
      сomplectSliderTabs = document.querySelectorAll('.complect__slider-wrapper-tabs > li');
  сomplectSliderTabs.forEach(function (item) {
    item.addEventListener('click', function () {
      сomplectSliderTabs.forEach(function (el) {
        el.classList.remove('active');
      });
      сomplectSliderItems.forEach(function (slide) {
        slide.classList.remove('active');

        if (item.getAttribute('data-tab') == slide.getAttribute('data-tab')) {
          item.classList.add('active');
          slide.classList.add('active');
        }
      });
    });
  }); // слайдер

  $('.slick-slider-datchiki').slick({
    variableWidth: true,
    centerMode: true,
    arrows: true,
    centerPadding: '60px',
    slidesToShow: 5,
    prevArrow: '<div class="arrow-prev arrow"><img src="../img/cartochka/prew.svg"></div>',
    nextArrow: '<div class="arrow-next arrow"><img src="../img/cartochka/next.svg"></div>',
    infinity: true
  });
  $('.slide-box-slider-item').slick({
    arrows: true,
    slidesToShow: 1,
    prevArrow: '<div class="arrow-prev-mini arrow-mini"><img src="../img/cartochka/arrow-prev-mini.svg"></div>',
    nextArrow: '<div class="arrow-next-mini arrow-mini"><img src="../img/cartochka/arrow-next-mini.svg"></div>'
  });
  var activeSlide = document.querySelector('.slick-slide.slick-center'),
      infoBlocks = document.querySelectorAll('.info'),
      allSlides = document.querySelectorAll('.slick-slide');
  allSlides.forEach(function (item, i) {
    var dataSlickIndex = item.getAttribute('data-slick-index');
    item.setAttribute('data-slider-info', +dataSlickIndex + 1);
  });
  document.querySelectorAll('.slick-slide').forEach(function (item) {
    item.classList.remove('prev-next-slide');

    if (document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') - 1 == item.getAttribute('data-slick-index')) {
      item.classList.add('prev-next-slide');
    }

    if (+document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') + 1 == item.getAttribute('data-slick-index')) {
      item.classList.add('prev-next-slide');
    }
    /*infoBlocks.forEach(item => {
        item.classList.remove('show');
        if (activeSlide.getAttribute('data-slider-info') == item.getAttribute('data-slider-info')) {
            item.classList.add('show')
        }
    })*/

  });
  document.querySelectorAll('.slick-arrow').forEach(function (arrow) {
    arrow.addEventListener('click', function () {
      document.querySelectorAll('.slick-slide').forEach(function (item) {
        item.classList.remove('prev-next-slide');

        if (document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') - 1 == item.getAttribute('data-slick-index')) {
          item.classList.add('prev-next-slide');
        }

        if (+document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') + 1 == item.getAttribute('data-slick-index')) {
          item.classList.add('prev-next-slide');
        }
        /*infoBlocks.forEach(item => {
            item.classList.remove('show');
            if (activeSlide.getAttribute('data-slider-info') == item.getAttribute('data-slider-info')) {
                item.classList.add('show')
            }
        })*/

      });
    });
  });
  $('.slick-slider-datchiki').on('swipe', function (event) {
    document.querySelectorAll('.slick-slide').forEach(function (item) {
      item.classList.remove('prev-next-slide');

      if (document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') - 1 == item.getAttribute('data-slick-index')) {
        item.classList.add('prev-next-slide');
      }

      if (+document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') + 1 == item.getAttribute('data-slick-index')) {
        item.classList.add('prev-next-slide');
      }
    });
  });
  closeOpenBlock('.slider__under-block-1', '.close-btn');
  closeOpenBlock('.slider__under-block-2', '.close-btn-2'); // modal

  $('.modal-slider').slick({
    prevArrow: '<div class="modal-arrow arrow-prev-mini arrow-mini"><img src="../img/cartochka/modal-prev.svg"></div>',
    nextArrow: '<div class="modal-arrow arrow-next-mini arrow-mini"><img src="../img/cartochka/modal-next.svg"></div>'
  });
  var slide = document.querySelectorAll('.modal-slider .slick-slide'),
      slideBottom = document.querySelectorAll('.modal-bottom .item'),
      modalArrow = document.querySelectorAll('.modal-arrow'),
      modal = document.querySelector('.slide-modal'),
      modalTrigger = document.querySelectorAll('.modal-btn'),
      modalClose = modal.querySelector('.close');
  modalTrigger.forEach(function (item) {
    item.addEventListener('click', function () {
      modal.classList.add('active');
    });
  });
  modalClose.addEventListener('click', function () {
    modal.classList.remove('active');
  });
  document.addEventListener('click', function (e) {
    if (e.target == modal && modal.classList.contains('active')) {
      modal.classList.remove('active');
    }
  });
  slide.forEach(function (item, i) {
    item.setAttribute('data-modal-slide', i);
  });
  slideBottom.forEach(function (item, i) {
    item.setAttribute('data-modal-slide', i + 1);
  });
  modalArrow.forEach(function (btn) {
    btn.addEventListener('click', function () {
      slide.forEach(function (slide) {
        if (slide.classList.contains('slick-active')) {
          slideBottom.forEach(function (slideBottom) {
            slideBottom.classList.remove('active');

            if (slide.getAttribute('data-modal-slide') === slideBottom.getAttribute('data-modal-slide')) {
              slideBottom.classList.add('active');
            }
          });
        }
      });
    });
  }); // swipe 

  $('.modal-slider').on('swipe', function (event) {
    slide.forEach(function (slide) {
      if (slide.classList.contains('slick-active')) {
        slideBottom.forEach(function (slideBottom) {
          slideBottom.classList.remove('active');

          if (slide.getAttribute('data-modal-slide') === slideBottom.getAttribute('data-modal-slide')) {
            slideBottom.classList.add('active');
          }
        });
      }
    });
  });
  $('.slick-slider-datchiki').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    $('.info').removeClass("vis");
    $('[data-slider-info="' + nextSlide + '"]').addClass('vis');
    console.log(nextSlide);
  });
  $(".complect .subscribe .blue-button").on("click", function () {
    $(".subscribe").addClass("subscribe-ordered");
    $('.card-one').removeClass("no-subscribe");
  });
  $(".complect .subscribe .button-ordered").on("click", function () {
    $(".subscribe").removeClass("subscribe-ordered");
    $('.card-one').addClass("no-subscribe");
  });
  $(".to-card-btn").on("click", function () {
    $([document.documentElement, document.body]).animate({
      scrollTop: $("#solutions__center").offset().top
    }, 300);
  });
}
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/complect_obor/complect_obor.js":
/*!***********************************************************!*\
  !*** ./src/blocks/modules/complect_obor/complect_obor.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(document).ready(function () {
  var items = $(".ready-pack__item");
  items.each(function (index) {
    var parent = $(this).children(" .ready-pack__mid");
    var ul = parent.find(".ready-pack__mid-list");

    if (ul.find("li").length > 5) {
      var el = ul.find("li").slice(5, 100);
      parent.find(".ready-pack__switch").css("display", "grid");
      el.addClass("hidden");
      var open = parent.find(".ready-pack__open");
      var close = parent.find(".ready-pack__close");
      var present = parent.find(".predloj__present");
      open.on("click", function () {
        console.log("heya");
        el.removeClass("hidden");
        close.css("display", "flex");
        open.css("display", "none");
        present.css("opacity", "0");
      });
      close.on("click", function () {
        el.addClass("hidden");
        close.css("display", "none");
        open.css("display", "flex");
        present.css("opacity", "1");
      });
    }
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/footer/footer.js":
/*!*********************************************!*\
  !*** ./src/blocks/modules/footer/footer.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {



/***/ }),

/***/ "./src/blocks/modules/header/header.js":
/*!*********************************************!*\
  !*** ./src/blocks/modules/header/header.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(jQuery) {

jQuery(document).ready(function ($) {
  // header burger
  $(".header__top-menu").on("click", function () {
    $('.header__top').addClass("header__top--open");
    $('.header__submenu').addClass("header__submenu--open");
    $(".header__wall").css({
      'display': 'block'
    });
  });
  $(".header__submenu-close, .header__wall, .header__top-menu--open").on("click", function () {
    $('.header__top').removeClass("header__top--open");
    $('.header__submenu').removeClass("header__submenu--open");
    $(".header__wall").css({
      'display': 'none'
    });
  });
  $(".header__submenu-question-yes").on("click", function () {
    $(".header__submenu-question").css({
      'opacity': '0'
    });
  }); // modal

  function modal() {
    var openModalButtons = document.querySelectorAll("[data-modal-target]");
    var closeModalButtons = document.querySelectorAll("[data-close-button]");
    var body = document.body;
    openModalButtons.forEach(function (button) {
      button.addEventListener("click", function (e) {
        e.preventDefault();
        var modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
        body.style.overflow = "hidden";
      });
    });
    closeModalButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var modal = button.closest(".modal");
        closeModal(modal);
      });
    });

    function openModal(modal) {
      if (modal == null) return;
      modal.classList.add("active");
    }

    function closeModal(modal) {
      if (modal == null) return;
      modal.classList.remove("active");
      body.style.overflow = "auto";
      body.style.overflowX = "hidden";
    }
  }

  modal(); // js-select
  // let select = document.querySelector('#header__select_town-js')
  // new Choices(select, {
  //     searchEnabled: false,
  //     itemSelectText: '',
  // });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/installment/installment.js":
/*!*******************************************************!*\
  !*** ./src/blocks/modules/installment/installment.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(document).ready(function () {
  function closeOpenBlockNext(blockClose, blockOpen, btn) {
    blockClose.classList.add('close');
    blockOpen.classList.remove('def-close');
    btn.classList.remove('close-btn_hide');
  }

  function closeOpenBlockBtn(btn, block) {
    if (btn) {
      btn.addEventListener('click', function () {
        if (block.classList.contains('close')) {
          block.classList.remove('close');
          btn.innerHTML = 'Свернуть';
        } else {
          block.classList.add('close');
          btn.innerHTML = 'Развернуть';
        }
      });
    }
  }

  var forms = document.getElementsByClassName('form');
  var btns = $('.close-btn');
  var btnns = $('.form__bottom button');

  for (var i = 0; i < btns.length; i++) {
    closeOpenBlockBtn(btns[i], forms[i]);
  }

  try {
    btnns[0].addEventListener("click", function () {
      closeOpenBlockNext(forms[0], forms[1], btns[0]);
      var id = "#form-2";
      var top = $(id).position().top;
      $('html').scrollTop(top);
    });
    btnns[1].addEventListener("click", function () {
      closeOpenBlockNext(forms[1], forms[2], btns[1]);
      var id = "#form-3";
      var top = $(id).position().top;
      $('html').scrollTop(top);
      $('.installment__rules').addClass("installment__rules--active");
    });
    $(".polzunok-1").slider({
      min: 0,
      max: 50,
      step: 1,
      range: "min",
      animate: "slow",
      slide: function slide(event, ui) {
        $(".polzunok__number-1").html(ui.value);
      }
    });
    $(".polzunok-2").slider({
      min: 0,
      max: 12,
      step: 6,
      range: "min",
      animate: "slow",
      slide: function slide(event, ui) {
        $(".installment__calculator-sub-value-2").html(ui.value);
      }
    });
  } catch (_unused) {}

  $(".to-short-rd").on("click", function () {
    $("#short-rd").removeClass("hidden");
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/insurance/insurance.js":
/*!***************************************************!*\
  !*** ./src/blocks/modules/insurance/insurance.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(document).ready(function () {
  if ($(window).width() >= '1024') {
    $('.included__items').slick({
      infinite: true,
      slidesToShow: 6,
      slidesToScroll: 3
    });
  } else if ($(window).width() >= '767') {
    $('.included__items').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 3
    });
  } else if ($(window).width() >= '560') {
    $('.included__items').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3
    });
  } else {
    $('.included__items').slick({
      infinite: true,
      slidesToShow: 2,
      slidesToScroll: 3
    });
  }

  var status = 0;
  $(".documents__switch-open, .documents__head").on("click", function () {
    console.log(status);

    if (status == 0) {
      $(".documents").addClass("documents--opened");
      setTimeout(function () {
        status = 1;
      }, 200);
    }
  });
  $(".documents__switch-close, .documents__head").on("click", function () {
    console.log(status);

    if (status == 1) {
      $(".documents").removeClass("documents--opened");
      setTimeout(function () {
        status = 0;
      }, 200);
    }
  });
  var select_calculator = document.querySelector('#calculator__select-js');

  if (select_calculator) {
    var choices = new Choices(select_calculator, {
      searchEnabled: false,
      itemSelectText: ''
    });
  }

  if ($(".card-three .products__payment").children(".products__payment-item").length > 4) {
    var el = $(".card-three .products__payment").children(".products__payment-item").slice(4, 100);
    $(".products__payment-switch").css("display", "grid");
    el.addClass("hidden");
    $(".card-three .products__payment-open").on("click", function () {
      el.removeClass("hidden");
      $(".card-three .products__payment-close").css("display", "flex");
      $(".card-three .products__payment-open").css("display", "none");
    });
    $(".card-three .products__payment-close").on("click", function () {
      el.addClass("hidden");
      $(".card-three .products__payment-close").css("display", "none");
      $(".card-three .products__payment-open").css("display", "flex");
    });
  }
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/loyalty/loyalty_program.js":
/*!*******************************************************!*\
  !*** ./src/blocks/modules/loyalty/loyalty_program.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(jQuery) {

jQuery(document).ready(function ($) {
  // tabs
  var tab = function tab() {
    var tabLink = document.querySelectorAll(".tab-js .item");
    var tabContent = document.querySelectorAll(".tabs__content-js");
    var tabName;
    tabLink.forEach(function (item) {
      item.addEventListener("click", selsectTabLink);
    });

    function selsectTabLink() {
      tabLink.forEach(function (item) {
        item.classList.remove("active");
      });
      this.classList.add("active");
      tabName = this.getAttribute("data-tab-name");
      selectTabContent(tabName);
    }

    var selectTabContent = function selectTabContent(tabName) {
      tabContent.forEach(function (item) {
        item.classList.contains(tabName) ? item.classList.add("active") : item.classList.remove("active");
      });
    };
  };

  tab(); // loyality__calculator

  $(document).on("change", function () {
    var $selectVal = $("#calculator__select-js option:selected").val();
    var $output = $(".content__items-left--bottom .number");
    var $center = $(".content__items-center--bottom>p");
    var $right = $(".content__items-right--bottom>p");
    $output.html($selectVal);
    var vincoTime = [{
      hour: 0,
      minut: 12
    }, {
      hour: 0,
      minut: 18
    }, {
      hour: 0,
      minut: 36
    }, {
      hour: 0,
      minut: 54
    }, {
      hour: 1,
      minut: 12
    }];
    var workTime = [{
      hour: 17,
      minut: 36
    }, {
      hour: 26,
      minut: 24
    }, {
      hour: 52,
      minut: 48
    }, {
      hour: 79,
      minut: 12
    }, {
      hour: 105,
      minut: 36
    }];
    var h = Object.values(workTime).map(function (i) {
      return i.hour;
    });
    var m = Object.values(workTime).map(function (i) {
      return i.minut;
    });

    function hour() {
      return Object.values(this).map(function (i) {
        return i.hour;
      });
    }

    var r = hour.bind(workTime);
    console.log(r());
    $("#calculator__range-js").on("input", function rangeRes() {
      var $value = $(this).val();
      $(".result-number").html($value);
    });

    function elNumber(el) {
      var $rangeValue = $("#calculator__range-js").val() / 1000;
      var vincoHour = vincoTime[el].hour * $rangeValue;
      var vincoMinut = vincoTime[el].minut * $rangeValue;
      var workHour = workTime[el].hour * $rangeValue;
      var workMinut = workTime[el].minut * $rangeValue;
      $center.html("<span>".concat(vincoHour, "<small>\u0447</small></span><span>").concat(vincoMinut, "<small>\u043C\u0438\u043D</small></span>"));
      $right.html("<span>".concat(workHour, "<small>\u0447</small></span><span>").concat(workMinut, "<small>\u043C\u0438\u043D</small></span>"));
    }

    if ($selectVal == 1000) {
      elNumber(0);
    }

    if ($selectVal == 1500) {
      elNumber(1);
    }

    if ($selectVal == 3000) {
      elNumber(2);
    }

    if ($selectVal == 4500) {
      elNumber(3);
    }

    if ($selectVal == 6000) {
      elNumber(4);
    }
  }); // js-select

  var select_calculator = document.querySelector('[data-calculator-select]');

  if (select_calculator) {
    var choices = new Choices(select_calculator, {
      searchEnabled: false,
      itemSelectText: ''
    });
  }

  if ($(window).width() <= 1024 && $(window).width() >= 768) {
    $(".loyality__options_content").slick({
      dots: true,
      arrows: false,
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      variableWidth: true
    });
  } // sliders


  var $prevArrowImg = "<svg width=\"10\" height=\"18\" viewBox=\"0 0 10 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n    <path d=\"M0.545444 9.82854L7.78681 17.0496C8.24745 17.5092 8.9943 17.5092 9.45471 17.0496C9.91516 16.5904 9.91516 15.8457 9.45471 15.3865L3.04722 8.99701L9.45452 2.6077C9.91498 2.14834 9.91498 1.40367 9.45452 0.944496C8.99407 0.485135 8.24726 0.485135 7.78662 0.944496L0.545258 8.16567C0.315031 8.39537 0.200048 8.6961 0.200048 8.99697C0.200048 9.298 0.315254 9.59895 0.545444 9.82854Z\" fill=\"#989898\"/>\n    </svg>";
  var $nextArrowImg = "<svg width=\"10\" height=\"18\" viewBox=\"0 0 10 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n    <path d=\"M9.45456 9.82854L2.21319 17.0496C1.75255 17.5092 1.0057 17.5092 0.54529 17.0496C0.0848382 16.5904 0.0848382 15.8457 0.54529 15.3865L6.95278 8.99701L0.545477 2.6077C0.0850245 2.14834 0.0850245 1.40367 0.545477 0.944496C1.00593 0.485135 1.75274 0.485135 2.21338 0.944496L9.45474 8.16567C9.68497 8.39537 9.79995 8.6961 9.79995 8.99697C9.79995 9.298 9.68475 9.59895 9.45456 9.82854Z\" fill=\"#989898\"/>\n    </svg>";
  var prevArrowBtn = "<button type=\"button\" class=\"slick-prev\">".concat($prevArrowImg, "</button>");
  var netArrowBtn = "<button type=\"button\" class=\"slick-next\">".concat($nextArrowImg, "</button>");
  $(".presents__tabs_slider-js,.equipment__tabs_slider-js").slick({
    variableWidth: true,
    centerMode: true,
    arrows: true,
    dots: false,
    draggable: false,
    infinite: true,
    slidesToShow: 5,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn
  });

  function addSlidersClass() {
    var $slide = $(".slick-slide");
    var $currentSlide = $(".slick-slide.slick-current");
    $slide.removeClass('prev-slide next-slide prev-slide-sub next-slide-sub');
    $currentSlide.prev().addClass("prev-slide");
    $currentSlide.prev().prev().addClass("prev-slide-sub");
    $currentSlide.next().addClass("next-slide");
    $currentSlide.next().next().addClass("next-slide-sub");
  }

  addSlidersClass();
  $('.slick-arrow').on('click', function () {
    addSlidersClass();
  });
  $(".sensors-collection__tab").on("click", function () {
    $(".sensors-collection__tab").each(function () {
      $(".sensors-collection__tab").removeClass("active");
    });
    $(this).addClass("active");
  });
  $(".item__img.slider_js").slick({
    centerMode: true,
    arrows: true,
    dots: true,
    draggable: false,
    infinite: false,
    slidesToShow: 1,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/main__content/main__content.js":
/*!***********************************************************!*\
  !*** ./src/blocks/modules/main__content/main__content.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery, $) {jQuery(document).ready(function () {
  var $prevArrowImg = "<svg width=\"10\" height=\"18\" viewBox=\"0 0 10 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n    <path d=\"M0.545444 9.82854L7.78681 17.0496C8.24745 17.5092 8.9943 17.5092 9.45471 17.0496C9.91516 16.5904 9.91516 15.8457 9.45471 15.3865L3.04722 8.99701L9.45452 2.6077C9.91498 2.14834 9.91498 1.40367 9.45452 0.944496C8.99407 0.485135 8.24726 0.485135 7.78662 0.944496L0.545258 8.16567C0.315031 8.39537 0.200048 8.6961 0.200048 8.99697C0.200048 9.298 0.315254 9.59895 0.545444 9.82854Z\" fill=\"#989898\"/>\n    </svg>";
  var $nextArrowImg = "<svg width=\"10\" height=\"18\" viewBox=\"0 0 10 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n    <path d=\"M9.45456 9.82854L2.21319 17.0496C1.75255 17.5092 1.0057 17.5092 0.54529 17.0496C0.0848382 16.5904 0.0848382 15.8457 0.54529 15.3865L6.95278 8.99701L0.545477 2.6077C0.0850245 2.14834 0.0850245 1.40367 0.545477 0.944496C1.00593 0.485135 1.75274 0.485135 2.21338 0.944496L9.45474 8.16567C9.68497 8.39537 9.79995 8.6961 9.79995 8.99697C9.79995 9.298 9.68475 9.59895 9.45456 9.82854Z\" fill=\"#989898\"/>\n    </svg>";
  var prevArrowBtn = "<button type=\"button\" class=\"slick-prev\">".concat($prevArrowImg, "</button>");
  var netArrowBtn = "<button type=\"button\" class=\"slick-next\">".concat($nextArrowImg, "</button>");
  $('.top__slider-js').slick({
    arrows: true,
    dots: false,
    infinite: false,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        dots: true
      }
    }]
  });
  $('.you__reviews_slider-js').slick({
    arrows: true,
    dots: false,
    infinite: false,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 1024,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true
      }
    }]
  });
  $('.what__task-js').slick({
    arrows: true,
    dots: false,
    infinite: false,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn,
    slidesToShow: 4,
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 1024,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true
      }
    }]
  });
  $('.about__us_slider-js').slick({
    arrows: true,
    dots: false,
    infinite: false,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn,
    slidesToShow: 4,
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 1024,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true
      }
    }]
  });
  $('.equipment__manufacturers_slider-js').slick({
    arrows: false,
    dots: false,
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn,
    responsive: [{
      breakpoint: 1180,
      settings: {
        arrows: true,
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 768,
      settings: {
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true
      }
    }]
  });
  $('.group__pack_slider-js').slick({
    arrows: false,
    dots: false,
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn,
    respondTo: "slider",
    responsive: [{
      breakpoint: 1180,
      settings: {
        arrows: true,
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 768,
      settings: {
        arrows: true,
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true
      }
    }]
  });
  $('.must__now_slider-js').slick({
    arrows: true,
    dots: false,
    infinite: false,
    prevArrow: prevArrowBtn,
    nextArrow: netArrowBtn,
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 1024,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true
      }
    }]
  }); // pseudo popup

  $(".must__now_slider-js").find(".slick-slide").each(function () {
    var $this = $(this);
    $this.on("click", function () {
      $(".must__now_slider-js").find(".slick-slide").each(function () {
        $(this).find(".must__now_item").addClass("shadow");
        $(".must__now_item--pseudo-items").hide();
      });
      $this.find(".must__now_item--pseudo-items").show();

      if ($(".must__now-pseudo_slider-js")) {
        $(".must__now-pseudo_slider-js").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          variableWidth: true,
          arrows: true,
          dots: true,
          infinite: true,
          prevArrow: prevArrowBtn,
          nextArrow: netArrowBtn,
          draggable: false,
          autoplay: true,
          autoplaySpeed: 2750
        });
      }
    });
  });
  $(document).mouseup(function (e) {
    var $item = $(".must__now_item--pseudo-items");

    if ($item.has(e.target).length === 0) {
      $(".must__now_slider-js").find(".slick-slide").find(".must__now_item").removeClass("shadow");
      $(".must__now_item--pseudo-items").hide();
    }
  }); // js-select

  var modalSelect_Ready_des = function modalSelect_Ready_des() {
    var select_ready_des = document.querySelectorAll(".ready__des_select-js");
    var reputation__rating_select = document.querySelectorAll(".reputation__rating_select-js");

    if (select_ready_des, reputation__rating_select) {
      select_ready_des.forEach(function (el) {
        var choices = new Choices(el, {
          searchEnabled: false,
          itemSelectText: ''
        });
      });
      reputation__rating_select.forEach(function (el) {
        var choices = new Choices(el, {
          searchEnabled: false,
          itemSelectText: ''
        });
      });
    }
  };

  modalSelect_Ready_des();
  $(".show__more .button").on("click", function () {
    $(".reputation__rating_center-item.hide").css({
      display: "flex"
    });
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery"), __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/modal/modal.js":
/*!*******************************************!*\
  !*** ./src/blocks/modules/modal/modal.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var btns_modals = document.getElementsByClassName("click-any-modal");
var close_modals = document.getElementsByClassName("any-modal__close");
var win_modals = document.getElementsByClassName("any-modal");

var _loop = function _loop(i) {
  btns_modals[i].addEventListener("click", function () {
    win_modals[i].classList.add("vis");
  });
  win_modals[i].addEventListener("click", function () {
    win_modals[i].classList.remove("vis");
  });
  close_modals[i].addEventListener("click", function () {
    win_modals[i].classList.remove("vis");
  });
};

for (var i = 0; i < btns_modals.length; i++) {
  _loop(i);
}

/***/ }),

/***/ "./src/blocks/modules/rating/rating.js":
/*!*********************************************!*\
  !*** ./src/blocks/modules/rating/rating.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery, $) {jQuery(document).ready(function () {
  $('.rating-center__items_top-btn').on('click', function () {
    $(this).addClass('act').siblings().removeClass('act');
  });
  $('.rating-center__item').on('click', function () {
    var itemRating = $(this).parent('.rating-center__item-wrapper').find('.itemRating-open');
    $(this).parent().addClass('item-rating-active');
    $(itemRating).addClass('show');
  });
  $('.itemRating-open__closed').on('click', function () {
    $(this).parent().removeClass('show');
    $(this).parents('.rating-center__item-wrapper').removeClass('item-rating-active');
  });
  $('.closed-card').on('click', function () {
    $('.itemRating-open').removeClass('show');
    $('.rating-center__item-wrapper').removeClass('item-rating-active');
  });
  $('.tab-one').on('click', function (event) {
    event.preventDefault();
    $(this).addClass('tab_active').siblings().removeClass('tab_active');
    $(this).parent().next().find('.content-one').addClass('tabs-content_active').siblings().removeClass('tabs-content_active');
  });
  $('.tab-two').on('click', function (event) {
    event.preventDefault();
    $(this).addClass('tab_active').siblings().removeClass('tab_active');
    $(this).parent().next().find('.content-two').addClass('tabs-content_active').siblings().removeClass('tabs-content_active');
  });
  $('.tab-three').on('click', function (event) {
    event.preventDefault();
    $(this).addClass('tab_active').siblings().removeClass('tab_active');
    $(this).parent().next().find('.content-three').addClass('tabs-content_active').siblings().removeClass('tabs-content_active');
  });
  $('.formation__left_btn').on('click', function () {
    $(this).addClass('formation__left_btn-active').siblings().removeClass('formation__left_btn-active');
  });
  $('.toggle__item').on('click', function () {
    var $this = $(this).find('.toggle__item_title');
    $(this).toggleClass('toggle__item_active');
    $('.toggle__item .toggle__item_descr').not($($this).next()).slideUp(300);
    $($this).next().slideToggle(300);
    $($this).toggleClass('toggle__item_title-active');
    $($this).parents('.toggle__item').siblings().find('div').removeClass('toggle__item_title-active');
    $(this).parents().siblings().find('div').removeClass('toggle__item_title-active');
    $(this).siblings().removeClass('toggle__item_active');
  });
  $('.formation__left_btn-one').on('click', function () {
    $('.slide-one').addClass('formation__right_slide-active').siblings().removeClass('formation__right_slide-active');
  });
  $('.formation__left_btn-two').on('click', function () {
    $('.slide-two').addClass('formation__right_slide-active').siblings().removeClass('formation__right_slide-active');
  });
  $('.formation__left_btn-three').on('click', function () {
    $('.slide-three').addClass('formation__right_slide-active').siblings().removeClass('formation__right_slide-active');
  });
  $('.slide-one-btnTwo').on('click', function () {
    $('.slide-two').addClass('formation__right_slide-active').siblings().removeClass('formation__right_slide-active');
    $('.formation__left_btn-two').addClass('formation__left_btn-active').siblings().removeClass('formation__left_btn-active');
  });
  $('.slide-two-btnOne').on('click', function () {
    $('.slide-one').addClass('formation__right_slide-active').siblings().removeClass('formation__right_slide-active');
    $('.formation__left_btn-one').addClass('formation__left_btn-active').siblings().removeClass('formation__left_btn-active');
  });
  $('.slide-two-btnTwo').on('click', function () {
    $('.slide-three').addClass('formation__right_slide-active').siblings().removeClass('formation__right_slide-active');
    $('.formation__left_btn-three').addClass('formation__left_btn-active').siblings().removeClass('formation__left_btn-active');
  });
  $('.slide-three-btnOne').on('click', function () {
    $('.slide-two').addClass('formation__right_slide-active').siblings().removeClass('formation__right_slide-active');
    $('.formation__left_btn-two').addClass('formation__left_btn-active').siblings().removeClass('formation__left_btn-active');
  });
  $('.questions__text-show').on('click', function () {
    $('.questions__text-show').toggleClass('act');
    $('.questions__text').toggleClass('questions__textHide');

    if ($('.questions__text').hasClass('questions__textHide')) {
      $('.questions__text-show').text('Развернуть');
    } else {
      $('.questions__text-show').text('Свернуть');
    }
  });
  $('.icon-info_cli').hover(function () {
    $('.icon-info_modal').fadeIn();
  }, function () {
    $('.icon-info_modal').fadeOut();
  });
  $('.itemRating-open__left_endorsements').hover(function () {
    $('.endorsements_modal').fadeIn();
  }, function () {
    $('.endorsements_modal').fadeOut();
  });
  $('.itemRating-open__left_deal').hover(function () {
    $('.deal_modal').fadeIn();
  }, function () {
    $('.deal_modal').fadeOut();
  });
  $('.itemRating-open__showRating_title-modal').hover(function () {
    $('.itemRating-open__showRating_title-modalShow').fadeIn();
  }, function () {
    $('.itemRating-open__showRating_title-modalShow').fadeOut();
  });

  if ($(window).width() > 670) {
    $('.tab-all_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '-120px');
    });
    $('.tab-one_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '-95px');
    });
    $('.tab-two_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '0px');
    });
    $('.tab-three_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '-180px');
    });
  }

  if ($(window).width() < 670) {
    $('.tab-all_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '-39px');
    });
    $('.tab-one_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '-45px');
    });
    $('.tab-two_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '0px');
    });
    $('.tab-three_btn').on('click', function () {
      $('.rating-center__item-rating').css('margin-left', '-30px');
    });
  }

  setInterval(function () {
    if ($('.tab-all_btn').hasClass('act')) {
      $('.title-all').addClass('title-act').siblings().removeClass('title-act');
    }

    if ($('.tab-one_btn').hasClass('act')) {
      $('.title-one').addClass('title-act').siblings().removeClass('title-act');
    }

    if ($('.tab-two_btn').hasClass('act')) {
      $('.title-two').addClass('title-act').siblings().removeClass('title-act');
    }

    if ($('.tab-three_btn').hasClass('act')) {
      $('.title-three').addClass('title-act').siblings().removeClass('title-act');
    }
  }, 1);
  $('.radio').on('click', function () {
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
  });
  $('.act-nohide').on('click', function () {
    $(this).css('display', 'none');
    $(this).next().css('display', 'block');
  });
  $('.rating-center__search_form-select').on('click', function () {
    $('.searchForm__modal').fadeIn(100);
  });
  $('.searchForm__modal_closed').on('click', function () {
    $('.searchForm__modal').fadeOut(100);
  });
  var $bottomModalItem = $('.bottomChekItem');
  var $topModalItem = $('.topChekItem');
  $bottomModalItem.on('click', function () {
    $(this).clone().prependTo('.searchForm__modal_topChek').removeClass('bottomChekItem').addClass('topChekItem');
    $('.searchForm__modal_topChek').addClass('active');
  });
  $topModalItem.on('click', function () {
    $(this).prependTo('.searchForm__modal_bottomChek').removeClass('topChekItem').addClass('bottomChekItem');
    console.log('true');
  });
  var $test = $('.searchForm__modal_topChek').find('.topChekItem');

  if ($test.length <= 0) {
    $('.searchForm__modal_topChek').removeClass('active');
  }

  $(document).mouseup(function (e) {
    var div = $(".searchForm__modal");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $(div).fadeOut();
    }
  });
  $(document).mouseup(function (e) {
    var div = $(".itemRating-open");
    var div2 = $(".rating-center__item-wrapper");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $(div).removeClass('show');
      $(div2).removeClass('item-rating-active');
    }
  });
  var swiper = new Swiper(".mySwiper", {
    observer: true,
    observeParents: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
  $(function () {
    var $range = $(".js-range-slider"),
        $input = $(".js-input"),
        instance,
        min = 1,
        max = 12;
    $range.ionRangeSlider({
      skin: "big",
      type: "single",
      min: min,
      max: max,
      from: 1,
      onStart: function onStart(data) {
        $input.prop("value", data.from);
      },
      onChange: function onChange(data) {
        $input.prop("value", data.from);
      }
    });
    instance = $range.data("ionRangeSlider");
    $input.on("change keyup", function () {
      var val = $(this).prop("value"); // validate

      if (val < min) {
        val = min;
      } else if (val > max) {
        val = max;
      }

      instance.update({
        from: val
      });
    });
  });
  $(function () {
    var $range = $(".js-range-slider2"),
        $input = $(".js-input2"),
        instance,
        min = 1,
        max = 3;
    $range.ionRangeSlider({
      skin: "big",
      type: "single",
      min: min,
      max: max,
      from: 1,
      onStart: function onStart(data) {
        $input.prop("value", data.from);
      },
      onChange: function onChange(data) {
        $input.prop("value", data.from);
      }
    });
    instance = $range.data("ionRangeSlider");
    $input.on("change keyup", function () {
      var val = $(this).prop("value"); // validate

      if (val < min) {
        val = min;
      } else if (val > max) {
        val = max;
      }

      instance.update({
        from: val
      });
    });
  });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery"), __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/ready-des/ready-des.js":
/*!***************************************************!*\
  !*** ./src/blocks/modules/ready-des/ready-des.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {jQuery(document).ready(function ($) {
  // var packerContainer = document.getElementById("packer");
  // var packs = packerContainer.getElementsByClassName("pack");
  // if (packs) {
  // 	for (var i = 0; i < packs.length; i++) {
  // 		packs[i].addEventListener("mouseover", function () {
  // 			var current = document.getElementsByClassName("shadow");
  // 			current[0].className = current[0].className.replace(" shadow", "");
  // 			this.className += " shadow";
  // 		});
  // 	}
  // }
  var animItems = document.querySelectorAll('._anim-items');

  if (animItems.length > 0) {
    var animOnScroll = function animOnScroll() {
      for (var index = 0; index < animItems.length; index++) {
        var animItem = animItems[index];
        var animItemHeight = animItem.offsetHeight;
        var animItemOffset = offset(animItem).top;
        var animStart = 4;
        var animItemPoint = window.innerHeight - animItemHeight / animStart;

        if (animItemHeight > window.innerHeight) {
          animItemPoint = window.innerHeight - window.innerHeight / animStart;
        }

        if (pageYOffset > animItemOffset - animItemPoint && pageYOffset < animItemOffset + animItemHeight) {
          animItem.classList.add('_animate');
        } else {
          if (!animItem.classList.contains('_anim-no-hide')) {
            animItem.classList.remove('_animate');
          }
        }
      }
    };

    var offset = function offset(el) {
      var rect = el.getBoundingClientRect(),
          scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
          scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      return {
        top: rect.top + scrollTop,
        left: rect.left + scrollLeft
      };
    };

    window.addEventListener('scroll', animOnScroll);
    setTimeout(function () {
      animOnScroll();
    }, 700);
  }

  var modalSelect_Ready_des = function modalSelect_Ready_des() {
    var select_ready_des = document.querySelectorAll(".ready__des_select-js");

    if (select_ready_des) {
      select_ready_des.forEach(function (el) {
        var choices = new Choices(el, {
          searchEnabled: false,
          itemSelectText: ''
        });
      });
    }
  };

  modalSelect_Ready_des();
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/ready-des2/ready-des2.js":
/*!*****************************************************!*\
  !*** ./src/blocks/modules/ready-des2/ready-des2.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(document).ready(function () {
  var $prevArrowImg = "<svg width=\"10\" height=\"18\" viewBox=\"0 0 10 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n    <path d=\"M0.545444 9.82854L7.78681 17.0496C8.24745 17.5092 8.9943 17.5092 9.45471 17.0496C9.91516 16.5904 9.91516 15.8457 9.45471 15.3865L3.04722 8.99701L9.45452 2.6077C9.91498 2.14834 9.91498 1.40367 9.45452 0.944496C8.99407 0.485135 8.24726 0.485135 7.78662 0.944496L0.545258 8.16567C0.315031 8.39537 0.200048 8.6961 0.200048 8.99697C0.200048 9.298 0.315254 9.59895 0.545444 9.82854Z\" fill=\"#989898\"/>\n    </svg>";
  var $nextArrowImg = "<svg width=\"10\" height=\"18\" viewBox=\"0 0 10 18\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n    <path d=\"M9.45456 9.82854L2.21319 17.0496C1.75255 17.5092 1.0057 17.5092 0.54529 17.0496C0.0848382 16.5904 0.0848382 15.8457 0.54529 15.3865L6.95278 8.99701L0.545477 2.6077C0.0850245 2.14834 0.0850245 1.40367 0.545477 0.944496C1.00593 0.485135 1.75274 0.485135 2.21338 0.944496L9.45474 8.16567C9.68497 8.39537 9.79995 8.6961 9.79995 8.99697C9.79995 9.298 9.68475 9.59895 9.45456 9.82854Z\" fill=\"#989898\"/>\n    </svg>";
  var prevArrowBtn = "<button type=\"button\" class=\"slick-prev\">".concat($prevArrowImg, "</button>");
  var netArrowBtn = "<button type=\"button\" class=\"slick-next\">".concat($nextArrowImg, "</button>"); // let copies = document.getElementsByClassName('r-d-s');
  // for (let i = 0; i < copies.length; i++) {
  //     let inner = copies[i].innerHTML;
  //     inner += inner
  //     copies[i].innerHTML = inner;
  // }

  var rds = document.getElementsByClassName('r-d-s');

  for (var i = 1; i <= rds.length; i++) {
    if ($('#r-d-s-' + i).children(".ready-pack__item-wrapper").length < 2) {
      $('#r-d-s-' + i).slick({
        variableWidth: true,
        centerMode: true,
        arrows: true,
        prevArrow: prevArrowBtn,
        nextArrow: netArrowBtn,
        centerPadding: '60px',
        slidesToShow: 1,
        slidesToScroll: 1,
        // initialSlide: 1,
        // infinite: true,
        focusOnSelect: true,
        responsive: [{
          breakpoint: 426,
          settings: {
            slidesToShow: 1
          }
        }]
      });
    } else if ($('#r-d-s-' + i).children(".ready-pack__item-wrapper").length === 2) {
      $('#r-d-s-' + i).slick({
        variableWidth: true,
        centerMode: true,
        arrows: true,
        prevArrow: prevArrowBtn,
        nextArrow: netArrowBtn,
        centerPadding: '60px',
        slidesToShow: 1,
        // slidesToScroll: 1,
        // initialSlide: 0,
        // infinite: false,
        focusOnSelect: true,
        responsive: [{
          breakpoint: 426,
          settings: {
            slidesToShow: 1
          }
        }]
      });
    } else if ($("#r-d-s-" + i).children(".ready-pack__item-wrapper").length > 2) {
      if ($(window).width() >= '426') {
        var copies = document.getElementById('r-d-s-' + i);
        var inner = copies.innerHTML;
        inner += inner;
        copies.innerHTML = inner;
      }

      $('#r-d-s-1').slick({
        variableWidth: true,
        centerMode: true,
        arrows: true,
        centerPadding: '60px',
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        initialSlide: 1,
        prevArrow: prevArrowBtn,
        nextArrow: netArrowBtn,
        focusOnSelect: true,
        responsive: [{
          breakpoint: 426,
          settings: {
            centerMode: false,
            slidesToShow: 1,
            infinite: false
          }
        }]
      });
    }
  } // if ($(".r-d-s")) {
  //     $('.r-d-s').slick({
  //         variableWidth: true,
  //         centerMode: true,
  //         arrows: true,
  //         centerPadding: '60px',
  //         infinite: true,
  //         slidesToShow: 3,
  //         slidesToScroll: 1,
  //         initialSlide: 2,
  //         prevArrow: prevArrowBtn,
  //         nextArrow: netArrowBtn,
  //         focusOnSelect: true,
  //         responsive: [
  //             {
  //                 breakpoint:1025,
  //                 settings: {
  //                     slidesToShow: 1
  //                 }
  //             }
  //         ]
  //     })
  // }


  var items = document.getElementsByClassName("ready-des2__show-item");
  var openBtns = document.getElementsByClassName("ready-des2__show-more");
  var closeBtns = document.getElementsByClassName("ready-des2__show-close");
  $(".ready-des2__up").on("click", function () {
    var top = $('.ready-des2__choice').position().top;
    $('html').scrollTop(top);
  });

  var _loop = function _loop(_i) {
    openBtns[_i].addEventListener("click", function () {
      items[_i].classList.remove("close");
    });

    closeBtns[_i].addEventListener("click", function () {
      items[_i].classList.add("close");
    });
  };

  for (var _i = 0; _i < items.length; _i++) {
    _loop(_i);
  }

  $(".ready-des2__choice-item").on("click", function () {
    var top = $('.ready-des2__show').position().top;
    $('html').scrollTop(top);
    $(".ready-des2__show--open").removeClass("hidden");

    if (!$(".ready-des2__show--close").hasClass("hidden")) {
      $(".ready-des2__show--close").addClass("hidden");
    }
  });
  $("#allC").on("click", function () {
    $(".ready-des2__show-item:first").removeClass("close");
  });

  var companySelect = function companySelect() {
    var element = document.querySelector('.ready-des2__company-select');

    if (element) {
      var choices = new Choices(element, {
        searchEnabled: false,
        itemSelectText: ''
      });
    }
  };

  var citySelect = function citySelect() {
    var element = document.querySelector('.ready-des2__city-select');

    if (element) {
      var choices = new Choices(element, {
        searchEnabled: false,
        itemSelectText: ''
      });
    }
  };

  var rdSelect = function rdSelect() {
    var element = document.querySelectorAll('.ready__des_select-js-2');

    if (element) {
      element.forEach(function (el) {
        var choices = new Choices(el, {
          searchEnabled: false,
          itemSelectText: ''
        });
      });
    }
  };

  companySelect();
  citySelect();
  rdSelect();
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/review/review.js":
/*!*********************************************!*\
  !*** ./src/blocks/modules/review/review.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (document.querySelector('.review') === null) {} else {
  var reviewBottomItem = document.querySelectorAll('.review__bottom-item');
  reviewBottomItem.forEach(function (item) {
    item.addEventListener('mouseover', function () {
      reviewBottomItem.forEach(function (el) {
        el.classList.remove('hover');
      });
      reviewBottomItem[0].classList.remove('hover');
      item.classList.add('hover');
    });
  });

  if (document.querySelector('.review__massage') === null) {} else {
    var reviewBox = document.querySelector('.review__massage');
    reviewIcon = reviewBox.querySelector('.review__massage-icon > picture'), reviewText = reviewBox.querySelector('.review__massage-text > p');

    if (reviewBox.classList.contains('bad')) {
      reviewBox.style.background = '#FFECEC';
      var source = reviewIcon.querySelector('source'),
          img = reviewIcon.querySelector('img');
      source.setAttribute('srcset', '../img/review/massage-bad.svg');
      img.setAttribute('src', '../img/review/massage-bad.svg');
      reviewText.innerHTML = 'Этот отзыв не влияет на рейтинг, так как вы не являетесь покупателем услуг данной охранной компании в рамках платформы <a href="">vincko:</a>';
    }
  }

  if (document.querySelector('.smile-input') === null) {} else {
    var input = document.querySelector('.smile-input'),
        smiles = document.querySelectorAll('.smile');
    input.addEventListener('input', function () {
      smiles.forEach(function (item, i) {
        item.classList.remove('active');

        if (input.value < 10000) {
          smiles[0].classList.add('active');
        } else if (input.value > 10000 && input.value <= 20000) {
          smiles[1].classList.add('active');
        } else if (input.value > 20000 && input.value <= 30000) {
          smiles[2].classList.add('active');
        } else if (input.value > 30000 && input.value <= 40000) {
          smiles[3].classList.add('active');
        } else if (input.value > 40000 && input.value <= 50000) {
          smiles[4].classList.add('active');
        }
      });
    });
  }

  var stepTwoItems = document.querySelectorAll('.review__bottom-item');
  stepTwoItems.forEach(function (item) {
    var input = item.querySelector('.smile-input'),
        li = item.querySelectorAll('.review-item-step-2'),
        span = item.querySelector('.number-wrapper > span'),
        svg = item.querySelector('svg'),
        circle = item.querySelector('circle'),
        numberWrapper = item.querySelector('.number-wrapper');
    input.addEventListener('input', function () {
      li.forEach(function (el, i) {
        el.classList.remove('active');

        if (input.value < 18000) {
          li[0].classList.add('active');
          span.innerHTML = '?';
          svg.style.display = 'none';
          numberWrapper.style.border = '1px solid #D1DBE3';
        } else if (input.value > 18000 && input.value < 28000) {
          li[1].classList.add('active');
          span.innerHTML = '0';
          numberWrapper.style.border = '1px solid #D1DBE3';
          svg.style.display = 'none';
        } else if (input.value > 28000 && input.value < 38000) {
          li[2].classList.add('active');
          span.innerHTML = '1';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '130.5';
        } else if (input.value > 38000 && input.value < 48000) {
          li[3].classList.add('active');
          span.innerHTML = '2';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '116';
        } else if (input.value > 48000 && input.value < 58000) {
          li[4].classList.add('active');
          span.innerHTML = '3';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '101.5';
        } else if (input.value > 58000 && input.value < 68000) {
          li[5].classList.add('active');
          span.innerHTML = '4';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '87';
        } else if (input.value > 68000 && input.value < 78000) {
          li[6].classList.add('active');
          span.innerHTML = '5';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '72.5';
        } else if (input.value > 78000 && input.value < 88000) {
          li[7].classList.add('active');
          span.innerHTML = '6';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '58';
        } else if (input.value > 88000 && input.value < 98000) {
          li[8].classList.add('active');
          span.innerHTML = '7';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '43.5';
        } else if (input.value > 98000 && input.value < 108000) {
          li[9].classList.add('active');
          span.innerHTML = '8';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '29';
        } else if (input.value > 108000 && input.value < 118000) {
          li[10].classList.add('active');
          span.innerHTML = '9';
          svg.style.display = 'block';
          circle.style.strokeDashoffset = '14.5';
          numberWrapper.style.border = '1px solid #D1DBE3';
        } else if (input.value > 118000) {
          li[11].classList.add('active');
          span.innerHTML = '10';
          svg.style.display = 'none';
          numberWrapper.style.border = '2px solid #005DFF';
        }
      });
    });
  });
  var content = document.querySelectorAll('.content');
  var stepThreeActiveBlocks = document.querySelectorAll('.content-wrapper .active-block');
  content.forEach(function (item, n) {
    var notBefore = 0;
    var q = item.querySelectorAll('.q');
    q.forEach(function (elem, i) {
      var input = elem.querySelector('.smile-input'),
          li = elem.querySelectorAll('.review-item-step-3'),
          span = elem.querySelector('span'),
          btn = elem.querySelector('.next-btn'),
          h5 = elem.querySelector('h5');
      input.addEventListener('input', function () {
        li.forEach(function (el, i) {
          el.classList.remove('active');

          if (input.value < 18000) {
            li[0].classList.add('active');
            span.innerHTML = '?';
          } else if (input.value > 18000 && input.value < 28000) {
            li[1].classList.add('active');
            span.innerHTML = '0';
          } else if (input.value > 28000 && input.value < 38000) {
            li[2].classList.add('active');
            span.innerHTML = '1';
          } else if (input.value > 38000 && input.value < 48000) {
            li[3].classList.add('active');
            span.innerHTML = '2';
          } else if (input.value > 48000 && input.value < 58000) {
            li[4].classList.add('active');
            span.innerHTML = '3';
          } else if (input.value > 58000 && input.value < 68000) {
            li[5].classList.add('active');
            span.innerHTML = '4';
          } else if (input.value > 68000 && input.value < 78000) {
            li[6].classList.add('active');
            span.innerHTML = '5';
          } else if (input.value > 78000 && input.value < 88000) {
            li[7].classList.add('active');
            span.innerHTML = '6';
          } else if (input.value > 88000 && input.value < 98000) {
            li[8].classList.add('active');
            span.innerHTML = '7';
          } else if (input.value > 98000 && input.value < 108000) {
            li[9].classList.add('active');
            span.innerHTML = '8';
          } else if (input.value > 108000 && input.value < 118000) {
            li[10].classList.add('active');
            span.innerHTML = '9';
          } else if (input.value > 118000) {
            li[11].classList.add('active');
            span.innerHTML = '10';
          }
        });
      });
      elem.setAttribute('q-num', i);
      h5.addEventListener('click', function () {
        q.forEach(function (trig) {
          trig.classList.remove('active');
        });
        elem.classList.add('active');
      });
      btn.addEventListener('click', function () {
        var nextBtn = document.querySelector('.next-btn-bottom');
        notBefore += 1;
        elem.classList.remove('active');

        if (!q[i + 1]) {} else {
          q[i + 1].classList.remove('before');
          q[i + 1].classList.add('active');
        }

        if (notBefore === q.length) {
          nextBtn.disabled = false;
        }
      });
    });
  });
  var stepThreeItems = document.querySelectorAll('.step-3-item');
  var btn = document.querySelector('.next-btn-bottom');
  stepThreeItems.forEach(function (item, i) {
    btn.addEventListener('click', function () {
      btn.disabled = true;

      if (btn.classList.contains('step-2') && stepThreeItems[i + 1].classList.contains('active')) {
        btn.classList.remove('step-2');
        btn.classList.add('step-3');
        stepThreeItems[i + 1].classList.remove('active');
        stepThreeItems[i + 1].classList.add('pre-back');
        stepThreeItems[i + 2].classList.add('active');
        stepThreeItems[i + 2].classList.remove('pre-next');
        var btnBlock = document.querySelector('.review__btn.step-3');
        var next = btnBlock.querySelector('.next-btn-bottom');
        var stop = btnBlock.querySelector('.stop');
        var bonusBlock = stop.querySelector('.bonus-block');
        var pic = bonusBlock.querySelector('picture');
        var bonSpan = bonusBlock.querySelector('span');
        next.style.display = 'none';
        stop.style.display = 'flex';
        bonusBlock.style.cssText = "\n                display: flex;\n                width: 112px;\n            ";
        pic.style.cssText = "\n                margin-left: 20px;\n            ";
        bonSpan.style.color = '#FF6E52';
      }
    });
    btn.addEventListener('click', function () {
      if (btn.classList.contains('step-1')) {
        btn.classList.remove('step-1');
        btn.classList.add('step-2');
        item.classList.remove('active');
        item.classList.add('back');
        stepThreeItems[i + 1].classList.add('active');
        stepThreeItems[i + 1].classList.remove('next');
      }
    });
  });

  if (document.body.clientWidth < 1098) {
    var reviewBlock = document.querySelector('.review');
    var stepOneNext = document.querySelector('.review__btn.step-1 .next');
    var stepTwoNext = document.querySelector('.review__btn.step-2 .next');
    var stepOneMid = document.querySelector('.review__mid-step-1.mob');
    var stepTwoMid = document.querySelector('.review__mid-step-2.mob');
    var stepThreeMid = document.querySelector('.review__mid-step-3.mob');
    stepOneNext.addEventListener('click', function () {
      stepOneMid.classList.remove('active');
      stepTwoMid.classList.add('active');
      reviewBlock.classList.add('step-2');
    });
    stepTwoNext.addEventListener('click', function () {
      stepTwoMid.classList.remove('active');
      stepThreeMid.classList.add('active');
      reviewBlock.classList.remove('step-2');
      reviewBlock.classList.add('step-3');
    });
  } else {
    var _reviewBlock = document.querySelector('.review');

    var _stepOneNext = document.querySelector('.review__btn.step-1 .next');

    var _stepTwoNext = document.querySelector('.review__btn.step-2 .next');

    var _stepOneMid = document.querySelector('.review__mid-step-1');

    var _stepTwoMid = document.querySelector('.review__mid-step-2');

    var _stepThreeMid = document.querySelector('.review__mid-step-3');

    _stepOneNext.addEventListener('click', function () {
      _stepOneMid.classList.remove('active');

      _stepOneMid.innerHTML = "\n            <picture class=\"pic\">\n                <source srcset=\"../img/review/step-1-no-active.svg\">\n                <img src=\"../img/review/step-1-no-active.svg\" alt=\"good\">\n            </picture>\n            <p><span>1</span> \u041E\u0431\u0449\u0435\u0435 \u0432\u043F\u0435\u0447\u0430\u0442\u043B\u0435\u043D\u0438\u0435</p>\n        ";

      _stepTwoMid.classList.add('active');

      _reviewBlock.classList.add('step-2');

      _stepTwoMid.innerHTML = "\n            <picture class=\"pic\">\n                <source srcset=\"../img/review/step-2-active.svg\">\n                <img src=\"../img/review/step-2-active.svg\" alt=\"good\">\n            </picture>\n            <p><span>2</span> \u0412\u0441\u0435\u0433\u043E 3 \u0432\u043E\u043F\u0440\u043E\u0441\u0430</p>\n            <picture class=\"icon\">\n                <source srcset=\"../img/review/step-2-icon.svg\">\n                <img src=\"../img/review/step-2-icon.svg\" alt=\"good\">\n            </picture>\n            <p class=\"bonus\">+500 \u0431\u043E\u043D\u0443\u0441\u043E\u0432</p>\n        ";
    });

    _stepTwoNext.addEventListener('click', function () {
      _stepTwoMid.classList.remove('active');

      _stepTwoMid.innerHTML = "\n        <picture class=\"pic\">\n        <source srcset=\"../img/review/step-2-no-active.svg\">\n        <img src=\"../img/review/step-2-no-active.svg\" alt=\"good\">\n        </picture>\n        <p><span>2</span> \u0412\u0441\u0435\u0433\u043E 3 \u0432\u043E\u043F\u0440\u043E\u0441\u0430</p>\n        <picture class=\"icon\">\n            <source srcset=\"../img/review/step-2-icon.svg\">\n            <img src=\"../img/review/step-2-icon.svg\" alt=\"good\">\n        </picture>\n        <p class=\"bonus\">+500 \u0431\u043E\u043D\u0443\u0441\u043E\u0432</p>\n        ";

      _stepThreeMid.classList.add('active');

      _reviewBlock.classList.remove('step-2');

      _reviewBlock.classList.add('step-3');

      _stepThreeMid.innerHTML = "\n        <picture class=\"pic\">\n        <source srcset=\"../img/review/step-3-active.svg\">\n        <img src=\"../img/review/step-3-active.svg\" alt=\"good\">\n        </picture>\n        <p><span>3</span> \u041D\u0435\u043C\u043D\u043E\u0433\u043E \u043F\u043E\u0434\u0440\u043E\u0431\u043D\u0435\u0435</p>\n        <picture class=\"icon\">\n            <source srcset=\"../img/review/step-3-icon.svg\">\n            <img src=\"../img/review/step-3-icon.svg\" alt=\"good\">\n        </picture>\n        <p class=\"bonus\">+600 \u0431\u043E\u043D\u0443\u0441\u043E\u0432</p>\n        ";
    });
  }
}

/***/ }),

/***/ "./src/blocks/modules/reviews/reviews.js":
/*!***********************************************!*\
  !*** ./src/blocks/modules/reviews/reviews.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {// "use strict"
jQuery(document).ready(function ($) {
  // js-select
  var modalSelect = function modalSelect() {
    var modalSelect = document.querySelector("[data-select-modal]");

    if (modalSelect) {
      var choices = new Choices(modalSelect, {
        searchEnabled: false,
        itemSelectText: ''
      });
    }
  };

  modalSelect();

  var sortrSelect = function sortrSelect() {
    var sortSelect = document.querySelector("[data-select-sort]");

    if (sortSelect) {
      var choices = new Choices(sortSelect, {
        searchEnabled: false,
        itemSelectText: '',
        classNames: {// list: 'sort__choices__list',
        }
      });
    }
  };

  sortrSelect(); // js-select end    
  // open__form

  var $hiddenForm = $(".reviews__form-top--hidden");
  $(".pseudo__search,.pseudo__range,.text-js").on("click", function () {
    $(".reviews__form-top").addClass("active");
    $hiddenForm.addClass("active");
    $(".text-js").addClass("active");
  }); // close form

  $(".close-js").on("click", function () {
    $(".reviews__form-top").removeClass("active");
    $hiddenForm.removeClass("active");
    $(".text-js").removeClass("active");
  });
  $(document).mouseup(function (e) {
    var $form = $(".reviews__form-top");

    if ($form.has(e.target).length === 0) {
      $(".reviews__form-top").removeClass("active");
      $hiddenForm.removeClass("active");
      $(".text-js").removeClass("active");
    }
  }); // reviews__form-top--submit
  // let $reviews__form__submit = $(".reviews__form-top--submit")
  // let $reviews__form__result = $(".reviews__form-top--result")
  // $reviews__form__submit.on("click", function (e) {
  //     e.preventDefault()
  //     $reviews__form__result.show(300)
  // })
  // filter_city

  $("#filter_city-js").on("keyup", function () {
    var $value = $(this).val().toLowerCase();
    $(".left__filter_city-items li").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf($value) > -1);
    });
  }); // form filter 
  // all checkbox

  var $btnAllCenter = $("#center__all_item-js");
  var $btnAllRight = $("#right__all_item-js");
  var $center__not_selected = $(".reviews__form-top--hidden .center__not_selected");
  var $center__selected = $(".reviews__form-top--hidden .center__selected");
  var $right__selected = $(".reviews__form-top--hidden .right__top");
  var $right__not_selected = $(".reviews__form-top--hidden .right__bottom");

  function clone(selected, not__selected) {
    selected.html(not__selected.find("label").clone(true));
    selected.prepend("<span>Выбраны</span>");
  }

  $btnAllCenter.on("click", function () {
    $center__selected.show(100);
    clone($center__selected, $center__not_selected);

    if ($(this).is(':checked')) {
      $(".reviews__form-top--hidden .center__not_selected input:checkbox").attr('checked', true);
    } else {
      $(".reviews__form-top--hidden .center__not_selected input:checkbox").attr('checked', false);
      $center__selected.children("label").remove();
      $center__selected.hide(100);
    }
  });
  $btnAllRight.on("click", function () {
    $right__selected.show(100);
    clone($right__selected, $right__not_selected);

    if ($(this).is(':checked')) {
      $(".reviews__form-top--hidden .right__bottom input:checkbox").attr('checked', true);
    } else {
      $(".reviews__form-top--hidden .right__bottom input:checkbox").attr('checked', false);
      $right__selected.children("label").remove();
      $right__selected.hide(100);
    }
  });
  $(document).on("change", function () {
    var $center__selected_input = $(".reviews__form-top--hidden .center__selected input:checkbox");
    var $right__selected_input = $(".reviews__form-top--hidden .right__top input:checkbox");
    $center__selected_input.each(function () {
      if ($center__selected_input.attr(":checked") != "checked") {
        $(this).attr('checked', true);
      }
    });
    $right__selected_input.each(function () {
      if ($right__selected_input.attr(":checked") != "checked") {
        $(this).attr('checked', true);
      }
    });

    if ($center__selected_input) {
      $center__selected_input.parent('label').on("click", function () {
        var $this = $(this);
        $this.remove();
      });
    }

    if ($right__selected_input) {
      $right__selected_input.parent('label').on("click", function () {
        var $this = $(this);
        $this.remove();
      });
    }
  });
  $center__not_selected.on("click", "input:checkbox", function () {
    var $this = $(this);

    if ($this.is(':checked')) {
      var $parent = $this.parent();
      $center__selected.show(100);
      $center__selected.append("<label class=\"center__selected-label\">".concat($parent.html(), "</label>"));
    }
  });
  $right__not_selected.on("click", "input:checkbox", function () {
    var $this = $(this);

    if ($this.is(':checked')) {
      var $parent = $this.parent();
      $right__selected.show(100);
      $right__selected.append("<label class=\"center__selected-label\">".concat($parent.html(), "</label>"));
    }
  }); // form filter end
  // range filter

  var $range = $("#pseudo__range");
  $range.addClass("all");
  $range.on("input change", function () {
    var $value = $(this).val();
    var $text = $(".pseudo__range-text__select");

    if ($value >= 2 && $value <= 3) {
      $text.html("Низкий");
      $text.css({
        color: "#FF5252"
      });
      $range.removeClass();
      $range.addClass("red");
    } else if ($value >= 4 && $value <= 6) {
      $text.html("Средний");
      $text.css({
        color: "#FFC85C"
      });
      $range.removeClass();
      $range.addClass("yellow");
    } else if ($value >= 7 && $value <= 10) {
      $text.html("Высокий");
      $text.css({
        color: "#31CB40"
      });
      $range.removeClass();
      $range.addClass("green");
    } else {
      $text.html("Все");
      $text.css({
        color: "#000000"
      });
      $range.removeClass();
      $range.addClass("all");
    }
  }); // reviews__item add new review

  $(".reviews__item").each(function () {
    var $this = $(this);
    var $btn = $(".comment__btn-js");
    var $comments = $(".reviews__item__comments");
    var $btnClose = $(".comments__close_btn-js");
    var $comments__add = $(".add__new_comment-js");
    var $add__new_comment_form = $(".add__new_comment-form");
    var $icon = "<svg width=\"13\" height=\"12\" viewBox=\"0 0 13 12\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M7.38173 5.9864L12.3557 1.0257C12.454 0.911231 12.5054 0.76398 12.4996 0.613378C12.4937 0.462776 12.4311 0.319916 12.3243 0.213345C12.2174 0.106774 12.0742 0.0443419 11.9232 0.0385248C11.7722 0.0327077 11.6245 0.0839342 11.5097 0.181967L6.53573 5.14266L1.56173 0.175983C1.44874 0.063303 1.29551 0 1.13573 0C0.975945 0 0.822708 0.063303 0.709726 0.175983C0.596744 0.288663 0.533271 0.44149 0.533271 0.600844C0.533271 0.760197 0.596744 0.913024 0.709726 1.0257L5.68973 5.9864L0.709726 10.9471C0.646917 11.0007 0.595905 11.0668 0.559891 11.141C0.523877 11.2152 0.503639 11.2961 0.500447 11.3785C0.497255 11.4609 0.511179 11.5431 0.541343 11.6199C0.571508 11.6967 0.617263 11.7664 0.675736 11.8247C0.734209 11.8831 0.804137 11.9287 0.881132 11.9588C0.958127 11.9889 1.04053 12.0027 1.12316 11.9996C1.20579 11.9964 1.28687 11.9762 1.36131 11.9403C1.43575 11.9044 1.50194 11.8535 1.55573 11.7908L6.53573 6.83014L11.5097 11.7908C11.6245 11.8889 11.7722 11.9401 11.9232 11.9343C12.0742 11.9285 12.2174 11.866 12.3243 11.7595C12.4311 11.6529 12.4937 11.51 12.4996 11.3594C12.5054 11.2088 12.454 11.0616 12.3557 10.9471L7.38173 5.9864Z\" fill=\"#A0A0A0\"/></svg>";
    var $body_item = $(".reviews__item__body");
    $this.find($btn).on("click", function () {
      $this.find($comments).show(0);
      $this.find($body_item).addClass("hide");
    });
    $this.find($btnClose).on("click", function () {
      $this.find($comments).hide();
      $this.find($body_item).removeClass("hide");
    });
    $this.find($comments__add).on("click", function () {
      $this.find($add__new_comment_form).toggle(300);

      if ($this.find($comments__add).text() == "Написать комментарий") {
        $this.find($comments__add).text("Закрыть поле комментария");
        $this.find($comments__add).addClass("active");
        $this.find($comments__add).append("<span class=\"icon\">".concat($icon, "</span>"));
        $(".comments__item__reply").hide();
      } else {
        $this.find($comments__add).text("Написать комментарий");
        $this.find($comments__add).removeClass("active");
      }
    }); // comments__item__reply

    $(".comments__items").each(function () {
      $(".comments__item").each(function () {
        var $this = $(this);
        var $send__to = $(".send__to");
        var $comments__item__reply = $(".comments__item__reply");
        var $comments__item__reply_close = $(".comments__item__reply-close_btn");
        $this.find($send__to).on("click", function () {
          $this.children($comments__item__reply).show(300);

          if ($add__new_comment_form.css({
            display: "block"
          })) {
            $add__new_comment_form.css({
              display: "none"
            });
            $comments__add.text("Написать комментарий");
            $comments__add.removeClass("active");
          } else $add__new_comment_form.css({
            display: "none"
          });
        }); // close btn

        $this.find($comments__item__reply_close).on("click", function () {
          $this.find($comments__item__reply).hide(300);
        });
      });
    });
  }); // reviews__form-top--result

  var $result__tab_item = $(".result__tab-item");
  $result__tab_item.each(function () {
    var $this = $(this);
    $this.on("click", function () {
      $result__tab_item.removeClass("active");
      $result__tab_item.children().show();
      $this.addClass("active");
      $this.children().hide(); // $this.on("mouseover", function () {
      //     $this.children().show()
      //     $this.removeClass("active")
      // })
    });
    $(".delete_btn-js").on("click", function () {
      $(this).closest($result__tab_item).remove();
    });
  });
  $(".result__tabs--pseudo").on("click", function (e) {
    e.preventDefault();
  }); // scroll horizontal

  function scrollHorizontally(e) {
    e = window.event || e;
    var delta = Math.max(-1, Math.min(1, e.wheelDelta || -e.detail));
    document.querySelector('.reviews__form-top--result .result__tabs').scrollLeft -= delta * 300;
    e.preventDefault();
  }

  $(".reviews__form-top--result .result__tabs").on("mousewheel", scrollHorizontally); // modal

  function modal() {
    var openModalButtons = document.querySelectorAll("[data-modal-target]");
    var closeModalButtons = document.querySelectorAll("[data-close-button]");
    var html = document.getElementsByTagName("html")[0];
    var overlay = document.querySelectorAll("[data-overlay]");
    openModalButtons.forEach(function (button) {
      button.addEventListener("click", function (e) {
        e.preventDefault();
        var modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
        html.style.overflow = "hidden";
      });
    });
    overlay.forEach(function (button) {
      button.addEventListener("click", function () {
        var modals = document.querySelectorAll(".modal.active");
        modals.forEach(function (modal) {
          closeModal(modal);
        });
      });
    });
    closeModalButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var modal = button.closest(".modal");
        closeModal(modal);
      });
    });

    function openModal(modal) {
      if (modal == null) return;
      modal.classList.add("active");
    }

    function closeModal(modal) {
      if (modal == null) return;
      modal.classList.remove("active");
      html.style.overflow = "auto";
      html.style.overflowX = "hidden";
    }
  }

  modal();
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/solutions/solutions.js":
/*!***************************************************!*\
  !*** ./src/blocks/modules/solutions/solutions.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery, $) {jQuery(document).ready(function () {
  $('.solutions-card__circles_item').on('click', function () {
    $(this).removeClass('hide').addClass('show').siblings().removeClass('show').addClass('hide');
  });
  $('.contract__item').on('click', function () {
    $(this).removeClass('no-active').addClass('active').siblings().removeClass('active').addClass('no-active');
  });
  $('.closed-card').on('click', function () {
    $(this).parents('.solutions-card').addClass('hide');
  });
  $('.solutions-card__icon-plus').on('click', function () {
    $(this).parents('.solutions-card').removeClass('hide');
  });
  $('.select').on('click', '.select__head', function () {
    if ($(this).hasClass('open')) {
      $(this).removeClass('open');
      $(this).next().fadeOut();
    } else {
      $('.select__head').removeClass('open');
      $('.select__list').fadeOut();
      $(this).addClass('open');
      $(this).next().fadeIn();
    }
  });
  $(document).mouseup(function (e) {
    var div = $(".select__list");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.select__head').hasClass('open');
      $('.select__head').removeClass('open');
      $(div).fadeOut();
    }
  });
  $('.select').on('click', '.select__item', function () {
    $('.select__head').removeClass('open');
    $('.select__list').fadeOut();
    $(this).parents('.solutions-card__top_text-subtitle').prev().text($(this).find('.select__item_text').text());
    $(this).parents('.select__list').prev().siblings('.select__input').val($(this).find('.select__item_text').text());
  });
  $('.select').on('click', '.select__list-item_policy', function () {
    $('.select__head').removeClass('open');
    $('.select__list').fadeOut();
    $(this).parents('.solutions-card__top_text-subtitle').prev().text($(this).find('.policy-title p').text());
    $(this).parents('.solutions-card__top_text-subtitle').prev().siblings('p').text($(this).find('.policy').text());
    $(this).parents('.select__list').prev().siblings('.select__input').val($(this).find('.policy-title').text());
  });

  if ($(".card-one .solutions-card__info").children(".solutions-card__info_item").length > 5) {
    var el = $(".card-one .solutions-card__info").children(".solutions-card__info_item").slice(5, 100);
    $(".solutions-card__info-switch").css("display", "grid");
    el.addClass("hidden");
    $(".card-one .solutions-card__info-open").on("click", function () {
      $(".card-one .solutions-card__info").children(".solutions-card__info_item").removeClass("hidden");
      $(".card-one .solutions-card__info-close").css("display", "flex");
      $(".card-one .solutions-card__info-open").css("display", "none");
    });
    $(".card-one .solutions-card__info-close").on("click", function () {
      el.addClass("hidden");
      $(".card-one .solutions-card__info-close").css("display", "none");
      $(".card-one .solutions-card__info-open").css("display", "flex");
    });
  }

  try {
    var element = document.querySelectorAll('.solutions__bottom_column-select');

    if (element) {
      element.forEach(function (el) {
        var choices = new Choices(el, {
          searchEnabled: false,
          itemSelectText: ''
        });
      });
    }
  } catch (_unused) {}
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery"), __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/blocks/modules/subscribe/subscribe.js":
/*!***************************************************!*\
  !*** ./src/blocks/modules/subscribe/subscribe.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(jQuery) {jQuery(document).ready(function ($) {
  try {
    var select_time = document.querySelector('#time-choice');
    var choices = new Choices(select_time, {
      searchEnabled: false,
      itemSelectText: ''
    });
  } catch (_unused) {}
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./src/js/import/modules.js":
/*!**********************************!*\
  !*** ./src/js/import/modules.js ***!
  \**********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_header_header__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! %modules%/header/header */ "./src/blocks/modules/header/header.js");
/* harmony import */ var _modules_header_header__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_modules_header_header__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _modules_main_content_main_content__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! %modules%/main__content/main__content */ "./src/blocks/modules/main__content/main__content.js");
/* harmony import */ var _modules_main_content_main_content__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_modules_main_content_main_content__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _modules_footer_footer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! %modules%/footer/footer */ "./src/blocks/modules/footer/footer.js");
/* harmony import */ var _modules_footer_footer__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_modules_footer_footer__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _modules_loyalty_loyalty_program__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! %modules%/loyalty/loyalty_program */ "./src/blocks/modules/loyalty/loyalty_program.js");
/* harmony import */ var _modules_loyalty_loyalty_program__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_modules_loyalty_loyalty_program__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _modules_solutions_solutions__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! %modules%/solutions/solutions */ "./src/blocks/modules/solutions/solutions.js");
/* harmony import */ var _modules_solutions_solutions__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_modules_solutions_solutions__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _modules_rating_rating_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! %modules%/rating/rating.js */ "./src/blocks/modules/rating/rating.js");
/* harmony import */ var _modules_rating_rating_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_modules_rating_rating_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _modules_reviews_reviews__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! %modules%/reviews/reviews */ "./src/blocks/modules/reviews/reviews.js");
/* harmony import */ var _modules_reviews_reviews__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_modules_reviews_reviews__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _modules_review_review__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! %modules%/review/review */ "./src/blocks/modules/review/review.js");
/* harmony import */ var _modules_review_review__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_modules_review_review__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _modules_insurance_insurance__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! %modules%/insurance/insurance */ "./src/blocks/modules/insurance/insurance.js");
/* harmony import */ var _modules_insurance_insurance__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_modules_insurance_insurance__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var _modules_complect_complect__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! %modules%/complect/complect */ "./src/blocks/modules/complect/complect.js");
/* harmony import */ var _modules_complect_complect__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(_modules_complect_complect__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var _modules_bonuses_bonuses__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! %modules%/bonuses/bonuses */ "./src/blocks/modules/bonuses/bonuses.js");
/* harmony import */ var _modules_bonuses_bonuses__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(_modules_bonuses_bonuses__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var _modules_modal_modal__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! %modules%/modal/modal */ "./src/blocks/modules/modal/modal.js");
/* harmony import */ var _modules_modal_modal__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(_modules_modal_modal__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var _modules_addSensors_addSensors__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! %modules%/addSensors/addSensors */ "./src/blocks/modules/addSensors/addSensors.js");
/* harmony import */ var _modules_addSensors_addSensors__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(_modules_addSensors_addSensors__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var _modules_installment_installment__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! %modules%/installment/installment */ "./src/blocks/modules/installment/installment.js");
/* harmony import */ var _modules_installment_installment__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(_modules_installment_installment__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var _modules_complect_obor_complect_obor__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! %modules%/complect_obor/complect_obor */ "./src/blocks/modules/complect_obor/complect_obor.js");
/* harmony import */ var _modules_complect_obor_complect_obor__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(_modules_complect_obor_complect_obor__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var _modules_ready_des_ready_des__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! %modules%/ready-des/ready-des */ "./src/blocks/modules/ready-des/ready-des.js");
/* harmony import */ var _modules_ready_des_ready_des__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(_modules_ready_des_ready_des__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var _modules_ready_des2_ready_des2__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! %modules%/ready-des2/ready-des2 */ "./src/blocks/modules/ready-des2/ready-des2.js");
/* harmony import */ var _modules_ready_des2_ready_des2__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(_modules_ready_des2_ready_des2__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var _modules_subscribe_subscribe__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! %modules%/subscribe/subscribe */ "./src/blocks/modules/subscribe/subscribe.js");
/* harmony import */ var _modules_subscribe_subscribe__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(_modules_subscribe_subscribe__WEBPACK_IMPORTED_MODULE_17__);
/* harmony import */ var _modules_autorisation_autorisation__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! %modules%/autorisation/autorisation */ "./src/blocks/modules/autorisation/autorisation.js");
/* harmony import */ var _modules_autorisation_autorisation__WEBPACK_IMPORTED_MODULE_18___default = /*#__PURE__*/__webpack_require__.n(_modules_autorisation_autorisation__WEBPACK_IMPORTED_MODULE_18__);




















/***/ }),

/***/ "./src/js/index.js":
/*!*************************!*\
  !*** ./src/js/index.js ***!
  \*************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _import_modules__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./import/modules */ "./src/js/import/modules.js");


/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ })

/******/ });
//# sourceMappingURL=main.js.map