<?php

namespace app\models\affairs;

/**
 * This is the ActiveQuery class for [[Affairs]].
 *
 * @see Affairs
 */
class AffairsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Affairs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Affairs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
