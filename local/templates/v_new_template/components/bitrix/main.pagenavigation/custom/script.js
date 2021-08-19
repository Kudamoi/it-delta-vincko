
$(document).ready(function() {
    $('.pagination a').each(function() {
        $(this).attr('data-href', $(this).attr('href'));
        $(this).attr('href', '#reviews__form');
    });
})