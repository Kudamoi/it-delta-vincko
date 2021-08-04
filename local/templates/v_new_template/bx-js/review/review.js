"use strict";

if (document.querySelector('.review') === null) {} else {
  var reviewBottomItem = document.querySelectorAll('.review__bottom-item');
  reviewBottomItem.forEach(function (item) {
    item.addEventListener('mouseover', function () {
      reviewBottomItem.forEach(function (el) {
        el.classList.remove('hover');
      });
      reviewBottomItem[0].classList.remove('hover');
      item.classList.add('hover');
    });
  });

  if (document.querySelector('.review__massage') === null) {} else {
    var reviewBox = document.querySelector('.review__massage');
    reviewIcon = reviewBox.querySelector('.review__massage-icon > picture'), reviewText = reviewBox.querySelector('.review__massage-text > p');

    if (reviewBox.classList.contains('bad')) {
      reviewBox.style.background = '#FFECEC';
      var source = reviewIcon.querySelector('source'),
          img = reviewIcon.querySelector('img');
      source.setAttribute('srcset', '../img/review/massage-bad.svg');
      img.setAttribute('src', '../img/review/massage-bad.svg');
      reviewText.innerHTML = 'Этот отзыв не влияет на рейтинг, так как вы не являетесь покупателем услуг данной охранной компании в рамках платформы <a href="">vincko:</a>';
    }
  }

  if (document.querySelector('.smile-input') === null) {} else {
    var input = document.querySelector('.smile-input'),
        smiles = document.querySelectorAll('.smile');
    input.addEventListener('input', function () {
      smiles.forEach(function (item, i) {
        item.classList.remove('active');

        if (input.value < 10000) {
          smiles[0].classList.add('active');
        } else if (input.value > 10000 && input.value <= 20000) {
          smiles[1].classList.add('active');
        } else if (input.value > 20000 && input.value <= 30000) {
          smiles[2].classList.add('active');
        } else if (input.value > 30000 && input.value <= 40000) {
          smiles[3].classList.add('active');
        } else if (input.value > 40000 && input.value <= 50000) {
          smiles[4].classList.add('active');
        }
      });
    });
  }

  var stepTwoItems = document.querySelectorAll('.review__bottom-item');
  stepTwoItems.forEach(function (item) {
    var input = item.querySelector('.smile-input'),
        li = item.querySelectorAll('.review-item-step-2'),
        span = item.querySelector('.number-wrapper > span'),
        svg = item.querySelector('svg'),
        circle = item.querySelector('circle'),
        numberWrapper = item.querySelector('.number-wrapper');
    input.addEventListener('input', function () {
      li.forEach(function (el, i) {
        el.classList.remove('active');

        if (input.value < 18000) {
          li[0].classList.add('active');
          span.innerHTML = '?';
          svg.style.display = 'none';
          numberWrapper.style.border = '1px solid #D1DBE3';
        } else if (input.value > 18000 && input.value < 28000) {
          li[1].classList.add('active');
          span.innerHTML = '0';
          numberWrapper.style.border = '1px solid #D1DBE3';
          svg.style.display = 'none';
        } else if (input.value > 28000 && input.value < 38000) {
          li[2].classList.add('active');
          span.innerHTML = '1';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '130.5';
        } else if (input.value > 38000 && input.value < 48000) {
          li[3].classList.add('active');
          span.innerHTML = '2';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '116';
        } else if (input.value > 48000 && input.value < 58000) {
          li[4].classList.add('active');
          span.innerHTML = '3';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '101.5';
        } else if (input.value > 58000 && input.value < 68000) {
          li[5].classList.add('active');
          span.innerHTML = '4';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '87';
        } else if (input.value > 68000 && input.value < 78000) {
          li[6].classList.add('active');
          span.innerHTML = '5';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '72.5';
        } else if (input.value > 78000 && input.value < 88000) {
          li[7].classList.add('active');
          span.innerHTML = '6';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '58';
        } else if (input.value > 88000 && input.value < 98000) {
          li[8].classList.add('active');
          span.innerHTML = '7';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '43.5';
        } else if (input.value > 98000 && input.value < 108000) {
          li[9].classList.add('active');
          span.innerHTML = '8';
          svg.style.display = 'block';
          numberWrapper.style.border = '1px solid #D1DBE3';
          circle.style.strokeDashoffset = '29';
        } else if (input.value > 108000 && input.value < 118000) {
          li[10].classList.add('active');
          span.innerHTML = '9';
          svg.style.display = 'block';
          circle.style.strokeDashoffset = '14.5';
          numberWrapper.style.border = '1px solid #D1DBE3';
        } else if (input.value > 118000) {
          li[11].classList.add('active');
          span.innerHTML = '10';
          svg.style.display = 'none';
          numberWrapper.style.border = '2px solid #005DFF';
        }
      });
    });
  });
  var content = document.querySelectorAll('.content');
  var stepThreeActiveBlocks = document.querySelectorAll('.content-wrapper .active-block');
  content.forEach(function (item, n) {
    var notBefore = 0;
    var q = item.querySelectorAll('.q');
    q.forEach(function (elem, i) {
      var input = elem.querySelector('.smile-input'),
          li = elem.querySelectorAll('.review-item-step-3'),
          span = elem.querySelector('span'),
          btn = elem.querySelector('.next-btn'),
          h5 = elem.querySelector('h5');
      input.addEventListener('input', function () {
        li.forEach(function (el, i) {
          el.classList.remove('active');

          if (input.value < 18000) {
            li[0].classList.add('active');
            span.innerHTML = '?';
          } else if (input.value > 18000 && input.value < 28000) {
            li[1].classList.add('active');
            span.innerHTML = '0';
          } else if (input.value > 28000 && input.value < 38000) {
            li[2].classList.add('active');
            span.innerHTML = '1';
          } else if (input.value > 38000 && input.value < 48000) {
            li[3].classList.add('active');
            span.innerHTML = '2';
          } else if (input.value > 48000 && input.value < 58000) {
            li[4].classList.add('active');
            span.innerHTML = '3';
          } else if (input.value > 58000 && input.value < 68000) {
            li[5].classList.add('active');
            span.innerHTML = '4';
          } else if (input.value > 68000 && input.value < 78000) {
            li[6].classList.add('active');
            span.innerHTML = '5';
          } else if (input.value > 78000 && input.value < 88000) {
            li[7].classList.add('active');
            span.innerHTML = '6';
          } else if (input.value > 88000 && input.value < 98000) {
            li[8].classList.add('active');
            span.innerHTML = '7';
          } else if (input.value > 98000 && input.value < 108000) {
            li[9].classList.add('active');
            span.innerHTML = '8';
          } else if (input.value > 108000 && input.value < 118000) {
            li[10].classList.add('active');
            span.innerHTML = '9';
          } else if (input.value > 118000) {
            li[11].classList.add('active');
            span.innerHTML = '10';
          }
        });
      });
      elem.setAttribute('q-num', i);
      h5.addEventListener('click', function () {
        q.forEach(function (trig) {
          trig.classList.remove('active');
        });
        elem.classList.add('active');
      });
      btn.addEventListener('click', function () {
        var nextBtn = document.querySelector('.next-btn-bottom');
        notBefore += 1;
        elem.classList.remove('active');

        if (!q[i + 1]) {} else {
          q[i + 1].classList.remove('before');
          q[i + 1].classList.add('active');
        }

        if (notBefore === q.length) {
          nextBtn.disabled = false;
        }
      });
    });
  });
  var stepThreeItems = document.querySelectorAll('.step-3-item');
  var btn = document.querySelector('.next-btn-bottom');
  stepThreeItems.forEach(function (item, i) {
    btn.addEventListener('click', function () {
      btn.disabled = true;

      if (btn.classList.contains('step-2') && stepThreeItems[i + 1].classList.contains('active')) {
        btn.classList.remove('step-2');
        btn.classList.add('step-3');
        stepThreeItems[i + 1].classList.remove('active');
        stepThreeItems[i + 1].classList.add('pre-back');
        stepThreeItems[i + 2].classList.add('active');
        stepThreeItems[i + 2].classList.remove('pre-next');
        var btnBlock = document.querySelector('.review__btn.step-3');
        var next = btnBlock.querySelector('.next-btn-bottom');
        var stop = btnBlock.querySelector('.stop');
        var bonusBlock = stop.querySelector('.bonus-block');
        var pic = bonusBlock.querySelector('picture');
        var bonSpan = bonusBlock.querySelector('span');
        next.style.display = 'none';
        stop.style.display = 'flex';
        bonusBlock.style.cssText = "\n                display: flex;\n                width: 112px;\n            ";
        pic.style.cssText = "\n                margin-left: 20px;\n            ";
        bonSpan.style.color = '#FF6E52';
      }
    });
    btn.addEventListener('click', function () {
      if (btn.classList.contains('step-1')) {
        btn.classList.remove('step-1');
        btn.classList.add('step-2');
        item.classList.remove('active');
        item.classList.add('back');
        stepThreeItems[i + 1].classList.add('active');
        stepThreeItems[i + 1].classList.remove('next');
      }
    });
  });

  if (document.body.clientWidth < 1098) {
    var reviewBlock = document.querySelector('.review');
    var stepOneNext = document.querySelector('.review__btn.step-1 .next');
    var stepTwoNext = document.querySelector('.review__btn.step-2 .next');
    var stepOneMid = document.querySelector('.review__mid-step-1.mob');
    var stepTwoMid = document.querySelector('.review__mid-step-2.mob');
    var stepThreeMid = document.querySelector('.review__mid-step-3.mob');
    stepOneNext.addEventListener('click', function () {
      stepOneMid.classList.remove('active');
      stepTwoMid.classList.add('active');
      reviewBlock.classList.add('step-2');
    });
    stepTwoNext.addEventListener('click', function () {
      stepTwoMid.classList.remove('active');
      stepThreeMid.classList.add('active');
      reviewBlock.classList.remove('step-2');
      reviewBlock.classList.add('step-3');
    });
  } else {
    var _reviewBlock = document.querySelector('.review');

    var _stepOneNext = document.querySelector('.review__btn.step-1 .next');

    var _stepTwoNext = document.querySelector('.review__btn.step-2 .next');

    var _stepOneMid = document.querySelector('.review__mid-step-1');

    var _stepTwoMid = document.querySelector('.review__mid-step-2');

    var _stepThreeMid = document.querySelector('.review__mid-step-3');

    _stepOneNext.addEventListener('click', function () {
      _stepOneMid.classList.remove('active');

      _stepOneMid.innerHTML = "\n            <picture class=\"pic\">\n                <source srcset=\"../img/review/step-1-no-active.svg\">\n                <img src=\"../img/review/step-1-no-active.svg\" alt=\"good\">\n            </picture>\n            <p><span>1</span> \u041E\u0431\u0449\u0435\u0435 \u0432\u043F\u0435\u0447\u0430\u0442\u043B\u0435\u043D\u0438\u0435</p>\n        ";

      _stepTwoMid.classList.add('active');

      _reviewBlock.classList.add('step-2');

      _stepTwoMid.innerHTML = "\n            <picture class=\"pic\">\n                <source srcset=\"../img/review/step-2-active.svg\">\n                <img src=\"../img/review/step-2-active.svg\" alt=\"good\">\n            </picture>\n            <p><span>2</span> \u0412\u0441\u0435\u0433\u043E 3 \u0432\u043E\u043F\u0440\u043E\u0441\u0430</p>\n            <picture class=\"icon\">\n                <source srcset=\"../img/review/step-2-icon.svg\">\n                <img src=\"../img/review/step-2-icon.svg\" alt=\"good\">\n            </picture>\n            <p class=\"bonus\">+500 \u0431\u043E\u043D\u0443\u0441\u043E\u0432</p>\n        ";
    });

    _stepTwoNext.addEventListener('click', function () {
      _stepTwoMid.classList.remove('active');

      _stepTwoMid.innerHTML = "\n        <picture class=\"pic\">\n        <source srcset=\"../img/review/step-2-no-active.svg\">\n        <img src=\"../img/review/step-2-no-active.svg\" alt=\"good\">\n        </picture>\n        <p><span>2</span> \u0412\u0441\u0435\u0433\u043E 3 \u0432\u043E\u043F\u0440\u043E\u0441\u0430</p>\n        <picture class=\"icon\">\n            <source srcset=\"../img/review/step-2-icon.svg\">\n            <img src=\"../img/review/step-2-icon.svg\" alt=\"good\">\n        </picture>\n        <p class=\"bonus\">+500 \u0431\u043E\u043D\u0443\u0441\u043E\u0432</p>\n        ";

      _stepThreeMid.classList.add('active');

      _reviewBlock.classList.remove('step-2');

      _reviewBlock.classList.add('step-3');

      _stepThreeMid.innerHTML = "\n        <picture class=\"pic\">\n        <source srcset=\"../img/review/step-3-active.svg\">\n        <img src=\"../img/review/step-3-active.svg\" alt=\"good\">\n        </picture>\n        <p><span>3</span> \u041D\u0435\u043C\u043D\u043E\u0433\u043E \u043F\u043E\u0434\u0440\u043E\u0431\u043D\u0435\u0435</p>\n        <picture class=\"icon\">\n            <source srcset=\"../img/review/step-3-icon.svg\">\n            <img src=\"../img/review/step-3-icon.svg\" alt=\"good\">\n        </picture>\n        <p class=\"bonus\">+600 \u0431\u043E\u043D\u0443\u0441\u043E\u0432</p>\n        ";
    });
  }
}