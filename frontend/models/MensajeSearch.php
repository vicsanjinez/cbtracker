<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mensaje;

/**
 * MensajeSearch represents the model behind the search form about `frontend\models\Mensaje`.
 */
class MensajeSearch extends Mensaje
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado', 'idusuario', 'idusuariodestino'], 'integer'],
            [['contenido', 'fechaevaluacion'], 'safe'],
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
        $query = Mensaje::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fechaevaluacion' => $this->fechaevaluacion,
            'estado' => $this->estado,
            'idusuario' => $this->idusuario,
            'idusuariodestino' => $this->idusuariodestino,
        ]);

        $query->andFilterWhere(['like', 'contenido', $this->contenido]);

        return $dataProvider;
    }
}
