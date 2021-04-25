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
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/header.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/footer.css");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/vue.global.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/axios.min.js");
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
</head>

<body>
<header class="header">
    <a href="/"><h1>Helpdesk</h1></a>
    <a href="/board/">Я сотрудник</a>
</header>