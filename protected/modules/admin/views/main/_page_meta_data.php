<div class="anchor"></div>
<form id="form-save-page" class="meta-data-page row active" action="/admin/main/savePage?name=<?php echo $page->name ?>"
      method="POST">

    <div class="row col-md-12">
        <h3>SEO параметры
            <div class="pull-right">
                <button type="button" class="btn btn-link open-seo toggle-meta-data">открыть</button>
                <button type="button" class="btn btn-link close-seo toggle-meta-data">закрыть</button>
            </div>
        </h3>
    </div>

    <div class="seo-params">
        <div class="row col-md-12">

            <label for="page-title">Заголовок</label>
            <textarea id="page-title" class="form-control"
                      name="MetaData[title]"><?php echo isset($page->meta_data) ? $page->meta_data->title : ''; ?></textarea>
        </div>
        <div class="row col-md-12">
            <label for="page-description">Описание</label>
            <textarea id="page-description" class="form-control"
                      name="MetaData[description]"><?php echo isset($page->meta_data) ? $page->meta_data->description : '' ?></textarea>
        </div>
        <div class="row col-md-12">
            <label for="page-keywords">Ключевые слова</label>
            <textarea id="page-keywords" class="form-control"
                      name="MetaData[keywords]"><?php echo isset($page->meta_data) ? $page->meta_data->keywords : '' ?></textarea>
        </div>
        <div class="row col-md-12">
            <button type="button" id="save-page" class="btn btn-success pull-right">Сохранить</button>
        </div>

    </div>
    <div class="anchor"></div>
</form>