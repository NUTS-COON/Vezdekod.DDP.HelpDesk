<?php


namespace Helpdesk;
use \Bitrix\Main\Loader;

class Props
{
    public function getPropertyStatus(){
        Loader::includeModule("iblock");
        $properties = [];
        $property_enums = \CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => MESSAGE_IBLOCK_ID, "CODE"=>"STATUS"));
        while($enum_fields = $property_enums->GetNext())
        {
            $properties[$enum_fields['XML_ID']] = $enum_fields;
        }
        return $properties;
    }
}