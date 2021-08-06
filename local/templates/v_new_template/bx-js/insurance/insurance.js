"use strict";

$(document).ready(function () {
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