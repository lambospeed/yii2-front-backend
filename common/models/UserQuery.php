<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserAccount]].
 *
 * @see UserAccount
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byName($name)
    {
        $this->andWhere(['username' => $name]);
        return $this;
    }

    public function byNameOrEmail($name)
    {
        $this->andWhere(['username' => $name]);
        $this->orWhere(['email' => $name]);
        return $this;
    }

    public function isActive()
    {
        $this->andWhere(['status' => User::STATUS_ACTIVE]);
        return $this;
    }
}