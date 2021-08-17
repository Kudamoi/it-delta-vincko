function change(num) {
    $('.rating-block .rating-center__items_top.title-change .rating-center__items_top-title').removeClass('title-act');
    $('.rating-block .rating-center__items_top.title-change .rating-center__items_top-title').eq(num).addClass('title-act');

    $('.rating-block .rating-center__item-wrapper').each(function() {
        if(num == 0) {
            $(this).find('.rating-center__item .num').html($(this).find('.rating-center__item  .rating-center__item_circle span').html());
            $(this).find('.line-panel-percent').animate({
                width: Number.parseFloat($(this).find('.rating-center__item  .rating-center__item_circle span').html().replace(/,/, '.'))*100/5+'%'
            }, 400);
        } else {
            $(this).find('.rating-center__item .num').html($(this).find('.itemRating-open .info-block-one.rating-check-window .info-block-one__right_row').eq(num).find('span').html())
            $(this).find('.line-panel-percent').animate({
                width: Number.parseFloat($(this).find('.rating-center__item > .num').html().replace(/,/, '.'))*100/5+'%'
            }, 400);
        }

    })
}

function clickRadio(param) {
    var value = document.querySelectorAll("input[type='radio'][name='" + param.name + "']");
    for (var i = 0; i < value.length; i++) {
        if (value[i] != param)
            value[i].BeforeCheck = false;
    }
    if (param.BeforeCheck)
        param.checked = false;
    param.BeforeCheck = param.checked;
}

