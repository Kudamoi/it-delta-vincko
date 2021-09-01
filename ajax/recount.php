<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();

//if ($request->isPost()) {

    $sum = $request->getPost('sum');
    $period = $request->getPost('period');

    $result = \Vincko\Other::formatInstalmentPrice($sum, $period);

    echo $result;
//}
