<form id="" action="/admin/main/about" method="POST">
    <div class="form-group">
        <label>Текст</label>
        <textarea class="form-control h500 redactor"
                  name="About[description]"><?php echo $about->description ?></textarea>
    </div>
    <button id="about-edit" type="button" class="btn btn-default pull-right">Сохранить</button>
</form>
<div class="anchor"></div>
<?php $this->renderPartial('/main/_page_meta_data', array('page' => $page)); ?>

<p class="bg-info default-hint">* На странице выводятся контактные данные для конректного города</p>
<p class="bg-info default-hint">** На странице выводятся последние 9 новостей</p>
<?php $this->widget('ImperaviRedactorWidget', array(
    'selector' => '.redactor',
    'options' => array(),
));
?>

