"use strict";

jQuery(document).ready(function () {
  $('.solutions-card__circles_item').on('click', function () {
    $(this).removeClass('hide').addClass('show').siblings().removeClass('show').addClass('hide');
  });
  $('.contract__item').on('click', function () {
    $(this).removeClass('no-active').addClass('active').siblings().removeClass('active').addClass('no-active');
  });
  $('.closed-card').on('click', function () {
    $(this).parents('.solutions-card').addClass('hide');
  });
  $('.solutions-card__icon-plus').on('click', function () {
    $(this).parents('.solutions-card').removeClass('hide');
  });
  $('.select').on('click', '.select__head', function () {
    if ($(this).hasClass('open')) {
      $(this).removeClass('open');
      $(this).next().fadeOut();
    } else {
      $('.select__head').removeClass('open');
      $('.select__list').fadeOut();
      $(this).addClass('open');
      $(this).next().fadeIn();
    }
  });
  $(document).mouseup(function (e) {
    var div = $(".select__list");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.select__head').hasClass('open');
      $('.select__head').removeClass('open');
      $(div).fadeOut();
    }
  });
  $('.select').on('click', '.select__item', function () {
    $('.select__head').removeClass('open');
    $('.select__list').fadeOut();
    $(this).parents('.solutions-card__top_text-subtitle').prev().text($(this).find('.select__item_text').text());
    $(this).parents('.select__list').prev().siblings('.select__input').val($(this).find('.select__item_text').text());
  });
  $('.select').on('click', '.select__list-item_policy', function () {
    $('.select__head').removeClass('open');
    $('.select__list').fadeOut();
    $(this).parents('.solutions-card__top_text-subtitle').prev().text($(this).find('.policy-title p').text());
    $(this).parents('.solutions-card__top_text-subtitle').prev().siblings('p').text($(this).find('.policy').text());
    $(this).parents('.select__list').prev().siblings('.select__input').val($(this).find('.policy-title').text());
  });

  if ($(".card-one .solutions-card__info").children(".solutions-card__info_item").length > 5) {
    var el = $(".card-one .solutions-card__info").children(".solutions-card__info_item").slice(5, 100);
    $(".solutions-card__info-switch").css("display", "grid");
    el.addClass("hidden");
    $(".card-one .solutions-card__info-open").on("click", function () {
      $(".card-one .solutions-card__info").children(".solutions-card__info_item").removeClass("hidden");
      $(".card-one .solutions-card__info-close").css("display", "flex");
      $(".card-one .solutions-card__info-open").css("display", "none");
    });
    $(".card-one .solutions-card__info-close").on("click", function () {
      el.addClass("hidden");
      $(".card-one .solutions-card__info-close").css("display", "none");
      $(".card-one .solutions-card__info-open").css("display", "flex");
    });
  }

  try {
    var element = document.querySelectorAll('.solutions__bottom_column-select');

    if (element) {
      element.forEach(function (el) {
        var choices = new Choices(el, {
          searchEnabled: false,
          itemSelectText: ''
        });
      });
    }
  } catch (_unused) {}
});