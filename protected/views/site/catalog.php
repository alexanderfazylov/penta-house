<div class="">
    <div class="catalog item-box">
        <?php foreach ($brands as $brand): ?>
            <a href="/brand?id=<?php echo $brand->id; ?>" class="catalog-item item catalog-title">
                <img class="catalog-logo" <?php echo Helper::getSrc($brand->upload2); ?> >
            </a>
            <?php foreach ($brand->collection as $collection): ?>
                <a href="/collection?id=<?php echo $collection->id; ?>" class="catalog-item item hovered">
                    <img class="item-bg" <?php echo Helper::getSrc($collection->upload1); ?>>

                    <div class="hovered-div">
                        <div class="hovered-div-text">
                            <span><?php echo $collection->name; ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>