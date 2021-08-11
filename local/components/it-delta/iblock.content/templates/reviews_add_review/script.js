$(document).ready(function() {
    let score = {};

    var stepOneNext = document.querySelector(".review__btn.step-1 .next");
    var stepTwoNext = document.querySelector(".review__btn.step-2 .next");
    var stepThreeEnd = document.querySelector(".review__btn.step-3 .stop");

    var inputStepOne = document.querySelector("#pseudo__range-review-1");
    var textareaCommentOne = document.querySelector("textarea[name=step-1-coment]");
    stepOneNext.disabled = true;

    inputStepOne.addEventListener("change", function(){
        if(inputStepOne.value < 10000){
            stepOneNext.disabled = true;
        }else if(inputStepOne.value > 10000 && inputStepOne.value <= 20000){
            stepOneNext.disabled = true;
        }else if(inputStepOne.value > 20000 && inputStepOne.value <= 30000){
            stepOneNext.disabled = true;
        }else if(inputStepOne.value > 30000 && inputStepOne.value <= 40000){
            stepOneNext.disabled = false;
        }else if(inputStepOne.value > 40000 && inputStepOne.value <= 50000){
            stepOneNext.disabled = false;
        }
    });

    textareaCommentOne.addEventListener("input", function(){
        if((inputStepOne.value < 10000) || (inputStepOne.value > 10000 && inputStepOne.value <= 20000) || (inputStepOne.value > 20000 && inputStepOne.value <= 30000)){
            if(textareaCommentOne.value != ""){
                stepOneNext.disabled = false;
            }else{
                stepOneNext.disabled = true;
            }
        }
    });

    stepOneNext.addEventListener("click", function(){
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

        stepTwoNext.disabled = true;
    });

    var inputStepTwo = document.querySelectorAll("#pseudo__range-review-2");
    var textareaCommentTwo = document.querySelectorAll("textarea[name=step-2-coment]");
    var count = [];
    var countComments = [];

    inputStepTwo.forEach(function(item, i){
        item.addEventListener("change", function(){
            if (item.value < 18000) {
                count.pop(i);
                textareaCommentTwo[i].addEventListener("change", function(){
                    if(textareaCommentTwo[i].value != ""){
                        count.push(i);
                    }else{
                        count.pop(i);
                    }
                });
            } else if (item.value > 18000 && item.value < 28000) {
                count.pop(i);
                textareaCommentTwo[i].addEventListener("change", function(){
                    if(textareaCommentTwo[i].value != ""){
                        count.push(i);
                    }else{
                        count.pop(i);
                    }
                });
            } else if (item.value > 28000 && item.value < 38000) {
                count.pop(i);
                textareaCommentTwo[i].addEventListener("change", function(){
                    if(textareaCommentTwo[i].value != ""){
                        count.push(i);
                    }else{
                        count.pop(i);
                    }
                });
            } else if (item.value > 38000 && item.value < 48000) {
                count.pop(i);
                textareaCommentTwo[i].addEventListener("change", function(){
                    if(textareaCommentTwo[i].value != ""){
                        count.push(i);
                    }else{
                        count.pop(i);
                    }
                });
            } else if (item.value > 48000 && item.value < 58000) {
                count.pop(i);
                textareaCommentTwo[i].addEventListener("change", function(){
                    if(textareaCommentTwo[i].value != ""){
                        count.push(i);
                    }else{
                        count.pop(i);
                    }
                });
            } else if (item.value > 58000 && item.value < 68000) {
                count.push(i);
                textareaCommentTwo[i].removeEventListener("change", function(){});
            } else if (item.value > 68000 && item.value < 78000) {
                count.push(i);
                textareaCommentTwo[i].removeEventListener("change", function(){});
            }

            if(count.length == inputStepTwo.length){
                stepTwoNext.disabled = false;
            }else{
                stepTwoNext.disabled = true;
            }
        });
    });

    stepTwoNext.addEventListener("click", function(){
        var stepTwoItems = document.querySelectorAll(".review__bottom-item");

        stepTwoItems.forEach(function(item, i){
            var span = item.querySelector(".number-wrapper > span").innerHTML;
            var textarea = item.querySelector("textarea[name=step-2-coment]");
            var element = item.querySelector("div.item-name");
            var scoreSections = document.querySelectorAll(".step-3-item .content-wrapper .number-block .number");

            if(element.getAttribute("id") == 45){
                score["CUSTOMER_FOCUS_SCORE"] = span != "?" ? span : "";
                score["CUSTOMER_FOCUS_COMMENT"] = textarea.value;
            }else if (element.getAttribute("id") == 46) {
                score["COMFORT_SCORE"] = span != "?" ? span : "";
                score["COMFORT_SCORE_COMMENT"] = textarea.value;
            } else {
                score["SECURITY_SCORE"] = span != "?" ? span : "";
                score["SECURITY_SCORE_COMMENT"] = textarea.value;
            }

            scoreSections.forEach(function(item, i){
                if(item.getAttribute("id") == 45){
                    item.innerHTML = score["CUSTOMER_FOCUS_SCORE"];
                }else if (item.getAttribute("id") == 46) {
                    item.innerHTML = score["COMFORT_SCORE"];
                } else {
                    item.innerHTML = score["SECURITY_SCORE"];
                }
            });
        });
    });

    stepThreeEnd.addEventListener("click", function(){
        var stepThreeItems = document.querySelectorAll(".step-3-item .content-wrapper .list-q .q");

        let arrElements = [];

        stepThreeItems.forEach(function(item, i){
            var span = item.querySelector(".q-right span").innerHTML;
            var questionId = item.querySelector(".q-left h5");
            var textarea = item.querySelector("textarea[name=coment]");

            arrElements[i] = new Object();
            arrElements[i]["QUESTION_ID"] = questionId.getAttribute("data-id");
            arrElements[i]["REVIEW_SCORE"] = span != "?" ? span : "";
            arrElements[i]["REVIEW_SCORE_COMMENT"] = textarea.value;
        });

        var params = window.location.search.replace("?","").split("&").reduce(
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

        $.ajax({
            method: "POST",
            url: "/ajax/addFeedback.php",
            data: {'feedbackData': score},
            dataType: "html",
            success: function(data){
                console.log(data);
            }
        });
    });
});