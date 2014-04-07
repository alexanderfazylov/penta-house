<?php
$this->pageTitle = "Penta House - Элитная сантехника и плитка. Продажа. Монтаж. Сервис.";
?>
<div class="callback-dialog dialog-position">
    <span class="dialog-close">Закрыть</span>

    <h2>Заказать обратный звонок</h2>

    <p class="dialog-description">Уважаемый Клиент, звонки осуществляются с учетом очередности
        поступления заявок, в ближайшее возможное время</p>

    <form class="dialog-form">
        <div class="row">
            <label>Тема звонка</label>
            <textarea></textarea>

            <p class="hint">Звонки осуществляются в рабочее время: с понедельника по воскресенье,
                с 9:00 до 21:00 (время московское)</p>
        </div>
        <div class="row">
            <label>Как Вас зовут</label>
            <input type="text"/>
        </div>
        <div class="row">
            <label>Контактный телефон</label>
            <input type="text"/>

            <p class="hint">Например, так: 89051234567</p>
        </div>
        <input class="submit-btn" type="submit" value="Отправить"/>
    </form>
</div>

<div class="index-box">
    <div class="main-img">
        <div class="title">Эволюция в ванной комнате</div>
    </div>
    <div class="service">
        <div class="service-item">
            <div class="service-item-wrapper">
                <h3>Дизайн и проектирование</h3>

                <div class="service-hr"></div>
                <div class="service-description">Бесплатный замер и дизайн-проект</div>
            </div>
        </div>
        <div class="service-item">
            <div class="service-item-wrapper">
                <h3>Продажа</h3>

                <div class="service-hr"></div>
                <div class="service-description">Элитная сантехника по доступным ценам</div>
            </div>
        </div>
        <div class="service-item">
            <div class="service-item-wrapper">
                <h3>Установка и монтаж</h3>

                <div class="service-hr"></div>
                <div class="service-description">Бесплатная установка и монтаж с гарантией</div>
            </div>
        </div>
        <div class="service-item">
            <div class="service-item-wrapper">
                <h3>Сервисное обслуживание</h3>

                <div class="service-hr"></div>
                <div class="service-description">Гарантийное обслуживание сантехники</div>
            </div>
        </div>
    </div>
    <div class="anchor"></div>
    <div class="project">
        <a href="#" class="project-item project-title">
            <span class="pr-title">Проекты</span>
            <span class="pr-count">234</span>
        </a>
        <a href="#" class="project-item">
            <img src="../../../i/test.png">

            <div class="project-description">
                <span>
                aasdasdasdaasdasdasd aasdasdasdaasdasdasd aasdasdasdaasdasdasd aasdasdasdaasdasdasd
                aasdasdasdaasdasdasd aasdasdasdaasdasdasd aasdasdasdaasdasdasd aasdasdasdaasdasdasd
                aasdasdasdaasdasdasd
                    </span>
            </div>
        </a>
        <a href="#" class="project-item">
            <img src="">
        </a>
        <a href="#" class="project-item">
            <img src="">
        </a>
        <a href="#" class="project-item">
            <img src="">
        </a>
        <a href="#" class="project-item">
            <img src="">
        </a>
        <a href="#" class="project-item">
            <img src="">
        </a>
        <a href="#" class="project-item">
            <img src="">
        </a>
    </div>
    <div class="news">
        <a href="#" class="news-item news-title">
            <span class="nw-title">Октябрь</span>
            <span class="nw-count">234</span>
        </a>
        <a href="#" class="news-item">
            <img src="">
        </a>
        <a href="#" class="news-item">
            <img src="">
        </a>
        <a href="#" class="news-item">
            <img src="">
        </a>
        <a href="#" class="news-item">
            <img src="">
        </a>
        <a href="#" class="news-item">
            <img src="">
        </a>
        <a href="#" class="news-item">
            <img src="">
        </a>
        <a href="#" class="news-item">
            <img src="">
        </a>
    </div>
</div>
<div class="index-sidebar">
    <a href="#" class="manufacturer">
        <img src="../../../i/test.png">
        <img class="manufacturer-logo" src="../../../i/logo.png">
    </a>
    <a href="#" class="manufacturer">
        <img src="">
    </a>
    <a href="#" class="manufacturer">
        <img src="">
    </a>
    <a href="#" class="manufacturer">
        <img src="">
    </a>
    <a href="#" class="manufacturer">
        <img src="">
    </a>
    <a href="#" class="manufacturer">
        <img src="">
    </a>
    <a href="#" class="manufacturer">
        <img src="">
    </a>
    <a href="#" class="manufacturer">
        <img src="">
    </a>
</div>

<script>
    $('.callback').click(function () {
        $('.callback-dialog').show();
    });
    $('.dialog-close').click(function () {
        $('.callback-dialog').hide();
    });
</script>

