<div class="col-md-8"></div>
<div class="col-md-4 clearfix">
    <button type="button" class="btn btn-default btn-popup" data-popup="edit-brand" data-title="Создать производителя">
        Создать производителя
    </button>
</div>
<div class="anchor"></div>
<script id="template_edit-brand" type="text/x-jsrender">
    <?php $this->renderPartial('/main/brand/_edit_brand'); ?>
</script>

<div class="jumbotron">
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'brand-grid',
        'dataProvider' => $brand->search(),
        'cssFile' => false,
        'itemsCssClass' => 'table table-hover',
        'columns' => array(
            array(
                'name' => 'id',
                'value' => '$data->id',
            ),
            array(
                'name' => 'Имя',
                'value' => '$data->name',
            ),
            array(
                'name' => 'Описание',
                'value' => '$data->description',
            ),
            array(
                'name' => 'Редактировать',
                'type' => 'raw',
                'value' => array($brand, 'popupPrepear'),
            ),


        ),
        'pagerCssClass' => 'pager',
        'pager' => array(
            'htmlOptions' => array('class' => 'pagination pagination-sm'),
            'cssFile' => false,
            'header' => '',
            'firstPageLabel' => '',
            'prevPageLabel' => '&laquo;',
            'nextPageLabel' => '&raquo;',
            'lastPageLabel' => '',

        ),
        'template' => '{items}{pager}',
    ));
    ?>
</div>


