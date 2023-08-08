<?php

namespace app\modules\manage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manage\models\TeamMember;

/**
 * TeamMemberSearch represents the model behind the search form about `app\modules\manage\models\TeamMember`.
 */
class TeamMemberSearch extends TeamMember
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_working', 'id_position', 'id_user', 'user_created'], 'integer'],
            [['date_created', 'summary'], 'safe'],
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
    public function search($params, $idWorking = NULL)
    {
        $query = TeamMember::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_position' => $this->id_position,
            'id_user' => $this->id_user,
            'date_created' => $this->date_created,
            'user_created' => $this->user_created,
        ]);
        
        if($idWorking != null){
            $query->andFilterWhere([
                'id_working' => $idWorking,
            ]);
        }

        $query->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
