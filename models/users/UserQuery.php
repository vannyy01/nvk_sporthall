<?php
declare(strict_types=1);

namespace app\models\users;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Users]].
 *
 * @see User
 */
class UserQuery extends ActiveQuery
{
    /**
     * @return $this
     *
     */
    public function active():UserQuery
    {
        return $this->andWhere('[[status]]=>'.User::ROLE_TRAINER);
    }

    /**
     * @inheritdoc
     * @return User[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return User|array|null
     */
    public function one($db = null):?User
    {
        return parent::one($db);
    }
}
