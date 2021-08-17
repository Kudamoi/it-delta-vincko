$(document).ready(function() {
    $('.ready-des2__choice .choice-slide .ready-des2__choice-item').on("click", function() {
        location.href='/packages/?task='+$(this).attr('data-id')+'&company='+$('.tasks__top_text .solutions__bottom_column-select').val();
    })

})