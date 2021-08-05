"use strict";

jQuery(document).ready(function ($) {
  // header burger
  $(".header__top-menu").on("click", function () {
    $('.header__top').addClass("header__top--open");
    $('.header__submenu').addClass("header__submenu--open");
    $(".header__wall").css({
      'display': 'block'
    });
  });
  $(".header__submenu-close, .header__wall, .header__top-menu--open").on("click", function () {
    $('.header__top').removeClass("header__top--open");
    $('.header__submenu').removeClass("header__submenu--open");
    $(".header__wall").css({
      'display': 'none'
    });
  });
  $(".header__submenu-question-yes").on("click", function () {
    $(".header__submenu-question").css({
      'opacity': '0'
    });
  }); // modal

  function modal() {
    var openModalButtons = document.querySelectorAll("[data-modal-target]");
    var closeModalButtons = document.querySelectorAll("[data-close-button]");
    var body = document.body;
    openModalButtons.forEach(function (button) {
      button.addEventListener("click", function (e) {
        e.preventDefault();
        var modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
        body.style.overflow = "hidden";
      });
    });
    closeModalButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var modal = button.closest(".modal");
        closeModal(modal);
      });
    });

    function openModal(modal) {
      if (modal == null) return;
      modal.classList.add("active");
    }

    function closeModal(modal) {
      if (modal == null) return;
      modal.classList.remove("active");
      body.style.overflow = "auto";
      body.style.overflowX = "hidden";
    }
  }

  modal(); // js-select
  // let select = document.querySelector('#header__select_town-js')
  // new Choices(select, {
  //     searchEnabled: false,
  //     itemSelectText: '',
  // });
});