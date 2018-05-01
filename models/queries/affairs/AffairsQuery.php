<?php

namespace app\models\queries\affairs;

/**
 * This is the ActiveQuery class for [[\app\models\affairs\Affairs]].
 *
 * @see \app\models\affairs\Affairs
 */
use \yii\db\ActiveQuery;
class AffairsQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\affairs\Affairs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\affairs\Affairs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
