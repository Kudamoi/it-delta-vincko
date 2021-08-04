"use strict";

$(document).ready(function () {
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
  var btnns = $('.form__button-open-next');

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