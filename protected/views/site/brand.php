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
        <a href="/site/collection" class="brand-item item brand-title">
            <span class="brand-title">Коллекции</span>
        </a>
        <?php foreach ($brand->collection as $collection): ?>
            <a href="<?php echo $collection->id; ?>" class="brand-item item hovered">
                <img class="item-bg"
                     src="/uploads/<?php (isset($collection->upload1)) ? $collection->upload1->file_name : ''; ?>">

                <div class="hovered-div">
                    <div class="hovered-div-text">
                        <span><?php echo $collection->name; ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>