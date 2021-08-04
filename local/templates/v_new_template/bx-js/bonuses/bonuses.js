"use strict";

$("#useless").on("click", function () {
  $(".useless-modal").addClass("vis");
});
$(".useless-modal__close").on("click", function () {
  $(".useless-modal").removeClass("vis");
});

if ($(window).width() <= '767') {
  $('.useless-modal__text').attr('placeholder', 'Напишите Ваши' + '\n' + 'пожелания');
  $('.useless-modal__text').attr('rows', '3');
}