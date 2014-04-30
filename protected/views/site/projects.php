<div class="">
    <div class="catalog item-box">
        <?php foreach ($years as $year => $v): ?>
            <div class="catalog-item item catalog-title">
                <span class="nw-title"><?php echo $year; ?></span>
            </div>
            <?php foreach ($projects as $project): ?>
                <?php if (DateTime::createFromFormat('d.m.Y', $project->end_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y') == $year): ?>
                    <a href="/site/project?id=<?php echo $project->id; ?>" class="catalog-item item hovered">
                        <img class="item-bg" <?php echo Helper::getSrc($project->upload1); ?> >

                        <div class="hovered-div">
                            <div class="hovered-div-text">
                                <span><?php echo $project->name; ?></span>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>