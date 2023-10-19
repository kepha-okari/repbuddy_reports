<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IncomingPaymentLogs;
use backend\libraries\RBAC;

/**
 * IncomingPaymentLogSearch represents the model behind the search form of `backend\models\IncomingPaymentLogs`.
 */
class IncomingPaymentLogSearch extends IncomingPaymentLogs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'client_id'], 'integer'],
            [['msisdn', 'merchant_request_id', 'checkout_request_id', 'response_code', 'response_desc', 'customer_message', 'result_code', 'result_desc', 'amount', 'mpesa_receipt', 'transaction_date', 'status', 'inserted_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = IncomingPaymentLogs::find();
        
        /*
        Boilerplate
        if(Yii::$app->user->identity->client_id != RBAC::super_client)//If client not equal to super
        {
            $query = IncomingPaymentLogs::find()->where('client_id='.Yii::$app->user->identity->client_id);
        }else{
            $query = IncomingPaymentLogs::find();

        }
        */

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'client_id' => $this->client_id,
            'inserted_at' => $this->inserted_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'msisdn', $this->msisdn])
            ->andFilterWhere(['like', 'merchant_request_id', $this->merchant_request_id])
            ->andFilterWhere(['like', 'checkout_request_id', $this->checkout_request_id])
            ->andFilterWhere(['like', 'response_code', $this->response_code])
            ->andFilterWhere(['like', 'response_desc', $this->response_desc])
            ->andFilterWhere(['like', 'customer_message', $this->customer_message])
            ->andFilterWhere(['like', 'result_code', $this->result_code])
            ->andFilterWhere(['like', 'result_desc', $this->result_desc])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'mpesa_receipt', $this->mpesa_receipt])
            ->andFilterWhere(['like', 'transaction_date', $this->transaction_date])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
