"use strict";

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