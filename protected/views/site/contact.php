<?php
/* @var $this SiteController */

$this->pageTitle = "Penta House - Контакты";
?>

<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru_RU"
        type="text/javascript"></script>

<div id="map" class="contact-map"></div>

<?php foreach ($this->contacts as $contact) if ($contact->id == $this->active_contact_id)
    $active_contact = $contact;
?>

<script type="text/javascript">
    ymaps.ready(function () {
        myMap = new ymaps.Map("map", {
            center: [<?php echo $active_contact->longitude?>, <?php echo $active_contact->latitude?>],
            zoom: <?php echo $active_contact->zoom;?>
            //behaviors: ['default', 'scrollZoom']
        });
        myMap.controls.add('zoomControl', { left: 5, bottom: 5 });

        <?php foreach($this->contacts as $contact):?>

        var myPlacemark<?php echo $contact->id;?> = new ymaps.Placemark([<?php echo $contact->longitude?>, <?php echo $contact->latitude?>], {
            balloonContentHeader: "Пента-Хаусaaaaaaaaaaaaaaaa",
            balloonContentBody: "Телефон 12312312",
            balloonContentFooter: "08:00-10:00",
            hintContent: "Хинт метки"
        });

        myMap.geoObjects.add(myPlacemark<?php echo $contact->id;?>);

        <?php endforeach;?>
    });
</script>


<div class="contact-info">
    <h1>Контакты</h1>

    <ul class="contact-info-ul">
        <?php foreach ($this->contacts as $contact): ?>
            <li>
                <div class="contact-info-wrapp">
                    <button type="button" class="map-chenger city-title"
                            data-latitude="<?php echo $contact->longitude; ?>"
                            data-longitude="<?php echo $contact->latitude; ?>"
                            data-zoom="15">
                        <?php echo $contact->city; ?>
                    </button>
                    <dl class="dl-horizontal">
                        <dt>Адрес</dt>
                        <dd><?php echo $contact->address ?></dd>
                        <dt>Телефон</dt>
                        <dd><?php echo $contact->phone ?></dd>
                    </dl>
                </div>
            </li>

        <?php endforeach; ?>
    </ul>

    <!--
    TODO для тебя скрыл просто старую верстку, а не удалил.
    Если не нужна удали.
    -->
    <div class="table contact-info-table" style="display: none">
        <div class="tr">
            <div class="td">
                <p class="city-title">Казань</p>

            </div>
            <div class="td">
                <p class="city-title">Казань</p>
                <dl class="dl-horizontal">
                    <dt>Адрес</dt>
                    <dd>ул. Большая Красная, д. 13а, оф. 1-4</dd>
                    <dt>Телефон</dt>
                    <dd>+7 (843) 524-71-76</dd>
                    <dt>Почта</dt>
                    <dd>info@pentahouse.ru</dd>
                </dl>
            </div>
        </div>
        <div class="tr">
            <div class="td">
                <p class="city-title city-title-link">Москва</p>
                <dl class="dl-horizontal">
                    <dt>Адрес</dt>
                    <dd>ул. Большая Красная, д. 13а, оф. 1-4</dd>
                    <dt>Телефон</dt>
                    <dd>+7 (843) 524-71-76</dd>
                    <dt>Почта</dt>
                    <dd>info@pentahouse.ru</dd>
                </dl>
            </div>
            <div class="td"></div>
        </div>
    </div>
</div>


