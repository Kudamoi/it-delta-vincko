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
    ?>
    <div class="header__top-cabinet">

        <div class="present">
                        <span class="text">
                            <span class="number">0</span>бонусов
                        </span>

            <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.0374383 13.9384C0.074443 14.0781 0.138751 14.2091 0.226651 14.3239C0.31455 14.4386 0.424302 14.5348 0.549573 14.6069L2.65318 15.8228V18.2445C2.65318 18.5366 2.76922 18.8167 2.97576 19.0233C3.18231 19.2298 3.46244 19.3458 3.75454 19.3458H6.17645L7.39235 21.4493C7.48986 21.616 7.62908 21.7544 7.79631 21.851C7.96354 21.9475 8.15303 21.9989 8.34614 22C8.53777 22 8.72831 21.9493 8.89792 21.8513L10.9993 20.6366L13.1029 21.8524C13.3558 21.9983 13.6562 22.0378 13.9383 21.9625C14.2203 21.8871 14.4609 21.703 14.6074 21.4504L15.8222 19.3469H18.2441C18.5362 19.3469 18.8163 19.2309 19.0229 19.0244C19.2294 18.8178 19.3455 18.5377 19.3455 18.2456V15.8239L21.4491 14.608C21.5744 14.5356 21.6842 14.4392 21.7722 14.3243C21.8602 14.2095 21.9248 14.0784 21.9621 13.9386C21.9994 13.7988 22.0088 13.653 21.9898 13.5095C21.9707 13.366 21.9236 13.2278 21.8511 13.1025L20.6363 11.0001L21.8522 8.89882C21.9983 8.64601 22.0381 8.34551 21.9627 8.0634C21.8873 7.78129 21.7029 7.54067 21.4502 7.39444L19.3466 6.17859V3.75571C19.3466 3.46362 19.2305 3.1835 19.024 2.97697C18.8174 2.77043 18.5373 2.6544 18.2452 2.6544H15.8233L14.6085 0.552001C14.4618 0.299709 14.2216 0.115338 13.94 0.0387911C13.8003 0.000923587 13.6545 -0.00884073 13.511 0.0100641C13.3675 0.0289689 13.2291 0.076167 13.104 0.148922L10.9993 1.36367L8.89682 0.147821C8.64399 0.00169292 8.34348 -0.0380498 8.06135 0.037331C7.77923 0.112712 7.53859 0.297045 7.39235 0.549799L6.17645 2.6533H3.75454C3.46244 2.6533 3.18231 2.76933 2.97576 2.97587C2.76922 3.1824 2.65318 3.46252 2.65318 3.75461V6.17639L0.549573 7.39223C0.296879 7.53909 0.112688 7.78011 0.0373409 8.06249C-0.0380062 8.34487 0.0016323 8.64561 0.147575 8.89882L1.36348 11.0001L0.147575 13.1014C0.00218079 13.3551 -0.0373904 13.6558 0.0374383 13.9384Z"
                                      fill="#DDE8FF"/>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M17.875 11C17.875 14.797 14.797 17.875 11 17.875C7.20305 17.875 4.125 14.797 4.125 11C4.125 7.20299 7.20305 4.125 11 4.125C14.797 4.125 17.875 7.20299 17.875 11ZM11.8984 16.0783C14.3178 15.6532 16.1562 13.5413 16.1562 11C16.1562 10.1621 15.9564 9.37092 15.6018 8.67146L11.8984 16.0783ZM14.8433 7.5625C13.8992 6.50762 12.5271 5.84375 11 5.84375C9.47288 5.84375 8.10083 6.50762 7.15668 7.5625H8.42188L11 13.7009L13.5781 7.5625H14.8433ZM6.39823 8.67146L10.1016 16.0783C7.68218 15.6532 5.84375 13.5413 5.84375 11C5.84375 10.1621 6.0436 9.37092 6.39823 8.67146Z"
                                      fill="#005DFF"/>
                            </svg>

                        </span>
        </div>
        <div class="link">
            <a href="<?=$arParams['AUTH_SUCCESS_URL']?>">Личный кабинет</a>
        </div>
    </div>
