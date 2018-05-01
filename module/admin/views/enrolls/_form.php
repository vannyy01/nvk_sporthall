<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\helpers\OwnHelper;

/* @var $this yii\web\View */
/* @var $model app\models\enrolls\Enrolls */
/* @var $form yii\widgets\ActiveForm */
/* @var $affairs [] app\models\affairs\Affairs */
?>

<div class="enrolls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label("Ім'я") ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true])->label("Прізвище") ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label("Пошта") ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+38 (099) 999-99-99',
        'options' => [
            'class' => 'form-control placeholder-style',
            'id' => 'phone2',
            'placeholder' => ('Мобільний номер')
        ],
        'clientOptions' => [
            'greedy' => false,
            'clearIncomplete' => true
        ]
    ])->label("Мобільний номер") ?>
    <?php
    $items = OwnHelper::concatObjectFieldsToArray($affairs, "id", ["affair_time"]);
    echo $form->field($model, 'affairs_id')->dropDownList($items)->label("Заняття");
    ?>

    <?= $form->field($model, 'verifycode')->textInput(['maxlength' => true, "value" => !$model->verifycode ? "0000" : $model->verifycode, 'readonly' => true])->label("Код капчі") ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
