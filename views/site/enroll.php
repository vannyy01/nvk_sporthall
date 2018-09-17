<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $list app\models\affairs\Affairs */

/* @var $enrolls app\models\enrolls\Enrolls */



use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Запис';
$this->params['breadcrumbs']['title'] = $this->title;
?>
<div class="site-contact">

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('./public/img_pages/enroll.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Запишіться на заняття!</h1>
                        <span class="subheading">Маєте запитання? Напишіть нам!</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div>
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <?= Yii::$app->session->getFlash('success') ?>
                    <?php endif; ?>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($enrolls, 'affairs_id')->dropDownList($list) ?>
                <?= $form->field($enrolls, 'name')->label("Ім'я") ?>
                <?= $form->field($enrolls, 'second_name')->label("Прізвище") ?>
                <?= $form->field($enrolls, 'email')->label("Електрону пошту") ?>
                <?= $form->field($enrolls, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
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
                <?= $form->field($enrolls, 'verifycode')->widget(Captcha::classname())->label("Ви не робот?") ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
