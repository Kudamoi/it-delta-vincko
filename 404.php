<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

<main class="404">
    <div class="empty">
        <picture>
            <img src="/upload/404/empty-man.png" alt="">
        </picture>

        <div class="empty-title">Было же где-то здесь...</div>
        <div class="empty-text">К сожалению, мы ничего не нашли по Вашему запросу
            Попробуйте сформулировать иначе или свяжитесь с нами</div>
    </div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/callback.php"
        )
    );?>
</main>

<!-- <div class="page404">
	<div class="page404__icon"></div>
	<div class="page404__title">Страница не найдена</div>
	<div class="page404__description">К сожалению, страница, которую вы запросили, не была найдена<br/>(ошибка 404). Вы можете перейти на <a href="/">главную страницу</a> или<br/>воспользоваться <a href="/pakety-okhrannykh-uslug/">списком пакетов</a>.</div>
</div> -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>