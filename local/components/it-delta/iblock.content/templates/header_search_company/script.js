$(document).ready(function () {
    $(".header__top-search .input__control").on("click", function(){
		$(".searchForm__modal").css({'display': 'block'});
		$(".searchForm__modal .searchForm__modal_input").focus();
	});

    $('input.rating-home').on('click', function(){
        if($(this).attr("checked") == 'checked') {
            $(this).removeAttr('checked');
        } else {
            $(this).attr('checked', 'checked')
        }
    });

    var params = window.location.search.replace('?','').split('&').reduce(
        function(p,e) {
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );
    
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