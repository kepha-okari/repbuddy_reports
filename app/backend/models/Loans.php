<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "loans".
 *
 * @property int $id
 * @property int $client_id
 * @property string $loan_code
 * @property int $member_id
 * @property int $amount
 * @property int $balance
 * @property string $status
 * @property string $inserted_at
 * @property string $updated_at
 *
 * @property Clients $client
 * @property Members $member
 */
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Loans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loans';
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
            [['client_id', 'member_id', 'status'], 'required'],
            [['client_id', 'member_id', 'amount', 'balance'], 'integer'],
            [['inserted_at', 'updated_at'], 'safe'],
            [['loan_code'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 10],
            [['loan_code'], 'unique'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Client ID'),
            'loan_code' => Yii::t('app', 'Loan Code'),
            'member_id' => Yii::t('app', 'Member ID'),
            'amount' => Yii::t('app', 'Amount'),
            'balance' => Yii::t('app', 'Balance'),
            'status' => Yii::t('app', 'Status'),
            'inserted_at' => Yii::t('app', 'Inserted At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
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
     * @return LoansQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoansQuery(get_called_class());
    }
}
