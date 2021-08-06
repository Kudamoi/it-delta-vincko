"use strict";

$(document).ready(function () {
  try {
    var scrollFixCard = function scrollFixCard() {
      if (window.pageYOffset >= sticky) {
        fixCard.classList.add("fix");
      } else {
        fixCard.classList.remove("fix");
      }
    };

    $(".show-details").on("click", function () {
      $(".show-details").addClass("hidden");
      $(".hide-details").removeClass("hidden");
      $(".products__max-payment").removeClass("hidden");
      $(".products__payment").removeClass("hidden");
      $(".short-ins__head").removeClass("hidden");
      $(".ready-pack__mid").removeClass("hidden");
      $(".short-rd__price").removeClass("hidden");
      $(".short-rd__footer").removeClass("hidden");
      $(".ready-pack__top-title .price").addClass("hidden");
      $(".short-ins-mobile .price").addClass("hidden");
    });
    $(".hide-details").on("click", function () {
      $(".show-details").removeClass("hidden");
      $(".hide-details").addClass("hidden");
      $(".products__max-payment").addClass("hidden");
      $(".products__payment").addClass("hidden");
      $(".short-ins__head").addClass("hidden");
      $(".ready-pack__mid").addClass("hidden");
      $(".short-rd__price").addClass("hidden");
      $(".short-rd__footer").addClass("hidden");
      $(".ready-pack__top-title .price").removeClass("hidden");
      $(".short-ins-mobile .price").removeClass("hidden");
    });
    $("#label-view-agree").on("click", function () {
      if ($("#label-view-agree").hasClass("hide")) $("#label-view-agree").removeClass("hide");else $("#label-view-agree").addClass("hide");
    });
    $("#label-view-agree-two").on("click", function () {
      if ($("#label-view-agree-two").hasClass("hide")) $("#label-view-agree-two").removeClass("hide");else $("#label-view-agree-two").addClass("hide");
    });

    window.onscroll = function () {
      scrollFixCard();
    };

    var fixCard = document.getElementById("fix-card");
    var sticky = fixCard.offsetTop;
  } catch (_unused) {}
});