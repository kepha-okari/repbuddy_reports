<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Members;
use backend\libraries\RBAC;

/**
 * MemberSearch represents the model behind the search form of `backend\models\Members`.
 */
class MemberSearch extends Members
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'identity_no', 'id_type', 'phone', 'dob', 'inserted_at', 'updated_at'], 'safe'],
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
        $query = Members::find();
        
        /*
        Boilerplate
        if(Yii::$app->user->identity->client_id != RBAC::super_client)//If client not equal to super
        {
            $query = Members::find()->where('client_id='.Yii::$app->user->identity->client_id);
        }else{
            $query = Members::find();

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
            'client_id' => $this->client_id,
            'inserted_at' => $this->inserted_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'identity_no', $this->identity_no])
            ->andFilterWhere(['like', 'id_type', $this->id_type])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'dob', $this->dob]);

        return $dataProvider;
    }
}



