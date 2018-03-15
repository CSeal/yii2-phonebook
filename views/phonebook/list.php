<?php
    use yii\helpers\Html;
?>
<h1>Телефонный справочник</h1>
<?=HTML::a('Добавить запись', ['phonebook/add'], ['class'=>'btn btn-success', 'style' => 'margin-bottom: 30px'])?>
<?php
if(isset($phonebook)){?>
    <table class="table table-hover table-condensed"><thead><tr><td>#</td><td>Фамилия</td><td>Имя</td><td>Отчество</td><td>Телефоннные номера</td><td></td></tr></thead><tbody>
    <?php foreach($phonebook as $phone){?>
        <tr><td><?=$phone->id?></td><td><?=$phone->surname?></td><td><?=$phone->name?></td><td><?=$phone->patronumic?></td><td>
                <?php if($phone->phonesNumber){
                    $phoneNumbers = $phone->phonesNumber;
                    foreach($phoneNumbers as $phoneNumber){ ?>
                        <?=$phoneNumber->number?><br />
                    <?php }} ?>
            </td><td><?=Html::a('Редактировать',['phonebook/edit', 'id'=>$phone->id])?><br/><?=HTML::a('Удалить',['phonebook/delete', 'id'=>$phone->id])?></td></tr>
 <?php } ?>
    </tbody>
    </table>
<?php } ?>
