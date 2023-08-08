<?php

namespace app\modules\manage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manage\models\Working;
use app\models\User;

/**
 * WorkingSearch represents the model behind the search form about `app\modules\manage\models\Working`.
 */
class WorkingPhongBanSearch extends Working
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_examination', 'id_room', 'user_created', 'id_template_group', 'id_template_single'], 'integer'],
            [['code', 'date_exam', 'date_created', 'summary'], 'safe'],
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
    public function search($params, $idEx=NULL)
    {
        $query = Working::find();
        
        $roomId = User::findOne(Yii::$app->user->id)->info->room_id;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_exam' => $this->date_exam,
            'date_created' => $this->date_created,
            'user_created' => $this->user_created,
            'id_template_group' => $this->id_template_group,
            'id_template_single' => $this->id_template_single,
        ]);
        
        if($roomId != null){
            $query->andFilterWhere([
                'id_room' => $roomId,
            ]);
        }

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'summary', $this->summary]);
        
        if($idEx != null){
            $query->andFilterWhere([
                'id_examination' => $idEx,
            ]);
        }
            
        return $dataProvider;
    }
}
