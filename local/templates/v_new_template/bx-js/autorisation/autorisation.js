"use strict";

$(document).ready(function () {
  var regNumber = 0;

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
      parent.find(".popup__form--" + switcher + " .grey-border-button--unactive").removeClass("grey-border-button--unactive");
      parent.find(".popup__form--" + switcher + " .grey-border-button").addClass("grey-border-button--active");
      parent.find(".popup__form-mod--" + switcher + " .send-message-btn").on("click", function () {
        sendCodeFunc(parent, switcher);
      });
    } else {
      parent.find(".popup__form--" + switcher + " .grey-border-button").addClass("grey-border-button--unactive");
      parent.find(".popup__form--" + switcher + " .grey-border-button").removeClass("grey-border-button--active");
    }
  }

  function sendCodeFunc(parent, switcher) {
    parent.find(".popup__form--" + switcher + " .grey-border-button").css("display", "none");
    parent.find(".popup__form--" + switcher + " .popup__code").css("display", "block");
    var parent1 = parent.find(".popup__form--" + switcher);
    var input1 = parent1.find("." + switcher + "-input");
    input1.attr("readonly", "readonly");
    timer(parent1);
  }

  function regShowBtn() {
    var parent = $(".popup--registration");
    console.log(parent.find(".text-field").inputmask("isComplete"));
    console.log(regNumber);
    console.log($("#agree")[0].checked);
    var texts = 1;
    parent.find(".text-field").each(function (index) {
      if (!$(this).inputmask("isComplete")) {
        texts = 0;
      }
    });

    if (texts == 1 && regNumber == 1 && $("#agree")[0].checked) {
      parent.find(".btn-registration").removeClass("btn-registration--unactive");
    } else {
      parent.find(".btn-registration").addClass("btn-registration--unactive");
    }
  }

  var selector = document.getElementsByClassName("phone-input");
  var popupers = $(".popup");
  popupers.each(function (index) {
    $("input").keyup(function () {
      if (parent.hasClass("popup--registration")) {
        regShowBtn();
      }
    });
    var parent = $(this);
    var phone = parent.find(".phone-input");
    var email = parent.find(".mail-input");
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
    var parent1 = parent.find(".popup__form--phone");
    var parent2 = parent.find(".popup__form--mail");
    parent1.find(".popup__code").mask("999999", {
      completed: function completed() {
        parent1.find(".popup__send-code").css("display", "grid");
      }
    });
    parent1.find(".popup__code").mask("999999", {
      completed: function completed() {
        parent1.find(".popup__send-code").css("display", "grid");
      }
    });
    parent2.find(".popup__code").mask("999999", {
      completed: function completed() {
        parent2.find(".popup__send-code").css("display", "grid");
      }
    });
    parent1.find(".popup__send-code").on("click", function () {
      if (parent.hasClass("popup--registration")) {
        regNumber = 1;
        regShowBtn();
      }

      parent1.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
      parent1.find(".popup__wait").css("opacity", "0");
      parent1.find(".popup__wait-time").css("display", "block");
      parent1.find(".popup__success").css("display", "flex");
      parent1.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
      parent1.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
    });
    parent2.find(".popup__send-code").on("click", function () {
      if (parent.hasClass("popup--registration")) {
        regNumber = 1;
        regShowBtn();
      }

      parent2.find(".popup__send-code, .popup__code,  .popup__wait-repeat").css("display", "none");
      parent2.find(".popup__wait").css("opacity", "0");
      parent2.find(".popup__wait-time").css("display", "block");
      parent2.find(".popup__success").css("display", "flex");
      parent2.find(".popup--forget .popup__bottom .blue-button").removeClass("blue-button--unactive");
      parent2.find(".popup--forget .popup__bottom .blue-button").addClass("blue-button--active");
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
  $("#agree").on("click", function () {
    regShowBtn();
  });
  $(".pass-input").inputmask({
    regex: "[1-9A-Za-z!@$%^&*()_+-]{8,}",
    showMaskOnHover: false
  });
  /*  $(".pass-input").inputmask("+7(999) 999-9999");*/

  $(".btn-registration").on("click", function () {
    if (!$(".btn-registration").hasClass("btn-registration--unactive")) {
      $(".popup").addClass("hidden");
      $(".popup--login").removeClass("hidden");
    }
  });
});