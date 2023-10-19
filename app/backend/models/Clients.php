<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $name
 * @property string $image_path
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $location 
 * @property string $api_key
 * @property string $api_secret
 * @property string $api_token
 * @property int $status
 * @property string $inserted_at
 * @property string $updated_at
 *
 * @property AccountCategories[] $accountCategories
 * @property Accounts[] $accounts
 * @property Loans[] $loans
 * @property Members[] $members
 * @property Orders[] $orders
 * @property Products[] $products
 */
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
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
            [['address'], 'string'],
            [['status'], 'integer'],
            [['inserted_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['image_path', 'email', 'api_key', 'api_secret', 'api_token'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['location'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image_path' => 'Image Path',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'location' => 'Location',
            'api_key' => 'Api Key',
            'api_secret' => 'Api Secret',
            'api_token' => 'Api Token',
            'status' => 'Status',
            'inserted_at' => 'Inserted At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCategories()
    {
        return $this->hasMany(AccountCategories::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Accounts::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loans::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Members::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['client_id' => 'id']);
    }
}
