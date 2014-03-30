<div id="edit-brand" class="modal fade" tabindex="-1" data-width="600">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">{{>title}}</h4>
    </div>
    <div class="modal-body">
        <form id="form-save-brand" action="/admin/main/brand" method="POST">
            <input type="hidden" name="Brand[id]" value="{{>item.id}}"/>


            <h4>Отображение на глвной странице и странице каталога</h4>

            <div class="form-group">
                <label>Фото подложки на главной странице</label>

                <div id="file-uploader-1"></div>

                <ul class="qq-upload-list" data-width="100" data-height="50">
                    {{if item.upload1}}
                    {{getUploadItem:item.upload1}}
                    {{/if}}
                </ul>

            </div>
            <div class="form-group">
                <label>Лого на главной странице и странице католога</label>

                <div id="file-uploader-2"></div>
                <ul class="qq-upload-list" data-width="200" data-height="50">
                    {{if item.upload2}}
                    {{getUploadItem:item.upload2}}
                    {{/if}}
                </ul>

            </div>
            <div class="checkbox">
                <label>
                    {{checkboxMainePageVisible:item.maine_page_visible}}
                    Скрыть производителя
                </label>
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

                <div id="file-uploader-3"></div>
                <ul class="qq-upload-list" data-width="300" data-height="50">
                    {{if item.upload3}}
                    {{getUploadItem:item.upload3}}
                    {{/if}}
                </ul>
            </div>
            <div class="form-group">
                <label for="brand-site">Сайт</label>
                <input type="text" class="form-control" id="brand-site" name="Brand[site]"
                       value="{{>item.site}}">
            </div>
            <div class="form-group">
                <label>Сертификат и пр.</label>

                <div id="file-uploader-4"></div>
                <ul class="qq-upload-list" data-width="400" data-height="50">
                    {{if item.upload4}}
                    {{getUploadItem:item.upload4}}
                    {{/if}}
                </ul>
            </div>
            <div class="form-group">
                <label for="brand-sert">Подпись к сертификату</label>
                <textarea class="form-control" id="brand-sert" name="Brand[sert]">{{>item.sert}}</textarea>
            </div>
            <hr/>
            <div class="form-group">
                <label for="brand-description">Текст</label>
                <textarea class="form-control" id="brand-description" name="Brand[description]"
                    >{{>item.description}}</textarea>
            </div>
            <hr>
            <h4>SEO</h4>

            <div class="meta-data">
                <div class="form-group">
                    <label for="md-title">Заголовок</label>
                    <textarea class="form-control" id="md-title"
                              name="MetaData[title]">{{>item.meta_data.title}}</textarea>
                </div>
                <div class="form-group">
                    <label for="md-keywords">Ключевые слова</label>
                    <textarea class="form-control" id="md-keywords" name="MetaData[keywords]">{{>item.meta_data.keywords}}</textarea>
                </div>
                <div class="form-group">
                    <label for="md-description">Описание</label>
                    <textarea class="form-control" id="md-description" name="MetaData[description]">{{>item.meta_data.description}}</textarea>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Отмена</button>
        <button type="button" class="btn btn-primary" id="save-brand">Сохранить</button>
    </div>
</div>


