$(document).ready(function() {
    $('#formation .formation__wrapper').on('click', '.formation__right_arrow', function() {
        let slide = 1;
        if ($(this).hasClass('right')) {
            slide = Number($(this).closest('.formation__wrapper').find('.formation__left_btn.formation__left_btn-active').attr('data-slide')) + 1;
        } else if ($(this).hasClass('left')) {
            slide = Number($(this).closest('.formation__wrapper').find('.formation__left_btn.formation__left_btn-active').attr('data-slide')) - 1;
        }
        $(this).closest('.formation__wrapper').find('.formation__left_btn[data-slide='+slide+']').click();
    });
    $('#formation .formation__wrapper').on('click', '.formation__left_btn', function() {
        if ($(this).attr('data-slide') == 1) {
            $('#formation .formation__wrapper .formation__right_arrows .formation__right_arrow.left').addClass('hide');
        } else {
            $('#formation .formation__wrapper .formation__right_arrows .formation__right_arrow.left').removeClass('hide');
        }
        if ($(this).attr('data-slide') == $('#formation .formation__wrapper .formation__left_btn').length) {
            $('#formation .formation__wrapper .formation__right_arrows .formation__right_arrow.right').addClass('hide');
        } else {
            $('#formation .formation__wrapper .formation__right_arrows .formation__right_arrow.right').removeClass('hide');
        }


        $(this).closest('.formation__wrapper').find('.formation__right_slide').removeClass('formation__right_slide-active');
        $(this).closest('.formation__wrapper').find('.formation__right_slide[data-slide='+$(this).attr('data-slide')+']').addClass('formation__right_slide-active');
    });


})