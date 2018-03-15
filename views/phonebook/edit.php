<?php
/**
 * Created by PhpStorm.
 * User: cseal
 * Date: 21.12.2017
 * Time: 13:44
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
<h1>Редактирование контакта телефонной книги</h1>
        <?php if(yii::$app->session->hasFlash("succ")){?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?=yii::$app->session->getFlash('succ')?>
            </div>
        <?php }elseif (yii::$app->session->hasFlash("warn")){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?=yii::$app->session->getFlash('warn')?>
            </div>
        <?php } ?>
        <div class="col-md-8 col-md-offset-1">
<?php $contactForm = ActiveForm::begin(['options' => ['id'=>'editContactForm', 'class' => 'form-horizontal']]) //Начало создания формы ?>
<?=$contactForm->field($contactCont, 'id')->label(false)->hiddenInput() ?>
<?=$contactForm->field($contactCont, 'name') ?>
<?=$contactForm->field($contactCont, 'surname')?>
<?=$contactForm->field($contactCont, 'patronumic')?>
<?= HTML::submitButton('Обновить запись', ['class'=>'btn btn-primary'])?>
<?=HTML::a('Перейти к списку контактов', ['phonebook/index'], ['class' => 'btn btn-warning', 'style'=>['margin-left'=>'35px']]) ?>
<?=HTML::a('Добавить/Редактировать телефонные номера', ['phonebook-number/index', 'contId' => $contactCont->id], ['class' => 'btn btn-danger', 'style'=>['margin-top'=>'15px']]) ?>
<?php ActiveForm::end()////Начало создания формы ?>
        </div>
    </div>
</div>