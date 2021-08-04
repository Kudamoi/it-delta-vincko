"use strict";

jQuery(document).ready(function ($) {
  try {
    var select_time = document.querySelector('#time-choice');
    var choices = new Choices(select_time, {
      searchEnabled: false,
      itemSelectText: ''
    });
  } catch (_unused) {}
});