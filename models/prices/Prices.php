<?php

namespace app\models\prices;

use app\models\affairs\Affairs;
use Yii;

/**
 * This is the model class for table "prices".
 *
 * @property string $id
 * @property string $name
 * @property string $price
 * @property string $descriprion
 * @property string $status
 * @property Affairs[] $affairs
 */
class Prices extends \yii\db\ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'descriprion', 'status'], 'required'],
            [['price', 'status'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['descriprion'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'status' => 'Status',
            'descriprion' => 'Descriprion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffairs()
    {
        return $this->hasMany(Affairs::className(), ['prices_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PricesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PricesQuery(get_called_class());
    }
}
