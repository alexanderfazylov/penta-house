<div id="edit-brand" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{>title}}</h4>
            </div>
            <div class="modal-body">
                <form id="form-save-brand" action="/admin/main/brand" method="POST">
                    <input type="hidden" name="Brand[id]" value="{{>item.id}}"/>

                    <div class="form-group">
                        <label for="brand-name">Имя производителя</label>
                        <input type="text" class="form-control" id="brand-name" name="Brand[name]"
                               value="{{>item.name}}">
                    </div>
                    <div class="form-group">
                        <label for="brand-description">Описание</label>
                        <textarea class="form-control" id="brand-description" name="Brand[description]"
                            >{{>item.description}}</textarea>
                    </div>
                    <div class="meta-data">
                        <div class="form-group">
                            <label for="brand-name">Ключевые слова</label>
                            <textarea class="form-control" id="brand-description" name="MetaData[keywords]">{{>item.meta_data.keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="brand-name">Описание</label>
                            <textarea class="form-control" id="brand-description" name="MetaData[description]">{{>item.meta_data.description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">

                        <p class="help-block">Файл будет автоматически прикреплен после удачной загрузки.</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="save-brand">Сохранить</button>
            </div>
        </div>
    </div>
</div>