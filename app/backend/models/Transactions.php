<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property string $reference_code
 * @property string $transaction_type
 * @property string $description
 * @property int $amount
 * @property string $payment_gateway
 * @property int $status
 * @property int $member_id
 * @property string $inserted_at
 *
 * @property Members $member
 */
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
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
            [['reference_code'], 'required'],
            [['amount', 'status', 'member_id'], 'integer'],
            [['inserted_at'], 'safe'],
            [['reference_code', 'transaction_type', 'description', 'payment_gateway'], 'string', 'max' => 255],
            [['reference_code'], 'unique'],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reference_code' => 'Reference Code',
            'transaction_type' => 'Transaction Type',
            'description' => 'Description',
            'amount' => 'Amount',
            'payment_gateway' => 'Payment Gateway',
            'status' => 'Status',
            'member_id' => 'Member ID',
            'inserted_at' => 'Inserted At',
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
     * {@inheritdoc}
     * @return TransactionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionsQuery(get_called_class());
    }
}
