$(".complect__slider-datchiki-title .num").text($(".slick-slider-datchiki").find(".slide").length)
console.log("len" + $(".slick-slider-datchiki").find(".slide").length);


var colorOnClick = function colorOnClick(allEl, el, text) {
    el.addEventListener('click', function () {
        allEl.forEach(function (item) {
            item.classList.remove('active');
        });
        el.classList.add('active');
        textBlock.innerHTML = text;
    });
};

// Блоки с характеристикой
var closeOpenBlock = function closeOpenBlock(blockSelector, btnSelector) {
    var block = document.querySelector(blockSelector),
        btn = document.querySelector(btnSelector);

    if (btn) {
        btn.addEventListener('click', function () {
            if (block.classList.contains('close')) {
                block.classList.remove('close');
                btn.innerHTML = 'Свернуть';
            } else {
                block.classList.add('close');
                btn.innerHTML = 'Развернуть';
            }
        });
    }
};

// Селектор цвета
var white = document.querySelector('.complect__slider-datchiki-color-choice .white'),
    black = document.querySelector('.complect__slider-datchiki-color-choice .black'),
    allColor = document.querySelectorAll('.complect__slider-datchiki-color-choice .color'),
    textBlock = document.querySelector('.complect__slider-datchiki-color-text > span');
colorOnClick(allColor, white, 'Белый');
colorOnClick(allColor, black, 'Черный');
var сomplectSliderItems = document.querySelectorAll('.complect__slider-wrapper-item'),
    сomplectSliderTabs = document.querySelectorAll('.complect__slider-wrapper-tabs > li');
сomplectSliderTabs.forEach(function (item) {
    item.addEventListener('click', function () {
        сomplectSliderTabs.forEach(function (el) {
            el.classList.remove('active');
        });
        сomplectSliderItems.forEach(function (slide) {
            slide.classList.remove('active');

            if (item.getAttribute('data-tab') == slide.getAttribute('data-tab')) {
                item.classList.add('active');
                slide.classList.add('active');
            }
        });
    });
}); // слайдер

$('.slick-slider-datchiki').slick({
    variableWidth: true,
    centerMode: true,
    arrows: true,
    centerPadding: '60px',
    slidesToShow: 1,
    prevArrow: '<div class="arrow-prev arrow"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.546177 8.17134L7.78754 0.950275C8.24818 0.490692 8.99503 0.490692 9.45544 0.950275C9.9159 1.40945 9.9159 2.15419 9.45544 2.61333L3.04795 9.00287L9.45526 15.3922C9.91571 15.8515 9.91571 16.5962 9.45526 17.0554C8.9948 17.5147 8.24799 17.5147 7.78736 17.0554L0.545991 9.83421C0.315764 9.60451 0.200782 9.30378 0.200782 9.0029C0.200782 8.70188 0.315987 8.40093 0.546177 8.17134Z" fill="url(#paint0_linear)"/><defs><linearGradient id="paint0_linear" x1="0.200781" y1="0.605599" x2="24.9336" y2="2.73651" gradientUnits="userSpaceOnUse"><stop stop-color="white"/></linearGradient></defs></svg></div>',
    nextArrow: '<div class="arrow-next arrow"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.45382 9.82866L2.21246 17.0497C1.75182 17.5093 1.00497 17.5093 0.544558 17.0497C0.0841057 16.5905 0.0841057 15.8458 0.544558 15.3867L6.95205 8.99713L0.544744 2.60782C0.0842921 2.14846 0.0842921 1.40379 0.544744 0.944618C1.0052 0.485257 1.75201 0.485257 2.21264 0.944618L9.45401 8.16579C9.68424 8.39549 9.79922 8.69622 9.79922 8.9971C9.79922 9.29812 9.68401 9.59907 9.45382 9.82866Z" fill="url(#paint0_linear)"/><defs><linearGradient id="paint0_linear" x1="9.79922" y1="17.3944" x2="-14.9336" y2="15.2635" gradientUnits="userSpaceOnUse"><stop stop-color="white"/></linearGradient></defs></svg></div>',
    infinity: true
});
$('.slide-box-slider-item').slick({
    arrows: true,
    slidesToShow: 1,
    prevArrow: '<div class="arrow-prev-mini arrow-mini"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.546177 8.17134L7.78754 0.950275C8.24818 0.490692 8.99503 0.490692 9.45544 0.950275C9.9159 1.40945 9.9159 2.15419 9.45544 2.61333L3.04795 9.00287L9.45526 15.3922C9.91571 15.8515 9.91571 16.5962 9.45526 17.0554C8.9948 17.5147 8.24799 17.5147 7.78736 17.0554L0.545991 9.83421C0.315764 9.60451 0.200782 9.30378 0.200782 9.0029C0.200782 8.70188 0.315987 8.40093 0.546177 8.17134Z" fill="#005DFF"/></svg></div>',
    nextArrow: '<div class="arrow-next-mini arrow-mini"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.25461 9.83427L2.01324 17.0553C1.5526 17.5149 0.805754 17.5149 0.345339 17.0553C-0.115113 16.5962 -0.115113 15.8514 0.345339 15.3923L6.75283 9.00275L0.345525 2.61343C-0.114927 2.15407 -0.114927 1.40941 0.345525 0.950234C0.805977 0.490873 1.55279 0.490873 2.01342 0.950234L9.25479 8.17141C9.48502 8.40111 9.6 8.70184 9.6 9.00271C9.6 9.30374 9.48479 9.60469 9.25461 9.83427Z" fill="#005DFF"/></svg></div>'
});
var activeSlide = document.querySelector('.slick-slide.slick-center'),
    infoBlocks = document.querySelectorAll('.info'),
    allSlides = document.querySelectorAll('.slick-slide');
