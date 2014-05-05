<div class="callback-dialog dialog-position">
    <span class="dialog-close">Закрыть</span>

    <h2>Заказать обратный звонок</h2>

    <p class="dialog-description">Уважаемый Клиент, звонки осуществляются с учетом очередности
        поступления заявок, в ближайшее возможное время</p>

    <form id="form-send-callback" class="dialog-form" method="POST" action="/site/callback">
        <div class="row form-group">
            <label>Тема звонка</label>
            <textarea name="Callback[text]"></textarea>

            <p class="hint">Звонки осуществляются в рабочее время: с понедельника по воскресенье,
                с 9:00 до 21:00 (время московское)</p>
        </div>
        <div class="row form-group">
            <label>Как Вас зовут</label>
            <input name="Callback[name]" type="text"/>
        </div>
        <div class="row form-group">
            <label>Контактный телефон</label>
            <input name="Callback[phone]" type="text"/>

            <p class="hint">Например, так: 89051234567</p>
        </div>
        <button id="send-callback" class="submit-btn" type="button">Отправить</button>
    </form>
</div>


