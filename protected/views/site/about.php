<?php
/* @var $this SiteController */

$this->pageTitle = "Penta House - О компании";
?>
<div class="breadcrumbs"><a href="/site/index">Главная</a> / О компании</div>
<div class="about-company">
    <h1>О компании</h1>

    <div class="about-company-descr">
        <?php echo $about->description; ?>
    </div>
</div>
<div class="about-contacts">
    <h1>Контакты</h1>
    <?php foreach ($contacts as $contact) if ($contact->id == $this->active_contact_id)
        $active_contact = $contact;
    ?>
    <ul class="contacts">
        <li>
            <div><?php echo $active_contact->address; ?></div>
            <div><?php echo $active_contact->city; ?></div>
            <div><?php echo $active_contact->phone; ?></div>

            <a href="mailto:info@penta-house.ru">info@penta-house.ru</a>
            <a href="http://www.penta-house.ru">www.penta-house.ru</a>
        </li>
    </ul>
</div>
<div class="about-footer">
    <div class="news item-box">
        <a href="/site/posts" class="news-item item news-title">
            <span class="nw-title">Последние новости</span>
        </a>
        <?php foreach ($posts as $post): ?>
            <a href="/site/post?id=<?php echo $post->id; ?>" class="news-item item">
                <img class="item-bg"
                     src="/uploads/<?php echo isset($post->upload1) ? $post->upload1->file_name : ''; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>