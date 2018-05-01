<?php
declare(strict_types=1);

namespace app\models\affairs;

use app\models\enrolls\Enrolls;
use app\models\prices\Prices;
use app\models\users\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "affairs".
 *
 * @property string $id
 * @property string $affair_time
 * @property int $clients
 * @property string $trainer
 * @property string $prices_id
 *
 * @property Prices $prices
 * @property User $trainer0
 * @property Enrolls[] $enrolls
 */
class Affairs extends ActiveRecord
{
    public $virtual_date;
    public $virtual_time;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'affairs';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['affair_time', 'trainer', 'prices_id'], 'required'],
            [['affair_time'], 'safe'],
            [['clients', 'trainer', 'prices_id'], 'integer'],
            [['affair_time'], 'unique'],
            [['prices_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prices::className(), 'targetAttribute' => ['prices_id' => 'id']],
            [['trainer'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['trainer' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'affair_time' => 'Час',
            'clients' => 'Клієнти',
            'trainer' => 'Тренер',
            'prices_id' => 'Ціна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices(): ActiveQuery
    {
        return $this->hasOne(Prices::className(), ['id' => 'prices_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::className(), ['id' => 'trainer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolls(): ActiveQuery
    {
        return $this->hasMany(Enrolls::className(), ['affairs_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AffairsQuery the active query used by this AR class.
     */
    public static function find(): AffairsQuery
    {
        return new AffairsQuery(get_called_class());
    }
}
