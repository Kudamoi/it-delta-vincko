$(document).ready(function () {
    $('.location-href-pack').on('click', function () {
        if ($(this).closest('.solutions-card__center').find('.contract__item.active').length > 0) {
            location.href = $(this).attr('data-link') + '?SOLUTIONS=' + $(this).closest('.solutions-card__center').find('.contract__item.active').attr('data-id')
        }
    })
    let winClose = $('.norating .solution-card__list-current-help-window-close');
    let winOpen = $('.norating .solution-card__list-current-help');
    let win = $('.norating .solution-card__list-current-help-window');
    let selectOpen = $('.solution-card__list-current-text');
    winClose.on('click', function () {
        $(this).closest('.solution-card__list-current-help-window').fadeOut();
    })
    winOpen.on('click', function () {
        $(this).closest('.win-open').find('.solution-card__list-current-help-window').fadeIn();
    })

    selectOpen.on('click', function () {
        $(this).closest('.solution-card__list').find('.solution-card__list-select').height($(this).closest('.solutions-card__center').height() - $(this).closest('.solution-card__list').position().top + 11);

        $(this).closest('.solution-card__list').find('.solution-card__list-select').fadeIn();
        $(this).closest('.solution-card__list').find('.solution-card__list-select').attr('view', 'open');
    })
    $('.solution-card__list-select > .solution-card__list-current-help-window-close').on('click', function () {
        $(this).closest('.solution-card__list-select').fadeOut();
    })
    $('.solution-card__list-current-open-list').on('click', function () {
        $(this).closest('.solution-card__list').find('.solution-card__list-select').fadeIn();
    })
    $('.solution-card__list-select-package-change label').on('click', function () {
        $(this).closest('.solution-card__list-select').find('.solution-card__list-select-package').removeClass('active');
        $(this).closest('.solution-card__list-select-package').addClass('active');
        $(this).closest('.solution-card__list-select').attr('view', 'close');
        $(this).closest('.solution-card__list-select').fadeOut();
        let complectClass = $(this).find('.class').html();
        let complectName = $(this).find('.complect').html();
        let complectDesc = $(this).closest('.win-open').find('.solution-card__list-current-help-window-desc').html();
        let complectPackage = $(this).closest('.solution-card__list-select-package').find('.solution-card__list-select-package-title span').html();
        $(this).closest('.solution-card__list').find('.solution-card__list-current-text').html(complectClass + ' ' + complectPackage + ': ' + complectName);
        $(this).closest('.solution-card__list').find('.solution-card__list-current .solution-card__list-current-help-window .name').html(complectPackage);
        $(this).closest('.solution-card__list').find('.solution-card__list-current .solution-card__list-current-help-window .solution-card__list-current-help-window-desc').html(complectDesc);

        $.ajax({
            type: 'post',
            url: '/ajax/norating/searchOffer.php',
            data: {'COMPANY': $(this).closest('.solutions-card__substrate').attr('data-company'), 'COMPLECT': $(this).attr('data-id')},
            response: 'html',
            success: function (data) {
                $('.installment__right-column .solutions-card__substrate .solutions-card__contract_wrapper').html(data);
                $('.solutions-card__center .location-href-pack').attr('data-link', $('.installment__right-column .solutions-card__substrate .solutions-card__contract_wrapper .new-page').val())
            },
            error: function (data) {
                $('.installment__right-column .solutions-card__substrate .solutions-card__contract_wrapper').html('error');
            }
        })
    })

    document.onclick = function (e) {
        if (!win.is(e.target) && win.has(e.target).length === 0 && !winOpen.is(e.target) && winOpen.has(e.target).length === 0) {
            win.fadeOut();
        };
        if (!$('.solution-card__list-select[view=\'open\']').is(e.target) && $('.solution-card__list-select[view=\'open\']').has(e.target).length === 0 && !$('.solution-card__list-current.win-open').is(e.target) && $('.solution-card__list-current.win-open').has(e.target).length === 0) {
            $('.solution-card__list-select[view=\'open\']').fadeOut();
            $('.solution-card__list-select[view=\'open\']').attr('view', 'close');

        }
    };
})