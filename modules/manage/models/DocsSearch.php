<?php

namespace app\modules\manage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manage\models\Docs;
use app\models\Custom;

/**
 * DocsSearch represents the model behind the search form about `app\modules\manage\models\Docs`.
 */
class DocsSearch extends Docs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_type', 'id_group', 'user_created', 'doc_year', 'id_dm'], 'integer'],
            [['code', 'doc_name', 'doc_ext', 'doc_url', 'summary', 'date_created', 'doc_no', 'doc_summary', 'doc_date', 'doc_sign', 'doc_year', 'id_room', 'idRoomParent'], 'safe'],
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
    public function search($params, $dm=NULL)
    {
        $query = Docs::find();
        $query->joinWith(['room as ro']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'doc_year' => SORT_DESC,
                    'id' => SORT_DESC
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if($this->doc_date != null){
            $custom = new Custom();
            $this->doc_date = $custom->convertDMYtoYMD($this->doc_date);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_type' => $this->id_type,
            'id_group' => $this->id_group,
            'user_created' => $this->user_created,
            'date_created' => $this->date_created,
            'doc_date' => $this->doc_date,
            'doc_year' => $this->doc_year,
            'id_room' => $this->id_room,
        ]);
        
        

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'doc_name', $this->doc_name])
            ->andFilterWhere(['like', 'doc_ext', $this->doc_ext])
            ->andFilterWhere(['like', 'doc_url', $this->doc_url])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'doc_no', $this->doc_no])
            ->andFilterWhere(['like', 'doc_summary', $this->doc_summary])
            ->andFilterWhere(['like', 'doc_sign', $this->doc_sign]);
        
        if($this->idRoomParent != null){
            $query->andFilterWhere([
                'ro.room_parent' => $this->idRoomParent,
            ]);
        }
        
        if($dm!=NULL){
            $query->andFilterWhere([
                'id_dm' => $dm,
            ]);
        } else {
            $query->andWhere('id_dm IS NULL');
        }
            
        return $dataProvider;
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchIso($params, $idiso)
    {
        $query = Docs::find()->alias('t');
        $query->joinWith('group as gr');
        
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
            'id_type' => $this->id_type,
            'id_group' => $this->id_group,
            'user_created' => $this->user_created,
            'date_created' => $this->date_created,
            'doc_date' => $this->doc_date,
        ]);
        
        $query->andFilterWhere(['like', 'code', $this->code])
        ->andFilterWhere(['like', 'doc_name', $this->doc_name])
        ->andFilterWhere(['like', 'doc_ext', $this->doc_ext])
        ->andFilterWhere(['like', 'doc_url', $this->doc_url])
        ->andFilterWhere(['like', 'summary', $this->summary])
        ->andFilterWhere(['like', 'doc_no', $this->doc_no])
        ->andFilterWhere(['like', 'doc_summary', $this->doc_summary])
        ->andFilterWhere(['like', 'doc_sign', $this->doc_sign]);
        
        if($idiso != NULL){
            $query->andFilterWhere([
                'gr.id_iso' => $idiso
            ]);
        }
        
        return $dataProvider;
    }
}
