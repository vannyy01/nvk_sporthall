<?php
declare(strict_types=1);

namespace app\models\users;

use app\models\affairs\Affairs;
use app\models\GetUser;
use app\models\news\News;
use yii\base\InvalidArgumentException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $user_name
 * @property string $name
 * @property string $second_name
 * @property string $email
 * @property string $pass_hash
 * @property int $role
 *
 * @property Affairs[] $affairs
 * @property News[] $news
 */
class User extends ActiveRecord implements IdentityInterface, GetUser
{
    const ROLE_ADMIN = 20;
    const ROLE_TRAINER = 10;
    const ROLE_BANNED = 0;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'users';
    }


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['role', 'in', 'range' => [static::ROLE_TRAINER, static::ROLE_ADMIN, static::ROLE_BANNED]],
            [['user_name', 'email', 'pass_hash', 'name', 'second_name'], 'required'],
            [['role'], 'integer'],
            [['user_name', 'name', 'second_name'], 'string', 'max' => 45],
            [['pass_hash'], 'string', 'max' => 100],
            [['user_name'], 'unique'],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }


    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_name' => 'Логін',
            'email' => 'Email',
            'pass_hash' => 'Password Hash',
            'role' => 'Роль',
            'name' => 'Ім`я',
            'second_name' => 'Прізвище',
        ];
    }

    /**
     * @param $password
     */
    public function setPassword($password): void
    {
        $this->pass_hash = md5(sha1($password));
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password): bool
    {
        return $this->pass_hash === md5(sha1($password));
    }

    /**
     * @param $email
     * @return bool
     */
    public static function isUserTrainer($email): bool
    {
        if (static::find()->where(['email' => $email])->andWhere('role >=' . User::ROLE_TRAINER)->one() || static::find()->where(['user_name' => $email])->andWhere('role >=' . User::ROLE_TRAINER)->one()) {
            return true;
        }
        return false;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function isUserAdmin($email): bool
    {
        if (static::findOne(['user_name' => $email, 'role' => static::ROLE_ADMIN]) || static::findOne(['email' => $email, 'role' => static::ROLE_ADMIN])) {
            return true;
        }
        return false;
    }

    /**
     * @return \app\models\users\UserQuery
     */
    public static function find(): UserQuery
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @param int|string $id
     * @return null|static
     */
    public static function findIdentity($id): ?User
    {
        return self::findOne($id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffairs(): ActiveQuery
    {
        return $this->hasMany(Affairs::className(), ['trainer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews(): ActiveQuery
    {
        return $this->hasMany(News::className(), ['author' => 'id']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatusName(): int
    {
        return $this->role;
    }

    /**
     * @return array
     */
    public static function getStatusesArray(): array
    {
        return [static::ROLE_TRAINER, static::ROLE_ADMIN, static::ROLE_BANNED];
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getUserNameById(int $id): string
    {
        if ($user = static::findOne(['id' => $id]))
            return $user->getFullUserName(false);
        throw new InvalidArgumentException("This User ID does not exist.");
    }

    /**
     * @param bool $withLogin
     * @return string
     */
    public function getFullUserName(bool $withLogin = true): string
    {
        return $withLogin ? $this->name . ' ' . $this->second_name . ' ' . $this->user_name : $this->name . ' ' . $this->second_name;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {

    }
}