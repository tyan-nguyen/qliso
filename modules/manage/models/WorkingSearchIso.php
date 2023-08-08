<?php

namespace app\modules\manage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manage\models\Working;

/**
 * WorkingSearch represents the model behind the search form about `app\modules\manage\models\Working`.
 */
class WorkingSearchIso extends Working
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_examination', 'id_room', 'user_created', 'id_template_group', 'id_template_single'], 'integer'],
            [['code', 'date_exam', 'date_created', 'summary', 'idRoomParent'], 'safe'],
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
    public function search($params, $idiso=NULL, $idEx=NULL)
    {
        $query = Working::find();
        $query->joinWith(['workingRoom as wr', 'workingExamination as exam']);

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
            'id_room' => $this->id_room,
            'date_exam' => $this->date_exam,
            'date_created' => $this->date_created,
            'user_created' => $this->user_created,
            'id_template_group' => $this->id_template_group,
            'id_template_single' => $this->id_template_single,
            //'id_examination' => $this->id_examination,
        ]);
        
        if($idiso != null){
            $query->andFilterWhere([
                'exam.id_iso' => $idiso,
            ]);
        }
        
        if($idEx != null){
            $query->andFilterWhere([
                'id_examination' => $idEx,
            ]);
        }
        
        if($this->idRoomParent != null){
            $query->andFilterWhere([
                'wr.room_parent' => $this->idRoomParent,
            ]);
        }

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
