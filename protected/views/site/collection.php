<div class="pt-page">
    <input type="hidden" id="page_title" value="<?php echo $this->pageTitle; ?>">
    <input type="hidden" id="entity_id" value="<?php echo $model->id ?>">
    <?php $this->renderPartial('/site/_carousel',
        array(
            'items' => $model->collection_upload,
            'title' => $model->slogan
        )
    );
    ?>

    <div class="breadcrumbs"><a href="/site/index">Главная</a> / <a href="/site/catalog">Каталог</a> / Коллекции</div>
    <div class="collection">
        <h1 class="entity_title"><?php echo $model->entity->name; ?> <?php echo $model->name; ?></h1>

        <div class="collection-description">
            <?php // echo $model->description; ?>
        </div>
        <div class="collection-gallery">
            <div class="item-box">
                <?php foreach ($model->collection_upload as $collection_upload): ?>
                    <a href="/uploads/<?php echo $collection_upload->upload->file_name; ?>"
                       class="collection-img-item item">
                        <img class="item-bg" <?php echo Helper::getSrc($collection_upload->upload, 'medium'); ?> ">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="anchor"></div>
    </div>
    <div class="anchor"></div>

    <?php if (!empty($models)): ?>
        <div class="collection-footer">
            <div class="item-box">
                <div class="brand-item item brand-title">
                    <span class="brand-title">Коллекции</span>
                </div>
                <?php foreach ($models as $collection): ?>

                    <a href="/collection?id=<?php echo $collection->id; ?>" class="brand-item item hovered">
                        <img class="item-bg" <?php echo Helper::getSrc($collection->upload1); ?>/>

                        <div class="hovered-div">
                            <div class="hovered-div-text">
                                <span><?php echo $collection->name; ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>