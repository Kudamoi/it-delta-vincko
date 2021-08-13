<?php
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
//use FeedbackDTO;

Loader::includeModule("highloadblock");

class FeedbackService
{
    //добаляет новый отзыв
    public static function add($value) {
        global $DB;
        global $USER;
        $hlblock = HL\HighloadBlockTable::query()->addSelect('*')->where('NAME', 'ReviewsHL')->exec()->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $data = array(
            "UF_USER_ID"=> $USER->getId(),
            "UF_REVIEW_SOURCE_ID"=> 1,
            "UF_REVIEW_TYPE_ID"=>$value['REVIEW_TYPE_ID'],
            "UF_REVIEW_DATE"=>date("d.m.Y"),
            "UF_CITY_ID"=>$value['CITY_ID'],
            "UF_CHOP_ID"=>$value['CHOP_ID'],
            "UF_ALLSCORE_REVIEW_SCORE"=>$value['ALLSCORE_REVIEW_SCORE'],
            "UF_ALLSCORE_REVIEW_SCORE_COMMENT"=>$value['ALLSCORE_REVIEW_SCORE_COMMENT'],
            "UF_CUSTOMER_FOCUS_SCORE"=>$value['CUSTOMER_FOCUS_SCORE'],
            "UF_CUSTOMER_FOCUS_COMMENT"=>$value['CUSTOMER_FOCUS_COMMENT'],
            "UF_COMFORT_SCORE"=>$value['COMFORT_SCORE'],
            "UF_COMFORT_SCORE_COMMENT"=>$value['COMFORT_SCORE_COMMENT'],
            "UF_SECURITY_SCORE"=>$value['SECURITY_SCORE'],
            "UF_SECURITY_SCORE_COMMENT"=>$value['SECURITY_SCORE_COMMENT'],
        );

        
        $DB->StartTransaction();
        $result = $entity_data_class::add($data);

        if ($result->isSuccess()) {
            $hlblock = HL\HighloadBlockTable::query()->addSelect('*')->where('NAME', 'ReviewsScoresHL')->exec()->fetch();

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();
            $id = $result->getId();
            foreach ($value['REVIEW_SCORES'] as $review_score)
            {
                $data = array(
                    "UF_REVIEW_ID"=> $id,
                    "UF_QUESTION_ID"=> $review_score['QUESTION_ID'],
                    "UF_REVIEW_SCORE"=>$review_score['REVIEW_SCORE'],
                    "UF_REVIEW_SCORE_COMMENT"=>$review_score['REVIEW_SCORE_COMMENT']
                );
                
                $result = $entity_data_class::add($data);
                if (!$result->isSuccess()) {
                    $DB->Rollback();
                    return false;
                }
            }
        }
        else {
            $DB->Rollback();
            return false;
        }
        $DB->Commit();
        return true;
    }
    //удаляет отзыв
    public static function delete($id) {
        global $DB;
        $hlblock = HL\HighloadBlockTable::getById(ReviewsScoresHL)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "filter" => array("UF_REVIEW_ID"=>$id)
        ));
        $DB->StartTransaction();
        while($arData = $rsData->Fetch()) {
            if(!$entity_data_class::Delete($arData['ID']))
            {
                $DB->Rollback();
                return false;
            }
        }

        $hlblock = HL\HighloadBlockTable::getById(ReviewsHL)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        if(!$entity_data_class::Delete($id))
        {
            $DB->Rollback();
            return false;
        }

        $DB->Commit();
        return true;
    }
}

