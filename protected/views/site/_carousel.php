<?php if (!empty($items)): ?>
    <div class="brand-plugin">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $index = 0; ?>
                <?php foreach ($items as $item): ?>
                    <div class="item <?php echo ($index == 0) ? 'active' : '' ?>">
                        <img style="height: 800px"
                             src="/uploads/<?php echo $item->upload->file_name; ?>"/>
                    </div>
                    <?php ++$index; ?>
                <?php endforeach; ?>
            </div>

            <ol class="carousel-indicators">
                <?php $index = 0; ?>
                <?php foreach ($items as $item): ?>
                    <li data-target="#carousel"
                        data-slide-to="<?php echo $index; ?>"
                        class="<?php echo ($index == 0) ? 'active' : '' ?>"></li>
                    <?php ++$index; ?>
                <?php endforeach; ?>
            </ol>
        </div>


        <div class="title">
            <?php echo $title; ?>
        </div>
        <div class="anchor"></div>
    </div>
<?php endif; ?>