<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<section>
    <div id="detailApp" v-cloak>
        <h2>Обращение №{{ arResult.ELEMENT.ID }}</h2>
        <ul>
            <li>ФИО: {{ arResult.ELEMENT.PROPERTY_FIO_VALUE }}</li>
            <li>Номер телефона: {{ arResult.ELEMENT.PROPERTY_PHONE_VALUE }}</li>
            <li>Дата обращения: {{ arResult.ELEMENT.PROPERTY_DATE_NEW_VALUE }}</li>
            <li v-if="arResult.ELEMENT.PROPERTY_DATE_END_VALUE">Дата закрытия обращения: {{ arResult.ELEMENT.PROPERTY_DATE_END_VALUE }}</li>
            <li>Статус: {{ arResult.ELEMENT.PROPERTY_STATUS_VALUE }}</li>
        </ul>
        <div>
            <h3>Текст обращения</h3>
            <p>{{ arResult.ELEMENT.PROPERTY_TEXT_VALUE.TEXT }}</p>
        </div>
        <div>
            <h3 v-if="(arResult.ELEMENT.PROPERTY_STATUS_VALUE != 'Завершено')">Добавить/редактировать комментарий</h3>
            <h3 v-else>Комментарий</h3>
            <form v-on:submit.prevent="onSubmit">
                <textarea :disabled="(arResult.ELEMENT.PROPERTY_STATUS_VALUE == 'Завершено')" v-model="arResult.COMMENT" rows="10"></textarea>
                <input :disabled="(arResult.ELEMENT.PROPERTY_STATUS_VALUE == 'Завершено')" type="submit">
            </form>
        </div>
        <button v-if="(arResult.ELEMENT.PROPERTY_STATUS_VALUE != 'Завершено')" v-on:click="endMessage">Завершить обращение</button>
    </div>
</section>
<?php
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addString('<script>
    window.detailMessage = JSON.parse(`'.json_encode($arResult).'`)
</script>');
?>

