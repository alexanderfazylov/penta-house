<?php $this->renderPartial('/main/_page_meta_data', array('page' => $page)); ?>

<button type="button" class="btn btn-default btn-popup" data-popup="edit-model"
        data-item='{"meta_data":{}}'
        data-title="Создание производителя">
    Создать производителя
</button>

<div class="anchor"></div>


<?php $this->widget('ImperaviRedactorWidget', array(
    'selector' => '.redactor',
    'options' => array(),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'model-grid',
    'dataProvider' => $brand->search(),
    'cssFile' => false,
    'itemsCssClass' => 'table table-hover',
    'filter' => $brand,
    'columns' => array(
        array(
            'name' => 'id',
        ),
        array(
            'name' => '',
            'type' => 'raw',
            'value' => array($brand, 'getLogo'),
            'filter' => false,

        ),
        array(
            'name' => 'name',
        ),
        array(
            'name' => 'maine_page_visible',
            'type' => 'raw',
            'value' => array($brand, 'pageVisible'),
            'filter' => Brand::getVisibleSelect($brand),
        ),
        array(
            'name' => 'order',
        ),
        //'collection_count',
        array(
            'name' => 'Количество коллекций',
            'type' => 'raw',
            'value' => array($brand, 'collectionCountCalck'),
            'filter' => Brand::collectionCountInput($brand),
        ),
        array(
            'name' => '',
            'type' => 'raw',
            'value' => array($brand, 'popupPrepear'),
            'filter' => false,
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





<script id="template_edit-model" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_edit_brand'); ?>
</script>
<script id="template_uplod_wrap" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_uplod_wrap'); ?>
</script>
<script id="template_upload-row" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_upload_row'); ?>
</script>
<script id="template_crop_modal" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_crop_modal'); ?>
</script>
<script id="template_meta_data" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_meta_data'); ?>
</script>
<script id="template_collection_row" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_collection_row'); ?>
</script>


