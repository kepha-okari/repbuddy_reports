<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Ledgers;
use backend\libraries\RBAC;

/**
 * LedgerSearch represents the model behind the search form of `backend\models\Ledgers`.
 */
class LedgerSearch extends Ledgers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'account_id'], 'integer'],
            [['transaction_id', 'inserted_at'], 'safe'],
            [['amount', 'credit', 'debit', 'balance'], 'number'],
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
        $query = Ledgers::find();
        
        /*
        Boilerplate
        if(Yii::$app->user->identity->client_id != RBAC::super_client)//If client not equal to super
        {
            $query = Ledgers::find()->where('client_id='.Yii::$app->user->identity->client_id);
        }else{
            $query = Ledgers::find();

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
            'credit' => $this->credit,
            'debit' => $this->debit,
            'balance' => $this->balance,
            'inserted_at' => $this->inserted_at,
            'member_id' => $this->member_id,
            'account_id' => $this->account_id,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id]);

        return $dataProvider;
    }
}