allSlides.forEach(function (item, i) {
    var dataSlickIndex = item.getAttribute('data-slick-index');
    item.setAttribute('data-slider-info', +dataSlickIndex + 1);
});
document.querySelectorAll('.slick-slide').forEach(function (item) {
    item.classList.remove('prev-next-slide');

    if (document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') - 1 == item.getAttribute('data-slick-index')) {
        item.classList.add('prev-next-slide');
    }

    if (+document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') + 1 == item.getAttribute('data-slick-index')) {
        item.classList.add('prev-next-slide');
    }
    /*infoBlocks.forEach(item => {
        item.classList.remove('show');
        if (activeSlide.getAttribute('data-slider-info') == item.getAttribute('data-slider-info')) {
            item.classList.add('show')
        }
    })*/

});
document.querySelectorAll('.slick-arrow').forEach(function (arrow) {
    arrow.addEventListener('click', function () {
        document.querySelectorAll('.slick-slide').forEach(function (item) {
            item.classList.remove('prev-next-slide');

            if (document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') - 1 == item.getAttribute('data-slick-index')) {
                item.classList.add('prev-next-slide');
            }

            if (+document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') + 1 == item.getAttribute('data-slick-index')) {
                item.classList.add('prev-next-slide');
            }
            /*infoBlocks.forEach(item => {
                item.classList.remove('show');
                if (activeSlide.getAttribute('data-slider-info') == item.getAttribute('data-slider-info')) {
                    item.classList.add('show')
                }
            })*/

        });
    });
});
$('.slick-slider-datchiki').on('swipe', function (event) {
    document.querySelectorAll('.slick-slide').forEach(function (item) {
        item.classList.remove('prev-next-slide');

        if (document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') - 1 == item.getAttribute('data-slick-index')) {
            item.classList.add('prev-next-slide');
        }

        if (+document.querySelector('.slick-slide.slick-center').getAttribute('data-slick-index') + 1 == item.getAttribute('data-slick-index')) {
            item.classList.add('prev-next-slide');
        }
    });
});
closeOpenBlock('.slider__under-block-1', '.close-btn');
closeOpenBlock('.slider__under-block-2', '.close-btn-2'); // modal

