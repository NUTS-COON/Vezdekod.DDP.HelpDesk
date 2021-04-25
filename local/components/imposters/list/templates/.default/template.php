<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<section>
    <div id="listApp" v-cloak>
        <h3>Всего элементов {{ arResult.NAV.NavRecordCount }}</h3>
        <div>
            <form v-on:submit.prevent="reload">
                <input type="text" v-model="arResult.PARAMS.id" placeholder="Поиск по ID" v-on:input="inputID">
                <input type="submit" value="Найти">
            </form>
        </div>
        <div>
            <select v-model="arResult.PARAMS.status" v-on:change="reload">
                <option disabled value="">Выберите один из вариантов</option>
                <option v-for="status in arResult.STATUSES" :key="status.ID">{{ status.VALUE }}</option>
            </select>
        </div>
        <div>
            <div v-if="(arResult.NAV.NavPageCount != 1)">
                <a href="" v-for="n in arResult.NAV.NavPageCount" v-on:click.prevent="arResult.PARAMS.page = n; reload()">{{ n }}</a>
            </div>
            <select v-model="arResult.PARAMS.sumPage" v-on:change="reload">
                <option>10</option>
                <option>20</option>
                <option>50</option>
            </select>
        </div>
        <a href="/board/">Сбросить все</a>
        <div v-if="this.arResult.ITEMS">
            <table>
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Дата открытия</th>
                    <th>Дата закрытия</th>
                    <th>ФИО</th>
                    <th>Номер телефона</th>
                    <th>Статус</th>
                </tr>
                <tr v-for="item in arResult.ITEMS" :key="item.ID">
                    <td>{{ item.ID }}</td>
                    <td>{{ item.PROPERTY_DATE_NEW_VALUE }}</td>
                    <td>{{ item.PROPERTY_DATE_END_VALUE }}</td>
                    <td>{{ item.PROPERTY_FIO_VALUE }}</td>
                    <td>{{ item.PROPERTY_PHONE_VALUE }}</td>
                    <td>{{ item.PROPERTY_STATUS_VALUE }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-else>
            <h2>Ничего не найдено</h2>
        </div>
    </div>
</section>
<?php
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addString('<script>
    window.listMessage = JSON.parse(`'.json_encode($arResult).'`)
</script>');
?>

