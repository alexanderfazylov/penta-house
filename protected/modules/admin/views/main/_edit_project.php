<div id="edit-model" class="modal fade" tabindex="-1" data-width="600">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title">{{>title}}</h2>
    </div>
    <div class="modal-body">
        <form id="form-save-model" action="/admin/main/project" method="POST">
            <input type="hidden" name="Project[id]" value="{{>item.id}}"/>

            <h4>Отображение на главной странице и странице о компании</h4>

            <div class="form-group">
                <label>Обложка на главной странице и странице о компании</label>

                <div class="construct_upload"
                     data-width="100"
                     data-height="50"
                     data-action="/server/projectUplod1"
                     data-multiple="false">
                    {{renderUploder:item.upload1}}
                </div>

            </div>
            <div class="form-group">
                <label for="model-order">Порядок вывода</label>
                <input type="text" class="form-control"  style="width: 50px" id="model-order" name="Project[order]"
                       value="{{>item.order}}">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="Project[visible]"
                    {{boolCheckbox:item.visible}} />
                    Скрыть проект
                </label>
            </div>
            <hr/>
            <h4>Основная страница</h4>

            <div class="form-group">
                <label for="model-name">Заголовок</label>
                <input type="text" class="form-control" id="model-name" name="Project[name]"
                       value="{{>item.name}}">
            </div>
            <div class="form-group">
                <label for="model-end_date">Дата сдачи</label>
                <input type="text" class="form-control has-datapicker"  style="width: 100px"  id="model-end_date" name="Project[end_date]"
                       value="{{>item.end_date}}">
            </div>
            <div class="form-group">
                <label for="model-description">Текст</label>
                <textarea class="form-control h500 redactor" id="model-description"
                          name="Project[description]">{{>item.description}}</textarea>
            </div>
            <hr/>
            <div class="form-group">
                <label for="model-description">Фото</label>

                <div class="construct_upload"
                     data-width="1600"
                     data-height="800"
                     data-action="/server/ProjectUpload"
                     data-multiple="true">
                    {{renderUploderMiltiple:item.project_upload}}
                </div>
            </div>
            <hr/>
            {{metaData:item.meta_data}}
        </form>
    </div>
    <div class="modal-footer">
        {{if item.id }}
        <button type="button" class="btn btn-danger" data-name="{{>item.name}}" data-unit="проект"
                data-action="/admin/main/deleteProject" data-model-id="{{>item.id}}"
                style="float:left" id="delete-model">
            Удалить проект
        </button>
        {{/if}}
        <button type="button" data-dismiss="modal" class="btn btn-default">Отмена</button>
        <button type="button" class="btn btn-primary" id="save-model">Сохранить</button>
    </div>
</div>


