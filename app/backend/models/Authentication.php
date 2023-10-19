<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "authentication".
 *
 * @property int $id
 * @property string $phone
 * @property string $otp
 * @property int $expired
 * @property string $created_at
 */
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Authentication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authentication';
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
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'otp'], 'required'],
            [['expired'], 'integer'],
            [['created_at'], 'safe'],
            [['phone'], 'string', 'max' => 15],
            [['otp'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'otp' => 'Otp',
            'expired' => 'Expired',
            'created_at' => 'Created At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AuthenticationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthenticationQuery(get_called_class());
    }
}
