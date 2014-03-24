<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="language" content="ru"/>
</head>

<body>
<header>
    <div class="container">
        <?php $this->renderPartial('/layouts/_menu'); ?>
    </div>
</header>
<div class="container">
    <?php echo $content; ?>
</div>

</body>
</html>

