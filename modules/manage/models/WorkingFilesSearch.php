<?php

namespace app\modules\manage\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manage\models\WorkingFiles;

/**
 * WorkingFilesSearch represents the model behind the search form about `app\modules\manage\models\WorkingFiles`.
 */
class WorkingFilesSearch extends WorkingFiles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_working', 'user_created'], 'integer'],
            [['file_name', 'file_type', 'file_url', 'shared_with', 'summary', 'date_created', 'id_user',], 'safe'],
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
        $query = WorkingFiles::find();

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
            'id_user' => $this->id_user,
            'date_created' => $this->date_created,
            'user_created' => $this->user_created,
            'file_type' => $this->file_type,
        ]);
        
        if($idWorking != null){
            $query->andFilterWhere([
                'id_working' => $idWorking
            ]);
        }

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_url', $this->file_url])
            ->andFilterWhere(['like', 'shared_with', $this->shared_with])
            ->andFilterWhere(['like', 'summary', $this->summary]);
        
       //$query->andWhere('id_user IS NULL');

        return $dataProvider;
    }
}
