<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>


<div class="form login-form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>
    <h1>Авторизация</h1>

    <div class="row login-options error_summary">
        <?php echo $form->errorSummary($model); ?>
        <!--        --><?php //foreach ($model->getErrors() as $atribbute): ?>
        <!--            <div class="errorSummary">-->
        <!--        --><?php //endforeach ?>
    </div>

    <div class="row login-options">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row login-options">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>


    <div class="row login-options">
        <div class="ccaptcha_form">
            <?php $this->widget('CCaptcha') ?>
        </div>
        <?php echo CHtml::activeLabelEx($model, 'verifyCode') ?>
        <?php echo CHtml::activeTextField($model, 'verifyCode') ?>

    </div>
    <div class="row rememberMe">
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <?php echo $form->label($model, 'rememberMe'); ?>
        <?php echo $form->error($model, 'rememberMe'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Войти', array('class' => 'login-button')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
