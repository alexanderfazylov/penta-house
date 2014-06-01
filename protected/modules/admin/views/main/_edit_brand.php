<div id="edit-model" class="modal fade" tabindex="-1" data-width="600">
    <div class="modal-content-scroll">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h2 class="modal-title">{{>title}}</h2>
        </div>
        <div class="modal-body">
            <form id="form-save-model" action="/admin/main/brand" method="POST">
                <input type="hidden" name="Brand[id]" value="{{>item.id}}"/>
                <h4>Отображение на главной странице и странице каталога</h4>

                <div class="form-group">
                    <label>Фото подложки на главной странице</label>


                    <div class="construct_upload"
                         data-width="400"
                         data-height="200"
                         data-action="/server/UploadBrand1">
                        {{renderUploder:item.upload1}}
                    </div>
                </div>
                <div class="form-group">
                    <label>Лого на главной странице и странице каталога</label>

                    <div class="construct_upload"
                         data-width="180"
                         data-height="200"
                         data-action="/server/UploadBrand2">
                        {{renderUploder:item.upload2}}
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        {{checkboxMainePageVisible:item.maine_page_visible}}
                        Скрыть производителя
                    </label>
                </div>
                <div class="form-group">
                    <label for="brand-order">Порядок вывода</label>
                    <input type="text" style="width: 50px" class="form-control" id="brand-order" name="Brand[order]"
                           value="{{>item.order}}">
                </div>
                <hr/>
                <h4>Основная страница</h4>

                <div class="form-group">
                    <label for="brand-name">Наименование</label>
                    <input type="text" class="form-control" id="brand-name" name="Brand[name]"
                           value="{{>item.name}}">
                </div>
                <div class="form-group">
                    <label>Лого на основной странице и странице коллекций</label>

                    <div class="construct_upload"
                         data-width="180"
                         data-height="200"
                         data-action="/server/UploadBrand3">
                        {{renderUploder:item.upload3}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="brand-site">Сайт</label>
                    <input type="text" class="form-control" id="brand-site" name="Brand[site]"
                           value="{{>item.site}}">
                </div>
                <div class="form-group">
                    <label>Сертификат и пр.</label>

                    <div class="construct_upload"
                         data-width="100"
                         data-height="50"
                         data-action="/server/UploadBrand4">
                        {{renderUploder:item.upload4}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="brand-sert">Подпись к сертификату</label>
                    <textarea class="form-control" id="brand-sert" name="Brand[sert]">{{>item.sert}}</textarea>
                </div>
                <hr/>
                <div class="form-group">
                    <label for="brand-description">Текст</label>
                    <textarea class="form-control h500 redactor" id="brand-description" name="Brand[description]"
                        >{{>item.description}}</textarea>
                </div>
                {{if item.collection }}
                <hr>
                <div class="form-group">
                    <h4>Коллекции</h4>
                    {{getCollection:item.collection}}
                </div>
                {{/if}}
                <hr>
                {{metaData:item.meta_data}}
            </form>
        </div>
    </div>
    <div class="modal-footer">
        {{if item.id }}
        <button type="button" class="btn btn-danger" data-name="{{>item.name}}" data-unit="производитель"
                data-action="/admin/main/deleteBrand" data-model-id="{{>item.id}}"
                style="float:left" id="delete-model">
            Удалить производителя
        </button>
        {{/if}}
        <button type="button" data-dismiss="modal" class="btn btn-default">Отмена</button>
        <button type="button" class="btn btn-primary" id="save-model">Сохранить</button>
    </div>
</div>


