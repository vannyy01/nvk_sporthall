<?php
declare(strict_types=1);

namespace app\models\users;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\users\User;

/**
 * UserSearch represents the model behind the search form of `app\models\users\User`.
 */
class UserSearch extends User
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['id', 'role'], 'integer'],
            [['user_name', 'email', 'pass_hash', 'name', 'second_name'], 'safe'],
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
        $query = User::find();

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
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pass_hash', $this->pass_hash])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'second_name', $this->second_name]);

        return $dataProvider;
    }
}
