<?php
/* @var $this SiteController */

$this->pageTitle = "Penta House - О компании";
?>
<div class="breadcrumbs"><a href="/site/index">Главная</a> / О компании</div>
<div class="about-company">
    <h1>О компании</h1>

    <div class="about-company-descr">
        <p>PentaHouse &mdash; это многопрофильный холдинг, который объединяет под одной торговой маркой
            архитектурное бюро, инжиниринговую компанию, оптовую и розничную группу элитной сантехники,
            авторизированный инсталяционный департамент и логистическую службу. В Поволжье мы
            представляем уникальные элитные фабрики и заводы сантехники, мебели, посуды и предметов
            интерьера.</p>

        <p>В нашей команде работают высококлассные специалисты &mdash; дизайнеры, инженеры и менеджеры
            по представленным брендам.</p>

        <p>Наши партнеры &mdash; более 50 европейских фабрик, заводов-изготовителей и частных
            мастерских. Мы сотрудничаем как с новейшими, суперсовременными технологичными
            производствами, так и со старинными родовыми предприятиями, культурные традиции которых
            передаются из поколения в поколение несколько веков. Отсутствие посредников в отношениях с
            поставщиками, наличие собственного подразделения, управляющего цепочкой поставок, позволяет
            существенно снизить стоимость и сроки реализации проекта.</p>
    </div>
</div>
<div class="about-contacts">
    <h1>Контакты</h1>

    <ul class="contacts">
        <li>
            <div>ул.&nbsp;Большая&nbsp;Красная, д.&nbsp;13а, оф.&nbsp;1-4</div>
            <div>г. Казань, 420111</div>
            <div>+7&nbsp;(843)&nbsp;524-71-76</div>
            <a href="mailto:info@penta-house.ru">info@penta-house.ru</a>
            <a href="http://www.penta-house.ru">www.penta-house.ru</a>
        </li>
    </ul>
</div>
<div class="about-footer">
    <div class="news item-box">
        <a href="#" class="news-item item news-title">
            <span class="nw-title">Последние новости</span>
        </a>
        <?php foreach ($posts as $post): ?>
            <a href="#" class="news-item item" title="<?php echo $post->id; ?>">
                <img class="item-bg"
                     src="/uploads/<?php echo isset($post->upload1) ? $post->upload1->file_name : ''; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>