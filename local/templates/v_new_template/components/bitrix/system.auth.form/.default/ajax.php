<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();

header('Content-type: application/json');

if (!$GLOBALS["USER"]->IsAuthorized()) {

	$return = $GLOBALS["USER"]->Login(strip_tags($request->getPost('USER_LOGIN')), strip_tags($request->getPost('USER_PASSWORD')), 'Y');

	if (empty($return['MESSAGE'])) {
		$result = [
			"TYPE" => "OK",
			"MESSAGE" => ""
		];
	} else {
		$result = [
			"TYPE" => "ERROR",
			"MESSAGE" => strip_tags($return['MESSAGE'])
		];
	}

	echo json_encode($result);
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");

/*
<div class="info-popup">
	<div class="info-popup__wrapper">
		<div class="info-popup__sign">
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
				 xmlns="http://www.w3.org/2000/svg">
				<path d="M8.99996 17.3333C4.40496 17.3333 0.666626 13.595 0.666626 8.99998C0.666626 4.40498 4.40496 0.666645 8.99996 0.666645C13.595 0.666645 17.3333 4.40498 17.3333 8.99998C17.3333 13.595 13.595 17.3333 8.99996 17.3333ZM9.83329 4.83331H8.16663V9.83331H9.83329V4.83331ZM9.83329 11.5H8.16663V13.1666H9.83329V11.5Z"
					  fill="#FF3232"/>
			</svg>
		</div>
		<div class="info-popup__text">
			Извините, пользователь с таким номером телефона не зарегистрирован. Проверьте
			правильность ввода номера.
		</div>
	</div>
</div>
*/?>
