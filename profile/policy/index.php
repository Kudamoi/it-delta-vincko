<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

<?
$APPLICATION->IncludeComponent(
	"vincko:policy.pdf",
	"",
	Array(
		"FPDF_FONTPATH"=>"/local/templates/v_new_template/fonts/ArialN",
		"FONT" =>"ARIALN.php"
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>