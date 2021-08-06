"use strict";

$(document).ready(function () {
  $('.slick-slider-reviews').slick({
    // variableWidth: true,
    arrows: true,
    slidesToShow: 1,
    prevArrow: "\n\t\t\t\t<div class=\"arrow-prev arrow\">\n\t\t\t\t\t<picture>\n\t\t\t\t\t\t<img src=\"../img/norating/prevArrow.png\">\n\t\t\t\t\t</picture>\n\t\t\t\t</div>",
    nextArrow: "<div class=\"arrow-next arrow\">\n\t\t\t\t\t\t<picture>\n\t\t\t\t\t\t\t<img src=\"../img/norating/nextArrow.png\">\n\t\t\t\t\t\t</picture>\n\t\t\t\t\t</div>",
    infinity: true
  });

  if (window.innerWidth <= 760) {
    $('.open__for-items').slick({
      slidesToShow: 1,
      variableWidth: false,
      arrows: true,
      prevArrow: "\n\t\t\t\t<div class=\"arrow-prev arrow\">\n\t\t\t\t\t<picture>\n\t\t\t\t\t\t<img src=\"../img/norating/prevArrow.png\">\n\t\t\t\t\t</picture>\n\t\t\t\t</div>",
      nextArrow: "<div class=\"arrow-next arrow\">\n\t\t\t\t\t\t<picture>\n\t\t\t\t\t\t\t<img src=\"../img/norating/nextArrow2.png\">\n\t\t\t\t\t\t</picture>\n\t\t\t\t\t</div>",
      infinite: false
    });
  } else if (window.innerWidth <= 768) {
    $('.open__for-items').slick({
      slidesToShow: 2.15,
      variableWidth: false,
      arrows: true,
      prevArrow: "\n\t\t\t\t<div class=\"arrow-prev arrow\">\n\t\t\t\t\t<picture>\n\t\t\t\t\t\t<img src=\"../img/norating/prevArrow.png\">\n\t\t\t\t\t</picture>\n\t\t\t\t</div>",
      nextArrow: "<div class=\"arrow-next arrow\">\n\t\t\t\t\t\t<picture>\n\t\t\t\t\t\t\t<img src=\"../img/norating/nextArrow2.png\">\n\t\t\t\t\t\t</picture>\n\t\t\t\t\t</div>",
      infinite: false
    });
  }

  $(".range-1").slider({
    min: 1,
    max: 12,
    step: 1,
    range: "min",
    animate: "slow",
    slide: function slide(event, ui) {
      $(".calculator-sub-value-1").html(ui.value);
      $(".range__number-1").html(ui.value);
    }
  });
  $(".range-2").slider({
    min: 1,
    max: 12,
    step: 1,
    range: "min",
    animate: "slow",
    slide: function slide(event, ui) {
      $(".calculator-sub-value-2").html(ui.value);
      $(".range__number-2").html(ui.value);
    }
  });

  try {
    var el = document.querySelector('#norating-cities');
    var choices = new Choices(el, {
      searchEnabled: false,
      itemSelectText: ''
    });
  } catch (_unused) {}

  $(document).mouseup(function (e) {
    var div = $(".company-info-card .rating-center .itemRating-open");
    var div2 = $(".company-info-card .rating-center .rating-center__item-wrapper");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $(div).addClass('show');
      $(div2).addClass('item-rating-active');
    }
  });
  /* type of secure objects tabs */

  tabsChange();
  $(".company-info-card__content-form").on("click", function () {
    tabsChange();
  });

  function tabsChange() {
    if ($("#secureChoice1").is(':checked')) {
      $(".block__tab").removeClass("checked");
      $(".block__tab--flat").addClass("checked");
    } else if ($("#secureChoice2").is(':checked')) {
      $(".block__tab").removeClass("checked");
      $(".block__tab--house").addClass("checked");
    } else if ($("#secureChoice3").is(':checked')) {
      $(".block__tab").removeClass("checked");
      $(".block__tab--commercial").addClass("checked");
    }
  }

  $(".solutions-card__switch-btn--open").on("click", function () {
    $(".installment__right-column").css("right", "-10px");
    $(".solutions-card__switch-btn--open").removeClass("show");
    $(".solutions-card__switch-btn--close").addClass("show");
  });
  $(".solutions-card__switch-btn--close, .solutions-card__close").on("click", function () {
    $(".installment__right-column").css("right", "-364px");
    $(".solutions-card__switch-btn--close").removeClass("show");
    $(".solutions-card__switch-btn--open").addClass("show");
  });
});