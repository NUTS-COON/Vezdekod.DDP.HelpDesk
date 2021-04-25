<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use Bitrix\Main\Loader;

class MessageList extends \CBitrixComponent
{
    private function getParams(){
        $params = [];
        switch ($_GET['sumPage']){
            case 20:
                $params['sumPage'] = 20;
                break;
            case 50:
                $params['sumPage'] = 50;
                break;
            default:
                $params['sumPage'] = 10;
                break;
        }

        if($page = intval($_GET['page']))
            $params['page'] = htmlspecialchars($page);
        else
            $params['page'] = 1;

        if($id = intval($_GET['id']))
            $params['id'] = htmlspecialchars($id);

        if($_GET['status'])
            $params['status'] = htmlspecialchars($_GET['status']);

        return $params;
    }

    private function getItems($params){
        Loader::includeModule("iblock");
        $messages = [];
        $arSelect = Array("ID", "PROPERTY_STATUS", "PROPERTY_FIO", "PROPERTY_PHONE", "PROPERTY_DATE_NEW", "PROPERTY_DATE_END");
        $arFilter = Array("IBLOCK_ID" => MESSAGE_IBLOCK_ID, "ACTIVE"=>"Y");
        if($params['status'])
            $arFilter['PROPERTY_STATUS_VALUE'] = $params['status'];
        if($params['id'])
            $arFilter['=ID'] = $params['id'];
        $arNav = Array("nPageSize"=>$params['sumPage'], "iNumPage"=>$params['page']);
        $res = CIBlockElement::GetList(Array('PROPERTY_DATE_NEW' => 'desc'), $arFilter, false, $arNav, $arSelect);
        $this->arResult['NAV']['NavPageCount'] = $res->NavPageCount;
        $this->arResult['NAV']['NavNum'] = $res->NavNum;
        $this->arResult['NAV']['NavRecordCount'] = $res->NavRecordCount;
        while($message = $res->Fetch())
        {
            $messages[] = $message;
        }
        return $messages;
    }

    public function executeComponent()
    {
        $this->arResult['PARAMS'] = $this->getParams();
        $this->arResult['ITEMS'] = $this->getItems($this->arResult['PARAMS']);
        $this->arResult['STATUSES'] = Helpdesk\Props::getPropertyStatus();
        if($_GET['axios'] == 'Y'){
            global $APPLICATION;
            $APPLICATION->RestartBuffer();
            echo json_encode($this->arResult);
            die();
        }else{
            $this->includeComponentTemplate();
        }
    }
}