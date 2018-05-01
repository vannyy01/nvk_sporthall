<?php
declare(strict_types=1);

namespace app\models\affairs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\affairs\Affairs;

/**
 * AffairsSearch represents the model behind the search form of `app\models\affairs\Affairs`.
 */
class AffairsSearch extends Affairs
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['id', 'clients', 'trainer', 'prices_id'], 'integer'],
            [['time'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function scenarios(): array
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
    public function search($params): ActiveDataProvider
    {
        $query = Affairs::find();

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
            'time' => $this->affair_time,
            'clients' => $this->clients,
            'trainer' => $this->trainer,
            'prices_id' => $this->prices_id,
        ]);

        return $dataProvider;
    }
}
