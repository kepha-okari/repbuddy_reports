<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Authentication]].
 *
 * @see Authentication
 */
class AuthenticationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Authentication[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Authentication|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
