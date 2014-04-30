<button type="button" class="btn btn-default btn-popup" data-popup="edit-model"
        data-item='{"meta_data":{}}'
        data-title="Создание проект">
    Создать Проект
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
    'dataProvider' => $project->search(),
    'cssFile' => false,
    'itemsCssClass' => 'table table-hover',
    'filter' => $project,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns' => array(
        array(
            'name' => 'id',
        ),
        array(
            'name' => 'name',
        ),
        array(
            'name' => 'order',
        ),
        array(
            'name' => 'end_date',

            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model' => $project,
                        'attribute' => 'end_date',
                        'language' => 'ru',
                        'htmlOptions' => array(
                            'id' => 'Project_end_date',
                            'size' => '10',
                        ),
                        'htmlOptions' => array(
                            'dateFormat' => 'dd.mm.yy',
                        ),
                    ),
                    true),
        ),
        array(
            'name' => 'visible',
            'type' => 'raw',
            'value' => array($project, 'pageVisible'),
            'filter' => Project::getVisibleSelect($project),
        ),
        array(
            'name' => '',
            'type' => 'raw',
            'value' => array($project, 'popupPrepear'),
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

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#Project_end_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ru'],{'dateFormat':'dd.mm.yy'}));
}
");
?>


<script id="template_edit-model" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_edit_project'); ?>
</script>
<script id="template_uplod_wrap" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_uplod_wrap'); ?>
</script>
<script id="template_uplod_wrap_miltiple" type="text/x-jsrender">
    <?php $this->renderPartial('/main/_uplod_wrap_miltiple'); ?>
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

