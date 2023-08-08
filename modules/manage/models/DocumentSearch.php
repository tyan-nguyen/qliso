<?php

namespace app\modules\manage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manage\models\Document;

/**
 * DocumentSearch represents the model behind the search form about `app\modules\manage\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_working', 'user_created'], 'integer'],
            [['document_name', 'document_url', 'document_type', 'summary', 'date_created'], 'safe'],
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
    public function search($params, $idWorking=NULL)
    {
        $query = Document::find();

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
            //'id_working' => $this->id_working,
            'date_created' => $this->date_created,
            'user_created' => $this->user_created,
        ]);
        
        if($idWorking != null){
            $query->andFilterWhere([
                'id_working' => $idWorking
            ]);
        }

        $query->andFilterWhere(['like', 'document_name', $this->document_name])
            ->andFilterWhere(['like', 'document_url', $this->document_url])
            ->andFilterWhere(['like', 'document_type', $this->document_type])
            ->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
