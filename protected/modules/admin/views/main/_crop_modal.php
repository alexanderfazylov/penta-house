<div id="modal-crop" class="modal fade" tabindex="2" data-width="auto">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Кропинг</h3>
    </div>
    <div class="modal-body">
        <img class="jcrop-preview" id="target" src="/uploads/medium/{{notCacheImage:file_name}}">

        <form id="form-crop-image" action="/server/crop" method="POST">
            <input type="hidden" name="Upload[id]" value="{{>id}}"/>
            <input type="hidden" id="x1" name="x1"/>
            <input type="hidden" id="y1" name="y1"/>
            <input type="hidden" id="x2" name="x2"/>
            <input type="hidden" id="w" name="w"/>
            <input type="hidden" id="h" name="h"/>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn">Назад</button>
        <button type="button" class="btn btn-primary" id="crop-image">Сохранить</button>
    </div>
</div>
