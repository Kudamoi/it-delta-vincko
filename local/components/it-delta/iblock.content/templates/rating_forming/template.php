<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix component iblock.content (webgsite.ru)
 * Компонент для битрикс, работа с инфоблоком одностраничный вывод
 *
 * @author    Falur <ienakaev@ya.ru>
 * @link      https://github.com/falur/bitrix.com.iblock.content
 * @copyright 2015 - 2016 webgsite.ru
 * @license   GNU General Public License http://www.gnu.org/licenses/gpl-2.0.html
 */

//echo '<pre>';
//print_r($arResult);
//echo '</pre>';
//


?>

<section class="formation" id="formation">
    <div class="container">
        <div class="formation__title">
            Как формируется<br>
            <span>Репутационный рейтинг</span>
        </div>
        <div class="formation__wrapper">
            <div class="formation__left">
                <div class="formation__left_title">
                    Рейтинг помогает выбрать
                    охранную компанию
                </div>
                <div class="formation__left_subtitle">
                    Потому что каждый пользователь <a href="#">vincko:</a><br> оценивает компанию по трем
                    детализированным
                    параметрам.
                </div>
                <div class="formation__left_btns">
                    <?$i=0;foreach ($arResult as $item):$i++;?>
                        <button class="formation__left_btn formation__left_btn-<?if($i==1): echo "one formation__left_btn-active"; elseif($i==2): echo 'two'; elseif($i==3): echo 'three'; else: echo 'other'; endif;?>">
                            <div class="formation__left_btn-border">
                                <svg height="36" width="36">
                                    <circle cx="17" cy="19" r="16"/>
                                </svg>
                            </div>
                            <div class="formation__left_btn-icon">
                                <img src="<?=$item['PREVIEW_PICTURE']?>" alt="">
                            </div>
                            <div class="formation__left_btn-text">
                                <?=$item['NAME']?>
                            </div>
                        </button>
                    <?endforeach; ?>
                </div>
                <div class="formation__left_bottomText">
                    Из них формируется средняя оценка и определяет место компании в Репутационном рейтинге. Комбинация
                    рейтинга и отзыва
                    дает исчерпывающее представление об охранной организации.
                </div>
                <div class="formation__left_bottomBtn">
                    <a href="/reviews/">
                        Оставить отзыв
                    </a>
                    <a href="#rating-center">
                        Вернуться к рейтингу
                    </a>
                </div>
            </div>
            <div class="formation__right">
                <?$i=0;foreach ($arResult as $item):$i++;?>
                <div class="formation__right_slide slide-<?if($i==1): echo "one formation__right_slide-active"; elseif($i==2): echo 'two'; elseif($i==3): echo 'three'; else: echo 'other'; endif;?>">
                    <div class="formation__right_arrows">
                        <div class="formation__right_arrow hide">
                            <img src="/upload/rating/formation__right_arrow1.svg" alt="img">
                        </div>
                        <div class="formation__right_arrow slide-one-btnTwo">
                            <img src="/upload/rating/formation__right_arrow2.svg" alt="img">
                        </div>
                    </div>
                    <div class="formation__right_info">
                        <div class="formation__right_info-top">
                            <div class="formation__right_info-iconBig">
                                <div class="formation__right_info-border">
                                    <svg height="36" width="36">
                                        <circle cx="17" cy="19" r="16"/>
                                    </svg>
                                </div>
                                <div class="formation__right_info-icon">
                                    <img src="<?=$item['PREVIEW_PICTURE']?>" alt="">
                                </div>
                            </div>
                            <div class="formation__right_info-text">
                                <?=$item['NAME']?>
                            </div>
                        </div>
                        <div class="formation__right_info-textBottom">
                            <?=$item['DESCRIPTION']?>
                        </div>
                    </div>
                    <div class="formation__right_questions">
                        <?$first = true;foreach ($item['ITEMS'] as $sItem):?>
                        <div class="formation__right_questionItem toggle__item<?=$first?' toggle__item_active':''?>">
                            <div class="formation__right_questionItem-title toggle__item_title<?=$first?' toggle__item_title-active':''?>">
                                <?=$sItem['NAME']?>
                            </div>
                            <div class="formation__right_questionItem-descr toggle__item_descr" <?=$first?'style="display:block;"':''?>">
                                <?=$sItem['PREVIEW_TEXT']?>
                            </div>
                        </div>
                        <?$first = false;endforeach;?>

                    </div>
                </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</section>

