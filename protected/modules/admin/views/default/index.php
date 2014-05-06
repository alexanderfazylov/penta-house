<p class="bg-info default-hint">* Выводятся первые 8 производителей</p>
<p class="bg-info default-hint">** Выводятся первые 7 проектов</p>
<p class="bg-info default-hint">*** Выводятся последние 7 новостей</p>


<form id="" action="/admin/default/index" method="POST">
    <h3>Направления</h3>

    <div class="form-group">
        <ul class="direction">
            <li>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="Main[direction_1]"
                           value="<?php echo $main->direction_1; ?>">
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="Main[direction_description_1]"
                           value="<?php echo $main->direction_description_1; ?>">
                </div>
            </li>
            <li>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="Main[direction_2]"
                           value="<?php echo $main->direction_2; ?>">
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="Main[direction_description_2]"
                           value="<?php echo $main->direction_description_2; ?>">
                </div>
            </li>
            <li>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="Main[direction_3]"
                           value="<?php echo $main->direction_3; ?>">
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="Main[direction_description_3]"
                           value="<?php echo $main->direction_description_3; ?>">
                </div>


            </li>
            <li>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="Main[direction_4]"
                           value="<?php echo $main->direction_4; ?>">
                </div>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="Main[direction_description_4]"
                           value="<?php echo $main->direction_description_4; ?>">
                </div>

            </li>
        </ul>
    </div>
    <hr>
    <h3>Социальные сети</h3>

    <div class="form-group">
        <ul class="direction">
            <li>
                <label for="">Вконтакте</label>
                <input placeholder="http://exemple.com" class="form-control" type="text" name="Main[vk_link]"
                       value="<?php echo $main->vk_link; ?>">
            </li>
            <li>
                <label for="">Фейсбук</label>
                <input placeholder="http://exemple.com" class="form-control" type="text" name="Main[fb_link]"
                       value="<?php echo $main->fb_link; ?>">
            </li>
            <li>
                <label for="">Твитер</label>
                <input placeholder="http://exemple.com" class="form-control" type="text" name="Main[tw_link]"
                       value="<?php echo $main->tw_link ?>">
            </li>
        </ul>
    </div>

    <button id="main-edit" type="button" class="btn btn-default pull-right">Сохранить</button>
</form>

<?php $this->renderPartial('/main/_page_meta_data', array('page' => $page)); ?>
