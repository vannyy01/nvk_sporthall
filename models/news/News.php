<?php
declare(strict_types=1);

namespace app\models\news;

use app\models\queries\news\NewsQuery;
use app\models\User;
use yii\db\ActiveQuery;
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
class News extends ActiveRecord
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
            'header' => 'Header',
            'date' => 'Date',
            'short_description' => 'Short Description',
            'full_description' => 'Full Description',
            'author' => 'Author',
            'image' => 'Image',
        ];
    }

    public function getAuthor0()
    {
        return $this->hasOne(User::className(), ['id' => 'author'])->one();
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\news\NewsQuery the active query used by this AR class.
     */
    public static function find(): NewsQuery
    {
        return new NewsQuery(get_called_class());
    }



}
