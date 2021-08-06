"use strict";

// js-select
var modalSelect_Ready_des = function modalSelect_Ready_des() {
  var select_ready_des = document.querySelectorAll(".ready__des_select-js");

  if (select_ready_des) {
    select_ready_des.forEach(function (el) {
      var choices = new Choices(el, {
        searchEnabled: false,
        itemSelectText: ''
      });
    });
  }
};

modalSelect_Ready_des();