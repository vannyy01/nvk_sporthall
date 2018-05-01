<?php
declare(strict_types=1);

namespace app\models;

use app\models\users\User;
use Yii;
use yii\base\Model;

class SignUp extends Model
{
    public $user_name;
    public $email;
    public $password;
    public $password_2;
    public $name;
    public $second_name;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['password', 'password_2', 'user_name', 'email', 'name', 'second_name'], 'required'],
            [['user_name', 'name', 'second_name'], 'string', 'min' => 4, 'max' => 45],
            [['password', 'password_2'], 'string', 'min' => 8, 'max' => 30],
            [['email'], 'string', 'max' => 50],
            ['email', 'email'],
        ];
    }

    /**
     * @return bool
     */
    public function SignUp(): bool
    {
        if ($this->password !== $this->password_2) {
            Yii::$app->session->setFlash('passError', 'Перевірте паролі.');
            return false;
        }
        $user = new User();
        if (!$user::findOne($this->user_name) || !$user::findOne($this->email)) {
            $user->user_name = htmlspecialchars(trim($this->user_name));
            $user->setPassword(htmlspecialchars(trim($this->password)));
            $user->name = htmlspecialchars(trim($this->name));
            $user->second_name = htmlspecialchars(trim($this->second_name));
            $user->email = htmlspecialchars(trim($this->email));
            return $user->save();
        }
        return false;
    }
}