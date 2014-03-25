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
<!-- Begin page content -->
<div class="container">
    <div class="page-header">
        <?php $this->renderPartial('/layouts/_menu'); ?>
    </div>

    <?php echo $content; ?>
</div>

<div id="footer">
    <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
    </div>
</div>
<div id="modal-api"></div>
</body>
</html>
