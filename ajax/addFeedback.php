<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();

//if ($request->isPost() && $request->isAjaxRequest()) {
$data = json_decode($request['feedbackData']);

//    $dto = new FeedbackDTO([
//        'userId' => $data['userId'],
//
//    ]);
$data = [
    "CITY_ID" => 526,
    "CHOP_ID" => 372,
    "ALLSCORE_REVIEW_SCORE" => 5,
    "ALLSCORE_REVIEW_SCORE_COMMENT" => "Коммент к общей оценке",
    "CUSTOMER_FOCUS_SCORE" => 4,
    "CUSTOMER_FOCUS_COMMENT" => "Комментарий к клиентоориентированости",
    "COMFORT_SCORE" => 4,
    "COMFORT_SCORE_COMMENT" => "Комментарий к кофморту",
    "SECURITY_SCORE" => 4,
    "SECURITY_SCORE_COMMENT" => "Комментарий к безопасности",
    "REVIEW_SCORES" => [

        0 => [
            "QUESTION_ID" => 69,
            "REVIEW_SCORE" => 8,
            "REVIEW_SCORE_COMMENT" => "Коммент к оценке"
        ],
        1 => [
            "QUESTION_ID" => 535,
            "REVIEW_SCORE" => 3,
            "REVIEW_SCORE_COMMENT" => "Коммент к оценке"
        ],
    ]
];

//echo FeedbackService::add($data);
//}