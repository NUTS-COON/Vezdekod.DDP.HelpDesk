<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use Bitrix\Main\Loader;

class MessageList extends \CBitrixComponent
{
    private function getID(){
        global $APPLICATION;
        $url = $APPLICATION->GetCurPage();
        $arUrl = explode('/', $url);
        return $arUrl[2];
    }

    private function getElement($id){
        Loader::includeModule("iblock");
        $arSelect = Array("ID", "PROPERTY_STATUS", "PROPERTY_FIO", "PROPERTY_PHONE", "PROPERTY_DATE_NEW", "PROPERTY_DATE_END", "PROPERTY_TEXT", "PROPERTY_COMMENT");
        $arFilter = Array("IBLOCK_ID" => MESSAGE_IBLOCK_ID, "ACTIVE"=>"Y", "ID" => $id);
        $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        if($element = $res->Fetch())
        {
            return $element;
        }
        return 0;
    }

    public function executeComponent()
    {
        $id = $this->getID();
        $request= json_decode(trim(file_get_contents('php://input')),true);
        if($request['axios'] == 'Y'){
            Loader::includeModule("iblock");
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            switch($request['type']){
                case 'endMessage':
                    CIBlockElement::SetPropertyValuesEx($id, false, array('STATUS' => Helpdesk\Props::getPropertyStatus()['end']['ID']));
                    CIBlockElement::SetPropertyValuesEx($id, false, array('DATE_END' => ConvertTimeStamp(time(), 'FULL')));
                    break;
                case 'addComment':
                    CIBlockElement::SetPropertyValuesEx($id, false, array('COMMENT' => htmlspecialchars($request['comment'])));
                    break;
            }
            $this->arResult['ELEMENT'] = $this->getElement($id);
            $this->arResult['COMMENT'] =  $this->arResult['ELEMENT']['PROPERTY_COMMENT_VALUE']['TEXT'];
            echo json_encode($this->arResult);
            die();
        }else{
            $this->arResult['ELEMENT'] = $this->getElement($id);
            $this->arResult['COMMENT'] =  $this->arResult['ELEMENT']['PROPERTY_COMMENT_VALUE']['TEXT'];
            $this->includeComponentTemplate();
        }
    }
}