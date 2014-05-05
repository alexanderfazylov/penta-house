<div class="breadcrumbs"><a href="/site/index">Главная</a> / Контакты</div>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru_RU"
        type="text/javascript"></script>

<div id="map" class="contact-map"></div>

<?php foreach ($contacts as $contact) if ($contact->id == $this->active_contact_id)
    $active_contact = $contact;
?>

<script type="text/javascript">
    ymaps.ready(function () {
        myMap = new ymaps.Map("map", {
            center: [<?php echo $active_contact->longitude?>, <?php echo $active_contact->latitude?>],
            zoom: <?php echo $active_contact->zoom;?>,
            behaviors: ['default', 'scrollZoom']
        });
        myMap.controls.add('zoomControl', { right: 5, top: 5 });

        <?php foreach($contacts as $contact):?>

        var myPlacemark<?php echo $contact->id;?> = new ymaps.Placemark([<?php echo $contact->longitude?>, <?php echo $contact->latitude?>], {
            //balloonContentHeader: "Пента-Хаусaaaaaaaaaaaaaaaa",
            //balloonContentBody: "Телефон 12312312",
            //balloonContentFooter: "08:00-10:00",
            //hintContent: ""
        });

        myMap.geoObjects.add(myPlacemark<?php echo $contact->id;?>);

        <?php endforeach;?>
    });
</script>


<div class="contact-info">
    <h1>Контакты</h1>

    <ul class="contact-info-ul">
        <?php foreach ($contacts as $contact): ?>
            <?php if ($contact->default_in_city): ?>
                <h2 class="contact-city"><?php echo $contact->city; ?></h2>
            <?php endif; ?>
            <li>
                <div class="contact-info-wrapp">
                    <button type="button"
                            class="map-chenger city-title <?php echo ($contact->id == $this->active_contact_id) ? 'active' : ''; ?>"
                            data-latitude="<?php echo $contact->longitude; ?>"
                            data-longitude="<?php echo $contact->latitude; ?>"
                            data-zoom="15">
                        <?php echo Contact::getType($contact); ?>
                    </button>
                    <dl class="dl-horizontal">
                        <dt>Время работы</dt>
                        <dd>&nbsp;</dd>

                        <dt>будни</dt>
                        <dd><?php echo empty($contact->weekdays) ? 'неизвестно' : $contact->weekdays; ?></dd>


                        <dt>суббота</dt>
                        <dd><?php echo empty($contact->saturday) ? 'выходной' : $contact->saturday; ?></dd>


                        <dt>воскресенье</dt>
                        <dd><?php echo empty($contact->sunday) ? 'выходной' : $contact->sunday; ?></dd>


                        <dt>Адрес</dt>
                        <dd>
                            <div><?php echo $contact->address; ?></div>
                            <div><?php echo $contact->phone; ?></div>
                            <div><a href="info@penta-house.ru">info@penta-house.ru</a></div>
                        </dd>


                    </dl>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


