<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();

header('Content-type: application/json');

if (!$GLOBALS["USER"]->IsAuthorized()) {
//все ли ок
	$return = $GLOBALS["USER"]->Login(
		strip_tags($request->getPost('USER_LOGIN')),
		strip_tags($request->getPost('USER_PASSWORD')),
		($request->getPost('USER_REMEMBER') == "Y" ?
			$request->getPost('USER_REMEMBER')
			:
			"N"
		));

	if (empty($return['MESSAGE'])) {
		$result = [
			"TYPE"    => "OK",
		];
	} else {
		$rsUser = CUser::GetByLogin( strip_tags($request->getPost('USER_LOGIN')) );
		if ($arUser = $rsUser->Fetch()){
			$result = [
				"TYPE"    => "ERROR",
				"MESSAGE" => "Неверный пароль",
				"FIELD" => "USER_PASSWORD"
			];
		}else{
			$result = [
				"TYPE"    => "ERROR",
				"MESSAGE" => "Пользователь с текущем номером не существует",
				"FIELD" => "USER_LOGIN"
			];
		}
	}
	echo json_encode($result).$return['MESSAGE']."123";
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>
