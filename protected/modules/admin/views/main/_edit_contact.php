<div id="edit-model" class="modal fade" tabindex="-1" data-width="600">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title">{{>title}}</h2>
    </div>
    <div class="modal-body">
        <form id="form-save-model" action="/admin/main/contact" method="POST">
            <input type="hidden" name="Contact[id]" value="{{>item.id}}"/>
            <h4>Основная страница</h4>

            <div class="form-group">
                <label for="model-name">Город</label>
                <input type="text" class="form-control" id="model-city" name="Contact[city]"
                       value="{{>item.city}}">
            </div>
            <div class="form-group">
                <label for="model-type">Тип</label>
                <select id="model-type" name="Contact[type]" data-value="{{>item.type}}">
                    <option value="0">-</option>
                    <option value="1">Проектный офис</option>
                    <option value="2">Шоурум</option>
                </select>
            </div>
            <div class="form-group">
                <label for="model-type">Город по умолчанию</label>
                <select id="model-default" name="Contact[default]" data-value="{{>item.default}}">
                    <option value="0">нет</option>
                    <option value="1">да</option>
                </select>
            </div>
            <div class="form-group">
                <label for="model-type">Контакт по умолчанию среди одинаковых городов</label>
                <select id="model-default_in_city" name="Contact[default_in_city]" data-value="{{>item.default_in_city}}">
                    <option value="0">нет</option>
                    <option value="1">да</option>
                </select>
            </div>
            <div class="form-group">
                <label for="model-name">Телефон</label>
                <input type="text" class="form-control" id="model-phone" name="Contact[phone]"
                       value="{{>item.phone}}">
            </div>
            <div class="form-group">
                <label for="model-address">Адрес</label>
                <textarea class="form-control" id="model-address"
                          name="Contact[address]">{{>item.address}}</textarea>
            </div>
            <div class="form-group">
                <label for="model-map">Координаты метки</label>
                <input type="text" class="coordinates" value="{{getCoordinats:item}}">
                <a href="http://api.yandex.ru/maps/tools/getlonglat/index.xml" target="_blank">Определить
                    координаты</a>
                <br/>
                <input type="hidden" name="Contact[latitude]" class="contact_latitude" value="{{>item.latitude}}">
                <input type="hidden" name="Contact[longitude]" class="contact_longitude" value="{{>item.longitude}}">

            </div>
            <div class="form-group">
                <label for="model-map">Масштаб карты</label>
                <input type="text" name="Contact[zoom]" value="{{>item.zoom}}">
            </div>
            <hr>
            <div class="form-group">
                <label for="model-weekdays">Будни</label>
                <input type="text" name="Contact[weekdays]" value="{{>item.weekdays}}">
            </div>
            <div class="form-group">
                <label for="model-saturday">Суббота</label>
                <input type="text" name="Contact[saturday]" value="{{>item.saturday}}">
                <p class="default-hint">если поле пустое, значит выходной</p>
            </div>
            <div class="form-group">
                <label for="model-sunday">Воскресенье</label>
                <input type="text" name="Contact[sunday]" value="{{>item.sunday}}">
                <p class="default-hint">если поле пустое, значит выходной</p>
            </div>

            <hr/>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="Contact[visible]"
                    {{boolCheckbox:item.visible}} />
                    Скрыть контакт
                </label>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        {{if item.id }}
        <button type="button" class="btn btn-danger" data-name="{{>item.name}}" data-unit="Контакт"
                data-action="/admin/main/deleteContact" data-model-id="{{>item.id}}"
                style="float:left" id="delete-model">
            Удалить контакт
        </button>
        {{/if}}
        <button type="button" data-dismiss="modal" class="btn btn-default">Отмена</button>
        <button type="button" class="btn btn-primary" id="save-model">Сохранить</button>
    </div>
</div>


