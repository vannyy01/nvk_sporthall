<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <div class="site-error" style="margin-top: 10%">

                <h1><?= Html::encode($this->title) ?></h1>

                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>

                <p>
                    Помилка під час обробки запиту сервером.
                </p>
            </div>
        </div>
    </div>
</div>