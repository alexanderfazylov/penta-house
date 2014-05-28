<div class="pt-page">
    <input type="hidden" id="page_title" value="<?php echo $this->pageTitle; ?>">
    <input type="hidden" id="entity_id" value="<?php echo $model->id ?>">
    <?php if (!empty($model->collection) && Helper::issetPhoto($model->collection)): ?>
        <div class="hack-wrapper">
            <img src="/i/hack.jpg" class="hack-height" width="100%"/>

            <div class="brand-plugin">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $index = 0; ?>
                        <?php foreach ($model->collection as $collection): ?>
                            <?php if (!empty($collection->collection_upload)): ?>
                                <?php
                                $collection_upload = $collection->collection_upload;
                                $photo = $collection_upload[0];
                                ?>
                                <div class="item <?php echo ($index == 0) ? 'active' : '' ?>">
                                    <img style="height: 800px"
                                    <?php echo Helper::getSrc($photo->upload); ?>//>
                                </div>
                                <?php ++$index; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <ol class="carousel-indicators">
                        <?php $index = 0; ?>
                        <?php foreach ($model->collection as $item): ?>
                            <?php if (!empty($collection->collection_upload)): ?>
                                <li data-target="#carousel"
                                    data-slide-to="<?php echo $index; ?>"
                                    class="<?php echo ($index == 0) ? 'active' : '' ?>"></li>
                                <?php ++$index; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ol>
                </div>


                <div class="title">
                    <?php echo $collection->slogan; ?>
                </div>
                <div class="anchor"></div>
            </div>


            <?php echo $collection->slogan; ?>
        </div>
    <?php endif; ?>
    <div class="breadcrumbs"><a href="/site/index">Главная</a> / <a href="/site/catalog">Каталог</a></div>
    <div class="brand-description">
        <h1><?php echo $model->name; ?></h1>

        <?php echo $model->description; ?>
    </div>
    <div class="brand-logo">
        <?php if (isset($model->upload3)): ?>
            <img style="width: 300px;" src="/uploads/<?php echo $model->upload3->file_name; ?>">
        <?php endif; ?>
        <a class="brand-link" target="_blank" href="http://<?php echo $model->site; ?>"><?php echo $model->site; ?></a>
        <?php if (isset($model->upload4)): ?>
            <p class="brand-logo-title">
                Компания ПентаХаус является официальным дилером <?php echo $model->name; ?>
            </p>
            <img src="/uploads/<?php echo $model->upload3->file_name; ?>">
        <?php endif; ?>
    </div>

    <div class="anchor"></div>
    <div class="collection-footer">
        <div class="item-box">
            <div class="brand-item item brand-title">
                <span class="brand-title">Коллекции и технологии</span>
            </div>
            <?php foreach ($model->collection as $collection): ?>
                <a href="/site/collection?id=<?php echo $collection->id; ?>" class="brand-item item hovered">
                    <img class="item-bg" <?php echo Helper::getSrc($collection->upload1); ?> >

                    <div class="hovered-div">
                        <div class="hovered-div-text">
                            <span><?php echo $collection->name; ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>