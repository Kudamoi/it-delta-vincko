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
        }
    });
    $('.icon-open-info-block').on('click', function () {
        $(this).closest('.rating-check-window').find('.rating-help-window').fadeIn();
    })
    $('.rating-help-window-close').on('click', function () {
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
