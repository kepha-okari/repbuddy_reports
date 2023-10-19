<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "incoming_payment_logs".
 *
 * @property int $id
 * @property string $msisdn
 * @property int $order_id
 * @property string $merchant_request_id
 * @property string $checkout_request_id
 * @property string $response_code
 * @property string $response_desc
 * @property string $customer_message
 * @property string $result_code
 * @property string $result_desc
 * @property string $amount
 * @property string $mpesa_receipt
 * @property string $transaction_date
 * @property int $client_id
 * @property string $status
 * @property string $inserted_at
 * @property string $updated_at
 *
 * @property Orders $order
 */
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class IncomingPaymentLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incoming_payment_logs';
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
            [['order_id', 'client_id'], 'integer'],
            [['inserted_at', 'updated_at'], 'safe'],
            [['msisdn'], 'string', 'max' => 50],
            [['merchant_request_id', 'checkout_request_id', 'response_desc', 'customer_message', 'result_desc'], 'string', 'max' => 255],
            [['response_code', 'result_code', 'status'], 'string', 'max' => 11],
            [['amount', 'mpesa_receipt', 'transaction_date'], 'string', 'max' => 100],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'Msisdn',
            'order_id' => 'Order ID',
            'merchant_request_id' => 'Merchant Request ID',
            'checkout_request_id' => 'Checkout Request ID',
            'response_code' => 'Response Code',
            'response_desc' => 'Response Desc',
            'customer_message' => 'Customer Message',
            'result_code' => 'Result Code',
            'result_desc' => 'Result Desc',
            'amount' => 'Amount',
            'mpesa_receipt' => 'Mpesa Receipt',
            'transaction_date' => 'Transaction Date',
            'client_id' => 'Client ID',
            'status' => 'Status',
            'inserted_at' => 'Inserted At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
