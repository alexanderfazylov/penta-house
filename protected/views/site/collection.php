<?php if (!empty($collection->collection_upload)): ?>
    <div class="brand-plugin">
        <div class="slider">
            <div class="sliderContent">
                <?php foreach ($collection->collection_upload as $collection_upload): ?>
                    <div class="item">
                        <img style="height: 800px" <?php echo Helper::getSrc($collection_upload->upload); ?>/>
                    </div>
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
<div class="breadcrumbs"><a href="/site/index">Главная</a> / <a href="/site/catalog">Каталог</a> / Коллекции</div>
<div class="collection">
    <h1> Коллекция <?php echo $collection->name; ?></h1>

    <div class="collection-description">
        <?php echo $collection->description; ?>
    </div>
    <div class="collection-gallery">
        <div class="item-box">
            <?php foreach ($collection->collection_upload as $collection_upload): ?>
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

<?php if (!empty($brand->collection)): ?>
    <div class="collection-footer">
        <div class="item-box">
            <div class="brand-item item brand-title">
                <span class="brand-title">Коллекции</span>
            </div>
            <?php foreach ($brand->collection as $collection): ?>
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

