"use strict";

$(document).ready(function () {
  function openNextBlock(blockOpen, btn, complete, required) {
    blockOpen.classList.remove('def-close');
    btn.classList.add('hidden');
    complete.classList.remove('hidden');
    required.classList.add('hidden');
    required.parentElement.parentElement.style.paddingTop = "16px";
  }

  var formsIO = document.getElementsByClassName('form');
  var btnnsIO = $('.form__next-button');
  var complete = $('.form__complete');
  var required = $('.form__required');

  try {
    btnnsIO[0].addEventListener("click", function () {
      openNextBlock(formsIO[1], btnnsIO[0], complete[0], required[0]);
    });

    if (formsIO.length >= 3) {
      btnnsIO[1].addEventListener("click", function () {
        openNextBlock(formsIO[2], btnnsIO[1], complete[1], required[1]);
      });
    }

    var cardRadio = document.getElementById("card-radio");
    var installmentRadio = document.getElementById("installment-radio");
    cardRadio.addEventListener("click", function () {
      document.getElementsByClassName("payment-method__card")[0].classList.add("active");
      document.getElementsByClassName("payment-method__installment")[0].classList.remove("active");
    });
    installmentRadio.addEventListener("click", function () {
      document.getElementsByClassName("payment-method__card")[0].classList.remove("active");
      document.getElementsByClassName("payment-method__installment")[0].classList.add("active");
    });
  } catch (_unused) {}
});