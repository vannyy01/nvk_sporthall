<?php
/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

use yii\bootstrap\ActiveForm;

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'signup-form',
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
    <input type="text" name="SignUp[user_name]" placeholder="Логін"><br>
    <input type="text" name="SignUp[email]" placeholder="Пошта"><br>
    <input type="text" name="SignUp[name]" placeholder="Ім'я"><br>
    <input type="text" name="SignUp[second_name]" placeholder="Прізвище"><br>
    <input type="password" id="login-password" name="SignUp[password]" placeholder="Пароль"><br>
    <input type="password" id="login-password" name="SignUp[password_2]" placeholder="Повторіть пароль"><br>
    <input type="submit" value="Зареєструватися" name="login-button"><br>
    <span><a href="/login">Увійти</a></span>

<?php ActiveForm::end(); ?>