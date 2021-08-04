"use strict";

jQuery(document).ready(function ($) {
  // var packerContainer = document.getElementById("packer");
  // var packs = packerContainer.getElementsByClassName("pack");
  // if (packs) {
  // 	for (var i = 0; i < packs.length; i++) {
  // 		packs[i].addEventListener("mouseover", function () {
  // 			var current = document.getElementsByClassName("shadow");
  // 			current[0].className = current[0].className.replace(" shadow", "");
  // 			this.className += " shadow";
  // 		});
  // 	}
  // }
  var animItems = document.querySelectorAll('._anim-items');

  if (animItems.length > 0) {
    var animOnScroll = function animOnScroll() {
      for (var index = 0; index < animItems.length; index++) {
        var animItem = animItems[index];
        var animItemHeight = animItem.offsetHeight;
        var animItemOffset = offset(animItem).top;
        var animStart = 4;
        var animItemPoint = window.innerHeight - animItemHeight / animStart;

        if (animItemHeight > window.innerHeight) {
          animItemPoint = window.innerHeight - window.innerHeight / animStart;
        }

        if (pageYOffset > animItemOffset - animItemPoint && pageYOffset < animItemOffset + animItemHeight) {
          animItem.classList.add('_animate');
        } else {
          if (!animItem.classList.contains('_anim-no-hide')) {
            animItem.classList.remove('_animate');
          }
        }
      }
    };

    var offset = function offset(el) {
      var rect = el.getBoundingClientRect(),
          scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
          scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      return {
        top: rect.top + scrollTop,
        left: rect.left + scrollLeft
      };
    };

    window.addEventListener('scroll', animOnScroll);
    setTimeout(function () {
      animOnScroll();
    }, 700);
  }

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
});