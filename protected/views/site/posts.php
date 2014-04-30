<div class="">
    <div class="catalog item-box">
        <?php foreach ($years as $year => $v): ?>
            <div class="catalog-item item catalog-title">
                <span class="nw-title"><?php echo $year; ?></span>
            </div>
            <?php foreach ($posts as $post): ?>
                <?php if (DateTime::createFromFormat('d.m.Y', $post->start_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y') == $year): ?>
                    <a href="/post?id=<?php echo $post->id; ?>" class="catalog-item item hovered">
                        <img class="item-bg" <?php echo Helper::getSrc($post->upload1); ?> >

                        <div class="hovered-div">
                            <div class="hovered-div-text">
                                <span><?php echo $post->name; ?></span>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>