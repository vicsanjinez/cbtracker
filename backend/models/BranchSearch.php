<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Branch;

/**
 * BranchSearch represents the model behind the search form about `backend\models\Branch`.
 */
class BranchSearch extends Branch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'idcompany', 'address', 'datecreated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc 
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
        $query = Branch::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->setSort([
                'attributes' => [
                    'name',
                    'address',
                    'datecreated',
                    'status',
                    'idcompany' => [
                        'asc' => ['company.name' => SORT_ASC],
                        'desc' => ['company.name' => SORT_DESC],
                    ]
                ]
            ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('company');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'datecreated' => $this->datecreated,
            'branch.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'branch.name', $this->name])
            ->andFilterWhere(['like', 'branch.address', $this->address])
            ->andFilterWhere(['like', 'company.name', $this->idcompany])
            ;

        return $dataProvider;
    }
}
