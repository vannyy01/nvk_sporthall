<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\helpers\OwnHelper;

/* @var $this yii\web\View */
/* @var $model app\models\affairs\Affairs */
/* @var $form yii\widgets\ActiveForm */
/* @var $trainers app\models\User */
/* @var $prices app\models\prices\Prices */

?>

<div class="affairs-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    $date = (new DateTime())->format('Y-m-d');
    echo '<label class="control-label">Дата занняття</label>';
    echo $form->field($model, 'virtual_date')->widget(\kartik\date\DatePicker::className(), [
        'type' => \kartik\date\DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => "2018-04-12",
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ])->label(false);

    echo '<label class="control-label">Час Заняття</label>';
    echo $form->field($model, 'virtual_time')->widget(\kartik\time\TimePicker::className(), [
        'size' => 'md',
        'pluginOptions' => [
            'showMeridian' => false,
            'minuteStep' => 1,
        ]
    ])->label(false);
    ?>

    <?php
    $items = OwnHelper::concatObjectFieldsToArray($trainers, "id", ["name", "second_name"]);
    echo $form->field($model, 'trainer')->dropDownList($items)->label("Тренер");
    ?>

    <?php
    $items = OwnHelper::concatObjectFieldsToArray($prices, "id", ["name", "price"]);

    echo $form->field($model, 'prices_id')->dropDownList($items)->label("Ціна");
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