$('.modal-slider').slick({
    prevArrow: '<div class="modal-arrow arrow-prev-mini arrow-mini"><img src="/upload/images/arrows/modal-prev.svg"></div>',
    nextArrow: '<div class="modal-arrow arrow-next-mini arrow-mini"><img src="/upload/images/arrows/modal-next.svg"></div>'
});
var slide = document.querySelectorAll('.modal-slider .slick-slide'),
    slideBottom = document.querySelectorAll('.modal-bottom .item'),
    modalArrow = document.querySelectorAll('.modal-arrow'),
    modal = document.querySelector('.slide-modal'),
    modalTrigger = document.querySelectorAll('.modal-btn'),
    modalClose = modal.querySelector('.close');
modalTrigger.forEach(function (item) {
    item.addEventListener('click', function () {
        let modWindow = $('.slide-modal[data-slider-info='+$(this).attr("data-key")+']');
        $(modWindow).addClass('active');
        let dataModal = $('.slide-modal.active .modal-slider .slick-current').attr('data-modal-slide');

        $('.slide-modal.active .modal-bottom .item').removeClass('active');
        $('.slide-modal.active .modal-bottom .item').eq(dataModal-1).addClass('active');
        console.log($('.slide-modal.active .modal-bottom .item:eq('+dataModal+')'));
    });
});
$('.close').on('click', function () {
    let closeWindow = $('.slide-modal[data-slider-info='+$(this).attr('data-close')+']');
    $(closeWindow).removeClass('active');
    $('.modal-slider .slick-active').removeClass('slick-active');
});
document.addEventListener('click', function (e) {
    if (e.target == modal && modal.classList.contains('active')) {
        modal.classList.remove('active');
    }
});
$('.modal-slider').each(function() {
    $(this).find('.slick-slide').each(function(index) {
        $(this).attr('data-modal-slide', index);
    });
});
$('.modal-bottom').each(function() {
    $(this).find('.item').each(function(index) {
        $(this).attr('data-modal-slide', index+1);
    });
});
//  slide.forEach(function (item, i) {
//    item.setAttribute('data-modal-slide', i);
//  });
//  slideBottom.forEach(function (item, i) {
//    item.setAttribute('data-modal-slide', i + 1);
//  });
modalArrow.forEach(function (btn) {
    btn.addEventListener('click', function () {
        slide.forEach(function (slide) {
            if (slide.classList.contains('slick-active')) {
                slideBottom.forEach(function (slideBottom) {
                    slideBottom.classList.remove('active');

                    if (slide.getAttribute('data-modal-slide') === slideBottom.getAttribute('data-modal-slide')) {
                        slideBottom.classList.add('active');
                    }
                });
            }
        });
    });
}); // swipe

$('.modal-slider').on('swipe', function (event) {
    slide.forEach(function (slide) {
        if (slide.classList.contains('slick-active')) {
            slideBottom.forEach(function (slideBottom) {
                slideBottom.classList.remove('active');

                if (slide.getAttribute('data-modal-slide') === slideBottom.getAttribute('data-modal-slide')) {
                    slideBottom.classList.add('active');
                }
            });
        }
    });
});
$('.slick-slider-datchiki').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    $('.info').removeClass("vis");
    $('[data-slider-info="' + nextSlide + '"]').addClass('vis');
    console.log(nextSlide);
});
$(".complect .subscribe .blue-button").on("click", function () {
    $(".subscribe").addClass("subscribe-ordered");
    $('.card-one').removeClass("no-subscribe");
});
$(".complect .subscribe .button-ordered").on("click", function () {
    $(".subscribe").removeClass("subscribe-ordered");
    $('.card-one').addClass("no-subscribe");
});
$(".to-card-btn").on("click", function () {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#solutions__center").offset().top
    }, 300);
});