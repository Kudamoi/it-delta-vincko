<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

?>

<div class="popup popup--new-pass">
	<div class="popup__wall"></div>

	<div class="popup__content">

		<div class="popup__head">
			<div class="popup__close">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.99926 7.99993L14.8713 2.12784C14.9874 1.99234 15.048 1.81804 15.0411 1.63977C15.0343 1.46149 14.9604 1.29239 14.8342 1.16624C14.7081 1.04009 14.5389 0.966185 14.3607 0.959299C14.1824 0.952413 14.0081 1.01305 13.8726 1.12909L8.00051 7.00118L2.12843 1.12201C1.99504 0.988629 1.81414 0.913696 1.62551 0.913696C1.43688 0.913696 1.25598 0.988629 1.12259 1.12201C0.989211 1.25539 0.914278 1.4363 0.914278 1.62493C0.914278 1.81356 0.989211 1.99446 1.12259 2.12784L7.00176 7.99993L1.12259 13.872C1.04844 13.9355 0.988221 14.0137 0.945705 14.1015C0.903188 14.1894 0.879296 14.2851 0.875528 14.3827C0.87176 14.4802 0.888197 14.5775 0.923808 14.6684C0.959419 14.7593 1.01344 14.8419 1.08247 14.9109C1.1515 14.9799 1.23405 15.0339 1.32495 15.0695C1.41584 15.1052 1.51312 15.1216 1.61067 15.1178C1.70822 15.1141 1.80394 15.0902 1.89182 15.0477C1.9797 15.0051 2.05784 14.9449 2.12134 14.8708L8.00051 8.99868L13.8726 14.8708C14.0081 14.9868 14.1824 15.0474 14.3607 15.0406C14.5389 15.0337 14.7081 14.9598 14.8342 14.8336C14.9604 14.7075 15.0343 14.5384 15.0411 14.3601C15.048 14.1818 14.9874 14.0075 14.8713 13.872L8.99926 7.99993Z"
						  fill="#005DFF"/>
				</svg>
			</div>
			<div class="popup__title">
				<?= Loc::getMessage("CHANGE_TITLE") ?>
			</div>

			<div class="popup__subtitle">
				<?= ($GLOBALS["USER"]->GetFullName() ?
					str_replace("#NAME#", ", " . $GLOBALS["USER"]->GetFullName(), Loc::getMessage("CHANGE_TITLE"))
					:
					Loc::getMessage("CHANGE_TITLE")
				) ?>
			</div>

			<div class="popup__text">
				<?=Loc::getMessage("CHANGE_TEXT") ?>
			</div>
		</div>
		<div class="popup__main">
			<form method="post" action="<?= $arResult["AUTH_URL"] ?>" name="bform" class="popup__form">
				<? if ($arResult["BACKURL"] <> ''): ?>
					<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
				<? endif ?>
				<input type="hidden" name="AUTH_FORM" value="Y">
				<input type="hidden" name="TYPE" value="CHANGE_PWD">
				<input type="hidden" name="USER_LOGIN" value="<?= $arResult["LAST_LOGIN"] ?>"/>
				<div class="popup__form-title">
					<?=Loc::getMessage("CHANGE_NEW") ?>
				</div>

				<div class="pass-wrapper">
					<input type="password" placeholder="<?=Loc::getMessage("CHANGE_PASW") ?>" name="USER_PASSWORD" maxlength="255"
						   value="<?= $arResult["USER_PASSWORD"] ?>" class="pass-input" autocomplete="new-password"/>
					<div class="pass__eye">
						<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M16 6C16 6 13 0.5 8 0.5C3 0.5 0 6 0 6C0 6 3 11.5 8 11.5C13 11.5 16 6 16 6ZM1.173 6C1.65651 5.26512 2.21264 4.58069 2.833 3.957C4.12 2.668 5.88 1.5 8 1.5C10.12 1.5 11.879 2.668 13.168 3.957C13.7884 4.58069 14.3445 5.26512 14.828 6C14.77 6.087 14.706 6.183 14.633 6.288C14.298 6.768 13.803 7.408 13.168 8.043C11.879 9.332 10.119 10.5 8 10.5C5.88 10.5 4.121 9.332 2.832 8.043C2.21165 7.41931 1.65552 6.73487 1.172 6H1.173Z"
								  fill="black"/>
							<path d="M8 3.5C7.33696 3.5 6.70107 3.76339 6.23223 4.23223C5.76339 4.70107 5.5 5.33696 5.5 6C5.5 6.66304 5.76339 7.29893 6.23223 7.76777C6.70107 8.23661 7.33696 8.5 8 8.5C8.66304 8.5 9.29893 8.23661 9.76777 7.76777C10.2366 7.29893 10.5 6.66304 10.5 6C10.5 5.33696 10.2366 4.70107 9.76777 4.23223C9.29893 3.76339 8.66304 3.5 8 3.5ZM4.5 6C4.5 5.07174 4.86875 4.1815 5.52513 3.52513C6.1815 2.86875 7.07174 2.5 8 2.5C8.92826 2.5 9.8185 2.86875 10.4749 3.52513C11.1313 4.1815 11.5 5.07174 11.5 6C11.5 6.92826 11.1313 7.8185 10.4749 8.47487C9.8185 9.13125 8.92826 9.5 8 9.5C7.07174 9.5 6.1815 9.13125 5.52513 8.47487C4.86875 7.8185 4.5 6.92826 4.5 6Z"
								  fill="black"/>
						</svg>
					</div>
				</div>

				<div class="pass-wrapper">
					<input type="password" name="USER_CONFIRM_PASSWORD" placeholder="<?=Loc::getMessage("CHANGE_PASW_CONFIRM") ?>"
						   value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" class="pass-input"/>
					<div class="pass__eye">
						<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M16 6C16 6 13 0.5 8 0.5C3 0.5 0 6 0 6C0 6 3 11.5 8 11.5C13 11.5 16 6 16 6ZM1.173 6C1.65651 5.26512 2.21264 4.58069 2.833 3.957C4.12 2.668 5.88 1.5 8 1.5C10.12 1.5 11.879 2.668 13.168 3.957C13.7884 4.58069 14.3445 5.26512 14.828 6C14.77 6.087 14.706 6.183 14.633 6.288C14.298 6.768 13.803 7.408 13.168 8.043C11.879 9.332 10.119 10.5 8 10.5C5.88 10.5 4.121 9.332 2.832 8.043C2.21165 7.41931 1.65552 6.73487 1.172 6H1.173Z"
								  fill="black"/>
							<path d="M8 3.5C7.33696 3.5 6.70107 3.76339 6.23223 4.23223C5.76339 4.70107 5.5 5.33696 5.5 6C5.5 6.66304 5.76339 7.29893 6.23223 7.76777C6.70107 8.23661 7.33696 8.5 8 8.5C8.66304 8.5 9.29893 8.23661 9.76777 7.76777C10.2366 7.29893 10.5 6.66304 10.5 6C10.5 5.33696 10.2366 4.70107 9.76777 4.23223C9.29893 3.76339 8.66304 3.5 8 3.5ZM4.5 6C4.5 5.07174 4.86875 4.1815 5.52513 3.52513C6.1815 2.86875 7.07174 2.5 8 2.5C8.92826 2.5 9.8185 2.86875 10.4749 3.52513C11.1313 4.1815 11.5 5.07174 11.5 6C11.5 6.92826 11.1313 7.8185 10.4749 8.47487C9.8185 9.13125 8.92826 9.5 8 9.5C7.07174 9.5 6.1815 9.13125 5.52513 8.47487C4.86875 7.8185 4.5 6.92826 4.5 6Z"
								  fill="black"/>
						</svg>
					</div>
				</div>
			</form>
		</div>

		<div class="popup__bottom">
			<div class="blue-button">
				<?=Loc::getMessage("CHANGE_SAVE") ?>
			</div>

		</div>
	</div>
</div>