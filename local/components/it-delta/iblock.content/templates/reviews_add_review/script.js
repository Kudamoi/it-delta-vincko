$(document).ready(function() {
    var stepOneNext = document.querySelector('.review__btn.step-1 .next');
    var stepTwoNext = document.querySelector('.review__btn.step-2 .next');
    var stepThreeEnd = document.querySelector('.review__btn.step-3 .stop');

    let score = [];

    stepOneNext.addEventListener('click', function () {
        var input = document.querySelector('.smile-input'),
            smiles = document.querySelectorAll('.smile');

        if (input.value < 10000) {
            value = 1;
        } else if (input.value > 10000 && input.value <= 20000) {
            value = 2;
        } else if (input.value > 20000 && input.value <= 30000) {
            value = 3;
        } else if (input.value > 30000 && input.value <= 40000) {
            value = 4;
        } else if (input.value > 40000 && input.value <= 50000) {
            value = 5;
        }

        var textarea = $("textarea[name=step-1-coment]").val();

        score["ALLSCORE_REVIEW_SCORE"] = value;
        score["ALLSCORE_REVIEW_SCORE_COMMENT"] = textarea;
    });

    stepTwoNext.addEventListener('click', function () {
        var stepTwoItems = document.querySelectorAll('.review__bottom-item');

        stepTwoItems.forEach(function (item, i) {
            var span = item.querySelector('.number-wrapper > span').innerHTML;
            var textarea = item.querySelector("textarea[name=step-1-coment]");
            
            if(i == 0){
                score["CUSTOMER_FOCUS_SCORE"] = span;
                score["CUSTOMER_FOCUS_SCORE_COMMENT"] = textarea.value;
            }else if (i == 1) {
                score["COMFORT_SCORE"] = span;
                score["COMFORT_SCORE_COMMENT"] = textarea.value;
            } else {
                score["SECURITY_SCORE"] = span;
                score["SECURITY_SCORE_COMMENT"] = textarea.value;
            }
        });
    });

    stepThreeEnd.addEventListener('click', function () {
        var stepThreeItems = document.querySelectorAll('.step-3-item .content-wrapper .list-q .q');

        let arrElements = [];

        stepThreeItems.forEach(function (item, i) {
            var span = item.querySelector('.q-right span').innerHTML;
            var textarea = item.querySelector("textarea[name=coment]");

            arrElements[i] = Array();
            arrElements[i]["QUESTION"] = 1;
            arrElements[i]["REVIEW_SCORE"] = span;
            arrElements[i]["REVIEW_SCORE_COMMENT"] = textarea.value;
        });

        var params = window.location.search.replace('?','').split('&').reduce(
            function(p,e){
                var a = e.split('=');
                p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                return p;
            },
            {}
        );
        score["CHOP_ID"] = params["chop"];
        score["CITY_ID"] = params["city"];
        score["REVIEW_SCORES"] = arrElements;
    });

    $.ajax({
        url: "ajax/Feedback.php",
        type: "POST",
        data: JSON.stringify(score),
        dataType: "json",
        success: function(data)
        {
            console.log(data);
        }
    });
});