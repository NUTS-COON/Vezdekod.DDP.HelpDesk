<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION;
$APPLICATION->SetTitle("Helpdesk");
global $USER;
//if($USER->IsAuthorized()){
//    LocalRedirect("/board/");
//}
$APPLICATION->IncludeComponent('imposters:forma', '', []);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>