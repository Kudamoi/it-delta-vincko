<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>

<div class="login__flex">
	<div class="login__form">
	<?if($arResult["AUTH_SERVICES"]):?>
		<div class="login__form-title"><?echo GetMessage("AUTH_TITLE")?></div>
	<?endif?>
		<div class="login__form-title"><?=GetMessage("У меня есть учетная запись")?></div>

		<form name="form_auth" class="login__form-form" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />
			<?if ($arResult["BACKURL"] <> ''):?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
			<?foreach ($arResult["POST"] as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			
			<div class="login__form-block">
				<label class="login__form-label" for="user-login"><?=GetMessage("AUTH_LOGIN")?></label>
				<input class="login__form-input" type="text" name="USER_LOGIN" id="user-login" maxlength="255" placeholder="Введите номер телефона" value="<?=$arResult["LAST_LOGIN"]?>">
			</div>
			
			<div class="login__form-block">
				<label class="login__form-label" for="user-password"><?=GetMessage("AUTH_PASSWORD")?></label>
				<input class="login__form-input" type="password" name="USER_PASSWORD" id="user-password" maxlength="255" autocomplete="off">
			</div>
			
	<?if($arResult["SECURE_AUTH"]):?>
					<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
						<div class="bx-auth-secure-icon"></div>
					</span>
					<noscript>
					<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
						<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
					</span>
					</noscript>
	<script type="text/javascript">
	document.getElementById('bx_auth_secure').style.display = 'inline-block';
	</script>
	<?endif?>
					
				<?if($arResult["CAPTCHA_CODE"]):?>
					<div class="login__form-block">
						<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
					</div>
					<div class="login__form-block">
						<label class="login__form-label" for="captcha"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
						<input class="login__form-input bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" />
					</div>
				<?endif;?>
				<?/*
	<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
				<tr>
					<td></td>
					<td><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /><label for="USER_REMEMBER">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label></td>
				</tr>
	<?endif?>
	*/?>
				<input type="submit" class="login__form-submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>">
			</table>

	<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
			<noindex>
			<div class="login__form-forget">
				<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow" class="login__form-forget-password"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
			</div>
			</noindex>
	<?endif?>

	<?/*
	<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
			<noindex>
				<p>
					<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
					<?=GetMessage("AUTH_FIRST_ONE")?>
				</p>
			</noindex>
	<?endif?>
	*/?>
		</form>
	</div>
	<div class="login__text">
		<div class="login__text-title"><?=GetMessage('AUTH_REGISTER_RIGHT_TITLE');?></div>
		<div class="login__text-info"><?=GetMessage('AUTH_REGISTER_RIGHT_DESCRIPTION');?></div>
		<noindex>
		<?if (!empty($_REQUEST["backurl"])){?>
		<a href="<?=$arResult['AUTH_REGISTER_URL']?>?backurl=<?=$_REQUEST["backurl"]?>" class="login__text-registration-link"><?=GetMessage('AUTH_REGISTER');?></a>
		<?}else{?>
		<a href="<?=$arResult['AUTH_REGISTER_URL']?>" class="login__text-registration-link"><?=GetMessage('AUTH_REGISTER');?></a>
		<?}?>
		</noindex>
	</div>
</div>

<script type="text/javascript">
<?if ($arResult["LAST_LOGIN"] <> ''):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>