<?php if (!empty($brand->collection) && Helper::issetPhoto($brand->collection)): ?>
    <div class="brand-plugin">
        <div class="slider">
            <div class="sliderContent">
                <?php foreach ($brand->collection as $collection): ?>
                    <?php if (!empty($collection->collection_upload)): ?>
                        <?php
                        $collection_upload = $collection->collection_upload;
                        $photo = $collection_upload[0];
                        ?>
                        <div class="item">
                            <img
                                style="height: 800px" <?php echo Helper::getSrc($photo->upload); ?>/>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="sliderArrows sliderArrowsBottom"></div>
        </div>
        <div class="title">
            <?php echo $collection->slogan; ?>
        </div>
        <div class="anchor"></div>
    </div>
<?php endif; ?>
<div class="breadcrumbs"><a href="/site/index">Главная</a> / <a href="/site/catalog">Каталог</a></div>
<div class="brand-description">
    <h1><?php echo $brand->name; ?></h1>

    <?php echo $brand->description; ?>
</div>
<div class="brand-logo">
    <a href="<?php echo $brand->site; ?>">
        <?php if (isset($brand->upload3)): ?>
            <img style="width: 180px;height: 200px" src="/uploads/<?php echo $brand->upload3->file_name; ?>">
        <?php endif; ?>
    </a>
    <a class="brand-link" href="<?php echo $brand->site; ?>"><?php echo $brand->name; ?></a>
    <?php if (isset($brand->upload4)): ?>
        <p class="brand-logo-title">
            Компания ПентаХаус является официальным дилером <?php echo $brand->name; ?>
        </p>
        <img src="/uploads/<?php echo $brand->upload3->file_name; ?>">
    <?php endif; ?>
</div>

<div class="anchor"></div>
<div class="collection-footer">
    <div class="item-box">
        <div class="brand-item item brand-title">
            <span class="brand-title">Коллекции</span>
        </div>
        <?php foreach ($brand->collection as $collection): ?>
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