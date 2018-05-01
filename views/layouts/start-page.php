<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<style>
    *{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    main{
        height: 120vh;
        background: url('https://images.unsplash.com/photo-1477346611705-65d1883cee1e?dpr=0.800000011920929&auto=format&fit=crop&w=1199&h=800&q=80&cs=tinysrgb&crop=') fixed no-repeat;
        background-size: cover;
    }
    #container{
        width: 350px;
        height: 725px;
        background: inherit;
        position: absolute;
        overflow: hidden;
        top: 25%;
        left: 50%;
        margin-left: -175px;
        margin-top: -12%;
        border-radius: 8px;
    }
    #container:before{
        width: 400px;
        height: 550px;
        content: "";
        position: absolute;
        top: -25px;
        left: -25px;
        bottom: 0;
        right: 0;
        background: inherit;
        box-shadow: inset 0 0 0 200px rgba(255,255,255,0.2);
        filter: blur(10px);
    }
    form img{
        width: 120px;
        height: 120px;
        border-radius: 100%;
    }
    form{
        text-align: center;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
    }
    input{
        background: 0;
        width: 200px;
        outline: 0;
        border: 0;
        border-bottom: 2px solid rgba(255,255,255, 0.3);
        margin: 20px 0;
        padding-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
        color: rgba(255,255,255, 0.8);
    }
    input[type="submit"]{
        border: 0;
        border-radius: 8px;
        padding-bottom: 0;
        height: 60px;
        background: #df2359;
        color: white;
        cursor: pointer;
        transition: all 600ms ease-in-out;
    }
    input[type="submit"]:hover{
        background: #C0392B;
    }
    span a{
        color: rgba(255,255,255, 0.8);
    }
</style>
<main>
    <div id="container">

        <?= $content ?>

    </div>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
