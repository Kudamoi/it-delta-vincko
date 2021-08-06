<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

/*\Bitrix\Main\Page\Asset::getInstance()->addCss(
	'/bitrix/css/main/system.auth/flat/style.css'
);*/

if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_FORM_SUCCESS');
	return;
}
?>
<div class="test">
	<h1>TEST</h1>
</div>
<div class="login">

	<div class="login__flex">
		<div class="login__form">

			<?if ($arResult['ERRORS']):?>
			<div class="alert alert-danger">
				<? foreach ($arResult['ERRORS'] as $error)
				{
					echo $error;
				}
				?>
			</div>
			<?endif;?>

			<div class="login__form-title"><?= Loc::getMessage('MAIN_AUTH_FORM_HEADER');?></div>

			<form class="login__form-form" name="<?= $arResult['FORM_ID'];?>" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>">
				<div class="login__form-block">
					<label class="login__form-label" for="login"><?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?></label>
					<input class="login__form-input" type="text" name="<?=$arResult['FIELDS']['login'];?>" id="login" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>"  placeholder="Введите номер телефона">
				</div>
				
				<div class="login__form-block">
					<label class="login__form-label" for="password">ПРОШУ, ДАЙ ЗНАК МНЕ<?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?></label>
					<?if ($arResult['SECURE_AUTH']):?>
					<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
						<div class="bx-authform-psw-protected-desc"><span></span>
							<?=Loc::getMessage('MAIN_AUTH_FORM_SECURE_NOTE');?>
						</div>
					</div>
					<script type="text/javascript">
						document.getElementById('bx_auth_secure').style.display = '';
					</script>
					<?endif?>
					<input class="login__form-input" type="password" name="<?= $arResult['FIELDS']['password'];?>" maxlength="255" autocomplete="off" id="password" placeholder="Введите пароль">
				</div>

				<?if ($arResult['CAPTCHA_CODE']):?>
					<input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
					<div class="bx-authform-formgroup-container dbg_captha">
						<div class="bx-authform-label-container">
							<?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_CAPTCHA');?>
						</div>
						<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
						<div class="bx-authform-input-container">
							<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
						</div>
					</div>
				<?endif;?>

				<?/*
				<?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
				<div class="login__form-block login__form-block-checkbox">
					<input type="checkbox" id="USER_REMEMBER" name="<?= $arResult['FIELDS']['remember'];?>" class="reg__form-checkbox" value="Y">
					<label class="reg__form-pp" for="USER_REMEMBER"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER');?></label>
				</div>
				<?endif?>
				*/?>
				<input type="hidden" id="USER_REMEMBER" name="<?=$arResult["FIELDS"]["remember"];?>" value="Y">
				<input type="submit" name="<?= $arResult['FIELDS']['action'];?>" class="login__form-submit" value="<?=Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>">
			</form>
			<?if ($arResult['AUTH_FORGOT_PASSWORD_URL'] || $arResult['AUTH_REGISTER_URL']):?>
				<noindex>
				<?if ($arResult['AUTH_FORGOT_PASSWORD_URL']):?>
					<div class="login__form-forget">
						<a class="login__form-forget-password" href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'];?>" rel="nofollow">
							<?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?>
						</a>
					</div>
				<?endif;?>
				</noindex>
			<?endif;?>
		</div>
		<div class="login__text">
			<div class="login__text-title">Регистрация офигенно нового пользователя</div>
			<div class="login__text-info">(ПАМАГИТИ) Регистрация на нашем сайте дает возможность оценивать охранные организации и заказывать пакеты услуг.</div>
			<noindex>
			<?if (!empty($_REQUEST["backurl"])){?>
			<a href="<?=$arResult['AUTH_REGISTER_URL']?>?backurl=<?=$_REQUEST["backurl"]?>" class="login__text-registration-link"><?=Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?></a>
			<?}else{?>
			<a href="<?=$arResult['AUTH_REGISTER_URL']?>" class="login__text-registration-link"><?=Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?></a>
			<?}?>
			</noindex>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>