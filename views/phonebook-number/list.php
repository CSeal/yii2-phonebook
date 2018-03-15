<?php
/**
 * Created by PhpStorm.
 * User: CSeal
 * Date: 22.12.2017
 * Time: 5:28
 */
use yii\widgets\ActiveForm;
use yii\helpers\html;
?>
<h1>Добавить | Удалить номера телефонов</h1>
<h2><?=$contactInfo['surname']?>  <?=$contactInfo['name']?>  <?=$contactInfo['patronumic']?></h2>
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
<?php $contactNumberForm = ActiveForm::begin(['options' => ['id' => 'contactNumberForm', 'class' => 'form-inline']]) ?>
<?=$contactNumberForm->field($numberModel, 'id')->label(false)->hiddenInput()?>
<?=$contactNumberForm->field($numberModel, 'number') ?>
<?=$contactNumberForm->field($numberModel, 'contact_info_id')->label(false)->hiddenInput()?>
<?=HTML::submitButton('Добавить номер', ['class'=>'btn btn-primary','style'=>['margin-left'=>'15px', 'margin-top'=>'-15px']])?>
<?php ActiveForm::end()?>
<?=HTML::a('Перейти к редактированию контакта '.$contactInfo['surname'] . ' ' . $contactInfo['name'] . ' ' . $contactInfo['patronumic'], ['phonebook/edit', 'id'=>$contId], ['class' => 'btn btn-warning', 'style'=>['margin-top'=>'15px', 'margin-bottom'=>'15px']]) ?>
<?=HTML::a('Перейти к списку контактов', ['phonebook/index'], ['class' => 'btn btn-danger', 'style'=>['margin-left'=>'25px']]) ?>
<h4>Действующие номера телефонов</h4>
<ul>
    <?php
        foreach($allNumber as $number){ ?>
            <li><?=$number->number?> <?=HTML::a('Удалить',['phonebook-number/delete', 'id'=>$number->id, 'contId'=>$contId])?></li>
    <?php } ?>
</ul>