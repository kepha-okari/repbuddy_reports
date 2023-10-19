<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property double $balance
 * @property double $debit
 * @property double $credit
 * @property string $type
 * @property int $client_id
 * @property int $member_id
 * @property string $inserted_at
 * @property string $updated_at
 *
 * @property Members $member
 * @property Clients $client
 * @property Ledgers[] $ledgers
 */
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Accounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounts';
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
            [['balance', 'debit', 'credit'], 'number'],
            [['type'], 'required'],
            [['client_id', 'member_id'], 'integer'],
            [['inserted_at', 'updated_at'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'balance' => 'Balance',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'type' => 'Type',
            'client_id' => 'Client ID',
            'member_id' => 'Member ID',
            'inserted_at' => 'Inserted At',
            'updated_at' => 'Updated At',
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
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLedgers()
    {
        return $this->hasMany(Ledgers::className(), ['account_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AccountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountsQuery(get_called_class());
    }
}
