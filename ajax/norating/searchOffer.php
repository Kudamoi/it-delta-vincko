<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$packages = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'chop-packet-ap', "PROPERTY_CPA_CHOP" => $_POST['COMPANY'], "ACTIVE" => "Y", 'ID' => $_POST['COMPLECT']), false, false, array('ID', 'NAME', 'PROPERTY_CPA_PACKET.NAME', 'PROPERTY_CPA_PACKET.PREVIEW_TEXT', 'PROPERTY_CPA_PACKET.IBLOCK_SECTION_ID', 'PROPERTY_CPA_PACKET.ID', 'PROPERTY_CPA_PACKET.PROPERTY_CO_CLASS_REF', 'PROPERTY_CPA_PACKET.DETAIL_PAGE_URL', "PROPERTY_CPA_ABONPLATA", "PROPERTY_CPA_PACKET.PROPERTY_P_COMPLECT"));
while ($package = $packages->GetNext()) {
    $src = preg_replace('[//]', '/', $package['PROPERTY_CPA_PACKET_DETAIL_PAGE_URL']);
    $idOfferContainer[] = $package['PROPERTY_CPA_ABONPLATA_VALUE'];
    $arrPackages[$package['ID']] = $package;
}

$idOfferContainer = array_unique($idOfferContainer);

foreach ($idOfferContainer as $id):
    $rsOffersId = CCatalogSKU::getOffersList(array('ID' => $id), false, false, array('ID'));
    foreach ($rsOffersId[$id] as $off):
        $idOffer[] = $off['ID'];
    endforeach;
    $offersList[$id] = $rsOffersId[$id];
endforeach;

$offers = CIBlockElement::GetList(array(), array("ID" => $idOffer), false, false, array("ID", 'CATALOG_GROUP_1', 'PROPERTY_APTP_MESYAC'));

while ($arOffer = $offers->GetNext()) {

    $arOffers[$arOffer['ID']]['ID'] = $arOffer['ID'];
    $arOffers[$arOffer['ID']]['MONTH'] = $arOffer['PROPERTY_APTP_MESYAC_VALUE'];
    $arOffers[$arOffer['ID']]['PRICE'] = $arOffer['CATALOG_PRICE_1'];
}

foreach ($offersList as &$offer):
    $keys = array_keys($offer);
    foreach ($keys as $key):
        $offer[$key] = $arOffers[$key];
    endforeach;
endforeach;

foreach ($arrPackages as $package):
    $month = array_values($offersList[$package['PROPERTY_CPA_ABONPLATA_VALUE']]);
endforeach;

foreach ($month as $offer): ?>
    <input type="text" class="new-page" hidden readonly value="<?=$src?>">
    <div data-id='<?= $offer["ID"] ?>' class="contract__item no-active">
        <div class="contract__item_top">
            <div class="contract__item_title">
                На <?= $offer['MONTH'] ?> месяца
            </div>
            <div class="contract__item_img">
                <svg width="200" height="92" viewBox="0 0 200 92" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <g filter="url(#filter0_d)">
                        <path d="M170 25C170 22.2386 167.761 20 165 20H30V52H170V25Z"
                              fill="#F4F4F4"/>
                    </g>
                    <path d="M170 52L153 52V74L170 52Z" fill="#DADADA"/>
                    <defs>
                        <filter id="filter0_d" x="0" y="0" width="200" height="92"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                            <feColorMatrix in="SourceAlpha" type="matrix"
                                           values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                            <feOffset dy="10"/>
                            <feGaussianBlur stdDeviation="15"/>
                            <feColorMatrix type="matrix"
                                           values="0 0 0 0 0 0 0 0 0 0.219333 0 0 0 0 0.783333 0 0 0 0.1 0"/>
                            <feBlend mode="normal" in2="BackgroundImageFix"
                                     result="effect1_dropShadow"/>
                            <feBlend mode="normal" in="SourceGraphic"
                                     in2="effect1_dropShadow" result="shape"/>
                        </filter>
                    </defs>
                </svg>

                <span><?= number_format($offer['PRICE'], 0, '.', ' ') ?> ₽</span>
            </div>
        </div>
    </div>
<? endforeach; ?>
