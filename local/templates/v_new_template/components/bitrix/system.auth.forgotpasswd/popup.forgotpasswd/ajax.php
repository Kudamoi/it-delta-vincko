<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();

header('Content-type: application/json');

$return = $APPLICATION->arAuthResult;
if ($return["TYPE"] == "ERROR") {
	if(!empty($_REQUEST["USER_EMAIL"]) || !empty($_REQUEST["USER_LOGIN"])) {
		//проверяем существует ли пользователь
		if(!empty($_REQUEST["USER_EMAIL"])){
			$filter = ["EMAIL" => $_REQUEST["USER_EMAIL"]];
		}else{
			$filter = ["LOGIN"=> $_REQUEST["USER_LOGIN"]];
		}
		$rsUsers = CUser::GetList(
			false,
			false,
			$filter
		);

		if ($arUsers = $rsUsers->Fetch()) {

			if(!empty($_REQUEST["USER_CHECKWORD_SMS"]) || !empty($_REQUEST["USER_CHECKWORD_SMS"])) {
				$return["FIELD"] = ($_REQUEST["USER_CHECKWORD_SMS"] ? "USER_CHECKWORD_SMS" : "USER_CHECKWORD_EMAIL");
				$return["MESSAGE"] = "Неверный проверочный код";
			}elseif($_REQUEST["USER_PASSWORD"]!=$_REQUEST["USER_CONFIRM_PASSWORD"]){
				$return["FIELD"] = "USER_CONFIRM_PASSWORD";
				$return["MESSAGE"] = "Проли не совпадают";
			}
		}else{
			if (!empty($_REQUEST["USER_EMAIL"])) {
				$return["FIELD"] = "USER_EMAIL";
				$return["MESSAGE"] = "Данный e-mail не зарегистрирован на сайте";
			} elseif (!empty($_REQUEST["USER_LOGIN"])) {
				$return["FIELD"] = "USER_LOGIN";
				$return["MESSAGE"] = "Данный номер не зарегистрирован на сайте";
			}
		}
	}
}
echo json_encode($return);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>