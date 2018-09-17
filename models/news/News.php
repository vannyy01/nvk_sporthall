<?php
declare(strict_types=1);

namespace app\models\news;

use app\models\GetUser;
use app\models\users\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $header
 * @property string $date
 * @property string $short_description
 * @property string $full_description
 * @property string $author
 *  * @property string $image
 */
class News extends ActiveRecord implements GetUser
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'news';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['date'], 'safe'],
            [['full_description'], 'string'],
            [['author'], 'required'],
            [['author'], 'integer'],
            [['header'], 'string', 'max' => 100],
            [['short_description'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 50],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'header' => 'Заголовок',
            'date' => 'Дата',
            'short_description' => 'Короткий опис',
            'full_description' => 'Повний опис',
            'author' => 'Автор',
            'image' => 'Фото',
        ];
    }

    /**
     * @return array|null|ActiveRecord
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author'])->one();
    }

    /**
     * @param bool $withLogin
     * @return string
     */
    public function getFullUserName(bool $withLogin = true): string
    {
        return $withLogin ? $this->getAuthor()->name . ' ' .
            $this->getAuthor()->second_name . '(' . $this->getAuthor()->user_name . ')' : $this->getAuthor()->name . ' ' .
            $this->getAuthor()->second_name;
    }

    /**
     * @inheritdoc
     * @return \app\models\news\NewsQuery the active query used by this AR class.
     */
    public static function find(): NewsQuery
    {
        return new NewsQuery(get_called_class());
    }


}
