function change(num) {
    $('.rating-block .rating-center__items_top.title-change .rating-center__items_top-title').removeClass('title-act');
    $('.rating-block .rating-center__items_top.title-change .rating-center__items_top-title').eq(num).addClass('title-act');
}
$(document).ready(function () {
    var params = window.location.search.replace('?','').split('&').reduce(
        function(p,e){
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );

    $('.searchForm__modal').closest('.rating-center__search_form').find('.rating-center__search_form-select input[type=text]').attr('placeholder', params["city"]);

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
                    '                                        <span class="itemText">'+ $(this).html()+'</span>' +
                    '                                    </div>');
            };
        });
    });
    $('.searchForm__modal').on('click', '.bottomChekItem', function() {
        var companyName = $(this).closest('.rating-center__search_form').find('.rating-center__search_form-select input[type=text]').attr('placeholder',$(this).find('.itemText').html());
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').html($(this).clone());
        //window.location.href = "?city=" + companyName.attr('placeholder');
        $.ajax({
            url: 'index.php',
            method: 'POST',
            data: {'city': companyName.attr('placeholder')},
            success: function (data){
                console.log(data);
            }
        });
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
