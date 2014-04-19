<?php
$this->pageTitle = "Penta House - Элитная сантехника и плитка. Продажа. Монтаж. Сервис.";
?>

<div class="index-box">
    <div class="main-img">
        <div class="title">Эволюция в ванной комнате</div>
        <img src="../../../i/logo.jpg">
    </div>
    <div class="service item-box">
        <div class="service-item item">
            <div class="service-item-wrapper">
                <h3><?php echo $this->main->direction_1; ?></h3>

                <div class="service-hr"></div>
                <div class="service-description"><?php echo $this->main->direction_description_1; ?></div>
            </div>
        </div>
        <div class="service-item item">
            <div class="service-item-wrapper">
                <h3><?php echo $this->main->direction_2; ?></h3>

                <div class="service-hr"></div>
                <div class="service-description"><?php echo $this->main->direction_description_2; ?></div>
            </div>
        </div>
        <div class="service-item item">
            <div class="service-item-wrapper">
                <h3><?php echo $this->main->direction_3; ?></h3>

                <div class="service-hr"></div>
                <div class="service-description"><?php echo $this->main->direction_description_3; ?></div>
            </div>
        </div>
        <div class="service-item item">
            <div class="service-item-wrapper">
                <h3><?php echo $this->main->direction_4; ?></h3>

                <div class="service-hr"></div>
                <div class="service-description"><?php echo $this->main->direction_description_4; ?></div>
            </div>
        </div>
    </div>
    <div class="anchor"></div>
    <div class="item-box">
        <a href="#" class="project-item item project-title">
            <span class="pr-title">Проекты</span>
            <span class="pr-count"><?php echo $projects_count; ?></span>
        </a>
        <?php foreach ($projects as $project): ?>
            <a href="#" class="project-item item hovered">
                <img class="item-bg"
                     src="/uploads/<?php echo isset($project->upload1) ? $project->upload1->file_name : ''; ?>">

                <div class="hovered-div">
                    <div class="hovered-div-text"><span><?php echo $project->name; ?></span></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="item-box">
        <a href="#" class="news-item item news-title">
            <span class="nw-title">Новости</span>
        </a>
        <?php foreach ($posts as $post): ?>
            <a href="#" class="news-item item">
                <img class="item-bg"
                     src="/uploads/<?php echo isset($post->upload1) ? $post->upload1->file_name : ''; ?>">

                <div class="hovered-div">
                    <div class="hovered-div-text">
                        <span><?php echo $post->name; ?></span>
                    </div>
                </div>

            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="index-sidebar">
    <?php foreach ($brands as $brand): ?>
        <a href="#" class="manufacturer hovered" title="<?php echo $brand->name; ?>">
            <img class="item-bg"
                 src="/uploads/<?php echo isset($brand->upload1) ? $brand->upload1->file_name : ''; ?>">
            <img class="manufacturer-logo"
                 src="/uploads/<?php echo isset($brand->upload2) ? $brand->upload2->file_name : ''; ?>">

            <div class="hovered-div"></div>
        </a>
    <?php endforeach; ?>
</div>