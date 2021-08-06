"use strict";

$(document).ready(function () {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!

  var yyyy = today.getFullYear();

  if (dd < 10) {
    dd = '0' + dd;
  }

  if (mm < 10) {
    mm = '0' + mm;
  }

  today = yyyy + '-' + mm + '-' + dd;
  var dates = document.getElementsByClassName("date");

  for (var i = 0; i < dates.length; i++) {
    dates[i].setAttribute("max", today);

    if (browser_name() === "Chrome" && !dates[i].classList.contains("date-install")) {
      dates[i].onmouseover = function () {
        this.type = 'date';
      };

      dates[i].onmouseout = function () {
        if (!this.value) this.type = 'text';
      };
    }
  }

  $('.text-field').inputmask({
    regex: "[A-ZА-Яa-zа-я-]+",
    showMaskOnHover: false
  });
  $('.address-field').inputmask({
    regex: "[A-ZА-Яa-zа-я-.,:]+",
    showMaskOnHover: false
  });
  $('.street-field').inputmask({
    regex: "[A-ZА-Яa-zа-я-.,:/]+",
    showMaskOnHover: false
  });
  $('.house-field').inputmask({
    regex: "[1-9]+[A-ZА-Яa-zа-я-]+",
    showMaskOnHover: false
  });
  $('.housing-field').inputmask({
    regex: "[1-9A-ZА-Яa-zа-я-]+",
    showMaskOnHover: false
  });
  $('.flat-field').inputmask({
    regex: "[1-9]+",
    showMaskOnHover: false
  });
  $('.birthday-field').inputmask({
    alias: "datetime",
    inputFormat: "dd/mm/yyyy",
    showMaskOnHover: false
  });
  $('#email-field').inputmask("email", {
    showMaskOnHover: false,
    positionCaretOnClick: "radixFocus"
  });
  $('.email-field').inputmask("email", {
    showMaskOnHover: false,
    positionCaretOnClick: "radixFocus"
  });
  $('#phone-field').inputmask("+7(999) 999-9999", {
    showMaskOnHover: false
  });
  $('.phone-field').inputmask("+7(999) 999-9999", {
    showMaskOnHover: false
  });
  $('#passport').inputmask("99 99 999999", {
    showMaskOnHover: false
  });
  $('#code').inputmask("999-999", {
    showMaskOnHover: false
  });
  $('#inn').inputmask("9999 9999 9999", {
    showMaskOnHover: false
  });
  $('.index-field').inputmask("999999", {
    showMaskOnHover: false
  });

  function browser_name() {
    var browser_id = navigator.userAgent; // перечень условий

    if (browser_id.search(/Chrome/) != -1) return 'Chrome';
    if (browser_id.search(/Firefox/) != -1) return 'Firefox';
    if (browser_id.search(/Opera/) != -1) return 'Opera';
    if (browser_id.search(/Safari/) != -1) return 'Safari';
    if (browser_id.search(/MSIE/) != -1) return 'Internet Explorer';
    return 'Не определен';
  }
});