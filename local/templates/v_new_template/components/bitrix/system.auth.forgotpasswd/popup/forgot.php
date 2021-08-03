<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
?>


<div class="popup popup--forget">
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
				<?= Loc::getMessage("FORGOT_TITLE")  ?>
			</div>

			<div class="popup__switch">
				<div class="popup__switch-item popup__switch-item-left popup__switch-item--active">
					<?= Loc::getMessage("FORGOT_PHONE")  ?>
				</div>

				<div class="popup__switch-choice">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="1" y="1" width="22" height="22" rx="11" fill="#93B6FF"/>
						<rect x="1" y="1" width="22" height="22" rx="11" stroke="white" stroke-width="2"/>
					</svg>
				</div>

				<div class="popup__switch-item popup__switch-item-right ">
					<?= Loc::getMessage("FORGOT_EMAIL")  ?>
				</div>

			</div>
			<div class="popup__text">
				<?= Loc::getMessage("FORGOT_PHONE_TEXT")  ?>
			</div>
		</div>
		<form name="bform"  method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
			<?
			if ($arResult["BACKURL"] <> '')
			{
				?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
				<?
			}
			?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="SEND_PWD">
		<div class="popup__main">

			<div class="popup__form popup__form--phone">
				<div class="popup__form-title">
					<?= Loc::getMessage("FORGOT_PHONE_YOUR")  ?>
				</div>


				<div class="phone-wrapper">
					<input placeholder="<?= Loc::getMessage("FORGOT_PHONE_PLACE")  ?>" type="tel" class="phone-input">
				</div>


				<div class="popup__wait">
					<div class="popup__wait-time">
						<?= Loc::getMessage("FORGOT_RE_TIME")  ?>
						<span class="popup__wait-num">
                                  <?=$arParams["TIMEOUT"]?>
                            </span>
						сек
					</div>
					<div class="popup__wait-repeat">
						<?= Loc::getMessage("FORGOT_RE")  ?>
					</div>
				</div>


				<div class="grey-border-button grey-border-button--unactive">
					<?= Loc::getMessage("FORGOT_SMS")  ?>
				</div>

				<input type="text" placeholder="<?= Loc::getMessage("FORGOT_SMS_CODE")  ?>" class="popup__code">

				<div class="popup__send-code blue-button">
					<svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd"
							  d="M9.64018 0.731804C10.0645 1.08537 10.1218 1.71593 9.76822 2.14021L4.76822 8.14021C4.58836 8.35605 4.32599 8.48627 4.04531 8.499C3.76464 8.51173 3.49156 8.4058 3.29289 8.20713L0.292893 5.20713C-0.0976311 4.81661 -0.0976311 4.18344 0.292893 3.79292C0.683417 3.40239 1.31658 3.40239 1.70711 3.79292L3.9328 6.01861L8.23178 0.859841C8.58534 0.435564 9.21591 0.37824 9.64018 0.731804Z"
							  fill="white"/>
					</svg>

				</div>


			</div>

			<div class="popup__form popup__form--mail">
				<div class="popup__form-title">
					<?= Loc::getMessage("FORGOT_EMAIL_ADDRESS")  ?>
				</div>

				<div class="popup__wait">
				</div>

				<div class="grey-border-button grey-border-button--unactive">
					<?= Loc::getMessage("FORGOT_POST")  ?>
				</div>

				<input type="text" placeholder="<?= Loc::getMessage("FORGOT_EMAIL_CODE")?>" class="popup__code">


			</div>
		</div>

		<div class="popup__bottom">
			<button name="send_account_info" class="new-pass-button blue-button blue-button--unactive" value="1">
				<?= Loc::getMessage("FORGOT_UPDATE_PASS")  ?>
			</button>

			<div class="popup__bottom-b">
				<div class="text-button" data-modal="<?=$arParams["AUTH_URL"]?>">
					<?= Loc::getMessage("FORGOT_BTN_AUTH")  ?>
				</div>

				<div class="text-button" data-modal="<?=$arParams["REGISTER_URL"]?>">
					<?= Loc::getMessage("FORGOT_BTN_REG")  ?>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