$(document).ready(function () {

    $.ajax({
        type: 'post',
        url: '/ajax/reviews/filter.php',
        //data: {'OBJECT': $('.rating-center__items_top-btns-item input[type="radio"].rating-home:checked').attr('id'), 'MARK':  $(this).val()},
        data: {},
        response: 'html',
        success: function(data) {
            $('.reviews-item-wrapper-block').html(data);
        }
    })


    $(document).click( function(e){
        if (!$('.rating-help-window[style="display: block;"]').is(e.target) &&
            $('.rating-help-window[style="display: block;"]').has(e.target).length === 0) {
            $('.rating-help-window[style="display: block;"]').fadeOut();
            $('.rating-check-window').removeClass('svg-active');
        }
    });

    $('.icon-open-info-block').on('mouseover', function () {
        $(this).closest('.rating-check-window').find('.rating-help-window').fadeIn();
        $(this).closest('.rating-check-window').addClass('svg-active');
    })
    $('.rating-help-window-close').on('click', function () {
        $(this).closest('.rating-check-window').removeClass('svg-active');
        $(this.parentNode).fadeOut();
    })
    $('.searchForm__modal_input input').keyup(function(){
        let str = $(this).val();
        if($(this).val().length < 1) {
            $(this).closest('.searchForm__modal').find('.searchForm__modal_centerChek').css({'display':'none'});
        } else {
            $(this).closest('.searchForm__modal').find('.searchForm__modal_centerChek').css({'display': 'block'});
        }
        $(this).closest('.searchForm__modal').find('.searchForm__modal_centerChek').html(' ');
        $(this).closest('.searchForm__modal').find('.searchForm__modal_bottomChek .itemText').each(function (){
            if($(this).html().toLowerCase().indexOf(str.toLowerCase()) != -1) {
                $(this).closest('.searchForm__modal_wrapper').find('.searchForm__modal_centerChek').append('' +
                    '<div class="searchForm__modal_item bottomChekItem">' +
                    '                                        <input type="checkbox" class="checkbox">' +
                    '                                        <span data-id='+$(this).attr('data-id')+' class="itemText">'+ $(this).html()+'</span>' +
                    '                                    </div>');
            };
        });
    });

    $('.searchForm__modal.companies-select').on('click', '.bottomChekItem', function() {
        if($('#reviews__form .reviews__form-top--result .result__tabs .result__tab-item[data-id='+$(this).find('span').attr('data-id')+']').length < 1) {
            $('#reviews__form .reviews__form-top--result .result__tabs').append('' +
                '<li data-id=\''+$(this).find('span').attr('data-id')+'\' class="result__tab-item">'+
                '<input class="input" type="checkbox">'+
                '<p>'+
                '<span class="text">'+$(this).find('span').html()+'</span>'+
                '<span class="icon">'+
                '<svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z" fill="white"></path> </svg>'+
                '</span>'+
                '<span class="raiting__number">'+$(this).find('span').attr('data-count')+'</span>'+
                '<span class="result__tab-item--delete delete_btn-js">'+
                '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z" fill="#005DFF"></path> </svg>'+
                '</span>'+
                '</p>'+
                '</li>');
            $('#reviews__form .reviews__form-top--result .result__tabs .result__tab-item[data-id='+$(this).find('span').attr('data-id')+']').click();
        }

        if($(this).closest('.searchForm__modal_wrapper').find('.topChekItem span[data-id='+$(this).find('span').attr('data-id')+']').length > 1) {
            $(this).closest('.searchForm__modal_wrapper').find('.topChekItem span[data-id='+$(this).find('span').attr('data-id')+']').closest('.topChekItem').remove();
            $('#reviews__form .reviews__form-top--result .result__tabs .result__tab-item[data-id='+$(this).find('span').attr('data-id')+']').remove();
            let company = null;
            company = $('.reviews__form-top--result .result__tabs .result__tab-item.active').attr('data-id');
            $.ajax({
                type: 'post',
                url: '/ajax/reviews/filter.php',
                data: {'COMPANY': company, 'MARK':  $('#pseudo__range').val(),'SORT': $('.sort__form .sort__form-select-js').val()},
                response: 'html',
                success: function(data) {
                    $('.reviews-item-wrapper-block').html(data);
                }
            })
        }


    });
    $('.result__tabs').on('click', '.result__tab-item ', function () {
        $('#reviews__form > .reviews__form-send_btn a').attr('href', '/review-add/?COMPANY='+$(this).attr('data-id'))
    })
    $('.searchForm__modal.cities-select').on('click', '.bottomChekItem', function() {

        $(this).closest('.rating-center__search_form').find('.rating-center__search_form-select input[type=text]').attr('data-id',$(this).find('.itemText').attr('data-id'));
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').addClass('actived');
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').html($(this).clone());
        let companyID = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-id');
        let companyPreID = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-pre-id');
        if (companyID != companyPreID) {
            BX.setCookie("selected_city", companyID, {expires: 86400, path: '/'});
            $.ajax({
                url: "/ajax/citymodal.php",
                type: "POST",
                data: {
                    city: companyID
                },
                dataType: "json",
                success: function(d){
                    location.reload('#rating-center');
                },
                error: function(e){
                    location.reload('#rating-center');
                }
            });
        }
    });



    $('#pseudo__range').change(function() {
        let company = null;
        company = $('.reviews__form-top--result .result__tabs .result__tab-item.active').attr('data-id');
        $.ajax({
            type: 'post',
            url: '/ajax/reviews/filter.php',
            data: {'COMPANY': company, 'MARK':  $(this).val(),'SORT': $('.sort__form .sort__form-select-js').val()},
            response: 'html',
            success: function(data) {
                $('.reviews-item-wrapper-block').html(data);
            }
        })
    })
    $('.reviews__form-top--result .result__tabs').on('click','.result__tab-item', function() {
        let company = null;
        if($(this).hasClass('active')) {
            company = $(this).attr('data-id');
        }

        $.ajax({
            type: 'post',
            url: '/ajax/reviews/filter.php',
            data: {'COMPANY': company, 'MARK':  $('#pseudo__range').val(), 'SORT': $('.sort__form .sort__form-select-js').val()},
            response: 'html',
            success: function(data) {
                $('.reviews-item-wrapper-block').html(data);
            }
        })


    });
    $('.sort__form-select-js').on('change', function () {
        let company = null;
        company = $('.reviews__form-top--result .result__tabs .result__tab-item.active').attr('data-id');
        $.ajax({
            type: 'post',
            url: '/ajax/reviews/filter.php',
            data: {'COMPANY': company, 'MARK':  $('#pseudo__range').val(), 'SORT': $(this).val()},
            response: 'html',
            success: function(data) {
                $('.reviews-item-wrapper-block').html(data);
            }
        })
    })

    $('.reviews-item-wrapper-block').on('click', '.reviews__form-bottom--right .pagination a', function() {
            let company = null;
            company = $('.reviews__form-top--result .result__tabs .result__tab-item.active').attr('data-id');
            $.ajax({
                type: 'get',
                url: '/ajax/reviews/filter.php',
                data: {'COMPANY': company, 'MARK':  $('#pseudo__range').val(), 'SORT': $('.sort__form .sort__form-select-js').val(), 'page': $(this).attr('data-href')},
                response: 'html',
                success: function(data) {
                    $('.reviews-item-wrapper-block').html(data);
                }
            })
    });

});