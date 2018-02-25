<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ServerSearch represents the model behind the search form about `backend\models\Server`.
 */
class ServerSearch extends Server
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [
                [
                    'title',
                    'user',
                    'host',
                    'path',
                ],
                'safe'
            ],
        ];
    }

    public function scenarios()
    {
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
        $query = Server::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'user', $this->title])
            ->andFilterWhere(['like', 'host', $this->title])
            ->andFilterWhere(['like', 'path', $this->title]);

        return $dataProvider;
    }
}
