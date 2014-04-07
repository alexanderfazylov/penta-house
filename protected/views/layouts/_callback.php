<div class="callback-dialog dialog-position">
    <span class="dialog-close">Закрыть</span>

    <h2>Заказать обратный звонок</h2>

    <p class="dialog-description">Уважаемый Клиент, звонки осуществляются с учетом очередности
        поступления заявок, в ближайшее возможное время</p>

    <form class="dialog-form">
        <div class="row">
            <label>Тема звонка</label>
            <textarea></textarea>

            <p class="hint">Звонки осуществляются в рабочее время: с понедельника по воскресенье,
                с 9:00 до 21:00 (время московское)</p>
        </div>
        <div class="row">
            <label>Как Вас зовут</label>
            <input type="text"/>
        </div>
        <div class="row">
            <label>Контактный телефон</label>
            <input type="text"/>

            <p class="hint">Например, так: 89051234567</p>
        </div>
        <input class="submit-btn" type="submit" value="Отправить"/>
    </form>
</div>


<script>
    $('.callback').click(function () {
        $('.callback-dialog').show();
        $('.city-dialog').hide();
    });
    $('.dialog-close').click(function () {
        $('.callback-dialog').hide();
    });
</script>