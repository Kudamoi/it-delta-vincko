"use strict";

$(document).ready(function () {
  var items = $(".ready-pack__item");
  items.each(function (index) {
    var parent = $(this).children(" .ready-pack__mid");
    var ul = parent.find(".ready-pack__mid-list");

    if (ul.find("li").length > 5) {
      var el = ul.find("li").slice(5, 100);
      parent.find(".ready-pack__switch").css("display", "grid");
      el.addClass("hidden");
      var open = parent.find(".ready-pack__open");
      var close = parent.find(".ready-pack__close");
      var present = parent.find(".predloj__present");
      open.on("click", function () {
        console.log("heya");
        el.removeClass("hidden");
        close.css("display", "flex");
        open.css("display", "none");
        present.css("opacity", "0");
      });
      close.on("click", function () {
        el.addClass("hidden");
        close.css("display", "none");
        open.css("display", "flex");
        present.css("opacity", "1");
      });
    }
  });
});