<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION;
global $USER;
?>
<?if($USER->IsAuthorized()):?>
    <?$APPLICATION->SetTitle("Обращения");?>
    <?$APPLICATION->IncludeComponent('imposters:list', '', []);?>
<?else:?>
    <?$APPLICATION->SetTitle("Авторизация");?>
    <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
            "REGISTER_URL" => "register.php",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => "profile.php",
            "SHOW_ERRORS" => "Y"
        )
    );?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>