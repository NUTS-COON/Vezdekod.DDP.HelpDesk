<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
use Bitrix\Main\Page\Asset;
?>
<html>
<head>
    <?
    global $APPLICATION;
    $APPLICATION->ShowHead();
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/reset.css");
    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/fix.js");
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
</head>

<body>
<? $APPLICATION->ShowPanel(); ?>
<header>
    <h1>Helpdesk</h1>
</header>