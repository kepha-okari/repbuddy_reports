<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Transactions;
use backend\libraries\RBAC;

/**
 * TransactionSearch represents the model behind the search form of `backend\models\Transactions`.
 */
class TransactionSearch extends Transactions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'amount', 'status', 'member_id'], 'integer'],
            [['reference_code', 'transaction_type', 'description', 'payment_gateway', 'inserted_at'], 'safe'],
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
        $query = Transactions::find();
        
        /*
        Boilerplate
        if(Yii::$app->user->identity->client_id != RBAC::super_client)//If client not equal to super
        {
            $query = Transactions::find()->where('client_id='.Yii::$app->user->identity->client_id);
        }else{
            $query = Transactions::find();

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
            'amount' => $this->amount,
            'status' => $this->status,
            'member_id' => $this->member_id,
            'inserted_at' => $this->inserted_at,
        ]);

        $query->andFilterWhere(['like', 'reference_code', $this->reference_code])
            ->andFilterWhere(['like', 'transaction_type', $this->transaction_type])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'payment_gateway', $this->payment_gateway]);

        return $dataProvider;
    }
}
