<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ClientAdmins]].
 *
 * @see ClientAdmins
 */
class ClientAdminsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClientAdmins[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClientAdmins|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
