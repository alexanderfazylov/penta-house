<div class="city-dialog dialog-position">
    <span class="dialog-close">Закрыть</span>

    <h2>Выбрать другой город</h2>

    <p class="dialog-description">Уважаемый Клиент, выберете тот город, в котором вы проживаете на данный момент</p>

    <form class="dialog-form">
        <div class="row">
            <?php foreach ($this->contacts as $contact): ?>
                <label>
                    <?php if ($this->active_contact_id == $contact->id) {
                        $selected = 'checked="checked"';
                    } else {
                        $selected = '';
                    }

                    ?>
                    <input <?php echo $selected; ?> type="radio" name="City[id]" value="<?php echo $contact->id; ?>"/>
                    <?php echo $contact->city; ?>
                </label>
            <?php endforeach; ?>

        </div>
        <button id="select-city" type="button" class="submit-btn">Выбрать город</button>
    </form>
</div>

