$(document).ready(function () {
    var swiper = new Swiper(".mySwiper", {
        observer: true,
        observeParents: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        }
    });
    $('.rating-center__items_bottom-pagin a').each(function () {;
        $(this).attr('href', '#rating-center');
    })
    $('.rating-center__items_bottom-pagin a').on('click', function () {
        let city = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-pre-id');
        $.ajax({
            type: 'get',
            url: '/ajax/raiting/filter.php',
            //data: {'OBJECT': $('.rating-center__items_top-btns-item input[type="radio"].rating-home:checked').attr('id'), 'MARK':  $(this).val()},
            data: {'CITY': city, 'PAGEN_1' : $(this).attr('data-href')},
            response: 'html',
            success: function(data) {
                $('.rating-center__items-wrapper-block').html(data);
                $('.rating-center__items_top .rating-center__items_top-left .rating-center__items_top-btns-item').eq(0).find('label').click();
            }
        })
    })

})