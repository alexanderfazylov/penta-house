<?php
/* @var $this SiteController */

$this->pageTitle = "Penta House - Контакты";
?>
<div class="breadcrumbs"><a href="/site/index">Главная</a> / Контакты</div>
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
            zoom: <?php echo $active_contact->zoom;?>,
            behaviors: ['default', 'scrollZoom']
        });
        myMap.controls.add('zoomControl', { right: 5, top: 5 });

        <?php foreach($this->contacts as $contact):?>

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
        <?php foreach ($this->contacts as $contact): ?>
            <li>
                <div class="contact-info-wrapp">
                    <button type="button" class="map-chenger city-title active"
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
</div>


