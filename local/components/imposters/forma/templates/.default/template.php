<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<section>
    <div id="formaApp" v-cloak class="container">
        <form v-on:submit.prevent="onSubmit" class="form">
            <input type="text" :disabled="id" v-model="fio" placeholder="Ф.И.О.">
            <input type="text" :disabled="id" v-model="phone"  v-on:input="phoneInput"  placeholder="Номер телефона">
            <textarea rows="10" :disabled="id" v-model="text" class="text" placeholder="Текст обращения"></textarea>
            <input :disabled="id" type="submit" class="submit">
        </form>
        <div class="massage">
        <p class="success" v-if="this.id">Ваше обращение с номером {{ this.id }} успешно создано</p>
        <p class="error" v-if="this.errors.fio">Минимальная длина ФИО 6 символов</p>
        <p class="error" v-if="this.errors.phone">Минимальная длина номера телефона 6 символов</p>
        <p class="error" v-if="this.errors.text">Минимальная длина текста обращения 10 символов</p>
        <p class="error" v-if="this.errors.server">Неизвестная ошибка со стороны сервера</p>
        </div>
    </div>
</section>


