<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();

if ($request->isPost()) {

    $data = json_decode($request->getPost('data'));
    $session = \Bitrix\Main\Application::getInstance()->getSession();
    $session->set('orderData', $data);

    LocalRedirect("/order/");

}
