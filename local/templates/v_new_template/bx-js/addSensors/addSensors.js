"use strict";

$(".price__bonuses-info").on("click", function () {
  $(".price__bonuses-info-m").addClass("vis");
  $(".price__bonuses-close").addClass("vis");
  $(".section-result__price-bonuses-container").addClass("vis");
  $(".section-result__price-rub-container").removeClass("vis");
  $(".price__bonuses-info").removeClass("vis");
  $(".installment__calculator-left").removeClass("vis");
  $(".price__bonuses").addClass("h-full");
  $(".installment__calculator").addClass("border-vis");
  $(".installment .price__result").removeClass("vis");
});
$(".price__bonuses-close").on("click", function () {
  $(".price__bonuses-info-m").removeClass("vis");
  $(".price__bonuses-close").removeClass("vis");
  $(".section-result__price-bonuses-container").removeClass("vis");
  $(".section-result__price-rub-container").addClass("vis");
  $(".price__bonuses-info").addClass("vis");
  $(".installment__calculator-left").addClass("vis");
  $(".installment__calculator").removeClass("border-vis");
  $(".price__bonuses").removeClass("h-full");
  $(".installment .price__result").addClass("vis");
});

function closeOpenBlock2(blockSelector, btnSelector, btnSelector2) {
  var block = document.querySelector(blockSelector),
      btn = document.querySelector(btnSelector);
  btn2 = document.querySelector(btnSelector2);

  if (btn) {
    btn.addEventListener('click', function () {
      if (block.classList.contains('close')) {
        block.classList.remove('close');
        btn2.innerHTML = 'Свернуть';
      } else {
        block.classList.add('close');
        btn2.innerHTML = 'Развернуть';
      }
    });
  }
}

closeOpenBlock2('.slider__under-block-1', '.slider__under-title', '.close-btn');
closeOpenBlock2('.slider__under-block-1', '.close-btn-3', '.close-btn');