<div class="">
    <div class="catalog item-box">
        <?php foreach ($brands as $brand): ?>
            <a href="/site/brand" class="catalog-item item catalog-title">
                <img class="catalog-logo"
                     src="/uploads/<?php echo isset($brand->upload2) ? $brand->upload2->file_name : ''; ?>">
            </a>
            <?php foreach ($brand->collection as $collection): ?>
                <a href="#" class="catalog-item item hovered">
                    <img class="item-bg"
                         src="/uploads/<?php echo isset($collection->upload1) ? $collection->upload1->file_name : ''; ?>">

                    <div class="hovered-div">
                        <div class="hovered-div-text">
                            <span>aasdasdasd aasdasdasdaasdasdasd aasdasdasdaasdasdasd aasdasdasdaasdasdasd</span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>