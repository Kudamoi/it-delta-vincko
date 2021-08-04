"use strict";

// "use strict"
jQuery(document).ready(function ($) {
  // js-select
  var modalSelect = function modalSelect() {
    var modalSelect = document.querySelector("[data-select-modal]");

    if (modalSelect) {
      var choices = new Choices(modalSelect, {
        searchEnabled: false,
        itemSelectText: ''
      });
    }
  };

  modalSelect();

  var sortrSelect = function sortrSelect() {
    var sortSelect = document.querySelector("[data-select-sort]");

    if (sortSelect) {
      var choices = new Choices(sortSelect, {
        searchEnabled: false,
        itemSelectText: '',
        classNames: {// list: 'sort__choices__list',
        }
      });
    }
  };

  sortrSelect(); // js-select end    
  // open__form

  var $hiddenForm = $(".reviews__form-top--hidden");
  $(".pseudo__search,.pseudo__range,.text-js").mousedown(function () {
    $(".reviews__form-top").addClass("active");
    $hiddenForm.addClass("active");
    $(".text-js").addClass("active");
  }); // close form

  $(".close-js").on("click", function () {
    $(".reviews__form-top").removeClass("active");
    $hiddenForm.removeClass("active");
    $(".text-js").removeClass("active");
  });
  $(document).mouseup(function (e) {
    var $form = $(".reviews__form-top");

    if ($form.has(e.target).length === 0) {
      $(".reviews__form-top").removeClass("active");
      $hiddenForm.removeClass("active");
      $(".text-js").removeClass("active");
    }
  }); // reviews__form-top--submit
  // let $reviews__form__submit = $(".reviews__form-top--submit")
  // let $reviews__form__result = $(".reviews__form-top--result")
  // $reviews__form__submit.on("click", function (e) {
  //     e.preventDefault()
  //     $reviews__form__result.show(300)
  // })
  // filter_city

  $("#filter_city-js").on("keyup", function () {
    var $value = $(this).val().toLowerCase();
    $(".left__filter_city-items li").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf($value) > -1);
    });
  }); // form filter 
  // all checkbox

  var $btnAllCenter = $("#center__all_item-js");
  var $btnAllRight = $("#right__all_item-js");
  var $center__not_selected = $(".reviews__form-top--hidden .center__not_selected");
  var $center__selected = $(".reviews__form-top--hidden .center__selected");
  var $right__selected = $(".reviews__form-top--hidden .right__top");
  var $right__not_selected = $(".reviews__form-top--hidden .right__bottom");

  function clone(selected, not__selected) {
    selected.html(not__selected.find("label").clone(true));
    selected.prepend("<span>Выбраны</span>");
  }

  $btnAllCenter.on("click", function () {
    $center__selected.show(100);
    clone($center__selected, $center__not_selected);

    if ($(this).is(':checked')) {
      $(".reviews__form-top--hidden .center__not_selected input:checkbox").attr('checked', true);
    } else {
      $(".reviews__form-top--hidden .center__not_selected input:checkbox").attr('checked', false);
      $center__selected.children("label").remove();
      $center__selected.hide(100);
    }
  });
  $btnAllRight.on("click", function () {
    $right__selected.show(100);
    clone($right__selected, $right__not_selected);

    if ($(this).is(':checked')) {
      $(".reviews__form-top--hidden .right__bottom input:checkbox").attr('checked', true);
    } else {
      $(".reviews__form-top--hidden .right__bottom input:checkbox").attr('checked', false);
      $right__selected.children("label").remove();
      $right__selected.hide(100);
    }
  });
  $(document).on("change", function () {
    var $center__selected_input = $(".reviews__form-top--hidden .center__selected input:checkbox");
    var $right__selected_input = $(".reviews__form-top--hidden .right__top input:checkbox");
    $center__selected_input.each(function () {
      if ($center__selected_input.attr(":checked") != "checked") {
        $(this).attr('checked', true);
      }
    });
    $right__selected_input.each(function () {
      if ($right__selected_input.attr(":checked") != "checked") {
        $(this).attr('checked', true);
      }
    });

    if ($center__selected_input) {
      $center__selected_input.parent('label').on("click", function () {
        var $this = $(this);
        $this.remove();
      });
    }

    if ($right__selected_input) {
      $right__selected_input.parent('label').on("click", function () {
        var $this = $(this);
        $this.remove();
      });
    }
  });
  $center__not_selected.on("click", "input:checkbox", function () {
    var $this = $(this);

    if ($this.is(':checked')) {
      var $parent = $this.parent();
      $center__selected.show(100);
      $center__selected.append("<label class=\"center__selected-label\">".concat($parent.html(), "</label>"));
    }
  });
  $right__not_selected.on("click", "input:checkbox", function () {
    var $this = $(this);

    if ($this.is(':checked')) {
      var $parent = $this.parent();
      $right__selected.show(100);
      $right__selected.append("<label class=\"center__selected-label\">".concat($parent.html(), "</label>"));
    }
  }); // form filter end
  // range filter

  var $range = $("#pseudo__range");
  $range.addClass("all");
  $range.on("input change", function () {
    var $value = $(this).val();
    var $text = $(".pseudo__range-text__select");

    if ($value >= 2 && $value <= 3) {
      $text.html("Низкий");
      $text.css({
        color: "#FF5252"
      });
      $range.removeClass();
      $range.addClass("red");
    } else if ($value >= 4 && $value <= 6) {
      $text.html("Средний");
      $text.css({
        color: "#FFC85C"
      });
      $range.removeClass();
      $range.addClass("yellow");
    } else if ($value >= 7 && $value <= 10) {
      $text.html("Высокий");
      $text.css({
        color: "#31CB40"
      });
      $range.removeClass();
      $range.addClass("green");
    } else {
      $text.html("Любой");
      $text.css({
        color: "#93B6FF"
      });
      $range.removeClass();
      $range.addClass("all");
    }
  }); // reviews__item add new review

  $(".reviews__item").each(function () {
    var $this = $(this);
    var $btn = $(".comment__btn-js");
    var $comments = $(".reviews__item__comments");
    var $btnClose = $(".comments__close_btn-js");
    var $comments__add = $(".add__new_comment-js");
    var $add__new_comment_form = $(".add__new_comment-form");
    var $icon = "<svg width=\"13\" height=\"12\" viewBox=\"0 0 13 12\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M7.38173 5.9864L12.3557 1.0257C12.454 0.911231 12.5054 0.76398 12.4996 0.613378C12.4937 0.462776 12.4311 0.319916 12.3243 0.213345C12.2174 0.106774 12.0742 0.0443419 11.9232 0.0385248C11.7722 0.0327077 11.6245 0.0839342 11.5097 0.181967L6.53573 5.14266L1.56173 0.175983C1.44874 0.063303 1.29551 0 1.13573 0C0.975945 0 0.822708 0.063303 0.709726 0.175983C0.596744 0.288663 0.533271 0.44149 0.533271 0.600844C0.533271 0.760197 0.596744 0.913024 0.709726 1.0257L5.68973 5.9864L0.709726 10.9471C0.646917 11.0007 0.595905 11.0668 0.559891 11.141C0.523877 11.2152 0.503639 11.2961 0.500447 11.3785C0.497255 11.4609 0.511179 11.5431 0.541343 11.6199C0.571508 11.6967 0.617263 11.7664 0.675736 11.8247C0.734209 11.8831 0.804137 11.9287 0.881132 11.9588C0.958127 11.9889 1.04053 12.0027 1.12316 11.9996C1.20579 11.9964 1.28687 11.9762 1.36131 11.9403C1.43575 11.9044 1.50194 11.8535 1.55573 11.7908L6.53573 6.83014L11.5097 11.7908C11.6245 11.8889 11.7722 11.9401 11.9232 11.9343C12.0742 11.9285 12.2174 11.866 12.3243 11.7595C12.4311 11.6529 12.4937 11.51 12.4996 11.3594C12.5054 11.2088 12.454 11.0616 12.3557 10.9471L7.38173 5.9864Z\" fill=\"#A0A0A0\"/></svg>";
    var $body_item = $(".reviews__item__body");
    $this.find($btn).on("click", function () {
      $this.find($comments).show(0);
      $this.find($body_item).addClass("hide");
    });
    $this.find($btnClose).on("click", function () {
      $this.find($comments).hide();
      $this.find($body_item).removeClass("hide");
    });
    $this.find($comments__add).on("click", function () {
      $this.find($add__new_comment_form).toggle(300);

      if ($this.find($comments__add).text() == "Написать комментарий") {
        $this.find($comments__add).text("Закрыть поле комментария");
        $this.find($comments__add).addClass("active");
        $this.find($comments__add).append("<span class=\"icon\">".concat($icon, "</span>"));
        $(".comments__item__reply").hide();
      } else {
        $this.find($comments__add).text("Написать комментарий");
        $this.find($comments__add).removeClass("active");
      }
    }); // comments__item__reply

    $(".comments__items").each(function () {
      $(".comments__item").each(function () {
        var $this = $(this);
        var $send__to = $(".send__to");
        var $comments__item__reply = $(".comments__item__reply");
        var $comments__item__reply_close = $(".comments__item__reply-close_btn");
        $this.find($send__to).on("click", function () {
          $this.children($comments__item__reply).show(300);

          if ($add__new_comment_form.css({
            display: "block"
          })) {
            $add__new_comment_form.css({
              display: "none"
            });
            $comments__add.text("Написать комментарий");
            $comments__add.removeClass("active");
          } else $add__new_comment_form.css({
            display: "none"
          });
        }); // close btn

        $this.find($comments__item__reply_close).on("click", function () {
          $this.find($comments__item__reply).hide(300);
        });
      });
    });
  }); // reviews__form-top--result

  var $result__tab_item = $(".result__tab-item");
  $result__tab_item.each(function () {
    var $this = $(this);
    $this.on("click", function () {
      $result__tab_item.removeClass("active");
      $result__tab_item.children().show();
      $this.addClass("active");
      $this.children().hide(); // $this.on("mouseover", function () {
      //     $this.children().show()
      //     $this.removeClass("active")
      // })
    });
    $(".delete_btn-js").on("click", function () {
      $(this).closest($result__tab_item).remove();
    });
  });
  $(".result__tabs--pseudo").on("click", function (e) {
    e.preventDefault();
  }); // scroll horizontal

  function scrollHorizontally(e) {
    e = window.event || e;
    var delta = Math.max(-1, Math.min(1, e.wheelDelta || -e.detail));
    document.querySelector('.reviews__form-top--result .result__tabs').scrollLeft -= delta * 300;
    e.preventDefault();
  }

  $(".reviews__form-top--result .result__tabs").on("mousewheel", scrollHorizontally); // modal

  function modal() {
    var openModalButtons = document.querySelectorAll("[data-modal-target]");
    var closeModalButtons = document.querySelectorAll("[data-close-button]");
    var html = document.getElementsByTagName("html")[0];
    var overlay = document.querySelectorAll("[data-overlay]");
    openModalButtons.forEach(function (button) {
      button.addEventListener("click", function (e) {
        e.preventDefault();
        var modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
        html.style.overflow = "hidden";
      });
    });
    overlay.forEach(function (button) {
      button.addEventListener("click", function () {
        var modals = document.querySelectorAll(".modal.active");
        modals.forEach(function (modal) {
          closeModal(modal);
        });
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
      html.style.overflow = "auto";
      html.style.overflowX = "hidden";
    }
  }

  modal();
});