<?php
/* @var $this SiteController */

$this->pageTitle = "Penta House - Контакты";
?>

<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru_RU"
        type="text/javascript"></script>

<button type="button" class="map-chenger" data-latitude="48.91025" data-longitude="55.846422" data-zoom="15">
    Первый
    контакт
</button>
<button type="button" class="map-chenger" data-latitude="37.551234" data-longitude="55.765291" data-zoom="15">Второй
    контакт
</button>

<div id="map" style="height:300px"></div>


<script type="text/javascript">


    ymaps.ready(function () {
        myMap = new ymaps.Map("map", {
            center: [55.846422, 48.91025],
            zoom: 10
        });
        myMap.controls
            // Кнопка изменения масштаба.
            .add('zoomControl', { left: 5, top: 5 });

        var myPlacemark1 = new ymaps.Placemark([55.846422, 48.91025], {
            balloonContentHeader: "Пента-Хаусaaaaaaaaaaaaaaaa",
            balloonContentBody: "Телефон 12312312",
            balloonContentFooter: "08:00-10:00",
            hintContent: "Хинт метки"
        });

        myMap.geoObjects.add(myPlacemark1);

        var myPlacemark2 = new ymaps.Placemark([55.765291, 37.551234], {
            balloonContentHeader: "Балун метки",
            balloonContentBody: "Содержимое <em>балуна</em> метки",
            balloonContentFooter: "Подвал",
            hintContent: "Хинт метки"
        });

        myMap.geoObjects.add(myPlacemark2);

    });


</script>

<div class="contact-info">
    <h1>Контакты</h1>

    <div class="table contact-info-table">
        <div class="tr">
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


