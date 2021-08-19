$(document).ready(function() {

    function sendAjax(){
        $.ajax({
            method: "POST",
            url: "/ajax/addFeedback.php",
            data: {'feedbackData': score},
            dataType: "html",
            success: function(data){
                location.href = "/reviews/?company=" + params["chop"] + "&" + "review=" + data;
            }
        });
    }

    /**
     * Метод для создания массива, который будет отправляться в ajax запросом
     * 
     * @param {int} step 
     */
    function setDataForAjax(step){
        if(step == 1){
            var input = document.querySelector(".smile-input");

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
    
            var textarea = document.querySelector("textarea[name=step-1-coment]").value;
    
            score["ALLSCORE_REVIEW_SCORE"] = value;
            score["ALLSCORE_REVIEW_SCORE_COMMENT"] = textarea;
        }else if(step == 2){
            var stepTwoItems = document.querySelectorAll(".review__bottom-item");

            stepTwoItems.forEach(function(item, i){
                var span = item.querySelector(".value-block .number-wrapper > span").innerHTML;
                var textarea = item.querySelector("textarea[name=step-2-coment]");
                var element = item.querySelector("div.item-name");
                var scoreSections = document.querySelectorAll(".step-3-item .content-wrapper .number-block .number");
    
                if(element.getAttribute("id") == "Klientoorientirovannost"){
                    scoreSections[i].innerHTML = span;

                    score["CUSTOMER_FOCUS_SCORE"] = span != "?" ? span : -1;
                    score["CUSTOMER_FOCUS_COMMENT"] = textarea.value;
                }else if(element.getAttribute("id") == "Komfort"){
                    scoreSections[i].innerHTML = span;

                    score["COMFORT_SCORE"] = span != "?" ? span : -1;
                    score["COMFORT_SCORE_COMMENT"] = textarea.value;
                }else if(element.getAttribute("id") == "Bezopasnost"){
                    scoreSections[i].innerHTML = span;

                    score["SECURITY_SCORE"] = span != "?" ? span : -1;
                    score["SECURITY_SCORE_COMMENT"] = textarea.value;
                }
            });
        }else if(step == 3){
            var stepThreeItems = document.querySelectorAll(".step-3-item .content-wrapper .list-q .q");

            let arrElements = [];

            stepThreeItems.forEach(function(item, i){
                var span = item.querySelector(".q-right span").innerHTML;
                var questionId = item.querySelector(".q-left h5");
                var textarea = item.querySelector("textarea[name=coment]");

                arrElements[i] = new Object();
                arrElements[i]["QUESTION_ID"] = questionId.getAttribute("data-id");
                arrElements[i]["REVIEW_SCORE"] = span != "?" ? span : -1;
                arrElements[i]["REVIEW_SCORE_COMMENT"] = textarea.value;
            });

            score["REVIEW_SCORES"] = arrElements;
        }

        score["CHOP_ID"] = params["chop"];
        score["CITY_ID"] = params["city"];
        score["REVIEW_TYPE_ID"] = document.querySelector(".review__massage").getAttribute("data-type");
    }

    var score = {};

    var params = window.location.search.replace("?","").split("&").reduce(
        function(p,e){
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );

    // Работа фильтра
    $('.searchForm__modal').on('click', '.bottomChekItem', function() {
        $('.rating-center__search_form.select-city .searchForm__modal_closed').click();

        $(this).closest('.rating-center__search_form').find('.rating-center__search_form-select input[type=text]').attr('data-id',$(this).find('.itemText').attr('data-id'));
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').addClass('actived');
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').html($(this).clone());
        let cityID = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-id');
        let cityPreID = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-pre-id');
        if (cityID != cityPreID) {
            $.ajax({
                url: "/ajax/citymodal.php",
                type: "POST",
                data: {
                    city: cityID
                },
                dataType: "json",
                success: function(d){
                    location.search = "city=" + cityID;
                },
                error: function(e){
                    location.search = "city=" + cityID;
                }
            });
        }
    });

    $('.searchForm__modal').on('click', '.bottomChekItem', function() {
        $('.rating-center__search_form.select-company .searchForm__modal_closed').click();

        $(this).closest('.rating-center__search_form').find('.rating-center__search_form-select input[type=text]').attr('data-id',$(this).find('.itemText').attr('data-id'));
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').addClass('actived');
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').html($(this).clone());
        let companyID = $('.rating-center__search_form.select-company .rating-center__search_form-select input').attr('data-id');
        let cityCompanyID = $('.rating-center__search_form.select-city .rating-center__search_form-input.rating-center__search_form-select input').attr('data-id');
        var city = params["city"] != undefined ? params["city"] : toString(cityCompanyID);
        location.search = "chop=" + companyID + "&" +"city=" + city;
    });
    
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
        $(this).closest('.rating-center__search_form').find('.rating-center__search_form-select input[type=text]').attr('placeholder',$(this).find('.itemText').html());
        $(this).closest('.rating-center__search_form').find('.rating-center__search_form-select input[type=text]').attr('data-id',$(this).find('.itemText').attr('data-id'));
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').addClass('actived');
        $(this).closest('.searchForm__modal').find('.searchForm__modal_topChek').html($(this).clone());
    });

    var stepOneNext = document.querySelector(".review__btn.step-1 .next");
    var stepOneReview = document.querySelector(".review__btn.step-1 .add-review");
    var inputStepOne = document.querySelector("#pseudo__range-review-1");
    var textareaCommentOne = document.querySelector("textarea[name=step-1-coment]");

    if(document.querySelector(".review__massage").getAttribute("data-type") == 0){
        // Убирает табы с 2 уровнем и 3-ем уровнем отзывов
        document.querySelector('.review__mid-step-2').style.display = "none";
        document.querySelector('.review__mid-step-3').style.display = "none";
    }

    // Валидация "формы" для перехода на 2 уровень оценок
    inputStepOne.addEventListener("input", function(){
        if(inputStepOne.value <= 30000){
            if(textareaCommentOne.value == ""){
                stepOneNext.disabled = true;
                stepOneReview.disabled = true;

                textareaCommentOne.style.border = "1px solid red";
            }
        }else if(inputStepOne.value > 30000 && inputStepOne.value <= 50000){
            stepOneNext.disabled = false;
            stepOneReview.disabled = false;

            textareaCommentOne.style.border = "1px solid #d1dbe3";
        }
    });

    textareaCommentOne.addEventListener("input", function(){
        if(inputStepOne.value <= 30000){
            if(textareaCommentOne.value != ""){
                stepOneNext.disabled = false;
                stepOneReview.disabled = false;

                textareaCommentOne.style.border = "1px solid #d1dbe3";
            }else{
                stepOneNext.disabled = true;
                stepOneReview.disabled = true;

                textareaCommentOne.style.border = "1px solid red";
            }
        }
    });

    stepOneNext.addEventListener("click", function(){
        setDataForAjax(1);

        document.querySelector('.review__mid-step-2 .icon').style.display = "none";
        document.querySelector('.review__mid-step-2 .bonus').style.display = "none";
        document.querySelector('.review__mid-step-1 .pic').style.display = "none";
    });

    stepOneReview.addEventListener("click", function(){
        setDataForAjax(1);

        sendAjax();
    });

    var inputsStepTwo = document.querySelectorAll("#pseudo__range-review-2");
    var stepTwoNext = document.querySelector(".review__btn.step-2 .next");
    var stepTwoReview = document.querySelector(".review__btn.step-2 .add-review-block .add-review");
    var textareaCommentTwo = document.querySelectorAll("textarea[name=step-2-coment]");
    var count = [1, 2, 3];

    // Валидация "формы" для перехода на 3 уровень оценок
    inputsStepTwo.forEach(function(item, i){
        item.addEventListener("change", function(){
            if(item.value < 18000){
                textareaCommentTwo[i].style.border = "1px solid #d1dbe3";
            }
            if (item.value > 18000 && item.value < 58000) {
                if(textareaCommentTwo[i].value == ""){
                    count.splice(count.indexOf(i), 1);
                    textareaCommentTwo[i].style.border = "1px solid red";
                }
            } else if (item.value > 58000 && item.value < 78000) {
                if(count.length <= 3 && count.indexOf(i) == -1){
                    count.push(i);
                }

                textareaCommentTwo[i].style.border = "1px solid #d1dbe3";
            }

            if(count.length == 3){
                stepTwoNext.disabled = false;
                stepTwoReview.disabled = false;
            }else{
                stepTwoNext.disabled = true;
                stepTwoReview.disabled = true;
            }
        });

        textareaCommentTwo[i].addEventListener("change", function(){
            if (item.value > 18000 && item.value < 58000) {
                if(textareaCommentTwo[i].value != ""){
                    if(count.length <= 3 && count.indexOf(i) == -1){
                        count.push(i);
                    }

                    textareaCommentTwo[i].style.border = "1px solid #d1dbe3";
                }else{
                    count.splice(count.indexOf(i), 1);

                    textareaCommentTwo[i].style.border = "1px solid red";
                }

                if(count.length == 3){
                    stepTwoNext.disabled = false;
                    stepTwoReview.disabled = false;
                }else{
                    stepTwoNext.disabled = true;
                    stepTwoReview.disabled = true;
                }
            }
        });
    });

    stepTwoNext.addEventListener("click", function(){
        setDataForAjax(2);

        document.querySelector('.review__mid-step-2 .icon').style.display = "none";
        document.querySelector('.review__mid-step-2 .bonus').style.display = "none";
        document.querySelector('.review__mid-step-3 .icon').style.display = "none";
        document.querySelector('.review__mid-step-3 .bonus').style.display = "none";

        var inputsStepThree = document.querySelectorAll(".step-3-item.active .smile-input.step-3");

        inputsStepThree.forEach(function(inputItem){
            inputItem.addEventListener("change", function(){
                var stepThreeItems = document.querySelectorAll(".step-3-item.active .content-wrapper .list-q .q");
                var score = 0;
                
                stepThreeItems.forEach(function(item){
                    var span = item.querySelector(".q-right span").innerHTML;
                    score += parseInt(span != "?" ? span : "0");
                })
                score /= stepThreeItems.length;

    
                document.querySelector(".step-3-item.active .content-wrapper .number-block .number").innerHTML = score.toFixed(1);
            });
        });
    });

    stepTwoReview.addEventListener("click", function(){
        setDataForAjax(2);

        sendAjax();
    });

    var stepThreeContinue = document.querySelector(".next-btn-bottom");
    var stepThreeEnd = document.querySelector(".review__btn.step-3 .stop");

    stepThreeContinue.addEventListener("click", function(){
        var inputsStepThree = document.querySelectorAll(".step-3-item.active .smile-input.step-3");

        inputsStepThree.forEach(function(inputItem){
            inputItem.addEventListener("change", function(){
                var stepThreeItems = document.querySelectorAll(".step-3-item.active .content-wrapper .list-q .q");
                var score = 0;

                stepThreeItems.forEach(function(item){
                    var span = item.querySelector(".q-right span").innerHTML;
                    score += parseInt(span != "?" ? span : "0");
                })
                score /= stepThreeItems.length;
    
                document.querySelector(".step-3-item.active .content-wrapper .number-block .number").innerHTML = score.toFixed(1);
            });
        });
    });

    stepThreeEnd.addEventListener("click", function(){
        setDataForAjax(3);

        sendAjax();
    });
})