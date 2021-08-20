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
    let company = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-pre-id');
    $.ajax({
        type: 'post',
        url: '/ajax/raiting/filter.php',
        //data: {'OBJECT': $('.rating-center__items_top-btns-item input[type="radio"].rating-home:checked').attr('id'), 'MARK':  $(this).val()},
        data: {'COMPANY': company},
        response: 'html',
        success: function(data) {
            console.log(company);
            $('.rating-center__items-wrapper-block').html(data);
            $('.rating-center__items_top .rating-center__items_top-left .rating-center__items_top-btns-item').eq(0).find('label').click();
        }
    })


    $('input.rating-home').on('click', function(){
        if($(this).attr("checked") == 'checked') {
            $(this).removeAttr('checked');
        } else {
            $(this).attr('checked', 'checked')
        }
    });

    const config = {
        attributes: true,
    };

    let targetCompany = document.querySelector('.rating-center__search_form.select-company .searchForm__modal');
        const callbackCompany = function(mutationsList, observer) {
            for (let mutation of mutationsList) {
                if($('.rating-center__search_form.select-company .searchForm__modal').attr('style') == 'display: none;') {
                let companyID = $('.rating-center__search_form.select-company .rating-center__search_form-select input').attr('data-id');
                    $('.rating-center__items-wrapper .rating-center__item_wrappers[data-id='+companyID+']').click();
                    let offset = $('.rating-center__items-wrapper .itemRating-open[data-id='+companyID+']').offset().top
                    $('html').animate({
                            scrollTop: offset
                        }, 300
                    );
                }
            }
        };
        const observerCompany = new MutationObserver(callbackCompany);
        observerCompany.observe(targetCompany, config);


    $('.rating-center__items_top-right-help #pseudo__range').change(function() {
        let company = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-pre-id');
    $.ajax({
                type: 'post',
                url: '/ajax/raiting/filter.php',
                data: {'COMPANY': company,'OBJECT': $('.rating-center__items_top-btns-item input[type="radio"].rating-home:checked').attr('id'), 'MARK':  $(this).val()},
                response: 'html',
                success: function(data) {
                    $('.rating-center__items-wrapper-block').html(data);
                    $('.rating-center__items_top .rating-center__items_top-left .rating-center__items_top-btns-item').eq(0).find('label').click();
                }
            })
    })
    $('.rating-center__items_top-btns-item').on('click','input[type="radio"].rating-home', function() {
        let company = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-pre-id');
        let objectID = null;
        if ($(this).prop('checked')) {
             objectID= $(this).attr('id');
        }
        $.ajax({
            type: 'post',
            url: '/ajax/raiting/filter.php',
            data: {'COMPANY': company,'OBJECT': objectID, 'MARK':  $('.rating-center__items_top-right-help #pseudo__range').val()},
            response: 'html',
            success: function(data) {
                $('.rating-center__items-wrapper-block').html(data);
                $('.rating-center__items_top .rating-center__items_top-left .rating-center__items_top-btns-item').eq(0).find('label').click();
            }
        })


    });
    var params = window.location.search.replace('?','').split('&').reduce(
        function(p,e) {
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );

    $(document).click( function(e){
        if (!$('.rating-help-window[style="display: block;"]').is(e.target) &&
            $('.rating-help-window[style="display: block;"]').has(e.target).length === 0) {
            $('.rating-help-window[style="display: block;"]').fadeOut();
            $('.rating-check-window').removeClass('svg-active');
        }
    });
    
    $('.rating-center').on('mouseover', '.icon-open-info-block',function () {
        $(this).closest('.rating-check-window').find('.rating-help-window').fadeIn();
        $(this).closest('.rating-check-window').addClass('svg-active');
    })
    $('.rating-center').on('click', '.rating-help-window-close', function () {
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
    $('.searchForm__modal').on('click', '.bottomChekItem', function() {

        $('.rating-center__search_form.select-company .searchForm__modal_closed').click();

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
})

$(document).ready(function () {
    $('.rating-center__items-wrapper .rating-center__item-wrapper').each(function () {
        $(this).find('.line-panel-percent').animate({
            width: Number.parseFloat($(this).find('.rating-center__item > .num').html().replace(/,/, '.'))*100/5+'%'
        }, 800);
    });
    $('.rating-center__items-wrapper .rating-center__item-wrapper .rating-center__item_circle').each(function () {
        $(this).find('svg circle').animate({
            'stroke-dashoffset': -8.0 - Number.parseFloat($(this).find('span').html().replace(/,/, '.'))*15/10+'em'
        }, 800);
    });
   $('.rating-center__items-wrapper .rating-center__item-wrapper .info-block-one .info-block-one__left').each(function () {
    $(this).find('svg circle').animate({
        'stroke-dashoffset': -8.0 - Number.parseFloat($(this).find('span').html().replace(/,/, '.'))*16/10+'em'
    }, 800);
});

})
