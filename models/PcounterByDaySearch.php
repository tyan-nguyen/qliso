<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PcounterByDay;
use yii\db\Expression;

/**
 * PcounterByDaySearch represents the model behind the search form about `app\models\PcounterByDay`.
 */
class PcounterByDaySearch extends PcounterByDay
{
	public $nam;
	public $thang;
	public $tu_ngay;
	public $den_ngay;
	public $search_tu_ngay;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user'], 'integer'],
            [['day', 'thang', 'nam', 'tu_ngay', 'den_ngay', 'search_tu_ngay'], 'safe'],
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
    public function search($params)
    {
    	$custom = new Custom();
        $query = PcounterByDay::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        	//'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]],
        	'pagination' => [
        		'pageSize' => 10,
        	],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'day' => $this->day,
            'user' => $this->user,
        ]);

        if($this->search_tu_ngay != null){
        	$searchTuNgay = explode(' - ', $this->search_tu_ngay);
        	$query->andFilterWhere(['between', 'day', $custom->convertDMYtoYMD($searchTuNgay[0]), $custom->convertDMYtoYMD($searchTuNgay[1]) ]);
        }

       /* if($this->tu_ngay != null && $this->den_ngay != null){
        	$query->andFilterWhere(['between', 'day', $this->tu_ngay, $this->den_ngay]);
        }
        else if($this->tu_ngay != null && $this->den_ngay == null){
        	$query->andFilterWhere(['>', 'day', $this->tu_ngay]);
        }
        else if($this->tu_ngay == null && $this->den_ngay != null){
        	$query->andFilterWhere(['<', 'day', $this->den_ngay]);
        }

		if($this->nam != null){
        	$query->andWhere("YEAR(day) ='". $this->nam. "'");
		}
		if($this->thang != null){
			$query->andWhere("MONTH(day) ='". $this->thang. "'");
		}*/

        return $dataProvider;
    }
}
