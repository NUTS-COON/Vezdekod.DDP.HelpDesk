<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<section>
    <div id="formaApp" v-cloak>
        <form v-on:submit.prevent="onSubmit">
            <input type="text" :disabled="id" v-model="fio">
            <input type="text" :disabled="id" v-model="phone"  v-on:input="phoneInput">
            <textarea rows="10" :disabled="id" v-model="text"></textarea>
            <input :disabled="id" type="submit">
        </form>
        <p v-if="this.id">Ваше обращение с номером {{ this.id }} успешно создано</p>
        <p v-if="this.errors.fio">Минимальная длина ФИО 6 символов</p>
        <p v-if="this.errors.phone">Минимальная длина номера телефона 6 символов</p>
        <p v-if="this.errors.text">Минимальная длина текста обращения 10 символов</p>
        <p v-if="this.errors.server">Неизвестная ошибка со стороны сервера</p>
    </div>
</section>


