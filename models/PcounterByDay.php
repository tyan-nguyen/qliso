<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcounter_by_day".
 *
 * @property int $id
 * @property string $day
 * @property int $user
 */
class PcounterByDay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcounter_by_day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day', 'user'], 'required'],
            [['day'], 'safe'],
            [['user'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Ngày',
            'user' => 'Lượt truy cập',
        ];
    }

    public function getListYear(){
    	return [
    			'2020'=>'2020',
    			'2019'=>'2019',
    	];
    }

    public function getListMonth(){
    	$arr = array();

    	for($i=1; $i<=12; $i++){
    		$arr[$i] = 'Tháng '.$i;
    	}
    	return $arr;
    }
}
