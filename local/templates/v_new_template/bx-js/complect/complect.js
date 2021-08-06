"use strict";

if (!document.querySelector('.complect__slider')) {} else {
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
    prevArrow: '<div class="modal-arrow arrow-prev-mini arrow-mini"><img src="/upload/images/arrows/modal-prev.svg"></div>',
    nextArrow: '<div class="modal-arrow arrow-next-mini arrow-mini"><img src="/upload/images/arrows/modal-next.svg"></div>'
  });
  var slide = document.querySelectorAll('.modal-slider .slick-slide'),
      slideBottom = document.querySelectorAll('.modal-bottom .item'),
      modalArrow = document.querySelectorAll('.modal-arrow'),
      modal = document.querySelector('.slide-modal'),
      modalTrigger = document.querySelectorAll('.modal-btn'),
      modalClose = modal.querySelector('.close');
  modalTrigger.forEach(function (item) {
    item.addEventListener('click', function () {
      var modWindow = $('.slide-modal[data-slider-info=' + $(this).attr("data-key") + ']');
      $(modWindow).addClass('active');
      var dataModal = $('.slide-modal.active .modal-slider .slick-current').attr('data-modal-slide');
      $('.slide-modal.active .modal-bottom .item').removeClass('active');
      $('.slide-modal.active .modal-bottom .item').eq(dataModal - 1).addClass('active');
      console.log($('.slide-modal.active .modal-bottom .item:eq(' + dataModal + ')'));
    });
  });
  $('.close').on('click', function () {
    var closeWindow = $('.slide-modal[data-slider-info=' + $(this).attr('data-close') + ']');
    $(closeWindow).removeClass('active');
    $('.modal-slider .slick-active').removeClass('slick-active');
  });
  document.addEventListener('click', function (e) {
    if (e.target == modal && modal.classList.contains('active')) {
      modal.classList.remove('active');
    }
  });
  $('.modal-slider').each(function () {
    $(this).find('.slick-slide').each(function (index) {
      $(this).attr('data-modal-slide', index);
    });
  });
  $('.modal-bottom').each(function () {
    $(this).find('.item').each(function (index) {
      $(this).attr('data-modal-slide', index + 1);
    });
  }); //  slide.forEach(function (item, i) {
  //    item.setAttribute('data-modal-slide', i);
  //  });
  //  slideBottom.forEach(function (item, i) {
  //    item.setAttribute('data-modal-slide', i + 1);
  //  });

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