<?php
	return;
}
?>

<div class="header__top-cabinet">
    <div class="present" style="opacity: 0">
        <span class="text"><span class="number">10 000</span>бонусов</span>
        <span class="icon">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.0374383 13.9384C0.074443 14.0781 0.138751 14.2091 0.226651 14.3239C0.31455 14.4386 0.424302 14.5348 0.549573 14.6069L2.65318 15.8228V18.2445C2.65318 18.5366 2.76922 18.8167 2.97576 19.0233C3.18231 19.2298 3.46244 19.3458 3.75454 19.3458H6.17645L7.39235 21.4493C7.48986 21.616 7.62908 21.7544 7.79631 21.851C7.96354 21.9475 8.15303 21.9989 8.34614 22C8.53777 22 8.72831 21.9493 8.89792 21.8513L10.9993 20.6366L13.1029 21.8524C13.3558 21.9983 13.6562 22.0378 13.9383 21.9625C14.2203 21.8871 14.4609 21.703 14.6074 21.4504L15.8222 19.3469H18.2441C18.5362 19.3469 18.8163 19.2309 19.0229 19.0244C19.2294 18.8178 19.3455 18.5377 19.3455 18.2456V15.8239L21.4491 14.608C21.5744 14.5356 21.6842 14.4392 21.7722 14.3243C21.8602 14.2095 21.9248 14.0784 21.9621 13.9386C21.9994 13.7988 22.0088 13.653 21.9898 13.5095C21.9707 13.366 21.9236 13.2278 21.8511 13.1025L20.6363 11.0001L21.8522 8.89882C21.9983 8.64601 22.0381 8.34551 21.9627 8.0634C21.8873 7.78129 21.7029 7.54067 21.4502 7.39444L19.3466 6.17859V3.75571C19.3466 3.46362 19.2305 3.1835 19.024 2.97697C18.8174 2.77043 18.5373 2.6544 18.2452 2.6544H15.8233L14.6085 0.552001C14.4618 0.299709 14.2216 0.115338 13.94 0.0387911C13.8003 0.000923587 13.6545 -0.00884073 13.511 0.0100641C13.3675 0.0289689 13.2291 0.076167 13.104 0.148922L10.9993 1.36367L8.89682 0.147821C8.64399 0.00169292 8.34348 -0.0380498 8.06135 0.037331C7.77923 0.112712 7.53859 0.297045 7.39235 0.549799L6.17645 2.6533H3.75454C3.46244 2.6533 3.18231 2.76933 2.97576 2.97587C2.76922 3.1824 2.65318 3.46252 2.65318 3.75461V6.17639L0.549573 7.39223C0.296879 7.53909 0.112688 7.78011 0.0373409 8.06249C-0.0380062 8.34487 0.0016323 8.64561 0.147575 8.89882L1.36348 11.0001L0.147575 13.1014C0.00218079 13.3551 -0.0373904 13.6558 0.0374383 13.9384Z" fill="#DDE8FF"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.875 11C17.875 14.797 14.797 17.875 11 17.875C7.20305 17.875 4.125 14.797 4.125 11C4.125 7.20299 7.20305 4.125 11 4.125C14.797 4.125 17.875 7.20299 17.875 11ZM11.8984 16.0783C14.3178 15.6532 16.1562 13.5413 16.1562 11C16.1562 10.1621 15.9564 9.37092 15.6018 8.67146L11.8984 16.0783ZM14.8433 7.5625C13.8992 6.50762 12.5271 5.84375 11 5.84375C9.47288 5.84375 8.10083 6.50762 7.15668 7.5625H8.42188L11 13.7009L13.5781 7.5625H14.8433ZM6.39823 8.67146L10.1016 16.0783C7.68218 15.6532 5.84375 13.5413 5.84375 11C5.84375 10.1621 6.0436 9.37092 6.39823 8.67146Z" fill="#005DFF"/></svg>
        </span>
    </div>
    <div class="link">
        <a href="/profile/" class="js-modal js-modal-auth">Вход</a>
    </div>
</div>
