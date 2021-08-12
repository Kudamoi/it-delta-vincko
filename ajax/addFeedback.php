<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();

if ($request->isPost() && $request->isAjaxRequest()) {
$data = $request['feedbackData'];

// print_r($data);

//    $dto = new FeedbackDTO([
//        'userId' => $data['userId'],
//
//    ]);

echo FeedbackService::add($data);
}