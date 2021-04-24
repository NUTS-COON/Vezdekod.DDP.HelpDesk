<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
use Bitrix\Main\Loader;

class MessageForm extends \CBitrixComponent
{
    private function validData($request){
        if(strlen($request['fio']) < 6 || strlen($request['phone']) < 16 || strlen($request['text']) < 10)
            return false;
        else
            return true;
    }

    private function addMessage($request){
        Loader::includeModule("iblock");
        $el = new CIBlockElement;

        $PROP = [
            'FIO' => htmlspecialchars($request['fio']),
            'PHONE' => htmlspecialchars($request['phone']),
            'TEXT' => htmlspecialchars($request['text']),
            "DATE_NEW" => ConvertTimeStamp(time(), 'FULL')
        ];

        $arLoadProductArray = Array(
            "NAME"           => 'Обращение в службу поддержки',
            "IBLOCK_ID"      => MESSAGE_IBLOCK_ID,
            "PROPERTY_VALUES"=> $PROP,
            "ACTIVE"         => "Y"
        );

        return $el->Add($arLoadProductArray);
    }
	public function executeComponent()
	{
        $request= json_decode(trim(file_get_contents('php://input')),true);
	    if ($request['type'] == 'resultForm'){
	        if($this->validData($request)){
                global $APPLICATION;
                $APPLICATION->RestartBuffer();
                $result = $this->addMessage($request);
                if($result)
                    echo $result;
                else
                    http_response_code(500);
                die();
            }else{
                http_response_code(500);
            }
        }else{
            $this->includeComponentTemplate();
        }
	}
}