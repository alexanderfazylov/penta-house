<div class="pt-page">
    <input type="hidden" id="page_title" value="<?php echo $this->pageTitle; ?>">
    <input type="hidden" id="entity_id" value="<?php echo $model->id ?>">
    <?php $this->renderPartial('/site/_carousel',
        array(
            'items' => $model->project_upload,
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
                <?php foreach ($model->project_upload as $project_upload): ?>
                    <div class="collection-img-item item">
                        <img class="item-bg" src="/uploads/medium/<?php echo $project_upload->upload->file_name; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="anchor"></div>
    </div>
    <div class="anchor"></div>
    <div class="collection-footer">
        <div class="item-box">
            <a href="/posts" class="brand-item item brand-title">
                <span class="brand-title">Проекты</span>
            </a>
            <?php foreach ($models as $project): ?>
                <a href="/project?id=<?php echo $project->id; ?>" class="brand-item item hovered">
                    <img class="item-bg" <?php echo Helper::getSrc($project->upload1); ?> />

                    <div class="hovered-div">
                        <div class="hovered-div-text">
                            <span><?php echo $project->name; ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>


