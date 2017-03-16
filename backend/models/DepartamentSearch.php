<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Departament;

/**
 * DepartamentSearch represents the model behind the search form about `backend\models\Departament`.
 */
class DepartamentSearch extends Departament
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'idbranch', 'idcompany', 'datecreated'], 'safe'],
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
        $query = Departament::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('company');
        $query->joinWith('branch');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'datecreated' => $this->datecreated,
            'status' => $this->status,
            
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'company.name', $this->idcompany])
            ->andFilterWhere(['like', 'branch.name', $this->idbranch])
        ;

        return $dataProvider;
    }
}
