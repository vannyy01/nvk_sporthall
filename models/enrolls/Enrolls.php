<?php
declare(strict_types=1);

namespace app\models\enrolls;

use app\models\affairs\Affairs;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "enrolls".
 *
 * @property int $id
 * @property string $name
 * @property string $second_name
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $affairs_id
 * @property string $verifycode
 *
 * @property Affairs $affairs
 */
class Enrolls extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName():string
    {
        return 'enrolls';
    }

    /**
     * @return array
     */
    public function rules():array
    {
        return [
            [['email', 'phone', 'affairs_id'], 'required'],
            [['created_at'], 'safe'],
            [['affairs_id'], 'integer'],
            [['name', 'second_name'], 'string', 'max' => 32],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['verifycode'], 'string', 'max' => 10],
            [['affairs_id'], 'exist', 'skipOnError' => true, 'targetClass' => Affairs::className(), 'targetAttribute' => ['affairs_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'name' => 'Ім`я',
            'second_name' => 'Прізвище',
            'email' => 'Email',
            'phone' => 'Телефон',
            'created_at' => 'Створенний',
            'affairs_id' => 'Час',
            'verifycode' => 'Код Капчі',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffairs():ActiveQuery
    {
        return $this->hasOne(Affairs::className(), ['id' => 'affairs_id']);
    }

    /**
     * @inheritdoc
     * @return EnrollsQuery the active query used by this AR class.
     */
    public static function find():EnrollsQuery
    {
        return new EnrollsQuery(get_called_class());
    }
}
