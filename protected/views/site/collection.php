<div class="brand-plugin">
    <div class="slider">
        <div class="sliderContent">
            <?php foreach ($collection->collection_upload as $collection_upload): ?>
                <div class="item">
                    <img style="height: 800px" src="/uploads/<?php echo $collection_upload->upload->file_name; ?>"/>
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
                    <img class="item-bg" src="/uploads/<?php echo $collection_upload->upload->file_name; ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="anchor"></div>
</div>
<div class="anchor"></div>
<div class="collection-footer">
    <div class="item-box">
        <div class="brand-item item brand-title">
            <span class="brand-title">Коллекции</span>
        </div>
        <?php if (!is_null($brand)): ?>
            <?php foreach ($brand->collection as $collection): ?>
                <a href="/site/collection?id=<?php echo $collection->id; ?>" class="brand-item item hovered">
                    <img class="item-bg" src="/uploads/<?php echo $collection->upload1->file_name ?>"/>

                    <div class="hovered-div">
                        <div class="hovered-div-text">
                            <span><?php echo $collection->name; ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(".collection-img-item").lightBox();
    });
</script>
