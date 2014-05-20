<div class="test-but-panel">
    <button type="button"
            data-page_type="<?php echo $this->page_type ?>"
            data-location_type="<?php echo Page::MODEL_PREV ?>"
            onclick="changeModel($(this))">
        &lt; Назад
    </button>
    <span class="separator">/</span>
    <button type="button"
            data-page_type="<?php echo $this->page_type ?>"
            data-location_type="<?php echo Page::MODEL_NEXT ?>"
            onclick="changeModel($(this))">
        Далее &gt;
    </button>
</div>