<?php

namespace app\models\queries\affairs;

/**
 * This is the ActiveQuery class for [[\app\models\affairs\Enrolls]].
 *
 * @see \app\models\affairs\Enrolls
 */
class EnrollsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\affairs\Enrolls[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\affairs\Enrolls|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
