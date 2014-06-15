<div class="index-box">
    <div class="main-img">
        <?php if (!empty($collections)): ?>
            <div class="brand-plugin">
                <div id="main-carousel" class="carousel slide" data-ride="main-carousel">
                    <div class="carousel-inner">
                        <?php $index = 0; ?>
                        <?php foreach ($collections as $item): ?>
                            <?php if (isset($item->upload2)): ?>
                                <a class="blocklink item <?php echo ($index == 0) ? 'active' : '' ?>"
                                   href="/collection?id=<?php echo $item->id ?>">
                                    <img class="ms-img" src="/uploads/<?php echo $item->upload2->file_name ?>"/>

                                    <div class="title">
                                        <?php echo $item->slogan; ?>
                                    </div>
                                </a>
                                <?php ++$index; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <ol class="carousel-indicators main-carousel-indicators">
                        <?php $index = 0; ?>
                        <?php foreach ($collections as $item): ?>
                            <li data-target="#main-carousel"
                                data-slide-to="<?php echo $index; ?>"
                                class="<?php echo ($index == 0) ? 'active' : '' ?>"></li>
                            <?php ++$index; ?>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <div class="anchor"></div>
            </div>
        <?php endif; ?>
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
        <a href="/projects" class="project-item item project-title">
            <span class="pr-title">Проекты</span>
            <span class="pr-count"><?php echo $projects_count; ?></span>
        </a>
        <?php foreach ($projects as $project): ?>
            <a href="/project?id=<?php echo $project->id; ?>" class="project-item item hovered">
                <img class="item-bg" <?php echo Helper::getSrc($project->upload1); ?>>

                <div class="hovered-div">
                    <div class="hovered-div-text"><span><?php echo $project->name; ?></span></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="item-box">
        <a href="/posts" class="news-item item news-title">
            <span class="nw-title">Новости</span>
        </a>
        <?php foreach ($posts as $post): ?>
            <a href="/post?id=<?php echo $post->id ?>" class="news-item item hovered">
                <img class="item-bg" <?php echo Helper::getSrc($post->upload1); ?> >

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
        <a href="/brand?id=<?php echo $brand->id; ?>" class="manufacturer hovered">
            <img class="item-bg" <?php echo Helper::getSrc($brand->upload1); ?> >
            <img class="manufacturer-logo" <?php echo Helper::getSrc($brand->upload2); ?> >

            <div class="hovered-div"></div>
        </a>
    <?php endforeach; ?>
</div>

