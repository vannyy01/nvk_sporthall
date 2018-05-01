<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */


use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        main {
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1477346611705-65d1883cee1e?dpr=0.800000011920929&auto=format&fit=crop&w=1199&h=800&q=80&cs=tinysrgb&crop=') fixed no-repeat;
            background-size: cover;
        }

        #container {
            width: 350px;
            height: 500px;
            background: inherit;
            position: absolute;
            overflow: hidden;
            top: 50%;
            left: 50%;
            margin-left: -175px;
            margin-top: -250px;
            border-radius: 8px;
        }

        #container:before {
            width: 400px;
            height: 550px;
            content: "";
            position: absolute;
            top: -25px;
            left: -25px;
            bottom: 0;
            right: 0;
            background: inherit;
            box-shadow: inset 0 0 0 200px rgba(255, 255, 255, 0.2);
            filter: blur(10px);
        }

        form img {
            width: 120px;
            height: 120px;
            border-radius: 100%;
        }

        form {
            text-align: center;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        input {
            background: 0;
            width: 200px;
            outline: 0;
            border: 0;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            margin: 20px 0;
            padding-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.8);
        }

        input[type="submit"] {
            border: 0;
            border-radius: 8px;
            padding-bottom: 0;
            height: 60px;
            background: #df2359;
            color: white;
            cursor: pointer;
            transition: all 600ms ease-in-out;
        }

        input[type="submit"]:hover {
            background: #C0392B;
        }

        span a {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
<?php $form = ActiveForm::begin([
    'id' => 'login',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

<?php if (Yii::$app->session->hasFlash('passError')): ?>
    <div style="color: white; font-size: 16px">
        <span style="color: #ff7117"><?= Yii::$app->session->getFlash('passError', null, true) ?><span>
    </div>
<?php endif; ?>
    <input type="text" name="Login[identificator]" placeholder="Логін або Email"><br>
    <input type="password" id="login-password" name="Login[password]" placeholder="Пароль"><br>
    <input type="submit" value="Увійти" name="login-button"><br>
    <span><a href="/signup">Реєстрація</a></span>

<?php ActiveForm::end(); ?>