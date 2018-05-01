<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $list app\models\affairs\Affairs */

/* @var $enrolls app\models\affairs\Enrolls */



use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Запис';
$this->params['breadcrumbs']['title'] = $this->title;
?>
<div class="site-contact">

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('./public/img/enroll.jpg')">
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

                <?= $form->field($enrolls, 'time')->dropDownList(ArrayHelper::map($list, 'time', 'time', 'trainer'))->label('Виберіть час заняття') ?>
                <?= $form->field($enrolls, 'name')->label("Ім'я") ?>
                <?= $form->field($enrolls, 'second_name')->label("Прізвище") ?>
                <?= $form->field($enrolls, 'email')->label("Електрону пошту") ?>
                <?= $form->field($enrolls, 'phone')->label("Телефонний номер") ?>
                <?= $form->field($enrolls, 'verifycode')->widget(Captcha::classname(), [
                ])->label("Ви не робот?") ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
