<?php
declare(strict_types=1);

namespace app\models\enrolls;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\enrolls\Enrolls;

/**
 * EnrollsSearch represents the model behind the search form of `app\models\enrolls\Enrolls`.
 */
class EnrollsSearch extends Enrolls
{
    /**
     * @return array
     */
    public function rules():array
    {
        return [
            [['id', 'affairs_id'], 'integer'],
            [['name', 'second_name', 'email', 'phone', 'created_at', 'verifycode'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function scenarios():array
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
    public function search($params):ActiveDataProvider
    {
        $query = Enrolls::find();

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
            'created_at' => $this->created_at,
            'affairs_id' => $this->affairs_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'verifycode', $this->verifycode]);

        return $dataProvider;
    }
}
