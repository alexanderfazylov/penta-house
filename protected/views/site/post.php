<div class="pt-page">
    <input type="hidden" id="page_title" value="<?php echo $this->pageTitle; ?>">
    <input type="hidden" id="entity_id" value="<?php echo $model->id ?>">



    <?php $this->renderPartial('/site/_carousel',
        array(
            'items' => $model->post_upload,
            'title' => $model->name
        )
    );
    ?>

    <div class="breadcrumbs"><a href="/site/index">Главная</a> / <a href="/site/catalog">Новости</a></div>
    <div class="collection">
        <h1> <?php echo $model->name; ?></h1>

        <div class="collection-description">
            <?php echo $model->description; ?>
        </div>
        <div class="collection-gallery">
            <div class="item-box">
                <?php foreach ($model->post_upload as $collection_upload): ?>
                    <a href="/uploads/<?php echo $collection_upload->upload->file_name; ?>"
                       class="collection-img-item item">
                        <img class="item-bg"
                             src="/uploads/medium/<?php echo $collection_upload->upload->file_name; ?>">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="anchor"></div>
    </div>
    <div class="anchor"></div>
    <div class="collection-footer">
        <div class="item-box">
            <a href="/site/posts" class="brand-item item brand-title">
                <span class="brand-title">Новости</span>
            </a>
            <?php foreach ($models as $post): ?>
                <a href="/site/post?id=<?php echo $post->id; ?>" class="brand-item item hovered">
                    <img class="item-bg" <?php echo Helper::getSrc($post->upload1); ?>/>

                    <div class="hovered-div">
                        <div class="hovered-div-text">
                            <span><?php echo $post->name; ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>




