"use strict";

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