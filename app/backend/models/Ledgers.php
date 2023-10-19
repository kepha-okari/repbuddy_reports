<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ledgers".
 *
 * @property int $id
 * @property string $transaction_id
 * @property double $amount
 * @property double $credit
 * @property double $debit
 * @property double $balance
 * @property string $inserted_at
 * @property int $member_id
 * @property int $account_id
 *
 * @property Members $member
 * @property Accounts $account
 */
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Ledgers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledgers';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'inserted_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            // [
            //     'class' => BlameableBehavior::className(),
            //     'createdByAttribute' => 'created_by',
            //     'updatedByAttribute' => 'updated_by',
            // ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'credit', 'debit', 'balance'], 'number'],
            [['inserted_at'], 'safe'],
            [['member_id', 'account_id'], 'integer'],
            [['transaction_id'], 'string', 'max' => 255],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accounts::className(), 'targetAttribute' => ['account_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_id' => 'Transaction ID',
            'amount' => 'Amount',
            'credit' => 'Credit',
            'debit' => 'Debit',
            'balance' => 'Balance',
            'inserted_at' => 'Inserted At',
            'member_id' => 'Member ID',
            'account_id' => 'Account ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Members::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_id']);
    }

    /**
     * {@inheritdoc}
     * @return LedgersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LedgersQuery(get_called_class());
    }
}
