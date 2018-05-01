<?php
declare(strict_types=1);

namespace app\models;

use Yii;
use  app\models\users\User;
use yii\base\Model;

class Login extends Model
{
    public $identificator;
    public $password;
    // public $rememberMe;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['password', 'identificator'], 'required'],
            [['identificator'], 'string', 'max' => 50],
            ['password', 'validatePassword'] //собственная функция для валидации пароля
        ];
    }

    /**
     * @return bool
     */
    public function isUserBanned(): bool
    {
        if ($this->getUser()->role === User::ROLE_BANNED) {
            Yii::$app->session->setFlash("passError", "Ви заблоковані. Зверніться до адміністратора.");
            return false;
        }
        return true;
    }

    /**
     * @param $attribute
     */
    public function validatePassword($attribute): void
    {
        if (!$this->hasErrors()) // если нет ошибок в валидации
        {
            $user = $this->getUser(); // получаем пользователя для дальнейшего сравнения пароля
            if (!$user || !$user->validatePassword($this->password)) {
                //если мы НЕ нашли в базе такого пользователя
                //или введенный пароль и пароль пользователя в базе НЕ равны ТО,
                $text = 'Пароль або email введені невірно';
                $this->addError($attribute, $text);
                Yii::$app->session->setFlash('passError', $text);
                //добавляем новую ошибку для атрибута password о том что пароль или имейл введены не верно
            }
        }
    }

    /**
     * @return null|User
     */
    public function getUser():?User
    {
        $user = User::findOne(['email' => $this->identificator]);
        if (empty($user)) {
            $user = User::findOne(['user_name' => $this->identificator]);
        }
        return $user;// а получаем мы его по введенному имейлу
    }

    /**
     * @return bool
     */
    public function loginAdmin(): bool
    {
        if ($this->validate() && User::isUserAdmin($this->identificator)) {
            return Yii::$app->user->login($this->getUser(), 3600 * 24);
        }
        return false;
    }
}