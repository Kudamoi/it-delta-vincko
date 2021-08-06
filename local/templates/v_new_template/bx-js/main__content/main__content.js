"use strict";

jQuery(document).ready(function () {
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
    arrows: true,
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