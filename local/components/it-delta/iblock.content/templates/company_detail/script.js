$(document).ready(function () {
    $('.location-href-pack').on('click', function () {
        if($(this).closest('.solutions-card__center').find('.contract__item.active').length > 0) {
            location.href=$(this).attr('data-link') + '?SOLUTIONS=' +$(this).closest('.solutions-card__center').find('.contract__item.active').attr('data-id')
        }
    })
})