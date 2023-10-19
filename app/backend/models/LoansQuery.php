<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Loans]].
 *
 * @see Loans
 */
class LoansQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Loans[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Loans|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
